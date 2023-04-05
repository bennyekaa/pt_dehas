@extends('layouts.app')
<link href="https://api.mapbox.com/mapbox-gl-js/v2.13.0/mapbox-gl.css" rel="stylesheet">
<script src="https://api.mapbox.com/mapbox-gl-js/v2.13.0/mapbox-gl.js"></script>
@section('content')
    <div>
        <iframe src="{{ $custom->url_web }}" height="700px" width="1400px"></iframe>
    </div>
@endsection
