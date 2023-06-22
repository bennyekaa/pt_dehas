<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BendunganBendungan;
use App\Models\DesaBendungan;
use App\Models\Log;
use App\Models\Notif;
use App\Models\PengungsianBendungan;
use App\Models\Role;
use App\Models\TitikKumpulBendungan;
use App\Models\UserBendungan;
use App\Models\Web_custom;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use DB;
use Exception;

class ApiController extends Controller
{
    public function master_web()
    {
        $data['web'] = Web_custom::all();
        if (isset($data['web'])) {
            return response([
                // 'success' => true,
                // 'message' => 'List Data',
                'data' => $data['web']
            ], 200);
        } else {
            return response([
                'success' => false,
                'message' => 'Data tidak sesuai',
            ], 401);
        }
    }
    public function master_desa($id = null)
    {
        try {
            if (isset($id)) {
                $id_desa = DesaBendungan::where('id_desa', 'like', $id)->count();
                $kelurahan_desa = DesaBendungan::where('kelurahan_desa', 'like', $id)->count();
                $kode_desa = DesaBendungan::where('kode_desa', 'like', $id)->count();
                if ($id_desa > 0) {
                    $data['id_desa'] = DesaBendungan::where('id_desa', 'like', $id)->get();
                    return response([
                        // 'success' => true,
                        // 'message' => 'List Data',
                        'data' => $data['id_desa']
                    ], 200);
                } elseif ($kelurahan_desa > 0) {
                    $data['kelurahan_desa'] = DesaBendungan::where('kelurahan_desa', 'like', $id)->get();
                    return response([
                        // 'success' => true,
                        // 'message' => 'List Data',
                        'data' => $data['kelurahan_desa']
                    ], 200);
                } elseif ($kode_desa > 0) {
                    $data['kode_desa'] = DesaBendungan::where('kode_desa', 'like', $id)->get();
                    return response([
                        // 'success' => true,
                        // 'message' => 'List Data',
                        'data' => $data['kode_desa']
                    ], 200);
                } else {
                    return response([
                        'success' => false,
                        'message' => 'Data tidak sesuai',
                    ], 401);
                }
            } else {
                $data['desa'] = DesaBendungan::all();
                return response([
                    'data' => $data['desa']
                    // 'success' => true,
                    // 'message' => 'List Data',
                    // 'data' => $data['desa']
                ], 200);
            }
            //code...
        } catch (Exception $e) {
            return response([
                'success' => false,
                'message' => 'Data tidak sesuai',
            ], 401);
        }
    }
    public function master_tk($id = null)
    {
        try {
            if (isset($id)) {
                $id_tk = TitikKumpulBendungan::where('id_titik_kumpul', 'like', $id)->count();
                $kode_tk = TitikKumpulBendungan::where('kode_tk', 'like', $id)->count();;
                $nama_tk = TitikKumpulBendungan::where('nama_titik_kumpul', 'like',  $id)->count();
                if ($id_tk > 0) {
                    $data['id_tk'] = TitikKumpulBendungan::where('id_titik_kumpul', 'like',  $id)->get();
                    return response([
                        // 'success' => true,
                        // 'message' => 'List Data',
                        'data' => $data['id_tk']
                    ], 200);
                } elseif ($kode_tk > 0) {
                    $data['kode_tk'] = TitikKumpulBendungan::where('kode_tk', 'like',  $id)->get();
                    return response([
                        // 'success' => true,
                        // 'message' => 'List Data',
                        'data' => $data['kode_tk']
                    ], 200);
                } elseif ($nama_tk > 0) {
                    $data['nama_tk'] = TitikKumpulBendungan::where('nama_titik_kumpul', 'like',  $id)->get();
                    return response([
                        // 'success' => true,
                        // 'message' => 'List Data',
                        'data' => $data['nama_tk']
                    ], 200);
                } else {
                    return response([
                        'success' => false,
                        'message' => 'Data tidak sesuai',
                    ], 401);
                }
            } else {
                $data['tk'] = TitikKumpulBendungan::all();
                return response([
                    // 'success' => true,
                    // 'message' => 'List Data',
                    'data' => $data['tk']
                ], 200);
            }
        } catch (Exception $e) {
            return response([
                'success' => false,
                'message' => 'Data tidak sesuai',
            ], 401);
        }
    }
    public function master_p($id = null)
    {
        try {
            if (isset($id)) {
                $id_p = PengungsianBendungan::where('id_pengungsian', 'like', $id)->count();
                $kode_p = PengungsianBendungan::where('kode_pengungsian', 'like', $id)->count();
                $nama_p = PengungsianBendungan::where('nama_pengungsian', 'like', $id)->count();
                if ($id_p > 0) {
                    $data['id_p'] = PengungsianBendungan::where('id_pengungsian', 'like', $id)->get();
                    return response([
                        // 'success' => true,
                        // 'message' => 'List Data',
                        'data' => $data['id_p']
                    ], 200);
                } elseif ($kode_p > 0) {
                    $data['kode_p'] = PengungsianBendungan::where('kode_pengungsian', 'like', $id)->get();
                    return response([
                        // 'success' => true,
                        // 'message' => 'List Data',
                        'data' => $data['kode_p']
                    ], 200);
                } elseif ($nama_p > 0) {
                    $data['nama_p'] = PengungsianBendungan::where('nama_pengungsian', 'like', $id)->get();
                    return response([
                        // 'success' => true,
                        // 'message' => 'List Data',
                        'data' => $data['nama_p']
                    ], 200);
                } else {
                    return response([
                        'success' => false,
                        'message' => 'Data tidak sesuai',
                    ], 401);
                }
            } else {
                $data['p'] = PengungsianBendungan::all();
                return response([
                    // 'success' => true,
                    // 'message' => 'List Data',
                    'data' => $data['p']
                ], 200);
            }
        } catch (Exception $e) {
            return response([
                'success' => false,
                'message' => 'Data tidak sesuai',
            ], 401);
        }
    }
    public function master_bendungan($id = null)
    {
        try {
            if (isset($id)) {
                $id_b = BendunganBendungan::where('id_bendungan', 'like',  $id)->count();
                $nama_b = BendunganBendungan::where('nama_bendungan', 'like',  $id)->count();
                if ($id_b > 0) {
                    $data['id_b'] = BendunganBendungan::where('id_bendungan', 'like',  $id)->get();
                    return response([
                        // 'success' => true,
                        // 'message' => 'List Data',
                        'data' => $data['id_b']
                    ], 200);
                } elseif ($nama_b > 0) {
                    $data['nama_b'] = BendunganBendungan::where('id_bendungan', 'like',  $id)->get();
                    return response([
                        // 'success' => true,
                        // 'message' => 'List Data',
                        'data' => $data['nama_b']
                    ], 200);
                } else {
                    return response([
                        'success' => false,
                        'message' => 'Data tidak sesuai',
                    ], 401);
                }
            } else {
                $data['bendungan'] = BendunganBendungan::all();
                return response([
                    // 'success' => true,
                    // 'message' => 'List Data',
                    'data' => $data['bendungan']
                ], 200);
            }
        } catch (Exception $e) {
            return response([
                'success' => false,
                'message' => 'Data tidak sesuai',
            ], 401);
        }
    }
    public function master_user($id = null)
    {
        try {
            if (isset($id)) {
                $id_user = UserBendungan::where('id_user', 'like',  $id)->count();
                $username = UserBendungan::where('username', 'like',  $id)->count();
                $hp = UserBendungan::where('hp', 'like',  $id)->count();
                $role = UserBendungan::Join('ref_role', 'ref_role.id_role', '=', 'ref_user.id_role')->where('nama_role', 'like',  $id)->count();
                if ($id_user > 0) {
                    $data['id_user'] = UserBendungan::Join('ref_role', 'ref_role.id_role', '=', 'ref_user.id_role')->where('id_user', 'like',  $id)->get();
                    return response([
                        // 'success' => true,
                        // 'message' => 'List Data',
                        'data' => $data['id_user']
                    ], 200);
                } elseif ($username > 0) {
                    $data['username'] = UserBendungan::Join('ref_role', 'ref_role.id_role', '=', 'ref_user.id_role')->where('username', 'like',  $id)->get();
                    return response([
                        // 'success' => true,
                        // 'message' => 'List Data',
                        'data' => $data['username']
                    ], 200);
                } elseif ($hp > 0) {
                    $data['hp'] = UserBendungan::Join('ref_role', 'ref_role.id_role', '=', 'ref_user.id_role')->where('hp', 'like',  $id)->get();
                    return response([
                        // 'success' => true,
                        // 'message' => 'List Data',
                        'data' => $data['hp']
                    ], 200);
                } elseif ($role > 0) {
                    $data['role'] = UserBendungan::Join('ref_role', 'ref_role.id_role', '=', 'ref_user.id_role')->where('nama_role', 'like',  $id)->get();
                    return response([
                        // 'success' => true,
                        // 'message' => 'List Data',
                        'data' => $data['role']
                    ], 200);
                } else {
                    return response([
                        'success' => false,
                        'message' => 'Data tidak sesuai',
                    ], 401);
                }
            } else {
                $data['user'] = UserBendungan::Join('ref_role', 'ref_role.id_role', '=', 'ref_user.id_role')->get();
                return response([
                    // 'success' => true,
                    // 'message' => 'List Data',
                    'data' => $data['user']
                ], 200);
            }
        } catch (Exception $e) {
            return response([
                'success' => false,
                'message' => 'Data tidak sesuai',
            ], 401);
        }
    }

