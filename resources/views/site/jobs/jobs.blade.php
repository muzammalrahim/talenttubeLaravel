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
        @dump($jobs)
        <div class="job_row_heading jobs_filter">

        </div>

        @if ($jobs->count() > 0)
        @foreach ($jobs as $job)
        <div class="job_row">

            <div class="job_heading p10">
                <h3 class=" job_title"><a>{{$job->title}}</a></h3>
                <div class="job_location">
                    <span>Location : </span>{{($job->GeoCity)?($job->GeoCity->city_title):''}},  {{($job->GeoState)?($job->GeoState->state_title):''}}, {{($job->GeoCountry)?($job->GeoCountry->country_title):''}}
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
                    <div class="j_label bold">Job Views</div>
                    <div class="j_value">120</div>
                </div>

                <div class="w_25p">
                    <div class="j_label bold">Job Likes</div>
                    <div class="j_value">300</div>
                </div>

                <div class="w_25p">
                    <div class="j_label bold">Application</div>
                    <div class="j_value">10</div>
                </div>


                <div class="w_25p">
                    <div class="j_button"><a class="jobApplyBtn graybtn jbtn" data-jobid="{{$job->id}}">Apply</a></div>
                    {{-- <div class="j_button">Delete</div> --}}
                </div>
            </div>


        </div>
        @endforeach
        @endif

    </div>

<div class="cl"></div>
</div>


<div style="display: none;">
<div id="jobApplyModal" class="modal p0 jobApplyModal wauto ">
    <div id="job_apply_modal" class="w100 pp_edit_info pp_cont m0">
        <div class="frame">
            <a class="icon_close" href="#close"><span class="close_hover"></span></a>
            <div class="head m0">Submit Proposal</div>
            <input type="hidden" value="" name="openModalJobId" id="openModalJobId" />
            <div class="cont">
                <div class="css_loader loader_edit_popup">
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
    console.log(' new job doc ready  ');
    $(".datepicker").datepicker({ dateFormat: "yy-mm-dd" });

    /*$('.saveNewJob').on('click',function(){  console.log(' saveNewJob clck  '); });*/


    // ========== Function to show popup when click on jobApplyBtn ==========//

    $('#jobApplyModal').on($.modal.OPEN, function(event, modal) {
        var job_id = $('#openModalJobId').val();
        console.log(' job_id ', job_id);
        console.log(' after open ', event);
        $.ajax({
        type: 'GET',
            url: base_url+'/ajax/jobApplyInfo/'+job_id,
            success: function(data){
                $('#jobApplyModal .cont').html(data);
            }
        });
    });


    $('.jobApplyBtn').on('click',function(){
        var job_id = $(this).attr('data-jobid');
        $('#openModalJobId').val(job_id);
        $('#jobApplyModal .cont').html(getLoader('css_loader loader_edit_popup'));
        $('#jobApplyModal').modal({
            fadeDuration: 200,
            fadeDelay: 2.5
        });
    });

    //========== jobApplyBtn clck end. ==========


    // ========== Function to submit job application ==========//
    $(document).on('click','.submitApplication',function(){
        event.preventDefault();
        // var job_id = $(this).attr('data-jobid');
        console.log(' submitApplication submit click ');
        $('.submitApplication').html(getLoader('jobSubmitBtn')).prop('disabled',true);

        var applyFormData = $('#job_apply_form').serializeArray()
        $.ajax({
        type: 'POST',
            url: base_url+'/ajax/jobApplySubmit',
            data: applyFormData,
            success: function(data){
                $('.submitApplication').html('Submit').prop('disabled',false);
                console.log(' data ', data );
                if (data.status == 1){
                     $('#job_apply_form').html(data.message);
                }else {
                     $('#job_apply_form').html(data.error);
                }



            }
        });
    });
    //========== jobSubmitApplyBtn clck end. ==========



});
</script>
@stop

