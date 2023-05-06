<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\WadukBendungan;
use Illuminate\Http\Request;

class WadukController extends Controller
{
    public function index()
    {
        // mengambil data dari table waduk
        $data['waduk'] = WadukBendungan::all();
        // $data['waduk'] = WadukBendungan::table('ref_waduk')->get();
        return view('master.waduk', $data);
    }
    // TAMBAH

    public function tambah()
    {
        return view('register.waduk');
    }

    public function tambahproses(Request $request)
    {
        DB::table('ref_waduk')->insert([
            'Batas_Atas_Muka_air' => $request->Batas_Atas_Muka_air,
            'Batas_Bawah_Muka_air' => $request->Batas_Bawah_Muka_air,
            'Muka_air' => $request->Muka_air,
            'Tinggi_air' => $request->Tinggi_air,
            'Debit_keluar' => $request->Debit_keluar,
            'status' => $request->status,
            'keterangan' => $request->keterangan,
            'created_at' => date('Y-m-d H:i:s.U'),
            'created_by' => 'Hendri'
        ]);

        return redirect('/waduk')->with('success', 'Data berhasil disimpan!');
    }
    //EDIT
    public function edit($id_waduk)
    {
        $id = decrypt($id_waduk);
        $data = WadukBendungan::find($id);
        return view('edit.waduk', compact(['data']));
    }

    public function proseswaduk(Request $request)
    {
        $data = WadukBendungan::find($request->id_waduk);
        $data->Batas_Atas_Muka_air = $request->Batas_Atas_Muka_air;
        $data->Batas_Bawah_Muka_air = $request->Batas_Bawah_Muka_air;
        $data->Muka_air = $request->Muka_air;
        $data->Tinggi_air = $request->Tinggi_air;
        $data->Debit_keluar = $request->Debit_keluar;
        $data->status = $request->status;
        $data->keterangan = $request->keterangan;
        $data->updated_by = 'Benny';
        $data->save();
        return redirect('/waduk');
    }

    // HAPUS
    public function hapus($id)
    {
        DB::table('ref_waduk')->where('id_waduk', $id)->delete();
        return redirect('/waduk');
    }
}


