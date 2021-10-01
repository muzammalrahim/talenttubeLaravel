{{-- @extends('adminlte::master') --}}
@extends('web.register.registerMaster')
{{-- @extends('adminlte::master') --}}


@section('title', $title)

@section('content_header')
    <h1 class="m-0 text-dark">Register</h1>
@stop


@section('custom_css')
    <link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site/register.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site/card.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/site/jquery.formstyler.css')}}"/>
    <link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">

@stop

@section('classes_body', 'register step2')

@section('body')


<!-- main -->
<div class="main  above ">
    <input type="hidden" id="userType" name="userType" value="user" />
{{--    <input type="hidden" id="userStep" name="userStep" value="{{($user->step2)?($user->step2):2}}" />--}}
    <!-- header -->
    <div class="header">
        <div id="join_step" class="step">
            <ul>
                <li class="selected pointer pointToStep1">1</li>
                <li class="pointer pointToStep2" style="display:none;">2</li>
                <li class="pointer pointToStep3" style="display:none;">3</li>
                <li class="pointer pointToStep4" style="display:none;">4</li>
                <li class="pointer pointToStep5" style="display:none;">5</li>
                <li class="pointer pointToStep6" style="display:none;">6</li>
                <li class="pointer pointToStep7" style="display:none;">7</li>
                <li class="pointer pointToStep8" style="display:none;">8</li>
                <li class="pointer pointToStep9" style="display:none;">9</li>
            </ul>

        </div>
        <div class="slogan"><span id="join_slogan">Answer 6 questions to calculate your best matches.</span></div>

        <div class="logo">
            <a href="./index"><img src="{{asset('/images/logo.png')}}" style="max-height:45px;  max-width:238px;" alt="" /></a>
        </div>
    </div>
    <!-- /header -->



    <div class="content">
        <div class="full_step_error"></div>
        <div class="mw50 dtable margin_auto">
            <div id="full_step_1" class="bl_card_question" style="display:none;">

                {{-- <div class="arrows initialPrevQuestion pointer questionNaviateTo"  data-action="previous" >
                        <h1><i class="initial_arrow fas fa-arrow-left"></i></h1>
                </div> --}}

                {{-- <div class="arrows initialNextQuestion pointer questionNaviateTo" data-action="next" >
                    <h1><i class="initial_arrow fas fa-arrow-right"></i></h1>
                </div> --}}


                <div class="card_question_cont">
                    <div id="card_question_no" class="card_question no hide answer">
                        <div class="question_vh">
                            {{-- <img src="../images/icon_card_answer_no.png" width="224" height="224" alt="" /> --}}
                            <i class="fas fa-times"></i>                        
                            <span>No</span>
                        
                        </div>
                    </div>
                    <div id="card_question_yes" class="card_question yes hide answer">
                        <div class="question_vh">
                            {{-- <img src="../images/icon_card_answer_yes.png" width="224" height="224" alt="" /> --}}
                            <i class="fas fa-check"></i>
                            <span>Yes</span>
                        </div>
                    </div>

                    <div data-field="graduate_intern" id="graduate_intern" class="card_question" data-id="graduate_intern">
                        <div class="count">6 of 6</div><div class="question_txt">Are you seeking a Graduate Program or Internship?</div>
                    </div>

                    <div data-field="part_time" id="part_time" class="card_question" data-id="part_time">
                        <div class="count">5 of 6</div><div class="question_txt">Are you open to Part Time or Casual work?</div>
                    </div>

                    <div data-field="temporary_contract" id="temporary_contract" class="card_question" data-id="temporary_contract">
                        <div class="count">4 of 6</div><div class="question_txt">Are you open to temporary and contract work?</div>
                    </div>

                    <div data-field="fulltime" id="fulltime" class="card_question" data-id="fulltime">
                        <div class="count">3 of 6</div><div class="question_txt">Are you looking for Full Time Employment?</div>
                    </div>

                    <div data-field="relocation" id="relocation" class="card_question" data-id="relocation">
                        <div class="count">2 of 6</div><div class="question_txt">Are you looking or willing to relocate for your next job opportunity?</div>
                    </div>

                    <div data-field="resident" id="resident" class="card_question first active1"  data-id="resident">
                        <div class="count">1 of 6</div><div class="question_txt">Are you a Permanent Resident or Citizen of Australia or New Zealand?</div>
                    </div>

                    <div class="card_decor_left1"></div>
                    <div class="card_decor_left2"></div>
                    <div class="card_decor_right1"></div>



                </div>


                <div class="card_question_btn">
                    <button class="arrows initialPrevQuestion pointer questionNaviateTo"  data-action="previous" >
                        <h1><i class="initial_arrow fas fa-arrow-left"></i></h1>
                    </button>
                    
                            <button data-action="0" class="btn large pink fl_left btn_question">No</button>
                    <button data-action="1" class="btn large turquoise fl_right btn_question">Yes</button>
                    <div class="cl"></div>
                </div>
            </div>
            <!-- step 1 end -->


           <div id="full_step_3" class="bl_card_profile"  style="display:none;">
                <div class="card_profile">
                    <div class="part_photo">
                        <div class="upload_file"><div class="upload"><div class="bl photo_add">Add a Photo</div></div></div>
                        <div class="name"></div>
                        <div class="name_info error to_hide"></div>
                        <div class="recent_job m5 mt20 relative">
                             <div class="title"> Your current or most recent job title</div>
                             <input type="text" id="recentJob" name="recentJob" value="" />
                             <div id="recentJob_error" class="error to_hide">Required field!</div>
                        </div>

                        <div class="organisation m5 mt20 relative">
                             <div class="title">The organisation you held the above title</div>
                             <input type="text" id="organHeldTitle" name="organHeldTitle" value="" />
                             <div id="organHeldTitle_error" class="error to_hide">Required field!</div>
                        </div>

                    </div>

                    <div id="frm_card_join" class="card_profile_info card_join">

                        <div class="bl bl_basic">

                            <div class="title">About me</div>
                            <div id="about_me_error" class="error to_hide">Required field!</div>
                            <textarea id="about_me" class="placeholder_always fl_basic" name="about_me" placeholder="Summarise your career, studies & skills here" maxlength="300"></textarea>
                            <span id="arChars" class="rChars">300</span> Character(s) Remaining
                        </div>
    
                        <div class="bl bl_basic">
                            <div class="title">Interested in</div>
                            <div id="interested_in_error" class="error to_hide">Required field!</div>

                            <textarea id="interested_in" class="placeholder_always fl_basic" name="interested_in" placeholder="What opportunities are you open to" maxlength="150"></textarea>
                            <span id="irChars" class="rChars">150</span> Character(s) Remaining
                        </div>

                        <div class="row text-center">


                        <div class="col">

                            <button id="user_step3_done" class="btn_join_submit btn btn-primary">Done</button>
                        </div>

                        </div>




                    </div>
                </div>
            </div>



            <div id="full_step_4" class="bl_card_qualification wauto"  style="display:none;">
                <div class="ind_exp">
                    <div class="ind_exp_h">
                        <p>What year did you complete your final year of high school ? </p>
                    </div>
                    <div class="qualification_type_cont mb20 center ageCal">
                        <select id="year" name="passing_year" class="w80">
                            {{ $last= date('Y')-50 }}
                            {{ $now = date('Y') }}

                            @for ($i = $now; $i >= $last; $i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                </div>

                <div class="ind_exp">
                    <div class="ind_exp_h">
                        <p>Please select the highest or most relevant studies you have completed or currently studying</p>
                    </div>

                    <div class="qualification_selected_type mb20 center">
                        <div class="qualification_type_cont">
                            <select class="qualification_type" id="qualification_type" name="qualification_type" data-placeholder="Select Qalification & Trades">
                                 <option value="">Select Qalification & Trades</option>
                                 <option value="certificate">Certificate or Advanced Diploma</option>
                                 <option value="trade">Trade Certificate </option>
                                 <option value="degree">University Degree</option>
                                 <option value="post_degree">University Post Graduate (Masters or PHD) </option>
                            </select>
                        </div>
                    </div>

                    <div class="select_qualification_list" style="display: none;">
                        <div class="qualification_list">
                            <div class="qualification_ul_cont">
                                <ul class="qualification_ul item_ul">
                                     @php
                                        $qualifications = getQualificationsList();
                                    @endphp

                                     @if (!empty($qualifications))
                                      @foreach ($qualifications as $qkey => $quaf)
                                        <li class="{{$quaf['type']}}" data-id="{{$quaf['id']}}"> {{$quaf['title']}} </li>
                                      @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>


                    <div class="join_btn mt20 center">
                        <div class="join_industry_error"></div>
                        <button id="user_step4_done" class="btn turquoise small btn_join_submit">Done</button>
                    </div>

                </div>
            </div>



            <div id="full_step_5" class="bl_card_indExp"  style="display:none;">
                <div class="ind_exp">
                    <div class="ind_exp_h">
                        <p>Please select from the industries below that you currently or previously have worked in. You can select up 5 industries 

                        </p>
                    </div>

                    <div class="industry_list">
                        <div class="industry_ul_cont">
                            <ul class="industry_ul item_ul">
                                 @php
                                    $industries = getIndustries();
                                @endphp

                                 @if (!empty($industries))
                                  @foreach ($industries as $ikey => $industry)
                                    <li data-id="{{$ikey}}"> {{$industry}} </li>
                                  @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>

                    <div class="join_btn mt20 center">
                        <div class="join_industry_error"></div>
                        <button id="user_step5_done" class="btn turquoise small btn_join_submit industryExpBtn_done" disabled="true">Done</button>
                    </div>

                </div>
            </div>



              <div id="full_step_6" class="bl_card_indExp center"  style="display:none;">
                <div class="ind_exp">
                    <div class="ind_exp_h">
                        <p>What’s a rough idea of the salary range you are open to?</p>
                    </div>

                    <div class="salary_list">
                        <div class="salary_list_cont">
                            <ul class="salary_ul item_ul">
                                @php
                                    $salaries = getSalariesRange();
                                @endphp

                                 @if (!empty($salaries))
                                  @foreach ($salaries as $ikey => $salary)
                                    <li data-id="{{$ikey}}"> {{$salary}} </li>
                                  @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>

                    <div class="join_btn mt20 center">
                        <button id="user_step6_done" class="btn turquoise small btn_join_submit " disabled="true">Done</button>
                    </div>

                </div>
            </div>


            <div id="full_step_7" class="bl_card_indExp"  style="display:none;">
                <div class="ind_exp">
                    <div class="ind_exp_h">
                        <p>
                            Well done candidates, you’re nearly at the final stage. To complete your application, all you need to do is upload your ‘elevator pitch’, which is a short 30-60 second video...
                        </p>
                        <div class="step2_uplod_info">
                            <p> 
                                Record a short 30-60 second video of yourself, and upload it in the portal below. Be sure to say hi and tell us about yourself. You can be as casual as you like, this is more about employers getting an idea of your personality and culture fit. 
                            </p>
                        </div>
                        <div class="userUpload">
                            <div class="userVideoCont">
                                <div class="userVideo">
                                    <div class="title_private_photos title_videos">Upload Videos</div>
                                    <div id="list_videos_public" class="list_videos_public">
                                        <div id="photo_add_video" class="item add_photo add_video_public item_video">
                                            <a class="add_photo">
                                                <img id="video_upload_select" class="transparent is_video" src="{{ asset('images/site/icons/add_video160x120.png') }}" style="opacity: 1">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="list_videos"></div>
                                </div>
                            </div>
                        </div>
                        <div class="join_btn mt20 center">
                            <button id="user_step7_done" class="btn turquoise small btn_join_submit">Done</button>
                        </div>
                    </div>
                </div>
            </div>



            <div id="full_step_8" class="bl_card_Final full_step_8"  style="display:none;">
                <div class="ind_exp">
                    <div class="ind_exp_h">
                        <p>Almost done candidates, you’re at the final stage. To complete your application, all you need to upload your resume...</p>
                        <div class="step2_uplod_info">
                            <p>
                                Please upload your most current resume.If you prefer, we also encourage you to remove some of your personal details (such as your full name, address & contact details) for added privacy. 

                            </p>


                        </div>

                        {{-- <p class="info">You can chose to save and exit here, and return to upload your resume and video when you’re ready. Please note your application will only become active and viewable to prospective employers, after your video and resume are uploaded.</p> --}}
                    </div>

                    <div class="userUpload">
                       <div class="userResumeCont">
                        <div class="userResume">
                         <div class="title_private_photos title_videos">Resume</div>
                            <form id="frm_upload" class=" submit-document" action="route('userUploadResume')" method="post" enctype="multipart/form-data">
                              {{csrf_field()}} <br>
                              <input type="file" name="resume" id="resume" accept=".pdf,.doc,.docx">
                              <a id="user_step8_done" class="btn turquoise violet save-resume-btn valign-top" style="width:fit-content;" name="submit">Done</a>
                            </form>
                            <div class="private_attachments"></div>
                            <div class="upload_resume_error"></div>
                            <p class="resumeErroe hide_it ">  </p>
                        </div>
                       </div>

{{--                       <div class="userVideoCont">--}}
{{--                           <div class="userVideo">--}}
{{--                           <div class="title_private_photos title_videos">Upload Videos</div>--}}
{{--                           <div id="list_videos_public" class="list_videos_public">--}}
{{--                            <div id="photo_add_video" class="item add_photo add_video_public item_video">--}}
{{--                                <a class="add_photo" >--}}
{{--                                    <img id="video_upload_select" class="transparent is_video" src="{{asset('images/site/icons/add_video160x120.png')}}" style="opacity: 1;">--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                           </div>--}}

{{--                           <div class="list_videos"></div>--}}
{{--                           </div>--}}
{{--                       </div>--}}
                    </div>

                    <div class="join_done"></div>

{{--                    <div class="join_btn mt20 center">--}}
{{--                        <button id="user_step8_done" class="btn turquoise small btn_join_submit">Done</button>--}}
{{--                    </div>--}}

                </div>
            </div>


            <div id="full_step_9" class="bl_card_final full_step_9" style="display: none">
                <div class="ind_exp">
                    <div class="ind_exp_h" style="">
                        <p class="tagging">
                            Good news, you’ve completed your application profile. Now, to help employers find you easier, please add as many tags that best describe you.
                        </p>
                        <div class="taging_h_info">
                            {{-- <p> Be sure to tag the following:</p>
                            <p>*Names of organisations and companies you’ve worked for, including charities and not for profits</p>
                            <p>*Job Titles you have held</p>
                            <p>*Skills you have (eg; customer service, java Developer, sales, book keeping, etc)</p>
                            <p>*Institutions you’ve studied, including the names of schools, colleges, universities and others</p>
                            <p>*The names of courses you’re studying or have completed</p>
                            <p>*The name of qualifications you have (eg; RG146, RSA, etc)</p>
                            <p>*Languages you speak (other than English)</p>
                            <p>*Hobbies and personal interests are fine as well</p> --}}
                        </div>
                    </div>

                    <div class="user_tagging">
                        @include('site.layout.tagging')
                    </div>

                    <div class="join_btn mt20 center">
                        <button id="user_step9_done" class="btn turquoise small btn_join_submit " disabled="true">Save Tags</button>
                        <button id="tag_skip_btn" class="btn turquoise small btn_join_submit ">Skip</button>
                    </div>

                </div>
            </div>

            <div id="full_step_10" class="bl_card_Final full_step_10" style="display: none">
                <div class="ind_exp">
                    <div class="ind_exp_h">
                        <p class="center" style="display: none">Browse Jobs</p>
                        <div class="jobs_list">
                            <div class="css_loader">
                                <div class="spinner center">
                                    <div class="spinner-blade"></div>
                                    <div class="spinner-blade"></div>
                                    <div class="spinner-blade"></div>
                                    <div class="spinner-blade"></div>
                                    <div class="spinner-blade"></div>
                                    <div class="spinner-blade"></div>
                                    <div class="spinner-blade"></div>
                                    <div class="spinner-blade"></div>
                                    <div class="spinner-blade"></div>
                                    <div class="spinner-blade"></div>
                                    <div class="spinner-blade"></div>
                                    <div class="spinner-blade"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="join_btn mt20 center">
                        <button id="user_step10_done" class="btn turquoise small btn_join_submit">Skip For Now</button>
                    </div>
                </div>
            </div>

        </div>
                </div>
                



{{--@dd($user->step2)--}}

</div>
<!-- /main -->

<div style="display: none;">
    <div id="jobApplyModal" class="modal p0 jobApplyModal wauto">
        <div id="job_apply_modal" class="w100 pp_edit_info pp_cont m0">
            <div class="frame">
                {{-- <a class="icon_close" href="#close"><span class="close_hover"></span></a> --}}
                <div class="head m0">Submit Proposal</div>
                    <input type="hidden" value="" name="openModalJobId" id="openModalJobId" />
                    <div class="cont">
                        <div class="css_loader loader_edit_popup">
                            <div class="spinner center">
                                <div class="spinner-blade"></div>
                                <div class="spinner-blade"></div>
                                <div class="spinner-blade"></div>
                                <div class="spinner-blade"></div>
                                <div class="spinner-blade"></div>
                                <div class="spinner-blade"></div>
                                <div class="spinner-blade"></div>
                                <div class="spinner-blade"></div>
                                <div class="spinner-blade"></div>
                                <div class="spinner-blade"></div>
                                <div class="spinner-blade"></div>
                                <div class="spinner-blade"></div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>


@stop


@section('custom_js')
<script type="text/javascript" src="{{ asset('js/site/jquery.popup.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/login_form.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/jquery.form.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/lib.js') }}"></script>

<script type="text/javascript" src="{{ asset('js/site/jquery.formstyler.js') }}"></script>
{{--<script type="text/javascript" src="{{ asset('js/site/join.js') }}"></script>--}}
<script type="text/javascript" src="{{ asset('js/site/step2.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/modernizr.js') }}"></script>

<script src="{{ asset('js/site/jquery.modal.min.js') }}"></script>
<script src="{{ asset('js/site/jquery-ui.js') }}"></script>
<script src="{{ asset('js/site/common.js') }}"></script>



<script type="text/javascript">
    $(function(){
        // $('#full_step_1').delay(150).fadeIn(500);
        var currentStep = {{ !empty($user->step2)?($user->step2):'1'}};
        userStepReload(currentStep);
    });

    // Profile Image Upload End
    // about me Character count for textarea start

        var aboutMaxLength = 300;
        $('#about_me').keyup(function() {
            var textlen = aboutMaxLength - $(this).val().length;
            $('#arChars').text(textlen);
        });
    // about me Character count for textarea end

    // about me Character count for textarea start

        var maxLength = 150;
        $('#interested_in').keyup(function() {
            var textlen = maxLength - $(this).val().length;
            $('#irChars').text(textlen);
        });
    // about me Character count for textarea end
    // User Step3 End

    //==================================================================================================================== 
    // Allow Job Seekers to select the numbers above to be able to go back to that particular section of the process
    //==================================================================================================================== 

    $('#join_step ul li').click(function(){  
        $('#join_step ul li').removeClass('selected');
        $(this).addClass('selected');  
        var steptext = $(this).text();
        var stepcheck = parseInt(steptext);

        if (stepcheck == 1) {
            $('#full_step_'+stepcheck).css("display", "block");
            $('#full_step_'+stepcheck).siblings().css("display", "none");
        }
        else{
            var step = stepcheck+1;
            console.log(step);
            $('#full_step_'+step).css("display", "block");
            $('#full_step_'+step).siblings().css("display", "none");
        }
        

        
    });




</script>

@stop

@section('custom_footer_css')
<link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}">
{{-- <link rel="stylesheet" href="{{ asset('css/site/profile.css') }}"> --}}


