<?php

namespace App\Imports;

use App\Helpers\Helper;
use App\Models\Agent;
use App\Models\Customer;
use App\Models\CustomerIssue;
use App\Models\Issue;
use Hamcrest\Core\Is;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class IssueImport implements ToModel, WithHeadingRow,WithCustomCsvSettings
{
    /**
     * @param Collection $collection
     */
    public function model(array $row)
    {

        $array = explode(' -', $row['customers']);
        $newArray = array_slice($array, 0, count($array) - 1);
        $count = count($array);

        $execution_request_id = Agent::where('agent_name', $row['execution_request_id'])->pluck('id')->first();

        if($row['execution_agent_name_id'] == null){
            $execution_agent_name_id = null;
        }else{
            $execution_agent_name_id = Agent::where('agent_name', $row['execution_agent_name_id'])->pluck('id')->first();
        }

        if($row['execution_agent_against_it_id'] == null){
            $execution_agent_against_it_id = null;
        }else{
            $execution_agent_against_it_id = Agent::where('agent_name', $row['execution_agent_against_it_id'])->pluck('id')->first();
        }


        $issue = Issue::create([
            'issue_NO' => Helper::IDGenerator(new Issue(), 'issue_NO', 5,2),
            'user_id'    => auth()->user()->id,
            'draft_id'    => null,
            'court_name'     => $row['court_name'],
            'customer_qty'         => $count,
            'case_number' => $row['case_number'],
            'case_amount'       => $row['case_amount'],
            'execution_request_id'       => $execution_request_id,
            'execution_agent_name_id'       => $execution_agent_name_id,
            'execution_agent_against_it_id'       => $execution_agent_against_it_id,
            'currency_type' => $row['currency_type'],
            'bond_type' => $row['bond_type'],
            'notes'       => $row['notes'],
            'issue_status'       => $row['status'],
            'created_at'       => $row['created_at'],
            'updated_at'       => $row['created_at'],
        ]);



        foreach ($newArray as $item){
            $newitem = str_replace(' ', '', $item);
            $customer = Customer::where('customer_NO',$newitem)->pluck('id')->first();
            $CustomerIssue = CustomerIssue::create([
                "issue_id" => $issue->id,
                "customer_id" => $customer,
            ]);
        }

        if($issue->issue_NO == 200000){
            $issue->issue_NO = $issue->issue_NO + 1;
            $issue->save();
        }

        return $issue;

    }

    public function getCsvSettings(): array
    {
        # Define your custom import settings for only this class
        return [
            'input_encoding' => 'UTF-8',
        ];
    }
}
