@extends('adminlte::page')

@section('title',$title)

@section('content_header')
@stop

@section('content')

<div class="container">

    @include('admin.errors',[ 'error' => $errors, 'record' => $record ])

        {!! Form::open(array('url' => route('bulkEmail.store'), 'method' => 'POST', 'files' => true, 'name'=>'formJob', 'novalidate'=>'')) !!}

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5"><h4 class="card-title mb-0"><small class="text-muted">Create Bulk Email</small></h4></div>
            </div>
            <hr>
            <div class="row mt-4 mb-4">
                <div class="col">

                    <div class="form-group row">
                        {{ Form::label('title', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                          {{ Form::text('title', null , $attributes = array('class'=>'form-control', 'placeholder' => 'title','required'=> 'true')) }}
                        </div>
                    </div>

                     <div class="form-group row country_dd">
                        {{ Form::label('content', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                         <textarea class="" name="content"></textarea>
                        </div>
                    </div>

                    {{-- @dd($jobSeekers) --}}

                    <div class="form-group row">
                        {{ Form::label('Users', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                        <select name="user_ids[]" multiple class="form-control">
                            @foreach ($jobSeekers as $js)
                                <option value="{{$js->id}}">{{$js->name.' '.$js->email}}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>


                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col"><a class="btn btn-danger btn-sm" href=" {{ url()->previous() }}">Cancel</a></div>
                <div class="col text-right"><button class="btn btn-success btn-sm pull-right" type="submit">Save</button></div>
            </div>
        </div><!--card-footer-->

    </div><!--card-->

    {!! Form::close() !!}

</div>

@stop

@section('css')
<link rel="stylesheet"  href="{{ asset('css/admin_custom.css') }}">
<link rel="stylesheet"  href="{{ asset('css/multi-select.css') }}">
<style>
textarea { width: 100%; }
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
@stop

@section('js')
    <script src="{{ asset('js/admin_custom.js') }}"></script>
    <script src="{{ asset('js/jquery.multi-select.js') }}"></script>

{{-- country city state --}}
<script type="text/javascript">
$(document).ready(function(){
    // $('.multiSelectBox').multiSelect();
});
</script>
{{-- country state city--}}
    <!-- added by Hassan -->
    <script type="text/javascript"> var base_url = '{!! url('/') !!}';</script>
@stop

@section('plugins.Datatables')

@stop


