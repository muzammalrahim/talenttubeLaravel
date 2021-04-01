{{-- @extends('site.user.usertemplate') --}}

{{-- 
@if ($controlsession->count() > 0)
<div class="adminControl">
        <p>You are in control of <span class="bold">{{$user->name}} </span>, click <a href="{{ route('logoutRouteForAdmin') }}" class="adminLogin" > HERE </a> to end control</p>
</div>
@endif
 --}}
@extends('site.user.usermaster')

@section('content')
<div class="cont bl_profile">
    <div class="bl_pic_info my_profile">

        {{-- @dump($profileImage) --}}
        {{-- @dump($profileImage['imagepath']) --}}
        {{-- @dump( $user_profile->image ) --}}
        {{-- @dump($profile_image) --}}

        {{-- @dump($controlsession) --}}

        <div class="bl_pic">
            <div class="pic">
                <div class="profile_pic_one to_show">
                    <a class="show_photo_gallery" href="{{$profile_image}}" data-lcl-thumb="{{$profile_image}}" >

                        <img  class="photo" id="pic_main_img" src="{{$profile_image}}" title="">
                    </a>
                    {{-- <div id="add_photo_main_profile" class="add_photo">
                        <div class="file" id="add_photo_profile">
                            <form>
                                <button class="btn small violet"><img width="16" height="16" alt="" src="">Add a photo</button>
                                <input title="" id="some_add_photo_main_public" type="file" multiple="" name="file_public[]">
                                <input id="some_add_photo_main_public_reset" type="reset" value="">
                            </form>
                        </div>
                    </div> --}}
                </div>
                   {{-- <div id="profile_status_online" title="On the site now!" class="status_online to_show"></div> --}}
            </div>
        </div>

        {{-- @dump($user) --}}
        {{-- @dump($user->GeoCountry)
        @dump($user->GeoState)
        @dump($user->GeoCity) --}}

        <div class="info">
            <div class="name"><a id="profile_name" style="cursor:default;" class="edit_main_title"  onclick="return false;">{{$user->name}} {{$user->surname}}</a></div>
            <div class="bl_list_info">
                <ul class="list_info userProfileLocation"><br>
                    {{-- <li><span id="list_info_age">{{$user->age}}</span><span class="basic_info">•</span></li> --}}
                    <li id="list_info_location">{{userLocation($user)}}<i class="fas fa-edit salaryRangeEdit" onclick="showMap()"></i></li>
                    <li><span id="list_info_gender">Job Seeker</span></li>
                </ul>
                {{-- <div class="icon_edit"><span onclick="UProfile.showMainEditor();"></span></div> --}}
            </div>
            <div class="location_search_cont hide_it">
                <div class="location_input dtable w100">
                    <input type="text" name="location_search" class="inp w80 fl_left" id="location_search" value="{{userLocation($user)}}" placeholder="Type a location" aria-invalid="false">
                    <select class="dinline_block filter_location_radius select_aw hide_it" name="filter_location_radius" data-placeholder="Select Location Radius">
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

                <div class="location_map_box dtable w100"><div class="location_map" id="location_map"></div></div>
                <div class="searchField_action">
                    <div class="searchFieldLabel dinline_block"></div>
                    <button class="btn small OrangeBtn saveNewLocation">Save</button>
                </div>
            </div>
            <div class="job">
                <span style="margin-right: 34px;">Recent Job:</span>
                <input type="text" class="hide_it recentJobField" name="recentJobField" value="{{$user->recentJob}}"  onchange="UProfile.updateRecentJob()"/>
                <span  class="recentJobValue">{{$user->recentJob}}</span>
                <i class="fas fa-edit recentJobEdit" style="cursor: pointer;" onclick="UProfile.enableRecentJobEdit()"></i>
            </div>

            {{-- ========================================= Salary Range ========================================= --}}

            <div class="job">
                <span>Expecting Salary:</span>
                {{ Form::select('salaryRange', $salaryRange, $user->salaryRange, ['placeholder' => 'Select Salary Range', 'onchange' => 'UProfile.updateSalaryRange()', 'id' => 'salaryRangeFieldnew', 'class' => 'hide_it salaryRangeField']) }}
                <b> {{'AUD: '}}<span  class="salaryRangeValue">{{number_format($user->salaryRange),3}}</span>  </b>
                <i class="fas fa-edit salaryRangeEdit" onclick="UProfile.enableSalaryRangeEdit()"></i>
            </div>

            {{-- ========================================= Salary Range End Here ========================================= --}}

        </div>
        <div class="cl"></div>
    </div>

    @include('site.user.profile.tabs')
    <div class="cl"></div>


    

