@extends('adminlte::page')

@section('title',$title)

@section('content_header')

<div class="block row">
    <div class="col-md-6"><a href=" {{url()->previous()}} " class="seeCompletedReference"><h1 class="m-0 text-dark">{{$content_header}}</h1></a></div>



    <div class="block row col-md-6 text-white">


      {{-- <div class="col-md-1.5 bulkButton"><a class="btn btn-block btn-primary btnBulkApproved" style="margin-right: 5px;">Bulk Assign Job</a></div>
      <div class="col-md-1.5 bulkButton"><a class="btn btn-block btn-primary btnBulkPDFGenerate">Bulk Snapshot</a></div>
      <div class="col-md-1.5 bulkButton"><a class="btn btn-block btn-primary btnBulkCSVExport">Bulk Export CSV</a></div>
      <div class="col-md-1.5 bulkButton"><a  class="btn btn-block btn-primary btnBulkEmail">Bulk Email</a></div>
      <div class="col-md-1.5 bulkButton"><a class="btn btn-block btn-primary btnBulkCompileCV">Bulk Compile CV</a></div>

       --}}
      {{-- <div class="col-md-2"><a class="btn btn-block btn-primary ">Bulk Apply To Job</a></div> --}}
    </div>
    {{-- testing --}}

    {{-- <div class="col-md-2">
        <div class="float-right">
            <a href="{!! route('pool.create') !!}" class="btn btn-block btn-success">Add New</a>
        </div>
    </div> --}}

</div>

<input type="hidden" name="" class="pool_id" pool_id="{{$id}}">
@stop


{{-- @include('admin.errors',[ 'error' => $errors, 'record' => $record ]) --}}

@section('content')

@include('admin.errors')
@include('admin.success')


{{-- @dump($records); --}}
<table class="table table-bordered cbxDataTable text-center" id="dataTable">
    <thead>
        <tr style = "text-align: center">
            {{-- <th>select</th> --}}
            <th>
              {{-- <input name="select_all" value="1" id="cbx_all" type="checkbox" /> --}}
            Id
            </th>
            <th>Name</th>
            <th>location</th>
            {{-- <th>Email</th> --}}
            {{-- <th>Qualification Type</th> --}}
            <th>qualification</th>
            <th>Industry Experience</th>
            <th>action</th>

        </tr>
    </thead>
  </table>


@stop


@section('css')
<link rel="stylesheet"  href="{{ asset('css/admin_custom.css') }}">
<style type="text/css">


  a.seeCompletedReference {color: black;text-transform: uppercase;text-decoration: none;letter-spacing: 0.15em;display: inline-block;
  padding: 15px 20px;
  position: relative;
}
a.seeCompletedReference:after {    
  background: none repeat scroll 0 0 transparent;bottom: 0;content: "";display: block;height: 2px;left: 50%;position: absolute;background: black;
  transition: width 0.3s ease 0s, left 0.3s ease 0s;
  width: 0;
}
a.seeCompletedReference:hover:after { width: 100%; left: 0; }


</style>
@stop



@section('plugins.Datatables') @stop


@section('js')
<script src="{{ asset('js/admin_custom.js') }}"></script>
<script src="{{ asset('js/admin/iteration_8.js') }}"></script>

<script type="text/javascript">
    var base_url = '{!! url('/') !!}';
</script>
<script>



// =================================================== iteration-8 add-candidate datatable ===================================================

jQuery(function() {

    var id = $('.pool_id').attr('pool_id');
    var table = jQuery('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        order: [/*[ 1, 'asc' ], [ 3, 'asc' ],*/ [ 0, 'desc' ]],

        ajax: {
          url: '{!! route('addJobseekerinPool.dataTable') !!}',
          data: {'id': id}
        },
        columns: [
            // { data: 'select', name: 'select' },
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'location', name: 'location' },
            // { data: 'email', name: 'email' },
            // { data: 'qualificationType', name: 'qualificationType' },
            { data: 'qualification', name: 'qualification' },
            { data: 'industry_experience', name: 'industry_experience' },
            { data: 'action', name: 'action' }
        ],

        columnDefs: [
            { "orderable": true, "targets": [0,1] },
            { "orderable": false, "targets": [2,3,4,5] },
          ],

    });


   $('.filter_status').on('change', function(){
      var filter_status = $(this).val();
      // console.log('filter_status ', filter_status);
      var newpath = '{!! route('users') !!}/'+filter_status;
      window.location.href = newpath;
   });

});



</script>
@stop
