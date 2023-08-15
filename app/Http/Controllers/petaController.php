<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\peta;
use Illuminate\Http\Request;

class petaController extends Controller
{
    public function index(){
        $data['peta'] = peta::all();
        return view('master.peta.index', $data);
    }

    public function peta($id, $set){

    }
}
