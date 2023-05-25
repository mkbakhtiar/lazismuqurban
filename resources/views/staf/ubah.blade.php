@extends('templates.admin')

@section('admin_content')
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Ubah Petugas</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/petugas">Petugas</a></li>
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
                    <h4 class="card-title">Ubah Petugas</h4>
                    <p class="card-title-desc">
                        Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.
                    </p>

                    <form class="needs-validation" id="UbahPetugasForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Nama Petugas</label>
                                            <input type="text" name="name" id="name" class="form-control" placeholder="Nama Petugas" value="{{$data->name}}" required>
                                            <input type="hidden" name="id_staf" id="id_staf" class="form-control" value="{{$data->id}}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">No WA</label>
                                            <input type="number" pattern="[0-9]*" id="handphone" inputmode="numeric" class="form-control" name="handphone" placeholder="" value="{{$data->handphone}}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <a href="/petugas" class="btn btn-light waves-effect waves-light d-flex">Batal</a> &nbsp;
                            <button class="btn btn-primary btnSubmit" type="submit"><span class="place-loader"></span>Simpan</button>
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
        $("#UbahPetugasForm").on("submit", function (e) {
            e.preventDefault();

            var name = $('#name').val();
            var handphone = $('#handphone').val();
            var password = $('#password').val();
            var id_staf = $('#id_staf').val();

            $.ajax({
                type: "POST",
                url: '/petugas/put',
                data: {"_token": "{{ csrf_token() }}", name:name, handphone:handphone, password:password, id:id_staf},
                beforeSend : function(xhr, opts){
                    $(".place-loader").addClass("loadingSpinner");
                    $(".btnSubmit").addClass("d-flex justify-content-center gap-3");
                },
                success: function( response ) {
                    toastr.success('Data petugas berhasil diubah!');

                    if(response.success) {
                         window.setTimeout(function () {
                            location.href = "/petugas";
                        }, 2000);
                    }
                },
                error: function(err) {
                    toastr.error(err.responseJSON.message);
                    $(".place-loader").removeClass("loadingSpinner");
                    $(".btnSubmit").removeClass("d-flex justify-content-center gap-3");
                }
            });
        });
    </script>
@endpush
@endsection
