
@extends('site.employer.employermaster')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('css/site/profile.css') }}">
@stop

@section('content')

<div class="cont bl_profile">
    <div class="bl_pic_info  my_profile">

        <div class="bl_pic">
            <div class="pic">
                <div class="profile_pic_one to_show">
                    <a class="show_photo_gallery" href="{{$profile_image}}" data-lcl-thumb="{{$profile_image}}" >
                        <img  data-offset-id="23" class="photo" id="pic_main_img" src="{{$profile_image}}" title="">
                    </a>
                </div>
            </div>
        </div>

        <div class="info">
            <div class="name"><a id="profile_name" style="cursor:default;" class="edit_main_title"  onclick="return false;">
                {{($user->company)?($user->company):($user->name.' '.$user->surname)}}</a></div>
            <div class="bl_list_info">
                <ul class="list_info userProfileLocation">
                    <li><span id="list_info_age">{{$user->age}}</span><span class="basic_info">•</span></li>
                    <li id="list_info_location">{{userLocation($user)}}</li>
                    <li><span class="basic_info">•</span><span id="list_info_gender">Employer</span></li>
                </ul>
                <div class="icon_edit">

                    {{-- <span onclick="UProfile.showMainEditor();"></span> --}}

                    <i onclick="UProfile.showMainEditor();" class=" fas fa-edit"></i>


                </div>
            </div>

            {{-- <div class="status">
                <div id="profile_status" class="status_text" style="min-height: 24.0078px; min-width: 163.008px;">
                    <span class="statusText">{{($user->statusText)?($user->statusText):'Enter Your Status'}}</span>
                    <input class="hide_it" type="text" id="statusText" value="{{($user->statusText)?($user->statusText):''}}" onchange="UProfile.updateStatusText()" />
                </div>
                <div id="profile_status_edit" class="icon_edit" onclick="UProfile.enableStatusTextEdit();" style="opacity: 1;"><span></span></div>
            </div> --}}

        </div>
        <div class="cl"></div>
    </div>


    @include('site.employer.profile.tabs')

<div class="cl"></div>
</div>



@include('site.employer.profile.profileEditPopup')
@include('site.employer.profile.profilePersonalInfo')


@stop


@section('custom_footer_css')
<style type="text/css">

div.tab_about.tab_cont>div#basic {
font-size: 20px;
margin: 0px 10px 20px 0px;
}
i.editEmployerQuestions.fas.fa-edit {
    cursor: pointer;
    font-size: 14px;
    color: mediumseagreen;
}
.button {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 10px 20px;;
  text-align: center;
  text-decoration: none;
  display: none;
  font-size: 14px;
  margin: 4px 2px;
  border-radius: 10px;
  cursor: pointer;
}
.button:hover {background-color: #3e8e41}
div.employerRegisterQuestions>div#basic {
    margin: 0px 10px 20px 0px;
    font-size: 20px;
}
i.editEmployerQuestions.fas.fa-edit {
    cursor: pointer;
    font-size: 14px;
    color: mediumseagreen;
    float:left;
}
.jq-selectbox.jqselect.EmployerRegQuestion{
    margin-bottom: 15px;
}
.jq-selectbox__select {
    width: 25px;
    border-radius: 0px;
}
li.sel {
    width: 35px;
}

/*chechking spinner*/

.smallSpinner.SaveEmployerQuestionsSpinner {
    float: left;
    position: relative;
    margin:8px 0px 0px 10px;
    font-size: 18px;
}
.alert.alert-success.EmployerQuestionsAlert {
    background: #3e8e41;
    height: 30px;
    width: 50%;
    text-align: center;
    padding: 15px 0px 0px 0px;
    color: white;
    font-size: 16px;
    margin: 0px auto;
    border-radius: 20px;
}
/*chechking spinner*/
.fa-edit{
    cursor: pointer;
    font-size: 14px;
    color: mediumseagreen;
}

.title.IndusListBox.edit .hide_it {
    display: block !important;
}

div.title.IndusListBox>div#basic {
    font-size: 20px;
    margin-bottom: 13px;
}

i.fa.fa-trash.removeIndustry {
    margin-top: 7px;
}

.qualifiCationBullet {
    margin-right: 10px;
}

