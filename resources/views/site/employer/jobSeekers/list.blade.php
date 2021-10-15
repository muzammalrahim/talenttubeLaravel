<div class="row">
   <div class=" float-right pt-5">
      <a class="blue_btn jbtn btnBulkPDFGenerate float-right">Bulk Snap Shot</a>
   </div>
   @if ($jobSeekers && $jobSeekers->count() > 0)
   @foreach ($jobSeekers as $js)
   <input type="checkbox" name="cbx[]" value="{{ $js->id }}" style="width: 20px; padding-left: 30px!important;">
   {{--  
   <div class="jobSeeker_row dblock js_{{$js->id}} mb20 p20">
      <div class="jobSeeker_box relative dinline_block w100">
         @include('site.layout.parts.jobSeekerProfilePhotoBox')   
         @include('site.layout.parts.jobSeekerInfoBox')  
         <div class="jobApplicAction">
            @if (in_array($js->id,$likeUsers))
            <a class="active graybtn jbtn" data-jsid="{{$js->id}}">Liked</a>
            @else
            <a class="jsLikeUserBtn graybtn jbtn" data-jsid="{{$js->id}}">Like</a>
            @endif
            <a class="graybtn jbtn" href="{{route('jobSeekerInfo',['id'=>$js->id])}}" target="_blank">View Profile</a>
         </div>
      </div>
   </div>
   --}}
   <div class="col-sm-12 col-md-12">
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
            <h4 class="text-danger bold w50"> No Match Potential </h4>
            @else
            @if ($dist < 50 && !empty($ind_exp))
            <h4 class="text-green bold w50"> Strong Match Potential </h4>
            @elseif($dist < 50 )
            <h4 class="text-orange bold w50"> Moderate Match Potential  </h4>
            @elseif(!empty($ind_exp))
            <h4 class="text-orange w50"> Moderate Match Potential </h4>
            @else
            @php
            $check = true;
            @endphp
            <h4 class="text-danger bold w50"> No Match Potential </h4>
            @endif
            @endif                          
         </div>
         <div class="row Block-user-wrapper">
            <div class="col-md-4 user-images">
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
               </div>
               <div class="block-user-progress ">
                  <h6>{{$js->username}}</h6>
               </div>
            </div>
            <div class="col-md-8 user-details">
               <div class="w50 py-3">
                  <div id="piechart_{{$js->id}}"></div>
               </div>
               <script type="text/javascript">
                  google.charts.load('current', {'packages':['corechart']});
                  google.charts.setOnLoadCallback(drawChart);
                      function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                        ['Task', 'Potenial'],
                        ['Match', {{ $user_compat }}],
                        ['Unmatch',100-{{ $user_compat }}],
                      ]);
                    var options = { 'width':300, 'height':160};
                    var chart = new google.visualization.PieChart(document.getElementById('piechart_'+{{$js->id}}));
                    chart.draw(data, options);
                  }
                  
               </script>
               <div class="row blocked-user-about">
                  <h6>Recent job:</h6>
                  <p class="pl-2"><b>{{$js->recentJob}}</b> at <b>{{$js->organHeldTitle}}</b></p>
               </div>
               <div class="row blocked-user-about">
                  <h6>Qualificaton:</h6>
                  @php
                  $qualification_names =  getQualificationNames($js->qualification)
                  @endphp
                  @if(!empty($qualification_names))
                  <div class="font13"><i class="fas fa-angle-right qualifiCationBullet"></i>
                     Type:<span class="qualifTypeSpan">{{$js->qualificationType}}</span>
                  </div>
                  <ul>
                     @foreach ($qualification_names as $qnKey => $qnValue)
                     <li class="qualification">
                        <p>{{$qnValue}}</p>
                     </li>
                     @endforeach
                  </ul>
                  @endif
               </div>
               <div class="row blocked-user-about">
                  <h6>About Me:</h6>
                  <p class="pl-2">{{$js->about_me}}</p>
               </div>
               <div class="row blocked-user-about">
                  <h6>Intrested In:</h6>
                  <p class="pl-2">{{$js->interested_in}}</p>
               </div>
               <div class="row blocked-user-about">
                  <h6>Sallary Range:</h6>
                  <p class="pl-2">{{getSalariesRangeLavel($js->salaryRange)}}</p>
               </div>
               <div class="row blocked-user-about">
                  <h6>Location:</h6>
                  <p class="pl-2">{{userLocation($js)}}</p>
               </div>
               <div class="row blocked-user-experience">
                  <h6>Industory Experience:</h6>
                  @if(isset($js->industry_experience))
                  <ul>
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
            <div class=" employe-btn-group">
               @if (in_array($js->id,$likeUsers))
               <button class="like-btn"><i class="fas fa-thumbs-up"></i> Like</button>
               @else
               <button class="like-btn"><i class="fas fa-thumbs-up"></i> Liked</button>
               @endif
               <button class="detail-btn"><i class="fas fa-file-alt"></i> View profile</button>
            </div>
         </div>
      </div>
   </div>
   @endforeach
   <div class="jobseeker_pagination cpagination mb20">{!! $jobSeekers->render() !!}</div>
   @endif
</div>