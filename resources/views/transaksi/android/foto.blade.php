<html>
@php
    use Illuminate\Support\Facades\Storage;
@endphp

<head>
    <title>{{ $berkas->kategoribocor->nama_kategori }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    {{-- @if ($tipedata == 'application/pdf')
        <object type="{{ $tipedata }}" width="100%" height="100%" data="{{ $url }}">
    @else
        <object type="{{ $tipedata }}" data="{{ $url }}">
                {{-- <img src="{{ $url }}" alt="" title="" />
    @endif
    Not supported by your browser. --}}
    @if (!empty($url1))
    <img src="{{ $url1 }}" class="img-fluid" alt="Responsive image">
    @endif
    @if(!empty($url2))
    <img src="{{ $url2 }}" class="img-fluid" alt="Responsive image">
    @endif
    @if(!empty($url3))
    <img src="{{ $url3 }}" class="img-fluid" alt="Responsive image">
    @endif
    @if(!empty($url4))
    <img src="{{ $url4 }}" class="img-fluid" alt="Responsive image">
    @endif
    @if(!empty($url5))
    <img src="{{ $url5 }}" class="img-fluid" alt="Responsive image">
    @endif

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
<html>
