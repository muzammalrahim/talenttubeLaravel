
@extends('web.user.usermaster')

@section('custom_css')
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">

{{-- <link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}"> --}}

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


  
@stop
@section('content')
{{-- <div class="newJobCont">
    <div class="head icon_head_browse_matches">Browse Jobs</div>

    <div class="add_new_job"> --}}

        <!-- =============================================================================================================================== -->
       {{--  @include('site.jobs.filter') --}}
        <!-- =============================================================================================================================== -->
      {{--   @include("site.spinner") --}}
        <!-- =============================================================================================================================== -->
        {{--  <div class="jobs_list"> --}}
            {{-- @include('site.jobs.list') --}} {{-- site/jobs/list --}}
         {{-- </div> --}}
        <!-- =============================================================================================================================== -->

{{--     </div>

<div class="cl"></div>
</div>


<div style="display: none;">
<div id="jobApplyModal" class="modal p0 jobApplyModal wauto">
    <div id="job_apply_modal" class="w100 pp_edit_info pp_cont m0">
        <div class="frame">
            <a class="icon_close" href="#close"><span class="close_hover"></span></a>
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
</div> --}}

{{-- ============================================================html for browse jobs================================================ --}}

<section class="row">
    <div class="col-md-12 browse-job-main">
        <div class="profile profile-section">
            <h2>Browse Jobs</h2>

            @include('site.jobs.filter') {{-- site/jobs/filter --}}
            <!-- Job Detail Area -->
            <div class="jobs_list">
                @include('web.jobs.list') {{-- web/jobs/list --}}
            </div>

            <!-- Job Detail Area -->
        </div>
    </div>
</section>


<!-- =====================Apply button modal================================ -->
<div class="modal fade" id="jobApplyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog Apply-modal " role="document">
    <div class="modal-content ">
      <div class="modal-header Apply-modal-header">
        <div class="m-header  ">
          <h4 class="modal-title Apply-modal-title " id="myModalLabel">
            Submit Proposal
          </h4>
          <i data-dismiss="modal" aria-label="Close" class="close-box fa fa-times"></i>
        </div>
      </div>
      <div class="modal-body ">
        <div class="jobData"></div>
      </div>
    </div>
  </div>
</div>
<!-- =====================Apply button modal ends============================= -->

@stop

@section('custom_footer_css')
{{-- <link rel="stylesheet" href="{{ asset('css/site/profile.css') }}"> --}}
{{-- <link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}"> --}}


@stop

@section('custom_js')
{{-- <script src="{{ asset('js/site/jquery.modal.min.js') }}"></script> --}}
<script src="{{ asset('js/site/jquery-ui.js') }}"></script>
<script src="{{ asset('js/site/common.js') }}"></script>
<script src="{{ asset('js/site/location_gmap.js') }}"></script>


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
    //$("#filter_form").trigger("reset");

    // jQuery('input[name="filter_location_status"]').styler();

    event.preventDefault();
    $('#paginate').val('');

        $('input[name="filter_industry_status"]').each(function() {

        if(this.checked){
        $(this).toggleClass('checked').trigger('refresh');
        this.checked = !this.checked;
        $(this).toggleClass('checked').trigger('refresh');
        (this.checked)?(jQuery('.filter_industryList').removeClass('hide_it')):(jQuery('.filter_industryList').addClass('hide_it'));

        }

        });


    jQuery('input[name="filter_location_status"]').each(function() {

        if(this.checked){
        $(this).toggleClass('checked').trigger('refresh');
        this.checked = !this.checked;
        $(this).toggleClass('checked').trigger('refresh');
        (this.checked)?(jQuery('.location_search_cont').removeClass('hide_it')):(jQuery('.location_search_cont').addClass('hide_it'));

        }
    });
    jQuery('input[name="filter_keyword"]').val("");
    jQuery('#filter_salary').get(0).selectedIndex = 0;
    jQuery('#filter_jobType').get(0).selectedIndex = 0;
    jQuery('#filter_form').find('input, select').trigger('refresh');
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

