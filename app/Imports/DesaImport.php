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
            'banjir' => $row[9],
            'kec_max' => str_replace(',', '.', round((float)$row[10], 2)),
            'waktu_tiba' => str_replace(',', '.', $row[11]),
            'waktu_surut' => str_replace(',', '.', round((float)$row[12], 2)),
            'durasi_banjir' => str_replace(',', '.', round((float)$row[13], 2)),
            'jumlah_jiwa' => str_replace(',', '.', $row[14]),
            'jumlah_kk' => str_replace(',', '.', $row[15]),
            'rendah' => str_replace(',', '.', $row[16]),
            'sedang' => str_replace(',', '.', $row[17]),
            'tinggi' => str_replace(',', '.', $row[18]),
            'total' => str_replace(',', '.', $row[19]),
            'kk' => str_replace(',', '.', $row[20]),
            'tidak_terdampak' => str_replace(',', '.', $row[21]),
            'zona_bahaya' => $row[22],
            'balita' => str_replace(',', '.', $row[23]),
            'anak' => str_replace(',', '.', $row[24]),
            'muda' => str_replace(',', '.', $row[25]),
            'dewasa' => str_replace(',', '.', $row[26]),
            'manula' => str_replace(',', '.', $row[27]),
            'total_jiwa' => str_replace(',', '.', $row[28]),
            'laki_laki' => str_replace(',', '.', $row[29]),
            'perempuan' => str_replace(',', '.', $row[30]),
            'total_LP' => str_replace(',', '.', $row[31]),
            'id_kategori' => $row[58],
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
            'jarak_ke_tk' => str_replace(',', '.', round((float)$row[49], 2)),
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
