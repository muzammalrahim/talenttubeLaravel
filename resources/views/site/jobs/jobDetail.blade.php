@extends('site.employer.employermaster')

@section('custom_css')
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
@stop

@section('content')
<div class="newJobCont">
    <div class="head icon_head_browse_matches">Job Detail Page</div>
    <div class="jobDetail">
        @if ($job)
        <div class="job_row">
            
            {{-- @dd($job) --}}

            <div class="job_heading p10">
                <h3 class="job_title"><a>{{$job->title}}</a></h3>
                @if ($job->code)
                     <div class="job_code">Code: {{$job->code}}</div>
                @endif
                <div class="job_employer">Employer: {{ $job->jobEmployer->name.' '.$job->jobEmployer->surname }}</div>

                <div class="job_location">
                    <span>Location : </span>{{($job->GeoCity)?($job->GeoCity->city_title):''}},  {{($job->GeoState)?($job->GeoState->state_title):''}}, {{($job->GeoCountry)?($job->GeoCountry->country_title):''}}
                </div>
            </div>

            <div class="job_info row p10 dblock">
                
                <div class="w_25p companyLogo">
                    @php 
                        $user_gallery  =  $job->jobEmployerLogo;   
                        $profile_image =  !empty($user_gallery)?(assetGallery2($user_gallery,'small')):(asset('images/site/icons/nophoto.jpg'));
                    @endphp
                    <img class="photo" id="pic_main_img" src="{{$profile_image}}" title="">
                </div>

                
                <div class="jobDetail_field">
                    <div class="w_30p dinline_block fl_left j_label bold">Job Experience</div>
                    <div class="w_70p dinline_block fl_left j_value">{{$job->experience}}</div>
                </div>

                <div class="jobDetail_field">
                    <div class="w_30p dinline_block fl_left j_label bold">Job Salary</div>
                    <div class="w_70p dinline_block fl_left j_value">{{$job->salary}}</div>
                </div>
                
                <div class="jobDetail_field">
                    <div class="w_30p dinline_block fl_left j_label bold">Job Type</div>
                    <div class="w_70p dinline_block fl_left j_value">{{$job->type}}</div>
                </div>

                {{-- <div class="jobDetail_field">
                    <div class="w_30p dinline_block fl_left j_label bold">Job Category</div>
                    <div class="w_70p dinline_block fl_left j_value">Web & E-commerce Job</div>
                </div> --}}

                <div class="jobDetail_field">
                    <div class="w_30p dinline_block fl_left j_label bold">Expire on</div>
                    <div class="w_70p dinline_block fl_left j_value">{{ ($job->expiration)?($job->expiration->format('yy-m-d')):''}}</div>
                </div>

                
                
            </div>

            <div class="job_detail p10">
                <div class="j_label bold">Job Detail</div>
                <div>{{$job->description}}</div>
            </div>

            <div class="job_footer p10">
                 
                <div class="w_25p fl_right">
                    <div class="j_button fl_right"><a class="jobApplyBtn graybtn jbtn" data-jobid="{{$job->id}}">Apply</a></div>
                </div>

                 

            </div>
        </div>
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

@stop

@section('custom_js')
<script src="{{ asset('js/site/jquery.modal.min.js') }}"></script>
<script src="{{ asset('js/site/jquery-ui.js') }}"></script>
<script src="{{ asset('js/site/common.js') }}"></script>

@stop

