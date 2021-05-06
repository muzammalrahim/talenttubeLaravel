

<div class="swiper-container mySwiper">
    <div class="swiper-button-next swiperButton" tabindex="0" role="button" aria-label="Next slide" aria-controls="swiper-wrapper-3c6e55462a735cf8" aria-disabled="false"></div>
    <div class="swiper-button-prev swiperButton" tabindex="0" role="button" aria-label="Prev slide" aria-controls="swiper-wrapper-3c6e55462a735cf8" aria-disabled="false"></div>

    <div class="swiper-wrapper">

        @if ($applications->count() > 0)
        @foreach ($applications as $application)
        	@php
               $js = $application->jobseeker;
                // dd($js);
            @endphp

            {{-- @dump($js) --}}

            <div class="card mb-3 swiper-slide shadow mb-3 bg-white rounded job_row jobApp_{{$application->id}}">
                <div class="card">
                    {{-- <div class="card-header jobInfoFont jobAppHeader p-2">Name:
                        <span class="jobInfoFont font-weight-normal">{{$js->name}} {{$js->surname}}</span>
                            <div class="jobInfoFont">Location:
                                <span class="font-weight-normal">{{$js->city}},  {{$js->state}}, {{$js->country}}</span>
                            </div>
                    </div> --}}
    				@php
        				$profile_image  = asset('images/site/icons/nophoto.jpg');
        				$profile_image_gallery    = $js->profileImage()->first();

        				// dump($profile_image_gallery);

    					if ($profile_image_gallery) {
                            // $profile_image   = assetGallery($profile_image_gallery->access,$js->id,'',$profile_image_gallery->image);
                            $profile_image   = assetGallery2($profile_image_gallery,'small');
                            // dump($profile_image);
    					}


                        $profile_imageBig  = asset('images/site/icons/nophoto.jpg');
                        $profile_imageBig_gallery    = $js->profileImage()->first();
                        // dump($profile_imageBig_gallery);
                        if ($profile_imageBig_gallery) {
                            // $profile_imageBig   = assetGallery($profile_imageBig_gallery->access,$js->id,'',$profile_imageBig_gallery->image);
                            $profile_imageBig   = assetGallery2($profile_imageBig_gallery,'/');
                            // dump($profile_imageBig);
                        }
    				@endphp
                    {{-- ============================================ Card Body ============================================ --}}
                    
                    <div class="card-body pt-2">
                        <div class="row jobInfo">
                            <div class="col-md-6 col-12 videoDiv">
                                <div class="js_profile_video">
                                    <div class="js_video_thumb">

                                        <a onclick="profileImage( '{{ $profile_imageBig }}')">  
                                                <img class="js_profile_photo w100" id="pic_main_img" src="{{$profile_image}}">
                                        </a>

                                        {{-- <img class="js_profile_photo w100" id="pic_main_img" src="{{$profile_image}}"> --}}
                                    </div>
                                    <div class="videos_list">
                                        @foreach($js->vidoes as $video)
                                            <input type="hidden" name="user_video" value="{{$video->file}}">
                                        @endforeach
                                    </div>
                                </div>
                                @if($js->vidoes->count() > 0)
                                <a onclick="profileVideoShow('{{assetVideo($js->vidoes->first())}}')" class="js_video_link" target="_blank">{!! generateVideoThumbsm($js->vidoes->first()) !!}</a>
                                @endif
                            </div>

                            <div class="col-md-6 col-12">
                              <span class="font-weight-bold m-0 float-left jobInfoFont"> {{$js->name}} {{$js->surname}} </span>
                              <span class="float-right"> <span class="font-weight-normal"> Status : </span>  
                                @if ($application->status == "inreview")
                                    <span class="statusUpdated text-capitalize"> In Review </span> 
                                @else
                                    <span class="statusUpdated text-capitalize"> {{ $application->status }} </span> 
                                @endif
                              </span>
                            </div>

                            <div class="col-md-6 col-12">
                                <p> <span class="jobInfoFont">  Recent Job: </span>  {{$js->recentJob}} </p> 
                            </div>
                        </div>
                    </div>

                    {{-- ============================================ Card Body end ============================================ --}}


                    {{-- ============================================ Card Footer ============================================ --}}

                    <div class="card-footer text-muted jobAppFooter p-1">


                        <div class="row">
                            <div class="col-4">
                                <a class="jobDetailBtn graybtn jbtn m5 btn btn-sm btn-primary ml-0 btn-xs" target="_blank" href="{{route('MjobSeekersInfo', ['id' => $js->id])}}">View Profile</a>
                            </div>
                            <div class="col-4">
                                <a class="m5 btn btn-sm btn-primary ml-0 btn-xs viewCvButton" onclick="viewCv()" data-jsId = "{{ $js->id }}" >View CV</a>
                            </div>
                            <div class="col-4">
                                <a class="jobDetailBtn graybtn jbtn m5 btn btn-sm btn-primary ml-0 btn-xs" href="tel:{{ $js->phone }}">Call Candidate</a>
                            </div>
                        </div>
                        <div class="float-right">

                            <a class="inreview btn btn-sm btn-primary ml-0 btn-xs my-3" onclick="inreview()" data-appId ="{{$application->id}}" data-status = "inreview">In Review</a>
                            <a class="interview btn btn-sm btn-primary mr-0 btn-xs my-3" onclick="interview()" data-appId ="{{$application->id}}" data-status = "interview" >Interview</a>
                            <a class="unsuccessful btn btn-sm btn-primary mr-0 btn-xs my-3" onclick="unsuccessful()" data-appId ="{{$application->id}}" data-status = "unsuccessful" >Unsuccessful</a>

                            <div class="mx-2 float-right jobApplicationStatusCont">
                                <select name="jobApplicStatus" class="mdb-select sm-form colorful-select dropdown-primary select_aw jobApplicStatus" data-application_id="{{$application->id}}">
                                  @foreach (jobStatusArray() as $statusK => $statusV)
                                          <option value="{{$statusK}}" {{($application->status == $statusK )?'selected="selected"':''}} >{{$statusV}}</option>
                                     @endforeach
                                </select>
                            </div>

                            {{-- <div class="jobApplicationStatusCont dinline_block">
                                <select name="jobApplicStatus" class="select_aw jobApplicStatus" data-application_id="{{$application->id}}">
                                     @foreach (jobStatusArray() as $statusK => $statusV)
                                          <option value="{{$statusK}}" {{($application->status == $statusK )?'selected="selected"':''}} >{{$statusV}}</option>
                                     @endforeach
                                </select>
                            </div> --}}
                        </div>
                    </div>

                    <div class="jobAppFooter jobAppChangeStatus" style="display: none">
                        <p class="float-right mr-3 text-primary mt-3"> Updated Successfully</p>
                    </div>

                    <div class="jobAppFooter">
                        <div class="text-center"><a class="mt-0 btn btn-primary btn-sm questionsAnswers">Questions/Answers</a></div>
                            <div class="application_qa jobDetail p-2 d-none">
                                @php
                                    $answers = $application->answers;
                                @endphp
                                 @if (!empty($answers))
                                        <div class="jobAnswers">
                                            @foreach ($answers as $answer)
                                            <div class="job_answers">
                                                <div class="jqa_q font-weight-bold">{{$answer->question->title}}</div>
                                                <div class="jqa_a">{{$answer->answer}}</div>
                                            </div>
                                            @endforeach
                                        </div>
                                 @endif
                                <div class="jobAppDescriptionBox">
                                    <span class="font-weight-bold">{{jobApplicationMandatoryQuestion()}}</span>
                                    <div class="jobAppDescription">{{$application->description}}</div>
                                </div>
                            </div>
                    </div>

                    {{-- ============================================ Card Footer end ============================================ --}}
                </div>
            </div>
        @endforeach
        {{-- <div class="jobseeker_pagination cpagination">{!! $job->links() !!}</div> --}}
        <div class="cl"></div>
        {{-- <div class="job_pagination cpagination">{!! $applications->render() !!}</div> --}}

        @else
         <h6 class="h6 jobAppH6">No Application found</h6>
        @endif

    </div>
</div>
{{-- Icluded Common file here --}}
@include('mobile.employer.jobSeekers.Swipe-jobseeker-common')


