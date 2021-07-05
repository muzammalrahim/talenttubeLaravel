
@extends('site.employer.employermaster')  {{-- site/employer/employermaster --}}

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('css/site/profile.css') }}">
@stop

@section('content')

<div class="cont bl_profile">
    <div class="bl_pic_info  my_profile">

        <div class="bl_pic">
            <div class="pic">
                <div class="profile_pic_one to_show">
                    <a class="show_photo_gallery" href="{{$profile_image}}" data-lcl-thumb="{{$profile_image}}" >
                        <img  data-offset-id="23" class="photo" id="pic_main_img" src="{{$profile_image}}" title="">
                    </a>
                </div>
            </div>
        </div>

        <div class="info">
            <div class="name"><a id="profile_name" style="cursor:default;" class="edit_main_title"  onclick="return false;">
                {{($user->company)?($user->company):($user->name.' '.$user->surname)}}</a></div>
            <div class="bl_list_info">
                <ul class="list_info userProfileLocation">
                    <li><span id="list_info_age">{{$user->age}}</span><span class="basic_info">•</span></li>
                    <li id="list_info_location">{{userLocation($user)}}</li>
                    <li><span class="basic_info">•</span><span id="list_info_gender">Employer</span></li>
                </ul>
                <div class="icon_edit">
                    <i onclick="UProfile.showMainEditor();" class=" fas fa-edit"></i>
                </div>
            </div>

        </div>
        <div class="cl"></div>
    </div>


    @include('site.employer.profile.tabs')  {{-- site/employer/profile/tabs --}}

    <div class="cl"></div>
</div>



@include('site.employer.profile.profileEditPopup') {{-- site/employer/profile/profileEditPopup --}}
@include('site.employer.profile.profilePersonalInfo') {{-- site/employer/profile/profilePersonalInfo --}}


@stop


@section('custom_footer_css')


<link rel="stylesheet" href="{{ asset('css/site/employer/profile.css') }}"> {{-- added on 02-07-2021 --}}
<link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}">
<link rel="stylesheet" href="{{ asset('css/site/gallery_popup/lc_lightbox.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/plyr.css') }}">

@stop

@section('custom_js')
<script src="{{ asset('js/site/jquery.modal.min.js') }}"></script>
<script src="{{ asset('js/site/gallery_popup/lc_lightbox.lite.js') }}"></script>
<script src="{{ asset('js/site/plyr.polyfilled.js') }}"></script>
<script type="text/javascript">
//======================= Employer Questions Edit =================================
 $(".editEmployerQuestions").click(function(){
 $('.button').css("display","inline-block");
 $('.EmployerRegQuestion').removeClass('hide_it');
 $('.employerQuestionsPtag').addClass('hide_it');
});
//======================= Employer Questions Editing end here =================================
$(document).ready(function(){
   $(document).on('click','.removeIndustry', function(){
    $(this).closest('.IndustrySelect').remove();
   });

   $(document).on('click','.addIndus', function(){
    console.log(' addIndus ');
    var newIndusHtml = '<div class="IndustrySelect"><select name="industry_experience[]" class="industry_experience userIndustryExperience">';
    @if(!empty($industriesList))
        @foreach($industriesList as $lk=>$lv)
            newIndusHtml += '<option value="{{$lk}}">{{$lv}}</option>';
        @endforeach
    @endif
    newIndusHtml += '</select>';
    newIndusHtml += '<i class="fa fa-trash removeIndustry"></i>';
    newIndusHtml += '</div>';
    $('.IndusList').append(newIndusHtml);
   });
});

$(".editIndustry").click(function(){
    $(this).closest('.IndusListBox').addClass('edit');
    $('.removeIndustry').removeClass('hide_it2');
    $('.addIndus').removeClass('hide_it2');
    $('.buttonSaveIndustry').removeClass('hide_it2');
    // console.log('welcome');
  });
</script>
@stop

