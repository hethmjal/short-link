@if (!isset($_COOKIE['id']))
<meta http-equiv="refresh" content="0; url=user/log-in">
@else

@extends('layout.main')
@section('content')
<div class="all-links container-fluid">
    <div class="col-12 all-links">
        <h4 style="color:#333">جميع الروابط المنشأة</h4>
        <table id="links" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>الرابط</th>
                    <th>تاريخ الاضافة</th>
                    <th>الرابط الاصلي</th>
                    <th>الضغطات</th>
                    <th>الرسالة</th>
                    <th>رمز القفل</th>
                    <th>الخيارات</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @php
                $i = 1;
                @endphp
                @foreach ($links as $link)

                <tr>
                    <td><span data-id="{{ $i }}">{{ $i }}</span></td>
                    <td><a href="u/{{ $link->link }}">m-r.pw/u/{{ $link->link }}</a></td>
                    <td><span>{{ $link->created_at }}</span></td>
                    <td><span><a href="{{ $link->original_link }}">{{ $link->original_link }}</a></span></td>
                    <td><span>{{ $link->views }}</span></td>
                    <td><span>{{ $link->custom_msg }}</span></td>
                    <td><span>{{ $link->link_pin }}</span></td>
                    <td><a href="{{ $link->link }}/stats" class="btn btn-success">الاحصائيات</a></td>
                    <td><a href="../deletelink/{{ $link->id }}" class="btn btn-danger">حذف</a></td></td>
                </tr>
                @php
                $i++;
                @endphp
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@endif