</div>



@include('site.user.profile.profileEditPopup')
@include('site.user.profile.profilePersonalInfo')


@stop


@section('custom_footer_css')
<link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}">
{{-- <link rel="stylesheet" href="{{ asset('css/site/gallery_popup/magnific-popup.css') }}"> --}}
<link rel="stylesheet" href="{{ asset('css/site/gallery_popup/lc_lightbox.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/profile.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/tagSystem.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jsprofile.css') }}">



<style>

</style>
@stop

@section('custom_js')
<script src="{{ asset('js/site/jquery.modal.min.js') }}"></script>
{{-- <script src="{{ asset('js/site/profile_photo.js') }}"></script>  --}}
{{-- <script src="{{ asset('js/site/gallery_popup/jquery.magnific-popup.js') }}"></script>  --}}
<script src="{{ asset('js/site/gallery_popup/lc_lightbox.lite.js') }}"></script>
<script src="{{ asset('js/site/tagSystem.js') }}"></script>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?libraries=places&key={{env('GOOGLE_API')}}"></script>

<script>
var toggle = true;
$('input[name="filter_location_status"]').change(function() {
    console.log(' filter_location_status ');
    (this.checked)?(jQuery('.location_search_cont').removeClass('hide_it')):(jQuery('.location_search_cont').addClass('hide_it'));
});

function showMap(){
    if(toggle){
        jQuery('.location_search_cont').removeClass('hide_it');
        toggle = false;
    }
    else{
        jQuery('.location_search_cont').addClass('hide_it');
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
            url: base_url+'/ajax/addNewLocation',
            data: formData,
            success: function(data){
                console.log(' data ', data);
                $('.saveNewJob').html('Save').prop('disabled',false);
                if( data.status == 1 ){
                    // that.hideMainEditor();
                    $("#list_info_location").html(data.data+'<i class="fas fa-edit salaryRangeEdit" onclick="showMap()"></i>');
                }else{


                }

            }
        });
    })

</script>

<script type="text/javascript">


// {{-- ==================================================== Edit Qualification ==================================================== --}}


  $(document).ready(function(){

  $(".editQualification").click(function(){
        $(this).closest('.qualificationBox').addClass('editQualif');
        $('.removeQualification').removeClass('hide_it2');
        $('.addQualification').removeClass('hide_it2');
        $('.qualificationSaveButton').removeClass('hide_it2');
        console.log('Testing Qualification');

  });

   $('.qualificationBox').on('click','.removeQualification', function(){
      console.log('removeQualification');
     $(this).closest('.QualificationSelect').remove();
   });

 })
   $(document).on('click','.addQualification', function(){
    console.log(' addQualification ');
    var newQualificationHtml = '<div class="QualificationSelect"><select name="qualification[]" class="userQualification">';
    @if(!empty($qualificationList))
        @foreach($qualificationList as $lk=>$qualification)
            newQualificationHtml += '<option value="{{$qualification['id']}}">{{$qualification['title']}}</option>';
        @endforeach
    @endif
    newQualificationHtml += '</select>';
    newQualificationHtml += '<i class="fa fa-trash removeQualification"></i>';
    newQualificationHtml += '</div>';
    $('.jobSeekerQualificationList').append(newQualificationHtml);
   });



// ====================================================== Edit Qualification Ajax ======================================================

//     $(".qualificationSaveButton").click(function(){
//         console.log('hi qualification');
//         $.ajaxSetup({
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             }
//         });
//         var qualification = jQuery('.userQualification').map(function(){ return $(this).val()}).get();
//         $('.qualifExpLoader').show();           //indusExpLoader
//         // $('.SaveQualification').after(getLoader('smallSpinner SaveQualificationSpinner'));

//         $.ajax({
//             type: 'POST',
//             url: base_url+'/ajax/updateQualification',
//             data: {'qualification': qualification},
//             success: function(resp){
//                 if(resp.status){
//                     $('.removeQualification ').addClass('hide_it2');
//                     $('.addQualification').addClass('hide_it2');
//                     $('.qualificationSaveButton').addClass('hide_it2');
//                     $('.qualifExpLoader').hide();
//                     $('.jobSeekerQualificationList').html(resp.data);

//                     // location.reload();
//                 }
//             }
//         });
// })


// ====================================================== End Qualification Ajax end here ======================================================




