{{-- @extends('site.user.usertemplate') --}}
@extends('site.employer.employermaster')

@section('custom_css')
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
@stop

@section('content')
<div class="jobApplicationCont">
    <div class="head icon_head_browse_matches">JobSeeker Application Submitted</div>

    <div class="job_applications_filter mb20">
   
    {{ Form::open(array('url' => url()->current(), 'method' => 'get', 'id' => 'job_applications_filter_form' )) }}
        <input type="hidden" name="page" id="paginate" value="">
        <input type="hidden" name="job_id" value="{{$job->id}}">

        <div class="searchField_qualification mb10">
            <div class="searchFieldLabel dinline_block">Qualification: </div>
            <select class="dinline_block filter_qualification_type" name="ja_filter_qualification_type" data-placeholder="Select Qalification & Trades">
                 <option value="">Select Qalification & Trades</option>
                 <option value="certificate">Certificate or Advanced Diploma</option>
                 <option value="trade">Trade Certificate</option>
                 <option value="degree">University Degree</option>
                 <option value="post_degree">University Post Graduate (Masters or PHD)</option>
            </select>

            @php ($qualifications = getQualificationsList())
            @if(!empty($qualifications))
            <div class="filter_qualificaton_degree">
                <ul class="qualification_ul item_ul dot_list">
                    @foreach ($qualifications as $qualif)
                        <li class="{{$qualif['type']}}" data-id="{{$qualif['id']}}" data-type="ja_filter_qualification[]">
                            <span>{{$qualif['title']}}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>

        <div class="searchField_salaryRange dblock mb10">
            <div class="searchFieldLabel dinline_block">Salary Range: </div>
            <select name="ja_filter_salary" class="dinline_block" data-placeholder="Select Salary Range">
                 <option value="">Select Salary Range</option>
                @foreach(getSalariesRange() as $sk => $salary)
                    <option value="{{$sk}}">{{$salary}}</option>
                @endforeach
            </select>
        </div>

        <div class="searchField_industry mb10">
            <div class="searchFieldLabel dinline_block">Filter by Industry: </div>
            <div class="toggleSwitchButton dinline_block"><label class="switch"><input type="checkbox" name="filter_industry_status"></label></div>
            {{-- industry selection --}}
            <div class="filter_industryList hide_it">
                @php ($industries = getIndustries())
                @if(!empty($industries))
                <div class="filter_industries_list ">
                    <ul class="industries_ul item_ul dot_list">
                        @foreach ($industries as $indK => $indV)
                            <li class="" data-id="{{$indK}}" data-type="filter_industry[]"><span>{{$indV}}</span></li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
            {{-- industry selection --}}        
        </div>

       

        <div class="searchField_location mb10">
            <div class="searchFieldLabel dinline_block">Filter by Location: </div>
            <div class="search_location_status_cont toggleSwitchButton"><label class="switch"><input type="checkbox" name="filter_location_status"></label></div>
            {{-- bl_location --}}
            <div class="location_search_cont hide_it">
                <div class="location_input dtable w100">
                    <input type="text" name="location_search" class="inp w80 fl_left" id="location_search" value="" placeholder="Type a location" aria-invalid="false">
                    <select class="dinline_block filter_location_radius select_aw" name="filter_location_radius" data-placeholder="Select Location Radius">
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
                </div>
                <div class="location_map_box dtable w100"><div class="location_map" id="location_map"></div></div>
            </div>
            {{-- bl_location --}}        
        </div>


        <div class="searchField_questions mb10">
            <div class="searchFieldLabel dinline_block">Filter by Question: </div>
            <div class="toggleSwitchButton dinline_block"><label class="switch"><input type="checkbox" name="filter_by_questions"></label></div>
            <div class="filter_question_cont hide_it">
                 <div class="questionFilter">
                 @if(varExist('questions', $job))
                 @foreach ($job->questions as $qkey =>  $jq)
                    <div class="jobFilterQuestion">
                        <span class="fjq_counter">Question {{($qkey+1)}}: </span>
                        <span class="fjq_title">{{$jq->title}}</span>
                        <div class="fjq_options">
                            @if($jq->options)
                            <select class="filter_question select_aw" name="filter_question[{{$jq->id}}]" >
                                <option value="">Select</option>
                                @foreach ($jq->options as $qk => $jqopt)
                                    <option value="{{$jqopt}}">{{$jqopt}}</option>
                                @endforeach
                            </select>
                            @endif
                        </div>
                    </div>
                 @endforeach
                 @endif
                 </div>
            </div>
        </div>

        <div class="searchField_keyword dblock mb10">
            <div class="searchFieldLabel dinline_block">Keyword: </div>
            <input type="text" name="ja_filter_keyword">
        </div>

        <div class="searchField_sortBy dblock mb10">
            <div class="sortByFieldLabel dinline_block">Sort By: </div>
            <select name="ja_filter_sortBy">
              <option value="goldstars">Gold Stars</option>
              <option value="applied">Applied</option>
              <option value="inreview">In Review</option>
              <option value="interview">Interview</option>
              <option value="unsuccessful">Unsuccessful</option>
              <option value="all_candidates">All candidates</option>
            </select>
        </div>
        
        <div class="searchField_action">
            <div class="searchFieldLabel dinline_block"></div>
            <button class="btn small OrangeBtn">Submit</button>
        </div>

    {{ Form::close() }}
    </div>

    <div class="job_applications"></div>

 
