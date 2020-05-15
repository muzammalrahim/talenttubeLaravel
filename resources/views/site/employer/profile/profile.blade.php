{{-- @extends('site.user.usertemplate') --}}
@extends('site.employer.employermaster')


@section('content')
<div class="cont bl_profile">
    <div class="bl_pic_info  my_profile">

        {{-- @dump($profileImage) --}}
        {{-- @dump($profileImage['imagepath']) --}}
        {{-- @dump( $user_profile->image ) --}}
        {{-- @dump($profile_image) --}}

        <div class="bl_pic">
            <div class="pic">
                <div class="profile_pic_one to_show">
                    <a class="show_photo_gallery" href="{{$profile_image}}" data-lcl-thumb="{{$profile_image}}" >
                        <img  data-offset-id="23" class="photo"
                            id="pic_main_img"
                            src="{{$profile_image}}"
                            title="">
                    </a>
                    {{-- <div id="add_photo_main_profile" class="add_photo">
                        <div class="file" id="add_photo_profile">
                            <form>
                                <button class="btn small violet"><img width="16" height="16" alt="" src="">Add a photo</button>
                                <input title="" id="some_add_photo_main_public" type="file" multiple="" name="file_public[]">
                                <input id="some_add_photo_main_public_reset" type="reset" value="">
                            </form>
                        </div>
                    </div> --}}
                </div>
                   {{-- <div id="profile_status_online" title="On the site now!" class="status_online to_show"></div> --}}
            </div>
        </div>

        {{-- @dump($user) --}}
        {{-- @dump($user->GeoCountry)
        @dump($user->GeoState)
        @dump($user->GeoCity) --}}

        <div class="info">
            <div class="name"><a id="profile_name" style="cursor:default;" class="edit_main_title"  onclick="return false;">{{$user->name}} {{$user->surname}}</a></div>
            <div class="bl_list_info">
                <ul class="list_info">
                    <li><span id="list_info_age">{{$user->age}}</span><span class="basic_info">•</span></li>
                    <li id="list_info_location">{{($user->GeoCity)?($user->GeoCity->city_title):''}},  {{($user->GeoState)?($user->GeoState->state_title):''}}, {{($user->GeoCountry)?($user->GeoCountry->country_title):''}}</li>
                    <li><span class="basic_info">•</span><span id="list_info_gender">Job Seeker</span></li>
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


            {{-- <div class="title_interest">
                <strong>I am looking for</strong>
                <div class="icon_edit"><span onclick="Profile.showLookingForEditor();"></span></div>
            </div>
            <ul class="list_interest">
                <li><span class="basic_info">•</span><span id="info_looking_for_orientation">Job Seeker</span></li>
                <li><span class="basic_info">•</span><span id="info_looking_for_ages">Ages 18-100</span></li>
                <li><span class="basic_info">•</span><span id="info_looking_for_near_me">Near me</span></li>
            </ul> --}}
        </div>
        <div class="cl"></div>
    </div>


    @include('site.user.profile.tabs')

<div class="cl"></div>
</div>



@include('site.user.profile.profileEditPopup')
@include('site.user.profile.profilePersonalInfo')


@stop


@section('custom_footer_css')
<link rel="stylesheet" href="{{ asset('css/site/profile.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}">
{{-- <link rel="stylesheet" href="{{ asset('css/site/gallery_popup/magnific-popup.css') }}"> --}}
<link rel="stylesheet" href="{{ asset('css/site/gallery_popup/lc_lightbox.css') }}">
@stop

@section('custom_js')
<script src="{{ asset('js/site/jquery.modal.min.js') }}"></script>
{{-- <script src="{{ asset('js/site/profile_photo.js') }}"></script>  --}}
{{-- <script src="{{ asset('js/site/gallery_popup/jquery.magnific-popup.js') }}"></script>  --}}
<script src="{{ asset('js/site/gallery_popup/lc_lightbox.lite.js') }}"></script>
@stop

