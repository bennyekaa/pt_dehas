<?php

namespace App\Exports;

use App\Models\DesaBendungan;
use Maatwebsite\Excel\Concerns\FromCollection;

class DesaExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DesaBendungan::all();
    }
}
