{{-- emloyers page new html --}}
<div class="row">
   @if(isset($employers))
   @if ($employers->count() > 0)
   @foreach ($employers as $js)
   <div class="col-sm-12 col-md-12">
      <div class="job-box-info block-box clearfix">
         <div class="box-head">
            @php
            $dist = calculate_distance($js, $user);
            $ind_exp = cal_ind_exp($js,$user);
            $compatibility = compatibility($js, $user); 
            $user_compat = $compatibility*20;
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
            {{-- <div class="text-danger bold w50"> No Match Potential </div> --}}
            <h4 class="text-danger bold"> No Match Potential </h4>

            @else
            @if ($dist < 50 && !empty($ind_exp))
            <h4 class="text-green bold "> Strong Match Potential </h4>
            @elseif($dist < 50 )
            <h4 class="text-orange bold "> Moderate Match Potential  </h4>
            @elseif(!empty($ind_exp))
            <h4 class="text-orange "> Moderate Match Potential </h4>
            @else
            <h4 class="text-danger bold"> No Match Potential </h4>
            @endif
            @endif                          
         </div>
         <div class="row Block-user-wrapper">
            <div class="col-md-2 user-images">
               <div class="block-user-img ">
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
                  <img src="{{$profile_image}}" alt="" >
               </div>
               <div class="block-user-progress ">
                  <h6>{{$js->name}} {{$js->company}}</h6>
               </div>
            </div>
            <div class="col-md-10 user-details">
               {{-- ============================================= Pie Chart =============================================  --}}
               {{-- @include('site.user.match_algo.match_algo')    site/user/match_algo/match_algo --}} 
               <div class="pb-4" style="width:310px">
                  <div  id="piechart_{{$js->id}}" class="job-box-info"></div>
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
                    var options = { 'width':305, 'height':160};
                    var chart = new google.visualization.PieChart(document.getElementById('piechart_'+{{$js->id}}));
                    chart.draw(data, options);
                  }
               </script>
               {{-- ============================================= Pie Chart =============================================  --}}
               <div class="row blocked-user-about">
                  <h6>About me:</h6>
                  <p class="pl-3">{{$js->about_me}}</p>
               </div>
               <div class="row blocked-user-about">
                  <h6>Intrested In:</h6>
                  <p class="pl-3">{{$js->interested_in}}</p>
               </div>
               <div class="row blocked-user-about">
                  <h6>Location:</h6>
                  <p class="pl-3">{{$js->city}},  {{$js->state}}, {{$js->country}}</p>
               </div>
               <div class="row blocked-user-experience">
                  <h6>Industory Experience:</h6>
                  @if(isset($js->industry_experience))
                  <ul>
                     @foreach ($js->industry_experience as $ind) 
                     <li>
                        <p>{{getIndustryName($ind)}}</p>
                     </li>
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
               <button class="block-btn" onclick="blockFunction('{{ $js->id }}')"><i class="fas fa-ban"></i> Block</button>
               <a href="{{route('employerInfo', ['id' => $js->id])}}"><button class="detail-btn"><i class="fas fa-file-alt"></i> Detail</button></a>
               @if (in_array($js->id,$likeUsers))            
               <button class="like-btn"><i class="fas fa-thumbs-up"></i> Liked</button>
               @else
               <button class="like-btn likeFunction" data-jsid="{{ $js->id }}"><i class="fas fa-thumbs-up"></i> Like</button>
               @endif
            </div>
         </div>
      </div>
   </div>
   @endforeach
   <div class="jobseeker_pagination cpagination">{!! $employers->render() !!}</div>
   @endif
   @endif 
</div>