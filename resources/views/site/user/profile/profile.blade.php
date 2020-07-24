{{-- @extends('site.user.usertemplate') --}}
@extends('site.user.usermaster')



@section('content')
<div class="cont bl_profile">
    <div class="bl_pic_info  my_profile">

        {{-- @dump($profileImage) --}}
        {{-- @dump($profileImage['imagepath']) --}}
        {{-- @dump( $user_profile->image ) --}}
        {{-- @dump($profile_image) --}}

        <div class="bl_pic">
            <div class="pic">
                <div class="profile_pic_one to_show">
                    <a class="show_photo_gallery" href="{{$profile_image}}" data-lcl-thumb="{{$profile_image}}" >
                        <img  data-offset-id="23" class="photo"
                            id="pic_main_img"
                            src="{{$profile_image}}"
                            title="">
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
                <ul class="list_info userProfileLocation">
                    <li><span id="list_info_age">{{$user->age}}</span><span class="basic_info">•</span></li>
                    <li id="list_info_location">{{userLocation($user)}}</li>
                    <li><span class="basic_info">•</span><span id="list_info_gender">Job Seeker</span></li>
                </ul>
                <div class="icon_edit"><span onclick="UProfile.showMainEditor();"></span></div>
            </div>

        {{--     <div class="status">
                <div id="profile_status" class="status_text" style="min-height: 24.0078px; min-width: 163.008px;">
                    <span class="statusText">{{($user->statusText)?($user->statusText):'Enter Your Status'}}</span>
                    <input class="hide_it" type="text" id="statusText" value="{{($user->statusText)?($user->statusText):''}}" onchange="UProfile.updateStatusText()" />
                </div>
                <div id="profile_status_edit" class="icon_edit" onclick="UProfile.enableStatusTextEdit();" style="opacity: 1;"><span></span></div>
            </div> --}}

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

                <b> {{'USD: '}}<span  class="salaryRangeValue">{{number_format($user->salaryRange),3}}</span>  </b>
                <i class="fas fa-edit salaryRangeEdit" onclick="UProfile.enableSalaryRangeEdit()"></i>
                </div>

{{-- New Salary Range End Here --}}
    


           {{--  <div class="title_interest">
                <strong>I am looking for</strong>
                <div class="icon_edit"><span onclick="Profile.showLookingForEditor();"></span></div>
            </div>
            <ul class="list_interest">
                <li><span class="basic_info">•</span><span id="info_looking_for_orientation">Job Seeker</span></li>
                <li><span class="basic_info">•</span><span id="info_looking_for_ages">Ages 18-100</span></li>
                <li><span class="basic_info">•</span><span id="info_looking_for_near_me">Near me</span></li>
            </ul> --}}
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
<style>
.job{margin:10px; }
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

div.bl.qualificationBox>div.title.qualificationList>.QualificationSelect{
    font-size: 14px;
}
div.bl_list_info>ul.list_info.userProfileLocation>li#list_info_location {
    font-size: 12px;
}
</style>
@stop

@section('custom_js')
<script src="{{ asset('js/site/jquery.modal.min.js') }}"></script>
{{-- <script src="{{ asset('js/site/profile_photo.js') }}"></script>  --}}
{{-- <script src="{{ asset('js/site/gallery_popup/jquery.magnific-popup.js') }}"></script>  --}}
<script src="{{ asset('js/site/gallery_popup/lc_lightbox.lite.js') }}"></script>
<script type="text/javascript">

  $(document).ready(function(){
   
   // $(document).on('click','.removeQualification', function(){
   //  $(this).closest('.QualificationSelect').remove();
   // });

   // For deleting old qual which was added by user
   $('.qualificationBox').on('click','.removeQualification', function(){
      console.log('removeQualification');
     $(this).closest('.QualificationSelect').remove();
   });


   $(document).on('click','.addQualification', function(){
    console.log(' addQualification ');

  
     
    
    // Add Qualification end here 
    var newQualificationHtml = '<div class="QualificationSelect"><select name="qualification[]" class="userQualification">'; 
    @if(!empty($qualificationList))
        @foreach($qualificationList as $lk=>$qualification)
            newQualificationHtml += '<option value="{{$qualification['id']}}">{{$qualification['title']}}</option>'; 
        @endforeach
    @endif
    newQualificationHtml += '</select>';  
    newQualificationHtml += '<span class="removeQualification  btn btn-danger">Remove</span>';
    newQualificationHtml += '</div>';
    $('.qualificationList').append(newQualificationHtml);
   });
 })


</script>


@stop

