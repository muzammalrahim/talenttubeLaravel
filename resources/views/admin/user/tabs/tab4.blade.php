
<div class="tab-pane fade" id="custom-tabs-one-private" role="tabpanel" aria-labelledby="custom-tabs-one-private-tab">

    <div class="mb-2 bg-secondary text-white text-center"><b>Images</b> </div>
    <a style="color: white;" class="btn btn-info uploadProgressModalBtn">Add Image</a>
    <div class="imagesAdmin">
	     @if ($user_gallery)
         <div id="images" class="imagesDiv">
	        @foreach ($user_gallery as $gallery)
                <div class="imageDiv" id="photodiv_{{$gallery->id}}" style="display: inline-block;">
                <img src="{{assetGallery($gallery->access,$record->id,'',$gallery->image)}}" id="photo_{{$gallery->id}}" class="photo">
                <div class="img-overlay text-center">
                    <button onclick="UProfile.confirmPhotoDelete({{$gallery->id}}); return false;" class="btn btn-sm btn-success">Delete</button>
                </div>
                </div>
           @endforeach


        </div>
	    @endif
    </div>
    <div style="display: none;">
        <img id="image" src="" alt="Picture">
    </div>
        <div class="mb-2 bg-secondary text-white text-center"><b>Videos</b></div>

        <div class="video text-dark mt-3">
            <div class="tabs_videos mb-2 font-weight-bold">Videos</div>
                <div id="video" class="list_videos">
                    <div id="list_videos_public" class="list_videos_public">
                        <div id="photo_add_video" class="item add_photo add_video_public item_video">
                            <a class="add_photo" return false;">
                                <img id="video_upload_select" class="transparent is_video bg-primary uploadedPhotos" onload="$(this).fadeTo(100,1);" src="{{asset('images/site/icons/add_video160x120.png')}}" style="opacity: 1;">
                            </a>
                        </div>
                    </div>
                    <div class="cl"></div>


                    <div class="videos mt-2">
                        @if ($videos->count() > 0 )
                        @foreach ($videos as $video)
                            <div id="v_{{$video->id}}" class="showinline video_box mb-2">
                                <!-- Grid row -->


                      <!--Modal: Name-->
                      <div class="modal fade" id="modal{{$video->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                          <!--Content-->
                          <div class="modal-content">
                            <!--Body-->
                            <div class="modal-body mb-0 p-0">
                              <div class="embed-responsive embed-responsive-16by9 z-depth-1-half videoBox">
                                  <video id="player" playsinline controls data-poster="https://mdbootstrap.com/img/screens/yt/screen-video-1.jpg">
                                    <source src="{{assetVideo($video)}}" type="video/mp4" />
                                  </video>

                              </div>
                            </div>
                            <!--Footer-->
                            <div class="modal-footer justify-content-center">
                              <button type="button" class="btn btn-outline-primary btn-rounded btn-md ml-4" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                          <!--/.Content-->
                        </div>
                      </div>

                      <!--Modal: Name-->
                    <a class="showinline">
                        <div class="text-center">
                          {!! generateVideoThumbsm($video) !!}

                          <div class="img-overlay">
                            <button onclick="UProfile.deleteVideoConfirm({{$video->id}}); return false;" class="btn btn-sm btn-success">Delete</button>
                          </div>
                        </div>
                    </a>
                            </div>
                        @endforeach
                    @endif

                 </div>




                </div>
            </div>

        <div class="mb-2 bg-secondary text-white text-center"><b>Resume</b></div>
        <div id="photo_add_resume" class="item add_photo add_video_public item_video md-2">
            <a class="add_photo" return false;">
                <img id="video_upload_select" class="transparent is_video bg-primary uploadedPhotos" onload="$(this).fadeTo(100,1);" src="{{asset('images/site/icons/add_video160x120.png')}}" style="opacity: 1;">
            </a>
        </div>
	<div class="private_attachments">
		@foreach ($attachments as $attachment)
			<div class="attachment_{{$attachment->id}} attachment_file">
					<div class="attachment"><img src="{{asset('images/site/icons/cv.png')}}" /></div>
					<span class="attach_title">{{ $attachment->name }}</span>
					<div class="attach_btns">
						<a class="attach_btn downloadAttachBtn btn btn-primary" href="{{asset('images/user/'.$attachment->file)}}">Download</a>
						<a class="attach_btn downloadAttachBtn btn btn-primary" style="color: white;" data-attachmentid="{{$attachment->id}}" onclick="UProfile.deleteAttachment({{$attachment->id}});">Remove</a>
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
