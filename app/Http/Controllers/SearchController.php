<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Bank;
use App\Models\Customer;
use App\Models\CustomerJob;
use App\Models\Draft;
use App\Models\Issue;
use App\Models\Transaction;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $banks = Bank::latest()->get();
        $jobs = CustomerJob::latest()->get();
        $agents = Agent::latest()->get();
        return view('search.index',
            [
                'banks' => $banks,
                'jobs' => $jobs,
                'agents' => $agents
            ]);
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
     * @return Application|Factory|View|\Illuminate\Http\RedirectResponse
     */
    public function search(Request $request)
    {
        if($request->type == "customer"){

            if (
                $request->filled('customer_NO') || $request->filled('full_name')
                || $request->filled('ID_NO') || $request->filled('phone_NO')
                || $request->filled('region') || $request->filled('marital_status')
                || $request->filled('job_id') || $request->filled('bank_id')
                || $request->filled('status')
            ) {

                $customers = Customer::query();

                if ($request->filled('customer_NO')) {
                    $customer_NO = $request->customer_NO;
                    $customers = $customers->where('customer_NO', 'LIKE', '%' . $customer_NO . '%');
                }

                if ($request->filled('customer_NO')) {
                    $full_name = $request->full_name;
                    $customers = $customers->where('full_name', 'LIKE', '%' . $full_name . '%');
                }

                if ($request->filled('ID_NO')) {
                    $ID_NO = $request->ID_NO;
                    $customers = $customers->where('ID_NO', 'LIKE', '%' . $ID_NO . '%');
                }

                if ($request->filled('phone_NO')) {
                    $phone_NO = $request->phone_NO;
                    $customers = $customers->where('phone_NO', 'LIKE', '%' . $phone_NO . '%');
                }

                if ($request->filled('region')) {
                    $region = $request->region;
                    $customers = $customers->where('region', 'LIKE', '%' . $region . '%');
                }

                if ($request->filled('marital_status')) {
                    $marital_status = $request->marital_status;
                    $customers = $customers->where('marital_status', 'LIKE', '%' . $marital_status . '%');
                }

                if ($request->filled('job_id')) {
                    $job_id = $request->job_id;
                    $customers = $customers->where('job_id', 'LIKE', '%' . $job_id . '%');
                }

                if ($request->filled('bank_id')) {
                    $bank_id = $request->bank_id;
                    $customers = $customers->where('bank_id', 'LIKE', '%' . $bank_id . '%');
                }

                $customers = $customers->latest()->get();
            } else {
                return redirect()->back();
            }

            return view('search.customers_search',
                [
                    'customers' =>$customers
                ]);

        }elseif ($request->type == "transaction"){

            if (
                $request->filled('transaction_NO') || $request->filled('transactions_type')
            ) {

                $transactions = Transaction::query();

                if ($request->filled('transaction_NO')) {
                    $transaction_NO = $request->transaction_NO;
                    $transactions = $transactions->where('transaction_NO', 'LIKE', '%' . $transaction_NO . '%');
                }

                if ($request->filled('transactions_type')) {
                    $transactions_type = $request->transactions_type;
                    $transactions = $transactions->where('transactions_type', 'LIKE', '%' . $transactions_type . '%');
                }

                $transactions = $transactions->latest()->get();
            } else {
                return redirect()->back();
            }

            return view('search.transactions_search',
                [
                    'transactions' =>$transactions
                ]);

        }elseif ($request->type == "draft"){

            if (
                $request->filled('draft_NO') || $request->filled('document_type')
            ) {

                $drafts = Draft::query();

                if ($request->filled('draft_NO')) {
                    $draft_NO = $request->draft_NO;
                    $drafts = $drafts->where('draft_NO', 'LIKE', '%' . $draft_NO . '%');
                }

                if ($request->filled('document_type')) {
                    $document_type = $request->document_type;
                    $drafts = $drafts->where('document_type', 'LIKE', '%' . $document_type . '%');
                }

                $drafts = $drafts->latest()->get();
            } else {
                return redirect()->back();
            }

            return view('search.drafts_search',
                [
                    'drafts' =>$drafts
                ]);

        }elseif($request->type == "issue"){

            if (
                $request->filled('issue_NO') || $request->filled('court_name')
                || $request->filled('case_number') || $request->filled('document_type')
                ||$request->filled('execution_request') || $request->filled('execution_agent_name')
                ||$request->filled('execution_agent_against_it') || $request->filled('bond_type')
            ) {

                $issues = Issue::query();

                if ($request->filled('issue_NO')) {
                    $issue_NO = $request->issue_NO;
                    $issues = $issues->where('issue_NO', 'LIKE', '%' . $issue_NO . '%');
                }

                if ($request->filled('court_name')) {
                    $court_name = $request->court_name;
                    $issues = $issues->where('court_name', 'LIKE', '%' . $court_name . '%');
                }

                if ($request->filled('case_number')) {
                    $case_number = $request->case_number;
                    $issues = $issues->where('case_number', 'LIKE', '%' . $case_number . '%');
                }

                if ($request->filled('document_type')) {
                    $document_type = $request->document_type;
                    $issues = $issues->where('document_type', 'LIKE', '%' . $document_type . '%');
                }

                if ($request->filled('execution_request')) {
                    $execution_request = $request->execution_request;
                    $issues = $issues->where('execution_request', 'LIKE', '%' . $execution_request . '%');
                }

                if ($request->filled('execution_agent_name')) {
                    $execution_agent_name = $request->execution_agent_name;
                    $issues = $issues->where('execution_agent_name', 'LIKE', '%' . $execution_agent_name . '%');
                }

                if ($request->filled('execution_agent_against_it')) {
                    $execution_agent_against_it = $request->execution_agent_against_it;
                    $issues = $issues->where('execution_agent_against_it', 'LIKE', '%' . $execution_agent_against_it . '%');
                }

                if ($request->filled('bond_type')) {
                    $bond_type = $request->bond_type;
                    $issues = $issues->where('bond_type', 'LIKE', '%' . $bond_type . '%');
                }

                $issues = $issues->latest()->get();
            } else {
                return redirect()->back();
            }

            return view('search.issues_search',
                [
                    'issues' =>$issues
                ]);

        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
