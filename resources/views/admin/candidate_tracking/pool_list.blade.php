@extends('adminlte::page')

@section('title',$title)

@section('content_header')

<div class="block row">
    <div class="col-md-2"><h1 class="m-0 text-dark">{{$content_header}}</h1></div>

    {{-- testing --}}

      {{-- <div class="col-md-2">
        <select class="filter_status browser-default custom-select">
            <option value="">Select Status</option>
            <option value="verified" {!! ($filter_status == 'verified')?('selected'):'' !!}>Approved</option>
            <option value="pending" {!! ($filter_status == 'pending')?('selected'):'' !!}>Pending</option>
        </select>
      </div> --}}

    <div class="block row col-md-8 text-white">


      {{-- <div class="col-md-1.5 bulkButton"><a class="btn btn-block btn-primary btnBulkApproved" style="margin-right: 5px;">Bulk Assign Job</a></div>
      <div class="col-md-1.5 bulkButton"><a class="btn btn-block btn-primary btnBulkPDFGenerate">Bulk Snapshot</a></div>
      <div class="col-md-1.5 bulkButton"><a class="btn btn-block btn-primary btnBulkCSVExport">Bulk Export CSV</a></div>
      <div class="col-md-1.5 bulkButton"><a  class="btn btn-block btn-primary btnBulkEmail">Bulk Email</a></div>
      <div class="col-md-1.5 bulkButton"><a class="btn btn-block btn-primary btnBulkCompileCV">Bulk Compile CV</a></div>

       --}}
      {{-- <div class="col-md-2"><a class="btn btn-block btn-primary ">Bulk Apply To Job</a></div> --}}
    </div>
    {{-- testing --}}

    <div class="col-md-2">
        <div class="float-right">
            <a href="{!! route('pool.create') !!}" class="btn btn-block btn-success">Add New</a>
        </div>
    </div>

</div>


{{-- Delete Talent_Pool Modal --}}


<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="deletePoolModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirm Delete Pool</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        This action can not be undone.<br>
        Are you sure you wish to continue ?
          <input type="hidden" class="pool_idModal"></input>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary conFirm_delete" data-dismiss="modal">Save changes</button>
      </div>
    </div>
  </div>
</div>

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
            {{-- <th>Email</th> --}}
            {{-- <th>Phone</th> --}}
            {{-- <th>Profile</th> --}}
            <th>action</th>

        </tr>
    </thead>
  </table>


@stop


@section('css')
<link rel="stylesheet"  href="{{ asset('css/admin_custom.css') }}">
<style type="text/css">

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
    var table = jQuery('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: '{!! route('talentPool.dataTable') !!}',
          data: function (d) {
                d.status = $('.filter_status').val()
            }
        },
        columns: [
            // { data: 'select', name: 'select' },
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            // { data: 'email', name: 'email' },
            // { data: 'phone', name: 'phone' },
            // { data: 'profile', name: 'profile' },
            { data: 'action', name: 'action' }
        ],


    });


   $('.filter_status').on('change', function(){
      var filter_status = $(this).val();
      // console.log('filter_status ', filter_status);
      var newpath = '{!! route('users') !!}/'+filter_status;
      window.location.href = newpath;
   });

});


$(document).on('click', '.pool_id', function(){
    var pool_id = $(this).attr('value');
    $('.pool_idModal').val(pool_id);
    // console.log(pool_id);
});

$(document).on('click', '.conFirm_delete', function(){
    // var pool_id = $(this).val();
    var pool_id = $('.pool_idModal').val();
    console.log(pool_id);

    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

        // $('.emailLoader').after(getLoader('smallSpinner SaveEmailSpinner'));

        $.ajax({
            type: 'POST',
            url: base_url+'/admin/ajax/delete/pool',
            data: {'id': pool_id},
            success: function(resp){
                if(resp.status == 1){
                    // console.log('call gone');
                    $('#dataTable').DataTable().ajax.reload();
                }
                else{
                }
            }
        });

});

</script>
@stop

