<ul>
   <li class="">
      <a onclick="uploadVideoFunction();">
         <div class="album-upload-img field" align="left">
            <div class="upload-file">
               <i class="fas fa-images"></i>
               <span>Upload-Video</span>
            </div>
      </a>
         {{-- <input type="file" id="files" name="files[]" accept="video/mp4,video/x-m4v,video/*" /> --}}
      </div>
   </li>
</ul>

<div class="list_videos row" id="video">
   {{-- <div id="list_videos_public" class="list_videos_public pointer">
      <div id="photo_add_video" class="item add_photo add_video_public item_video">
         <a class="add_photo" onclick="uploadVideoFunction();">
             <img id="video_upload_select" class="transparent is_video" onload="$(this).fadeTo(100,1);" src="{{asset('images/site/icons/add_video160x120.png')}}" style="opacity: 1;">
         </a>
      </div>
   </div>
   --}}


   @if ($videos->count() > 0 )
        @foreach ($videos as $video)
            <div id="v_{{$video->id}}" class="item profile_photo_frame item_video col-5 pointer position-relative d-inline-block m-3">
               <a class="videoFunction" class="video_link" target="_blank">
                  <div class="v_title_shadow">
                     <span class="v_title">{{$video->title}}</span>
                  </div>

                  <span class="viewVideo" onclick="showVideoModalFunction('{{assetVideo($video)}}', '{{ $video->title }}' )" data-bs-toggle="modal" data-bs-target="#videoShowModal" >View Video</span>

                  <span class="deleteVideoSpan" onclick="deleteVideoFun({{$video->id}})" data-toggle="modal" data-target ="#deleteVideoModal">Delete Video</span>

                  {!! generateVideoThumbs($video) !!}
               </a>
               <span title="Delete video" class="icon_delete" data-vid="{{$video->id}}">
                  <span class="icon_delete_photo"></span>
                  <span class="icon_delete_photo_hover"></span>
               </span>
               <div class="v_error error hide_it"></div>
            </div>
        @endforeach
    @endif



</div>



 <!-- Button trigger modal -->
{{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#videoShowModal">
  Launch demo modal
</button> --}}

<!-- Modal -->
<div class="modal fade" id="videoShowModal" tabindex="-1" aria-labelledby="exampleModalLabel" 
   aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="videoTitle">Video</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

         <div class="videoBox"></div>

      </div>

    </div>
  </div>
</div>






<div class="modal fade" id="deleteVideoModal" role="dialog">
  <div class="modal-dialog delete-applications">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <i data-dismiss="modal" class="close-box fa fa-times"></i>                      
        <h1 class="modal-title"><i class="fa fa-trash trash-icon"></i>Delete Video?</h1>
      </div>
      <div class="modal-body">
        <strong>This action can not be undone. Are you sure you wish to continue?</strong>
      </div>
      <div class="dual-footer-btn">
        <input type="hidden" name="" id="deleteVideoId"/>

        <button type="button" class="btn btn-default black_btn" data-dismiss="modal"><i class="fa fa-times"></i>Cancel</button>
        <button type="button" class="orange_btn" onclick="removeVideoConfirm()" data-dismiss="modal"><i class="fa fa-check"></i>OK</button>
      </div>
    </div>
    
  </div>
</div>