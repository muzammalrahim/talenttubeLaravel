<div class="row mx-0">
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

   if ($emp_resident == 'no' && $user_resident == 'no') {
      $check = false;
   }
   else if($dist < 50 && !empty($ind_exp)) {
      $check = true;
      $html = '<h4 class="text-green bold "> Strong Match Potential </h4>';
   }
   else if($dist < 50 ) {
      $check = true;
      $html = '<h4 class="text-orange bold "> Moderate Match Potential  </h4>';

   }
   else if(!empty($ind_exp)){
      $check = true;
      $html = '<h4 class="text-orange bold "> Moderate Match Potential  </h4>';
   }
   else{
      $check = false;
   }


   @endphp
 
   {{-- @dd('coming here') --}}
   
   @if ($check)
   <div class="col-sm-12 col-md-12 js_{{ $js->id }} mx-0 px-0">
      <div class="job-box-info block-box clearfix mx-0">
         <div class="box-head">
            {!! $html !!}
         </div>
         <div class="row Block-user-wrapper ">
            <div class="col-md-2 user-images " >
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
               <div class="block-user-img ">
                  <img src="{{$profile_image}}" alt="" >
																		<h6 class="py-2"> {{ $js->company }} </h6>
               </div>
               <div class="block-user-progress " >
                 
               </div>
            </div>
            <div class="col-md-10 user-details">
               <div class="progress-img">
                  {{-- ============================================= Pie Chart =============================================  --}}
                  {{--  @include('site.talent_matcher.algo')  --}}{{-- site/talent_matcher/algo --}}
                  {{-- <div class="w50"> --}}
                  <div class="pb-4" style="width:290px; margin-left:-58px;">

                     <div id="piechart_{{$js->id}}" class="job-box-info" style="transform:scale(0.7);"></div>
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
                       var options = { 'width':285, 'height':160 ,tooltip: { isHtml: true },};
                       var chart = new google.visualization.PieChart(document.getElementById('piechart_'+{{$js->id}}));
                       chart.draw(data, options);
                     }
                     
                  </script>
                  {{-- ============================================= Pie Chart =============================================  --}}
               </div>
               @if (isEmployer())
                  <div class="row blocked-user-about mt-2">
                     <h6 class="p-0">Recent Job:</h6>
                     <p>{{$js->recentJob}}<b> at </b>{{$js->organHeldTitle}}</p>
                  </div>
                  <div class="row blocked-user-about mt-2">
                     <h6 class="p-0">Qualificaton:</h6>
                     @php
                     $qualification_names =  getQualificationNames($js->qualification)
                     @endphp
                     @if(!empty($qualification_names))
                     <div class="font13"><i class="fas fa-angle-right qualifiCationBullet"></i>
                        Type:<span class="qualifTypeSpan">{{$js->qualificationType}}</span>
                     </div>
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
                     <h6 class="p-0">Sallary Range:</h6>
                     <p>{{getSalariesRangeLavel($js->salaryRange)}}</p>
                  </div>
               @endif
               <div class="row blocked-user-about mt-2">
                  <h6 class="p-0">About Me:</h6>
                  <p>{{$js->about_me}}</p>
               </div>
               <div class="row blocked-user-about mt-2">
                  <h6 class="p-0">Intrested In:</h6>
                  <p>{{$js->interested_in}}</p>
               </div>
               
               <div class="row blocked-user-experience mt-2">
                  <h6 class="p-0">Industory Experience:</h6>
                  @if(isset($js->industry_experience))
                  @foreach ($js->industry_experience as $ind)
                  <ul class="indsutrySelect p-0">
                     <li> <p>{{getIndustryName($ind)}}</p></li>
                  </ul>
                  @endforeach
                  @endif
               </div>
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
            {{-- @if (in_array($js->id,$likeUsers))
            <button class="unlike-btn" onclick="unlikefunction('{{ $js->id }}')" data-toggle="modal" data-target="#unlikeModal"><i class="fas fa-thumbs-up"></i>UnLike</button>
            @else
            <button class="like-btn" data-jsid = "{{ $js->id }}"><i class="fas fa-thumbs-up"></i> Like</button> 
            @endif
            <a  href="{{route('jobSeekerInfo',['id'=>$js->id])}}" target="_blank"><button class="block-btn"><i class="fas fa-eye"></i> View profile</button> </a>  --}}

            @if (in_array($js->id,$likeUsers))
               <div class="unlike-div">
                  <button class="unlike-btn" onclick="unlikefunction('{{ $js->id }}')" data-toggle="modal" data-target="#unlikeModal"><i class="fas fa-thumbs-up"> </i> UnLike</button>
               </div>
            @else
               <div class="like-div">
                  <button class="like-btn" onclick="likeFunction('{{ $js->id }}')" data-jsid = "{{ $js->id }}"><i class="fas fa-thumbs-up"></i> Like</button> 
               </div>
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

@include('web.modals.unlike')



{{ $query->onEachSide(1)->links() }}


@section('custom_js')
   <script src="{{ asset('js/web/profile.js') }}"></script>
@stop