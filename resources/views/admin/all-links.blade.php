@if (!isset($_COOKIE['admin']))
    <meta http-equiv="refresh" content="0; url=login">
@else
    @extends('admin.main')
    @section('content')
        <div class="admin container">
            <div class="col-12 all-links" style="color:#fff">
                <h4>جميع المستخمين</h4>
                <table id="links" style="color: #fff" class="table table-striped table-bordered dt-responsive nowrap"
                    style="width:100%">
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

                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($links as $link)

                            <tr>


                                <td>{{ $i }}</td>
                                <td><a href="https://m-r.pw/u/{{ $link->link }}"
                                        style="color: #fff">{{ $link->link }}</a></td>
                                <td>{{ $link->created_at }}</td>
                                <td>{{ $link->original_link }}</td>


                                <td>{{ $link->views }}</td>

                                <td>{{ $link->custom_msg }}</td>
                                <td>{{ $link->link_pin }}</td>

                                <td><a href="../deletelink/{{ $link->id }}" class="btn btn-danger">حذف</a></td>


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
