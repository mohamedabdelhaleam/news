<?php

namespace App\Exports;

use App\Models\Service;
use Maatwebsite\Excel\Concerns\FromCollection;

class ServiceExport implements FromCollection
{
    public function collection()
    {
        return Service::all();
    }
}
