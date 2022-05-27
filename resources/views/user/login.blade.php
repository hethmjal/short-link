@if (isset($_COOKIE['id']))
<meta http-equiv="refresh" content="0; url=../">
@else
    

@extends('layout/main')

@section('content')
<style>a[href="{{route('login')}}"]{color: #e63946 !important}</style>
<div class="login container text-right">
  <div class="col-md-6">
      <!-- general form elements -->
      <div class="card" dir="rtl">
        <div class="card-header">
          <h3 class="card-title">تسجيل الدخول</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form id="loginForm">
          {{-- @csrf --}}
          <div class="card-body">
            <div class="form-group">
              <label for="exampleInputEmail1">اسم المستخدم</label>
              <input type="email" class="form-control" id="emailinput"   name="emailinput" placeholder="">
              <div class="val"><i class="bx bx-info-circle"></i><span class="text"></span></div>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">كلمة المرور</label>
              <input type="password" class="form-control" id="passwordinput" name="passwordinput" placeholder="">
              <div class="val"><i class="bx bx-info-circle"></i><span class="text"></span></div>
            </div>
            <a href="{{route('reset')}}">هل نسيت كلمة المرور؟</a>
          </div>
          <!-- /.card-body -->

          <div class="card-footer" >
            <button type="submit" class="btn sign-in-btn" style="background: #0099ff; color: #fff">تسجيل الدخول</button>
            <a href="{{route('signup')}}" class="btn" style="background: #00ff99; color: #fff">انشاء حساب</a>
          </div>
        </form>
      </div>

    </div>
</div>
@endsection
@endif