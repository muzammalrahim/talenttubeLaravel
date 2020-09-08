
@extends('mobile.user.usermaster')
@section('content')



<h6 class="h6 jobAppH6">Job Seeker's Detail </h6>

@php
$js = $jobseeker;
@endphp

<div class="card border-info mb-3 shadow mb-3 bg-white rounded job_row jobApp_{{-- {{$application->id}} --}}">
    <div class="card">
        <div class="card-header jobInfoFont jobAppHeader p-2">Name:
            <span class="jobInfoFont font-weight-normal">{{$js->name}} {{$js->surname}}</span>
                <div class="jobInfoFont">Location:
                <span class="font-weight-normal">{{($js->GeoCity)?($js->GeoCity->city_title):''}},  {{($js->GeoState)?($js->GeoState->state_title):''}}, {{($js->GeoCountry)?($js->GeoCountry->country_title):''}}</span>
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
                    <a class="jsLikeButton btn btn-sm btn-primary mr-0 btn-xs" data-jsid ="{{$js->id}}">Like</a>
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

            <div class="photos">
                @if ($galleries)
                @foreach ($galleries as $gallery)
                    <div id="{{$gallery->id}}" class="emp_profile_photo_frame fl_left gallery_{{$gallery->id}}">
                        <a  data-offset-id="{{$gallery->id}}" class="show_photo_gallery"
                            href="{{asset('images/user/'.$js->id.'/gallery/'.$gallery->image)}}"
                            data-lcl-thumb="{{asset('images/user/'.$js->id.'/gallery/small/'.$gallery->image)}}"
                            >
                            <img data-photo-id="{{$gallery->id}}"  id="photo_{{$gallery->id}}"   class="w100"
                            data-src="{{asset('images/user/'.$js->id.'/gallery/'.$gallery->image)}}"
                            src="{{asset('images/user/'.$js->id.'/gallery/small/'.$gallery->image)}}" >
                        </a>
                    </div>
                @endforeach
            @endif
            </div>

  </div>
  <div class="tab-pane fade" id="profile-md" role="tabpanel" aria-labelledby="profile-tab-md">

    <div class="videos">
        @if ($videos->count() > 0 )
        @foreach ($videos as $video)
            <div id="v_{{$video->id}}" class="video_box">
                <a class="video_link" href="{{asset('images/user/'.$video->file)}}" data-lcl-thumb="{{'images/user/'.asset($video->file)}}" target="_blank">
                <span class="v_title">{{$video->title}}</span>
                </a>
            </div>
        @endforeach
    @endif
    </div>

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
                          <p>{{$question}} </p>
                           <p class="QuestionsKeyPTag"><b>{{$userQuestions[$qk]}}</b></p>
                        </div>
                      @endforeach
                  @endif
            </div>

  </div>
</div>

@stop
