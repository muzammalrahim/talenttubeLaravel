{{-- @extends('site.user.usertemplate') --}}
@extends('site.employer.employermaster')

@section('custom_css')
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
@stop

@section('content')
<div class="newJobCont">
    <div class="head icon_head_browse_matches">Browse Jobs</div>

    <div class="add_new_job">
         
        <!-- =============================================================================================================================== -->
        @include('site.jobs.filter')
        <!-- =============================================================================================================================== -->
        @include("site.spinner")
        <!-- =============================================================================================================================== -->
         <div class="jobs_list">
            @include('site.jobs.list') {{-- site/jobs/list --}}
         </div>
        <!-- =============================================================================================================================== -->

    </div>

<div class="cl"></div>
</div>


<div style="display: none;">
<div id="jobApplyModal" class="modal p0 jobApplyModal wauto">
    <div id="job_apply_modal" class="w100 pp_edit_info pp_cont m0">
        <div class="frame">
            {{-- <a class="icon_close" href="#close"><span class="close_hover"></span></a> --}}
            <div class="head m0">Submit Proposal</div>
            <input type="hidden" value="" name="openModalJobId" id="openModalJobId" />
            <div class="cont">
                <div class="css_loader loader_edit_popup">
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
            </div>
        </div>
    </div>
</div>
</div>


@stop

@section('custom_footer_css')
<link rel="stylesheet" href="{{ asset('css/site/profile.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}">


{{-- <script type="text/javascript" src="https://maps.google.com/maps/api/js?libraries=places&key={{env('GOOGLE_API')}}"></script> --}}

@stop

@section('custom_js')
<script src="{{ asset('js/site/jquery.modal.min.js') }}"></script>
<script src="{{ asset('js/site/jquery-ui.js') }}"></script>
<script src="{{ asset('js/site/common.js') }}"></script>
<script src="{{ asset('js/site/location_gmap.js') }}"></script>
{{-- <script src="{{ asset('js/site/profile_photo.js') }}"></script>  --}}
{{-- <script src="{{ asset('js/site/gallery_popup/jquery.magnific-popup.js') }}"></script>  --}}
{{-- <script src="{{ asset('js/site/gallery_popup/lc_lightbox.lite.js') }}"></script> --}}

<script type="text/javascript">
$(document).ready(function() {

//====================================================================================================================================//
// Top Filter form submit load data throug ajax.
//====================================================================================================================================//
$('#filter_form').on('submit',function(event){
    console.log(' filter_form submit '); 
    event.preventDefault();
    $('#paginate').val('');
    getData();
});

// function to send ajax call for getting data throug filter/Pagination selection. 
var getData = function(){
    var url = '{{route('jobsFilter')}}';
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.post(url, $('#filter_form').serialize(), function(data){
        $('.jobs_list').html(data);
    });
}

getData(); 

// Bottom pagination load data throug ajax. 
$(document).on('click','.jobs_pagination .page-item .page-link',function(e){
    console.log(' page-link click ', $(this) ); 
    e.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
    $('#paginate').val(page);
    getData();
});


});

$("body").click(function(){
    clickOutside: false;
});

$(".reset-btn").click(function(){
	$("#filter_form").trigger("reset");
	getDataCustom();
});


	var getDataCustom = function(){
					var url = '{{route('jobsFilter')}}';
					$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
					$.post(url, $('#filter_form').serialize(), function(data){
									$('.jobs_list').html(data);
					});
	}
</script>
@stop

