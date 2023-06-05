<?php

namespace App\Http\Controllers;

use App\Models\DataBanjir;
use App\Models\DataMukaAir;
use App\Models\Waduk;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Exception;
use App\Models\Notif;

class TransBanjir extends Controller
{
    public function index($stat)
    {
        $data['mukaair'] = DataMukaAir::where('status_role', decrypt($stat))->get();
        session()->put('banjir_mukaair', url()->full());
        // dd($data);
        return view('transaksi.mukaair.index', $data);
    }

    public function tambah()
    {
        $data['mukaair'] = Waduk::all()->sortBy('muka_air');
        return view('transaksi.mukaair.tambah', $data);
    }

    public function proses(Request $request)
    {
        // if(Str::length($request->id_waduk) > 10){
        //     dd('pilihan');
        // }else{
        //     dd('ketikan');
        // }
        if ($request->fungsi == "Tambah") {
            try {
                $mukaair = new DataMukaAir();
                $mukaair->id_waduk = $request->id_waduk;
                $mukaair->status_role = 0;
                $mukaair->aktif = 1;
                $mukaair->created_at = date('Y-m-d H:i:s.U');
                $mukaair->created_by = session('nama');
                $mukaair->save();
                return redirect(session('banjir_mukaair'))->with('success', 'Data Berhasil Ditambah');
            } catch (Exception $e) {
                return redirect(session('banjir_mukaair'))->with('error', $e->getMessage());
            }
        }
        // } else {
        //     try {
        //         $statusbocor = StatusBocor::find($request->id_status_bocor);
        //         $statusbocor->nama_status = $request->nama_status;
        //         $statusbocor->keterangan = $request->keterangan;
        //         $statusbocor->id_kategori_bocor = $request->id_kategori_bocor;
        //         $statusbocor->status = $request->status;
        //         $statusbocor->updated_at = date('Y-m-d H:i:s.U');
        //         $statusbocor->updated_by = session('nama');
        //         $statusbocor->save(); 
        //         return redirect(session('statusbocor'))->with('success', 'Data Berhasil Diedit');
        //     } catch (Exception $e) {
        //         return redirect(session('statusbocor'))->with('error', $e->getMessage());
        //     }
        // }
    }

    public function kirim($id)
    {
        try {
            $mukaair = DataMukaAir::find(decrypt($id));
            $mukaair->status_role = 5;
            $mukaair->updated_at = date('Y-m-d H:i:s.U');
            $mukaair->updated_by = session('nama');
            $mukaair->save();
            return redirect(session('banjir_mukaair'))->with('success', 'Data Terkirim Ke Balai');
        } catch (Exception $e) {
            return redirect(session('banjir_mukaair'))->with('error', $e->getMessage());
        }
    }

    public function pesan($id,$role)
    {
        $data['id_banjir'] = $id;
        $data['role'] = $role;
        return view('transaksi.mukaair.pesan',$data);
    }

    public function notif(Request $request)
    {
        try {
            $mukaair = DataMukaAir::find(decrypt($request->id_banjir));
            $mukaair->status_role = $request->role;
            $mukaair->aktif = 0;
            $mukaair->updated_at = date('Y-m-d H:i:s.U');
            $mukaair->updated_by = session('nama');
            $mukaair->save();
            $notif = new Notif();
            $notif->id_referensi = decrypt($request->id_banjir);
            $notif->role = $request->role;
            $notif->pesan = $request->pesan;
            $notif->aktif = 1;
            $notif->created_at = date('Y-m-d H:i:s.U');
            $notif->created_by = session('nama');
            $notif->save();
            return redirect(session('banjir_mukaair'))->with('success', 'Data Terkirim');
        } catch (Exception $e) {
            return redirect(session('banjir_mukaair'))->with('error', $e->getMessage());
        }
    }

    public function hapus($id)
    {
        try {
            $mukaair = DataMukaAir::find(decrypt($id));
            $mukaair->delete();
            return redirect(session('banjir_mukaair'))->with('success', 'Data Terhapus');
        } catch (Exception $e) {
            return redirect(session('banjir_mukaair'))->with('error', $e->getMessage());
        }
    }
}
