
 {{-- @dd($jobSeekers) --}}

<div class="swiper-container mySwiper">
    <div class="swiper-button-next swiperButton" tabindex="0" role="button" aria-label="Next slide" aria-controls="swiper-wrapper-3c6e55462a735cf8" aria-disabled="false"></div>
    <div class="swiper-button-prev swiperButton" tabindex="0" role="button" aria-label="Prev slide" aria-controls="swiper-wrapper-3c6e55462a735cf8" aria-disabled="false"></div>

  <div class="swiper-wrapper">

        @if(isset($jobSeekers))
        @if ($jobSeekers && $jobSeekers->count() > 0)

            @foreach ($jobSeekers as $js)

            <div class="card mb-3 swiper-slide shadow mb-3 bg-white rounded job_row jobApp_{{-- {{$application->id}} --}}">
                <div class="card">

                    {{-- <div class="swiper-button-next"></div> --}}

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


                        $profile_imageBig  = asset('images/site/icons/nophoto.jpg');
                        $profile_imageBig_gallery    = $js->profileImage()->first();
                        // dump($profile_imageBig_gallery);
                        if ($profile_imageBig_gallery) {
                            // $profile_imageBig   = assetGallery($profile_imageBig_gallery->access,$js->id,'',$profile_imageBig_gallery->image);
                            $profile_imageBig   = assetGallery2($profile_imageBig_gallery,'/');
                            // dump($profile_imageBig);
                        }
                    @endphp

                    {{-- ============================================ Card Body ============================================ --}}

                    <div class="card-body pt-2">
                        <div class="row jobInfo">
                            <div class="col-md-6 col-12 videoDiv text-center">
                                <div class="js_profile_video">
                                    <div class="js_video_thumb">

                                        <a onclick="profileImage( '{{ $profile_imageBig }}')">  
                                            <img class="js_profile_photo w100" id="pic_main_img" src="{{$profile_image}}">
                                        </a>
                                    
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
                                {{-- @dump(userLocation($js)) --}}

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <a class="jobDetailBtn graybtn jbtn m5 btn btn-sm btn-primary ml-0 btn-xs" target="_blank" href="{{route('MjobSeekersInfo', ['id' => $js->id])}}">View Profile</a>
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
        {{-- <div class="jobseeker_pagination pagination pagination-sm">{!! $jobSeekers->links() !!}</div> --}}
        @endif

    </div>
</div>

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
<script type="text/javascript" src="{{ asset('js/mobile/likeUnlikeBlockUnblockJS.js') }}"></script>

{{-- Icluded Common file here --}}
@include('mobile.employer.jobSeekers.Swipe-jobseeker-common')


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


</script>
@endif

<style type="text/css">
    img.img-fluid.imageSizeModal.z-depth-1 {
    height: 300px;
}
.card{overflow: scroll;}
</style>