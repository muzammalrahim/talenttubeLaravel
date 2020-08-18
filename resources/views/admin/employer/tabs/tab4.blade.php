
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
</style>