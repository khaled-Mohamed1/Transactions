<?php

namespace App\Http\Controllers;

use App\Exports\IssueExport;
use App\Helpers\Helper;
use App\Imports\ImportDraft;
use App\Imports\IssueImport;
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
            $customer_issues = Customer::orderBy('customer_NO','desc')->whereNotNull('updated_issue_by')->paginate(100);
            $drafts = Draft::orderBy('draft_NO','desc')->whereNotNull('updated_by')->paginate(100);
        }else{
            $customer_issues = Customer::orderBy('customer_NO','desc')->where('updated_issue_by', auth()->user()->id)->paginate(100);
            $drafts = Draft::orderBy('draft_NO','desc')->where('updated_by', auth()->user()->id)->paginate(100);

        }

        return view('issues.index',[
            'drafts' => $drafts,
            'customer_issues' => $customer_issues
        ]);
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

//        // Validations
        $validator = $request->validate(
            [
                'court_name' => 'required',
                'customer_qty'  => 'required|numeric',
                'case_amount'  =>  'required|numeric',
                'execution_request' => 'required',
                'currency_type' => 'required',
                'bond_type' => 'required',
                'customer_id.*'     => 'required_if:customer_qty,>,0|numeric|digits:9',

            ],[
                'court_name.required' => 'يجب ادخال اسم المحكمة',
                'customer_qty.required' => 'يجب ادخال عدد الأفراد',
                'customer_qty.numeric' => 'يجب ادخال عدد الأفراد بالأرقام',
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
                'draft_id'    => $request->draft_id,
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
                $draft = Draft::findOrFail($request->draft_id);
                $draft->update([
                    'updated_by' => null,
                    'document_qty' => $draft->document_qty - 1,
                    'document_affiliate' => $draft->document_affiliate - 1
                ]);

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

    public function storeCustomer(Request $request)
    {

//        // Validations
        $validator = $request->validate(
            [
                'court_name' => 'required',
                'customer_qty'  => 'required|numeric',
                'case_amount'  =>  'required|numeric',
                'execution_request' => 'required',
                'currency_type' => 'required',
                'bond_type' => 'required',
                'customer_id.*'     => 'required_if:customer_qty,>,0|numeric|digits:9',

            ],[
                'court_name.required' => 'يجب ادخال اسم المحكمة',
                'customer_qty.required' => 'يجب ادخال عدد الأفراد',
                'customer_qty.numeric' => 'يجب ادخال عدد الأفراد بالأرقام',
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
                'draft_id'    => $request->draft_id,
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
                $draft = Draft::findOrFail($request->draft_id);
                $draft->update([
                    'updated_by' => null,
                    'document_qty' => $draft->document_qty - 1,
                    'document_affiliate' => $draft->document_affiliate - 1
                ]);

            }

            $id = $issue->id;


            $customer_id = Customer::where('ID_NO',$request->customer_id)->get()->first();
            $customer_id->updated_issue_by = NULL;
            $customer_id->save();
            // Store Data
            $CustomerDraft = CustomerIssue::create([
                'issue_id'     => $id,
                'customer_id'         => $customer_id->id,
            ]);

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
        $agents = Agent::where('agent_type','المحول له')->get();
        return view('issues.show')->with([
            'issue'  => $issue,
            'agents'  => $agents,
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


//        // Validations
        $validator = $request->validate(
            [
                'court_name' => 'required',
                'customer_qty'  => 'required|numeric',
                'case_amount'  =>  'required|numeric',
                'execution_request' => 'required',
                'currency_type' => 'required',
                'bond_type' => 'required',
                'customer_id.*'     => 'required_if:customer_qty,>,0|numeric|digits:9',

            ],[
                'court_name.required' => 'يجب ادخال اسم المحكمة',
                'customer_qty.required' => 'يجب ادخال عدد الأفراد',
                'customer_qty.numeric' => 'يجب ادخال عدد الأفراد بالأرقام',
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
            $issue = Issue::where('id',$request->issue_id)->update([
                'court_name'     => $request->court_name,
                'customer_qty'         => $request->customer_qty,
                'case_amount'       => $request->case_amount,
                'execution_request_id'       => $request->execution_request,
                'execution_agent_name_id'       => $request->execution_agent_name,
                'execution_agent_against_it_id'       => $request->execution_agent_against_it,
                'currency_type' => $request->currency_type,
                'bond_type' => $request->bond_type,
                'notes'       => $request->notes,
            ]);


            if($request->case_number){
                Issue::where('id',$request->issue_id)->update([
                    'case_number' => $request->case_number,
                    'issue_status' =>  'بانتظار تصديق الاتفاق'
                ]);
            }



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
            return redirect()->route('issues.show',['issue' => $request->issue_id])->with('success','تم تعديل القضية بنجاح');

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
//        dd(count($array_issue));
        if(count($array_issue) <= 3){
            if($data->execution_agent_name_id == null && $data->execution_agent_against_it_id == null){
                $templateProcessor = new TemplateProcessor('wordOffice/issue1-3n-n.docx');
            }elseif($data->execution_agent_name_id != null && $data->execution_agent_against_it_id != null){
                $templateProcessor = new TemplateProcessor('wordOffice/issue1-3y-y.docx');
            }elseif($data->execution_agent_name_id == null && $data->execution_agent_against_it_id != null){
                $templateProcessor = new TemplateProcessor('wordOffice/issue1-3n-y.docx');
            }elseif($data->execution_agent_name_id != null && $data->execution_agent_against_it_id == null){
                $templateProcessor = new TemplateProcessor('wordOffice/issue1-3y-n.docx');
            }

        }elseif (count($array_issue) >= 4 && count($array_issue) <= 6){
            if($data->execution_agent_name_id == null && $data->execution_agent_against_it_id == null){
                $templateProcessor = new TemplateProcessor('wordOffice/issue4-6n-n.docx');
            }elseif($data->execution_agent_name_id != null && $data->execution_agent_against_it_id != null){
                $templateProcessor = new TemplateProcessor('wordOffice/issue4-6y-y.docx');
            }elseif($data->execution_agent_name_id == null && $data->execution_agent_against_it_id != null){
                $templateProcessor = new TemplateProcessor('wordOffice/issue4-6n-y.docx');
            }elseif($data->execution_agent_name_id != null && $data->execution_agent_against_it_id == null){
                $templateProcessor = new TemplateProcessor('wordOffice/issue4-6y-n.docx');
            }

        }elseif(count($array_issue) >= 7) {
            if ($data->execution_agent_name_id == null && $data->execution_agent_against_it_id == null) {
                $templateProcessor = new TemplateProcessor('wordOffice/issue7-9n-n.docx');
            } elseif ($data->execution_agent_name_id != null && $data->execution_agent_against_it_id != null) {
                $templateProcessor = new TemplateProcessor('wordOffice/issue7-9y-y.docx');
            } elseif ($data->execution_agent_name_id == null && $data->execution_agent_against_it_id != null) {
                $templateProcessor = new TemplateProcessor('wordOffice/issue7-9n-y.docx');
            } elseif ($data->execution_agent_name_id != null && $data->execution_agent_against_it_id == null) {
                $templateProcessor = new TemplateProcessor('wordOffice/issue7-9y-n.docx');
            }
        }
//        $templateProcessor = new TemplateProcessor('wordOffice/issue1-3.docx');
        $templateProcessor->setValue('court_name',$data->court_name);
        $templateProcessor->setValue('case_number',$data->case_number);
        $templateProcessor->setValue('execution_request_name',$data->execution_request_idIssue->agent_name ?? null);
        $templateProcessor->setValue('execution_request_address',$data->execution_request_idIssue->address ?? null);
        $templateProcessor->setValue('execution_request_ID_NO',$data->execution_request_idIssue->ID_NO ?? null);
        $templateProcessor->setValue('execution_agent_name',$data->execution_agent_name_idIssue->agent_name ?? null);
        $templateProcessor->setValue('execution_against_name',$data->execution_agent_against_it_idIssue->agent_name ?? null);
        $templateProcessor->setValue('execution_agent_against_it_name',$data->execution_agent_name_idIssue->agent_name ?? null);
        $templateProcessor->setValue('execution_agent_against_it_address',$data->execution_agent_against_it_idIssue->address ?? null);
        $templateProcessor->setValue('execution_agent_against_it_ID_NO',$data->execution_agent_against_it_idIssue->ID_NO ?? null);
        $templateProcessor->setValue('case_amount',$data->case_amount);
        $templateProcessor->setValue('created_at',Carbon::now()->format('Y-m-d'));
        $templateProcessor->setValue('currency',$data->currency_type);


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
        Issue::where('id',$issue->id)->update([
            'issue_status' => 'بانتظار اصدار قرار'
        ]);


        if($request->payment_type == 'استقطاع'){
            if($issue->execution_agent_name_id == null && $issue->execution_agent_against_it_id == null){
                $templateProcessor = new TemplateProcessor('wordOffice/ratifyAlln-n.docx');
            }elseif($issue->execution_agent_name_id != null && $issue->execution_agent_against_it_id != null){
                $templateProcessor = new TemplateProcessor('wordOffice/ratifyAlly-y.docx');
            }elseif($issue->execution_agent_name_id == null && $issue->execution_agent_against_it_id != null){
                $templateProcessor = new TemplateProcessor('wordOffice/ratifyAlln-y.docx');
            }elseif($issue->execution_agent_name_id != null && $issue->execution_agent_against_it_id == null){
                $templateProcessor = new TemplateProcessor('wordOffice/ratifyAlly-n.docx');
            }
            $templateProcessor->setValue('court_name',$issue->court_name);
            $templateProcessor->setValue('case_number',$issue->case_number);
            $templateProcessor->setValue('case_amount',$issue->case_amount);
            $templateProcessor->setValue('issue_currency',$issue->currency_type);
            $templateProcessor->setValue('execution_request_name',$issue->execution_request_idIssue->agent_name ?? null);
            $templateProcessor->setValue('execution_request_address',$issue->execution_request_idIssue->address ?? null);
            $templateProcessor->setValue('execution_request_ID_NO',$issue->execution_request_idIssue->ID_NO ?? null);
            $templateProcessor->setValue('execution_agent_name',$issue->execution_agent_name_idIssue->agent_name ?? null);
            $templateProcessor->setValue('execution_agent_against_it_name',$issue->execution_agent_against_it_idIssue->agent_name ?? null);
            $templateProcessor->setValue('bank_name',$bank->AgentBank->name);
            $templateProcessor->setValue('bank_branch',$bank->bank_branch);
            $templateProcessor->setValue('bank_account_NO',$bank->bank_account_NO);
            $templateProcessor->setValue('created_at',Carbon::now()->format('Y/m/d'));
            $templateProcessor->setValue('customer_name',$customer->full_name);
            $templateProcessor->setValue('customer_ID_NO',$customer->ID_NO);
            $templateProcessor->setValue('withholding_amount',$request->withholding_amount);
            $templateProcessor->setValue('currency_type',$request->currency_type);
            if ($request->by == 'بنك'){
                $bank_name = $customer->CustomerBank->name;
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
            if($issue->execution_agent_name_id == null && $issue->execution_agent_against_it_id == null){
                $templateProcessor = new TemplateProcessor('wordOffice/ratifyHalfn-n.docx');
            }elseif($issue->execution_agent_name_id != null && $issue->execution_agent_against_it_id != null){
                $templateProcessor = new TemplateProcessor('wordOffice/ratifyHalfy-y.docx');
            }elseif($issue->execution_agent_name_id == null && $issue->execution_agent_against_it_id != null){
                $templateProcessor = new TemplateProcessor('wordOffice/ratifyHalfn-y.docx');
            }elseif($issue->execution_agent_name_id != null && $issue->execution_agent_against_it_id == null){
                $templateProcessor = new TemplateProcessor('wordOffice/ratifyHalfy-n.docx');
            }
            $templateProcessor->setValue('court_name',$issue->court_name);
            $templateProcessor->setValue('case_number',$issue->case_number);
            $templateProcessor->setValue('case_amount',$issue->case_amount);
            $templateProcessor->setValue('issue_currency',$issue->currency_type);
            $templateProcessor->setValue('execution_request_name',$issue->execution_request_idIssue->agent_name ?? null);
            $templateProcessor->setValue('execution_request_address',$issue->execution_request_idIssue->address ?? null);
            $templateProcessor->setValue('execution_request_ID_NO',$issue->execution_request_idIssue->ID_NO ?? null);
            $templateProcessor->setValue('execution_agent_name',$issue->execution_agent_name_idIssue->agent_name ?? null);
            $templateProcessor->setValue('execution_agent_against_it_name',$issue->execution_agent_against_it_idIssue->agent_name ?? null);
            $templateProcessor->setValue('bank_name',$bank->AgentBank->name);
            $templateProcessor->setValue('bank_branch',$bank->bank_branch);
            $templateProcessor->setValue('bank_account_NO',$bank->bank_account_NO);
            $templateProcessor->setValue('created_at',Carbon::now()->format('Y/m/d'));
            $templateProcessor->setValue('customer_name',$customer->full_name);
            $templateProcessor->setValue('customer_ID_NO',$customer->ID_NO);
//            $templateProcessor->setValue('customer_bank',$customer->bank_name);
//            $templateProcessor->setValue('customer_branch',$customer->bank_branch);
            $templateProcessor->setValue('payment_type',$request->payment_type);

            if ($request->by == 'بنك'){
                $bank_name = $customer->CustomerBank->name;
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

    public function exportWORDReimbursement(Request $request,Issue $issue)
    {
        $issue = Issue::where('id',$issue->id)->first();
        $customer = Customer::where('id',$request->customer_id)->first();

        if($issue->execution_agent_name_id == null){
            $templateProcessor = new TemplateProcessor('wordOffice/reimbursement-n.docx');
        }elseif($issue->execution_agent_name_id != null){
            $templateProcessor = new TemplateProcessor('wordOffice/reimbursement-y.docx');
        }
        $templateProcessor->setValue('court_name',$issue->court_name);
        $templateProcessor->setValue('case_number',$issue->case_number);
        $templateProcessor->setValue('execution_request_name',$issue->execution_request_idIssue->agent_name ?? null);
        $templateProcessor->setValue('execution_request_address',$issue->execution_request_idIssue->address ?? null);
        $templateProcessor->setValue('execution_request_ID_NO',$issue->execution_request_idIssue->ID_NO ?? null);
        $templateProcessor->setValue('execution_agent_name',$issue->execution_agent_name_idIssue->agent_name ?? null);
        $templateProcessor->setValue('created_at',Carbon::now()->format('Y/m/d'));
        $templateProcessor->setValue('customer_name',$customer->full_name);
        $templateProcessor->setValue('customer_ID_NO',$customer->ID_NO);



        $fileName = $issue->issue_NO;
        $templateProcessor->saveAs($fileName.' تسديد.docx');
        return response()->download($fileName.' تسديد.docx')->deleteFileAfterSend(true);

    }

    public function exportWORDReservation(Request $request,Issue $issue)
    {
        $issue = Issue::where('id',$issue->id)->first();
        $customer = Customer::where('id',$request->customer_id)->first();
        Issue::where('id',$issue->id)->update([
            'issue_status' => 'بانتظار رد البنك'
        ]);
        if($issue->execution_agent_name_id == null){
            $templateProcessor = new TemplateProcessor('wordOffice/reservation-n.docx');
        }elseif($issue->execution_agent_name_id != null){
            $templateProcessor = new TemplateProcessor('wordOffice/reservation-y.docx');
        }
        $templateProcessor->setValue('court_name',$issue->court_name);
        $templateProcessor->setValue('case_number',$issue->case_number);
        $templateProcessor->setValue('execution_request_name',$issue->execution_request_idIssue->agent_name ?? null);
        $templateProcessor->setValue('execution_request_address',$issue->execution_request_idIssue->address ?? null);
        $templateProcessor->setValue('execution_request_ID_NO',$issue->execution_request_idIssue->ID_NO ?? null);
        $templateProcessor->setValue('execution_agent_name',$issue->execution_agent_name_idIssue->agent_name ?? null);
        $templateProcessor->setValue('created_at',Carbon::now()->format('Y/m/d'));
        $templateProcessor->setValue('customer_name',$customer->full_name);
        $templateProcessor->setValue('customer_ID_NO',$customer->ID_NO);

        $bank_name = $customer->CustomerBank->name;
        $bank_branch = $customer->bank_branch;
        $by = $bank_name . ' - ' . $bank_branch;

        $templateProcessor->setValue('by',$by);

        $fileName = $issue->issue_NO;
        $templateProcessor->saveAs($fileName.' فك حجز.docx');
        return response()->download($fileName.' فك حجز.docx')->deleteFileAfterSend(true);

    }

    public function exportWORDConversion(Request $request,Issue $issue)
    {
        $issue = Issue::where('id',$issue->id)->first();
        $bank = AgentBank::where('id',$request->bank_id)->first();
        $agent = Agent::where('id',$request->agent_id)->first();

        if($issue->execution_agent_name_id == null){
            $templateProcessor = new TemplateProcessor('wordOffice/conversion-n.docx');
        }elseif($issue->execution_agent_name_id != null){
            $templateProcessor = new TemplateProcessor('wordOffice/conversion-y.docx');
        }
        $templateProcessor->setValue('court_name',$issue->court_name);
        $templateProcessor->setValue('case_number',$issue->case_number);
        $templateProcessor->setValue('execution_request_name',$issue->execution_request_idIssue->agent_name ?? null);
        $templateProcessor->setValue('execution_request_address',$issue->execution_request_idIssue->address ?? null);
        $templateProcessor->setValue('execution_request_ID_NO',$issue->execution_request_idIssue->ID_NO ?? null);
        $templateProcessor->setValue('execution_agent_name',$issue->execution_agent_name_idIssue->agent_name ?? null);
        $templateProcessor->setValue('created_at',Carbon::now()->format('Y/m/d'));
        $templateProcessor->setValue('agent_name',$agent->agent_name);
        $templateProcessor->setValue('agent_ID_NO',$agent->ID_NO);
        $templateProcessor->setValue('bank_name',$bank->AgentBank->name);
        $templateProcessor->setValue('bank_branch',$bank->bank_branch);
        $templateProcessor->setValue('bank_account_NO',$bank->bank_account_NO);
//        $bank_name = $agent->bank_name;
//        $bank_branch = $customer->bank_branch;
//        $by = $bank_name . ' - ' . $bank_branch;
//
//        $templateProcessor->setValue('by',$by);

        $fileName = $issue->issue_NO;
        $templateProcessor->saveAs($fileName.' تحويل.docx');
        return response()->download($fileName.' تحويل.docx')->deleteFileAfterSend(true);

    }

    public function importIssues()
    {
        return view('issues.import');
    }

    public function uploadIssues(Request $request): RedirectResponse
    {
        $request->validate([
                'file'    => 'required',
            ]
            ,[
                'file.required' => 'يجب ادخال ملف اكسل',
            ]);

        Excel::import(new IssueImport(), $request->file('file'));


        return redirect()->route('issues.index')->with('success', 'تم استيراد بيانات القضايا');
    }

}
