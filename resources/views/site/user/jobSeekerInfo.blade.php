@extends('web.user.usermaster')
@section('custom_css')
{{-- 
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
--}}
<link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
@stop
@section('content')
{{-- html for job seeker details starts here --}}
<section class="row">
   <div class="col-md-12">
   <div class="profile profile-section">
      <h2>Job Seeker Detail</h2>
      @php
      $js = $jobSeeker;
      @endphp                
      <!-- Top Filter Row -->
      <div class="row">
         <div class="col-sm-12 col-md-12">
            <div class="job-box-info employee-details-info block-box clearfix">
               <div class="box-head">                        
               </div>
               <div class="row Block-user-wrapper">
                  @php
                  $profile_image  = asset('images/site/icons/nophoto.jpg');
                  $profile_image_gallery    = $js->profileImage()->first();
                  if ($profile_image_gallery) {
                  $profile_image   = assetGallery2($profile_image_gallery,'small');
                  }
                  @endphp
                  <div class="col-md-3 user-images">
                     <div class="block-user-img ">
                        <img src="{{$profile_image}}" alt="">
                     </div>
                     <div class="block-user-progress ">
                        <h6>{{$js->username}}</h6>
                        {{-- <div class="progress-img"> <img src="{{ asset('assests/images/user-progressbar.svg') }}" alt=""></div> --}}
                        {{-- <div class="block-progrees-ratio d-block d-md-none">
                           <ul>
                              <li><span class="Progress-ratio-icon1">.</span> <span>60%</span> Match </li>
                              <li><span class="Progress-ratio-icon2">.</span> <span>40%</span> UnMatch</li>
                           </ul>
                        </div> --}}
                     </div>
                  </div>
                  <div class="col-md-9 user-details">
                     <div class="row blocked-user-about">
                        @if (!isAdmin($user))
                        {{-- expr --}}
                        @include('site.user.match_algo.match_algo')   {{-- site/user/match_algo/match_algo --}}
                        @endif
                     </div>
                     @php
                     $dist = calculate_distance($js, $user);
                     $ind_exp = cal_ind_exp($js,$user);
                     $compatibility = compatibility($js, $user); 
                     $user_compat = $compatibility*20;
                     // dump($user_compat);
                     // $resident = initial_last_question($js,$user);
                     // ========================= excluded 6th question ========================= 
                     $emp_questions = json_decode($js->questions , true);
                     $user_questions = json_decode($user->questions , true);
                     // dump($emp_questions);
                     // {"resident":"no","relocation":"yes","fulltime":"yes","temporary_contract":"yes","part_time":"no","graduate_intern":"yes"}
                     // $checkLastQuestion = end($emp_questions);
                     // dump($checkLastQuestion);
                     $emp_resident = '';
                     $user_resident = '';
                     if ($emp_questions != null && $user_questions != null) {
                     $emp_match = array_slice($emp_questions, 5, 6, true);
                     foreach ($emp_match as $key => $value) {
                     $emp_resident .= $value;
                     }
                     $user_match = array_slice($user_questions, 5, 6, true);
                     foreach ($user_match as $key => $value) {
                     $user_resident .= $value;
                     }
                     }
                     @endphp
                     <div class="row blocked-user-about">
                        <h6>Recent Job:</h6>
                        <p><b>{{$js->recentJob}}</b> at <b>{{$js->organHeldTitle}}</b></p>
                     </div>
                     <div class="row blocked-user-about">
                        <h6>About Me:</h6>
                        <p>{{$js->about_me}}</p>
                     </div>
                     <div class="row blocked-user-about">
                        <h6>Intrested In:</h6>
                        <p>{{$js->interested_in}}</p>
                     </div>
                     <div class="row blocked-user-about">
                        <h6>Location:</h6>
                        <p>{{$js->city}},  {{$js->state}}, {{$js->country}}</p>
                     </div>
                     <div class="row blocked-user-about">
                        <h6>Sallary Range:</h6>
                        <p>{{getSalariesRangeLavel($js->salaryRange)}}</p>
                     </div>
                     <div class="row blocked-user-about">
                        <h6>Qualification:</h6>
                        <p><span><b>Type:</b></span>{{$js->qualificationType}}</p>
                        @php
                        $qualificationsData =  ($js->qualification)?(getQualificationsData($js->qualification)):(array());
                        @endphp
                        @if(!empty($qualificationsData))
                        <ul>
                           @foreach($qualificationsData as $qualification)
                           <li class="QualificationSelect">
                              <p>{{$qualification['title']}}</p>
                           </li>
                           @endforeach
                        </ul>
                        @endif
                     </div>
                     <div class="row blocked-user-experience">
                        <h6>Industory Experience:</h6>
                        @if(isset($js->industry_experience))
                        <ul>
                           @foreach ($js->industry_experience as $ind)
                           <li class="indsutrySelect">
                              <p >{{getIndustryName($ind)}} </p>
                           </li>
                           @endforeach
                        </ul>
                        @endif
                     </div>
                  </div>
               </div>
               <div class="box-footer clearfix">
                  <div class="block-progrees-ratio d-none d-md-block">
                  </div>
                  <a id="JSBlockBtn"  data-jsid="{{$js->id}}"><button class="unblock-btn" data-toggle="modal" data-target="#myModal333"><i class="fas fa-ban"></i> Block</button></a>
                  @if (in_array($js->id,$likeUsers))
                  <a class="active " data-jsid="{{$js->id}}"><button class="like-btn"><i class="fas fa-thumbs-up"></i> UnLike</button></a>
                  @else
                  <a class="jsLikeUserBtn" onclick="likeFunction('{{ $js->id }}')" data-jsid="{{$js->id}}"><button class="like-btn"><i class="fas fa-thumbs-up"></i> Like</button></a>
                  @endif                          
               </div>
            </div>
         </div>
      </div>
      <div class="profile">
         <ul class="nav nav-tabs employee-tab-info" id="Profile-tab" role="tablist">
            <span class="line-tab"></span>
            <li class="nav-item" role="presentation">
               <button class="nav-link active" id="reference-tab" data-bs-toggle="tab" data-bs-target="#reference"
                  type="button" role="tab" aria-controls="job" aria-selected="false">
               <i class="fa fa-circle tab-circle-cross"></i>Refrance</button>
            </li>
            <li class="nav-item" role="presentation">
               <button class="nav-link" id="profile-tab1" data-bs-toggle="tab" data-bs-target="#profile"
                  type="button" role="tab" aria-controls="profile" aria-selected="false">
               <i class="fa fa-circle tab-circle-cross"></i>Album</button>
            </li>
            <li class="nav-item" role="presentation">
               <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                  type="button" role="tab" aria-controls="contact" aria-selected="false">
               <i class="fa fa-circle tab-circle-cross"></i>Questions</button>
            </li>
            @if ($controlsession->count() > 0 || isAdmin())
            @include('site.user.jobseekerInfoTabs.notesAndHistory')
            @endif
            <li class="nav-item" role="presentation">
               <button class="nav-link" id="interview-tab" data-bs-toggle="tab" data-bs-target="#interview"
                  type="button" role="tab" aria-controls="contact" aria-selected="false">
               <i class="fa fa-circle tab-circle-cross"></i>InterView</button>
            </li>
            <li class="nav-item" role="presentation">
               <button class="nav-link" id="online_test-tab" data-bs-toggle="tab" data-bs-target="#online_test"
                  type="button" role="tab" aria-controls="contact" aria-selected="false">
               <i class="fa fa-circle tab-circle-cross"></i>Online Test</button>
            </li>
            <li class="nav-item" role="presentation">
               <button class="nav-link" id="last_login-tab" data-bs-toggle="tab" data-bs-target="#last_login"
                  type="button" role="tab" aria-controls="contact" aria-selected="false">
               <i class="fa fa-circle tab-circle-cross"></i>Last Login</button>
            </li>
         </ul>
         <div class="tab-content employee-details-infomation" id="myTabContent">

            <!-- ======================================================= job tab ======================================================= -->
            
            <div class="tab-pane fade show active job-applied" id="reference"  role="tabpanel" aria-labelledby="reference-tab">
               <h2>Refrance</h2>
               <div class="row">
                  @include('site.user.jobseekerInfoTabs.reference')
               </div>
            </div>

            <!-- ======================================================= album-tab ======================================================= -->
            
            <div class="album-section tab-pane fade Photos " id="profile" role="tabpanel"
               aria-labelledby="profile-tab">

               @include('site.user.jobseekerInfoTabs.album')

            </div>

            <!-- ======================================================= question tab ======================================================= -->

            <div class="tab-pane fade questions-tab" id="contact"  role="tabpanel" aria-labelledby="contact-tab">
               <h2>Questions</h2>
               <div class="tab_photos tab_cont">
                  @include('site.user.jobseekerInfoTabs.questions')  {{-- site/user/jobseekerInfoTabs/questions --}}
               </div>
            </div>

            @if ($controlsession->count() > 0 || isAdmin())
            <!-- =============================================== Tab History =============================================== -->
            <a id="tabs-5" class="tab_link tab_a"></a>
            <div class="tab_history tab_cont pt30px">
               @include('site.user.jobseekerInfoTabs.history') {{-- site/user/jobseekerInfoTabs/history --}}
            </div>
            <!-- =============================================== Tab Notes =============================================== -->
            <a id="tabs-6" class="tab_link tab_a"></a>
            <div class="tab_notes tab_cont pt30px">
               @include('site.user.jobseekerInfoTabs.addNotes')
            </div>
            <!-- =============================================== Tab Jobs =============================================== -->
            <a id="tabs-8" class="tab_link tab_a"></a>
            <div class="tab_interviews tab_cont pt30px">
               @include('site.user.jobseekerInfoTabs.jobApplications') {{--    site/user/jobseekerInfoTabs/jobApplications  --}}
            </div>
            @endif

            <div class="tab-pane fade interview-tab" id="interview"  role="tabpanel" aria-labelledby="contact-tab">
               <h2>Interviews</h2>
               <div class="tab_interviews tab_cont pt30px">
                  {{-- @dd($UserInterview); --}}
                  @include('site.user.jobseekerInfoTabs.interviews')
                  {{--    site/user/jobseekerInfoTabs/interviews  --}}
               </div>
            </div>
            <div class="tab-pane fade online_test-tab" id="online_test"  role="tabpanel" aria-labelledby="online_test-tab">
               <h2>online Tests</h2>
               <div class="tab_onlineTest tab_cont pt30px">
                  @include('site.user.jobseekerInfoTabs.onlineTests')
                  {{--    site/user/jobseekerInfoTabs/onlineTests  --}}
               </div>
            </div>
            <div class="tab-pane fade last_login-tab" id="last_login"  role="tabpanel" aria-labelledby="last_login-tab">
               <h2>last Login</h2>
               <div class="tab_lastLogin tab_cont pt30px">
                  {{-- @dump($jobSeeker->last_login); --}}
                  <p>
                     {{ $jobSeeker->last_login }}
                  </p>
               </div>
            </div>
            <!--========================end all tabs-->
         </div>
         {{-- 
      </div>
      --}}
   </div>
   {{-- modal for Block user of like page --}}
   <!-- ====================================================================================Modal -->
   <div class="modal fade" id="myModal333" role="dialog">
      <div class="modal-dialog delete-applications">
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <i data-dismiss="modal" class="close-box fa fa-times"></i><i ></i>                      
               <h1 class="modal-title"><i class="fas fa-ban trash-icon"></i>Block User</h1>
            </div>
            <div class="modal-body">
               <strong>Are you sure you wish to continue?</strong>
            </div>
            <div class="dual-footer-btn">
               <button type="button" class="btn btn-default black_btn" data-dismiss="modal"><i class="fa fa-times"></i>Cancel</button>
               <button type="button" class="orange_btn"><i class="fa fa-check"></i>OK</button>
            </div>
         </div>
      </div>
   </div>
   
