
@extends('mobile.user.usermaster')
@section('content')



<h6 class="h6 jobAppH6">Employer Detail Page</h6>

    {{-- @if ($employers->count() > 0) --}}
    {{-- @foreach ($employers as $jobs) --}}

    {{-- @dump($empquestion) --}}

    <div class="card border-info mb-3 shadow mb-3 bg-white rounded job_row jobApp_{{-- {{$application->id}} --}}">


        <div class="card">

            <div class="card-header jobInfoFont jobAppHeader p-2">Company :
                <span class="jobInfoFont">{{$employer->company}}</span>
                
                <div class="row p-0 m-0">
                        <span class="jobInfoFont">Location : </span>
                    <div class="jobDetail ml-1 mt-1">{{$employer->city}},  {{$employer->state}}, {{$employer->country}}</div>
                </div>
            </div>


            {{-- ============================================ Card Body ============================================ --}}

            <div class="card-body jobAppBody pt-2">

                <div class="row jobInfo">

                    <div class="col-4 p-0">
                        @php
                        $profile_image  = asset('images/site/icons/nophoto.jpg');
                        $profile_image_gallery    = $employer->profileImage()->first();
                        // dump($profile_image_gallery);
                            if ($profile_image_gallery) {
                                // $profile_image   = assetGallery($profile_image_gallery->access,$js->id,'',$profile_image_gallery->image);
                                $profile_image   = assetGallery2($profile_image_gallery,'small');
                                            // dump($profile_image);
                            }
                        @endphp
                        <img class="js_photo w100" id="pic_main_img" src="{{$profile_image}}">
                    </div>

                    <div class="col p-0 pl-3">

                        <div class="jobInfoFont">Interested In</div>
                        <div>
                        {{$employer->interested_in}}
                        </div>

                        

                    </div>

                </div>

                <div class="row p-0">
                    <div class="card-title col p-0 mt-2 mb-0 jobInfoFont">About Us</div>
                </div>
                <p class="card-text jobDetail row mb-1">{{$employer->about_me}}</p>

 {{--
                <div class="row p-0">
                    <div class="card-title col p-0 mt-2 mb-0 jobInfoFont">Questions</div>
                </div>
                @php
                        $userQuestions = !empty($user->questions)?(json_decode($user->questions, true)):(array());
                @endphp

                @if(!empty($empquestion))
                        @foreach($empquestion as $qk => $question)
                            <div>
                              <p class="card-text jobDetail row mb-1">{{$question}} </p>
                               <p class="card-text jobDetail row mb-1 font-weight-bold">{{$userQuestions[$qk]}}</p>
                            </div>
                        @endforeach
                @endif --}}

            </div>

{{-- ============================================ Card Body end ============================================ --}}


{{-- ============================================ Card Footer ============================================ --}}

            <div class="card-footer text-muted jobAppFooter p-1">

                    <div class="float-right">


                        <a class="blockEmployerButton btn btn-sm btn-primary mr-0 btn-xs" data-jsid="{{$employer->id}}">Block</a>
                        {{-- <a class="likeEmployerButton btn btn-sm btn-primary mr-0 btn-xs" data-jsid="{{$employer->id}}">Like</a> --}}

                        @if (in_array($employer->id,$likeUsers))

                        <a class="btn btn-sm btn-danger mr-0 btn-xs unlikeEmpButton" data-jsid="{{$employer->id}}" data-toggle="modal" data-target="#unlikeEmpModal">UnLike</a>


                    @else
                    <a class="likeEmployerButton btn btn-sm btn-primary mr-0 btn-xs" data-jsid ="{{$employer->id}}">Like</a>

                    @endif




                    </div>
            </div>

{{-- ============================================ Card Footer end ============================================ --}}

        </div>

    </div>






<ul class="nav nav-tabs md-tabs" id="myTabMD" role="tablist" style="background: #254c8e">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab-md" data-toggle="tab" href="#home-md" role="tab" aria-controls="home-md"
      aria-selected="true">Jobs</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab-md" data-toggle="tab" href="#profile-md" role="tab" aria-controls="profile-md"
      aria-selected="false">Albums</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="contact-tab-md" data-toggle="tab" href="#contact-md" role="tab" aria-controls="contact-md"
      aria-selected="false">Questions</a>
  </li>
</ul>
<div class="tab-content card pt-5 mb-3" id="myTabContentMD">
  <div class="tab-pane fade show active" id="home-md" role="tabpanel" aria-labelledby="home-tab-md">


{{-- ================================================================================================= --}}
        {{-- @if(isset($jobs)) --}}
@if ($jobs->count() > 0)
@foreach ($jobs as $job)


@php
// dd($user->qualification);
$industry_experienceData =  json_decode($job->experience);
// ?(getIndustriesData($user->industry_experience)):(array());
// dd( $industry_experienceData);

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
{{-- @include('mobile.modals.jobsModal')          mobile/modals/jobsModal       --}}

