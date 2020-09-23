
@extends('mobile.user.usermaster')
@section('content')


{{-- <h6 class="h6 jobAppH6">Add New Job</h6> --}}




    {{-- @dump($job) --}}

    <div class="card border-info mb-3 shadow mb-3 bg-white rounded job_row jobApp_{{-- {{$application->id}} --}}">


        {{-- <a href="" class="btn btn-primary d-none"> see job detail</a> --}}

        <div class="card add_new_job">

            <div class="card-header jobAppHeader p-2 jobInfoFont text-center">
               <h5 class="font-weight-bold">Add New Job</h5>
            <div>
             {{--        <div class="row p-0 m-0">
                        <span class="jobInfoFont">Location : </span>
                            <div class="jobDetail font-weight-normal"  style="margin: 0.2rem 0 0 0.2rem;">
                             {{($job->GeoCity)?($job->GeoCity->city_title):''}},  {{($job->GeoState)?($job->GeoState->state_title):''}}, {{($job->GeoCountry)?($job->GeoCountry->country_title):''}}</div>
                    </div> --}}
                </div>
            </div>


{{-- ============================================ Card Body ============================================ --}}

        <div class="card-body jobAppBody pt-2">

                 <form method="POST" name="new_job_form" class="new_job_form newJob job_validation">

                    @csrf

                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label font-weight-bold">Title</label>
                    <div class="col-sm-10">
                      <input type="text" name="title" class="form-control" id="title">
                      <div id="title_error" class="error field_error to_hide">&nbsp;</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label font-weight-bold">Description</label>
                    <div class="col-sm-10">
                  <textarea class="form-control z-depth-1" name="description" id="description" rows="3" placeholder="Write something here..."></textarea>
                    <div id="description_error" class="error field_error to_hide">&nbsp;</div>
                    </div>
                </div>


                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label font-weight-bold">Experience</label>
                    <div class="col-sm-10">
                      <input type="text" name="experience" class="form-control" id="experience">
                      <div id="experience_error" class="error field_error to_hide">&nbsp;</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label font-weight-bold">Type</label>
                    <div class="col-sm-10">
                    <select name="type" class="browser-default custom-select" >
                        <option value="contract">Contract</option>
                        <option value="temporary">Temporary</option>
                        <option value="casual">Casual</option>
                        <option value="part_time">Part Time</option>
                        <option value="full_time">Full Time</option>
                    </select>
                    <div id="type_error" class="error field_error to_hide">&nbsp;</div>
                    </div>
                </div>

            {{-- <div class="form-group">

                        <div class="row">
                            <div class="col-sm-2">
                                <label for="staticEmail" class="col-form-label font-weight-bold">Location</label>
                            </div>
                            <div class="col-sm-7">
                            <input type="text" name="location_search" id="location_search" placeholder="Type a location" class="form-control">
                            </div>
                            <div class="col-sm-2 ml-2">
                                            <button type="button" id="location_search_load" class="btn btn-success btn-xs ">Search</button>
                            </div>
                            </div>
                            <div class="location_latlong dtable w100 hide_it">
                                <input type="hidden" class="location_lat w50 fl_left" name="location_lat" id="location_lat" value="" placeholder="Lat" readonly="true" aria-invalid="false">
                                <input type="hidden" class="location_long w50 fl_left" name="location_long" id="location_long" value="" placeholder="Long" readonly="true" aria-invalid="false">

                                <input type="hidden" name="location_name" id="location_name"  value="">
                                <input type="hidden" name="location_city" id="location_city"  value="">
                                <input type="hidden" name="location_state" id="location_state"  value="">
                                <input type="hidden" name="location_country" id="location_country"  value="">
                                </div>
                                <div class="location_map_box dtable w100 hide_it">
                                                <div class="location_map" id="location_map"></div>
                                </div>
            </div> --}}
            <div class="form-group">

                <div class="row">
                    <div class="col-sm-2">
                        <label for="staticEmail" class="col-form-label font-weight-bold">Location</label>
                    </div>
                    <div class="col-sm-7">
                    <input type="text" name="location_search" id="location_search" placeholder="Type a location" class="form-control">
                    </div>
                    <div class="col-sm-2 ml-2">
                                    <button type="button" id="location_search_load" class="btn btn-success btn-xs ">Search</button>
                    </div>
                    </div>
                    <div class="location_latlong dtable w100 hide_it">
                        <input type="hidden" class="location_lat w50 fl_left" name="location_lat" id="location_lat" value="" placeholder="Lat" readonly="true" aria-invalid="false">
                        <input type="hidden" class="location_long w50 fl_left" name="location_long" id="location_long" value="" placeholder="Long" readonly="true" aria-invalid="false">

                        <input type="hidden" name="location_name" id="location_name"  value="">
                        <input type="hidden" name="location_city" id="location_city"  value="">
                        <input type="hidden" name="location_state" id="location_state"  value="">
                        <input type="hidden" name="location_country" id="location_country"  value="">
                        </div>
                        <div class="location_map_box dtable w100 hide_it">
                                        <div class="location_map" id="location_map"></div>
                        </div>
            </div>

                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label font-weight-bold">Vacancies </label>
                    <div class="col-sm-10">
                      <input type="number" name="vacancies" class="form-control" id="Vacancies ">
                      <div id="vacancies_error" class="error field_error to_hide">&nbsp;</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label font-weight-bold">Salary  </label>
                    <div class="col-sm-10">
                      <input type="text" name="salary" class="form-control" id="Salary">
                      <div id="salary_error" class="error field_error to_hide">&nbsp;</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label font-weight-bold">Expiration Date</label>
                    <div class="col-sm-10">
                                <input placeholder="Selected date" name="expirationtype=" text" id="datepicker" class="form-control datepicker">
                                <div id="expiration_error" class="error field_error to_hide ">&nbsp;</div>
                    </div>
                </div>

                <div class="questionstCard">

                <div class="form-group text-center font-weight-bold">
                    Job Questions
                </div>



        <div class="jobQuestions">
            <div class="jobQuestion q1">

                <div class="form-group row">

                    <label for="staticEmail" class="col-sm-2 col-form-label font-weight-bold">Title</label>

                    <div class="col-sm-10">

                            <input type="text" class="form-control" id="question-id" name="jq[0][title]">

                    </div>
                </div>

                <div class="form-group row option">
                                    <label for="staticEmail" class="col-sm-2 col-form-label font-weight-bold">Options</label>
                                    <div class="col-sm-10 jq_field_questions">
                                            <div class="option form-group">
                                                        <input type="text" class="col-sm-3 form-control float-left mr-5" name="jq[0][option][0][text]" id="question-id">
                                                        <div class="col-sm-3 custom-control custom-checkbox custom-control-inline mt-2">
                                                                <input type="checkbox" class="custom-control-input" id="jq_0_option_0_goldstar" name="jq[0][option][0][goldstar]" value="goldstar" >
                                                                <label class="custom-control-label font-weight-bold" for="jq_0_option_0_goldstar">Gold Star</label>
                                                        </div>
                                                        <div class="col-sm-3 custom-control custom-checkbox custom-control-inline mt-2">
                                                                <input type="checkbox" class="custom-control-input" id="jq_0_option_0_preffer" name="jq[0][option][0][preffer]" value="preffer">
                                                                <label class="custom-control-label font-weight-bold" for="jq_0_option_0_preffer">Prefer</label>
                                                        </div>
                                            </div>

                                    </div>
                                    <div class="form-group">
                                            <label class="col-sm-2 col-form-label"></label>
                                            <div class="col-sm-12">
                                                <div class="j_button dinline_block addOptionsBtn"><a class="addQuestionOption graybtn jbtn btn btn-sm btn-primary ml-2 btn-xs" data-qc="0">Add option</a></div>
                                            </div>
                                    </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                                        <div class="jobApplyBtn graybtn jbtn btn btn-sm btn-secondary mr-0 btn-xs removeJobQuestion"><i class="fas fa-backspace close_icon "></i></div>
                        </div>
            </div>
                </div>
        </div>

                        <input type="hidden" name="questionCounter" id="questionCounter" value="0">

                        <div class="form-group row float-right">
                                    <label class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                                    <a class="jobApplyBtn graybtn jbtn btn btn-sm btn-secondary mr-0 btn-xs addQuestion">Add+</a>
                                    </div>
                        </div>


