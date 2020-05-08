<!-- gallery blade -->





<div class="list_photos_public">
    <div class="list_photos_trans">
    
    <div id="photo_add_public" class="item add_photo add_photo_public">
        <a href="#null" class="dblock uploadProgressModalBtn"><img src="{{asset('/images/site/icons/add_photo126x140.png')}}" alt=""></a>
    </div>
    
    {{-- @dump($user_gallery) --}}

    @if ($user_gallery)
        @foreach ($user_gallery as $gallery)
            <div id="{{$gallery->id}}" class="item profile_photo_frame gallery_{{$gallery->id}}">
                <a  data-offset-id="{{$gallery->id}}" class="show_photo_gallery"
                    href="{{asset('images/user/'.$user->id.'/gallery/'.$gallery->image)}}" 
                    data-lcl-thumb="{{asset('images/user/'.$user->id.'/gallery/small/'.$gallery->image)}}"
                    >
                    <img data-photo-id="{{$gallery->id}}"  id="photo_{{$gallery->id}}"   class="photo" 
                    data-src="{{asset('images/user/'.$user->id.'/gallery/'.$gallery->image)}}"   
                    src="{{asset('images/user/'.$user->id.'/gallery/small/'.$gallery->image)}}" >
                </a>
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
        @endforeach
    @endif
    </div>
    <div class="cl"></div>
    
    {{-- <span id="some_link_photo_counter_public" class="some_link_photo_counter"></span>
    <div class="some_link_add_photo">
        <div>
            <form>
                <input id="some_link_photo_public" type="file" title="" multiple="" name="file_public[]">
                <input id="some_link_photo_public_reset" type="reset" value="">
            </form>
        </div>
         
    </div> --}}
    
    <div class="cl"></div>
</div>



{{--
<div id="uploadProgressModal" class="modal p0 uploadProgressModal">
    <div  class="pp_edit_info pp_cont m0">
        <div class="frame">
            <a class="icon_close" href="#close"><span class="close_hover"></span></a>
            <div class="head">Upload Photos</div>
            <div class="cont"> 
                <div class="select_file">Select File to upload </div>   
                <div class="css_loader loader_edit_popup">
                    <div class="spinner center">
                        <div class="spinner-blade"></div>
                        <div class="spinner-blade"></div>
                        <div class="spinner-blade"></div>
                        <div class="spinner-blade"></div>
                        <div class="spinner-blade"></div>
                        <div class="spinner-blade"></div>
                        <div class="spinner-blade"></div>
                        <div class="spinner-blade"></div>
                        <div class="spinner-blade"></div>
                        <div class="spinner-blade"></div>
                        <div class="spinner-blade"></div>
                        <div class="spinner-blade"></div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>
--}}
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