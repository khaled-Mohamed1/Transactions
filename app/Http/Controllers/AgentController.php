<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\AgentBank;
use App\Models\Issue;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AgentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:وكلاء-بيانات|وكلاء-اضافة|وكلاء-تعديل|وكلاء-حذف', ['only' => ['index']]);
        $this->middleware('permission:وكلاء-اضافة', ['only' => ['create','store']]);
        $this->middleware('permission:وكلاء-تعديل', ['only' => ['edit','update']]);
        $this->middleware('permission:وكلاء-حذف', ['only' => ['delete']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $agents = Agent::latest()->paginate(100);
        return view('agents.index', ['agents'=>$agents]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('agents.create');
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
                'agent_name' => 'required',
                'agent_type'  => 'required',
                'ID_NO'     => 'required|numeric|digits:9',
                'address'  => 'required',

            ],[
                'agent_name.required' => 'يجب ادخال اسم الوكيل',
                'agent_type.required' => 'يجب ادخال نوع الوكيل',
                'ID_NO.required' => 'يجب ادخال رقم هوية العميل',
                'ID_NO.numeric' => 'يجب ادخال رقم الهوية بالأرقام',
                'ID_NO.digits' => 'رقم الهوية يتكون من 9 ارقام فقط',
                'address.required' => 'يجب ادخال عنوان سكن العميل',
            ]
        );

        DB::beginTransaction();
        try {

            // Store Data
            $agent = Agent::create([
                'agent_name'     => $request->agent_name,
                'agent_type'         => $request->agent_type,
                'ID_NO'         => $request->ID_NO,
                'address'         => $request->address,
            ]);

            $id = $agent->id;

            foreach($request->bank_name as $key => $data)
            {


                // Store Data
                $bank_agent = AgentBank::create([
                    'agent_id' => $id,
                    'bank_name' => $request->bank_name[$key],
                    'bank_branch'=> $request->bank_branch[$key],
                    'bank_account_NO'=> $request->bank_account_NO[$key],
                ]);
            }


            // Commit And Redirected To Listing
            DB::commit();
            return redirect()->route('agents.index')->with('success','تم انشاء الوكيل بنجاح');

        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function show(Agent $agent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agent  $agent
     * @return Application|Factory|View
     */
    public function edit(Agent $agent)
    {
        $banks = $agent->agentBanks;
        return view('agents.edit')->with([
            'agent'  => $agent,
            'banks'  => $banks,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Agent $agent)
    {
        // Validations
        $request->validate(
            [
                'agent_name' => 'required',
                'agent_type'  => 'required',
                'ID_NO'     => 'required|numeric|digits:9',
                'address'  => 'required',

            ],[
                'agent_name.required' => 'يجب ادخال اسم الوكيل',
                'agent_type.required' => 'يجب ادخال نوع الوكيل',
                'ID_NO.required' => 'يجب ادخال رقم هوية العميل',
                'ID_NO.numeric' => 'يجب ادخال رقم الهوية بالأرقام',
                'ID_NO.digits' => 'رقم الهوية يتكون من 9 ارقام فقط',
                'address.required' => 'يجب ادخال عنوان سكن العميل',
            ]
        );

        DB::beginTransaction();
        try {

            // Store Data

            $agent_update = Agent::whereId($agent->id)->update([
                'agent_name'     => $request->agent_name,
                'agent_type'         => $request->agent_type,
                'ID_NO'         => $request->ID_NO,
                'address'         => $request->address,
            ]);

            AgentBank::where('agent_id',$request->agent_id)->delete();


            foreach($request->bank_name as $key => $data)
            {

                // Store Data
                $bank_agent = AgentBank::create([
                    'agent_id' => $request->agent_id,
                    'bank_name' => $request->bank_name[$key],
                    'bank_branch'=> $request->bank_branch[$key],
                    'bank_account_NO'=> $request->bank_account_NO[$key],
                ]);
            }

            // Commit And Redirected To Listing
            DB::commit();
            return redirect()->route('agents.index')->with('success','تم تعديل الوكيل بنجاح!');

        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Agent $agent)
    {
        DB::beginTransaction();
        try {
            // Delete
            Agent::whereId($agent->id)->delete();

            DB::commit();
            return redirect()->route('agents.index')->with('success', 'تم حذف الوكيل');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
