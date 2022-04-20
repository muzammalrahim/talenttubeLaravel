
@extends('web.user.usermaster')

@section('custom_css')

@stop

@section('content')

<section class="row">
   <div class="col-md-12">
      <h2>Like Users Lists</h2>
   @if ($likeUsers->count() > 0)
   <div class="profile profile-section">
      <div class="row">
         @foreach ($likeUsers as $likeuser)
         <div class="col-sm-12 col-md-12 removeJs_{{ $likeuser->user->id }}">
            <div class="job-box-info block-box clearfix">

         @php
         // @dd($likeuser)
         $js = $likeuser->user;
         @endphp
               <div class="box-head">
                @if (isEmployer())
                  <h4>{{$js->name}} {{$js->surname}}</h4>
                  @else
                  
                  <h4>{{$js->company}}</h4>

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
                        <img src="{{$profile_image}}" alt="">
                     </div>
                     <div class="block-user-progress ">
                        <h6 class="p-0">{{$js->name}} {{$js->surname}}</h6>
        
                     </div>
                  </div>
                  <div class="col-md-10 user-details">
                     <div class="row blocked-user-about mt-2">
                        <h6 class="p-0">About me:</h6>
                        <p class="">{{$js->about_me}}.</p>
                     </div>
                     <div class="row blocked-user-about mt-2">
                        <h6 class="p-0">Intrested In:</h6>
                        <p class="">{{$js->interested_in}}</p>
                     </div>
                     <div class="row blocked-user-about mt-2">
                        <h6 class="p-0">Location:</h6>
                        <p class="">{{$js->city}},  {{$js->state}}, {{$js->country}}</p>
                     </div>
                     <div class="row blocked-user-experience mt-2">
                        <h6 class="p-0">Industory Experience:</h6>
                        @if(isset($js->industry_experience))
                        {{-- <div class="indusDiv"> --}}
                            @foreach ($js->industry_experience as $ind)
                            <ul class="indsutrySelect p-0">
                               <li>
                                  <p>{{getIndustryName($ind)}}</p>
                               </li>
                            </ul>
                            @endforeach
                        {{-- </div> --}}
                        @endif
                     </div>
                  </div>
               </div>
               <div class="box-footer unlike-btn-group clearfix">
                  {{-- <div class="block-progrees-ratio d-none d-md-block user-page-footer">
                     <ul>
                        <li><span class="Progress-ratio-icon1">.</span> <span>60%</span> Match </li>
                        <li><span class="Progress-ratio-icon2">.</span> <span>40%</span> UnMatch</li>
                     </ul>
                  </div> --}}
                  <button class="unlike-btn" data-toggle="modal" onclick="unlikefunction('{{ $js->id }}')" data-target="#unlikeModal"><i class="fas fa-thumbs-down"></i> UnLike</button> 
                  <a  href="{{route('employerInfo', ['id' => $js->id])}}"><button class="block-btn "> View Profile</button></a>                     
               </div>
            </div>
         </div>
        @endforeach

      </div>
      
   </div>

   @else
      <h3>You have not liked any Employers</h3>
      @endif
</section>


@include('web.modals.unlike')

@stop

@section('custom_footer_css')
{{-- <link rel="stylesheet" href="{{ asset('css/site/profile.css') }}"> --}}
<style type="text/css">
    .indusDiv{
        height: 50px;
        overflow-y: scroll;
    }
</style>
@stop

@section('custom_js')
<script src="{{ asset('js/web/profile.js') }}"></script>
{{-- <script src="{{ asset('js/site/common.js') }}"></script> --}}

@stop

