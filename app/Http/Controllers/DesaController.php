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

    // TAMBAH

    public function tambah()
    {
        return view('register.desa');
    }

    public function tambahproses(Request $request)
    {
        DB::table('ref_desa')->insert([
            'kode_pengungsian' => $request->kode_pengungsian,
            'desa' => $request->desa,
            'titik_kumpul' => $request->titik_kumpul,
            'jarak_titik_kumpul' => $request->jarak_tk,
            'tk_x' => $request->tk_x,
            'tk_y' => $request->tk_y,
            'lokasi_pengungsian' => $request->lokasi_pengungsian,
            'jarak_pengungsian' => $request->jarak_pengungsian,
            'p_x' => $request->p_x,
            'p_y' => $request->p_y,
            'e_x' => $request->e_x,
            'e_y' => $request->e_y,
            'created_at' => date('Y-m-d H:i:s.U'),
            'created_by' => 'Adit'
        ]);
        return redirect('/desa');
    }

    //EDIT
    public function edit($id_desa)
    {
        $id = decrypt($id_desa);
        $data = DesaBendungan::find($id);
        return view('edit.desa', compact(['data']));
    }

    public function prosesdesa(Request $request)
    {
        $data = DesaBendungan::find($request->id_desa);
        $data->kode_pengungsian = $request->kode_pengungsian;
        $data->desa = $request->desa;
        $data->titik_kumpul = $request->titik_kumpul;
        $data->jarak_titik_kumpul = $request->jarak_tk;
        $data->tk_x = $request->tk_x;
        $data->tk_y = $request->tk_y;
        $data->tk_y = $request->tk_y;
        $data->lokasi_pengungsian = $request->lokasi_pengungsian;
        $data->jarak_pengungsian = $request->jarak_pengungsian;
        $data->p_x = $request->p_x;
        $data->p_y = $request->p_y;
        $data->e_x = $request->e_x;
        $data->e_y = $request->e_y;
        $data->updated_by = 'Benny';
        $data->save();
        return redirect('/desa');
    }

    // HAPUS
    public function hapus($id)
    {
        DB::table('ref_desa')->where('id_desa', $id)->delete();
        return redirect('/desa');
    }
}
