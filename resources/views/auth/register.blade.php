@extends('templates.auth')

@section('content')
    <div class="sw-lg-70 min-h-100 bg-foreground d-flex justify-content-center align-items-center shadow-deep py-5 full-page-content-right-border">
        <div class="sw-lg-50 px-5">
            <div class="sh-11 mb-5">
                <div>
                    <a href="/" class="">
                        <img src="assets/images/logo-lazismu.png" alt="" height="70" class="auth-logo logo-dark mx-auto">
                        <img src="assets/images/logo-lazismu.png" alt="" height="70" class="auth-logo logo-light mx-auto">
                    </a>
                </div>
            </div>
            <div class="mb-5">
                <p class="h6">Please use the form to register.</p>
                <p class="h6">
                    If you are a member, please
                    <a href="/login">login</a>
                    .
                </p>
            </div>
            <div>
                <form id="registerForm" class="tooltip-end-bottom" method="POST" action="{{ route('register') }}" novalidate>
                    @csrf
                    <div class="mb-3 filled form-group tooltip-end-top">
                        <i data-acorn-icon="user"></i>
                        <input class="form-control @error('name') is-invalid @enderror" placeholder="Name" name="name" />

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3 filled form-group tooltip-end-top">
                        <i data-acorn-icon="email"></i>
                        <input class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" />

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3 filled form-group tooltip-end-top">
                        <i data-acorn-icon="lock-off"></i>
                        <input class="form-control @error('password') is-invalid @enderror" name="password" type="password" placeholder="Password" />

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3 filled form-group tooltip-end-top">
                        <i data-acorn-icon="lock-off"></i>
                        <input class="form-control @error('password') is-invalid @enderror" name="password_confirmation" type="password" placeholder="Password Confirm" />

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-lg btn-primary">Signup</button>
                </form>
            </div>
        </div>
    </div>
@endsection
