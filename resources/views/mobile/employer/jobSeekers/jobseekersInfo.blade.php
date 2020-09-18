
@extends('mobile.user.usermaster')
@section('content')



<h6 class="h6 jobAppH6">Job Seeker's Detail </h6>

@php
$js = $jobSeeker;
@endphp

<div class="card border-info mb-3 shadow mb-3 bg-white rounded job_row jobApp_{{-- {{$application->id}} --}}">
    <div class="card">
        <div class="card-header jobInfoFont jobAppHeader p-2">Name:
            <span class="jobInfoFont font-weight-normal">{{$js->name}} {{$js->surname}}</span>
                <div class="jobInfoFont">Location:
                <span class="font-weight-normal">{{$js->city}},  {{$js->state}}, {{$js->country}}</span>
                </div>
        </div>
		@php
		$profile_image  = asset('images/site/icons/nophoto.jpg');
		$profile_image_gallery    = $js->profileImage()->first();

		// dump($profile_image_gallery);

			if ($profile_image_gallery) {
						// $profile_image   = assetGallery($profile_image_gallery->access,$js->id,'',$profile_image_gallery->image);

						$profile_image   = assetGallery2($profile_image_gallery,'small');
							// dump($profile_image);
			}
		@endphp

        {{-- ============================================ Card Body ============================================ --}}
        <div class="card-body jobAppBody pt-2">

            <div class="row jobInfo">

                <div class="col-4 p-0">
                    <img class="img-fluid z-depth-1" src="{{$profile_image}}" height="100px" width="150px">

                  {{--   <div class="mt-2">
                        <span class="jobInfoFont">Location:</span>
                        {{($js->GeoCity)?($js->GeoCity->city_title):''}},  {{($js->GeoState)?($js->GeoState->state_title):''}}, {{($js->GeoCountry)?($js->GeoCountry->country_title):''}}
                    </div> --}}
                </div>
                <div class="col p-0 pl-3">
                    <div class="jobInfoFont">Recent Job</div>
                    <div>
                    {{$js->recentJob}}
                    </div>
                    <div class="jobInfoFont mt-2">Salary Range</div>
                    <div>
                    {{getSalariesRangeLavel($js->salaryRange)}}
                    </div>
                </div>

            </div>

            <div class="row p-0">
                <div class="card-title col p-0 mt-2 mb-0 jobInfoFont">Interested In</div>
            </div>
            <p class="card-text jobDetail row mb-1">{{$js->interested_in}}</p>


            <div class="row p-0">
                <div class="card-title col p-0 mt-2 mb-0 jobInfoFont">About Me</div>
            </div>
            <p class="card-text jobDetail row mb-1">{{$js->about_me}}</p>

            <div class="row p-0">
                <div class="card-title col p-0 mt-2 mb-0 jobInfoFont">Qualification</div>
            </div>

            @php
             $qualification_names =  getQualificationNames($js->qualification)
            @endphp

             @if(!empty($qualification_names))
                @foreach ($qualification_names as $qnKey => $qnValue)

                   {{-- <span class="qualification dblock">{{$qnValue}}</span> --}}

            <p class="card-text jobDetail row mb-1 qualification dblock">{{$qnValue}}</p>


                @endforeach
             @endif


             <div class="row p-0">
                <div class="card-title col p-0 mt-2 mb-0 jobInfoFont">Industry Expereience</div>
            </div>
            {{-- <div class="js_interested js_field"> --}}
                {{-- <span class="js_label">Industry Experience:</span> --}}
                    @if(isset($js->industry_experience))
                    @foreach ($js->industry_experience as $ind)
                         <p class="card-text jobDetail row mb-1 qualification dblock">{{getIndustryName($ind)}} </p>
                    @endforeach
                    @endif
            {{-- </div> --}}

            {{-- <p class="card-text jobDetail row mb-1 qualification dblock">{{$qnValue}}</p> --}}


        </div>

{{-- ============================================ Card Body end ============================================ --}}


{{-- ============================================ Card Footer ============================================ --}}

        <div class="card-footer text-muted jobAppFooter p-1">
                <div class="float-right">
                {{--     <a class="jobDetailBtn graybtn jbtn m5 btn btn-sm btn-primary ml-0 btn-xs"href="{{route('MjobSeekersInfo', ['id' => $js->id])}}">View Profile</a> --}}
                    <a class="jsBlockButton btn btn-sm btn-danger mr-0 btn-xs" data-jsid ="{{$js->id}}">Block</a>
                    {{-- <a class="jsLikeButton btn btn-sm btn-primary mr-0 btn-xs" data-jsid ="{{$js->id}}">Like</a> --}}


                    @if (in_array($js->id,$likeUsers))
                        <a class="btn btn-sm btn-danger mr-0 btn-xs unlikeEmpButton" data-jsid="{{$js->id}}" data-toggle="modal" data-target="#unlikeEmpModal">UnLike</a>
                    @else
                    <a class="jsLikeButton btn btn-sm btn-primary mr-0 btn-xs" data-jsid ="{{$js->id}}">Like</a>

                    @endif


                </div>
        </div>

{{-- ============================================ Card Footer end ============================================ --}}


    </div>

</div>





<ul class="nav nav-tabs md-tabs" id="myTabMD" role="tablist" style="background: #254c8e">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab-md" data-toggle="tab" href="#home-md" role="tab" aria-controls="home-md"
      aria-selected="true">Photos</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab-md" data-toggle="tab" href="#profile-md" role="tab" aria-controls="profile-md"
      aria-selected="false">Videos</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="contact-tab-md" data-toggle="tab" href="#contact-md" role="tab" aria-controls="contact-md"
      aria-selected="false">Questions</a>
  </li>
