@extends('adminlte::page')

@section('title',$title)

@section('content_header')

<div class="block row">
    <div class="col-md-6"><h1 class="m-0 text-dark">{{$content_header}}</h1></div>
    <div class="col-md-6">
        <div class="float-right">
            <a href="{!! route('users.create') !!}" class="btn btn-block btn-success">Add New</a>
        </div>
    </div>
</div>

@stop


{{-- @include('admin.errors',[ 'error' => $errors, 'record' => $record ]) --}}

@section('content')

@include('admin.errors')
@include('admin.success')

<table class="table table-bordered" id="dataTable">
    <thead>
        <tr>
            <th>id.</th>
            <th>name</th>
            <th>email</th>
            <th>created_at</th>
            <th>action</th>
        </tr>
    </thead>
  </table>


@stop


@section('css')
    <link rel="stylesheet"  href="{{ asset('css/admin_custom.css') }}">
@stop



@section('plugins.Datatables') @stop


@section('js')
<script src="{{ asset('js/admin_custom.js') }}"></script>
<script>
    jQuery(function() {
        jQuery('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('users.dataTable') !!}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'created_at', name: 'created_at' },
                { data: 'action', name: 'action' }
            ]
        });
    });
</script>
@stop
