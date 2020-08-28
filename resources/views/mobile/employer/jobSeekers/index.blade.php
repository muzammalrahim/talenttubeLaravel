@extends('mobile.user.usermaster')
@section('content')
<div class="newJobCont">
    {{-- <div class="head icon_head_browse_matches">Job Seekers List</div> --}}

    
    <div class="add_new_job jobSeekersListingCont">

    	 <h6 class="h6 jobAppH6">Job Seekeers</h6>

        <!-- =============================================================================================================================== -->
            @include('mobile.employer.jobSeekers.filter')  

            <!-- 			mobile/employer/jobSeekers/filter 				-->
        
        <!-- =============================================================================================================================== -->

        <div class="jobSeekers_list">
            @include('mobile.employer.jobSeekers.list')
        </div>

            <!-- 			mobile/employer/jobSeekers/list 				-->

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
 







 