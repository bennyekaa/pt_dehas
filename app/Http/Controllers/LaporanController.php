<?php

namespace App\Http\Controllers;

use App\Exports\laporan;
use App\Exports\LaporanExport;
use App\Models\BendunganBendungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Elibyy\TCPDF\Facades\TCPDF;
use PDF;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class LaporanController extends Controller
{
    public function index()
    {
        $data['laporan'] = DB::select("SELECT
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
		notif.id_referensi = data_banjir_muka_air.id_banjir_muka_air");
        return view('laporan.index');
    }

    public function proses(Request $request)
    {
        if (empty($request->mulai)) {
            $data['bendungan'] = BendunganBendungan::all()->first();
            $data['selesai'] = $request->selesai;
            $checkhari = \Carbon\Carbon::parse($request->selesai)->dayName;
            if ($checkhari == 'Monday') {
                $data['hari2'] = 'Senin';
            } elseif ($checkhari == 'Tuesday') {
                $data['hari2'] = 'Selasa';
            } elseif ($checkhari == 'Wednesday') {
                $data['hari2'] = 'Rabu';
            } elseif ($checkhari == 'Thursday') {
                $data['hari2'] = 'Kamis';
            } elseif ($checkhari == 'Friday') {
                $data['hari2'] = 'Jumat';
            } elseif ($checkhari == 'Saturday') {
                $data['hari2'] = 'Sabtu';
            } elseif ($checkhari == 'Sunday') {
                $data['hari2'] = 'Ahad';
            }
            $data['laporan'] =
                DB::select("SELECT
                notif.id_referensi,
                notif.role_muka_air,
                notif.role_bocor,
                notif.`status` AS status_notif,
                notif.aktif AS aktif_notif,
                notif.pesan_default,
                notif.pesan_pemda,
                notif.pesan_umum,
                notif.created_at,
                notif.updated_at,
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
                    notif.id_referensi = data_banjir_muka_air.id_banjir_muka_air
            WHERE notif.status <> 0 AND notif.updated_at <= '". $request->selesai."' ORDER BY notif.updated_at ASC");

            // return view('laporan.cetak', $data);


            // $viewP = \View::make('laporan.cetak_atas', $data);
            // $htmlP = $viewP->render();
            $viewL = \View::make('laporan.cetak', $data);
            $htmlL = $viewL->render();

            // dd($html);

            $pdf = new TCPDF;


            $bMargin = $pdf::getBreakMargin();
            $auto_page_break = $pdf::getAutoPageBreak();
            $pdf::SetAutoPageBreak($auto_page_break, $bMargin);

            $pdf::SetTitle('LAPORAN');
            $pdf::SetMargins(5, 0, 5, true);
            //  $pdf::SetMargins($left, $top, $right = -1, $keepmargins = false)
            // $pdf::AddPage('L');
            // $pdf::writeHTML($htmlP, true, false, true, false, '');
            $pdf::AddPage('L');
            $pdf::writeHTML($htmlL, true, false, true, false, '');
            // QRCODE,H : QR-CODE Best error correction
            // $pdf::write2DBarcode('tes', 'QRCODE,H', 220, 50, 25, 25, $style, 'N');

            PDF::Output('LAPORAN.pdf');
        } elseif (empty($request->selesai)) {
            $data['bendungan'] = BendunganBendungan::all()->first();
            $data['mulai'] = $request->mulai;
            $checkhari = \Carbon\Carbon::parse($request->mulai)->dayName;
            if ($checkhari == 'Monday') {
                $data['hari1'] = 'Senin';
            } elseif ($checkhari == 'Tuesday') {
                $data['hari1'] = 'Selasa';
            } elseif ($checkhari == 'Wednesday') {
                $data['hari1'] = 'Rabu';
            } elseif ($checkhari == 'Thursday') {
                $data['hari1'] = 'Kamis';
            } elseif ($checkhari == 'Friday') {
                $data['hari1'] = 'Jumat';
            } elseif ($checkhari == 'Saturday') {
                $data['hari1'] = 'Sabtu';
            } elseif ($checkhari == 'Sunday') {
                $data['hari1'] = 'Ahad';
            }
            $data['laporan'] =
                DB::select("SELECT
                notif.id_referensi,
                notif.role_muka_air,
                notif.role_bocor,
                notif.`status` AS status_notif,
                notif.aktif AS aktif_notif,
                notif.pesan_default,
                notif.pesan_pemda,
                notif.pesan_umum,
                notif.created_at,
                notif.updated_at,
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
                    notif.id_referensi = data_banjir_muka_air.id_banjir_muka_air
            WHERE notif.status <> 0 AND notif.updated_at >= '" . $request->mulai . "' ORDER BY notif.updated_at ASC");

            // return view('laporan.cetak', $data);

            // $viewP = \View::make('laporan.cetak_atas', $data);
            // $htmlP = $viewP->render();
            $viewL = \View::make('laporan.cetak', $data);
            $htmlL = $viewL->render();

            // dd($html);

            $pdf = new TCPDF;


            $bMargin = $pdf::getBreakMargin();
            $auto_page_break = $pdf::getAutoPageBreak();
            $pdf::SetAutoPageBreak($auto_page_break, $bMargin);

            $pdf::SetTitle('LAPORAN');
            $pdf::SetMargins(5, 0, 5, true);
            // $pdf::SetMargins($left, $top, $right = -1, $keepmargins = false)
            // $pdf::AddPage('L');
            // $pdf::writeHTML($htmlP, true, false, true, false, '');
            $pdf::AddPage('L');
            $pdf::writeHTML($htmlL, true, false, true, false, '');
            // QRCODE,H : QR-CODE Best error correction
            // $pdf::write2DBarcode('tes', 'QRCODE,H', 220, 50, 25, 25, $style, 'N');

            PDF::Output('LAPORAN.pdf');
        } else {
            $data['bendungan'] = BendunganBendungan::all()->first();
            $data['mulai'] = $request->mulai;
            $checkhari1 = \Carbon\Carbon::parse($request->mulai)->dayName;
            if ($checkhari1 == 'Monday') {
                $data['hari1'] = 'Senin';
            } elseif ($checkhari1 == 'Tuesday') {
                $data['hari1'] = 'Selasa';
            } elseif ($checkhari1 == 'Wednesday') {
                $data['hari1'] = 'Rabu';
            } elseif ($checkhari1 == 'Thursday') {
                $data['hari1'] = 'Kamis';
            } elseif ($checkhari1 == 'Friday') {
                $data['hari1'] = 'Jumat';
            } elseif ($checkhari1 == 'Saturday') {
                $data['hari1'] = 'Sabtu';
            } elseif ($checkhari1 == 'Sunday') {
                $data['hari1'] = 'Ahad';
            }
            $data['selesai'] = $request->selesai;
            $checkhari2 = \Carbon\Carbon::parse($request->selesai)->dayName;
            if ($checkhari2 == 'Monday') {
                $data['hari2'] = 'Senin';
            } elseif ($checkhari2 == 'Tuesday') {
                $data['hari2'] = 'Selasa';
            } elseif ($checkhari2 == 'Wednesday') {
                $data['hari2'] = 'Rabu';
            } elseif ($checkhari2 == 'Thursday') {
                $data['hari2'] = 'Kamis';
            } elseif ($checkhari2 == 'Friday') {
                $data['hari2'] = 'Jumat';
            } elseif ($checkhari2 == 'Saturday') {
                $data['hari2'] = 'Sabtu';
            } elseif ($checkhari2 == 'Sunday') {
                $data['hari2'] = 'Ahad';
            }
            $data['laporan'] =
                DB::select("SELECT
                notif.id_referensi,
                notif.role_muka_air,
                notif.role_bocor,
                notif.`status` AS status_notif,
                notif.aktif AS aktif_notif,
                notif.pesan_default,
                notif.pesan_pemda,
                notif.pesan_umum,
                notif.created_at,
                notif.updated_at,
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
                    notif.id_referensi = data_banjir_muka_air.id_banjir_muka_air
            WHERE notif.status <> 0 AND notif.updated_at >= '" . $request->mulai . "' AND notif.updated_at <= '" . $request->selesai . "' ORDER BY notif.updated_at ASC");

            // return view('laporan.cetak', $data);

            // $viewP = \View::make('laporan.cetak_atas', $data);
            // $htmlP = $viewP->render();
            $viewL = \View::make('laporan.cetak', $data);
            $htmlL = $viewL->render();

            // dd($html);

            $pdf = new TCPDF;


            $bMargin = $pdf::getBreakMargin();
            $auto_page_break = $pdf::getAutoPageBreak();
            $pdf::SetAutoPageBreak($auto_page_break, $bMargin);

            $pdf::SetTitle('LAPORAN');
            $pdf::SetMargins(5, 0, 5, true);
            // $pdf::SetMargins($left, $top, $right = -1, $keepmargins = false)
            // $pdf::AddPage('L');
            // $pdf::writeHTML($htmlP, true, false, true, false, '');
            $pdf::AddPage('L');
            $pdf::writeHTML($htmlL, true, false, true, false, '');
            // QRCODE,H : QR-CODE Best error correction
            // $pdf::write2DBarcode('tes', 'QRCODE,H', 220, 50, 25, 25, $style, 'N');

            PDF::Output('LAPORAN.pdf');
        }
    }

    public function export()
    {
        try {
            $laporanData = DB::select("SELECT
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
            notif.id_referensi = data_banjir_muka_air.id_banjir_muka_air
        WHERE notif.status <> 0");

            return Excel::download(new LaporanExport($laporanData), 'laporan.xlsx');
        } catch (\Exception $e) {
            // Tangani kesalahan di sini, misalnya mencetak pesan error
            return back()->withError($e->getMessage());
        }
    }

    public function lihat()
    {
        $data['bendungan'] = BendunganBendungan::all()->first();
        $data['laporan'] =
            DB::select("SELECT
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
		notif.id_referensi = data_banjir_muka_air.id_banjir_muka_air
WHERE notif.status <> 0");
        return view('laporan.cetak', $data);
    }
}
