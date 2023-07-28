@extends('templates.web')

@section('web_content')
<!-- start page title -->
<div class="row">
    <div class="col-12 p-0 mt-xs-0 mt-lg-4 mt-md-4 mt-sm-4">
        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-bs-target="#carouselExampleFade" data-bs-slide-to="0" class="active"></li>
                    <li data-bs-target="#carouselExampleFade" data-bs-slide-to="1"></li>
                    <li data-bs-target="#carouselExampleFade" data-bs-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block img-fluid" style="" src="https://cdn.lazismu.org/11733/conversions/hJZnLINbF2WTYJmWAx1Z7zbQ6TsehG-metaV2ViIEJhbm5lciBRdXJiYW4gMTQ0NCBIIGxvdy5wbmc=--main.jpg" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block img-fluid" style="" src="https://cdn.lazismu.org/8518/conversions/FEED-YEAH-main.jpg" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block img-fluid" style="" src="https://cdn.lazismu.org/9936/conversions/Xmjdm5bWbQYCbdwSwQPzl6l86OMZAj-metaV2ViIEJhbm5lciBaYWthdCBNYWFsIChCdXR0b24pLnBuZw==--main.jpg" alt="Third slide">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
        </div>
    </div>
</div>
<div class="container-fluid">
    <!-- end page title -->
    <div class="row mt-5 paket-list">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-lg-12">
                    <div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-center">
                                    <h2>Daftar Paket</h2>
                                    <h5>mari dukung program paket kami</h5>
                                </div>
                            </div>

                        </div>

                        <div class="row g-0 mt-5">
                            @foreach ($paket as $item)
                                <div class="col-xl-4 col-sm-6" style="padding: 20px;">
                                    <a href="/paket/lazismu-kota-malang/{{strtolower(str_replace(' ','-',$item->name))}}" class="text-light">
                                        <div class="product-box">
                                            <div class="product-img">
                                                <div class="product-ribbon badge bg-warning">
                                                    {{$item->lots}} {{$item->unit}}
                                                </div>
                                                <div style="width:100%;height:320px; border-radius:20px; background-image: linear-gradient(to bottom, rgba(0,0,0,0) 20%,rgba(0,0,0,0.8)), url({{asset('assets/images/paket/'.$item->thumbnail)}});background-size:100%;background-repeat:no-repeat;"></div>
                                            </div>

                                            <div class="text-left" style="position: absolute;bottom: 35px; padding:15px 30px;z-index:1;">
                                                <h4 style="font-weight:normal mb-0">{{$item->name}}</h4>
                                                <h3 class="mt-0 mb-0 text-light">Rp {{number_format($item->price,0,",",".")}}</h3>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
