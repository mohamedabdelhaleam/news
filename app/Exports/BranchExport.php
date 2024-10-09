<?php

namespace App\Exports;

use App\Models\Branch;
use Maatwebsite\Excel\Concerns\FromCollection;

class BranchExport implements FromCollection
{
    public function collection()
    {
        return Branch::all();
    }
}
