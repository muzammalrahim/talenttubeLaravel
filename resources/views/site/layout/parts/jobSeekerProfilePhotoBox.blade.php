

{{-- @dump($js->vidoes) --}}
@php
$profile_image  = asset('images/site/icons/nophoto.jpg');
$profile_image_gallery    = $js->profileImage()->first();
 if ($profile_image_gallery) {
    $profile_image   = assetGallery($profile_image_gallery->access,$js->id,'',$profile_image_gallery->image);
 } 
@endphp

<div class="js_profile w_30p w_box dblock fl_left">
    <div class="js_profile_cont center p10">
        <div class="js_profile_video">
            <div class="js_video_thumb">
                <img class="js_profile_photo w100" id="pic_main_img" src="{{$profile_image}}">
               {{--
               <a onclick="profileVideoShow('{{assetVideo($js->vidoes->first())}}')" class="js_video_link" target="_blank">
                {!! generateVideoThumbs($js->vidoes->first())!!}
               </a>
               --}}
            </div>
            <div class="videos_list">
                @foreach($js->vidoes as $video)
                    <input type="hidden" name="user_video" value="{{$video->file}}">
                @endforeach
            </div>
        </div>
        {{-- <img class="js_photo w100" id="pic_main_img" src="{{$profile_image}}"> --}}
        <a onclick="profileVideoShow('{{assetVideo($js->vidoes->first())}}')" class="js_video_link" target="_blank">{!! generateVideoThumbs($js->vidoes->first()) !!}</a>
    </div>
    <div class="js_info center">
        <div class="js_name"><h4 class="bold">{{$js->name}} {{$js->surname}}</h4></div>
        <div class="js_status_label">{{$js->statusText}}</div>
        <div class="js_location">Location: {{($js->GeoCity)?($js->GeoCity->city_title):''}},  {{($js->GeoState)?($js->GeoState->state_title):''}}, {{($js->GeoCountry)?($js->GeoCountry->country_title):''}} </div>
    </div>
</div>



<div style="display:none;">
    <div id="videoShowModal" class="modal p0 videoShowModal">
        <div class="pp_info_start pp_alert pp_confirm pp_cont" style="left: 0px; top: 0px; margin: 0;">
            <div class="cont">
                <div class="videoBox"></div>
                
            </div>
        </div>
    </div>
</div>