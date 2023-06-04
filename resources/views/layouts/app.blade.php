<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="{{ asset('assets/img/logo/pt_dehas.png') }}" rel="icon">
    <title>PT Dehas Inframedia Karsa - Deshboard</title>
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/ruang-admin.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
        rel="stylesheet" />

    {{-- select2 --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/select2/css/select2.css') }}">
</head>
@yield('tambahancss')

<body id="page-top">
    <div id="wrapper">
        @include('sweetalert::alert')
        <!-- Sidebar -->
        @include('layouts.navbar')
        <!-- Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- TopBar -->
                @if (Request::segment(1) == 'map')
                    @include('layouts.topbar_nopadding')
                @else
                    @include('layouts.topbar')
                @endif
                <!-- Topbar -->
                @yield('content')
            </div>
            @include('layouts.footer')
        </div>
    </div>


    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>



    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('assets/js/ruang-admin.min.js') }}"></script>

    <script src="{{ asset('assets/select2/js/select2.full.min.js') }}"></script>

    {{-- <script src="{{ asset('assets/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/js/demo/chart-area-demo.js') }}"></script> --}}

    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2').select2({
                allowClear: true,
            });

            $('.check_all').on('click', function() {
                let target = $(this).data('target');
                $(target + ' :checkbox').prop('checked', $(this).is(':checked')).trigger('change');
            });

            $(document).on('focus', '.select2', function() {
                $(this).siblings('select').select2('open');
            });
            $('#dataTable').DataTable();
            $('#dataTableHover').DataTable();
        })
        $(".datepicker").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
        });
        $('.alert_notif').on('click', function() {
            var getLink = $(this).attr('href');
            Swal.fire({
                title: "Yakin hapus data?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonColor: '#3085d6',
                cancelButtonText: "Batal"

            }).then(result => {
                //jika klik ya maka arahkan ke proses.php
                // console.log(result);
                if (result.value) {
                    window.location.href = getLink
                }
            })
            return false;
        });
    </script>
    @yield('tambahanjs')
</body>

</html>
