<?php

namespace App\Exports;

use App\Models\Customer;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CommittedExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {

        return view('exports.customers', [
            'customers' => Customer::where('status','ملتزم')->latest()->get()
        ]);
    }
}
