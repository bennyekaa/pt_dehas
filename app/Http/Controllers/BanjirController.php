<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\BanjirBendungan;


class BanjirController extends Controller
{
    public function index()
    {
        // mengambil data dari table user
        $data['banjir'] = DB::table('data_banjir')->get();
        return view('transaksi.banjir', $data);
    }

}