{{-- @dump( $job->questions ) --}}
{{-- @dump($job->jobEmployer->name) --}}

    <div class="card border-info mb-3 shadow mb-3 bg-white rounded job_row jobApp_{{-- {{$application->id}} --}}">

        <div class="card text-dark">
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
                             {{$job->city}},  {{$job->state}}, {{$job->country}}</div>
                    </div>
                </div>

                    <div class="row p-0 m-0">
                        <span class="jobInfoFont">Employer : </span>
                            <span class="jobDetail" style="margin: 0.2rem 0 0 0.2rem;"> {{ $job->jobEmployer->company}}</span>
                    </div>

            </div>

            <div class="card-body jobAppBody pt-2">

                <div class="row jobInfo">

                    <div class="col-4 p-0 mr-3">

                        <div class="companyLogo">
                            @php
                                $user_gallery  =  $job->jobEmployerLogo;
                                $profile_image =  !empty($user_gallery)?(assetGallery2($user_gallery,'small')):(asset('images/site/icons/nophoto.jpg'));
                            @endphp
                            <img class="photo" id="pic_main_img" src="{{$profile_image}}" title="">
                        </div>


                    </div>

                    <div class="col p-0 pl-3">

                        <div class="jobInfoFont float-left mr-1">Job Salary: </div>
                            <div class="jobDetail" style="margin: 0.2rem 0 0 0.2rem; "> {{$job->salary}}</div>
                        <div class="mt-2">
                            <span class="jobInfoFont">Job Experience</span>
                        </div>
                        <div>
                            @if(!empty($industry_experienceData))
                            @foreach($industry_experienceData as  $industry )
                                <div class="IndustrySelect">
                                      <input type="hidden" name="industry_experience[]" class="industry_experience" value="{{$industry}}">
                                      <p>
                                        <i class="fas fa-angle-right qualifiCationBullet"></i>
                                          {{getIndustryName($industry)}}

                                </div>
                            @endforeach
                        @endif
                        </div>

                    </div>

                </div>

                <div class="row p-0 mt-2">
                    <div class="card-title col p-0 mb-0 jobInfoFont">Job Detail</div>
                </div>
                <p class="card-text jobDetail row">{{$job->description}}</p>

            </div>

            <div class="card-footer text-muted jobAppFooter">
                <div class="row jobInfo jobFooter ">
                    <div class="col p-0"><span>Expire on</span><br>
                        {{ ($job->expiration)?($job->expiration->format('yy-m-d')):''}}
                    </div>
                    <div class="col p-0"> <button class="applicationsCount btn btn-sm btn-primary">Applications
                        ({{($job->applicationCount)?($job->applicationCount->aggregate):0}})
                    </button>

                    </div>

                    <div class="p-0 float-right mr-2"><span>Job Type</span><br>
                        {{$jobType}}
                    </div>

                </div>
                <div class="card-footer row p-0 mt-3">
                    <div class="col p-0">
                        <a class="jobDetailBtn graybtn jbtn m5 btn btn-sm btn-primary ml-0 btn-xs" href="{{route('MjobDetail', ['id' => $job->id]) }}">Detail</a>
                    </div>
                    <div class="float-right">
                        <a class="jobApplyBtn graybtn jbtn btn btn-sm btn-primary mr-0 btn-xs" job-id ="{{$job->id}}" job-title="{{$job->title}}">Apply</a>
                    </div>

                </div>

            </div>

        </div>

    </div>




@endforeach
{{-- <div class="jobs_pagination cpagination">{!! $jobs->render() !!}</div> --}}
{{-- @endif --}}
@else
    <h5 class="text-dark"> This Employer has not posted any job yet.</h5>
@endif
{{-- ================================================================================================= --}}

  </div>
  <div class="tab-pane fade" id="profile-md" role="tabpanel" aria-labelledby="profile-tab-md">

