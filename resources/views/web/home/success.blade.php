@extends('templates.web')

@section('web_content')
<div class="container-fluid">
    <!-- end page title -->
    <div class="row justify-content-center mt-5 paket-list">
        <div class="col-xl-9">
            <form class="needs-validation" action="/order" method="POST">
            @csrf
            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <div class="row mb-3">
                        <h3>Pembelian Berhasil</h3>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <div class="d-flex gap-3">
                                <div class="">
                                    <img src="{{asset('assets/images/paket/'.$paket->thumbnail)}}" alt="Paket Lazismu Kota Malang {{$paket->name}}" style="width:100px; border-radius:15px;">
                                </div>
                                <div class="">
                                    <h4 style="font-weight:normal">{{$paket->name}}</h4>

                                    <p style="font-size:12px;"><b>Rp {{number_format($paket->price,0,",",".")}}</b> {{$paket->lots}} {{$paket->unit}} </p>
                                    <p style="font-size:12px;margin-top:-10px;">{{substr($paket->description, 0, 100)}}...</p>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="row mb-3">
                        <h6>Jumlah {{$transaksi->qty}} Item</h6>
                        <h6>Total Yang Harus Dibayar Rp {{number_format($transaksi->nominal,0,",",".")}}</h6>
                    </div>
                    <div class="row mb-3">
                        <div class="bg-light p-3 mb-3">
                            <p>Selesaikan kebaikan Anda dengan mengirimkan tagihan ke <b>Nomor Rekening 1111111 a.n Bapak Mr</b> & Kirimkan bukti pembayaran melalui WA yang Anda terima dari Admin Lazismu Kota Malang</p>
                        </div>
                        <p style="font-size:12px;">Tidak ada WA dari Admin Lazismu Kota Malang ? <a href="wa.me/6285732455061" target="_blank">Klik Link Ini</a></p>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
