
@extends('site.employer.employermaster')  {{-- site/employer/employermaster --}}

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('css/site/profile.css') }}">
@stop

{{-- @section('content') --}}

{{-- <div class="cont bl_profile"> --}}
 {{--    <div class="bl_pic_info  my_profile">

        <div class="bl_pic">
            <div class="pic">
                <div class="profile_pic_one to_show">
                    <a class="show_photo_gallery" href="{{$profile_image}}" data-lcl-thumb="{{$profile_image}}" >
                        <img  data-offset-id="23" class="photo" id="pic_main_img" src="{{$profile_image}}" title="">
                    </a>
                </div>
            </div>
        </div>

        <div class="info">
            <div class="name"><a id="profile_name" style="cursor:default;" class="edit_main_title"  onclick="return false;">
                {{($user->company)?($user->company):($user->name.' '.$user->surname)}}</a></div>
            <div class="bl_list_info">
                <ul class="list_info userProfileLocation">
                    <li><span id="list_info_age">{{$user->age}}</span><span class="basic_info">•</span></li>
                    <li id="list_info_location">{{userLocation($user)}}</li>
                    <li><span class="basic_info">•</span><span id="list_info_gender">Employer</span></li>
                </ul>
                <div class="icon_edit">
                    <i onclick="UProfile.showMainEditor();" class=" fas fa-edit"></i>
                </div>
            </div>

        </div>
        <div class="cl"></div>
    </div>
 --}}

  {{--   @include('site.employer.profile.tabs')  --}} {{-- site/employer/profile/tabs --}}

    {{-- <div class="cl"></div> --}}
{{-- </div> --}}



