@extends('adminlte::page')

@section('title',$title)

@section('content_header')

@stop

@section('content')

<div class="container">
    @include('admin.errors',[ 'error' => $errors, 'record' => $record ])
    @if ($record)
        {!! Form::model($record, array('url' => route('users.update',['id' => $record->id]), 'method'=>'PATCH', 'files' => true, 'name'=>'formUser', 'novalidate'=>'')) !!}

    @else
        {!! Form::open(array('url' => route('users.create'), 'method' => 'POST', 'files' => true, 'name'=>'formUser', 'novalidate'=>'')) !!}
    @endif

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5"><h4 class="card-title mb-0">{{ __('Job Seeker Management') }}</h4></div>
            </div>
            <hr>
            <div class="row mt-4 mb-4">

                    <div class="col">

                    {{-- Adding Tab Start --}}


          <div class="col-12 col-sm-6 col-lg-12">
            <div class="card card-primary card-tabs">

              <div class="card-header p-0 pt-1 tabColor"style="background: #6c757d;">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">

                  <li class="nav-item col-lg-3">
                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true"><b>General</b></a>
                  </li>

                  <li class="nav-item col-lg-3">
                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false"><b>User Information</b></a>
                  </li>

                  <li class="nav-item col-lg-3">
                    <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false"><b>Questions</b></a>
                  </li>

                  <li class="nav-item col-lg-3">
                    <a class="nav-link" id="custom-tabs-one-private-tab" data-toggle="pill" href="#custom-tabs-one-private" role="tab" aria-controls="custom-tabs-one-private" aria-selected="false"><b>Private Gallery</b></a>
                  </li>

                </ul>
              </div>

              <div class="card-body">

                <div class="tab-content" id="custom-tabs-one-tabContent">

                  @include('admin.user.tabs.tab1')
                  @include('admin.user.tabs.tab2')
                  @include('admin.user.tabs.tab3')
                  @include('admin.user.tabs.tab4')


                </div> <!-- tab-content end -->
              </div>

              <!-- /.card -->
            </div>
          </div>
                    {{-- Adding Tab End --}}


                </div><!--col-->

            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col"><a class="btn btn-danger btn-sm" href=" {!! route('users') !!}">Cancel</a></div>
                <div class="col text-right"><button class="btn btn-success btn-sm pull-right" type="submit">Update</button></div>
            </div>
        </div><!--card-footer-->

    </div><!--card-->

    {!! Form::close() !!}

</div>

@stop


@section('css')
    <link rel="stylesheet"  href="{{ asset('css/admin_custom.css') }}">

@stop

@section('js')

<script src="{{ asset('js/admin_custom.js') }}"></script>
<script src="{{ asset('js/site/userProfileadmin.js') }}"></script>
<script>
 $("#form_id").submit(function(){
  return false;
});
 </script>




<script type="text/javascript">
// add and remove languages code
$(document).ready(function(){


    $("#headingOne").submit(function(e){
        e.preventDefault();
    });

   $(document).on('click','.removeLang', function(){
    $(this).closest('.langSelect').remove();
   });

   $(document).on('click','.addLang', function(){
    console.log(' addLang ');
    var newLangHtml = '<div class="langSelect"><select name="language[]">';

    @if(!empty($languages))
        @foreach($languages as $lk=>$lang)
            newLangHtml += '<option value="{{$lk}}">{{$lang}}</option>';
        @endforeach
    @endif

    newLangHtml += '</select>';
    newLangHtml += '<span class="removeLang  btn btn-danger">Remove</span>';
    newLangHtml += '</div>';

    $('.langList').append(newLangHtml);
   });
});

// add and remove Industry code
$(document).ready(function(){
   $(document).on('click','.removeIndus', function(){
    $(this).closest('.indusSelect').remove();
   });

   $(document).on('click','.addIndus', function(){
    console.log(' addIndus ');
    var newIndusHtml = '<div class="IndusSelect"><select name="industry_experience[]" class="industrySelectStyling">';

    @if(!empty($industriesList))
        @foreach($industriesList as $lk=>$lv)
            newIndusHtml += '<option value="{{$lk}}">{{$lv}}</option>';
        @endforeach
    @endif

    newIndusHtml += '</select>';
    newIndusHtml += '<span class="removeIndus btn btn-danger">Remove</span>';
    newIndusHtml += '</div>';

    $('.indusList').append(newIndusHtml);
   });
});

