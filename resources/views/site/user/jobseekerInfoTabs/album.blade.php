

<div class="tab_photos tab_cont">
   <div class="galleryCont row">
      <div class="head2 ">
         <h2>Gallery Photos</h2>
         <div class="photos">
            <ul>
               @if ($galleries)
               @foreach ($galleries as $gallery)
               <li class=" float-left">
                  <div class="album-upload-img field" align="left">
                     <div id="{{$gallery->id}}" class="pip">
                        <a  data-offset-id="{{$gallery->id}}" class="show_photo_gallery"
                           href="{{assetGallery($gallery->access,$jobSeeker->id,'',$gallery->image)}}" data-lcl-thumb="{{assetGallery($gallery->access,$jobSeeker->id,'small',$gallery->image)}}">
                        <img data-photo-id="{{$gallery->id}}"  id="photo_{{$gallery->id}}"   class="imageThumb" src="{{assetGallery($gallery->access,$jobSeeker->id,'small',$gallery->image)}}" > </a>
                     </div>
                  </div>
               </li>
               @endforeach
               @endif
            </ul>
         </div>
      </div>
   </div>
   <div class="cl mb20"></div>
   @if($isallowed)
   <span class="prvate-section">
      <div class="title_private_photos" style="margin-bottom: 5px;">
         Resume &amp; Contact Details
      </div>
      <ul class="list_interest_c" style="margin: 0;padding: 0 0 0 23px;">
         <li><span class="basic_info">•</span><span id="info_looking_for_orientation">Email: {{$js->email}}</span></li>
         <li><span class="basic_info">•</span><span id="info_looking_for_ages">First Name : {{$js->name}}</span></li>
         <li><span class="basic_info">•</span><span id="info_looking_for_ages">Last Name : {{$js->surname}}</span></li>
         <li><span class="basic_info">•</span><span id="info_looking_for_ages">Mobile : {{$js->phone}}</span></li>
      </ul>
   </span>
   <br>
   <div class="private_attachments">
      @foreach ($attachments as $attachment)
      <div class="attachment_{{$attachment->id}} attachment_file">
         <div class="attachment"><img src="{{asset('images/site/icons/cv.png')}}" /></div>
         <span class="attach_title">{{ $attachment->name }}</span>
         <div class="attach_btns">
            <a class="attach_btn downloadAttachBtn" href="{{asset('images/user/'.$attachment->file)}}">Download</a>
         </div>
      </div>
      @endforeach
   </div>
   @else
   <span class="prvate-section">
      <div class="title_private_photos" style="margin-bottom: 5px;">
         Content Locked
      </div>
      <p>
         Get premium account from
         <a class="credits_balans" id="credits_balans_header" href="{{route('premiumAccount')}}"> here</a>
         for contacting job seekers
      </p>
   </span>
   @endif
   {{-- ======================== Paid employer viewing the jobseeker personal info ========================  --}}
   {{-- ======================== Paid employer viewing the jobseeker personal info ========================  --}}
   <div class="cl mb20"></div>
   <div class="VideoCont row">
      <h2 class="head2">Gallery Videos</h2>
      <div class="videos">
         @if ($videos->count() > 0 )
         @foreach ($videos as $video)
         <div id="v_{{$video->id}}" class="item profile_photo_frame item_video" style="display: inline-block;">
            <a onclick="showVideoModalFunction('{{assetVideo($video)}}', '{{ $video->title }}' )" data-bs-toggle="modal" data-bs-target="#videoShowModal" class="video_link" target="_blank">
               <div class="v_title_shadow"><span class="v_title">{{$video->title}}</span></div>
               {!! generateVideoThumbs($video) !!}
            </a>
         </div>
         @endforeach
         @endif
      </div>
   </div>
   <!-- /videos -->
</div>




<div class="modal fade" id="videoShowModal" tabindex="-1" aria-labelledby="exampleModalLabel" 
   aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        {{-- <h5 class="modal-title" id="videoTitle">Modal title</h5> --}}
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

         <div class="videoBox"></div>

      </div>

    </div>
  </div>
</div>