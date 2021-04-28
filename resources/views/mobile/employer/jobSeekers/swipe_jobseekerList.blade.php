
 {{-- @dd($jobSeekers); --}}

@if(isset($jobSeekers))
@if ($jobSeekers && $jobSeekers->count() > 0)


    @foreach ($jobSeekers as $js)

    {{-- @dump($js) --}}

    <div class="card mb-3 shadow mb-3 bg-white rounded job_row jobApp_{{-- {{$application->id}} --}}">
        <div class="card">
            {{-- <div class="card-header jobInfoFont jobAppHeader p-2">Name:
                <span class="jobInfoFont font-weight-normal">{{$js->name}} {{$js->surname}}</span>
                <div class="jobInfoFont">Location:
                    <span class="font-weight-normal">{{$js->city}},  {{$js->state}}, {{$js->country}}</span>
                </div>
            </div> --}}

            @php
                $profile_image  = asset('images/site/icons/nophoto.jpg');
                $profile_image_gallery    = $js->profileImage()->first();
                // dump($profile_image_gallery);
                if ($profile_image_gallery) {
                    // $profile_image   = assetGallery($profile_image_gallery->access,$js->id,'',$profile_image_gallery->image);
                    $profile_image   = assetGallery2($profile_image_gallery,'small');
                    // dump($profile_image);
                }
            @endphp

            {{-- ============================================ Card Body ============================================ --}}

            <div class="card-body pt-2">
                <div class="row jobInfo">
                    <div class="col-md-6 col-12 videoDiv">
                        <div class="js_profile_video">
                            <div class="js_video_thumb">
                                <img class="js_profile_photo w100" id="pic_main_img" src="{{$profile_image}}">
                            </div>
                            <div class="videos_list">
                                @foreach($js->vidoes as $video)
                                    <input type="hidden" name="user_video" value="{{$video->file}}">
                                @endforeach
                            </div>

                        </div>
                        @if($js->vidoes->count() > 0)
                        <a onclick="profileVideoShow('{{assetVideo($js->vidoes->first())}}')" class="js_video_link" target="_blank">{!! generateVideoThumbsm($js->vidoes->first()) !!}</a>
                        @endif
                    </div>


                    <div class="col-md-6 col-12 text-center">
                      <h4 class="font-weight-bold m-0"> {{$js->name}} {{$js->surname}} </h4>
                    </div>

                    <div class="col-md-6 col-12 text-center">
                        <p> <span class="jobInfoFont">  Recent Job: </span>  {{$js->recentJob}} </p> 
                    </div>
                </div>

                <div class="row">
                    <div class="col-4">
                        <a class="jobDetailBtn graybtn jbtn m5 btn btn-sm btn-primary ml-0 btn-xs" href="{{route('MjobSeekersInfo', ['id' => $js->id])}}">View Profile</a>
                    </div>
                    <div class="col-4">
                        <a class="m5 btn btn-sm btn-primary ml-0 btn-xs viewCvButton" onclick="viewCv()" data-jsId = "{{ $js->id }}" >View CV</a>
                    </div>
                    <div class="col-4">
                        <a class="jobDetailBtn graybtn jbtn m5 btn btn-sm btn-primary ml-0 btn-xs" href="tel:{{ $js->phone }}">Call Candidate</a>
                    </div>
                </div>

              

            </div>

            {{-- ============================================ Card Body end ============================================ --}}


            {{-- ============================================ Card Footer ============================================ --}}

            <div class="card-footer text-muted p-1">
                <div>
                    <a class="jsBlockButton btn btn-sm btn-danger mr-0 btn-xs float-right" data-jsid ="{{$js->id}}">Block</a>
                    @if (in_array($js->id,$likeUsers))
                        <a class="btn btn-sm btn-danger mr-0 btn-xs unlikeEmpButton" data-jsid="{{$js->id}}" data-toggle="modal" data-target="#unlikeEmpModal">UnLike</a>
                    @else
                    <a class="jsLikeButton btn btn-sm btn-primary mr-0 btn-xs" data-jsid ="{{$js->id}}">Like</a>
                    @endif

                </div>
            </div>

            {{-- ============================================ Card Footer end ============================================ --}}

        </div>

    </div>

@endforeach
<div class="jobseeker_pagination cpagination">{!! $jobSeekers->links() !!}</div>
@endif

<!-- Modal -->
<div class="modal fade"id="videoShowModal"tabindex="-1"aria-labelledby="exampleModalLabel"aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body videoBox"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="closeVideo()">
          Close
        </button>
      </div>
    </div>
  </div>
</div>

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
<script type="text/javascript" src="{{ asset('js/mobile/likeUnlikeBlockUnblockJS.js') }}"></script>
<script type="text/javascript">

    $('.unlikeEmpButton').click(function(){
        var btn = $(this);
        var jobseeker_id = $(this).data('jsid');
        $('#idEmpInModalHidden').val(jobseeker_id);

    });

    $('.confirmUnlikeEmployer').click(function(){
        var btn = $(this);
        var jobseeker_id = $(this).data('jsid');
        var emp_id = $('#idEmpInModalHidden').val();
        console.log(emp_id);
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                type: 'POST',
                url: base_url+'/m/ajax/MunLikeUser/'+emp_id,
                data: {'id': emp_id},
                success: function(data){
                    if( data.status == 1 ){
                        $('.empLikeAlert').show().delay(3000).fadeOut('slow');
                        location.reload();
                    }
                }
            });
     });

    profileVideoShow =  function(video_url){
        console.log(' showVideoModal ', video_url);
        var videoElem  = '<video id="player" controls>';
        videoElem     += '<source src="'+video_url+'" type="video/mp4">';
        videoElem     += '</video>';
        $('#videoShowModal .videoBox').html(videoElem);
        $('#videoShowModal').modal('show'); 
    }

    closeVideo = function(){
        $('#videoShowModal').modal('hide'); 

    }

    viewCv = function(){
        var jsId = $('.viewCvButton').attr('data-jsid');
        // console.log(jsId);

        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                type: 'POST',
                url: base_url+'/m/ajax/jobseeker/viewCv/'+jsId,
                data: {'id': jsId},
                success: function(data){
                console.log(data)
                location.href = data;
                }
            });
    }


</script>
@endif

