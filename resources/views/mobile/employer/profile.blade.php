{{-- @extends('site.user.usertemplate') --}}
@extends('mobile.user.usermaster')
@section('content')

 

<div class="card shadow mb-3 bg-white rounded">

  <h6 class="card-header h6">Company Information {{-- <i class="fas fa-edit float-right"> --}}</i></h6>

    <div class="card-body p-2 cardBody">




{{-- ==================================================== For image ==================================================== --}}


<!--Section: Testimonials v.1-->
{{-- <section class="section pb-3 text-center"> --}}
  <!--Section description-->

  <div class="row">

    <!--Grid column-->
    <div class="col-lg-4 col-md-12 mb-1">

      <!--Card-->
      <div class="testimonial-card">
        <!--Background color-->
        <div class="card-up teal lighten-2">
        </div>
        <!--Avatar-->
        <div class="avatar mx-auto white">
          <img src="{{$profile_image}}"
            alt="avatar mx-auto white" class="rounded-circle img-fluid">
        </div>

      </div>
      <!--Card-->

    </div>
    <!--Grid column-->
  </div>

{{-- </section> --}}
<!--Section: Testimonials v.1-->

{{-- ==================================================== For image ==================================================== --}}

    {{-- <div id="over" style="/*position:absolute; */width:auto; height:150px"> --}}

      {{-- <img src="https://p16-tiktokcdn-com.akamaized.net/aweme/720x720/tiktok-obj/1646491669975042.jpeg"> --}}
      {{--   <a class="show_photo_gallery" href="{{$profile_image}}" data-lcl-thumb="{{$profile_image}}" >
            <img  class="photo" id="pic_main_img" src="{{$profile_image}}" title="">
        </a> --}}
        
    {{-- </div> --}}

    <div class="personalInfo">{{$user->name}} {{$user->surname}}</div>
    <div class="personalInfo"><b>Email:</b> {{$user->email}}</div>
    <div class="personalInfo"><b>Phone:</b> {{$user->phone}}</div>
    <div class="personalInfo"><b>Location: </b>{{$user->location}}</div>

        {{-- Interested In --}}
    <div class="aboutMeSection"><b>Interested In: </b>
            <div class="spinner-border spinner-border-sm text-primary IntsdInLoader ml-2" role="status" style="display:none;"></div>
            <i class="fas fa-edit float-right intInSecButton"></i> <p class="interestedInSec">{{$user->interested_in}}</p>
        </div>

    <div class="col-md-12 text-center my-2">
                              <a class="btn btn-sm btn-success saveInterestedInButton d-none">Save</a>
        </div>

        <div class="alert alert-success interestedInAlert" role="alert" style="display:none;">
          <strong>Success!</strong> Interested In have been updated successfully!
        </div>

        {{-- Interested In --}}

    <div class="aboutMeSection"><b>About Me: </b>
            <div class="spinner-border spinner-border-sm text-primary AboutMeLoader ml-2" role="status" style="display:none;"></div>
            <i class="fas fa-edit float-right aboutMeSecButton"></i> <p class="aboutMeSec">{{$user->about_me}}</p>
        </div>

        <div class="col-md-12 text-center my-2">
            <a class="btn btn-sm btn-success saveAboutMeButton d-none">Save</a>
        </div>

        <div class="alert alert-success AboutMeAlert" role="alert" style="display:none;">
          <strong>Success!</strong> About Me have been updated successfully!
        </div>

        <div class="cardContent"></div>
        <div class="cardEdit" style="display: none;"></div>
    {{-- @dump($user); --}}

    </div>

</div> 


