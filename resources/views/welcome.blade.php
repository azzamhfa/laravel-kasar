@extends('layouts/mainNavbar')

@section('title', 'Welcome')

@section('container')
<link rel="stylesheet" href="login.css">
    <div style="padding-left:10%;padding-right:10%;margin-top:50px">
        <h1>Home</h1>
        <div class="listFilm" style="padding:2vw">
            <div class="container">
                <div class="row">
                    @foreach ($daftarFILM as $films)
                    <div class="col-sm" style="justify-contents: center">
                        <img src="https://dummyimage.com/300x400/000/fff" class="img-fluid" alt="dummy">
                        <p>{{$films->judul_s}}</p>
                        <p>{{$films->harga}}</p>
                        <div class="button">
                            <button type="button" class="btn btn-primary">Pinjam</button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
