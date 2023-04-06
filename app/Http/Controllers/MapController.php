<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Web_custom;

class MapController extends Controller
{
    public function index(){
        $data['custom'] = Web_custom::all()->first();
        // dd($data);
        return view('map.map',$data);
    }
}
