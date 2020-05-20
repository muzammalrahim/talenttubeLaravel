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
                    <option value="full_time">Full time</option>
                    <option value="part_time">Part time</option>
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
                        <option value="{{$country->country_id}}">{{$country->country_title}}</option>
                    @endforeach
                </select>



                <select name="geo_states" class="form_select geo_states" onchange="CommonScript.GetLocation('geo_cities',this);">
                    <option value="">Select State</option>
                </select>



                <select name="geo_cities" class="form_select geo_cities" >
                    <option value="">Select City</option>
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

        <div class="job_gender form_field">
            <span class="form_label">Gender :</span>
            <div class="form_input">
                <select name="gender" class="form_select " >
                    <option value="any">Any Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                <div id="gender_error" class="error field_error to_hide">&nbsp;</div>
            </div>
        </div>

        <div class="job_age form_field">
            <span class="form_label">Age :</span>
            <div class="form_input">
                <input type="text" name="age" class="" />
                <div id="age_error" class="error field_error to_hide">&nbsp;</div>
            </div>
        </div>


        <div class="job_age form_field">
            <span class="form_label">Expiration Date:</span>
            <div class="form_input">
                <input type="text" name="expiration" class="datepicker" />
                <div id="expiration_error" class="error field_error to_hide ">&nbsp;</div>
            </div>
        </div>



        <div class="job_age form_field">
            <span class="form_label">Job Questions:</span>
            <div class="form_input">
                <div class="jobQuestions">
                   <div class="question mb10 relative"><input type="text" name="questions[]" class="w100" /><span class="close_icon jobQuestion"></span></div>
                </div>
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
            <iput type="type" value="academic" />
            <button class="btn small turquoise saveNewJob">Save</button>
        </div>

    </form>
    </div>






<div class="cl"></div>
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
    console.log(' new job doc ready  ');
    $(".datepicker").datepicker({
        dateFormat: "yy-mm-dd"
    });


    $('.addQuestion').on('click',function(){
        console.log(' addQuestion clck  ');
        var question = '<div class="question mb10 relative"><input type="text" name="questions[]" class="w100" /><span class="close_icon jobQuestion"></span></div>';
        $('.jobQuestions').append(question);
    });

    $(document).on('click','.close_icon.jobQuestion',function(){
        $(this).closest('.question').remove();
    });

});
</script>
@stop

