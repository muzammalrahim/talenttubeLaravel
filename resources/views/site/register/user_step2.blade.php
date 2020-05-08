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
  
    <!-- header -->
    <div class="header">  
        <div id="join_step" class="step">
            <ul>
                <li class="selected">1</li>
                <li style="display:none;">2</li>
                <li style="display:none;">3</li>
            </ul>
            
        </div>
        <div class="slogan"><span id="join_slogan">Answer 5 questions to calculate your best matches.</span></div>
        
        <div class="logo">
            <a href="./index"><img src="{{asset('/images/site/logo.png')}}" style="max-height:45px;  max-width:238px;" alt="" /></a>
        </div>
    </div>
    <!-- /header -->


     
    <div class="content">
        <div class="cont_vc">
            
            <div id="full_step_1" class="bl_card_question" style="display:none;">
                <div class="card_question_cont">
                    <div id="card_question_no" class="card_question no hide answer">
                        <div class="question_vh"><img src="../images/icon_card_answer_no.png" width="224" height="224" alt="" /><span>No</span></div>
                    </div>
                    <div id="card_question_yes" class="card_question yes hide answer">
                        <div class="question_vh"><img src="../images/icon_card_answer_yes.png" width="224" height="224" alt="" /><span>Yes</span></div>
                    </div>
                    
                    <div data-field="work_type" class="card_question ">
                        <div class="count">5 of 5</div><div class="question_txt">Are you open to temporary and contract work?</div>
                    </div>
                    
                    <div data-field="job_type" class="card_question ">
                        <div class="count">4 of 5</div><div class="question_txt">Are you looking for Full Time Employment?</div>
                    </div>
                    
                    <div data-field="relocate" class="card_question ">
                        <div class="count">3 of 5</div><div class="question_txt">Are you looking or willing to relocate for your next job opportunity?</div>
                    </div>
                    
                    <div data-field="casual_part" class="card_question ">
                        <div class="count">2 of 5</div><div class="question_txt">Are you open to Part Time or Casual work?</div>
                    </div>
                    
                    <div data-field="resident " class="card_question first">
                        <div class="count">1 of 5</div><div class="question_txt">Are you a Permanent Resident or Citizen of Australia or New Zealand?</div>
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
                        <div class="upload_file">
                            <form id="photo_upload" data-id="" method="post" enctype="multipart/form-data" action="join2.php">
                                <div class="upload">
                                    <img id="photo_img" class="pic" src="">
                                    <div id="photo_loader" class="bl photo_loader to_hide">
                                        <div class="css_loader photo_upload_loader">
                                            <div class="spinner spinnerw center">
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
                                    <div class="bl photo_add">Add a photo</div>
                                    <input id="photo_upload_file" name="photo_upload_file" class="file" accept="image/jpeg,image/png,image/gif" onchange="changeUploadPhoto($(this));" type="file">
                                </div>
                                <div class="upload_pic">
                                    <input id="photo_upload_file_bind" name="photo_upload_file_bind" accept="image/jpeg,image/png,image/gif" class="file" onchange="changeUploadPhoto($(this));" type="file">
                                </div>
                                <input id="photo_upload_reset" style="display:none;" type="reset" value="">
                                <input id="photo_upload_submit" style="display:none;" type="submit">
                            </form>
                        </div>
                        <div id="photo_upload_error" class="error" title=""></div>
                        <div class="name"></div>
                        <div class="name_info">2020, </div>
                    </div>
            
                    <div id="frm_card_join" class="card_profile_info card_join">
                        
                        <div class="bl bl_basic">
                        <div class="title">About me</div>
                        <div id="about_me_error" class="error to_hide">Required field!</div>
                        
                        <textarea id="about_me" class="placeholder_always fl_basic" name="about_me" placeholder="Tell us something about you" maxlength="1000"></textarea>
                        
                        
                        </div>
                        
                        <div class="bl bl_basic">
                        <div class="title">Interested in</div>
                        <div id="interested_in_error" class="error to_hide">Required field!</div>
                        
                        <textarea id="interested_in" class="placeholder_always fl_basic" name="interested_in" placeholder="Whom would you like to find?" maxlength="1000"></textarea>
                        
                        
                        </div>
                        
                        
                        <!--<div class="bl">
                            <div title="" class="capcha capcha_img" onclick="refreshCaptcha();">
                                <img id="img_join_captcha" src="./_server/securimage/securimage_show_custom.php?sid=1588094172" alt="" />
                            </div>
                            <div class="bl_inp_pos">
                                <input id="captcha" name="captcha" class="inp capcha placeholder" type="text" placeholder="Enter the symbols you see" value="" />
                                <div id="captcha_error" class="error to_hide">Captcha is incorrect!</div>
                            </div>
                            <div class="cl"></div>
                        </div>-->
                        
                        
                        <button id="join_done" class="btn turquoise small btn_join_submit">Done</button>
                    </div>
                </div>
            </div>




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
<script type="text/javascript" src="{{ asset('js/site/join.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/modernizr.js') }}"></script>

<script type="text/javascript">
    $(function(){
        $('#full_step_1').delay(150).fadeIn(500);
    }); 
</script>

@stop

@section('custom_footer_css')
<style>
.header, .main.above .wrapper {
    background: #5b0079;
}
</style>
@stop
