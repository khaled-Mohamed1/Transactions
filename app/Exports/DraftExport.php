<?php

namespace App\Exports;

use App\Models\Draft;
use Maatwebsite\Excel\Concerns\FromCollection;

class DraftExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Draft::latest()->get();
    }
}
