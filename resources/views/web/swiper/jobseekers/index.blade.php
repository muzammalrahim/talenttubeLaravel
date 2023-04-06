@extends('web.user.usermaster') {{-- mobile/user/usermaster --}}
    @section('custom_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/swiper/swipers.css') }}">
    @endsection
@section('content')
    
    @section('custom_css')
    {{-- <style type="text/css">
        .swiper-button-next, .swiper-button-prev {
            position: relative;
            top: var(--swiper-navigation-top-offset,50%);
            width: calc(var(--swiper-navigation-size)/ 44 * 27);
            height: 50px;
            margin-top: calc(0px - (var(--swiper-navigation-size)/ 2)) !important;
            z-index: 10;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin-top: 0 !important;
            background: #f48128;
            padding: 15px 10px;
            margin-bottom: 15px;
        }
    </style> --}}
    @endsection
    {{-- <h6 class="h6 jobAppH6">Job Seekeers</h6> --}}
    <!-- =============================================================================================================================== -->
    <div class="filter-div" style="height: 60px;position: relative;">

        {{-- <button class="blue_btn" data-target="#swiper-filter-modal" data-toggle ="modal" > Filters <i class="fas fa-angle-down rotate-icon"></i></button> --}}
        @include('web.swiper.jobseekers.filter') {{-- web/swiper/jobseekers/filter --}} 
    </div>
        

    <!-- mobile/employer/jobSeekers/filter -->
         @include('mobile.spinner')
    <!-- =============================================================================================================================== -->

    <div class="jobSeekers_list">
        @include('web.swiper.jobseekers.list')  <!--  web/swiper/jobseekers/list -->
    </div> 

@stop




<script type="text/javascript" src="https://maps.google.com/maps/api/js?libraries=places&key={{env('GOOGLE_API')}}"></script>

<link rel="stylesheet"href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>


<style type="text/css">
    @media only screen and (max-width: 768px){
        .sidebaricontoggle{
            top: 3.69rem !important;
        }

      }
</style>
@section('custom_js')

