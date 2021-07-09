

<div class="aboutMeSection"><b>Location: </b>
     {{-- <div class="spinner-border spinner-border-sm text-primary IntsdInLoader ml-2" role="status" style="display:none;"></div> --}}

     {{-- <i class="fas fa-edit float-right intInSecButton"></i> <p class="interestedInSec">{{$user->interested_in}}</p> --}}


      <i class="fas fa-edit float-right" onclick="showMap()"></i> <p id="list_info_location">{{userLocation($user)}}</p>

</div>



<div class="bl_list_info">
    {{-- <ul class="list_info userProfileLocation"><br> --}}
    {{-- </ul> --}}
</div>

<div class="location_search_cont d-none">
    <div class="location_input dtable w100">
        <input type="text" name="location_search" class="inp form-control fl_left" id="location_search" value="{{userLocation($user)}}" placeholder="Type a location" aria-invalid="false">
        {{-- <select class="dinline_block filter_location_radius select_aw d-none" name="filter_location_radius" data-placeholder="Select Location Radius">
             <option value="5">5km</option>
             <option value="10">10km</option>
             <option value="25">25km</option>
             <option value="50">50km</option>
             <option value="51">50km +</option>
        </select> --}}
    </div>
    <div class="location_latlong dtable w100">
        <input type="hidden" class="location_lat w50 fl_left" name="location_lat" id="location_lat" value="" placeholder="Lat" readonly="true" aria-invalid="false">
        <input type="hidden" class="location_long w50 fl_left" name="location_long" id="location_long" value="" placeholder="Long" readonly="true" aria-invalid="false">
        <input type="hidden" name="location_name" id="location_name"  value="">
        <input type="hidden" name="location_city" id="location_city"  value="">
        <input type="hidden" name="location_state" id="location_state"  value="">
        <input type="hidden" name="location_country" id="location_country"  value="">
    </div>

    <div class="location_map_box dtable w100"><div class="location_map" id="location_map"></div></div>
    <div class="searchField_action">
        <div class="searchFieldLabel dinline_block"></div>
        <button class="btn btn-sm btn-primary saveNewLocation">Save</button>
    </div>
</div>




<div class="col-md-12 text-center my-2">
      <a class="btn btn-sm btn-success location_save_button d-none">Save</a>
</div>

<div class="alert alert-success interestedInAlert" role="alert" style="display:none;">
      <strong>Success!</strong> Location updated successfully!
</div>


{{-- <div class="personalInfo"> <b>Location: </b> <span class="m-0 mb-1">{{userLocation($user)}}</span></div> --}}


<script type="text/javascript">

this.edit_location = function(){

      console.log(' Hi this is location edit on mobile ');
}


var toggle = true;
$('input[name="filter_location_status"]').change(function() {
    console.log(' filter_location_status ');
    (this.checked)?(jQuery('.location_search_cont').removeClass('d-none')):(jQuery('.location_search_cont').addClass('d-none'));
});

function showMap(){
    if(toggle){
        jQuery('.location_search_cont').removeClass('d-none');
        toggle = false;
    }
    else{
        jQuery('.location_search_cont').addClass('d-none');
        toggle = true;
    }
}

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

 // by default show this location;
// geocode('Sydney New South Wales, Australia');
data = {!! str_replace("'", "\'", json_encode(userLocation($user))) !!};
geocode(data);

 jQuery('.filter_location_radius').on('change', function(){
     console.log(' filter_location_radius changed.  ');
     drawCircle(new google.maps.LatLng(jQuery("#location_lat").val(), jQuery("#location_long").val()));
 });


 var base_url = {!! json_encode(url('/')) !!};

 $('.saveNewLocation').on('click',function() {
        showMap();
        event.preventDefault();
        var formData = $('.location_latlong :input').serializeArray();
        console.log(' formData ', formData);
        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
        $.ajax({
            type: 'POST',
            url: base_url+'/m/ajax/addNewLocation',
            data: formData,
            success: function(data){
                console.log(' data ', data);
                $('.saveNewJob').html('Save').prop('disabled',false);
                if( data.status == 1 ){
                    // that.hideMainEditor();
                    $("#list_info_location").html(data.data);
                }else{


                }

            }
        });
    })

</script>