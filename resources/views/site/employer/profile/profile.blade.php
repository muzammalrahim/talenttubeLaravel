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
<link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}">
<link rel="stylesheet" href="{{ asset('css/site/gallery_popup/lc_lightbox.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/plyr.css') }}">
@stop

@section('custom_js')
<script src="{{ asset('js/site/jquery.modal.min.js') }}"></script>
<script src="{{ asset('js/site/gallery_popup/lc_lightbox.lite.js') }}"></script>
<script src="{{ asset('js/site/plyr.polyfilled.js') }}"></script>
@stop

