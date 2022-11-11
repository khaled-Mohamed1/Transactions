<?php

namespace App\Exports;

use App\Models\Draft;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DraftExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function view(): View
    {

        return view('exports.drafts', [
            'drafts' => Draft::orderBy('draft_NO','desc')->get()
        ]);
    }
}
