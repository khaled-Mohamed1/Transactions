<?php

namespace App\Imports;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CustomerImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return Model|null
     */
    public function model(array $row)
    {
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
            "job"=>$row['job'] ?? null,
            "salary"=>$row['salary'] ?? null,
            "bank_name"=>$row['bank_name'] ?? null,
            "bank_branch"=>$row['bank_branch'] ?? null,
            "bank_account_NO"=>$row['bank_account_no'] ?? null,
            "created_by"=> auth()->user()->id,
            "status"=>$row['status'] ?? 'جديد',
            "account"=>$row['account'],
        ]);

        return $customer;
    }
}
