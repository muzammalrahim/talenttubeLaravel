{{-- @extends('site.user.usertemplate') --}}
@extends('web.employer.employermaster')
@section('custom_css')
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
@stop
@section('content')
<div class="profile profile-section">
   <h2 class="head icon_head_browse_matches">Add New Job</h2>
   <div class="add_new_job  ">
      <form method="POST" name="new_job_form" class="new_job_form newJob job_validation ">
         @csrf
         <div class="form-row">
            <div class="form-group col-md-6">
               <label for="inputEmail4">Title</label>
               <input type="text" name="title" class="form-control" id="inputEmail4" placeholder="Title">
               <div id="title_error" class="error field_error">&nbsp;</div>
            </div>
            <div class="form-group col-md-6">
               <label for="inputPassword4">Type</label>
               {{ Form::select('type', $jobType, ['placeholder' => 'Select Job Type'], ['class' => 'form-control custom-select', 'id'=>"inputPassword4"]) }}
               <div id="type_error" class="error field_error">&nbsp;</div>
            </div>
         </div>
         <div class="form-row">
            <div class="form-group col-md-6">
               <label for="salaryRangeFieldnew">Salary</label>

               {{ Form::select('salary', $salaryRange, ['placeholder' => 'Select Salary Range','onchange' => '', 'id' => 'salaryRangeFieldnew'],['class' => 'salaryRangeField form-control icon_show',]) }}

               <div id="salary_error" class="error field_error to_hide">&nbsp;</div>
            </div>
            <div class="form-group col-md-6">
               <label for="expiration_error">Expiration Date:</label>
               <input type="text" name="expiration" class="form-control datepicker" id="expiration_error" placeholder="Expiration Date">
               <div id="expiration_error" class="error field_error to_hide ">&nbsp;</div>
            </div>
         </div>
         <div class="form-row">
            <div class="form-group col-md-6">
               <label for="onlineTest">Online Test</label>
               <select name="test_id" class="form-control icon_show" id = "onlineTest">
                  <option value="0">Select Test</option>
                  @foreach ($onlineTest as $test)
                  <option value="{{$test->id}}"> {{$test->name}} </option>
                  @endforeach
               </select>
            </div>
            <div class="form-group col-md-6">
               <label for="inputPassword4">Vacancies</label>
               <input type="text" name="vacancies" class="form-control" id="inputPassword4" placeholder="Vacancies">
               <div id="vacancies_error" class="error field_error to_hide">&nbsp;</div>
            </div>
         </div>
         <div class="form-row">
            <div class="form-group col-md-6">
               <label for="inputPassword4">Description</label>
               <textarea name="description" class="form-control" rows="7" cols="5" maxlength="1000"></textarea>
               <div id="description_error" class="error field_error to_hide">&nbsp;</div>
            </div>
            <div class="form-group col-md-6">
               {{-- <span class="form_label">Location :</span> --}}
               <label for="location_search_cont">Location</label>
               <div class="location_search_cont">
                  <div class="row m-0 jus">
                     <input type="text" name="location_search" class="col-9 form-control" id="location_search" value="" placeholder="Type a location" aria-invalid="false">
                     <select class="filter_location_radius col-3 form-control" name="filter_location_radius" data-placeholder="Select Location Radius">
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
                  <div class="location_map_box dtable w100">
                     <div class="location_map" id="location_map" style="height: 145px !important"></div>
                  </div>
               </div>
            </div>
         </div>
         <div class="form-row">
            <div class="form-group col-md-12">

               <div class="form_field ">
                  <div class="row">
                     <div class="col-12 col-sm-2">Industry Experience :</div>
                     <div class="col-11 col-sm-9">
                        <p class="loader SaveindustryExperience"style="float: left;"></p>
                        <div class="IndusList form_input">
                           <div class="IndustrySelect" style="width:80%;"></div>
                        </div>
                        <div class="mt-3">
                           <a class=" addIndus blue_btn  mt-2 py-2 pointer"  title="Add a Question">+ Add</a>
                           <a class=" orange_btn  buttonSaveIndustry mt-2 py-2 pointer"style = "cursor:pointer;" onclick="updateNewJobIndustryExperience()">Save</a>
                        </div>
                     </div>
                     <div class="col-1 col-sm-1"><i class="editIndustry fas fa-edit orange_btn float-right py-2 pointer"></i></div>
                  </div>
               </div>
            </div>
         </div>
         <div class="job_age form_field ">
            <div class="form_input ">
               {{--   
               <div class="jobQuestions">
                  <div class="question mb10 relative"><input type="text" name="questions[]" class="w100" />
                     <span class="close_icon jobQuestion"></span>
                  </div>
               </div>
               --}}
               <div class="jobQuestions row d-flex  border border-secondary rounded-2 pt-3">
                  <h2 class="form_label">Job Questions:</h2>
                  <div class="col-12 col-sm-6 col-md-6 col-lg-6 p-4">
                     <div class="jobQuestion q1 row bg-light rounded">
                        <div class="col-md-12 pt-2">
                           <label>Title</label>
                           <div class="jq_field title col-md-12 p-0"><input type="text" name="jq[0][title]" class="form-control bg-white" /></div>
                        </div>
                        <div class="col-md-12 pt-2">
                           <label >Options</label>
                           <div class="jq_field_questions mb20">
                              <div class="option row mb-1 ">
                                 <div class="col-md-5">
                                    <input type="text" class="form-control bg-white" name="jq[0][option][0][text]" />
                                 </div>

                                 

                                 <div class="jq_option_cbx col-md-3 custom-checkbox">
                                    <input type="checkbox" id="jq_0_option_0_preffer" name="jq[0][option][0][preffer]" value="preffer">
                                    <label for="jq_0_option_0_preffer" >Undiserable</label>
                                 </div>
                                 <div class="jq_option_cbx col-md-3 custom-checkbox">
                                    <input type="checkbox" id="jq_0_option_0_goldstar" name="jq[0][option][0][goldstar]" value="goldstar">
                                    <label for="jq_0_option_0_goldstar" >Gold Star</label>
                                 </div>
                              </div>
                           </div>
                           <div class="jq_remove"><span class=" removeJobQuestion text-danger float-right pb-2"><i class="fas fa-times-circle"></i></span></div>
                           <div class="j_button dinline_block addOptionsBtn"><a class="addQuestionOption graybtn jbtn blue-btn" data-qc="0">Add Option+</a></div>
                        </div>
                        
                     </div>
                  </div>
               </div>
               <input type="hidden" name="questionCounter" id="questionCounter" value="0">
               <div class="j_button dinline_block mt20 fl_right mt-4">
                  {{-- <a class="addQuestion graybtn jbtn blue_btn py-1"title="Add Questions">Add Question</a> --}}
                  <a class="blue-btn" onclick="addnewQuestion()" style="cursor: pointer;">Add Question</a>

               </div>
            </div>
         </div>
         <div class="form_field">
            <span class="form_label"></span>
            <div class="form_input">
               <div class="general_error error to_hide">&nbsp;</div>
            </div>
         </div>
         <div class="fomr_btn act_field m-auto row">
            <span class="form_label"></span>
            {{-- <input type="type" value="academic" /> --}}
            <div class="col-md-3">
               <button class="btn small turquoise saveNewJob orange_btn ">Save</button>
            </div>
         </div>
      </form>
   </div>
