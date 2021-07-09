{{-- @extends('site.user.usertemplate') --}}
@extends('mobile.user.usermaster')
@section('content')



<div class="card shadow mb-3 bg-white rounded">

  <h6 class="card-header h6 m-0">Personal Information {{-- <i class="fas fa-edit float-right"></i> --}} </h6>

	  <div class="card-body p-2 cardBody">

      {{-- ==================================================== For image ==================================================== --}}

      <div class="row">
        <div class="col-lg-12 col-md-12 mb-1">
          <div class="testimonial-card">
            <div class="card-up teal lighten-2">
            </div>
            <div class="avatar mx-auto white">
                <div class="avatarimg">
                <img src="{{$profile_image}}"
                    alt="avatar mx-auto white" class="rounded-circle img-fluid" style="height: 110px">
                </div>
            </div>

          </div>
        </div>
      </div>

      {{-- ==================================================== For image ==================================================== --}}


      {{-- <div class="personalInfoDiv"> --}}
		
      <div class="personalInfo mt-2"> <h6 class="m-0 font-weight-bold">{{$user->name}} {{$user->surname}}</h6></div>
  		<div class="personalInfo"> <b>Email:</b>     <span class="m-0">{{$user->email}}</span></div>
  		<div class="personalInfo"> <b>Phone:</b>     <span class="m-0">{{$user->phone}}</span></div>

      @include('mobile.user.tabs.location')   {{-- mobile/user/tabs/location --}}

      {{-- </div> --}}



      {{-- =============================================== Interested in =============================================== --}}


      @include('mobile.user.tabs.interested')   {{-- mobile/user/tabs/interested --}}


      {{-- =============================================== Recent Job =============================================== --}}

      @include('mobile.user.tabs.recentjob')   {{-- mobile/user/tabs/recentjob --}}

      
      {{-- =============================================== Organization Name =============================================== --}}

      @include('mobile.user.tabs.organization')   {{-- mobile/user/tabs/organization --}}

      
      {{-- =============================================== Salary Range =============================================== --}}

      @include('mobile.user.tabs.salaryrange')   {{-- mobile/user/tabs/salaryrange --}}


      {{-- =============================================== About Me =============================================== --}}

      @include('mobile.user.tabs.aboutme')   {{-- mobile/user/tabs/aboutme --}}



      <div class="cardContent"></div>
      <div class="cardEdit" style="display: none;"></div>
    </div>
  </div>
</div>


{{-- =============================================== qualification_card =============================================== --}}

@include('mobile.user.tabs.qualification_card')   {{-- mobile/user/tabs/qualification_card --}}


{{-- =============================================== industry_exp =============================================== --}}

@include('mobile.user.tabs.industry_exp')   {{-- mobile/user/tabs/industry_exp --}}



{{-- ======================================================================================================================== --}}


<ul class="nav nav-tabs nav-justified md-tabs indigo" id="myTabJust" role="tablist" style="font-size:12px">

  <li class="nav-item">
    <a class="nav-link active" id="home-tab-just" data-toggle="tab" href="#home-just" role="tab" aria-controls="home-just"
      aria-selected="true">Albums</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab-just" data-toggle="tab" href="#profile-just" role="tab" aria-controls="profile-just"
      aria-selected="false">Questions</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="reference-tab-just" data-toggle="tab" href="#reference-just" role="tab" aria-controls="reference-just"
      aria-selected="false">Reference</a>
  </li>

  {{--   <li class="nav-item">
    <a class="nav-link" id="tags-tab-just" data-toggle="tab" href="#tags-just" role="tab" aria-controls="tags-just"
      aria-selected="false">Tags</a>
  </li> --}}

</ul>

<div class="tab-content card pt-5 pl-2 text-dark" id="myTabContentJust">


  {{-- ============================================================= Album Tab Start here ============================================================= --}}

    <div class="tab-pane fade show active" id="home-just" role="tabpanel" aria-labelledby="home-tab-just">

      {{-- =================================================================== Photos =================================================================== --}}


      @include('mobile.user.tabs.photos')   {{-- mobile/user/tabs/photos --}}


      {{-- ======================================================== Resume & Contact Detail ======================================================== --}}

      @include('mobile.user.tabs.resume_contact')   {{-- mobile/user/tabs/resume_contact --}}

      {{-- =================================================================== videos =================================================================== --}}

    
      @include('mobile.user.tabs.videos')

      {{-- =================================================================== videos end =================================================================== --}}

    </div>

    {{-- ============================================================= Album Tab Ends here ============================================================= --}}


    {{-- ============================================================= Questions Tab Start here ============================================================= --}}


    @include('mobile.user.tabs.questions')  {{-- mobile/user/tabs/questions --}}


    {{-- ============================================================= Reference Tab Start here ============================================================= --}}

    <div class="tab-pane fade" id="reference-just" role="tabpanel" aria-labelledby="reference-tab-just">
        <div class="mb-3 bg-white rounded text-dark">
          @include('mobile.layout.parts.jsAddReference')  {{--  mobile/layout/parts/jsAddReference    --}}
        </div>
    </div>

    {{-- ============================================================= Reference Tab End here ============================================================= --}}

</div>

{{-- ======================================================================================================================== --}}

@stop


@section('custom_footer_css')
<style type="text/css">

.qualifType{ /*margin-left: 10px;*/font-size: 12px;}
.qualifTypeSpan{text-transform: capitalize;font-weight: bold;}
p,span{font-size: 12px;}
.iconPosition {position: relative;right: 20px;top: 5px;}
.tabs_profile .tab_photos .item {position: relative;overflow: hidden;width: 126px;height: 140px;margin: 0 26px 25px 0;transition: 0.5s ease;float: left;width: auto;
  height: auto;float: none;display: inline-block;box-shadow: 0 2px 4px -1px rgba(0,0,0,.2), 0 4px 5px 0 rgba(0,0,0,.14), 0 1px 10px 0 rgba(0,0,0,.12);border-radius: 4px;}
