<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Pengaturan extends Controller
{
    public function qr()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/qr',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'Authorization: VKV@d+tb1541aPL7nJDu'
            ),
        ));

        $response = curl_exec($curl);

        dd($response);

        curl_close($curl);
        $res = json_decode($response, true);
        if (isset($res['url'])) {
            $data['qr'] = $res['url'];
        }

        return view('pengaturan.qr', $data);
    }
}
