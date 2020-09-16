{{-- @extends('site.user.usertemplate') --}}
@extends('site.employer.employermaster')

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
                <div class="icon_edit"><span onclick="UProfile.showMainEditor();"></span></div>
            </div>

            <div class="status">
                <div id="profile_status" class="status_text" style="min-height: 24.0078px; min-width: 163.008px;">
                    <span class="statusText">{{($user->statusText)?($user->statusText):'Enter Your Status'}}</span>
                    <input class="hide_it" type="text" id="statusText" value="{{($user->statusText)?($user->statusText):''}}" onchange="UProfile.updateStatusText()" />
                </div>
                <div id="profile_status_edit" class="icon_edit" onclick="UProfile.enableStatusTextEdit();" style="opacity: 1;"><span></span></div>
            </div>

        </div>
        <div class="cl"></div>
    </div>


    @include('site.employer.profile.tabs')

<div class="cl"></div>
</div>



@include('site.employer.profile.profileEditPopup')
@include('site.employer.profile.profilePersonalInfo')


@stop


@section('custom_footer_css')
<style type="text/css">

div.tab_about.tab_cont>div#basic {
font-size: 20px;
margin: 0px 10px 20px 0px;
}
i.editEmployerQuestions.fas.fa-edit {
    cursor: pointer;
    font-size: 14px;
    color: mediumseagreen;
}
.button {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 10px 20px;;
  text-align: center;
  text-decoration: none;
  display: none;
  font-size: 14px;
  margin: 4px 2px;
  border-radius: 10px;
  cursor: pointer;
}
.button:hover {background-color: #3e8e41}
div.employerRegisterQuestions>div#basic {
    margin: 0px 10px 20px 0px;
    font-size: 20px;
}
i.editEmployerQuestions.fas.fa-edit {
    cursor: pointer;
    font-size: 14px;
    color: mediumseagreen;
    float:left;
}
.jq-selectbox.jqselect.EmployerRegQuestion{
    margin-bottom: 15px;
}
.jq-selectbox__select {
    width: 25px;
    border-radius: 0px;
}
li.sel {
    width: 35px;
}

/*chechking spinner*/

.smallSpinner.SaveEmployerQuestionsSpinner {
    float: left;
    position: relative;
    margin:8px 0px 0px 10px;
    font-size: 18px;
}
.alert.alert-success.EmployerQuestionsAlert {
    background: #3e8e41;
    height: 30px;
    width: 50%;
    text-align: center;
    padding: 15px 0px 0px 0px;
    color: white;
    font-size: 16px;
    margin: 0px auto;
    border-radius: 20px;
}
/*chechking spinner*/

/*===================================================== Image Sizing ===========================================*/
/*.tabs_profile .tab_photos img.photo {
    width: auto;
    height: 150px;
    max-width: 200px ;
    min-width: 150px ;
}*/

/*===================================================== Make Profile Icon ===========================================*/
/*span.icon_image_profile {
    bottom: 42px;
    right: 5px;
}*/

span.icon_image_profile {
    right: 3px !important;
}
</style>
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
</script>
@stop