<style>
.header, .main.above .wrapper {
    background: #5b0079;
}
.full_step_error p, .upload_resume_error p {
    color: white;
    text-align: center;
    background-color: rgba(228, 29, 61, 0.6);
    font-size: 15px;
    padding: 5px 0;
    width: 20%;
    margin: 10px auto;
    border-radius: 5px;
}
.css_loader_btn .spinner.center, .css_loader_btn .spinnerw.center {
    position: relative !important;
}
.title_private_photos.title_videos {
    padding: 0 0 15px 0;
}
.userResumeCont, .userVideoCont {
    width: 100%;
}
div#list_videos_public{
    float: none;
}
a#user_step8_done, a#more_jobs_step2  {
    transition: background-color 0.3s ease;
    font-size: 18px;
    color: #fff;
    border: none;
    border-radius: 3px;
    cursor: pointer;
    display: block;
    background: #40c7db;
    width: 5%;
    margin: 0 auto;
    padding: 10px 30px;
    margin-top: 10px;
}
a#more_jobs_step2{
    width: 15%;
text-align: center;
}
.active1{
    opacity: 1 !important;
}
.ageCal>#year-styler > .jq-selectbox__dropdown.drop_down {
    height: 200px !important;
    width: 100% !important;
    overflow: scroll;
}
</style>
@stop

