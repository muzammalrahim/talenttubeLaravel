{{-- @extends('adminlte::master') --}}
@extends('site.master')

@section('title', $title)

@section('content_header')
    <h1 class="m-0 text-dark">Register</h1>
@stop


@section('custom_css')
    <link rel="stylesheet" href="{{ asset('css/site/register.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site/card.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/site/jquery.formstyler.css')}}"/>

@stop

@section('classes_body', 'register step2')

@section('body')


<!-- main -->
<div class="main  above ">
    <input type="hidden" id="userType" name="userType" value="user" />
    <input type="hidden" id="userStep" name="userStep" value="{{($user->step2)?($user->step2):2}}" />
    <!-- header -->
    <div class="header">
        <div id="join_step" class="step">
            <ul>
                <li class="selected">1</li>
                <li style="display:none;">2</li>
                <li style="display:none;">3</li>
                <li style="display:none;">4</li>
                <li style="display:none;">5</li>
                <li style="display:none;">6</li>
                <li style="display:none;">7</li>
            </ul>

        </div>
        <div class="slogan"><span id="join_slogan">Answer 6 questions to calculate your best matches.</span></div>

        <div class="logo">
            <a href="./index"><img src="{{asset('/images/site/logo.png')}}" style="max-height:45px;  max-width:238px;" alt="" /></a>
        </div>
    </div>
    <!-- /header -->



    <div class="content">
        <div class="full_step_error"></div>
        <div class="mw50 dtable margin_auto">
            <div id="full_step_1" class="bl_card_question" style="display:none;">
                <div class="card_question_cont">
                    <div id="card_question_no" class="card_question no hide answer">
                        <div class="question_vh"><img src="../images/icon_card_answer_no.png" width="224" height="224" alt="" /><span>No</span></div>
                    </div>
                    <div id="card_question_yes" class="card_question yes hide answer">
                        <div class="question_vh"><img src="../images/icon_card_answer_yes.png" width="224" height="224" alt="" /><span>Yes</span></div>
                    </div>

                    <div data-field="graduate_intern" class="card_question ">
                        <div class="count">6 of 6</div><div class="question_txt">Are you seeking a Graduate Program or Internship?</div>
                    </div>

                    <div data-field="part_time" class="card_question ">
                        <div class="count">5 of 6</div><div class="question_txt">Are you open to Part Time or Casual work?</div>
                    </div>

                    <div data-field="temporary_contract" class="card_question ">
                        <div class="count">4 of 6</div><div class="question_txt">Are you open to temporary and contract work?</div>
                    </div>

                    <div data-field="fulltime" class="card_question ">
                        <div class="count">3 of 6</div><div class="question_txt">Are you looking for Full Time Employment?</div>
                    </div>

                    <div data-field="relocation" class="card_question ">
                        <div class="count">2 of 6</div><div class="question_txt">Are you looking or willing to relocate for your next job opportunity?</div>
                    </div>

                    <div data-field="resident" class="card_question first">
                        <div class="count">1 of 6</div><div class="question_txt">Are you a Permanent Resident or Citizen of Australia or New Zealand?</div>
                    </div>

                    <div class="card_decor_left1"></div>
                    <div class="card_decor_left2"></div>
                    <div class="card_decor_right1"></div>
                </div>
                <div class="card_question_btn">
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
                             <div class="title">Your current or most recent job title and employer</div>
                             <input type="text" id="recentJob" name="recentJob" value="" />
                             <div id="recentJob_error" class="error to_hide">Required field!</div>
                        </div>

                    </div>

                    <div id="frm_card_join" class="card_profile_info card_join">

                        <div class="bl bl_basic">
                        <div class="title">About me</div>
                        <div id="about_me_error" class="error to_hide">Required field!</div>
                        <textarea id="about_me" class="placeholder_always fl_basic" name="about_me" placeholder="Summarise your career, studies & skills here" maxlength="1000"></textarea>
                        </div>

                        <div class="bl bl_basic">
                        <div class="title">Interested in</div>
                        <div id="interested_in_error" class="error to_hide">Required field!</div>

                        <textarea id="interested_in" class="placeholder_always fl_basic" name="interested_in" placeholder="What opportunities are you open to" maxlength="1000"></textarea>
                        </div>

                        <button id="user_step3_done" class="btn turquoise small btn_join_submit">Done</button>
                    </div>
                </div>
            </div>



            <div id="full_step_4" class="bl_card_qualification wauto"  style="display:none;">
                <div class="ind_exp">
                    <div class="ind_exp_h">
                        <p>Please select the highest level of tertiary studies you have completed or currently enrolled in and completing (You can only select 1 option)</p>
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
                        <button id="user_step4_done" class="btn turquoise small btn_join_submit" disabled="true">Done</button>
                    </div>

                </div>
            </div>



            <div id="full_step_5" class="bl_card_indExp"  style="display:none;">
                <div class="ind_exp">
                    <div class="ind_exp_h">
                        <p>Please select from the industries and role types below, that best describe the type of candidates you’d like to match with. You can select up to 5 and change these at any time
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
                        <p>Almost done, candidates! To help Employers connect with you, we’ve created a tagging system. This allows Employers to search for specific candidates via a search system. In the below section, we encourage you to create as many tags that best describe your key attributes as a Job Seeker.</p>
                        <div class="taging_h_info">
                            <p>Be sure to tag the following:</p>
                            <p>*Names of organisations and companies you’ve worked for, including charities and not for profits</p>
                            <p>*Job Titles you have held</p>
                            <p>*Skills you have (eg; customer service, java Developer, sales, book keeping, etc)</p>
                            <p>*Institutions you’ve studied, including the names of schools, colleges, universities and others</p>
                            <p>*The names of courses you’re studying or have completed</p>
                            <p>*The name of qualifications you have (eg; RG146, RSA, etc)</p>
                            <p>*Languages you speak (other than English)</p>
                            <p>*Hobbies and personal interests are fine as well</p>
                        </div>
                    </div>

                    <div class="user_tagging">
                       @include('site.layout.tagging')
                    </div>

                    <div class="join_btn mt20 center">
                        <button id="user_step7_done" class="btn turquoise small btn_join_submit " disabled="true">Done</button>
                    </div>

                </div>
            </div>



            <div id="full_step_8" class="bl_card_Final full_step_8"  style="display:none;">
                <div class="ind_exp">
                    <div class="ind_exp_h">
                        <p>Well done candidates, you’re at the final stage. To complete your application, all you need to do is 2 things:</p>
                        <div class="step2_uplod_info">
                            <p>1. Upload your most current resume. Please feel free to remove your full name, address and contact details if you prefer to keep this confidential form prospective employers.</p>

                            <p>2. Record a short 30-60 second video of yourself, and upload it in the portal below. Be sure to say hi, tell us about what you’ve done in your career, any key skills/studies/attributes you have, and very briefly the kind of opportunities you’re interested in. You can be as casual as you like, this is more about employers getting an idea of your personality and culture fit. </p>
                        </div>

                        <p class="info">You can chose to save and exit here, and return to upload your resume and video when you’re ready. Please note your application will only become active and viewable to prospective employers, after your video and resume are uploaded.</p>
                    </div>

                    <div class="userUpload">
                       <div class="userResumeCont">
                        <div class="userResume">
                         <div class="title_private_photos title_videos">Resume & Contact Details</div>
                            <form id="frm_upload" class=" submit-document" action="route('userUploadResume')" method="post" enctype="multipart/form-data">
                              {{csrf_field()}} <br>
                              <input type="file" name="resume" id="resume" accept=".pdf,.doc,.docx">
                              <button class="btn violet save-resume-btn valign-top" name="submit" style="padding: 5px;">Save</button>
                            </form>
                            <div class="private_attachments"></div>
                        </div>
                       </div>

                       <div class="userVideoCont">
                           <div class="userVideo">
                           <div class="title_private_photos title_videos">Upload Videos</div>
                           <div id="list_videos_public" class="list_videos_public">
                            <div id="photo_add_video" class="item add_photo add_video_public item_video">
                                <a class="add_photo" >
                                    <img id="video_upload_select" class="transparent is_video" src="{{asset('images/site/icons/add_video160x120.png')}}" style="opacity: 1;">
                                </a>
                            </div>
                           </div>

                           <div class="list_videos"></div>
                           </div>
                       </div>
                    </div>

                    <div class="join_done"></div>

                    <div class="join_btn mt20 center">
                        <button id="user_step8_done" class="btn turquoise small btn_join_submit">Done</button>
                    </div>

                </div>
            </div>




        </div>
    </div>



