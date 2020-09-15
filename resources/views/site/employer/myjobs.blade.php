{{-- @extends('site.user.usertemplate') --}}
@extends('site.employer.employermaster')

@section('custom_css')
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
@stop

@section('content')
<div class="newJobCont">
    <div class="head icon_head_browse_matches">My Jobs</div>
    <div class="add_new_job">
        <div class="job_row_heading jobs_filter"></div>

        @if ($jobs->count() > 0)
        @foreach ($jobs as $job)
        <div class="job_row job_{{$job->id}}">

            <div class="job_heading p10">
                <h3 class=" job_title"><a>{{$job->title}}</a></h3>
                <div class="job_location">
                    <span>Location : </span>
                    {{($job->GeoCity)?($job->GeoCity->city_title):''}},  {{($job->GeoState)?($job->GeoState->state_title):''}}, {{($job->GeoCountry)?($job->GeoCountry->country_title):''}}
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

            <div class="job_footer p10">
                <div class="w_25p">
                    <div class="j_label bold">Expire on</div>
                    <div class="j_value">{{ ($job->expiration)?($job->expiration->format('yy-m-d')):''}}</div>
                </div>

                <div class="w_25p">

                   <a href="{{route('empJobApplications',['id' => $job->id])}}">

                    <button type="button" class="ApplicationCountButton">
                    <div class="j_label bold">Applications</div>
                    <div class="j_value" style="font-weight:700;"><u>{{($job->applicationCount)?($job->applicationCount->aggregate):0}}<u/></div></button></a>

                </div>

                <div class="w50 fl_right">
                    <div class="j_button dinline_block fl_right m5"><a class="jobDetailBtn graybtn jbtn " href="{{route('jobDetail',['id' => $job->id])}}">Detail</a></div>
                    <div class="j_button dinline_block fl_right m5"><a class="graybtn jbtn" href="{{route('employerJobEdit',['id' => $job->id])}}">Edit</a></div>
                    <div class="j_button dinline_block fl_right m5"><a class="myJobDeleteBtn graybtn jbtn"  data-jobid="{{$job->id}}">Delete</a></div>
                </div>
            </div>


        </div>
        @endforeach
            @else
                <h3>You have not posted any job yet</h3>
        @endif

    </div>

<div class="cl"></div>
</div>

<div style="display:none;">
    <div id="confirmJobDeleteModal" class="modal p0 confirmJobDeleteModal wauto">
        <div class="pp_info_start pp_alert pp_confirm pp_cont" style="left: 0px; top: 0px; margin: 0;">
            <div class="cont">
                <div class="title">Delete Job?</div>
                <div class="img_chat">
                    <div class="icon">
                        <img src="{{asset('/images/site/icons/icon_pp_sure.png')}}" height="48" alt="">
                    </div>
                    <div class="msg">This action can not be undone. Are you sure you wish to continue?</div>
                </div>
                <div class="double_btn">
                    <button class="confirm_close btn small dgrey" onclick="UProfile.cancelGalleryConfirm(); return false;">Cancel</button>
                    <button class="confirm_jobDelete_ok btn small marsh">OK</button>
                    <input type="hidden" name="deleteConfirmJobId" id="deleteConfirmJobId" value=""/>
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
{{-- <link rel="stylesheet" href="{{ asset('css/site/gallery_popup/magnific-popup.css') }}"> --}}
{{-- <link rel="stylesheet" href="{{ asset('css/site/gallery_popup/lc_lightbox.css') }}"> --}}


@stop

@section('custom_js')
<script src="{{ asset('js/site/jquery.modal.min.js') }}"></script>
<script src="{{ asset('js/site/jquery-ui.js') }}"></script>
<script src="{{ asset('js/site/common.js') }}"></script>
{{-- <script src="{{ asset('js/site/profile_photo.js') }}"></script>  --}}
{{-- <script src="{{ asset('js/site/gallery_popup/jquery.magnific-popup.js') }}"></script>  --}}
{{-- <script src="{{ asset('js/site/gallery_popup/lc_lightbox.lite.js') }}"></script> --}}

<script type="text/javascript">
$(document).ready(function() {

    console.log(' new job doc ready ');
    $(".datepicker").datepicker({ dateFormat: "yy-mm-dd" });

    $('.myJobDeleteBtn').on('click',function(){
        var job_id = $(this).attr('data-jobid');
        console.log(' confirmJobAppRemoval click  job_id ', job_id, $(this) );
        $('#confirmJobDeleteModal').modal({
            fadeDuration: 200,
            fadeDelay: 2.5,
            escapeClose: false,
            clickClose: false,
        });
        $('#deleteConfirmJobId').val(job_id);
    });

    $(document).on('click','.confirm_jobDelete_ok',function(){
        $('.confirmJobDeleteModal  .img_chat').html(getLoader('jobDeleteloader'));
        $(this).prop('disabled',true);
        var job_id =  $('#deleteConfirmJobId').val();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/deleteJob/'+job_id,
            success: function(data){
                if( data.status == 1 ){
                    $('.confirmJobDeleteModal .img_chat').html(data.message);
                    $('.job_row.job_'+job_id).remove();
                }else{
                    $('.confirmJobDeleteModal .img_chat').html(data.error);
                }
            }
        });
    });


});
</script>
@stop

