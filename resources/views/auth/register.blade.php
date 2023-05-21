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
        .digit-group input {
            width: 50px;
            height: 50px;
            background-color: lightcyan;
            border: solid 1px cyan;
            border-radius:10px;
            line-height: 50px;
            text-align: center;
            font-size: 24px;
            font-family: "Raleway", sans-serif;
            font-weight: 200;
            color: darkcyan;
            margin: 0 2px;
        }
        .digit-group .splitter {
            display:flex;
            align-items: center;
            padding:0 3px;
            color: gray;
            font-size: 24px;
        }
    </style>
@endpush

    <div class="sw-lg-70 min-h-100 bg-foreground d-flex justify-content-center align-items-center shadow-deep py-4 full-page-content-right-border">
        <div class="sw-lg-50 px-5">
            <div class="sh-11 mb-4">
                <div>
                    <a href="/" class="">
                        <img src="assets/images/logo-lazismu.png" alt="" height="70" class="auth-logo logo-dark mx-auto">
                        <img src="assets/images/logo-lazismu.png" alt="" height="70" class="auth-logo logo-light mx-auto">
                    </a>
                </div>
            </div>
            <div class="mb-4">
                <p id="welcomeMsg">Daftar sebagai petugas Qurban Lazismu. <br> Jika sudah mempunyai akun klik
                    <a href="/login">login</a>
                    .
                </p>
            </div>
            <div class="panelRegister">
                <form id="registerForm" class="tooltip-end-bottom">
                    @csrf
                    <div class="mb-3 auth-form-group-custom">
                        <i class="ri-user-2-line auti-custom-input-icon"></i>
                        <label for="handphone">Nama Lengkap</label>
                        <input class="form-control @error('name') is-invalid @enderror" placeholder="Nama Lengkap" name="name" id="name" />

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3 auth-form-group-custom">
                        <i class="dripicons-phone auti-custom-input-icon"></i>
                        <label for="handphone">No WA</label>
                        <input type="number" pattern="[0-9]*" inputmode="numeric" class="form-control{{ $errors->has('handphone') ? ' is-invalid' : '' }}" name="handphone" id="handphone"  placeholder="Masukan nomor WA">

                        @if ($errors->has('handphone'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('handphone') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="mb-3 auth-form-group-custom mb-4">
                        <i class="ri-lock-2-line auti-custom-input-icon"></i>
                        <label for="userpassword">Kata Sandi</label>
                        <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="userpassword"  placeholder="Masukan kata sandi">

                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="mb-3 auth-form-group-custom mb-4">
                        <i class="ri-lock-2-line auti-custom-input-icon"></i>
                        <label for="password_confirmation">Ulangi Kata Sandi</label>
                        <input class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation" type="password" placeholder="Password Confirm"  />

                        @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong id="err-password_confirmation">{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                    <div class="mb-3">
                        <span id="err-system" role="alert" style="font-size:12px;"></span>
                    </div>
                    <button class="btn btn-primary w-md waves-effect waves-light btnSubmit" type="submit"> <div class="place-loader"></div> Daftar Sekarang</button>
                </form>
            </div>
            <div class="panelOTP" style="display:none">
                <form action="sendOTPForm">
                    @csrf
                    <div class="mb-4 d-flex digit-group">
                        <input type="number" id="digit-1" name="digit-1" required data-next="digit-2" />
                        <span class="splitter">&ndash;</span>
                        <input type="number" id="digit-2" name="digit-2" required data-next="digit-3" data-previous="digit-1" />
                        <span class="splitter">&ndash;</span>
                        <input type="number" id="digit-3" name="digit-3" required data-next="digit-4" data-previous="digit-2" />
                        <span class="splitter">&ndash;</span>
                        <input type="number" id="digit-4" name="digit-4" required data-previous="digit-3" />
                    </div>
                    <div class="">
                        <p>Tidak menerima Kode OTP di WA?<br><b>Minta kode baru dalam <span id="Timer">00:30</span></b></p>
                    </div>
                    <button class="btn btn-primary w-md waves-effect waves-light btnSubmit" type="submit"> <div class="place-loader"></div> Verifikasi Kode </button>
                </form>
            </div>
        </div>
    </div>

    @push('custom-scripts')
        <script>

            $('#registerForm').on('submit', function(e) {
                e.preventDefault();

                var name = $('#name').val();
                var handphone = $('#handphone').val();
                var password = $('#userpassword').val();
                var confirm = $('#password_confirmation').val();

                //validate number WA

                $.ajax({
                    type: "GET",
                    url: '/validate-wa-number/'+handphone,
                    beforeSend : function(xhr, opts){
                        $("#err-system").html("Validate WA Number is Progress");
                        $(".place-loader").addClass("loadingSpinner");
                        $(".btnSubmit").addClass("d-flex justify-content-center gap-3");
                    },
                    success: function( response ) {
                        const jsonResponse = JSON.parse(response);
                        const status = jsonResponse.status;
                        const messages = jsonResponse.message;

                        if(status === '1005') {
                            $("#err-system").html("");
                            toastr.error( messages );
                        } else if(status === '200') {
                            // validate column field
                            $.ajax({
                                type: "POST",
                                url: '/register-validate',
                                data: {"_token": "{{ csrf_token() }}", name:name, handphone:handphone, password:password, password_confirmation: confirm, email: ''},
                                beforeSend : function(xhr, opts){
                                    $("#err-system").html("Validate WA Number is Done &#10004;");
                                    $(".place-loader").addClass("loadingSpinner");
                                    $(".btnSubmit").addClass("d-flex justify-content-center gap-3");
                                },
                                success: function( response ) {
                                    $("#err-system").html("Validation Data is Done &#10004; <br> OTP is Sending...");
                                    // send WA API

                                    $.ajax({
                                        type: "GET",
                                        url: '/send-otp/'+handphone,
                                        beforeSend : function(xhr, opts){
                                            $(".place-loader").addClass("loadingSpinner");
                                            $(".btnSubmit").addClass("d-flex justify-content-center gap-3");
                                        },
                                        success: function( response ) {
                                            const jsonResponse = JSON.parse(response);
                                            if(jsonResponse.status === '200') {
                                                $("#err-system").html("");
                                                $("#welcomeMsg").html('Silahkan isi kode OTP yang sudah dikirimkan <br> ke nomor WA '+ handphone);
                                                $(".panelOTP").css("display","block");
                                                $(".panelRegister").css("display","none");

                                                var timeLeft = 60;
                                                var elem = document.getElementById("Timer");

                                                var timerId = setInterval(countdown, 1000);

                                                function countdown() {
                                                    if (timeLeft == 0) {
                                                        clearTimeout(timerId);
                                                        doSomething();
                                                    } else {
                                                        elem.innerHTML = "00:"+timeLeft;
                                                        timeLeft--;
                                                    }
                                                }
                                            } else {
                                                $("#err-system").html("");
                                                toastr.error( response.message );
                                            }
                                        },
                                        error: function( err ) {
                                            console.log(err);
                                            $("#err-system").html("");
                                        },
                                        complete : function() {
                                            $("#err-system").html("");
                                            $(".place-loader").removeClass("loadingSpinner");
                                            $(".btnSubmit").removeClass("d-flex justify-content-center gap-3");
                                        },
                                    });
                                },
                                error: function(err) {
                                    $("#err-system").html("");
                                    const objectField = Object.keys(err.responseJSON.errors)[0];
                                    const valueObjectField = err.responseJSON.errors[objectField][0];
                                    toastr.error( valueObjectField );
                                    $(".place-loader").removeClass("loadingSpinner");
                                    $(".btnSubmit").removeClass("d-flex justify-content-center gap-3");
                                }
                            });

                        }
                    },
                    error: function(err) {
                        console.log(err);
                        $(".place-loader").removeClass("loadingSpinner");
                        $(".btnSubmit").removeClass("d-flex justify-content-center gap-3");
                    }
                });

            });
        </script>
    @endpush

@endsection