    public function master_role($id = null)
    {
        try {
            if (isset($id)) {
                $id_role = Role::where('id_role', 'like',  $id)->count();
                $nama_role = Role::where('nama_role', 'like',  $id)->count();
                $role = Role::where('role', 'like',  $id)->count();
                if ($id_role > 0) {
                    $data['id_role'] = Role::where('id_role', 'like',  $id)->get();
                    return response([
                        // 'success' => true,
                        // 'message' => 'List Data',
                        'data' => $data['id_role']
                    ], 200);
                } elseif ($nama_role > 0) {
                    $data['nama_role'] = Role::where('nama_role', 'like',  $id)->get();
                    return response([
                        // 'success' => true,
                        // 'message' => 'List Data',
                        'data' => $data['nama_role']
                    ], 200);
                } elseif ($role > 0) {
                    $data['role'] = Role::where('role', 'like',  $id)->get();
                    return response([
                        // 'success' => true,
                        // 'message' => 'List Data',
                        'data' => $data['role']
                    ], 200);
                } else {
                    return response([
                        'success' => false,
                        'message' => 'Data tidak sesuai',
                    ], 401);
                }
            } else {
                return response([
                    'success' => false,
                    'message' => 'Data tidak sesuai',
                ], 401);
            }
        } catch (Exception $e) {
            return response([
                'success' => false,
                'message' => 'Data tidak sesuai',
            ], 401);
        }
    }

