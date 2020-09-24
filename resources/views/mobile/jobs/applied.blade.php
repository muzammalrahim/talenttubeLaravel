{{-- @extends('site.user.usertemplate') --}}
@extends('mobile.user.usermaster')
@section('content')


<h6 class="h6 jobAppH6">My Job Applications</h6>



@if ($applications->count() > 0)
@foreach ($applications as $application)
    {{-- @dump($applications) --}}

    <div class="card border-info mb-3 shadow mb-3 bg-white rounded job_row jobApp_{{$application->id}}">

        @php
            $job = $application->job;
        @endphp

        <div class="card">
            <div class="card-header jobInfoFont jobAppHeader p-2">

                <a>{{$job->title}}</a>

                <div class="jobAppStatus float-right">
                    <div class="font-weight-bold"> Status</div>
                    <div class="jobAppStatus">{{$application->status}}</div>
                </div>


                <div class="jobInfoFont">Location :
                    <span style="font-size: 12px">{{$job->city}},  {{$job->state}}, {{$job->country}}
                    </span>
                </div>
            </div>

            <div class="card-body jobAppBody p-2">

                <div class="row jobInfo">
                    <div class="col"><span>Job Type</span><br>
                        {{$job->type}}
                    </div>

                    <div class="col jobInfo"><span>Job Experience</span><br>
                        {{$job->experience}}
                    </div>

                    <div class="col jobInfo"><span>Job Salary</span><br>
                        {{$job->salary}}
                    </div>

                    <div class="col jobInfo"><span>Job Category</span><br>
                        Web & E-commerce Job
                    </div>
                </div>

{{--                 <div class="row">
                    <div class="col">{{$job->type}}</div>
                    <div class="col">{{$job->experience}}</div>
                    <div class="col">{{$job->salary}}</div>
                    <div class="col">Web & E-commerce Job</div>
                </div>   --}}

{{--                 <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col" class="jobInfo">Job Type</th>
                      <th scope="col" class="jobInfo">Job Experience</th>
                      <th scope="col" class="jobInfo">Job Salary</th>
                      <th scope="col" class="jobInfo">Job Category</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>{{$job->type}}</td>
                      <td>{{$job->experience}}</td>
                      <td>{{$job->salary}}</td>
                      <td>Web & E-commerce Job</td>
                    </tr>
                  </tbody>
                </table> --}}


                <h5 class="card-title jobDetailTitle">Job Detail</h5>
                <p class="card-text jobDetail">{{$job->description}}</p>
            </div>

            <div class="card-footer text-muted jobAppFooter p-2">
                <div class="row jobInfo jobFooter">
                    <div class="col"><span>Submitted</span><br>
                        {{$application->created_at->format('yy-m-d')}}
                    </div>
                    <a class="btn btn-sm btn-danger confirmJobAppRemoval redbtn jbtn mr-3" data-jobid="{{$application->id}}" data-toggle="modal" data-target="#deleteJobAppPopup" >Remove</a>


               {{--      <div class="float-right">
                        <a class="btn btn-sm btn-primary mr-0 btn-xs unlikeEmpButton" data-jsid="{{$js->id}}" data-toggle="modal" data-target="#unlikeEmpModal">UnLike</a>
                    </div> --}}


                </div>
            </div>

        </div>

    </div>

@endforeach

@else

<h3 class="h6 jobAppH6 mt-3">you hava not applied to any job.</h3>




@endif



@stop


@section('custom_footer_css')
<style type="text/css">


</style>
@stop

@section('custom_js')


<script type="text/javascript">

    $('.confirmJobAppRemoval').on('click',function(){
        var job_id = $(this).attr('data-jobid');
        console.log(' confirmJobAppRemoval click  job_id ', job_id, $(this) );
        $('#deleteConfirmJobAppId').val(job_id);
    });
    $(document).on('click','.confirm_jobAppDelete_ok',function(){
        $('.confirmJobAppDeleteModal').addClass('showLoader');
        var job_app_id = $('#deleteConfirmJobAppId').val();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'POST',
            url: base_url+'/m/ajax/MdeleteJobApplication/'+job_app_id,
            success: function(data){
                $('.confirmJobAppDeleteModal').removeClass('showLoader').addClass('showMessage');
                if( data.status == 1 ){
                    $('.confirmJobAppDeleteModal .apiMessage').html(data.message);
                    $('.jobApp_'+job_app_id).remove();
                }else{
                    $('.confirmJobAppDeleteModal .apiMessage').html(data.error);
                }
            }
        });
    });

</script>

@stop

