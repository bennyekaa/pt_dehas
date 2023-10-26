<?php

namespace App\Imports;

use App\Models\DesaBendungan;
use App\Models\PengungsianBendungan;
use App\Models\TitikKumpulBendungan;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Session;

class DesaImport implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $id_pengungsian = Str::uuid();
        $id_titik_kumpul = Str::uuid();
        $created_by = session('nama');
        // dd($row[1]);

        DesaBendungan::create([
            'id_desa' => Str::uuid(),
            'id_pengungsian' => $id_pengungsian,
            'id_titik_kumpul' => $id_titik_kumpul,
            'kode_desa' => $row[1],
            'desa_lat' => str_replace(',', '.', $row[2]),
            'desa_long' => str_replace(',', '.', $row[3]),
            'radius' => $row[4],
            'kelurahan_desa' => $row[5],
            'kecamatan_desa' => $row[6],
            'kabupaten_desa' => $row[7],
            'jarak_dari_bendungan' => str_replace(',', '.', round((float)$row[8], 2)),
            'zona_bahaya' => $row[9],
            'id_kategori' => $row[26],
            'bendungan' => $row[27],
            'created_at' => now(),
            'created_by' => $created_by
        ]);

        TitikKumpulBendungan::create([
            'id_titik_kumpul' => $id_titik_kumpul,
            'kode_tk' => $row[12],
            'tk_lat' => $row[10],
            'tk_long' => $row[11],
            'nama_titik_kumpul' => $row[13],
            'nama_desa' => $row[14],
            'nama_kecamatan' => $row[15],
            'nama_kabupaten' => $row[16],
            'jarak_ke_tk' => str_replace(',', '.', round((float)$row[17], 2)),
            'created_at' => now(),
            'created_by' => $created_by
        ]);

        PengungsianBendungan::create([
            'id_pengungsian' => $id_pengungsian,
            'kode_pengungsian' => $row[20],
            'pengungsian_lat' => $row[18],
            'pengungsian_long' => $row[19],
            'nama_pengungsian' => $row[21],
            'nama_desa_pengungsian' => $row[22],
            'nama_kecamatan_pengungsian' => $row[23],
            'nama_kabupaten_pengungsian' => $row[24],
            'jarak_pengungsian' => str_replace(',', '.', round((float)$row[57], 2)),
            'created_at' => now(),
            'created_by' => $created_by
        ]);
    }


    public function startRow(): int
    {
        return 6;
    }

}
