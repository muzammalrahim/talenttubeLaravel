
@extends('web.employer.employermaster') {{-- site/employer/employermaster --}}
@section('custom_css')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@stop
@section('content')
<div class="newJobCont  profile profile-section">
   {{-- <h2 class="head icon_head_browse_matches">Job Seekers List</h2> --}}
   <div class="add_new_job jobSeekersListingCont">
      <!-- =============================================================================================================================== -->
      
      @include('site.employer.jobSeekers.filter')    {{-- site/employer/jobSeekers/filter --}}

      <!-- =============================================================================================================================== -->
      
      @include("site.spinner")
      
      <!-- =============================================================================================================================== -->
      <div class="scroll"></div>
      <div class="jobSeekers_list mb-5">
         @include('site.employer.jobSeekers.list')  {{-- site/employer/jobSeekers/list --}}
      </div>
      
      <!-- =============================================================================================================================== -->
   </div>
   <div class="cl"></div>



</div>

@include('web.modals.unlike')


@include('web.modals.show_video')
{{-- @include('web.modals.testVideoShowModal') --}}


@stop



@section('custom_js')
{{-- <script src="{{ asset('js/site/jquery.modal.min.js') }}"></script> --}}
{{-- <script src="{{ asset('js/site/jquery-ui.js') }}"></script> --}}
<script src="{{ asset('js/site/common.js') }}"></script>
<script src="{{ asset('js/web/profile.js') }}"></script>
{{-- <script src="{{ asset('js/site/UserFilter.js') }}"></script> --}}
<script type="text/javascript">
   $(document).ready(function() {   

    // $('.pagination').click(function(){

        $("html").animate({ scrollTop: 0 }, "slow");
        //alert('Animation complete.');
        //return false;


        $(".jobseeker_pagination").click(function() {
            $('.scroll').scroll(function() {
                didScroll = true;
            });
        });
    // })


   
   //====================================================================================================================================//
   // Top Filter form submit load data throug ajax.
   //====================================================================================================================================//
   
   $('#jobSeeker_filter_form').on('submit',function(event){
       console.log(' jobSeeker_filter_form submit ');
       event.preventDefault();
       $('#paginate').val('');
       getData();
   });
   
   //====================================================================================================================================//
   // function to send ajax call for getting data throug filter/Pagination selection
   //====================================================================================================================================//
   
   var getData = function(){
       var url = '{{route('jobSeekersFilter')}}';
       $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
       $.post(url, $('#jobSeeker_filter_form').serialize(), function(data){
           // console.log(' success data  ', data);
           $('.jobSeekers_list').html(data);    
       });
   }
   getData();
   
   //====================================================================================================================================//
   // Bottom pagination load data throug ajax.
   //====================================================================================================================================//
   
   $(document).on('click','.jobseeker_pagination .page-item .page-link',function(e){
       console.log(' page-link click ', $(this) );
       e.preventDefault();
       var page = $(this).attr('href').split('page=')[1];
       $('#paginate').val(page); 
       getData();
       var element = $('#scrollTop1').get(0)
       element.scrollIntoView({behavior: "smooth", block: "end", inline: "nearest"});
   });
   

   //====================================================================================================================================//
   // Enable/Disabled Filtering by Resume.
   //====================================================================================================================================//
   
   /*$('input[name="filter_by_resume_value"]').change(function() {
    
       // console.log(' filter_by_resume ');
       if(this.checked){
           jQuery('.filter_resume_cont').removeClass('hide_it');
       }else{
           jQuery('.filter_resume_cont').addClass('hide_it');
           jQuery('.filter_by_resume_value').val("");
       }
   
   });
   */
   
   //====================================================================================================================================//
   // Enable/Disabled Filtering by Age Group.
   //====================================================================================================================================//
   
    $('input[name="filter_by_age"]').change(function() {
       console.log(' filter_by_age ');
       if(this.checked){
           jQuery('.filter_age_cont').removeClass('hide_it');
       }else{
           jQuery('.filter_age_cont').addClass('hide_it');
           jQuery('.filter_by_age_val').val("");
       }
   
    });

   //====================================================================================================================================//
   // Enable/Disabled Filtering by Gender.
   //====================================================================================================================================//
   
    $('input[name="filter_by_gender"]').change(function() {
       console.log(' filter_by_gender ');
       if(this.checked){
           jQuery('.filter_gender_cont').removeClass('hide_it');
       }else{
           jQuery('.filter_gender_cont').addClass('hide_it');
           jQuery('.filter_by_gender_val').val("");
       }
   
    });


    //====================================================================================================================================//
   // Filter by Tags
   //====================================================================================================================================//
   
   $('input[name="filter_tags_status"]').change(function() {
       console.log("Tags Filter" + "Hi How are you");
       if(this.checked){
           jQuery('.filter_tagList').removeClass('hide_it');
           $(this).toggleClass('checked').trigger('refresh');
       }
       else{
           jQuery('.filter_tagList').addClass('hide_it');
           $(this).toggleClass('checked').trigger('refresh');
           var degreeType = "";
           $(this).get(0).selectedIndex = 0;
           $(this).closest('.searchField_tags').attr('class','searchField_tags '+degreeType);
           $('.dot_list li').removeClass('active');
           $('.searchField_tags .dot_list_li_hidden').remove();
   
       }
   });
    
    //====================================================================================================================================//
   // Filter by Industry Experience
   //====================================================================================================================================//
   

   $('input[name="filter_industry_status"]').change(function() {
        (this.checked)?(jQuery('.filter_industryDiv').removeClass('hide_it')):(jQuery('.filter_industryDiv').addClass('hide_it'));
   });

   //====================================================================================================================================//
   // Enable/Disabled Filtering by google map location.
   //====================================================================================================================================//
   
   $('input[name="filter_location_status"]').change(function() {
       console.log(' filter_location_status ');
       (this.checked)?(jQuery('.location_search_cont').removeClass('hide_it')):(jQuery('.location_search_cont').addClass('hide_it'));
   });
   
   //====================================================================================================================================//
   // Enable/Disabled Filtering by Questions.
   //====================================================================================================================================//
   
   $('input[name="filter_by_questions"]').change(function() {
       console.log(' filter_by_questions ');
       (this.checked)?(jQuery('.filter_question_cont').removeClass('hide_it')):(jQuery('.filter_question_cont').addClass('hide_it'));
       // $('input, select').styler({ selectSearch: true, });
   });
   
   
   
   
   
   
   
   
   
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
   
   //====================================================================================================================================//
   // Reset Button for filtering
   //====================================================================================================================================//
   
   $(".reset-btn").click(function(){
       // jQuery('input[name="filter_location_status"]').styler();
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
   
   // ========================================================= Filter by resume Resume =========================================================
   
   $('input[name="filter_by_resume_value"]').each(function() {

        jQuery('.filter_by_resume_value').val("");

       /*if(this.checked){
       // jQuery('.filter_by_resume_value').val("");
       $(this).toggleClass('checked').trigger('refresh');
       this.checked = !this.checked;
       $(this).toggleClass('checked').trigger('refresh');
       (this.checked)?(jQuery('.filter_resume_cont').removeClass('hide_it')):(jQuery('.filter_resume_cont').addClass('hide_it'));
       }*/
   
   });
   
   // ========================================================= Filter by salary =========================================================
   
   jQuery('#filter_salary').get(0).selectedIndex = 0;
   jQuery('#jobSeeker_filter_form').find('input, select').trigger('refresh');
   
   //  ========================================================= Filter By keyword =========================================================
   
   jQuery('input[name="filter_keyword"]').val("");
   
   // ========================================================= Filter by Age Group =========================================================
   
   $('input[name="filter_by_age_val"]').each(function() {
       if(this.checked){
       $("#filterAgeGroup").prop("selectedIndex", 0);
       $(this).toggleClass('checked').trigger('refresh');
       this.checked = !this.checked;
       $(this).toggleClass('checked').trigger('refresh');
       (this.checked)?(jQuery('.filter_age_cont').removeClass('hide_it')):(jQuery('.filter_age_cont').addClass('hide_it'));
       }
   });
   
   
   // ========================================================= Filter by Age Group =========================================================
   
   $('input[name="filter_by_gender"]').each(function() {
       if(this.checked){
       $("#filterAgeGroup").prop("selectedIndex", 0);
       $(this).toggleClass('checked').trigger('refresh');
       this.checked = !this.checked;
       $(this).toggleClass('checked').trigger('refresh');
       (this.checked)?(jQuery('.filter_gender_cont').removeClass('hide_it')):(jQuery('.filter_gender_cont').addClass('hide_it'));
       }
   });

   $("#filter_industry").val('').trigger('change');
   $("#filter_by_qualification").val('').trigger('change');
   $("#filter_by_usertaga").val('').trigger('change');
   
   //  ========================================================= Filter By tags =========================================================
   // jQuery('.filter_tagList').addClass('hide_it');
   // jQuery('.filter_tags_status').removeClass('checked');
   // $(this).toggleClass('checked').trigger('refresh');
   
   var degreeType = "";
   $(this).get(0).selectedIndex = 0;
   $(this).closest('.searchField_tags').attr('class','searchField_tags '+degreeType);
   $('.dot_list li').removeClass('active');
   $('.searchField_tags .dot_list_li_hidden').remove();
   
   
   //  ========================================================= Filter By Questions =========================================================
   
   
   $('input[name="filter_by_questions"]').each(function() {

        // console.log(' Filter by question clicked ');
   
       if(this.checked){
       $(this).toggleClass('checked').trigger('refresh');
       this.checked = !this.checked;
       $(this).toggleClass('checked').trigger('refresh');
       (this.checked)?(jQuery('.filter_question_cont').removeClass('hide_it')):(jQuery('.filter_question_cont').addClass('hide_it'));
   
       }
   
    // $('input, select').styler({ selectSearch: true, });
   });
   getDataCustom();
   });
   
   
   var getDataCustom = function(){
       var url = '{{route('jobSeekersFilter')}}';
       $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
       $.post(url, $('#jobSeeker_filter_form').serialize(), function(data){
           // console.log(' success data  ', data);
       $('.jobSeekers_list').html(data);
   });
   }
   
   
   $(document).on('click','.btnBulkPDFGenerate', function(){
   console.log(' btnBulkPDFGenerate click ');
   var cbx = $('input[name="cbx[]"]:checked').map(function(){return $(this).val(); }).toArray();
   // console.log(cbx);
   
   if(cbx.length <= 0){
     alert('Please Select Checkboxes');
     return false;
   }
   var cbx_hidden =  '';
   cbx.forEach(function(id){ cbx_hidden += '<input type="hidden" name="cbx[]" value="'+id+'" />'  });
   $('.bulkPDFExportForm .cbx_list').html(cbx_hidden);
   $('.bulkPDFExportForm').submit();
   });


   $(document).on('click', '.js_video_link', function(){
        setTimeout(function(){
            // $('#player').removeClass('w-100');


        },1000);
        
        $('div#videoShowModal').css({'width':'-webkit-fill-available', 'max-width': 'unset'});
        // $('#player').css('height', '50vh');
   });

 
   
   
</script>
@stop
@section('custom_footer_css')
<link rel="stylesheet" href="{{ asset('css/site/profile.css') }}">

<style type="text/css">

    html {
    overflow-x: hidden;
    overflow-y: hidden;
}

body { 
    overflow-x: hidden;
    overflow-y: hidden;
}



</style>
{{-- 
<link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}">
--}}
@stop