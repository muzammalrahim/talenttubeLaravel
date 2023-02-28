@extends('adminlte::page')

@section('title',$title)

@section('content_header')

<div class="block row">
    <div class="col-md-4"><h1 class="m-0 text-dark">{{$content_header}}</h1></div>

    <div class="block row col-md-6 text-white">

    </div>
    {{-- testing --}}

    <div class="col-md-2">
        <div class="float-right">
            <a href="{!! route('template.create') !!}" class="btn btn-block btn-success">Add New</a>
        </div>
    </div>

</div>


@stop


{{-- @include('admin.errors',[ 'error' => $errors, 'record' => $record ]) --}}


@section('content')

<div class="modal fade" id="deleteNoteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-notify modal-danger" role="document">
     <!--Content-->
     <div class="modal-content">
       <!--Header-->
       <div class="modal-header bg-danger">
         <p class="heading lead">Delete template  </p>
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
        <a type="button" class="btn btn-danger text-white confrimDeleteNote">Delete </a>
        <a type="button" class="btn btn-outline-danger waves-effect" data-dismiss="modal">Cancel</a>
        <input type="hidden" val="" class="noteIdInModal"/>
       </div>
     </div>
     <!--/.Content-->
   </div>
 </div>

@include('admin.errors')
@include('admin.success')


<table class="table table-bordered cbxDataTable" id="dataTable">
    <thead>
        <tr style = "text-align: center">
            <th>Id</th>
            <th>Template Name</th>
            <th>Type</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
    </thead>
  </table>

@stop

@section('css')
<link rel="stylesheet"  href="{{ asset('css/admin_custom.css') }}">
<style type="text/css">
    .modal.showProcessing  .modalContentUser{ display: none;  }
    .modal.showProcessing  .modelProcessingUser{ display: block !important; }
    #delConfirmIdUser{ color:red; }
    td{ text-align: center; }

 .bulkButton {
    margin-left: 7px;
}

.disableClick{
    pointer-events: none;
}
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
        order: [/*[ 1, 'asc' ], [ 3, 'asc' ],*/ [ 3, 'asc' ]],

        ajax: {
          url: '{!! route('template.dataTable') !!}',
          data: function (d) {
                d.status = $('.filter_status').val()
            }
        },
    
        columns: [
            { data: 'id', name: 'id' },
            { data: 'template_name', name: 'template_name' },
            { data: 'type', name: 'type' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action' }
        ],
        
     columnDefs: [
        { "orderable": false, "targets": [4] },
        { "orderable": true, "targets": [0,1,2,3] }
      ],
    });
});


  jQuery("body").on("click", ".noteId", function(){
    // console.log('hi note button');
    var noteId = $(this).attr("value");
    jQuery('.noteIdInModal').val(noteId);
    console.log(noteId);
  });


  jQuery('.confrimDeleteNote').click(function(){    
  var noteidInModal = jQuery('.noteIdInModal').val();
  $('#deleteNoteModal').modal('hide');
  // console.log(noteidInModal);

  $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.ajax({
        type: 'POST',
        url: '{!! route('AdminDeleteTemplate') !!}',
        data: {'id': noteidInModal},
        beforeSend: function(){
           $('#ModaluserInfo').modal('show');
        },
        success: function(data) {
          console.log(' data ', data);
          $('.ModaluserInfo .modalContentUser').html(data);
           $('#dataTable').DataTable().ajax.reload();
          
        }
    });

  });


</script>
@stop
