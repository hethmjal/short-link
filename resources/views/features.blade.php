@extends('layout.main')
@section('content')
<style>
    a[href="{{route('features')}}"]{
        color: #e63946 !important;
    }
</style>
<div class="features container">
    <div class="row">
    <div class="col-md-4">

        <div class="feature">
            <div style="width: 80%"><img width="100%" src="{{asset('images/sales.svg')}}" alt="" srcset=""></div>
            <div class="title">مجاني</div>
            <p>نقدم لك هذه الخدمة مجانا وسوف تظل مجانا دائما, ليس هناك حدود لانشاء الروابط المختصرة</p>
        </div>
    </div>
    <div class="col-md-4">

        <div class="feature">
            <div style="width: 80%"><img width="100%" src="images/marketing.svg" alt="" srcset=""></div>
            <div class="title">سريع ودقيق</div>
            <p>نحن نعلم اختصار الروابط ، m-r.pw يعمل على اختصار الروابط على مدار الساعة. يعمل m-r.pw أيضًا على أحدث وأكبر تقنيات الويب مما يجعله سريعًا ودقيقًا للغاية!</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="feature">
            <div style="width: 80%"><img width="100%" src="images/phone.svg" alt="" srcset=""></div>
            <div class="title">متوافق مع جميع الاجهزة</div>
            <p>يعمل m-r.pw ويبدو رائعًا على جميع الأجهزة الذكية بما في ذلك الهواتف وأجهزة الكمبيوتر والأجهزة اللوحية وأي شيء بينهما.</p>
        </div>
    </div>
</div>
</div>
@endsection