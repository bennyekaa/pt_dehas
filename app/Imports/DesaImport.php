<?php

namespace App\Imports;

use App\Models\DesaBendungan;
use App\Models\UserBendungan;
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

        DesaBendungan::create([
            'id_desa' => Str::uuid(),
            'id_pengungsian' => $id_pengungsian,
            'id_titik_kumpul' => $id_titik_kumpul,
            'kode_desa' => $row[1],
            'desa_lat' => $row[2],
            'desa_long' => $row[3],
            'kelurahan_desa' => $row[4],
            'kecamatan_desa' => $row[5],
            'kabupaten_desa' => $row[6],
            'jarak_dari_bendungan' => $row[7],
            'banjir' => $row[8],
            'kec_max' => $row[9],
            'waktu_tiba' => $row[10],
            'waktu_surut' => $row[11],
            'durasi_banjir' => $row[12],
            'jumlah_jiwa' => $row[13],
            'jumlah_kk' => $row[14],
            'rendah' => $row[15],
            'sedang' => $row[16],
            'tinggi' => $row[17],
            'total' => $row[18],
            'kk' => $row[19],
            'tidak_terdampak' => $row[20],
            'zona_bahaya' => $row[21],
            'balita' => $row[22],
            'anak' => $row[23],
            'muda' => $row[24],
            'dewasa' => $row[25],
            'manula' => $row[26],
            'total_jiwa' => $row[27],
            'laki_laki' => $row[28],
            'perempuan' => $row[39],
            'total_LP' => $row[30],
            'created_at' => now(),
            'created_by' => $created_by
        ]);

        TitikKumpulBendungan::create([
            'id_titik_kumpul' => $id_titik_kumpul,
            'kode_tk' => $row[43],
            'tk_lat' => $row[41],
            'tk_long' => $row[42],
            'nama_titik_kumpul' => $row[44],
            'nama_desa' => $row[45],
            'nama_kecamatan' => $row[46],
            'nama_kabupaten' => $row[47],
            'jarak_ke_tk' => $row[48],
            'created_at' => now(),
            'created_by' => $created_by
        ]);

        PengungsianBendungan::create([
            'id_pengungsian' => $id_pengungsian,
            'kode_pengungsian' => $row[51],
            'pengungsian_lat' => $row[49],
            'pengungsian_long' => $row[50],
            'nama_pengungsian' => $row[52],
            'nama_desa_pengungsian' => $row[53],
            'nama_kecamatan_pengungsian' => $row[54],
            'nama_kabupaten_pengungsian' => $row[55],
            'jarak_pengungsian' => $row[56],
            'created_at' => now(),
            'created_by' => $created_by
        ]);

    }
    

    public function startRow(): int
    {
        return 6;
    }

}
