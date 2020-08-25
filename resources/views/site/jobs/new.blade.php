{{-- @extends('site.user.usertemplate') --}}
@extends('site.employer.employermaster')

@section('custom_css')
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
@stop

@section('content')
<div class="newJobCont">
    <div class="head icon_head_browse_matches">Add New Job</div>

    <div class="add_new_job">
    <form method="POST" name="new_job_form" class="new_job_form newJob job_validation">
        @csrf
        <div class="job_title form_field">
            <span class="form_label">Title :</span>
            <div class="form_input">
                <input type="text" value="" name="title" class="w100" required>
                <div id="title_error" class="error field_error to_hide">&nbsp;</div>
            </div>
        </div>

        <div class="job_description form_field" required>
            <span class="form_label">Description :</span>
            <div class="form_input">
                <textarea name="description" class="form_editor w100" maxlength="1000" style="min-height: 120px;"></textarea>
                <div id="description_error" class="error field_error to_hide">&nbsp;</div>
            </div>
        </div>

        <div class="job_experience form_field">
            <span class="form_label">Experience :</span>
            <div class="form_input">
                <input type="text" value="" name="experience" class="w100">
                <div id="experience_error" class="error field_error to_hide">&nbsp;</div>
            </div>
        </div>

        <div class="job_type form_field">
            <span class="form_label">Type :</span>
            <div class="form_input">
                <select name="type" class="form_select " >
                    <option value="contract">Contract</option>
                    <option value="temporary">Temporary</option>
                    <option value="casual">Casual</option>
                    <option value="part_time">Part Time</option>
                    <option value="full_time">Full Time</option>
                </select>
                <div id="type_error" class="error field_error to_hide">&nbsp;</div>
            </div>
        </div>


        <div class="job_country form_field geo_location_cont">
            <span class="form_label">Location :</span>
            <div class="form_input">

                {{-- <select name="country" class="form_select"> --}}

                <select name="geo_country" id="country" class="geo select_main geo_country width-200" onchange="CommonScript.GetLocation('geo_states',this);">
                        <option value="">Select Country</option>
                    @foreach ($geo_country as $country)
                        <option value="{{$country->country_id}}" {{(default_Country_id() == $country->country_id)?('selected="selected"'):('')}}>{{$country->country_title}}</option>
                    @endforeach
                </select>



                <select name="geo_states" class="form_select geo_states" onchange="CommonScript.GetLocation('geo_cities',this);">
                     @foreach ($geo_state as $state)
                        <option  id="option_state_{{$state->state_id}}"  value="{{$state->state_id}}" {{(default_State_id() == $state->state_id)?('selected="selected"'):('')}}>{{$state->state_title}}</option>
                    @endforeach
                </select>



                <select name="geo_cities" class="form_select geo_cities" >
                    @foreach ($geo_cities as $city)
                        <option  id="option_city_{{$city->city_id}}"  value="{{$city->city_id}}">{{$city->city_title}}</option>
                    @endforeach
                </select>


                <div id="country_error" class="error field_error to_hide">&nbsp;</div>
                <div id="state_error" class="error field_error to_hide">&nbsp;</div>
                <div id="city_error" class="error field_error to_hide">&nbsp;</div>
            </div>
        </div>


        <div class="job_vacancies form_field">
            <span class="form_label">Vacancies :</span>
            <div class="form_input">
                <input type="text" value="" name="vacancies" class="">
                <div id="vacancies_error" class="error field_error to_hide">&nbsp;</div>
            </div>
        </div>


        <div class="job_salary form_field">
            <span class="form_label">Salary :</span>
            <div class="form_input">
                <input type="text" value="" name="salary" class="">
                <div id="salary_error" class="error field_error to_hide">&nbsp;</div>
            </div>
        </div>

      {{--   <div class="job_gender form_field">
            <span class="form_label">Gender :</span>
            <div class="form_input">
                <select name="gender" class="form_select " >
                    <option value="any">Any Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                <div id="gender_error" class="error field_error to_hide">&nbsp;</div>
            </div>
        </div> --}}

       {{--  <div class="job_age form_field">
            <span class="form_label">Age :</span>
            <div class="form_input">
                <input type="text" name="age" class="" />
                <div id="age_error" class="error field_error to_hide">&nbsp;</div>
            </div>
        </div> --}}


        <div class="job_age form_field">
            <span class="form_label">Expiration Date:</span>
            <div class="form_input">
                <input type="text" name="expiration" class="datepicker" />
                <div id="expiration_error" class="error field_error to_hide ">&nbsp;</div>
            </div>
        </div>



        <div class="job_age form_field">
            <span class="form_label">Job Questions:</span>
            <div class="form_input w100">
                {{-- 
                <div class="jobQuestions">
                   <div class="question mb10 relative"><input type="text" name="questions[]" class="w100" />
                    <span class="close_icon jobQuestion"></span>
                   </div>
                </div>
                 --}}
                 <div class="jobQuestions">
                     <div class="jobQuestion q1">
                         <div class="jq_field_box ">
                             <div class="jq_field_label">Title</div>
                             <div class="jq_field title"><input type="text" name="jq[0][title]" /></div>
                         </div>
                         <div class="jq_field_box">
                             <div class="jq_field_label">Options</div>
                             <div class="jq_field_questions mb20">
                                 <div class="option">
                                     <input type="text" name="jq[0][option][0][text]" />
                                     <div class="jq_option_cbx">
                                        <input type="checkbox" id="jq_0_option_0_preffer" name="jq[0][option][0][preffer]" value="preffer">
                                        <label for="jq_0_option_0_preffer">Preffer</label> 
                                     </div>
                                      <div class="jq_option_cbx">
                                        <input type="checkbox" id="jq_0_option_0_goldstar" name="jq[0][option][0][goldstar]" value="goldstar">
                                        <label for="jq_0_option_0_goldstar">Gold Star</label> 
                                     </div>
                                  </div>
                             </div>
                             <div class="j_button dinline_block addOptionsBtn"><a class="addQuestionOption graybtn jbtn" data-qc="0">Add Option+</a></div>
                         </div>
                         <div class="jq_remove"><span class="close_icon removeJobQuestion"></span></div>
                     </div>
                 </div>

                 <input type="hidden" name="questionCounter" id="questionCounter" value="0">
                <div class="j_button dinline_block mt20 fl_right"><a class="addQuestion graybtn jbtn">Add+</a></div>
            </div>
        </div>



        <div class="form_field">
            <span class="form_label"></span>
            <div class="form_input">
                <div class="general_error error to_hide">&nbsp;</div>
            </div>
        </div>

        <div class="fomr_btn act_field">
            <span class="form_label"></span>
            <input type="type" value="academic" />
            <button class="btn small turquoise saveNewJob">Save</button>
        </div>

    </form>
    </div>




