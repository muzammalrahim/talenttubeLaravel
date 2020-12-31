@extends('adminlte::page')

@section('title',$title)

@section('content_header')
<div class="block row">
    <div class="col-md-3"><h1 class="m-0 text-dark">{{$content_header}}</h1></div>


     {{-- <div class="block row col-md-5 text-white"> --}}
      {{-- <div class="col-md-5">
        <select class="filter_status browser-default custom-select">
            <option value="">Select Status</option>
            <option value="verified" {!! ($filter_status == 'verified')?('selected'):'' !!}>Approved</option>
            <option value="pending" {!! ($filter_status == 'pending')?('selected'):'' !!}>Pending</option>
        </select>
      </div> --}}

      {{-- <div class="col-md-2"><a class="btn btn-block btn-primary btnBulkApproved">Bulk Approved</a></div>
      <div class="col-md-2"><a class="btn btn-block btn-primary btnBulkPDFGenerate">Bulk Compile CV</a></div>
      <div class="col-md-2"><a class="btn btn-block btn-primary btnBulkCSVExport">Bulk Export CSV</a></div>
      --}}
    {{-- </div> --}}

    {{-- <div class="col-md-4">
        <div class="float-right">
            <a href="{!! route('employers.create') !!}" class="btn btn-block btn-success">Add New</a>
        </div>
    </div> --}}
</div>
@stop

@section('content')

<table class="table table-bordered" id="dataTable">
    <thead>
        <tr style = "text-align: center">
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            {{-- <th>Profile</th> --}}
            <th>Created_at</th>
            <th>Action</th>
            {{-- <th>delete</th> --}}
        </tr>
    </thead>
  </table>

@stop

@section('css')
    <link rel="stylesheet"  href="{{ asset('css/admin_custom.css') }}">

    <style type="text/css">

        .modal.showProcessing  .modalContentEmp{
         display: none;

        }

        .modal.showProcessing  .modelProcessingEmp{
            display: block !important;
        }

        #delConfirmIdEmp{
            color:red;
        }

        td{
          text-align: center;
        }
    </style>

@stop

@section('plugins.Datatables')

@stop

@section('js')

<script type="text/javascript">
	var APP_URL = {!! json_encode(url('/')) !!}
</script>

<script src="{{ asset('js/admin_custom.js') }}"></script>
<script src="{{asset('js/admin_employerdelete.js')}}"></script>

<script>
jQuery(function() {
  jQuery('#dataTable').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
          url: '{!! route('Cemp.dataTable') !!}',
          data: function (d) {
                d.status = $('.filter_status').val()
            }
        },
      columns: [
          { data: 'id', name: 'id' },
          { data: 'name', name: 'name' },
          { data: 'email', name: 'email' },
          // { data: 'profile', name: 'profile' },
          { data: 'created_at', name: 'created_at' },
          { data: 'action', name: 'action', },
          // { data: 'action', name: 'action', },
      ]
  });

//========================================================================//
// Change filter_status append value to url
//========================================================================//



});
</script>
@stop
