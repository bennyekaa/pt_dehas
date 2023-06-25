<?php

namespace App\Http\Controllers;

use App\Models\BendunganBendungan;
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
                $cari_status = DB::select("SELECT * FROM ref_waduk WHERE " . $request->tinggi_air . " BETWEEN batas_bawah AND batas_atas");
                $hitung_muka_air = $master_muka_air->first()->ambang + $request->tinggi_air;
                $hitung_debit = pow(($master_muka_air->first()->c * $master_muka_air->first()->lebar * $request->tinggi_air), 1.5);
                // dd($hitung_debit);
                $mukaair = new DataMukaAir();
                $mukaair->id_banjir_muka_air =  Str::uuid();
                $mukaair->muka_air = $hitung_muka_air;
                $mukaair->tinggi_air = $request->tinggi_air;
                $mukaair->debit_air = round($hitung_debit, 2);
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

    public function kirim($id, $role)
    {
        try {
            if ($role == 'BALAI') {
                $batas_normal = DB::select("SELECT * FROM ref_waduk WHERE status = 0");
                $batas_waspada1 = DB::select("SELECT * FROM ref_waduk WHERE status = 1");
                $batas_waspada2 = DB::select("SELECT * FROM ref_waduk WHERE status = 2");
                $batas_siaga = DB::select("SELECT * FROM ref_waduk WHERE status = 3");
                $batas_awas = DB::select("SELECT * FROM ref_waduk WHERE status = 4");
                $balai = Role::where('nama_role', $role)->first();
                $bendungan = BendunganBendungan::first();
                $mukaair = DataMukaAir::find(decrypt($id));
                $mukaair->id_role = $balai->id_role;
                $mukaair->updated_at = date('Y-m-d H:i:s.U');
                $mukaair->updated_by = session('nama');
                $notif = new Notif();
                $notif->id = Str::uuid();
                $notif->id_referensi = decrypt($id);
                $notif->role_muka_air = $balai->role_muka_air;
                $notif->aktif = 1;
                $notif->status = $mukaair->status;
                $status_pemda = "";
                $status_umum = "";
                if($mukaair->status == 0){
                    $status_pemda = null;
                    $status_umum = null;
                    $notif->pesan_default = $bendungan->nama_bendungan." Pada ".$mukaair->created_at." Dengan Rincian : \n1. TMA = ".$mukaair->muka_air." mdl, Waktu ".$mukaair->updated_at."\n2. Batas Normal = ".$batas_normal[0]->batas_atas+$batas_normal[0]->ambang." mdl\n3. Batas Waspada 1 = ".$batas_waspada1[0]->batas_atas+$batas_normal[0]->ambang." mdl\n4. Batas Waspada 2 = ".$batas_waspada2[0]->batas_atas+$batas_normal[0]->ambang." mdl\n5. Batas Siaga = ".$batas_siaga[0]->batas_atas+$batas_normal[0]->ambang." mdl\n6. Batas Awas = ".$batas_awas[0]->batas_atas+$batas_normal[0]->ambang." mdl\n7. Puncak Bendungan = ".$batas_awas[0]->puncak+$batas_normal[0]->ambang. " mdl\n8. Outflow ".$mukaair->debit_air." m^3/detik waktu ".$mukaair->created_at;
                    $notif->pesan_pemda = $status_pemda;
                    $notif->pesan_umum = $status_umum;
                }elseif($mukaair->status == 1){
                    $status_pemda = null;
                    $status_umum = null;
                    $notif->pesan_default = $bendungan->nama_bendungan." Pada ".$mukaair->created_at." Dengan Rincian : \n1. TMA = ".$mukaair->muka_air." mdl, Waktu ".$mukaair->updated_at."\n2. Batas Normal = ".$batas_normal[0]->batas_atas+$batas_normal[0]->ambang." mdl\n3. Batas Waspada 1 = ".$batas_waspada1[0]->batas_atas+$batas_normal[0]->ambang." mdl\n4. Batas Waspada 2 = ".$batas_waspada2[0]->batas_atas+$batas_normal[0]->ambang." mdl\n5. Batas Siaga = ".$batas_siaga[0]->batas_atas+$batas_normal[0]->ambang." mdl\n6. Batas Awas = ".$batas_awas[0]->batas_atas+$batas_normal[0]->ambang." mdl\n7. Puncak Bendungan = ".$batas_awas[0]->puncak+$batas_normal[0]->ambang. " mdl\n8. Outflow ".$mukaair->debit_air." m^3/detik waktu ".$mukaair->created_at;
                    $notif->pesan_pemda = $status_pemda;
                    $notif->pesan_umum = $status_umum;
                }elseif($mukaair->status == 2){
                    $status_pemda = $bendungan->nama_bendungan." Pada ".$mukaair->created_at." \nSTATUS WASPADA 2\ntelah muncul indikasi potensi keruntuhan bendungan,\ntetapi belum ada bahaya yang segera terjadi\nMemerlukan Pengungsian untuk wilayah ZONA HIJAU Pada Peta BAHAYA BANJIR DI HILIR ".strtoupper($bendungan->nama_bendungan);
                    $status_umum = $bendungan->nama_bendungan." Pada ".$mukaair->created_at." \nSTATUS WASPADA 2\nDi Himbau Masyarakat Di Wilayah ZONA HIJAU segera MENGUNGSI";
                    $notif->pesan_default = $bendungan->nama_bendungan." Pada ".$mukaair->created_at." Dengan Rincian : \n1. TMA = ".$mukaair->muka_air." mdl, Waktu ".$mukaair->updated_at."\n2. Batas Normal = ".$batas_normal[0]->batas_atas+$batas_normal[0]->ambang." mdl\n3. Batas Waspada 1 = ".$batas_waspada1[0]->batas_atas+$batas_normal[0]->ambang." mdl\n4. Batas Waspada 2 = ".$batas_waspada2[0]->batas_atas+$batas_normal[0]->ambang." mdl\n5. Batas Siaga = ".$batas_siaga[0]->batas_atas+$batas_normal[0]->ambang." mdl\n6. Batas Awas = ".$batas_awas[0]->batas_atas+$batas_normal[0]->ambang." mdl\n7. Puncak Bendungan = ".$batas_awas[0]->puncak+$batas_normal[0]->ambang. " mdl\n8. Outflow ".$mukaair->debit_air." m^3/detik waktu ".$mukaair->created_at;
                    $notif->pesan_pemda = $status_pemda;
                    $notif->pesan_umum = $status_umum;
                }elseif($mukaair->status == 3){
                    $status_pemda = $bendungan->nama_bendungan." Pada ".$mukaair->created_at." \nSTATUS SIAGA\ntelah Pada Kondisi ini Kemungkinan Bendungan Dapat Runtuh,\nSaat ini sedang dilakukan upaya-upaya perbaikan\nMemerlukan Pengungsian untuk wilayah Zona KUNING Pada Peta BAHAYA BANJIR DI HILLIR ".strtoupper($bendungan->nama_bendungan);
                    $status_umum = $bendungan->nama_bendungan." Pada ".$mukaair->created_at." \nSTATUS SIAGA\nDi Himbau Masyarakat Di Wilayah ZONA KUNING(ZONA EVAKUASI) segera MENGUNGSI";
                    $notif->pesan_default = $bendungan->nama_bendungan." Pada ".$mukaair->created_at." Dengan Rincian : \n1. TMA = ".$mukaair->muka_air." mdl, Waktu ".$mukaair->updated_at."\n2. Batas Normal = ".$batas_normal[0]->batas_atas+$batas_normal[0]->ambang." mdl\n3. Batas Waspada 1 = ".$batas_waspada1[0]->batas_atas+$batas_normal[0]->ambang." mdl\n4. Batas Waspada 2 = ".$batas_waspada2[0]->batas_atas+$batas_normal[0]->ambang." mdl\n5. Batas Siaga = ".$batas_siaga[0]->batas_atas+$batas_normal[0]->ambang." mdl\n6. Batas Awas = ".$batas_awas[0]->batas_atas+$batas_normal[0]->ambang." mdl\n7. Puncak Bendungan = ".$batas_awas[0]->puncak+$batas_normal[0]->ambang. " mdl\n8. Outflow ".$mukaair->debit_air." m^3/detik waktu ".$mukaair->created_at;
                    $notif->pesan_pemda = $status_pemda;
                    $notif->pesan_umum = $status_umum;
                }elseif($mukaair->status == 4){
                    $status_pemda = $bendungan->nama_bendungan." Pada ".$mukaair->created_at." \nSTATUS AWAS\ntelah Pada Kondisi ini Kemungkinan Bendungan Akan Runtuh\nMemerlukan Pengungsian untuk wilayah ZONA MERAH Pada Peta BAHAYA BANJIR DI HILIR ".strtoupper($bendungan->nama_bendungan);
                    $status_umum = $bendungan->nama_bendungan." Pada ".$mukaair->created_at." \nSTATUS AWAS\nDi Himbau Masyarakat Di Wilayah ZONA MERAH(ZONA EVAKUASI 1 dan ZONA EVAKUASI 2) segera MENGUNGSI";
                    $notif->pesan_default = $bendungan->nama_bendungan." Pada ".$mukaair->created_at." Dengan Rincian : \n1. TMA = ".$mukaair->muka_air." mdl, Waktu ".$mukaair->updated_at."\n2. Batas Normal = ".$batas_normal[0]->batas_atas+$batas_normal[0]->ambang." mdl\n3. Batas Waspada 1 = ".$batas_waspada1[0]->batas_atas+$batas_normal[0]->ambang." mdl\n4. Batas Waspada 2 = ".$batas_waspada2[0]->batas_atas+$batas_normal[0]->ambang." mdl\n5. Batas Siaga = ".$batas_siaga[0]->batas_atas+$batas_normal[0]->ambang." mdl\n6. Batas Awas = ".$batas_awas[0]->batas_atas+$batas_normal[0]->ambang." mdl\n7. Puncak Bendungan = ".$batas_awas[0]->puncak+$batas_normal[0]->ambang. " mdl\n8. Outflow ".$mukaair->debit_air." m^3/detik waktu ".$mukaair->created_at;
                    $notif->pesan_pemda = $status_pemda;
                    $notif->pesan_umum = $status_umum;
                }
                // $notif->pesan_pemda = $bendungan->nama_bendungan." Pada ".$mukaair->created_at." Dengan Rincian : \n1. TMA = ".$mukaair->muka_air." mdl, Waktu ".$mukaair->updated_at."\n2. Batas Normal = ".$batas_normal[0]->batas_atas+$batas_normal[0]->ambang." mdl\n3. Batas Waspada 1 = ".$batas_waspada1[0]->batas_atas+$batas_normal[0]->ambang." mdl\n4. Batas Waspada 2 = ".$batas_waspada2[0]->batas_atas+$batas_normal[0]->ambang." mdl\n5. Batas Siaga = ".$batas_siaga[0]->batas_atas+$batas_normal[0]->ambang." mdl\n6. Batas Awas = ".$batas_awas[0]->batas_atas+$batas_normal[0]->ambang." mdl\n7. Puncak Bendungan = ".$batas_awas[0]->puncak+$batas_normal[0]->ambang. " mdl\n8. Outflow ".$mukaair->debit_air." m^3/detik waktu ".$mukaair->created_at;
                // $notif->pesan_umum = $bendungan->nama_bendungan." Pada ".$mukaair->created_at." Dengan Rincian : \n1. TMA = ".$mukaair->muka_air." mdl, Waktu ".$mukaair->updated_at."\n2. Batas Normal = ".$batas_normal[0]->batas_atas+$batas_normal[0]->ambang." mdl\n3. Batas Waspada 1 = ".$batas_waspada1[0]->batas_atas+$batas_normal[0]->ambang." mdl\n4. Batas Waspada 2 = ".$batas_waspada2[0]->batas_atas+$batas_normal[0]->ambang." mdl\n5. Batas Siaga = ".$batas_siaga[0]->batas_atas+$batas_normal[0]->ambang." mdl\n6. Batas Awas = ".$batas_awas[0]->batas_atas+$batas_normal[0]->ambang." mdl\n7. Puncak Bendungan = ".$batas_awas[0]->puncak+$batas_normal[0]->ambang. " mdl\n8. Outflow ".$mukaair->debit_air." m^3/detik waktu ".$mukaair->created_at;
                $notif->created_at = date('Y-m-d H:i:s.U');
                $notif->created_by = session('nama');
                $mukaair->save();
                $notif->save();
                return redirect(session('banjir_mukaair'))->with('success', 'Data Terkirim Ke BALAI');
            }else
            if ($role == 'BPBD') {
                $bpbd = Role::where('nama_role', $role)->first();
                $mukaair = DataMukaAir::find(decrypt($id));
                $mukaair->id_role = $bpbd->id_role;
                $mukaair->updated_at = date('Y-m-d H:i:s.U');
                $mukaair->updated_by = session('nama');
                $notif = Notif::where('id_referensi', decrypt($id))->first();
                $notif->role_muka_air = $bpbd->role_muka_air;
                $notif->updated_at = date('Y-m-d H:i:s.U');
                $notif->updated_by = session('nama');
                $mukaair->save();
                $notif->save();
                return redirect(session('banjir_mukaair'))->with('success', 'Data Terkirim Ke BPBD');
            }else
            if ($role == 'PENDUDUK') {
                $penduduk = Role::where('nama_role', $role)->first();
                $mukaair = DataMukaAir::find(decrypt($id));
                $mukaair->id_role = $penduduk->id_role;
                $mukaair->updated_at_bpbd = date('Y-m-d H:i:s.U');
                $mukaair->updated_by_bpbd = session('nama');
                $notif = Notif::where('id_referensi', decrypt($id))->first();
                $notif->role_muka_air = $penduduk->role_muka_air;
                $notif->updated_at = date('Y-m-d H:i:s.U');
                $notif->updated_by = session('nama');
                $mukaair->save();
                $notif->save();
                return redirect(session('banjir_mukaair'))->with('success', 'Data Terkirim Ke PENDUDUK');
            }
        } catch (Exception $e) {
            return redirect(session('banjir_mukaair'))->with('error', $e->getMessage());
        }
    }

    public function pesan($id, $role)
    {
        $data['id_banjir'] = $id;
        $data['role'] = $role;
        return view('transaksi.mukaair.pesan', $data);
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
