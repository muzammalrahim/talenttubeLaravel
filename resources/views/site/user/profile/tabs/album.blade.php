<div class="Gallery" >
      <h2>Photos</h2>
      <ul>
         <li class="album-upload-img uploaded-photo field">
            <div class="" onclick="uploadPhoto()" >
               <div class="upload-file">
                  <i class="fas fa-images"></i>
                  <span>Upload-photo</span>
               </div>
               {{-- <input type="file" id="files" name="files[]" multiple /> --}}
            </div>

       
        @if ($user_gallery)
          @foreach ($user_gallery as $gallery)

            <span class="pip imgContainer_{{$gallery->id}}">
               <img data-photo-id="{{$gallery->id}}"  id="photo_{{$gallery->id}}" class="photo imageThumb"
                      data-src="{{assetGallery($gallery->access,$user->id,'',$gallery->image)}}"
                    src="{{assetGallery($gallery->access,$user->id,'small',$gallery->image)}}" />
              <br>

              <span class="remove" onclick="deletePhotoPopUp({{$gallery->id}})" data-toggle="modal" data-target="#deletePhotModal">Delete</span>

              <br>

              <span class="Profile-img" onclick="setProfilePicture({{$gallery->id}})">Profile Image</span>

              <br>

              <span class="Private-img" onclick="makePhotoPrivate({{$gallery->id}})">Private Image</span>

            </span>
               
          @endforeach
      @endif

    </li>

    </ul>

</div>






<div class="modal fade" id="deletePhotModal" role="dialog">
  <div class="modal-dialog delete-applications">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <i data-dismiss="modal" class="close-box fa fa-times"></i>                      
        <h1 class="modal-title"><i class="fa fa-trash trash-icon"></i>Delete Photo?</h1>
      </div>
      <div class="modal-body">
        <strong>This action can not be undone. Are you sure you wish to continue?</strong>
      </div>
      <div class="dual-footer-btn">
        <input type="hidden" name="" id="deleteConfirmId"/>

        <button type="button" class="btn btn-default black_btn" data-dismiss="modal"><i class="fa fa-times"></i>Cancel</button>
        <button type="button" class="orange_btn" onclick="deletePhotConfirm()" data-dismiss="modal"><i class="fa fa-check"></i>OK</button>
      </div>
    </div>
    
  </div>
</div>




<style type="text/css">
  .uploadingImage span {
    margin: 6px 0px;
    display: inline-block;
    clear: both;
}
</style>