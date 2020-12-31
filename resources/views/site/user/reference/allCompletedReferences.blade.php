{{-- @extends('site.user.usertemplate') --}}
@extends('site.user.reference.referencemaster')   {{-- site/user/reference/referencemaster --}}

@section('custom_css')
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
@stop

@section('content')
<div class="card">
    <div class="card-header text-center headerBG font-weight-bold"><h5>Completed References</h5></div>
    <div class="card-body bodyBG">
      @if ($crossreference->count()>0)
        @foreach ($crossreference as $reference)
        <div class="referees1 p-3">
          <div class="row"> 
            <h5 class="bold col-md-2">Reference ({{ $loop->index+1 }}):</h5> 
            <h5 class="bold col-md-10"> {{ $reference->refType }}</h5>
          </div>
          <h5 class="font-weight-bold text-center mb-4">Job Seeker's Detail</h5>
          <div class="form-group row">
            <label for="inputEmail4" class="col-md-1">Name:</label>
            <span type="text" class="form-control col-md-3" id="inputEmail4">{{$reference->jsdata->name}}</span>
            <label for="inputPhone" class="col-md-1">Phone:</label>
            <span class="form-control col-md-3" id="inputPhone" name="refereePhone">{{$reference->jsdata->phone}}</span>
            <label for="inputPassword4" class="col-md-1">Email: </label>
            <span type="text" class="form-control col-md-3" id="inputPassword4">{{$reference->jsdata->email}}</span>
          </div>
          @if ($reference->refType == 'Work Reference')
            @include('site.user.reference.layouts.workReference')     {{-- site/user/reference/layouts/workReference --}}
          @elseif($reference->refType == 'Personal Reference')
            @include('site.user.reference.layouts.personalReference')     {{-- site/user/reference/layouts/personalReference --}}
          @else($reference->refType == 'Educational Reference')
            @include('site.user.reference.layouts.educationalReference')     {{-- site/user/reference/layouts/educationalReference --}}
          @endif
        </div>
      @endforeach
      @else
          <div class="p-0 m-0"> <span class="bold">{{$jsName}} </span> <span> has not any completed reference yet</span></div>
      @endif
    </div>
    <div class="card-footer text-center headerBG font-weight-bold"> TalentTube </div>
</div>


@stop

@section('custom_footer_css')
<link rel="stylesheet" href="{{ asset('css/site/profile.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}">
{{-- <link rel="stylesheet" href="{{ asset('css/site/gallery_popup/magnific-popup.css') }}"> --}}
{{-- <link rel="stylesheet" href="{{ asset('css/site/gallery_popup/lc_lightbox.css') }}"> --}}
<style>

.col_center{background: none !important;}
.headerBG{background: #e9ecef;}
.bodyBG{background: #f7f7f7;}
/*.referees1{width: 48%; border:1px solid #dcdee2;margin: 0 10px 10px 0;}*/
.referees1:nth-child(even) {
  background: #e9ecef;
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

