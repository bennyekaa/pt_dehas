<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class JabatanController extends Controller
{
    public function index()
    {
        // mengambil data dari table user
        if(session('nama_role') == 'DEVELOPER'){
            $data['jabatan'] = DB::table('ref_role')->get();
        }else{
            $data['jabatan'] = DB::table('ref_role')->where('nama_role', '<>', 'DEVELOPER')->get();
        }
        return view('master.jabatan.index', $data);
    }

    // TAMBAH
    public function tambah()
    {
        return view('master.jabatan.add');
    }

    public function tambahproses(Request $request)
    {
        $id_log = Str::uuid();
        DB::table('ref_role')->insert([
       //     'id_role' => Str::uuid(),
            'nama_role' => $request->nama_role,
            'created_at' => date('Y-m-d H:i:s.U'),
            'created_by' => session('nama')
        ]);
        return redirect('/jabatan');
    }


    public function edit($id)
    {
        $data['jabatan'] = Role::find(decrypt($id));
        // dd($data);
        return view('master.jabatan.edit', $data);
    }

    public function proses(Request $request)
    {
        $data = Role::find($request->id_role);
        $data->nama_role = $request->nama_role;
        $data->updated_by = session('nama');
        $data->save();

        return redirect(('/jabatan'))->with('success', 'Data Tersimpan');

    }

    public function hapus($id)
    {
        try {
            DB::table('ref_role')->where('id_role', decrypt($id))->delete();
            return redirect(('/jabatan'))->with('success', 'Data Terhapus');
        } catch (Exception $e) {
            return redirect(('/jabatan'))->with('error', $e->getMessage());
        }
    }
}

