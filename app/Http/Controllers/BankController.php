<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class BankController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:بنوك-بيانات|بنوك-اضافة|بنوك-تعديل|بنوك-حذف', ['only' => ['index']]);
        $this->middleware('permission:بنوك-اضافة', ['only' => ['create','store']]);
        $this->middleware('permission:بنوك-تعديل', ['only' => ['edit','update']]);
        $this->middleware('permission:بنوك-حذف', ['only' => ['delete']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $banks = Bank::latest()->paginate(100);
        return view('banks.index', ['banks'=>$banks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('banks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
    // Validations
        $request->validate(
            [
                'name' => 'required',
            ],[
                'name.required' => 'يجب ادخال اسم البنك',
            ]
        );

        DB::beginTransaction();
        try {

            // Store Data
            $bank = Bank::create([
                'name'     => $request->name,
            ]);

            // Commit And Redirected To Listing
            DB::commit();
            return redirect()->route('banks.index')->with('success','تم انشاء البنك بنجاح');

        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Bank $bank
     * @return Response
     */
    public function show(Bank $bank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Bank $bank
     * @return Application|Factory|View|Response
     */
    public function edit(Bank $bank)
    {
        return view('banks.edit')->with([
            'bank'  => $bank,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Bank $bank
     * @return RedirectResponse
     */
    public function update(Request $request, Bank $bank)
    {
        // Validations
        $request->validate(
            [
                'name' => 'required',
            ],[
                'name.required' => 'يجب ادخال اسم البنك',
            ]
        );

        DB::beginTransaction();
        try {

            // Store Data

            $bank = Bank::whereId($bank->id)->update([
                'name'     => $request->name,
            ]);

            // Commit And Redirected To Listing
            DB::commit();
            return redirect()->route('banks.index')->with('success','تم تعديل البنك بنجاح!');

        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Bank $bank
     * @return RedirectResponse
     */
    public function delete(Bank $bank): RedirectResponse
    {
        DB::beginTransaction();
        try {
            // Delete
            Bank::whereId($bank->id)->delete();

            DB::commit();
            return redirect()->route('banks.index')->with('success', 'تم حذف البنك بنجاح');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
