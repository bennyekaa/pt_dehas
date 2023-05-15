@extends('layouts.app')
@section('content')
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Status Bocor</h1>
        </div>

        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <a class="btn btn-primary" href="{{ url('statusbocor/tambah') }}" style="float: left;"> + Tambah Status</a>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Nama Status</th>
                                <th>Nama Kategori</th>
                                <th>Keterangan</th>
                                <th>Status</th>
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
                        @foreach ($statusbocor as $item)
                            <thead class="thead-light">
                                <tr>
                                    <td>{{ $i++ }} </td>
                                    <td>{{ $item->nama_status }} </td>
                                    <td>{{ $item->kategoriBocor->nama_kategori }} </td>
                                    <td>{{ $item->keterangan }} </td>
                                    @if ($item->status == 0)
                                        <td>
                                            <div class="alert alert-success" role="alert"> Normal</div>
                                        </td>
                                    @elseif ($item->status == 1)
                                        <td>
                                            <div class="alert alert-primary" role="alert"> Waspada 1</div>
                                        </td>
                                    @elseif ($item->status == 2)
                                        <td>
                                            <div class="alert alert-secondary" role="alert"> Waspada 2</div>
                                        </td>
                                    @elseif ($item->status == 3)
                                        <td>
                                            <div class="alert alert-warning" role="alert"> Siaga</div>
                                        </td>
                                    @else
                                        <td>
                                            <div class="alert alert-danger" role="alert"> Bahaya</div>
                                        </td>
                                    @endif
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->created_by }}</td>
                                    <td>{{ $item->updated_at }}</td>
                                    <td>{{ $item->updated_by }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="btn btn-warning" title="Edit"
                                                href="{{ url('statusbocor/edit') }}/{{ encrypt($item->id_status_bocor) }}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a class="btn btn-danger alert_notif" id="notif" title="Hapus"
                                                href="{{ url('statusbocor/hapus') }}/{{ encrypt($item->id_status_bocor) }}">
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
