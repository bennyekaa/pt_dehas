<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="{{ asset('assets/img/logo/logo_PU.png') }}" rel="icon">
    <title>KEMENTERIAN PEKERJAAN UMUM DAN PERUMAHAN RAKYAT</title>
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/ruang-admin.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
        rel="stylesheet">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/select2/css/select2.css') }}">
</head>

<body id="page-top">
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <div class="container-fluid" id="container-wrapper">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Peta</h1>
                    </div>
                    <div class="row">
                        @if (!empty($gambar))
                            <img src="{{ asset($gambar->nama_gambar) }}" class="img-fluid" alt="Responsive image">
                        @endif
                        <div class="col-lg-12">
                            <div class="card mb-4">
                                <div class="table-responsive p-3">
                                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>No</th>
                                                <th>Peta Banjir</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach ($peta as $item)
                                                <tr>
                                                    <td>{{ $i++ }} </td>
                                                    <td>{{ $item->nama_peta }} </td>
                                                    <td>
                                                        {{-- <div class="btn-group">
                                                            <a class="btn btn-primary" title="Aktifkan"
                                                                href="{{ url('peta/android/status')}}/{{$item->id_peta}}/{{$id}}">
                                                                <i class="fa fa-check"></i>
                                                            </a>
                                                        </div> --}}
                                                        {{-- <form id="updateStatusForm" method="GET"
                                                            action="{{ url('peta/android/status') }}/{{ $item->id_peta }}/{{ $id }}">
                                                            @csrf --}}
                                                            <label>
                                                                <input type="checkbox" name="status"
                                                                    id="statusCheckbox{{$item->id_peta}}" data-idpeta="{{ $item->id_peta }}">
                                                            </label>
                                                        {{-- </form> --}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/ruang-admin.min.js') }}"></script> --}}

    <script src="{{ asset('assets/select2/js/select2.full.min.js') }}"></script>



    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('[id^="statusCheckbox"]').change(function() {
                var isChecked = $(this).is(':checked');

                var idPeta = $(this).data('idpeta');

                console.log(idPeta);

                $.ajax({
                    type: 'GET',
                    url: "{{ URL('peta/android/status') }}/" + idPeta + "/{{ $id }}", // Ganti dengan nama rute yang sesuai
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: isChecked ? 1 : 0,
                    },
                    success: function(response) {
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        // Penanganan kesalahan jika diperlukan
                    }
                });
            });
        });
    </script>
</body>

</html>
