@extends('layouts.app')
<link href="https://api.mapbox.com/mapbox-gl-js/v2.13.0/mapbox-gl.css" rel="stylesheet">
<script src="https://api.mapbox.com/mapbox-gl-js/v2.13.0/mapbox-gl.js"></script>
@section('content')
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">MAP</h1>
        </div>
        <!-- Row -->
        <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
                <iframe src="{{$custom->nama_web}}" height="700px" width="1400px"></iframe>
            </div>

        </div>
        <!--Row-->



    </div>
@endsection

