@extends('templates.admin')

@section('admin_content')
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">@if($type === 'ubah') Ubah @else Detail @endif Transaksi Qurban</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/qurban">Transaksi Qurban</a></li>
                        <li class="breadcrumb-item active">@if($type === 'ubah') Ubah @else Detail @endif</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="row d-flex align-items-center justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <form class="needs-validation" id="@if($type === 'ubah') UbahTransactionForm @endif">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Nama Customer</label>
                                            <input type="text" name="customer_name" id="customer_name" class="form-control" placeholder="Masukan Nama Customer" @if($type === 'detail') disabled @endif value="{{$transaction->customer_name}}" required>
                                            <input type="hidden" name="id" id="id" value="{{$transaction->id}}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">No WA</label>
                                            <input type="number" pattern="[0-9]*" id="customer_phone" inputmode="numeric" class="form-control" name="customer_phone" @if($type === 'detail') disabled @endif placeholder="Masukan No WA" value="{{$transaction->customer_phone}}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">NIK</label>
                                            <input type="number" pattern="[0-9]*" id="customer_nik" inputmode="numeric" class="form-control" name="customer_nik" @if($type === 'detail') disabled @endif placeholder="Masukan NIK" value="{{$transaction->customer_nik}}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Alamat</label>
                                            <textarea class="form-control" id="customer_address" name="customer_address" value="" placeholder="Masukan Alamat Customer" @if($type === 'detail') disabled @endif required>{{$transaction->customer_address}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Catatan</label>
                                            <textarea class="form-control" id="description" name="description" placeholder="Masukan Catatan" required @if($type === 'detail') disabled @endif>{{$transaction->description}}</textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Paket</label>
                                            @if($type === 'ubah')
                                                <div class="d-flex">
                                                    <button type="button" class="btn btn-info showPaketBtn" data-bs-toggle="modal" data-bs-target=".bs-modal-show-package"> Ganti Paket + </button>
                                                </div>
                                            @endif
                                            <input type="hidden" name="packages_id" id="packages_id" required value="{{$transaction->packages_id}}">
                                            <div class="preview-pick @if($type === 'ubah') mt-3 @endif" style="display:flex; background:lightcyan; padding:15px;">
                                                <div class="thumbnail-preview-pick" style="width:15%"><img src='/assets/images/paket/{{$packages->thumbnail}}' style='width:100%;'></div>
                                                <div class="info-preview-pick" style="width:80%; padding: 0px 0px 0px 20px;">
                                                    <h5 class="title-preview-pick">{{$packages->name}}</h5>
                                                    <p class="description-preview-pick">{{substr($packages->description, 0, 100)}}</p>
                                                    <span class="lots-preview-pick" style="font-weight:bold">{{$packages->lots}} {{$packages->unit}}</span>
                                                    <p class="price-preview-pick" style="margin-bottom:0;">{{$packages->price}}</p>
                                                </div>
                                                <div class="" style="width:5%">@if($type === 'ubah')<i class="dripicons-cross" onclick="removePaket()" title="Hapus Paket Terpilih" style="cursor: pointer"></i>@endif</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Nominal Yang Dibayar</label>
                                            <input type="number" pattern="[0-9]*" inputmode="numeric" class="form-control" id="nominal" name="nominal" value="{{$transaction->nominal}}" placeholder="Nominal Yang Dibayar" required @if($type === 'detail') disabled @endif>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Tanggal Transaksi</label>
                                            <input type="text" class="form-control datetimepicker" id="transaction_date" name="transaction_date" value="{{$transaction->transaction_date}}" placeholder="Tanggal Transaksi" required @if($type === 'detail') disabled @endif>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">QTY Yang Dibayar</label>
                                            <input type="number" pattern="[0-9]*" placeholder="0" inputmode="numeric" class="form-control" id="qty" name="qty" value="{{$transaction->qty}}" required @if($type === 'detail') disabled @endif>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Satuan</label>
                                            <input type="text" class="form-control" placeholder="" id="unit" name="unit" value="{{$transaction->satuan}}" placeholder="" required @if($type === 'detail') disabled @endif>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="row">
                                    @if(@$transaction->staf_id !== 0)
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Petugas</label>
                                                @if($type === 'ubah')
                                                    <div class="d-flex">
                                                        <button type="button" class="btn btn-info showStafBtn" data-bs-toggle="modal" data-bs-target=".bs-modal-show-staf"> Ganti Petugas + </button>
                                                    </div>
                                                @endif
                                                <input type="hidden" name="staf_id" id="staf_id" value="{{$transaction->staf_id}}" required>
                                                <div class="preview-pick-staf  @if($type === 'ubah') mt-3 @endif" style="display:flex; background:lightcyan; padding:15px;">
                                                    <div class="info-preview-pick-staf" style="width:95%; padding: 0px 0px 0px 20px;">
                                                        <h6 class="title-preview-pick-staf">{{$staf->name}}</h6>
                                                        <p class="description-preview-pick-staf" style="margin-bottom:0;">{{$staf->handphone}}</p>
                                                    </div>
                                                    <div class="" style="width:5%">@if($type === 'ubah')<i class="dripicons-cross" onclick="removeStaf()" title="Hapus Paket Terpilih" style="cursor: pointer"></i>@endif</div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <input type="hidden" name="staf_id" id="staf_id" value="{{$transaction->staf_id}}" required>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <a href="/petugas" class="btn btn-light waves-effect waves-light d-flex">@if($type === 'ubah') Batal @else Kembali @endif</a> &nbsp;
                            @if($type === 'ubah') <button class="btn btn-primary btnSubmit" type="submit"><span class="place-loader"></span>Simpan</button> @endif
                        </div>
                    </form>

                    <div class="modal fade bs-modal-show-package" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Pilih Daftar Paket</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <table id="packages-datatable" class="table dt-responsive nowrap w-100 packages-datatables">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Paket</th>
                                                <th>Pilih</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div>

                    <div class="modal fade bs-modal-show-staf" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Pilih Petugas</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <table id="staf-datatables" class="table dt-responsive nowrap w-100 staf-datatables">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Petugas</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end page title -->
</div>
@push('custom-scripts')
    <script>
        $("#UbahTransactionForm").on("submit", function (e) {
            e.preventDefault();

            var datax = {
                '_token': '{{ csrf_token() }}',
                id: $('#id').val(),
                customer_name: $('#customer_name').val(),
                customer_phone: $('#customer_phone').val(),
                customer_nik: $('#customer_nik').val(),
                customer_address: $('#customer_address').val(),
                packages_id: $('#packages_id').val(),
                nominal: $('#nominal').val(),
                transaction_date: $('#transaction_date').val(),
                qty: $('#qty').val(),
                unit: $('#unit').val(),
                staf_id: $('#staf_id').val(),
                description: $('#description').val(),
            };

            $.ajax({
                type: "POST",
                url: '/qurban/put',
                data: datax,
                beforeSend : function(xhr, opts){
                    $(".place-loader").addClass("loadingSpinner");
                    $(".btnSubmit").addClass("d-flex justify-content-center gap-3");
                },
                success: function( response ) {
                    toastr.success('Transaksi berhasil diubah!');

                    if(response.success) {
                         window.setTimeout(function () {
                            location.href = "/qurban";
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

         var table = $('.packages-datatables').DataTable({
            processing: true,
            serverSide: true,
            ajax: "/paket",
            pageLength: 2,
            lengthChange: false,
            columns: [
                {
                    data: 'thumbnail',
                    render: function (data, type, row) {
                        const price = new Intl.NumberFormat("id-ID", { style: "currency", currency: "IDR", minimumFractionDigits: 0 }).format(row.price);
                        return '<div onclick="previewPick(\''+row.id+'\',\''+row.name+'\',\''+row.thumbnail+'\',\''+row.description+'\',\''+row.unit+'\',\''+row.lots+'\',\''+row.price+'\')"  style="cursor:pointer;display:flex; justify-content:space-around;"><div><img src="/assets/images/paket/'+data+'" style="width:100px; border-radius:10px;""></div><div><b>'+row.name+'</b><br><p style="font-size:12px;">'+row.description+'</p>' + price + ' / ' + row.lots + ' ' + row.unit + '</div></div>';
                    },
                },
            ],
        });

        function previewPick(id, name, thumbnail, desc, unit, qty, price) {
            toastr.success('Paket telah ditambahkan!');
            $('.bs-modal-show-package').modal('hide');
            $(".preview-pick").css('padding','15px');
            $(".preview-pick").css('display','flex');
            $(".preview-pick").css('background-color','lightcyan');
            $("#packages_id").val(id);
            $(".title-preview-pick").html(name);
            $(".price-preview-pick").html(new Intl.NumberFormat("id-ID", { style: "currency", currency: "IDR", minimumFractionDigits: 0 }).format(price));
            $(".description-preview-pick").html(desc);
            $(".lots-preview-pick").html(qty + " " +unit);
            $(".thumbnail-preview-pick").html("<img src='/assets/images/paket/"+thumbnail+"' style='width:100%'>");
            $(".showPaketBtn").text('Ganti Paket +');
            $(".showPaketBtn").removeClass('btn-primary');
            $(".showPaketBtn").addClass('btn-info');
        }

        function removePaket(){
            toastr.success('Paket telah dihapus!');
            $(".showPaketBtn").removeClass('btn-info');
            $(".showPaketBtn").text('Pilih Paket +');
            $(".preview-pick").css('display','none');
            $(".showPaketBtn").addClass('btn-primary');
            $("#packages_id").val('');
        }

        var tableStaf = $('.staf-datatables')
        .DataTable({
            processing: true,
            serverSide: true,
            ajax: "/petugas",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {
                    data: 'name',
                    render:function (data, type, row){
                        return "<b>"+data+"</b><br>"+row.handphone;
                    }
                },
                {
                    data: 'action',
                    render: function (data, type, row) {
                        return '<button class="btn btn-primary" onclick="previewPickStaf(\''+row.id+'\',\''+row.name+'\',\''+row.handphone+'\')">Pilih</button>';
                    },
                    orderable: false,
                    searchable: false
                },
            ],
        });

        function previewPickStaf(id, name, wa) {
            toastr.success('Petugas telah ditambahkan!');
            $('.bs-modal-show-staf').modal('hide');
            $(".preview-pick-staf").css('padding','15px');
            $(".preview-pick-staf").css('display','flex');
            $(".preview-pick-staf").css('background-color','lightcyan');
            $("#staf_id").val(id);
            $(".title-preview-pick-staf").html(name);
            $(".description-preview-pick-staf").html(wa);
            $(".showStafBtn").text('Ganti Petugas +');
            $(".showStafBtn").removeClass('btn-primary');
            $(".showStafBtn").addClass('btn-info');
        }

         function removeStaf(){
            toastr.success('Petugas telah dihapus!');
            $(".showStafBtn").removeClass('btn-info');
            $(".showStafBtn").text('Pilih Petugas +');
            $(".preview-pick-staf").css('display','none');
            $(".showStafBtn").addClass('btn-primary');
            $("#staf_id").val('');
        }

    </script>
@endpush
@endsection
