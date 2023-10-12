@extends('layouts.app')
@section('content')
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data User</h1>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    @if (session('nama_role') == 'DEWA')
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <a class="btn btn-primary" href="/user/tambah" style="float: left;"> + Tambah User Baru</a>
                        </div>
                    @endif
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                            <thead class="thead-light">
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>HP</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Total Device</th>
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
                                        <td>{{ $p->total_device }} </td>
                                        <td>{{ $p->created_at }}</td>
                                        <td>{{ $p->created_by }}</td>
                                        <td>{{ $p->updated_at }}</td>
                                        <td>{{ $p->updated_by }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-info" title="Reset Password"
                                                    href="{{ 'user/reset' }}/{{ encrypt($p->id_user) }}">
                                                    <i class="fa fa-arrows-h"></i>
                                                </a>
                                                <a class="btn btn-warning" title="Edit"
                                                    href="/user/edit/{{ encrypt($p->id_user) }}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                @if (session('nama_role') == 'DEWA')
                                                    <a class="btn btn-danger alert_notif" title="Hapus"
                                                        href="/user/hapus/{{ encrypt($p->id_user) }}">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                @endif
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
