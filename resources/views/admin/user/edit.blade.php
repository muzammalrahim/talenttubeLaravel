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
<script src="{{ asset('js/site/userProfile.js') }}"></script>




<script type="text/javascript">
// add and remove languages code
$(document).ready(function(){
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
<script type="text/javascript">

// add and remove languages code

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

</script>
<!-- added by Hassan -->

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
</style>

<!-- added by Hassan -->
