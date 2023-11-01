<?php

namespace App\Http\Controllers;

use App\Models\DataBanjirBocor;
use App\Models\KategoriBocor;
use App\Models\StatusBocor;
use App\Models\Notif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use App\Models\BendunganBendungan;
use App\Models\peta;
use App\Models\WadukBendungan;
use Exception;
use Illuminate\Support\Str;


class TransBocor extends Controller
{

    public function index($stat)
    {
        if (session('nama_role') == 'BALAI') {
            $data['bocor'] = DataBanjirBocor::select('*', 'data_banjir_bocor.created_at AS bocor_created_at')->Join('ref_kategori_bocor', 'ref_kategori_bocor.id_kategori_bocor', '=', 'data_banjir_bocor.id_kategori_bocor')->where('data_banjir_bocor.id_role', decrypt($stat))->orderBy('data_banjir_bocor.created_at', 'DESC')->get();
        } elseif (session('nama_role') == 'BPBD') {
            if (session('bendungan') == 1) {
                $data['bocor'] = DataBanjirBocor::select('*', 'data_banjir_bocor.created_at AS bocor_created_at')->Join('ref_kategori_bocor', 'ref_kategori_bocor.id_kategori_bocor', '=', 'data_banjir_bocor.id_kategori_bocor')->where('bendungan_1', 2)->orderBy('data_banjir_bocor.created_at', 'DESC')->get();
                // $data['bocor'] = DataBanjirBocor::select('*', 'data_banjir_bocor.created_at AS bocor_created_at')->Join('ref_kategori_bocor', 'ref_kategori_bocor.id_kategori_bocor', '=', 'data_banjir_bocor.id_kategori_bocor')->where('data_banjir_bocor.id_role', decrypt($stat))->where('bendungan_1', 2)->orderBy('data_banjir_bocor.created_at', 'DESC')->get();
            } else {
                $data['bocor'] = DataBanjirBocor::select('*', 'data_banjir_bocor.created_at AS bocor_created_at')->Join('ref_kategori_bocor', 'ref_kategori_bocor.id_kategori_bocor', '=', 'data_banjir_bocor.id_kategori_bocor')->where('bendungan_2', 2)->orderBy('data_banjir_bocor.created_at', 'DESC')->get();
            }
        } else {
            $data['bocor'] = DataBanjirBocor::select('*', 'data_banjir_bocor.created_at AS bocor_created_at')->Join('ref_kategori_bocor', 'ref_kategori_bocor.id_kategori_bocor', '=', 'data_banjir_bocor.id_kategori_bocor')->where('data_banjir_bocor.id_role', decrypt($stat))->where('nama_bendungan', session('lokasi'))->orderBy('data_banjir_bocor.created_at', 'DESC')->get();
        }
        $data['peta'] = peta::all();
        session()->put('banjir_bocor', url()->full());
        session()->put('current', url()->full());
        // $data['bocor'] = DB::table('data_banjir_bocor')
        //     ->join('ref_kategori_bocor', 'ref_kategori_bocor.id_kategori_bocor', '=', 'data_banjir_bocor.id_kategori_bocor')
        //     ->get();
        // session()->put('banjir_bocor', url()->full());
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
        $tinggi_air = 0;
        if (!empty($request->didihtinggiair)) {
            $tinggi_air = $request->didihtinggiair;
        } elseif (!empty($request->gempatinggiair)) {
            $tinggi_air = $request->gempatinggiair;
        } elseif (!empty($request->badaitinggiair)) {
            $tinggi_air = $request->badaitinggiair;
        } elseif (!empty($request->longsortinggiair)) {
            $tinggi_air = $request->longsortinggiair;
        } elseif (!empty($request->lubangtinggiair)) {
            $tinggi_air = $request->lubangtinggiair;
        } elseif (!empty($request->penurunantinggiair)) {
            $tinggi_air = $request->penurunantinggiair;
        } elseif (!empty($request->pusarantinggiair)) {
            $tinggi_air = $request->pusarantinggiair;
        } elseif (!empty($request->rembesantinggiair)) {
            $tinggi_air = $request->rembesantinggiair;
        } elseif (!empty($request->retakantinggiair)) {
            $tinggi_air = $request->retakantinggiair;
        } elseif (!empty($request->pergerakantinggiair)) {
            $tinggi_air = $request->pergerakantinggiair;
        }

        $lokasi = "";
        if (!empty($request->didihlokasi)) {
            $lokasi = $request->didihlokasi;
        } elseif (!empty($request->gempalokasi)) {
            $lokasi = $request->gempalokasi;
        } elseif (!empty($request->longsorlokasi)) {
            $lokasi = $request->longsorlokasi;
        } elseif (!empty($request->badailokasi)) {
            $lokasi = $request->badailokasi;
        } elseif (!empty($request->penurunanlokasi)) {
            $lokasi = $request->penurunanlokasi;
        } elseif (!empty($request->pusaranlokasi)) {
            $lokasi = $request->pusaranlokasi;
        } elseif (!empty($request->lubanglokasi)) {
            $lokasi = $request->lubanglokasi;
        } elseif (!empty($request->rembesanlokasi)) {
            $lokasi = $request->rembesanlokasi;
        } elseif (!empty($request->retakanlokasi)) {
            $lokasi = $request->retakanlokasi;
        } elseif (!empty($request->pergerakanlokasi)) {
            $lokasi = $request->pergerakanlokasi;
        }

        $diameter = "";
        if (!empty($request->didihdiameter)) {
            $diameter = $request->didihdiameter;
        } elseif (!empty($request->lubangdiameter)) {
            $diameter = $request->lubangdiameter;
        } elseif (!empty($request->pusarandiameter)) {
            $diameter = $request->pusarandiameter;
        }

        $tinggi = "";
        if (!empty($request->penurunantinggi)) {
            $tinggi = $request->penurunantinggi;
        }

        $panjang = "";
        if (!empty($request->longsorpanjang)) {
            $panjang = $request->longsorpanjang;
        } elseif (!empty($request->penurunanpanjang)) {
            $panjang = $request->penurunanpanjang;
        } elseif (!empty($request->retakanpanjang)) {
            $panjang = $request->retakanpanjang;
        } elseif (!empty($request->pergerakanpanjang)) {
            $panjang = $request->pergerakanpanjang;
        }

        $lebar = "";
        if (!empty($request->longsorlebar)) {
            $lebar = $request->longsorlebar;
        } elseif (!empty($request->penurunanlebar)) {
            $lebar = $request->penurunanlebar;
        } elseif (!empty($request->retakanlebar)) {
            $lebar = $request->retakanlebar;
        } elseif (!empty($request->pergerakanlebar)) {
            $lebar = $request->pergerakanlebar;
        }

        $keterangan = "";
        if (!empty($request->didihketerangan)) {
            $keterangan = $request->didihketerangan;
        } elseif (!empty($request->gempaketerangan)) {
            $keterangan = $request->gempaketerangan;
        } elseif (!empty($request->badaiketerangan)) {
            $keterangan = $request->badaiketerangan;
        } elseif (!empty($request->longsorketerangan)) {
            $keterangan = $request->longsorketerangan;
        } elseif (!empty($request->lubangketerangan)) {
            $keterangan = $request->lubangketerangan;
        } elseif (!empty($request->penurunanketerangan)) {
            $keterangan = $request->penurunanketerangan;
        } elseif (!empty($request->pusaranketerangan)) {
            $keterangan = $request->pusaranketerangan;
        } elseif (!empty($request->rembesanketerangan)) {
            $keterangan = $request->rembesanketerangan;
        } elseif (!empty($request->retakanketerangan)) {
            $keterangan = $request->retakanketerangan;
        } elseif (!empty($request->pergerakanketerangan)) {
            $keterangan = $request->pergerakanketerangan;
        }

        $file_1 = null;
        // if (!empty($request->didih_data_file)) {
        //     $file_1 = Storage::putFile('/public/berkas', ($request->didih_data_file));
        // } elseif (empty($request->didih_data_file)) {
        //     $file_1 = null;
        // } elseif (!empty($request->gempa_data_file)) {
        //     $file_1 = Storage::putFile('/public/berkas', ($request->gempa_data_file));
        // } elseif (empty($request->gempa_data_file)) {
        //     $file_1 = null;
        // }

        if (!empty($request->didih_data_file)) {
            $file_1 = Storage::putFile('/public/berkas', $request->didih_data_file);
        } elseif (!empty($request->gempa_data_file)) {
            $file_1 = Storage::putFile('/public/berkas', $request->gempa_data_file);
        } elseif (!empty($request->badai_data_file)) {
            $file_1 = Storage::putFile('/public/berkas', $request->badai_data_file);
        } elseif (!empty($request->longsor_data_file)) {
            $file_1 = Storage::putFile('/public/berkas', $request->longsor_data_file);
        } elseif (!empty($request->lubang_data_file)) {
            $file_1 = Storage::putFile('/public/berkas', $request->lubang_data_file);
        } elseif (!empty($request->penurunan_data_file)) {
            $file_1 = Storage::putFile('/public/berkas', $request->penurunan_data_file);
        } elseif (!empty($request->pusaran_data_file)) {
            $file_1 = Storage::putFile('/public/berkas', $request->pusaran_data_file);
        } elseif (!empty($request->rembesan_data_file)) {
            $file_1 = Storage::putFile('/public/berkas', $request->rembesan_data_file);
        } elseif (!empty($request->retakan_data_file)) {
            $file_1 = Storage::putFile('/public/berkas', $request->retakan_data_file);
        } elseif (!empty($request->pergerakan_data_file)) {
            $file_1 = Storage::putFile('/public/berkas', $request->pergerakan_data_file);
        }

        $file_2 = null;
        if (!empty($request->didih_data_file2)) {
            $file_2 = Storage::putFile('/public/berkas', $request->didih_data_file2);
        } elseif (!empty($request->gempa_data_file2)) {
            $file_2 = Storage::putFile('/public/berkas', $request->gempa_data_file2);
        } elseif (!empty($request->badai_data_file2)) {
            $file_2 = Storage::putFile('/public/berkas', $request->badai_data_file2);
        } elseif (!empty($request->longsor_data_file2)) {
            $file_2 = Storage::putFile('/public/berkas', $request->longsor_data_file2);
        } elseif (!empty($request->lubang_data_file2)) {
            $file_2 = Storage::putFile('/public/berkas', $request->lubang_data_file2);
        } elseif (!empty($request->penurunan_data_file2)) {
            $file_2 = Storage::putFile('/public/berkas', $request->penurunan_data_file2);
        } elseif (!empty($request->pusaran_data_file2)) {
            $file_2 = Storage::putFile('/public/berkas', $request->pusaran_data_file2);
        } elseif (!empty($request->rembesan_data_file2)) {
            $file_2 = Storage::putFile('/public/berkas', $request->rembesan_data_file2);
        } elseif (!empty($request->retakan_data_file2)) {
            $file_2 = Storage::putFile('/public/berkas', $request->retakan_data_file2);
        } elseif (!empty($request->pergerakan_data_file2)) {
            $file_2 = Storage::putFile('/public/berkas', $request->pergerakan_data_file2);
        }

        $file_3 = null;
        if (!empty($request->didih_data_file3)) {
            $file_3 = Storage::putFile('/public/berkas', $request->didih_data_file3);
        } elseif (!empty($request->gempa_data_file3)) {
            $file_3 = Storage::putFile('/public/berkas', $request->gempa_data_file3);
        } elseif (!empty($request->badai_data_file3)) {
            $file_3 = Storage::putFile('/public/berkas', $request->badai_data_file3);
        } elseif (!empty($request->longsor_data_file3)) {
            $file_3 = Storage::putFile('/public/berkas', $request->longsor_data_file3);
        } elseif (!empty($request->lubang_data_file3)) {
            $file_3 = Storage::putFile('/public/berkas', $request->lubang_data_file3);
        } elseif (!empty($request->penurunan_data_file3)) {
            $file_3 = Storage::putFile('/public/berkas', $request->penurunan_data_file3);
        } elseif (!empty($request->pusaran_data_file3)) {
            $file_3 = Storage::putFile('/public/berkas', $request->pusaran_data_file3);
        } elseif (!empty($request->rembesan_data_file3)) {
            $file_3 = Storage::putFile('/public/berkas', $request->rembesan_data_file3);
        } elseif (!empty($request->retakan_data_file3)) {
            $file_3 = Storage::putFile('/public/berkas', $request->retakan_data_file3);
        } elseif (!empty($request->pergerakan_data_file3)) {
            $file_3 = Storage::putFile('/public/berkas', $request->pergerakan_data_file3);
        }

        $file_4 = null;
        if (!empty($request->didih_data_file4)) {
            $file_4 = Storage::putFile('/public/berkas', $request->didih_data_file4);
        } elseif (!empty($request->gempa_data_file4)) {
            $file_4 = Storage::putFile('/public/berkas', $request->gempa_data_file4);
        } elseif (!empty($request->badai_data_file4)) {
            $file_4 = Storage::putFile('/public/berkas', $request->badai_data_file4);
        } elseif (!empty($request->longsor_data_file4)) {
            $file_4 = Storage::putFile('/public/berkas', $request->longsor_data_file4);
        } elseif (!empty($request->lubang_data_file4)) {
            $file_4 = Storage::putFile('/public/berkas', $request->lubang_data_file4);
        } elseif (!empty($request->penurunan_data_file4)) {
            $file_4 = Storage::putFile('/public/berkas', $request->penurunan_data_file4);
        } elseif (!empty($request->pusaran_data_file4)) {
            $file_4 = Storage::putFile('/public/berkas', $request->pusaran_data_file4);
        } elseif (!empty($request->rembesan_data_file4)) {
            $file_4 = Storage::putFile('/public/berkas', $request->rembesan_data_file4);
        } elseif (!empty($request->retakan_data_file4)) {
            $file_4 = Storage::putFile('/public/berkas', $request->retakan_data_file4);
        } elseif (!empty($request->pergerakan_data_file4)) {
            $file_4 = Storage::putFile('/public/berkas', $request->pergerakan_data_file4);
        }

        $file_5 = null;
        if (!empty($request->didih_data_file5)) {
            $file_5 = Storage::putFile('/public/berkas', $request->didih_data_file5);
        } elseif (!empty($request->gempa_data_file5)) {
            $file_5 = Storage::putFile('/public/berkas', $request->gempa_data_file5);
        } elseif (!empty($request->badai_data_file5)) {
            $file_5 = Storage::putFile('/public/berkas', $request->badai_data_file5);
        } elseif (!empty($request->longsor_data_file5)) {
            $file_5 = Storage::putFile('/public/berkas', $request->longsor_data_file5);
        } elseif (!empty($request->lubang_data_file5)) {
            $file_5 = Storage::putFile('/public/berkas', $request->lubang_data_file5);
        } elseif (!empty($request->penurunan_data_file5)) {
            $file_5 = Storage::putFile('/public/berkas', $request->penurunan_data_file5);
        } elseif (!empty($request->pusaran_data_file5)) {
            $file_5 = Storage::putFile('/public/berkas', $request->pusaran_data_file5);
        } elseif (!empty($request->rembesan_data_file5)) {
            $file_5 = Storage::putFile('/public/berkas', $request->rembesan_data_file5);
        } elseif (!empty($request->retakan_data_file5)) {
            $file_5 = Storage::putFile('/public/berkas', $request->retakan_data_file5);
        } elseif (!empty($request->pergerakan_data_file5)) {
            $file_5 = Storage::putFile('/public/berkas', $request->pergerakan_data_file5);
        }

        if (session('lokasi') == 1) {
            $htotal = 0;
            $master_muka_air = WadukBendungan::all();
            $cari_status = DB::select("SELECT * FROM ref_waduk WHERE bendungan = '1' AND " . $tinggi_air . " BETWEEN batas_bawah AND batas_atas");
            if (empty($tinggi_air)) {
                return redirect(session('banjir_bocor'))->with('error', 'Tinggi Muka Air Mohon Diisi');
            } elseif (empty($cari_status)) {
                return redirect(session('banjir_bocor'))->with('error', 'Tinggi Muka Air Tidak Boleh Dibawah Batas Bawah');
            } else {
                $h1 = $tinggi_air - $cari_status[0]->ambang;
                $htotal = ((pow($h1, 1.5)) * $cari_status[0]->c * $cari_status[0]->lebar);
            }
        } elseif (session('lokasi') == 2) {
            $htotal = 0;
            $pintu1 = 0;
            $pintu2 = 0;
            $pintu3 = 0;
            $master_muka_air = WadukBendungan::all();
            $cari_status = DB::select("SELECT * FROM ref_waduk WHERE bendungan = '2' AND " . $tinggi_air . " BETWEEN batas_bawah AND batas_atas");
            if (empty($tinggi_air)) {
                return redirect(session('banjir_bocor'))->with('error', 'Tinggi Muka Air Mohon Diisi');
            } elseif (empty($cari_status)) {
                return redirect(session('banjir_bocor'))->with('error', 'Tinggi Muka Air Tidak Boleh Dibawah Batas Bawah');
            } else {
                if (count($cari_status) > 1) {
                    $h1 = $tinggi_air - $cari_status[1]->ambang;
                    $h1_pintu = $tinggi_air - $cari_status[1]->ambang_berpintu;
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
                    $h1 = $tinggi_air - $cari_status[0]->ambang;
                    $h1_pintu = $tinggi_air - $cari_status[0]->ambang_berpintu;
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
            }
            // dd($pintu3_hasil);
        }

        // $master_muka_air = WadukBendungan::all();
        // $cari_status = DB::select("SELECT * FROM ref_waduk WHERE " . $tinggi_air . " BETWEEN batas_bawah AND batas_atas");
        // if (empty($tinggi_air)) {
        //     return redirect(session('banjir_bocor'))->with('error', 'Tinggi Muka Air Mohon Diisi');
        // } elseif (empty($cari_status)) {
        //     return redirect(session('banjir_bocor'))->with('error', 'Tinggi Muka Air Tidak Boleh Dibawah Batas Bawah');
        // } else {

        //     $h1 = $tinggi_air - $cari_status[0]->ambang;
        //     $h2 = $tinggi_air - $cari_status[0]->ambang_1;
        //     $h1_result = '';
        //     $h2_result = '';
        //     if ($h1 <= 0) {
        //         $h1_result = 0;
        //     } else {
        //         $h1_result = $h1;
        //     }
        //     if ($h2 <= 0) {
        //         $h2_result = 0;
        //     } else {
        //         $h2_result = $h2;
        //     }
        //     $htotal = 0;
        //     if ($h1 <= 0) {
        //         $htotal = 0;
        //     } else {
        //         $hitung1 = ((pow($h1_result, 1.5)) * $cari_status[0]->c * $cari_status[0]->lebar);
        //         $hitung2 = ((pow($h2_result, 1.5)) * $cari_status[0]->c_1 * $cari_status[0]->lebar_1);
        //         $htotal = $hitung1 + $hitung2;
        //     }

        $bocor = new DataBanjirBocor();
        $bocor->id_banjir_bocor =  Str::uuid();
        $bocor->id_kategori_bocor = $request->kategori;
        $bocor->id_role = session('id_role');
        $bocor->aktif = 1;
        $bocor->lokasi = $lokasi;
        $bocor->tinggi_air = $tinggi_air;
        // $bocor->tinggi_MAW = $request->tinggi_MAW;
        $bocor->debit = round($htotal, 2);
        // $bocor->ukuran = $request->ukuran;
        $bocor->kekuatan = $request->kekuatan;
        $bocor->diameter = $diameter;
        $bocor->tinggi = $tinggi;
        $bocor->panjang = $panjang;
        $bocor->lebar = $lebar;
        $bocor->keterangan = $keterangan;
        $bocor->file_1 = $file_1;
        $bocor->file_2 = $file_2;
        $bocor->file_3 = $file_3;
        $bocor->file_4 = $file_4;
        $bocor->file_5 = $file_5;
        $bocor->bendungan_1 = 0;
        $bocor->bendungan_2 = 0;
        $bocor->id_peta = '9ebfaf8539568e9389a9c0431f44836c';
        $bocor->nama_bendungan = session('lokasi');
        $bocor->created_at = date('Y-m-d H:i:s.U');
        $bocor->created_by = session('id_role');
        // dd($bocor);
        $bocor->save();
        return redirect(session('banjir_bocor'))->with('success', 'Data Berhasil Ditambah');
        // }
    }

    public function get_status($id)
    {
        $data = StatusBocor::where('id_kategori_bocor', $id)->get();
        return $data;
    }

    public function kirim($id, $role)
    {
        try {
            $bocor = DataBanjirBocor::find(decrypt($id));
            if ($bocor->nama_bendungan == 1) {
                $bendungan = BendunganBendungan::where('bendungan', 1)->first();
                if ($role == 'BALAI') {
                    $balai = Role::where('nama_role', $role)->first();
                    $bocor->id_role = $balai->id_role;
                    $bocor->bendungan_1 = 5;
                    $bocor->bendungan_2 = 5;
                    $kategori = $bocor->id_kategori_bocor;
                    $nama_bocor = KategoriBocor::find($kategori);
                    // session()->put("current_id", decrypt($id));
                    $bocor->updated_at = date('Y-m-d H:i:s.U');
                    $bocor->updated_by = session('nama');
                    $notif = new Notif();
                    $notif->id = Str::uuid();
                    $notif->id_referensi = decrypt($id);
                    $notif->role_bocor = $balai->role_bocor;
                    $notif->aktif = 1;
                    if ($nama_bocor->nomor == 1) {
                        $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . "  TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA DIDIH PASIR Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at;
                    }
                    if ($nama_bocor->nomor == 2) {
                        $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . "  TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA GEMPA BUMI Pada Lokasi " . $bocor->lokasi . " Dengan Kekuatan " . $bocor->kekuatan . " SR\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at;
                    }
                    if ($nama_bocor->nomor == 3) {
                        $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . "  TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA HUJAN BADAI DENGAN INTENSITAS TINGGI Pada Lokasi " . $bocor->lokasi . "\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at;
                    }
                    if ($nama_bocor->nomor == 4) {
                        $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . "  TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LONGSOR ATAU EROSI BESAR PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at;
                    }
                    if ($nama_bocor->nomor == 5) {
                        $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . "  TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LUBANG BENAM Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at;
                    }
                    if ($nama_bocor->nomor == 6) {
                        $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . "  TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PENURUNAN ATAU SETTLEMENT Pada Lokasi " . $bocor->lokasi . " Dengan Tinggi " . $bocor->tinggi . "M, Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at;
                    }
                    if ($nama_bocor->nomor == 7) {
                        $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . "  TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PUSARAN AIR DI WADUK Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at;
                    }
                    if ($nama_bocor->nomor == 8) {
                        $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . "  TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA REMBESAN Pada Lokasi " . $bocor->lokasi . " Dengan Debit Air " . $bocor->debit . " m3/Detik\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at;
                    }
                    if ($nama_bocor->nomor == 9) {
                        $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . "  TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at;
                    }
                    if ($nama_bocor->nomor == 10) {
                        $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . "  TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN ATAU PERGERAKAN PADA STRUKTUR BETON Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at;
                    }
                    // $notif->pesan_default = "Data Baru " . $bendungan->nama_bendungan . " Pada " . $bocor->created_at;
                    // $notif->pesan_pemda = $bendungan->nama_bendungan." Pada ".$mukaair->created_at." Dengan Rincian : \n1. TMA = ".$mukaair->muka_air." mdl, Waktu ".$mukaair->updated_at."\n2. Batas Normal = ".$batas_normal[0]->batas_atas+$batas_normal[0]->ambang." mdl\n3. Batas Waspada 1 = ".$batas_waspada1[0]->batas_atas+$batas_normal[0]->ambang." mdl\n4. Batas Waspada 2 = ".$batas_waspada2[0]->batas_atas+$batas_normal[0]->ambang." mdl\n5. Batas Siaga = ".$batas_siaga[0]->batas_atas+$batas_normal[0]->ambang." mdl\n6. Batas Awas = ".$batas_awas[0]->batas_atas+$batas_normal[0]->ambang." mdl\n7. Puncak Bendungan = ".$batas_awas[0]->puncak+$batas_normal[0]->ambang. " mdl\n8. Outflow ".$mukaair->debit_air." m^3/detik waktu ".$mukaair->created_at;
                    // $notif->pesan_umum = $bendungan->nama_bendungan." Pada ".$mukaair->created_at." Dengan Rincian : \n1. TMA = ".$mukaair->muka_air." mdl, Waktu ".$mukaair->updated_at."\n2. Batas Normal = ".$batas_normal[0]->batas_atas+$batas_normal[0]->ambang." mdl\n3. Batas Waspada 1 = ".$batas_waspada1[0]->batas_atas+$batas_normal[0]->ambang." mdl\n4. Batas Waspada 2 = ".$batas_waspada2[0]->batas_atas+$batas_normal[0]->ambang." mdl\n5. Batas Siaga = ".$batas_siaga[0]->batas_atas+$batas_normal[0]->ambang." mdl\n6. Batas Awas = ".$batas_awas[0]->batas_atas+$batas_normal[0]->ambang." mdl\n7. Puncak Bendungan = ".$batas_awas[0]->puncak+$batas_normal[0]->ambang. " mdl\n8. Outflow ".$mukaair->debit_air." m^3/detik waktu ".$mukaair->created_at;
                    $notif->created_at = date('Y-m-d H:i:s.U');
                    $notif->created_by = session('nama');
                    $bocor->save();
                    $notif->save();
                    return redirect(session('banjir_bocor'))->with('success', 'Data Terkirim Ke BALAI');
                } elseif ($role == 'PENDUDUK') {
                    $penduduk = Role::where('nama_role', $role)->first();
                    $bocor = DataBanjirBocor::find(decrypt($id));
                    $bocor->id_role = $penduduk->id_role;
                    if (session('bendungan') == 1) {
                        $bocor->bendungan_1 = 4;
                    } else {
                        $bocor->bendungan_2 = 4;
                    }
                    $bocor->updated_at_bpbd = date('Y-m-d H:i:s.U');
                    $bocor->updated_by_bpbd = session('nama');
                    $notif = Notif::where('id_referensi', decrypt($id))->first();
                    $notif->role_bocor = $penduduk->role_bocor;
                    $notif->updated_at = date('Y-m-d H:i:s.U');
                    $notif->updated_by = session('nama');
                    $bocor->save();
                    $notif->save();
                    return redirect(session('banjir_bocor'))->with('success', 'Data Terkirim Ke PENDUDUK');
                }
            } else {
                $bendungan = BendunganBendungan::where('bendungan', 2)->first();
                if ($role == 'BALAI') {
                    $balai = Role::where('nama_role', $role)->first();
                    $bocor->id_role = $balai->id_role;
                    $bocor->bendungan_1 = 5;
                    $bocor->bendungan_2 = 5;
                    $kategori = $bocor->id_kategori_bocor;
                    $nama_bocor = KategoriBocor::find($kategori);
                    // session()->put("current_id", decrypt($id));
                    $bocor->updated_at = date('Y-m-d H:i:s.U');
                    $bocor->updated_by = session('nama');
                    $notif = new Notif();
                    $notif->id = Str::uuid();
                    $notif->id_referensi = decrypt($id);
                    $notif->role_bocor = $balai->role_bocor;
                    $notif->aktif = 1;
                    if ($nama_bocor->nomor == 1) {
                        $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . "  TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA DIDIH PASIR Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at;
                    }
                    if ($nama_bocor->nomor == 2) {
                        $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . "  TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA GEMPA BUMI Pada Lokasi " . $bocor->lokasi . " Dengan Kekuatan " . $bocor->kekuatan . " SR\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at;
                    }
                    if ($nama_bocor->nomor == 3) {
                        $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . "  TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA HUJAN BADAI DENGAN INTENSITAS TINGGI Pada Lokasi " . $bocor->lokasi . "\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at;
                    }
                    if ($nama_bocor->nomor == 4) {
                        $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . "  TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LONGSOR ATAU EROSI BESAR PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at;
                    }
                    if ($nama_bocor->nomor == 5) {
                        $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . "  TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LUBANG BENAM Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at;
                    }
                    if ($nama_bocor->nomor == 6) {
                        $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . "  TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PENURUNAN ATAU SETTLEMENT Pada Lokasi " . $bocor->lokasi . " Dengan Tinggi " . $bocor->tinggi . "M, Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at;
                    }
                    if ($nama_bocor->nomor == 7) {
                        $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . "  TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PUSARAN AIR DI WADUK Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at;
                    }
                    if ($nama_bocor->nomor == 8) {
                        $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . "  TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA REMBESAN Pada Lokasi " . $bocor->lokasi . " Dengan Debit Air " . $bocor->debit . " m3/Detik\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at;
                    }
                    if ($nama_bocor->nomor == 9) {
                        $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . "  TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at;
                    }
                    if ($nama_bocor->nomor == 10) {
                        $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . "  TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN ATAU PERGERAKAN PADA STRUKTUR BETON Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at;
                    }
                    // $notif->pesan_default = "Data Baru " . $bendungan->nama_bendungan . " Pada " . $bocor->created_at;
                    // $notif->pesan_pemda = $bendungan->nama_bendungan." Pada ".$mukaair->created_at." Dengan Rincian : \n1. TMA = ".$mukaair->muka_air." mdl, Waktu ".$mukaair->updated_at."\n2. Batas Normal = ".$batas_normal[0]->batas_atas+$batas_normal[0]->ambang." mdl\n3. Batas Waspada 1 = ".$batas_waspada1[0]->batas_atas+$batas_normal[0]->ambang." mdl\n4. Batas Waspada 2 = ".$batas_waspada2[0]->batas_atas+$batas_normal[0]->ambang." mdl\n5. Batas Siaga = ".$batas_siaga[0]->batas_atas+$batas_normal[0]->ambang." mdl\n6. Batas Awas = ".$batas_awas[0]->batas_atas+$batas_normal[0]->ambang." mdl\n7. Puncak Bendungan = ".$batas_awas[0]->puncak+$batas_normal[0]->ambang. " mdl\n8. Outflow ".$mukaair->debit_air." m^3/detik waktu ".$mukaair->created_at;
                    // $notif->pesan_umum = $bendungan->nama_bendungan." Pada ".$mukaair->created_at." Dengan Rincian : \n1. TMA = ".$mukaair->muka_air." mdl, Waktu ".$mukaair->updated_at."\n2. Batas Normal = ".$batas_normal[0]->batas_atas+$batas_normal[0]->ambang." mdl\n3. Batas Waspada 1 = ".$batas_waspada1[0]->batas_atas+$batas_normal[0]->ambang." mdl\n4. Batas Waspada 2 = ".$batas_waspada2[0]->batas_atas+$batas_normal[0]->ambang." mdl\n5. Batas Siaga = ".$batas_siaga[0]->batas_atas+$batas_normal[0]->ambang." mdl\n6. Batas Awas = ".$batas_awas[0]->batas_atas+$batas_normal[0]->ambang." mdl\n7. Puncak Bendungan = ".$batas_awas[0]->puncak+$batas_normal[0]->ambang. " mdl\n8. Outflow ".$mukaair->debit_air." m^3/detik waktu ".$mukaair->created_at;
                    $notif->created_at = date('Y-m-d H:i:s.U');
                    $notif->created_by = session('nama');
                    $bocor->save();
                    $notif->save();
                    return redirect(session('banjir_bocor'))->with('success', 'Data Terkirim Ke BALAI');
                } elseif ($role == 'PENDUDUK') {
                    $penduduk = Role::where('nama_role', $role)->first();
                    $bocor = DataBanjirBocor::find(decrypt($id));
                    $bocor->id_role = $penduduk->id_role;
                    if (session('bendungan') == 1) {
                        $bocor->bendungan_1 = 4;
                    } else {
                        $bocor->bendungan_2 = 4;
                    }
                    $bocor->updated_at_bpbd = date('Y-m-d H:i:s.U');
                    $bocor->updated_by_bpbd = session('nama');
                    $notif = Notif::where('id_referensi', decrypt($id))->first();
                    $notif->role_bocor = $penduduk->role_bocor;
                    $notif->updated_at = date('Y-m-d H:i:s.U');
                    $notif->updated_by = session('nama');
                    $bocor->save();
                    $notif->save();
                    return redirect(session('banjir_bocor'))->with('success', 'Data Terkirim Ke PENDUDUK');
                }
            }
        } catch (Exception $e) {
            return redirect(session('banjir_bocor'))->with('error', $e->getMessage());
        }
    }

    public function tanda($id, $status)
    {
        try {
            $bocor = DataBanjirBocor::find(decrypt($id));
            if ($bocor->nama_bendungan == 1) {
                $bendungan = BendunganBendungan::where('bendungan', 1)->first();
                $kategori = $bocor->id_kategori_bocor;
                $nama_bocor = KategoriBocor::find($kategori);
                if ($status == 1) {
                    // $lanjut = Role::where('role_bocor', 3)->first();
                    $notif = Notif::where('id_referensi', decrypt($id))->first();
                    $notif->role_bocor = 2;
                    $notif->status = $status;
                    $bocor->id_role = null;
                    $bocor->status = $status;
                    $status_pemda = "";
                    $status_umum = "";
                    if ($status == 0) {
                        $status_pemda = null;
                        $status_umum = null;
                        $notif->pesan_default = null;
                        $notif->pesan_pemda = $status_pemda;
                        $notif->pesan_umum = $status_umum;
                    } elseif ($status == 1) {
                        $status_pemda = null;
                        $status_umum = null;

                        if ($nama_bocor->nomor == 1) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA DIDIH PASIR Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 2) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA GEMPA BUMI Pada Lokasi " . $bocor->lokasi . " Dengan Kekuatan " . $bocor->kekuatan . " SR\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 3) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA HUJAN BADAI DENGAN INTENSITAS TINGGI Pada Lokasi " . $bocor->lokasi . "\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 4) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LONGSOR ATAU EROSI BESAR PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 5) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LUBANG BENAM Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 6) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PENURUNAN ATAU SETTLEMENT Pada Lokasi " . $bocor->lokasi . " Dengan Tinggi " . $bocor->tinggi . "M, Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 7) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PUSARAN AIR DI WADUK Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 8) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA REMBESAN Pada Lokasi " . $bocor->lokasi . " Dengan Debit Air " . $bocor->debit . " m3/Detik\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 9) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 10) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN ATAU PERGERAKAN PADA STRUKTUR BETON Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }

                        // $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " STATUS WASPADA 1";
                        $notif->pesan_pemda = $status_pemda;
                        $notif->pesan_umum = $status_umum;
                    } elseif ($status == 2) {
                        if ($nama_bocor->nomor == 1) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA DIDIH PASIR Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 2) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA GEMPA BUMI Pada Lokasi " . $bocor->lokasi . " Dengan Kekuatan " . $bocor->kekuatan . " SR\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 3) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA HUJAN BADAI DENGAN INTENSITAS TINGGI Pada Lokasi " . $bocor->lokasi . "\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 4) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LONGSOR ATAU EROSI BESAR PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 5) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LUBANG BENAM Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 6) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PENURUNAN ATAU SETTLEMENT Pada Lokasi " . $bocor->lokasi . " Dengan Tinggi " . $bocor->tinggi . "M, Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 7) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PUSARAN AIR DI WADUK Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 8) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA REMBESAN Pada Lokasi " . $bocor->lokasi . " Dengan Debit Air " . $bocor->debit . " m3/Detik\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 9) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 10) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN ATAU PERGERAKAN PADA STRUKTUR BETON Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        $status_pemda = null;
                        $status_pemda = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " \nSTATUS WASPADA 2\ntelah muncul indikasi potensi keruntuhan bendungan, tetapi belum ada bahaya yang segera  terjadi\nMemerlukan Pengungsian Untuk Wilayah ZONA HIJAU Pada Peta BAHAYA BANJIR DI HILIR " . strtoupper($bendungan->nama_bendungan);
                        $status_umum = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " \nSTATUS WASPADA 2\nDi Himbau MASYARAKAT Di Wilayah ZONA HIJAU segera MENGUNGSI";
                        // $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " STATUS WASPADA 2";
                        $notif->pesan_pemda = $status_pemda;
                        $notif->pesan_umum = $status_umum;
                    } elseif ($status == 3) {
                        if ($nama_bocor->nomor == 1) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA DIDIH PASIR Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 2) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA GEMPA BUMI Pada Lokasi " . $bocor->lokasi . " Dengan Kekuatan " . $bocor->kekuatan . " SR\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 3) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA HUJAN BADAI DENGAN INTENSITAS TINGGI Pada Lokasi " . $bocor->lokasi . "\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 4) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LONGSOR ATAU EROSI BESAR PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 5) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LUBANG BENAM Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 6) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PENURUNAN ATAU SETTLEMENT Pada Lokasi " . $bocor->lokasi . " Dengan Tinggi " . $bocor->tinggi . "M, Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 7) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PUSARAN AIR DI WADUK Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 8) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA REMBESAN Pada Lokasi " . $bocor->lokasi . " Dengan Debit Air " . $bocor->debit . " m3/Detik\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 9) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 10) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN ATAU PERGERAKAN PADA STRUKTUR BETON Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        $status_pemda = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " \nSTATUS SIAGA\ntelah Pada Kondisi ini Kemungkinan Bendungan Dapat Runtuh,\nSaat ini sedang dilakukan upaya-upaya perbaikan\nMemerlukan Pengungsian untuk wilayah Zona KUNING Pada Peta BAHAYA BANJIR DI HILLIR " . strtoupper($bendungan->nama_bendungan);
                        $status_umum = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " \nSTATUS SIAGA\nDi Himbau Masyarakat Di Wilayah ZONA KUNING(PRIORITAS PENGUNGSIAN 1) segera MENGUNGSI";
                        // $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . "STATUS SIAGA";
                        $notif->pesan_pemda = $status_pemda;
                        $notif->pesan_umum = $status_umum;
                    } elseif ($status == 4) {
                        if ($nama_bocor->nomor == 1) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA DIDIH PASIR Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 2) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA GEMPA BUMI Pada Lokasi " . $bocor->lokasi . " Dengan Kekuatan " . $bocor->kekuatan . " SR\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 3) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA HUJAN BADAI DENGAN INTENSITAS TINGGI Pada Lokasi " . $bocor->lokasi . "\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 4) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LONGSOR ATAU EROSI BESAR PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 5) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LUBANG BENAM Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 6) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PENURUNAN ATAU SETTLEMENT Pada Lokasi " . $bocor->lokasi . " Dengan Tinggi " . $bocor->tinggi . "M, Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 7) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PUSARAN AIR DI WADUK Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 8) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA REMBESAN Pada Lokasi " . $bocor->lokasi . " Dengan Debit Air " . $bocor->debit . " m3/Detik\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 9) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 10) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN ATAU PERGERAKAN PADA STRUKTUR BETON Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        $status_pemda = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " \nSTATUS AWAS\ntelah Pada Kondisi ini Kemungkinan Bendungan Akan Runtuh\nMemerlukan Pengungsian untuk wilayah ZONA MERAH Pada Peta BAHAYA BANJIR DI HILIR " . strtoupper($bendungan->nama_bendungan);
                        $status_umum = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " \nSTATUS AWAS\nDi Himbau Masyarakat Di Wilayah ZONA MERAH(PRIORITAS PENGUNGSIAN 2 dan PRIORITAS PENGUNGSIAN 1) segera MENGUNGSI";
                        // $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . "STATUS AWAS";
                        $notif->pesan_pemda = $status_pemda;
                        $notif->pesan_umum = $status_umum;
                    }
                    $bocor->updated_at = date('Y-m-d H:i:s.U');
                    $bocor->updated_by = session('nama');
                    $notif->role_bocor = 2;
                    if (session('bendungan') == 1) {
                        $bocor->bendungan_1 = 2;
                    } else {
                        $bocor->bendungan_2 = 2;
                    }
                    $notif->updated_at = date('Y-m-d H:i:s.U');
                    $notif->updated_by = session('nama');
                    $bocor->save();
                    $notif->save();
                    return redirect(session('banjir_bocor'))->with('success', 'Data Terkirim Ke PU PUSAT');
                } elseif ($status == 2) {
                    $bpbd = Role::where('nama_role', 'BPBD')->first();
                    $bendungan = BendunganBendungan::first();
                    $bocor = DataBanjirBocor::find(decrypt($id));
                    $notif = Notif::where('id_referensi', decrypt($id))->first();
                    $notif->role_bocor = $bpbd->role_bocor;
                    $notif->status = $status;
                    $bocor->id_role = $bpbd->id_role;
                    $bocor->status = $status;
                    $status_pemda = "";
                    $status_umum = "";
                    if ($status == 0) {
                        $status_pemda = null;
                        $status_umum = null;
                        $notif->pesan_default = null;
                        $notif->pesan_pemda = $status_pemda;
                        $notif->pesan_umum = $status_umum;
                    } elseif ($status == 1) {
                        $status_pemda = null;
                        $status_umum = null;

                        if ($nama_bocor->nomor == 1) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA DIDIH PASIR Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 2) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA GEMPA BUMI Pada Lokasi " . $bocor->lokasi . " Dengan Kekuatan " . $bocor->kekuatan . " SR\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 3) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA HUJAN BADAI DENGAN INTENSITAS TINGGI Pada Lokasi " . $bocor->lokasi . "\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 4) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LONGSOR ATAU EROSI BESAR PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 5) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LUBANG BENAM Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 6) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PENURUNAN ATAU SETTLEMENT Pada Lokasi " . $bocor->lokasi . " Dengan Tinggi " . $bocor->tinggi . "M, Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 7) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PUSARAN AIR DI WADUK Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 8) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA REMBESAN Pada Lokasi " . $bocor->lokasi . " Dengan Debit Air " . $bocor->debit . " m3/Detik\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 9) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 10) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN ATAU PERGERAKAN PADA STRUKTUR BETON Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        // $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " STATUS WASPADA 1";
                        $notif->pesan_pemda = $status_pemda;
                        $notif->pesan_umum = $status_umum;
                    } elseif ($status == 2) {
                        $status_pemda = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " \nSTATUS WASPADA 2\ntelah muncul indikasi potensi keruntuhan bendungan,\ntetapi belum ada bahaya yang segera  terjadi\nMemerlukan Pengungsian untuk wilayah ZONA HIJAU Pada Peta BAHAYA BANJIR DI HILIR " . strtoupper($bendungan->nama_bendungan);
                        $status_umum = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " \nSTATUS WASPADA 2\nDi Himbau Masyarakat Di Wilayah ZONA HIJAU segera MENGUNGSI";

                        if ($nama_bocor->nomor == 1) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA DIDIH PASIR Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 2) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA GEMPA BUMI Pada Lokasi " . $bocor->lokasi . " Dengan Kekuatan " . $bocor->kekuatan . " SR\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 3) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA HUJAN BADAI DENGAN INTENSITAS TINGGI Pada Lokasi " . $bocor->lokasi . "\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 4) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LONGSOR ATAU EROSI BESAR PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 5) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LUBANG BENAM Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 6) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PENURUNAN ATAU SETTLEMENT Pada Lokasi " . $bocor->lokasi . " Dengan Tinggi " . $bocor->tinggi . "M, Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 7) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PUSARAN AIR DI WADUK Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 8) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA REMBESAN Pada Lokasi " . $bocor->lokasi . " Dengan Debit Air " . $bocor->debit . " m3/Detik\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 9) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 10) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN ATAU PERGERAKAN PADA STRUKTUR BETON Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        // $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " STATUS WASPADA 2";
                        $notif->pesan_pemda = $status_pemda;
                        $notif->pesan_umum = $status_umum;
                    } elseif ($status == 3) {
                        $status_pemda = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " \nSTATUS SIAGA\ntelah Pada Kondisi ini Kemungkinan Bendungan Dapat Runtuh,\nSaat ini sedang dilakukan upaya-upaya perbaikan\nMemerlukan Pengungsian untuk wilayah Zona KUNING Pada Peta BAHAYA BANJIR DI HILLIR " . strtoupper($bendungan->nama_bendungan);
                        $status_umum = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " \nSTATUS SIAGA\nDi Himbau Masyarakat Di Wilayah ZONA KUNING(PENGUNGSIAN PRIORITAS 1) segera MENGUNGSI";

                        if ($nama_bocor->nomor == 1) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA DIDIH PASIR Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 2) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA GEMPA BUMI Pada Lokasi " . $bocor->lokasi . " Dengan Kekuatan " . $bocor->kekuatan . " SR\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 3) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA HUJAN BADAI DENGAN INTENSITAS TINGGI Pada Lokasi " . $bocor->lokasi . "\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 4) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LONGSOR ATAU EROSI BESAR PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 5) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LUBANG BENAM Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 6) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PENURUNAN ATAU SETTLEMENT Pada Lokasi " . $bocor->lokasi . " Dengan Tinggi " . $bocor->tinggi . "M, Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 7) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PUSARAN AIR DI WADUK Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 8) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA REMBESAN Pada Lokasi " . $bocor->lokasi . " Dengan Debit Air " . $bocor->debit . " m3/Detik\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 9) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 10) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN ATAU PERGERAKAN PADA STRUKTUR BETON Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        // $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . "STATUS SIAGA";
                        $notif->pesan_pemda = $status_pemda;
                        $notif->pesan_umum = $status_umum;
                    } elseif ($status == 4) {
                        $status_pemda = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " \nSTATUS AWAS\ntelah Pada Kondisi ini Kemungkinan Bendungan Akan Runtuh\nMemerlukan Pengungsian untuk wilayah ZONA MERAH Pada Peta BAHAYA BANJIR DI HILIR " . strtoupper($bendungan->nama_bendungan);
                        $status_umum = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " \nSTATUS AWAS\nDi Himbau Masyarakat Di Wilayah ZONA MERAH(PRIORITAS PENGUNGSIAN 2 dan PRIORITAS PENGUNGSIAN 1) segera MENGUNGSI";

                        if ($nama_bocor->nomor == 1) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA DIDIH PASIR Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 2) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA GEMPA BUMI Pada Lokasi " . $bocor->lokasi . " Dengan Kekuatan " . $bocor->kekuatan . " SR\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 3) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA HUJAN BADAI DENGAN INTENSITAS TINGGI Pada Lokasi " . $bocor->lokasi . "\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 4) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LONGSOR ATAU EROSI BESAR PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 5) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LUBANG BENAM Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 6) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PENURUNAN ATAU SETTLEMENT Pada Lokasi " . $bocor->lokasi . " Dengan Tinggi " . $bocor->tinggi . "M, Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 7) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PUSARAN AIR DI WADUK Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 8) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA REMBESAN Pada Lokasi " . $bocor->lokasi . " Dengan Debit Air " . $bocor->debit . " m3/Detik\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 9) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 10) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN ATAU PERGERAKAN PADA STRUKTUR BETON Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        // $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . "STATUS AWAS";
                        $notif->pesan_pemda = $status_pemda;
                        $notif->pesan_umum = $status_umum;
                    }
                    $bocor->updated_at = date('Y-m-d H:i:s.U');
                    $bocor->updated_by = session('nama');
                    if (session('bendungan') == 1) {
                        $bocor->bendungan_1 = 2;
                    } else {
                        $bocor->bendungan_2 = 2;
                    }
                    $notif->role_bocor = $bpbd->role_bocor;
                    $notif->updated_at = date('Y-m-d H:i:s.U');
                    $notif->updated_by = session('nama');
                    $bocor->save();
                    $notif->save();
                    return redirect(session('banjir_bocor'))->with('success', 'Data Terkirim Ke BPBD');
                } elseif ($status == 3) {
                    $bpbd = Role::where('nama_role', 'BPBD')->first();
                    $bendungan = BendunganBendungan::first();
                    $bocor = DataBanjirBocor::find(decrypt($id));
                    $notif = Notif::where('id_referensi', decrypt($id))->first();
                    $notif->role_bocor = $bpbd->role_bocor;
                    $notif->status = $status;
                    $bocor->id_role = $bpbd->id_role;
                    $bocor->status = $status;
                    $status_pemda = "";
                    $status_umum = "";
                    if ($status == 0) {
                        $status_pemda = null;
                        $status_umum = null;
                        $notif->pesan_default = null;
                        $notif->pesan_pemda = $status_pemda;
                        $notif->pesan_umum = $status_umum;
                    } elseif ($status == 1) {
                        $status_pemda = null;
                        $status_umum = null;

                        if ($nama_bocor->nomor == 1) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA DIDIH PASIR Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 2) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA GEMPA BUMI Pada Lokasi " . $bocor->lokasi . " Dengan Kekuatan " . $bocor->kekuatan . " SR\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 3) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA HUJAN BADAI DENGAN INTENSITAS TINGGI Pada Lokasi " . $bocor->lokasi . "\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 4) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LONGSOR ATAU EROSI BESAR PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 5) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LUBANG BENAM Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 6) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PENURUNAN ATAU SETTLEMENT Pada Lokasi " . $bocor->lokasi . " Dengan Tinggi " . $bocor->tinggi . "M, Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 7) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PUSARAN AIR DI WADUK Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 8) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA REMBESAN Pada Lokasi " . $bocor->lokasi . " Dengan Debit Air " . $bocor->debit . " m3/Detik\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 9) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 10) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN ATAU PERGERAKAN PADA STRUKTUR BETON Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        // $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " STATUS WASPADA 1";
                        $notif->pesan_pemda = $status_pemda;
                        $notif->pesan_umum = $status_umum;
                    } elseif ($status == 2) {
                        $status_pemda = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " \nSTATUS WASPADA 2\ntelah muncul indikasi potensi keruntuhan bendungan,\ntetapi belum ada bahaya yang segera  terjadi\nMemerlukan Pengungsian untuk wilayah ZONA HIJAU Pada Peta BAHAYA BANJIR DI HILIR " . strtoupper($bendungan->nama_bendungan);
                        $status_umum = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " \nSTATUS WASPADA 2\nDi Himbau Masyarakat Di Wilayah ZONA HIJAU segera MENGUNGSI";
                        if ($nama_bocor->nomor == 1) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA DIDIH PASIR Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 2) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA GEMPA BUMI Pada Lokasi " . $bocor->lokasi . " Dengan Kekuatan " . $bocor->kekuatan . " SR\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 3) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA HUJAN BADAI DENGAN INTENSITAS TINGGI Pada Lokasi " . $bocor->lokasi . "\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 4) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LONGSOR ATAU EROSI BESAR PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 5) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LUBANG BENAM Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 6) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PENURUNAN ATAU SETTLEMENT Pada Lokasi " . $bocor->lokasi . " Dengan Tinggi " . $bocor->tinggi . "M, Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 7) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PUSARAN AIR DI WADUK Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 8) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA REMBESAN Pada Lokasi " . $bocor->lokasi . " Dengan Debit Air " . $bocor->debit . " m3/Detik\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 9) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 10) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN ATAU PERGERAKAN PADA STRUKTUR BETON Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        // $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " STATUS WASPADA 2";
                        $notif->pesan_pemda = $status_pemda;
                        $notif->pesan_umum = $status_umum;
                    } elseif ($status == 3) {
                        $status_pemda = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " \nSTATUS SIAGA\ntelah Pada Kondisi ini Kemungkinan Bendungan Dapat Runtuh,\nSaat ini sedang dilakukan upaya-upaya perbaikan\nMemerlukan Pengungsian untuk wilayah Zona KUNING Pada Peta BAHAYA BANJIR DI HILLIR " . strtoupper($bendungan->nama_bendungan);
                        $status_umum = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " \nSTATUS SIAGA\nDi Himbau Masyarakat Di Wilayah ZONA KUNING(PRIORITAS PENGUNGSIAN 1) segera MENGUNGSI";
                        if ($nama_bocor->nomor == 1) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA DIDIH PASIR Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 2) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA GEMPA BUMI Pada Lokasi " . $bocor->lokasi . " Dengan Kekuatan " . $bocor->kekuatan . " SR\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 3) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA HUJAN BADAI DENGAN INTENSITAS TINGGI Pada Lokasi " . $bocor->lokasi . "\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 4) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LONGSOR ATAU EROSI BESAR PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 5) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LUBANG BENAM Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 6) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PENURUNAN ATAU SETTLEMENT Pada Lokasi " . $bocor->lokasi . " Dengan Tinggi " . $bocor->tinggi . "M, Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 7) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PUSARAN AIR DI WADUK Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 8) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA REMBESAN Pada Lokasi " . $bocor->lokasi . " Dengan Debit Air " . $bocor->debit . " m3/Detik\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 9) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 10) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN ATAU PERGERAKAN PADA STRUKTUR BETON Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        // $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . "STATUS SIAGA";
                        $notif->pesan_pemda = $status_pemda;
                        $notif->pesan_umum = $status_umum;
                    } elseif ($status == 4) {
                        $status_pemda = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " \nSTATUS AWAS\ntelah Pada Kondisi ini Kemungkinan Bendungan Akan Runtuh\nMemerlukan Pengungsian untuk wilayah ZONA MERAH Pada Peta BAHAYA BANJIR DI HILIR " . strtoupper($bendungan->nama_bendungan);
                        $status_umum = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " \nSTATUS AWAS\nDi Himbau Masyarakat Di Wilayah ZONA MERAH(PRIORITAS PENGUNGSIAN 2 dan PRIORITAS PENGUNGSIAN 1) segera MENGUNGSI";
                        if ($nama_bocor->nomor == 1) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA DIDIH PASIR Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 2) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA GEMPA BUMI Pada Lokasi " . $bocor->lokasi . " Dengan Kekuatan " . $bocor->kekuatan . " SR\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 3) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA HUJAN BADAI DENGAN INTENSITAS TINGGI Pada Lokasi " . $bocor->lokasi . "\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 4) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LONGSOR ATAU EROSI BESAR PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 5) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LUBANG BENAM Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 6) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PENURUNAN ATAU SETTLEMENT Pada Lokasi " . $bocor->lokasi . " Dengan Tinggi " . $bocor->tinggi . "M, Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 7) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PUSARAN AIR DI WADUK Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 8) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA REMBESAN Pada Lokasi " . $bocor->lokasi . " Dengan Debit Air " . $bocor->debit . " m3/Detik\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 9) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 10) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN ATAU PERGERAKAN PADA STRUKTUR BETON Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        // $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . "STATUS AWAS";
                        $notif->pesan_pemda = $status_pemda;
                        $notif->pesan_umum = $status_umum;
                    }
                    $bocor->updated_at = date('Y-m-d H:i:s.U');
                    $bocor->updated_by = session('nama');
                    if (session('bendungan') == 1) {
                        $bocor->bendungan_1 = 2;
                    } else {
                        $bocor->bendungan_2 = 2;
                    }
                    $notif->role_bocor = $bpbd->role_bocor;
                    $notif->updated_at = date('Y-m-d H:i:s.U');
                    $notif->updated_by = session('nama');
                    $bocor->save();
                    $notif->save();
                    return redirect(session('banjir_bocor'))->with('success', 'Data Terkirim Ke BPBD');
                } elseif ($status == 4) {
                    $bpbd = Role::where('nama_role', 'BPBD')->first();
                    $bendungan = BendunganBendungan::first();
                    $bocor = DataBanjirBocor::find(decrypt($id));
                    $notif = Notif::where('id_referensi', decrypt($id))->first();
                    $notif->role_bocor = $bpbd->role_bocor;
                    $notif->status = $status;
                    $bocor->id_role = $bpbd->id_role;
                    $bocor->status = $status;
                    $status_pemda = "";
                    $status_umum = "";
                    if ($status == 0) {
                        $status_pemda = null;
                        $status_umum = null;
                        $notif->pesan_default = null;
                        $notif->pesan_pemda = $status_pemda;
                        $notif->pesan_umum = $status_umum;
                    } elseif ($status == 1) {
                        $status_pemda = null;
                        $status_umum = null;
                        if ($nama_bocor->nomor == 1) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA DIDIH PASIR Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 2) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA GEMPA BUMI Pada Lokasi " . $bocor->lokasi . " Dengan Kekuatan " . $bocor->kekuatan . " SR\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 3) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA HUJAN BADAI DENGAN INTENSITAS TINGGI Pada Lokasi " . $bocor->lokasi . "\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 4) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LONGSOR ATAU EROSI BESAR PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 5) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LUBANG BENAM Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 6) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PENURUNAN ATAU SETTLEMENT Pada Lokasi " . $bocor->lokasi . " Dengan Tinggi " . $bocor->tinggi . "M, Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 7) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PUSARAN AIR DI WADUK Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 8) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA REMBESAN Pada Lokasi " . $bocor->lokasi . " Dengan Debit Air " . $bocor->debit . " m3/Detik\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 9) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 10) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN ATAU PERGERAKAN PADA STRUKTUR BETON Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        // $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " STATUS WASPADA 1";
                        $notif->pesan_pemda = $status_pemda;
                        $notif->pesan_umum = $status_umum;
                    } elseif ($status == 2) {
                        $status_pemda = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " \nSTATUS WASPADA 2\ntelah muncul indikasi potensi keruntuhan bendungan,\ntetapi belum ada bahaya yang segera  terjadi\nMemerlukan Pengungsian untuk wilayah ZONA HIJAU Pada Peta BAHAYA BANJIR DI HILIR " . strtoupper($bendungan->nama_bendungan);
                        $status_umum = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " \nSTATUS WASPADA 2\nDi Himbau Masyarakat Di Wilayah ZONA HIJAU segera MENGUNGSI";
                        if ($nama_bocor->nomor == 1) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA DIDIH PASIR Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 2) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA GEMPA BUMI Pada Lokasi " . $bocor->lokasi . " Dengan Kekuatan " . $bocor->kekuatan . " SR\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 3) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA HUJAN BADAI DENGAN INTENSITAS TINGGI Pada Lokasi " . $bocor->lokasi . "\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 4) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LONGSOR ATAU EROSI BESAR PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 5) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LUBANG BENAM Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 6) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PENURUNAN ATAU SETTLEMENT Pada Lokasi " . $bocor->lokasi . " Dengan Tinggi " . $bocor->tinggi . "M, Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 7) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PUSARAN AIR DI WADUK Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 8) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA REMBESAN Pada Lokasi " . $bocor->lokasi . " Dengan Debit Air " . $bocor->debit . " m3/Detik\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 9) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 10) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN ATAU PERGERAKAN PADA STRUKTUR BETON Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        // $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " STATUS WASPADA 2";
                        $notif->pesan_pemda = $status_pemda;
                        $notif->pesan_umum = $status_umum;
                    } elseif ($status == 3) {
                        $status_pemda = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " \nSTATUS SIAGA\ntelah Pada Kondisi ini Kemungkinan Bendungan Dapat Runtuh,\nSaat ini sedang dilakukan upaya-upaya perbaikan\nMemerlukan Pengungsian untuk wilayah Zona KUNING Pada Peta BAHAYA BANJIR DI HILLIR " . strtoupper($bendungan->nama_bendungan);
                        $status_umum = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " \nSTATUS SIAGA\nDi Himbau Masyarakat Di Wilayah ZONA KUNING(PRIORITAS PENGUNGSIAN 1) segera MENGUNGSI";
                        if ($nama_bocor->nomor == 1) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA DIDIH PASIR Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 2) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA GEMPA BUMI Pada Lokasi " . $bocor->lokasi . " Dengan Kekuatan " . $bocor->kekuatan . " SR\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 3) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA HUJAN BADAI DENGAN INTENSITAS TINGGI Pada Lokasi " . $bocor->lokasi . "\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 4) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LONGSOR ATAU EROSI BESAR PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 5) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LUBANG BENAM Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 6) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PENURUNAN ATAU SETTLEMENT Pada Lokasi " . $bocor->lokasi . " Dengan Tinggi " . $bocor->tinggi . "M, Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 7) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PUSARAN AIR DI WADUK Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 8) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA REMBESAN Pada Lokasi " . $bocor->lokasi . " Dengan Debit Air " . $bocor->debit . " m3/Detik\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 9) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 10) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN ATAU PERGERAKAN PADA STRUKTUR BETON Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        // $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . "STATUS SIAGA";
                        $notif->pesan_pemda = $status_pemda;
                        $notif->pesan_umum = $status_umum;
                    } elseif ($status == 4) {
                        $status_pemda = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " \nSTATUS AWAS\ntelah Pada Kondisi ini Kemungkinan Bendungan Akan Runtuh\nMemerlukan Pengungsian untuk wilayah ZONA MERAH Pada Peta BAHAYA BANJIR DI HILIR " . strtoupper($bendungan->nama_bendungan);
                        $status_umum = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " \nSTATUS AWAS\nDi Himbau Masyarakat Di Wilayah ZONA MERAH(PRIORITAS PENGUNGSIAN 2 dan PRIORITAS PENGUNGSIAN 1) segera MENGUNGSI";
                        if ($nama_bocor->nomor == 1) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA DIDIH PASIR Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 2) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA GEMPA BUMI Pada Lokasi " . $bocor->lokasi . " Dengan Kekuatan " . $bocor->kekuatan . " SR\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 3) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA HUJAN BADAI DENGAN INTENSITAS TINGGI Pada Lokasi " . $bocor->lokasi . "\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 4) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LONGSOR ATAU EROSI BESAR PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 5) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LUBANG BENAM Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 6) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PENURUNAN ATAU SETTLEMENT Pada Lokasi " . $bocor->lokasi . " Dengan Tinggi " . $bocor->tinggi . "M, Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 7) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PUSARAN AIR DI WADUK Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 8) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA REMBESAN Pada Lokasi " . $bocor->lokasi . " Dengan Debit Air " . $bocor->debit . " m3/Detik\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 9) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 10) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN ATAU PERGERAKAN PADA STRUKTUR BETON Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        // $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . "STATUS AWAS";
                        $notif->pesan_pemda = $status_pemda;
                        $notif->pesan_umum = $status_umum;
                    }
                    $bocor->updated_at = date('Y-m-d H:i:s.U');
                    $bocor->updated_by = session('nama');
                    if (session('bendungan') == 1) {
                        $bocor->bendungan_1 = 2;
                    } else {
                        $bocor->bendungan_2 = 2;
                    }
                    $notif->role_bocor = $bpbd->role_bocor;
                    $notif->updated_at = date('Y-m-d H:i:s.U');
                    $notif->updated_by = session('nama');
                    $bocor->save();
                    $notif->save();
                    return redirect(session('banjir_bocor'))->with('success', 'Data Terkirim Ke BPBD');
                }
            } else {
                $bendungan = BendunganBendungan::where('bendungan', 2)->first();
                $kategori = $bocor->id_kategori_bocor;
                $nama_bocor = KategoriBocor::find($kategori);
                if ($status == 1) {
                    // $lanjut = Role::where('role_bocor', 3)->first();
                    $notif = Notif::where('id_referensi', decrypt($id))->first();
                    $notif->role_bocor = 2;
                    $notif->status = $status;
                    $bocor->id_role = null;
                    $bocor->status = $status;
                    $status_pemda = "";
                    $status_umum = "";
                    if ($status == 0) {
                        $status_pemda = null;
                        $status_umum = null;
                        $notif->pesan_default = null;
                        $notif->pesan_pemda = $status_pemda;
                        $notif->pesan_umum = $status_umum;
                    } elseif ($status == 1) {
                        $status_pemda = null;
                        $status_umum = null;

                        if ($nama_bocor->nomor == 1) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA DIDIH PASIR Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 2) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA GEMPA BUMI Pada Lokasi " . $bocor->lokasi . " Dengan Kekuatan " . $bocor->kekuatan . " SR\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 3) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA HUJAN BADAI DENGAN INTENSITAS TINGGI Pada Lokasi " . $bocor->lokasi . "\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 4) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LONGSOR ATAU EROSI BESAR PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 5) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LUBANG BENAM Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 6) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PENURUNAN ATAU SETTLEMENT Pada Lokasi " . $bocor->lokasi . " Dengan Tinggi " . $bocor->tinggi . "M, Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 7) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PUSARAN AIR DI WADUK Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 8) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA REMBESAN Pada Lokasi " . $bocor->lokasi . " Dengan Debit Air " . $bocor->debit . " m3/Detik\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 9) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 10) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN ATAU PERGERAKAN PADA STRUKTUR BETON Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }

                        // $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " STATUS WASPADA 1";
                        $notif->pesan_pemda = $status_pemda;
                        $notif->pesan_umum = $status_umum;
                    } elseif ($status == 2) {
                        if ($nama_bocor->nomor == 1) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA DIDIH PASIR Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 2) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA GEMPA BUMI Pada Lokasi " . $bocor->lokasi . " Dengan Kekuatan " . $bocor->kekuatan . " SR\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 3) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA HUJAN BADAI DENGAN INTENSITAS TINGGI Pada Lokasi " . $bocor->lokasi . "\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 4) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LONGSOR ATAU EROSI BESAR PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 5) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LUBANG BENAM Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 6) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PENURUNAN ATAU SETTLEMENT Pada Lokasi " . $bocor->lokasi . " Dengan Tinggi " . $bocor->tinggi . "M, Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 7) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PUSARAN AIR DI WADUK Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 8) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA REMBESAN Pada Lokasi " . $bocor->lokasi . " Dengan Debit Air " . $bocor->debit . " m3/Detik\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 9) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 10) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN ATAU PERGERAKAN PADA STRUKTUR BETON Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        $status_pemda = null;
                        $status_pemda = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " \nSTATUS WASPADA 2\ntelah muncul indikasi potensi keruntuhan bendungan, tetapi belum ada bahaya yang segera  terjadi\nMemerlukan Pengungsian Untuk Wilayah ZONA HIJAU Pada Peta BAHAYA BANJIR DI HILIR " . strtoupper($bendungan->nama_bendungan);
                        $status_umum = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " \nSTATUS WASPADA 2\nDi Himbau MASYARAKAT Di Wilayah ZONA HIJAU segera MENGUNGSI";
                        // $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " STATUS WASPADA 2";
                        $notif->pesan_pemda = $status_pemda;
                        $notif->pesan_umum = $status_umum;
                    } elseif ($status == 3) {
                        if ($nama_bocor->nomor == 1) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA DIDIH PASIR Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 2) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA GEMPA BUMI Pada Lokasi " . $bocor->lokasi . " Dengan Kekuatan " . $bocor->kekuatan . " SR\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 3) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA HUJAN BADAI DENGAN INTENSITAS TINGGI Pada Lokasi " . $bocor->lokasi . "\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 4) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LONGSOR ATAU EROSI BESAR PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 5) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LUBANG BENAM Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 6) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PENURUNAN ATAU SETTLEMENT Pada Lokasi " . $bocor->lokasi . " Dengan Tinggi " . $bocor->tinggi . "M, Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 7) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PUSARAN AIR DI WADUK Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 8) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA REMBESAN Pada Lokasi " . $bocor->lokasi . " Dengan Debit Air " . $bocor->debit . " m3/Detik\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 9) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 10) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN ATAU PERGERAKAN PADA STRUKTUR BETON Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        $status_pemda = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " \nSTATUS SIAGA\ntelah Pada Kondisi ini Kemungkinan Bendungan Dapat Runtuh,\nSaat ini sedang dilakukan upaya-upaya perbaikan\nMemerlukan Pengungsian untuk wilayah Zona KUNING Pada Peta BAHAYA BANJIR DI HILLIR " . strtoupper($bendungan->nama_bendungan);
                        $status_umum = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " \nSTATUS SIAGA\nDi Himbau Masyarakat Di Wilayah ZONA KUNING(PRIORITAS PENGUNGSIAN 1) segera MENGUNGSI";
                        // $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . "STATUS SIAGA";
                        $notif->pesan_pemda = $status_pemda;
                        $notif->pesan_umum = $status_umum;
                    } elseif ($status == 4) {
                        if ($nama_bocor->nomor == 1) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA DIDIH PASIR Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 2) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA GEMPA BUMI Pada Lokasi " . $bocor->lokasi . " Dengan Kekuatan " . $bocor->kekuatan . " SR\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 3) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA HUJAN BADAI DENGAN INTENSITAS TINGGI Pada Lokasi " . $bocor->lokasi . "\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 4) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LONGSOR ATAU EROSI BESAR PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 5) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LUBANG BENAM Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 6) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PENURUNAN ATAU SETTLEMENT Pada Lokasi " . $bocor->lokasi . " Dengan Tinggi " . $bocor->tinggi . "M, Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 7) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PUSARAN AIR DI WADUK Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 8) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA REMBESAN Pada Lokasi " . $bocor->lokasi . " Dengan Debit Air " . $bocor->debit . " m3/Detik\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 9) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 10) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN ATAU PERGERAKAN PADA STRUKTUR BETON Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        $status_pemda = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " \nSTATUS AWAS\ntelah Pada Kondisi ini Kemungkinan Bendungan Akan Runtuh\nMemerlukan Pengungsian untuk wilayah ZONA MERAH Pada Peta BAHAYA BANJIR DI HILIR " . strtoupper($bendungan->nama_bendungan);
                        $status_umum = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " \nSTATUS AWAS\nDi Himbau Masyarakat Di Wilayah ZONA MERAH(PRIORITAS PENGUNGSIAN 2 dan PRIORITAS PENGUNGSIAN 1) segera MENGUNGSI";
                        // $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . "STATUS AWAS";
                        $notif->pesan_pemda = $status_pemda;
                        $notif->pesan_umum = $status_umum;
                    }
                    $bocor->updated_at = date('Y-m-d H:i:s.U');
                    $bocor->updated_by = session('nama');
                    if (session('bendungan') == 1) {
                        $bocor->bendungan_1 = 2;
                    } else {
                        $bocor->bendungan_2 = 2;
                    }
                    $notif->role_bocor = 2;
                    $notif->updated_at = date('Y-m-d H:i:s.U');
                    $notif->updated_by = session('nama');
                    $bocor->save();
                    $notif->save();
                    return redirect(session('banjir_bocor'))->with('success', 'Data Terkirim Ke PU PUSAT');
                } elseif ($status == 2) {
                    $bpbd = Role::where('nama_role', 'BPBD')->first();
                    $bendungan = BendunganBendungan::first();
                    $bocor = DataBanjirBocor::find(decrypt($id));
                    $notif = Notif::where('id_referensi', decrypt($id))->first();
                    $notif->role_bocor = $bpbd->role_bocor;
                    $notif->status = $status;
                    $bocor->id_role = $bpbd->id_role;
                    $bocor->status = $status;
                    $status_pemda = "";
                    $status_umum = "";
                    if ($status == 0) {
                        $status_pemda = null;
                        $status_umum = null;
                        $notif->pesan_default = null;
                        $notif->pesan_pemda = $status_pemda;
                        $notif->pesan_umum = $status_umum;
                    } elseif ($status == 1) {
                        $status_pemda = null;
                        $status_umum = null;

                        if ($nama_bocor->nomor == 1) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA DIDIH PASIR Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 2) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA GEMPA BUMI Pada Lokasi " . $bocor->lokasi . " Dengan Kekuatan " . $bocor->kekuatan . " SR\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 3) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA HUJAN BADAI DENGAN INTENSITAS TINGGI Pada Lokasi " . $bocor->lokasi . "\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 4) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LONGSOR ATAU EROSI BESAR PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 5) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LUBANG BENAM Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 6) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PENURUNAN ATAU SETTLEMENT Pada Lokasi " . $bocor->lokasi . " Dengan Tinggi " . $bocor->tinggi . "M, Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 7) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PUSARAN AIR DI WADUK Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 8) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA REMBESAN Pada Lokasi " . $bocor->lokasi . " Dengan Debit Air " . $bocor->debit . " m3/Detik\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 9) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 10) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN ATAU PERGERAKAN PADA STRUKTUR BETON Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        // $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " STATUS WASPADA 1";
                        $notif->pesan_pemda = $status_pemda;
                        $notif->pesan_umum = $status_umum;
                    } elseif ($status == 2) {
                        $status_pemda = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " \nSTATUS WASPADA 2\ntelah muncul indikasi potensi keruntuhan bendungan,\ntetapi belum ada bahaya yang segera  terjadi\nMemerlukan Pengungsian untuk wilayah ZONA HIJAU Pada Peta BAHAYA BANJIR DI HILIR " . strtoupper($bendungan->nama_bendungan);
                        $status_umum = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " \nSTATUS WASPADA 2\nDi Himbau Masyarakat Di Wilayah ZONA HIJAU segera MENGUNGSI";

                        if ($nama_bocor->nomor == 1) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA DIDIH PASIR Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 2) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA GEMPA BUMI Pada Lokasi " . $bocor->lokasi . " Dengan Kekuatan " . $bocor->kekuatan . " SR\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 3) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA HUJAN BADAI DENGAN INTENSITAS TINGGI Pada Lokasi " . $bocor->lokasi . "\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 4) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LONGSOR ATAU EROSI BESAR PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 5) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LUBANG BENAM Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 6) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PENURUNAN ATAU SETTLEMENT Pada Lokasi " . $bocor->lokasi . " Dengan Tinggi " . $bocor->tinggi . "M, Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 7) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PUSARAN AIR DI WADUK Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 8) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA REMBESAN Pada Lokasi " . $bocor->lokasi . " Dengan Debit Air " . $bocor->debit . " m3/Detik\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 9) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 10) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN ATAU PERGERAKAN PADA STRUKTUR BETON Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        // $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " STATUS WASPADA 2";
                        $notif->pesan_pemda = $status_pemda;
                        $notif->pesan_umum = $status_umum;
                    } elseif ($status == 3) {
                        $status_pemda = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " \nSTATUS SIAGA\ntelah Pada Kondisi ini Kemungkinan Bendungan Dapat Runtuh,\nSaat ini sedang dilakukan upaya-upaya perbaikan\nMemerlukan Pengungsian untuk wilayah Zona KUNING Pada Peta BAHAYA BANJIR DI HILLIR " . strtoupper($bendungan->nama_bendungan);
                        $status_umum = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " \nSTATUS SIAGA\nDi Himbau Masyarakat Di Wilayah ZONA KUNING(PENGUNGSIAN PRIORITAS 1) segera MENGUNGSI";

                        if ($nama_bocor->nomor == 1) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA DIDIH PASIR Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 2) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA GEMPA BUMI Pada Lokasi " . $bocor->lokasi . " Dengan Kekuatan " . $bocor->kekuatan . " SR\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 3) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA HUJAN BADAI DENGAN INTENSITAS TINGGI Pada Lokasi " . $bocor->lokasi . "\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 4) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LONGSOR ATAU EROSI BESAR PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 5) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LUBANG BENAM Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 6) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PENURUNAN ATAU SETTLEMENT Pada Lokasi " . $bocor->lokasi . " Dengan Tinggi " . $bocor->tinggi . "M, Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 7) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PUSARAN AIR DI WADUK Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 8) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA REMBESAN Pada Lokasi " . $bocor->lokasi . " Dengan Debit Air " . $bocor->debit . " m3/Detik\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 9) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 10) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN ATAU PERGERAKAN PADA STRUKTUR BETON Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        // $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . "STATUS SIAGA";
                        $notif->pesan_pemda = $status_pemda;
                        $notif->pesan_umum = $status_umum;
                    } elseif ($status == 4) {
                        $status_pemda = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " \nSTATUS AWAS\ntelah Pada Kondisi ini Kemungkinan Bendungan Akan Runtuh\nMemerlukan Pengungsian untuk wilayah ZONA MERAH Pada Peta BAHAYA BANJIR DI HILIR " . strtoupper($bendungan->nama_bendungan);
                        $status_umum = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " \nSTATUS AWAS\nDi Himbau Masyarakat Di Wilayah ZONA MERAH(PRIORITAS PENGUNGSIAN 2 dan PRIORITAS PENGUNGSIAN 1) segera MENGUNGSI";

                        if ($nama_bocor->nomor == 1) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA DIDIH PASIR Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 2) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA GEMPA BUMI Pada Lokasi " . $bocor->lokasi . " Dengan Kekuatan " . $bocor->kekuatan . " SR\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 3) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA HUJAN BADAI DENGAN INTENSITAS TINGGI Pada Lokasi " . $bocor->lokasi . "\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 4) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LONGSOR ATAU EROSI BESAR PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 5) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LUBANG BENAM Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 6) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PENURUNAN ATAU SETTLEMENT Pada Lokasi " . $bocor->lokasi . " Dengan Tinggi " . $bocor->tinggi . "M, Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 7) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PUSARAN AIR DI WADUK Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 8) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA REMBESAN Pada Lokasi " . $bocor->lokasi . " Dengan Debit Air " . $bocor->debit . " m3/Detik\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 9) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 10) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN ATAU PERGERAKAN PADA STRUKTUR BETON Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        // $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . "STATUS AWAS";
                        $notif->pesan_pemda = $status_pemda;
                        $notif->pesan_umum = $status_umum;
                    }
                    $bocor->updated_at = date('Y-m-d H:i:s.U');
                    $bocor->updated_by = session('nama');
                    if (session('bendungan') == 1) {
                        $bocor->bendungan_1 = 2;
                    } else {
                        $bocor->bendungan_2 = 2;
                    }
                    $notif->role_bocor = $bpbd->role_bocor;
                    $notif->updated_at = date('Y-m-d H:i:s.U');
                    $notif->updated_by = session('nama');
                    $bocor->save();
                    $notif->save();
                    return redirect(session('banjir_bocor'))->with('success', 'Data Terkirim Ke BPBD');
                } elseif ($status == 3) {
                    $bpbd = Role::where('nama_role', 'BPBD')->first();
                    $bendungan = BendunganBendungan::first();
                    $bocor = DataBanjirBocor::find(decrypt($id));
                    $notif = Notif::where('id_referensi', decrypt($id))->first();
                    $notif->role_bocor = $bpbd->role_bocor;
                    $notif->status = $status;
                    $bocor->id_role = $bpbd->id_role;
                    $bocor->status = $status;
                    $status_pemda = "";
                    $status_umum = "";
                    if ($status == 0) {
                        $status_pemda = null;
                        $status_umum = null;
                        $notif->pesan_default = null;
                        $notif->pesan_pemda = $status_pemda;
                        $notif->pesan_umum = $status_umum;
                    } elseif ($status == 1) {
                        $status_pemda = null;
                        $status_umum = null;

                        if ($nama_bocor->nomor == 1) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA DIDIH PASIR Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 2) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA GEMPA BUMI Pada Lokasi " . $bocor->lokasi . " Dengan Kekuatan " . $bocor->kekuatan . " SR\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 3) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA HUJAN BADAI DENGAN INTENSITAS TINGGI Pada Lokasi " . $bocor->lokasi . "\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 4) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LONGSOR ATAU EROSI BESAR PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 5) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LUBANG BENAM Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 6) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PENURUNAN ATAU SETTLEMENT Pada Lokasi " . $bocor->lokasi . " Dengan Tinggi " . $bocor->tinggi . "M, Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 7) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PUSARAN AIR DI WADUK Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 8) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA REMBESAN Pada Lokasi " . $bocor->lokasi . " Dengan Debit Air " . $bocor->debit . " m3/Detik\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 9) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 10) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN ATAU PERGERAKAN PADA STRUKTUR BETON Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        // $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " STATUS WASPADA 1";
                        $notif->pesan_pemda = $status_pemda;
                        $notif->pesan_umum = $status_umum;
                    } elseif ($status == 2) {
                        $status_pemda = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " \nSTATUS WASPADA 2\ntelah muncul indikasi potensi keruntuhan bendungan,\ntetapi belum ada bahaya yang segera  terjadi\nMemerlukan Pengungsian untuk wilayah ZONA HIJAU Pada Peta BAHAYA BANJIR DI HILIR " . strtoupper($bendungan->nama_bendungan);
                        $status_umum = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " \nSTATUS WASPADA 2\nDi Himbau Masyarakat Di Wilayah ZONA HIJAU segera MENGUNGSI";
                        if ($nama_bocor->nomor == 1) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA DIDIH PASIR Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 2) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA GEMPA BUMI Pada Lokasi " . $bocor->lokasi . " Dengan Kekuatan " . $bocor->kekuatan . " SR\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 3) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA HUJAN BADAI DENGAN INTENSITAS TINGGI Pada Lokasi " . $bocor->lokasi . "\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 4) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LONGSOR ATAU EROSI BESAR PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 5) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LUBANG BENAM Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 6) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PENURUNAN ATAU SETTLEMENT Pada Lokasi " . $bocor->lokasi . " Dengan Tinggi " . $bocor->tinggi . "M, Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 7) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PUSARAN AIR DI WADUK Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 8) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA REMBESAN Pada Lokasi " . $bocor->lokasi . " Dengan Debit Air " . $bocor->debit . " m3/Detik\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 9) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 10) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN ATAU PERGERAKAN PADA STRUKTUR BETON Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        // $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " STATUS WASPADA 2";
                        $notif->pesan_pemda = $status_pemda;
                        $notif->pesan_umum = $status_umum;
                    } elseif ($status == 3) {
                        $status_pemda = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " \nSTATUS SIAGA\ntelah Pada Kondisi ini Kemungkinan Bendungan Dapat Runtuh,\nSaat ini sedang dilakukan upaya-upaya perbaikan\nMemerlukan Pengungsian untuk wilayah Zona KUNING Pada Peta BAHAYA BANJIR DI HILLIR " . strtoupper($bendungan->nama_bendungan);
                        $status_umum = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " \nSTATUS SIAGA\nDi Himbau Masyarakat Di Wilayah ZONA KUNING(PRIORITAS PENGUNGSIAN 1) segera MENGUNGSI";
                        if ($nama_bocor->nomor == 1) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA DIDIH PASIR Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 2) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA GEMPA BUMI Pada Lokasi " . $bocor->lokasi . " Dengan Kekuatan " . $bocor->kekuatan . " SR\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 3) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA HUJAN BADAI DENGAN INTENSITAS TINGGI Pada Lokasi " . $bocor->lokasi . "\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 4) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LONGSOR ATAU EROSI BESAR PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 5) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LUBANG BENAM Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 6) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PENURUNAN ATAU SETTLEMENT Pada Lokasi " . $bocor->lokasi . " Dengan Tinggi " . $bocor->tinggi . "M, Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 7) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PUSARAN AIR DI WADUK Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 8) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA REMBESAN Pada Lokasi " . $bocor->lokasi . " Dengan Debit Air " . $bocor->debit . " m3/Detik\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 9) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 10) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN ATAU PERGERAKAN PADA STRUKTUR BETON Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        // $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . "STATUS SIAGA";
                        $notif->pesan_pemda = $status_pemda;
                        $notif->pesan_umum = $status_umum;
                    } elseif ($status == 4) {
                        $status_pemda = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " \nSTATUS AWAS\ntelah Pada Kondisi ini Kemungkinan Bendungan Akan Runtuh\nMemerlukan Pengungsian untuk wilayah ZONA MERAH Pada Peta BAHAYA BANJIR DI HILIR " . strtoupper($bendungan->nama_bendungan);
                        $status_umum = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " \nSTATUS AWAS\nDi Himbau Masyarakat Di Wilayah ZONA MERAH(PRIORITAS PENGUNGSIAN 2 dan PRIORITAS PENGUNGSIAN 1) segera MENGUNGSI";
                        if ($nama_bocor->nomor == 1) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA DIDIH PASIR Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 2) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA GEMPA BUMI Pada Lokasi " . $bocor->lokasi . " Dengan Kekuatan " . $bocor->kekuatan . " SR\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 3) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA HUJAN BADAI DENGAN INTENSITAS TINGGI Pada Lokasi " . $bocor->lokasi . "\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 4) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LONGSOR ATAU EROSI BESAR PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 5) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LUBANG BENAM Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 6) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PENURUNAN ATAU SETTLEMENT Pada Lokasi " . $bocor->lokasi . " Dengan Tinggi " . $bocor->tinggi . "M, Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 7) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PUSARAN AIR DI WADUK Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 8) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA REMBESAN Pada Lokasi " . $bocor->lokasi . " Dengan Debit Air " . $bocor->debit . " m3/Detik\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 9) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 10) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN ATAU PERGERAKAN PADA STRUKTUR BETON Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        // $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . "STATUS AWAS";
                        $notif->pesan_pemda = $status_pemda;
                        $notif->pesan_umum = $status_umum;
                    }
                    $bocor->updated_at = date('Y-m-d H:i:s.U');
                    $bocor->updated_by = session('nama');
                    if (session('bendungan') == 1) {
                        $bocor->bendungan_1 = 2;
                    } else {
                        $bocor->bendungan_2 = 2;
                    }
                    $notif->role_bocor = $bpbd->role_bocor;
                    $notif->updated_at = date('Y-m-d H:i:s.U');
                    $notif->updated_by = session('nama');
                    $bocor->save();
                    $notif->save();
                    return redirect(session('banjir_bocor'))->with('success', 'Data Terkirim Ke BPBD');
                } elseif ($status == 4) {
                    $bpbd = Role::where('nama_role', 'BPBD')->first();
                    $bendungan = BendunganBendungan::first();
                    $bocor = DataBanjirBocor::find(decrypt($id));
                    $notif = Notif::where('id_referensi', decrypt($id))->first();
                    $notif->role_bocor = $bpbd->role_bocor;
                    $notif->status = $status;
                    $bocor->id_role = $bpbd->id_role;
                    $bocor->status = $status;
                    $status_pemda = "";
                    $status_umum = "";
                    if ($status == 0) {
                        $status_pemda = null;
                        $status_umum = null;
                        $notif->pesan_default = null;
                        $notif->pesan_pemda = $status_pemda;
                        $notif->pesan_umum = $status_umum;
                    } elseif ($status == 1) {
                        $status_pemda = null;
                        $status_umum = null;
                        if ($nama_bocor->nomor == 1) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA DIDIH PASIR Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 2) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA GEMPA BUMI Pada Lokasi " . $bocor->lokasi . " Dengan Kekuatan " . $bocor->kekuatan . " SR\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 3) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA HUJAN BADAI DENGAN INTENSITAS TINGGI Pada Lokasi " . $bocor->lokasi . "\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 4) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LONGSOR ATAU EROSI BESAR PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 5) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LUBANG BENAM Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 6) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PENURUNAN ATAU SETTLEMENT Pada Lokasi " . $bocor->lokasi . " Dengan Tinggi " . $bocor->tinggi . "M, Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 7) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PUSARAN AIR DI WADUK Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 8) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA REMBESAN Pada Lokasi " . $bocor->lokasi . " Dengan Debit Air " . $bocor->debit . " m3/Detik\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 9) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        if ($nama_bocor->nomor == 10) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN ATAU PERGERAKAN PADA STRUKTUR BETON Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 1";
                        }
                        // $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " STATUS WASPADA 1";
                        $notif->pesan_pemda = $status_pemda;
                        $notif->pesan_umum = $status_umum;
                    } elseif ($status == 2) {
                        $status_pemda = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " \nSTATUS WASPADA 2\ntelah muncul indikasi potensi keruntuhan bendungan,\ntetapi belum ada bahaya yang segera  terjadi\nMemerlukan Pengungsian untuk wilayah ZONA HIJAU Pada Peta BAHAYA BANJIR DI HILIR " . strtoupper($bendungan->nama_bendungan);
                        $status_umum = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " \nSTATUS WASPADA 2\nDi Himbau Masyarakat Di Wilayah ZONA HIJAU segera MENGUNGSI";
                        if ($nama_bocor->nomor == 1) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA DIDIH PASIR Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 2) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA GEMPA BUMI Pada Lokasi " . $bocor->lokasi . " Dengan Kekuatan " . $bocor->kekuatan . " SR\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 3) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA HUJAN BADAI DENGAN INTENSITAS TINGGI Pada Lokasi " . $bocor->lokasi . "\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 4) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LONGSOR ATAU EROSI BESAR PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 5) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LUBANG BENAM Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 6) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PENURUNAN ATAU SETTLEMENT Pada Lokasi " . $bocor->lokasi . " Dengan Tinggi " . $bocor->tinggi . "M, Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 7) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PUSARAN AIR DI WADUK Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 8) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA REMBESAN Pada Lokasi " . $bocor->lokasi . " Dengan Debit Air " . $bocor->debit . " m3/Detik\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 9) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        if ($nama_bocor->nomor == 10) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN ATAU PERGERAKAN PADA STRUKTUR BETON Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS WASPADA 2";
                        }
                        // $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " STATUS WASPADA 2";
                        $notif->pesan_pemda = $status_pemda;
                        $notif->pesan_umum = $status_umum;
                    } elseif ($status == 3) {
                        $status_pemda = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " \nSTATUS SIAGA\ntelah Pada Kondisi ini Kemungkinan Bendungan Dapat Runtuh,\nSaat ini sedang dilakukan upaya-upaya perbaikan\nMemerlukan Pengungsian untuk wilayah Zona KUNING Pada Peta BAHAYA BANJIR DI HILLIR " . strtoupper($bendungan->nama_bendungan);
                        $status_umum = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " \nSTATUS SIAGA\nDi Himbau Masyarakat Di Wilayah ZONA KUNING(PRIORITAS PENGUNGSIAN 1) segera MENGUNGSI";
                        if ($nama_bocor->nomor == 1) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA DIDIH PASIR Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 2) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA GEMPA BUMI Pada Lokasi " . $bocor->lokasi . " Dengan Kekuatan " . $bocor->kekuatan . " SR\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 3) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA HUJAN BADAI DENGAN INTENSITAS TINGGI Pada Lokasi " . $bocor->lokasi . "\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 4) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LONGSOR ATAU EROSI BESAR PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 5) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LUBANG BENAM Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 6) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PENURUNAN ATAU SETTLEMENT Pada Lokasi " . $bocor->lokasi . " Dengan Tinggi " . $bocor->tinggi . "M, Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 7) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PUSARAN AIR DI WADUK Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 8) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA REMBESAN Pada Lokasi " . $bocor->lokasi . " Dengan Debit Air " . $bocor->debit . " m3/Detik\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 9) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        if ($nama_bocor->nomor == 10) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN ATAU PERGERAKAN PADA STRUKTUR BETON Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS SIAGA";
                        }
                        // $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . "STATUS SIAGA";
                        $notif->pesan_pemda = $status_pemda;
                        $notif->pesan_umum = $status_umum;
                    } elseif ($status == 4) {
                        $status_pemda = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " \nSTATUS AWAS\ntelah Pada Kondisi ini Kemungkinan Bendungan Akan Runtuh\nMemerlukan Pengungsian untuk wilayah ZONA MERAH Pada Peta BAHAYA BANJIR DI HILIR " . strtoupper($bendungan->nama_bendungan);
                        $status_umum = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . " \nSTATUS AWAS\nDi Himbau Masyarakat Di Wilayah ZONA MERAH(PRIORITAS PENGUNGSIAN 2 dan PRIORITAS PENGUNGSIAN 1) segera MENGUNGSI";
                        if ($nama_bocor->nomor == 1) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA DIDIH PASIR Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 2) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA GEMPA BUMI Pada Lokasi " . $bocor->lokasi . " Dengan Kekuatan " . $bocor->kekuatan . " SR\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 3) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA HUJAN BADAI DENGAN INTENSITAS TINGGI Pada Lokasi " . $bocor->lokasi . "\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 4) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LONGSOR ATAU EROSI BESAR PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 5) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA LUBANG BENAM Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 6) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PENURUNAN ATAU SETTLEMENT Pada Lokasi " . $bocor->lokasi . " Dengan Tinggi " . $bocor->tinggi . "M, Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 7) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA PUSARAN AIR DI WADUK Pada Lokasi " . $bocor->lokasi . " Dengan Diameter " . $bocor->diameter . " M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 8) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA REMBESAN Pada Lokasi " . $bocor->lokasi . " Dengan Debit Air " . $bocor->debit . " m3/Detik\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 9) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN PADA TUBUH BENDUNGAN Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        if ($nama_bocor->nomor == 10) {
                            $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->updated_at . " TERJADI INDIKASI MASALAH Dengan Rincian:\nADANYA RETAKAN ATAU PERGERAKAN PADA STRUKTUR BETON Pada Lokasi " . $bocor->lokasi . " Dengan Panjang " . $bocor->panjang . " M dan Lebar " . $bocor->lebar . "M\nTMA = " . $bocor->tinggi_air . " mdpl Waktu Pencatatan " . $bocor->created_at . " DENGAN STATUS AWAS";
                        }
                        // $notif->pesan_default = $bendungan->nama_bendungan . " Pada " . $bocor->created_at . "STATUS AWAS";
                        $notif->pesan_pemda = $status_pemda;
                        $notif->pesan_umum = $status_umum;
                    }
                    $bocor->updated_at = date('Y-m-d H:i:s.U');
                    $bocor->updated_by = session('nama');
                    if (session('bendungan') == 1) {
                        $bocor->bendungan_1 = 2;
                    } else {
                        $bocor->bendungan_2 = 2;
                    }
                    $notif->role_bocor = $bpbd->role_bocor;
                    $notif->updated_at = date('Y-m-d H:i:s.U');
                    $notif->updated_by = session('nama');
                    $bocor->save();
                    $notif->save();
                    return redirect(session('banjir_bocor'))->with('success', 'Data Terkirim Ke BPBD');
                }
            }
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
            $bocor = DataBanjirBocor::find(decrypt($request->id_bocor));
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
            $bocor = DataBanjirBocor::find(decrypt($id));
            $bocor->delete();
            return redirect(session('banjir_bocor'))->with('success', 'Data Terhapus');
        } catch (Exception $e) {
            return redirect(session('banjir_bocor'))->with('error', $e->getMessage());
        }
    }

    //EDIT
    // public function edit($id_bocor)
    // {
    //     $id = decrypt($id_bocor);
    //     $data = DataBanjirBocor::find($id);
    //     return view('transaksi.bocor.edit', compact(['bocor']));
    // }

    // public function prosesedit(Request $request)
    // {
    //     $bocor = DataBanjirBocor::find($request->id_banjir_bocor);
    //     $bocor->id_status_bocor = $request->status_bocor;
    //     $bocor->desa = $request->desa;
    //     $bocor->titik_kumpul = $request->titik_kumpul;
    //     $bocor->updated_by = session('nama');
    //     $bocor->save();
    //     return redirect(session('banjir_bocor'))->with('success', 'Data Berhasil Diedit');
    // }


    public function lihat_berkas($id)
    {
        $data['berkas'] = DataBanjirBocor::find(decrypt($id));
        $data['url'] = Storage::url($data['berkas']->file_1);
        $data['tipedata'] = Storage::mimeType($data['berkas']->file_1);
        return view('transaksi.bocor.view', $data);
    }

    public function lihat_berkas2($id)
    {
        $data['berkas'] = DataBanjirBocor::find(decrypt($id));
        $data['url'] = Storage::url($data['berkas']->file_2);
        $data['tipedata'] = Storage::mimeType($data['berkas']->file_2);
        return view('transaksi.bocor.view', $data);
    }

    public function lihat_berkas3($id)
    {
        $data['berkas'] = DataBanjirBocor::find(decrypt($id));
        $data['url'] = Storage::url($data['berkas']->file_3);
        $data['tipedata'] = Storage::mimeType($data['berkas']->file_3);
        return view('transaksi.bocor.view', $data);
    }

    public function lihat_berkas4($id)
    {
        $data['berkas'] = DataBanjirBocor::find(decrypt($id));
        $data['url'] = Storage::url($data['berkas']->file_4);
        $data['tipedata'] = Storage::mimeType($data['berkas']->file_4);
        return view('transaksi.bocor.view', $data);
    }

    public function lihat_berkas5($id)
    {
        $data['berkas'] = DataBanjirBocor::find(decrypt($id));
        $data['url'] = Storage::url($data['berkas']->file_5);
        $data['tipedata'] = Storage::mimeType($data['berkas']->file_5);
        return view('transaksi.bocor.view', $data);
    }
}
