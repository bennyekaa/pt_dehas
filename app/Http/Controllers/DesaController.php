<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DesaBendungan;
use Exception;

class DesaController extends Controller
{
    public function index()
    {
        // mengambil data dari table user
        $data['desa'] = DB::table('ref_desa')->get();
        return view('master.desa', $data);
    }

    public function tambah()
    {
        return view('register.desa');
    }

    public function tambahprosessss()
    {
       // dd($data->all());
        $data['kode_pengungsian'] = 'kode_pengungsian';
        $data['desa'] = 'desa';
        $data['titik_kumpul'] = 'titik_kumpul';
        $data['jarak_tk'] = 'jarak_tk';
        $data['tk_x'] = 'tk_x';
        $data['tk_y'] = 'tk_y';
        $data['lokasi_pengungsian'] = 'lokasi_pengungsian';
        $data['jarak_pengungsian'] = 'jarak_pengungsian';
        $data['p_x'] = 'p_x';
        $data['p_y'] = 'p_y';
        $data['e_x'] = 'e_x';
        $data['e_y'] = 'e_y';
        return view('master.desa', $data);
    }

    public function tambahproses(Request $request)
    {
       // dd($request->all());
        DB::table('ref_desa')->insert([
            'kode_pengungsian' => $request->kode_pengungsian,
            'desa' => $request->desa,
            'titik_kumpul' => $request->titik_kumpul,
            'jarak_tk' => $request->jarak_tk,
            'tk_x' => $request->tk_x,
            'tk_y' => $request->tk_y,
            'lokasi_pengungsian' => $request->lokasi_pengungsian,
            'jarak_pengungsian' => $request->jarak_pengungsian,
            'p_x' => $request->p_x,
            'p_y' => $request->p_y,
            'e_x' => $request->e_x,
            'e_y' => $request->e_y,
        ]);
        return redirect('/desa');
    }
}
