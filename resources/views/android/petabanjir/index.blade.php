<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="{{ asset('assets/img/logo/pt_dehas.jpg') }}" rel="icon">
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/ruang-admin.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    </head>
<body>
    <img src="{{ asset('assets/img/PMF.jpg') }}" height="100%" id="image">
    <button class="btn btn-block btn-primary" onclick="ZoomIn()"> Zoom IN </button>
    <button class="btn btn-block btn-primary" onclick="ZoomOut()"> Zoom Out </button>
    <script>
        let image = document.getElementById('image');

        function ZoomIn() {
            let width = image.clientWidth;
            let height = image.clientHeight;
            image.style.width = (width + 500) + "px";
            image.style.height = (height + 500) + "px";
        }

        function ZoomOut() {
            let width = image.clientWidth;
            let height = image.clientHeight;
            image.style.width = (width - 500) + "px";
            image.style.height = (height - 500) + "px";
        }
    </script>
    <script src="{{ asset('assets/jquery/jquery-3.1.1.min.js') }}"></script>
</body>

</html>
