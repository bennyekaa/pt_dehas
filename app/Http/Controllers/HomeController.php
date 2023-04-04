<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\UserBendungan;

class HomeController extends Controller
{
    public function index()
    {
        return view('beranda.index');
    }

    public function tabel()
    {
 //       $data['nama_user'] = UserBendungan::find($id);
        return view('master.tabel');
    }
}
