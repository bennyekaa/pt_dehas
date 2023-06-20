<?php

namespace App\Http\Controllers;

use App\Models\DataBanjirBocor;
use App\Models\KategoriBocor;
use App\Models\StatusBocor;
use App\Models\Notif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Exception;


class TransBocor extends Controller
{

    public function index($stat)
    {
        $data['bocor'] = DataBanjirBocor::where('id_role', decrypt($stat))->orderBy('created_at')->get();
        $data['bocor'] = DB::table('data_banjir_bocor')
            ->join('ref_kategori_bocor', 'ref_kategori_bocor.id_kategori_bocor', '=', 'data_banjir_bocor.id_kategori_bocor')
            ->get();
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
        $lokasi = "";
        if (!empty($request->didihlokasi)) {
            $lokasi = $request->didihlokasi;
        } elseif (!empty($request->gempalokasi)) {
            $lokasi = $request->gempalokasi;
        } elseif (!empty($request->longsorlokasi)) {
            $lokasi = $request->longsorlokasi;
        } elseif (!empty($request->lubanglokasi)) {
            $lokasi = $request->lubanglokasi;
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
        if (!empty($request->lubangdiameter)) {
            $diameter = $request->lubangdiameter;
        } elseif (!empty($request->pusarandiameter)) {
            $diameter = $request->pusarandiameter;
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
        if (!empty($request->didih_data_file)) {
            $file_1 = Storage::putFile('/public/berkas', ($request->didih_data_file));
        } elseif (empty($request->didih_data_file)) {
            $file_1 = null;

        } elseif (!empty($request->gempa_data_file)) {
            $file_1 = $request->gempa_data_file;
        } elseif (!empty($request->badai_data_file)) {
            $file_1 = $request->badai_data_file;
        } elseif (!empty($request->longsor_data_file)) {
            $file_1 = $request->longsor_data_file;
        } elseif (!empty($request->lubang_data_file)) {
            $file_1 = $request->lubang_data_file;
        } elseif (!empty($request->penurunan_data_file)) {
            $file_1 = $request->penurunan_data_file;
        } elseif (!empty($request->pusaran_data_file)) {
            $file_1 = $request->pusaran_data_file;
        } elseif (!empty($request->rembesan_data_file)) {
            $file_1 = $request->rembesan_data_file;
        } elseif (!empty($request->retakan_data_file)) {
            $file_1 = $request->retakan_data_file;
        } elseif (!empty($request->pergerakan_data_file)) {
            $file_1 = $request->pergerakan_data_file;
        }

        $file_2 = null;
        if (!empty($request->didih_data_file2)) {
            $file_2 = $request->didih_data_file2;
            $file_2 = Storage::putFile('/public/berkas', ($file_2));
        } elseif (empty($request->didih_data_file2)) {
            $file_2 = null;
        
        
        
        }elseif (!empty($request->gempa_data_file2)) {
            $file_2 = $request->gempa_data_file2;
        } elseif (!empty($request->badai_data_file2)) {
            $file_2 = $request->badai_data_file2;
        } elseif (!empty($request->longsor_data_file2)) {
            $file_2 = $request->longsor_data_file2;
        } elseif (!empty($request->lubang_data_file2)) {
            $file_2 = $request->lubang_data_file2;
        } elseif (!empty($request->penurunan_data_file2)) {
            $file_2 = $request->penurunan_data_file2;
        } elseif (!empty($request->pusaran_data_file2)) {
            $file_2 = $request->pusaran_data_file2;
        } elseif (!empty($request->rembesan_data_file2)) {
            $file_2 = $request->rembesan_data_file2;
        } elseif (!empty($request->retakan_data_file2)) {
            $file_2 = $request->retakan_data_file2;
        } elseif (!empty($request->pergerakan_data_file2)) {
            $file_2 = $request->pergerakan_data_file2;
        }

        $file_3 = null;
        if (!empty($request->didih_data_file3)) {
            $file_3 = $request->didih_data_file3;
            $file_3 = Storage::putFile('/public/berkas', ($file_3));
        } elseif (empty($request->didih_data_file3)) {
            $file_3 = null;
        
        
        
        
        }elseif (!empty($request->gempa_data_file3)) {
            $file_3 = $request->gempa_data_file3;
        } elseif (!empty($request->badai_data_file3)) {
            $file_3 = $request->badai_data_file3;
        } elseif (!empty($request->longsor_data_file3)) {
            $file_3 = $request->longsor_data_file3;
        } elseif (!empty($request->lubang_data_file3)) {
            $file_3 = $request->lubang_data_file3;
        } elseif (!empty($request->penurunan_data_file3)) {
            $file_3 = $request->penurunan_data_file3;
        } elseif (!empty($request->pusaran_data_file3)) {
            $file_3 = $request->pusaran_data_file3;
        } elseif (!empty($request->rembesan_data_file3)) {
            $file_3 = $request->rembesan_data_file3;
        } elseif (!empty($request->retakan_data_file3)) {
            $file_3 = $request->retakan_data_file3;
        } elseif (!empty($request->pergerakan_data_file3)) {
            $file_3 = $request->pergerakan_data_file3;
        }

        $file_4 = null;
        if (!empty($request->didih_data_file4)) {
            $file_4 = $request->didih_data_file4;
            $file_4 = Storage::putFile('/public/berkas', ($file_4));
        } elseif (empty($request->didih_data_file4)) {
            $file_4 = null;
        
        
        } elseif (!empty($request->gempa_data_file4)) {
            $file_4 = $request->gempa_data_file4;
        } elseif (!empty($request->badai_data_file4)) {
            $file_4 = $request->badai_data_file4;
        } elseif (!empty($request->longsor_data_file4)) {
            $file_4 = $request->longsor_data_file4;
        } elseif (!empty($request->lubang_data_file4)) {
            $file_4 = $request->lubang_data_file4;
        } elseif (!empty($request->penurunan_data_file4)) {
            $file_4 = $request->penurunan_data_file4;
        } elseif (!empty($request->pusaran_data_file4)) {
            $file_4 = $request->pusaran_data_file4;
        } elseif (!empty($request->rembesan_data_file4)) {
            $file_4 = $request->rembesan_data_file4;
        } elseif (!empty($request->retakan_data_file4)) {
            $file_4 = $request->retakan_data_file4;
        } elseif (!empty($request->pergerakan_data_file4)) {
            $file_4 = $request->pergerakan_data_file4;
        }

        $file_5 = null;
        if (!empty($request->didih_data_file5)) {
            $file_5 = $request->didih_data_file5;
            $file_5 = Storage::putFile('/public/berkas', ($file_5));
        } elseif (empty($request->didih_data_file5)) {
            $file_5 = null;
        
        
        
        } elseif (!empty($request->gempa_data_file5)) {
            $file_5 = $request->gempa_data_file5;
        } elseif (!empty($request->badai_data_file5)) {
            $file_5 = $request->badai_data_file5;
        } elseif (!empty($request->longsor_data_file5)) {
            $file_5 = $request->longsor_data_file5;
        } elseif (!empty($request->lubang_data_file5)) {
            $file_5 = $request->lubang_data_file5;
        } elseif (!empty($request->penurunan_data_file5)) {
            $file_5 = $request->penurunan_data_file5;
        } elseif (!empty($request->pusaran_data_file5)) {
            $file_5 = $request->pusaran_data_file5;
        } elseif (!empty($request->rembesan_data_file5)) {
            $file_5 = $request->rembesan_data_file5;
        } elseif (!empty($request->retakan_data_file5)) {
            $file_5 = $request->retakan_data_file5;
        } elseif (!empty($request->pergerakan_data_file5)) {
            $file_5 = $request->pergerakan_data_file5;
        }

        // dd($request->all());
        // $path1 = Storage::putFile('/public/berkas', ($file_1));
        // $path2 = Storage::putFile('/public/berkas', ($file_2));
        // $path3 = Storage::putFile('/public/berkas', ($file_3));
        // $path4 = Storage::putFile('/public/berkas', ($file_4));
        // $path5 = Storage::putFile('/public/berkas', ($file_5));
        $bocor = new DataBanjirBocor();
        $bocor->id_kategori_bocor = $request->kategori;
        $bocor->id_role = session('id_role');
        $bocor->aktif = 1;
        $bocor->lokasi = $lokasi;
        $bocor->tinggi_MAW = $request->tinggi_MAW;
        $bocor->debit = $request->debit;
        $bocor->ukuran = $request->ukuran;
        $bocor->kekuatan = $request->kekuatan;
        $bocor->diameter = $diameter;
        $bocor->tinggi = $request->penurunantinggi;
        $bocor->panjang = $panjang;
        $bocor->lebar = $lebar;
        $bocor->keterangan = $keterangan;
        $bocor->file_1 = $file_1;
        $bocor->file_2 = $file_2;
        $bocor->file_3 = $file_3;
        $bocor->file_4 = $file_4;
        $bocor->file_5 = $file_5;
        $bocor->created_at = date('Y-m-d H:i:s.U');
        $bocor->created_by = session('nama');
        // dd($bocor);
        $bocor->save();
        return redirect(session('banjir_bocor'))->with('success', 'Data Berhasil Ditambah');
    }

    public function get_status($id)
    {
        $data = StatusBocor::where('id_kategori_bocor', $id)->get();
        return $data;
    }

    public function kirim($id)
    {
        try {
            $bocor = DataBanjirBocor::find(decrypt($id));
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
    public function edit($id_bocor)
    {
        $id = decrypt($id_bocor);
        $data = DataBanjirBocor::find($id);
        return view('transaksi.bocor.edit', compact(['bocor']));
    }

    public function prosesedit(Request $request)
    {
        $bocor = DataBanjirBocor::find($request->id_banjir_bocor);
        $bocor->id_status_bocor = $request->status_bocor;
        $bocor->desa = $request->desa;
        $bocor->titik_kumpul = $request->titik_kumpul;
        $bocor->updated_by = session('nama');
        $bocor->save();
        return redirect(session('banjir_bocor'))->with('success', 'Data Berhasil Diedit');
    }


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