<div class="cl"></div>


{{--
<div style="display:none;">
<div id="addNewQuestionModel" class="modal cmodal p0 addNewQuestionModel wauto">
    <div class="pp_info_start pp_alert pp_confirm pp_cont" style="left: 0px; top: 0px; margin: 0;">
        <div class="cont">
            <div class="title">Delete Job Application?</div>
            <div class="spinner_loader">
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
            <div class="apiMessage mt20"></div>
            <div class="img_chat">
                <div class="icon">
                    <img src="{{asset('/images/site/icons/icon_pp_sure.png')}}" height="48" alt="">
                </div>
                <div class="msg">Are you sure you wish to continue?</div>
            </div>
            <div class="double_btn">
                <button class="confirm_close btn small dgrey" onclick="UProfile.cancelGalleryConfirm(); return false;">Cancel</button>
                <button class="confirm_jobAppDelete_ok confirm_btn btn small marsh">OK</button>
                <input type="hidden" name="deleteConfirmJobAppId" id="deleteConfirmJobAppId" value=""/>
                <div class="cl"></div>
            </div>
        </div>
    </div>
</div>
</div>
--}}



</div>
@stop

@section('custom_footer_css')
<link rel="stylesheet" href="{{ asset('css/site/profile.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}">
{{-- <link rel="stylesheet" href="{{ asset('css/site/gallery_popup/magnific-popup.css') }}"> --}}
{{-- <link rel="stylesheet" href="{{ asset('css/site/gallery_popup/lc_lightbox.css') }}"> --}}


<style type="text/css">
.jq_field_label {
    float: left;
    width: 10%;
}
.jq_field {
    float: left;
    width: 90%;
}
.jq_field_box {
    display: table;
    width: 100%;
    /*border: 1px solid red;*/
    margin-bottom: 5px;
}
.jq_field.title input { width: 100%; }
.jq_field.option input[type="text"]{
    width: 60%;
    float: left;
}
.jq_option_cbx {
    width: 20%;
    float: left;
    margin: 7px 0px;
    text-align: center;
}
.jq_field_box.optionfield {height: 80px;}
.addOptionsBtn {
    float: none;
    margin-left: 10%;
    margin-top: 5px;
    margin-bottom: 10px;
}
.jq_field_questions.mb20 {
    min-height: 20px;
}
.jobQuestion {
    position: relative;
    margin: 6px 0px;
    padding: 10px 4px;
    border-radius: 4px;
    background: rgba(0, 0, 0, 0.08);
}
.jq_remove {
    position: absolute;
    right: 0px;
    bottom: 0px;
    cursor: pointer;
}
.jq_option_cbx label {
    margin: 0px 4px;
}
.jq_field_questions input[type="text"] {
    float: left;
}

