
{{dd('user side')}}
@include('site.user.profile.album.gallery')         {{--    site/user/profile/album/gallery     --}}
@include('site.user.profile.album.private')         {{--    site/user/profile/album/private     --}}     



<div class="title_private_photos title_videos">Videos</div>
<div id="video" class="list_videos">
    <div id="list_videos_public" class="list_videos_public">
        <div id="photo_add_video" class="item add_photo add_video_public item_video">
            <a class="add_photo" onclick="UProfile.SelectVideoFile();">
                <img id="video_upload_select" class="transparent is_video" onload="$(this).fadeTo(100,1);" src="{{asset('images/site/icons/add_video160x120.png')}}" style="opacity: 1;">
            </a>
        </div>
    </div>
    <div class="cl"></div>

    @if ($videos->count() > 0 )
        @foreach ($videos as $video)
            <div id="v_{{$video->id}}" class="item profile_photo_frame item_video" style="display: inline-block;">
                <a onclick="UProfile.showVideoModal('{{assetVideo($video)}}')" class="video_link" target="_blank">
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
                    {{-- <div class="double_btn">
                        <button class="confirm_close btn small dgrey" onclick="UProfile.cancelVideoModal(); return false;">Close</button>
                        <div class="cl"></div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

</div>
