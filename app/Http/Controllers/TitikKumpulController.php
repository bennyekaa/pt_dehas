<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TitikKumpulBendungan;


class TitikKumpulController extends Controller
{
    public function index()
    {
        $data['kumpul'] = DB::table('ref_titik_kumpul')->orderBy('kode_tk', 'asc')->get();
        session()->put('titikkumpul', url()->full());
        return view('master.titikkumpul', $data);
    }

    public function edit($id_titik_kumpul)
    {
        $id = decrypt($id_titik_kumpul);
        $data = TitikKumpulBendungan::find($id);
        return view('edit.titikkumpul', compact(['data']));
    }

    public function prosestitikkumpul(Request $request)
    {
        $data = TitikKumpulBendungan::find($request->id_titik_kumpul);
        $data->id_titik_kumpul = $request->id_titik_kumpul;
        $data->kode_tk = $request->kode_tk;
        $data->tk_lat = $request->tk_lat;
        $data->tk_long = $request->tk_long;
        $data->nama_titik_kumpul = $request->nama_titik_kumpul;
        $data->nama_desa = $request->nama_desa;
        $data->nama_kecamatan = $request->nama_kecamatan;
        $data->nama_kabupaten = $request->nama_kabupaten;
        $data->jarak_ke_tk = $request->jarak_ke_tk;
        $data->updated_by = session('nama');
        $data->save();
        return redirect('/titikkumpul');
    }

    public function tambah()
    {
        return view('register.titikkumpul');
    }

    public function tambahproses(Request $request)
    {
        DB::table('ref_bendungan')->insert([
            'kode_tk' => $request->kode_tk,
            'tk_lat' => $request->tk_lat,
            'tk_long' => $request->tk_long,
            'nama_titik_kumpul' => $request->nama_titik_kumpul,
            'nama_desa' => $request->nama_desa,
            'nama_kecamatan' => $request->nama_kecamatan,
            'nama_kabupaten' => $request->nama_kabupaten,
            'jarak_ke_tk' => $request->jarak_ke_tk,
            'created_at' => date('Y-m-d H:i:s.U'),
            'created_by' => session('nama')
        ]);
        return redirect('/titikkumpul');
    }

    // public function hapus($id)
    // {
    //     DB::table('ref_titik_kumpul')->where('id_titik_kumpul', decrypt($id))->delete();
    //     return redirect(('ref_titik_kumpul'))->with('success', 'Data Terhapus');
    // }

    public function hapus($id)
    {
        try {
            $titikkumpul = TitikKumpulBendungan::find(decrypt($id));
            $titikkumpul->delete();
            return redirect(session('titikkumpul'))->with('success', 'Data Terhapus');
        } catch (Exception $e) {
            return redirect(session('titikkumpul'))->with('error', $e->getMessage());
        }
    }
}
