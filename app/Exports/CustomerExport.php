<?php

namespace App\Exports;

use App\Models\Customer;
use App\Models\CustomerDraft;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CustomerExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $customer;

    function __construct($customer) {
        $this->customer = $customer;
    }


    public function view(): View
    {

        $drafts = CustomerDraft::with('DraftCustomerDraft')->where('id',$this->customer->id)->get();
//        dd($this->customer->CustomerDrafts->DraftCustomerDraft);

        return view('exports.customer', [
            'customer' => $this->customer,
            'drafts' => $drafts,
        ]);
    }
}
