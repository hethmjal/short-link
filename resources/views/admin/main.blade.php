<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title',"m-r.pw")</title>
    <link rel="stylesheet" href="{{ asset('css/boxicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery.form.min.js') }}"></script>


    <style>
        @font-face {
            font-family: "jannat";
            src: url("{{ asset('fonts/jannat.ttf') }}");
        }

        body {
            background: #333;
            color: #fff
        }

      .card-body,
.card {
  background-color: #333;
}

    </style>
</head>

<body>
    @php
        $d = env('DB_DATABASE');
        $u = env('DB_USERNAME');
        $p = env('DB_PASSWORD');
        // connect to database
        $dsn = 'mysql:host=localhost;dbname=' . $d;
        $user = $u;
        $pass = $p;
        $option = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'];
        
        try {
            $con = new PDO($dsn, $user, $pass, $option);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOExeception $e) {
            echo 'Failed Connect' . $e->getMessage();
        }
        
        $now2 = date('m/d/Y h:i');
        $id = Cookie::get('id');
        
        $sql = "UPDATE users SET active =? WHERE id = '$id'";
        $con->prepare($sql)->execute([$now2]);
    @endphp

    @section('content')

    @show
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/daterangepicker.js') }}"></script>

    <script src="{{ asset('js/dropzone.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

</body>

</html>
