@extends('layouts.app')
@section('content')
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Website</h1>
        </div>

        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <a class="btn btn-primary" href="{{ url('web/tambah') }}" style="float: left;"> + Tambah Website</a>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Nama Web</th>
                                <th>Url Web</th>
                                <th>Keterangan</th>
                                <th>Dibuat Pada</th>
                                <th>Dibuat Oleh</th>
                                <th>Diupdate Pada</th>
                                <th>Diupdate Oleh</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($website as $item)
                            <thead class="thead-light">
                                <tr>
                                    <td>{{ $i++ }} </td>
                                    <td>{{ $item->nama_web }} </td>
                                    <td>{{ $item->url_web }} </td>
                                    <td>{{ $item->keterangan }} </td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->created_by }}</td>
                                    <td>{{ $item->updated_at }}</td>
                                    <td>{{ $item->updated_by }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="btn btn-warning" title="Edit"
                                                href="{{ url('web/edit') }}/{{ encrypt($item->id_web) }}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a class="btn btn-danger" id="notif" title="Hapus"
                                                href="{{ url('web/hapus') }}/{{ encrypt($item->id_web) }}">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            </thead>
                        @endforeach
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('tambahanjs')
    <script type="text/javascript">
        $("#notif").on('click', function() {
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
@endsection
