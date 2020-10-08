
<div class="tab-pane fade" id="custom-tabs-one-private" role="tabpanel" aria-labelledby="custom-tabs-one-private-tab">

    <div class="mb-2 bg-secondary text-white text-center"><b>Images</b></div>
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
