@extends('mobile.user.usermaster')
@section('content')
<div class="newJobCont">
    {{-- <div class="head icon_head_browse_matches">Job Seekers List</div> --}}

    
    <div class="add_new_job jobSeekersListingCont">

        <!-- =============================================================================================================================== -->
            @include('mobile.employer.jobSeekers.filter')  
        <!-- =============================================================================================================================== -->
        
        <!-- =============================================================================================================================== -->
         <div class="jobSeekers_list">
            {{-- @include('site.employer.jobSeekers.list') --}}
        </div>
        <!-- =============================================================================================================================== -->

    </div>

<div class="cl"></div>
</div>



 


@stop


 
@section('custom_footer_css')
@stop

@section('custom_js')

<script type="text/javascript" src="https://maps.google.com/maps/api/js?libraries=places&key={{env('GOOGLE_API')}}"></script>
<script type="text/javascript">
$(document).ready(function(){ })
</script>
@stop

