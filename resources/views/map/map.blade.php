@extends('layouts.app')

@section('content')
    <div>
        <iframe class="responsive-iframe" src="{{ $custom->url_web }}" height="700px" width="1400px"></iframe>
    </div>
@endsection