{{-- <div class="card shadow mb-3 bg-white rounded">

    <h6 class="card-header h6">Questions<i class="fas fa-edit float-right editQuestions"></i></h6>
      <div class="card-body p-2 cardBody">
            <p class="loader SaveQuestionsLoader"style="float: left;"></p>
              <div class="cl"></div>
                <div class="questionsOfUser">
                    @php  
                        $userQuestions = !empty($user->questions)?(json_decode($user->questions, true)):(array()); 
                    @endphp
                      @if(!empty($empquestion))
                          @foreach($empquestion as $qk => $question)
                            <div>
                              <p class="mb-1">{{$question}} </p>
                               <p class="QuestionsKeyPTag mb-1"><b>{{$userQuestions[$qk]}}</b></p>
                                <select name="{{$qk}}" class="jobSeekerRegQuestion custom-select custom-select hideme mb-2 d-none">
                                    <option value="yes"
                                    {{( isset($userQuestions[$qk]) && ($userQuestions[$qk] == 'yes'))?'selected':''}}
                                    >Yes</option>
                                    <option value="no"
                                    {{( isset($userQuestions[$qk]) && ($userQuestions[$qk] == 'no'))?'selected':''}}
                                    >No</option>
                                </select>
                            </div>
                          @endforeach
                      @endif
                          <div class="col-md-12 text-center mt-3">
                              <a class="btn btn-sm btn-success saveQuestionsButton d-none">Save</a>
                          </div>  
                </div>
            <div class="alert alert-success questionsAlert" role="alert" style="display:none;">
              <strong>Success!</strong> Questions have been updated successfully!
            </div>
  </div>
</div>  --}}

{{-- ======================================================================================================================== --}}


<ul class="nav nav-tabs nav-justified md-tabs indigo" id="myTabJust" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab-just" data-toggle="tab" href="#home-just" role="tab" aria-controls="home-just"
      aria-selected="true">Albums</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab-just" data-toggle="tab" href="#profile-just" role="tab" aria-controls="profile-just"
      aria-selected="false">Questions</a>
  </li>

  {{-- <li class="nav-item">
    <a class="nav-link" id="contact-tab-just" data-toggle="tab" href="#contact-just" role="tab" aria-controls="contact-just"
      aria-selected="false">Contact</a>
  </li> --}}

</ul>

