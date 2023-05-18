@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{('LAPORAN') }}</div>

                <div class="card-body">
                    <form action="/user/store" method="post">

                        @csrf

                        <div class="row mb-3">
                            <label for="kategori" class="col-md-4 col-form-label text-md-end">{{('Kategori')}}</label>
                            <div class="col-md-6">
                                <select type="kategori" class="form-control" name="kategori" id="role">
                                    <option value="0">DIDIH PASIR</option>
                                    <option value="1">RETAK PADA TUBUH BENDUNGAN</option>
                                    <option value="2">LONGSOR ATAU EROSI BESAR PADA TUBUH BENDUNGAN</option>
                                    <option value="3">PUSARAN AIR DI HULU</option>
                                    <option value="4">RETAKAN ATAU PERGERAKAN PADA STRUKTUR BETON</option>
                                    <option value="5">REMBESAN</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="statusbocor" class="col-md-4 col-form-label text-md-end">{{('Status Bocor')}}</label>
                            <div class="col-md-6">
                                <select type="statusbocor" class="form-control" name="statusbocor" id="role">
                                    <option value="0">DIDIH PASIR</option>
                                    <option value="1">RETAK PADA TUBUH BENDUNGAN</option>
                                    <option value="2">LONGSOR ATAU EROSI BESAR PADA TUBUH BENDUNGAN</option>
                                    <option value="3">PUSARAN AIR DI HULU</option>
                                    <option value="4">RETAKAN ATAU PERGERAKAN PADA STRUKTUR BETON</option>
                                    <option value="5">REMBESAN</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Upload') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection