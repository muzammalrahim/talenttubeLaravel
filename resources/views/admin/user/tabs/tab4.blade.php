
<div class="tab-pane fade" id="custom-tabs-one-private" role="tabpanel" aria-labelledby="custom-tabs-one-private-tab">

    <div class="mb-2 bg-secondary text-white text-center"><b>Imges</b></div>

    <div class="imagesAdmin">
	     @if ($user_gallery)
	        @foreach ($user_gallery as $gallery)
	            <div id="{{$gallery->id}}" class="imagesDiv item profile_photo_frame gallery_{{$gallery->id}} {{($gallery->access == 2)?'private':'public'}}">
	               <a  data-offset-id="{{$gallery->id}}" class="show_photo_gallery"
	                    href="{{assetGallery($gallery->access,$record->id,'',$gallery->image)}}"
	                    data-lcl-thumb="{{assetGallery($gallery->access,$record->id,'small',$gallery->image)}}"
	                    >
	                    <img data-photo-id="{{$gallery->id}}"  id="photo_{{$gallery->id}}"   class="photo imgStyling"
	                    data-src="{{assetGallery($gallery->access,$record->id,'',$gallery->image)}}"
	                    src="{{assetGallery($gallery->access,$record->id,'small',$gallery->image)}}" >
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

        <div class="mb-2 bg-secondary text-white text-center"><b>Videos</b></div>
    
	<div id="video" class="list_videos">
	    <div id="list_videos_public" class="list_videos_public">
	        <div id="photo_add_video" class="item add_photo add_video_public item_video">
	            <a class="add_photo" onclick="UProfile.SelectVideoFile(); return false;">
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

        <div class="mb-2 bg-secondary text-white text-center"><b>Resume</b></div>

	<div class="private_attachments">
		@foreach ($attachments as $attachment)
			<div class="attachment_{{$attachment->id}} attachment_file">
					<div class="attachment"><img src="{{asset('images/site/icons/cv.png')}}" /></div>
					<span class="attach_title">{{ $attachment->name }}</span>
					<div class="attach_btns">
						<a class="attach_btn downloadAttachBtn btn btn-primary" href="{{asset('images/user/'.$attachment->file)}}">Download</a>
				{{-- 		<a class="attach_btn removeAttachBtn" data-attachmentid="{{$attachment->id}}" onclick="UProfile.confirmAttachmentDelete({{$attachment->id}});">Remvoe</a> --}}
					</div>
			</div>
		@endforeach		
	</div>
         
     <a class="btn btn-primary btnPrevious text-white text-white" onclick="scrollToTop()" >Previous</a>


</div>

<style type="text/css">

.imagesDiv{
position: relative;
    overflow: hidden;
    width: 126px;
    height: 140px;
    margin: 0 26px 25px 0;
    transition: 0.5s ease;
    /*float: left;*/
    width: auto;
    height: auto;
    float: none;
    display: inline-block;
    box-shadow: 0 2px 4px -1px rgba(0,0,0,.2), 0 4px 5px 0 rgba(0,0,0,.14), 0 1px 10px 0 rgba(0,0,0,.12);
    border-radius: 4px;

}
.imgStyling{
	width: auto;
    height: auto;
    max-width: 300px;
    max-height: 300px;
    min-width: 150px;

}
.gallery_action {
    border-top: 4px solid #142d69;
}
.icon_delete_photo_hover {
    background-position: 0 -32px;
    opacity: 0;
}
span.icon_image_profile {
    bottom: 42px;
    right: 5px;
}
.w100 {
    width: 100% !important;
}
.attachment_file {
    display: inline-block;
    text-align: center;
    border: 1px solid #7d7d7d;
    margin: 10px;
}
.attachment>img {
    height: 100px;
}
span.attach_title {
    color: white;
    display: block;
    /* margin: 4px; */
    padding: 6px 4px;
    background: #7d7d7d;
}
a.attach_btn.downloadAttachBtn.btn.btn-primary {
    margin: 5px;
    font-size: 12px;
}

</style>
