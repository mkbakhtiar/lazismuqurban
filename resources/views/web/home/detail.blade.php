@extends('templates.web')

@section('web_content')
<!-- start page title -->
<div class="row">
    <div class="col-12 header-bg mb-4" style="margin-top:0px;padding:100px 0;background-position:0px 0px;background-image: linear-gradient(to bottom, rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url({{asset('assets/images/bg.jpg')}});background-size:cover;background-repeat:no-repeat;">
        <div class="container-fluid">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="title">Detail Paket Lazismu <br>{{$paket->name}}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="/" style="color:white">Home</a></li>
                        <li class="breadcrumb-item active">Detail Paket Lazismu</li>

                    </ol>
                </div>

            </div>
        </div>
    </div>

</div>
<div class="container-fluid">
    <!-- end page title -->
    <div class="row justify-content-center mt-5 paket-list">
        <div class="col-xl-9">
            <form class="needs-validation" action="/order" method="POST">
            @csrf
            <div class="row">
                <div class="col-xl-7">
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <div class="d-flex gap-3">
                                <div class="">
                                    <img src="{{asset('assets/images/paket/'.$paket->thumbnail)}}" alt="Paket Lazismu Kota Malang {{$paket->name}}" style="width:100px; border-radius:15px;">
                                </div>
                                <div class="">
                                    <h4 style="font-weight:normal">{{$paket->name}}</h4>

                                    <p style="font-size:12px;"><b>Rp{{number_format($paket->price,0,",",".")}}</b> {{$paket->lots}} {{$paket->unit}} </p>
                                    <p style="font-size:12px;margin-top:-10px;">{{substr($paket->description, 0, 100)}}...</p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="col-lg-12">

                            <input type="hidden" name="" id="hidPrice" value="{{$paket->price}}">
                            <input type="hidden" name="packages_id" id="packages_id" value="{{$paket->id}}">
                            <input type="hidden" name="nominal" id="nominal" value="{{session()->get('nominal') === null ? $paket->price : session()->get('nominal')}}">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Jumlah Pesan*</label>
                                                <input type="number" pattern="[0-9]*" min="1" value="1" placeholder="0" inputmode="numeric" class="form-control" id="qty" name="qty" value="{{session()->get('qty')}}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Nama Lengkap*</label>
                                                <input type="text" name="customer_name" id="customer_name" class="form-control" placeholder="Masukan Nama Customer" value="{{session()->get('customer_name')}}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">No WA*</label>
                                                <input type="number" pattern="[0-9]*" id="customer_phone" inputmode="numeric" class="form-control" name="customer_phone" placeholder="Masukan No WA" value="{{session()->get('customer_phone')}}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Provinsi</label>
                                                <select name="province_id" class="form-control" id="province_id" required>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Kota</label>
                                                <select name="city_id" class="form-control" id="city_id" required>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Alamat Lengkap</label>
                                                <textarea class="form-control" id="customer_address" name="customer_address" value="" placeholder="Masukan Alamat Lengkap">{{session()->get('customer_address')}}</textarea>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-xl-5">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="d-flex flex-column bg-light bg-gradient p-3 rounded-3">
                                <div class="">
                                    <h4 style="font-weight:normal">Checkout</h4>
                                    <hr>
                                    <div class="d-flex justify-content-between mb-2">
                                        <div class="">Harga</div>
                                        <div class="">Rp {{number_format($paket->price,0,",",".")}}</div>
                                    </div>
                                    <div class="d-flex justify-content-between mb-3">
                                        <div class="">Jumlah</div>
                                        <div class="qty-order">{{session()->get('qty') === null ? "1" : session()->get('qty')}}</div>
                                    </div>
                                    <div class="d-flex justify-content-between mb-3">
                                        <div class="">Total Pembayaran</div>
                                        <div class="grand-order fs-5 fw-bold">Rp {{number_format(session()->get('nonimal') === null ? $paket->price : session()->get('nonimal') ,0,",",".")}}</div>
                                    </div>
                                </div>
                                <div class=""></div>
                                <div class="d-flex flex-column gap-2">
                                    <button class="btn btn-primary btnSubmit" type="submit"><span class="place-loader"></span>Pesan & Bayar</button>
                                    <a href="/" class="btn bg-white">Batal</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
@push('custom-scripts')
    <script>
        $("#qty").on("change", function (e) {
            $(".qty-order").html($(this).val());
            $(".grand-order").html(new Intl.NumberFormat("id-ID", { style: "currency", currency: "IDR", minimumFractionDigits: 0 }).format($(this).val() * $("#hidPrice").val()));
            $("#nominal").val($(this).val() * $("#hidPrice").val());
        });
        $("#qty").on("keyup", function (e) {
            $(".qty-order").html($(this).val());
            $(".grand-order").html(new Intl.NumberFormat("id-ID", { style: "currency", currency: "IDR", minimumFractionDigits: 0 }).format($(this).val() * $("#hidPrice").val()));
            $("#nominal").val($(this).val() * $("#hidPrice").val());
        });

        $.ajax({
            type: "GET",
            url: 'https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json',
            success: function( response ) {
                $.each(response, function (i, item) {
                    $('#province_id').append($('<option>', {
                        value: item.id,
                        text : item.name
                    }));
                });
            },
            error: function(err) {
                toastr.error(err);
            }
        });

        $("#province_id").on("change", function (e) {
					$("#city_id").html("");
            $.ajax({
                type: "GET",
                url: 'https://www.emsifa.com/api-wilayah-indonesia/api/regencies/'+$(this).val()+'.json',
                success: function( response ) {
                    $.each(response, function (i, item) {
                        $('#city_id').append($('<option>', {
                            value: item.id,
                            text : item.name
                        }));
                    });
                },
                error: function(err) {
                    toastr.error(err);
                }
            });
        });

    </script>
@endpush
@endsection
