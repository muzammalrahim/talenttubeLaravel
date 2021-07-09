<div class="video text-dark mt-3">
    <div class="tabs_videos mb-2 font-weight-bold">Videos</div>
    <div id="video" class="list_videos">
        <div id="list_videos_public" class="list_videos_public">
            <div id="photo_add_video" class="item add_photo add_video_public item_video">
                <a class="add_photo" onclick="UProfile.SelectVideoFile(); return false;">
                    <img id="video_upload_select" class="transparent is_video bg-primary uploadedPhotos" onload="$(this).fadeTo(100,1);" src="{{asset('images/site/icons/add_video160x120.png')}}" style="opacity: 1;">
                </a>
            </div>
        </div>
        <div class="cl"></div>
        <div class="videos mt-2">
            @if ($videos->count() > 0 )
            @foreach ($videos as $video)
            <div id="v_{{$video->id}}" class="video_box mb-2">
              <i class="fa fa-trash float-right" onclick="delteVideo({{$video->id}})" data-toggle = "modal" data-target = "#delete_video_Popup" ></i>
              <div class="modal fade" id="modal{{$video->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-body mb-0 p-0">
                      <div class="embed-responsive embed-responsive-16by9 z-depth-1-half videoBox">
                          <video id="player" playsinline controls data-poster="https://mdbootstrap.com/img/screens/yt/screen-video-1.jpg">
                            <source src="{{assetVideo($video)}}" type="video/mp4" />
                          </video>
                      </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                      <button type="button" class="btn btn-outline-primary btn-rounded btn-md ml-4" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
              <a>{!! generateVideoThumbsm($video) !!}</a>

            </div>
            @endforeach
        	@endif
     	</div>
    </div>
</div>


{{-- Deleting Modal --}}

<div class="modal fade right" id="delete_video_Popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="t`rue">
  <div class="modal-dialog modal-notify modal-danger modal-side modal-top-right" role="document">
    <!--Content-->
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header">
        <p class="heading">Delete Video</p>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text">&times;</span>
        </button>
      </div>
      <!--Body-->
      <div class="modal-body">
        <div class="row">
          <div class="col">
            <p class="text-center"><i class="fas fa-trash fa-2x"></i></p>
          </div>
        </div>
        <div class="row text-center mt-3 px-4">
            <p>Are you sure you wish to continue?</p>
        </div>
      </div>
      <!--Footer-->
      <div class="modal-footer justify-content-center">
        <a type="button" class="btn btn-sm btn-outline-danger waves-effect" data-dismiss="modal">Cancel</a>
        <a type="button" id="deleteConfirmbutton" class="confirm_jobDelete_ok btn btn-sm btn-danger" onclick="deleteVideoConfirm()" data-dismiss="modal">Delete<i class="fas fa-trash ml-1 white-text"></i></a>
      </div>
      <input type="hidden" name="deleteVideoConfirmId" id="deleteVideoConfirmId" value=""/>
    </div>
    <!--/.Content-->
  </div>
</div>


<script type="text/javascript">
	
	// Delete video

this.delteVideo = function(video_id){
    console.log(' delteVideo  ', video_id);
    $('#deleteVideoConfirmId').val(video_id);
}

this.deleteVideoConfirm = function(){
    // $.modal.close();
    var video_id = $('#deleteVideoConfirmId').val();
    console.log(video_id);
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.ajax({
        type: 'POST',
        url: base_url+'/m/ajax/mdeleteVideo',
        data: {video_id: video_id},
        success: function(data){
            console.log(' data ', data);
            if(data.status == 1){
                $('#v_'+video_id).remove();
            }
        }
    });
}



</script>