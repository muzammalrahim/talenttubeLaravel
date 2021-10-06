{{-- <div > --}}

       {{--  <div class="galleryCont">
            <div class="head2">Gallery Photos</div>
            <div class="photos">
            @if ($galleries)
            @foreach ($galleries as $gallery)
                <div id="{{$gallery->id}}" class="emp_profile_photo_frame fl_left gallery_{{$gallery->id}} {{($gallery->access == 2)?'private':'public'}} pip">
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
        </div> --}}

        {{-- html for photos --}}
<div class="row">
           <div class=" Gallery">
          <h2>Photos</h2>
          <ul>
            @if ($galleries)
             @foreach ($galleries as $gallery)
            <li class=" float-left">
              <!-- ============ upload images ============= -->
              <div class="album-upload-img field" align="left">
               <div class="pip" id="{{$gallery->id}}" >
                   <a  data-offset-id="{{$gallery->id}}" {{-- class="show_photo_gallery" --}} href="{{assetGallery($gallery->access,$employer->id,'',$gallery->image)}}"
                data-lcl-thumb="{{assetGallery($gallery->access,$employer->id,'small',$gallery->image)}}" >
                    <img src="{{assetGallery($gallery->access,$employer->id,'small',$gallery->image)}}" class="imageThumb">
                    </a>
                 </div>
                </div>
            </li>
            @endforeach
            @endif
          </ul>
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

  

        {{-- html for videos  --}}
<div class="row">
          <div class=" Gallery">
                      <h2>Gallery Video's</h2>
                      <ul>
                          @if ($videos->count() > 0 )
                         @foreach ($videos as $video)
                        <li class="float-left">
                          <!-- ============ upload images ============= -->
                          <div class="album-upload-img field" align="left">
                            <div class="upload-file">
                            <div class="pip">
                                <div id="v_{{$video->id}}" class="item profile_photo_frame item_video" ">
                        <a onclick="UProfile.showVideoModal('{{assetVideo($video)}}')" class="video_link " target="_blank">
                            <div class="v_title_shadow imageThumb"><span class="v_title">{{$video->title}}</span></div>
                           {!! generateVideoThumbs($video) !!}
                        </a>
                    </div>
                            </div>
                            </div>
                          </div>
                        </li>
                         @endforeach
                         @endif
                      </ul>
                    </div>
                    </div>
        <!-- /videos -->

    {{-- </div> --}}