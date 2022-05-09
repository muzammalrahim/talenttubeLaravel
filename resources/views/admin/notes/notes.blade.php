
@extends('adminlte::page')

@section('title',$title)

@section('content_header')
<div class="block row">
    <div class="col-md-3"><h1 class="m-0 text-dark">{{$content_header}}</h1></div>

</div>
@stop

@section('content')

<table class="table table-bordered text-center" id="dataTable">
    <thead>
        <tr style = "text-align: center">
            {{-- <th>Id</th> --}}
            <th>Job Seeker Name</th>
            <th>Profile</th>
            <th>Text</th>
            <th>Created_at</th>
            <th>Action</th>
        </tr>
    </thead>
  </table>



 <!-- Central Modal Medium Danger -->
 <div class="modal fade" id="deleteNoteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-notify modal-danger" role="document">
     <!--Content-->
     <div class="modal-content">
       <!--Header-->
       <div class="modal-header bg-danger">
         <p class="heading lead">Delete Note</p>
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
 <!-- Central Modal Medium Danger-->

@stop


@section('css')
    <link rel="stylesheet"  href="{{ asset('css/admin_custom.css') }}">
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
          url: '{!! route('notes.dataTable') !!}',
          data: function (d) {
                d.status = $('.filter_status').val()
            }
        },
      columns: [
          // { data: 'id', name: 'id' },
          { data: 'js_id', name: 'js_id' },
          { data: 'js_id', name: 'js_id' },
          { data: 'profile', name: 'profile' },
          { data: 'text', name: 'text' },
          { data: 'created_at', name: 'created_at' },
          { data: 'action', name: 'action', },
      ]
  });

//========================================================================//
// Change filter_status append value to url
//========================================================================//



});




jQuery(document).ready(function(){

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
        url: '{!! route('AdminDeleteNote') !!}',
        data: {'id': noteidInModal},
        beforeSend: function(){
           $('#ModaluserInfo').modal('show');
           $('#dataTable').DataTable().ajax.reload();
        },
        success: function(data) {
          console.log(' data ', data);
          $('.ModaluserInfo .modalContentUser').html(data);

        }
    });

  });



});


</script>
@stop
