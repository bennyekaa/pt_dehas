<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BendunganBendungan;
use App\Models\DataBanjirBocor;
use App\Models\DataMukaAir;
use App\Models\DesaBendungan;
use App\Models\Log;
use App\Models\Notif;
use App\Models\PengungsianBendungan;
use App\Models\peta;
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
use Illuminate\Support\Facades\DB as FacadesDB;
use Maatwebsite\Excel\Facades\Excel;

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
            ]);
        } else {
            return response([
                'success' => false,
                'message' => 'Data tidak sesuai',
            ]);
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
                    ]);
                } elseif ($kelurahan_desa > 0) {
                    $data['kelurahan_desa'] = DesaBendungan::where('kelurahan_desa', 'like', $id)->get();
                    return response([
                        // 'success' => true,
                        // 'message' => 'List Data',
                        'data' => $data['kelurahan_desa']
                    ]);
                } elseif ($kode_desa > 0) {
                    $data['kode_desa'] = DesaBendungan::where('kode_desa', 'like', $id)->get();
                    return response([
                        // 'success' => true,
                        // 'message' => 'List Data',
                        'data' => $data['kode_desa']
                    ]);
                } else {
                    return response([
                        'success' => false,
                        'message' => 'Data tidak sesuai',
                    ]);
                }
            } else {
                $data['desa'] = DesaBendungan::all();
                return response([
                    'data' => $data['desa']
                    // 'success' => true,
                    // 'message' => 'List Data',
                    // 'data' => $data['desa']
                ]);
            }
            //code...
        } catch (Exception $e) {
            return response([
                'success' => false,
                'message' => 'Data tidak sesuai',
            ]);
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
                    ]);
                } elseif ($kode_tk > 0) {
                    $data['kode_tk'] = TitikKumpulBendungan::where('kode_tk', 'like',  $id)->get();
                    return response([
                        // 'success' => true,
                        // 'message' => 'List Data',
                        'data' => $data['kode_tk']
                    ]);
                } elseif ($nama_tk > 0) {
                    $data['nama_tk'] = TitikKumpulBendungan::where('nama_titik_kumpul', 'like',  $id)->get();
                    return response([
                        // 'success' => true,
                        // 'message' => 'List Data',
                        'data' => $data['nama_tk']
                    ]);
                } else {
                    return response([
                        'success' => false,
                        'message' => 'Data tidak sesuai',
                    ]);
                }
            } else {
                $data['tk'] = TitikKumpulBendungan::all();
                return response([
                    // 'success' => true,
                    // 'message' => 'List Data',
                    'data' => $data['tk']
                ]);
            }
        } catch (Exception $e) {
            return response([
                'success' => false,
                'message' => 'Data tidak sesuai',
            ]);
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
                    ]);
                } elseif ($kode_p > 0) {
                    $data['kode_p'] = PengungsianBendungan::where('kode_pengungsian', 'like', $id)->get();
                    return response([
                        // 'success' => true,
                        // 'message' => 'List Data',
                        'data' => $data['kode_p']
                    ]);
                } elseif ($nama_p > 0) {
                    $data['nama_p'] = PengungsianBendungan::where('nama_pengungsian', 'like', $id)->get();
                    return response([
                        // 'success' => true,
                        // 'message' => 'List Data',
                        'data' => $data['nama_p']
                    ]);
                } else {
                    return response([
                        'success' => false,
                        'message' => 'Data tidak sesuai',
                    ]);
                }
            } else {
                $data['p'] = PengungsianBendungan::all();
                return response([
                    // 'success' => true,
                    // 'message' => 'List Data',
                    'data' => $data['p']
                ]);
            }
        } catch (Exception $e) {
            return response([
                'success' => false,
                'message' => 'Data tidak sesuai',
            ]);
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
                    ]);
                } elseif ($nama_b > 0) {
                    $data['nama_b'] = BendunganBendungan::where('id_bendungan', 'like',  $id)->get();
                    return response([
                        // 'success' => true,
                        // 'message' => 'List Data',
                        'data' => $data['nama_b']
                    ]);
                } else {
                    return response([
                        'success' => false,
                        'message' => 'Data tidak sesuai',
                    ]);
                }
            } else {
                $data['bendungan'] = BendunganBendungan::all();
                return response([
                    // 'success' => true,
                    // 'message' => 'List Data',
                    'data' => $data['bendungan']
                ]);
            }
        } catch (Exception $e) {
            return response([
                'success' => false,
                'message' => 'Data tidak sesuai',
            ]);
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
                    ]);
                } elseif ($username > 0) {
                    $data['username'] = UserBendungan::Join('ref_role', 'ref_role.id_role', '=', 'ref_user.id_role')->where('username', 'like',  $id)->get();
                    return response([
                        // 'success' => true,
                        // 'message' => 'List Data',
                        'data' => $data['username']
                    ]);
                } elseif ($hp > 0) {
                    $data['hp'] = UserBendungan::Join('ref_role', 'ref_role.id_role', '=', 'ref_user.id_role')->where('hp', 'like',  $id)->get();
                    return response([
                        // 'success' => true,
                        // 'message' => 'List Data',
                        'data' => $data['hp']
                    ]);
                } elseif ($role > 0) {
                    $data['role'] = UserBendungan::Join('ref_role', 'ref_role.id_role', '=', 'ref_user.id_role')->where('nama_role', 'like',  $id)->get();
                    return response([
                        // 'success' => true,
                        // 'message' => 'List Data',
                        'data' => $data['role']
                    ]);
                } else {
                    return response([
                        'success' => false,
                        'message' => 'Data tidak sesuai',
                    ]);
                }
            } else {
                $data['user'] = UserBendungan::Join('ref_role', 'ref_role.id_role', '=', 'ref_user.id_role')->get();
                return response([
                    // 'success' => true,
                    // 'message' => 'List Data',
                    'data' => $data['user']
                ]);
            }
        } catch (Exception $e) {
            return response([
                'success' => false,
                'message' => 'Data tidak sesuai',
            ]);
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
                    ]);
                } elseif ($nama_role > 0) {
                    $data['nama_role'] = Role::where('nama_role', 'like',  $id)->get();
                    return response([
                        // 'success' => true,
                        // 'message' => 'List Data',
                        'data' => $data['nama_role']
                    ]);
                } elseif ($role > 0) {
                    $data['role'] = Role::where('role', 'like',  $id)->get();
                    return response([
                        // 'success' => true,
                        // 'message' => 'List Data',
                        'data' => $data['role']
                    ]);
                } else {
                    return response([
                        'success' => false,
                        'message' => 'Data tidak sesuai',
                    ]);
                }
            } else {
                $data['role'] = Role::all();
                return response([
                    // 'success' => true,
                    // 'message' => 'List Data',
                    'data' => $data['role']
                ]);
            }
        } catch (Exception $e) {
            return response([
                'success' => false,
                'message' => 'Data tidak sesuai',
            ]);
        }
    }

    public function notif()
    {
        $notif = Notif::where('aktif', 1)->count();

        if ($notif > 0) {
            $data['notif'] = Notif::select(
                'notif.id',
                'notif.id_referensi',
                'notif.role_muka_air as notif_role_muka_air',
                'notif.role_bocor as notif_role_bocor',
                'notif.status as status_notif',
                'notif.aktif as aktif_notif',
                'notif.pesan_default',
                'notif.pesan_pemda',
                'notif.pesan_umum',
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
                'pm.kategori as peta_muka_air',
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
                'pb.kategori as peta_bocor'
            )
                ->leftJoin('data_banjir_bocor', 'data_banjir_bocor.id_banjir_bocor', '=', 'notif.id_referensi')
                ->leftJoin('ref_kategori_bocor', 'data_banjir_bocor.id_kategori_bocor', '=', 'ref_kategori_bocor.id_kategori_bocor')
                ->leftJoin('data_peta as pb', 'data_banjir_bocor.id_peta', '=', 'pb.id_peta')
                ->leftJoin('ref_role as a', 'data_banjir_bocor.id_role', '=', 'a.id_role')
                ->leftJoin('data_banjir_muka_air', 'data_banjir_muka_air.id_banjir_muka_air', '=', 'notif.id_referensi')
                ->leftJoin('data_peta as pm', 'data_banjir_muka_air.id_peta', '=', 'pm.id_peta')
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
                ]);
            } else {
                return response([
                    'success' => false,
                    'message' => 'Data tidak sesuai',
                ]);
            }
        }
        // var_dump($tes);
        // die();
    }

    public function update_notif(Request $request)
    {
        try {
            $mukaair = DataMukaAir::where('id_banjir_muka_air', $request->id)->count();
            $mukaair_get = DataMukaAir::where('id_banjir_muka_air', $request->id)->first();
            $bocor = DataBanjirBocor::where('id_banjir_bocor', $request->id)->count();
            $bocor_get = DataBanjirBocor::where('id_banjir_bocor', $request->id)->first();
            $bendungan = BendunganBendungan::first();
            $pesan = null;
            $pesan_pemda = null;
            $pesan_umum = null;
            if ($mukaair > 0) {
                DataMukaAir::where('id_banjir_muka_air', $request->id)->update(['id_role' => $request->id_role, 'updated_at' => now(), 'updated_by' => 'AndroidApps']);
                Notif::where('id_referensi', $request->id)->update([
                    'role_muka_air' => $request->role_muka_air, 'updated_at' => now(), 'updated_by' => 'Android Apps'
                ]);
                return response()->json([
                    'status' => true,
                    'message' => 'update success'
                ]);
            } elseif ($bocor > 0) {
                if ($request->status == 1) {
                    $pesan = $bendungan->nama_bendungan . " Pada " . $bocor_get->created_at . " STATUS WASPADA 1";
                    $pesan_pemda = $bendungan->nama_bendungan . " Pada " . $bocor_get->created_at . " STATUS WASPADA 1";
                    $pesan_umum = $bendungan->nama_bendungan . " Pada " . $bocor_get->created_at . " STATUS WASPADA 1";
                    DataBanjirBocor::where('id_banjir_bocor', $request->id)->update(['id_role' => $request->id_role, 'status' => 1, 'updated_at' => now(), 'updated_by' => 'AndroidApps']);
                    Notif::where('id_referensi', $request->id)->update([
                        'role_bocor' => $request->role_bocor, 'status' => 1, 'pesan_default' => $pesan, 'updated_at' => now(), 'updated_by' => 'Android Apps'
                    ]);
                    return response()->json([
                        'status' => true,
                        'message' => 'update success'
                    ]);
                } elseif ($request->status == 2) {
                    $pesan_pemda = $bendungan->nama_bendungan . " Pada " . $bocor_get->created_at . " \nSTATUS WASPADA 2\ntelah muncul indikasi potensi keruntuhan bendungan,\ntetapi belum ada bahaya yang segera terjadi\nMemerlukan Pengungsian untuk wilayah ZONA HIJAU Pada Peta BAHAYA BANJIR DI HILIR " . strtoupper($bendungan->nama_bendungan);
                    $pesan_umum = $bendungan->nama_bendungan . " Pada " . $bocor_get->created_at . " \nSTATUS WASPADA 2\nDi Himbau Masyarakat Di Wilayah ZONA HIJAU segera MENGUNGSI";
                    $pesan = $bendungan->nama_bendungan . " Pada " . $bocor_get->created_at . " STATUS WASPADA 2";
                    DataBanjirBocor::where('id_banjir_bocor', $request->id)->update(['id_role' => $request->id_role, 'status' => 2, 'updated_at' => now(), 'updated_by' => 'Android Apps']);
                    Notif::where('id_referensi', $request->id)->update([
                        'role_bocor' => $request->role_bocor, 'status' => 2, 'pesan_default' => $pesan, 'pesan_pemda' => $pesan_pemda, 'pesan_umum' => $pesan_umum, 'updated_at' => now(), 'updated_by' => 'AndroidApps'
                    ]);
                    return response()->json([
                        'status' => true,
                        'message' => 'update success'
                    ]);
                } elseif ($request->status == 3) {
                    $pesan_pemda = $bendungan->nama_bendungan . " Pada " . $bocor_get->created_at . " \nSTATUS SIAGA\ntelah Pada Kondisi ini Kemungkinan Bendungan Dapat Runtuh,\nSaat ini sedang dilakukan upaya-upaya perbaikan\nMemerlukan Pengungsian untuk wilayah Zona KUNING Pada Peta BAHAYA BANJIR DI HILLIR " . strtoupper($bendungan->nama_bendungan);
                    $pesan_umum = $bendungan->nama_bendungan . " Pada " . $bocor_get->created_at . " \nSTATUS SIAGA\nDi Himbau Masyarakat Di Wilayah ZONA KUNING(ZONA EVAKUASI) segera MENGUNGSI";
                    $pesan = $bendungan->nama_bendungan . " Pada " . $bocor_get->created_at . "STATUS SIAGA";
                    DataBanjirBocor::where('id_banjir_bocor', $request->id)->update(['id_role' => $request->id_role, 'status' => 3, 'updated_at' => now(), 'updated_by' => 'Android Apps']);
                    Notif::where('id_referensi', $request->id)->update([
                        'role_bocor' => $request->role_bocor, 'status' => 3, 'pesan_default' => $pesan, 'pesan_pemda' => $pesan_pemda, 'pesan_umum' => $pesan_umum, 'updated_at' => now(), 'updated_by' => 'AndroidApps'
                    ]);
                    return response()->json([
                        'status' => true,
                        'message' => 'update success'
                    ]);
                } elseif ($request->status == 4) {
                    // dd($request->all());
                    $pesan_pemda = $bendungan->nama_bendungan . " Pada " . $bocor_get->created_at . " \nSTATUS AWAS\ntelah Pada Kondisi ini Kemungkinan Bendungan Akan Runtuh\nMemerlukan Pengungsian untuk wilayah ZONA MERAH Pada Peta BAHAYA BANJIR DI HILIR " . strtoupper($bendungan->nama_bendungan);
                    $pesan_umum = $bendungan->nama_bendungan . " Pada " . $bocor_get->created_at . " \nSTATUS AWAS\nDi Himbau Masyarakat Di Wilayah ZONA MERAH(ZONA EVAKUASI 1 dan ZONA EVAKUASI 2) segera MENGUNGSI";
                    $pesan = $bendungan->nama_bendungan . " Pada " . $bocor_get->created_at . "STATUS AWAS";
                    DataBanjirBocor::where('id_banjir_bocor', $request->id)->update(['id_role' => $request->id_role, 'status' => 4, 'updated_at' => now(), 'updated_by' => 'Android Apps']);
                    Notif::where('id_referensi', $request->id)->update([
                        'role_bocor' => $request->role_bocor, 'status' => 4, 'pesan_default' => $pesan, 'pesan_pemda' => $pesan_pemda, 'pesan_umum' => $pesan_umum, 'updated_at' => now(), 'updated_by' => 'AndroidApps'
                    ]);
                    return response()->json([
                        'status' => true,
                        'message' => 'update success'
                    ]);
                }
                // else{
                //     DataBanjirBocor::where('id_banjir_bocor', $request->id)->update(['id_role' => $request->id_role, 'status' => $request->status, 'updated_at' => now(), 'updated_by' => 'Android Apps']);
                //     Notif::where('id_referensi', $request->id)->update([
                //         'role_bocor' => $request->role_bocor, 'updated_at' => now(), 'updated_by' => 'AndroidApps'
                //     ]);
                //     return response()->json([
                //         'status' => true,
                //         'message' => 'update success'
                //     ]);
                // }
            } else {
                return response([
                    'success' => false,
                    'message' => 'Data tidak sesuai,',
                ]);
            }
        } catch (Exception $th) {
            // dd($th->getMessage());
            return response([
                'success' => false,
                'message' => 'Data tidak sesuai.',
            ]);
        }
    }

    public function register(Request $request)
    {
        try {
            UserBendungan::create(['id_user' => Str::uuid(), 'nama' => $request->nama, 'email' => $request->email, 'hp' => $request->hp, 'username' => $request->username, 'password' => Hash::make($request->password), 'id_role' => '65877613b110ff8ae52069c50181c077', 'id_desa' => $request->id_desa, 'created_at' => now(), 'created_by' => 'Penduduk']);
            return response()->json([
                'status' => true,
                'message' => 'register success'
            ], 200);
        } catch (Exception $th) {
            return response([
                'success' => false,
                'message' => 'Data tidak sesuai',
            ]);
        }
    }

    public function login($username, $password)
    {
        $user = UserBendungan::where('username', $username)->first();
        if (!Hash::check($password, $user->password)) {
            return response([
                'success' => false,
                'message' => 'Login Gagal',
            ]);
        } else {
            $data['login'] = UserBendungan::leftJoin('ref_role', 'ref_role.id_role', '=', 'ref_user.id_role')->leftJoin('ref_desa', 'ref_desa.id_desa', '=', 'ref_user.id_desa')->leftJoin('ref_pengungsian', 'ref_pengungsian.id_pengungsian', '=', 'ref_desa.id_pengungsian')->leftJoin('ref_titik_kumpul', 'ref_titik_kumpul.id_titik_kumpul', '=', 'ref_desa.id_titik_kumpul')->where('username', $username)->get();
            return response([
                // 'success' => true,
                // 'message' => 'List Data',
                'data' => $data['login']
            ]);
        }
    }

    public function device_ready($id = null)
    {
        try {
            if (isset($id)) {
                $mac = Log::where('mac_add', $id)->count();
                $keterangan = Log::where('keterangan', $id)->count();
                if ($mac > 0) {
                    $data['mac'] = Log::where('mac_add', $id)->get();
                    return response([
                        // 'success' => true,
                        // 'message' => 'List Data',
                        'data' => $data['mac']
                    ]);
                } elseif ($keterangan > 0) {
                    $data['keterangan'] = Log::where('keterangan', $id)->get();
                    return response([
                        // 'success' => true,
                        // 'message' => 'List Data',
                        'data' => $data['keterangan']
                    ]);
                } else {
                    return response([
                        'success' => false,
                        'message' => 'Data tidak sesuai',
                    ]);
                }
            } else {
                $data['log'] = Log::all();
                return response([
                    // 'success' => true,
                    // 'message' => 'List Data',
                    'data' => $data['log']
                ]);
            }
        } catch (Exception $th) {
            return response([
                'success' => false,
                'message' => 'Data tidak sesuai',
            ]);
        }
    }

    public function check_device($id)
    {
        try {
            $data = UserBendungan::select('total_device')->where('id_user', $id)->first();
            $data['device_kosong'] = Log::whereNull('mac_add')->where('id_user', $id)->count();
            return response([
                // 'success' => true,
                // 'message' => 'List Data',
                'data' => [$data]
            ]);
        } catch (Exception $th) {
            return response([
                'success' => false,
                'message' => 'Data tidak sesuai',
            ]);
        }
    }

    public function add_device(Request $request)
    {
        try {
            Log::where('id_user', $request->id_user)->whereNull('keterangan')->first()->update(['mac_add' => $request->mac_add, 'keterangan' => $request->keterangan]);
            return response()->json([
                'status' => true,
                'message' => 'pendaftaran device success'
            ], 200);
        } catch (Exception $th) {
            return response([
                'success' => false,
                'message' => 'Data tidak sesuai',
            ]);
        }
    }

    public function check_user($id = null)
    {
        try {
            if (isset($id)) {
                $check_user = UserBendungan::where('username', 'like', $id)->count();
                $check_email = UserBendungan::where('email', 'like', $id)->count();
                $data['detail'] = [['keterangan' => 'Username dan Email Masih Kosong']];
                $data['user'] = [['keterangan' => 'Username Sudah Ada']];
                $data['mail'] = [['keterangan' => 'Email Sudah Ada']];
                if ($check_user > 0) {
                    return response([
                        'status' => 'gagal',
                        // 'message' => 'Username Sudah Ada',
                        'data' => $data['user']
                    ]);
                } elseif ($check_email > 0) {
                    return response([
                        'status' => 'gagal',
                        'data' => $data['mail']
                    ]);
                } else {
                    return response([
                        'status' => 'success',
                        // 'success' => true,
                        // 'message' => 'Username dan Email Masih Kosong',
                        'data' => $data['detail']
                    ]);
                }
            } else {
                return response([
                    // 'success' => false,
                    // 'message' => 'Data tidak sesuai',
                    'data' => 'Data Tidak Sesuai'
                ]);
            }
        } catch (Exception $e) {
            return response([
                'success' => false,
                'message' => 'Data tidak sesuai',
            ]);
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
        ]);
    }

    public function peta_aktif()
    {
        $data['peta'] = peta::where('aktif', 1)->get();
        return response([
            'data' => $data['peta']
        ]);
    }

    public function desa_filter()
    {
        $data['filter'] = DB::select("SELECT
                ref_desa.id_desa,
                ref_desa.id_pengungsian,
                ref_desa.id_titik_kumpul,
                ref_desa.kode_desa,
                ref_desa.desa_lat,
                ref_desa.desa_long,
                ref_desa.radius,
                ref_desa.kelurahan_desa,
                ref_desa.kecamatan_desa,
                ref_desa.kabupaten_desa,
                ref_desa.jarak_dari_bendungan,
                ref_desa.id_kategori,
                ref_titik_kumpul.kode_tk,
                ref_titik_kumpul.tk_lat,
                ref_titik_kumpul.tk_long,
                ref_titik_kumpul.nama_titik_kumpul,
                ref_titik_kumpul.nama_desa,
                ref_titik_kumpul.nama_kecamatan,
                ref_titik_kumpul.nama_kabupaten,
                ref_titik_kumpul.jarak_ke_tk,
                ref_pengungsian.kode_pengungsian,
                ref_pengungsian.pengungsian_lat,
                ref_pengungsian.pengungsian_long,
                ref_pengungsian.nama_pengungsian,
                ref_pengungsian.nama_desa_pengungsian,
                ref_pengungsian.nama_kecamatan_pengungsian,
                ref_pengungsian.nama_kabupaten_pengungsian,
                ref_pengungsian.jarak_pengungsian
            FROM
                ref_desa
                INNER JOIN
                ref_titik_kumpul
                ON
                    ref_desa.id_titik_kumpul = ref_titik_kumpul.id_titik_kumpul
                INNER JOIN
                ref_pengungsian
                ON
                    ref_desa.id_pengungsian = ref_pengungsian.id_pengungsian
            GROUP BY
                ref_desa.id_desa,
                ref_desa.id_pengungsian,
                ref_desa.id_titik_kumpul,
                ref_desa.kode_desa,
                ref_desa.desa_lat,
                ref_desa.desa_long,
                ref_desa.radius,
                ref_desa.kelurahan_desa,
                ref_desa.kecamatan_desa,
                ref_desa.kabupaten_desa,
                ref_desa.jarak_dari_bendungan,
                ref_desa.id_kategori,
                ref_titik_kumpul.kode_tk,
                ref_titik_kumpul.tk_lat,
                ref_titik_kumpul.tk_long,
                ref_titik_kumpul.nama_titik_kumpul,
                ref_titik_kumpul.nama_desa,
                ref_titik_kumpul.nama_kecamatan,
                ref_titik_kumpul.nama_kabupaten,
                ref_titik_kumpul.jarak_ke_tk,
                ref_pengungsian.kode_pengungsian,
                ref_pengungsian.pengungsian_lat,
                ref_pengungsian.pengungsian_long,
                ref_pengungsian.nama_pengungsian,
                ref_pengungsian.nama_desa_pengungsian,
                ref_pengungsian.nama_kecamatan_pengungsian,
                ref_pengungsian.nama_kabupaten_pengungsian,
                ref_pengungsian.jarak_pengungsian
            ORDER BY ref_desa.kode_desa ASC");
        return response([
            'data' => $data['filter']
        ]);
    }
}
