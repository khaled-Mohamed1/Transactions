<?php

namespace App\Exports;

use App\Models\Transaction;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TransactionExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function view(): View
    {

        return view('exports.transactions', [
            'transactions' => Transaction::orderBy('transaction_NO','desc')->get()
        ]);
    }
}
