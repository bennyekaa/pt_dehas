<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DesaBendungan;
use Exception;
use App\Exports\DesaExport;
use App\Imports\DesaImport;
use Maatwebsite\Excel\Facades\Excel;
use Session;
use Illuminate\Support\Facades\Redirect;

class DesaController extends Controller
{
    public function index()
    {
        $data['desa'] = DesaBendungan::all();
   //     $data['desa'] = DB::table('ref_desa')->orderBy('kode_desa', 'asc')->get();
        session()->put('ref_desa', url()->full());
        return view('master.desa', $data);
    }

    public function import()
    {
        return view('master.importdesa');
    }

    public function export()
    {
    }

    public function proses_excel(Request $request)
    {
        if ($request->fungsi == 'Import') {
            // dd($request->all());
            // try {
                $file = $request->file('data_file')->getRealPath();
                Excel::import(new DesaImport, $file);

                return redirect(('/desa'))->with('success', 'Berhasil Import');
                
                //return redirect(session('desa'))->with('success', 'Berhasil Import');
            // } catch (Exception $e) {
            //     return redirect(session('desa'))->with('error', $e->getMessage());
            // }
        }
    }

    // TAMBAH

    // public function tambah()
    // {
    //     return view('register.desa');
    // }

    // public function tambahproses(Request $request)
    // {
    //     $created_by = session('nama');
    //     DB::table('ref_desa')->insert([
    //         'kode_desa' => $request->kode_desa,
    //         'desa_lat' => $request->desa_lat,
    //         'desa_long' => $request->desa_long,
    //         'radius' => $request->radius,
    //         'kelurahan_desa' => $request->kelurahan_desa,
    //         'kecamatan_desa' => $request->kecamatan_desa,
    //         'kabupaten_desa' => $request->kabupaten_desa,
    //         'jarak_dari_bendungan' => $request->jarak_dari_bendungan,
    //         'banjir' => $request->banjir,
    //         'kec_max' => $request->kec_max,
    //         'waktu_tiba' => $request->waktu_tiba,
    //         'waktu_surut' => $request->waktu_surut,
    //         'durasi_banjir' => $request->durasi_banjir,
    //         'jumlah_jiwa' => $request->jumlah_jiwa,
    //         'jumlah_kk' => $request->jumlah_kk,
    //         'rendah' => $request->rendah,
    //         'sedang' => $request->sedang,
    //         'tinggi' => $request->tinggi,
    //         'total' => $request->total,
    //         'kk' => $request->kk,
    //         'tidak_terdampak' => $request->tidak_terdampak,
    //         'zona_bahaya' => $request->zona_bahaya,
    //         'balita' => $request->balita,
    //         'anak' => $request->anak,
    //         'muda' => $request->muda,
    //         'dewasa' => $request->dewasa,
    //         'manula' => $request->manula,
    //         'total_jiwa' => $request->total_jiwa,
    //         'laki_laki' => $request->laki_laki,
    //         'perempuan' => $request->perempuan,
    //         'total_LP' => $request->total_LP,
    //         'created_at' => date('Y-m-d H:i:s.U'),
    //         'created_by' => session('nama')
    //     ]);
    //     DB::table('ref_titik_kumpul')->insert([
    //         'kode_desa' => $request->kode_desa,
    //         'titik_kumpul' => $request->titik_kumpul,
    //         'jarak_titik_kumpul' => $request->jarak_tk,
    //         'tk_long' => $request->tk_long,
    //         'tk_lat' => $request->tk_lat,
    //         'lokasi_pengungsian' => $request->lokasi_pengungsian,
    //         'jarak_pengungsian' => $request->jarak_pengungsian,
    //         'p_long' => $request->p_long,
    //         'p_lat' => $request->p_lat,
    //         'e_long' => $request->e_long,
    //         'e_lat' => $request->e_lat,
    //         'created_at' => date('Y-m-d H:i:s.U'),
    //         'created_by' => session('nama')
    //     ]);
    //     DB::table('ref_pengungsian')->insert([
    //         'kode_desa' => $request->kode_desa,
    //         'titik_kumpul' => $request->titik_kumpul,
    //         'jarak_titik_kumpul' => $request->jarak_tk,
    //         'tk_long' => $request->tk_long,
    //         'tk_lat' => $request->tk_lat,
    //         'lokasi_pengungsian' => $request->lokasi_pengungsian,
    //         'jarak_pengungsian' => $request->jarak_pengungsian,
    //         'p_long' => $request->p_long,
    //         'p_lat' => $request->p_lat,
    //         'e_long' => $request->e_long,
    //         'e_lat' => $request->e_lat,
    //         'created_at' => date('Y-m-d H:i:s.U'),
    //         'created_by' => session('nama')
    //     ]);
    //     return redirect('/desa');
    // }

    //EDIT
    public function edit($id)
    {
        $data['desa'] = DesaBendungan::find(decrypt($id));
        return view('edit.desa', $data);
    }


    public function prosesdesa(Request $request)
    {
        $data = DesaBendungan::find($request->id_desa);
        $data->kode_desa = $request->kode_desa;
        $data->desa_lat = $request->desa_lat;
        $data->desa_long = $request->desa_long;
        $data->radius = $request->radius;
        $data->kelurahan_desa = $request->kelurahan_desa;
        $data->kecamatan_desa = $request->kecamatan_desa;
        $data->kabupaten_desa = $request->kabupaten_desa;
        $data->jarak_dari_bendungan = $request->jarak_dari_bendungan;
        $data->banjir = $request->banjir;
        $data->kec_max = $request->kec_max;
        $data->waktu_tiba = $request->waktu_tiba;
        $data->waktu_surut = $request->waktu_surut;
        $data->durasi_banjir = $request->durasi_banjir;
        $data->jumlah_jiwa = $request->jumlah_jiwa;
        $data->jumlah_kk = $request->jumlah_kk;
        $data->rendah = $request->rendah;
        $data->sedang = $request->sedang;
        $data->tinggi = $request->tinggi;
        $data->total = $request->total;
        $data->kk = $request->kk;
        $data->tidak_terdampak = $request->tidak_terdampak;
        $data->zona_bahaya = $request->zona_bahaya;
        $data->balita = $request->balita;
        $data->anak = $request->anak;
        $data->muda = $request->muda;
        $data->dewasa = $request->dewasa;
        $data->manula = $request->manula;
        $data->total_jiwa = $request->total_jiwa;
        $data->laki_laki = $request->laki_laki;
        $data->perempuan = $request->perempuan;
        $data->total_LP = $request->total_LP;
        $data->updated_by = session('nama');
        $data->save();
        return redirect(('/desa'))->with('success', 'Data Tersimpan');
    }

    //EXPORT
    public function export_excel()
    {
        return Excel::download(new DesaExport, 'desa.xlsx');
    }

    public function import_excel(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file')->getRealPath();
        Excel::import(new DesaImport, $file);
        return redirect('/desa');
    }

    // HAPUS
    public function hapus($id)
    {
        DB::table('ref_desa')->where('id_desa', decrypt($id))->delete();
        return redirect(session('ref_desa'))->with('success', 'Data Terhapus');
    }
}
