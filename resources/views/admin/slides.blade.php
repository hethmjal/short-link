@if (!isset($_COOKIE['admin']))
    <meta http-equiv="refresh" content="0; url=login">
@endif
@extends('admin.main')
@section('content')
    <div class="admin">

        <div class="admin-ads container" style="margin: 60px auto;">
            <div class="container mt-5"
                style="max-width: 500px;display: flex;flex-direction: column;align-items: center;max-width: 500px">

                <label for="upload">
                    <i class="bx bx-upload"></i>
                    رفع ملف جديد
                </label>

                <form class="col-12" id="fileUploadForm" method="POST" action="{{ route('newslide') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <input name="image" id="upload" type="file" class="form-control" hidden>
                    </div>
                    <div class="form-group mb-3 text-right">
                        <span>ضع رابط الاعلان هنا</span>
                        <input name="link" type="url" class="form-control" required>
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

            <div class="row">
                @foreach ($slides as $slide)
                    <div class="img col-md-4">
                        <div class="ad">
                            <img src="{{ asset('slides/' . $slide->image) }}" width="100%">
                            <a href="deleteslide/{{ $slide->id }}" class="bt btn-danger col-12">حذف</a>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>


    </div>
    <style>
        .dropzone {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 100%;
            margin-bottom: 50px;
            border: 1px solid #dfdfdf;
        }

        .dz-preview>div {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .dz-progress {
            height: 20px;
            background: #4caf50;
            border-radius: 10px;
            margin: 20px 0;
        }

        .dz-button {
            margin: 20px
        }

        .dz-error-message,
        .dz-success-mark,
        .dz-error-mark {
            display: none !important
        }

    </style>

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
    </script>
@endsection
