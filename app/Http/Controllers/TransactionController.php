<?php

namespace App\Http\Controllers;

use App\Exports\TransactionExport;
use App\Helpers\Helper;
use App\Models\Bank;
use App\Models\Customer;
use App\Models\CustomerJob;
use App\Models\Purchase;
use App\Models\Store;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class TransactionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:معاملات-بيانات|معاملات-اضافة|معاملات-تعجيل|معاملات-حذف', ['only' => ['index']]);
        $this->middleware('permission:معاملات-اضافة', ['only' => ['create','store']]);
        $this->middleware('permission:معاملات-تعديل', ['only' => ['edit','update']]);
        $this->middleware('permission:معاملات-حذف', ['only' => ['delete']]);
        $this->middleware('permission:معاملات-تصدير', ['only' => ['export']]);
        $this->middleware('permission:معاملات-جميع', ['only' => ['allIndex']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|  View
     */
    public function index()
    {

        $users = User::where('role_id','!=','1')->where('role_id','!=','3')->latest()->get();

        if(auth()->user()->role_id == 1 || auth()->user()->role_id == 3){
            $customers = Customer::with('transactions')->orderBy('customer_NO')->whereNotNull('updated_by')->paginate(100);
        }else{
            $customers = Customer::with('transactions')->where('updated_by', auth()->user()->id)->orderBy('customer_NO')->paginate(100);
        }

        return view('transactions.index', ['customers' => $customers,
            'users'=>$users]);
    }

    public function allIndex(){
        if(auth()->user()->role_id == 1 || auth()->user()->role_id == 3){
            $transactions = Transaction::orderBy('transaction_NO','desc')->paginate(100);
        }else{
            $transactions = Transaction::where('user_id', auth()->user()->id)->orderBy('transaction_NO')->paginate(100);
        }

        return view('transactions.allTransactions', ['transactions' => $transactions]);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(Customer $customer)
    {
        $banks = Bank::latest()->get();
        $jobs = CustomerJob::latest()->get();
        $stores = Store::where('product_qty','>',0)->get();
        return view('transactions.create',
            [
                'customer' => $customer,
                'stores'=>$stores,
                'banks' => $banks,
                'jobs' => $jobs,
            ]);
    }

    public function getProduct(Request $request)
    {
        $getProduct = Store::whereId($request->product_id)->get();
        if (count($getProduct) > 0) {
            return response()->json([
                'status' => 'success',
                'getProduct' => $getProduct,
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {

        // Validations
        $request->validate([
                'bank_name'   =>  'required_if:transactions_type,استقطاع',
                'bank_branch'   =>  'required_if:transactions_type,استقطاع',
                'bank_account_NO'   =>  'required_if:transactions_type,استقطاع',
                'transactions_type'     => 'required',
                'transaction_amount'     => 'required',
                'first_payment'     => 'required',
                'transaction_rest'     => 'required',
                'monthly_payment'     => 'required',
                'date_of_first_payment'     => 'required',
            ]
            ,[
                'transactions_type.required' => 'يجب ادخال نوع المعاملة',
                'transaction_amount.required' => 'يجب ادخال قيمة المعاملة',
                'first_payment.required' => 'يجب ادخال الدفعة الأولى',
                'transaction_rest.required' => 'يجب ادخال باقي قيمة المعاملة',
                'monthly_payment.required' => 'يجب ادخال قيمة دفعة المعاملة',
                'date_of_first_payment.required' => 'يجب ادخال تاريخ دفعة أول دفعة',
            ]
        );

        DB::beginTransaction();
        try {

            // Store Data
            $transaction = Transaction::create([
                'transaction_NO' => Helper::IDGenerator(new Transaction(), 'transaction_NO', 5,5),
                'user_id' => auth()->user()->id,
                'customer_id'    => $request->customer_id,
                'transactions_type'     => $request->transactions_type,
                'transaction_amount'         => $request->transaction_amount,
                'first_payment' => $request->first_payment,
                'transaction_rest'       => $request->transaction_rest,
                'monthly_payment'       => $request->monthly_payment,
                'date_of_first_payment'       => $request->date_of_first_payment,
            ]);

            if($transaction->transaction_NO == 500000){
                $transaction->transaction_NO = $transaction->transaction_NO + 1;
                $transaction->save();
            }

            // Store Data
            $customer = Customer::findOrFail($request->customer_id);

            $customer->update([
                'reserve_phone_NO'    => $request->reserve_phone_NO,
                'bank_id'       => $request->bank_name,
                'bank_branch'       => $request->bank_branch,
                'bank_account_NO'       => $request->bank_account_NO,
                'status'       => 'قيد العمل',
                'updated_by' => null
            ]);

            // Store Data
            $customer->where('id', $request->customer_id)->update([
                'account'       => $customer->account + $request->transaction_rest,
            ]);

            if ($request->product_name != null){
                foreach($request->product_name as $key => $data)
                {
                    $store = Store::find($request->product_name[$key]);
                    if($request->product_qty[$key] > $store->product_qty){
                        DB::rollBack();
                        return redirect()->back()->with('warning',$store->product_name."لا يمكن تجاوز الكمية الأصلية لمنتج");
                    }else{
                        $store = Store::where('id' , $request->product_name[$key])->decrement('product_qty', $request->product_qty[$key]);

                        // Store Data
                        $purchase = Purchase::create([
                            'customer_id'=> $request->customer_id,
                            'user_id' => auth()->user()->id,
                            'transaction_id' => $transaction->id,
                            'store_id' => $request->product_name[$key],
                            'product_qty' => $request->product_qty[$key],
                            'profit_ratio' => $request->profit_ratio[$key],
                            'profit' =>$request->hiddenProfit[$key],
                            'total_price' => $request->total[$key],
                        ]);
                    }

                }
            }

            // Commit And Redirected To Listing
            DB::commit();
            return redirect()->route('transactions.index')->with('success','تم انشاء المعاملة بنجاح!');

        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }


    public function get(Request $request)
    {
        $customer = Customer::with('transactions')->where('id',$request->customer_id)->get();
        return response()->json([
            'status' => 'success',
            'customer' => $customer,
        ]);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return Application|Factory|View
     */
    public function show(Transaction $transaction)
    {
        return view('transactions.show')->with([
            'transaction'  => $transaction,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return Application|Factory|View
     */
    public function edit(Transaction $transaction)
    {
        $banks = Bank::latest()->get();
        $jobs = CustomerJob::latest()->get();
        return view('transactions.edit')->with([
            'transaction'  => $transaction,
            'banks' => $banks,
            'jobs' => $jobs,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  \App\Models\Transaction  $transaction
     * @return RedirectResponse
     */
    public function update(Request $request, Transaction $transaction)
    {
        // Validations

        $customer = Customer::FindOrFail($request->customer_id);
        $request->validate([
                'transactions_type'     => 'required',
                'bank_name'   =>  'required_if:transactions_type,استقطاع',
                'bank_branch'   =>  'required_if:transactions_type,استقطاع',
                'bank_account_NO'   =>  'required_if:transactions_type,استقطاع',
                'transaction_amount'     => 'required',
                'first_payment'     => 'required',
                'transaction_rest'     => 'required',
                'monthly_payment'     => 'required',
                'date_of_first_payment'     => 'required',
            ]
            ,[
                'bank_name.required_if' => 'يجب ادخال اسم البنك',
                'bank_branch.required_if' => 'يجب ادخال فرع البنك',
                'bank_account_NO.required_if' => 'يجب ادخال رقم حساب البنك',
                'transactions_type.required' => 'يجب ادخال نوع المعاملة',
                'transaction_amount.required' => 'يجب ادخال قيمة المعاملة',
                'first_payment.required' => 'يجب ادخال الدفعة الأولى',
                'transaction_rest.required' => 'يجب ادخال باقي قيمة المعاملة',
                'monthly_payment.required' => 'يجب ادخال قيمة دفعة المعاملة',
                'date_of_first_payment.required' => 'يجب ادخال تاريخ دفعة أول دفعة',
            ]);

        DB::beginTransaction();
        try {

            // Store Data
            $transaction = Transaction::whereId($transaction->id)->update([
                'transactions_type'     => $request->transactions_type,
                'transaction_amount'         => $request->transaction_amount,
                'first_payment' => $request->first_payment,
                'transaction_rest'       => $request->transaction_rest,
                'monthly_payment'       => $request->monthly_payment,
                'date_of_first_payment'       => $request->date_of_first_payment,
            ]);

            // Store Data

            $customer->update([
                'reserve_phone_NO'    => $request->reserve_phone_NO,
                'bank_id'       => $request->bank_name,
                'bank_branch'       => $request->bank_branch,
                'bank_account_NO'       => $request->bank_account_NO,
            ]);

            // Commit And Redirected To Listing
            DB::commit();
            return redirect()->route('customers.show',['customer' => $customer->id])->with('success','تم تعديل المعاملة بنجاح');

        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return RedirectResponse
     */
    public function delete(Transaction $transaction)
    {
        DB::beginTransaction();
        try {
            // Delete User
            Transaction::whereId($transaction->id)->delete();

            DB::commit();
            return redirect()->route('transactions.index')->with('success', 'تم حذف المعاملة');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function export()
    {
        return Excel::download(new TransactionExport(), 'المعاملات.xlsx');
    }
}