.jq_field_questions .option {
    display: table;
    width: 100%;
}

 

.jq_field_questions {
    float: left;
    width: 90%;
}
</style>

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
    console.log(' new job doc ready  ');
    $(".datepicker").datepicker({
        dateFormat: "yy-mm-dd"
    });



    // add new question html to dom. 
    $('.addQuestion').on('click',function(){
        console.log(' addQuestion clck  ');
        // var question = '<div class="question mb10 relative"><input type="text" name="questions[]" class="w100" /><span class="close_icon jobQuestion"></span></div>';
        // $('.jobQuestions').append(question);
        //  $('#addNewQuestionModel').modal({
        //     fadeDuration: 200,
        //     fadeDelay: 2.5,
        //     escapeClose: false,
        //     clickClose: false,
        // });

        var qC = parseInt($('#questionCounter').val())+1; 

        var jobQuestion  = '<div class="jobQuestion q'+qC+'">'; 
            jobQuestion +=  '<div class="jq_field_box ">'; 
            jobQuestion +=    '<div class="jq_field_label">Title</div>'; 
            jobQuestion +=    '<div class="jq_field title"><input type="text" name="jq['+qC+'][title]" /></div>'; 
            jobQuestion +=  '</div>'; 
            jobQuestion +=  '<div class="jq_field_box">'; 
            jobQuestion +=    '<div class="jq_field_label">Options</div>'; 
            jobQuestion +=    '<div class="jq_field_questions mb20">';
            jobQuestion +=          '<div class="option">';
            jobQuestion +=             '<input type="text" name="jq['+qC+'][option][0][text]" />';
            jobQuestion +=                 '<div class="jq_option_cbx">';
            jobQuestion +=                      '<input type="checkbox" id="jq_'+qC+'_option_0_preffer" name="jq['+qC+'][option][0][preffer]" value="preffer">';
            jobQuestion +=                       '<label for="jq_'+qC+'_option_0_preffer">Preffer</label> ';
            jobQuestion +=                  '</div>';
            jobQuestion +=                  '<div class="jq_option_cbx">';
            jobQuestion +=                     '<input type="checkbox" id="jq_'+qC+'_option_0_goldstar" name="jq['+qC+'][option][0][goldstar]" value="goldstar">';
            jobQuestion +=                     '<label for="jq_'+qC+'_option_0_goldstar">Gold Star</label> ';
            jobQuestion +=                  '</div>';
            jobQuestion +=          '</div>';
            jobQuestion +=      '</div>';
            jobQuestion +=     '<div class="j_button dinline_block addOptionsBtn"><a class="addQuestionOption graybtn jbtn" data-qc="'+qC+'">Add Option+</a></div>';
            jobQuestion +=    '</div>';
            jobQuestion +=  '<div class="jq_remove"><span class="close_icon removeJobQuestion"></span></div>';
            jobQuestion +=  '</div>'; 

         $('.jobQuestions').append(jobQuestion);
         $('#questionCounter').val(qC);  
         jQFormStyler(); // rerun the form styler.

    });

    // add more option to question 
    $('.jobQuestions').on('click','.addQuestionOption', function(){
        var oC = $(this).closest('.jobQuestion').find('.jq_field_questions .option').length;
        // var qC = $(this).attr('data-qc');
        var qC = parseInt($('#questionCounter').val()); 
        var option_html = ''; 
            option_html +=          '<div class="jq_option option">';
            option_html +=             '<input type="text" name="jq['+qC+'][option]['+oC+'][text]" />';
            option_html +=              '<div class="jq_option_cbx">';
            option_html +=              '<input type="checkbox" id="jq_'+qC+'_option_'+oC+'_preffer" name="jq['+qC+'][option]['+oC+'][preffer]" value="preffer">';
            option_html +=                '<label for="jq_'+qC+'_option_'+oC+'_preffer">Preffer</label> ';
            option_html +=                  '</div>';
            option_html +=                  '<div class="jq_option_cbx">';
            option_html +=                     '<input type="checkbox" id="jq_'+qC+'_option_'+oC+'_goldstar" name="jq['+qC+'][option]['+oC+'][goldstar]" value="goldstar">';
            option_html +=                     '<label for="jq_'+qC+'_option_'+oC+'_goldstar">Gold Star</label> ';
            option_html +=                  '</div>';
            option_html +=          '</div>';

        $(this).closest('.jobQuestion').find('.jq_field_questions').append(option_html);
        jQFormStyler(); // rerun the form styler.
    }); 



    // remove question html from dom. 
    $(document).on('click','.close_icon.removeJobQuestion',function(){
        $(this).closest('.jobQuestion').remove();
    });


    var jQFormStyler = function(){
        $('input, select').styler({ selectSearch: true, });
    }


});
</script>
@stop

