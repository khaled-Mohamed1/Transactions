<?php

namespace App\Http\Controllers;

use App\Models\CustomerJob;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CustomerJobController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:وظيفة-العميل-بيانات|وظيفة-العميل-اضافة|وظيفة-العميل-تعديل|وظيفة-العميل-حذف', ['only' => ['index']]);
        $this->middleware('permission:وظيفة-العميل-اضافة', ['only' => ['create','store']]);
        $this->middleware('permission:وظيفة-العميل-تعديل', ['only' => ['edit','update']]);
        $this->middleware('permission:وظيفة-العميل-حذف', ['only' => ['delete']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $jobs = CustomerJob::latest()->paginate(100);
        return view('jobs.index', ['jobs'=>$jobs]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('jobs.create');
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
            ],
            [
                'name.required' => 'يجب ادخال اسم الوظيفة',
            ]
        );

        DB::beginTransaction();
        try {

            // Store Data
            $job = CustomerJob::create([
                'name'     => $request->name,
            ]);

            // Commit And Redirected To Listing
            DB::commit();
            return redirect()->route('jobs.index')->with('success','تم انشاء الوظيفة بنجاح');

        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param CustomerJob $CustomerJob
     * @return Response
     */
    public function show(CustomerJob $CustomerJob)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param CustomerJob $CustomerJob
     * @return Application|Factory|View
     */
    public function edit(CustomerJob $CustomerJob)
    {
        return view('jobs.edit')->with([
            'job'  => $CustomerJob,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param CustomerJob $CustomerJob
     * @return RedirectResponse
     */
    public function update(Request $request, CustomerJob $CustomerJob)
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

            $job = CustomerJob::whereId($CustomerJob->id)->update([
                'name'     => $request->name,
            ]);

            // Commit And Redirected To Listing
            DB::commit();
            return redirect()->route('jobs.index')->with('success','تم تعديل البنك بنجاح!');

        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CustomerJob $CustomerJob
     * @return RedirectResponse
     */
    public function delete(CustomerJob $CustomerJob)
    {
        DB::beginTransaction();
        try {
            // Delete
            CustomerJob::whereId($CustomerJob->id)->delete();

            DB::commit();
            return redirect()->route('jobs.index')->with('success', 'تم حذف البنك بنجاح');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
