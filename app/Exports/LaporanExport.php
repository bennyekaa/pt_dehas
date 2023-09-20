<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;



class LaporanExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('laporan.cetak', [
            'laporan' => DB::select("SELECT
	notif.id_referensi,
	notif.role_muka_air,
	notif.role_bocor,
	notif.`status` AS status_notif,
	notif.aktif AS aktif_notif,
	notif.pesan_default,
	notif.pesan_pemda,
	notif.pesan_umum,
	data_banjir_bocor.id_banjir_bocor,
	data_banjir_bocor.`status` AS status_bocor,
	data_banjir_bocor.aktif AS aktif_bocor,
	data_banjir_bocor.lokasi,
	data_banjir_bocor.ukuran,
	data_banjir_bocor.tinggi_MAW,
	data_banjir_bocor.debit,
	data_banjir_bocor.kekuatan,
	data_banjir_bocor.diameter,
	data_banjir_bocor.tinggi,
	data_banjir_bocor.panjang,
	data_banjir_bocor.lebar,
	data_banjir_bocor.file_1,
	data_banjir_bocor.file_2,
	data_banjir_bocor.file_3,
	data_banjir_bocor.file_4,
	data_banjir_bocor.file_5,
	data_banjir_bocor.created_at as created_at_bocor,
	data_banjir_bocor.created_by as created_by_bocor,
	data_banjir_bocor.updated_at as updated_at_bocor,
	data_banjir_bocor.updated_by as updated_by_bocor,
	data_banjir_bocor.id_peta as peta_bocor,
	data_banjir_bocor.tinggi_air as tinggi_bocor,
	data_banjir_muka_air.muka_air,
	data_banjir_muka_air.tinggi_air as tinggi_muka_air,
	data_banjir_muka_air.debit_air,
	data_banjir_muka_air.id_banjir_muka_air,
	data_banjir_muka_air.`status` as status_muka_air,
	data_banjir_muka_air.aktif as aktif_muka_air,
	data_banjir_muka_air.created_at as created_at_muka_air,
	data_banjir_muka_air.created_by as created_by_muka_air,
	data_banjir_muka_air.updated_at as updated_at_muka_air,
	data_banjir_muka_air.updated_by as updated_by_muka_air,
	data_banjir_muka_air.id_peta as peta_muka_air
FROM
	notif
	LEFT JOIN
	data_banjir_bocor
	ON
		notif.id_referensi = data_banjir_bocor.id_banjir_bocor
	LEFT JOIN
	data_banjir_muka_air
	ON
		notif.id_referensi = data_banjir_muka_air.id_banjir_muka_air")
        ]);
    }
}
