@extends('adminlte::page')

@section('title',$title)

@section('content_header')
@stop



@section('content')

<div class="container">

    @if ($record)
        {!! Form::model($record, array('url' => route('employers.update',['id' => $record->id]), 'method'=>'PATCH', 'files' => true, 'name'=>'formUser', 'novalidate'=>'')) !!}
    @else
        {!! Form::open(array('url' => route('employers.create'), 'method' => 'POST', 'files' => true, 'name'=>'formUser', 'novalidate'=>'')) !!}
    @endif



    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5"><h4 class="card-title mb-0">{{ __('admin.admin.user_management') }} <small class="text-muted">Edit User</small></h4></div>
            </div>
            <hr>
            <div class="row mt-4 mb-4">
                <div class="col">

                    <div class="form-group row">
                          {{ Form::label('ID', null, ['class' => 'col-md-2 form-control-label']) }}
                          <div class="col-md-10">
                            {{ Form::text('id', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Id','required'=> 'false','disabled'=> true)) }}
                          </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('name', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                          {{ Form::text('name', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'name','required'=> 'false')) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('email', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                          {{ Form::text('email', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'email','required'=> 'false')) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('password', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                          {{ Form::text('password', '' , $attributes = array('class'=>'form-control', 'placeholder' => 'password','required'=> 'false')) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('phone', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                          {{ Form::text('phone', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Phone','required'=> 'false')) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('country', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                          {{ Form::text('country', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Country','required'=> 'false')) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('state', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                          {{ Form::text('state', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'State','required'=> 'false')) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('city', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                          {{ Form::text('city', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'City','required'=> 'false')) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('age', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                          {{ Form::text('age', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Age','required'=> 'false')) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('bday', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                          {{ Form::text('bday', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Bday','required'=> 'false')) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('bmonth', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                          {{ Form::text('bmonth', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Birthday Month','required'=> 'false')) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('byear', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                          {{ Form::text('byear', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Birthday Year','required'=> 'false')) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('statusText', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                          {{ Form::text('statusText', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Status Text','required'=> 'false')) }}
                        </div>
                    </div>

                     <div class="form-group row">
                        {{ Form::label('gender', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                          {{ Form::text('gender', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'gender','required'=> 'false')) }}
                        </div>
                    </div>

                     <div class="form-group row">
                        {{ Form::label('eye', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                          {{ Form::text('eye', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Eye','required'=> 'false')) }}
                        </div> 
                    </div>

                     <div class="form-group row">
                        {{ Form::label('family', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                          {{ Form::text('family', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Family','required'=> 'false')) }}
                        </div> 
                    </div>

                    <div class="form-group row">
                        {{ Form::label('education', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                          {{ Form::text('education', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Education','required'=> 'false')) }}
                        </div> 
                    </div>

                    <div class="form-group row">
                        {{ Form::label('language', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                          {{ Form::text('lang', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Language','required'=> 'false')) }}
                        </div> 
                    </div>

                    <div class="form-group row">
                        {{ Form::label('hobbies', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                          {{ Form::text('hobbies', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Hobbies','required'=> 'false')) }}
                        </div> 
                    </div>

                    <div class="form-group row">
                        {{ Form::label('about_me', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                          {{ Form::text('about_me', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'About me','required'=> 'false')) }}
                        </div> 
                    </div>

                    <div class="form-group row">
                        {{ Form::label('interested_in', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                          {{ Form::text('interested_in', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Interested in ','required'=> 'false')) }}
                        </div> 
                    </div>

                   

                    <div class="form-group row">
                        {{ Form::label('questions', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                          {{ Form::text('questions', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Questions','required'=> 'false')) }}
                        </div> 
                    </div>

                    <div class="form-group row">
                        {{ Form::label('created_at', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                          {{ Form::text('created_at', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Created At','required'=> 'false')) }}
                        </div> 
                    </div>

                    <div class="form-group row">
                        {{ Form::label('updated_at', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                          {{ Form::text('updated_at', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Updated At','required'=> 'false')) }}
                        </div> 
                    </div>

                    <div class="form-group row">
                        {{ Form::label('credit', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                          {{ Form::text('credit', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Credit','required'=> 'false')) }}
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

@section('plugins.Datatables')

@stop


