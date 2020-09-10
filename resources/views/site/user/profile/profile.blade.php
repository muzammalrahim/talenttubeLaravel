{{-- @extends('site.user.usertemplate') --}}
@extends('site.user.usermaster')

@section('content')
<div class="cont bl_profile">
    <div class="bl_pic_info my_profile">

        {{-- @dump($profileImage) --}}
        {{-- @dump($profileImage['imagepath']) --}}
        {{-- @dump( $user_profile->image ) --}}
        {{-- @dump($profile_image) --}}

        <div class="bl_pic">
            <div class="pic">
                <div class="profile_pic_one to_show">
                    <a class="show_photo_gallery" href="{{$profile_image}}" data-lcl-thumb="{{$profile_image}}" >
                        
                        <img  class="photo" id="pic_main_img" src="{{$profile_image}}" title="">
                    </a>
                    {{-- <div id="add_photo_main_profile" class="add_photo">
                        <div class="file" id="add_photo_profile">
                            <form>
                                <button class="btn small violet"><img width="16" height="16" alt="" src="">Add a photo</button>
                                <input title="" id="some_add_photo_main_public" type="file" multiple="" name="file_public[]">
                                <input id="some_add_photo_main_public_reset" type="reset" value="">
                            </form>
                        </div>
                    </div> --}}
                </div>
                   {{-- <div id="profile_status_online" title="On the site now!" class="status_online to_show"></div> --}}
            </div>
        </div>

        {{-- @dump($user) --}}
        {{-- @dump($user->GeoCountry)
        @dump($user->GeoState)
        @dump($user->GeoCity) --}}

        <div class="info">
            <div class="name"><a id="profile_name" style="cursor:default;" class="edit_main_title"  onclick="return false;">{{$user->name}} {{$user->surname}}</a></div>
            <div class="bl_list_info">
                <ul class="list_info userProfileLocation"><br>
                    {{-- <li><span id="list_info_age">{{$user->age}}</span><span class="basic_info">•</span></li> --}}

                    <li id="list_info_location">{{userLocation($user)}}</li>

                    <li>
                        {{-- <span class="basic_info">•</span> --}}

                    <span id="list_info_gender">Job Seeker</span></li>
                </ul>
                {{-- <div class="icon_edit"><span onclick="UProfile.showMainEditor();"></span></div> --}}
            </div>

            <div class="job">
                <span style="margin-right: 34px;">Recent Job:</span>
                <input type="text" class="hide_it recentJobField" name="recentJobField" value="{{$user->recentJob}}"  onchange="UProfile.updateRecentJob()"/>
                <span  class="recentJobValue">{{$user->recentJob}}</span>  
                <i class="fas fa-edit recentJobEdit" style="cursor: pointer;" onclick="UProfile.enableRecentJobEdit()"></i>
            </div>
{{-- Salary Range --}}


                {{-- <div class="job">
                <span>Expecting Salary:</span>

                <input type="text" class="hide_it salaryRangeField" name="salaryRangeField" value="{{$user->salaryRange}}"  onchange="UProfile.updateSalaryRange()"/>


                <b> {{'USD: '}}<span  class="salaryRangeValue">{{number_format($user->salaryRange),3}}</span>  </b>
                <i class="fas fa-edit salaryRangeEdit" style="cursor: pointer;" onclick="UProfile.enableSalaryRangeEdit()"></i>
                </div> --}}

{{-- @dump($salaryRange) --}}

{{-- New Salary Range --}}

                <div class="job">
                <span>Expecting Salary:</span>
                {{ Form::select('salaryRange', $salaryRange, $user->salaryRange, ['placeholder' => 'Select Salary Range', 'onchange' => 'UProfile.updateSalaryRange()', 'id' => 'salaryRangeFieldnew', 'class' => 'hide_it salaryRangeField']) }}

                <b> {{'AUD: '}}<span  class="salaryRangeValue">{{number_format($user->salaryRange),3}}</span>  </b>
                <i class="fas fa-edit salaryRangeEdit" onclick="UProfile.enableSalaryRangeEdit()"></i>
                </div>

{{-- New Salary Range End Here --}}
           
        </div>
        <div class="cl"></div>
    </div>


    @include('site.user.profile.tabs')

<div class="cl"></div>
</div>



@include('site.user.profile.profileEditPopup')
@include('site.user.profile.profilePersonalInfo')


@stop


@section('custom_footer_css')
<link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}">
{{-- <link rel="stylesheet" href="{{ asset('css/site/gallery_popup/magnific-popup.css') }}"> --}}
<link rel="stylesheet" href="{{ asset('css/site/gallery_popup/lc_lightbox.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/profile.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/tagSystem.css') }}">

<style>
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
    width: 280px;
    height: 150px;
}
div.questionsOfUser>div>p {
    margin: 10px 0px 0;
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
</style>
@stop

@section('custom_js')
<script src="{{ asset('js/site/jquery.modal.min.js') }}"></script>
{{-- <script src="{{ asset('js/site/profile_photo.js') }}"></script>  --}}
{{-- <script src="{{ asset('js/site/gallery_popup/jquery.magnific-popup.js') }}"></script>  --}}
<script src="{{ asset('js/site/gallery_popup/lc_lightbox.lite.js') }}"></script>
<script src="{{ asset('js/site/tagSystem.js') }}"></script>



@stop