</div>

</div>

</form>

{{-- ============================================ Card Body end ============================================ --}}
<div class="form_field">
    <span class="form_label"></span>
    <div class="form_input">
        <div class="general_error error to_hide"></div>
    </div>
</div>

{{-- ============================================ Card Footer ============================================ --}}

            <div class="card-footer text-muted jobAppFooter p-1">

                    <div class="text-center">

                        <a class="jobApplyBtn graybtn jbtn btn btn-sm btn-success mr-0 saveNewJob">Save</a>

                    </div>

            </div>

{{-- ============================================ Card Footer end ============================================ --}}


        </div>

    </div>

<a href="{{route('MemployerJobs')}}" class="btn btn-primary d-none seeJobDetail"> See Your Jobs</a>


@stop



@section('custom_js')
<script>

	$(document).ready(function() {


		$('.datepicker').pickadate();

		$('.jobQuestions').on('click','.addQuestionOption', function(){
        var oC = $(this).closest('.jobQuestion').find('.jq_field_questions .option').length;
        // var qC = $(this).attr('data-qc');
								var qC = parseInt($('#questionCounter').val());
        var option_html = '';
            option_html += '<div class="option form-group">';
            option_html += '<input type="text" class="col-sm-3 form-control float-left mr-5" name="jq['+qC+'][option]['+oC+'][text]">';
            option_html +=	'<div class="col-sm-3 custom-control custom-checkbox custom-control-inline mt-2">';
            option_html +=	'<input type="checkbox" class="custom-control-input" id="jq_'+qC+'_option_'+oC+'_goldstar" name="jq['+qC+'][option]['+oC+'][goldstar]">';
            option_html +=	'<label class="custom-control-label font-weight-bold" for="jq_'+qC+'_option_'+oC+'_goldstar">Gold Star</label>';
            option_html += '</div>';
            option_html +=	'<div class="col-sm-3 custom-control custom-checkbox custom-control-inline mt-2">';
            option_html +=	'<input type="checkbox" class="custom-control-input" id="jq_'+qC+'_option_'+oC+'_preffer" name="jq['+qC+'][option]['+oC+'][preffer]">';
            option_html +=	'<label class="custom-control-label font-weight-bold" for="jq_'+qC+'_option_'+oC+'_preffer">Prefer</label>';
            option_html += '</div>';
            option_html += '</div>';

        			$(this).closest('.jobQuestion').find('.jq_field_questions').append(option_html);

				});
				  // add new question html to dom.
						$('.addQuestion').on('click',function(){
        console.log(' addQuestion clck  ');
        // var question = '<div class="question mb10 relative"><input type="text" name="questions[]" class="w100" /><span class="close_icon jobQuestion"></span></div>';
        // $('.jobQuestions').append(question);
        //  $('#addNewQuestionModel').modal({
        //     fadeDuration: 200,
        //     fadeDelay: 2.5,
        //     escapeClose: false,
        //     clickClose: false,
        // });

        var qC = parseInt($('#questionCounter').val())+1;



											var	jobQuestion  = 	'<div class="jobQuestion q'+qC+'">';
												jobQuestion +=	'<div class="form-group row">';

											jobQuestion +=		'<label for="staticEmail" class="col-sm-2 col-form-label font-weight-bold">Title</label>';

											jobQuestion +=		'<div class="col-sm-10">';

												jobQuestion += '<input type="text" class="form-control" id="question-id" name="jq['+qC+'][title]">';

												jobQuestion +=		'</div>';
												jobQuestion +=		'</div>';
													jobQuestion +=		'<div class="form-group row option">';
														jobQuestion +=									'<label for="staticEmail" class="col-sm-2 col-form-label font-weight-bold">Options</label>';
														jobQuestion +=									'<div class="col-sm-10 jq_field_questions">';
															jobQuestion +=											'<div class="option form-group">';
																jobQuestion +=													'<input type="text" class="col-sm-3 form-control float-left mr-5" name="jq['+qC+'][option][0][text]" id="question-id">';
																jobQuestion +=												'<div class="col-sm-3 custom-control custom-checkbox custom-control-inline mt-2">';
																	jobQuestion +=													'	<input type="checkbox" class="custom-control-input" id="jq_'+qC+'_option_0_goldstar" name="jq['+qC+'][option][0][goldstar]" value="goldstar" >';
																	jobQuestion +=												'<label class="custom-control-label font-weight-bold" for="jq_'+qC+'_option_0_goldstar">Gold Star</label>';
																	jobQuestion +=										'</div>';
																	jobQuestion +=										'<div class="col-sm-3 custom-control custom-checkbox custom-control-inline mt-2">';
																		jobQuestion +=											'<input type="checkbox" class="custom-control-input" id="jq_'+qC+'_option_0_preffer" name="jq['+qC+'][option][0][preffer]" value="preffer">';
																		jobQuestion +=											'<label class="custom-control-label font-weight-bold" for="jq_'+qC+'_option_0_preffer">Prefer</label>';
																		jobQuestion +=								'</div>';
																		jobQuestion +=				'</div>';
																		jobQuestion +=			'</div>';
																		jobQuestion +=			'<div class="form-group">';
																			jobQuestion +=				'<label class="col-sm-2 col-form-label"></label>';
																			jobQuestion +=					'<div class="col-sm-12">';
																				jobQuestion +=				'<div class="j_button dinline_block addOptionsBtn"><a class="addQuestionOption graybtn jbtn btn btn-sm btn-primary ml-2 btn-xs" data-qc="'+qC+'">Add option</a></div>';
																				jobQuestion +=				'</div>';
																				jobQuestion +=				'</div>';
																				jobQuestion +=	'</div>';
																				jobQuestion +=	'<div class="form-group row">';
																					jobQuestion +=		'<div class="col-sm-12">';
																						jobQuestion +=				'<div class="jobApplyBtn graybtn jbtn btn btn-sm btn-secondary mr-0 btn-xs"><i class="fas fa-backspace close_icon removeJobQuestion"></i></div>';
																						jobQuestion +=	'</div>';
																						jobQuestion +='</div>';
																						jobQuestion += '</div>';

         $('.jobQuestions').append(jobQuestion);
         $('#questionCounter').val(qC);


    });

				$(document).on('click','.removeJobQuestion',function(){
        $(this).closest('.jobQuestion').remove();
				});



    });


    $('.saveNewJob').on('click',function() {
        event.preventDefault();
        var formData = $('.new_job_form').serializeArray();

        console.log(' formData ', formData);
        $('.general_error').html('');
        $.ajax({
            type: 'POST',
            url:  "{{ url('m/ajax/job/mnew') }}",
            data: formData,
            success: function(data){
                console.log(' data ', data);

                if( data.status == 1 ){
                    // that.hideMainEditor();
                    $('.add_new_job').html(data.message);

                    $('.seeJobDetail').removeClass('d-none');
                    $('.rounded').removeClass('border-info');
                    $('.rounded').removeClass('card');
                    $('.add_new_job').removeClass('card');
                    $('.rounded').addClass('p-3');
                    $('.seeJobDetail').removeClass('jobApp_');

                }else{
                    $('.general_error').html('<p>Error Creating new job</p>').removeClass('to_hide').addClass('to_show');
                    if(data.validator != undefined){
                        const keys = Object.keys(data.validator);
                        for (const key of keys) {
                            if($('#'+key+'_error').length > 0){
                                $('#'+key+'_error').removeClass('to_hide').addClass('to_show').text(data.validator[key][0]);
                            }
                        }
                    }
                   if(data.error != undefined){
                     $('.general_error').append(data.error);
                   }
                   setTimeout(() => { $('.general_error').removeClass('to_show').addClass('to_hide').text(''); },3000);
                }

            }
        });
    })

</script>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?libraries=places&key={{env('GOOGLE_API')}}"></script>
<script type="text/javascript">



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



</script>

@stop

<style type="text/css">

form.new_job_form.newJob.job_validation {
    margin-right: 7%;
}

</style>