</div>

{{-- <div style="display:none;">
    <div id="confirmJobDeleteModal" class="modal p0 confirmJobDeleteModal wauto">
        <div class="pp_info_start pp_alert pp_confirm pp_cont" style="left: 0px; top: 0px; margin: 0;">
            <div class="cont">
                <div class="title">Delete Job?</div>
                <div class="img_chat">
                    <div class="icon">
                        <img src="{{asset('/images/site/icons/icon_pp_sure.png')}}" height="48" alt="">
                    </div>
                    <div class="msg">This action can not be undone. Are you sure you wish to continue?</div>
                </div>
                <div class="double_btn">
                    <button class="confirm_close btn small dgrey" onclick="UProfile.cancelGalleryConfirm(); return false;">Cancel</button>
                    <button class="confirm_jobDelete_ok btn small marsh">OK</button>
                    <input type="hidden" name="deleteConfirmJobId" id="deleteConfirmJobId" value=""/>
                    <div class="cl"></div>
                </div>
            </div>
        </div>
    </div>
    </div> --}}


@stop



@section('custom_js')
<script src="{{ asset('js/site/jquery.modal.min.js') }}"></script>
<script src="{{ asset('js/site/jquery-ui.js') }}"></script>
<script src="{{ asset('js/site/common.js') }}"></script> 

<script type="text/javascript">
$(document).ready(function() {

    console.log(' new job doc ready ');
    // trigger date picker. 
    $(".datepicker").datepicker({ dateFormat: "yy-mm-dd" });

    // job Delete confirmation modal popup open. 
    $('.myJobDeleteBtn').on('click',function(){
        var job_id = $(this).attr('data-jobid');
        console.log(' confirmJobAppRemoval click  job_id ', job_id, $(this) );
        $('#confirmJobDeleteModal').modal({
            fadeDuration: 200,
            fadeDelay: 2.5,
            escapeClose: false,
            clickClose: false,
        });
        $('#deleteConfirmJobId').val(job_id);
    });

    // confirmation job delete ok trigger. 
    $(document).on('click','.confirm_jobDelete_ok',function(){
        $('.confirmJobDeleteModal  .img_chat').html(getLoader('jobDeleteloader'));
        $(this).prop('disabled',true);
        var job_id =  $('#deleteConfirmJobId').val();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/deleteJob/'+job_id,
            success: function(data){
                if( data.status == 1 ){
                    $('.confirmJobDeleteModal .img_chat').html(data.message);
                    $('.job_row.job_'+job_id).remove();
                }else{
                    $('.confirmJobDeleteModal .img_chat').html(data.error);
                }
            }
        });
    });

    // Show Job Application Question Answers. 
    $(document).on('click','.ja_load_qa',function(){
        var job_app_id = $(this).attr('data-appid');
        $(this).html(getLoader('jobDeleteloader'));
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'GET',
            url: base_url+'/ajax/getJobAppQA/'+job_app_id,
            success: function(data){
                $('.job_app_'+job_app_id+' .job_app_qa_box').html(data).show();
                $('.job_app_'+job_app_id+' .ja_load_qa').remove();
            }
        });
    });

    // Top Filter form submit load data throug ajax. 
    $('#job_applications_filter_form').on('submit',function(event){
        console.log(' job_applications_filter_form submit '); 
        event.preventDefault();
        $('#paginate').val('');
        getData();
    });
    
    // Bottom pagination load data throug ajax. 
    $(document).on('click','.job_pagination .page-item .page-link',function(e){
        console.log(' page-link click ', $(this) ); 
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        $('#paginate').val(page);
        getData();
    });

    // change job application status, send ajax. 
    $(document).on('change','select.jobApplicStatus',function(e){
        console.log(' jobApplicStatus change ', $(this)); 
        var statusElem = $(this); 
        var status = $(this).val(); 
        var application_id = $(this).attr('data-application_id'); 
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/changeJobApplicationStatus',
            data: {status: status, application_id: application_id},
            success: function(data){
                var jobAppStatusHtml = '<span class="jobApplicationStatusResponse">Updated Succesfully</span>'; 
                statusElem.closest('.jobApplicationStatusCont').append(jobAppStatusHtml);
                setTimeout(function(){  
                  statusElem.closest('.jobApplicationStatusCont').find('.jobApplicationStatusResponse').remove();
                },1500);
            }
        });
    });

    // function to send ajax call for getting data throug filter/Pagination selection. 
    var getData = function(){
        var url = '{{route('jobAppFilter')}}';
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.post(url, $('#job_applications_filter_form').serialize(), function(data){
            $('.job_applications').html(data);
            $('.jobApplicationStatusCont select').styler({ selectSearch: true,});
        });
    }
    
    // initially when page load trigger the ajax call to get data. 
    getData();

    formStyler =  function(){
      $('#job_applications_filter_form input, #job_applications_filter_form select').styler({ selectSearch: true,});
    } 



