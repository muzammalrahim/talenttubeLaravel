
@extends('web.user.usermaster')

@section('custom_css')
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}"> --}}
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

     @include('site.jobs.filter')

      <!-- Job Detail Area -->

      <div class="jobs_list">
          @include('web.jobs.list') {{-- web/jobs/list --}}
        
      </div>

      <!-- Job Detail Area -->
    </div>
  </div>

</section>




               <!-- =====================Apply button modal================================ -->
          <div class="modal fade" id="myModal9" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
                  <div class="m-inner-main">
                    <div class="loc-m-row">
                      <div class="row Apply-modal-body">
                        <h4 class="first-heading">1 day contract - Market Stall Assistant</h4>
                        <p>Almost done , few questions before your resume is accepted for this job</p>
                        <form action="">
                          <div class="col-md-12 Apply-job-modal-form">
                            <label for="">Are you available all day August 15th, and can you make it to the Brisbane CBD
                              for 8 hours?</label>
                            <ul class="question-radiobtn">
                              <li>
                                <div class="form-check emp-redio d-block">
                                  <input type="radio" id="test1" name="radio-group1" checked>
                                  <label for="test1"> Yes to both</label>
                                </div>

                              </li>

                              <li>
                                <div class="form-check emp-redio">
                                  <input type="radio" id="test2" name="radio-group1">
                                  <label for="test2">No to both</label>
                                </div>
                              </li>
                              <li>
                                <div class="form-check emp-redio">
                                  <input type="radio" id="test3" name="radio-group1">
                                  <label for="test3">Yes on the 15th, but need a lift to the CBD</label>
                                </div>
                              </li>
                            </ul>
                          </div>
                          <div class="col-md-12 Apply-job-modal-form">
                            <label for="">Are you physically fit and able to move heavy equipment and stock?</label>
                            <ul class="question-radiobtn">
                              <li>
                                <div class="form-check emp-redio">
                                  <input type="radio" id="test4" name="radio-group2" checked>
                                  <label for="test4">Yes</label>
                                </div>

                              </li>

                              <li>
                                <div class="form-check emp-redio">
                                  <input type="radio" id="test5" name="radio-group2">
                                  <label for="test5">No</label>
                                </div>
                              </li>
                              <li>
                                <div class="form-check emp-redio">
                                  <input type="radio" id="test6" name="radio-group2">
                                  <label for="test6">Up to 20 kilos max</label>
                                </div>
                              </li>
                            </ul>
                          </div>
                          <div class="col-md-12 Apply-job-modal-form">
                            <label for="">Do you consent to just 1 day contract?</label>
                            <ul class="question-radiobtn">
                              <li>
                                <div class="form-check emp-redio3">
                                  <input type="radio" id="test7" name="radio-group3" checked>
                                  <label for="test7">Yes</label>
                                </div>

                              </li>

                              <li>
                                <div class="form-check emp-redio3">
                                  <input type="radio" id="test8" name="radio-group3">
                                  <label for="test8">No</label>
                                </div>
                              </li>
                            </ul>
                          </div>
                          <div class="col-md-12 Apply-job-modal-form">
                            <label for="">What motivated you to apply for this job and why do think you will be
                              suitable?</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                              placeholder="Maximum 300 Characters"></textarea>
                          </div>
                          <div class="col-md-12 Apply-job-modal-form">
                            <label for="">This job requires you to complete a mandatory online test, in order to be
                              considered for the job. Do you agree to continue ?</label>
                            <ul class="question-radiobtn">
                              <li>
                                <div class="form-check emp-redio3">
                                  <input type="radio" id="test9" name="radio-group4" checked>
                                  <label for="test9">Yes</label>
                                </div>

                              </li>

                              <li>
                                <div class="form-check emp-redio3">
                                  <input type="radio" id="test10" name="radio-group4">
                                  <label for="test10">No</label>
                                </div>
                              </li>
                            </ul>

                          </div>
                          <div class="col-md-12 Apply-job-modal-form">
                            <label for="">We can see you’ve completed this same online test previously. Would you like
                              to use your previous results, or would you like to complete the test again?</label>
                            <ul class="question-radiobtn">
                              <li>
                                <div class="form-check emp-redio3">
                                  <input type="radio" id="test11" name="radio-group5" checked>
                                  <label for="test11">Redo Test</label>
                                </div>

                              </li>

                              <li>
                                <div class="form-check emp-redio3">
                                  <input type="radio" id="test12" name="radio-group5">
                                  <label for="test12">Use Previous Result</label>
                                </div>
                              </li>
                            </ul>

                          </div>
                          <div class="col-md-12 bj-tr-btn">
                            <button class="interview-tag used-tag" type="submit"><i class="fas fa-paper-plane"></i>Submit</button>
                          </div>
                        </form>
                      </div>
                    </div>


                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- =====================Apply button modal ends============================= -->


           <!-- Modal by filter industry -->
           <div class="bj-modal">
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog"
              aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog filter-industry-modal" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <div class="m-header">
                      <h4 class="modal-title" id="myModalLabel">
                        <img src="assests/images/filter.png" alt="img" class="">
                        Filter by Industry
                      </h4>
                      <i data-dismiss="modal" aria-label="Close" class="close-box fa fa-times"></i>
                    </div>
                    


                  </div>
                  <div class="modal-body">
                    <div class="i-modal-checks">
                     {{-- industry selection --}}
         <div class="filter_industryList {{-- hide_it --}}">
            @php
            $industries = getIndustries()
            @endphp
            @if(!empty($industries))
            <div class="filter_industries_list ">
               <ul class="industries_ul item_ul dot_list">
                  @foreach ($industries as $indK => $indV)
                  <li class="" data-id="{{$indK}}" data-type="filter_industry[]"><span>{{$indV}}</span></li>
                  @endforeach
               </ul>
            </div>
            @endif
         </div>
         {{-- industry selection --}}
                    </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary bs-btn">
                      <img src="assests/images/search-modal.png" alt="img" class="">
                      <span class="fb-text">
                        Search
                      </span>
                    </button>

                  </div>
                </div>
              </div>
            </div>
            
          <!-- Modal -->
          </div>

          <!-- Modal -->

          <!-- Modal filter by location -->
          <div class="bj-modal loc-modal">
            <div class="modal fade" id="myModal2" tabindex="-1" role="dialog"
              aria-labelledby="myModalLabel" aria-hidden="true">

              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <div class="m-header">
                      <h4 class="modal-title">
                        <i class="fas fa-map-marker-alt"></i> Location
                        <i data-dismiss="modal" aria-label="Close" class="close-box fa fa-times"></i>
                      </h4>
                    </div>
                  </div>
                  <div class="modal-body">
                    <div class="location_search_cont {{-- hide_it --}}">
            <div class="location_input dtable w100">
               <input type="text" name="location_search" class="inp w80 fl_left" id="location_search" value="" placeholder="Type a location" aria-invalid="false">
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
            </div>
            <div class="location_map_box dtable w100">
               <div class="location_map" id="location_map"></div>
            </div>
         </div>
                  </div>
                </div>
              </div>
            </div>
          </div>


          <!-- Modal -->


@stop

@section('custom_footer_css')
<link rel="stylesheet" href="{{ asset('css/site/profile.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}"> --}}


@stop

@section('custom_js')
<script src="{{ asset('js/site/jquery.modal.min.js') }}"></script>
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

    jQuery('input[name="filter_location_status"]').styler();

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

