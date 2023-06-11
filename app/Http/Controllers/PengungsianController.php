<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PengungsianBendungan;

class PengungsianController extends Controller
{
    public function index()
    {
        // mengambil data dari table Titik Kumpul
        $data['pengungsian'] = DB::table('ref_pengungsian')->orderBy('kode_pengungsian', 'asc')->get();
        session()->put('ungsian', url()->full());
        return view('master.pengungsian', $data);
    }

    //EDIT
    public function edit($id)
    {
        $data['pengungsian'] = PengungsianBendungan::find(decrypt($id));
        return view('edit.pengungsian', $data);
    }

    public function prosespengungsian(Request $request)
    {
        $data = PengungsianBendungan::find($request->id_pengungsian);
        $data->id_pengungsian = $request->id_pengungsian;
        $data->kode_pengungsian = $request->kode_pengungsian;
        $data->pengungsian_lat = $request->pengungsian_lat;
        $data->pengungsian_long = $request->pengungsian_long;
        $data->nama_pengungsian = $request->nama_pengungsian;
        $data->nama_desa_pengungsian = $request->nama_desa_pengungsian;
        $data->nama_kecamatan_pengungsian = $request->nama_kecamatan_pengungsian;
        $data->nama_kabupaten_pengungsian = $request->nama_kabupaten_pengungsian;
        $data->jarak_pengungsian = $request->jarak_pengungsian;
        $data->updated_by = session('nama');
        $data->save();
        return redirect(('/pengungsian'))->with('success', 'Data Tersimpan');
    }

    // public function tambah()
    // {
    //     return view('register.pengungsian');
    // }

    // public function tambahproses(Request $request)
    // {
    //     DB::table('ref_bendungan')->insert([
    //         'kode_tk' => $request->kode_tk,
    //         'tk_lat' => $request->tk_lat,
    //         'tk_long' => $request->tk_long,
    //         'nama_titik_kumpul' => $request->nama_titik_kumpul,
    //         'nama_desa' => $request->nama_desa,
    //         'nama_kecamatan' => $request->nama_kecamatan,
    //         'nama_kabupaten' => $request->nama_kabupaten,
    //         'jarak_ke_tk' => $request->jarak_ke_tk,
    //         'created_at' => date('Y-m-d H:i:s.U'),
    //         'created_by' => session('nama')
    //     ]);
    //     return redirect('/titikkumpul');
    // }

    public function hapus($id)
    {
        try {
            $pengungsian = PengungsianBendungan::find(decrypt($id));
            $pengungsian->delete();
            return redirect(session('ungsian'))->with('success', 'Data Terhapus');
        } catch (Exception $e) {
            return redirect(session('ungsian'))->with('error', $e->getMessage());
        }
    }
}
