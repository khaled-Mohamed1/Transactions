<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Store;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:مخازن-بيانات|مخازن-اضافة|مخازن-تعديل|مخازن-حذف', ['only' => ['index']]);
        $this->middleware('permission:مخازن-اضافة', ['only' => ['create','store']]);
        $this->middleware('permission:مخازن-تعديل', ['only' => ['edit','update']]);
        $this->middleware('permission:مخازن-حذف', ['only' => ['delete']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $stores = Store::latest()->paginate(100);
        return view('stores.index', ['stores'=>$stores]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('stores.create');
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
                'product_name' => 'required',
                'product_qty'     => 'required|numeric',
                'product_price'  => 'required',

            ],[
                'product_name.required' => 'يجب ادخال اسم المنتج',
                'product_qty.required' => 'يجب ادخال كمية المنتج',
                'product_qty.numeric' => 'يجب ادخال كمية المنتج بالأرقام',
                'product_price.required' => 'يجب ادخال سعر المنتج بالجملة',
                'product_price.numeric' => 'يجب ادخال سعر المنتج بالأرقام',

            ]
        );

        DB::beginTransaction();
        try {

            // Store Data
            $prodcut = Store::create([
                'user_id'     => auth()->user()->id,
                'product_name'         => $request->product_name,
                'product_qty'         => $request->product_qty,
                'product_price'         => $request->product_price,
            ]);

            // Commit And Redirected To Listing
            DB::commit();
            return redirect()->route('stores.index')->with('success','تم انشاء المنتج بنجاح');

        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return Application|Factory|View
     */
    public function edit(Store $store)
    {
        return view('stores.edit')->with([
            'store'  => $store
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Store $store)
    {
        $request->validate(
            [
                'product_name' => 'required',
                'product_qty'     => 'required|numeric',
                'product_price'  => 'required',

            ],[
                'product_name.required' => 'يجب ادخال اسم المنتج',
                'product_qty.required' => 'يجب ادخال كمية المنتج',
                'product_qty.numeric' => 'يجب ادخال كمية المنتج بالأرقام',
                'product_price.required' => 'يجب ادخال سعر المنتج بالجملة',
                'product_price.numeric' => 'يجب ادخال سعر المنتج بالأرقام',

            ]
        );

        DB::beginTransaction();
        try {

            // Store Data

            $product_update = Store::whereId($store->id)->update([
                'product_name'         => $request->product_name,
                'product_qty'         => $request->product_qty,
                'product_price'         => $request->product_price,
            ]);

            // Commit And Redirected To Listing
            DB::commit();
            return redirect()->route('stores.index')->with('success','تم تعديل المنتج بنجاح!');

        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Store $store)
    {
        DB::beginTransaction();
        try {
            // Delete
            Store::whereId($store->id)->delete();

            DB::commit();
            return redirect()->route('stores.index')->with('success', 'تم حذف المنتج');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
