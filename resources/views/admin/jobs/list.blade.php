@extends('adminlte::page')

@section('title',$title)

@section('content_header')

<div class="block row">
    <div class="col-md-6"><h1 class="m-0 text-dark">{{$content_header}}</h1></div>
    <div class="col-md-6">
        <div class="float-right">
            <a href="{!! route('jobs.create') !!}" class="btn btn-block btn-success">Add New</a>
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
            <th>title</th>
            <th>country</th>
            <th>state</th>
            <th>city</th>
            <th>experience</th>
            <th>created_at</th>
            {{-- <th>created_by</th> --}}
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
            ajax: '{!! route('jobs.dataTable') !!}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'title', name: 'title' },
                // { data: 'description', name: 'description' },
                // { data: 'type', name: 'type' },
                { data: 'country', name: 'country' },
                { data: 'state', name: 'state' },
                { data: 'city', name: 'city' },
                { data: 'experience', name: 'experience' },
                { data: 'created_at', name: 'created_at' },
                // { data: 'created_by', name: 'created_by' },
                { data: 'action', name: 'action' },
            ]
        });
    });
</script>
@stop
