<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Issue;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AgentController extends Controller
{
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

//        // Validations
        $validator = $request->validate(
            [
                'agent_name' => 'required',
                'agent_type'  => 'required',

            ],[
                'agent_name.required' => 'يجب ادخال اسم الوكيل',
                'agent_type.required' => 'يجب ادخال نوع الوكيل',
            ]
        );

        DB::beginTransaction();
        try {

            // Store Data
            $agent = Agent::create([
                'agent_name'     => $request->agent_name,
                'agent_type'         => $request->agent_type,

            ]);

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
        return view('agents.edit')->with([
            'agent'  => $agent
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

            ],[
                'agent_name.required' => 'يجب ادخال اسم الوكيل',
                'agent_type.required' => 'يجب ادخال نوع الوكيل',
            ]
        );

        DB::beginTransaction();
        try {

            // Store Data

            $agent_update = Agent::whereId($agent->id)->update([
                'agent_name'     => $request->agent_name,
                'agent_type'         => $request->agent_type,
            ]);

            // Commit And Redirected To Listing
            DB::commit();
            return redirect()->route('agents.index')->with('success','تم تعديل الوكيل بنجاح!');

        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }    }

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
