@extends('layout/main')
@section('content')
<style>
    a[href="{{ route('home') }}"] {
        color: #e63946 !important
    }
</style>

<div class="home">
    @if ($errors->any())
    <div class="container">
        <div class="alert alert-danger alert-dismissible text-right">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-ban"></i> خطا!</h5>
            {{ $errors->first() }}
        </div>
    </div>

    @endif
    <form method="post" action="{{ route('new-link') }}">
        @csrf
        <div class="short container">

            <div class="link card col-md-6">
                <div class="card-header">
                    <div class="title">اختصار رابط</div>
                </div>
                <div class="card-body">
                    <p><span><img width="100%" src="images/logo.svg" alt="" srcset=""></span> هو موقع اختصار الروابط
                        الطويلة
                        الى روابط قصيرة سهلة لبحفظ وبمميزات رائعة</p>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <input type="submit" class="btn btn-danger" value="أختصر"
                                style="background: #dc3545 !important">
                        </div>
                        <input type="url" class="form-control" name="linkinput" required>
                    </div>
                </div>
            </div>
            <div class="mobile-ads container">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

                    <div class="carousel-inner">
                        @php
                        $i = 0;

                        @endphp
                        @foreach ($slides as $slide)
                        @if ($i === 0)
                        <div class="carousel-item active">
                            <div style="overflow: hidden ; max-height:100px">
                                <a href="{{ $slide->link }}"><img width="100%"
                                        src="{{ asset('slides/' . $slide->image) }}" alt=""></a>
                            </div>
                        </div>
                        @php
                        $i = 1;
                        @endphp
                        @else
                        <div class="carousel-item">
                            <div style="overflow: hidden ; max-height:100px">
                                <a href="{{ $slide->link }}"><img width="100%"
                                        src="{{ asset('slides/' . $slide->image) }}" alt=""></a>

                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>

                </div>

            </div>
            <div class="link card col-md-6">
                <div class="card-body">
                    <div class="img"><img src="images/sales.svg" alt=""></div>
                </div>
            </div>
            <div class="col-12 disk-ads">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

                    <div class="carousel-inner">
                        @php
                        $i = 0;

                        @endphp
                        @foreach ($slides as $slide)
                        @if ($i === 0)
                        <div class="carousel-item active">
                            <div style="overflow: hidden ; max-height:200px">
                                <a href="{{ $slide->link }}"><img width="100%"
                                        src="{{ asset('slides/' . $slide->image) }}" alt=""></a>
                            </div>
                        </div>
                        @php
                        $i = 1;
                        @endphp
                        @else
                        <div class="carousel-item">
                            <div style="overflow: hidden ; max-height:200px">
                                <a href="{{ $slide->link }}"><img width="100%"
                                        src="{{ asset('slides/' . $slide->image) }}" alt=""></a>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>

                </div>

            </div>
        </div>
        <div class="custom-link" style="margin-bottom: 100px">

            <div class="img" style="margin-bottom: -12px;">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                    <path fill="var(--wave)" fill-opacity="1"
                        d="M0,288L48,288C96,288,192,288,288,256C384,224,480,160,576,154.7C672,149,768,203,864,208C960,213,1056,171,1152,138.7C1248,107,1344,85,1392,74.7L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
                    </path>
                </svg>
            </div>


            <div class="content row">
                <div class="col-11 col-md-3">
                    <div class="link card">
                        <div class="card-header">
                            <div class="title">رسالة التوجيه</div>
                        </div>
                        <div class="card-body">
                            <i class="bx bx-comment"></i>
                            <p>اضافة رسالة خاصة للاشخاص الذين يقومون بزيارة الرابط المختصر قبل التوجه الى الرابط
                                الرئيسي.
                            </p>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control c-msg" dir="rtl" name="messsageinput"
                                    placeholder="رسالتك هنا ...">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-11 col-md-3">
                    <div class="link card c-link">
                        <div class="card-header">
                            <div class="title">رابط مخصص</div>
                        </div>
                        <div class="card-body">
                            <i class="bx bx-edit"></i>
                            <p>هذه الميزة تضع لك لمسة مميزة للرابط المختصر الخاص بك عن طريق تعديل لاحقة الرابط باسمك او
                                باي
                                كلمة اخرى</p>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">m-r.pw/</div>
                                </div>
                                <input type="text" style="font-family: monospace" name="customlinkinput"
                                    class="form-control c-msg" dir="ltr" placeholder="tik_tok">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-11 col-md-3">
                    <div class="link card c-lock">
                        <div class="card-header">
                            <div class="title">رمز قفل</div>
                        </div>
                        <div class="card-body">
                            <i class="bx bx-lock"></i>
                            <p> حماية اضافية عن طريق اضافة رمز قفل للرابط المختصر, يمكنك تغيير هذا الرمز في اي وقت</p>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control c-msg" name="pininput" dir="rtl"
                                    placeholder="رمز القفل">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    {{-- <div class="customers">
        <div class="container">
            <div class="card"
                style="border: none;
                                                                                                                                                            margin: 50px auto;">

                <!-- /.card-header -->
                <div class="card-body">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1" class=""></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2" class=""></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="card tes">
                                    <div class="card-header">
                                        <h3 class="card-title"><i class="bx bxs-quote-left"></i></h3>
                                    </div>
                                    <div class="card-body" style="background: #f7f7f7;">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing eli assumenda dicta,
                                            velit similique rem iure numquam aliquid quibusdam ratione laborum eum.</p>
                                        <div class="img"><img src="images/avatar1.PNG" alt="" srcset="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="card tes">
                                    <div class="card-header">
                                        <h3 class="card-title"><i class="bx bxs-quote-left"></i></h3>
                                    </div>
                                    <div class="card-body" style="background: #f7f7f7;">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing eli assumenda dicta,
                                            velit similique rem iure numquam aliquid quibusdam ratione laborum eum.</p>
                                        <div class="img"><img src="images/avatar1.PNG" alt="" srcset="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="card tes">
                                    <div class="card-header">
                                        <h3 class="card-title"><i class="bx bxs-quote-left"></i></h3>
                                    </div>
                                    <div class="card-body" style="background: #f7f7f7;">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing eli assumenda dicta,
                                            velit similique rem iure numquam aliquid quibusdam ratione laborum eum.</p>
                                        <div class="img"><img src="images/avatar1.PNG" alt="" srcset="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                            data-slide="prev">
                            <span class="carousel-control-custom-icon" aria-hidden="true">
                                <i class="fas fa-chevron-left"></i>
                            </span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                            data-slide="next">
                            <span class="carousel-control-custom-icon" aria-hidden="true">
                                <i class="fas fa-chevron-right"></i>
                            </span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div> --}}
</div>
@endsection