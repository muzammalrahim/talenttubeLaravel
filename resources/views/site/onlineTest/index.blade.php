
@extends('site.employer.employermaster')

@section('custom_css')
{{-- <link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}"> --}}
{{-- <link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}"> --}}
@stop

@section('content')
{{-- <div class="newJobCont">
    <div class="head icon_head_browse_matches">Online Tests</div>

    <div class="add_new_job"> --}}

  
        <!-- =============================================================================================================================== -->
        {{--  <div class="jobs_list"> --}}
         {{--    @include('site.onlineTest.list') --}} {{-- site/onlineTest/list --}}
       {{--   </div> --}}
        <!-- =============================================================================================================================== -->

{{--     </div>

    <div class="cl"></div>
</div> --}}


{{-- html for testing --}}
<section class="row">
      {{-- <div class="col-md-12"> --}}
        <div class="profile profile-section">
          <h2>Online Tests</h2>
           {{-- <div class="row"> --}}
              @include('site.onlineTest.list') {{-- site/onlineTest/list --}}     
            {{-- </div> --}}
        </div>
    {{-- </div> --}}
</section>


@stop

@section('custom_footer_css')
<link rel="stylesheet" href="{{ asset('css/site/profile.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}"> --}}

@stop

@section('custom_js')
{{-- <script src="{{ asset('js/site/jquery.modal.min.js') }}"></script> --}}
<script src="{{ asset('js/site/jquery-ui.js') }}"></script>
<script src="{{ asset('js/site/common.js') }}"></script>

<script type="text/javascript">

</script>

@stop

