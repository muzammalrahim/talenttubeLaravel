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


            <div class="job_type form_field">
                <span class="form_label ">Type :</span>
                <div class="form_input">
                    {{-- @dump($jobType) --}}

                    {{ Form::select('type', $jobType, ['placeholder' => 'Select Job Type',]) }}

                    {{--
                    <select name="type" class="form_select " >
                        <option value="contract">Contract</option>
                        <option value="temporary">Temporary</option>
                        <option value="casual">Casual</option>
                        <option value="Part_Time">Part Time</option>
                        <option value="full_time">Full Time</option>
                    </select> --}}

                    <div id="type_error" class="error field_error to_hide">&nbsp;</div>
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
                    {{ Form::select('salary', $salaryRange, ['placeholder' => 'Select Salary Range', 'onchange' => '', 'id' => 'salaryRangeFieldnew', 'class' => ' salaryRangeField']) }}
                    <div id="salary_error" class="error field_error to_hide">&nbsp;</div>
                </div>

                                                

            </div>


            <div class="job_age form_field margintop">
                <span class="form_label">Expiration Date:</span>
                <div class="form_input">
                    <input type="text" name="expiration" class="datepicker" />
                    <div id="expiration_error" class="error field_error to_hide ">&nbsp;</div>
                </div>
            </div>



            <div class="form_field">

                {{-- <div id="basic_anchor_industry_experience">Industry Experience <i class="editIndustry fas fa-edit "></i>
              <p class="loader SaveIndustryLoader"style="float: left;"></p></div>
              <div class="cl"></div> --}}
              <span class="form_label2">Industry Experience :<i class="editIndustry fas fa-edit "></i></span>
                <p class="loader SaveindustryExperience"style="float: left;"></p>
                <div class="IndusList form_input">
                    <div class="IndustrySelect" style="width:80%;"></div>
                </div>
                <div class="">
                    <a class=" block addIndus jbtn hide_it " style="background: #499ffd;">+ Add</a>
                    <a class="block jbtn hide_it buttonSaveIndustry"style = "cursor:pointer;" onclick="UProfile.updateNewJobIndustryExperience()">Save</a>
                </div>
            </div>

            


            <div class="job_country form_field geo_location_cont">
                <span class="form_label">Location :</span>
                <div class="location_search_cont">
                    <div class="location_input dtable form_input">
                        <input type="text" name="location_search" class="inp w70 fl_left" id="location_search" value="" placeholder="Type a location" aria-invalid="false">
                        <select class="dinline_block filter_location_radius select_aw" name="filter_location_radius" data-placeholder="Select Location Radius">
                             <option value="5">5km</option>
                             <option value="10">10km</option>
                             <option value="25">25km</option>
                             <option value="50">50km</option>
                             <option value="51">50km +</option>
                        </select>
                    </div>
                    <div class="location_latlong dtable w100">
                        <input type="hidden" class="location_lat w50 fl_left" name="location_lat" id="location_lat" value="" placeholder="Lat" readonly="true" aria-invalid="false">
                        <input type="hidden" class="location_long w50 fl_left" name="location_long" id="location_long" value="" placeholder="Long" readonly="true" aria-invalid="false">

                        <input type="hidden" name="location_name" id="location_name"  value="">
                        <input type="hidden" name="location_city" id="location_city"  value="">
                        <input type="hidden" name="location_state" id="location_state"  value="">
                        <input type="hidden" name="location_country" id="location_country"  value="">

                    </div>
                    <div class="location_map_box dtable w100"><div class="location_map" id="location_map"></div></div>
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
                                            <label for="jq_0_option_0_preffer">Undiserable</label>
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
                {{-- <input type="type" value="academic" /> --}}
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

