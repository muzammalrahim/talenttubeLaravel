{{-- @extends('site.user.usertemplate') --}}
@extends('web.user.usermaster')
@section('custom_css')
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
@stop
@section('content')
{{-- html for like user page emloyer section --}}
<section class="row">
   <div class="col-md-12">
   @if ($likeUsers->count() > 0)
   <div class="profile profile-section">
      <h2>like Users Lists</h2>
      <div class="row">
         @foreach ($likeUsers as $likeuser)
         @php
         // @dd($likeuser)
         $js = $likeuser->user;
         @endphp
         <div class="col-sm-12 col-md-6">
            <div class="job-box-info block-box clearfix">
               <div class="box-head">
                  <h4>{{$js->name}} {{$js->surname}}</h4>
               </div>
               <div class="row Block-user-wrapper">
                  <div class="col-md-4 user-images">
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
                        <h6>{{$js->recentJob}}</h6>
                        <div class="progress-img"> <img src="assests/images/user-progressbar.svg" alt=""></div>
                        <div class="block-progrees-ratio d-block d-md-none">
                           <ul>
                              <li><span class="Progress-ratio-icon1">.</span> <span>60%</span> Match </li>
                              <li><span class="Progress-ratio-icon2">.</span> <span>40%</span> UnMatch</li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-8 user-details">
                     <div class="row blocked-user-about">
                        <h6>About me:</h6>
                        <p>{{$js->about_me}}</p>
                     </div>
                     <div class="row blocked-user-about">
                        <h6>Intrested In:</h6>
                        <p>{{$js->interested_in}}</p>
                     </div>
                     <div class="row blocked-user-about">
                        <h6>Location:</h6>
                        <p>{{$js->city}},  {{$js->state}}, {{$js->country}}</p>
                     </div>
                     <div class="row blocked-user-experience">
                        <h6>Industory Experience:</h6>
                        @if(isset($js->industry_experience))
                        @foreach ($js->industry_experience as $ind)
                        <ul class="indsutrySelect">
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
                     <ul>
                        <li><span class="Progress-ratio-icon1">.</span> <span>60%</span> Match </li>
                        <li><span class="Progress-ratio-icon2">.</span> <span>40%</span> UnMatch</li>
                     </ul>
                  </div>
                  <button class="unlike-btn"  data-toggle="modal" data-target="#myModal"><i class="fas fa-thumbs-down"></i> UnLike</button> 
                  <button class="block-btn">View Profile</button>                     
               </div>
            </div>
            @endforeach
         </div>
      </div>
      @else
      <h3>You have not liked anyone</h3>
      @endif
   </div>
</section>
{{-- modal for unlike user of like page --}}
<!-- ====================================================================================Modal -->
<div class="modal fade" id="myModal" role="dialog">
   <div class="modal-dialog delete-applications">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <i data-dismiss="modal" class="close-box fa fa-times"></i><i ></i>                      
            <h1 class="modal-title"><i class="fas fa-thumbs-down trash-icon"></i>UnLike User</h1>
         </div>
         <div class="modal-body">
            <strong>Are you sure you wish to continue?</strong>
         </div>
         <div class="dual-footer-btn">
            <button type="button" class="btn btn-default black_btn" data-dismiss="modal"><i class="fa fa-times"></i>Cancel</button>
            <button type="button" class="orange_btn"><i class="fa fa-check"></i>OK</button>
         </div>
      </div>
   </div>
</div>
{{-- html for like user page ends here --}}
@stop
@section('custom_footer_css')
<link rel="stylesheet" href="{{ asset('css/site/profile.css') }}">
{{-- 
<link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}">
--}}
@stop
@section('custom_js')
{{-- <script src="{{ asset('js/site/jquery.modal.min.js') }}"></script> --}}
<script src="{{ asset('js/site/jquery-ui.js') }}"></script>
<script src="{{ asset('js/site/common.js') }}"></script>
{{-- <script type="text/javascript">
   $(document).ready(function() {
   
    $(document).on('click','.jsUnLikeUserBtn',function(){
        var jobseeker_id = $(this).data('jsid');
        console.log('jsBlockUserBtn click jobseeker_id = ', jobseeker_id);
        $('#jobSeekerBlockId').val(jobseeker_id);
        $('.modal.cmodal').removeClass('showLoader').removeClass('showMessage');
        $('.double_btn').show();
   
        $('#confirmJobSeekerBlockModal').modal({
           fadeDuration: 200,
           fadeDelay: 2.5,
           escapeClose: false,
           clickClose: false,
       });
    });
   
    $(document).on('click','.confirm_EmpUnlike_ok',function(){
       console.log(' confirm_JobSeekerBlock_ok ');
       var jobseeker_id = $('#jobSeekerBlockId').val();
   
       // $('.confirmJobSeekerBlockModal  .img_chat').html(getLoader('blockJobSeekerLoader'));
       $('.confirmJobSeekerBlockModal').addClass('showLoader');
      // $('.confirmJobSeekerBlockModal  .loader').html(getLoader('blockJobSeekerLoader'));
   
       var btn = $(this); //
      //  btn.prop('disabled',true);
   
       $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
       $.ajax({
           type: 'POST',
           url: base_url+'/ajax/unLikeUser',
           data: {id: jobseeker_id},
           success: function(data){
              // btn.prop('disabled',false);
              $('.confirmJobSeekerBlockModal').removeClass('showLoader').addClass('showMessage');
               if( data.status == 1 ){
                   $('.confirmJobSeekerBlockModal .apiMessage').html(data.message);
                   $('.jobSeeker_row.js_'+jobseeker_id).remove();
                   $('.double_btn').hide();
   
               }else{
                   $('.confirmJobSeekerBlockModal .apiMessage').html(data.error);
               }
           }
       });
   });
   
   
   
   
   
   });
</script> --}}
@stop