<?php

namespace App\Http\Controllers;

use App\Models\BendunganBendungan;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\UserBendungan;
use DB;
class HomeController extends Controller
{
    public function index()
    {
        // return view('beranda.index');
        $data['bendungan'] = BendunganBendungan::all();
        return view('beranda.detailbendungan', $data);
    }

    public function tabel()
    {
 //       $data['nama_user'] = UserBendungan::find($id);
        return view('master.tabel');
    }

    public function login()
    {
        return view('login.masuk');
    }
}
