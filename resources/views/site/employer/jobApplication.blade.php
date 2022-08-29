{{-- @extends('site.user.usertemplate') --}}
@extends('web.employer.employermaster')
@section('custom_css')
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />



{{-- <link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}"> --}}
{{-- 
<link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}">
--}}
@stop
@section('content')
<div class="jobApplicationCont profile profile-section">
   <h2 class="head icon_head_browse_matches">Job Seeker Applications</h2>
   <div class="job_applications_filter mb20 employee-wraper">
      {{ Form::open(array('url' => url()->current(), 'method' => 'get', 'id' => 'job_applications_filter_form' )) }}
      <input type="hidden" name="page" id="paginate" value="">
      <input type="hidden" name="job_id" value="{{$job->id}}">
      <div class="row b-filter-row top-filter-row mb-0">
         

         {{-- ======================================= Filter By Keyword ======================================= --}}
         
         <div class="row">   
            <div class="col-md-6 col-sm-6 col-12">
               <div class="input-employee clearfix mb-0">
                  <div class="row">
                     {{-- <label class="col-md-4">Keyword:</label> --}}
                     <label class="col-12 col-sm-4 browse-heading font-weight-normal">Keyword:</label>
                     <input type="text" class="form-control col-12 col-sm-8 ml-3 ml-sm-0" name="filter_keyword">
                  </div>
               </div>
            </div>
            
            {{-- ======================================= Filter By Salary ======================================= --}}

            <div class="col-md-6 col-sm-6 col-12">
               <div class="input-employee clearfix">
                  <div class="row">
                     <label class="col-12 col-sm-4 browse-heading font-weight-normal">Salary:</label>
                     {{-- <input type="text" class="form-control col-md-8" name="filter_salary" aria-label="Recipient's username"> --}}
                     <select name="filter_salary" class="form-control col-12 col-sm-8 ml-3 ml-sm-0 bg-white icon_show" id="filter_salary" data-placeholder="Select Salary Range">
                        <option value="">Select Salary Range</option>
                        @foreach(getSalariesRange() as $sk => $salary)
                            <option value="{{$sk}}">{{$salary}}</option>
                        @endforeach
                    </select>
                  </div>
               </div>
            </div>
         </div>

         {{-- ======================================= Filter By Sort By ======================================= --}}

         <div class="row">
           
            {{-- <div class="searchField_sortBy d-flex col-md-4"> --}}
            <div class="col-md-6 col-sm-6 col-12">
               <div class="input-employee clearfix">

                  <div class="row">
                     <label class="col-12 col-sm-4 browse-heading font-weight-normal">Sort By:</label>

                     {{-- <div class="sortByFieldLabel col-5 pt-2">Sort By: </div> --}}
                     <select name="ja_filter_sortBy" class="form-control col-12 col-sm-8 ml-3 ml-sm-0 bg-white icon_show">
                        <option value="goldstars">Gold Stars</option>
                        <option value="applied">Applied</option>
                        <option value="inreview">In Review</option>
                        <option value="interview">Interview</option>
                        <option value="unsuccessful">Unsuccessful</option>
                        <option value="pending">pending</option>
                        <option value="all_candidates">All candidates</option>
                     </select>
                  </div>
               </div>
            </div>


            {{-- ======================================= Filter By Qualification ======================================= --}}


            <div class="col-md-6 col-sm-6 col-12 px-0">
               <div class="searchField_qualification b-filter-row">
                  <div class="row input-employee mb-0">
                     {{-- <div class="searchFieldLabel col-5 pt-2">Qualification: </div> --}}  
                     <label class="col-12 col-sm-4 browse-heading font-weight-normal">Qualifications:</label>
                     <select class="col-12 col-sm-8 ml-3 ml-sm-0 filter_qualification_type form-control bg-white icon_show" name="ja_filter_qualification_type" onchange="showQualificationSelect2()" data-placeholder="Select Qalification & Trades">
                        <option value="">Select Qalification & Trades</option>
                        <option value="certificate">Certificate or Advanced Diploma</option>
                        <option value="trade">Trade Certificate</option>
                        <option value="degree">University Degree</option>
                        <option value="post_degree">University Post Graduate (Masters or PHD)</option>
                     </select>
                     @php 
                        ($qualifications = getQualificationsList())
                     @endphp
                     @if(!empty($qualifications))
                     <div class="filter_qualificaton_degree pe-0" style="opacity:0">
                        <select class="qualification_ul item_ul dot_list form-select icon_show" id="filter_by_qualification">
                           @foreach ($qualifications as $qualif)
                           <option class="{{$qualif['type']}}" data-id="{{$qualif['id']}}" data-type="ja_filter_qualification[]" value="{{$qualif['id']}}">
                              <span>{{$qualif['title']}}</span>
                           </option>
                           @endforeach
                        </select>
                     </div>
                     @endif
                  </div>
               </div>
            </div>
         </div>

         {{-- ======================================= Filter By Industry ======================================= --}}


            <div class="row b-filter-row mt-3">
               <div class="col-12 col-md-10 browse-mp">
                  <div class="row">
                     <div class="col-3 col-sm-2 mt-1">
                        <h5 class="browse-heading font-weight-normal">Industry:</h5>
                     </div>
                     <div class="col-2 col-sm-1 custom-checkbox pl-sm-0">
                        <input type="checkbox" name="filter_industry_status" checked class="">
                     </div>
                     <div class="col-sm-9 filter_industryList">
                           <select name="filter_industry[]" multiple="multiple" id="filter_industry" placeholder = "Filter by Job" class="multi-select form-control custom-select" style="width:100%">
                              @php
                              $industries = getIndustries()
                              @endphp
                              @if(!empty($industries))
                              <div class="filter_industries_list">
                                 @foreach ($industries as $indK => $indV)
                                 <option class="" value="{{$indK}}" data-id="{{$indK}}"><span>{{$indV}}</span></option>
                                 @endforeach
                              </div>
                              @endif
                           </select>
                           <i class="fa fa-angle-down dropdownSelect3 position-absolute"></i>
                           {{-- 
                        </div>
                        --}}
                     </div>
                  </div>
               </div>
            </div>

         {{-- ======================================= Filter By Question ======================================= --}}


         <div class="row b-filter-row mt-3">
            <div class="col-12 col-md-10">            
               <div class="row">
                  <div class="col-3 col-sm-2 mt-1">  
                     <h5 class="browse-heading font-weight-normal">Question:</h5>
                  </div>
                  <div class="col-2 col-sm-1 custom-checkbox pl-sm-0">
                     <input type="checkbox" class="" name="filter_by_questions">
                  </div>
                  <div class="col-sm-9 pt-3 pt-sm-0 questionFilter filter_question_cont">
                     @if(varExist('questions', $job))
                     @foreach ($job->questions as $qkey =>  $jq)
                     <div class="jobFilterQuestion row mb-1">
                        <span class="fjq_counter col-2">Question {{($qkey+1)}}: </span>
                        <span class="fjq_title col-5">{{$jq->title}}</span>
                        <div class="fjq_options col-5">
                           @if($jq->options)
                           <select class="filter_question bg-white  select_aw form-control icon_show" name="filter_question[{{$jq->id}}]" >
                              <option value="">Select</option>
                              @foreach ($jq->options as $qk => $jqopt)
                              <option value="{{$jqopt}}">{{$jqopt}}</option>
                              @endforeach
                           </select>
                           @endif
                        </div>
                     </div>
                     @endforeach
                     @endif
                  </div>
               </div>
            </div>
         </div>
            
            {{-- ============================================ Filter by Location ============================================ --}}


            <div class="row b-filter-row mt-3">
               <div class="col-12 col-md-10">
                  <div class="row">
                     <div class="col-3 col-sm-2 mt-1 b-mob-pad">
                        <h5 class="browse-heading font-weight-normal">Location:</h5>
                     </div>
                     <div class="col-2 col-sm-1 custom-checkbox pl-sm-0">  
                        <input type="checkbox" class="" name="filter_location_status">
                     </div>
                     <div class="FilterLocationBox col-sm-9 pt-3 pt-sm-0">
                        <div class="location_search_cont row hide_it">
                           <div class="col-9 pe-0 md-form form-sm">
                              <input type="text" name="location_search" id="location_search" class="form-control form-control-sm white-text"  placeholder="Type a location">
                           </div>
                           <div class="col-3 ps-0">
                              <select class="white-text mdb-select md-form filter_location_radius custom-select icon_show" name="filter_location_radius" data-placeholder="Select Location Radius">
                                 <option value="5" selected="selected">5km</option>
                                 <option value="10">10km</option>
                                 <option value="25">25km</option>
                                 <option value="50">50km</option>
                                 <option value="51">50km +</option>
                              </select>
                           </div>
                           <div class="location_latlong d-none w100">
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


         {{-- data-target ="#qualification_modal" data-toggle = "modal" --}}


         <div class="bj-tr-btn">
            <button class="orange_btn" type="reset"><i class="fas fa-redo"></i> Reset</button>
            <button class="interview-tag used-tag"><i class="fas fa-paper-plane"></i>Submit</button>
         </div>
      </div>
      {{ Form::close() }}
   </div>
   {{-- ================================================== Job Applications ================================================== --}}
   <div class="job_applications"></div>

