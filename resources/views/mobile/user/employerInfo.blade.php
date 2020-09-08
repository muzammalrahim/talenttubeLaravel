
@extends('mobile.user.usermaster')
@section('content')



<h6 class="h6 jobAppH6">Employer Detail Page</h6>

{{-- @if ($employers->count() > 0) --}}
{{-- @foreach ($employers as $jobs) --}}

    {{-- @dump($empquestion) --}}

    <div class="card border-info mb-3 shadow mb-3 bg-white rounded job_row jobApp_{{-- {{$application->id}} --}}">


        <div class="card">

            <div class="card-header jobInfoFont jobAppHeader p-2">Company : 
                <span class="jobInfoFont">{{$employer->name}}</span>
            </div>

{{-- ============================================ Card Body ============================================ --}}

            <div class="card-body jobAppBody pt-2">

                <div class="row jobInfo">
                   
                    <div class="col-4 p-0">


                        {{-- @dump($employer_video); --}}
                        
                   {{--      <img class="img-fluid z-depth-1" src="https://media-exp1.licdn.com/dms/image/C5103AQHK0mH7N_EvGg/profile-displayphoto-shrink_200_200/0?e=1601510400&v=beta&t=mxpoqv7XzDVLr_ACQKTkPsIKa5wSLg7JMke622gyR1U" height="100px" width="100px"> --}}

                        @php
                    $profile_image   = asset('images/site/icons/nophoto.jpg');
                    if ($employer->profileImage){
                        $profile_image = asset('images/user/'.$employer->id.'/gallery/'.$employer->profileImage->image);
                    }
                    @endphp
                    
                    <img class="js_photo w100" id="pic_main_img" src="{{$profile_image}}">


                    </div>

                    <div class="col p-0 pl-3">

                        <div class="jobInfoFont">Interested In</div>
                        <div>
                        {{$employer->interested_in}}
                        </div>

                        <div class="mt-3">
                            <span class="jobInfoFont">Location</span>
                        </div>
                        {{-- <div>
                        {{($employer->GeoCity->city_title)}}, {{($employer->GeoState->state_title)}},{{($employer->GeoCountry->country_title)}}
                        </div> --}}
                        
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
                        <a class="blockEmployerButton btn btn-sm btn-primary mr-0 btn-xs">Block</a>
                        <a class="likeEmployerButton btn btn-sm btn-primary mr-0 btn-xs">Like</a>
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

@include('mobile.jobs.jobsModal')  {{--         mobile/jobs/jobsModal       --}}

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
                             {{($job->GeoCity)?($job->GeoCity->city_title):''}},  {{($job->GeoState)?($job->GeoState->state_title):''}}, {{($job->GeoCountry)?($job->GeoCountry->country_title):''}}</div>
                    </div>
                </div>

                    <div class="row p-0 m-0">
                        <span class="jobInfoFont">Employer : </span>
                            <span class="jobDetail" style="margin: 0.2rem 0 0 0.2rem;"> {{ $job->jobEmployer->name.' '.$job->jobEmployer->surname }}</span>
                    </div>

            </div>

            <div class="card-body jobAppBody pt-2">

                <div class="row jobInfo">
                   
                    <div class="col-4 p-0">
                        <img class="img-fluid z-depth-1" src="https://media-exp1.licdn.com/dms/image/C5103AQHK0mH7N_EvGg/profile-displayphoto-shrink_200_200/0?e=1601510400&v=beta&t=mxpoqv7XzDVLr_ACQKTkPsIKa5wSLg7JMke622gyR1U" style="height:110px;">
                    </div>

                    <div class="col p-0 pl-3">

                        <div class="jobInfoFont float-left mr-1">Job Salary: </div> 
                            <div class="jobDetail" style="margin: 0.2rem 0 0 0.2rem; "> {{$job->salary}}</div>
                        <div class="mt-2">
                            <span class="jobInfoFont">Job Experience</span>
                        </div>
                        <div>
                        {{$job->experience}}
                        </div>
                        <div class="mt-2">
                            <span class="jobInfoFont">Job Category</span>
                        </div>

                        <div>
                        Web & E-commerce Job
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
                        {{$job->type}}
                    </div>
                </div>
                <div class="card-footer row p-0 mt-3">
                    <div class="col p-0">
                        <a class="jobDetailBtn graybtn jbtn m5 btn btn-sm btn-primary ml-0 btn-xs" href="{{route('MjobDetail', ['id' => $job->id]) }}">Detail</a>
                    </div>
                    <div class="float-right">
                        <a class="jobApplyBtn graybtn jbtn btn btn-sm btn-primary mr-0 btn-xs" job-id ="{{$job->id}}" job-title="{{$job->title}}" data-toggle="modal" data-target="#modalJobApply" >Apply</a>
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

<div class="galleryCont">
            <div class="head2 text-primary font-weight-bold">Gallery Photos</div>
            <div class="photos">
                @if ($galleries)
                @foreach ($galleries as $gallery)
                    <div id="{{$gallery->id}}" class="emp_profile_photo_frame fl_left gallery_{{$gallery->id}}">
                        <a  data-offset-id="{{$gallery->id}}" class="show_photo_gallery"
                            href="{{asset('images/user/'.$employer->id.'/gallery/'.$gallery->image)}}"
                            data-lcl-thumb="{{asset('images/user/'.$employer->id.'/gallery/small/'.$gallery->image)}}"
                            >
                            <img data-photo-id="{{$gallery->id}}"  id="photo_{{$gallery->id}}"   class="w100"
                            data-src="{{asset('images/user/'.$employer->id.'/gallery/'.$gallery->image)}}"
                            src="{{asset('images/user/'.$employer->id.'/gallery/small/'.$gallery->image)}}" >
                        </a>
                    </div>
                @endforeach
            @endif
            </div>
        </div>
        <!-- /photos -->

        <div class="cl mb20"></div>

        <div class="VideoCont">
            <div class="head2 text-primary font-weight-bold">Gallery Videos</div>
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
            {{-- @dump($employer->questions) --}}

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
                          <p>{{$question}} </p>
                           <p class="QuestionsKeyPTag"><b>{{$userQuestions[$qk]}}</b></p>
                        </div>
                      @endforeach
                  @endif
            </div>
  </div>
</div>
@stop


