<?php

namespace App\Imports;

use App\Models\WadukBendungan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Str;

class WadukImport implements ToModel, WithStartRow
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        $puncak = str_replace(',','.',$row[0]);
        $ambang = str_replace(',','.',$row[1]);
        $lebar = str_replace(',','.',$row[2]);
        $c = str_replace(',','.',$row[3]);
        $batas_bawah = str_replace(',','.',$row[4]);
        $batas_atas = str_replace(',','.',$row[5]);
        if(strtolower(trim($row[6])) == 'normal'){
            $status = 0;
        }elseif(strtolower(trim($row[6])) == 'waspada 1'){
            $status = 1;
        }elseif(strtolower(trim($row[6])) == 'waspada 2'){
            $status = 2;
        }elseif(strtolower(trim($row[6])) == 'siaga'){
            $status = 3;
        }elseif(strtolower(trim($row[6])) == 'awas'){
            $status = 4;
        }

        if (!array_filter($row)) {
            return null;
        }
        // dd($status);
        WadukBendungan::create([
            'id_waduk' => Str::uuid(),
            'batas_bawah' => $batas_bawah,
            'batas_atas' => $batas_atas,
            'status' => $status,
            'keterangan' => $row[7],
            'puncak' => $puncak,
            'ambang' => $ambang,
            'lebar' => $lebar,
            'c' => $c,
            'created_by' => session('nama_role')
        ]);
    }
    public function startRow(): int
    {
        return 9;
    }
}
