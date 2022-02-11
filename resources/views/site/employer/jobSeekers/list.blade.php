


<div class="row">
   <div class=" float-right pt-lg-5">
      <a class="blue_btn jbtn btnBulkPDFGenerate float-right">Bulk Snap Shot</a>
   </div>
   @if ($jobSeekers && $jobSeekers->count() > 0)
   @foreach ($jobSeekers as $js)

   <input type="checkbox" name="cbx[]" value="{{ $js->id }}" style="width: 20px; margin-left: 13px!important;">
   

   <div class="col-sm-12 col-md-12 js_{{ $js->id }}">
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
            <div class="col-md-3 col-lg-2 user-images">
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
               <div class="block-user-img ">
                  <img src="{{$profile_image}}" alt="">
																		<h6 class="py-2">{{$js->username}}</h6>
               </div>
               <div class="block-user-progress ">
                 
               </div>
            </div>
            <div class="col-md-9 col-lg-10 user-details">

               {{-- ============================================= Pie Chart =============================================  --}}

               @include('web.piechart.pie_chart')

               {{-- ============================================= Pie Chart =============================================  --}}

               <div class="row blocked-user-about mt-2">
                  <h6 class="p-0">Recent job:</h6>
                  <p class=""><b>{{$js->recentJob}}</b> at <b>{{$js->organHeldTitle}}</b></p>
               </div>
               <div class="row blocked-user-about mt-2">
                  <h6 class="p-0">Qualificaton:</h6>
                  @php
                  $qualification_names =  getQualificationNames($js->qualification)
                  @endphp
                  @if(!empty($qualification_names))
                  
                  {{-- <h6 class="p-0">Qualification:</h6> --}}
                  <p><span><b>Type:</b></span>{{$js->qualificationType}}</p>

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
                  <h6 class="p-0">Intrested In:</h6>
                  <p class="">{{$js->interested_in}}</p>
               </div>
               <div class="row blocked-user-about mt-2">
                  <h6 class="p-0">Sallary Range:</h6>
                  <p class="">{{getSalariesRangeLavel($js->salaryRange)}}</p>
               </div>
               <div class="row blocked-user-about mt-2">
                  <h6 class="p-0">Location:</h6>
                  <p class="">{{userLocation($js)}}</p>
               </div>
               <div class="row blocked-user-experience mt-2" >
                  <h6 class="p-0">Industory Experience:</h6>
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
            </div>
            <div class="employe-btn-group">
               {{-- @dump($likeUsers) --}}
               @if (in_array($js->id,$likeUsers))
               <div class="unlike-div ">
                  <button class="unlike-btn ml-2" onclick="unlikefunction('{{ $js->id }}')" data-toggle="modal" data-target="#unlikeModal"><i class="fas fa-thumbs-up"> </i> UnLike</button>
               </div>
               @else
                  <div class="like-div">
                     <button class="like-btn scd-like-btn" onclick="likeFunction('{{ $js->id }}')" data-jsid = "{{ $js->id }}"><i class="fas fa-thumbs-up"></i> Like</button> 
                  </div>
               @endif

               <a href="{{ route('jobSeekerInfo', ['id'=> $js->id]) }}" target="_blank">
                  <button class="detail-btn"><i class="fas fa-file-alt"></i> View profile</button>
               </a>
            </div>
         </div>
      </div>
   </div>
   @endforeach
   <div class="jobseeker_pagination cpagination mb20">{!! $jobSeekers->render() !!}</div>
   @endif
</div>