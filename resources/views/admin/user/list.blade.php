@extends('adminlte::page')

@section('title',$title)

@section('content_header')

<div class="block row">
    <div class="col-md-3"><h1 class="m-0 text-dark">{{$content_header}}</h1></div>

    {{-- testing --}}
    <div class="block row col-md-8 text-white">

      <div class="col-md-2">
            <a class="btn btn-block btn-primary ">Bulk Compile CV</a>
      </div>
      <div class="col-md-2">
            <a class="btn btn-block btn-primary ">Bulk Export CSV</a>
      </div>
      <div class="col-md-2">
            <a class="btn btn-block btn-primary ">Bulk Email</a>

      </div>
      <div class="col-md-2">
            <a class="btn btn-block btn-primary ">Bulk Apply To Job</a>

      </div>

    </div>
    {{-- testing --}}
    <div class="col-md-1">
     {{--    <div class="float-right">
            <a href="{!! route('users.create') !!}" class="btn btn-block btn-success">Add New</a>
        </div> --}}
    </div>

</div>


@stop


{{-- @include('admin.errors',[ 'error' => $errors, 'record' => $record ]) --}}

@section('content')

@include('admin.errors')
@include('admin.success')


<table class="table table-bordered" id="dataTable">


    <thead>

        <tr style = "text-align: center">
            {{-- <th>select</th> --}}
            <th>id.</th>
            <th>name</th>
            <th>city</th>
            <th>email</th>
            <th>phone</th>
            <th>created_at</th>
            <th>profile</th>
            <th>View Video</th>
            <th>View Resume</th>
            <th>action</th>
            
        </tr>
    </thead>
  </table>

{{-- User Deleting Pop Up --}}

  <div id="deleteModaluser" class="modal fade" role="dialog">
    <div class="modal-dialog">
                 <!-- Modal content-->
        <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
             </div>
             <div class="modal-body">

                <div class="modalContentUser">
                    <p>Do you want to Delete <b><span id="delConfirmIdUser"></span></b> User ?</p>
                    
                </div>

                <div class="modelProcessingUser" style="display: none;">
                        <h4>Deleting User...</h4>    
                 </div>

             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-danger" id="removeuser" style="margin: 0 auto">Yes</button>
              <input type="hidden" name="deleteConfirmUser" id="deleteConfirmUser" value="">
             </div>

        </div>
    </div>
</div>

{{-- User Deleting Pop Up End Here --}}

{{-- User Info Pop Up --}}

  <div id="ModaluserInfo" class="modal fade" role="dialog">
    <div class="modal-dialog">
                 <!-- Modal content-->
        <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
             </div>
             <div class="modal-body">

                <div class="modalContentUser text-center">

                    <i class="fa fa-spinner fa-pulse" style="font-size: 35px;"></i>


                    
                </div>

                {{-- <div class="modelProcessingUser" style="display: none;">
                        <h4>Deleting User...</h4>    
                </div> --}}

             </div>
             <div class="modal-footer">
                 {{-- <button type="button" class="btn btn-danger" id="removeuser" style="margin: 0 auto">Yes</button> --}}
              {{-- <input type="hidden" name="deleteConfirmUser" id="deleteConfirmUser" value=""> --}}
             </div>

        </div>
    </div>
</div>

{{-- User Info Pop Up End Here --}}

@stop


@section('css')
    <link rel="stylesheet"  href="{{ asset('css/admin_custom.css') }}">

    <style type="text/css">
        .modal.showProcessing  .modalContentUser{
         display: none;  
        }
        .modal.showProcessing  .modelProcessingUser{ 
            display: block !important;  
        }
        #delConfirmIdUser{
            color:red;
        }
        td{
          text-align: center;
        }
    </style>
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
                // { data: 'select', name: 'select' },
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'city', name: 'city' },
                { data: 'email', name: 'email' },
                { data: 'phone', name: 'phone' },
                { data: 'created_at', name: 'created_at' },
                { data: 'profile', name: 'profile' },
                { data: 'city', name: 'city' },
                { data: 'city', name: 'city' },
                { data: 'action', name: 'action' }
            ]
        });


     
     // script to show user info PopupBox 
     // 0-> empty the popup html.  jQuery(popupBoday tag ).html(getLoader()'');
     // 0.5 --> show animation in popup. 
     // 1-> show popup. 
     // 2--> send ajax call to render userinfo html.
     // 3--> show that html in the popup. 
     // 4 --> jQuery(popupBoday tag ).html(succss data );

// Start user Info 

$(document).on('click', '#userinfo', function() {
  var UserInfoId = parseInt($(this).attr('user-id'));
   
  console.log("UserInfoId"+UserInfoId);

    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.ajax({
        type: 'GET',
        url: '{!! route('users.profilePopup') !!}',
        data: {'id': UserInfoId},
        beforeSend: function(){
           // // $(".modelProcessingUser").show();
           // $(".modalContentUser p").hide();
           // $("#userinfo").prop("disabled", true);  
           $('#ModaluserInfo').modal('show');  


        },
        success: function(data) {
          console.log(' data ', data);
          $('.modalContentUser').html(data);  
          
        }
    });

});

  // Ajax for deleting User

// $('#userinfo').on('click', function() {
//     // var deliduser = $('#deleteConfirmUser').val();
//     console.log("User Delete"+deliduser);

    // $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    // $.ajax({
    //     type: 'POST',
    //     url: 'users/delete/' + deliduser,
    //     data: {deliduser},
    //     beforeSend: function(){
    //        // $(".modelProcessingUser").show();
    //        $(".modalContentUser p").hide();
    //        $("#userinfo").prop("disabled", true);            
    //     },
    //     success: function(data) {
    //       console.log(' data ', data);
    //         if(data.status === 1 )
    //          $('#ModaluserInfo').modal('hide');
    //        // $(".modelProcessingUser").hide();
    //        $(".modalContentUser p").show();
    //          $("#userinfo").prop("disabled", false);
    //         jQuery('#dataTable').DataTable().ajax.reload();
    //     }
    // });
    
// });

// End Here userinfo

    });
</script>
@stop
