

@extends('admin.main')
@section('content')
    <div class="uploads container" style="margin: 100px auto">
       <div class="container mt-5"
                style="max-width: 500px;display: flex;flex-direction: column;align-items: center;max-width: 500px">

                <label for="upload">
                    <i class="bx bx-upload"></i>
                    رفع ملف جديد
                </label>
                <span class="fname text-center"></span>

                <form class="col-12" id="fileUploadForm" method="POST" action="{{ route('upload') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <input name="file" id="upload" type="file" class="form-control" hidden>
                    </div>
                    

                    <div class="d-grid mb-3">
                        <input type="submit" value="رفع" class="btn btn-block btn-primary">
                    </div>

                    <div class="form-group">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger"
                                role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                                style="width: 0%"></div>
                        </div>
                    </div>
                </form>
            </div>
        <div class="list">
            <div class="row">
                {{ @$msg }}
                @foreach ($files as $file)
                    <input type="hidden" id="file" value="{{ $file->file }}">
                    <div class="col-md-6">
                        <div class="card" style="border: none">
                            <div class="card-body" style="overflow: hidden">
                                @if (in_array($file->ext, ['jpg','JPG','JPEG','jpeg', 'png','PNG','svg','SVG']))
                                    <div class="img">
                                        <a href="../u/{{ $file->file }}/vi"><img width="100%"
                                                src="{{ asset('up/' . $file->file) }}" alt=""></a>

                                    </div>
                                @elseif (in_array($file->ext, ['mp4','MP4','WMV', 'wmv', 'avi','AVI']))

                                    <div class="card-header" style="background: #fff">
                                        <div class="title text-center">
                                            <a href="../u/{{ $file->file }}/vi" style="color: #333">عرض الفيديو</a>
                                        </div>
                                    </div>

                                @else

                                    <a style="color: #fff" dir="rtl" href="{{ asset('up/' . $file->file) }}" download>هذا الملف
                                    {{ $file->file }}
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
<script>
        $(function() {
            $(document).ready(function() {
                $('#fileUploadForm').ajaxForm({
                    beforeSend: function() {
                        var percentage = '0';
                    },
                    uploadProgress: function(event, position, total, percentComplete) {
                        var percentage = percentComplete;
                        $('.progress .progress-bar').css("width", percentage + '%', function() {
                            return $(this).attr("aria-valuenow", percentage) + "%";
                        })
                    },
                    complete: function(xhr) {
                        location.reload();
                    }
                });
            });
        });
        
        $("#upload").on('change',function(){
            var filename = $(this).val().replace(/C:\\fakepath\\/i, '')
            $(".fname").text(filename)
        })
    </script>


@endsection
