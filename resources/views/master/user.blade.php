@extends('layouts.app')
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data User</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <a class="btn btn-primary" href="/user/tambah" style="float: left;"> + Tambah User Baru</a>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                        <thead class="thead-light">
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>HP</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Dibuat Pada</th>
                                <th>Dibuat Oleh</th>
                                <th>Diupdate Pada</th>
                                <th>Diupdate Oleh</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                            @endphp
                            @foreach ($user as $p)
                            <tr>
                                <td>{{ $p->nama }} </td>
                                <td>{{ $p->email }} </td>
                                <td>{{ $p->hp }} </td>
                                <td>{{ $p->username }} </td>
                                <td>{{ $p->nama_role }} </td>

                                <!-- @if ($p->nama_role == "ADMIN")
                                <td>
                                    <div class="alert alert-secondary" role="alert"> TEST</div>
                                </td>
                                @elseif($p->nama_role == "DEVELOPER")
                                <td>
                                    <div class="alert alert-primary" role="alert" style="font-color:white;">
                                        COBA
                                    </div>
                                </td> -->
                                <!-- @elseif($p->id_role == 2)
                                <td>
                                    <div class="alert alert-info" role="alert"> Atasan</div>
                                </td>
                                @elseif($p->id_role == 3)
                                <td>
                                    <div class="alert alert-success" role="alert"> BPPD</div>
                                </td>
                                @elseif($p->id_role == 4)
                                <td>
                                    <div class="alert alert-dark" role="alert"> Umum</div>
                                </td>
                                @else
                                <td>
                                    <div class="alert alert-warning" role="alert"> Balai</div>
                                </td> -->
                                <!-- @endif -->
                                <td>{{ $p->created_at }}</td>
                                <td>{{ $p->created_by }}</td>
                                <td>{{ $p->updated_at }}</td>
                                <td>{{ $p->updated_by }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-warning" title="Edit" href="/user/edit/{{ encrypt($p->id_user) }}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a class="btn btn-danger alert_notif" title="Hapus" href="/user/hapus/{{ encrypt($p->id_user) }}">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
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
@endsection
@section('tambahanjs')
<script type="text/javascript">
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
@endsection