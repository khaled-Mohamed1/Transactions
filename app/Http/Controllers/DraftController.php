<?php

namespace App\Http\Controllers;

use App\Exports\DraftExport;
use App\Exports\TransactionExport;
use App\Models\Draft;
use App\Models\Transaction;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DraftController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:draft-list|draft-create|draft-edit|draft-delete', ['only' => ['index']]);
        $this->middleware('permission:draft-create', ['only' => ['create','store']]);
        $this->middleware('permission:draft-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:draft-delete', ['only' => ['delete']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
//        $drafts = Draft::latest()->paginate(100);
        return view('drafts.index');
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
     * @param  \App\Models\Draft  $draft
     * @return \Illuminate\Http\Response
     */
    public function show(Draft $draft)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Draft  $draft
     * @return \Illuminate\Http\Response
     */
    public function edit(Draft $draft)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Draft  $draft
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Draft $draft)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Draft  $draft
     * @return \Illuminate\Http\Response
     */
    public function destroy(Draft $draft)
    {
        //
    }

    public function export()
    {
        return Excel::download(new DraftExport(), 'drafts.xlsx');
    }
}
