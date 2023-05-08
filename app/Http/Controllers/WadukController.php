<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\WadukBendungan;

class WadukController extends Controller
{
    public function index()
    {
        // mengambil data dari table Titik Kumpul
    //  $data['waduk'] = DB::table('ref_waduk')->get();
        $data['waduk'] = DB::table('ref_waduk')->orderBy('tinggi_air', 'asc')->get();
        return view('master.waduk', $data);
    }

    public function edit($id_waduk)
    {
        $id = decrypt($id_waduk);
        $data = WadukBendungan::find($id);
        return view('edit.waduk', compact(['data']));
    }

    public function proseswaduk(Request $request)
    {
        $data = WadukBendungan::find($request->id_waduk);
        $data->id_waduk = $request->id_waduk;
        $data->muka_air = $request->muka_air;
        $data->tinggi_air = $request->tinggi_air;
        $data->debit_keluar = $request->debit_keluar;
        $data->status = $request->status;
        $data->keterangan = $request->keterangan;
        $data->updated_by = session('nama');
        $data->save();
        return redirect('/waduk');
    }

    public function tambah()
    {
        return view('register.waduk');
    }

    public function tambahproses(Request $request)
    {
        DB::table('ref_waduk')->insert([
            'muka_air' => $request->muka_air,
            'tinggi_air' => $request->tinggi_air,
            'debit_keluar' => $request->debit_keluar,
            'status' => $request->status,
            'keterangan' => $request->keterangan,
            'created_at' => date('Y-m-d H:i:s.U'),
            'created_by' => session('nama')
        ]);
        return redirect('/waduk');
    }

    public function hapus($id)
    {
        DB::table('ref_waduk')->where('id_waduk', $id)->delete();
        return redirect(('/waduk'))->with('success', 'Data Terhapus');
    }
}