<div class="tab-content card pt-5 pl-2" id="myTabContentJust">


  {{-- ============================================================= Album Tab Start here ============================================================= --}}

    <div class="tab-pane fade show active" id="home-just" role="tabpanel" aria-labelledby="home-tab-just">

  {{-- =================================================================== Photos =================================================================== --}}

    <div class="tabs_photos text-dark mb-2 font-weight-bold">Photos</div>
        <div class="list_photos_public d-flex">
            <div class="list_photos_trans">
            <div id="photo_add_public" class="item add_photo add_photo_public">
                <a href="#null" class="dblock uploadProgressModalBtn"><img src="{{asset('/images/site/icons/add_photo126x140.png')}}" alt="" class="bg-primary float-left mr-3 ml-1 mt-2 uploadedPhotos" ></a>
            </div>
            @if ($user_gallery)
                @foreach ($user_gallery as $gallery)
                    <div id="{{$gallery->id}}" class="float-left mt-1 item profile_photo_frame gallery_{{$gallery->id}} {{($gallery->access == 2)?'private':'public'}}">
                        <a  data-offset-id="{{$gallery->id}}" class="show_photo_gallery"
                            href="{{assetGallery($gallery->access,$user->id,'',$gallery->image)}}"
                            data-lcl-thumb="{{assetGallery($gallery->access,$user->id,'small',$gallery->image)}}"
                            >
                            <img data-photo-id="{{$gallery->id}}"  id="photo_{{$gallery->id}}"   class="photo m-1 uploadedPhotos"
                            data-src="{{assetGallery($gallery->access,$user->id,'',$gallery->image)}}"
                            src="{{assetGallery($gallery->access,$user->id,'small',$gallery->image)}}"{{--  alt="thumbnail" class="img-thumbnail"
  style="width: 150px;height:150px;" --}}>
                        </a>
                        <div class="gallery_action float-right">
                            {{-- <i class="fas fa-user"></i> --}}
                                <span onclick="UProfile.confirmPhotoDelete({{$gallery->id}});" title="Delete photo" class="icon_delete">
                                    {{-- <span class="icon_delete_photo"></span> --}}
                                    <div class="iconPosition"><i class="fas fa-trash"></i></div>
                                    <span class="icon_delete_photo_hover"></span>
                                </span>
                                <span onclick="UProfile.setPrivateAccess({{$gallery->id}})"  title="Make private" class="icon_private">
                                    {{-- <span class="icon_private_photo"></span> --}}
                                    <div class="iconPosition"><i class="fas fa-lock"></i></div>
                                    
                                    <span class="icon_private_photo_hover"></span>
                                </span>
                                <span onclick="UProfile.setAsProfile({{$gallery->id}})" title="Make Profile" class="icon_image_profile">
                                        {{-- <span class=""></span> --}}
                                    <div class="iconPosition"><i class="fas fa-user"></i></div>
                                        
                                </span>
                        </div>
                    </div>
                @endforeach
            @endif
            </div>
        </div>
  {{-- =================================================================== Photos end =================================================================== --}}



      {{-- =================================================================== videos =================================================================== --}}

    <div class="video text-dark mt-3">
    <div class="tabs_videos mb-2 font-weight-bold">Videos</div>
        <div id="video" class="list_videos">
            <div id="list_videos_public" class="list_videos_public">
                <div id="photo_add_video" class="item add_photo add_video_public item_video">
                    <a class="add_photo" onclick="UProfile.SelectVideoFile(); return false;">
                        <img id="video_upload_select" class="transparent is_video bg-primary" onload="$(this).fadeTo(100,1);" src="{{asset('images/site/icons/add_video160x120.png')}}" style="opacity: 1;">
                    </a>
                </div>
            </div>
            <div class="cl"></div>

            @if ($videos->count() > 0 )
                @foreach ($videos as $video)
                    <div id="v_{{$video->id}}" class="item profile_photo_frame item_video" style="display: inline-block;">
                        <a onclick="UProfile.showVideoModal('{{$video->file}}')" class="video_link" target="_blank">
                            <div class="v_title_shadow"><span class="v_title">{{$video->title}}</span></div>
                           {!! generateVideoThumbs($video) !!}
                        </a>
                        <span title="Delete video" class="icon_delete" data-vid="{{$video->id}}" onclick="UProfile.delteVideo({{$video->id}})">
                            <span class="icon_delete_photo"></span>
                            <span class="icon_delete_photo_hover"></span>
                        </span>

                        <div class="v_error error hide_it"></div>
                    </div>
                @endforeach
            @endif


            <div style="display:none;">
                <div id="videoShowModal" class="modal p0 videoShowModal">
                    <div class="pp_info_start pp_alert pp_confirm pp_cont" style="left: 0px; top: 0px; margin: 0;">
                        <div class="cont">
                            <div class="videoBox"></div>
                                                                                        
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
  {{-- =================================================================== videos end =================================================================== --}}

  </div>



  {{-- ============================================================= Album Tab Ends here ============================================================= --}}


    <div class="tab-pane fade" id="profile-just" role="tabpanel" aria-labelledby="profile-tab-just">

        <div class="mb-3 bg-white rounded">
            <h6 class="card-header h6">Questions<i class="fas fa-edit float-right editQuestions"></i></h6>
              <div class="card-body p-2 cardBody text-dark">
                    <p class="loader SaveQuestionsLoader"style="float: left;"></p>
                      <div class="cl"></div>
                        <div class="questionsOfUser">

                                  @include('mobile.layout.parts.employerQuestions')  {{--  mobile/layout/parts/employerQuestions    --}}

                            
                                  <div class="col-md-12 text-center mt-3">
                                      <a class="btn btn-sm btn-success saveQuestionsButton d-none">Save</a>
                                  </div>  
                        </div>
                    <div class="alert alert-success questionsAlert" role="alert" style="display:none;">
                      <strong>Success!</strong> Questions have been updated successfully!
                    </div>
                </div>
        </div>
    </div>

{{--   <div class="tab-pane fade" id="contact-just" role="tabpanel" aria-labelledby="contact-tab-just">
    <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro
      fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone
      skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings
      gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork
      biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl
      craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
  </div> --}}

</div>


{{-- ======================================================================================================================== --}}


@stop


@section('custom_footer_css')
<style type="text/css">

p,span{
    font-size: 12px;
}
.iconPosition {
    position: relative;
    right: 20px;
    top: 5px;
}

.tabs_profile .tab_photos .item {
    position: relative;
    overflow: hidden;
    width: 126px;
    height: 140px;
    margin: 0 26px 25px 0;
    transition: 0.5s ease;
    float: left;
    width: auto;
    height: auto;
    float: none;
    display: inline-block;
    box-shadow: 0 2px 4px -1px rgba(0,0,0,.2), 0 4px 5px 0 rgba(0,0,0,.14), 0 1px 10px 0 rgba(0,0,0,.12);
    border-radius: 4px;
}
div#home-just {
    /*display: grid;*/
}
.uploadedPhotos {
    vertical-align: middle;
    /* overflow: visible; */
    object-fit: cover;
    height: 119px;
    width: 120px;
    
}
.teal.lighten-2 {
    background-color: #254c8e !important;
}

</style>
@stop

