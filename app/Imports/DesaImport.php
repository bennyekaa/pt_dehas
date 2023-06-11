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
        $desa_lat = str_replace(',', '.', $row[2]);
        $desa_long = str_replace(',', '.', $row[3]);
        // dd($row[1]);

        DesaBendungan::create([
            'id_desa' => Str::uuid(),
            'id_pengungsian' => $id_pengungsian,
            'id_titik_kumpul' => $id_titik_kumpul,
            'kode_desa' => $row[1],
            'desa_lat' => $desa_lat,
            'desa_long' => $desa_long,
            'radius' => $row[4],
            'kelurahan_desa' => $row[5],
            'kecamatan_desa' => $row[6],
            'kabupaten_desa' => $row[7],
            'jarak_dari_bendungan' => $row[8],
            'banjir' => $row[9],
            'kec_max' => $row[10],
            'waktu_tiba' => $row[11],
            'waktu_surut' => $row[12],
            'durasi_banjir' => $row[13],
            'jumlah_jiwa' => $row[14],
            'jumlah_kk' => $row[15],
            'rendah' => $row[16],
            'sedang' => $row[17],
            'tinggi' => $row[18],
            'total' => $row[19],
            'kk' => $row[20],
            'tidak_terdampak' => $row[21],
            'zona_bahaya' => $row[22],
            'balita' => $row[23],
            'anak' => $row[24],
            'muda' => $row[25],
            'dewasa' => $row[26],
            'manula' => $row[27],
            'total_jiwa' => $row[28],
            'laki_laki' => $row[29],
            'perempuan' => $row[30],
            'total_LP' => $row[31],
            'created_at' => now(),
            'created_by' => $created_by
        ]);

        TitikKumpulBendungan::create([
            'id_titik_kumpul' => $id_titik_kumpul,
            'kode_tk' => $row[44],
            'tk_lat' => $row[42],
            'tk_long' => $row[43],
            'nama_titik_kumpul' => $row[45],
            'nama_desa' => $row[46],
            'nama_kecamatan' => $row[47],
            'nama_kabupaten' => $row[48],
            'jarak_ke_tk' => $row[49],
            'created_at' => now(),
            'created_by' => $created_by
        ]);

        PengungsianBendungan::create([
            'id_pengungsian' => $id_pengungsian,
            'kode_pengungsian' => $row[52],
            'pengungsian_lat' => $row[50],
            'pengungsian_long' => $row[51],
            'nama_pengungsian' => $row[53],
            'nama_desa_pengungsian' => $row[54],
            'nama_kecamatan_pengungsian' => $row[55],
            'nama_kabupaten_pengungsian' => $row[56],
            'jarak_pengungsian' => $row[57],
            'created_at' => now(),
            'created_by' => $created_by
        ]);

    }


    public function startRow(): int
    {
        return 6;
    }

}
