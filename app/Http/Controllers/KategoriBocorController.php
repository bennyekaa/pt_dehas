<?php

namespace App\Http\Controllers;

use App\Models\KategoriBocor;
use Illuminate\Http\Request;
use Exception;

class KategoriBocorController extends Controller
{
    public function index(){
        $data['kategori'] = KategoriBocor::all();
        session()->put('kategoribocor', url()->full());
        return view('master.kategoribocor.index', $data);
    }

    public function tambah(){
        return view('master.kategoribocor.add');
    }

    public function edit($id){
        $data['riwayat_kategori'] = KategoriBocor::find(decrypt($id));
        // dd($data);
        return view('master.kategoribocor.edit', $data);
    }

    public function proses(Request $request)
    {
        // dd($request->all());
        if ($request->fungsi == "Tambah") {
            try {
                $kategoribocor = new KategoriBocor();
                $kategoribocor->nama_kategori = $request->nama_kategori;
                $kategoribocor->created_at = date('Y-m-d H:i:s.U');
                $kategoribocor->created_by = session('nama');
                $kategoribocor->save();
                return redirect(session('kategoribocor'))->with('success', 'Data Berhasil Ditambah');
            } catch (Exception $e) {
                return redirect(session('kategoribocor'))->with('error', $e->getMessage());
            }
        } else {
            try {
                $kategoribocor = KategoriBocor::find($request->id_kategori_bocor);
                $kategoribocor->nama_kategori = $request->nama_kategori;
                $kategoribocor->updated_at = date('Y-m-d H:i:s.U');
                $kategoribocor->updated_by = session('nama');
                $kategoribocor->save();
                return redirect(session('kategoribocor'))->with('success', 'Data Berhasil Diedit');
            } catch (Exception $e) {
                return redirect(session('kategoribocor'))->with('error', $e->getMessage());
            }
        }
    }

    public function hapus($id){
        try {
            $kategoribocor = KategoriBocor::find(decrypt($id));
            $kategoribocor->delete();
            return redirect(session('kategoribocor'))->with('success', 'Data Terhapus');
        } catch (Exception $e) {
            return redirect(session('kategoribocor'))->with('error', $e->getMessage());
        }
    }
}
