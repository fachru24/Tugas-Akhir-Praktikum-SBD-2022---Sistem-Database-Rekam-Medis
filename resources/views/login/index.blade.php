@extends('login.layout')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-4">
        @if(session()->has('loginError'))
            <div class="alert-danger alert-dismissible fade show" role="alert">
                {{ session('loginError') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><button>
            </div>
        @endif
    <main class="form-signin">
        <h1 class="h3 mb-3 fw-normal text-center">Please Login</h1>
    <form action="/login" method="post">
        @csrf
        <div class="form-floating">
            <input type="email" name='email' class="form-control @error('email') is-invalid @enderror" id="email" placeholder="email" autofocus requrired>
            <label for="email">Email</label>
            @error('email')
            <div class="ivalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-floating">
            <input type="password" name='password' class="form-control" id="password" placeholder="Password" required>
            <label for="password">Password</label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
    </form>
    <small class="d-block text-center mt-3">Not registered? <a href="/register">Register Now!</a> </small>
</main>
    </div>
</div>

@endsection