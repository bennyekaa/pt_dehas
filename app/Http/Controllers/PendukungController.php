<?php

namespace App\Http\Controllers;

use App\Models\pendukung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PendukungController extends Controller
{
    public function index()
    {
        $data['pendukung'] = pendukung::all();
        session()->put('pendukung', url()->full());
        return view('master.pendukung.index', $data);
    }

    public function tambah()
    {
        return view('master.pendukung.add');
    }

    public function proses(Request $request)
    {
        // dd($request->all());
        $path = null;
        if (!empty($request->file('data_file'))) {
            $path = Storage::putFile('/public/berkas', $request->file('data_file'));
        }
        $pendukung = new pendukung();
        $pendukung->url = $request->url;
        $pendukung->berkas = $path;
        $pendukung->keterangan = $request->keterangan;
        $pendukung->created_at = date('Y-m-d H:i:s.U');
        $pendukung->created_by = session('id_role');
        $pendukung->save();
        return redirect(session('pendukung'))->with('success', 'Berhasil Upload');
    }

    public function hapus($id)
    {
        $berkas = pendukung::find(decrypt($id));
        if($berkas->berkas != null){
            Storage::delete($berkas->berkas);
        }
        $berkas->delete();
        return redirect(session('pendukung'))->with('success', 'Data Terhapus');
    }
}
