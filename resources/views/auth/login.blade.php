
@extends('layouts.app')

@section('content')
    <main class="main-content  mt-0">
        <div class="page-header align-items-start min-vh-50 pt-7 pb-9 m-3 border-radius-lg"
            style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signin-cover.jpg');">
            <span class="mask bg-gradient-dark opacity-6"></span>
        </div>
        <div class="container">
            <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
                <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                    <div class="card mt-5">
                        <div class="card-header pb-0 text-start">
                            <h3 class="font-weight-bolder">Seja Bem Vindo</h3>
                        </div>
                        <div class="card-body">
                            <form role="form" method="POST" action="{{route('login.perform') }}" class="text-start">
                                @csrf
                                <label>Email</label>
                                <div class="mb-3">
                                    <input type="email" name="email"  value={{ old('email') }}class="form-control" placeholder="Email" aria-label="Email">
                                    @error('email') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <label>Password</label>
                                <div class="mb-3">
                                    <input type="password" name="password" class="form-control" placeholder="Password" aria-label="Password">
                                    @error('password') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="rememberMe">
                                    <label class="form-check-label" for="rememberMe">Lembrar-me</label>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary w-100 mt-4 mb-0">Entrar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('layouts.footers.auth.desc-footer')
@endsection
