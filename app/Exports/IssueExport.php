<?php

namespace App\Exports;

use App\Models\Issue;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
class IssueExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function view(): View
    {

        return view('exports.issues', [
            'issues' => Issue::orderBy('issue_NO','desc')->get()
        ]);
    }
}
