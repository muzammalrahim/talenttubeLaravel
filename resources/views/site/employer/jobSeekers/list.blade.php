


<div class="row">
   <div class=" float-right pt-lg-5">
      <a class="blue_btn jbtn btnBulkPDFGenerate float-right">Bulk Snap Shot</a>
   </div>
   @if ($jobSeekers && $jobSeekers->count() > 0)
   @foreach ($jobSeekers as $js)

   <input type="checkbox" name="cbx[]" value="{{ $js->id }}" style="width: 20px; margin-left: 13px!important;">
   

   <div class="col-sm-12 col-md-12 js_{{ $js->id }}" id="scrollTop1">
      <div class="job-box-info block-box clearfix">
         <div class="box-head">
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
            @if ($emp_resident == 'no' && $user_resident == 'no')
            <h4 class="text-danger bold "> No Match Potential </h4>
            @else
            @if ($dist < 50 && !empty($ind_exp))
            <h4 class="text-green bold"> Strong Match Potential </h4>
            @elseif($dist < 50 )
            <h4 class="text-orange bold "> Moderate Match Potential  </h4>
            @elseif(!empty($ind_exp))
            <h4 class="text-orange "> Moderate Match Potential </h4>
            @else
            @php
            $check = true;
            @endphp
            <h4 class="text-danger bold "> No Match Potential </h4>
            @endif
            @endif                          
         </div>
         <div class="row Block-user-wrapper">
            
            <div class="col-md-2">
               <div class="d-none d-md-block  user-images">
                  <div class="block-user-img">
                     @php
                     $profile_image  = asset('images/site/icons/nophoto.jpg');
                     $profile_image_gallery    = $js->profileImage()->first();
                     if ($profile_image_gallery) {
                     $profile_image   = assetGallery2($profile_image_gallery,'small');
                     }
                     @endphp
                     <img src="{{$profile_image}}" class="w-75" alt="" >
                  </div>
                  
                  <div class="block-user-progress ">
                     <h6 class="text-start">{{$js->username}}</h6>


                     {{-- <div class="progress-img"> 
                        <img src="assests/images/user-progressbar.svg" alt="">
                     </div> --}}
                     <div class="text-center">
                        
                        @if($js->vidoes->count() > 0)
                        <i class="fas fa-video js_video_link pointer fa-2x text-center" onclick="showVideoModalFunction('{{assetVideo($js->vidoes->first())}}')" data-bs-target="#videoShowModal" data-bs-toggle="modal" target="_blank" style="color: #00326F; cursor: pointer;">
                        </i>
                     </div>
                     @endif
                  </div>
               </div>

               {{-- mobile view --}}
               <div class="d-block d-md-none">
                  <div class="d-flex justify-content-between">
                     <div class="w-75">
                        <h2 class="text-start">{{$js->username}}</h2>
                     </div>


                     {{-- <div class="progress-img"> 
                        <img src="assests/images/user-progressbar.svg" alt="">
                     </div> --}}
                     <div>
                        
                        @if($js->vidoes->count() > 0)
                        <i class="fas fa-video js_video_link pointer fa-2x text-center" onclick="showVideoModalFunction('{{assetVideo($js->vidoes->first())}}')" data-bs-target="#videoShowModal" data-bs-toggle="modal" target="_blank" style="color: #00326F; cursor: pointer;">
                        </i>
                     </div>
                     @endif
                  </div>
                  <div class="block-user-img mx-auto float-none border-0">
                     @php
                     $profile_image  = asset('images/site/icons/nophoto.jpg');
                     $profile_image_gallery    = $js->profileImage()->first();
                     if ($profile_image_gallery) {
                     $profile_image   = assetGallery2($profile_image_gallery,'small');
                     }
                     @endphp
                     <img src="{{$profile_image}}" class="w-75" alt="" >
                  </div>
                  
               </div>
            </div>
            
            <div class="col-md-9 col-lg-10 user-details">

               {{-- ================================= Show video =================================  --}}


               {{-- ============================================= Pie Chart =============================================  --}}

               {{-- @include('web.piechart.pie_chart') --}}

               {{-- ============================================= Pie Chart =============================================  --}}

               <div class="row blocked-user-about mt-2">
                  <h6 class="p-0">Recent job:</h6>
                  <p class=""><b>{{$js->recentJob}}</b> at <b>{{$js->organHeldTitle}}</b></p>
               </div>
               <div class="row blocked-user-about mt-2">
                  <h6 class="p-0">Qualificatons:</h6>
                  @php
                  $qualification_names =  getQualificationNames($js->qualification)
                  @endphp
                  @if(!empty($qualification_names))
                  
                  {{-- <h6 class="p-0">Qualification:</h6> --}}
                  <p><span><b>Type:</b></span> 
                  
                     <span class="text-capitalize">  {{ str_replace( '_', ' ', $js->qualificationType )}} </span>

                  </p>

                  <ul class="p-0">
                     @foreach ($qualification_names as $qnKey => $qnValue)
                     {{-- <li class="qualification"> --}}
                        <p>{{$qnValue}}</p>
                     {{-- </li> --}}
                     @endforeach
                  </ul>
                  @endif
               </div>
               <div class="row blocked-user-about mt-2">
                  <h6 class="p-0">About Me:</h6>
                  <p class="">{{$js->about_me}}</p>
               </div>
               <div class="row blocked-user-about mt-2">
                  <h6 class="p-0">Interested In:</h6>
                  <p class="">{{$js->interested_in}}</p>
               </div>
               <div class="row blocked-user-about mt-2">
                  <h6 class="p-0">Salary Range:</h6>
                  <p class="">{{getSalariesRangeLavel($js->salaryRange)}}</p>
               </div>
               <div class="row blocked-user-about mt-2">
                  <h6 class="p-0">Location:</h6>
                  <p class="">{{userLocation($js)}}</p>
               </div>
               <div class="row blocked-user-experience mt-2" >
                  <h6 class="p-0">Industry Experience:</h6>
                  @if(isset($js->industry_experience))
                  <ul class="p-0">
                     @foreach ($js->industry_experience as $ind)
                     <div class="indsutrySelect">
                        <li>
                           <p>{{getIndustryName($ind)}}</p>
                        </li>
                     </div>
                     @endforeach
                  </ul>
                  @endif
               </div>
            </div>
         </div>
         <div class="box-footer1 box-footer  clearfix">
     


            <div class="block-progrees-ratio1 d-none d-md-block">
              <ul>
                <li><span class="Progress-ratio-icon1">.</span> <span> {{ $user_compat }}% </span> Match </li>
                <li><span class="Progress-ratio-icon2">.</span> <span> {{ 100-$user_compat }}% </span> Un-Matched</li>
              </ul>
            </div>

            <div class="employe-btn-group">
               {{-- @dump($likeUsers) --}}
               @if (in_array($js->id,$likeUsers))
               <div class="unlike-div ">
                  <button class="unlike-btn ml-2" onclick="unlikefunction('{{ $js->id }}')" data-toggle="modal" data-target="#unlikeModal"><i class="fas fa-thumbs-down"> </i> UnLike</button>
               </div>
               @else
                  <div class="like-div">
                     <button class="like-btn scd-like-btn" onclick="likeFunction('{{ $js->id }}')" data-jsid = "{{ $js->id }}"><i class="fas fa-thumbs-up"></i> Like</button> 
                  </div>
               @endif

               <div class="block-div">
                  <button class="block-btn" onclick="blockFunction('{{ $js->id }}')"><i class="fas fa-ban"></i> Block</button>
               </div>

               <a href="{{ route('jobSeekerInfo', ['id'=> $js->id]) }}" target="_blank">
                  <button class="detail-btn px-1"><i class="fas fa-file-alt"></i> View profile</button>
               </a>
            </div>
         </div>
      </div>
   </div>
   @endforeach

   


   <div class="jobseeker_pagination cpagination mb20">{!! $jobSeekers->render() !!}</div>
   @endif 
</div>



