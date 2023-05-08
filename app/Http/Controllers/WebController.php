<?php

namespace App\Http\Controllers;

use App\Models\Web_custom;
use Illuminate\Http\Request;
use Exception;

class WebController extends Controller
{
    public function index(){
        $data['website'] = Web_custom::all();
        session()->put('website', url()->full());
        return view('master.website.index', $data);
    }

    public function tambah(){
        return view('master.website.add');
    }

    public function edit($id){
        // dd('tes');
        $data['riwayat_web'] = Web_custom::find(decrypt($id));
        return view('master.website.edit', $data);
    }

    public function proses(Request $request){
        // dd($request->all());
        if($request->fungsi == "Tambah"){
            try {
                $website = new Web_custom();
                $website->nama_web = $request->nama_web;
                $website->url_web = $request->url_web;
                $website->keterangan = $request->keterangan;
                $website->created_at = date('Y-m-d H:i:s.U');
                $website->created_by = session('nama');
                $website->save();
                return redirect(session('website'))->with('success', 'Data Berhasil Ditambah');
            } catch (Exception $e) {
                return redirect(session('website'))->with('error', $e->getMessage());
            }
        }else{
            try {
                $website = Web_custom::find($request->id_web);
                $website->nama_web = $request->nama_web;
                $website->url_web = $request->url_web;
                $website->keterangan = $request->keterangan;
                $website->updated_at = date('Y-m-d H:i:s.U');
                $website->updated_by = session('nama');
                $website->save();
                return redirect(session('website'))->with('success', 'Data Berhasil Diedit');
            } catch (Exception $e) {
                return redirect(session('website'))->with('error', $e->getMessage());
            }
        }
    }

    public function hapus($id){
        // dd(decrypt($id));
        try {
            $website = Web_custom::find(decrypt($id));
            $website->delete();
            return redirect(session('website'))->with('success', 'Data Terhapus');
        } catch (Exception $e) {
            return redirect(session('website'))->with('error', $e->getMessage());
        }
    }
}


