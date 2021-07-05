@extends('adminlte::page')

@section('title',$title)

@section('content_header')

<div class="block row">
    <div class="col-md-2"><h1 class="m-0 text-dark">{{$content_header}}</h1></div>

    {{-- @dd($content_header); --}}

    <div class="block row col-md-8 text-white">

    </div>
    
    <div class="col-md-2">
        <div class="float-right">
            <a href="{!! route('onlineTest.create') !!}" class="btn btn-block btn-success">Add New</a>
        </div>
    </div>

</div>


{{-- Delete Talent_Pool Modal --}}


<!-- Button trigger modal -->


<!-- Modal -->
{{-- <div class="modal fade" id="deletTestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirm Delete Test</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        This action can not be undone.<br>
        Are you sure you wish to continue ?
          <input type="hidden" class="test_idModal"></input>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary conFirm_delete" data-dismiss="modal">Save changes</button>
      </div>
    </div>
  </div>
</div> --}}


 <!-- Central Modal Medium Danger -->
 <div class="modal fade" id="deletTestModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-notify modal-danger" role="document">
     <!--Content-->
     <div class="modal-content">
       <!--Header-->
       <div class="modal-header bg-danger">
         <p class="heading lead">Confirm Delete Test</p>
         <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
       <!--Body-->
       <div class="modal-body">
         <div class="text-center">
           <p>This action cannot be undone. Are you sure you wish to continue </p>
         </div>
       </div>
       <!--Footer-->
       <div class="modal-footer justify-content-center">
        <a type="button" class="btn btn-danger text-white conFirm_delete" data-dismiss="modal">Delete </a>
        <a type="button" class="btn btn-outline-danger waves-effect" data-dismiss="modal">Cancel</a>
        <input type="hidden" val="" class="test_idModal"/>
       </div>
     </div>
     <!--/.Content-->
   </div>
 </div>
 <!-- Central Modal Medium Danger-->

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
            <th>Time</th>
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
          url: '{!! route('onlineTest.dataTable') !!}',
          data: function (d) {
                d.status = $('.filter_status').val()
            }
        },
        columns: [
            // { data: 'select', name: 'select' },
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'time', name: 'time' },
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




$(document).on('click', '.test_id', function(){
    var test_id = $(this).attr('value');
    $('.test_idModal').val(test_id);
    // console.log(pool_id);
});

$(document).on('click', '.conFirm_delete', function(){
    // var pool_id = $(this).val();
    var test_id = $('.test_idModal').val();
    // console.log(test_id);

    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

        // $('.emailLoader').after(getLoader('smallSpinner SaveEmailSpinner'));

        $.ajax({
            type: 'POST',
            url: base_url+'/admin/ajax/delete/onlineTest',
            data: {'id': test_id},
            success: function(resp){
                // if(resp.status == 1){
                    // console.log('call gone');
                    $('#dataTable').DataTable().ajax.reload();
                     // $('#deletTestModal').modal('toggle');
                // }
                // else{
                // }
            }
        });

});



</script>
@stop
