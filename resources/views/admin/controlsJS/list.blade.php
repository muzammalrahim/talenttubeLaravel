@extends('adminlte::page')

@section('title',$title)

@section('content_header')

<div class="block row">
    <div class="col-md-3"><h1 class="m-0 text-dark">{{$content_header}}</h1></div>
</div>


@stop


{{-- @include('admin.errors',[ 'error' => $errors, 'record' => $record ]) --}}

@section('content')

@include('admin.errors')
@include('admin.success')

<table class="table table-bordered cbxDataTable" id="dataTable">
    <thead>
        <tr style = "text-align: center">
            <th>ID</th>
            <th>Name</th>
            {{-- <th><input name="select_all" value="1" id="cbx_all" type="checkbox" /></th> --}}
            <th>Surname</th>
            <th>city</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Created_at</th>
            {{-- <th>profile</th> --}}
            {{-- <th>View Video</th> --}}
            {{-- <th>View Resume</th> --}}
            <th>Action</th>

        </tr>
    </thead>
  </table>


@stop


@section('css')
<link rel="stylesheet"  href="{{ asset('css/admin_custom.css') }}">

<style type="text/css">
    td{ text-align: center; }
    
</style>
@stop



@section('plugins.Datatables') @stop


@section('js')
<script src="{{ asset('js/admin_custom.js') }}"></script>
<script type="text/javascript">
    var base_url = '{!! url('/') !!}';
</script>
<script>




jQuery(function() {

    var table = jQuery('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: '{!! route('CJS.dataTable') !!}',
          data: function (d) {
                d.status = $('.filter_status').val()
            }
        },
        // ajax: '{!! route('users.dataTable') !!}',
        // data: function (d) {
        //         d.status = $('.filter_status').val(),
        // },
        columns: [
            // { data: 'select', name: 'select' },
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'surname', name: 'surname' },
            { data: 'city', name: 'city' },
            { data: 'email', name: 'email' },
            { data: 'phone', name: 'phone' },
            { data: 'created_at', name: 'created_at' },
            // { data: 'profile', name: 'profile' },
            // { data: 'videoInfo', name: 'videoInfo' },
            // { data: 'resume', name: 'resume' },
            { data: 'action', name: 'action' }
        ],

    });





});
</script>
@stop
