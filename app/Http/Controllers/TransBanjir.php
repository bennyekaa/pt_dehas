<?php

namespace App\Http\Controllers;

use App\Models\DataBanjir;
use App\Models\DataMukaAir;
use App\Models\Waduk;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Exception;
use App\Models\Notif;
use App\Models\Role;
use App\Models\WadukBendungan;
use DB;

class TransBanjir extends Controller
{
    public function index($stat)
    {
        $data['mukaair'] = DataMukaAir::where('id_role', decrypt($stat))->orderBy('created_at')->get();
        session()->put('banjir_mukaair', url()->full());
        // dd($data);
        return view('transaksi.mukaair.index', $data);
    }

    public function tambah()
    {
        // $data['mukaair'] = Waduk::all()->sortBy('muka_air');
        return view('transaksi.mukaair.tambah');
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
                $master_muka_air = WadukBendungan::all();
                $cari_status = DB::select("SELECT * FROM ref_waduk WHERE ".$request->tinggi_air." BETWEEN batas_bawah AND batas_atas");
                $hitung_muka_air = $master_muka_air->first()->ambang+$request->tinggi_air;
                $hitung_debit = pow(($master_muka_air->first()->c*$master_muka_air->first()->lebar*$request->tinggi_air),1.5);
                // dd($hitung_debit);
                $mukaair = new DataMukaAir();
                $mukaair->muka_air = $hitung_muka_air;
                $mukaair->tinggi_air = $request->tinggi_air;
                $mukaair->debit_air = round($hitung_debit,2);
                $mukaair->id_role = session('id_role');
                $mukaair->status = $cari_status[0]->status;
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
            $balai = Role::where('nama_role', 'BALAI')->first();
            $mukaair = DataMukaAir::find(decrypt($id));
            $mukaair->id_role = $balai->id_role;
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
