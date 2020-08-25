
@extends('mobile.user.usermaster')
@section('content')

 
<h6 class="h6 jobAppH6">Browse Jobs</h6>

@include('mobile.jobs.jobsModal')


@if ($jobs->count() > 0)
@foreach ($jobs as $job)
    {{-- @dump($job->jobEmployer->name) --}}

    <div class="card border-info mb-3 shadow mb-3 bg-white rounded job_row jobApp_{{-- {{$application->id}} --}}">


        <div class="card">
            <div class="card-header jobAppHeader p-2 jobInfoFont">
                <a>{{$job->title}}</a>
                <div class="jobAppStatus float-right">
                    @if ($job->code)
                        <div class="font-weight-bold"> Code: </div>
                        <div class="jobAppStatus">{{$job->code}}</div>
                    @endif
                </div>

                <div>
                    <div class="row p-0 m-0">
                        <span class="jobInfoFont">Location : </span>
                            <div class="jobDetail" style="margin: 0.2rem 0 0 0.2rem;">
                             {{($job->GeoCity)?($job->GeoCity->city_title):''}},  {{($job->GeoState)?($job->GeoState->state_title):''}}, {{($job->GeoCountry)?($job->GeoCountry->country_title):''}}</div>
                    </div>
                </div>

                    <div class="row p-0 m-0">
                        <span class="jobInfoFont">Employer : </span>
                            <span class="jobDetail" style="margin: 0.2rem 0 0 0.2rem;"> {{ $job->jobEmployer->name.' '.$job->jobEmployer->surname }}</span>
                    </div>
{{-- 
                <div>
                    <span><b>Employer :</b>{{ $job->jobEmployer->name.' '.$job->jobEmployer->surname }}</span>
                </div> --}}

            </div>

            <div class="card-body jobAppBody pt-2">

                <div class="row jobInfo">
                   
                    <div class="col-4 p-0">
                        <img class="img-fluid z-depth-1" src="https://media-exp1.licdn.com/dms/image/C5103AQHK0mH7N_EvGg/profile-displayphoto-shrink_200_200/0?e=1601510400&v=beta&t=mxpoqv7XzDVLr_ACQKTkPsIKa5wSLg7JMke622gyR1U" style="height:110px;">
                    </div>

                    <div class="col p-0 pl-3">

                        <div class="jobInfoFont float-left mr-1">Job Salary: </div> 
                            <div class="jobDetail" style="margin: 0.2rem 0 0 0.2rem; "> {{$job->salary}}</div>
                        <div class="mt-2">
                            <span class="jobInfoFont">Job Experience</span>
                        </div>
                        <div>
                        {{$job->experience}}
                        </div>
                        <div class="mt-2">
                            <span class="jobInfoFont">Job Category</span>
                        </div>

                        <div>
                        Web & E-commerce Job
                        </div>
                        
                    </div>

                </div> {{-- 39 line div --}}

{{--                 <div class="row p-0">
                    <div class="card-title col p-0 mt-2 mb-0 jobInfoFont">Job Experience</div>
                </div>
                <p class="card-text jobDetail row mb-1">{{$job->experience}}</p> --}}
            
                <div class="row p-0 mt-2">
                    <div class="card-title col p-0 mb-0 jobInfoFont">Job Detail</div>
                </div>
                <p class="card-text jobDetail row">{{$job->description}}</p>

            </div>

            <div class="card-footer text-muted jobAppFooter">
                <div class="row jobInfo jobFooter ">
                    <div class="col p-0"><span>Expire on</span><br>
                        {{ ($job->expiration)?($job->expiration->format('yy-m-d')):''}}
                    </div>

                    <div class="col p-0"> <button class="applicationsCount">Applications
                        ({{($job->applicationCount)?($job->applicationCount->aggregate):0}})
                    </button>

                    </div>

                    <div class="p-0 float-right mr-2"><span>Job Type</span><br>
                        {{$job->type}}
                    </div>
                </div>

                <div class="card-footer row p-0 mt-3">
                    <div class="col p-0">
                        <button class="jobDetailBtn graybtn jbtn m5 btn btn-sm blue-gradient ml-0 btn-xs" href="{{route('jobDetail', ['id' => $job->id]) }}">Detail</button>
                    </div>

                    <div class="float-right">
                        <button class="jobApplyBtn graybtn jbtn btn btn-sm blue-gradient mr-0 btn-xs" data-jobid="{{$job->id}}" data-toggle="modal" data-target="#modalJobApply">Apply</button>
                    </div>
                    
                </div>

            </div>

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

