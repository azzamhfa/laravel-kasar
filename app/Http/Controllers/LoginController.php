<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class LoginController extends Controller
{
    public function login()
    {

        return view('login', ['status' => "awal"]);
    }

    public function auth(Request $req)
    {
        $dataUser = $req->input();


        $arraySend = array(
            'username' => $dataUser['email'],
            'password' => $dataUser['password']
        );

        $data = http_build_query($arraySend);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "http://localhost:5001/moviesDB");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $resp = curl_exec($ch);

        if ($e = curl_error($ch)) {
            echo $e;
        }else{
            $decode = json_decode($resp);
            foreach ($decode as $key => $value) {
                echo $key . ':' . $value;
            }
        }
    }
}
