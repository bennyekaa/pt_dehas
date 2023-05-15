<?php

namespace App\Http\Controllers;

use App\Models\KategoriBocor;
use Illuminate\Http\Request;
use App\Models\StatusBocor;
use Exception;

class StatusBocorController extends Controller
{
    public function index()
    {
        $data['statusbocor'] = StatusBocor::all();
        session()->put('statusbocor', url()->full());
        return view('master.statusbocor.index', $data);
    }

    public function tambah()
    {
        $data['kategoribocor'] = KategoriBocor::all();
        return view('master.statusbocor.add', $data);
    }

    public function edit($id)
    {
        $data['kategoribocor'] = KategoriBocor::all();
        $data['riwayat_status'] = StatusBocor::find(decrypt($id));
        // dd($data);
        return view('master.statusbocor.edit', $data);
    }

    public function proses(Request $request)
    {
        // dd($request->all());
        if ($request->fungsi == "Tambah") {
            try {
                $statusbocor = new StatusBocor();
                $statusbocor->nama_status = $request->nama_status;
                $statusbocor->keterangan = $request->keterangan;
                $statusbocor->id_kategori_bocor = $request->id_kategori_bocor;
                $statusbocor->status = $request->status;
                $statusbocor->created_at = date('Y-m-d H:i:s.U');
                $statusbocor->created_by = session('nama');
                $statusbocor->save();
                return redirect(session('statusbocor'))->with('success', 'Data Berhasil Ditambah');
            } catch (Exception $e) {
                return redirect(session('statusbocor'))->with('error', $e->getMessage());
            }
        } else {
            try {
                $statusbocor = StatusBocor::find($request->id_status_bocor);
                $statusbocor->nama_status = $request->nama_status;
                $statusbocor->keterangan = $request->keterangan;
                $statusbocor->id_kategori_bocor = $request->id_kategori_bocor;
                $statusbocor->status = $request->status;
                $statusbocor->updated_at = date('Y-m-d H:i:s.U');
                $statusbocor->updated_by = session('nama');
                $statusbocor->save();
                return redirect(session('statusbocor'))->with('success', 'Data Berhasil Diedit');
            } catch (Exception $e) {
                return redirect(session('statusbocor'))->with('error', $e->getMessage());
            }
        }
    }

    public function hapus($id)
    {
        try {
            $statusbocor = StatusBocor::find(decrypt($id));
            $statusbocor->delete();
            return redirect(session('statusbocor'))->with('success', 'Data Terhapus');
        } catch (Exception $e) {
            return redirect(session('statusbocor'))->with('error', $e->getMessage());
        }
    }
}
