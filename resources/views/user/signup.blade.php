@if (isset($_COOKIE['id']))
<meta http-equiv="refresh" content="0; url=../">
@else
    

@extends('layout/main')
@section('content')
<style>a[href="{{route('signup')}}"]{color: #e63946 !important}</style>
    
<div class="signup container text-right">
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="card" dir="rtl">
          <div class="card-header">
            <h3 class="card-title">انشاء حساب</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form id="ss" >
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">الاسم الكامل</label>
                    <input autocomplete="no" type="text" class="form-control" id="nameinput" name="nameinput"  required>
                    <div class="val"><i class="bx bx-info-circle"></i><span class="text"></span></div>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">البريد الالكتروني</label>
                    <input type="email" class="form-control" autocomplete="off" id="emailinput" name="emailinput" required>
                    <div class="val"><i class="bx bx-info-circle"></i><span class="text"></span></div>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">كلمة المرور</label>
                    <input type="password" class="form-control" id="passwordinput" name="passwordinput" required>
                    <div class="val"><i class="bx bx-info-circle"></i><span class="text"></span></div>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">اعادة كتابة كلمة المرور</label>
                    <input type="password"  class="form-control" id="password2input" name="password2input"  required>
                    <div class="val"><i class="bx bx-info-circle"></i><span class="text"></span></div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <div  class="btn dis">جار انشاء الحساب...</div>
              <button type="submit" class="btn sign-up-btn" style="background: #00ff99; color: #fff">انشاء حساب</button>
              <a href="{{route('login')}}" class="btn" style="background: #0099ff; color: #fff">تسجيل الدخول</a>
            </div>
          </form>
        </div>

      </div>
</div>
@endsection
@endif