//===================================================== add remove industry ===================================================

 $(".editIndustry").click(function(){
    $(this).closest('.IndusListBox').addClass('edit');
    $('input, select').styler();
    $('.removeIndustry').removeClass('hide_it2');
    $('.addIndus').removeClass('hide_it2');
    $('.buttonSaveIndustry').removeClass('hide_it2');

    // console.log('welcome');
  });

// add and remove Industry code
$(document).ready(function(){
   $(document).on('click','.removeIndustry', function(){
    $(this).closest('.IndustrySelect').remove();
   });

   $(document).on('click','.addIndus', function(){
    console.log(' addIndus ');
    var newIndusHtml = '<div class="IndustrySelect"><select name="industry_experience[]" class="industry_experience userIndustryExperience">';
    @if(!empty($industriesList))
        @foreach($industriesList as $lk=>$lv)
            newIndusHtml += '<option value="{{$lk}}">{{$lv}}</option>';
        @endforeach
    @endif
    newIndusHtml += '</select>';
    newIndusHtml += '<i class="fa fa-trash removeIndustry"></i>';
    newIndusHtml += '</div>';

    $('.IndusList').append(newIndusHtml);
   });
});

// ======================== Edit Industry Experience for Ajax ========================

// $(".saveIndus").click(function(){
//     // console.log('hi industry');
//     $.ajaxSetup({
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             }
//         });
//         var industry_experience = jQuery('.industry_experience').map(function(){ return $(this).val()}).get();

//          // $('.indusExpLoader').after(getLoader('smallSpinner indusExpLoader'));
//         $('.indusExpLoader').show();           //indusExpLoader


//         $.ajax({
//             type: 'POST',
//             url: base_url+'/ajax/updateIndustryExperience',
//             data: {'industry_experience': industry_experience},
//             // $('.IndusAlert').hide();


//             success: function(resp){
//                 if(resp.status){
//                     // $('.IndusListBox').removeClass('edit');
//                     $('.IndusAlert').show().delay(3000).fadeOut('slow');
//                     // $('.SaveIndustrySpinner').remove();

//                     $('.IndusList').html(resp.data);
//                     $('.removeIndustry').addClass('hide_it2');
//                     $('.addIndus').addClass('hide_it2');
//                     $('.buttonSaveIndustry').addClass('hide_it2');
//                     $('.indusExpLoader').hide();


//                     }
//             }
//     });
//  });

// ======================================= Edit Industry Experience For Ajax End Here =======================================


//===================================================== add remove industry end  =====================================================

//===================================================== User Questions Edit =====================================================

 $(".editQuestions").click(function(){
     // $('.hideme').show();
     $('.saveQuestionsButton').css("display","block");
     $('.QuestionsKeyPTag').addClass('hide_it');
     $('.jobSeekerRegQuestion').removeClass('hide_it');

});

//  ======================================= User Questions Ajax saveQuestionsButton =======================================

    // $(".saveQuestionsButton").click(function(){
    //     var items = {};
    //     $('select.jobSeekerRegQuestion').each(function(index,el){
    //     // console.log(index, $(el).attr('name')  , $(el).val()   );
    //         // items.push({name:  $(el).attr('name') , value: $(el).val()});
    //         var elem_name = $(el).attr('name');
    //         var elem_val = $(el).val();
    //         items[elem_name] = elem_val;
    //         // items.push({elem_name : elem_val });
    //     $('.userQuesLoader').show();

    //     });
    //      $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });
    //     $('.SaveQuestionsLoader').after(getLoader('smallSpinner SaveQuestionsSpinner'));
    //     $.ajax({
    //         type: 'POST',
    //         url: base_url+'/m/ajax/MupdateQuestions',
    //         data: {'questions': items},

    //         success: function(data){
    //                 $('.questionsAlert').show().delay(3000).fadeOut('slow');
    //  $('.saveQuestionsButton').addClass('hide_it2');

    //                 // $('.saveQuestionsButton').addClass('hide_it2');
    //                 $('.userQuesLoader').hide();
    //                 $('.QuestionsKeyPTag').removeClass('hide_it2');
    //                 $(".SaveQuestionsSpinner").remove();
    //                 $('.jobSeekerRegQuestion').addClass('hide_it');



    //                 if(data){
    //                     // $(".questionsOfUser").load(" .questionsOfUser");
    //                     // $(".SaveQuestionsSpinner").remove();

    //             }
    //         }
    //     });
    // });

//  ======================================= User Questions Ajax End  =======================================
</script>


@stop

