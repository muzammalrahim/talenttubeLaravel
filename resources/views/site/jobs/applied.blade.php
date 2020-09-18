{{-- @extends('site.user.usertemplate') --}}
@extends('site.employer.employermaster')

@section('custom_css')
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
@stop

@section('content')
<div class="newJobCont">
    <div class="head icon_head_browse_matches">My Jobs Application</div>

    <div class="add_new_job">
        {{-- @dump($applications) --}}
        <div class="job_row_heading jobs_filter">

        </div>

        @if ($applications->count() > 0)
        @foreach ($applications as $application)
        <div class="job_row jobApp_{{$application->id}}">

            @php
                $job = $application->job;
            @endphp

            <div class="job_heading p10">
                <div class="w_80p">
                    <h3 class=" job_title"><a>{{$job->title}}</a></h3>
                    <div class="job_location">
                        <span>Location : </span>{{$job->city}},  {{$job->state}}, {{$job->country}}
                    </div>
                </div>

                <div class="fl_right">
                    <div class="j_label bold">Status</div>
                    <div class="j_value text_capital">{{$application->status}}</div>
                </div>

            </div>

            <div class="job_info row p10 dblock">
                <div class="w_25p">
                    <div class="j_label bold">Job Type</div>
                    <div class="j_value">{{$job->type}}</div>
                </div>

                <div class="w_25p">
                    <div class="j_label bold">Job Experience</div>
                    <div class="j_value">{{$job->experience}}</div>
                </div>

                <div class="w_25p">
                    <div class="j_label bold">Job Salary</div>
                    <div class="j_value">{{$job->salary}}</div>
                </div>

                <div class="w_25p">
                    <div class="j_label bold">Job Category</div>
                    <div class="j_value">Web & E-commerce Job</div>
                </div>
            </div>

            <div class="job_detail p10">
                <div class="j_label bold">Job Detail</div>
                <div>{{$job->description}}</div>
            </div>

            <div class="job_footer p10 relative">
                <div class="w_25p">
                    <div class="j_label bold">Submitted</div>
                    {{-- @dump($applications->created_at->format('yy-mm-dd')) --}}
                    <div class="j_value">{{$application->created_at->format('yy-m-d')}}</div>
                </div>

                <div class="js_actionBtn bottom_10">
                    <button class="confirmJobAppRemoval redbtn jbtn" data-jobid="{{$application->id}}">Remove</button>
                </div>
            </div>


        </div>
        @endforeach
            @else
                <h3>You have not applied to any job yet</h3>
        @endif

    </div>

<div class="cl"></div>
</div>



<div style="display:none;">
<div id="confirmJobAppDeleteModal" class="modal cmodal p0 confirmJobAppDeleteModal wauto">
    <div class="pp_info_start pp_alert pp_confirm pp_cont" style="left: 0px; top: 0px; margin: 0;">
        <div class="cont">
            <div class="title">Delete Job Application?</div>
            <div class="spinner_loader">
                <div class="spinner center">
                    <div class="spinner-blade"></div>
                    <div class="spinner-blade"></div>
                    <div class="spinner-blade"></div>
                    <div class="spinner-blade"></div>
                    <div class="spinner-blade"></div>
                    <div class="spinner-blade"></div>
                    <div class="spinner-blade"></div>
                    <div class="spinner-blade"></div>
                    <div class="spinner-blade"></div>
                    <div class="spinner-blade"></div>
                    <div class="spinner-blade"></div>
                    <div class="spinner-blade"></div>
                </div>
            </div>
            <div class="apiMessage mt20"></div>
            <div class="img_chat">
                <div class="icon">
                    <img src="{{asset('/images/site/icons/icon_pp_sure.png')}}" height="48" alt="">
                </div>
                <div class="msg">Are you sure you wish to continue?</div>
            </div>
            <div class="double_btn">
                <button class="confirm_close btn small dgrey" onclick="UProfile.cancelGalleryConfirm(); return false;">Cancel</button>
                <button class="confirm_jobAppDelete_ok confirm_btn btn small marsh">OK</button>
                <input type="hidden" name="deleteConfirmJobAppId" id="deleteConfirmJobAppId" value=""/>
                <div class="cl"></div>
            </div>
        </div>
    </div>
</div>
</div>


@stop

@section('custom_footer_css')
<link rel="stylesheet" href="{{ asset('css/site/profile.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}">
@stop

@section('custom_js')
<script src="{{ asset('js/site/jquery.modal.min.js') }}"></script>
<script src="{{ asset('js/site/jquery-ui.js') }}"></script>
<script src="{{ asset('js/site/common.js') }}"></script>
<script type="text/javascript">
$(document).ready(function() {
    console.log(' new job doc ready  ');

    $(".datepicker").datepicker({ dateFormat: "yy-mm-dd" });

    $('.confirmJobAppRemoval').on('click',function(){
        var job_id = $(this).attr('data-jobid');
        console.log(' confirmJobAppRemoval click  job_id ', job_id, $(this) );
        $('.modal.cmodal').removeClass('showLoader').removeClass('showMessage');
        $('.confirm_close').show();

        $('#confirmJobAppDeleteModal').modal({
            fadeDuration: 200,
            fadeDelay: 2.5,
            escapeClose: false,
            clickClose: false,
        });
        $('#deleteConfirmJobAppId').val(job_id);
    });

    $(document).on('click','.confirm_jobAppDelete_ok',function(){
        // $('.confirmJobAppDeleteModal  .img_chat').html(getLoader('jobDeleteloader'));
        // $(this).prop('disabled',true);
        // $.modal.close();
        // console.log('job delete button');
        $('.confirmJobAppDeleteModal').addClass('showLoader');
        var job_app_id = $('#deleteConfirmJobAppId').val();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/deleteJobApplication/'+job_app_id,
            success: function(data){
                $('.confirmJobAppDeleteModal').removeClass('showLoader').addClass('showMessage');
                if( data.status == 1 ){
                    $('.confirmJobAppDeleteModal .apiMessage').html(data.message);
                    $('.jobApp_'+job_app_id).remove();
                    $('.confirm_close').hide();
                }else{
                    $('.confirmJobAppDeleteModal .apiMessage').html(data.error);
                }
            }
        });

    });

});
</script>
@stop

