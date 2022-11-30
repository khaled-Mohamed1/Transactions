<?php

namespace App\Http\Controllers;

use App\Exports\IssueExport;
use App\Helpers\Helper;
use App\Models\Agent;
use App\Models\AgentBank;
use App\Models\Customer;
use App\Models\CustomerIssue;
use App\Models\Draft;
use App\Models\Issue;
use Carbon\Carbon;
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
        $this->middleware('permission:قضايا-اضافة', ['only' => ['create','store','createIssue']]);
        $this->middleware('permission:قضايا-تعديل', ['only' => ['edit','update']]);
        $this->middleware('permission:قضايا-حذف', ['only' => ['delete']]);
        $this->middleware('permission:قضايا-تصدير', ['only' => ['export']]);
        $this->middleware('permission:قضايا-جميع', ['only' => ['allIndex']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        if(auth()->user()->role_id == 1 || auth()->user()->role_id == 3){
            $drafts = Draft::orderBy('draft_NO','desc')->whereNotNull('updated_by')->paginate(100);
        }else{
            $drafts = Draft::orderBy('draft_NO','desc')->where('updated_by', auth()->user()->id)->paginate(100);

        }

        return view('issues.index',['drafts' => $drafts]);
    }

    public function allIndex(){
        if(auth()->user()->role_id == 1 || auth()->user()->role_id == 3){
            $issues = Issue::orderBy('issue_NO','desc')->paginate(100);
            $issuesAll = Issue::get();
        }else{
            $issues = Issue::orderBy('issue_NO','desc')->where('user_id', auth()->user()->id)->paginate(100);
            $issuesAll = Issue::get();
        }

        return view('issues.allIssues', ['issues' => $issues,'issuesAll'=>$issuesAll]);

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

    public function createIssue(Draft $draft)
    {
        $agents = Agent::get();
        return view('issues.create-issue',['agents'=>$agents,'draft'=>$draft]);
    }

    public function createIssueCustomer(Customer $customer)
    {
        $agents = Agent::get();
        return view('issues.create-issue-customer',['agents'=>$agents,'customer'=>$customer]);
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
//                'case_number'  => 'required',
                'case_amount'  =>  'required|numeric',
                'execution_request' => 'required',
                'currency_type' => 'required',
                'bond_type' => 'required',
                'customer_id.*'     => 'required_if:customer_qty,>,0|numeric|digits:9',

            ],[
                'court_name.required' => 'يجب ادخال اسم المحكمة',
                'customer_qty.required' => 'يجب ادخال عدد الأفراد',
                'customer_qty.numeric' => 'يجب ادخال عدد الأفراد بالأرقام',
//                'case_number.required' => 'يجب ادخال رقم القضية',
//                'case_amount.required' => 'يجب ادخال مبلغ القضية',
                'case_amount.numeric' => 'يجب ادخال مبلغ القضية بالأرقام',
                'currency_type.required' => 'يجب ادخال نوع العملة',
                'bond_type.required' => 'يجب ادخال نوع السند',
                'customer_id.*.numeric' => 'يجب ادخال رقم الهوية بالأرقام',

            ]
        );

        DB::beginTransaction();
        try {

            // Store Data
            $issue = Issue::create([
                'issue_NO' => Helper::IDGenerator(new Issue(), 'issue_NO', 5,2),
                'user_id'    => auth()->user()->id,
                'draft_id'    => $request->draft_id ?? null,
                'court_name'     => $request->court_name,
                'customer_qty'         => $request->customer_qty,
                'case_number' => $request->case_number,
                'case_amount'       => $request->case_amount,
                'execution_request_id'       => $request->execution_request,
                'execution_agent_name_id'       => $request->execution_agent_name,
                'execution_agent_against_it_id'       => $request->execution_agent_against_it,
                'currency_type' => $request->currency_type,
                'bond_type' => $request->bond_type,
                'notes'       => $request->notes,
            ]);

            if($request->draft_id != null){
                $draft = Draft::findOrFail($request->draft_id)->update(['updated_by' => null]);

            }




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
     * @return Application|Factory|View
     */
    public function show(Issue $issue)
    {
        return view('issues.show')->with([
            'issue'  => $issue,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Issue  $issue
     * @return Application|Factory|View|\Illuminate\Http\Response
     */
    public function edit(Issue $issue)
    {
        $agents = Agent::get();
        $ID_NO = $issue->customerIssues;
        $array = array();
        foreach ($ID_NO as $row){
            $array[] = $row->IssueCustomer->ID_NO;
        }

        return view('issues.edit')->with([
            'issue'  => $issue,
            'array'  => $array,
            'agents'  => $agents,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  \App\Models\Issue  $issue
     * @return RedirectResponse
     */
    public function update(Request $request, Issue $issue)
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
//                'case_number'  => 'required',
                'case_amount'  =>  'required|numeric',
                'execution_request' => 'required',
                'currency_type' => 'required',
                'bond_type' => 'required',
                'customer_id.*'     => 'required_if:customer_qty,>,0|numeric|digits:9',

            ],[
                'court_name.required' => 'يجب ادخال اسم المحكمة',
                'customer_qty.required' => 'يجب ادخال عدد الأفراد',
                'customer_qty.numeric' => 'يجب ادخال عدد الأفراد بالأرقام',
//                'case_number.required' => 'يجب ادخال رقم القضية',
//                'case_amount.required' => 'يجب ادخال مبلغ القضية',
                'case_amount.numeric' => 'يجب ادخال مبلغ القضية بالأرقام',
                'execution_request.required' => 'يجب ادخال اسم طالب التنفيذ',
                'currency_type.required' => 'يجب ادخال نوع العملة',
                'bond_type.required' => 'يجب ادخال نوع السند',
                'customer_id.*.numeric' => 'يجب ادخال رقم الهوية بالأرقام',

            ]
        );

        DB::beginTransaction();
        try {

            // Store Data
            $issue = Issue::whereId($issue->id)->update([
                'user_id'    => auth()->user()->id,
                'court_name'     => $request->court_name,
                'customer_qty'         => $request->customer_qty,
                'case_number' => $request->case_number,
                'case_amount'       => $request->case_amount,
                'execution_request_id'       => $request->execution_request,
                'execution_agent_name_id'       => $request->execution_agent_name,
                'execution_agent_against_it_id'       => $request->execution_agent_against_it,
                'currency_type' => $request->currency_type,
                'bond_type' => $request->bond_type,
                'notes'       => $request->notes,
            ]);

            CustomerIssue::where('issue_id',$request->issue_id)->delete();

            foreach($request->customer_id as $key => $data)
            {

                $customer_id = Customer::where('ID_NO',$request->customer_id[$key])->get()->first();

                // Store Data
                $CustomerDraft = CustomerIssue::create([
                    'issue_id'     => $request->issue_id,
                    'customer_id'         => $customer_id->id,
                ]);
            }


            // Commit And Redirected To Listing
            DB::commit();
            return redirect()->route('issues.show',['issue' => $issue->id])->with('success','تم تعديل القضية بنجاح');

        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
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

        $customers = $data->customerIssues;
        $array_issue = array();
        foreach ($customers as $row){
            $array_issue[] = $row->IssueCustomer->toArray();
        }

        $templateProcessor = new TemplateProcessor('wordOffice/issue.docx');
        $templateProcessor->setValue('court_name',$data->court_name);
        $templateProcessor->setValue('case_number',$data->case_number);
        $templateProcessor->setValue('execution_request_name',$data->execution_request_idIssue->agent_name ?? null);
        $templateProcessor->setValue('execution_request_address',$data->execution_request_idIssue->address ?? null);
        $templateProcessor->setValue('execution_request_ID_NO',$data->execution_request_idIssue->ID_NO ?? null);
        $templateProcessor->setValue('execution_agent_name',$data->execution_agent_name_idIssue->agent_name ?? null);
        $templateProcessor->setValue('execution_agent_against_it_name',$data->execution_agent_name_idIssue->agent_name ?? null);
        $templateProcessor->setValue('execution_agent_against_it_address',$data->execution_agent_against_it_idIssue->address ?? null);
        $templateProcessor->setValue('execution_agent_against_it_ID_NO',$data->execution_agent_against_it_idIssue->ID_NO ?? null);
        $templateProcessor->setValue('case_amount',$data->case_amount);
        $templateProcessor->setValue('created_at',$data->created_at);


        $templateProcessor->cloneRowAndSetValues('ID_NO', $array_issue);

        $fileName = $data->issue_NO;
        $templateProcessor->saveAs($fileName.'.docx');
        return response()->download($fileName.'.docx')->deleteFileAfterSend(true);
    }

    public function exportWORDRatify(Request $request,Issue $issue)
    {
        $issue = Issue::where('id',$issue->id)->first();
        $bank = AgentBank::where('id',$request->bank_id)->first();
        $customer = Customer::where('id',$request->customer_id)->first();



        if($request->payment_type == 'استقطاع'){
            $templateProcessor = new TemplateProcessor('wordOffice/ratifyAll.docx');
            $templateProcessor->setValue('court_name',$issue->court_name);
            $templateProcessor->setValue('case_number',$issue->case_number);
            $templateProcessor->setValue('case_amount',$issue->case_amount);
            $templateProcessor->setValue('issue_currency',$issue->currency_type);
            $templateProcessor->setValue('execution_request_name',$issue->execution_request_idIssue->agent_name ?? null);
            $templateProcessor->setValue('execution_request_address',$issue->execution_request_idIssue->address ?? null);
            $templateProcessor->setValue('execution_request_ID_NO',$issue->execution_request_idIssue->ID_NO ?? null);
            $templateProcessor->setValue('execution_agent_name',$data->execution_agent_name_idIssue->agent_name ?? null);
            $templateProcessor->setValue('execution_agent_against_it_name',$data->execution_agent_name_idIssue->agent_name ?? null);
            $templateProcessor->setValue('bank_name',$bank->bank_name);
            $templateProcessor->setValue('bank_branch',$bank->bank_branch);
            $templateProcessor->setValue('bank_account_NO',$bank->bank_account_NO);
            $templateProcessor->setValue('created_at',Carbon::now()->format('Y/m/d'));
            $templateProcessor->setValue('customer_name',$customer->full_name);
            $templateProcessor->setValue('customer_ID_NO',$customer->ID_NO);
            $templateProcessor->setValue('withholding_amount',$request->withholding_amount);
            $templateProcessor->setValue('currency_type',$request->currency_type);
            if ($request->by == 'بنك'){
                $bank_name = $customer->bank_name;
                $bank_branch = $customer->bank_branch;
                $by = $bank_name . ' - ' . $bank_branch;
            }else{
                $by = $request->by;
            }
            $templateProcessor->setValue('by',$by);

            $fileName = $issue->issue_NO;
            $templateProcessor->saveAs($fileName.' تصديق.docx');
            return response()->download($fileName.' تصديق.docx')->deleteFileAfterSend(true);
        }else{
            $templateProcessor = new TemplateProcessor('wordOffice/ratifyHalf.docx');
            $templateProcessor->setValue('court_name',$issue->court_name);
            $templateProcessor->setValue('case_number',$issue->case_number);
            $templateProcessor->setValue('case_amount',$issue->case_amount);
            $templateProcessor->setValue('issue_currency',$issue->currency_type);
            $templateProcessor->setValue('execution_request_name',$issue->execution_request_idIssue->agent_name ?? null);
            $templateProcessor->setValue('execution_request_address',$issue->execution_request_idIssue->address ?? null);
            $templateProcessor->setValue('execution_request_ID_NO',$issue->execution_request_idIssue->ID_NO ?? null);
            $templateProcessor->setValue('execution_agent_name',$data->execution_agent_name_idIssue->agent_name ?? null);
            $templateProcessor->setValue('execution_agent_against_it_name',$data->execution_agent_name_idIssue->agent_name ?? null);
            $templateProcessor->setValue('bank_name',$bank->bank_name);
            $templateProcessor->setValue('bank_branch',$bank->bank_branch);
            $templateProcessor->setValue('bank_account_NO',$bank->bank_account_NO);
            $templateProcessor->setValue('created_at',Carbon::now()->format('Y/m/d'));
            $templateProcessor->setValue('customer_name',$customer->full_name);
            $templateProcessor->setValue('customer_ID_NO',$customer->ID_NO);
//            $templateProcessor->setValue('customer_bank',$customer->bank_name);
//            $templateProcessor->setValue('customer_branch',$customer->bank_branch);
            $templateProcessor->setValue('payment_type',$request->payment_type);

            if ($request->by == 'بنك'){
                $bank_name = $customer->bank_name;
                $bank_branch = $customer->bank_branch;
                $by = $bank_name . ' - ' . $bank_branch;
            }else{
                $by = $request->by;
            }

            $templateProcessor->setValue('by',$by);

            $fileName = $issue->issue_NO;
            $templateProcessor->saveAs($fileName.' تصديق.docx');
            return response()->download($fileName.' تصديق.docx')->deleteFileAfterSend(true);
        }




    }
}
