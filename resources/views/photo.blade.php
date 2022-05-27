@extends('admin.main')
@section('content')
    <div class="col-10 container">


        <div class="card">
            <div class="card-body">
                @foreach ($data as $d)
                    <input type="hidden" id="file" value="{{ $d->file }}">

                    @if (in_array($d->ext, ['mp4', 'wmv', 'avi']))
                        <link href="{{ asset('css/skin.css') }}" rel="stylesheet" type="text/css" />






<div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="../../up/{{ $d->file }}" allowfullscreen></iframe>
</div>

  <div class="card-header" style="background: #fff">
                            <div class="title text-center">
                                <a href="{{ asset('up/' . $d->file) }}" download style="color: #333">تحميل | Download</a>
                            </div>
                        </div>
                        <script src="{{ asset('js/scripts/config_xml.js') }}"></script>
                     

                    @else
                        <div class="img" style="overflow: hidden">
                            <img width="100%" src="{{ asset('up/' . $d->file) }}" alt="" srcset="">
                        </div>
                        <div class="card-header" style="background: #fff">
                            <div class="title text-center">
                                <a href="{{ asset('up/' . $d->file) }}" download style="color: #333">تحميل</a>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

<script>

$("#fl").on("click",function(){

if($("#tscVideoContent").css("position") == "fixed"){
$("#tscVideoContent").css({
position:"relative",})
}else{

$("#tscVideoContent").css({
position:"fixed",
left:0,
width:"100%",
background:"#000",
height:"100%"

})
}
})
</script>
@endsection
