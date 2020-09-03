

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
                 console.log('resp ', resp);

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
	//  Google map integration 
	//====================================================================================================================================//
  var input = document.getElementById('location_search');
  var autocomplete = new google.maps.places.Autocomplete(input);
  var geocoder = new google.maps.Geocoder();
  var latlng = new google.maps.LatLng(-31.2532183, 146.921099);
  if(jQuery("#location_search").length > 0) {
        // get the location (city,state,country) on base of text enter in search. 
        jQuery("#location_search_load").click(function() {
            if(jQuery("#location_search").val() != "") {
                geocode(jQuery("#location_search").val());
                return false;
            }  
            return false;
        })
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
                console.log("No details available for input: '" + place.name + "'");
                return;
              }

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

                  updateLocationInputs(place.name,city,state,country);
                  jQuery("#location_search").val(address);
            });

        }
        // location_map length. 


    function geocode(address) {
        if (geocoder) {
            geocoder.geocode({"address": address}, function(results, status) {
                if (status != google.maps.GeocoderStatus.OK) {
                    console.log("Cannot find address");
                    return;
                }
                reverseGeocode(results[0].geometry.location);
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
    // // by default show this location; 
    // geocode('Sydney New South Wales, Australia');





  
        
});