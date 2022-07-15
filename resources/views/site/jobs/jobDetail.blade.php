@extends('site.employer.employermaster')

@section('custom_css')
{{-- <link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}"> --}}
{{-- <link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}"> --}}
@stop

@section('content')


<section class="row">
    <div class="col-md-12">
    <div class="profile profile-section">
        <div class="row px-3 px-md-0">
            <h2 class="col-6">Job Detail Page</h2>
            <div class="col-5 col-lg-6"> <a href="{{ route('jobs') }}" class="float-right"> <button class="orange_btn"> Return To Jobs</button> </a> </div>
        </div>
        <div class="row">
            @if ($job)
            <div class="col-sm-12 col-md-12">
                @php
                $experience = json_decode($job->experience);
                $jobType = '';
                if($job->type == 'Contract'){
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
                        <p class="text-light m-0"><b>Location:</b> {{$job->city}},  {{$job->state}}, {{$job->country}}</p>
                    </div>
                    <div class="row Block-user-wrapper">
                        <div class="col-md-2 user-images">
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
                        <div class="col-md-10 user-details">
                            <div class="row blocked-user-about mt-2">
                                <h6 class="p-0">Job Type:</h6>
                                <p class="">{{$jobType}}</p>
                            </div>
                            <div class="row blocked-user-about mt-2">
                                <h6 class="p-0">Salary Range:</h6>
                                <p class="">{{$job->salary}}</p>
                            </div>
                            <div class="row blocked-user-about mt-2">
                                <h6 class="p-0">Industry:</h6>
                                @if(!empty($experience))
                                @foreach($experience as $industry )
                                <div class="IndustrySelect">
                                    <p class="">
                                        <i class="fas fa-angle-right qualifiCationBullet"></i>
                                        {{getIndustryName($industry)}}
                                        <i class="fa fa-trash removeIndustry hide_it"></i>
                                    </p>
                                </div>
                                @endforeach
                                @endif
                            </div>
                            <div class="row blocked-user-about mt-2">
                                <h6 class="p-0">Expires On:</h6>
                                <p class="">{{ ($job->expiration)?($job->expiration->format('d-m-Y')):''}}</p>
                            </div>
                            <div class="row blocked-user-experience mt-2">
                                <h6 class="p-0">Job Detail:</h6>
                                @php 
                                $remSpecialCharQues = str_replace("\&#39;","'",$job->description);
                                @endphp
                                <p class="">{{$remSpecialCharQues}}</p>
                            </div>
                        </div>
                    </div>
                    @php
                    $user = Auth::user();
                    @endphp
                    <div class="box-footer unlike-btn-group clearfix py-0 py-md-4">
                        @if ($job->code)
                        <span class="px-2 px-md-3"><strong>Code:</strong> {{$job->code}}</span>
                        @endif
                        @if(!isEmployer($user))
                        <button class="unlike-btn mb-2" data-toggle="modal" data-target="#jobApplyModal" onclick="jobApplyFunction({{ $job->id }})"> Apply</button> 
                        @endif                    
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>


<!-- =====================Apply button modal================================ -->
<div class="modal fade" id="jobApplyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
        <div class="jobData"></div>
      </div>
    </div>
  </div>
</div>
<!-- =====================Apply button modal ends============================= -->


@stop

@section('custom_footer_css')
<link rel="stylesheet" href="{{ asset('css/site/profile.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}"> --}}
<style>
    @media only screen and (max-width: 479px){
      .sidebaricontoggle {
         top: 5rem !important;
      }
   }
   @media only screen and (min-width: 480px) and (max-width: 991px){
      .sidebaricontoggle {
         top: 6rem !important;
      }
   }
</style>
@stop

@section('custom_js')
<script src="{{ asset('js/site/jquery.modal.min.js') }}"></script>
<script src="{{ asset('js/site/jquery-ui.js') }}"></script>
<script src="{{ asset('js/site/common.js') }}"></script>

@stop



 