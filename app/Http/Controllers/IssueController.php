<?php

namespace App\Http\Controllers;

use App\Exports\IssueExport;
use App\Helpers\Helper;
use App\Models\Agent;
use App\Models\Customer;
use App\Models\CustomerIssue;
use App\Models\Issue;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpWord\TemplateProcessor;


class IssueController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:قضايا-بيانات|قضايا-اضافة|قضايا-تعديل|قضايا-حذف', ['only' => ['index']]);
        $this->middleware('permission:قضايا-اضافة', ['only' => ['create','store']]);
        $this->middleware('permission:قضايا-تعديل', ['only' => ['edit','update']]);
        $this->middleware('permission:قضايا-حذف', ['only' => ['delete']]);
        $this->middleware('permission:قضايا-تصدير', ['only' => ['export']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $issues = Issue::orderBy('issue_NO','desc')->paginate(100);

        return view('issues.index',['issues' => $issues]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $agents = Agent::get();
        return view('issues.create',['agents'=>$agents]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {

        if($request->customer_id == null){
            return redirect()->back()->with('error','يجب ادخال عدد الأطراف قبل اتمام العملية. ');
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

//        // Validations
        $validator = $request->validate(
            [
                'court_name' => 'required',
                'customer_qty'  => 'required|numeric',
                'case_number'  => 'required',
                'case_amount'  =>  'required|numeric',
                'execution_request' => 'required',
                'customer_id.*'     => 'required_if:customer_qty,>,0|numeric|digits:9',

            ],[
                'court_name.required' => 'يجب ادخال اسم المحكمة',
                'customer_qty.required' => 'يجب ادخال عدد الأفراد',
                'customer_qty.numeric' => 'يجب ادخال عدد الأفراد بالأرقام',
                'case_number.required' => 'يجب ادخال رقم القضية',
                'case_amount.required' => 'يجب ادخال مبلغ القضية',
                'case_amount.numeric' => 'يجب ادخال مبلغ القضية بالأرقام',
                'execution_request.required' => 'يجب ادخال اسم طالب التنفيذ',
                'customer_id.*.numeric' => 'يجب ادخال رقم الهوية بالأرقام',

            ]
        );

        DB::beginTransaction();
        try {

            // Store Data
            $issue = Issue::create([
                'issue_NO' => Helper::IDGenerator(new Issue(), 'issue_NO', 5,2),
                'user_id'    => auth()->user()->id,
                'court_name'     => $request->court_name,
                'customer_qty'         => $request->customer_qty,
                'case_number' => $request->case_number,
                'case_amount'       => $request->case_amount,
                'execution_request'       => $request->execution_request,
                'execution_agent_name'       => $request->execution_agent_name,
                'execution_agent_against_it'       => $request->execution_agent_against_it,
                'notes'       => $request->notes,
            ]);

            $id = $issue->id;

            foreach($request->customer_id as $key => $data)
            {

                $customer_id = Customer::where('ID_NO',$request->customer_id[$key])->get()->first();

                // Store Data
                $CustomerDraft = CustomerIssue::create([
                    'issue_id'     => $id,
                    'customer_id'         => $customer_id->id,
                ]);
            }

            if($issue->issue_NO == 200000){
                $issue->issue_NO = $issue->issue_NO + 1;
                $issue->save();
            }

            // Commit And Redirected To Listing
            DB::commit();
            return redirect()->route('issues.index')->with('success','تم انشاء القضية بنجاح');

        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function show(Issue $issue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function edit(Issue $issue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  \App\Models\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Issue $issue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Issue  $issue
     * @return RedirectResponse
     */
    public function delete(Issue $issue)
    {
        DB::beginTransaction();
        try {
            // Delete
            Issue::whereId($issue->id)->delete();

            DB::commit();
            return redirect()->route('issues.index')->with('success', 'تم حذف القضية');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function export()
    {
        return Excel::download(new IssueExport(), 'قضايا.xlsx');
    }


    public function exportWORD(Request $request,Issue $issue){

        $data = Issue::where('id',$issue->id)->first();
        $templateProcessor = new TemplateProcessor('wordOffice/issue.docx');
        $templateProcessor->setValue('court_name',$data->court_name);
        $templateProcessor->setValue('case_number',$data->case_number);
        $templateProcessor->setValue('execution_request_name',$data->execution_request_idIssue->agent_name ?? null);
        $templateProcessor->setValue('execution_request_address',$data->execution_request_idIssue->address ?? null);
        $templateProcessor->setValue('execution_request_ID_NO',$data->execution_request_idIssue->ID_NO ?? null);
        $templateProcessor->setValue('execution_agent_against_it_name',$data->execution_agent_name_idIssue->agent_name ?? null);
        $templateProcessor->setValue('execution_agent_against_it_address',$data->execution_agent_against_it_idIssue->address ?? null);
        $templateProcessor->setValue('execution_agent_against_it_ID_NO',$data->execution_agent_against_it_idIssue->ID_NO ?? null);
        $templateProcessor->setValue('case_amount',$data->case_amount);
        $templateProcessor->setValue('created_at',$data->created_at);


//        $templateProcessor->cloneRowAndSetValues('payment_NO', $payments);
        $fileName = $data->issue_NO;
        $templateProcessor->saveAs($fileName.'.docx');
        return response()->download($fileName.'.docx')->deleteFileAfterSend(true);
    }

}
