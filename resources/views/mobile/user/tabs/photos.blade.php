
      <div class="tabs_photos text-dark mb-2 font-weight-bold">Photos</div>
        <div class="list_photos_public d-flex">
            <div class="list_photos_trans">
            <div id="photo_add_public" class="item add_photo add_photo_public">
                <a href="#null" class="dblock uploadProgressModalBtn"><img src="{{asset('/images/site/icons/add_photo126x140.png')}}" alt="" class="bg-primary float-left mr-3 ml-1 mt-2 uploadedPhotos" ></a>
            </div>
            @if ($user_gallery)
                @foreach ($user_gallery as $gallery)
                    <div id="{{$gallery->id}}" class="float-left mt-1 item profile_photo_frame gallery_{{$gallery->id}} {{($gallery->access == 2)?'private':'public'}}">
                        <a  data-offset-id="{{$gallery->id}}" class="show_photo_gallery js-smartPhoto2" data-group="no-gravity"
                            href="{{assetGallery($gallery->access,$user->id,'',$gallery->image)}}"
                            data-lcl-thumb="{{assetGallery($gallery->access,$user->id,'small',$gallery->image)}}"
                            >
                            <img data-photo-id="{{$gallery->id}}"  id="photo_{{$gallery->id}}"   class="photo m-1 uploadedPhotos"
                            data-src="{{assetGallery($gallery->access,$user->id,'',$gallery->image)}}"
                            src="{{assetGallery($gallery->access,$user->id,'small',$gallery->image)}}"{{--  alt="thumbnail" class="img-thumbnail" style="width: 150px;height:150px;" --}}>
                        </a>
                        <div class="gallery_action float-right">
                            {{-- <i class="fas fa-user"></i> --}}
                                <span onclick="UProfile.confirmPhotoDelete({{$gallery->id}});" title="Delete photo" class="icon_delete">
                                    {{-- <span class="icon_delete_photo"></span> --}}
                                    <div class="iconPosition"><i class="fas fa-trash"></i></div>
                                    <span class="icon_delete_photo_hover"></span>
                                </span>
                                <span onclick="UProfile.setPrivateAccess({{$gallery->id}})"  title="Make private" class="icon_private">
                                    {{-- <span class="icon_private_photo"></span> --}}
                                    <div class="iconPosition"><i class="fas fa-lock"></i></div>

                                    <span class="icon_private_photo_hover"></span>
                                </span>
                                <span onclick="UProfile.setAsProfile({{$gallery->id}})" title="Make Profile" class="icon_image_profile">
                                        {{-- <span class=""></span> --}}
                                    <div class="iconPosition"><i class="fas fa-user"></i></div>

                                </span>
                        </div>
                    </div>
                @endforeach
            @endif
            </div>
        </div>

        {{-- ============================================================ Photos Delete Modal ============================================================ --}}

        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">

        <!-- Add .modal-dialog-centered to .modal-dialog to vertically center the modal -->
        <div class="modal-dialog modal-dialog-centered" role="document">


          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Delete confirmation</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
             <h5 class="modal-title" id="exampleModalLongTitle">Are you sure to delete the picture?</h5>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-primary" onclick="UProfile.deleteGallery(); return false;">Yes</button>
               <input type="hidden" name="deleteConfirmId" id="deleteConfirmId" value=""/>
            </div>
          </div>
        </div>
      </div>