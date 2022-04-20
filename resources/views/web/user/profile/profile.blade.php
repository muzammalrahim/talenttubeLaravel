
@extends('web.user.usermaster') {{-- web/user/usermaster --}}

@section('content')

<div class="tab-content" id="nav-tabContent">
   
   <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
      <section class="row">
         <div class="col-md-4 order-md-2 order-sm-1 profile-data-info ">
            <div class="profile-information ">
               <div class="profile-img-wrapper">
                  <div class="profileimgContainer">
                    <img  src="{{$profile_image}}" class="profile_img" width="150" height="200" alt="profile">
                  </div>
               </div>
               <div class="profile-detail clearfix ">
                  <div class="text-center">
                     <h1> {{ $user->name }} {{ $user->surname }} </h1>
                     {{-- <p> {{userLocation($user)}} </p> --}}

                     <div class="location p-0s">  
                        <div class="row m-0">
                           <div class="col-10 p-0 m-0"> 
                              <p class="userLocationSpan px-0" > {{userLocation($user)}} </p> 
                           </div>
                           <div class="col-2 p-0 m-0">
                              <button type="button" id="list_info_location" class="orange_btn float-right " onclick="showMap()">
                                 <i class="fas fa-edit salaryRangeEdit"></i> 
                              </button>
                           </div>
                        </div>
                        <div class="location_search_cont hide_it ">
                              <div class="location_input dtable w100">
                                <input type="text" name="location_search" class="inp fl_left form-control" id="location_search" value="{{userLocation($user)}}" placeholder="Type a location" aria-invalid="false">
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

                                {{-- <button class=" btn-sm btn-danger" onclick="showMap()">Cancel</button> --}}

                                <button class="btn small orange_btn saveNewLocation" onclick="updateLocation()">Save</button>

                            </div>
                        </div>
                     </div>

                     <!-- <h2> {{$user->username}} </h2> -->
                  </div>

                  
                  {{-- ==================================== Recent job ==================================== --}}

                     {{-- <div class="about-infomation">
                        <h2>Recent Job</h2>
                            <button type="button"  onclick="showFieldEditor('recentJob');" class="edited-text"><i class="fas fa-edit"></i></button>
                        
                        <div class="recentjob">
                           <span class="recentjobSpan"> {{$user->recentJob}} </span>
                              <b class="mx-2">at</b>
                           <span class="organizationSpan"> {{$user->organHeldTitle}} </span>
                        </div>

                        <div class="row sec_recentJob d-none">
                           <div class="col-5">
                              <input type="text" name="recentJobField" class="form-control recentJobField" value="{{$user->recentJob}}">
                           </div>
                           <div class="col-1">  <span> at </span>  </div>
                           <div class="col-6">
                              <input type="text" name="organHeldTitleField" class="form-control organHeldTitleField" value="{{$user->organHeldTitle}}" onclick="showFieldEditor()">
                           </div>
                        </div>           

                        <div class="row">
                           <div class="col-md-12">
                              <div class="float-right button_recentJob d-none">
                                 <button class="cancel-button" onclick="hideFieldEditor('recentJob');">Cancel</button>
                                 <button class="orange_btn mt-2" onclick="updateRecentJob()">Save</button> 
                              </div>
                           </div>
                        </div>

                        <div class="alert alert-success alert_recentJob hide_me" role="alert">
                          <strong>Success!</strong> Recent Job has been updated successfully!
                        </div>
                     </div> --}}

                  {{-- ==================================== Recent job ==================================== --}}

                  <div class="recent-job recentjob clearfix px-0 px-md-3">

                     {{-- <div class="row m-0">  --}}
                        {{-- <div class="col-5"> --}}
                           <div class="d-inline-block">
                              <label class="mb-2">Recent Job:</label>
                        {{-- </div> --}}

                        {{-- <div class="col-7"> --}}
                              <span class="recentjobSpan"> {{$user->recentJob}} </span>
                             <span class="px-1"> at </span> 
                              <span class="organizationSpan"> {{$user->organHeldTitle}} </span>
                              </div>
                        {{-- </div> --}}
                     {{-- </div> --}}

                  </div> 


                  {{-- ========================================= Salary Range ========================================= --}}


                  <div class="recent-job clearfix px-0 px-md-3">
                     {{-- <div class="row m-0"> --}}
                        <div class="d-inline-block">
                        {{-- <div class="col-5"> --}}
                           <label class="mb-2"> 
                              Expecting Salary: 
                           </label>
                        {{-- </div> --}}
                        {{-- <div class="col-7"> --}}
                           <span>AUD: </span>  <span class="salaryRangeValue"> {{number_format($user->salaryRange),3}} </span>
                        </div>
                        {{-- </div> --}}
                     {{-- </div> --}}
                  </div>


                  {{-- ========================================= Salary Range End Here ========================================= --}}
                  <div class="text-center mb-4">  
                     <button type="button" class="edit-btn orange_btn" data-toggle = "modal" data-target ="#multifieldPopUp" onclick="editMultipleFields()"><i class="fas fa-edit"></i>Edit</button>
                  </div> 
               </div>


            </div>
         </div>

         <div class="col-md-8 order-md-1 order-sm-2 first-tap-detail">

            <div class="profile profile-section">
               <ul class="nav nav-tabs" id="Profile-tab" role="tablist">
                  <span class="line-tab"></span>
                  <li class="nav-item" role="presentation">
                     <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                        type="button" role="tab" aria-controls="home" aria-selected="true">
                     <i class="fa fa-circle tab-circle-cross"></i>Profile</button>
                  </li>
                  <li class="nav-item" role="presentation">
                     <button class="nav-link" id="profile-tab1" data-bs-toggle="tab" data-bs-target="#profile"
                        type="button" role="tab" aria-controls="profile" aria-selected="false">
                     <i class="fa fa-circle tab-circle-cross"></i>Album</button>
                  </li>
                  <li class="nav-item" role="presentation">
                     <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                        type="button" role="tab" aria-controls="contact" aria-selected="false">
                     <i class="fa fa-circle tab-circle-cross"></i>Questions</button>
                  </li>
                  <li class="nav-item" role="presentation">
                     <button class="nav-link" id="tag-tab" data-bs-toggle="tab" data-bs-target="#tag"
                        type="button" role="tab" aria-controls="tag" aria-selected="false">
                     <i class="fa fa-circle tab-circle-cross"></i>Tags</button>
                  </li>
                  <li class="nav-item" role="presentation">
                     <button class="nav-link" id="job-tab" data-bs-toggle="tab" data-bs-target="#job"
                        type="button" role="tab" aria-controls="job" aria-selected="false">
                     <i class="fa fa-circle tab-circle-cross"></i>Job</button>
                  </li>
                  <li class="nav-item" role="presentation">
                     <button class="nav-link" id="refrance-tab" data-bs-toggle="tab" data-bs-target="#refrance"
                        type="button" role="tab" aria-controls="refrance" aria-selected="false">
                     <i class="fa fa-circle tab-circle-cross"></i>References</button>
                  </li>

               </ul>
               <div class="tab-content" id="myTabContent">
                  <!--==================== profile tab-->
                  <div class="profile-text-wrap tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="Profile-tab">
                     
                     

                     {{-- ==================================== About me ==================================== --}}

                     <div class="about-infomation">
                        <h2>About me</h2>
                        <button type="button"id="showeditbox" onclick="showFieldEditor('about_me');" class="edited-text"><i class="fas fa-edit"></i></button>
                        <p class="text_about_me m-0"> {{$user->about_me}} </p>

                        <textarea class="form-control bg-white border-0 sec_about_me d-none" rows="3" cols="3" readonly > {{$user->about_me}}</textarea>

                        <div class="row">
                           <div class="col-md-12">
                              <div class="float-right button_about_me d-none">
                                 <button class="cancel-button" onclick="hideFieldEditor('about_me');">Cancel</button>
                                 <button class="orange_btn mt-2" onclick="updateProfile('about_me');" >Save</button> 
                              </div>
                           </div>
                        </div>
                        <div class="alert alert-success alert_about_me hide_me" role="alert">
                          <strong>Success!</strong> About me has been updated successfully!
                        </div>
                     </div>

                     <div class="about-infomation">
                        <h2>Interested In</h2>
                        <button type="button"  onclick="showFieldEditor('interested_in');" class="edited-text"><i class="fas fa-edit"></i></button>
                        
                        <p class="text_interested_in m-0"> {{$user->interested_in}} </p>

                        <textarea class="form-control bg-white border-0 sec_interested_in d-none" rows="3" cols="3" readonly > {{$user->interested_in}}</textarea>

                        <div class="row">
                           <div class="col-md-12">
                              <div class="float-right button_interested_in d-none">
                                 <button class="cancel-button" onclick="hideFieldEditor('interested_in');">Cancel</button>
                                 <button class="orange_btn mt-2" onclick="updateProfile('interested_in');">Save</button> 
                              </div>
                           </div>
                        </div>
                        <div class="alert alert-success alert_interested_in hide_me" role="alert">
                          <strong>Success!</strong> Interested In have been updated successfully!
                        </div>
                     </div>


                    
                    <div class="about-infomation bl qualificationBox">
                        <h2>Qualifications</h2>
                        <button type="button" class="edited-text" onclick="showQualificationEditor();"><i class="fas fa-edit editQualification"></i></button>
                        <p class="loader SaveQualification"style="float: left;"></p>
                              <div class="cl"></div>
                        <ul class="qualification-li">
                            <li><i class="qualification-circle"></i><span> Type: {{ ucfirst($user->qualificationType) }}</span></li>
                            <div class="">
                            @include('site.layout.parts.jobSeekerQualificationList') {{-- site/layout/parts/jobSeekerQualificationList --}}  </div>
                            <div class="button_qualification d-none "> 
                                <button class="btn-info btn-block rounded py-2 btn-sm m-0 addQualification" onclick="addQualification()" >Add New</button> 
                                 <button class="savequalification btn-block orange_btn rounded py-2 " onclick="updateQualification()">Save</button>
                              </div>
                              <div class="alert alert-success QualifAlert hide_me" role="alert">
                                <strong>Success!</strong> Qualification have been updated successfully!
                              </div>
                        </ul>
                     </div> 
                    

                    <div class="about-infomation IndusListBox">
                        <h2>Industry Experience</h2>
                        <button type="button" class="edited-text" onclick="showIndustryExpEditor();"><i class="fas fa-edit"></i></button>
                        <ul class="qualification-li font-16">
                            <div class="IndusList">  
                              @include('site.layout.parts.jobSeekerIndustryList')
                            </div>
                            <div class="button_industryExperience d-none">
                                <button class="addIndus btn-info btn-block rounded py-2 btn-sm m-0" onclick="addIndustryExp()" >Add New</button> 
                                <button class=" btn-block orange_btn rounded py-2  saveIndus " onclick="updateIndusExperience()">Save</button>
                            </div>
                            <div class="alert alert-success IndusAlert hide_me" role="alert">
                               <strong>Success!</strong> Industry Experience have been updated successfully!
                            </div>
                        </ul>
                    </div>
                </div>
               
                  <!-- ========================================== album-tab ========================================== -->
                  

                  <div class="album-section tab-pane fade Photos " id="profile" role="tabpanel" aria-labelledby="profile-tab">

                     @include('site.user.profile.tabs.album')  {{-- site/user/profile/tabs/album --}}
                     

                     @include('web.user.profile.tabs.resume')  {{-- web/user/profile/tabs/resume --}}

                     <div class=" Gallery">
                        <h2>Videos</h2>

                           @include('web.user.profile.tabs.videos') {{-- web/user/profile/tabs/videos --}}

                     </div>
                  </div>


                  <!-- ========================================== question tab ========================================== -->
                  
                  <div class="tab-pane fade questions-tab" id="contact"  role="tabpanel" aria-labelledby="contact-tab">

                     <h2>Questions  <button type="button"  onclick="showFieldEditor('question');" class="edited-text orange_btn float-right"><i class="fas fa-edit"></i></button></h2>
                     
                        @include('site.user.profile.questionsuserpart')
                  </div>

                  <!-- ========================================== tag tab ========================================== -->
                  <div class="tab-pane fade tag-tab-info " id="tag"  role="tabpanel" aria-labelledby="tag-tab">

                     @include('site.user.profile.tabs.tags')

                  </div>
                  <!--=================job tab ============================ -->
                  
                  <div class="tab-pane fade job-applied" id="job"  role="tabpanel" aria-labelledby="job-tab">

                     @include('site.user.profile.tabs.jobs') {{-- site/user/profile/tabs/jobs --}}

                  </div>
                  
                  <!--=================referancesss tab=====================-->
                  <div class="tab-pane fade referance-tab" id="refrance"  role="tabpanel" aria-labelledby="refrance-tab">
                     @include('site.user.profile.tabs.reference') {{-- site/user/profile/tabs/reference --}}
                  </div>

                  <!--========================end all tabs-->
               </div>
               
               </div>

            </div>
 
      </section>
   </div>
   
