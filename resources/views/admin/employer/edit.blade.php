@extends('adminlte::page')

@section('title',$title)

@section('content_header')
@stop



@section('content')

<div class="container">

    @if ($record)
        {!! Form::model($record, array('url' => route('employers.update',['id' => 2]), 'method'=>'PATCH', 'files' => true, 'name'=>'formUser', 'novalidate'=>'')) !!}
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
                            {{ Form::text('id', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Id','required'=> 'false')) }}
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


