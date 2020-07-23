{{-- @extends('site.user.usertemplate') --}}
@extends('site.employer.employermaster')

@section('custom_css')
<style>

    .js_location {
    font-size: 11px;
    }

</style>
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
@stop

@section('content')
<div class="newJobCont">
    <div class="head icon_head_browse_matches">Job Seekers List</div>

    {{-- @dump($jobSeekers) --}}
    <div class="add_new_job">

        <div class="job_row_heading jobs_filter">

        </div>

        @if ($jobSeekers->count() > 0)
        <div class="jobSeekers_list">
        @foreach ($jobSeekers as $js)

  {{--       {{$qualif = $js->industry_experience}}

            @dump($qualif) --}}



        <div class="jobSeeker_row dblock js_{{$js->id}} mb20 p20">

            <div class="jobSeeker_box relative dinline_block w100">

            <div class="js_profile w_30p w_box dblock fl_left">
                <div class="js_profile_cont center p10">
                    @php
                    $profile_image   = asset('images/site/icons/nophoto.jpg');
                    if ($js->profileImage){
                        $profile_image = asset('images/user/'.$js->id.'/gallery/'.$js->profileImage->image);
                    }
                    @endphp
                    <img class="js_photo w100" id="pic_main_img" src="{{$profile_image}}">
                </div>
                <div class="js_info center">
                    <div class="js_name"><h4 class="bold">{{$js->name}} {{$js->surname}}</h4></div>

                    {{-- <div class="js_status_label">{{$js->statusText}}</div> --}}

                    <div class="js_location">Location: {{($js->GeoCity)?($js->GeoCity->city_title):''}},  {{($js->GeoState)?($js->GeoState->state_title):''}}, {{($js->GeoCountry)?($js->GeoCountry->country_title):''}} </div>
                </div>
            </div>

            <div class="js_info w_70p w_box dblock fl_left">

                <div class="js_interested js_field">
                    <span class="js_label">Recent Job:</span>
                    <p>{{$js->recentJob}}</p>
                </div>

                <div class="js_about js_field">
                    <span class="js_label">About me:</span>
                    <p class="js_about_me"> {{$js->about_me}}</p>
                </div>
                
                <div class="js_interested js_field">
                    <span class="js_label">Interested in:</span>
                    <p>{{$js->interested_in}}</p>
                </div>

                <div class="js_education js_field">
                    <span class="js_label">Qualification:</span>{{implode(', ',getQualificationNames($js->qualification))}}
                </div>
                

                <div class="js_interested js_field">
                    <span class="js_label">Industry Experience:</span>
                        @if(isset($js->industry_experience))
                        @foreach ($js->industry_experience as $ind)
                             <p>{{getIndustryName($ind)}} </p>
                        @endforeach
                        @endif
                </div>

                {{-- @dump($js->industry_experience) --}}
                {{-- <div class="js_languages js_field">
                    <span class="js_label">Languages:</span>
                    <div class="js_tags dinline_block">
                        @if ($js->language)
                        @foreach ($js->language as $lang)
                            <span class="js_tag">{{getLanguage($lang)}}</span>
                        @endforeach
                        @endif
                    </div>
                </div>

                <div class="js_languages js_field">
                    <span class="js_label">Hobbies:</span>
                    <div class="js_tags dinline_block">
                        @if ($js->hobbies)
                        @foreach ($js->hobbies as $hobby)
                            <span class="js_tag">{{getHobby($hobby)}}</span>
                        @endforeach
                        @endif
                    </div>
                </div> --}}

            </div>
            {{-- @dump($likeUsers) --}}
            <div class="js_actionBtn">
                <a class="graybtn jbtn" href="{{route('jobSeekerInfo', ['id' => $js->id])}}">Detail</a>
                <a class="jsBlockUserBtn graybtn jbtn" data-jsid="{{$js->id}}">Block</a>
                @if (in_array($js->id,$likeUsers))
                <a class="active graybtn jbtn" data-jsid="{{$js->id}}">Liked</a>
                @else
                <a class="jsLikeUserBtn graybtn jbtn" data-jsid="{{$js->id}}">Like</a>
                @endif
            </div>

            </div>

        </div>
        @endforeach
        </div>
        @endif

    </div>