</section>
{{-- html for job seekers details ends here --}}
@stop
@section('custom_footer_css')

@stop
@section('custom_js')

<script src="{{ asset('js/web/profile.js') }}"></script>
<script type="text/javascript">
   $(document).ready(function(){
   
    // ========== Function to show Block popup when click on ==========//
    $(document).on('click','#JSBlockBtn',function(){
        var jobseeker_id = $(this).data('jsid');
        console.log('jsBlockUserBtn click jobseeker_id = ', jobseeker_id);
        $('#jobSeekerBlockId').val(jobseeker_id);
        $('.double_btn').show();
    });
   
    // ========== Block Employer Ajax call  ==========//
    $(document).on('click','.ConfirmBlockJsInJsInfoPage',function(){
       console.log(' blockJsInJsInfoPage ');
       var jobseeker_id = $('#jobSeekerBlockId').val();
   
       $('.confirmJobSeekerBlockModal  .img_chat').html(getLoader('blockJobSeekerLoader'));
       var btn = $(this); //
       btn.prop('disabled',true);
   
       $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
       $.ajax({
           type: 'POST',
           url: base_url+'/ajax/blockJobSeeker/'+jobseeker_id,
           success: function(data){
               btn.prop('disabled',false);
               if( data.status == 1 ){
                   $('.confirmJobSeekerBlockModal .img_chat').html(data.message);
                   $('.jobSeeker_row.js_'+jobseeker_id).remove();
                   $('.double_btn').hide();
   
               }else{
                   $('.confirmJobSeekerBlockModal .img_chat').html(data.error);
               }
           }
       });
   });
   
   
   
   $('.cop_text').click(function (e) {
      e.preventDefault();
      var copyText = $('.seeCompletedReference').attr('href');
   
      document.addEventListener('copy', function(e) {
         e.clipboardData.setData('text/plain', copyText);
         e.preventDefault();
      }, true);
   
      document.execCommand('copy');
      console.log('Link Copied : ', copyText);
      alert('Link Copied: ' + copyText);
    });
   
   
   // ======================================== On Change button get interview templates ========================================
       
       $(document).on('click' , ".conductInterview", function(){ 
           var abcdrf = $('.jq-selectbox__select-text').text().trim();
           console.log(abcdrf);  
       });
   
       
   
   // ======================================== On Change button get interview templates ========================================
   
   
   });
</script>
@stop