.saveIndus,.addIndus,.addQualification,.saveQualification{
    background: #007bff;
    text-align: center;
    height: 22px;
    padding-top: 6px;
    border-radius: 4px;
    opacity: 0.7;
    color: white;
    cursor: pointer;
}
.saveIndus,.saveQualification{
    background: #28a745;
    text-align: center;
    height: 22px;
    padding-top: 6px;
    border-radius: 4px;
    opacity: 0.7;
    color: white;
    cursor: pointer;
}

.saveIndus:hover,.addIndus:hover,.addQualification:hover,.saveQualification:hover,.saveQuestionsButton:hover{
    opacity: 1.0;
}

div#basic_anchor_industry_experience,div.title.qualificationList>div#basic {
    font-size: 20px;
    margin-bottom: 13px;
}

.job{
    margin: 5px 23px;
}
.jq-selectbox.jqselect.salaryRangeField.dropup.opened{ width: 100px;}
.jq-selectbox__select {
    min-width: 120px;
}
.jq-selectbox__select-text{
        display: table;
}
div.jq-selectbox__dropdown.drop_down>ul {
    width: 136px;
}
div.jq-selectbox__dropdown.drop_down>ul>li {
    font-size: 11px;
}
.fa-edit{
    cursor: pointer;
    font-size: 14px;
    color: mediumseagreen;
}
.fa-trash{
    cursor: pointer;
    font-size: 14px;
    float: right;
    color: #a94442;
    margin-top: 5px;
}
div#basic {
    font-size: 20px;
}
/*.SaveQuestionsSpinner{
    position: relative;
    right: 774px;
    top: 5px;
    float: right;
}*/
select{
        display: block;
        width: 100%;
        height: calc(2.75rem + 2px);
        padding: .375rem .75rem;
        font-size: 1.5rem;
        font-weight: 400;
        line-height: 1.5;
        color: #495057;
        margin: 5px 0px 5px 0px ;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        box-shadow: inset 0 0 0 transparent;
        transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }

.QualificationSelect{
    font-size: 14px;
}
div.bl_list_info>ul.list_info.userProfileLocation>li#list_info_location {
    font-size: 12px;
}
.spinner.center{
    position: relative;
    opacity: 1;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
}
.qualificationBox.editQualif .hide_it {
    display: block !important;
}
.title.IndusListBox.edit .hide_it {
    display: block !important;
}
div#basic_anchor_industry_experience,div.title.qualificationList>div#basic {
    font-size: 20px;
    margin-bottom: 13px;
}
div.title.IndusListBox>div#basic {
    font-size: 20px;
    margin-bottom: 13px;
}
.smallSpinner.SaveIndustrySpinner {
    font-size: 20px;
}
a.addQualification.btn.btn-sm.btn-primary.text-white.hide_it, span.addIndus.btn.btn-primary.hide_it {
    margin: 25px 0px 5px 0px;
}
select.userQualification {
    width: 90%;
    display: inline-block;
}
div>div.jq-selectbox__dropdown.drop_down>ul {
    width: 155px;
    /*height: 150px;*/
}
div.questionsOfUser>div>p {
    margin: 10px 0px 0;
    padding: 0px;
}
.alert.alert-success.questionsAlert {
    margin-top: 50px;
}
/*span.addIndus.btn.btn-primary.hide_it {
    margin: 25px 0px 5px 0px;
}*/
.questionsAlert{
    display: none;
}
.SaveIndustryLoader{
    font-size: 20px;
}
.hide2{
    display: none;
}
select.jobSeekerRegQuestion {
    width: auto;
    cursor: pointer;
}
div.smallSpinner.SaveQuestionsSpinner>.spinner.center {
    font-size: 20px;
    margin: 5px 0px 0px 10px;
}
div.IndusList>div.IndustrySelect>select {
    width: 90%;
    display: inline-block;
}
i.fa.fa-trash.removeIndustry {
    margin-top: 7px;
}

.rounded{
    /*border-top: 3px solid #bbb;*/
    border-top: 3px solid #142d69;

    border-radius: 3px;
}
.lineDivivder {
   width: 100%;
   text-align: center;
   border-bottom: 1px solid #000;
   line-height: 0.1em;
   margin: 10px 0 20px;
}

.lineDivivder span {
    background:#f3f5f9;
    padding:0 10px;
}

