<?php

namespace App\Http\Controllers;

use App\Models\Fund;
use App\Models\Payment;
use App\Models\Purchase;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FundController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:الصندوق-بيانات|الصندوق-اضافة', ['only' => ['index']]);
        $this->middleware('permission:الصندوق-اضافة', ['only' => ['create','store']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $fund = Fund::first();
        $payments = Payment::latest()->paginate(30);
        $purchases = Purchase::latest()->paginate(30);
        return view('funds.index',[
            'fund' => $fund,
            'payments' => $payments,
            'purchases' =>$purchases
        ]);
    }

    /** c
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $fund = Fund::first();
        return view('funds.create',['fund' => $fund]);
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
        $request->validate(
            [
                'financial'     => 'required|numeric',
            ],[
                'financial.required' => 'يجب ادخال مبلغ المضاف',
                'financial.numeric' => 'يجب ادخال مبلغ المضاف بالأرقام',
            ]
        );

        DB::beginTransaction();
        try {

            $fund = Fund::find($request->fund_id);

            // Store Data
            $fund->financial = $fund->financial + $request->financial;
            $fund->save();

            // Commit And Redirected To Listing
            DB::commit();
            return redirect()->route('funds.index')->with('success','تم اضافة المبلغ على الصندوق');

        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fund  $fund
     * @return \Illuminate\Http\Response
     */
    public function show(Fund $fund)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fund  $fund
     * @return \Illuminate\Http\Response
     */
    public function edit(Fund $fund)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fund  $fund
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fund $fund)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fund  $fund
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fund $fund)
    {
        //
    }
}
