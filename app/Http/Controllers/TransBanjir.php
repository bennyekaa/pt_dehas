<?php

namespace App\Http\Controllers;

use App\Models\DataMukaAir;
use App\Models\Waduk;
use Illuminate\Http\Request;

class TransBanjir extends Controller
{
    public function index($stat = 0)
    {
        $data['mukaair'] = DataMukaAir::where('status', $stat)->get();
        // dd($data);
        return view('transaksi.mukaair.index', $data);
    }

    public function tambah(){
        $data['mukaair'] = Waduk::all()->sortBy('muka_air');
        return view('transaksi.mukaair.tambah', $data);
    }
}
