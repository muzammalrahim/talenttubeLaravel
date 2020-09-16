{{-- @extends('site.user.usertemplate') --}}
@extends('site.user.usermaster')

@section('custom_css')
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/profile.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}">
{{-- <style>
    .js_location {
    font-size: 11px !important;
    }
</style> --}}
@stop

@section('content')
<div class="">
    <div class="head icon_head_browse_matches">Employers List</div>



				@include("site.user.employerfilter")
				
																
				@include("site.spinner")
				<div class="employers_list">
					@include("site.user.employerslist")
				</div>




					

</div>

<div style="display:none;">
<div id="confirmJobSeekerBlockModal" class="modal p0 confirmJobSeekerBlockModal wauto">
    <div class="pp_info_start pp_alert pp_confirm pp_cont" style="left: 0px; top: 0px; margin: 0;">
        <div class="cont">
            <div class="title">Block Employer?</div>

            <p class="showError mt20"></p>
            <div class="img_chat">
                <div class="icon">
                    <img src="{{asset('/images/site/icons/icon_pp_sure.png')}}" height="48" alt="">
                </div>
                <div class="msg">Are you sure you wish to continue?</div>
            </div>
            <div class="double_btn">
                <button class="confirm_close btn small dgrey" onclick="UProfile.cancelGalleryConfirm(); return false;">Cancel</button>
                <button class="confirm_JobSeekerBlock_ok btn small marsh">OK</button>
                <input type="hidden" name="jobSeekerBlockId" id="jobSeekerBlockId" value=""/>
                <div class="cl"></div>
            </div>
        </div>
        <div class="apiMessage"></div>
    </div>
</div>
</div>


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

	$('#employer_filter_form').on('submit',function(event){
    console.log(' jobSeeker_filter_form submit '); 
    event.preventDefault();
    $('#paginate').val('');
    getData();
});

var getData = function(){
    var url = '{{route('employers')}}';
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.post(url, $('#employer_filter_form').serialize(), function(data){
        // console.log(' success data  ', data); 
        $('.employers_list').html(data);
    });
}

getData(); 
 
$(document).on('click','.jobseeker_pagination .page-item .page-link',function(e){
    console.log(' page-link click ', $(this) ); 
    e.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
    $('#paginate').val(page);
    getData();
});

});


$('input[name="filter_by_questions"]').change(function() {
    console.log(' filter_by_questions '); 
    (this.checked)?(jQuery('.filter_question_cont').removeClass('hide_it')):(jQuery('.filter_question_cont').addClass('hide_it'));  
     // $('input, select').styler({ selectSearch: true, });
});

$(".reset-btn").click(function(){
	$("#employer_filter_form").trigger("reset");
	getDataCustom();
});


var getDataCustom = function(){
	var url = '{{route('employers')}}';
	$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
	$.post(url, $('#employer_filter_form').serialize(), function(data){
					$('.employers_list').html(data);
	});
}

</script>
@stop

{{-- @section('custom_css')
<style type="text/css">

.showError{
    margin-top: 20px !important;
}
</style>

@stop --}}