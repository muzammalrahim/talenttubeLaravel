{{-- @extends('site.user.usertemplate') --}}

@extends('site.employer.employermaster') {{-- site/employer/employermaster --}}

@section('custom_css')
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
@stop

@section('content')
<div class="newJobCont">
    <div class="head icon_head_browse_matches">Talent Matcher</div>
    <div class="add_new_job jobSeekersListingCont">

        <!-- =============================================================================================================================== -->
        <div class="jobSeekers_list">
            @include('site.talent_matcher.list')  {{-- site/talent_matcher/list --}}
        </div>
        <!-- =============================================================================================================================== -->
    </div>
    <div class="cl"></div>
</div>




@stop



@section('custom_js')
<script src="{{ asset('js/site/jquery-ui.js') }}"></script>
<script src="{{ asset('js/site/common.js') }}"></script>



</script>
@stop




@section('custom_footer_css')
<link rel="stylesheet" href="{{ asset('css/site/profile.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}">
@stop
