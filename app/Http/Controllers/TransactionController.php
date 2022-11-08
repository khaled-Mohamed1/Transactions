<?php

namespace App\Http\Controllers;

use App\Exports\CustomersExport;
use App\Exports\TransactionExport;
use App\Helpers\Helper;
use App\Models\Customer;
use App\Models\Transaction;
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
        $this->middleware('permission:transaction-list|transaction-create|transaction-edit|transaction-delete', ['only' => ['index']]);
        $this->middleware('permission:transaction-create', ['only' => ['create','store']]);
        $this->middleware('permission:transaction-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:transaction-delete', ['only' => ['delete']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|  View
     */
    public function index()
    {
        if(auth()->user()->role_id == 1 || auth()->user()->role_id == 3){
            $transactions = Transaction::orderBy('transaction_NO')->paginate(100);
        }else{
            dd(auth()->user()->id);
            $transactions = Transaction::where(auth()->user()->id, 'user_id')->orderBy('transaction_NO')->paginate(100);
        }

//        if(auth()->user()->role_id == 1){
//            $customers = Customer::with('transactions')->orderBy('customer_NO')->where('status','!=','جديد')
//                ->where('status','!=','مرفوض')->paginate(100);
//        }else{
//            $customers = Customer::with('transactions')->orderBy('customer_NO')->where('status','!=','مرفوض')
//                    ->where('status','!=','جديد')->where('updated_by',auth()->user()->id)
//                ->paginate(100);
//        }

        return view('transactions.index', ['transactions' => $transactions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        if(auth()->user()->role_id == 1 || auth()->user()->role_id == 3){
            $customers = Customer::where('status','=','قيد التوقيع')->orWhere('status','=','متعسر')->latest()->get();
        }else{
            $customers = Customer::where('updated_by',auth()->user()->id)->where('status','=','قيد التوقيع')->orWhere('status','=','متعسر')->latest()->get();
        }
        return view('transactions.create',['customers' => $customers]);
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

                'full_name'    => 'required',
                'ID_NO'     => 'required|numeric|digits:9|'.Rule::unique('customers')->ignore($request->customer_id),
                'phone_NO' => 'required|numeric|digits:10',
                'region'       =>  'required',
                'address'       =>  'required',

//                'reserve_phone_NO' => 'numeric|digits:10',
                'date_of_birth'       =>  'required|date',
                'marital_status'       =>  'required',
                'number_of_children'       =>  'required',
                'job'   =>  'required_if:transactions_type,استقطاع',
                'salary'   =>  'required_if:transactions_type,استقطاع',
                'bank_name'   =>  'required_if:transactions_type,استقطاع',
                'bank_branch'   =>  'required_if:transactions_type,استقطاع',
                'bank_account_NO'   =>  'required_if:transactions_type,استقطاع',

                'transactions_type'     => 'required',
                'transaction_amount'     => 'required',
                'first_payment'     => 'required',
                'transaction_rest'     => 'required',
                'monthly_payment'     => 'required',
                'date_of_first_payment'     => 'required',

                'draft_NO'   =>  'required',
                'agency_NO'   =>  'required',
                'endorsement_NO'   =>  'required',
                'receipt_NO'   =>  'required',
            ]
            ,[

                'full_name.required' => 'يجب ادخال اسم العميل',
                'ID_NO.required' => 'يجب ادخال رقم هوية العميل',
                'ID_NO.unique' => 'تم ادخال رقم الهوية من قبل',
                'ID_NO.numeric' => 'يجب ادخال رقم الهوية بالأرقام',
                'ID_NO.digits' => 'رقم الهوية يتكون من 9 ارقام فقط',
                'phone_NO.required' => 'يجب ادخال رقم جوال العميل',
                'phone_NO.numeric' => 'يجب ادخال رقم الجوال بالأرقام',
                'phone_NO.digits' => 'رقم الجوال يتكون من 10 ارقام فقط',
                'region.required' => 'يجب ادخال منطفة السكن',
                'address.required' => 'يجب ادخال العنوان بالتفصيل',

//                'reserve_phone_NO.required' => 'يجب ادخال رقم جوال احتياطي للعميل',
//                'reserve_phone_NO.numeric' => 'يجب ادخال رقم الجوال بالأرقام',
//                'reserve_phone_NO.digits' => 'رقم الجوال يتكون من 10 ارقام فقط',
                'date_of_birth.required' => 'يجب ادخال تاريخ ميلاد العميل',
                'marital_status.required' => 'يجب ادخال الحالة الإجتماعية للعميل',
                'number_of_children.required' => 'يجب ادخال عدد افراد الأسرة العميل',
                'job.required_if' => 'يجب ادخال الوظيفة العميل',
                'salary.required_if' => 'يجب ادخال دخل العميل',
                'bank_name.required_if' => 'يجب ادخال اسم البنك',
                'bank_branch.required_if' => 'يجب ادخال فرع البنك',
                'bank_account_NO.required_if' => 'يجب ادخال رقم حساب البنك',
                'draft_NO.required' => 'يجب ادخال عدد الكمبيالات',
                'agency_NO.required' => 'يجب ادخال عدد الوكالات',
                'endorsement_NO.required' => 'يجب ادخال عدد الاقرارات',
                'receipt_NO.required' => 'يجب ادخال عدد الوصل',

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
                'draft_NO'       => $request->draft_NO,
                'agency_NO'       => $request->agency_NO,
                'endorsement_NO'       => $request->endorsement_NO,
                'receipt_NO'       => $request->receipt_NO,
            ]);

            if($transaction->transaction_NO == 500000){
                $transaction->transaction_NO = $transaction->transaction_NO + 1;
                $transaction->save();
            }


//            if($request->transactions_type == 'ودي' || $request->transactions_type == 'شيكات' || $request->transactions_type == 'قروض'){
//                $status = 'مكتمل';
//            }else{
//                $status = 'تم التوقيع';
//            }

            // Store Data
            $customer = Customer::findOrFail($request->customer_id);

            $customer->update([
                'full_name'    => $request->full_name,
                'ID_NO'     => $request->ID_NO,
                'phone_NO'         => $request->phone_NO,
                'region' => $request->region,
                'address'       => $request->address,
                'account' => $request->account,
                'reserve_phone_NO'    => $request->reserve_phone_NO,
                'date_of_birth'     => $request->date_of_birth,
                'marital_status'         => $request->marital_status,
                'number_of_children' => $request->number_of_children,
                'job'       => $request->job,
                'salary'       => $request->salary,
                'bank_name'       => $request->bank_name,
                'bank_branch'       => $request->bank_branch,
                'bank_account_NO'       => $request->bank_account_NO,
                'status'       => 'متعسر',
            ]);

            // Store Data
            $customer->where('id', $request->customer_id)->update([
                'account'       => $customer->account + $request->transaction_rest,
            ]);

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
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return Application|Factory|View
     */
    public function edit(Transaction $transaction)
    {
//        if(auth()->user()->role_id == 1){
//            $customers = Customer::where('status','!=','مكتمل')->where('status','!=','جديد')->latest()->get();
//        }else{
//            $customers = Customer::where('updated_by',auth()->user()->id)->where('status','!=','مكتمل')->where('status','!=','جديد')->latest()->get();
//        }
        return view('transactions.edit')->with([
            'transaction'  => $transaction
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
                'reserve_phone_NO' => 'numeric|digits:10',
                'date_of_birth'       =>  'required|date',
                'marital_status'       =>  'required',
                'number_of_children'       =>  'required',
                'job'   =>  'required_if:transactions_type,استقطاع',
                'salary'   =>  'required_if:transactions_type,استقطاع',
                'bank_name'   =>  'required_if:transactions_type,استقطاع',
                'bank_branch'   =>  'required_if:transactions_type,استقطاع',
                'bank_account_NO'   =>  'required_if:transactions_type,استقطاع',
                'draft_NO'   =>  'required',
                'agency_NO'   =>  'required',
                'endorsement_NO'   =>  'required',
                'receipt_NO'   =>  'required',
                'transactions_type'     => 'required',
                'transaction_amount'     => 'required',
                'first_payment'     => 'required',
                'transaction_rest'     => 'required',
                'monthly_payment'     => 'required',
                'date_of_first_payment'     => 'required',
            ]
            ,[
//                'reserve_phone_NO.required' => 'يجب ادخال رقم جوال احتياطي للعميل',
                'reserve_phone_NO.unique' => 'تم ادخال رقم جوال من قبل',
                'reserve_phone_NO.numeric' => 'يجب ادخال رقم الجوال بالأرقام',
                'reserve_phone_NO.digits' => 'رقم الجوال يتكون من 10 ارقام فقط',
                'date_of_birth.required' => 'يجب ادخال تاريخ ميلاد العميل',
                'marital_status.required' => 'يجب ادخال الحالة الإجتماعية للعميل',
                'number_of_children.required' => 'يجب ادخال عدد افراد الأسرة العميل',
                'job.required_if' => 'يجب ادخال الوظيفة العميل',
                'salary.required_if' => 'يجب ادخال دخل العميل',
                'bank_name.required_if' => 'يجب ادخال اسم البنك',
                'bank_branch.required_if' => 'يجب ادخال فرع البنك',
                'bank_account_NO.required_if' => 'يجب ادخال رقم حساب البنك',
                'draft_NO.required' => 'يجب ادخال عدد الكمبيالات',
                'agency_NO.required' => 'يجب ادخال عدد الوكالات',
                'endorsement_NO.required' => 'يجب ادخال عدد الاقرارات',
                'receipt_NO.required' => 'يجب ادخال عدد الوصل',
                'transactions_type.required' => 'يجب ادخال نوع المعاملة',
                'transaction_amount.required' => 'يجب ادخال قيمة المعاملة',
                'first_payment.required' => 'يجب ادخال الدفعة الأولى',
                'transaction_rest.required' => 'يجب ادخال باقي قيمة المعاملة',
                'monthly_payment.required' => 'يجب ادخال قيمة دفعة المعاملة',
                'date_of_first_payment.required' => 'يجب ادخال تاريخ دفعة أول دفعة',
            ]);

        DB::beginTransaction();
        try {
//
//            $rest = 0;
//
//            if($request->transaction_rest != $transaction->transaction_rest){
//                if($request->transaction_rest > $transaction->transaction_rest){
//                    $rest = $request->transaction_rest - $transaction->transaction_rest;
//                }elseif($request->transaction_rest < $transaction->transaction_rest){
//                    $rest = $request->transaction_rest - $transaction->transaction_rest ;
//                }
//            }

            // Store Data
            $transaction = Transaction::whereId($transaction->id)->update([
                'draft_NO'       => $request->draft_NO,
                'agency_NO'       => $request->agency_NO,
                'endorsement_NO'       => $request->endorsement_NO,
                'receipt_NO'       => $request->receipt_NO,
                'transactions_type'     => $request->transactions_type,
                'transaction_amount'         => $request->transaction_amount,
                'first_payment' => $request->first_payment,
                'transaction_rest'       => $request->transaction_rest,
                'monthly_payment'       => $request->monthly_payment,
                'date_of_first_payment'       => $request->date_of_first_payment,
            ]);

//            if($request->transactions_type == 'ودي' || $request->transactions_type == 'شيكات' || $request->transactions_type == 'قروض'){
//                $status = 'مكتمل';
//            }else{
//                $status = 'تم التوقيع';
//            }

            // Store Data

            $customer->update([
                'reserve_phone_NO'    => $request->reserve_phone_NO,
                'date_of_birth'     => $request->date_of_birth,
                'marital_status'         => $request->marital_status,
                'number_of_children' => $request->number_of_children,
                'job'       => $request->job,
                'salary'       => $request->salary,
                'bank_name'       => $request->bank_name,
                'bank_branch'       => $request->bank_branch,
                'bank_account_NO'       => $request->bank_account_NO,
                'status'       => 'متعسر',
            ]);



//            // Store Data
//            $customer->update([
//                'account'   => $customer->account + $rest,
//            ]);

            // Commit And Redirected To Listing
            DB::commit();
            return redirect()->route('transactions.index')->with('success','تم تعديل المعاملة بنجاح');

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
        return Excel::download(new TransactionExport(), 'transactions.xlsx');
    }
}