<div class="cl"></div>
</div>



<div style="display:none;">
<div id="confirmJobSeekerBlockModal" class="modal p0 confirmJobSeekerBlockModal wauto">
    <div class="pp_info_start pp_alert pp_confirm pp_cont" style="left: 0px; top: 0px; margin: 0;">
        <div class="cont">
            <div class="title">Block Job Seeker?</div>
            <div class="img_chat">
                <div class="icon">
                    <img src="{{asset('/images/site/icons/icon_pp_sure.png')}}" height="48" alt="">
                </div>
                <div class="msg">This action can not be undone. Are you sure you wish to continue?</div>
            </div>
            <div class="double_btn">
                <button class="confirm_close btn small dgrey" onclick="UProfile.cancelGalleryConfirm(); return false;">Cancel</button>
                <button class="confirm_JobSeekerBlock_ok btn small marsh">OK</button>
                <input type="hidden" name="jobSeekerBlockId" id="jobSeekerBlockId" value=""/>
                <div class="cl"></div>
            </div>
        </div>
        <div class="apiMessage"></div>
    </div>
</div>
</div>


@stop

@section('custom_footer_css')
<link rel="stylesheet" href="{{ asset('css/site/profile.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}">
{{-- <link rel="stylesheet" href="{{ asset('css/site/gallery_popup/magnific-popup.css') }}"> --}}
{{-- <link rel="stylesheet" href="{{ asset('css/site/gallery_popup/lc_lightbox.css') }}"> --}}


@stop

@section('custom_js')
<script src="{{ asset('js/site/jquery.modal.min.js') }}"></script>
<script src="{{ asset('js/site/jquery-ui.js') }}"></script>
<script src="{{ asset('js/site/common.js') }}"></script>
{{-- <script src="{{ asset('js/site/profile_photo.js') }}"></script>  --}}
{{-- <script src="{{ asset('js/site/gallery_popup/jquery.magnific-popup.js') }}"></script>  --}}
{{-- <script src="{{ asset('js/site/gallery_popup/lc_lightbox.lite.js') }}"></script> --}}

<script type="text/javascript">
$(document).ready(function() {

 $(document).on('click','.jsBlockUserBtn',function(){
     var jobseeker_id = $(this).data('jsid');
     console.log('jsBlockUserBtn click jobseeker_id = ', jobseeker_id);
     $('#jobSeekerBlockId').val(jobseeker_id);
     $('#confirmJobSeekerBlockModal').modal({
        fadeDuration: 200,
        fadeDelay: 2.5,
        escapeClose: false,
        clickClose: false,
    });
 });

 $(document).on('click','.confirm_JobSeekerBlock_ok',function(){
    console.log(' confirm_JobSeekerBlock_ok ');
    var jobseeker_id = $('#jobSeekerBlockId').val();

    $('.confirmJobSeekerBlockModal  .img_chat').html(getLoader('blockJobSeekerLoader'));
    var btn = $(this); //
    btn.prop('disabled',true);

    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.ajax({
        type: 'POST',
        url: base_url+'/ajax/blockJobSeeker/'+jobseeker_id,
        success: function(data){
            btn.prop('disabled',false);
            if( data.status == 1 ){
                $('.confirmJobSeekerBlockModal .img_chat').html(data.message);
                $('.jobSeeker_row.js_'+jobseeker_id).remove();
            }else{
                $('.confirmJobSeekerBlockModal .img_chat').html(data.error);
            }
        }
    });
});


$(document).on('click','.jsLikeUserBtn',function(){
    var btn = $(this);
    var jobseeker_id = $(this).data('jsid');
    console.log(' jsLikeUserBtn jobseeker_id ', jobseeker_id);
    // $(this).html(getLoader('blockJobSeekerLoader'));
    $(this).html('..');
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.ajax({
        type: 'POST',
        url: base_url+'/ajax/likeJobSeeker/'+jobseeker_id,
        success: function(data){
            btn.prop('disabled',false);
            if( data.status == 1 ){
                btn.html('Liked');
                // $('.jobSeeker_row.js_'+jobseeker_id).remove();
            }else{
                btn.html('error');
            }
        }
    });
});



});
</script>
@stop
