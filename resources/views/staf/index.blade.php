@extends('templates.admin')

@section('admin_content')
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Petugas</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item active">Petugas</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-end mb-4">
                <a href="petugas/tambah" class="btn btn-primary waves-effect waves-light">Tambah Petugas</a>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar Petugas</h4>
                    <p class="card-title-desc">
                        Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.
                    </p>

                    <table id="staf-datatables" class="table dt-responsive nowrap w-100 staf-datatables">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>No WA</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end page title -->
</div>

@push('custom-scripts')
    <script>
        var table = $('.staf-datatables').DataTable({
            processing: true,
            serverSide: true,
            ajax: "/petugas",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'handphone', name: 'handphone'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ],
        });
        $('.staf-datatables').on('click','#deleteModal',function(){
            var id = $(this).attr('data-id');
            var table = $(this).attr('data-table');
            var nama = $(this).attr('data-nama');

            $(".nameDataModal").html(nama);
            $("#idTxtModalDelete").val(id);
            $("#tableTxtModalDelete").val(table);
        });
    </script>
@endpush
@endsection
