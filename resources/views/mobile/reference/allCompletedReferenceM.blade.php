{{-- @extends('site.user.usertemplate') --}}
@extends('mobile.reference.refMobileMaster')  {{-- mobile/reference/refMobileMaster --}}

@section('custom_css')
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
@stop

@section('content')
<div class="height500">
<div class="card shadow-none">
    <div class="card-header text-center headerBG font-weight-bold"><h6>Completed References</h6></div>
    <div class="card-body bodyBG">
      @if ($crossreference->count()>0)
      @foreach ($crossreference as $reference)
        <div class="referees1 p-2">
          <div class="row"> 
            <h6 class="font-weight-bold col-5">Reference ({{ $loop->index+1 }}):</h6> 
            <h6 class="font-weight-bold col-7"> {{ $reference->refType }}</h6>
          </div>
          <h6 class="font-weight-bold text-center my-4">Job Seeker's Detail</h6>
          <div class="form-group">
            <label for="inputEmail4">Name:</label>
            <span type="text" class="form-control" id="inputEmail4">{{$reference->jsdata->name}}</span>
          </div>
          <div class="form-group">
            <label for="inputPhone">Phone:</label>
            <span class="form-control" id="inputPhone" name="refereePhone">{{$reference->jsdata->phone}}</span>
          </div>
          <div class="form-group">
            <label for="inputPassword4">Email: </label>
            <span type="text" class="form-control" id="inputPassword4">{{$reference->jsdata->email}}</span>
          </div>
           @if ($reference->refType == 'Work Reference')
            @include('mobile.reference.layouts.workReference')
          @elseif($reference->refType == 'Personal Reference')
            @include('mobile.reference.layouts.personalReference')  {{-- mobile/reference/layouts/personalReference --}}
          @else($reference->refType == 'Educational Reference')
            @include('mobile.reference.layouts.educationalReference')
          @endif
        </div>
      @endforeach
      @else
        <p class="p-0 m-0"> <span class="font-weight-bold">{{$jsName}} </span> <span> has not any completed reference yet </span></p>
      @endif

    </div>
</div>

<div class="card-header bgcolor text-center font-weight-bold"> TalentTube</div>


</div>
@stop

@section('custom_footer_css')
<link rel="stylesheet" href="{{ asset('css/site/profile.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}">
{{-- <link rel="stylesheet" href="{{ asset('css/site/gallery_popup/magnific-popup.css') }}"> --}}
{{-- <link rel="stylesheet" href="{{ asset('css/site/gallery_popup/lc_lightbox.css') }}"> --}}
<style>

.col_center{background: none !important;}
.bgcolor{background: #e9ecef !important;margin-top: -2px}
.headerBG{background: #e9ecef !important;  position: fixed;width: 100%;}
.bodyBG{margin-top: 40px;}
.referees1{border:1px solid #dcdee2;margin: 0 10px 10px 0;}
.referees1:nth-child(even) {
  background: #e9ecef;
}

main .container-fluid {
    background: none !important;
}

.card {
    height: 550px;
    overflow: scroll;
}

.container-fluid {
     width: 100% !important; 
     border-radius: 0px !important; 
     margin-top: 00px !important; 
    padding: 0px !important;
}
</style>

@stop

@section('custom_js')
<script src="{{ asset('js/site/jquery.modal.min.js') }}"></script>
<script src="{{ asset('js/site/jquery-ui.js') }}"></script>
<script src="{{ asset('js/site/common.js') }}"></script>

<script type="text/javascript">


</script>
@stop