div#home-just {/*display: grid;*/}
.uploadedPhotos {vertical-align: middle;/* overflow: visible; */object-fit: cover;height: 119px;width: 120px;}
.teal.lighten-2 {background-color: #254c8e !important;}

/*.video_box{width: 36%;float: right;}*/

.video_box {
    width: 46%;
    float: left;
    margin-right: 13px;
}
</style>
@stop

@section('custom_js')
<link rel="stylesheet" href="https://unpkg.com/smartphoto@1.1.0/css/smartphoto.min.css">
<script src="https://unpkg.com/smartphoto@1.1.0/js/smartphoto.js"></script>
<script src="{{ asset('js/site/plyr.polyfilled.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/mobile/userProfile.js') }}"></script>
<script src="{{ asset('js/site/plyr.polyfilled.js') }}"></script>
<script>
    @if ($videos->count() > 0 )
    @foreach ($videos as $video)

    $('#modal{{$video->id}}').on('hidden.bs.modal', function (e) {
  // do something...
        var src = $(this).find(".videoBox video").find("source").attr('src');
        $(this).find(".videoBox video").find("source").attr('src');
        var videoElem  = '<video id="player" controls>';
        videoElem     += '<source src="'+src+'" type="video/mp4">';
        videoElem     += '</video>';
        $(this).find(".videoBox video").remove();
        $(this).find(".videoBox").html(videoElem);
    });
    @endforeach
    @endif

</script>
<script type="text/javascript">


document.addEventListener('DOMContentLoaded',function(){

new SmartPhoto(".js-smartPhoto2",{
        useOrientationApi: false
});
});


(function ($) {
  $.fn.progressBar = function (givenValue) {
    const $this = $(this);

    function init(selector) {
      const progressValue = selector.children().attr('aria-valuenow');
      selector.children().width(progressValue + "%");
      selector.children().html('<span></span>');
      $this.hasClass('md-progress') ? selector.children().children().addClass('md-progress-bar-text') : selector.children().children().addClass('progress-bar-text');
      (progressValue != 100) ? selector.children().children().text(progressValue + "%") : selector.children().children().html('<i class="fas fa-check"></i>');
    }

    function set(selector, value) {
      selector.children().removeClass('success fail active');
      selector.children().attr('aria-valuenow', value);
      init(selector);
      if (value > 100) {
        console.log('value over 100');
      } else if (value == 100) {
        selector.children().addClass('success');
      } else if (value < 30) {
        selector.children().addClass('fail');
      } else {
        selector.children().addClass('active');
      }
    }

    set($this, givenValue);
  }
}(jQuery));





$('#photo_add_video').on('click', function(){

var input = document.createElement('input');
input.type = 'file';
input.onchange = e => {
    var file = e.target.files[0];
    console.log(' onchange file  ', file);
    var formData = new FormData();
    formData.append('video', file);
    var item_id = Math.floor((Math.random() * 1000) + 1);
    var video_item = '';
    video_item += '<div id="v_'+item_id+'" class="item profile_photo_frame item_video" style="display: inline-block;">';
    video_item  +=  '<a class="show_photo_gallery video_link" href="">';
    video_item  +=  '</a>';
    video_item  +=  '<span class="v_title"></span>';
    video_item  +=  '<span title="Delete video" class="icon_delete">';
    video_item  +=      '<span class="icon_delete_photo"></span>';
    video_item  +=      '<span class="icon_delete_photo_hover"></span>';
    video_item  +=  '</span>';
    video_item  +=  '<div class="v_error error hide_it"></div>';
    video_item  +=  '<div class="v_progress"></div>';
    video_item  += '</div>';
    // var video_item = '';
    video_item += '<div id="bar8" class="progress md-progress my-4">';
    video_item += '<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">';
    video_item += '</div>';
    video_item += '</div>';
    $('.list_videos').append(video_item);
    $('#bar8').progressBar(0);
    var updateForm = document.querySelector('form');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var request = new XMLHttpRequest();
    request.upload.addEventListener('progress', function(e){
        var percent = Math.round((e.loaded / e.total) * 100);
        console.log(' progress-bar ', percent+'%' );
        $('#v_'+item_id+' .v_progress').css('width', percent+'%');
        $('#bar8').progressBar(percent);
    }, false);
    request.addEventListener('load', function(e){
        console.log(' load e ', e);
        var resp = JSON.parse(e.target.responseText);
        console.log(' jsonResponse ', resp);
        $('#v_'+item_id+' .v_progress').remove();
       $( "#bar8" ).remove();
        if (resp.status == 1) {
            $('#v_'+item_id).replaceWith(resp.html);
            $('#modal'+resp.data.id).on('hidden.bs.modal', function (e) {
            // do something...
                var src = $(this).find(".videoBox video").find("source").attr('src');
                $(this).find(".videoBox video").find("source").attr('src');
                var videoElem  = '<video id="player" controls>';
                videoElem     += '<source src="'+src+'" type="video/mp4">';
                videoElem     += '</video>';
                $(this).find(".videoBox video").remove();
                $(this).find(".videoBox").html(videoElem);
            });
        } else {
            console.log(' video error ');
            if (resp.validator != undefined) {
                $('#v_'+item_id+' .error').removeClass('hide_it').addClass('to_show').text(res.validator['video'][0]);
            }
        }
    }, false);
    request.open('post', base_url+'/m/ajax/uploadVideo');
    request.send(formData);
}
input.click();
});



</script>


@stop
