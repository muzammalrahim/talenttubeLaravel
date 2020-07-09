@extends('adminlte::page')

@section('title',$title)

@section('content_header')
@stop

@section('content')

<div class="container">

    @include('admin.errors',[ 'error' => $errors, 'record' => $record ])

    {{--
    @dump( $errors )
    @dump( $errors->has('title') )
    @dump( $errors->get('title')[0] )
    @dump( $errors->getBag('title')   ) 
   
    @if($errors->has('title'))
        <div class="error">{{ $errors->first('title') }}</div>
    @endif

    @error('title')
        <div class="error">{{ $message }}</div>
    @enderror
    --}}


    @if ($record->id)
        {!! Form::model($record->id, array('url' => route('jobs.update',['id' => $record->id]), 'method'=>'PATCH', 'files' => true, 'name'=>'formUser', 'novalidate'=>'')) !!}
    @else
        {!! Form::open(array('url' => route('jobs.edit'), 'method' => 'POST', 'files' => true, 'name'=>'formUser', 'novalidate'=>'')) !!}
    @endif
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5"><h4 class="card-title mb-0">{{ __('admin.jobs.edit_job') }} <small class="text-muted">Edit Jobs</small></h4></div>
            </div>
            <hr>
            <div class="row mt-4 mb-4">
                <div class="col">

                    <div class="form-group row">
                          {{ Form::label('ID', null, ['class' => 'col-md-2 form-control-label']) }}
                          <div class="col-md-10">
                            {{ Form::text('id', $value = $record->id, $attributes = array('class'=>'form-control', 'placeholder' => 'Id','required'=> 'false','disabled'=> true)) }}
                          </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('Job Title', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                          {{ Form::text('title', $value = $record->title , $attributes = array('class'=>'form-control', 'placeholder' => 'name','required'=> 'false')) }}
                        </div>
                    </div>
                
                     <div class="form-group row country_dd">
                        {{ Form::label('country', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                        {{ Form::select('country', $countries, $record->country, ['placeholder' => 'Select Country']) }}
                        </div>
                    </div>

                     <div class="form-group row state_dd">
                        {{ Form::label('state', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                            {{ Form::select('state', $states, $record->state, ['placeholder' => 'Select state']) }}
                        </div>
                    </div>

                    <div class="form-group row city_dd">
                        {{ Form::label('city', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                        {{ Form::select('city', $cities, $record->city, ['placeholder' => 'Select city']) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('Gender', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                          {{ Form::text('gender', $value = $record->gender, $attributes = array('class'=>'form-control', 'placeholder' => 'Gender','required'=> 'false')) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('Experience', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                          {{ Form::text('experience', $value = $record->experience , $attributes = array('class'=>'form-control', 'placeholder' => 'Experience','required'=> 'false')) }}
                        </div>
                    </div>

                    <div class="form-group row ">
                        {{ Form::label('Job Type', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                        {{ Form::select('job_type', $job_type, $record->job_type, ['placeholder' => 'Job Type']) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('Expiration', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                          {{ Form::text('expiration', $value = $record->expiration , $attributes = array('class'=>'form-control', 'placeholder' => 'Expiration','required'=> 'false')) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('Created At', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                          {{ Form::text('created_at', $value = $record->created_at , $attributes = array('class'=>'form-control', 'placeholder' => 'Created At','required'=> 'false')) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('created_by', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                        {{ Form::select('employers', $employers, $record->employers, ['placeholder' => 'Select employers']) }}
                        </div>
                    </div>

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

@section('plugins.Datatables')

@stop

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
}); 
</script>

{{-- country state city --}}

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