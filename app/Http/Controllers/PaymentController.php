<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Customer;
use App\Models\CustomerIssue;
use App\Models\Issue;
use App\Models\Payment;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PaymentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:عملاء-دفعات', ['only' => ['create','store']]);
        $this->middleware('permission:عملاء-دفعات-حذف', ['only' => ['delete']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('payments.create');
    }

    public function createPayment(Customer $customer)
    {
        return view('payments.customer-create',['customer'=>$customer]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = $request->validate(
            [
                'ID_NO'     => 'required|numeric|digits:9',
                'payment_amount'  => 'required|numeric',
                'payment_type'  => 'required',
                'payment_via'  =>  'required',
                'currency_type'  =>  'required',

            ],[
                'ID_NO.required' => 'يجب ادخال رقم هوية العميل',
                'ID_NO.numeric' => 'يجب ادخال رقم الهوية بالأرقام',
                'ID_NO.digits' => 'رقم الهوية يتكون من 9 ارقام فقط',
                'payment_amount.required' => 'يجب ادخال قيمة الدفعة',
                'payment_amount.numeric' => 'يجب ادخال قيمة الدفعة بالأرقام',
                'payment_type.required' => 'يجب ادخال نوع الدفعة',
                'payment_via.required' => 'يجب ادخال طريق الدفعة',
                'currency_type.required' => 'يجب ادخال طريق الدفعة',

            ]
        );

        DB::beginTransaction();
        try {

            $customer_id = Customer::where('ID_NO', $request->ID_NO)->first();
            if($customer_id == null){
                return redirect()->back()->with('warning','رقم الهوية التي ادختلها غير مسجلة!');
            }
            // Store Data
            $payment = Payment::create([
                'payment_NO' => Helper::IDGenerator(new Payment(), 'payment_NO', 5,7),
                'user_id' => auth()->user()->id,
                'customer_id' => $customer_id->id,
                'payment_amount' => $request->payment_amount,
                'payment_type' => $request->payment_type,
                'notes' => $request->notes,
                'currency_type' => $request->currency_type,

            ]);

            if($payment->payment_NO == 700000){
                $payment->payment_NO = $payment->payment_NO + 1;
                $payment->save();
            }

            // Store Data
            $customer_id->update([
                'status' => 'ملتزم',
                'account'       => $customer_id->account - $request->payment_amount,
            ]);

            // Commit And Redirected To Listing
            DB::commit();
            return redirect()->route('home')->with('success','تم انشاء الدفعة بنجاح');

        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function get(Request $request)
    {

        $customer = Customer::where('ID_NO',$request->ID_NO)->first();
        if($customer == null){
            $customer = ['full_name' => '', 'phone_NO' => '' ];
        }
        return response()->json([
            'status' => 'success',
            'customer' => $customer,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return RedirectResponse
     */
    public function delete(Payment $payment)
    {
        DB::beginTransaction();
        try {
            // Delete User
            Payment::whereId($payment->id)->delete();

            DB::commit();
            return redirect()->back()->with('success', 'تم حذف الدفعة');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }    }
}
