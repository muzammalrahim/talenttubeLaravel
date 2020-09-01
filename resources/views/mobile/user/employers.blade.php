
@if(!$ajax) 
    @extends('mobile.user.usermaster')
    @section('content')
@endif


<h6 class="h6 jobAppH6">Employers</h6>

@include('mobile.jobs.jobsModal')


    <!-- ===================================================== Employer Filter ===================================================== -->

    @include('mobile.user.employersFilter')  
     
    <!-- ===================================================== Employer List ===================================================== -->


    <div class="jobSeekers_list">
        @include('mobile.user.employersList')  	<!--	mobile/user/employersList 		 -->
    </div>


@if(!$ajax) 

    @stop

@endif