    public function notif()
    {
        $notif = Notif::where('aktif', 1)->count();

        if ($notif > 0) {
            $data['notif'] = Notif::select(
                'notif.id',
                'notif.id_referensi',
                'notif.role as role_notif',
                'notif.status as status_notif',
                'notif.aktif as aktif_notif',
                'notif.pesan',
                'b.nama_role as role_muka_air',
                'data_banjir_muka_air.muka_air',
                'data_banjir_muka_air.tinggi_air',
                'data_banjir_muka_air.debit_air',
                'data_banjir_muka_air.status as status_muka_air',
                'data_banjir_muka_air.aktif as aktif_muka_air',
                'data_banjir_muka_air.created_at as created_at_muka_air',
                'data_banjir_muka_air.created_by as created_by_muka_air',
                'data_banjir_muka_air.updated_at as updated_at_muka_air',
                'data_banjir_muka_air.updated_by as updated_by_muka_air',
                'ref_kategori_bocor.nama_kategori',
                'a.nama_role as role_bocor',
                'data_banjir_bocor.lokasi',
                'data_banjir_bocor.ukuran',
                'data_banjir_bocor.tinggi_MAW',
                'data_banjir_bocor.debit',
                'data_banjir_bocor.kekuatan',
                'data_banjir_bocor.diameter',
                'data_banjir_bocor.tinggi',
                'data_banjir_bocor.panjang',
                'data_banjir_bocor.lebar',
                'data_banjir_bocor.file_1',
                'data_banjir_bocor.file_2',
                'data_banjir_bocor.file_3',
                'data_banjir_bocor.file_4',
                'data_banjir_bocor.file_5',
                'data_banjir_bocor.aktif as aktif_bocor',
                'data_banjir_bocor.created_at as created_at_bocor',
                'data_banjir_bocor.created_by as created_by_bocor',
                'data_banjir_bocor.updated_at as updated_at_bocor',
                'data_banjir_bocor.updated_by as updated_by_bocor',
                )
                ->leftJoin('data_banjir_bocor', 'data_banjir_bocor.id_banjir_bocor', '=', 'notif.id_referensi')
                ->leftJoin('ref_kategori_bocor', 'data_banjir_bocor.id_kategori_bocor', '=', 'ref_kategori_bocor.id_kategori_bocor')
                ->leftJoin('ref_role as a', 'data_banjir_bocor.id_role', '=', 'a.id_role')
                ->leftJoin('data_banjir_muka_air', 'data_banjir_muka_air.id_banjir_muka_air', '=', 'notif.id_referensi')
                ->leftJoin('ref_role as b', 'data_banjir_muka_air.id_role', '=', 'b.id_role')
                ->where('notif.aktif', 1)
                ->orderBy('notif.updated_at', 'desc')
                ->limit(1)
                ->get();
            if (isset($data['notif'])) {
                return response([
                    // 'success' => true,
                    // 'message' => 'List Data',
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

    public function update_notif(Request $request)
    {
        Notif::where('id', $request->id)->update([
            'role' => $request->role, 'updated_at' => now(), 'updated_by' => $request->nama
        ]);
        return response()->json([
            'status' => true,
            'message' => 'update success'
        ]);
    }

    public function register(Request $request)
    {
        // $agent = new Agent();
        // $device = $agent->device();
        // $platform = $agent->platform();
        UserBendungan::create([ 'id_user' => Str::uuid(), 'nama' => $request->nama, 'email' => $request->email, 'hp' => $request->hp, 'username' => $request->username, 'password' => Hash::make($request->password), 'id_role' => '65877613b110ff8ae52069c50181c077', 'id_desa' => $request->id_desa, 'created_at' => now(), 'created_by' => 'Penduduk']);
        return response()->json([
            'status' => true,
            'message' => 'register success'
        ]);
    }

    public function login($username, $password)
    {
        $user = UserBendungan::where('username', $username)->first();
        if(!Hash::check($password, $user->password)){
            return response([
                'success' => false,
                'message' => 'Login Gagal',
            ], 401);
        }else{
            $data['login'] = UserBendungan::Join('ref_role', 'ref_role.id_role', '=', 'ref_user.id_role')->Join('ref_desa', 'ref_desa.id_desa', '=', 'ref_user.id_desa')->Join('ref_pengungsian', 'ref_pengungsian.id_pengungsian', '=', 'ref_desa.id_pengungsian')->Join('ref_titik_kumpul', 'ref_titik_kumpul.id_titik_kumpul', '=', 'ref_desa.id_titik_kumpul')->where('username', $username)->get();
            return response([
                // 'success' => true,
                // 'message' => 'List Data',
                'data' => $data['login']
            ], 200);
        }
    }

    public function log_ready($id)
    {
        $data['log'] = Log::whereNull('mac_add')->where('id_user', $id)->count();
        if (isset($data['log'])) {
            return response([
                // 'success' => true,
                // 'message' => 'List Data',
                'data' => $data['log']
            ], 200);
        } else {
            return response([
                'success' => false,
                'message' => 'Data tidak sesuai',
            ], 401);
        }
    }

    public function device_ready($id = null)
    {
        $data['log'] = Log::where('id_user', $id)->get();
        if (isset($id)) {
            if (isset($data['log'])) {
                return response([
                    // 'success' => true,
                    // 'message' => 'List Data',
                    'data' => $data['log']
                ], 200);
            } else {
                return response([
                    'success' => false,
                    'message' => 'Data tidak sesuai',
                ], 401);
            }
        } else {
            $data['log'] = Log::all();
            if (isset($data['log'])) {
                return response([
                    // 'success' => true,
                    // 'message' => 'List Data',
                    'data' => $data['log']
                ], 200);
            } else {
                return response([
                    'success' => false,
                    'message' => 'Data tidak sesuai',
                ], 401);
            }
        }
    }

    public function mac_check()
    {
        $agent = new Agent();
        $device = $agent->device();
        $platform = $agent->platform();

        $data['mac'] = $platform;
        $data['keterangan'] = request()->header('user_agent');
        // $data['mac'] = trim(substr(shell_exec('getmac'), 159, 20));
        return response([
            // 'success' => true,
            // 'message' => 'List Data',
            'data' => $data
        ], 200);
    }
}
