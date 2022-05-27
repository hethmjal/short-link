<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.css">

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.js"></script>

@extends('admin.main')
@section('content')
    <div class="uploads container" style="margin: 100px auto">
       <div class="card">
<div class="card-body">
<form method="post" action="{{ route('upload') }}"
enctype="multipart/form-data" class="dropzone dz-clickable" id="image-upload text-center" >
@csrf
<div><h3 class="text-center">رفع ملف جديد</h3></div>

<div class="dz-default dz-message"><span> اسحب الملف او اضغط لاختيار الملف</span></div>

</form>
</div>
</div>
        <div class="list">
            <div class="row">
                {{ @$msg }}
                @foreach ($files as $file)
                    <input type="hidden" id="file" value="{{ $file->file }}">
                    <div class="col-md-6">
                        <div class="card" style="border: none">
                            <div class="card-body" style="overflow: hidden">
                                @if (in_array($file->ext, ['jpg', 'jpeg', 'png','svg']))
                                    <div class="img">
                                        <a href="../u/{{ $file->file }}/vi"><img width="100%"
                                                src="{{ asset('up/' . $file->file) }}" alt=""></a>

                                    </div>
                                @elseif (in_array($file->ext, ['mp4', 'wmv', 'avi']))

                                    <div class="card-header" style="background: #fff">
                                        <div class="title text-center">
                                            <a href="../u/{{ $file->file }}/vi" style="color: #333">عرض الفيديو</a>
                                        </div>
                                    </div>

                                @else

                                    <a style="color: #fff" href="{{ asset('up/' . $file->file) }}" download>هذا الملف
                                        لا
                                        يمكن عرضه في
                                        المتصفح
                                        انقر لتحميله</a>

                                @endif

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>



@endsection
