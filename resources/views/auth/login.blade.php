@extends('templates.auth')

@section('content')
<div class="authentication-page-content p-4 d-flex align-items-center min-vh-100">
    <div class="w-100">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div>
                    <div class="text-center">
                        <div>
                            <a href="/" class="">
                                <img src="assets/images/logo-lazismu.png" alt="" height="70" class="auth-logo logo-dark mx-auto">
                                <img src="assets/images/logo-lazismu.png" alt="" height="70" class="auth-logo logo-light mx-auto">
                            </a>
                        </div>

                        <h4 class="font-size-18 mt-4">Welcome Back !</h4>
                        <p class="text-muted">Sign in to continue to Lazismu.</p>
                    </div>

                    <div class="p-2 mt-5">
                        <form class="" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="mb-3 auth-form-group-custom mb-4">
                                <i class="ri-user-2-line auti-custom-input-icon"></i>
                                <label for="username">Username</label>
                                <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="username" required placeholder="Masukan username">

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="mb-3 auth-form-group-custom mb-4">
                                <i class="ri-lock-2-line auti-custom-input-icon"></i>
                                <label for="userpassword">Kata Sandi</label>
                                <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="userpassword" required placeholder="Masukan kata sandi">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="mb-3 auth-form-group-custom mb-4">
                                <i class="ri-calendar-event-line auti-custom-input-icon"></i>
                                <label for="useryears">Tahun Anggaran</label>
                                <div class="">
                                    <select name="tahun_anggaran" class="form-control" id="useryears" required>
                                        <option value="">Pilih</option>
                                        <option value="2024">2024</option>
                                        <option value="2023">2023</option>
                                        <option value="2022">2022</option>
                                        <option value="2021">2021</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mt-4 text-center">
                                <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Log In</button>
                            </div>

                            <div class="mt-4 text-center">
                                <a href="auth-recoverpw.html" class="text-muted"><i class="mdi mdi-lock me-1"></i> Forgot your password?</a>
                            </div>
                        </form>
                    </div>

                    <div class="mt-5 text-center">
                        <p>© <script>document.write(new Date().getFullYear())</script> Lazismu. Crafted with <i class="mdi mdi-heart text-danger"></i> by Lazismu</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