//====================================================================================================================================//
// Enable/Disabled Filtering by Questions.
//====================================================================================================================================//
$('input[name="filter_by_questions"]').change(function() {
    console.log(' filter_by_questions '); 
    (this.checked)?(jQuery('.filter_question_cont').removeClass('hide_it')):(jQuery('.filter_question_cont').addClass('hide_it'));  
     // $('input, select').styler({ selectSearch: true, });
});



//====================================================================================================================================//
// Enable/Disabled Filtering by google map location.
//====================================================================================================================================//
$('input[name="filter_location_status"]').change(function() {
    console.log(' filter_location_status '); 
    (this.checked)?(jQuery('.location_search_cont').removeClass('hide_it')):(jQuery('.location_search_cont').addClass('hide_it'));  
});


//====================================================================================================================================//
// Function to display sub qualification on base of qualification type. 
//====================================================================================================================================//
// $(document).on('change','select[name="ja_filter_qualification_type"]',function() {
//     var degreeType =  $(this).val();
//      if (degreeType != ''){ degreeType = (degreeType == 'trade')?'trade':'degree';}
//      $(this).closest('.searchField_qualification').attr('class','searchField_qualification '+degreeType);
//      $('.dot_list li').removeClass('active');
//      $('.searchField_qualification .dot_list_li_hidden').remove();
// });
// $(document).on('click','.dot_list li', function(){
//     console.log(' dot_list li click '); 
//     if($(this).hasClass('active')){
//         $(this).removeClass('active');
//         $(this).find('.dot_list_li_hidden').remove();
//     }else{
//         $(this).addClass('active');
//         var type = $(this).attr('data-type'); 
//         var qualif_value = $(this).attr('data-id');
//         var input_hidden_html = '<input type="hidden" class="dot_list_li_hidden" name="'+type+'" value="'+qualif_value+'" />'; 
//         $(this).append(input_hidden_html);
//     }
   
// });





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
                    // updateLocationInputs(place.name,city,state,country);
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
                    // updateLocationInputs('',city,state,country);
                    jQuery("#location_search").val(address);
                    placeMarker(location);
                    return true;
                }
            })
        }
        return false;
    }

    // function updateLocationInputs(place,city,state,country){
    //     jQuery('#location_name').val(place);
    //     jQuery('#location_city').val(city);
    //     jQuery('#location_state').val(state);
    //     jQuery('#location_country').val(country);
    // }

    // by default show this location; 
    geocode('Sydney New South Wales, Australia');


    jQuery('.filter_location_radius').on('change', function(){
        console.log(' filter_location_radius changed.  '); 
        drawCircle(new google.maps.LatLng(jQuery("#location_lat").val(), jQuery("#location_long").val()));    
    }); 




});
</script>
@stop



@section('custom_footer_css')
<link rel="stylesheet" href="{{ asset('css/site/profile.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}">
{{-- <link rel="stylesheet" href="{{ asset('css/site/gallery_popup/magnific-popup.css') }}"> --}}
{{-- <link rel="stylesheet" href="{{ asset('css/site/gallery_popup/lc_lightbox.css') }}"> --}}
<style type="text/css">
button.ja_load_qa { background: #40c7db; }
.job_app_qa_box {
    padding: 10px;
    border: 1px solid rgba(0,0,0,0.1);
    border-radius: 4px;
    margin: 10px 0px;
}
.job_answers { margin-bottom: 6px; }
.jqa_q {
    margin: 2px 0px;
    display: inline-block;
}
.jqa_a {
    margin: 2px 0px;
    display: inline-block;
    font-weight: bold;
    color: #eea11e;
}
.searchFieldLabel { min-width: 15%; }
.searchField { display: inline-block; }

.jobFilterQuestion {margin: 10px 0px;}
.jobFilterQuestion .fjq_title {
        display: inline-block;
    float: left;
    padding: 0px 8px;
    background: rgb(0 0 0 / 3%);
    border: 1px solid rgb(0 0 0 / 11%);
    height: 33px;
    line-height: 33px;
}

.jobFilterQuestion .fjq_counter {
    float: left;
    padding: 0px 8px; 
    border: 1px solid rgb(0 0 0 / 11%);
    height: 33px;
    line-height: 33px;
    border-right: 0px;
}

.location_map {
    height: 250px;
    margin: 2px;
    border-radius: 4px;
}
.jobApplicAction {
    display: inline-block;
    float: right;
    margin: 10px 0px;
}
.jobApplicationStatusCont .jq-selectbox__select, 
.jobApplicationStatusCont .jq-selectbox__trigger {
    height: 28px;
    line-height: 28px;
}
.jobApplicationStatusResponse {
    display: block;
    position: absolute;
    font-size: 11px;
    margin: 6px;
    color: #fba82f;
}
.sortByFieldLabel.dinline_block {
    margin-right: 88px;
}
</style>

@stop