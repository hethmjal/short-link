@if (!isset($_COOKIE['id']))
    <meta http-equiv="refresh" content="0; url=../user/log-in">
@else


    @extends('layout.main')
    @section('content')
        <div class="linkstats">
            @foreach ($links as $link)
                @php
                    function timeAgo($time_ago)
                    {
                        $time_ago = strtotime($time_ago);
                        $cur_time = time();
                        $time_elapsed = $cur_time - $time_ago;
                        $seconds = $time_elapsed;
                        $minutes = round($time_elapsed / 60);
                        $hours = round($time_elapsed / 3600);
                        $days = round($time_elapsed / 86400);
                        $weeks = round($time_elapsed / 604800);
                        $months = round($time_elapsed / 2600640);
                        $years = round($time_elapsed / 31207680);
                        // Seconds
                        if ($seconds <= 60) {
                            return 'منذ لحظات';
                        }
                        //Minutes
                        elseif ($minutes <= 60) {
                            if ($minutes == 1) {
                                return 'منذ دقيقة واحدة';
                            } elseif ($minutes == 2) {
                                return 'منذ دقيقتين';
                            } elseif ($minutes > 2 && $minutes < 11) {
                                return 'منذ ' . $minutes . ' دقائق';
                            } else {
                                return 'منذ ' . $minutes . ' دقيقة';
                            }
                        }
                        //Hours
                        elseif ($hours <= 24) {
                            if ($hours == 1) {
                                return 'منذ ساعة واحدة';
                            } elseif ($hours == 2) {
                                return 'منذ ساعتين';
                            } elseif ($hours > 2 && $hours < 11) {
                                return 'منذ ' . $hours . ' ساعات';
                            } else {
                                return 'منذ ' . $hours . ' ساعة';
                            }
                        }
                        //Days
                        elseif ($days <= 7) {
                            if ($day == 1) {
                                return 'منذ يوم واحد';
                            } elseif ($day == 2) {
                                return 'منذ يومين';
                            } elseif ($day > 2 && $day < 11) {
                                return 'منذ ' . $day . ' ايام';
                            } else {
                                return 'منذ ' . $day . ' يوم';
                            }
                        }
                        //Weeks
                        elseif ($weeks <= 4.3) {
                            if ($weeks == 1) {
                                return 'منذ اسبوع واحد';
                            } elseif ($weeks == 2) {
                                return 'منذ اسبوعين';
                            } elseif ($weeks > 2 && $weeks < 11) {
                                return 'منذ ' . $weeks . ' اسابيع';
                            } else {
                                return 'منذ ' . $weeks . ' اسبوع';
                            }
                        }
                        //Months
                        elseif ($months <= 12) {
                            if ($months == 1) {
                                return 'منذ شهر واحد';
                            } elseif ($months == 2) {
                                return 'منذ شهرين';
                            } elseif ($months > 2 && $months < 11) {
                                return 'منذ ' . $months . ' شهور';
                            } else {
                                return 'منذ ' . $months . ' اشهر';
                            }
                        }
                        //Years
                        else {
                            if ($years == 1) {
                                return 'منذ سنة واحدة';
                            } elseif ($years == 2) {
                                return 'منذ سنتين';
                            } elseif ($years > 2 && $years < 11) {
                                return 'منذ ' . $years . ' سنين';
                            } else {
                                return 'منذ ' . $years . ' سنة';
                            }
                        }
                    }
                @endphp

                <div class="col-md-4">
                    <div class="card"
                        style="justify-content: center; color: #fff;background: linear-gradient(118deg,#7367F0,rgba(115,103,240,.7))">
                        <div class="img">

                            <img src="{{ asset('images/decore-left.png') }}" width="30%" alt="">
                            <img src="{{ asset('images/decore-right.png') }}" width="30%" alt="">
                        </div>
                        <h2 style="position: absolute; bottom:0"><a href="../u/{{ $link->link }}"
                                style="color: #fff;text-decoration: none">m-r.pw/u/{{ $link->link }}</a></h2>
                        <p>هذا هو رابطك المختصر</p>
                        <span class="copied" style="position: absolute;
                                      top: 5px;display:none">تم نسخ الرابط</span>
                        <input type="hidden" id="copylink" value="m-r.pw/u/{{ $link->link }}">
                        <span id="copy" style="border-radius: 10px;
                                                                  background: #fff;
                                                                  padding: 8px 26px;
                                                                  color: #948bf4;cursor:pointer">نسخ الرابط</span>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card"
                        style="height: max-content; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                        <div class="card-body">
                            <div id="qrcode"></div>
                            <script type="text/javascript">
                                new QRCode(document.getElementById("qrcode"), "m-r.pw/u/{{ $link->link }}");
                            </script>
                            <style>
                                #qrcode img {
                                    width: 100%;
                                }

                            </style>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card">
                        <div class="card-header">
                            <div><span>{{ $day }}</span><small>اليوم</small></div>
                            <i class="bx bx-pointer"></i>
                        </div>
                        <div class="card-header">
                            <div><span>{{ $link->views }}</span><small>كل الضغطات</small></div>
                            <i class="bx bx-pointer"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <div><span>{{ timeAgo($link->created_at) }}</span><small>{{ $link->created_at }}</small>
                            </div>
                            <i class="bx bx-time"></i>
                        </div>
                        <a href="{{ $link->original_link }}" class="card-header"
                            style="color: #333; text-decoration:none">
                            <div class="col-9"><span
                                    style="max-height: 50px; overflow:hidden">{{ $link->original_link }}</span><small>الرابط
                                    الاصلي</small></div>
                            <i class="bx bx-link-external"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endsection
@endif
