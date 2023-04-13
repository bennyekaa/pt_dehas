<?php

namespace App\Imports;

use App\Models\DesaBendungan;
use Maatwebsite\Excel\Concerns\ToModel;

class DesaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new DesaBendungan([
            'id_desa' => $row[0],
            'kode_pengungsian' => $row[1],
            'desa' => $row[2],
            'titik_kumpul' => $row[3],
            'jarak_titik_kumpul' => $row[4],
            'tk_x' => $row[5],
            'tk_y' => $row[6],
            'lokasi_pengungsian' => $row[7],
            'jarak_pengungsian' => $row[8],
            'p_x' => $row[9],
            'p_y' => $row[10],
            'e_x' => $row[11],
            'e_y' => $row[12],
            'created_at' => now(),
            'created_by' => $row[14],
        ]);
    }
}
