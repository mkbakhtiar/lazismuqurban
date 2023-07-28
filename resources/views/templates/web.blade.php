<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>Lazismu Qurban</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

        <!-- DataTables -->
        <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min') }}.css" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.min.css" rel="stylesheet" />
        <!-- Bootstrap Css -->
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

        <link href="{{ asset('assets/css/webcustoms.css') }}" id="app-style" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/webresponsive.css') }}" id="app-style" rel="stylesheet" type="text/css" />

        <script async data-watzapkey="4IMF1234" src="https://cdn.watzap.id/widget-api.js"></script>

    </head>

    <body data-topbar="light" data-layout="horizontal">

       <!-- Begin page -->
       <div id="layout-wrapper">

        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="/" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="{{ asset('assets/images/logo-lazismu.png') }}" alt="logo-sm-dark" height="70">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('assets/images/logo-lazismu.png') }}" alt="logo-dark" height="70">
                            </span>
                        </a>

                        <a href="/" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="{{ asset('assets/images/logo-lazismu.png') }}" alt="logo-sm-light" height="70">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('assets/images/logo-lazismu.png') }}" alt="logo-light" height="70">
                            </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-24 d-lg-none header-item" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                        <i class="ri-menu-2-line align-middle"></i>
                    </button>

                    <nav class="d-none d-md-flex d-sm-flex d-lg-flex elementor-nav-menu--main elementor-nav-menu__container elementor-nav-menu--layout-horizontal e--pointer-underline e--animation-fade">
                        <ul id="menu-1-ff34f8c" class="elementor-nav-menu" data-smartmenus-id="16856232407192297"><li class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-19273"><a href="https://lazismujatim.org/" aria-current="page" class="elementor-item elementor-item-active">Home</a></li>
                            <li class="menu-item menu-item-type-custom"><a href="#" class="elementor-item">Tentang Kami</a></li>
                            <li class="menu-item menu-item-type-custom"><a href="#" class="elementor-item">Layanan</a></li>
                            <li class="menu-item menu-item-type-custom"><a href="#" class="elementor-item">Program</a></li>
                            <li class="menu-item menu-item-type-custom"><a href="#" class="elementor-item">Blog</a></li>
                        </ul>
                    </nav>

                </div>

                <div class="d-md-flex d-lg-flex d-sm-flex d-none gap-3">

                    <a href="/register" class="btn btn-light btn-lg">Daftar Amil</a>
                    <button class="btn btn-warning btn-lg">Qurban Sekarang</button>

                </div>
            </div>
        </header>
        <div class="topnav d-sm-none d-md-none d-lg-none d-block">
            <div class="container-fluid mt-3">
                <nav class="navbar navbar-light navbar-expand-lg topnav-menu">
                    <div class="collapse navbar-collapse" id="topnav-menu-content">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="/">
                                    Home
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/">
                                    Tentang Kami
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/">
                                    Layanan
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/">
                                    Program
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                @yield('web_content')
            </div>

            <div class="modal fade bs-modal-sm-delete" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <form action="" id="modalDeleteForm" method="post">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">Apakah Anda Yakin?</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p id="smModalDeleteTitle"></p>
                                <input type="hidden" name="id" id="idModalDelete">
                            </div>
                            <div class="modal-footer">
                                <div class="d-flex">
                                    <input type="submit" value="Ya, Yakin" class="btn btn-danger" style="margin-right:20px">
                                    <a href="javascript:void(0)" rel="noopener noreferrer" class="btn btn-light">Tidak</a>
                                </div>
                            </div>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>
            <!-- End Page-content -->


        </div>

        <div class="container-fluid">
            <footer class="row py-5 mx-3 my-5 border-top">
                <div class="col-md-5 col-lg-5 col-sm-5 col-xs-12 mb-3">
                    <a href="/" class="d-flex align-items-center mb-3 link-dark text-decoration-none" style="margin-left:-5px;">
                        <img src="{{ asset('assets/images/logo-lazismu.png') }}" alt="logo-sm-dark" height="50">
                    </a>
                    <p class="text-muted">
                        LAZISMU adalah lembaga amil zakat nasional dengan SK. Menteri Agama RI No. 90 Tahun 2022, yang berkhidmat dalam pemberdayaan masyarakat, melalui pendayagunaan dana zakat, infaq dan dana kedermawanan lainnya baik dari perseorangan, lembaga, perusahaan dan instansi lainnya.
                    </p>
                    <p class="text-muted">Lazismu Kota Malang © 2023</p>
                </div>

                <div class="col mb-3">

                </div>
                <div class="col-md-3 col-lg-3 col-sm-3 col-xs-12 mb-3">
                    <h4>Selengkapnya</h4>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="#" class="p-0 text-muted">Kebijakan Privacy</a></li>
                        <li class="nav-item mb-2"><a href="#" class="p-0 text-muted">Syarat dan Ketentuan</a></li>
                        <li class="nav-item mb-2"><a href="#" class="p-0 text-muted">Daftar Rekening</a></li>
                        <li class="nav-item mb-2"><a href="#" class="p-0 text-muted">Bantuan</a></li>
                    </ul>
                </div>

                <div class="col-md-3 col-lg-3 col-sm-3 col-xs-12 mb-3">
                <h4>Alamat</h4>
                <ul class="nav flex-column gap-2">
                    <li class="nav-item mb-2">
                       <i class="dripicons-location"></i> Jl. Gedongkuning No.152, RT.41, Rejowinangun, Kec. Kotagede, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55171
                    </li>
                    <li class="nav-item mb-2">
                       <i class="dripicons-phone"></i> Phone: 0821-3833-9339
                    </li>
                </ul>
                </div>


            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>

    <!-- Required datatable js -->
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Buttons examples -->
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>

    <script src="{{ asset('assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-select/js/dataTables.select.min.js') }}"></script>

    <!-- Responsive examples -->
    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.min.js"></script>

    @stack('custom-scripts')

    <script src="{{ asset('assets/js/app.js') }}"></script>
    </body>
</html>
