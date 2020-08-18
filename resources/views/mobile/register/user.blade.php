@extends('mobile.master')

@section('title', $title)

@section('classes_body', 'register user')

@section('body')


<!-- main -->
<div class="main  ">
<div class="homeBg">

    <div class="shadeBg">
        
    
    <div class="wrapper">
        @include('site.header')
   </div>

    

   <div class="registerForm container h-100">

       <div class="formTitle text-white text-center">Create New Account</div>

       <div class="formBox mb-">
            <form name="frm_date" method="post" action="{{route('register')}}" autocomplete="off" class="text-center">
               
                <!-- First Name -->
                <div class="md-form bgShad">
                    <input type="text" name="firstname" id="field_firstname" class="form-control">
                    <label for="field_firstname">First Name</label>
                    <div id="firstname_error" class="error d-none">&nbsp;</div>
                </div>

                <!-- Last Name -->
                <div class="md-form bgShad">
                    <input type="text" name="surname" id="field_surname" class="form-control">
                    <label for="field_surname">Surname</label>
                    <div id="surname_error" class="error d-none">&nbsp;</div>
                </div>

                <!-- Last Name -->
                <div class="md-form bgShad">
                    {{-- bl_location --}}
                    
                                             
                            
                            <input type="text" class="form-control" name="location_search" id="location_search" placeholder="Type a location">
                           {{--  <div class="input-group-append">
                               <button id="location_search_load" class="btn btn-outline-secondary location_search_btn waves-effect waves-light btn-sm " type="button">Search</button>
                            </div> --}}
                            <label for="location_search">Location</label>
                           
                            <div class="location_latlong d-none w100">
                                <input type="text" class="location_lat w50 fl_left" name="location_lat" id="location_lat" value="" placeholder="Lat" readonly="true" aria-invalid="false">
                                <input type="text" class="location_long w50 fl_left" name="location_long" id="location_long" value="" placeholder="Long" readonly="true" aria-invalid="false">

                                <input type="hidden" name="location_name" id="location_name"  value="">
                                <input type="hidden" name="location_city" id="location_city"  value="">
                                <input type="hidden" name="location_state" id="location_state"  value="">
                                <input type="hidden" name="location_country" id="location_country"  value="">
                            </div>
                         
                    
                    {{-- bl_location --}}
                </div>


                <!-- Email -->
                <div class="md-form bgShad">
                    <input type="email" name="email" id="field_email" class="form-control">
                    <label for="field_email">E-mail</label>
                    <div id="email_error" class="error d-none">&nbsp;</div>
                </div>

                <!-- Mobile -->
                <div class="md-form bgShad">
                    <input type="text" name="phone" id="field_phone" class="form-control">
                    <label for="field_phone">Mobile Number</label>
                    <div id="phone_error" class="error d-none">&nbsp;</div>
                </div>

                <!-- Mobile -->
                <div class="md-form bgShad">
                    <input type="text" name="username" id="field_username" class="form-control">
                    <label for="field_username">Username</label>
                    <div id="username_error" class="error d-none">&nbsp;</div>
                </div>

                <!-- Password -->
                <div class="md-form bgShad">
                    <input type="text" name="password" id="field_password" class="form-control">
                    <label for="field_password">Password</label>
                    <div id="password_error" class="error d-none">&nbsp;</div>
                </div>

                <!-- Password_confirmation -->
                <div class="md-form bgShad">
                    <input type="text" name="password_confirmation" id="field_password_confirmation" class="form-control">
                    <label for="field_password_confirmation">Confirm password</label>
                    <div id="password_confirmation_error" class="error d-none">&nbsp;</div>
                </div>

                <!-- Terms and Privacy -->
                <div class="md-form">
                    <div class="form-check">
                        <input type="checkbox" name="privacy_policy" class="form-check-input" id="field_privacy_policy">
                        <label class="form-check-label" for="field_privacy_policy">I agree to the Terms and Privacy Policy</label>
                    </div>
                </div>

                <!-- Submit button -->
                <div class="md-form">
                    <div class="clearfix"></div>
                    <button id="frm_register_submit" type="button" class="btn btn-primary btn-primary2 w-50">Next</button>
                </div>

 

           </form>
       </div>

   </div>

