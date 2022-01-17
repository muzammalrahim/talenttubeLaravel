{{-- @extends('site.user.usertemplate') --}}
{{-- 
@if ($controlsession->count() > 0)
<div class="adminControl">
   <p>You are in control of <span class="bold">{{$user->name}} </span>, click <a href="{{ route('logoutRouteForAdmin') }}" class="adminLogin" > HERE </a> to end control</p>
</div>
@endif
--}}
@extends('web.user.usermaster')
@section('custom_css')
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
@stop
@section('content')
<section class="row">
   <div class="col-md-12">
   @if ($likeUsers->count() > 0)
   <div class="profile profile-section">
      <h2>Like Users Lists</h2>
      <div class="row">
         @foreach ($likeUsers as $likeuser)
         @php
         // @dd($likeuser)
         $js = $likeuser->user;
         @endphp
         <div class="col-sm-12 col-md-12 removeJs_{{$js->id}}">
            <div class="job-box-info block-box clearfix">
               <div class="box-head">
                  <h4>{{$js->name}} {{$js->surname}}</h4>
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
                        <img src="{{$profile_image}}" alt="">
                     </div>
                     <div class="block-user-progress ">
                        <h6 class="p-0">{{$js->name}} {{$js->surname}}</h6>
                     </div>
                  </div>
                  <div class="col-md-10 user-details">
                     <div class="row blocked-user-about mt-2">
                        <h6 class="p-0">About me:</h6>
                        <p>{{$js->about_me}}.</p>
                     </div>
                     <div class="row blocked-user-about mt-2">
                        <h6 class="p-0">Intrested In:</h6>
                        <p>{{$js->interested_in}}</p>
                     </div>
                     <div class="row blocked-user-about mt-2">
                        <h6 class="p-0">Location:</h6>
                        <p>{{$js->city}},  {{$js->state}}, {{$js->country}}</p>
                     </div>
                     <div class="row blocked-user-experience mt-2">
                        <h6 class="p-0">Industory Experience:</h6>
                        @if(isset($js->industry_experience))
                        @foreach ($js->industry_experience as $ind)
                        <ul class="indsutrySelect p-0">
                           <li>
                              <p>{{getIndustryName($ind)}}</p>
                           </li>
                        </ul>
                        @endforeach
                        @endif
                     </div>
                  </div>
               </div>
               <div class="box-footer unlike-btn-group clearfix">
                  <div class="block-progrees-ratio d-none d-md-block user-page-footer">
                     {{-- <ul>
                        <li><span class="Progress-ratio-icon1">.</span> <span>60%</span> Match </li>
                        <li><span class="Progress-ratio-icon2">.</span> <span>40%</span> UnMatch</li>
                     </ul> --}}
                  </div>
                  <button class="unlike-btn" onclick="unlikefunction('{{ $js->id }}')" data-toggle="modal" data-target="#unlikeModal"><i class="fas fa-thumbs-down"></i> UnLike</button> 
                  <a  href="{{route('jobSeekerInfo', ['id' => $js->id])}}"><button class="block-btn "> View Profile</button></a>                     
               </div>
            </div>
         </div>
         @endforeach
      </div>
   </div>
   @else
   <h3>You have not liked anyone</h3>
   @endif
</section>
{{-- modal for unlike user of like page --}}
<!-- ====================================================================================Modal -->

@include('web.modals.unlike')

{{-- Updated html for like user page end  --}}
@stop
@section('custom_footer_css')
@stop
@section('custom_js')
<script src="{{ asset('js/web/profile.js') }}"></script>

{{-- <script src="{{ asset('js/site/common.js') }}"></script> --}}

@stop