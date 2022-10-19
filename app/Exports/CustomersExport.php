<?php

namespace App\Exports;

use App\Models\Customer;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CustomersExport implements FromView
{

    public function view(): View
    {

        return view('exports.customers', [
            'customers' => Customer::latest()->get()
        ]);
    }
}