</div>
<div class="cl"></div>
</div>
@stop
@section('custom_footer_css')
{{-- 
<link rel="stylesheet" href="{{ asset('css/site/profile.css') }}">
--}}
<link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}">
{{-- 
<link rel="stylesheet" href="{{ asset('css/site/gallery_popup/magnific-popup.css') }}">
--}}
{{-- 
<link rel="stylesheet" href="{{ asset('css/site/gallery_popup/lc_lightbox.css') }}">
--}}
<style type="text/css">
   .mz{margin: 0!important;}
   .addQuestionOption{
   cursor: pointer;
   }
</style>
@stop
@section('custom_js')
{{-- <script src="{{ asset('js/site/jquery.modal.min.js') }}"></script> --}}
<script src="{{ asset('js/site/jquery-ui.js') }}"></script>
<script src="{{ asset('js/web/common.js') }}"></script>
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
       var newIndusHtml = '<div class="row mt-3 mt-lg-0 mb-3">';
           newIndusHtml += '<div class="IndustrySelect col-11 "><select name="industry_experience[]" class="industry_experience userIndustryExperience form-control icon_show">';
       @if(!empty($industriesList))
           @foreach($industriesList as $lk=>$lv)
               newIndusHtml += '<option value="{{$lk}}">{{$lv}}</option>';
           @endforeach
       @endif
       newIndusHtml += '</select>';
       newIndusHtml += '</div>';
       newIndusHtml += '<i class="fa fa-trash fa-trash2 col-1  removeIndustry"></i>';

       newIndusHtml += '</div>';
   
       $('.IndusList').append(newIndusHtml);
   
      });
   });
   
   
   
   $(document).ready(function() {
      console.log(' new job doc ready  ');
      $(".datepicker").datepicker({
         dateFormat: "yy-mm-dd",
         minDate: 1
      });
   
      
      $(".editIndustry").click(function(){
         $(this).closest('.IndusListBox').addClass('edit');
         $('.removeIndustry').removeClass('hide_it');
         $('.addIndus').removeClass('hide_it');
         $('.buttonSaveIndustry').removeClass('hide_it');
      });
   
   
      // ====================================================== remove question html from dom. ======================================================
   
       $(document).on('click','.removeJobQuestion',function(){
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