.jq_field_label {float: left;width: 10%;}
.jq_field {float: left;width: 90%;}
.jq_field_box {display: table;width: 100%;margin-bottom: 5px;}
.jq_field.title input { width: 100%; }
.jq_field.option input[type="text"]{width: 60%;float: left;}
.jq_option_cbx {width: 20%;float: left;margin: 7px 0px;text-align: center;}
.jq_field_box.optionfield {height: 80px;}
.addOptionsBtn {float: none;margin-left: 10%;margin-top: 5px;margin-bottom: 10px;}
.jq_field_questions.mb20 {min-height: 20px;}
.jobQuestion {position: relative;margin: 6px 0px;padding: 10px 4px;border-radius: 4px;background: rgba(0, 0, 0, 0.08);}
.jq_remove {position: absolute;right: 0px;bottom: 0px;cursor: pointer;}
.jq_option_cbx label {margin: 0px 4px;}
.jq_field_questions input[type="text"] {float: left;}
.jq_field_questions .option {display: table;width: 100%;}
.jq_field_questions {float: left;width: 90%;}
div.tab_about.tab_cont>div#basic {margin: 0px 10px 20px 0px;}
i.editEmployerQuestions.fas.fa-edit {cursor: pointer;font-size: 14px;color: mediumseagreen;}
.button {background-color: #4CAF50;border: none;color: white;padding: 10px 20px;text-align: center;text-decoration: none;display: none;font-size: 14px;margin: 4px 2px;border-radius: 10px;cursor: pointer;}
.button:hover {background-color: #3e8e41}
div.employerRegisterQuestions>div#basic {margin: 0px 10px 20px 0px;}
i.editEmployerQuestions.fas.fa-edit {cursor: pointer;font-size: 14px;color: mediumseagreen;float:left;}
.jq-selectbox.jqselect.EmployerRegQuestion{margin-bottom: 15px;}
.jq-selectbox__select {width: 25px;border-radius: 0px;}
.smallSpinner.SaveEmployerQuestionsSpinner {float: left;position: relative;margin:8px 0px 0px 10px;font-size: 18px;}
.alert.alert-success.EmployerQuestionsAlert {background: #3e8e41;height: 30px;width: 50%;text-align: center;padding: 15px 0px 0px 0px;color: white;font-size: 16px;margin: 0px auto;border-radius: 20px;}
.fa-edit{cursor: pointer;font-size: 14px;color: mediumseagreen;}
.title.IndusListBox.edit .hide_it {display: block !important;}
div.title.IndusListBox>div#basic {margin-bottom: 13px;}
i.fa.fa-trash.removeIndustry {margin-top: 7px;}
.qualifiCationBullet {margin-right: 10px;}
.saveIndus,.saveQualification{background: #28a745;text-align: center;height: 22px;padding-top: 6px;border-radius: 4px;opacity: 0.7;color: white;cursor: pointer;}
div#basic_anchor_industry_experience,div.title.qualificationList>div#basic {margin-bottom: 13px;}
.job{margin: 5px 23px;}
.jq-selectbox.jqselect.salaryRangeField.dropup.opened{ width: 100px;}
.jq-selectbox__select {min-width: 151px;}
.jq-selectbox__select-text{display: table;}
div.jq-selectbox__dropdown.drop_down>ul {width: 136px;}
div.jq-selectbox__dropdown.drop_down>ul>li {font-size: 15px;}
div.jq-selectbox__dropdown.drop_up>ul>li {font-size: 15px;}
.fa-edit{cursor: pointer;font-size: 14px;color: mediumseagreen;}
.fa-trash{cursor: pointer;font-size: 14px;float: right;color: #a94442;margin-top: 5px;}
.fa-trash2 {cursor: pointer;font-size: 26px;float: right;color: #a94442;margin-top: 5px;margin-top: 15px;margin-right: -18%;}
select{display: block;width: 100%;height: calc(2.75rem + 2px);padding: .375rem .75rem;
        font-size: 1.5rem;font-weight: 400;line-height: 1.5;color: #495057;margin: 5px 0px 5px 0px ;background-color: #fff;background-clip: padding-box;
        border: 1px solid #ced4da;border-radius: .25rem;box-shadow: inset 0 0 0 transparent;transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;}
.QualificationSelect{font-size: 14px;}
div.bl_list_info>ul.list_info.userProfileLocation>li#list_info_location {font-size: 12px;}
.spinner.center{position: relative;opacity: 1;left: 0;right: 0;top: 0;bottom: 0;}
.qualificationBox.editQualif .hide_it {display: block !important;}
.title.IndusListBox.edit .hide_it {display: block !important;}
div#basic_anchor_industry_experience,div.title.qualificationList>div#basic {margin-bottom: 13px;}
div.title.IndusListBox>div#basic {margin-bottom: 13px;}
.smallSpinner.SaveIndustrySpinner {font-size: 20px;}
select.userQualification {width: 90%;display: inline-block;}
div>div.jq-selectbox__dropdown.drop_up>ul {width: 189px;text-align: center;}
div>div.jq-selectbox__dropdown.drop_down>ul {width: 189px;text-align: center;}
div.questionsOfUser>div>p {margin: 10px 0px 0;padding: 0px;}
.alert.alert-success.questionsAlert {margin-top: 50px;}
.questionsAlert{display: none;}
.SaveIndustryLoader{font-size: 20px;}
.hide2{display: none;}
select.jobSeekerRegQuestion {width: auto;cursor: pointer;}
div.smallSpinner.SaveQuestionsSpinner>.spinner.center {font-size: 20px;margin: 5px 0px 0px 10px;}
div.IndusList>div.IndustrySelect>select {width: 40%;display: inline-block;}
i.fa.fa-trash.removeIndustry {margin-top: 7px;}
.rounded{border-top: 3px solid #142d69;border-radius: 3px;}
.lineDivivder {width: 100%;text-align: center;border-bottom: 1px solid #000;line-height: 0.1em;margin: 10px 0 20px;}
.lineDivivder span {background:#f3f5f9;padding:0 10px;}
span.addTags.btn.btn-primary{display: block;margin-top: 15px;}
div.col_left>div>div#basic {margin-bottom: 13px;}
.userTag {margin-bottom: 7px;}
select.userTags.userTagsSelect {width: 45%;display: inline-block;}
.tab_photos>.col_left {float: none !important;}
.savebuttonUsertags{text-align: center;margin-top:10px}
.jobSeekerProfileUpdate,.signOutButtonHeader{color: white !important;}

/*===================================================== Save Resume ===========================================*/

button.btn.violet.save-resume-btn.valign-top {margin-bottom: 23px;}

/*===================================================== Make Profile Icon ===========================================*/
span.icon_image_profile {bottom: 42px;right: 5px;}
div.jq-selectbox.jqselect.dropdown.opened>.jq-selectbox__dropdown.drop_down{position: absolute !important;}
.jq-selectbox__search {display: none;}
.qualifiCationBullet {margin-right: 10px;}
.qualifType{font-size: 16px;}
.qualifTypeSpan{text-transform: capitalize;font-weight: bold;}
.QuestionsKeyPTag{padding: 0px;}
.jq-selectbox__dropdown.drop_down {width: 100% !important;}
hr.rounded {margin: 20px 0px 20px 0px;}
.saveIndus,.saveQualification{background: #28a745;text-align: center;height: 22px;padding-top: 6px;border-radius: 4px;opacity: 0.7;color: white;cursor: pointer;}
.saveQuestionsButton {background: #28a745;text-align: center;border-radius: 4px;height: 22px;padding-top: 6px;opacity: 0.7;color: white;cursor: pointer;}
.buttonGroup{margin-top: 10%;}
.marginButton{margin-right: 1%;}
.margintop{margin-top: 17px;}
.block {display: inline-block;width: 88%;border: none;background-color: #4CAF50;color: white;padding: 10px 28px;font-size: 16px;cursor: pointer;text-align: center;margin-top:13px;}
.block:hover {background-color: #ddd;color: black;}
</style>

@stop

@section('custom_js')
<script src="{{ asset('js/site/jquery.modal.min.js') }}"></script>
<script src="{{ asset('js/site/jquery-ui.js') }}"></script>
<script src="{{ asset('js/site/common.js') }}"></script>

<script type="text/javascript">

$('input:checkbox').change(function() {
	if ($(this).is(':checked')) {
        $(this).closest('label').addClass('checked');
        if($(this).attr('name').includes('preffer')){
            var res = $(this).attr('name').replace("preffer", "goldstar");
            var arrChkBox = $('[name="'+res+'"]');
            arrChkBox.prop('checked', false).trigger('refresh');
        }
        if($(this).attr('name').includes('goldstar')){
            var res = $(this).attr('name').replace("goldstar", "preffer");
            var arrChkBox = $('[name="'+res+'"]');
            arrChkBox.prop('checked', false).trigger('refresh');
        }

	} else {
		$(this).closest('label').removeClass('checked');
	}
});

// ====================================================== Remove Industry. ======================================================

$(document).ready(function(){
   $(document).on('click','.removeIndustry', function(){
    $(this).closest('.IndustrySelect').remove();
   });

   $(document).on('click','.addIndus', function(){
    console.log(' addIndus ');
    var newIndusHtml = '<div class="IndustrySelect"><select name="industry_experience[]" class="industry_experience userIndustryExperience">';
    @if(!empty($industriesList))
        @foreach($industriesList as $lk=>$lv)
            newIndusHtml += '<option value="{{$lk}}">{{$lv}}</option>';
        @endforeach
    @endif
    newIndusHtml += '</select>';
    newIndusHtml += '<i class="fa fa-trash fa-trash2  removeIndustry"></i>';
    newIndusHtml += '</div>';

    $('.IndusList').append(newIndusHtml);

   });
});

$(".editIndustry").click(function(){
    $(this).closest('.IndusListBox').addClass('edit');
    $('.removeIndustry').removeClass('hide_it');
    $('.addIndus').removeClass('hide_it');
    $('.buttonSaveIndustry').removeClass('hide_it');
  });

$(document).ready(function() {
    console.log(' new job doc ready  ');
    $(".datepicker").datepicker({
        dateFormat: "yy-mm-dd"
    });

    // ====================================================== add more question. ======================================================

    $('.addQuestion').on('click',function(){
        console.log(' addQuestion clck  ');
        var qC = parseInt($('#questionCounter').val())+1;
        if(qC<=5){
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
            jobQuestion +=                       '<label for="jq_'+qC+'_option_0_preffer">Undiserable</label> ';
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
         $('input:checkbox').change(function() {
        	if ($(this).is(':checked')) {
                $(this).closest('label').addClass('checked');

                if($(this).attr('name').includes('preffer')){
                    var res = $(this).attr('name').replace("preffer", "goldstar");
                    var arrChkBox = $('[name="'+res+'"]');
                    arrChkBox.prop('checked', false).trigger('refresh');
                }

                if($(this).attr('name').includes('goldstar')){
                    var res = $(this).attr('name').replace("goldstar", "preffer");
                    var arrChkBox = $('[name="'+res+'"]');
                    arrChkBox.prop('checked', false).trigger('refresh');
                }


        	} else {
        		$(this).closest('label').removeClass('checked');
        	}
        });

    }

    });

    // ====================================================== add more option to question. ======================================================

    $('.jobQuestions').on('click','.addQuestionOption', function(){
        var oC = $(this).closest('.jobQuestion').find('.jq_field_questions .option').length;
        // var qC = $(this).attr('data-qc');
        var qC = parseInt($('#questionCounter').val());
        var option_html = '';
            option_html +=          '<div class="jq_option option">';
            option_html +=             '<input type="text" name="jq['+qC+'][option]['+oC+'][text]" />';
            option_html +=              '<div class="jq_option_cbx">';
            option_html +=              '<input type="checkbox" id="jq_'+qC+'_option_'+oC+'_preffer" name="jq['+qC+'][option]['+oC+'][preffer]" value="preffer">';
            option_html +=                '<label for="jq_'+qC+'_option_'+oC+'_preffer">Undiserable</label> ';
            option_html +=                  '</div>';
            option_html +=                  '<div class="jq_option_cbx">';
            option_html +=                     '<input type="checkbox" id="jq_'+qC+'_option_'+oC+'_goldstar" name="jq['+qC+'][option]['+oC+'][goldstar]" value="goldstar">';
            option_html +=                     '<label for="jq_'+qC+'_option_'+oC+'_goldstar">Gold Star</label> ';
            option_html +=                  '</div>';
            option_html +=          '</div>';

        $(this).closest('.jobQuestion').find('.jq_field_questions').append(option_html);
        jQFormStyler(); // rerun the form styler.

        $('input:checkbox').change(function() {
        	if ($(this).is(':checked')) {
                $(this).closest('label').addClass('checked');
                if($(this).attr('name').includes('preffer')){
                    var res = $(this).attr('name').replace("preffer", "goldstar");
                    var arrChkBox = $('[name="'+res+'"]');
                    arrChkBox.prop('checked', false).trigger('refresh');
                }
                if($(this).attr('name').includes('goldstar')){
                    var res = $(this).attr('name').replace("goldstar", "preffer");
                    var arrChkBox = $('[name="'+res+'"]');
                    arrChkBox.prop('checked', false).trigger('refresh');
                }
        	} else {
        		$(this).closest('label').removeClass('checked');
        	}
        });

    });



    // ====================================================== remove question html from dom. ======================================================

    $(document).on('click','.close_icon.removeJobQuestion',function(){
        $(this).closest('.jobQuestion').remove();
        var qC = parseInt($('#questionCounter').val());
        qC -=1;
        $('#questionCounter').val(qC);
    });
    var jQFormStyler = function(){
        $('input, select').styler({ selectSearch: true, });
    }


    //====================================================================================================================================//
    // Google map location script
    //====================================================================================================================================//

    var map;
    var input = document.getElementById('location_search');
    var autocomplete = new google.maps.places.Autocomplete(input);
    var geocoder = new google.maps.Geocoder();
    var hasLocation = false;
    var latlng = new google.maps.LatLng(-31.2532183, 146.921099);
    var marker = "";
    var circle = "";
    var options = {
        zoom: 14,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    if(jQuery("#location_map").length > 0) {
        map = new google.maps.Map(document.getElementById("location_map"), options);
        autocomplete.bindTo('bounds', map);
        autocomplete.setFields(['address_components', 'geometry', 'icon', 'name']);
        if(!hasLocation) { map.setZoom(14); }

        // add listner on map, when click on map change the latlong and put a marker over there.
        google.maps.event.addListener(map, "click", function(event) {
            console.log(' addListener click  ');
            reverseGeocode(event.latLng);
        })

        // get the location (city,state,country) on base of text enter in search.
        // jQuery("#location_search_load").click(function() {
        //     if(jQuery("#location_search").val() != "") {
        //         geocode(jQuery("#location_search").val());
        //         return false;
        //     } else {
        //         // marker.setMap(null);
        //         return false;
        //     }
        //     return false;
        // })
        // jQuery("#location_search").keyup(function(e) {
        //     if(e.keyCode == 13)
        //         jQuery("#location_search_load").click();
        // })

        // when click on the Autocomplete suggested locations list
        autocomplete.addListener('place_changed', function() {
             console.log(' autocomplete place_changed ');

              var place = autocomplete.getPlace();
              console.log(' place ', place);

              if (!place.geometry) {
                // User entered the name of a Place that was not suggested and
                // pressed the Enter key, or the Place Details request failed.
                window.alert("No details available for input: '" + place.name + "'");
                return;
              }

              // If the place has a geometry, then present it on a map.
              if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
              } else {
                map.setCenter(place.geometry.location);
                map.setZoom(14);  // Why 14? Because it looks good.
              }


              // var address = '';
              // if (place.address_components) {
              //   address = [
              //     (place.address_components[0] && place.address_components[0].short_name || ''),
              //     (place.address_components[1] && place.address_components[1].short_name || ''),
              //     (place.address_components[2] && place.address_components[2].short_name || '')
              //   ].join(' ');
              // }


              // console.log(' auto place --- ', place);
              // console.log(' auto address --- ', address);

                var address, city, country, state;
                var address_components = place.address_components;
                for ( var j in address_components ) {
                    var types = address_components[j]["types"];
                    var long_name = address_components[j]["long_name"];
                    var short_name = address_components[j]["short_name"];
                    // console.log(' address_components ', address_components);
                    if ( jQuery.inArray("locality", types) >= 0 && jQuery.inArray("political", types) >= 0 ) {
                        city = long_name;
                    }
                    else if ( jQuery.inArray("administrative_area_level_1", types) >= 0 && jQuery.inArray("political", types) >= 0 ) {
                        state = long_name;
                    }
                    else if ( jQuery.inArray("country", types) >= 0 && jQuery.inArray("political", types) >= 0 ) {
                        country = long_name;
                    }
                }

                if((city) && (state) && (country))
                    address = city + ", " + state + ", " + country;
                else if((city) && (state))
                    address = city + ", " + state;
                else if((state) && (country))
                    address = state + ", " + country;
                else if(country)
                    address = country;

                 if((place) && (place.name))
                    address = place.name + ',' + address;

                    // console.log(' reverseGeocode place ', place);
                    // console.log(' reverseGeocode city/state/country = ', city,'/',state,'/',country );
                    updateLocationInputs(place.name,city,state,country);
                    jQuery("#location_search").val(address);
                    placeMarker(place.geometry.location);

            });

        }
        // location_map length.

    function placeMarker(location) {
        console.log(' placeMarker location ',location);

        if (marker == "") {
            marker = new google.maps.Marker({
                position: latlng,
                map: map,
                draggable:true,
                title: "Drag me"
            })
            google.maps.event.addListener(marker, "dragend", function() {
            var point = marker.getPosition();
            map.panTo(point);
                jQuery("#location_lat").val(point.lat());
                jQuery("#location_long").val(point.lng());
            });
        }
        marker.setPosition(location);
        marker.setVisible(true);
        map.setCenter(location);
        map.setZoom(14);
        if((location.lat() != "") && (location.lng() != "")) {
            jQuery("#location_lat").val(location.lat());
            jQuery("#location_long").val(location.lng());
        }
        drawCircle(location);
    }

    function drawCircle(location){
        // var center = new google.maps.LatLng(19.0822507, 72.8812041);
         // place circle.
        var filter_location_radius =  parseInt(jQuery('select[name="filter_location_radius"]').val())*1000;
        if (circle == "") {
            //  var circle = new google.maps.Circle({
            //     center: location,
            //     map: map,
            //     radius: filter_location_radius,          // IN METERS.
            //
            // });

             circle = new google.maps.Circle({
                     map: map,
                     radius: filter_location_radius,    // 10 miles in metres
                     fillColor: '#FF6600',
                     fillOpacity: 0.3,
                     strokeColor: "#FFF",
                     strokeWeight: 0         // DON'T SHOW CIRCLE BORDER.
                    });
        }
        console.log(' circle marker ', circle);
        circle.bindTo('center', marker, 'position');
        circle.setRadius(filter_location_radius);
        map.fitBounds(circle.getBounds());

    }

    function geocode(address) {
        // console.log('---2-- geocode ', address);
        if (geocoder) {
            geocoder.geocode({"address": address}, function(results, status) {
                if (status != google.maps.GeocoderStatus.OK) {
                    alert("Cannot find address");
                    return;
                }
                placeMarker(results[0].geometry.location);
                reverseGeocode(results[0].geometry.location);
                if(!hasLocation) {
                    map.setZoom(14);
                    hasLocation = true;
                }
            })
        }
    }

    function reverseGeocode(location) {
        console.log(' reverseGeocode ', location);
        if (geocoder) {
            geocoder.geocode({"latLng": location}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    var address, city, country, state;
                    for ( var i in results ) {
                        var address_components = results[i]["address_components"];
                        for ( var j in address_components ) {
                            var types = address_components[j]["types"];
                            var long_name = address_components[j]["long_name"];
                            var short_name = address_components[j]["short_name"];

                            // console.log(' address_components ', address_components);

                            if ( jQuery.inArray("locality", types) >= 0 && jQuery.inArray("political", types) >= 0 ) {
                                city = long_name;
                            }
                            else if ( jQuery.inArray("administrative_area_level_1", types) >= 0 && jQuery.inArray("political", types) >= 0 ) {
                                state = long_name;
                            }
                            else if ( jQuery.inArray("country", types) >= 0 && jQuery.inArray("political", types) >= 0 ) {
                                country = long_name;
                            }
                        }
                    }
                    if((city) && (state) && (country))
                        address = city + ", " + state + ", " + country;
                    else if((city) && (state))
                        address = city + ", " + state;
                    else if((state) && (country))
                        address = state + ", " + country;
                    else if(country)
                        address = country;

                    // console.log(' reverseGeocode results ', results);
                    // console.log(' reverseGeocode city/state/country = ', city,'/',state,'/',country );
                    updateLocationInputs('',city,state,country);
                    jQuery("#location_search").val(address);
                    placeMarker(location);
                    return true;
                }
            })
        }
        return false;
    }

    function updateLocationInputs(place,city,state,country){
        jQuery('#location_name').val(place);
        jQuery('#location_city').val(city);
        jQuery('#location_state').val(state);
        jQuery('#location_country').val(country);
    }

    // by default show this location;

    geocode('Sydney New South Wales, Australia');


    jQuery('.filter_location_radius').on('change', function(){
        console.log(' filter_location_radius changed.  ');
        drawCircle(new google.maps.LatLng(jQuery("#location_lat").val(), jQuery("#location_long").val()));
    });



});
</script>
@stop

