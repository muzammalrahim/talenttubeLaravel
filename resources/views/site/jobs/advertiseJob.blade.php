@extends('site.employer.employermaster')

@section('custom_css')
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
@stop

@section('content')
{{-- <div class="newJobCont">
    <div class="head icon_head_browse_matches">Advertise Job</div>
    <div class="jobDetail">
        @if ($job && $user->id == $job->user_id)
        <div class="job_row">
            @php
            $experience = json_decode($job->experience);
            $jobType = '';
            if($job->type == 'Contract')
            {
                $jobType = 'Contract';
            }
            elseif ($job->type == 'temporary') {
                $jobType = 'Temporary';
            }
            elseif ($job->type == 'casual') {
                $jobType = 'casual';
            }
            elseif ($job->type == 'full_time') {
                $jobType = 'Full time';
            }
            elseif ($job->type == 'part_time') {
                $jobType = 'Part time';
            }
            @endphp
            <div class="job_heading p10">
                <h3 class="job_title"><a>{{$job->title}}</a></h3>
                @if ($job->code)
                     <div class="job_code">Code: {{$job->code}}</div>
                @endif
                <div class="job_employer">Employer: {{ $job->jobEmployer->name.' '.$job->jobEmployer->surname }}</div>

                <div class="job_location">
                    <div class="js_location">Location: {{$job->city}},  {{$job->state}}, {{$job->country}} </div>
                </div>
            </div>

            <div class="job_info row p10 dflex">
                <div class="w_25p companyLogo">
                    @php
                        $user_gallery  =  $job->jobEmployerLogo;
                        $profile_image =  !empty($user_gallery)?(assetGallery2($user_gallery,'small')):(asset('images/site/icons/nophoto.jpg'));
                    @endphp
                    <img class="photo" id="pic_main_img" src="{{$profile_image}}" title="">
                </div>
                <div class="jobDetail w100">
                    <div class="jobDetail_field">
                        <div class="w_30p dinline_block fl_left j_label bold">Job Experience</div>
                        <div class="w_70p dinline_block fl_left j_value">
                            @if(!empty($experience))
                            @foreach($experience as $industry )
                                <div class="IndustrySelect">
                                    <p><i class="fas fa-angle-right qualifiCationBullet"></i> {{getIndustryName($industry)}}
                                        <i class="fa fa-trash removeIndustry hide_it"></i>
                                    </p>
                                </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="jobDetail_field">
                        <div class="w_30p dinline_block fl_left j_label bold">Job Salary</div>
                        <div class="w_70p dinline_block fl_left j_value">{{$job->salary}}</div>
                    </div>
                    <div class="jobDetail_field">
                        <div class="w_30p dinline_block fl_left j_label bold">Job Type</div>
                        <div class="w_70p dinline_block fl_left j_value">{{$jobType}}</div>
                    </div>
                    <div class="jobDetail_field">
                        <div class="w_30p dinline_block fl_left j_label bold">Expire on</div>
                        <div class="w_70p dinline_block fl_left j_value">{{ ($job->expiration)?($job->expiration->format('yy-m-d')):''}}</div>
                    </div>

                    <div class="j_button mt20">
                        <a class="jobApplyBtn graybtn jbtn" target="_blank" data-jobid="{{$job->id}}" href="{{ route('advertiseOnJura' , ['id' => $job->id]) }}" >Advertise on Jura</a>
                    </div>
                    <div class="j_button"></div> 
                </div>
            </div>
        </div>
        @else
        <h3> This job does not belong to you </h3>
        @endif
    </div>
    <div class="cl"></div>
</div> --}}
{{-- html for advertise job  --}}
 <section class="row">
                <div class="col-md-12">
                  <div class="profile profile-section">
                    <h2>Advertise Job</h2>
                     <div class="row">
                         @if ($job && $user->id == $job->user_id)
                       <div class="col-sm-12 col-md-6">
                           @php
                            $experience = json_decode($job->experience);
                            $jobType = '';
                            if($job->type == 'Contract')
                            {
                                $jobType = 'Contract';
                            }
                            elseif ($job->type == 'temporary') {
                                $jobType = 'Temporary';
                            }
                            elseif ($job->type == 'casual') {
                                $jobType = 'casual';
                            }
                            elseif ($job->type == 'full_time') {
                                $jobType = 'Full time';
                            }
                            elseif ($job->type == 'part_time') {
                                $jobType = 'Part time';
                            }
                            @endphp
                        <div class="job-box-info block-box clearfix">
                          <div class="box-head">
                            <h4 class="text-white">{{$job->title}}</h4>                          
                          </div>
                          <div class="row Block-user-wrapper">
                            <div class="col-md-4 user-images">
                                 @php
                                    $user_gallery  =  $job->jobEmployerLogo;
                                    $profile_image =  !empty($user_gallery)?(assetGallery2($user_gallery,'small')):(asset('images/site/icons/nophoto.jpg'));
                                @endphp
                              <div class="block-user-img ">
                                <img src="{{$profile_image}}" alt="">
                              </div>
                              <div class="block-user-progress ">
                                <h6>{{ $job->jobEmployer->name.' '.$job->jobEmployer->surname }}</h6>
                              </div>
                            </div>
                            <div class="col-md-8 user-details">
                              <div class="row blocked-user-about">
                                <h6>Job Experience:</h6>
                                 @if(!empty($experience))
                                 <ul>
                            @foreach($experience as $industry )
                                <div class="IndustrySelect">
                                    <li> {{getIndustryName($industry)}}
                                    </li>
                                </div>
                            @endforeach
                            </ul>
                            @endif
                              </div>
                              <div class="row blocked-user-about">
                                <h6>Job Type:</h6>
                                <p>{{$jobType}}</p>
                              </div>
                              <div class="row blocked-user-about">
                                <h6>Job Sallary:</h6>
                                <p>{{$job->salary}}</p>
                              </div>
                               <div class="row blocked-user-about">
                                <h6>Location:</h6>
                                <p>{{$job->city}},  {{$job->state}}, {{$job->country}}</p>
                              </div>
                              <div class="row blocked-user-experience">
                                <h6>Expire On:</h6>
                               <p>{{ ($job->expiration)?($job->expiration->format('yy-m-d')):''}}</p>
                              </div>
            
                            </div>
                          </div>
                          <div class="box-footer unlike-btn-group clearfix m-auto">
                             @if ($job->code)
                                 <div class="job_code mt-3">Code: {{$job->code}}</div>
                            @endif
                                <a href="{{ route('advertiseOnJura' , ['id' => $job->id]) }}"  target="_blank" data-jobid="{{$job->id}}"><button class="unlike-btn mb-2">Advertise On Jura</button></a>
                         </div>
                       </div>
                     </div> 
                      @else
                        <h3> This job does not belong to you </h3>
                        @endif
                  </div>
                </div>
              </section>
{{-- html for advertise job ends here --}}

<div style="display: none;">
<div id="jobApplyModal" class="modal p0 jobApplyModal wauto ">
    <div id="job_apply_modal" class="w100 pp_edit_info pp_cont m0">
        <div class="frame">
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
{{-- <script src="{{ asset('js/site/common.js') }}"></script> --}}

@stop