</div>


{{-- ================================= Show video =================================  --}}

   @include('web.modals.show_video')

{{-- ================================= Show Qualification =================================  --}}


   @include('web.modals.qualification_modal')


<div id="onlineTestModal" class="modal w100 p0">
   <div class="testHeader">
      <p>Send online Test</p>
   </div>
   <div class="testContent p10">
      <form name="sendTestForm" class="sendTestForm">
         {{-- @csrf --}}
         <input type="hidden" name="jobApp_id" class="jobAppIdModal">
         <div class="job_age form_field" style="height:120px;">
            <span class="w20 dinline_block">Select Test</span>
            <div class="w70 dinline_block">
               <select name="test_id">
                  @foreach ($onlineTest as $test)
                  <option value="{{$test->id}}"> {{$test->name}} </option>
                  @endforeach
               </select>
            </div>
         </div>
      </form>
      <p class="errorsInFields text-danger"></p>
      <div class="fomr_btn act_field center">
         <button class="btn small turquoise sendTestButton">Send Test</button>
      </div>
   </div>
 
</div>

@stop
@section('custom_js')
{{-- <script src="{{ asset('js/site/jquery.modal.min.js') }}"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="{{ asset('js/site/jquery-ui.js') }}"></script>
<script src="{{ asset('js/site/common.js') }}"></script>
<script src="{{ asset('js/web/profile.js') }}"></script>
<script type="text/javascript">
   this.showQualificationSelect2 = function(){
      // console.log('on change qualification');
      var selected = $('.ja_filter_qualification_type option:selected').val();
      // console.log(selected);
      if (selected != '') {
         $('.filter_qualificaton_degree').css('opacity', '1');
         $('.dropdownSelect2').css('opacity', '1');
      }
      else{
         $('.filter_qualificaton_degree').css('opacity', '0');
         $('.dropdownSelect2').css('opacity', '0');
         $("#filter_by_qualification").val('').trigger('change');

      }
   }

   $(document).ready(function() {
      $('#filter_industry').select2();
   
   
       $(".reset-btn").click(function(){
       ///  $("#jobSeeker_filter_form").trigger("reset");
       jQuery('input[name="filter_location_status"]').styler();
   
       event.preventDefault();
       $('#paginate').val('');
       jQuery('input[name="filter_location_status"]').each(function() {
               if(this.checked){
               $(this).toggleClass('checked').trigger('refresh');
               this.checked = !this.checked;
               $(this).toggleClass('checked').trigger('refresh');
               (this.checked)?(jQuery('.location_search_cont').removeClass('hide_it')):(jQuery('.location_search_cont').addClass('hide_it'));
               }
           });
   
       jQuery('select.filter_qualification_type').each(function() {
   
           var degreeType = "";
           $(this).get(0).selectedIndex = 0;
           $(this).closest('.searchField_qualification').attr('class','searchField_qualification '+degreeType);
           $('.dot_list li').removeClass('active');
           $('.searchField_qualification .dot_list_li_hidden').remove();
       });
   
       $('input[name="filter_industry_status"]').each(function() {
   
           if(this.checked){
           $(this).toggleClass('checked').trigger('refresh');
           this.checked = !this.checked;
           $(this).toggleClass('checked').trigger('refresh');
           (this.checked)?(jQuery('.filter_industryList').removeClass('hide_it')):(jQuery('.filter_industryList').addClass('hide_it'));
   
           }
   
       });
   
   
       jQuery('#filter_salary').get(0).selectedIndex = 0;
       jQuery('#job_applications_filter_form').find('input, select').trigger('refresh');
   
       jQuery('input[name="ja_filter_keyword"]').val("");
   
       $('input[name="filter_by_questions"]').each(function() {
   
           if(this.checked){
           $(this).toggleClass('checked').trigger('refresh');
           this.checked = !this.checked;
           $(this).toggleClass('checked').trigger('refresh');
           (this.checked)?(jQuery('.filter_question_cont').removeClass('hide_it')):(jQuery('.filter_question_cont').addClass('hide_it'));
   
           }
   
        // $('input, select').styler({ selectSearch: true, });
       });
    getData();
   });
   
   
       console.log(' new job doc ready ');
       // trigger date picker.
       $(".datepicker").datepicker({ dateFormat: "yy-mm-dd" });
   
       // job Delete confirmation modal popup open.
       $('.myJobDeleteBtn').on('click',function(){
           var job_id = $(this).attr('data-jobid');
           console.log(' confirmJobAppRemoval click  job_id ', job_id, $(this) );
           $('#confirmJobDeleteModal').modal({
               fadeDuration: 200,
               fadeDelay: 2.5,
               escapeClose: false,
               clickClose: false,
           });
           $('#deleteConfirmJobId').val(job_id);
       });
   
       // confirmation job delete ok trigger.
       $(document).on('click','.confirm_jobDelete_ok',function(){
           $('.confirmJobDeleteModal  .img_chat').html(getLoader('jobDeleteloader'));
           $(this).prop('disabled',true);
           var job_id =  $('#deleteConfirmJobId').val();
           $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
           $.ajax({
               type: 'POST',
               url: base_url+'/ajax/deleteJob/'+job_id,
               success: function(data){
                   if( data.status == 1 ){
                       $('.confirmJobDeleteModal .img_chat').html(data.message);
                       $('.job_row.job_'+job_id).remove();
                   }else{
                       $('.confirmJobDeleteModal .img_chat').html(data.error);
                   }
               }
           });
       });
   
       // Show Job Application Question Answers.
       $(document).on('click','.ja_load_qa',function(){
           var job_app_id = $(this).attr('data-appid');
           $(this).html(getLoader('jobDeleteloader'));
           $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
           $.ajax({
               type: 'GET',
               url: base_url+'/ajax/getJobAppQA/'+job_app_id,
               success: function(data){
                   $('.job_app_'+job_app_id+' .job_app_qa_box').html(data).show();
                   $('.job_app_'+job_app_id+' .ja_load_qa').remove();
               }
           });
       });
   
       // Top Filter form submit load data throug ajax.
       $('#job_applications_filter_form').on('submit',function(event){
           console.log(' job_applications_filter_form submit ');
           event.preventDefault();
           $('#paginate').val('');
           getData();
       });
   
       // Bottom pagination load data throug ajax.
       $(document).on('click','.job_pagination .page-item .page-link',function(e){
           console.log(' page-link click ', $(this) );
           e.preventDefault();
           var page = $(this).attr('href').split('page=')[1];
           $('#paginate').val(page);
           getData();
       });
   
       // change job application status, send ajax.
       $(document).on('change','select.jobApplicStatus',function(e){
           console.log(' jobApplicStatus change ', $(this));
           var statusElem = $(this);
           var status = $(this).val();
           var application_id = $(this).attr('data-application_id');
           $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
           $.ajax({
               type: 'POST',
               url: base_url+'/ajax/changeJobApplicationStatus',
               data: {status: status, application_id: application_id},
               success: function(data){
                   var jobAppStatusHtml = '<span class="jobApplicationStatusResponse">Updated Succesfully</span>';
                   statusElem.closest('.jobApplicationStatusCont').append(jobAppStatusHtml);
                   setTimeout(function(){
                     statusElem.closest('.jobApplicationStatusCont').find('.jobApplicationStatusResponse').remove();
                   },1500);
               }
           });
       });
   
       // function to send ajax call for getting data throug filter/Pagination selection.
       var getData = function(){
           var url = '{{route('jobAppFilter')}}';
           $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
           $.post(url, $('#job_applications_filter_form').serialize(), function(data){
               $('.job_applications').html(data);
               // $('.jobApplicationStatusCont select').styler({ selectSearch: true,});
           });
       }
   
       // initially when page load trigger the ajax call to get data.
       getData();
   
       formStyler =  function(){
         $('#job_applications_filter_form input, #job_applications_filter_form select').styler({ selectSearch: true,});
       }
   
   
   
   //====================================================================================================================================//
   // Enable/Disabled Filtering by Questions.
   //====================================================================================================================================//
   $('input[name="filter_by_questions"]').change(function() {
       console.log(' filter_by_questions ');
       (this.checked)?(jQuery('.filter_question_cont').removeClass('hide_it')):(jQuery('.filter_question_cont').addClass('hide_it'));
        // $('input, select').styler({ selectSearch: true, });
   });
   
   
   
   //====================================================================================================================================//
   // Enable/Disabled Filtering by google map location.
   //====================================================================================================================================//
   $('input[name="filter_location_status"]').change(function() {
       console.log(' filter_location_status ');
       (this.checked)?(jQuery('.location_search_cont').removeClass('hide_it')):(jQuery('.location_search_cont').addClass('hide_it'));
   });
   
   
   //====================================================================================================================================//
   // Function to display sub qualification on base of qualification type.
   //====================================================================================================================================//
   // $(document).on('change','select[name="ja_filter_qualification_type"]',function() {
   //     var degreeType =  $(this).val();
   //      if (degreeType != ''){ degreeType = (degreeType == 'trade')?'trade':'degree';}
   //      $(this).closest('.searchField_qualification').attr('class','searchField_qualification '+degreeType);
   //      $('.dot_list li').removeClass('active');
   //      $('.searchField_qualification .dot_list_li_hidden').remove();
   // });
   // $(document).on('click','.dot_list li', function(){
   //     console.log(' dot_list li click ');
   //     if($(this).hasClass('active')){
   //         $(this).removeClass('active');
   //         $(this).find('.dot_list_li_hidden').remove();
   //     }else{
   //         $(this).addClass('active');
   //         var type = $(this).attr('data-type');
   //         var qualif_value = $(this).attr('data-id');
   //         var input_hidden_html = '<input type="hidden" class="dot_list_li_hidden" name="'+type+'" value="'+qualif_value+'" />';
   //         $(this).append(input_hidden_html);
   //     }
   
   // });
   
   
   
   
   
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
                       // jQuery("#location_search").val(address);   // Commented for preventing duplication of location
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
@section('custom_footer_css')
{{-- <link rel="stylesheet" href="{{ asset('css/site/profile.css') }}"> --}}
<style>
   @media only screen and (max-width: 1200px) {
      .block-box .box-footer1 {
         flex-direction: row !important;
      }
      .block-progrees-ratio1 {
         width: auto !important;
      }
   }
   .bj-tr-btn button {
      margin: 5px !important;
   }
   @media only screen and (max-width: 479px){
      .sidebaricontoggle {
         top: 4rem !important;
      }
      .blue_btn {
         width: 100% !important;
      }
   }
   @media only screen and (min-width: 480px) and (max-width: 767px) {

      .block-box .box-footer {
         background: transparent;
         border-radius: 2px 2px 0 0;
         position: relative;
         color: #ffffff;
         display: block;
         margin: 0px 5px 10px 5px;
      }
      .blue_btn {
         width: 100% !important;
      }
   }
   @media only screen and (min-width: 480px) and (max-width: 991px){
      .sidebaricontoggle {
         top: 5rem !important;
      }
   }
</style>
@stop