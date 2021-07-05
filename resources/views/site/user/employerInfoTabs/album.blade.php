<div class="tab_photos tab_cont">

        <div class="galleryCont">
            <div class="head2">Gallery Photos</div>
            <div class="photos">
            @if ($galleries)
            @foreach ($galleries as $gallery)
                <div id="{{$gallery->id}}" class="emp_profile_photo_frame fl_left gallery_{{$gallery->id}} {{($gallery->access == 2)?'private':'public'}}">
                    <a  data-offset-id="{{$gallery->id}}" class="show_photo_gallery"
                        href="{{assetGallery($gallery->access,$employer->id,'',$gallery->image)}}"
                        data-lcl-thumb="{{assetGallery($gallery->access,$employer->id,'small',$gallery->image)}}"
                        >
                        <img data-photo-id="{{$gallery->id}}"  id="photo_{{$gallery->id}}"   class="photo"
                        data-src="{{assetGallery($gallery->access,$employer->id,'',$gallery->image)}}"
                        src="{{assetGallery($gallery->access,$employer->id,'small',$gallery->image)}}" >
                    </a>
                </div>
            @endforeach
            @endif
            </div>
        </div>
        <!-- /photos -->
        <div style="display:none;">
            <div id="videoShowModal" class="modal p0 videoShowModal">
                <div class="pp_info_start pp_alert pp_confirm pp_cont" style="left: 0px; top: 0px; margin: 0;">
                    <div class="cont">
                        <div class="videoBox"></div>

                    </div>
                </div>
            </div>
        </div>
        <div class="cl mb20"></div>

        <div class="VideoCont">
            <div class="head2">Gallery Videos</div>
            <div class="videos">
                @if ($videos->count() > 0 )
                @foreach ($videos as $video)
                    <div id="v_{{$video->id}}" class="item profile_photo_frame item_video" style="display: inline-block;">
                        <a onclick="UProfile.showVideoModal('{{assetVideo($video)}}')" class="video_link" target="_blank">
                            <div class="v_title_shadow"><span class="v_title">{{$video->title}}</span></div>
                           {!! generateVideoThumbs($video) !!}
                        </a>
                    </div>
                @endforeach
            @endif
            </div>
            {{-- @dump($employer->questions) --}}

        </div>
        <!-- /videos -->

    </div>