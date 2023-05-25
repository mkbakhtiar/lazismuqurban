@extends('templates.admin')

@section('admin_content')
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Paket</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item active">Paket</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-end mb-4">
                <a href="paket/tambah" class="btn btn-primary waves-effect waves-light">Tambah Paket</a>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar Paket</h4>
                    <p class="card-title-desc">
                        Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.
                    </p>

                    <table id="packages-datatable" class="table dt-responsive nowrap w-100 packages-datatables">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Thumbnail</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Unit</th>
                                <th>Kuota</th>
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
        var table = $('.packages-datatables').DataTable({
            processing: true,
            serverSide: true,
            ajax: "/paket",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {
                    data: 'thumbnail',
                    render: function (data, type) {
                        return "<img src='assets/images/paket/"+data+"' style='width:50px; border-radius:10px;'>";
                    },
                },
                {
                    data: 'name',
                    render: function (data, type, row) {
                        return "<b>"+data+"</b><br><p style='font-size:12px;'>"+row.description+"</p>";
                    },
                },
                {
                    data: 'price',
                    render: function (data, type) {
                        return new Intl.NumberFormat("id-ID", { style: "currency", currency: "IDR", minimumFractionDigits: 0 }).format(data);
                    },
                    className: "text-right"
                },
                {data: 'unit', name: 'unit'},
                {data: 'lots', name: 'lots'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ],
        });
        $('.packages-datatables').on('click','#deleteModal',function(){
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
