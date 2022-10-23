<?php

namespace App\Exports;

use App\Models\Customer;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AllCustomersExport implements FromView
{
    public function view(): View
    {

        return view('exports.customers', [
            'customers' => Customer::orderBy('customer_NO','desc')->get()
        ]);
    }
}
