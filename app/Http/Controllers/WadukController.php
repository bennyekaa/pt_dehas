<?php

namespace App\Http\Controllers;
<<<<<<< HEAD
use Illuminate\Support\Facades\DB;
use App\Models\WadukBendungan;
use Illuminate\Http\Request;
=======

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\WadukBendungan;
>>>>>>> e362a111a1cee91d840f7aa543303b9b6403e499

class WadukController extends Controller
{
    public function index()
    {
<<<<<<< HEAD
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
=======
        // mengambil data dari table Titik Kumpul
    //  $data['waduk'] = DB::table('ref_waduk')->get();
        $data['waduk'] = DB::table('ref_waduk')->orderBy('tinggi_air', 'asc')->get();
        return view('master.waduk', $data);
    }

>>>>>>> e362a111a1cee91d840f7aa543303b9b6403e499
    public function edit($id_waduk)
    {
        $id = decrypt($id_waduk);
        $data = WadukBendungan::find($id);
        return view('edit.waduk', compact(['data']));
    }

    public function proseswaduk(Request $request)
    {
        $data = WadukBendungan::find($request->id_waduk);
<<<<<<< HEAD
        $data->Batas_Atas_Muka_air = $request->Batas_Atas_Muka_air;
        $data->Batas_Bawah_Muka_air = $request->Batas_Bawah_Muka_air;
        $data->Muka_air = $request->Muka_air;
        $data->Tinggi_air = $request->Tinggi_air;
        $data->Debit_keluar = $request->Debit_keluar;
        $data->status = $request->status;
        $data->keterangan = $request->keterangan;
        $data->updated_by = 'Benny';
=======
        $data->id_waduk = $request->id_waduk;
        $data->muka_air = $request->muka_air;
        $data->tinggi_air = $request->tinggi_air;
        $data->debit_keluar = $request->debit_keluar;
        $data->status = $request->status;
        $data->keterangan = $request->keterangan;
        $data->updated_by = session('nama');
>>>>>>> e362a111a1cee91d840f7aa543303b9b6403e499
        $data->save();
        return redirect('/waduk');
    }

<<<<<<< HEAD
    // HAPUS
    public function hapus($id)
    {
        DB::table('ref_waduk')->where('id_waduk', $id)->delete();
        return redirect('/waduk');
    }
}


=======
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
>>>>>>> e362a111a1cee91d840f7aa543303b9b6403e499
