<?php

namespace App\Http\Controllers;

use App\Exports\DraftExport;
use App\Helpers\Helper;
use App\Models\Customer;
use App\Models\CustomerDraft;
use App\Models\Draft;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class DraftController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:كمبيالات-بيانات|كمبيالات-اضافة|كمبيالات-تعديل|كمبيالات-حذف', ['only' => ['index']]);
        $this->middleware('permission:كمبيالات-اضافة', ['only' => ['create','store']]);
        $this->middleware('permission:كمبيالات-تعديل', ['only' => ['edit','update']]);
        $this->middleware('permission:كمبيالات-حذف', ['only' => ['delete']]);
        $this->middleware('permission:كمبيالات-تصدير', ['only' => ['export']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $drafts = Draft::orderBy('draft_NO','desc')->paginate(100);
        return view('drafts.index',['drafts' => $drafts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('drafts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        if($request->customer_id == null){
            return redirect()->back()->with('error','يجب ادخال عدد الأفراد قبل اتمام العملية. ');
        }


        foreach($request->customer_id as $key => $data)
        {
            if($request->customer_id[$key] == null){
                return redirect()->back()->with('error','يجب ادخال جميع أرقام الهوايا. ');
            }
        }

        foreach($request->customer_id as $key => $data)
        {
            $customer_id = Customer::where('ID_NO',$request->customer_id[$key])->get()->first();
            if($customer_id == null){
                return redirect()->back()->with('error','رقم الهوية الذي ادخلته غير موجود ' . $request->customer_id[$key]);
            }
        }



        // Validations
        $request->validate(
            [
                'document_type' => 'required',
                'customer_qty'  => 'required|numeric',
                'document_qty'  => 'required|numeric',
                'document_affiliate'  =>  'required|numeric',
                'customer_id.*'     => 'required_if:customer_qty,>,0|numeric|digits:9',
            ],[
                'document_type.required' => 'يجب ادخال نوع المستند',
                'customer_qty.required' => 'يجب ادخال عدد الأفراد',
                'customer_qty.numeric' => 'يجب ادخال عدد الأفراد بالأرقام',
                'document_qty.required' => 'يجب ادخال عدد المستندات',
                'document_qty.numeric' => 'يجب ادخال عدد المستندات بالأرقام',
                'document_affiliate.required' => 'يجب ادخال عدد المستندات التابعة',
                'document_affiliate.numeric' => 'يجب ادخال عدد المستندات التابعة بالأرقام',
                'customer_id.*.numeric' => 'يجب ادخال رقم الهوية بالأرقام',
            ]
        );

        DB::beginTransaction();
        try {

            // Store Data
            $draft = Draft::create([
                'draft_NO' => Helper::IDGenerator(new Draft(), 'draft_NO', 5,3),
                'user_id'    => auth()->user()->id,
                'document_type'     => $request->document_type,
                'customer_qty'         => $request->customer_qty,
                'document_qty' => $request->document_qty,
                'document_affiliate'       => $request->document_affiliate,
            ]);

            $id = $draft->id;

            foreach($request->customer_id as $key => $data)
            {

                $customer_id = Customer::where('ID_NO',$request->customer_id[$key])->get()->first();

                // Store Data
                $CustomerDraft = CustomerDraft::create([
                    'draft_id'     => $id,
                    'customer_id'         => $customer_id->id,
                ]);
            }

            if($draft->draft_NO == 300000){
                $draft->draft_NO = $draft->draft_NO + 1;
                $draft->save();
            }

            // Commit And Redirected To Listing
            DB::commit();
            return redirect()->route('drafts.index')->with('success','تم انشاء الكمبيالة بنجاح');

        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Draft  $draft
     * @return Response
     */
    public function show(Draft $draft)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Draft  $draft
     * @return Application|Factory|View|Response
     */
    public function edit(Draft $draft)
    {
        $ID_NO = $draft->cusotmerdrafts;
        $array = array();
        foreach ($ID_NO as $row){
            $array[] = $row->DraftCustomer->ID_NO;
        }

        return view('drafts.edit')->with([
            'draft'  => $draft,
            'array'  => $array,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Draft  $draft
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Draft $draft)
    {


        if($request->customer_id == null){
            return redirect()->back()->with('error','يجب ادخال عدد الأفراد قبل اتمام العملية. ');
        }


        foreach($request->customer_id as $key => $data)
        {
            if($request->customer_id[$key] == null){
                return redirect()->back()->with('error','يجب ادخال جميع أرقام الهوايا. ');
            }
        }

        foreach($request->customer_id as $key => $data)
        {
            $customer_id = Customer::where('ID_NO',$request->customer_id[$key])->get()->first();
            if($customer_id == null){
                return redirect()->back()->with('error','رقم الهوية الذي ادخلته غير موجود ' . $request->customer_id[$key]);
            }
        }

        // Validations
        $request->validate(
            [
                'document_type' => 'required',
                'customer_qty'  => 'required|numeric',
                'document_qty'  => 'required|numeric',
                'document_affiliate'  =>  'required|numeric',
                'customer_id.*'     => 'required_if:customer_qty,>,0|numeric|digits:9',
            ],[
                'document_type.required' => 'يجب ادخال نوع المستند',
                'customer_qty.required' => 'يجب ادخال عدد الأفراد',
                'customer_qty.numeric' => 'يجب ادخال عدد الأفراد بالأرقام',
                'document_qty.required' => 'يجب ادخال عدد المستندات',
                'document_qty.numeric' => 'يجب ادخال عدد المستندات بالأرقام',
                'document_affiliate.required' => 'يجب ادخال عدد المستندات التابعة',
                'document_affiliate.numeric' => 'يجب ادخال عدد المستندات التابعة بالأرقام',
                'customer_id.*.numeric' => 'يجب ادخال رقم الهوية بالأرقام',
            ]
        );

        DB::beginTransaction();
        try {

            // Store Data
            $draft = Draft::whereId($draft->id)->update([
                'user_id'    => auth()->user()->id,
                'document_type'     => $request->document_type,
                'customer_qty'         => $request->customer_qty,
                'document_qty' => $request->document_qty,
                'document_affiliate'       => $request->document_affiliate,
            ]);


            CustomerDraft::where('draft_id',$request->draft_id)->delete();

            foreach($request->customer_id as $key => $data)
            {

                $customer_id = Customer::where('ID_NO',$request->customer_id[$key])->get()->first();

                // Store Data
                $CustomerDraft = CustomerDraft::create([
                    'draft_id'     => $request->draft_id,
                    'customer_id'         => $customer_id->id,
                ]);
            }

            // Commit And Redirected To Listing
            DB::commit();
            return redirect()->route('drafts.index')->with('success','تم انشاء تعديل بنجاح');

        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Draft  $draft
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Draft $draft)
    {
        DB::beginTransaction();
        try {
            // Delete
            Draft::whereId($draft->id)->delete();

            DB::commit();
            return redirect()->route('drafts.index')->with('success', 'تم حذف كمبيالة');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function export()
    {
        return Excel::download(new DraftExport(), 'الكمبيالات.xlsx');
    }
}
