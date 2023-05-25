@extends('templates.admin')

@section('admin_content')

<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Ubah Paket Qurban</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/paket">Paket Qurban</a></li>
                        <li class="breadcrumb-item active">Ubah</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="row d-flex align-items-center justify-content-center">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Ubah Paket</h4>
                    <p class="card-title-desc">
                        Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.
                    </p>

                    <form class="needs-validation" novalidate action="/paket/put" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Nama / Judul</label>
                                            <input type="text" name="name" value="{{$data->name}}" class="form-control" placeholder="Nama / Judul Paket" value="" required>
                                            <input type="hidden" name="id" value="{{$data->id}}>">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Harga</label>
                                            <input type="text" class="form-control" data-type='currency' value="{{number_format($data->price, 0,",",".")}}" name="price" placeholder="" value="" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Unit</label>
                                            <input type="text" class="form-control" value="{{$data->unit}}" name="unit" placeholder="Kalen, Bungkus, dll" value="" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Total / Kuota</label>
                                            <input type="text" class="form-control" value="{{$data->lots}}" name="lots" value="" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Deskripsi</label>
                                            <textarea class="form-control" name="description" value="" required placeholder="Ketik apapun disini perihal paket ini">{{$data->description}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Thumbnail / Foto</label> <br>
                                        <img id="thumbnail_preview" src="{{asset('assets/images/paket/'.$data->thumbnail)}}" class="mb-3" style="width:100%" alt="Thumbnail Paket Kurban" />
                                        <input type="file" accept="image/*" class="form-control" name="thumbnail" id="thumbnail" value="" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <a href="/paket" class="btn btn-light waves-effect waves-light">Batal</a> &nbsp;
                            <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
                        </div>
                    </form>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end page title -->
</div>

@push('custom-scripts')
    <script>
			thumbnail.onchange = evt => {
				const [file] = thumbnail.files
				if (file) {
					thumbnail_preview.src = URL.createObjectURL(file)
				}
			}
    </script>
@endpush
@endsection
