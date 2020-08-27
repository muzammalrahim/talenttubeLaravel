
@extends('mobile.user.usermaster')
@section('content')

 
<h6 class="h6 jobAppH6">My Jobs</h6>


@if ($jobs->count() > 0)
@foreach ($jobs as $job)

    {{-- @dump($job) --}}


    <div class="card border-info mb-3 shadow mb-3 bg-white rounded job_row jobApp_{{-- {{$application->id}} --}}">


        <div class="card">


             <div class="card-header jobAppHeader p-2 jobInfoFont">

                <button class="jobsTypeLablel float-right font-weight-normal" disabled>{{$job->type}} Job</button>

                <a>{{$job->title}}</a>
                <div>
                    <div class="row p-0 m-0">
                        <span class="jobInfoFont">Location : </span>
                            <div class="jobDetail font-weight-normal"  style="margin: 0.2rem 0 0 0.2rem;">
                             {{($job->GeoCity)?($job->GeoCity->city_title):''}},  {{($job->GeoState)?($job->GeoState->state_title):''}}, {{($job->GeoCountry)?($job->GeoCountry->country_title):''}}</div>
                    </div>
                </div>
            </div>

 
{{-- ============================================ Card Body ============================================ --}}

            <div class="card-body jobAppBody pt-2">

 
                <div class="row jobInfo">
                   
        {{--             <div class="col-4 p-0">
                        <img class="img-fluid z-depth-1" src="https://media-exp1.licdn.com/dms/image/C5103AQHK0mH7N_EvGg/profile-displayphoto-shrink_200_200/0?e=1601510400&v=beta&t=mxpoqv7XzDVLr_ACQKTkPsIKa5wSLg7JMke622gyR1U" height="100px" width="100px">
                    </div> --}}

                  {{--   <div class="col px-1"> <span class="jobInfojobInfo">Job Type</span>
                     	<div>{{$job->type}}</div>
                    </div> --}}

                   {{-- 	<div class="col px-1"> <span class="jobInfojobInfo"> Experience</span>
                     	<div>{{$job->experience}}</div>
                    </div> --}}

                   	<div class="col px-1"><span class="jobInfojobInfo"> Job Salary</span>
                     	<div>{{$job->salary}}</div>
                    </div>

                   	<div class="col px-1"> <span class="jobInfojobInfo"> Job Category </span>
                     	<div>Web & E-commerce Job</div>
                    </div>

                </div> 


                <div class="row px-1">
                    <div class="card-title col-12 p-0 mt-2 mb-0 jobInfoFont">Job Experience</div>
                	<p class="card-text jobDetail row m-0">{{$job->experience}}</p>
                </div>

                <div class="row px-1">
                    <div class="card-title col p-0 mt-2 mb-0 jobInfoFont">Job Detail</div>
                    <p class="card-text jobDetail row m-0">{{$job->description}}</p>
                </div>


                <div class="row pl-1 jobInfo">

                	<div class="col p-0 mt-2"> <span class="jobInfojobInfo"> Expire on</span>
                		<div>{{ ($job->expiration)?($job->expiration->format('yy-m-d')):''}}</div>
                	</div>

                	<div class="p-0 mt-2 float-right"> 

                		<a class="btn btn-sm btn-primary mr-0 btn-xs">Applications
                        ({{($job->applicationCount)?($job->applicationCount->aggregate):0}})
                    	</a>

                	</div>
                        
                </div>

            </div>

{{-- ============================================ Card Body end ============================================ --}}


{{-- ============================================ Card Footer ============================================ --}}

            <div class="card-footer text-muted jobAppFooter p-1">

                    <div class="float-right">
                        <a class="jobDetailBtn graybtn jbtn m5 btn btn-sm btn-danger ml-0 btn-xs" {{-- href="{{route('MemployerInfo', ['id' => $js->id])}}" --}}>Delete</a>
                        <a class="jobApplyBtn graybtn jbtn btn btn-sm btn-primary mr-0 btn-xs">Edit</a>

                        <a class="jobApplyBtn graybtn jbtn btn btn-sm btn-primary mr-0 btn-xs">Detail</a>

                    </div>
                    
            </div>

{{-- ============================================ Card Footer end ============================================ --}}


        </div>

    </div> 

@endforeach
@endif     



@stop


@section('custom_footer_css')
<style type="text/css">


</style>
@stop

@section('custom_js')


@stop

