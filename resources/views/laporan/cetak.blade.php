<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="table-responsive">
        <img src="{{asset('assets/img/logo/emblem.jpg')}}">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Status</th>
                    <th>Muka Air (Meter)</th>
                    <th>Debit Outflow (m3/detik)</th>
                    <th>Kejadian</th>
                    <th>Dokumentasi 1</th>
                    <th>Dokumentasi 2</th>
                    <th>Dokumentasi 3</th>
                    <th>Dokumentasi 4</th>
                    <th>Dokumentasi 5</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($laporan as $item)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
