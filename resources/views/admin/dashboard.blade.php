@if (!isset($_COOKIE['admin']))
    <meta http-equiv="refresh" content="0; url=login">
@else

    @extends('admin.main')
    @section('content')


        <div class="admin">

            <div class="stats container"
                style="margin: 40px auto;
                                                                                                                        display: flex;
                                                                                                                        justify-content: space-between;flex-wrap: wrap;">



                <div class="col-md-6" style="margin-bottom: 20px">

                    <div class="card visitors" style="height: 100%;">
                        <div class="card-body">
                            <i class="bx bxs-group"></i>
                            <h5 style="margin: 20px">احصائيات الزوار</h5>
                            <span id="visits" style="font-size: 2rem;"></span>

                        </div>
                        <div class="select text-right" dir="rtl">
                            <div class="col-12">
                                <!-- select -->
                                <div class="form-group">
                                    <label>اختيار التاريخ</label>
                                    <select class="form-control select-date">
                                        <option>الجميع</option>
                                        <option>اليوم</option>
                                        <option>اخر اسبوع</option>
                                        <option>اخر شهر</option>
                                        <option>اخر سنه</option>
                                        <option>تاريخ مخصص</option>
                                    </select>
                                </div>
                                <div class="date-range row" style="justify-content: space-between; margin-bottom:20px"
                                    dir="ltr">
                                    <div class="form-group col-12">
                                        <label>تحديد تاريخ مخصص</label>

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="bx bx-calendar"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control float-right" id="reservation">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6" style="margin-bottom: 20px">
                    <div class="card online" style="height: 100%;">
                        <div class="card-body">
                            <i class="bx bxs-group"></i>
                            <h5 style="margin: 20px">المتواجدين الان</h5>
                            <span id="count" style="font-size: 2rem;"></span>

                        </div>

                    </div>
                </div>
                <div class="col-md-6" style="margin-bottom: 20px">
                    <div class="card online " style="height: 100%;">
                        <div class="card-body">
                            <i class="bx bx-group"></i>
                            <h5 style="margin: 20px">عدد الاعضاء</h5>
                            <span id="countusers" style="font-size: 2rem;"></span>

                        </div>

                    </div>
                </div>
                <div class="col-md-6" style="margin-bottom: 20px">
                    <div class="card online " style="height: 100%;">
                        <div class="card-body">
                            <i class="bx bx-link"></i>
                            <h5 style="margin: 20px">زيارات الروابط</h5>
                            <span id="urlvisits" style="font-size: 2rem;"></span>

                        </div>

                    </div>
                </div>
                <div class="col-md-6" style="margin-bottom: 20px">
                    <div class="card online " style="height: 100%;">
                        <div class="card-body">
                            <i class="bx bx-link"></i>
                            <h5 style="margin: 20px">الروابط المختصرة</h5>
                            <span id="countlinks" style="font-size: 2rem;"></span>

                        </div>

                    </div>
                </div>
                <div class="col-md-6" style="margin-bottom: 20px">
                    <div class="card online " style="height: 100%;">
                        <div class="card-body">
                            <i class="bx bx-mobile"></i>
                            <h5 style="margin: 20px">زوار من الجوال</h5>
                            <span id="countmobilevisits" style="font-size: 2rem;"></span>

                        </div>

                    </div>
                </div>
                <div class="col-md-6" style="margin-bottom: 20px">
                    <div class="card online " style="height: 100%;">
                        <div class="card-body">
                            <i class="bx bx-laptop"></i>
                            <h5 style="margin: 20px">زوار من الكمبيوتر</h5>
                            <span id="countdeskevisits" style="font-size: 2rem;"></span>

                        </div>

                    </div>
                </div>
            </div>
            <div class="admin-dash container row">
                <div class="col-md-3 col-6">
                    <a href="{{ route('users') }}" class="tag">
                        <i class="bx bxs-group"></i>
                        <span>المستخدمين</span>
                    </a>
                </div>
                <div class="col-md-3 col-6">
                    <a href="{{ route('links') }}" class="tag" style="color: #03a9f4;">
                        <i class="bx bx-link-alt" style="background: #03a9f475;"></i>
                        <span>الروابط</span>
                    </a>
                </div>
                <div class="col-md-3 col-6">
                    <a href="{{ route('uploads') }}" class="tag">
                        <i class="bx bx-upload"></i>
                        <span>رفع الملفات</span>
                    </a>
                </div>
                <div class="col-md-3 col-6">
                    <a href="{{ route('u-upl') }}" class="tag">
                        <i class="bx bx-upload"></i>
                        <span>ملفات المستخدمين</span>
                    </a>
                </div>
                <div class="col-md-3 col-6">
                    <a href="{{ route('admins') }}" class="tag" style="color: #e91e63;">
                        <i class="bx bx-user-circle" style="background: #e91e6373;"></i>
                        <span>المشرفين</span>
                    </a>
                </div>
                <div class="col-md-3 col-6">
                    <a href="{{ route('slides') }}" class="tag" style="color: #4caf50;">
                        <i class="bx bx-images" style="background: #4caf5073;"></i>
                        <span>الاعلانات</span>
                    </a>
                </div>

            </div>
            <div class="last-actions container text-center">
                <div class="last-users col-md-4">
                    <div class="card">
                        <div class="card-header" style="background: #9c27b0;">
                            <div class="title">اخر الاعضاء المسجلين</div>
                        </div>
                        <div class="card-body">
                            @foreach ($users as $user)
                                <a>{{ $user->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="last-users col-md-4">
                    <div class="card">
                        <div class="card-header" style="background: #0fa9f4;">
                            <div class="title">اخر الروابط المنشأة</div>
                        </div>
                        <div class="card-body">
                            @foreach ($links as $link)
                                <a style="color: #fff" href="../u/{{ $link->link }}">m-r.pw/u/{{ $link->link }}</a>
                            @endforeach

                        </div>
                    </div>
                </div>
                <div class="card card-primary col-12" dir="rtl" style="text-align:right;padding: 0; margin-bottom: 2rem">
                    <div class="card-header">
                        <h3 class="card-title">تحديد سعة السيرفر</h3>
                    </div>

                    <!-- /.card-header -->

                    <!-- form start -->
                    <form method="POST" action="{{ route('setsize') }}">
                        @csrf
                        <div class="card-body">
                            @php
                                
                            @endphp
                            <div>حجم السيرفر الحالي {{ env('SERVER_SIZE') / 1000000000 }} قيقا</div>
                            <div>السيرفر ممتلئ بنسبة <span id="sizeper"></span></div>
                            <div class="form-group col-12">
                                <label for="exampleInputEmail1">السعة</label>
                                <input type="text" name="serversize" class="form-control">
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">ادخال</button>
                        </div>
                    </form>
                </div>
                <form method="POST" action="{{ route('deleteuserfiles') }}">
                    @csrf
                    <div class="card-body">
                        @if (env('DELETE_USER_FILES') == true)
                            <div>خاصية حذف ملفات المستخدمين فعالة</div>
                            <input type="hidden" name="del" value="off">
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">ايقاف</button>
                            </div>
                        @endif
                        @if (env('DELETE_USER_FILES') == false)
                            <div>خاصية حذف ملفات المستخدمين متوقفه</div>
                            <input type="hidden" name="del" value="on">
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">تشغيل</button>
                            </div>
                        @endif


                    </div>
                    <!-- /.card-body -->


                </form>
            </div>
            <div class="card card-primary col-12" dir="rtl" style="text-align:right;padding: 0; margin-bottom: 2rem">
                <div class="card-header">
                    <h3 class="card-title">كود قوقل ادسنس</h3>
                </div>

                <!-- /.card-header -->

                <!-- form start -->
                <form method="POST" action="{{ route('gadsense') }}">
                    @csrf
                    <div class="card-body">
                        @php
                            
                        @endphp

                        <div class="form-group col-12">
                            <label for="exampleInputEmail1">الكود</label>
                            <input type="text" name="gadsense" class="form-control">
                        </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">ادخال</button>
                    </div>
                </form>
            </div>
            <div class="card card-primary col-12" dir="rtl" style="text-align:right;padding: 0; margin-bottom: 2rem">
                <div class="card-header">
                    <h3 class="card-title">كود تحليلات قوقل</h3>
                </div>

                <!-- /.card-header -->

                <!-- form start -->
                <form method="POST" action="{{ route('ganalize') }}">
                    @csrf
                    <div class="card-body">
                        @php
                            
                        @endphp

                        <div class="form-group col-12">
                            <label for="exampleInputEmail1">الكود</label>
                            <input type="text" name="ganalize" class="form-control">
                        </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">ادخال</button>
                    </div>
                </form>
            </div>
        </div>



        </div>

        <script>
            $(function() {
                //Date range picker
                $('#reservation').daterangepicker()
                //Date range picker with time picker
                $('#reservationtime').daterangepicker({
                    timePicker: true,
                    timePickerIncrement: 30,
                    locale: {
                        format: 'MM/DD/YYYY hh:mm A'
                    }
                })
                //Date range as a button
                $('#daterange-btn').daterangepicker({
                        ranges: {
                            'Today': [moment(), moment()],
                            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                            'This Month': [moment().startOf('month'), moment().endOf('month')],
                            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                                'month').endOf('month')]
                        },
                        startDate: moment().subtract(29, 'days'),
                        endDate: moment()
                    },
                    function(start, end) {
                        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format(
                            'MMMM D, YYYY'))
                    }
                )
            })

            $.get({
                url: "../visits",
                success: function success(r) {
                    $("#visits").text(r);
                },
            });
            $.get({
                url: "../countonline",
                success: function success(r) {
                    $("#count").text(r);
                },
            });
            $.get({
                url: "../alllinks",
                success: function success(r) {
                    $("#countlinks").text(r);
                },
            });
            $.get({
                url: "../admin/sizeper",
                success: function success(r) {
                    $("#sizeper").text(r);
                },
            });
            $.get({
                url: "../urlvisits",
                success: function success(r) {
                    $("#urlvisits").text(r);
                },
            });
            $.get({
                url: "../countmobilevisits",
                success: function success(r) {
                    $("#countmobilevisits").text(r);
                },
            });
            $.get({
                url: "../countdeskevisits",
                success: function success(r) {
                    $("#countdeskevisits").text(r);
                },
            });
            $.get({
                url: "../countusers",
                success: function success(r) {
                    $("#countusers").text(r);
                },
            });
            setInterval(function() {
                $.get({
                    url: "../countonline",
                    success: function success(r) {
                        $("#count").text(r);
                    },
                });
                $.get({
                    url: "../alllinks",
                    success: function success(r) {
                        $("#countlinks").text(r);
                    },
                });
                $.get({
                    url: "../urlvisits",
                    success: function success(r) {
                        $("#urlvisits").text(r);
                    },
                });
            }, 600000);
        </script>

    @endsection
@endif
