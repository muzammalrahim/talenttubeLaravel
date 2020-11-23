

$(document).ready(function() {

  // SideNav Initialization
  $('.mdb-select').materialSelect();
  // Filter JobSeekers
  $(document).on('change','select.filter_qualification_type', function() {
    var degreeType =  $(this).val();
     if (degreeType != ''){ degreeType = (degreeType == 'trade')?'trade':'degree';}
					$(this).closest('.FilterBox').attr('class','FilterBox '+degreeType);

	});

// 	$('#tradeSelect').on('change', function() {
// 		var values = $(this).val();
// 		alert(values);
// });

$('#degreeSelect').on('change', function() {
	var values = $(this).val();
	// alert(values.length);
	if(values.length==0){
		$("#filter").html("Filters" +"<i class='fas fa-angle-down rotate-icon'></i>");
	}
	else
	$("#filter").html("Filters ("+values.length+")" +"<i class='fas fa-angle-down rotate-icon'></i>" );
});





    // Mobile login.
    $('.mSignInBtn').on('click',function() {
        console.log(' mSignInBtn click ');
        $('.loginStatus').html('');
        $('.mProcessing').removeClass('d-none');
        $('#m_form_login').addClass('d-none');
        var formData = $('#m_form_login').serialize();
        console.log(' formData ', formData);
        // var formData = {
        //     email:  $.trim($('#loginFormEmail').val()),
        //     password:  $.trim($('#loginFormPassword').val()),
        //     login_type: 'site_ajax',
        //   };


        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
         $.ajax({
             url: base_url+'/login',
             type : 'POST',
             data : formData,
             success : function(resp) {
                 // console.log('resp ', resp.message);

                 var signinError = resp.message;
                 // console.log(signinError);

                 $('.loginStatus').text(signinError);
                 
                 if(resp.status){
                     setTimeout(() => {
                         location.href = resp.redirect;
                     }, 1000);
                 }else{

                    $('.mProcessing').addClass('d-none');
                    $('#m_form_login').removeClass('d-none');

                    if(resp.message && resp.message.email){
                        $('.loginStatus').html('<p>'+resp.message.email+'</p>');
                    }
                    if(resp.message && resp.message.password){
                        $('.loginStatus').html('<p>'+resp.message.password+'</p>');
                    }

                 }
             }
         });

    });



	//====================================================================================================================================//
	// Function to display Industry experience list.
	//====================================================================================================================================//
	// $('input[name="filter_industry_status"]').change(function() {
 //    (this.checked)?(jQuery('.FilterIndustryList').removeClass('d-none')):(jQuery('.FilterIndustryList').addClass('d-none'));
	// });


	//====================================================================================================================================//
	// Function to show hide filter.
	//====================================================================================================================================//
	$('.filter_showDetail').change(function() {
		var detail_cont = $(this).attr('data-dc');
    (this.checked)?(jQuery('.'+detail_cont).removeClass('d-none')):(jQuery('.'+detail_cont).addClass('d-none'));
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
                    jQuery("#location_search").val(address);
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


$( document ).ajaxStart(function() {
	$( ".spin" ).show();
});

$( document ).ajaxComplete(function() {
	$( ".spin" ).hide();
});


// ================================= interview Log in =================================

$('#MintConform_login').click(function ($event) {
    $event.preventDefault();
        event.preventDefault();
        var formData = $('.MintCon_login').serializeArray();
        console.log(' formData ', formData);
        $.ajax({
            type: 'POST',
            url:  base_url + '/m/MinterviewConLogin',
            data: formData,
            success: function(response){

            if (response == "") {
                $('.errorInBooking').text('This "Email" and "Mobile" is not registered with any booking.');
            }else{
                console.log(' data >>>> ', response);
                    
                if( response.status) {
                    location.href = response.redirect;
                }else{                    
                    // that.hideMainEditor();
                   var errorIntCon = response['message'];
                   // console.log(errorIntCon);
                   // var nameError = errorIntCon['name'];
                   var mobileError = errorIntCon['mobile'];
                   // console.log(mobileError);
                   var emailError = errorIntCon['email'];
                   console.log(emailError);

                   // ==================== mobile validation ====================
                   if (mobileError){
                        var mobileError2 = mobileError.toString();
                        $('.errorInMobile').text(mobileError2);
                        $('.errorInMobile').show();
                        // console.log(nameError);

                    } else {
                        $('.errorInMobile').hide();
                    }
                    // ==================== mobile validation end here ====================
                    // ==================== email validation ====================
                   if (emailError){
                        var emailError2 = emailError.toString();
                        $('.errorInEmail').text(emailError2);
                        $('.errorInemail').show();
                        // console.log(nameError);

                    } else {
                        $('.errorInemail').hide();
                    }
                    // ==================== email validation end here ====================

                            
                }
            }


                

            }

        });
}); 

// ================================= interview Log in end here =================================