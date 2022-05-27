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

<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/6.0.0-beta.2/dropzone.min.js" integrity="sha512-Ky7SgifG9Q4ANAFvK3k7zkfdrkbM+jBJyT6kgS2cdl8VbNNo2X+kKmq73xieujm0C6HEaXDA5po3r6lmwe4sMg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="{{ asset('css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/qrcode.min.js') }}"></script>
    @if (isset($_COOKIE['dark']))
    <link rel="stylesheet" href="{{ asset('css/dark.css') }}">
    @endif

    <style>
        @font-face {
            font-family: "jannat";
            src: url("{{ asset('fonts/jannat.ttf') }}");
        }
    </style>
    <script src={{ env('GOOGLE_ANALIZE') }}></script>
    <script src={{ env('GOOGLE_ADSENSE') }}></script>


</head>

<body>
    @php

    $db = env('DB_DATABASE');
    $user = env('DB_USERNAME');
    $pass = env('DB_PASSWORD');
    // connect to database
    $dsn = 'mysql:host=localhost;dbname=' . $db;
    $user = $user;
    $pass = $pass;
    $option = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'];

    try {
    $con = new PDO($dsn, $user, $pass, $option);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOExeception $e) {
    echo 'Failed Connect' . $e->getMessage();
    }
    // get client ip

    function get_client_ip()
    {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP')) {
    $ipaddress = getenv('HTTP_CLIENT_IP');
    } elseif (getenv('HTTP_X_FORWARDED_FOR')) {
    $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    } elseif (getenv('HTTP_X_FORWARDED')) {
    $ipaddress = getenv('HTTP_X_FORWARDED');
    } elseif (getenv('HTTP_FORWARDED_FOR')) {
    $ipaddress = getenv('HTTP_FORWARDED_FOR');
    } elseif (getenv('HTTP_FORWARDED')) {
    $ipaddress = getenv('HTTP_FORWARDED');
    } elseif (getenv('REMOTE_ADDR')) {
    $ipaddress = getenv('REMOTE_ADDR');
    } else {
    $ipaddress = 'UNKNOWN';
    }
    return $ipaddress;
    }
    // get user os

    $hua = filter_input(INPUT_SERVER, 'HTTP_USER_AGENT');
    $os = 'other';

    if (preg_match('/android/i', $hua)) {
    $os = 'Android';
    } elseif (preg_match('/linux/i', $hua)) {
    $os = 'Linux';
    } elseif (preg_match('/iphone/i', $hua)) {
    $os = 'iPhone';
    } elseif (preg_match('/macintosh|mac os x/i', $hua)) {
    $os = 'Mac';
    } elseif (preg_match('/windows|win32/i', $hua)) {
    $os = 'Windows';
    }

    // store data into database

    $ip = get_client_ip();

    $from = 'fb';
    $now = date('m/d/Y');
    $now2 = date('m/d/Y h:i');
    $id = Cookie::get('id');
    $sql = 'INSERT INTO visits (ip, ip_source,created_at,os) VALUES (?,?,?,?)';
    $con->prepare($sql)->execute([$ip, $from, $now, $os]);
    $sql = "UPDATE users SET active =? WHERE id = '$id'";
    $con->prepare($sql)->execute([$now2]);

    @endphp
    <div class="header">
        <div class="over"></div>
        <div class="mob-header  container">
            <div class="logo" style="width: 100px"><img src="{{ asset('images/logo.svg') }}" alt="" srcset="">
            </div>
            <div class="sidebar">
                <div class="box"></div>
                <i class="bx bx-menu"></i>
                <div class="sidebar-content">
                    <ul>
                        @if (!isset($_COOKIE['id']))
                        <li><a href="{{ route('signup') }}"><i class="bx bx-user-plus"></i>انشاء حساب </a></li>
                        <li><a href="{{ route('login') }}"><i class="bx bx-log-out"></i>تسجيل الدخول</a></li>
                        <span class="devider"></span>
                        @endif
                        @if (isset($_COOKIE['id']))
                        <li><a href="{{ route('my-links') }}"><i class="bx bx-link-alt"></i>روابطي</a></li>
                        <li><a href="{{ route('account') }}"><i class="bx bx-user"></i>حسابي</a></li>
                        <li><a href="{{ route('logout') }}"><i class="bx bx-log-in"></i>تسجيل الخروج</a></li>
                        <span class="devider"></span>
                        @endif
                        <li><a href="{{ route('u-upload') }}"><i class="bx bx-upload"></i>رفع الملفات</a></li>

                        <li><a href="{{ route('home') }}"> <i class="bx bx-link-alt"></i>اختصار الروابط</a></li>
                        <li><a href="{{ route('features') }}"><i class="bx bxs-bolt"></i>المميزات</a></li>


                    </ul>
                </div>
            </div>
        </div>
        <div class="desk-header  container">
            <div class="logo" style="width: 100px"><img src="{{ asset('images/logo.svg') }}" alt="" srcset=""></div>
            <div class="navbar">
                <ul>
                    @if (!isset($_COOKIE['id']))
                    <li><a href="{{ route('signup') }}"><i class="bx bx-user-plus"></i>انشاء حساب </a></li>
                    <li><a href="{{ route('login') }}"><i class="bx bx-log-out"></i>تسجيل الدخول <span
                                class="devider"></span></a></li>
                    @endif
                    @if (isset($_COOKIE['id']))
                    <li><a href="{{ route('my-links') }}"><i class="bx bx-link-alt"></i>روابطي</a></li>
                    <li><a href="{{ route('u-upload') }}"><i class="bx bx-upload"></i>رفع الملفات</a></li>

                    <li><a href="{{ route('account') }}"><i class="bx bx-user"></i>حسابي</a></li>
                    <li><a href="{{ route('logout') }}"><i class="bx bx-log-in"></i>تسجيل الخروج<span
                                class="devider"></span></a></li>
                    @endif
                    <li><a href="{{ route('u-upload') }}"><i class="bx bx-upload"></i>رفع الملفات</a></li>
                    <li><a href="{{ route('home') }}"> <i class="bx bx-link-alt"></i>اختصار الروابط</a></li>
                    <li><a href="{{ route('features') }}"><i class="bx bxs-bolt"></i>المميزات</a></li>



                </ul>
            </div>
        </div>
    </div>
    @if (isset($_COOKIE['dark']))
    <a id="day"><i class="bx bx-sun"></i></a>

    @endif
    @if (!isset($_COOKIE['dark']))
    <a id="dark"><i class="bx bx-moon"></i></a>

    @endif

    <div class="athoo-alert container">


    </div>
    @section('content')

    @show
    <div class="footer">
        <div class="links">
            <a href="#">اتصل بنا</a>
            <a href="#">الشروط والخصوصية</a>
            <a href="#">المساعدة</a>
        </div>
        <span style="color: #e91e63;">m-r.pw @ 2021 جميع الحقوق محفوظة</span>
        <a style="display: flex;
        justify-content: center;" href="https://www.moody0100.com"><img width="20%"
                src="{{ asset('images/site.png') }}" alt=""></a>
    </div>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/qrcode.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/6.0.0-beta.2/dropzone-min.js" integrity="sha512-FFyHlfr2vLvm0wwfHTNluDFFhHaorucvwbpr0sZYmxciUj3NoW1lYpveAQcx2B+MnbXbSrRasqp43ldP9BKJcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

</html>