@section('custom_js')

<script type="text/javascript">


// {{-- ==================================================== Edit Interested IN ==================================================== --}}

$('.intInSecButton').click(function(){

        $('.interestedInSec').attr("contentEditable", "true");
        $('.interestedInSec').addClass('interestedInEditColor').css("border","2px solid #dc9f4a");
        $('.interestedInSec').addClass('editable');
    $('.saveInterestedInButton').removeClass('d-none');

    
});

$(".saveInterestedInButton").click(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var interestedIn = $('.interestedInSec').text(); 
    console.log(interestedIn);
        $('.IntsdInLoader').show();
    $.ajax({
        type: 'POST',
        url: base_url+'/m/ajax/MupdateInterested_inEmp',
        data: {'interestedIn': interestedIn},
        success: function(resp){
            if(resp.status){
                $('.IntsdInLoader').hide(); 
                $('.saveInterestedInButton').addClass('d-none'); 
                $('.interestedInSec').attr("contentEditable", "false");
                $('.interestedInSec').removeClass('interestedInEditColor').css("border","none");
                $('.interestedInAlert').show().delay(3000).fadeOut('slow');


            }
        }
    });
});

// {{-- ==================================================== Edit Interested IN End ==================================================== 

--}}

// {{-- ==================================================== Edit About Me  ==================================================== --}}

$('.aboutMeSecButton').click(function(){

        $('.aboutMeSec').attr("contentEditable", "true");
        $('.aboutMeSec').addClass('interestedInEditColor').css("border","2px solid #dc9f4a");
        $('.aboutMeSec').addClass('editable');
        $('.saveAboutMeButton').removeClass('d-none');
});

$(".saveAboutMeButton").click(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var aboutMe = $('.aboutMeSec').text(); 
    console.log(aboutMe);
    $('.AboutMeLoader').show();
    $.ajax({
        type: 'POST',
        url: base_url+'/m/ajax/Mabout_meEmp',
        data: {'aboutMe': aboutMe},
        success: function(resp){
            if(resp.status){
                $('.AboutMeLoader').hide(); 
                $('.saveAboutMeButton').addClass('d-none'); 
                $('.aboutMeSec').attr("contentEditable", "false");
                $('.aboutMeSec').removeClass('interestedInEditColor').css("border","none");
                $('.AboutMeAlert').show().delay(3000).fadeOut('slow');

            }
        }
    });
});

// {{-- ==================================================== Edit About Me End ==================================================== --}}


//===================================================== Employer Questions Edit =====================================================

 $(".editQuestions").click(function(){      
     $('.hideme').show();
     $('.saveQuestionsButton').removeClass('d-none');
     $('.QuestionsKeyPTag').addClass('d-none');
     $('.jobSeekerRegQuestion').removeClass('d-none');


});
//================================================ Employer Questions Editing end here ================================================

//  ======================================= Employer Questions Ajax saveQuestionsButton =======================================

    $(".saveQuestionsButton").click(function(){
        var items = {}; 
        $('select.jobSeekerRegQuestion').each(function(index,el){  
        // console.log(index, $(el).attr('name')  , $(el).val()   );  
            // items.push({name:  $(el).attr('name') , value: $(el).val()});
            var elem_name = $(el).attr('name'); 
            var elem_val = $(el).val(); 
            items[elem_name] = elem_val; 
            // items.push({elem_name : elem_val });
        $('.userQuesLoader').show();           //indusExpLoader

        });
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // $('.SaveQuestionsLoader').after(getLoader('smallSpinner SaveQuestionsSpinner'));
        $.ajax({
            type: 'POST',
            url: base_url+'/m/ajax/MupdateQuestionsEmp',
            data: {'questions': items},
            
            success: function(data){
                    $('.questionsAlert').show().delay(3000).fadeOut('slow');
                    $('.saveQuestionsButton').addClass('d-none'); 
                    $('.userQuesLoader').hide();
                    // $('.QuestionsKeyPTag').removeClass('hide_it');

                    $('.QuestionsKeyPTag').removeClass('d-none');
                    $('.jobSeekerRegQuestion').addClass('d-none');

                    // location.reload();
                    if(data){
                        // $(".questionsOfUser").load(" .questionsOfUser");
                        // $(".SaveQuestionsSpinner").remove();
                       
                }
            }
        });
    });

//  ======================================= Employer Questions Ajax End  =======================================




</script>
@stop

