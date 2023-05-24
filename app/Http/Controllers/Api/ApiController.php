<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DesaBendungan;
use App\Models\Notif;
use App\Models\PengungsianBendungan;
use App\Models\TitikKumpulBendungan;
use App\Models\Web_custom;
use Illuminate\Http\Request;
use DB;

class ApiController extends Controller
{
    public function notif()
    {
        $notif = Notif::where('aktif', 1)->count();

        if ($notif > 0) {
            $data['notif'] = Notif::where('aktif', 1)->orderBy('created_at', 'desc')->first();
            if (isset($data['notif'])) {
                return response([
                    'success' => true,
                    'message' => 'List Data',
                    'data' => $data['notif']
                ], 200);
            } else {
                return response([
                    'success' => false,
                    'message' => 'Data tidak sesuai',
                ], 401);
            }
        }
        // var_dump($tes);
        // die();
    }

    public function update_notif(Request $request,$id)
    {
        DB::table('notif')->where('id', $id)->update([
            'aktif' => 0, 'updated_at' => date('Y-m-d H:i:s.U'), 'updated_at' => session('nama')
        ]);
        return response()->json([
            'status' => true,
            'message' => 'update success'
        ]);
    }

    public function master_web()
    {
        $data['web'] = Web_custom::all();
        if (isset($data['web'])) {
            return response([
                'success' => true,
                'message' => 'List Data',
                'data' => $data['web']
            ], 200);
        } else {
            return response([
                'success' => false,
                'message' => 'Data tidak sesuai',
            ], 401);
        }
    }
    public function master_desa()
    {
        $data['desa'] = DesaBendungan::all();
        if (isset($data['desa'])) {
            return response([
                'success' => true,
                'message' => 'List Data',
                'data' => $data['desa']
            ], 200);
        } else {
            return response([
                'success' => false,
                'message' => 'Data tidak sesuai',
            ], 401);
        }
    }
    public function master_tk()
    {
        $data['tk'] = TitikKumpulBendungan::all();
        if (isset($data['tk'])) {
            return response([
                'success' => true,
                'message' => 'List Data',
                'data' => $data['tk']
            ], 200);
        } else {
            return response([
                'success' => false,
                'message' => 'Data tidak sesuai',
            ], 401);
        }
    }
    public function master_p()
    {
        $data['p'] = PengungsianBendungan::all();
        if (isset($data['p'])) {
            return response([
                'success' => true,
                'message' => 'List Data',
                'data' => $data['p']
            ], 200);
        } else {
            return response([
                'success' => false,
                'message' => 'Data tidak sesuai',
            ], 401);
        }
    }
}
