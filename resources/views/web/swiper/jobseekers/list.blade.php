
 {{-- @dd($jobSeekers) --}}
<div class="overlay" style="position: fixed;top: 15%;left: 0;width: 100%;height: 100%;background-color: rgba(0, 0, 0, 0.5);z-index: 100;display: none;"></div>
<div class="swiper-container mySwiper">

    <div class="swiper-navigation-buttons">                    
        <div class="swiper-button-next swiperButton float-right" tabindex="0" role="button" aria-label="Next slide" aria-controls="swiper-wrapper-3c6e55462a735cf8" aria-disabled="false"></div>
        <div class="swiper-button-prev swiperButton float-left" tabindex="0" role="button" aria-label="Prev slide" aria-controls="swiper-wrapper-3c6e55462a735cf8" aria-disabled="false"></div>
    </div>

    <div class="swiper-wrapper">

    @if(isset($jobSeekers))
    @if ($jobSeekers && $jobSeekers->count() > 0)

        @foreach ($jobSeekers as $js)

            <div class="{{-- card  --}}swiper-slide shadow bg-white rounded job_row jobApp_{{-- {{$application->id}} --}} overflow-hidden" style="">
                <div class="{{-- card --}} overflow-hidden">

                    @php
                        $profile_image  = asset('images/site/icons/nophoto.jpg');
                        $profile_image_gallery    = $js->profileImage()->first();
                        if ($profile_image_gallery) {
                            // $profile_image   = assetGallery($profile_image_gallery->access,$js->id,'',$profile_image_gallery->image);
                            $profile_image   = assetGallery2($profile_image_gallery,'small');
                        }
                        $profile_imageBig  = asset('images/site/icons/nophoto.jpg');
                        $profile_imageBig_gallery    = $js->profileImage()->first();
                        if ($profile_imageBig_gallery) {
                            // $profile_imageBig   = assetGallery($profile_imageBig_gallery->access,$js->id,'',$profile_imageBig_gallery->image);
                            $profile_imageBig   = assetGallery2($profile_imageBig_gallery,'/');
                        }
                    @endphp

                    {{-- ============================================ Card Body ============================================ --}}

                    
                    <div class="{{-- card-body --}} pt-2">
                        <div class="row jobInfo">
                            <div class="col-md-6 col-12 videoDiv text-center"{{--  style="height: 55vh;" --}}>
                                <div class="js_profile_video">
                                    {{-- <div class="js_video_thumb">
                                        <a onclick="profileImage( '{{ $profile_imageBig }}')">  
                                            <img class="js_profile_photo w100" id="pic_main_img" src="{{$profile_image}}">
                                        </a>
                                    </div> --}}
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
                            
                        </div>
                        <div class="row">
                        
                            <div class="col-md-6 col-12 text-center">
                              <h3 class="font-weight-bold my-2"> {{$js->name}} {{$js->surname}} </h3>
                            </div>

                            <div class="col-md-6 col-12 text-center">
                                <h4 class="mb-3"> <span class="jobInfoFont">  Recent Job: </span>  {{$js->recentJob}} </h4> 
                            </div>
                        </div>

                        <div class="row p-2">
                            <div class="col-4">
                                <a class="jobDetailBtn blue-btn-mob d-flex justify-content-center align-items-center" target="_blank" href="{{route('jobSeekerInfo', ['id' => $js->id])}}">View Profile</a>
                            </div>
                            <div class="col-4">
                                <a class="blue-btn-mob viewCvButton d-flex justify-content-center align-items-center" onclick="viewJobseekerCv({{ $js->id }})" data-jsId = "{{ $js->id }}" >View CV</a>
                            </div>
                            <div class="col-4">
                                <a class="jobDetailBtn blue-btn-mob d-flex justify-content-center align-items-center" href="tel:{{ $js->phone }}">Call Candidate</a>
                            </div>
                        </div>

                        <div class="{{-- card-footer --}}text-muted p-1 block-box" style="position: fixed;width: 100%;bottom: 11%;">
                            <div class="box-footer clearfix">
                                <div class="block-div-{{ $js->id }}">
                                @if (in_array($js->id,$blockUsers))
                                    <button class="block-btn w27" onclick="swipeUnBlock('{{ $js->id }}')" class="unblock-btn"><i class="fas fa-ban"></i> UnBlock</button>
                                @else
                                    <button class="block-btn w27" onclick="swipeBlock('{{ $js->id }}')"><i class="fas fa-ban"></i> Block</button>
                                @endif
                                </div>
                                  
                                <div class="like-div-{{ $js->id }}">
                                @if (in_array($js->id,$likeUsers))
                                    <button class="unlike-btn w27" onclick="swipeUnlike('{{ $js->id }}')"><i class="fas fa-thumbs-up"> </i> UnLike</button>
                                @else
                                    <button class="like-btn w27" onclick="swipeLike('{{ $js->id }}')" data-jsid = "{{ $js->id }}"><i class="fas fa-thumbs-up"></i> Like</button> 
                                @endif
                                </div>
                           </div>
                        </div>
                    </div>

                    {{-- ============================================ Card Body end ============================================ --}}

                    {{-- ============================================ Card Footer ============================================ --}}


                    {{-- ============================================ Card Footer end ============================================ --}}

                </div>

            </div>

        @endforeach
        {{-- <div class="jobseeker_pagination pagination pagination-sm">{!! $jobSeekers->links() !!}</div> --}}

    @else 
        <p> No Record Found </p>
    @endif
    </div>

</div>



{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
<script type="text/javascript" src="{{ asset('js/mobile/likeUnlikeBlockUnblockJS.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/web/profile.js') }}"></script>

{{-- Icluded Common file here --}}
@include('web.swiper.jobseekers.swiper-common')


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
/*            height: 300px;*/
}
.card{overflow: scroll;}
.swiper-container{
/*    height: 100vh;*/
}
</style>