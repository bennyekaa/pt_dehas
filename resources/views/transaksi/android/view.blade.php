<html>
@php
    use Illuminate\Support\Facades\Storage;
@endphp

<head>
    <title>{{ $berkas->keterangan }}</title>
</head>

<body>
    @if ($tipedata == 'application/pdf')
        <object type="{{ $tipedata }}" width="100%" height="100%" data="{{ $url }}">
    @else
        <object type="{{ $tipedata }}" data="{{ $url }}">
                {{-- <img src="{{ $url }}" alt="" title="" /> --}}
    @endif
    Not supported by your browser.
</body>
<html>
