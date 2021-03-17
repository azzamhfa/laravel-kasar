@extends('layouts/main')

@section('title', 'Login')

@section('container')
    <link rel="stylesheet" href="login.css">
    <main class="form-signin">
        <p>{{ $status }}</p>
        <form action="/auth" method="POST">
            <h1 class="h3 mb-3 fw-normal">Sign In</h1>
            <label for="inputEmail" class="visually-hidden">Email address</label>
            @csrf
            <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
            <label for="inputPassword" class="visually-hidden">Password</label>
            <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
            <p class="mt-5 mb-3 text-muted">&copy; For Education Purposes Only</p>
        </form>
    </main>

@endsection
