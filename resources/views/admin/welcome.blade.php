@extends('admin.main')
@section('content')
<div class="admin">
    <div class="admin-login container" style="">
        <h4>لوحة التحكم</h4>
        <div class="card col-md-6">
            <div class="card-body">
                <form method="POST" action="{{route('adminlogin')}}">
                    @csrf
                    <label>اسم المستخدم</label>
                    <input type="text" class="form-control mb-3" name="emailinput">
                    <label>كلمة المرور</label>
                    <input type="text" class="form-control mb-3" name="passwordinput">
                    <input type="submit" class="form-control mb-3 btn btn-primary" value="تسجيل الدخول">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection