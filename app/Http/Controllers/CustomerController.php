<?php

namespace App\Http\Controllers;

use App\Exports\AdverserExport;
use App\Exports\CustomersExport;
use App\Exports\UsersExport;
use App\Helpers\Helper;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;

class CustomerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:customer-list|customer-create|customer-edit|customer-delete|customer-show', ['only' => ['index']]);
        $this->middleware('permission:customer-create', ['only' => ['create','store']]);
        $this->middleware('permission:customer-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:customer-delete', ['only' => ['delete']]);
        $this->middleware('permission:customer-show', ['only' => ['show']]);
        $this->middleware('permission:customer-adverser', ['only' => ['indexAdverser']]);
        $this->middleware('permission:customer-task', ['only' => ['indexTask','addTask']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */


    public function index()
    {
        $customers = Customer::latest()->paginate(100);
        return view('customers.index', ['customers' => $customers]);
    }

    public function indexAdverser()
    {
        $customers = Customer::where('status','متعسر')->latest()->paginate(10);
        return view('customers.index_adverser', ['customers' => $customers]);
    }

    public function indexTask()
    {
        $users = User::where('role_id','2')->latest()->get();
        $customers = Customer::where('status','متعسر')->orWhere('status','مقبول')->latest()->paginate(100);
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
     * @return \Illuminate\Http\RedirectResponse
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
        ]
            ,[
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
            ]);

        DB::beginTransaction();
        try {

            // Store Data
            $customer = Customer::create([
                'customer_NO' => Helper::IDGenerator(new Customer, 'customer_NO', 4,4),
                'full_name'    => $request->full_name,
                'ID_NO'     => $request->ID_NO,
                'phone_NO'         => $request->phone_NO,
                'region' => $request->region,
                'address'       => $request->address,
                'created_by' => auth()->user()->id
            ]);

            // Commit And Redirected To Listing
            DB::commit();
            return redirect()->route('customers.index')->with('success','Customer Created Successfully.');

        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
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
     * @param  \App\Models\Customer  $customer
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
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Customer $customer)
    {

        // Validations
        $request->validate([
            'full_name'    => 'required',
            'ID_NO'     => 'required|numeric|digits:9|'.Rule::unique('customers')->ignore($customer->id),
            'phone_NO' => 'required|numeric|digits:10|'.Rule::unique('customers')->ignore($customer->id),
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
            $customer_updated = Customer::whereId($customer->id)->update([
                'full_name'    => $request->full_name,
                'ID_NO'     => $request->ID_NO,
                'phone_NO'         => $request->phone_NO,
                'region' => $request->region,
                'address'       => $request->address,
                'status' => $request->status,
                'account' => $request->account
            ]);


            // Commit And Redirected To Listing
            DB::commit();
            return redirect()->route('customers.index')->with('success','Customer Updated Successfully.');

        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Customer $customer)
    {
        DB::beginTransaction();
        try {
            // Delete User
            Customer::whereId($customer->id)->delete();

            DB::commit();
            return redirect()->route('customers.index')->with('success', 'Customer Deleted Successfully!.');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function export()
    {
        return Excel::download(new CustomersExport(), 'customers.xlsx');
    }

    public function exportAdverser()
    {
        return Excel::download(new AdverserExport(), 'adverser.xlsx');
    }

}
