<?php

namespace App\Http\Controllers;

use App\Exports\AdverserExport;
use App\Exports\AllCustomersExport;
use App\Exports\CustomersExport;
use App\Helpers\Helper;
use App\Imports\CustomerImport;
use App\Models\Customer;
use App\Models\CustomerDraft;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use ArPHP\I18N\Arabic;


class CustomerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:عملاء-بيانات|عملاء-اضافة|عملاء-تعديل|عملاء-حذف|عملاء-ملف-شخصي|عملاء-استراد', ['only' => ['index']]);
        $this->middleware('permission:عملاء-اضافة', ['only' => ['create','store']]);
        $this->middleware('permission:عملاء-تعديل', ['only' => ['edit','update']]);
        $this->middleware('permission:عملاء-حذف', ['only' => ['delete']]);
        $this->middleware('permission:عملاء-ملف-شخصي', ['only' => ['show']]);
        $this->middleware('permission:عملاء-المتعسرين', ['only' => ['indexAdverser']]);
        $this->middleware('permission:عملاء-المرفوضين', ['only' => ['indexRejected']]);
        $this->middleware('permission:عملاء-الجميع', ['only' => ['indexCustomers']]);
        $this->middleware('permission:عملاء-المهام', ['only' => ['indexTask','addTask']]);
        $this->middleware('permission:عملاء-استراد', ['only' => ['importCustomers','uploadCustomers']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */


    public function index()
    {
        $customers = Customer::orderBy('customer_NO','desc')->where('status','جديد')->paginate(100);
        return view('customers.index', ['customers' => $customers]);
    }

    public function indexCustomers()
    {
        $customers = Customer::orderBy('customer_NO','desc')->paginate(100);
        return view('customers.customers', ['customers' => $customers]);
    }

    public function indexAdverser()
    {
        $customers = Customer::orderBy('customer_NO','desc')->where('status','=','متعسر')->paginate(100);
        return view('customers.index_adverser', ['customers' => $customers]);
    }

    public function indexRejected()
    {
        $customers = Customer::orderBy('customer_NO','desc')->where('status','=','مرفوض')->paginate(100);
        return view('customers.rejected', ['customers' => $customers]);
    }

    public function indexTask()
    {
        $users = User::where('role_id','!=','1')->where('role_id','!=','3')->latest()->get();
        $customers = Customer::orderBy('customer_NO','desc')->whereNull('updated_by')->where(function ($query){
            $query->where('status','=','متعسر')->orWhere('status','=','قيد التوقيع')
            ->orWhere('status','=','مقبول');
        })->paginate(100);
        return view('customers.tasks', ['customers' => $customers,'users'=>$users]);
    }


    public function addTask(Request $request)
    {

        if($request->user_id === 'false'){
            $customer = Customer::findOrFail($request->customer_id)->update([
                'updated_by' => NULL,
            ]);
        }else{
            $customer = Customer::findOrFail($request->customer_id)->update([
                'updated_by' => $request->user_id,
            ]);        }

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
                'phone_NO' => 'required|numeric|digits:10',
                'region'       =>  'required',
                'address'       =>  'required',
            ],[
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
                'notes'       => $request->notes,
                'created_by' => auth()->user()->id
            ]);

            if($customer->customer_NO == 400000){
                $customer->customer_NO = $customer->customer_NO + 1;
                $customer->save();
            }

            // Commit And Redirected To Listing
            DB::commit();
            return redirect()->route('home')->with('success','تم انشاء العميل بنجاح');

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
        $users = User::where('role_id','!=','1')->where('role_id','!=','3')->latest()->get();
        $drafts = CustomerDraft::with('DraftCustomerDraft')->where('customer_id',$customer->id)->get();
        $issues = CustomerDraft::with('IssueCustomerIssue')->where('customer_id',$customer->id)->get();
        return view('customers.show')->with([
            'customer'  => $customer,
            'drafts' => $drafts,
            'issues' => $issues,
            'users' => $users
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
                'phone_NO' => 'required|numeric|digits:10',
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
            if($request->status == 'مقبول' || $request->status == 'قيد التوقيع'){
                $status = 'قيد التوقيع';
            }

            $customer_updated = Customer::whereId($customer->id)->update([
                'full_name'    => $request->full_name,
                'ID_NO'     => $request->ID_NO,
                'phone_NO'         => $request->phone_NO,
                'region' => $request->region,
                'address'       => $request->address,
                'status' => $status ?? $request->status,
                'account' => $request->account,
                'notes' => $request->notes,
            ]);


//            $transaction = Transaction::create([
//                'transaction_NO' => Helper::IDGenerator(new Transaction(), 'transaction_NO', 5,5),
//                'user_id' => auth()->user()->id,
//                'customer_id'    => $customer->id,
//            ]);
//
//            $test = 1;
//
//            Transaction::where('id',$transaction->id)->update([
//                'transactions_type'     => $request->transactions_type,
//                'transaction_amount'         => $request->transaction_amount,
//                'first_payment' => $request->first_payment,
//                'transaction_rest'       => $request->transaction_rest,
//                'monthly_payment'       => $request->monthly_payment,
//                'date_of_first_payment'       => $request->date_of_first_payment,
//            ]);

//            $customer_st = Customer::find($customer->id);
//            if($customer_st->status == 'مقبول'){
//                Customer::whereId($customer->id)->update([
//                    'status' => 'قيد التوقيع',
//                ]);
//            }

            // Commit And Redirected To Listing
            DB::commit();
            return redirect()->route('customers.show',['customer' => $customer->id])->with('success','تم تعديل العميل بنجاح!');

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
        return Excel::download(new CustomersExport(), 'العملاء المقبولين.xlsx');
    }

    public function exportAdverser(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return Excel::download(new AdverserExport(), 'المتعسرين.xlsx');
    }

    public function exportCustomers(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return Excel::download(new AllCustomersExport(), 'جميع العملاء.xlsx');
    }

    public function search(Request $request)
    {
        if ($request->filled('search')) {
            $customers = Customer::query();
            if ($request->filled('search')) {
                $customers = $customers->where('ID_NO', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('customer_NO', 'LIKE', '%' . $request->search . '%')
                ->orWhere('full_name', 'LIKE', '%' . $request->search . '%');
            }
            $customers = $customers->get();

        } else {
            return redirect()->back();
        }
        return view('customers.search', compact('customers'));
    }

//    public function exportPDF(Request $request){
//
//        $data = Customer::findOrFail($request->customer_id);
//        $reportHtml = view('pdf.customerProfile' ,['data'=>$data])->render();
//
//        $arabic = new Arabic();
//        $p = $arabic->arIdentify($reportHtml);
//
//        for ($i = count($p)-1; $i >= 0; $i-=2) {
//            $utf8ar = $arabic->utf8Glyphs(substr($reportHtml, $p[$i-1], $p[$i] - $p[$i-1]));
//            $reportHtml = substr_replace($reportHtml, $utf8ar, $p[$i-1], $p[$i] - $p[$i-1]);
//        }
//
//            $pdf = PDF::loadHTML($reportHtml)->setPaper('a4','portrait');
//
//
//        return $pdf->download('ملف شخصي.pdf');
//    }


}
