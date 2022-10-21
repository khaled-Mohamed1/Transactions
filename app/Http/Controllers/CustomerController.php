<?php

namespace App\Http\Controllers;

use App\Exports\AdverserExport;
use App\Exports\CustomersExport;
use App\Helpers\Helper;
use App\Imports\CustomerImport;
use App\Models\Customer;
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


class CustomerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:customer-list|customer-create|customer-edit|customer-delete|customer-show|customer-import', ['only' => ['index']]);
        $this->middleware('permission:customer-create', ['only' => ['create','store']]);
        $this->middleware('permission:customer-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:customer-delete', ['only' => ['delete']]);
        $this->middleware('permission:customer-show', ['only' => ['show']]);
        $this->middleware('permission:customer-adverser', ['only' => ['indexAdverser']]);
        $this->middleware('permission:customer-task', ['only' => ['indexTask','addTask']]);
        $this->middleware('permission:customer-import', ['only' => ['importCustomers','uploadCustomers']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */


    public function index()
    {
        $customers = Customer::orderBy('customer_NO','desc')->where('status', '=','جديد')->paginate(100);
        return view('customers.index', ['customers' => $customers]);
    }

    public function indexAdverser()
    {
        $customers = Customer::orderBy('customer_NO','desc')->where('status','!=','جديد')->where('status','!=','مرفوض')->paginate(10);
        return view('customers.index_adverser', ['customers' => $customers]);
    }

    public function indexTask()
    {
        $users = User::where('role_id','!=','1')->latest()->get();
        $customers = Customer::orderBy('customer_NO','desc')->where('status','=','متعسر')->where('status','=','مقبول')
            ->where('status','=','قيد التوقيع')->paginate(100);
        return view('customers.tasks', ['customers' => $customers,'users'=>$users]);
    }


    public function addTask(Request $request)
    {
        $customer = Customer::findOrFail($request->customer_id)->update([
            'updated_by' => $request->user_id,
        ]);
        return response()->json([
            'status' => 'success',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        // Validations
        $request->validate([
                'full_name'    => 'required',
                'ID_NO'     => 'required|numeric|digits:9|unique:customers',
                'phone_NO' => 'required|numeric|digits:10|unique:customers',
                'region'       =>  'required',
                'address'       =>  'required',
            ],[
                'full_name.required' => 'يجب ادخال اسم العميل',
                'ID_NO.required' => 'يجب ادخال رقم هوية العميل',
                'ID_NO.unique' => 'تم ادخال رقم الهوية من قبل',
                'ID_NO.numeric' => 'يجب ادخال رقم الهوية بالأرقام',
                'ID_NO.digits' => 'رقم الهوية يتكون من 9 ارقام فقط',
                'phone_NO.required' => 'يجب ادخال رقم جوال العميل',
                'phone_NO.unique' => 'تم ادخال رقم جوال من قبل',
                'phone_NO.numeric' => 'يجب ادخال رقم الجوال بالأرقام',
                'phone_NO.digits' => 'رقم الجوال يتكون من 10 ارقام فقط',
                'region.required' => 'يجب ادخال منطفة السكن',
                'address.required' => 'يجب ادخال العنوان بالتفصيل',
            ]
        );



        DB::beginTransaction();
        try {

            // Store Data
            $customer = Customer::create([
                'customer_NO' => Helper::IDGenerator(new Customer, 'customer_NO', 5,4),
                'full_name'    => $request->full_name,
                'ID_NO'     => $request->ID_NO,
                'phone_NO'         => $request->phone_NO,
                'region' => $request->region,
                'address'       => $request->address,
                'created_by' => auth()->user()->id
            ]);

            // Commit And Redirected To Listing
            DB::commit();
            return redirect()->route('customers.index')->with('success','تم انشاء العميل بنجاح');

        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Customer $customer
     * @return Application|Factory|View
     */
    public function show(Customer $customer)
    {
        return view('customers.show')->with([
            'customer'  => $customer
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Customer $customer
     * @return Application|Factory|View|\Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit')->with([
            'customer'  => $customer
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Customer $customer
     * @return RedirectResponse
     */
    public function update(Request $request, Customer $customer)
    {

        // Validations
        $request->validate(
            [
                'full_name'    => 'required',
                'ID_NO'     => 'required|numeric|digits:9|'.Rule::unique('customers')->ignore($customer->id),
                'phone_NO' => 'required|numeric|digits:10|',
                'region'       =>  'required',
                'address'       =>  'required',
//                'transactions_type'     => 'required_if:status,مقبول',
//                'transaction_amount'     => 'required_if:status,مقبول',
//                'first_payment'     => 'required_if:status,مقبول',
//                'transaction_rest'     => 'required_if:status,مقبول',
//                'monthly_payment'     => 'required_if:status,مقبول',
//                'date_of_first_payment'     => 'required_if:status,مقبول',


            ],[
                'full_name.required' => 'يجب ادخال اسم العميل',
                'ID_NO.required' => 'يجب ادخال رقم هوية العميل',
                'ID_NO.unique' => 'تم ادخال رقم الهوية من قبل',
                'ID_NO.numeric' => 'يجب ادخال رقم الهوية بالأرقام',
                'ID_NO.digits' => 'رقم الهوية يتكون من 9 ارقام فقط',
                'phone_NO.required' => 'يجب ادخال رقم جوال العميل',
                'phone_NO.unique' => 'تم ادخال رقم جوال من قبل',
                'phone_NO.numeric' => 'يجب ادخال رقم الجوال بالأرقام',
                'phone_NO.digits' => 'رقم الجوال يتكون من 10 ارقام فقط',
                'region.required' => 'يجب ادخال منطفة السكن',
                'address.required' => 'يجب ادخال العنوان بالتفصيل',
//                'transactions_type.required_if' => 'يجب ادخال نوع المعاملة',
//                'transaction_amount.required_if' => 'يجب ادخال قيمة المعاملة',
//                'first_payment.required_if' => 'يجب ادخال الدفعة الأولى',
//                'transaction_rest.required_if' => 'يجب ادخال باقي قيمة المعاملة',
//                'monthly_payment.required_if' => 'يجب ادخال قيمة دفعة المعاملة',
//                'date_of_first_payment.required_if' => 'يجب ادخال تاريخ دفعة أول دفعة',
            ]
        );

        DB::beginTransaction();
        try {

            // Store Data
            $customer_updated = Customer::whereId($customer->id)->update([
                'full_name'    => $request->full_name,
                'ID_NO'     => $request->ID_NO,
                'phone_NO'         => $request->phone_NO,
                'region' => $request->region,
                'address'       => $request->address,
                'status' => $request->status,
                'account' => $request->account
            ]);


            $transaction = Transaction::create([
                'transaction_NO' => Helper::IDGenerator(new Customer, 'transaction_NO', 4,5),
                'user_id' => auth()->user()->id,
                'customer_id'    => $customer->id,
            ]);

            Transaction::where('id',$transaction->id)->update([
                'transactions_type'     => $request->transactions_type,
                'transaction_amount'         => $request->transaction_amount,
                'first_payment' => $request->first_payment,
                'transaction_rest'       => $request->transaction_rest,
                'monthly_payment'       => $request->monthly_payment,
                'date_of_first_payment'       => $request->date_of_first_payment,
            ]);

            $customer_st = Customer::find($customer->id);
            if($customer_st->status == 'مقبول'){
                Customer::whereId($customer->id)->update([
                    'status' => 'قيد التوقيع',
                ]);
            }

            // Commit And Redirected To Listing
            DB::commit();
            return redirect()->route('customers.index')->with('success','تم تعديل العميل بنجاح!');

        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Customer $customer
     * @return RedirectResponse
     */
    public function delete(Customer $customer): RedirectResponse
    {
        DB::beginTransaction();
        try {
            // Delete User
            Customer::whereId($customer->id)->delete();

            DB::commit();
            return redirect()->route('customers.index')->with('success', 'تم حذف العميل بنجاح!');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function importCustomers()
    {
        return view('customers.import');
    }

    public function uploadCustomers(Request $request): RedirectResponse
    {
        $request->validate([
                'file'    => 'required',
            ]
            ,[
                'file.required' => 'يجب ادخال ملف اكسل',
            ]);

        Excel::import(new CustomerImport(), $request->file('file'));


        return redirect()->route('customers.index')->with('success', 'تم استيراد بيانات العملاء');
    }

    public function export(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return Excel::download(new CustomersExport(), 'customers.xlsx');
    }

    public function exportAdverser(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return Excel::download(new AdverserExport(), 'adverser.xlsx');
    }

    public function search(Request $request)
    {
        if ($request->filled('search')) {
            $customers = Customer::query();
            if ($request->filled('search')) {
                $customers = $customers->where('ID_NO', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('customer_NO', 'LIKE', '%' . $request->search . '%');
            }
            $customers = $customers->get();

        } else {
            return redirect()->back();
        }
        return view('customers.search', compact('customers'));
    }

}