</div>


<div class="bj-modal">
   <div class="modal fade" id="multifieldPopUp" tabindex="-1" role="dialog"
      aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog filter-industry-modal" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <div class="m-header">
                  <h4 class="modal-title" id="myModalLabel">
                     <img src="{{ asset('assests/images/filter.png') }}" alt="img" class="">
                     Edit Fields
                  </h4>
                  <i data-dismiss="modal" aria-label="Close" class="close-box fa fa-times"></i>
               </div>
            </div>
            <div class="modal-body">

               <div class="i-modal-checks multiFields">
    
               </div>
            </div>
            <div class="modal-footer" >
               <button type="button" class="btn btn-primary bs-btn" data-dismiss="modal">
               {{-- <img src="{{ asset('assests/images/search-modal.png') }}" alt="img" class=""> --}}
               <span class="fb-text"> Done </span>
               </button>
            </div>
         </div>
      </div>
   </div>
</div>




@stop



@section('custom_js')

<script type="text/javascript" src="https://maps.google.com/maps/api/js?libraries=places&key={{env('GOOGLE_API')}}"></script>

<script src="{{ asset('js/web/profile.js') }}"></script>
<script src="{{ asset('js/site/tagSystem.js') }}"></script>
<script src="{{ asset('js/site/jquery.modal.min.js') }}"></script>



