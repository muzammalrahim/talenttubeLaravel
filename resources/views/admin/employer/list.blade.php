@extends('adminlte::page')

@section('title',$title)

@section('content_header')
<h1 class="m-0 text-dark">{{$content_header}}</h1>
@stop

@section('content')

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

@section('plugins.Datatables')

@stop


@section('js')
<script>
    jQuery(function() {
        jQuery('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('employers.dataTable') !!}',
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