{{-- ================================================================================================= --}}



    <div class="tabs_photos text-dark mb-2 font-weight-bold">Photos</div>
        <div class="list_photos_public d-flex">
            <div class="list_photos_trans">
                @if ($galleries)
                @foreach ($galleries as $gallery)
                    <div id="{{$gallery->id}}" class="float-left mt-1 item profile_photo_frame gallery_{{$gallery->id}} {{($gallery->access == 2)?'private':'public'}}">
                        <a  data-id="{{$gallery->id}}" class="show_photo_gallery js-smartPhoto2" data-group="no-gravity"
                            href="{{assetGallery2($gallery,'')}}"
                            data-lcl-thumb="{{assetGallery($gallery->access,$user->id,'',$gallery->image)}}"
                            >
                            <img data-photo-id="{{$gallery->id}}"  id="photo_{{$gallery->id}}"   class="photo m-1 uploadedPhotos"
                            data-src="{{assetGallery($gallery->access,$user->id,'',$gallery->image)}}"
                            src="{{assetGallery2($gallery,'small')}}">
                        </a>

                    </div>
                @endforeach
            @endif
            </div>
        </div>
  {{-- =================================================================== Photos end =================================================================== --}}



      {{-- =================================================================== videos =================================================================== --}}

    <div class="video text-dark mt-3">

            <div class="row">

                <!-- Grid column -->
            <div class="col-lg-4 col-md-4 mb-4">

            <div class="videos">
                        @if ($videos->count() > 0 )
                        @foreach ($videos as $video)
                            <div id="v_{{$video->id}}" class="video_box mb-2">
                                <!-- Grid row -->


                      <!--Modal: Name-->
                      <div class="modal fade" id="modal{{$video->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                          <!--Content-->
                          <div class="modal-content">
                            <!--Body-->
                            <div class="modal-body mb-0 p-0">
                              <div class="embed-responsive embed-responsive-16by9 z-depth-1-half videoBox">
                                  <video id="player" playsinline controls data-poster="https://mdbootstrap.com/img/screens/yt/screen-video-1.jpg">
                                    <source src="{{assetVideo($video)}}" type="video/mp4" />
                                  </video>
                              </div>
                            </div>
                            <!--Footer-->
                            <div class="modal-footer justify-content-center">
                              <button type="button" class="btn btn-outline-primary btn-rounded btn-md ml-4" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                          <!--/.Content-->
                        </div>
                      </div>

                      <!--Modal: Name-->
                      <a>{!! generateVideoThumbsm($video) !!}</a>
                            </div>
                        @endforeach
                    @endif
            </div>

          </div>
        </div>
    </div>

{{-- ================================================================================================== --}}

  </div>
  <div class="tab-pane fade" id="contact-md" role="tabpanel" aria-labelledby="contact-tab-md">


    <p class="loader SaveQuestionsLoader"style="float: left;"></p>
        <div class="cl"></div>
            <div class="questionsOfUser text-dark">

                @php
                    $userQuestions = !empty($user->questions)?(json_decode($user->questions, true)):(array());
                @endphp
                  @if(!empty($empquestion))
                      @foreach($empquestion as $qk => $question)
                        <div>
                          <p class="m-0">{{$question}} </p>
                           <p class="QuestionsKeyPTag my-1">
                                <b>
                                    @if ($userQuestions[$qk] == 'yes')
                                        Yes
                                        @else
                                        No
                                    @endif
                                    {{-- {{$userQuestions[$qk]}} --}}
                                </b>
                            </p>
                        </div>
                      @endforeach
                  @endif
            </div>
  </div>
</div>
@stop


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('js/mobile/likeUnlikeBlockUnblockEmp.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/mobile/userProfile.js') }}"></script>
<link rel="stylesheet" href="https://unpkg.com/smartphoto@1.1.0/css/smartphoto.min.css">
<script src="https://unpkg.com/smartphoto@1.1.0/js/smartphoto.js"></script>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
{{-- <script type="text/javascript" src="{{ asset('js/mobile/likeUnlikeBlockUnblockJS.js') }}"></script>  --}}
<script src="{{ asset('js/site/plyr.polyfilled.js') }}"></script>
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

  });





  document.addEventListener('DOMContentLoaded',function(){

new SmartPhoto(".js-smartPhoto2",{
        useOrientationApi: false
});
});





  // jobApplyBtn click end
</script>

<script>
    @if ($videos->count() > 0 )
    @foreach ($videos as $video)

    $('#modal{{$video->id}}').on('hidden.bs.modal', function (e) {
  // do something...
        var src = $(this).find(".videoBox video").find("source").attr('src');
        $(this).find(".videoBox video").find("source").attr('src');
        var videoElem  = '<video id="player" controls>';
        videoElem     += '<source src="'+src+'" type="video/mp4">';
        videoElem     += '</video>';
        $(this).find(".videoBox video").remove();
        $(this).find(".videoBox").html(videoElem);
    });
    @endforeach
    @endif

</script>
<style type="text/css">

.tabs_profile .tab_photos .item {
    position: relative;
    overflow: hidden;
    width: 126px;
    height: 140px;
    margin: 0 26px 25px 0;
    transition: 0.5s ease;
    float: left;
    width: auto;
    height: auto;
    float: none;
    display: inline-block;
    box-shadow: 0 2px 4px -1px rgba(0,0,0,.2), 0 4px 5px 0 rgba(0,0,0,.14), 0 1px 10px 0 rgba(0,0,0,.12);
    border-radius: 4px;
}
div#home-just {
    /*display: grid;*/
}
.uploadedPhotos {
    vertical-align: middle;
    /* overflow: visible; */
    object-fit: cover;
    height: 119px;
    width: 120px;
}
.questionsOfUser{
    font-size: 12px;
}

</style>
