@extends('adminlte::page')

@section('title',$title)

@section('content_header')
@stop

@section('content')

<div class="container">
    @include('admin.errors',[ 'error' => $errors, 'record' => $record ])
    @if ($record)
        {!! Form::model($record, array('url' => route('jobs.update',['id' => $record->id]), 'method'=>'PATCH', 'files' => true, 'name'=>'formUser', 'novalidate'=>'')) !!}
    @else
        {!! Form::open(array('url' => route('jobs.store'), 'method' => 'POST', 'files' => true, 'name'=>'formJob', 'novalidate'=>'')) !!}
    @endif
    
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5"><h4 class="card-title mb-0">{{ __('Job Management') }} <small class="text-muted">Edit Jobs</small></h4></div>
            </div>
            <hr>
            <div class="row mt-4 mb-4">
                <div class="col">

                    {{-- Adding Tab Start --}}

          <div class="col-12 col-sm-6 col-lg-12">
            <div class="card card-primary card-tabs">
              
              <div class="card-header p-0 pt-1 tabColor"style="background: #6c757d;">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">

                  <li class="nav-item col-lg-6">
                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true"><b>Job Information</b></a>
                  </li>

                  <li class="nav-item col-lg-6">
                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false"><b>Job Questions</b></a>
                  </li>

              {{--     <li class="nav-item col-lg-3">
                    <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false"><b>Questions</b></a>
                  </li>

                  <li class="nav-item col-lg-3">
                    <a class="nav-link" id="custom-tabs-one-private-tab" data-toggle="pill" href="#custom-tabs-one-private" role="tab" aria-controls="custom-tabs-one-private" aria-selected="false"><b>Private Gallery</b></a>
                  </li> --}}

                </ul>
              </div>

              <div class="card-body">
                  
                <div class="tab-content" id="custom-tabs-one-tabContent">

                  @include('admin.jobs.tabs.tab1')
                  @include('admin.jobs.tabs.tab2')
                  
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

{{-- country city state --}}
<script type="text/javascript">
    $(document).ready(function(){
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


  // Next and Previous tab button start
 $('#custom-tabs-one-home .btnNext').on('click', function (e) {
  e.preventDefault()
  $('#custom-tabs-one-profile-tab').tab('show')
});

 $('#custom-tabs-one-profile .btnPrevious').on('click', function (e) {
  e.preventDefault()
  $('#custom-tabs-one-home-tab').tab('show')
});



  // Next and Previous tab button start

}); 

// For Scrolling to top start

   function scrollToTop() { 
          window.scrollTo(0, 0); 
      } 

// For Scrolling to top end

</script>
{{-- country state city--}}

    <!-- added by Hassan -->
    <script type="text/javascript"> var base_url = '{!! url('/') !!}';</script>
@stop

@section('plugins.Datatables')

@stop


<style>
    
    select{
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

</style>