@if (!isset($_COOKIE['admin']))
    <meta http-equiv="refresh" content="0; url=login">
@endif
@extends('admin.main')
@section('content')
    <div class="container">
        @foreach ($up as $up)
            <div class="card-header">
                <div class="title" dir="rtl" style="display: flex;
                                    justify-content: space-around;">
                    <div>قام {{ $up->user_name }} </div>
                    <div>برفع الملف {{ $up->file }}</div>
                    <a class="btn btn-primary" href="../u/{{ $up->file }}/vi">معاينة</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