{{--@dd($user->step2)--}}

</div>
<!-- /main -->


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



<script type="text/javascript">
    $(function(){
        // $('#full_step_1').delay(150).fadeIn(500);
        var currentStep = {{ !empty($user->step2)?($user->step2):'1'}};
        userStepReload(currentStep);
        {{--var previousStep =  currentStep - 1;--}}
        {{--var joinStepList = $('#join_step ul li').removeClass('selected');--}}
        {{--console.log('step list', joinStepList);--}}
        {{--// if (currentStep == 3){--}}
        {{--//--}}
        {{--// }--}}

        {{--switch (currentStep) {--}}
        {{--    case 2:--}}
        {{--        var step3_slogan =  ($('#userType').val() == 'user')?('Update your profile'):('Give us a brief overview');--}}
        {{--        $('#join_slogan').text(step3_slogan);--}}
        {{--        joinStepList;--}}
        {{--        $('#join_step ul li:eq(1)').addClass('selected').css('display','block');--}}
        {{--        break;--}}

        {{--    case 3:--}}
        {{--        var step3_slogan =  ($('#userType').val() == 'user')?('Update your profile'):('Give us a brief overview');--}}
        {{--        $('#join_slogan').text(step3_slogan);--}}
        {{--        joinStepList;--}}
        {{--        $('#join_step ul li:eq(1)').addClass('selected').css('display','block');--}}
        {{--        break;--}}
        {{--    case 4:--}}
        {{--        // $('#join_slogan').text('Qualification');--}}
        {{--        // joinStepList;--}}
        {{--        // $('#join_step ul li:eq(1)').css('display','block');--}}
        {{--        // $('#join_step ul li:eq(2)').addClass('selected').css('display','block');--}}
        {{--        // // showUserStep4();--}}
        {{--        showUserStep5();--}}

        {{--        break;--}}
        {{--    case 5:--}}
        {{--        $('#join_slogan').text('Industry Experience');--}}
        {{--        joinStepList;--}}
        {{--        $('#join_step ul li:eq(1), #join_step ul li:eq(2)').css('display','block');--}}
        {{--        $('#join_step ul li:eq(3)').addClass('selected').css('display','block');--}}
        {{--        break;--}}
        {{--    case 6:--}}
        {{--        $('#join_step').text('Salary Range');--}}
        {{--        joinStepList;--}}
        {{--        $('#join_step ul li:eq(1), #join_step ul li:eq(2), #join_step ul li:eq(3)').css('display','block');--}}
        {{--        $('#join_step ul li:eq(4)').addClass('selected').css('display','block');--}}
        {{--        break;--}}
        {{--    case 7:--}}
        {{--        $('#join_step').text('Tagging');--}}
        {{--        joinStepList;--}}
        {{--        $('#join_step ul li:eq(1), #join_step ul li:eq(2), #join_step ul li:eq(3), #join_step ul li:eq(4)').css('display','block');--}}
        {{--        $('#join_step ul li:eq(5)').addClass('selected').css('display','block');--}}
        {{--        break;--}}
        {{--    case 8:--}}
        {{--        $('#join_step').text('Final Section');--}}
        {{--        joinStepList;--}}
        {{--        $('#join_step ul li:eq(1), #join_step ul li:eq(2), #join_step ul li:eq(3), #join_step ul li:eq(4), #join_step ul li:eq(5)').css('display','block');--}}
        {{--        $('#join_step ul li:eq(6)').addClass('selected').css('display','block');--}}
        {{--        break;--}}
        {{--     default :--}}

        {{--         $('#full_step_1').delay(150).fadeIn(500);--}}

        {{--         break;--}}
        // }
    });
</script>

@stop

@section('custom_footer_css')
<link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}">


<style>
.header, .main.above .wrapper {
    background: #5b0079;
}
.full_step_error p {
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
</style>
@stop
