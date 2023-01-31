<?php

namespace App\Imports;

use App\Models\Bank;
use App\Models\Customer;
use App\Models\CustomerJob;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class CustomerImport implements ToModel, WithHeadingRow, WithCustomCsvSettings
{
    /**
     * @param array $row
     *
     * @return Model|null
     */
    public function model(array $row)
    {

        $bank = Bank::where('name', $row['bank_name'])->first();
        $job = CustomerJob::where('name', $row['job'])->first();

        $customer = new Customer([
            "customer_NO"=>$row['customer_no'],
            "full_name"=>$row['full_name'],
            "ID_NO"=>$row['id_no'],
            "phone_NO"=>$row['phone_no'],
            "region"=>$row['region'],
            "address"=>$row['address'],
            "reserve_phone_NO"=>$row['reserve_phone_no'] ?? null,
            "date_of_birth"=>$row['date_of_birth'] ?? null,
            "marital_status"=>$row['marital_status'] ?? null,
            "number_of_children"=>$row['number_of_children'] ?? null,
            "job_id"=> $job->id ?? null,
            "salary"=>$row['salary'] ?? null,
            "bank_id"=> $bank->id ?? null,
            "bank_branch"=>$row['bank_branch'] ?? null,
            "bank_account_NO"=>$row['bank_account_no'] ?? null,
            "notes" => $row['notes'] ?? null,
            "created_by"=> auth()->user()->id,
            "status"=>$row['status'] ?? 'جديد',
            "account"=>$row['account'] ?? '0',
        ]);

        return $customer;
    }

    public function getCsvSettings(): array
    {
        # Define your custom import settings for only this class
        return [
            'input_encoding' => 'UTF-8',
        ];
    }
}
