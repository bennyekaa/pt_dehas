<?php

namespace App\Http\Controllers;

use App\Models\DataBanjir;
use App\Models\KategoriBocor;
use App\Models\StatusBocor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class TransBocor extends Controller
{
    public function index($stat){
        $data['bocor'] = DataBanjir::where('status_role', decrypt($stat))->get();
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
        $path = Storage::putFile('/public/berkas', $request->file('data_file'));
        DB::table('data_banjir_bocor')->insert([
            'id_status_bocor' => $request->status_bocor,
            'status_role' => $request->status_role,
            'keterangan' => $request->keterangan,
            'nama_file' => $path, 
            'created_at' => date('Y-m-d H:i:s.U'),
            'created_by' => session('nama')
        ]);
        return redirect('/transaksi/bocor/index', $data);
    }

    public function get_status($id)
    {
        $data = StatusBocor::where('id_kategori_bocor',$id)->get();
        return $data;
    }
}
