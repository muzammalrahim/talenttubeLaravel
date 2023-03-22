{{-- emloyers page new html --}}
<div class="row">
   @if(isset($employers))
   @if ($employers->count() > 0)
   @foreach ($employers as $js)
   <div class="col-sm-12 col-md-12 js_{{ $js->id }}">
      <div class="job-box-info block-box clearfix">
         <div class="box-head">
            

            {{-- ============================================= Match Potential =============================================  --}}

            {{-- @include('web.piechart.match_potential')   --}}

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
            
            {{-- ============================================= Match Potential =============================================  --}}

         </div>
         
         <div class="row Block-user-wrapper">
            <div class="col-md-2 user-images">
               <div class="block-user-img mx-auto float-none border-0">
                  @php
                  $profile_image  = asset('images/site/icons/nophoto.jpg');
                  $profile_image_gallery    = $js->profileImage()->first();
                  if ($profile_image_gallery) {
                     $profile_image   = assetGallery2($profile_image_gallery,'small');
                  }
                  @endphp
                  <img src="{{$profile_image}}" alt="" >
               </div>

               <div class="block-user-progresss d-none d-sm-block">
                  <h6 class="pl-1 mt-1">{{$js->company}}</h6>
               </div>
            </div>

            <div class="progress-img d-block d-sm-none mt-3"> 
               <h6 class="text-center">{{$js->company}}</h6>
               <div class="block-progrees-ratio1 d-md-block">
               <ul>
               <li><span class="Progress-ratio-icon1">.</span> <span> {{ $user_compat }} % </span> Match </li>
               <li><span class="Progress-ratio-icon2">.</span> <span> {{ 100-$user_compat }} % </span> Un-Matched</li>
               </ul>
               </div>
              
            </div>
            <div class="col-md-10 user-details">
               
               {{-- ============================================= Pie Chart =============================================  --}}
               <div class="d-sm-block d-none"> 
               @include('web.piechart.pie_chart') {{-- web/piechart/pie_chart --}}
               </div>

               {{-- ============================================= Pie Chart =============================================  --}}

               <div class="row blocked-user-about pl-3">
                  <h6 class="p-0">About me:</h6>
                  <p class="">{{$js->about_me}}</p>
               </div>
               <div class="row blocked-user-about pl-3 mt-2">
                  <h6 class="p-0">Interested In:</h6>
                  <p class="">{{$js->interested_in}}</p>
               </div>
               <div class="row blocked-user-about pl-3 mt-2">
                  <h6 class="p-0">Location:</h6>
                  <p class="">{{$js->city}},  {{$js->state}}, {{$js->country}}</p>
               </div>
               <div class="row blocked-user-experience pl-3 mt-2">
                  <h6 class="p-0">Industry Experience :</h6>
                  @if(isset($js->industry_experience))
                  <ul class="p-0">
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
            <div class=" employe-btn-group" style="float: right !important; width: 100%!important;">
               <!-- <div class="block-div"> -->
                  <button class="block-btn" onclick="blockEmployerFunction('{{ $js->id }}')"><i class="fas fa-ban"></i> Block</button>
               <!-- </div> -->
               <a href="{{route('employerInfo', ['id' => $js->id])}}"><button class="detail-btn float-right"><i class="fas fa-file-alt"></i> Details</button></a>
               @if (in_array($js->id,$likeUsers))
               <div class="unlike-div" style="display: contents;">
                  <button class="unlike-btn" onclick="unlikefunction('{{ $js->id }}')" data-toggle="modal" data-target="#unlikeModal"><i class="fas fa-thumbs-up"> </i> UnLike</button>
               </div>
               @else
                  <div class="like-div" style="display: contents;">
                     <button class="like-btn" onclick="likeFunction('{{ $js->id }}')" data-jsid = "{{ $js->id }}"><i class="fas fa-thumbs-up"></i> Like</button> 
                  </div>
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

@include('web.modals.unblockEmployer')

