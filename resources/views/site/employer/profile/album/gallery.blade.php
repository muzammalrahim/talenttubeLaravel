<!-- gallery blade -->
<div class="tabs_photos">Photos</div>
<div class="list_photos_public">
   <div class="list_photos_trans">
      <div id="photo_add_public" class="item add_photo add_photo_public">
         <a href="#null" class="dblock uploadProgressModalBtn"><img src="{{asset('/images/site/icons/add_photo126x140.png')}}" alt=""></a>
      </div>
      {{-- @dump($user_gallery) --}}
      @if ($user_gallery)
      @foreach ($user_gallery as $gallery)
      <div id="{{$gallery->id}}" class="item profile_photo_frame gallery_{{$gallery->id}} {{($gallery->access == 2)?'private':'public'}}">
         <a  data-offset-id="{{$gallery->id}}" class="show_photo_gallery"
            href="{{assetGallery($gallery->access,$user->id,'',$gallery->image)}}"
            data-lcl-thumb="{{assetGallery($gallery->access,$user->id,'small',$gallery->image)}}"
            >
         <img data-photo-id="{{$gallery->id}}"  id="photo_{{$gallery->id}}"   class="photo"
            data-src="{{assetGallery($gallery->access,$user->id,'',$gallery->image)}}"
            src="{{assetGallery($gallery->access,$user->id,'small',$gallery->image)}}" >
         </a>
         <div class="gallery_action">
            <span onclick="UProfile.confirmPhotoDelete({{$gallery->id}});" title="Delete photo" class="icon_delete">
            <span class="icon_delete_photo"></span>
            <span class="icon_delete_photo_hover"></span>
            </span>
            <span onclick="UProfile.setPrivateAccess({{$gallery->id}})"  title="Make private" class="icon_private">
            <span class="icon_private_photo"></span>
            <span class="icon_private_photo_hover"></span>
            </span>
            <span onclick="UProfile.setAsProfile({{$gallery->id}})" title="Make Profile" class="icon_image_profile">
            <span class=""></span>
            </span>
         </div>
      </div>
      @endforeach
      @endif
   </div>
   <div class="cl"></div>
   <div class="cl"></div>
</div>
<div style="display:none;">
   <div id="confirmDeleteModal" class="modal p0 confirmDeleteModal">
      <div class="pp_info_start pp_alert pp_confirm pp_cont" style="left: 0px; top: 0px; margin: 0;">
         <div class="cont">
            <div class="title">Delete photo?</div>
            <div class="img_chat">
               <div class="icon">
                  <img src="{{asset('/images/site/icons/icon_pp_sure.png')}}" height="48" alt="">
               </div>
               <div class="msg">This action can not be undone. Are you sure you wish to continue?</div>
            </div>
            <div class="double_btn">
               <button class="confirm_close btn small dgrey" onclick="UProfile.cancelGalleryConfirm(); return false;">Cancel</button>
               <button class="confirm_ok btn small marsh" onclick="UProfile.deleteGallery(); return false;">OK</button>
               <input type="hidden" name="deleteConfirmId" id="deleteConfirmId" value=""/>
               <div class="cl"></div>
            </div>
         </div>
      </div>
   </div>
</div>
<div style="display:none;">
   <div id="confirmDeleteVideoModal" class="modal p0 confirmDeleteVideoModal wauto">
      <div class="pp_info_start pp_alert pp_confirm pp_cont" style="left: 0px; top: 0px; margin: 0;">
         <div class="cont">
            <div class="title">Delete video?</div>
            <div class="img_chat">
               <div class="icon">
                  <img src="{{asset('/images/site/icons/icon_pp_sure.png')}}" height="48" alt="">
               </div>
               <div class="msg">This action can not be undone. Are you sure you wish to continue?</div>
            </div>
            <div class="double_btn">
               <button class="confirm_close btn small dgrey" onclick="UProfile.cancelGalleryConfirm(); return false;">Cancel</button>
               <button class="confirm_ok btn small marsh" onclick="UProfile.deleteVideoConfirm(); return false;">OK</button>
               <input type="hidden" name="deleteVideoConfirmId" id="deleteVideoConfirmId" value=""/>
               <div class="cl"></div>
            </div>
         </div>
      </div>
   </div>
</div>