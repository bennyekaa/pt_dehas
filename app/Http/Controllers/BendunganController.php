<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\BendunganBendungan;


class BendunganController extends Controller
{
    public function index()
    {
        // mengambil data dari table bendungan
        $data['bendungan'] = DB::table('ref_bendungan')->get();
        session()->put('bendungan', url()->full());
        return view('master.bendungan', $data);
    }

    public function detailbendungan()
    {
        // mengambil data dari table bendungan
        $data['bendungan'] = BendunganBendungan::all();
        // dd($data);
        return view('beranda.detailbendungan', $data);
    }

    public function edit($id_bendungan)
    {
        $id = decrypt($id_bendungan);
        $data = BendunganBendungan::find($id);
        return view('edit.bendungan', compact(['data']));
    }

    public function prosesbendungan(Request $request)
    {
        $data = BendunganBendungan::find($request->id_bendungan);
        $data->id_bendungan = $request->id_bendungan;
        $data->nama_bendungan = $request->nama_bendungan;
        $data->lokasi_bendungan = $request->lokasi_bendungan;
        $data->nama_sungai = $request->nama_sungai;
        $data->koordinat_bendungan_x = $request->koordinat_bendungan_x;
        $data->koordinat_bendungan_y = $request->koordinat_bendungan_y;
        $data->pengelola_bendungan = $request->pengelola_bendungan;
        $data->telp_pengelola_bendungan = $request->telp_pengelola_bendungan;
        $data->alamat_pengelola_bendungan = $request->alamat_pengelola_bendungan;
        $data->type_tubuh_bendungan = $request->type_tubuh_bendungan;
        $data->panjang_puncak_tubuh_bendungan = $request->panjang_puncak_tubuh_bendungan;
        $data->tinggi_dari_sungai_tubuh_bendungan = $request->tinggi_dari_sungai_tubuh_bendungan;
        $data->tinggi_dari_fondasi_tubuh_bendungan = $request->tinggi_dari_fondasi_tubuh_bendungan;
        $data->lebar_puncak_tubuh_bendungan = $request->lebar_puncak_tubuh_bendungan;
        $data->elevasi_puncak_tubuh_bendungan = $request->elevasi_puncak_tubuh_bendungan;
        $data->daerah_tangkapan_tubuh_bendungan = $request->daerah_tangkapan_tubuh_bendungan;
        $data->tipe_bangunan_pelimpah = $request->tipe_bangunan_pelimpah;
        $data->lokasi_bangunan_pelimpah = $request->lokasi_bangunan_pelimpah;
        $data->lebar_bangunan_pelimpah = $request->lebar_bangunan_pelimpah;
        $data->elevasi_bangunan_pelimpah = $request->elevasi_bangunan_pelimpah;
        $data->debit_inflow_qin_bangunan_pelimpah = $request->debit_inflow_qin_bangunan_pelimpah;
        $data->debit_inflow_q1000_bangunan_pelimpah = $request->debit_inflow_q1000_bangunan_pelimpah;
        $data->tipe_bangunan_pengambilan = $request->tipe_bangunan_pengambilan;
        $data->lokasi_bangunan_pengambilan = $request->lokasi_bangunan_pengambilan;
        $data->saluran_hantar_bangunan_pengambilan = $request->saluran_hantar_bangunan_pengambilan;
        $data->diameter_terowongan_bangunan_pengambilan = $request->diameter_terowongan_bangunan_pengambilan;
        $data->kapasitas_max_bangunan_pengambilan = $request->kapasitas_max_bangunan_pengambilan;
        $data->elev_muka_air_waduk = $request->elev_muka_air_waduk;
        $data->kapasitas_waduk = $request->kapasitas_waduk;
        $data->luas_genangan_waduk = $request->luas_genangan_waduk;
        $data->updated_at = date('Y-m-d H:i:s.U');
        $data->updated_by = session('nama');
        $data->save();
        // return redirect('/bendungan');
        return redirect(session('bendungan'))->with('success', 'Data Berhasil Diedit');
    }

    public function tambah()
    {
        return view('register.bendungan');
    }

    public function tambahproses(Request $request)
    {
        DB::table('ref_bendungan')->insert([
            'nama_bendungan' => $request->nama_bendungan,
            'lokasi_bendungan' => $request->lokasi_bendungan,
            'nama_sungai' => $request->nama_sungai,
            'koordinat_bendungan_x' => $request->koordinat_bendungan_x,
            'koordinat_bendungan_y' => $request->koordinat_bendungan_y,
            'pengelola_bendungan' => $request->pengelola_bendungan,
            'telp_pengelola_bendungan' => $request->telp_pengelola_bendungan,
            'alamat_pengelola_bendungan' => $request->alamat_pengelola_bendungan,
            'type_tubuh_bendungan' => $request->type_tubuh_bendungan,
            'panjang_puncak_tubuh_bendungan' => $request->panjang_puncak_tubuh_bendungan,
            'tinggi_dari_sungai_tubuh_bendungan' => $request->tinggi_dari_sungai_tubuh_bendungan,
            'tinggi_dari_fondasi_tubuh_bendungan' => $request->tinggi_dari_fondasi_tubuh_bendungan,
            'lebar_puncak_tubuh_bendungan' => $request->lebar_puncak_tubuh_bendungan,
            'elevasi_puncak_tubuh_bendungan' => $request->elevasi_puncak_tubuh_bendungan,
            'daerah_tangkapan_tubuh_bendungan' => $request->daerah_tangkapan_tubuh_bendungan,
            'tipe_bangunan_pelimpah' => $request->tipe_bangunan_pelimpah,
            'lokasi_bangunan_pelimpah' => $request->lokasi_bangunan_pelimpah,
            'lebar_bangunan_pelimpah' => $request->lebar_bangunan_pelimpah,
            'elevasi_bangunan_pelimpah' => $request->elevasi_bangunan_pelimpah,
            'debit_inflow_qin_bangunan_pelimpah' => $request->debit_inflow_qin_bangunan_pelimpah,
            'debit_inflow_q1000_bangunan_pelimpah' => $request->debit_inflow_q1000_bangunan_pelimpah,
            'tipe_bangunan_pengambilan' => $request->tipe_bangunan_pengambilan,
            'lokasi_bangunan_pengambilan' => $request->lokasi_bangunan_pengambilan,
            'saluran_hantar_bangunan_pengambilan' => $request->saluran_hantar_bangunan_pengambilan,
            'diameter_terowongan_bangunan_pengambilan' => $request->diameter_terowongan_bangunan_pengambilan,
            'kapasitas_max_bangunan_pengambilan' => $request->kapasitas_max_bangunan_pengambilan,
            'elev_muka_air_waduk' => $request->elev_muka_air_waduk,
            'kapasitas_waduk' => $request->kapasitas_waduk,
            'luas_genangan_waduk' => $request->luas_genangan_waduk,
            'created_at' => date('Y-m-d H:i:s.U'),
            'created_by' => session('nama')
        ]);
        // return redirect('/bendungan');
        return redirect(session('bendungan'))->with('success', 'Data Berhasil Ditambah');
    }

    public function hapus($id)
    {
            DB::table('ref_bendungan')->where('id_bendungan', decrypt($id))->delete();
            return redirect(('/bendungan'))->with('success', 'Data Terhapus');
    }

}
