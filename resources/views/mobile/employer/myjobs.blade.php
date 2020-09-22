
@extends('mobile.user.usermaster')
@section('content')
@include('mobile.modals.jobsModal')

<h6 class="h6 jobAppH6">My Jobs</h6>


@if ($jobs->count() > 0)
@foreach ($jobs as $job)

    {{-- @dump($job) --}}


    <div class="card border-info mb-3 shadow mb-3 bg-white rounded job_row jobApp_{{-- {{$application->id}} --}}">


        <div class="card">
            {{-- @dump($job) --}}
            {{-- $job->type =  $requestData['type']; --}}


             <div class="card-header jobAppHeader p-2 jobInfoFont">

                <button class="jobsTypeLablel float-right font-weight-normal" disabled> {{$job->type}} Job</button>

                <a>{{$job->title}}</a>
                <div>
                    <div class="row p-0 m-0">
                        <span class="jobInfoFont">Location : </span>
                            <div class="jobDetail font-weight-normal"  style="margin: 0.2rem 0 0 0.2rem;">
                             {{$job->city}},  {{$job->state}}, {{$job->country}}</div>
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

                        {{-- @dump($job->applicationCount) --}}



                		<a class="btn btn-sm btn-primary mr-0 btn-xs"  href="{{route('MempJobApplications',['id' => $job->id])}}">Applications
                        ({{($job->applicationCount)?($job->applicationCount->aggregate):0}})
                    	</a>

                	</div>

                </div>

            </div>

{{-- ============================================ Card Body end ============================================ --}}


{{-- ============================================ Card Footer ============================================ --}}

            <div class="card-footer text-muted jobAppFooter p-1">

                    <div class="float-right">
                        <a class="myJobDeleteBtn graybtn jbtn m5 btn btn-sm btn-danger ml-0 btn-xs" data-jobid="{{$job->id}}" {{-- href="{{route('MdeleteJob', ['id' => $job->id])}}" --}} data-toggle="modal" data-target="#deleteJobPopup" >Delete</a>
                        <a class="jobApplyBtn graybtn jbtn btn btn-sm btn-primary mr-0 btn-xs" href="{{route('Mjobedit', ['id' => $job->id]) }}">Edit</a>

                        <a class="jobApplyBtn graybtn jbtn btn btn-sm btn-primary mr-0 btn-xs" href="{{route('MjobDetail', ['id' => $job->id]) }}">Detail</a>

                    </div>

            </div>

{{-- ============================================ Card Footer end ============================================ --}}


        </div>

    </div>

@endforeach

@else
<h6 class="h6 jobAppH6">You have not posted any job yet.</h6>

@endif






@stop


@section('custom_footer_css')
<style type="text/css">

div#centralModalSuccess {
    height: 100%;
    width: 100%;
    background: #21252940;
    padding-top: 50%;
}

#successMessageJobdeleting{
    height: 100%;
    width: 100%;
    padding-top: 50%;
    font-size: 25px;
    background: #1411118c;
}
</style>
@stop

@section('custom_js')

<script type="text/javascript">

$('.myJobDeleteBtn').on('click',function(){
    var job_id = $(this).attr('data-jobid');
    console.log(' confirmJobAppRemoval click  job_id ', job_id, $(this) );
        $('#deleteConfirmJobId').val(job_id);
});

$(document).on('click','.confirm_jobDelete_ok',function(){
    var job_id =  $('#deleteConfirmJobId').val();
        $('#centralModalSuccess').show().delay(1000).fadeOut('slow');
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.ajax({
        type: 'POST',
        url: base_url+'/m/ajax/MdeleteJob/'+job_id,
        success: function(data){
            if( data.status == 1 ){
                // $('.confirmJobDeleteModal .img_chat').html(data.message);
                // $('.job_row.job_'+job_id).remove();
                    $('.jobDeleted').show().delay(2000).fadeOut('slow');
                    location.reload();

            }else{
                // $('.confirmJobDeleteModal .img_chat').html(data.error);
            }
        }
    });
});

</script>

@stop

