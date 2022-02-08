{{-- html for job application form in employer page  --}}
<div class="row">
   @if ($applications->count() > 0)
   @foreach ($applications as $application)
   @php
   $js = $application->jobseeker;
   @endphp
   <div class="col-sm-12 col-md-12">
      <div class="job-box-info block-box clearfix">
         <div class="box-head py-4">
            {{-- goldstat questions --}}
            @include('site.layout.parts.jobSeekerProfileStar') {{-- site/layout/parts/jobSeekerProfileStar --}} 
            @if ($application->userOnlineTests ->count() > 0 )
            @foreach ($application->userOnlineTests as $test)
            <span  style="position: absolute; top: 10px; right: 10px;"> Test Result: <b> {{$test->test_result}} </b> </span>
            @endforeach
            @else
            <span  style="position: absolute; top: 10px; right: 10px;"> No Test attempted </span>
            @endif                         
         </div>
         
         <div class="row Block-user-wrapper">
            <div class="col-md-4 user-images">
               <div class="block-user-img position-absolute">
                  @php
                  $profile_image  = asset('images/site/icons/nophoto.jpg');
                  $profile_image_gallery    = $js->profileImage()->first();
                  if ($profile_image_gallery) {
                  $profile_image   = assetGallery2($profile_image_gallery,'small');
                  }
                  @endphp
                  <img src="{{$profile_image}}" class="w-auto rounded-circle" alt="" >
               </div>

               <!-- ================================= Video box ================================= -->
                  <div class="block-progrees-ratio d-block d-md-none">
                     <div class="videos_list">
                        @foreach($js->vidoes as $video)
                        <input type="hidden" name="user_video" value="{{$video->file}}">
                        @endforeach
                     </div>
                  </div>
                  @if($js->vidoes->count() > 0)
                  <a onclick="showVideoModalFunction('{{assetVideo($js->vidoes->first())}}')" class="js_video_link pointer" data-bs-toggle="modal" data-bs-target="#videoShowModal" target="_blank">{!! generateVideoThumbs($js->vidoes->first()) !!}</a>
                  @endif

               <!-- ================================= Video box ================================= -->

               <div class="block-user-progress ">
                  <h6>{{$js->username}}</h6>
                  <div class="progress-img"> <img src="assests/images/user-progressbar.svg" alt=""></div>
                  
               </div>
            </div>
            <div class="col-md-8 user-details">
               <div class="row blocked-user-about mt-2">
                  <h6 class="p-0">Recent Job:</h6>
                  <p><b>{{$js->recentJob}}</b> at <b>{{$js->organHeldTitle}}</b></p>
               </div>
               <div class="row blocked-user-experience">
                  <h6 class="p-0">Qualification:</h6>
                  @php
                  $qualification_names =  getQualificationNames($js->qualification)
                  @endphp
                  @if(!empty($qualification_names))
                  {{-- <div class="font13"> --}}
                     
                     <p> <span>Type:</span> {{$js->qualificationType}}</p>
                  {{-- </div> --}}
                  <ul class="p-0">
                     @foreach ($qualification_names as $qnKey => $qnValue)
                     <li class="qualification">
                        <p>{{$qnValue}}</p>
                     </li>
                     @endforeach
                  </ul>
                  @endif
               </div>
               <div class="row blocked-user-about mt-2">
                  <h6 class="p-0">About me:</h6>
                  <p>{{$js->about_me}}</p>
               </div>
               <div class="row blocked-user-about mt-2">
                  <h6 class="p-0">Intrested In:</h6>
                  <p>{{$js->interested_in}}.</p>
               </div>
               <div class="row blocked-user-about mt-2">
                  <h6 class="p-0">Salary Range:</h6>
                  <p>{{getSalariesRangeLavel($js->salaryRange)}}</p>
               </div>
               <div class="row blocked-user-experience mt-2">
                  <h6 class="p-0">Industory Experience:</h6>
                  @if(isset($js->industry_experience))
                  <ul class="p-0">
                     @foreach ($js->industry_experience as $ind)
                     <li style="margin-bottom: 0px;">
                        <p>{{getIndustryName($ind)}} </p>
                     </li>
                     @endforeach
                  </ul>
                  @endif
               </div>
            </div>
         </div>
         <div class="box-footer1 box-footer  clearfix">
            <div class="block-progrees-ratio1 d-none d-md-block">
               <div class="job_app_qa job_app_{{$application->id}}">
                  <div class="ps-3"><button class="ja_load_qa blue_btn" data-appid="{{$application->id}}">Question/Answers</button></div>
                  <div class="job_app_qa_box" style="display: none;"></div>
               </div>
            </div>
            <div class=" employe-btn-group">
               <a href="#onlineTestModal"  class="requestTest  detail-btn "data-toggle="modal" data-target="#myModal" data-jobAppId="{{$application->id}}">Request Testing</a>
               @if (in_array($js->id,$likeUsers))
               <a class="active  like-btn" data-jsid="{{$js->id}}">Liked</a>
               @else
               <a class="jsLikeUserBtn  like-btn" data-jsid="{{$js->id}}">Like</a>
               @endif

               <a class="block-btn" href="{{route('jobSeekerInfo',['id'=>$js->id])}}" target="_blank" >View Profile</a>
               {{-- <a href="{{ route('jobSeekerInfo', ['id'=> $js->id]) }}" target="_blank">
                  <button class="detail-btn"><i class="fas fa-file-alt"></i> View profile</button>
               </a> --}}

               @if ($application->status != 'pending')
               <div class="jobApplicationStatusCont ">
                  <select name="jobApplicStatus" class="select_aw jobApplicStatus" data-application_id="{{$application->id}}" style="height: 36px; margin-top: 10px;">
                  @foreach (jobStatusArray() as $statusK => $statusV)
                  <option value="{{$statusK}}" {{($application->status == $statusK )?'selected="selected"':''}} >{{$statusV}}</option>
                  @endforeach
                  </select>
               </div>
               @else
               <span class="m5">Pending</span>
               @endif
            </div>
         </div>
      </div>
   </div>
   @endforeach
   @endif
</div>
<div class="job_pagination cpagination">{!! $applications->render() !!}</div>
<!-- ====================================================================================Modal -->
<div class="modal fade" id="myModal" role="dialog">
   <div class="modal-dialog delete-applications">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header py-4 px-2">
            <i data-dismiss="modal" class="close-box fa fa-times"></i>                      
            <h5 class="modal-title text-start text-white">Send Online Test</h5>
         </div>
         <div class="modal-body">
            <div class="testContent p10">
               {{--   
               <form name="sendTestForm" class="sendTestForm">
                  @csrf
                  <input type="hidden" name="jobApp_id" class="jobAppIdModal">
                  <div class="job_age form_field" style="height:120px;">
                     <span class="w20 dinline_block">Select Test</span>
                     <div class="w70 dinline_block">
                        <select name="test_id">
                           @foreach ($onlineTest as $test)
                           <option value="{{$test->id}}"> {{$test->name}} </option>
                           @endforeach
                        </select>
                     </div>
                  </div>
               </form>
               --}}
               <p class="errorsInFields text-danger"></p>
               <div class="fomr_btn act_field center">
                  <button class="btn small turquoise sendTestButton orange_btn">Send Test</button>
               </div>
            </div>
         </div>
         <div class="dual-footer-btn">
            {{-- <button type="button" class="btn btn-default black_btn" data-dismiss="modal"><i class="fa fa-times"></i>Cancel</button> --}}
            {{-- <button type="button" class="orange_btn"><i class="fa fa-check"></i>OK</button> --}}
         </div>
      </div>
   </div>
</div>