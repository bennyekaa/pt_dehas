<?php

namespace App\Imports;

use App\Models\DesaBendungan;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;

class DesaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        DesaBendungan::create([
            'id_desa' => Str::uuid(),
            'kode_pengungsian' => $row[1],
            'desa' => $row[2],
            'titik_kumpul' => $row[3],
            'jarak_titik_kumpul' => $row[4],
            'tk_long' => $row[5],
            'tk_lat' => $row[6],
            'lokasi_pengungsian' => $row[7],
            'jarak_pengungsian' => $row[8],
            'p_long' => $row[9],
            'p_lat' => $row[10],
            'e_long' => $row[11],
            'e_lat' => $row[12],
            'created_at' => now(),
            'created_by' => $row[14],
        ]);
    }
}
