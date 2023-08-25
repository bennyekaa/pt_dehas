<?php

namespace App\Http\Controllers;

use App\Imports\WadukImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\WadukBendungan;
use Exception;
use Maatwebsite\Excel\Facades\Excel;

class WadukController extends Controller
{
    public function index()
    {
        // mengambil data dari table Titik Kumpul
        $data['waduk'] = WadukBendungan::all();
        // $data['waduk'] = DB::table('ref_waduk')->get();
        session()->put('waduk', url()->full());
        return view('master.waduk.index', $data);
    }

    public function import(){
        return view('master.waduk.import');
    }

    public function export(){

    }

    public function proses_excel(Request $request){
        if($request->fungsi == 'Import'){
            // dd($request->all());
            try {

                // linux
                // $path1 = $request->file('data_file')->store('temp');
                // $path = storage_path('app') . '/' . $path1;
                // \Excel::import(new WadukImport, $path);

                $file = $request->file('data_file')->getRealPath();
                Excel::import(new WadukImport, $file);

                return redirect(session('waduk'))->with('success', 'Berhasil Import');
            } catch (Exception $e) {
                return redirect(session('waduk'))->with('error', $e->getMessage());
            }
        }
    }

    public function edit($id)
    {
        // $id = decrypt($id_waduk);
        // $data = WadukBendungan::find($id);
        $data['riwayat_waduk'] = WadukBendungan::find(decrypt($id));
        return view('master.waduk.edit', $data);
    }

    public function proseswaduk(Request $request)
    {
        $data = WadukBendungan::find($request->id_waduk);
        $data->id_waduk = $request->id_waduk;
        $data->muka_air = $request->muka_air;
        $data->tinggi_air = $request->tinggi_air;
        $data->debit_keluar = $request->debit_keluar;
        $data->status = $request->status;
        $data->keterangan = $request->keterangan;
        $data->updated_by = session('nama');
        $data->save();
        return redirect('/waduk');
    }

    public function tambah()
    {
        return view('master.waduk.add');
        // return view('register.waduk');
    }

    public function proses(Request $request){
        if ($request->fungsi == "Tambah") {
            try {
                $waduk = new WadukBendungan();
                $waduk->muka_air = $request->muka_air;
                $waduk->tinggi_air = $request->tinggi_air;
                $waduk->debit_keluar = $request->debit_keluar;
                $waduk->status = $request->status;
                $waduk->keterangan = $request->keterangan;
                $waduk->created_at = date('Y-m-d H:i:s.U');
                $waduk->created_by = session('nama');
                $waduk->save();
                return redirect(session('waduk'))->with('success', 'Data Berhasil Ditambah');
            } catch (Exception $e) {
                return redirect(session('waduk'))->with('error', $e->getMessage());
            }
        } else {
            try {
                $waduk = WadukBendungan::find($request->id_waduk);
                $waduk->muka_air = $request->muka_air;
                $waduk->tinggi_air = $request->tinggi_air;
                $waduk->debit_keluar = $request->debit_keluar;
                $waduk->status = $request->status;
                $waduk->keterangan = $request->keterangan;
                $waduk->updated_at = date('Y-m-d H:i:s.U');
                $waduk->updated_by = session('nama');
                $waduk->save();
                return redirect(session('waduk'))->with('success', 'Data Berhasil Diedit');
            } catch (Exception $e) {
                return redirect(session('waduk'))->with('error', $e->getMessage());
            }
        }
    }

    public function tambahproses(Request $request)
    {
        DB::table('ref_waduk')->insert([
            'muka_air' => $request->muka_air,
            'tinggi_air' => $request->tinggi_air,
            'debit_keluar' => $request->debit_keluar,
            'status' => $request->status,
            'keterangan' => $request->keterangan,
            'created_at' => date('Y-m-d H:i:s.U'),
            'created_by' => session('nama')
        ]);
        return redirect('/waduk');
    }

    public function hapus($id)
    {
        // DB::table('ref_waduk')->where('id_waduk', $id)->delete();
        // return redirect(('/waduk'))->with('success', 'Data Terhapus');
        try {
            $waduk = WadukBendungan::find(decrypt($id));
            $waduk->delete();
            return redirect(session('waduk'))->with('success', 'Data Terhapus');
        } catch (Exception $e) {
            return redirect(session('waduk'))->with('error', $e->getMessage());
        }
    }
}
