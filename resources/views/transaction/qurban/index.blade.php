@extends('templates.admin')

@section('admin_content')
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Transaksi Qurban</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item active">Transaksi Qurban</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-end mb-4">
                <a href="qurban/tambah" class="btn btn-primary waves-effect waves-light">Tambah Transaksi</a>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar Transaksi Qurban</h4>

                     <table cellspacing="5" cellpadding="5" class="mb-4" style="margin-left:-5px;">
                        <tbody>
                            <tr>
                                <td>Cari Mulai Tanggal </td>
                                <td><input type="text" class="form-control" placeholder="{{date('Y-m-d')}}" id="start" name="start"></td>
                            </tr>
                            <tr>
                                <td>Sampai</td>
                                <td><input type="text" class="form-control" id="end" name="end" placeholder="{{date('Y-m-d')}}"></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="right">
                                    <button class="btn btn-primary" id="btn_cari_daterange">
                                        <i class="fa fa-search"></i>
                                        <span class="mx-2">Cari</span>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <table id="transaction-datatable" class="table dt-responsive nowrap w-100 transaction-datatables">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Nama Customer</th>
                                <th>No WA</th>
                                <th>Paket</th>
                                <th>Jumlah</th>
                                <th>Nominal</th>
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
        showData();

        function showData(s='', e=''){
            var postData = {
                'startdate'     : s,
                'enddate'       : e,
            };
            var table = $('.transaction-datatables').DataTable({
                processing: true,
                serverSide: true,
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fa fa-file-excel-o"></i> Excel',
                        titleAttr: 'Export to Excel',
                        title: s !== "" && e !== "" ? 'Daftar Transaksi Qurban '+ s + ' '+' - '+ e : 'Daftar Transaksi Qurban Terbaru',
                        exportOptions: {
                            columns: ':not(:last-child)',
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fa fa-file-text-o"></i> CSV',
                        titleAttr: 'CSV',
                        title: s !== "" && e !== "" ? 'Daftar Transaksi Qurban '+ s + ' '+' - '+ e : 'Daftar Transaksi Qurban Terbaru',
                        exportOptions: {
                            columns: ':not(:last-child)',
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fa fa-file-pdf-o"></i> PDF',
                        titleAttr: 'PDF',
                        title: s !== "" && e !== "" ? 'Daftar Transaksi Qurban '+ s + ' '+' - '+ e : 'Daftar Transaksi Qurban Terbaru',
                        exportOptions: {
                            columns: ':not(:last-child)',
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i> Print',
                        exportOptions: {
                            columns: ':visible'
                        },
                        orientation: 'landscape',
                        customize: function(win) {
                            $(win.document.body).find( 'table' ).find('td:last-child, th:last-child').remove();
                        }
                    }
                ],
                ajax: {
                    'headers': {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    'type': 'POST',
                    'url': 'qurban',
                    'data': postData,
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {
                        data: 'transaction_date',
                        render: function (data, type, row) {
                            return new Date(data).toLocaleString("id-ID", {year: 'numeric', month: '2-digit', day: '2-digit', weekday:"long", hour: '2-digit', hour12: false, minute:'2-digit', second:'2-digit'})
                        }
                    },
                    {
                        data: 'customer_name',
                        render: function (data, type, row) {
                            return "<b>"+data+"</b>";
                        },
                    },
                    {
                        data: 'customer_phone',
                        render: function (data, type, row) {
                            return "<a href='https://wa.me/"+row.customer_phone+"' target='_blank'>"+row.customer_phone+"</a>";
                        },
                    },
                    {
                        data: 'packages_name',
                        render: function (data, type, row) {
                            return "<a href='/paket/ubah/"+row.packages_id+"' target='_blank'>"+data+"</a>";
                        },
                    },
                    {
                        data: 'qty',
                        render: function (data, type, row) {
                            return data + " Item";
                        },
                    },
                    {
                        data: 'nominal',
                        render: function (data, type, row) {
                            return "<b>"+new Intl.NumberFormat("id-ID", { style: "currency", currency: "IDR", minimumFractionDigits: 0 }).format(data)+"</b>";
                        },
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ],
                "bDestroy": true,
            });
        }

        // Refilter the table
        $('#btn_cari_daterange').on('click', function () {
            if($("#start").val() === '') {
                toastr.error('Masukan Filter Tanggal Mulai');
            } else {
                showData($("#start").val(),$("#end").val());
            }
        });
    </script>
@endpush
@endsection