</div>
</div>
</div>
<!-- /main -->


@stop


@section('custom_js')

<script type="text/javascript" src="https://maps.google.com/maps/api/js?libraries=places&key={{env('GOOGLE_API')}}"></script>
<script type="text/javascript">
//====================================================================================================================================//
// Google map location script 
//====================================================================================================================================//
// var map;
jQuery(document).ready(function() {

    var input = document.getElementById('location_search');
    var autocomplete = new google.maps.places.Autocomplete(input);

    // var service = new google.maps.places.AutocompleteService();
    var geocoder = new google.maps.Geocoder();
    // var hasLocation = false;
    var latlng = new google.maps.LatLng(-31.2532183, 146.921099);
    // var marker = "";
   
    // var options = {
    //     zoom: 14,
    //     center: latlng,
    //     mapTypeId: google.maps.MapTypeId.ROADMAP
    // };
    if(jQuery("#location_search").length > 0) {
        // map = new google.maps.Map(document.getElementById("location_map"), options);
        // autocomplete.bindTo('bounds', map);
        // autocomplete.setFields(['address_components', 'geometry', 'icon', 'name']);
        // if(!hasLocation) { map.setZoom(14); }

        // add listner on map, when click on map change the latlong and put a marker over there. 
        // google.maps.event.addListener(map, "click", function(event) { 
        //     console.log(' addListener click  '); 
        //     reverseGeocode(event.latLng); 
        // })

        // get the location (city,state,country) on base of text enter in search. 
        jQuery("#location_search_load").click(function() {
            if(jQuery("#location_search").val() != "") {
                geocode(jQuery("#location_search").val());
                return false;
            } else {
                // marker.setMap(null);
                return false;
            }
            return false;
        })
        jQuery("#location_search").keyup(function(e) {
            if(e.keyCode == 13)
                jQuery("#location_search_load").click();
        })

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
              // if (place.geometry.viewport) {
              //   map.fitBounds(place.geometry.viewport);
              // } else {
              //   map.setCenter(place.geometry.location);
              //   map.setZoom(14);  // Why 14? Because it looks good.
              // }

              
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
                    jQuery("#location_search").val(address);
                    // placeMarker(place.geometry.location);
            });

        }
        // location_map length. 

    // function placeMarker(location) {
    //     console.log(' placeMarker location ',location); 

    //     if (marker == "") {
    //         marker = new google.maps.Marker({
    //             position: latlng,
    //             map: map,
    //             draggable:true,
    //             title: "Drag me"
    //         })
    //         google.maps.event.addListener(marker, "dragend", function() {
    //         var point = marker.getPosition();
    //         map.panTo(point);
    //             jQuery("#location_lat").val(point.lat());
    //             jQuery("#location_long").val(point.lng());
    //         });
    //     }
    //     marker.setPosition(location);
    //     marker.setVisible(true);
    //     map.setCenter(location);
    //     map.setZoom(14);
    //     if((location.lat() != "") && (location.lng() != "")) {
    //         jQuery("#location_lat").val(location.lat());
    //         jQuery("#location_long").val(location.lng());
    //     }
    // }

    function geocode(address) {
        // console.log('---2-- geocode ', address);
        if (geocoder) {
            geocoder.geocode({"address": address}, function(results, status) {
                if (status != google.maps.GeocoderStatus.OK) {
                    alert("Cannot find address");
                    return;
                }
                // placeMarker(results[0].geometry.location);
                reverseGeocode(results[0].geometry.location);
                // if(!hasLocation) {
                //     // map.setZoom(14);
                //     hasLocation = true;
                // }
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
                    // placeMarker(location);
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



});
         
        
    

</script>

@stop

@section('custom_footer_css')
<link rel="stylesheet" href="{{ asset('css/mobile/homepage.css') }}">

@stop