<script type="text/javascript">
$(document).ready(function() {


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
     scrollwheel: false,
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

              if((place) && (place.name) && (place.name != city))
                 address = place.name + ',' + address;

                 // console.log(' reverseGeocode place ', place);
                 // console.log(' reverseGeocode city/state/country = ', city,'/',state,'/',country );

                 updateLocationInputs(place.name,city,state,country);
                 jQuery("#location_search").val(address);
                 placeMarker(place.geometry.location);
                 marker.setPosition(location);
                marker.setVisible(true);
                map.setCenter(location);
                map.setZoom(14);


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
    //  alert("executed");
     if((location.lat() != "") && (location.lng() != "")) {
         jQuery("#location_lat").val(location.lat());
         jQuery("#location_long").val(location.lng());
     }
     drawCircle(location);
     map.setZoom(12);
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
                 var address,place, city, country, state;

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

                     place = results[0]["address_components"][2]["long_name"];
                 // console.log(' reverseGeocode results ', results);
                 // console.log(' reverseGeocode city/state/country = ', city,'/',state,'/',country );
                 if((place) && (place != city)){
                    address = place + ',' + address;
                 }
                //  marker.setPosition(location);
                //  marker.setVisible(true);
                //     map.setCenter(location);
                //     map.setZoom(14);

                 updateLocationInputs(place,city,state,country);
                 jQuery("#location_search").val(address);
                 placeMarker(location);
                //  map.setZoom(10)
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
//====================================================================================================================================//
// Block User Confirmed.
//====================================================================================================================================//
$(document).on('click','.confirm_JobSeekerBlock_ok',function(){
    console.log(' confirm_JobSeekerBlock_ok ');
    var jobseeker_id = $('#jobSeekerBlockId').val();

    $('.confirmJobSeekerBlockModal  .img_chat').html(getLoader('blockJobSeekerLoader'));
    var btn = $(this); //
    btn.prop('disabled',true);

    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.ajax({
        type: 'POST',
        url: base_url+'/ajax/blockJobSeeker/'+jobseeker_id,
        success: function(data){
            btn.prop('disabled',false);
            if( data.status == 1 ){
                $('.confirmJobSeekerBlockModal .img_chat').html(data.message);
                $('.jobSeeker_row.js_'+jobseeker_id).remove();
            }else{
                $('.confirmJobSeekerBlockModal .img_chat').html(data.error);
            }
        }
    });
});

//====================================================================================================================================//
// Top Filter form submit load data throug ajax.
//====================================================================================================================================//
$('#jobSeeker_filter_form').on('submit',function(event){
    console.log(' jobSeeker_filter_form submit ');
    event.preventDefault();
    $('#paginate').val('');
    getData();
});

// function to send ajax call for getting data throug filter/Pagination selection.
var getData = function(){
    var url = '{{route('swiper.jobSeekersFilter')}}';
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    var jqxhr = $.post(url, $('#jobSeeker_filter_form').serialize(), function(data){
        // console.log(' success data  ', data);
        $('.jobSeekers_list').html(data);
    });
}

getData();

// Bottom pagination load data throug ajax.
$(document).on('click','.jobseeker_pagination .page-item .page-link',function(e){
    console.log(' page-link click ', $(this) );
    e.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
    $('#paginate').val(page);
    getData();
});



//====================================================================================================================================//
// Enable/Disabled Filtering by google map location.
//====================================================================================================================================//
$('input[name="filter_location_status"]').change(function() {
    var filterByLocation = $('input[name="filter_location_status"]').is(':checked');
    console.log(' filter_location_status ', filterByLocation);
    (filterByLocation)?(jQuery('.location_search_cont').removeClass('d-none')):(jQuery('.location_search_cont').addClass('d-none'));
});

//====================================================================================================================================//
// Enable/Disabled Filtering by Questions.
//====================================================================================================================================//
$('input[name="filter_industry_status"]').change(function() {
    var filterByIndustry = $('input[name="filter_industry_status"]').is(':checked');
    (filterByIndustry)?(jQuery('.FilterIndustryList').removeClass('d-none')):(jQuery('.FilterIndustryList').addClass('d-none'));
     // $('input, select').styler({ selectSearch: true, });
});

$('input[name="filter_by_questions"]').change(function() {
    var filterByQuestions = $('input[name="filter_by_questions"]').is(':checked');
    console.log(' filter_by_questions ', filterByQuestions);
    (filterByQuestions)?(jQuery('.FilterQuestionBox').removeClass('d-none')):(jQuery('.FilterQuestionBox').addClass('d-none'));
});


$('select[name="swiper_qualification_type"]').change(function() {
    var qualification = $('select[name="swiper_qualification_type"]').val();
    console.log(' filter_by_questions ', qualification);
    (qualification)?(jQuery('.qualification_degree').removeClass('d-none')):(jQuery('.qualification_degree').addClass('d-none'));
});

$(".reset-btn").click(function(){
    $("#jobSeeker_filter_form").trigger("reset");
    $("#filter").html("Filters" +"<i class='fas fa-angle-down rotate-icon'></i>");
    $('.FilterQuestionBox').addClass("d-none");
    $('.FilterLocationBox').addClass("d-none");
    $('.FilterIndustryList').addClass("d-none");
    $('#paginate').val('');
    getDataCustom();
});
//made custom function for global call to refresh the job seekers data on rest
var getDataCustom = function(){
    var url = '{{route('swipeJobSeekersFilter')}}';
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.post(url, $('#jobSeeker_filter_form').serialize(), function(data){
        // console.log(' success data  ', data);
        $('.jobSeekers_list').html(data);
    });
}
});

this.showOverlay = function(){
    if ($('#collapse1').hasClass('show')) {
        $('.overlay').css('display','none');
    }else{
        $('.overlay').css('display','block');
    }
    console.log('herhehrehrhehrher');
}


this.showQualificationSelect2Swiper = function(){
  // console.log('on change qualification');
  var selected = $('.filter_qualification_type option:selected').val();
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

this.locationReload = function(){
    location.reload();
}

</script>
@stop








