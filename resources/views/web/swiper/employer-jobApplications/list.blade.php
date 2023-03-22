
 {{-- @dd($jobSeekers) --}}
<div class="overlay" style="position: fixed;top: 15%;left: 0;width: 100%;height: 100%;background-color: rgba(0, 0, 0, 0.5);z-index: 100;display: none;"></div>
<div class="swiper-container mySwiper">


    <div class="swiper-wrapper">

    @if(isset($applications))
    @if ($applications && $applications->count() > 0)

        @foreach ($applications as $application)
            @php
               $js = $application->jobseeker;
               @endphp
            <div class="swiper-slide shadow bg-white rounded job_row jobApp_{{$application->id}} overflow-hidden" style="">
                <div class="w-100 text-center" style="height: 50px;margin: 10px 0px;"> 
                        <div class="swiper-navigation-buttons">                    
                            <div class="navigation-div float-right">
                                <div class="swiper-button-next swiperButton" tabindex="0" role="button" aria-label="Next slide" aria-controls="swiper-wrapper-3c6e55462a735cf8" aria-disabled="false">  
                                </div>
                            </div>

                            {{-- @include('site.layout.parts.jobSeekerProfileStar') --}}
                            <span class="d-inline-block mt-2 bold"> {{$js->name}} {{$js->surname}} </span>
                            @if ($application->status == "inreview")
                                <span class="d-inline-block mt-2 bold text-capitalize statusUpdated_{{ $application->id }}"> ( In Review ) </span>
                            @else
                                <span class="d-inline-block mt-2 bold text-capitalize statusUpdated_{{ $application->id }}"> ( {{$application->status}} ) </span>
                            @endif
                            <div class="navigation-div float-left">
                                <div class="swiper-button-prev swiperButton" tabindex="0" role="button" aria-label="Prev slide" aria-controls="swiper-wrapper-3c6e55462a735cf8" aria-disabled="false">
                                    
                                </div>
                            </div>
                        </div>
                </div>
                <div class="">

                    @php
                        $profile_image  = asset('images/site/icons/nophoto.jpg');
                        $profile_image_gallery    = $js->profileImage()->first();
                        if ($profile_image_gallery) {
                            // $profile_image   = assetGallery($profile_image_gallery->access,$js->id,'',$profile_image_gallery->image);
                            $profile_image   = assetGallery2($profile_image_gallery,'');
                        }
                        $profile_imageBig  = asset('images/site/icons/nophoto.jpg');
                        $profile_imageBig_gallery    = $js->profileImage()->first();
                        if ($profile_imageBig_gallery) {
                            // $profile_imageBig   = assetGallery($profile_imageBig_gallery->access,$js->id,'',$profile_imageBig_gallery->image);
                            $profile_imageBig   = assetGallery2($profile_imageBig_gallery,'/');
                        }
                    @endphp

                    {{-- ============================================ Card Body ============================================ --}}

                    
                    <div class="{{-- card-body --}} pt-2">
                        <div class="row jobInfo">
                            <div class="col-md-6 col-12 videoDiv text-center"{{--  style="height: 55vh;" --}}>
                                <div class="js_profile_video">
                                    {{-- <div class="js_video_thumb">
                                        <a onclick="profileImage( '{{ $profile_imageBig }}')">  
                                            <img class="js_profile_photo w100" id="pic_main_img" src="{{$profile_image}}">
                                        </a>
                                    </div> --}}
                                    <div class="videos_list">
                                        @foreach($js->vidoes as $video)
                                            <input type="hidden" name="user_video" value="{{$video->file}}">
                                        @endforeach
                                    </div>
                                </div>
                                @if($js->vidoes->count() > 0)
                                <a onclick="profileVideoShow('{{assetVideo($js->vidoes->first())}}')" class="js_video_link" target="_blank">
                                    {{-- {!! generateVideoThumbsm($js->vidoes->first()) !!} --}}
                                    <img class="img-fluid imageSizeModal z-depth-1 item_video" id="pic_main_img" src="{{$profile_image}}">
                                </a>
                                @endif
                            </div>
                            
                        </div>
                        <div class="row">
                        
                            <div class="col-md-6 col-12 text-center">
                            </div>

                            <div class="col-md-6 col-12 text-center">
                                <h3 class="my-2 bold"> {{-- <span class="jobInfoFont">  Recent Job: </span> --}}  {{$js->recentJob}} </h3> 
                                <h3 class="mb-2"> <span class="jobInfoFont">  @ </span>  {{$js->organHeldTitle}} </h3> 
                            </div>
                        </div>

                        <div class="row p-2">
                            <div class="col-4">
                                <a class="jobDetailBtn custom-btn-mob view-profile-bg d-flex justify-content-center align-items-center" target="_blank" href="{{route('jobSeekerInfo', ['id' => $js->id])}}"> 
                                    <img src="{{ asset('/assests/images/profile.png') }}" class="mr-1"> View Profile</a>
                            </div>
                            <div class="col-4">
                                <a class="custom-btn-mob view-cv-bg viewCvButton d-flex justify-content-center align-items-center" onclick="viewJobseekerCv({{ $js->id }})" data-jsId = "{{ $js->id }}" >
                                    <img src="{{ asset('/assests/images/cv.png') }}" class="mr-1">View CV
                                </a>
                            </div>
                            <div class="col-4">
                                <a class="jobDetailBtn blue-btn-mob d-flex justify-content-center align-items-center" href="tel:{{ $js->phone }}">
                                    <img src="{{ asset('/assests/images/call.png') }}" class="mr-1">
                                    Call Candidate
                                </a>
                            </div>
                        </div>

                        <div class="row px-2">
                            {{-- <div class="col-6">
                                @if ($application->status != 'pending')
                                  <div class="jobApplicationStatusCont">
                                     <select name="jobApplicStatus" class="select_aw blue_btn jobApplicStatus form-control icon_show" data-application_id="{{$application->id}}">
                                     @foreach (jobStatusArray() as $statusK => $statusV)
                                     <option value="{{$statusK}}" {{($application->status == $statusK )?'selected="selected"':''}} >{{$statusV}}</option>
                                     @endforeach
                                     </select>
                                  </div>
                                  @else
                                  <div class="py-3 bold d-inline-block">
                                     <span class="m5">Pending</span>
                                  </div>
                                  @endif
                            </div> --}}
                            <div class="col-4">
                                <div class="status-div {{ $application->status =='inreview' ? 'activestatus':'' }}">
                                    <a class="inreview custom-btn-mob inreview-bg ml-0+" 
                                    onclick="change_status({{$application->id}} , 'inreview',this)" data-appId ="{{$application->id}}" data-status = "inreview">
                                    <img src="{{ asset('/assests/images/inreview.png') }}" class="mr-1">
                                    In Review
                                    </a>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="status-div {{ $application->status =='interview' ? 'activestatus':'' }}">
                                    <a class="interview custom-btn-mob interview-bg mr-0+" 
                                    onclick="change_status({{$application->id}} , 'interview', this)" data-appId ="{{$application->id}}" data-status = "interview" >
                                        <img src="{{ asset('/assests/images/interview.png') }}" class="mr-1">
                                        Interview
                                    </a>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="status-div {{ $application->status =='unsuccessful' ? 'activestatus':'' }}">
                                    <a class="unsuccessful custom-btn-mob unsuccessfull-bg mr-0+" 
                                    onclick="change_status({{$application->id}} , 'unsuccessful', this)" data-appId ="{{$application->id}}" data-status = "unsuccessful" >
                                        <img src="{{ asset('/assests/images/unsuccessfull.png') }}" class="mr-1">
                                        Unsuccessful
                                    </a>
                                </div>
                            </div>

                            {{-- <div class="col-6">
                                <a href="#onlineTestModal" class="requestTest blue_btn detail-btn px-1 d-block w-100 text-center"data-toggle="modal" data-target="#myModal" data-jobAppId="{{$application->id}}">Request Testing</a>
                            </div> --}}

                        </div>

                        <div class="text-muted p-1 block-box" style="position: fixed;width: 100%;bottom: 2%;height: 40px;">
                            
                            <div class="box-footer clearfix">
                                <button class="app-question-btn w-100 getJobAppAnswers" 
                                    data-toggle="modal" data-target="#jobApplication-questions" data-app-id="{{$application->id}}">
                                    <img src="{{ asset('/assests/images/questions.png') }}" class="mr-1"> Question/Answers

                                </button>
                                {{-- <div class="job_app_qa_box" style="display: none;"></div> --}}
                            </div>

                           
                        </div>

                    </div>

                    {{-- ============================================ Card Body end ============================================ --}}

                    {{-- ============================================ Card Footer ============================================ --}}


                    {{-- ============================================ Card Footer end ============================================ --}}

                </div>

            </div>

        @endforeach
        {{-- <div class="jobseeker_pagination pagination pagination-sm">{!! $jobSeekers->links() !!}</div> --}}

    @else 
        <p> No Record Found </p>
    @endif
    </div>

</div>



{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
<script type="text/javascript" src="{{ asset('js/mobile/likeUnlikeBlockUnblockJS.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/web/profile.js') }}"></script>

{{-- Icluded Common file here --}}
@include('web.swiper.jobseekers.swiper-common')


<script type="text/javascript">

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


</script>
@endif

<style type="text/css">
    img.img-fluid.imageSizeModal.z-depth-1 {
        height: calc(var(--vh, 1vh) * 39) !important;
        padding: 0 10px;
    }
.card{overflow: scroll;}
.swiper-container{
/*    height: 100vh;*/
}
</style>