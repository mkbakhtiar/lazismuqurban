@extends('templates.auth')

@section('content')

@push('css-style')
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
        }

        /* Firefox */
        input[type=number] {
        -moz-appearance: textfield;
        }
    </style>
@endpush


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
                        <form id="loginForm" class="tooltip-end-bottom">
                            @csrf
                            <div class="mb-3 auth-form-group-custom mb-4">
                                <i class="dripicons-phone auti-custom-input-icon"></i>
                                <label for="handphone">No WA</label>
                                <input type="number" pattern="[0-9]*" inputmode="numeric" class="form-control{{ $errors->has('handphone') ? ' is-invalid' : '' }}" name="handphone" id="handphone" required placeholder="Masukan nomor WA">

                                @if ($errors->has('handphone'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('handphone') }}</strong>
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

                            <div class="mt-4 text-center">
                                <button class="btn btn-primary w-md waves-effect waves-light btnSubmit" type="submit"><div class="place-loader"></div>Log In</button>
                            </div>

                            <div class="mt-4 text-center">
                                Belum punya akun? <a href="/register" class="text-muted"> Daftar Disini </a>
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
    @push('custom-scripts')
        <script>
             $("#loginForm").on("submit", function (e) {
                e.preventDefault();

                var handphone = $('#handphone').val();
                var password = $('#userpassword').val();

                $.ajax({
                    type: "POST",
                    url: '/login',
                    data: {"_token": "{{ csrf_token() }}", handphone:handphone, password:password},
                    beforeSend : function(xhr, opts){
                        $(".place-loader").addClass("loadingSpinner");
                        $(".btnSubmit").addClass("d-flex justify-content-center gap-3");
                    },
                    success: function( response ) {
                        if(response.success) {
                            window.location.href='/home';
                        }
                    },
                    error: function(err) {
                        toastr.error(err.responseJSON.data);
                        $(".place-loader").removeClass("loadingSpinner");
                        $(".btnSubmit").removeClass("d-flex justify-content-center gap-3");
                    }
                });


             })
        </script>
    @endpush
@endsection
