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
use App\Models\peta;
use App\Models\Role;
use App\Models\WadukBendungan;
use DB;

class TransBanjir extends Controller
{
    public function index($stat)
    {
        if (session('nama_role') == 'BALAI') {
            $data['mukaair'] = DataMukaAir::where('id_role', decrypt($stat))->orderBy('created_at', 'DESC')->get();
        } elseif (session('nama_role') == 'BPBD') {
            if (session('bendungan') == 1) {
                $data['mukaair'] = DataMukaAir::where('bendungan_1', 6)->orderBy('created_at', 'DESC')->get();
                // $data['mukaair'] = DataMukaAir::where('id_role', decrypt($stat))->where('bendungan_1', 6)->orderBy('created_at', 'DESC')->get();
            } else {
                $data['mukaair'] = DataMukaAir::where('bendungan_2', 6)->orderBy('created_at', 'DESC')->get();
            }
        } else {
            $data['mukaair'] = DataMukaAir::where('id_role', decrypt($stat))->where('nama_bendungan', session('lokasi'))->orderBy('created_at', 'DESC')->get();
        }
        $data['peta'] = peta::orderBy('kategori')->get();
        session()->put('banjir_mukaair', url()->full());
        session()->put('current', url()->full());
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
                if (session('lokasi') == 1) {
                    $htotal = 0;
                    $master_muka_air = WadukBendungan::all();
                    $cari_status = DB::select("SELECT * FROM ref_waduk WHERE bendungan = '1' AND " . $request->tinggi_air . " BETWEEN batas_bawah AND batas_atas");
                    $h1 = $request->tinggi_air - $cari_status[0]->ambang;
                    $htotal = ((pow($h1, 1.5)) * $cari_status[0]->c * $cari_status[0]->lebar);
                } elseif (session('lokasi') == 2) {
                    $htotal = 0;
                    $pintu1 = 0;
                    $pintu2 = 0;
                    $pintu3 = 0;
                    $master_muka_air = WadukBendungan::all();
                    $cari_status = DB::select("SELECT * FROM ref_waduk WHERE bendungan = '2' AND " . $request->tinggi_air . " BETWEEN batas_bawah AND batas_atas");
                    // dd($cari_status);
                    if (count($cari_status) > 1) {
                        $h1 = $request->tinggi_air - $cari_status[1]->ambang;
                        $h1_pintu = $request->tinggi_air - $cari_status[1]->ambang_berpintu;
                        $ambang_bebas = ((pow($h1, 1.7584)) * 45.676);
                        // $pintu1 = ((pow($h1, 1.5)) * $cari_status[0]->c_1 * $cari_status[0]->lebar_1);
                        $pintu1_1 = 3 * $cari_status[1]->pintu_1;
                        $pintu1_2 = 2 * 9.81 * $h1_pintu;
                        $pintu1_3 = sqrt($pintu1_2);
                        $pintu1_hasil = $cari_status[1]->f * $pintu1_1 * $pintu1_3;

                        $pintu2_1 = 3 * $cari_status[1]->pintu_2;
                        $pintu2_2 = 2 * 9.81 * $h1_pintu;
                        $pintu2_3 = sqrt($pintu2_2);
                        $pintu2_hasil = $cari_status[1]->f * $pintu2_1 * $pintu2_3;

                        $pintu3_1 = 3 * $cari_status[1]->pintu_3;
                        $pintu3_2 = 2 * 9.81 * $h1_pintu;
                        $pintu3_3 = sqrt($pintu1_3);
                        $pintu3_hasil = $cari_status[1]->f * $pintu3_1 * $pintu3_3;
                        // $pintu1 = ((pow(2*9.81*$h1_pintu, 0.5)) * $cari_status[0]->c_1 * $cari_status[0]->lebar_1);;
                        // $pintu2 = ($cari_status[1]->f * (3 * $cari_status[1]->pintu_2) * (2 * sqrt(9.81 * $h1_pintu)));
                        // $pintu3 = ($cari_status[1]->f * (3 * $cari_status[1]->pintu_3) * (2 * sqrt(9.81 * $h1_pintu)));
                        $total_pintu = $pintu1_hasil + $pintu2_hasil + $pintu3_hasil;
                        $htotal = $ambang_bebas + $total_pintu;
                    } else {
                        $h1 = $request->tinggi_air - $cari_status[0]->ambang;
                        $h1_pintu = $request->tinggi_air - $cari_status[0]->ambang_berpintu;
                        $ambang_bebas = ((pow($h1, 1.7584)) * 45.676);

                        $pintu1_1 = 3 * $cari_status[0]->pintu_1;
                        $pintu1_2 = 2 * 9.81 * $h1_pintu;
                        $pintu1_3 = sqrt($pintu1_2);
                        $pintu1_hasil = $cari_status[0]->f * $pintu1_1 * $pintu1_3;

                        $pintu2_1 = 3 * $cari_status[0]->pintu_2;
                        $pintu2_2 = 2 * 9.81 * $h1_pintu;
                        $pintu2_3 = sqrt($pintu2_2);
                        $pintu2_hasil = $cari_status[0]->f * $pintu2_1 * $pintu2_3;

                        $pintu3_1 = 3 * $cari_status[0]->pintu_3;
                        $pintu3_2 = 2 * 9.81 * $h1_pintu;
                        $pintu3_3 = sqrt($pintu3_2);
                        $pintu3_hasil = $cari_status[0]->f * $pintu3_1 * $pintu3_3;
                        // $pintu1 = ($cari_status[0]->f * (3 * $cari_status[0]->pintu_1) * (2 * sqrt(9.81 * $h1_pintu)));
                        // $pintu2 = ($cari_status[0]->f * (3 * $cari_status[0]->pintu_2) * (2 * sqrt(9.81 * $h1_pintu)));
                        // $pintu3 = ($cari_status[0]->f * (3 * $cari_status[0]->pintu_3) * (2 * sqrt(9.81 * $h1_pintu)));
                        $total_pintu = $pintu1_hasil + $pintu2_hasil + $pintu3_hasil;
                        $htotal = $ambang_bebas + $total_pintu;
                    }
                    // dd($pintu3_hasil);
                }
                // $h1_result = '';
                // $h2 = $request->tinggi_air-$cari_status[0]->ambang_1;
                // $h2_result = '';
                // if($h1 <= 0){
                //     $h1_result = 0;
                // }else{
                //     $h1_result = $h1;
                // }
                // if($h2 <= 0){
                //     $h2_result = 0;
                // }else{
                //     $h2_result = $h2;
                // }
                // if($h1 <= 0){
                //     $htotal = 0;
                // }else{
                //     $hitung2 = ((pow($h2_result, 1.5)) * $cari_status[0]->c_1 * $cari_status[0]->lebar_1);
                //     $htotal = $hitung1+$hitung2;
                // }
                // $hitung_muka_air = $master_muka_air->first()->ambang + $request->tinggi_air;
                // // $hitung_debit = (pow(($master_muka_air->first()->c * $master_muka_air->first()->lebar * $request->tinggi_air), 3) / 2);
                // $hitung_debit_1 = (pow(($master_muka_air->first()->c * $master_muka_air->first()->lebar * $request->tinggi_air), 3) / 2);
                // $hitung_debit_2 = (pow(($master_muka_air->first()->c_1 * $master_muka_air->first()->lebar_1 * $request->tinggi_air), 3) / 2);
                // $hitung_total = $hitung_debit_1+$hitung_debit_2;
                // dd(round($hitung_total, 2));
                $mukaair = new DataMukaAir();
                $mukaair->id_banjir_muka_air =  Str::uuid();
                // $mukaair->muka_air = $hitung_muka_air;
                $mukaair->tinggi_air = $request->tinggi_air;
                $mukaair->debit_air = round($htotal, 2);
                // $mukaair->debit_air = round($hitung_debit, 2);
                $mukaair->id_role = session('id_role');
                $mukaair->status = $cari_status[0]->status;
                $mukaair->aktif = 1;
                $mukaair->bendungan_1 = 0;
                $mukaair->bendungan_2 = 0;
                $mukaair->id_peta = '9ebfaf8539568e9389a9c0431f44836c';
                $mukaair->nama_bendungan = session('lokasi');
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
            $mukaair = DataMukaAir::find(decrypt($id));
            if ($role == 'BALAI') {
                $batas_normal = DB::select("SELECT * FROM ref_waduk WHERE status = 0");
                $batas_waspada1 = DB::select("SELECT * FROM ref_waduk WHERE status = 1");
                $batas_waspada2 = DB::select("SELECT * FROM ref_waduk WHERE status = 2");
                $batas_siaga = DB::select("SELECT * FROM ref_waduk WHERE status = 3");
                $batas_awas = DB::select("SELECT * FROM ref_waduk WHERE status = 4");
                $balai = Role::where('nama_role', $role)->first();
                // session()->put("current_id", decrypt($id));
                if ($mukaair->nama_bendungan == 1) {
                    $bendungan = BendunganBendungan::where('bendungan', 1)->first();
                    $mukaair->id_role = $balai->id_role;
                    $mukaair->bendungan_1 = 5;
                    $mukaair->bendungan_2 = 5;
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
                    if ($mukaair->status == 0) {
                        $status_pemda = $bendungan->nama_bendungan . " Pada " . $mukaair->created_at . " \nSTATUS NORMAL";
                        $status_umum = $bendungan->nama_bendungan . " Pada " . $mukaair->created_at . " \nSTATUS NORMAL";
                        $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $mukaair->created_at . " Dengan Rincian : \n1. TMA = " . $mukaair->tinggi_air . " mdl, Waktu " . $mukaair->updated_at . "\n2. Batas Normal = 151.79 mdl\n3. Batas Waspada 1 = 151.80 mdl\n4. Batas Waspada 2 = 152.60 mdl\n5. Batas Siaga = 154.00 mdl\n6. Batas Awas = 156.75 mdl\n7. Puncak Bendungan = 157.00 mdl";
                        $notif->pesan_pemda = $status_pemda;
                        $notif->pesan_umum = $status_umum;
                    } elseif ($mukaair->status == 1) {
                        $status_pemda = $bendungan->nama_bendungan . " Pada " . $mukaair->created_at . " \nSTATUS WASPADA 1";
                        $status_umum = $bendungan->nama_bendungan . " Pada " . $mukaair->created_at . " \nSTATUS WASPADA 1";
                        $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $mukaair->created_at . " Dengan Rincian : \n1. TMA = " . $mukaair->tinggi_air . " mdl, Waktu " . $mukaair->updated_at . "\n2. Batas Normal = 151.79 mdl\n3. Batas Waspada 1 = 151.80 mdl\n4. Batas Waspada 2 = 152.60 mdl\n5. Batas Siaga = 154.00 mdl\n6. Batas Awas = 156.75 mdl\n7. Puncak Bendungan = 157.00 mdl";
                        $notif->pesan_pemda = $status_pemda;
                        $notif->pesan_umum = $status_umum;
                    } elseif ($mukaair->status == 2) {
                        $status_pemda = $bendungan->nama_bendungan . " Pada " . $mukaair->created_at . " \nSTATUS WASPADA 2\ntelah muncul indikasi potensi keruntuhan bendungan,\ntetapi belum ada bahaya yang segera terjadi\nMemerlukan Pengungsian untuk wilayah ZONA HIJAU Pada Peta BAHAYA BANJIR DI HILIR " . strtoupper($bendungan->nama_bendungan);
                        $status_umum = $bendungan->nama_bendungan . " Pada " . $mukaair->created_at . " \nSTATUS WASPADA 2\nDi Himbau Masyarakat Di Wilayah ZONA HIJAU segera MENGUNGSI";
                        $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $mukaair->created_at . " Dengan Rincian : \n1. TMA = " . $mukaair->tinggi_air . " mdl, Waktu " . $mukaair->updated_at . "\n2. Batas Normal = 151.79 mdl\n3. Batas Waspada 1 = 151.80 mdl\n4. Batas Waspada 2 = 152.60 mdl\n5. Batas Siaga = 154.00 mdl\n6. Batas Awas = 156.75 mdl\n7. Puncak Bendungan = 157.00 mdl";
                        $notif->pesan_pemda = $status_pemda;
                        $notif->pesan_umum = $status_umum;
                    } elseif ($mukaair->status == 3) {
                        $status_pemda = $bendungan->nama_bendungan . " Pada " . $mukaair->created_at . " \nSTATUS SIAGA\ntelah Pada Kondisi ini Kemungkinan Bendungan Dapat Runtuh,\nSaat ini sedang dilakukan upaya-upaya perbaikan\nMemerlukan Pengungsian untuk wilayah Zona KUNING Pada Peta BAHAYA BANJIR DI HILLIR " . strtoupper($bendungan->nama_bendungan);
                        $status_umum = $bendungan->nama_bendungan . " Pada " . $mukaair->created_at . " \nSTATUS SIAGA\nDi Himbau Masyarakat Di Wilayah ZONA KUNING(PRIORITAS PENGUNGSIAN 1) segera MENGUNGSI";
                        $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $mukaair->created_at . " Dengan Rincian : \n1. TMA = " . $mukaair->tinggi_air . " mdl, Waktu " . $mukaair->updated_at . "\n2. Batas Normal = 151.79 mdl\n3. Batas Waspada 1 = 151.80 mdl\n4. Batas Waspada 2 = 152.60 mdl\n5. Batas Siaga = 154.00 mdl\n6. Batas Awas = 156.75 mdl\n7. Puncak Bendungan = 157.00 mdl";
                        $notif->pesan_pemda = $status_pemda;
                        $notif->pesan_umum = $status_umum;
                    } elseif ($mukaair->status == 4) {
                        $status_pemda = $bendungan->nama_bendungan . " Pada " . $mukaair->created_at . " \nSTATUS AWAS\ntelah Pada Kondisi ini Kemungkinan Bendungan Akan Runtuh\nMemerlukan Pengungsian untuk wilayah ZONA MERAH Pada Peta BAHAYA BANJIR DI HILIR " . strtoupper($bendungan->nama_bendungan);
                        $status_umum = $bendungan->nama_bendungan . " Pada " . $mukaair->created_at . " \nSTATUS AWAS\nDi Himbau Masyarakat Di Wilayah ZONA MERAH(PRIORITAS PENGUNGSIAN 2 dan PRIORITAS PENGUNGSIAN 1) segera MENGUNGSI";
                        $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $mukaair->created_at . " Dengan Rincian : \n1. TMA = " . $mukaair->tinggi_air . " mdl, Waktu " . $mukaair->updated_at . "\n2. Batas Normal = 151.79 mdl\n3. Batas Waspada 1 = 151.80 mdl\n4. Batas Waspada 2 = 152.60 mdl\n5. Batas Siaga = 154.00 mdl\n6. Batas Awas = 156.75 mdl\n7. Puncak Bendungan = 157.00 mdl";
                        $notif->pesan_pemda = $status_pemda;
                        $notif->pesan_umum = $status_umum;
                    }
                    // $notif->pesan_pemda = $bendungan->nama_bendungan." Pada ".$mukaair->created_at." Dengan Rincian : \n1. TMA = ".$mukaair->tinggi_air." mdl, Waktu ".$mukaair->updated_at."\n2. Batas Normal = ".$batas_normal[0]->batas_atas+$batas_normal[0]->ambang." mdl\n3. Batas Waspada 1 = ".$batas_waspada1[0]->batas_atas+$batas_normal[0]->ambang." mdl\n4. Batas Waspada 2 = ".$batas_waspada2[0]->batas_atas+$batas_normal[0]->ambang." mdl\n5. Batas Siaga = ".$batas_siaga[0]->batas_atas+$batas_normal[0]->ambang." mdl\n6. Batas Awas = ".$batas_awas[0]->batas_atas+$batas_normal[0]->ambang." mdl\n7. Puncak Bendungan = ".$batas_awas[0]->puncak+$batas_normal[0]->ambang. " mdl\n8. Outflow ".$mukaair->debit_air." m^3/detik waktu ".$mukaair->created_at;
                    // $notif->pesan_umum = $bendungan->nama_bendungan." Pada ".$mukaair->created_at." Dengan Rincian : \n1. TMA = ".$mukaair->muka_air." mdl, Waktu ".$mukaair->updated_at."\n2. Batas Normal = ".$batas_normal[0]->batas_atas+$batas_normal[0]->ambang." mdl\n3. Batas Waspada 1 = ".$batas_waspada1[0]->batas_atas+$batas_normal[0]->ambang." mdl\n4. Batas Waspada 2 = ".$batas_waspada2[0]->batas_atas+$batas_normal[0]->ambang." mdl\n5. Batas Siaga = ".$batas_siaga[0]->batas_atas+$batas_normal[0]->ambang." mdl\n6. Batas Awas = ".$batas_awas[0]->batas_atas+$batas_normal[0]->ambang." mdl\n7. Puncak Bendungan = ".$batas_awas[0]->puncak+$batas_normal[0]->ambang. " mdl\n8. Outflow ".$mukaair->debit_air." m^3/detik waktu ".$mukaair->created_at;
                    $notif->created_at = date('Y-m-d H:i:s.U');
                    $notif->created_by = session('nama');
                    $mukaair->save();
                    $notif->save();
                    return redirect(session('banjir_mukaair'))->with('success', 'Data Terkirim Ke BALAI');
                } else if ($mukaair->nama_bendungan == 2) {
                    $bendungan = BendunganBendungan::where('bendungan', 2)->first();
                    $mukaair->id_role = $balai->id_role;
                    $mukaair->bendungan_1 = 5;
                    $mukaair->bendungan_2 = 5;
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
                    if ($mukaair->status == 0) {
                        $status_pemda = $bendungan->nama_bendungan . " Pada " . $mukaair->created_at . " \nSTATUS NORMAL";
                        $status_umum = $bendungan->nama_bendungan . " Pada " . $mukaair->created_at . " \nSTATUS NORMAL";
                        $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $mukaair->created_at . " Dengan Rincian : \n1. TMA = " . $mukaair->tinggi_air . " mdl, Waktu " . $mukaair->updated_at . "\n2. Batas Normal = 151.79 mdl\n3. Batas Waspada 1 = 151.80 mdl\n4. Batas Waspada 2 = 152.60 mdl\n5. Batas Siaga = 154.00 mdl\n6. Batas Awas = 156.75 mdl\n7. Puncak Bendungan = 157.00 mdl";
                        $notif->pesan_pemda = $status_pemda;
                        $notif->pesan_umum = $status_umum;
                    } elseif ($mukaair->status == 1) {
                        $status_pemda = $bendungan->nama_bendungan . " Pada " . $mukaair->created_at . " \nSTATUS WASPADA 1";
                        $status_umum = $bendungan->nama_bendungan . " Pada " . $mukaair->created_at . " \nSTATUS WASPADA 1";
                        $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $mukaair->created_at . " Dengan Rincian : \n1. TMA = " . $mukaair->tinggi_air . " mdl, Waktu " . $mukaair->updated_at . "\n2. Batas Normal = 151.79 mdl\n3. Batas Waspada 1 = 151.80 mdl\n4. Batas Waspada 2 = 152.60 mdl\n5. Batas Siaga = 154.00 mdl\n6. Batas Awas = 156.75 mdl\n7. Puncak Bendungan = 157.00 mdl";
                        $notif->pesan_pemda = $status_pemda;
                        $notif->pesan_umum = $status_umum;
                    } elseif ($mukaair->status == 2) {
                        $status_pemda = $bendungan->nama_bendungan . " Pada " . $mukaair->created_at . " \nSTATUS WASPADA 2\ntelah muncul indikasi potensi keruntuhan bendungan,\ntetapi belum ada bahaya yang segera terjadi\nMemerlukan Pengungsian untuk wilayah ZONA HIJAU Pada Peta BAHAYA BANJIR DI HILIR " . strtoupper($bendungan->nama_bendungan);
                        $status_umum = $bendungan->nama_bendungan . " Pada " . $mukaair->created_at . " \nSTATUS WASPADA 2\nDi Himbau Masyarakat Di Wilayah ZONA HIJAU segera MENGUNGSI";
                        $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $mukaair->created_at . " Dengan Rincian : \n1. TMA = " . $mukaair->tinggi_air . " mdl, Waktu " . $mukaair->updated_at . "\n2. Batas Normal = 151.79 mdl\n3. Batas Waspada 1 = 151.80 mdl\n4. Batas Waspada 2 = 152.60 mdl\n5. Batas Siaga = 154.00 mdl\n6. Batas Awas = 156.75 mdl\n7. Puncak Bendungan = 157.00 mdl";
                        $notif->pesan_pemda = $status_pemda;
                        $notif->pesan_umum = $status_umum;
                    } elseif ($mukaair->status == 3) {
                        $status_pemda = $bendungan->nama_bendungan . " Pada " . $mukaair->created_at . " \nSTATUS SIAGA\ntelah Pada Kondisi ini Kemungkinan Bendungan Dapat Runtuh,\nSaat ini sedang dilakukan upaya-upaya perbaikan\nMemerlukan Pengungsian untuk wilayah Zona KUNING Pada Peta BAHAYA BANJIR DI HILLIR " . strtoupper($bendungan->nama_bendungan);
                        $status_umum = $bendungan->nama_bendungan . " Pada " . $mukaair->created_at . " \nSTATUS SIAGA\nDi Himbau Masyarakat Di Wilayah ZONA KUNING(PRIORITAS PENGUNGSIAN 1) segera MENGUNGSI";
                        $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $mukaair->created_at . " Dengan Rincian : \n1. TMA = " . $mukaair->tinggi_air . " mdl, Waktu " . $mukaair->updated_at . "\n2. Batas Normal = 151.79 mdl\n3. Batas Waspada 1 = 151.80 mdl\n4. Batas Waspada 2 = 152.60 mdl\n5. Batas Siaga = 154.00 mdl\n6. Batas Awas = 156.75 mdl\n7. Puncak Bendungan = 157.00 mdl";
                        $notif->pesan_pemda = $status_pemda;
                        $notif->pesan_umum = $status_umum;
                    } elseif ($mukaair->status == 4) {
                        $status_pemda = $bendungan->nama_bendungan . " Pada " . $mukaair->created_at . " \nSTATUS AWAS\ntelah Pada Kondisi ini Kemungkinan Bendungan Akan Runtuh\nMemerlukan Pengungsian untuk wilayah ZONA MERAH Pada Peta BAHAYA BANJIR DI HILIR " . strtoupper($bendungan->nama_bendungan);
                        $status_umum = $bendungan->nama_bendungan . " Pada " . $mukaair->created_at . " \nSTATUS AWAS\nDi Himbau Masyarakat Di Wilayah ZONA MERAH(PRIORITAS PENGUNGSIAN 2 dan PRIORITAS PENGUNGSIAN 1) segera MENGUNGSI";
                        $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $mukaair->created_at . " Dengan Rincian : \n1. TMA = " . $mukaair->tinggi_air . " mdl, Waktu " . $mukaair->updated_at . "\n2. Batas Normal = 151.79 mdl\n3. Batas Waspada 1 = 151.80 mdl\n4. Batas Waspada 2 = 152.60 mdl\n5. Batas Siaga = 154.00 mdl\n6. Batas Awas = 156.75 mdl\n7. Puncak Bendungan = 157.00 mdl";
                        $notif->pesan_pemda = $status_pemda;
                        $notif->pesan_umum = $status_umum;
                    }
                    // $notif->pesan_pemda = $bendungan->nama_bendungan." Pada ".$mukaair->created_at." Dengan Rincian : \n1. TMA = ".$mukaair->tinggi_air." mdl, Waktu ".$mukaair->updated_at."\n2. Batas Normal = ".$batas_normal[0]->batas_atas+$batas_normal[0]->ambang." mdl\n3. Batas Waspada 1 = ".$batas_waspada1[0]->batas_atas+$batas_normal[0]->ambang." mdl\n4. Batas Waspada 2 = ".$batas_waspada2[0]->batas_atas+$batas_normal[0]->ambang." mdl\n5. Batas Siaga = ".$batas_siaga[0]->batas_atas+$batas_normal[0]->ambang." mdl\n6. Batas Awas = ".$batas_awas[0]->batas_atas+$batas_normal[0]->ambang." mdl\n7. Puncak Bendungan = ".$batas_awas[0]->puncak+$batas_normal[0]->ambang. " mdl\n8. Outflow ".$mukaair->debit_air." m^3/detik waktu ".$mukaair->created_at;
                    // $notif->pesan_umum = $bendungan->nama_bendungan." Pada ".$mukaair->created_at." Dengan Rincian : \n1. TMA = ".$mukaair->muka_air." mdl, Waktu ".$mukaair->updated_at."\n2. Batas Normal = ".$batas_normal[0]->batas_atas+$batas_normal[0]->ambang." mdl\n3. Batas Waspada 1 = ".$batas_waspada1[0]->batas_atas+$batas_normal[0]->ambang." mdl\n4. Batas Waspada 2 = ".$batas_waspada2[0]->batas_atas+$batas_normal[0]->ambang." mdl\n5. Batas Siaga = ".$batas_siaga[0]->batas_atas+$batas_normal[0]->ambang." mdl\n6. Batas Awas = ".$batas_awas[0]->batas_atas+$batas_normal[0]->ambang." mdl\n7. Puncak Bendungan = ".$batas_awas[0]->puncak+$batas_normal[0]->ambang. " mdl\n8. Outflow ".$mukaair->debit_air." m^3/detik waktu ".$mukaair->created_at;
                    $notif->created_at = date('Y-m-d H:i:s.U');
                    $notif->created_by = session('nama');
                    $mukaair->save();
                    $notif->save();
                    return redirect(session('banjir_mukaair'))->with('success', 'Data Terkirim Ke BALAI');
                }
            } else
             if ($role == 'BPBD') {
                if ($mukaair->nama_bendungan == 1) {
                    $bpbd = Role::where('nama_role', $role)->first();
                    $mukaair = DataMukaAir::find(decrypt($id));
                    $mukaair->id_role = $bpbd->id_role;
                    $mukaair->bendungan_1 = 6;
                    $mukaair->bendungan_2 = 6;
                    $mukaair->updated_at = date('Y-m-d H:i:s.U');
                    $mukaair->updated_by = session('nama');
                    $notif = Notif::where('id_referensi', decrypt($id))->first();
                    $notif->role_muka_air = $bpbd->role_muka_air;
                    $notif->updated_at = date('Y-m-d H:i:s.U');
                    $notif->updated_by = session('nama');
                    $mukaair->save();
                    $notif->save();
                    return redirect(session('banjir_mukaair'))->with('success', 'Data Terkirim Ke BPBD');
                } elseif ($mukaair->nama_bendungan == 2) {
                    $bpbd = Role::where('nama_role', $role)->first();
                    $mukaair = DataMukaAir::find(decrypt($id));
                    $mukaair->id_role = $bpbd->id_role;
                    if (session('bendungan') == 2) {
                        $mukaair->bendungan_1 = 6;
                    } else {
                        $mukaair->bendungan_2 = 6;
                    }
                    $mukaair->updated_at = date('Y-m-d H:i:s.U');
                    $mukaair->updated_by = session('nama');
                    $notif = Notif::where('id_referensi', decrypt($id))->first();
                    $notif->role_muka_air = $bpbd->role_muka_air;
                    $notif->updated_at = date('Y-m-d H:i:s.U');
                    $notif->updated_by = session('nama');
                    $mukaair->save();
                    $notif->save();
                    return redirect(session('banjir_mukaair'))->with('success', 'Data Terkirim Ke BPBD');
                }
            } else
            if ($role == 'PENDUDUK') {
                $penduduk = Role::where('nama_role', $role)->first();
                $mukaair = DataMukaAir::find(decrypt($id));
                $mukaair->id_role = $penduduk->id_role;
                if(session('bendungan') == 1){
                    $mukaair->bendungan_1 = 4;
                }else{
                    $mukaair->bendungan_2 = 4;
                }
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