// add and remove Industry code end here



</script>



<!-- added by Hassan -->
<script type="text/javascript"> var base_url = '{!! url('/') !!}';</script>
<script src="http://malsup.github.com/jquery.form.js"></script>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?libraries=places&key={{env('GOOGLE_API')}}"></script>
<link rel="stylesheet" href="{{ asset('css/viewer.css') }}">
<script type="text/javascript" src="{{ asset('js/viewer.js') }}"></script>
<script type="text/javascript">

// add and remove languages code

// var viewer = new Viewer(document.getElementById('images'), {
//   inline: true,
//   viewed() {
//     viewer.zoomTo(1);
//   },
// });

var viewer=new Viewer (document.getElementById ("images"), {
  toolbar:true, //Show toolbar
  viewed () {
   viewer.zoomTo (1);//Picture display ratio 75%
  },  show:function() {//After loading the image dynamically,Update instance
   viewer.update();
  }, });

// Then, show the image by click it, or call `viewer.show()`.
console.log(viewer);
// View a list of images
var gallery = new Viewer(document.getElementById('images'));


$(document).ready(function(){
   $(document).on('click','.removeHobby', function(){
    $(this).closest('.hobbySelect').remove();
   });


   $(document).on('click','.addHobby', function(){
    console.log(' addHobby ');
    var newHobbyHtml = '<div class="hobbySelect"><select name="hobbies[]">';
    @if(!empty($hobbies))
        @foreach($hobbies as $lk=>$hobby)
            newHobbyHtml += '<option value="{{$lk}}">{{$hobby}}</option>';
        @endforeach
    @endif
    newHobbyHtml += '</select>';
    newHobbyHtml += '<span class="removeHobby  btn btn-danger">Remove</span>';
    newHobbyHtml += '</div>';
    $('.hobbyList').append(newHobbyHtml);
   });

   // addHobby end

   $(document).on('change','.country_dd', function(){
     console.log(' country_dd ',this);
     var country_id = $('#country').val();
     var type = 'geo_states';
     get_Location('geo_states',country_id,0);
   });

   // country_dd end

    $(document).on('change','.state_dd', function(){
     console.log(' state_dd ',this);
     var country_id = $('#country').val();
     var city_id = $('.state_dd select').val();
     var type = 'geo_cities';
     get_Location('geo_cities',country_id,city_id);
   });

   // country_dd end

  get_Location = function(type, country_id, state_id){
    $.ajax({
        type: 'POST',
        url: base_url+'/ajax/'+type,
        data: { cmd:type,
                select_id: (type == 'geo_states')?country_id:state_id,
                filter:'1',
                list: 0
        },
        beforeSend: function(){
            // $jq('.geo, #city', pp_profile_edit_main_frm).prop('disabled', true).trigger('refresh');
            // preloader
        },
        success: function(data){
            console.log(data);
            if (data.status) {
                var option ='<option value="0">Select City</option>';
                switch (type) {
                    case 'geo_states':
                        $('.state_dd select').html(data.list);
                        $('.city_dd select').html(option);
                        break
                    case 'geo_cities':
                        $('.city_dd select').html(data.list);
                        break
                }
            }
        }
    });
  }


// Tab next click
$('#custom-tabs-one-home .btnNext').on('click', function (e) {
  e.preventDefault()
  $('#custom-tabs-one-profile-tab').tab('show')
});

$('#custom-tabs-one-profile .btnNext').on('click', function (e) {
  e.preventDefault()
  $('#custom-tabs-one-messages-tab').tab('show')
});

$('#custom-tabs-one-messages .btnNext').on('click', function (e) {
  e.preventDefault()
  $('#custom-tabs-one-private-tab').tab('show')
});

// new

$('#custom-tabs-one-profile .btnPrevious').on('click', function (e) {
  e.preventDefault()
  $('#custom-tabs-one-home-tab').tab('show')
});

$('#custom-tabs-one-messages .btnPrevious').on('click', function (e) {
  e.preventDefault()
  $('#custom-tabs-one-profile-tab').tab('show')
});

$('#custom-tabs-one-private .btnPrevious').on('click', function (e) {
  e.preventDefault()
  $('#custom-tabs-one-messages-tab').tab('show')
});

// new end

// Qualification adding old

 // $('.qualificationBox').on('click','.removeQualification', function(){
 //  console.log('removeQualification');
 //  $(this).closest('.qualification').remove();
 // });

 //  $('.qualificationBox').on('click','.addQualification', function(event){
 //    event.preventDefault();
 //    console.log('addQualification');

 //    var newQhtml = '<div class="qualificationList"><select name="qualification[]">';

 //    $('.qualificationList').append(newQhtml);
 // });

// Qualification adding old end here

   // Add Qualification Start Hassan


   $('.saveNewLocation').on('click',function() {
        event.preventDefault();
        var formData = $('.location_latlong :input').serializeArray();

        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
        $.ajax({
            type: 'POST',
            url: base_url+'/admin/ajax/addNewLocation',
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
data = {!! str_replace("'", "\'", json_encode(userLocation($record))) !!};
geocode(data);

jQuery('.filter_location_radius').on('change', function(){
    console.log(' filter_location_radius changed.  ');
    drawCircle(new google.maps.LatLng(jQuery("#location_lat").val(), jQuery("#location_long").val()));
});


var base_url = {!! json_encode(url('/')) !!};


  $(document).ready(function(){







   // $(document).on('click','.removeQualification', function(){
   //  $(this).closest('.QualificationSelect').remove();
   // });

   // For deleting old qual which was added by user
   $('.qualificationBox').on('click','.removeQualification', function(){
      console.log('removeQualification');
     $(this).closest('.QualificationSelect').remove();
   });


   $(document).on('click','.addQualification', function(){
    console.log(' addQualification ');




    // Add Qualification end here
    var newQualificationHtml = '<div class="QualificationSelect"><select name="qualification[]" class="qualificationSelectStyling">';
    @if(!empty($qualificationList))
        @foreach($qualificationList as $lk=>$qualification)
            newQualificationHtml += '<option value="{{$qualification['id']}}">{{$qualification['title']}}</option>';
        @endforeach
    @endif
    newQualificationHtml += '</select>';
    newQualificationHtml += '<span class="removeQualification  btn btn-danger">Remove</span>';
    newQualificationHtml += '</div>';
    $('.qualificationList').append(newQualificationHtml);
   });
 })

   // Add Qualification End
});

// For Scrolling to top start

function scrollToTop() {
      window.scrollTo(0, 0);
}

// For Scrolling to top end

$('#photo_add_video').on('click', function(){

var input = document.createElement('input');
var x = document.getElementById("formUserId").value;
input.type = 'file';
input.onchange = e => {
    var file = e.target.files[0];
    console.log(' onchange file  ', file);
    var formData = new FormData();
    formData.append('video', file);
    formData.append('userID', x);
    var item_id = Math.floor((Math.random() * 1000) + 1);
    var video_item = '';
    video_item += '<div id="v_'+item_id+'" >';
    video_item  +=  '<div class="progress">';
    video_item  += ' <div class="progress-bar" style="width:0%"></div>';
    video_item  += '</div>';
    video_item += '</div>';
    $('.videos').append(video_item);
    // $('#bar8').progressBar(0);
    var updateForm = document.querySelector('form');
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });


    // $.ajax({
    //         url: base_url+'/admin/ajax/uploadVideo1',
    //         type : 'POST',
    //         data : formData,
    //         processData: false,  // tell jQuery not to process the data
    //         contentType: false,  // tell jQuery not to set contentType
    //         success : function(resp) {
    //         if (resp.status == 1) {
    //             alert("success");
    //         // $('#v_'+item_id).replaceWith(resp.html);
    //         $('#modal'+resp.data.id).on('hidden.bs.modal', function (e) {
    //         // do something...
    //             var src = $(this).find(".videoBox video").find("source").attr('src');
    //             $(this).find(".videoBox video").find("source").attr('src');
    //             var videoElem  = '<video id="player" controls>';
    //             videoElem     += '<source src="'+src+'" type="video/mp4">';
    //             videoElem     += '</video>';
    //             $(this).find(".videoBox video").remove();
    //             $(this).find(".videoBox").html(videoElem);
    //         });
    //     } else {
    //         console.log(' video error ');
    //         if (resp.validator != undefined) {
    //             $('#v_'+item_id+' .error').removeClass('hide_it').addClass('to_show').text(res.validator['video'][0]);
    //         }
    //     }
	// 		       }
	// 		    });

    $.ajax({
    xhr: function() {
        var xhr = new window.XMLHttpRequest();

        xhr.upload.addEventListener("progress", function(evt) {
        if (evt.lengthComputable) {
            var percentComplete = evt.loaded / evt.total;
            percentComplete = parseInt(percentComplete * 100);
            console.log(percentComplete);
            $('.progress-bar').css('width', percentComplete+'%');
            if (percentComplete === 100) {

            }

        }
        }, false);

    return xhr;
  },
  url: base_url+'/admin/ajax/uploadVideo1',
  type: "POST",
  data:formData ,
  processData: false,  // tell jQuery not to process the data
  contentType: false,
  success: function(resp) {
    $('progress').remove();
    if (resp.status == 1) {
    $('#v_'+item_id).replaceWith(resp.html);

    $('#modal'+resp.data.id).on('hidden.bs.modal', function (e) {
            // do something...
                var src = $(this).find(".videoBox video").find("source").attr('src');
                $(this).find(".videoBox video").find("source").attr('src');
                var videoElem  = '<video id="player" controls>';
                videoElem     += '<source src="'+src+'" type="video/mp4">';
                videoElem     += '</video>';
                $(this).find(".videoBox video").remove();
                $(this).find(".videoBox").html(videoElem);
            });
    }
  }
});
}

input.click();
});


$('#photo_add_resume').on('click', function(){

var input = document.createElement('input');
var x = document.getElementById("formUserId").value;
input.type = 'file';
input.onchange = e => {
    var file = e.target.files[0];
    console.log(' onchange file  ', file);
    var formData = new FormData();
    formData.append('resume', file);
    formData.append('userID', x);
    var item_id = Math.floor((Math.random() * 1000) + 1);
    var video_item = '';
    video_item  +=  '<div class="progress">';
    video_item  += ' <div class="progress-bar" style="width:0%"></div>';
    video_item  += '</div>';

    $('.private_attachments').append(video_item);
    // $('#bar8').progressBar(0);
    var updateForm = document.querySelector('form');
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });


    // $.ajax({
    //         url: base_url+'/admin/ajax/uploadVideo1',
    //         type : 'POST',
    //         data : formData,
    //         processData: false,  // tell jQuery not to process the data
    //         contentType: false,  // tell jQuery not to set contentType
    //         success : function(resp) {
    //         if (resp.status == 1) {
    //             alert("success");
    //         // $('#v_'+item_id).replaceWith(resp.html);
    //         $('#modal'+resp.data.id).on('hidden.bs.modal', function (e) {
    //         // do something...
    //             var src = $(this).find(".videoBox video").find("source").attr('src');
    //             $(this).find(".videoBox video").find("source").attr('src');
    //             var videoElem  = '<video id="player" controls>';
    //             videoElem     += '<source src="'+src+'" type="video/mp4">';
    //             videoElem     += '</video>';
    //             $(this).find(".videoBox video").remove();
    //             $(this).find(".videoBox").html(videoElem);
    //         });
    //     } else {
    //         console.log(' video error ');
    //         if (resp.validator != undefined) {
    //             $('#v_'+item_id+' .error').removeClass('hide_it').addClass('to_show').text(res.validator['video'][0]);
    //         }
    //     }
	// 		       }
	// 		    });

    $.ajax({
    xhr: function() {
        var xhr = new window.XMLHttpRequest();

        xhr.upload.addEventListener("progress", function(evt) {
        if (evt.lengthComputable) {
            var percentComplete = evt.loaded / evt.total;
            percentComplete = parseInt(percentComplete * 100);
            console.log(percentComplete);
            $('.progress-bar').css('width', percentComplete+'%');
            if (percentComplete === 100) {

            }

        }
        }, false);

    return xhr;
  },
  url: base_url+'/admin/ajax/userUploadResume',
  type: "POST",
  data:formData ,
  processData: false,  // tell jQuery not to process the data
  contentType: false,
  success: function(data) {
    $('progress').remove();
    if(data && data.attachments) {
                    // data = JSON.parse(data);
                    // $('.view-resume').attr('href', '/talenttube/_files/resumeUpload/'+data['attachment']).show();
                    var attachments = data.attachments;
                    var attach_html = '';

                    if( attachments.length > 0 ){
                        for (let ai = 0; ai < attachments.length; ai++) {


                            attach_html += '<div class="attachment_'+attachments[ai].id+' attachment_file">';
                            attach_html +=   '<div class="attachment"><img src="'+base_url+'/images/site/icons/cv.png" /></div>';
                            attach_html +=   '<span class="attach_title">'+attachments[ai].name+'</span>';
                            attach_html +=   '<div class="attach_btns">';
                            attach_html +=      '<a class="attach_btn downloadAttachBtn btn btn-primary"  href="'+base_url+'/'+attachments[ai].file+'">Download</a>';
                            attach_html +=      '<a class="attach_btn downloadAttachBtn btn btn-primary" style="color: white;" data-attachmentid="'+attachments[ai].id+'" onclick="UProfile.deleteAttachment('+attachments[ai].id+');">Remvoe</a>';
                            attach_html +=    '</div>';
                            attach_html +=  '</div>';

                        }
                    }

                    $('.private_attachments').html(attach_html);


                }
  }
});
}

input.click();
});
</script>
<!-- added by Hassan -->
<script>
    @if ($videos->count() > 0 )
    @foreach ($videos as $video)

    $('#modal{{$video->id}}').on('hidden.bs.modal', function (e) {
  // do something...
        var src = $(this).find(".videoBox video").find("source").attr('src');
        $(this).find(".videoBox video").find("source").attr('src');
        var videoElem  = '<video id="player" controls>';
        videoElem     += '<source src="'+src+'" type="video/mp4">';
        videoElem     += '</video>';
        $(this).find(".videoBox video").remove();
        $(this).find(".videoBox").html(videoElem);
    });
    @endforeach
    @endif

</script>
@stop

@section('plugins.Datatables')

@stop


<!-- added by Hassan -->

<style>
    span.removeHobby,span.removeLang{
        cursor: pointer;
        /*float: right;*/
    }

    select , .bg-secondary{
        display: block;
        width: 100%;
        height: calc(2.25rem + 2px);
        padding: .375rem .75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        box-shadow: inset 0 0 0 transparent;
        transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }

div.langSelect>select, div.hobbySelect>select {
    width: 88%;
    float: left;
    margin-bottom: 16px;
    margin-right: 27px;
}

@media only screen and (max-width: 1409px) {
  div.langSelect>select, div.hobbySelect>select {
    width: 100%;
    margin-bottom: 16px;
  }
}

.btn-danger{
    margin-bottom: 16px;
}
.userimg{
  height: 160px;
  width: 160px;
}

.photo{
    width: 100px;
    height: 110px;
    margin-right: 10px;
    margin-bottom: 10px;
}

.imagesAdmin{

    margin-top:30px;
}

.imageSizeModal{

    width: 200px;
    height: 210px;
}

.showinline{
    display:inline-block;
}
</style>

<!-- added by Hassan -->
