<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $film = file_get_contents("http://localhost:5001/moviesDB");
        $filmData = json_decode($film);
        return view('welcome', ['daftarFILM' => $filmData]);
    } 


}
