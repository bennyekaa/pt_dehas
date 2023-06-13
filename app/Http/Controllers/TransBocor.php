<?php

namespace App\Http\Controllers;

use App\Models\DataBanjir;
use App\Models\KategoriBocor;
use App\Models\StatusBocor;
use App\Models\Notif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Exception;


class TransBocor extends Controller
{
    public function index($stat){
        $data['bocor'] = DataBanjir::where('id_role', decrypt($stat))->get();
        session()->put('banjir_bocor', url()->full());
        return view('transaksi.bocor.index', $data);
    }

    public function tambah()
    {
        $data['kategori'] = KategoriBocor::all()->sortBy('nama_kategori');
        return view('transaksi.bocor.tambah', $data);
    }

    public function proses(Request $request)
    {
        // dd($request->all());
        $path = Storage::putFile('/public/berkas', $request->file('data_file'));
        $bocor = new DataBanjir();
        $bocor->id_status_bocor = $request->status_bocor;
        $bocor->status_role = session('role');
        $bocor->aktif = 1;
        $bocor->keterangan = $request->keterangan;
        $bocor->nama_file = $path;
        $bocor->created_at = date('Y-m-d H:i:s.U');
        $bocor->created_by = session('nama');
        // dd($bocor);
        $bocor->save();
        return redirect(session('banjir_bocor'))->with('success', 'Data Berhasil Ditambah');
    }

    public function get_status($id)
    {
        $data = StatusBocor::where('id_kategori_bocor',$id)->get();
        return $data;
    }

    public function kirim($id)
    {
        try {
            $bocor = DataBanjir::find(decrypt($id));
            $bocor->status_role = 5;
            $bocor->updated_at = date('Y-m-d H:i:s.U');
            $bocor->updated_by = session('nama');
            $bocor->save();
            return redirect(session('banjir_bocor'))->with('success', 'Data Terkirim Ke Balai');
        } catch (Exception $e) {
            return redirect(session('banjir_bocor'))->with('error', $e->getMessage());
        }
    }

    public function pesan($id, $role)
    {
        $data['id_bocor'] = $id;
        $data['role'] = $role;
        return view('transaksi.bocor.pesan', $data);
    }

    public function notif(Request $request)
    {
        try {
            $bocor = DataBanjir::find(decrypt($request->id_bocor));
            $bocor->status_role = $request->role;
            $bocor->aktif = 0;
            $bocor->updated_at = date('Y-m-d H:i:s.U');
            $bocor->updated_by = session('nama');
            $bocor->save();
            $notif = new Notif();
            $notif->id_referensi = decrypt($request->id_bocor);
            $notif->role = $request->role;
            $notif->pesan = $request->pesan;
            $notif->aktif = 1;
            $notif->created_at = date('Y-m-d H:i:s.U');
            $notif->created_by = session('nama');
            $notif->save();
            return redirect(session('banjir_bocor'))->with('success', 'Data Terkirim');
        } catch (Exception $e) {
            return redirect(session('banjir_bocor'))->with('error', $e->getMessage());
        }
    }

    public function hapus($id)
    {
        try {
            $bocor = DataBanjir::find(decrypt($id));
            $bocor->delete();
            return redirect(session('banjir_bocor'))->with('success', 'Data Terhapus');
        } catch (Exception $e) {
            return redirect(session('banjir_bocor'))->with('error', $e->getMessage());
        }
    }

    //EDIT
    public function edit($id_bocor)
    {
        $id = decrypt($id_bocor);
        $data = DataBanjir::find($id);
        return view('transaksi.bocor.edit', compact(['bocor']));
    }

    public function prosesedit(Request $request)
    {
        $bocor = DataBanjir::find($request->id_banjir_bocor);
        $bocor->id_status_bocor = $request->status_bocor;
        $bocor->desa = $request->desa;
        $bocor->titik_kumpul = $request->titik_kumpul;
        $bocor->updated_by = session('nama');
        $bocor->save();
        return redirect(session('banjir_bocor'))->with('success', 'Data Berhasil Diedit');
    }


    public function lihat_berkas($id){
        $data['berkas'] = DataBanjir::find(decrypt($id));
        $data['url'] = Storage::url($data['berkas']->nama_file);
        $data['tipedata'] = Storage::mimeType($data['berkas']->nama_file);
        // dd($data);
        return view('transaksi.bocor.view', $data);
    }
}