{{-- @include('site.employer.profile.profileEditPopup') {{-- site/employer/profile/profileEditPopup --}} 
{{-- @include('site.employer.profile.profilePersonalInfo') {{-- site/employer/profile/profilePersonalInfo --}} 


{{-- @stop --}}


{{-- @section('custom_footer_css')


<link rel="stylesheet" href="{{ asset('css/site/employer/profile.css') }}"> 
<link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}">
<link rel="stylesheet" href="{{ asset('css/site/gallery_popup/lc_lightbox.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/plyr.css') }}">

@stop --}}

@section('custom_js')
<script src="{{ asset('js/site/jquery.modal.min.js') }}"></script>
<script src="{{ asset('js/site/gallery_popup/lc_lightbox.lite.js') }}"></script>
<script src="{{ asset('js/site/plyr.polyfilled.js') }}"></script>
<script type="text/javascript">
//======================= Employer Questions Edit =================================
 $(".editEmployerQuestions").click(function(){
 $('.button').css("display","inline-block");
 $('.EmployerRegQuestion').removeClass('hide_it');
 $('.employerQuestionsPtag').addClass('hide_it');
});
//======================= Employer Questions Editing end here =================================
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

$(".editIndustry").click(function(){
    $(this).closest('.IndusListBox').addClass('edit');
    $('.removeIndustry').removeClass('hide_it2');
    $('.addIndus').removeClass('hide_it2');
    $('.buttonSaveIndustry').removeClass('hide_it2');
    // console.log('welcome');
  });
</script>
@stop





{{--================================================= html for employer ============================================--}}

{{-- @extends('web.user.usermaster') --}} {{-- site/user/usermaster --}}

@section('content')

<div class="tab-content" id="nav-tabContent">
   
   <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
      <section class="row">
         <div class="col-md-4 order-md-2 order-sm-1 profile-data-info">
            <div class="profile-information">
               <div class="profile-img-wrapper  profile_pic_one to_show">
                 <a class="show_photo_gallery" href="{{$profile_image}}" data-lcl-thumb="{{$profile_image}}" >
                  <img  data-offset-id="23" class="photo" id="pic_main_img" src="{{$profile_image}}" width="150" height="200" alt="profile">
              </a>
               </div>
               <div class="profile-detail clearfix">

                  {{-- <div class="row m-0">  
                     <input type="text" class="form-control col-10 bg-white border-0 sec_username text-center" 
                        value="{{$user->name}}" readonly />
                        <button type="button" onclick="showFieldEditor('username');" class="orange_btn col-2">
                           <i class="fas fa-edit"></i>
                        </button>
                        <div class="float-right button_username d-none">
                           <button class="btn btn-sm btn-danger" onclick="hideFieldEditor('username');">Cancel</button>
                           <button class="orange_btn mt-2">Save</button> 
                        </div>
                  </div> --}}

                  <h2 class="text-center"> <a id="profile_name" style="cursor:default;" class="edit_main_title"  onclick="return false;">
                {{($user->company)?($user->company):($user->name.' '.$user->surname)}}</a> </h2>


                  <div class="location p-2">  
                     <b> Location </b> 
                     <button type="button" onclick="showFieldEditor('location');" class="orange_btn float-right">
                        <i class="fas fa-edit"></i>
                     </button>
                     <input type="text" class="form-control p-0 bg-white border-0 sec_location" 
                        value="{{ $user->state }} , {{ $user->country }}" readonly />

                     <div class="row">
                        <div class="col-12">
                           <div class="float-right button_location d-none">
                              <button class="btn btn-sm btn-danger" onclick="hideFieldEditor('location');">Cancel</button>
                              <button class="orange_btn mt-2">Save</button> 
                           </div>
                        </div>
                     </div>
                  </div>

                  {{-- <h2>Job Seekers</h2> --}}
                  
{{-- 
                  <div class="salaryRange p-2">
                     <b>Expecting Salary:</b>
                     <button type="button" onclick="showFieldEditor('salaryRange');" class="orange_btn float-right">
                        <i class="fas fa-edit"></i>
                     </button>
                     <input type="text" class="form-control p-0 bg-white border-0 sec_salaryRange" 
                        value="{{ $user->salaryRange }}" readonly />
                       
                        <div class="newSalary my-2 d-none">
                          {{ Form::select('salaryRange', $salaryRange, $user->salaryRange, 
                          ['placeholder' => 'Select Salary Range', 'id' => 'salaryRangeFieldnew',  'class' => 'form-control custom-select']) }}
                        </div>

                     <div class="row">
                        <div class="col-12">
                           <div class="float-right button_salaryRange d-none">
                              <button class="btn btn-sm btn-danger" onclick="hideFieldEditor('salaryRange');">Cancel</button>
                              <button class="orange_btn mt-2">Save</button> 
                           </div>
                        </div>
                     </div>

                  </div> --}}

               </div>
            </div>
         </div>
        
           @include('site.employer.profile.tabs')  {{-- site/employer/profile/tabs --}}
         
      </section>
   </div>
   <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
      <div class="profile-section update-information">
         <div class="row update-information-area">
            <div class="col-sm-12">
               <h2>Update Email Address</h2>
               <div class="row">
                  <div class="col-sm-3">
                     <label>Email</label>
                  </div>
                  <div class="col-sm-6">
                     <input class="form-control" type="email" placeholder="Example@domain.com"/>
                  </div>
               </div>
            </div>
         </div>
         <div class="row update-information-area">
            <div class="col-sm-12">
               <h2>Update Phone Number</h2>
               <div class="row">
                  <div class="col-sm-3">
                     <label>Phone</label>
                  </div>
                  <div class="col-sm-6">
                     <input class="form-control" type="number" placeholder="Example@domain.com"/>
                  </div>
               </div>
            </div>
         </div>
         <div class="row update-information-area">
            <div class="col-sm-12">
               <h2>Update Password</h2>
               <div class="row mb-3">
                  <div class="col-sm-3">
                     <label>Current Password</label>
                  </div>
                  <div class="col-sm-6">
                     <input class="form-control" type="number" placeholder="Example@domain.com"/>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-3">
                     <label>New Password</label>
                  </div>
                  <div class="col-sm-6">
                     <input class="form-control" type="number" placeholder="Example@domain.com"/>
                  </div>
               </div>
            </div>
         </div>
         <div class="update-account-info">
            <button class="update-btn orange_btn" type="button"><i class="fas fa-retweet"></i>Update All</button>
            <button class="delete-btn" type="button"><i class="fa fa-trash"></i>Delete Account</button>
         </div>
      </div>
   </div>
</div>
@stop

@section('custom_js')


<script src="{{ asset('js/site/profile.js') }}"></script> 

<script src="{{ asset('js/site/userProfile.js') }}"></script>


<script type="text/javascript">
   this.showFieldEditor = function(field){
      console.log('.save'+field+'button');
      if (field == 'salaryRange') {
         $('.sec_salaryRange').addClass('d-none');
         $('.newSalary').removeClass('d-none');
      }
      if (field =='recentJob') {
         $('.recentjob').addClass('d-none');
         $('.sec_recentJob').removeClass('d-none');
      }
      $('.sec_'+field).removeAttr('readonly');
      $('.sec_'+field).focus();
      $('.sec_'+field).removeClass('bg-white border-0');
      $('.button_'+field).removeClass('d-none');
   }

   this.hideFieldEditor = function(field){
      console.log('.save'+field+'button');
      $('.sec_'+field).attr('readonly', 'true');
      $('.sec_'+field).blur();
      $('.sec_'+field).addClass('bg-white border-0');
      $('.button_'+field).addClass('d-none');
      if (field == 'salaryRange') {
         $('.sec_salaryRange').removeClass('d-none');
         $('.newSalary').addClass('d-none');
      }
      if (field =='recentJob') {
         $('.recentjob').removeClass('d-none');
         $('.sec_recentJob').addClass('d-none');
      }

   }


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



</script>

@stop

@section('custom_css')
   <style type="text/css">
      textarea{
         resize: none
      }
   </style>
@stop