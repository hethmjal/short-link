@if (isset($_COOKIE['id']))
@extends('layout.main')
@section('content')


@foreach ($data as $d)
    

    <div class="account container">
        <div class="row">

            <div class="col-md-12 text-right" dir="rtl">
                <h3>المعلومات الشخصية</h3>
                <div class="card text-right" >
                   
                    <div class="card-body" style="padding-top: 50px; padding-bottom: 50px">
                        <div class="col-md-6" >
                            <form id="{{$d->id}}">
                                <input type="hidden" name="id" value="{{$d->id}}">
                                <span>الاسم الكامل</span>
                                <input type="text" class="form-control mb-3" value="{{$d->name}}" name="nameinput">
                                <span>البريد الالكتروني</span>
                                <input type="text" class="form-control mb-4"  value="{{$d->email}}" name="emailinput">
                                <input type="submit" data-id="{{$d->id}}" class="edit btn btn-primary form-control mb-3" value="تعديل المعلومات">
                            </form>
                        </div>
                    </div>
                </div>
               
                <h3>كلمة المرور</h3>
                <div class="card text-right" dir="rtl">
                    <div class="card-body" style="padding-top: 50px; padding-bottom: 50px">
                        <div class="col-md-6" >
                            <form id="editpass">
                                <input type="hidden" name="id" value="{{$d->id}}">
                                <span>كلمة المرور الحالية</span>
                                <input type="password" class="form-control mb-3" name="oldpass">
                                <span>كلمة المرور الجديدة</span>
                                <input type="password" class="form-control mb-4" name="newpass">
                                <span>تاكيد كلمة المرور الجديدة</span>
                                <input type="password" class="form-control mb-4" name="newpass2">
                                <input type="submit" data-id="{{$d->id}}" class="editpass btn btn-primary form-control mb-3" value="تعديل المعلومات">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
@else
<meta http-equiv="refresh" content="0; url=/user/log-in">
@endif