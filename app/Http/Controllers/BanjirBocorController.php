<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataBanjir;
use Illuminate\Support\Facades\DB;


class BanjirBocorController extends Controller
{
    public function index()
    {
        // mengambil data dari table user
        $data['banjirbocor'] = DB::table('data_banjir_bocor')->get();
        return view('transaksi.bocor.index', $data);

    }
}
