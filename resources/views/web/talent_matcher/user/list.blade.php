<div class="row m-0">
   
   {{-- @dd($query) --}}

   @if ($query)
   @foreach ($query as $js) 
   
   <div class="col-sm-12 col-md-12 js_{{ $js['id']->id }}">
      <div class="job-box-info block-box clearfix">
         <div class="box-head">
            {!! $js['html'] !!}
         </div>
         <div class="row Block-user-wrapper ">
            <div class="col-md-2 user-images " >
               {{-- @dump($js->vidoes) --}}
               @php
               $profile_image  = asset('images/site/icons/nophoto.jpg');
               $profile_image_gallery    = $js['id']->profileImage()->first();
               // dump($profile_image_gallery);
               if ($profile_image_gallery) {
               // $profile_image   = assetGallery($profile_image_gallery->access,$js->id,'',$profile_image_gallery->image);
               $profile_image   = assetGallery2($profile_image_gallery,'small');
               // dump($profile_image);
               }
               @endphp
               <div class="block-user-img mx-auto float-none border-0">
                  <img src="{{$profile_image}}" alt="" >
               </div>
               {{-- <div class="block-user-progress " >
                  <h6> {{ $js['id']->company }} </h6>
               </div> --}}
            </div>
            <div class="col-md-10 user-details">
               {{-- <div class="progress-img"> --}}
                  
                  {{-- ============================================= Pie Chart =============================================  --}}

                  {{-- @include('web.piechart.pie_chart') --}}

                  {{-- ============================================= Pie Chart =============================================  --}}

               {{-- </div> --}}
               
               @if (isEmployer())
                  <div class="row blocked-user-about mt-2">
                     <h6 class="p-0">Recent Job:</h6>
                     <p class="bold">{{$js['id']->recentJob}} at {{$js['id']->organHeldTitle}}</p>
                  </div>
                  <div class="row blocked-user-about mt-2">
                     <h6 class="p-0">Qualifications:</h6>
                     @php
                     $qualification_names =  getQualificationNames($js['id']->qualification)
                     @endphp
                     @if(!empty($qualification_names))
                     <div class="font13"><i class="fas fa-angle-right qualifiCationBullet"></i>
                        Type:<span class="qualifTypeSpan">{{$js['id']->qualificationType}}</span>
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
                     <h6 class="p-0">Salary Range:</h6>
                     <p>{{getSalariesRangeLavel($js['id']->salaryRange)}}</p>
                  </div>
               @endif
               <div class="row blocked-user-about mt-2">
                  <h6 class="p-0">About Me:</h6>
                  <p>{{$js['id']->about_me}}</p>
               </div>
               <div class="row blocked-user-about mt-2">
                  <h6 class="p-0">Interested In:</h6>
                  <p>{{$js['id']->interested_in}}</p>
               </div>
               
               <div class="row blocked-user-experience mt-2">
                  <h6 class="p-0">Industry:</h6>
                  @if(isset($js['id']->industry_experience))
                  @foreach ($js['id']->industry_experience as $ind)
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
               
               <ul>
                <li><span class="Progress-ratio-icon1">.</span> <span> {{ $js['user_compat'] }}% </span> Match </li>
                <li><span class="Progress-ratio-icon2">.</span> <span> {{ 100-$js['user_compat'] }}% </span> Un-Matched </li>
              </ul>              
            </div>
            {{-- @if (in_array($js->id,$likeUsers))
            <button class="unlike-btn" onclick="unlikefunction('{{ $js->id }}')" data-toggle="modal" data-target="#unlikeModal"><i class="fas fa-thumbs-up"></i>UnLike</button>
            @else
            <button class="like-btn" data-jsid = "{{ $js->id }}"><i class="fas fa-thumbs-up"></i> Like</button> 
            @endif
            <a  href="{{route('jobSeekerInfo',['id'=>$js->id])}}" target="_blank"><button class="block-btn"><i class="fas fa-eye"></i> View profile</button> </a>  --}}

            @if (in_array($js['id']->id,$likeUsers))
               <div class="unlike-div">
                  <button class="unlike-btn me-1" onclick="unlikefunction('{{ $js['id']->id }}')" data-toggle="modal" data-target="#unlikeModal"><i class="fas fa-thumbs-up"> </i> UnLike</button>
               </div>
            @else
               <div class="like-div">
                  <button class="like-btn" onclick="likeFunction('{{ $js['id']->id }}')" data-jsid = "{{ $js['id']->id }}"><i class="fas fa-thumbs-up"></i> Like</button> 
               </div>
            @endif
            @if (isEmployer())
               {{-- expr --}}
               <a  href="{{route('jobSeekerInfo',['id'=>$js['id']->id])}}" target="_blank"><button class="block-btn px-1"><i class="fas fa-eye"></i> View profile</button> </a> 
            @else
               <a  href="{{route('employerInfo',['id'=>$js['id']->id])}}" target="_blank"><button class="block-btn px-1"><i class="fas fa-eye"></i> View profile</button> </a> 
            @endif

         </div>
      </div>
   </div>
   @endforeach
   
   {{-- <div class="jobseeker_pagination cpagination mb20">{!! $query->onEachSide(0)->links() !!}</div> --}}
  
   @endif
</div>

@include('web.modals.unlike')



{{ $query->links() }}


@section('custom_js')
   <script src="{{ asset('js/web/profile.js') }}"></script>
@stop


