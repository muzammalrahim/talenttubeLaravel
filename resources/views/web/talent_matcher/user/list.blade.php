<div class="row">
   @php
   $check = false;
   @endphp

   @if ($query && $query->count() > 0)
   @foreach ($query as $js) 
   @php
   $dist = calculate_distance($js, $user);
   $ind_exp = cal_ind_exp($js,$user);
   $compatibility = compatibility($js, $user); 
   $user_compat = $compatibility*20;
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
   @if ($dist < 50 && !empty($ind_exp))
   @php
   $check = true;
   @endphp
   @endif

   {{-- @dd('coming here') --}}
   
   @if ($check)
   <div class="col-sm-12 col-md-6">
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
            {{-- @dump($emp_resident) --}}
            @if ($emp_resident == 'no' && $user_resident == 'no')
            <h4 class="text-danger bold "> No Match Potential </h4>
            @else
            @if ($dist < 50 && !empty($ind_exp))
            <h4 class="text-green bold "> Strong Match Potential </h4>
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
         <div class="row Block-user-wrapper ">
            <div class="col-md-4 user-images " >
               {{-- @dump($js->vidoes) --}}
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
               <div class="block-user-img  d-flex">
                  <img src="{{$profile_image}}" alt="" >
               </div>
               <div class="block-user-progress " >
                  <h6> {{ $js->company }} </h6>
               </div>
            </div>
            <div class="col-md-8 user-details">
               <div class="progress-img">
                  {{-- ============================================= Pie Chart =============================================  --}}
                  {{--  @include('site.talent_matcher.algo')  --}}{{-- site/talent_matcher/algo --}}
                  <div class="w50">
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
                  {{-- ============================================= Pie Chart =============================================  --}}
               </div>
               @if (isEmployer())
               <div class="row blocked-user-about">
                  <h6>Recent Job:</h6>
                  <span>{{$js->recentJob}}<b> at </b>{{$js->organHeldTitle}}</span>
               </div>
               <div class="row blocked-user-about">
                  <h6>Qualification:</h6>
                  @php
                  $qualification_names =  getQualificationNames($js->qualification)
                  @endphp
                  @if(!empty($qualification_names))
                  <div>
                     Type:<span class="qualifTypeSpan">{{$js->qualificationType}}</span>
                  </div>
                  <ul>
                     @foreach ($qualification_names as $qnKey => $qnValue)
                     <span >
                        <li>{{$qnValue}}</li>
                     </span>
                     @endforeach
                  </ul>
                  @endif
               </div>
               @endif
               <div class="row blocked-user-about">
                  <h6>About Me:</h6>
                  <span>{{$js->about_me}}</span>
               </div>
               <div class="row blocked-user-about">
                  <h6>Intrested In:</h6>
                  <span>{{$js->interested_in}}</span>
               </div>
               <div class="row blocked-user-about">
                  <h6>Sallary Range:</h6>
                  <p>{{getSalariesRangeLavel($js->salaryRange)}}</p>
               </div>
               @if (isEmployer())
               {{-- expr --}}
               <div class="row blocked-user-experience">
                  <h6>Industory Experience:</h6>
                  @if(isset($js->industry_experience))
                  @foreach ($js->industry_experience as $ind)
                  <ul class="indsutrySelect">
                     <li> <span>{{getIndustryName($ind)}}</span></li>
                  </ul>
                  @endforeach
                  @endif
               </div>
               @endif
            </div>
         </div>
         <div class="box-footer unlike-btn-group clearfix">
            <div class="block-progrees-ratio d-none d-md-block user-page-footer">
               {{-- 
               <ul>
                  <li><span class="Progress-ratio-icon1">.</span> <span>60%</span> Match </li>
                  <li><span class="Progress-ratio-icon2">.</span> <span>40%</span> UnMatch</li>
               </ul>
               --}}
            </div>
            @if (in_array($js->id,$likeUsers))
            <button class="unlike-btn" data-jsid="{{$js->id}}"><i class="fas fa-thumbs-up"></i>Liked</button>
            @else
            <button class="unlike-btn" data-jsid="{{$js->id}}"><i class="fas fa-thumbs-up"></i> Like</button> 
            @endif
            <a  href="{{route('jobSeekerInfo',['id'=>$js->id])}}" target="_blank"><button class="block-btn"><i class="fas fa-eye"></i> View profile</button> </a>                  
         </div>
      </div>
   </div>
   @endif
   @php
   $check = false;
   @endphp
   @endforeach
   {{-- 
   <div class="jobseeker_pagination cpagination mb20">{!! $query->onEachSide(0)->links() !!}</div>
   --}}
   @endif
</div>