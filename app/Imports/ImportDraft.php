<?php

namespace App\Imports;

use App\Helpers\Helper;
use App\Models\Customer;
use App\Models\CustomerDraft;
use App\Models\Draft;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class ImportDraft implements ToModel, WithHeadingRow,WithCustomCsvSettings
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {

        $array = explode(' -', $row['customers']);
        $newArray = array_slice($array, 0, count($array) - 1);

        $draft = Draft::create([
            "draft_NO" => Helper::IDGenerator(new Draft(), 'draft_NO', 5,3),
            "document_type" => $row['document_type'],
            "customer_qty" => $row['customer_qty'],
            "document_qty" => $row['document_qty'],
            "document_affiliate" => $row['document_affiliate'],
            "user_id" => auth()->user()->id,
        ]);



        foreach ($newArray as $item){
            $newitem = str_replace(' ', '', $item);
            $customer = Customer::where('customer_NO',$newitem)->pluck('id')->first();
            $CustomerDraft = CustomerDraft::create([
                "draft_id" => $draft->id,
                "customer_id" => $customer,
            ]);
        }

        if($draft->draft_NO == 300000){
            $draft->draft_NO = $draft->draft_NO + 1;
            $draft->save();
        }

        return $draft;

    }

    public function getCsvSettings(): array
    {
        # Define your custom import settings for only this class
        return [
            'input_encoding' => 'UTF-8',
        ];
    }
}
