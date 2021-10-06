@extends('site.employer.employermaster')

@section('custom_css')
{{-- <link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}"> --}}
{{-- <link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}"> --}}
@stop

@section('content')
{{-- <div class="newJobCont">
    <div class="head icon_head_browse_matches">Job Detail Page</div>
    <div class="jobDetail">
        @if ($job)
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
            @endphp --}}
            {{-- @dd($job) --}}
{{-- 
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
                    <div class="w_70p dinline_block fl_left j_value">@if(!empty($experience))
                        @foreach($experience as $industry )
                            <div class="IndustrySelect">

                                  <p>
                                    <i class="fas fa-angle-right qualifiCationBullet"></i>
                                      {{getIndustryName($industry)}}
                                      <i class="fa fa-trash removeIndustry hide_it"></i></p>
                            </div>
                        @endforeach
                    @endif</div>
                </div>

                <div class="jobDetail_field">
                    <div class="w_30p dinline_block fl_left j_label bold">Job Salary</div>
                    <div class="w_70p dinline_block fl_left j_value">{{$job->salary}}</div>
                </div>

                <div class="jobDetail_field">
                    <div class="w_30p dinline_block fl_left j_label bold">Job Type</div>
                    <div class="w_70p dinline_block fl_left j_value">{{$jobType}}</div>
                </div> --}}

                {{-- <div class="jobDetail_field">
                    <div class="w_30p dinline_block fl_left j_label bold">Job Category</div>
                    <div class="w_70p dinline_block fl_left j_value">Web & E-commerce Job</div>
                </div> --}}
{{-- 
                <div class="jobDetail_field">
                    <div class="w_30p dinline_block fl_left j_label bold">Expire on</div>
                    <div class="w_70p dinline_block fl_left j_value">{{ ($job->expiration)?($job->expiration->format('yy-m-d')):''}}</div>
                </div>



            </div>

            <div class="job_detail p10">
                <div class="j_label bold">Job Detail</div>
                <div>{{$job->description}}</div>
            </div>
            @php
            $user = Auth::user();
            @endphp
            <div class="job_footer p10">
                @if(!isEmployer($user))
                <div class="w_25p fl_right">
                    <div class="j_button fl_right"><a class="jobApplyBtn graybtn jbtn" data-jobid="{{$job->id}}">Apply</a></div>
                </div>
                @endif


            </div>
        </div>
        @endif
    </div>
    <div class="cl"></div>
</div>


<div style="display: none;">
<div id="jobApplyModal" class="modal p0 jobApplyModal wauto ">
    <div id="job_apply_modal" class="w100 pp_edit_info pp_cont m0">
        <div class="frame"> --}}

            {{-- <a class="icon_close" href="#close"><span class="close_hover"></span></a> --}}

{{--             <div class="head m0">Submit Proposal</div>
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
</div> --}}

<section class="row">
                <div class="col-md-12">
                  <div class="profile profile-section">
                    <h2>Job Detail Page</h2>
                     <div class="row">
                         @if ($job)
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
                            <p class="text-light"><b>Location:</b> {{$job->city}},  {{$job->state}}, {{$job->country}}</p>                         
                          </div>
                          <div class="row Block-user-wrapper">
                            <div class="col-md-4 user-images">
                              <div class="block-user-img ">
                                @php
                                    $user_gallery  =  $job->jobEmployerLogo;
                                    $profile_image =  !empty($user_gallery)?(assetGallery2($user_gallery,'small')):(asset('images/site/icons/nophoto.jpg'));
                                @endphp
                                <img src="{{$profile_image}}" alt="">
                              </div>
                              <div class="block-user-progress ">
                                <h6>{{ $job->jobEmployer->name.' '.$job->jobEmployer->surname }}</h6>
                               <div class="progress-img"> <img src="assests/images/user-progressbar.svg" alt=""></div>
                              </div>
                            </div>
                            <div class="col-md-8 user-details">
                              <div class="row blocked-user-about">
                                <h6>Job Type:</h6>
                                <p class="pl-3">{{$jobType}}</p>
                              </div>
                              <div class="row blocked-user-about">
                                <h6>Job Sallary:</h6>
                                <p class="pl-3">{{$job->salary}}</p>
                              </div>
                              <div class="row blocked-user-about">
                                <h6>Job Experience:</h6>
                                @if(!empty($experience))
                                    @foreach($experience as $industry )
                                        <div class="IndustrySelect">
                                             <p class="pl-3">
                                                <i class="fas fa-angle-right qualifiCationBullet"></i>
                                                  {{getIndustryName($industry)}}
                                                  <i class="fa fa-trash removeIndustry hide_it"></i>
                                              </p>
                                        </div>
                                    @endforeach
                                 @endif
                              </div>
                              <div class="row blocked-user-about">
                                <h6>Expired On:</h6>
                                <p class="pl-3">{{ ($job->expiration)?($job->expiration->format('yy-m-d')):''}}</p>
                              </div>
                              <div class="row blocked-user-experience">
                                <h6>Job Detail:</h6>
                               <p class="pl-3">{{$job->description}}</p>
                              </div>
            
                            </div>
                          </div>
                           @php
                            $user = Auth::user();
                            @endphp
                          <div class="box-footer unlike-btn-group clearfix">
                            {{-- <div class="block-progrees-ratio d-none d-md-block user-page-footer"> --}}
                                  @if ($job->code)
                                     <span class="position-absolute mt-3 ml-2"><strong>Code:</strong> {{$job->code}}</span>
                                 @endif
                            {{-- </div> --}}
                             @if(!isEmployer($user))
                            <button class="unlike-btn mb-2" data-toggle="modal" data-target="#myModal9"> Apply</button> 
                               @endif                    
                          </div>
                       </div>
                     </div> 
                      @endif
                  </div>
                </div>
              </section>
               <!-- =====================Apply button modal================================ -->
          <div class="modal fade" id="myModal9" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog Apply-modal " role="document">
              <div class="modal-content ">
                <div class="modal-header Apply-modal-header">
                  <div class="m-header  ">
                    <h4 class="modal-title Apply-modal-title " id="myModalLabel">
                      Submit Proposal
                    </h4>
                    <i data-dismiss="modal" aria-label="Close" class="close-box fa fa-times"></i>
                  </div>
                 

                </div>
                <div class="modal-body ">
                  <div class="m-inner-main">
                    <div class="loc-m-row">
                      <div class="row Apply-modal-body">
                        <h4 class="first-heading">1 day contract - Market Stall Assistant</h4>
                        <p>Almost done , few questions before your resume is accepted for this job</p>
                        <form action="">
                          <div class="col-md-12 Apply-job-modal-form">
                            <label for="">Are you available all day August 15th, and can you make it to the Brisbane CBD
                              for 8 hours?</label>
                            <ul class="question-radiobtn">
                              <li>
                                <div class="form-check emp-redio">
                                  <input type="radio" id="test1" name="radio-group1" checked>
                                  <label for="test1"> Yes to both</label>
                                </div>

                              </li>

                              <li>
                                <div class="form-check emp-redio">
                                  <input type="radio" id="test2" name="radio-group1">
                                  <label for="test2">No to both</label>
                                </div>
                              </li>
                              <li>
                                <div class="form-check emp-redio">
                                  <input type="radio" id="test3" name="radio-group1">
                                  <label for="test3">Yes on the 15th, but need a lift to the CBD</label>
                                </div>
                              </li>
                            </ul>
                          </div>
                          <div class="col-md-12 Apply-job-modal-form">
                            <label for="">Are you physically fit and able to move heavy equipment and stock?</label>
                            <ul class="question-radiobtn">
                              <li>
                                <div class="form-check emp-redio">
                                  <input type="radio" id="test4" name="radio-group2" checked>
                                  <label for="test4">Yes</label>
                                </div>

                              </li>

                              <li>
                                <div class="form-check emp-redio">
                                  <input type="radio" id="test5" name="radio-group2">
                                  <label for="test5">No</label>
                                </div>
                              </li>
                              <li>
                                <div class="form-check emp-redio">
                                  <input type="radio" id="test6" name="radio-group2">
                                  <label for="test6">Up to 20 kilos max</label>
                                </div>
                              </li>
                            </ul>
                          </div>
                          <div class="col-md-12 Apply-job-modal-form">
                            <label for="">Do you consent to just 1 day contract?</label>
                            <ul class="question-radiobtn">
                              <li>
                                <div class="form-check emp-redio3">
                                  <input type="radio" id="test7" name="radio-group3" checked>
                                  <label for="test7">Yes</label>
                                </div>

                              </li>

                              <li>
                                <div class="form-check emp-redio3">
                                  <input type="radio" id="test8" name="radio-group3">
                                  <label for="test8">No</label>
                                </div>
                              </li>
                            </ul>
                          </div>
                          <div class="col-md-12 Apply-job-modal-form">
                            <label for="">What motivated you to apply for this job and why do think you will be
                              suitable?</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                              placeholder="Maximum 300 Characters"></textarea>
                          </div>
                          <div class="col-md-12 Apply-job-modal-form">
                            <label for="">This job requires you to complete a mandatory online test, in order to be
                              considered for the job. Do you agree to continue ?</label>
                            <ul class="question-radiobtn">
                              <li>
                                <div class="form-check emp-redio3">
                                  <input type="radio" id="test9" name="radio-group4" checked>
                                  <label for="test9">Yes</label>
                                </div>

                              </li>

                              <li>
                                <div class="form-check emp-redio3">
                                  <input type="radio" id="test10" name="radio-group4">
                                  <label for="test10">No</label>
                                </div>
                              </li>
                            </ul>

                          </div>
                          <div class="col-md-12 Apply-job-modal-form">
                            <label for="">We can see you’ve completed this same online test previously. Would you like
                              to use your previous results, or would you like to complete the test again?</label>
                            <ul class="question-radiobtn">
                              <li>
                                <div class="form-check emp-redio3">
                                  <input type="radio" id="test11" name="radio-group5" checked>
                                  <label for="test11">Redo Test</label>
                                </div>

                              </li>

                              <li>
                                <div class="form-check emp-redio3">
                                  <input type="radio" id="test12" name="radio-group5">
                                  <label for="test12">Use Previous Result</label>
                                </div>
                              </li>
                            </ul>

                          </div>
                          <div class="col-md-12 bj-tr-btn">
                            <button class="interview-tag used-tag" type="submit"><i class="fas fa-paper-plane"></i>Submit</button>
                          </div>
                        </form>
                      </div>
                    </div>


                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- =====================Apply button modal ends============================= -->
@stop

@section('custom_footer_css')
<link rel="stylesheet" href="{{ asset('css/site/profile.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}"> --}}

@stop

@section('custom_js')
<script src="{{ asset('js/site/jquery.modal.min.js') }}"></script>
<script src="{{ asset('js/site/jquery-ui.js') }}"></script>
<script src="{{ asset('js/site/common.js') }}"></script>

@stop



 