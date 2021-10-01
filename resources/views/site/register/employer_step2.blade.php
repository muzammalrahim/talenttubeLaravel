{{-- @extends('adminlte::master') --}}
@extends('web.register.registerMaster')

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
    <input type="hidden" id="userType" name="userType" value="employer" />
    <!-- header -->
    <div class="header">
        <div id="join_step" class="step">
            <ul>
                <li class="selected">1</li>
                <li style="display:none;">2</li>
                <li style="display:none;">3</li> 
            </ul>

        </div>
        <div class="slogan"><span id="join_slogan">Answer 6 questions to calculate your best matches.</span></div>

        <div class="logo">
            <a href="./index"><img src="{{asset('/images/logo.png')}}" style="max-height:45px;  max-width:238px;" alt="" /></a>
        </div>
    </div>
    <!-- /header -->



    <div class="content">
        <div class="cont_vc">

            <div id="full_step_1" class="bl_card_question" style="display:none;">
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

                    <div data-field="graduate_intern" class="card_question ">
                        <div class="count">6 of 6</div><div class="question_txt">Does you company hire Graduates or Interns?</div>
                    </div>

                    <div data-field="part_time" class="card_question ">
                        <div class="count">5 of 6</div><div class="question_txt">Are you open to Part Time or Casual workers?</div>
                    </div>

                    <div data-field="temporary_contract" class="card_question ">
                        <div class="count">4 of 6</div><div class="question_txt">Does you organisation offer temporary or contract type work?</div>
                    </div>

                    <div data-field="fulltime" class="card_question ">
                        <div class="count">3 of 6</div><div class="question_txt">Are you looking for Full Time candidates?</div>
                    </div>

                    <div data-field="relocation" class="card_question ">
                        <div class="count">2 of 6</div><div class="question_txt">Are you willing to repay relocation expenses for a strong candidate?</div>
                    </div>

                    <div data-field="resident" class="card_question first">
                        <div class="count">1 of 6</div><div class="question_txt">Does your organisation ever hire candidates who are not Permanent Residents or Citizens?</div>
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
                        <div class="upload_file"><div class="upload"><div class="bl photo_add">Add Company Logo</div></div></div>
                        <div class="name"></div>
                        <div class="name_info error to_hide"></div>
                    </div>

                    <div id="frm_card_join" class="card_profile_info card_join">

         {{--                <div class="bl bl_basic">
                            
                            <div class="title">About Our Organisation</div>
                            <div id="about_me_error" class="error to_hide">Required field!</div>
                            <textarea id="about_me" class="placeholder_always fl_basic" name="about_me" placeholder="Give us a brief overview of what your company does" maxlength="1000"></textarea>
                        </div>

                        <div class="bl bl_basic">
                            <div class="title">Interested in</div>
                            <div id="interested_in_error" class="error to_hide">Required field!</div>
                            <textarea id="interested_in" class="placeholder_always fl_basic" name="interested_in" placeholder="Whom would you like to find?" maxlength="1000"></textarea>
                        </div> --}}


                        <div class="bl bl_basic">

                            <div class="title">About me</div>
                            <div id="about_me_error" class="error to_hide">Required field!</div>
                            <textarea id="about_me" class="placeholder_always fl_basic" name="about_me" placeholder="Give us a brief overview of what your company does" maxlength="300"></textarea>
                            <span id="arChars" class="rChars">300</span> Character(s) Remaining
                        </div>
    
                        <div class="bl bl_basic">
                            <div class="title">Interested in</div>
                            <div id="interested_in_error" class="error to_hide">Required field!</div>

                            <textarea id="interested_in" class="placeholder_always fl_basic" name="interested_in" placeholder="Whom would you like to find?" maxlength="150"></textarea>
                            <span id="irChars" class="rChars">150</span> Character(s) Remaining
                        </div>

                        <button id="step3_done" class="btn turquoise small btn_join_submit">Done</button>
                    </div>
                </div>
            </div>


            <div id="full_step_4" class="bl_card_indExp"  style="display:none;">
                <div class="ind_exp">
                    <div class="ind_exp_h">
                        <p>Please select from the industries and role types below, that best describe the type of candidates you’d like to match with. You can select up to 5 and change these at any time
                        </p>
                    </div>

                   {{--  <div class="industry_selected_list mb20">
                        <div class="industry_selected_ul_cont">
                            <ul class="industry_selected_ul item_selected_ul">

                            </ul>
                        </div>
                    </div> --}}

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
                        <button id="join_done" class="btn turquoise small btn_join_submit industryExpBtn_done" disabled="true">Done</button>
                    </div>

                </div>
            </div>


            <div class="full_step_error"></div>



        </div>
    </div>





</div>
<!-- /main -->


@stop


@section('custom_js')
<script type="text/javascript" src="{{ asset('js/site/jquery.popup.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/login_form.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/jquery.form.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/lib.js') }}"></script>

<script type="text/javascript" src="{{ asset('js/site/jquery.formstyler.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/step2.js') }}"></script>
{{--<script type="text/javascript" src="{{ asset('js/site/join.js') }}"></script>--}}
<script type="text/javascript" src="{{ asset('js/site/modernizr.js') }}"></script>

<script type="text/javascript">
    $(function(){
        // $('#full_step_1').delay(150).fadeIn(500);
        var currentStep = {{ !empty($user->step2)?($user->step2):'1'}};
        employerStepReload(currentStep);
    });


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

</script>

@stop

@section('custom_footer_css')
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
    width: 50%;
    margin: 10px auto;
    border-radius: 5px;
}
</style>
@stop
