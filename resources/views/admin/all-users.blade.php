@if (!isset($_COOKIE['admin']))
    <meta http-equiv="refresh" content="0; url=login">
@else
    @extends('admin.main')
    @section('content')
        <div class="admin container">
            <div class="col-12 all-users" style="color:#fff">
                <h4>جميع المستخمين</h4>
                <table id="users" style="color: #fff" class="table table-striped table-bordered dt-responsive nowrap"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الاسم</th>
                            <th>البريد الالكتروني</th>
                            <th>الخيارات</th>
                            <th></th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($users as $user)

                            <tr>
                                <form id="{{ $user->id }}">
                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                    <td>{{ $i }}</td>
                                    <td><input type="text" value="{{ $user->name }}" name="nameinput"></td>
                                    <td><input type="text" value="{{ $user->email }}" name="emailinput"></td>
                                    <td><input type="submit" data-id="{{ $user->id }}" value="تعديل"
                                            style="margin: 0 10px;" class="btn btn-success" id="edituser" /></td>
                                    <td><button data-id="{{ $user->id }}" class="btn btn-danger">حذف</button></td>
                                    @if ($user->status == 0)
                                        <td><a style="color: #fff" href="setadmin?id={{ $user->id }}"
                                                class="btn btn-primary">ترقية مشرف</a></td>
                                    @else
                                        <td></td>
                                    @endif
                                </form>
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