span.addTags.btn.btn-primary
{
    display: block;
    margin-top: 15px;
}
div.col_left>div>div#basic {
    margin-bottom: 13px;
}
.userTag {
    margin-bottom: 7px;
}
select.userTags.userTagsSelect {
    width: 45%;
    display: inline-block;
}

.tab_photos>.col_left {
    float: none !important;
}
.savebuttonUsertags{
    text-align: center;
    margin-top:10px
}
.jobSeekerProfileUpdate,.signOutButtonHeader{
    color: white !important;
}



/*===================================================== Save Resume ===========================================*/

button.btn.violet.save-resume-btn.valign-top {
    margin-bottom: 23px;
}

/*===================================================== Image Sizing ===========================================*/
/*.tabs_profile .tab_photos img.photo {
    width: auto;
    height: 150px;
    max-width: 200px ;
    min-width: 150px ;
}*/

/*===================================================== Make Profile Icon ===========================================*/
span.icon_image_profile {
    bottom: 42px;
    right: 5px;
}


div.jq-selectbox.jqselect.dropdown.opened>.jq-selectbox__dropdown.drop_down{
    position: unset !important;
}

.jq-selectbox__search {
    display: none;
}
.qualifiCationBullet {
    margin-right: 10px;
}
.qualifType{
    /*margin-left: 10px;*/
    font-size: 16px;
}
.qualifTypeSpan{
    text-transform: capitalize;
    font-weight: bold;
}

.QuestionsKeyPTag{
    padding: 0px;
}
.jq-selectbox__dropdown.drop_down {
    width: 100% !important;
}
hr.rounded {
    margin: 20px 0px 20px 0px;
}

.saveIndus,.addIndus,.addQualification,.saveQualification{
    background: #007bff;
    text-align: center;
    height: 22px;
    padding-top: 6px;
    border-radius: 4px;
    opacity: 0.7;
    color: white;
    cursor: pointer;
}
.saveIndus,.saveQualification{
    background: #28a745;
    text-align: center;
    height: 22px;
    padding-top: 6px;
    border-radius: 4px;
    opacity: 0.7;
    color: white;
    cursor: pointer;
}
.saveQuestionsButton {
    background: #28a745;
    text-align: center;
    border-radius: 4px;
    height: 22px;
    padding-top: 6px;
    /*display: block;*/
    opacity: 0.7;
    color: white;
    cursor: pointer;
}

.saveIndus:hover,.addIndus:hover,.addQualification:hover,.saveQualification:hover,.saveQuestionsButton:hover{
    opacity: 1.0;
}
/*===================================================== Image Sizing ===========================================*/
/*.tabs_profile .tab_photos img.photo {
    width: auto;
    height: 150px;
    max-width: 200px ;
    min-width: 150px ;
}*/

/*===================================================== Make Profile Icon ===========================================*/
/*span.icon_image_profile {
    bottom: 42px;
    right: 5px;
}*/

span.icon_image_profile {
    right: 3px !important;
}
</style>
<link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}">
<link rel="stylesheet" href="{{ asset('css/site/gallery_popup/lc_lightbox.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/plyr.css') }}">
@stop

@section('custom_js')
<script src="{{ asset('js/site/jquery.modal.min.js') }}"></script>
<script src="{{ asset('js/site/gallery_popup/lc_lightbox.lite.js') }}"></script>
<script src="{{ asset('js/site/plyr.polyfilled.js') }}"></script>
<script type="text/javascript">
//======================= Employer Questions Edit =================================
 $(".editEmployerQuestions").click(function(){
 $('.button').css("display","inline-block");
 $('.EmployerRegQuestion').removeClass('hide_it');
 $('.employerQuestionsPtag').addClass('hide_it');
});
//======================= Employer Questions Editing end here =================================
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
    newIndusHtml += '<i class="fa fa-trash removeIndustry"></i>';
    newIndusHtml += '</div>';
    $('.IndusList').append(newIndusHtml);
   });
});

$(".editIndustry").click(function(){
    $(this).closest('.IndusListBox').addClass('edit');
    $('.removeIndustry').removeClass('hide_it2');
    $('.addIndus').removeClass('hide_it2');
    $('.buttonSaveIndustry').removeClass('hide_it2');
    // console.log('welcome');
  });
</script>
@stop

