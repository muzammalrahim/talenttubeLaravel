
@extends('mobile.user.usermaster')
@section('content')
{{-- @include('mobile.modals.jobsModal') --}}

 
<h6 class="h6 jobAppH6">Job's Detail</h6>


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

            </div>

            <div class="card-body jobAppBody pt-2">

                <div class="row jobInfo">
                   
                    <div class="col-4 p-0">
                        {{-- <img class="img-fluid z-depth-1" src="https://media-exp1.licdn.com/dms/image/C5103AQHK0mH7N_EvGg/profile-displayphoto-shrink_200_200/0?e=1601510400&v=beta&t=mxpoqv7XzDVLr_ACQKTkPsIKa5wSLg7JMke622gyR1U" style="height:110px;"> --}}
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

                </div> 

                <div class="row p-0 mt-2">
                    <div class="card-title col p-0 mb-0 jobInfoFont">Job Detail</div>
                </div>
                <p class="card-text jobDetail row">{{$job->description}}</p>

            </div>

            <div class="card-footer text-muted jobAppFooter">

                    <div class="float-right">

                       {{--  <a class="jobApplyBtn graybtn jbtn btn btn-sm btn-primary mr-0 btn-xs" href="{{route('MjobApplyInfo', ['id' => $job->id]) }}" data-toggle="modal" data-target="#modalJobApply" >Apply</a> --}}
                       @if (!isEmployer())
                        <a class="jobApplyBtn graybtn jbtn btn btn-sm btn-primary mr-0 btn-xs" job-id ="{{$job->id}}" job-title="{{$job->title}}">Apply</a>
                        @endif
                    </div>

            </div>

        </div>

    </div> 

@stop


@section('custom_footer_css')
<style type="text/css">


</style>
@stop

@section('custom_js')




<script type="text/javascript">
$(document).ready(function(){

    $('.graybtn').click(function(){
        console.log("jobapplybutton");
    });



});


  $(document).on('click','.jobApplyBtn', function() {
    console.log(' jobApplyBtn click  ');
    var jobPopId = parseInt($(this).attr('job-id'));
    var jobPopTitle = $(this).attr('job-title');
    $('.jobTitle').text(jobPopTitle);
    $('#openModalJobId').val(jobPopId);
    $('#modalJobApply').modal('show');

    $.ajax({
        type: 'GET',
            url: base_url+'/m/ajax/MjobApplyInfo/'+ jobPopId,
            success: function(data){
                console.log("apply for job call");
                $('.applyJobModalProcessing').addClass('d-none');
                $('.jobApplyModalContent').removeClass('d-none');
                $('.jobApplyModalContent').html(data);
            }
        });



  }); // jobApplyBtn click end 



</script>

@stop
