@extends('layouts.app')

    @section('content')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Banjir</h1>
        </div>

        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <a class="btn btn-primary" href="{{url('transaksi/mukaair/tambah')}}" style="float: left;"> + Input Data Waduk</a>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Batas Atas</th>
                                <th>Muka Air</th>
                                <th>Batas Bawah</th>
                                {{-- <th>Tinggi Air</th>
                                <th>Debit Keluar</th> --}}
                                <th>Status Kondisi</th>
                                <th>Dibuat Pada</th>
                                <th>Dibuat Oleh</th>
                                <th>Diupdate Pada</th>
                                <th>Diupdate Oleh</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        @php
                            $i = 1;
                        @endphp
                        @foreach($mukaair as $p)
                        <thead class="thead-light">
                            <tr>
                                <td>{{ $i++ }} </td>
                                <td>{{ $p->batas_atas }} </td>
                                <td>{{ $p->muka_air }} </td>
                                <td>{{ $p->batas_bawah }} </td>
                                <td>{{ $p->created_at }}</td>
                                <td>{{ $p->created_by }}</td>
                                <td>{{ $p->updated_at }}</td>
                                <td>{{ $p->updated_by }}</td>
                                <td></td>
                            </tr>
                        </thead>
                        @endforeach
                    </table>

                </div>
            </div>
        </div>
    </div>
    @endsection
