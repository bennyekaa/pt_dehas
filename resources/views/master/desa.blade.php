@extends('layouts.app')
@section('content')
    @if ($errors->has('file'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('file') }}</strong>
        </span>
    @endif

    @if ($sukses = Session::get('sukses'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $sukses }}</strong>
        </div>
    @endif

    <!-- Import Excel -->
    <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action="/desa/import_excel" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                    </div>
                    <div class="modal-body">

                        {{ csrf_field() }}

                        <label>Pilih file excel</label>
                        <div class="form-group">
                            <input type="file" name="file" required="required">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Desa</h1>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <!-- <a class="btn btn-primary" href="/desa/tambah" style="float: left;"> + Tambah Desa Baru</a> -->
                        <div class="btn-group">
                            <!-- <a href="/desa/export_excel" class="btn btn-success my-3" data-target="#importExcel">EXPORT
                                        EXCEL</a> -->
                            <a href="{{ url('/importdesa') }}" class="btn btn-primary my-3">IMPORT EXCEL</a>
                        </div>
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                            <thead class="thead-light">
                                <tr>
                                    <th>Kode Desa</th>
                                    <th>Desa Latitude</th>
                                    <th>Desa Longitude</th>
                                    <th>Radius</th>
                                    <th>Kelurahan</th>
                                    <th>Kecamatan</th>
                                    <th>Kabupaten</th>
                                    <th>Jarak Dari Bendungan</th>
                                    <th>Kategori</th>
                                    {{-- <th>Banjir (m)</th>
                                <th>Kecepatan Max</th>
                                <th>Waktu Tiba (jam)</th>
                                <th>Waktu Surut (jam)</th>
                                <th>Durasi Banjir (jam)</th>
                                <th>Jumlah Jiwa</th>
                                <th>Jumlah KK</th>
                                <th>Rendah</th>
                                <th>Sedang</th>
                                <th>Tinggi</th>
                                <th>Total</th>
                                <th>KK</th>
                                <th>Tidak Terdampak</th>
                                <th>Zona Bahaya</th>
                                <th>Balita</th>
                                <th>Anak</th>
                                <th>Muda</th>
                                <th>Dewasa</th>
                                <th>Manula</th>
                                <th>Total Jiwa</th>
                                <th>Laki - Laki</th>
                                <th>Perempuan</th>
                                <th>Total L/P</th> --}}
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
                                @foreach ($desa as $p)
                                    <tr>
                                        <td>{{ $p->kode_desa }} </td>
                                        <td>{{ $p->desa_lat }} </td>
                                        <td>{{ $p->desa_long }} </td>
                                        <td>{{ $p->radius }} </td>
                                        <td>{{ $p->kelurahan_desa }} </td>
                                        <td>{{ $p->kecamatan_desa }} </td>
                                        <td>{{ $p->kabupaten_desa }} </td>
                                        <td>{{ $p->jarak_dari_bendungan }} KM </td>
                                        @if ($p->id_kategori == 0)
                                            <td>
                                                <div class="alert alert-primary" role="alert"> PMF</div>
                                            </td>
                                        @elseif($p->id_kategori == 1)
                                            <td>
                                                <div class="alert alert-info" role="alert"> SD</div>
                                            </td>
                                        @elseif($p->id_kategori == 2)
                                            <td>
                                                <div class="alert alert-success" role="alert"> WSA Hijau</div>
                                            </td>
                                        @elseif($p->id_kategori == 3)
                                            <td>
                                                <div class="alert alert-warning" role="alert"> WSA Kuning</div>
                                            </td>
                                        @elseif($p->id_kategori == 4)
                                            <td>
                                                <div class="alert alert-danger" role="alert"> WSA Merah</div>
                                            </td>
                                        @elseif($p->id_kategori == 5)
                                            <td>
                                                <div class="alert alert-dark" role="alert"> WSA Total</div>
                                            </td>
                                        @endif
                                        {{-- <td>{{ $p->banjir }} </td>
                                <td>{{ $p->kec_max }} </td>
                                <td>{{ $p->waktu_tiba }} </td>
                                <td>{{ $p->waktu_surut }} </td>
                                <td>{{ $p->durasi_banjir }} </td>
                                <td>{{ $p->jumlah_jiwa }} </td>
                                <td>{{ $p->jumlah_kk }} </td>
                                <td>{{ $p->rendah }} </td>
                                <td>{{ $p->sedang }} </td>
                                <td>{{ $p->tinggi }} </td>
                                <td>{{ $p->total }} </td>
                                <td>{{ $p->kk }} </td>
                                <td>{{ $p->tidak_terdampak }} </td>
                                <td>{{ $p->zona_bahaya }} </td>
                                <td>{{ $p->balita }} </td>
                                <td>{{ $p->anak }} </td>
                                <td>{{ $p->muda }} </td>
                                <td>{{ $p->dewasa }} </td>
                                <td>{{ $p->manula }} </td>
                                <td>{{ $p->total_jiwa }} </td>
                                <td>{{ $p->laki_laki }} </td>
                                <td>{{ $p->perempuan }} </td>
                                <td>{{ $p->total_LP }} </td> --}}
                                        <td>{{ $p->created_at }}</td>
                                        <td>{{ $p->created_by }}</td>
                                        <td>{{ $p->updated_at }}</td>
                                        <td>{{ $p->updated_by }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-warning" title="Edit"
                                                    href="/desa/edit/{{ encrypt($p->id_desa) }}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <!-- <a class="btn btn-danger alert_notif" id="notif" title="Hapus" href="/desa/hapus/{{ encrypt($p->id_desa) }}">
                                                    <i class="fa fa-trash"></i>
                                                </a> -->
                                            </div>
                                    </tr>
                                    </td>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endsection