<script type="text/javascript">



// {{-- ==================================================== Edit Qualification ==================================================== --}}

  this.addQualification = function(){
    console.log('Add Qualification Button profile');

    var newQualificationHtml = '<div class="QualificationSelect row ml-0 my-2"> <select name="qualification[]" class="userQualification form-control col-10">';
    @if(!empty($qualificationList))
        @foreach($qualificationList as $lk=>$qualification)
            newQualificationHtml += '<option value="{{$qualification['id']}}">{{$qualification['title']}}</option>';
        @endforeach
    @endif
    newQualificationHtml += '</select>';
    newQualificationHtml += '<div class = "col-2">';
    newQualificationHtml += '<i class="fa fa-trash removeQualification float-right"></i></div>';
    newQualificationHtml += '</div>';
    newQualificationHtml += '</div>';
    $('.jobSeekerQualificationList').append(newQualificationHtml);

  }


// ===================================================== add remove industry ===================================================


$(document).ready(function(){
   $(document).on('click','.removeIndustry', function(){
    $(this).closest('.IndustrySelect').remove();
   });

    this.addIndustryExp = function (){

    console.log(' addIndus ');
    var newIndusHtml = '<div class="IndustrySelect row ml-0 my-2"><select name="industry_experience[]" class="industry_experience userIndustryExperience form-control col-10">';
    @if(!empty($industriesList))
        @foreach($industriesList as $lk=>$lv)
            newIndusHtml += '<option value="{{$lk}}">{{$lv}}</option>';
        @endforeach
    @endif
    newIndusHtml += '</select>';
    newIndusHtml += '<div class = "col-2">';
    newIndusHtml += '<i class="fa fa-trash removeIndustry float-right"></i></div>';
    newIndusHtml += '</div>';
    $('.IndusList').append(newIndusHtml);

   }

});

// ======================== Edit Industry Experience for Ajax ========================

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




</script>

@stop

@section('custom_css')

<link rel="stylesheet" href="{{ asset('css/site/tagSystem.css') }}">

   <style type="text/css">
      textarea{ resize: none }
   </style>
    
@stop