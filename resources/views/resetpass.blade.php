
@extends('layout.main')
@section('content')

    

    <div class="account container">
        <div class="row">

            <div class="col-md-12 text-right" dir="rtl">
                <h3>تغيير كلمة المرور</h3>
                <div class="card text-right" >
                   
                    <div class="card-body" style="padding-top: 50px; padding-bottom: 50px">
                        <div class="col-md-6" >
                            <form method="POST" action="{{route('changepass')}}">
                                @csrf
                                @foreach ($data as $d)
                                <input type="hidden" name="id" value="{{$d->id}}">
                                @endforeach
                                
                                <span>اكتب كلمة المرور الجديدة</span>
                                <input type="password" class="form-control mb-4" name="passinput">
                                <span>اعادة كتابة كلمة المرور</span>
                                <input type="password" class="form-control mb-4" name="pass2input">
                                <input type="submit"  class=" btn btn-primary form-control mb-3" value="تغيير كلمة المرور">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
