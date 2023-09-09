@extends('layouts.app')
@section('content')
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Peta</h1>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Peta Banjir</th>
                                    <th>Status</th>
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
                                        @if ($item->aktif == 1)
                                            <td>
                                                <div class="alert alert-success" role="alert">Aktif</div>
                                            </td>
                                        @else
                                            <td>
                                                <div class="alert alert-danger" role="alert">Tidak Aktif</div>
                                            </td>
                                        @endif
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-dark" title="Lihat Peta"
                                                    href="{{ url('peta/lihat') }}/{{ encrypt($item->id_peta) }}" target="_blank">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </div>
                                            <div class="btn-group">
                                                <a class="btn btn-success" title="Aktifkan"
                                                    href="{{ url('peta/status') }}/{{ encrypt($item->id_peta) }}/1">
                                                    <i class="fa fa-check"></i>
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
<script>
    $(document).ready(function() {
        $('a.btn-success').on('click', function(e) {
            e.preventDefault();
            var url = $(this).attr('href'); // URL pembaruan
            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', // CSRF token
                },
                success: function(response) {
                    if (response.message === 'Status berhasil diperbarui') {
                        // Ubah status di tampilan tanpa me-reload halaman
                        var alert = $(this).closest('tr').find('.alert');
                        if (alert.hasClass('alert-success')) {
                            alert.removeClass('alert-success').addClass('alert-danger').text('Tidak Aktif');
                        } else {
                            alert.removeClass('alert-danger').addClass('alert-success').text('Aktif');
                        }
                    }
                }
            });
        });
    });
</script>