</ul>
<div class="tab-content card pt-5 mb-3" id="myTabContentMD">

  <div class="tab-pane fade show active" id="home-md" role="tabpanel" aria-labelledby="home-tab-md">

            {{-- <div class="photos">
                @if ($galleries)
                @foreach ($galleries as $gallery)
                    <div id="{{$gallery->id}}" class="emp_profile_photo_frame fl_left gallery_{{$gallery->id}}">
                        <a  data-offset-id="{{$gallery->id}}" class="show_photo_gallery"
                            href="{{assetGallery($gallery->access,$js->id,'',$gallery->image)}}"
                            data-lcl-thumb="{{assetGallery($gallery->access,$js->id,'small',$gallery->image)}}"
                            >
                            <img data-photo-id="{{$gallery->id}}"  id="photo_{{$gallery->id}}"   class="w100"
                            data-src="{{assetGallery($gallery->access,$js->id,'',$gallery->image)}}"
                            src="{{assetGallery($gallery->access,$js->id,'small',$gallery->image)}}" >
                        </a>
                    </div>


                @endforeach
            @endif
            </div> --}}

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

           {{-- private area --}}

           {{-- @dump($isallowed) --}}
     

            {{-- New  --}}
            @if($isallowed)
        
        {{-- private area --}}
            <span class="prvate-section text-dark">
                <div class="title_private_photos" style="margin-bottom: 5px;">
                    Resume &amp; Contact Details
                </div>

                <ul class="list_interest_c" style="margin: 0;padding: 0 0 0 23px;">
                    <li><span class="basic_info">•</span><span id="info_looking_for_orientation">Email: {{$js->email}}</span></li>
                    <li><span class="basic_info">•</span><span id="info_looking_for_ages">Mobile : {{$js->phone}}</span></li>
                    {{-- <li> <a class="btn violet view-resume" target="_blank" style="" href="/talenttube/_files/resumeUpload/3687_Pimmys logo.pdf">View Resume</a></li> --}}
                </ul>
            </span>

                <br>

                <div class="private_attachments text-dark display-flex">
                    @foreach ($attachments as $attachment)

                        {{-- {{asset('images/user/'.$attachment->file)}} --}}

                        <div class="attachment_{{$attachment->id}} attachment_file float-left ml-2">
                                <div class="attachment"><img src="{{asset('images/site/icons/cv.png')}}" style="    height: 100px;" /></div>
                                <span class="attach_title ml-2">{{ $attachment->name }}</span>
                                <div class="attach_btns">
                                    <a class="attach_btn downloadAttachBtn" href="{{asset('images/user/'.$attachment->file)}}">Download</a>
                                </div>

                        </div>
                    @endforeach
            </div>
            @else

            <span class="prvate-section text-dark">
                <div class="title_private_photos" style="margin-bottom: 5px;">
                    Content Locked
                </div>

                <div class="attach_btns">
                    <a class="attach_btn downloadAttachBtn btn btn-sm btn-primary m-0" onclick="({{$js->id}});">Unlock <i class="fas fa-unlock-alt ml-2"></i></a>
                </div>
            </span>

        @endif
            {{-- New end --}}


  </div>
  <div class="tab-pane fade" id="profile-md" role="tabpanel" aria-labelledby="profile-tab-md">
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
<!-- Grid column -->

</div>

  <div class="tab-pane fade" id="contact-md" role="tabpanel" aria-labelledby="contact-tab-md">


    <p class="loader SaveQuestionsLoader"style="float: left;"></p>
      	<div class="cl"></div>
            <div class="questionsOfUser text-dark">

                @php
                    $userQuestions = !empty($user->questions)?(json_decode($user->questions, true)):(array());
                @endphp
                  @if(!empty($userquestion))
                      @foreach($userquestion as $qk => $question)
                        <div>
                          <p class="m-0">{{$question}} </p>
                           <p class="QuestionsKeyPTag my-1 font-weight-bold">{{$userQuestions[$qk]}}</p>
                        </div>
                      @endforeach
                  @endif
            </div>

  </div>
</div>

@stop

@section('custom_footer_css')
<link rel="stylesheet" href="{{ asset('css/site/plyr.css') }}">
<style type="text/css">

p{
  font-size: 12px;
}
.iconPosition {
    position: relative;
        right: 20px;
    top: 5px;
}

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

</style>

@stop


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('js/mobile/likeUnlikeBlockUnblockJS.js') }}"></script>
<link rel="stylesheet" href="https://unpkg.com/smartphoto@1.1.0/css/smartphoto.min.css">
<script src="https://unpkg.com/smartphoto@1.1.0/js/smartphoto.js"></script>
@section('custom_js')
<script src="{{ asset('js/site/plyr.polyfilled.js') }}"></script>
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
<script type="text/javascript">


// =============================================== unLike Job Seeker in JS Detail Page ===============================================

$('.unlikeEmpButton').click(function(){
        var btn = $(this);
        var jobseeker_id = $(this).data('jsid');
        $('#idEmpInModalHidden').val(jobseeker_id);

    });

    $('.confirmUnlikeEmployer').click(function(){
        var btn = $(this);
        var jobseeker_id = $(this).data('jsid');
        var emp_id = $('#idEmpInModalHidden').val();
        console.log(emp_id);
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                type: 'POST',
                url: base_url+'/m/ajax/MunLikeUser/'+emp_id,
                data: {'id': emp_id},
                success: function(data){
                    if( data.status == 1 ){
                        $('.empLikeAlert').show().delay(3000).fadeOut('slow');
                        location.reload();
                    }
                }
            });
    });

// =============================================== unLike Job Seeker in JS Detail Page end ===============================================


document.addEventListener('DOMContentLoaded',function(){

				new SmartPhoto(".js-smartPhoto2",{
						useOrientationApi: false
				});
			});
</script>
@stop
