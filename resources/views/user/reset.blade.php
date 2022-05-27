
@extends('layout.main')
@section('content')

    

    <div class="account container">
        <div class="row">

            <div class="col-md-12 text-right" dir="rtl">
                <h3>استعادة كلمة المرور</h3>
                <div class="card text-right" >
                   
                    <div class="card-body" style="padding-top: 50px; padding-bottom: 50px">
                        <div class="col-md-6" >
                            <form method="POST" action="{{route('send')}}">
                                @csrf
                                <span>سوف نرسل لك رسالة في بريدك الالكتروني</span>
                                <input type="text" class="form-control mb-4" name="emailinput">
                                <input type="submit"  class=" btn btn-primary form-control mb-3" value="ارسال الرمز">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
