<?php

namespace App\Http\Controllers;

use App\Exports\DraftExport;
use App\Exports\IssueExport;
use App\Models\Issue;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class IssueController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:issue-list|issue-create|issue-edit|issue-delete', ['only' => ['index']]);
        $this->middleware('permission:issue-create', ['only' => ['create','store']]);
        $this->middleware('permission:issue-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:issue-delete', ['only' => ['delete']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
//        $issues = Issue::latest()->paginate(100);
        return view('issues.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
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
     * @return \Illuminate\Http\Response
     */
    public function destroy(Issue $issue)
    {
        //
    }

    public function export()
    {
        return Excel::download(new IssueExport(), 'issues.xlsx');
    }
}
