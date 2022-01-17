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


      <div class="col-md-1.5 bulkButton"><a class="btn btn-sm btn-block btn-primary btnBulkApproved" style="margin-right: 5px;">Bulk Assign Job</a></div>
      <div class="col-md-1.5 bulkButton"><a class="btn btn-sm btn-block btn-primary btnBulkPDFGenerate">Bulk Snapshot</a></div>
      <div class="col-md-1.5 bulkButton"><a class="btn btn-sm btn-block btn-primary btnBulkCSVExport">Bulk Export CSV</a></div>
      <div class="col-md-1.5 bulkButton"><a  class="btn btn-sm btn-block btn-primary btnBulkEmail">Bulk Email</a></div>
      <div class="col-md-1.5 bulkButton"><a class="btn btn-sm btn-block btn-primary btnBulkCompileCV">Bulk Compile CV</a></div>
      <div class="col-md-1.5 bulkButton"><a class="btn btn-sm btn-block btn-primary bulkPool">Bulk Pool</a></div>
      {{-- <div class="col-md-1.5 bulkButton"><a class="btn btn-sm btn-block btn-primary bulkSms" onclick="bulkSmsFunction()">Bulk SMS</a></div> --}}
      {{-- <div class="col-md-2"><a class="btn btn-block btn-primary ">Bulk Apply To Job</a></div> --}}
    </div>
    {{-- testing --}}

    {{-- <div class="col-md-2">
        <div class="float-right">
            <a href="{!! route('users.create') !!}" class="btn btn-block btn-success">Add New</a>
        </div>
    </div> --}}

</div>


@stop


{{-- @include('admin.errors',[ 'error' => $errors, 'record' => $record ]) --}}

@section('content')

@include('admin.errors')
@include('admin.success')


<table class="table table-bordered cbxDataTable" id="dataTable">
    <thead>
        <tr style = "text-align: center">
            {{-- <th>select</th> --}}
            <th><input name="select_all" value="1" id="cbx_all" type="checkbox" /></th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>City</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Created At</th>
            <th>Profile</th>
            <th>Video</th>
            <th>Resume</th>
            <th>Action</th>

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

<div id="ModaluserInfo" class="modal fade ModaluserInfo" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
         <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body">
            <div class="modalContentUser text-center"><i class="fa fa-spinner fa-pulse" style="font-size: 35px;"></i></div>
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


{{-- Bulk Approved Pop Up --}}
<div id="ModalBulkApprovedInfo" class="modal fade ModalBulkApprovedInfo" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
         {{-- <div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button></div> --}}
         <div class="modal-body p-3">
            <div class="modalContentUser">


            </div>
         </div>
         <div class="modal-footer text-center margin_auto">
                {{-- <button type="button" class="btn btn-primary btn-md modelConfirmAction">Yes</button> --}}
                <button type="button" class="btn btn-default btn-md modelCancelAction" data-dismiss="modal">Cancel</button>
         </div>
    </div>
  </div>
</div>
{{-- Bulk Approved Pop Up End --}}

<div id="divtemp" style="display: none;">
    <h3>You are bulk assigning a job to <span class="bulkCount"></span> JobSeekers.</h3>
    <div class="col-12 col-sm-6 col-lg-12">
        <div class="card card-primary card-tabs">

          <div class="card-header p-0 pt-1 tabColor"style="background: #6c757d;">
            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">

              <li class="nav-item col-lg-6">
                <a class="nav-link active disableClick" id="jobslist-tab" data-toggle="pill" disabled href="#jobslist" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true"><b>Select Job</b></a>
              </li>

              <li class="nav-item col-lg-6">
                <a class="nav-link disableClick" id="question-tab" data-toggle="pill" disabled href="#question" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false"><b>Questions</b></a>
              </li>


            </ul>
          </div>

          <div class="card-body">

            <div class="tab-content" id="custom-tabs-one-tabContent">
                <div class="tab-pane show active" id="jobslist" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                        <table class="table table-bordered" id="dataTablejobs">
                            <thead>
                                <tr style="text-align: center">
                                    <th>id.</th>
                                    <th>title</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                        </table>
                </div>
                <div class="tab-pane fade" id="question" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                    <div class="modalcontent1">

                    </div>
                </div>
            </div> <!-- tab-content end -->
          </div>

          <!-- /.card -->
        </div>
      </div>

</div>





{{-- BulkCSV download --}}
<div class="d-none">
  <form method="POST" class="bulkCSVExportForm" action="{{route('bulk.GenerateCVS')}}">
    @csrf
    <div class="cbx_list">
    </div>
  </form>
</div>


<div class="d-none">
    <form method="POST" class="BulkCompileCVForm" action="{{route('bulk.BulkGenerateCVPDF')}}">
      @csrf
      <div class="cbx_list">
      </div>
    </form>
  </div>
{{-- BulkCSV download end --}}


{{-- BulkCSV download --}}
<div class="d-none">
  <form method="POST" class="bulkPDFExportForm" action="{{route('bulk.GeneratePDF')}}">
    @csrf
    <div class="cbx_list">
    </div>
  </form>
</div>

<div class="d-none">
    <form method="GET" class="bulkEmailForm" action="{{route('bulkEmail.new')}}">
      @csrf
      <div class="cbx_list">
      </div>
    </form>
</div>
{{-- BulkCSV download end --}}



<div id="ModalBulkPool" class="modal fade ModalBulkPool" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    {{-- <div class="modal-header bg-white text-black"> Add Jobseekers in Talent Pool</div> --}}

    <form class="addBulkJobSeekerInPool" name="addBulkJobSeekerInPool">
      <div class="modal-content">
           <div class="modal-header">Add Jobseekers in Talent Pool<button type="button" class="close" data-dismiss="modal">&times;</button></div>
           <div class="modal-body p-3 bulkPoolContent">
              <div class="poolsInModal">


              </div>

              <div class="cbx_list"></div>

           </div>

           <p class="d-none usersAddedMessage px-3"> Users are added in pool successfully </p>
           <div class="modal-footer text-center margin_auto">
                  <button type="button" class="btn btn-success btn-md addInPoolConfirm">Confirm</button>
                  <button type="button" class="btn btn-default btn-md modelCancelAction" data-dismiss="modal">Cancel</button>
           </div>
      </div>
    </form>
  </div>
</div>



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

function nextTabQuestion(jobPopId) {
        console.log(jobPopId);
        // $('#jobslist').hide();
        // $('#question').tab('show');
        $('#jobslist').removeClass("active");
        $('#jobslist').addClass('fade');
        $('#question').removeClass("fade");
        $('#question').addClass('active');
        // $('#jobslist').hide();
        // $('#question').tab('show');
        $('#jobslist-tab').removeClass("active");
        $('#question-tab').addClass('active');
        $.ajax({
        type: 'GET',
            url: base_url+'/admin/ajax/jobApplyInfoa/'+ jobPopId,
            success: function(data){
                console.log("apply for job call");
                $('.modalcontent1').html(data);
                // $('#modalJobApply').modal('hide');

            }
        });
}

// $('.submitApplication').click(function(){
//     console.log('submit application');
//       var applyFormData = $('#job_apply_form').serializeArray()

//       $.ajaxSetup({
//         headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//       }
//         });
//         $.ajax({
//         type: 'POST',

//             url: base_url+'/admin/ajax/massJobApplySubmit',
//             data: applyFormData,
//             success: function(data){
//                 $('.submitApplication').html('Submit').prop('disabled',false);
//                 console.log(' data ', data );
//                 if (data.status == 1){
//                      $('#job_apply_form').html(data.message);

//                 }else {
//                      $('#job_apply_form').html(data.error);
//                 }
//             }
//         });

//   });



jQuery(function() {
    var table = jQuery('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: '{!! route('users.dataTable') !!}',
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
            { data: 'name', name: '' },
            { data: 'surname', name: 'surname' },
            { data: 'city', name: 'city' },
            { data: 'email', name: 'email' },
            { data: 'phone', name: 'phone' },
            { data: 'created_at', name: 'created_at' },
            { data: 'profile', name: 'profile' },
            { data: 'videoInfo', name: 'videoInfo' },
            { data: 'resume', name: 'resume' },
            { data: 'action', name: 'action' }
        ],
     columnDefs: [{
         'targets': 0,
         'searchable':false,
         'orderable':false,
         'className': 'dt-body-center',
         'render': function (data, type, full, meta){
             return '<input type="checkbox" name="cbx[]" value="'+ $('<div/>').text(data).html() + '">';
         }
      }],
    });


   $('.filter_status').on('change', function(){
      var filter_status = $(this).val();
      // console.log('filter_status ', filter_status);
      var newpath = '{!! route('users') !!}/'+filter_status;
      window.location.href = newpath;
   });



   // $('#frm-example').on('submit', function(e){
   //    var form = this;

   //    // Iterate over all checkboxes in the table
   //    table.$('input[type="checkbox"]').each(function(){
   //       // If checkbox doesn't exist in DOM
   //       if(!$.contains(document, this)){
   //          // If checkbox is checked
   //          if(this.checked){
   //             // Create a hidden element
   //             $(form).append(
   //                $('<input>')
   //                   .attr('type', 'hidden')
   //                   .attr('name', this.name)
   //                   .val(this.value)
   //             );
   //          }
   //       }
   //    });

   //    // FOR TESTING ONLY

   //    // Output form data to a console
   //    $('#example-console').text($(form).serialize());
   //    console.log("Form submission", $(form).serialize());

   //    // Prevent actual form submission
   //    e.preventDefault();
   // });



     // script to show user info PopupBox
     // 0-> empty the popup html.  jQuery(popupBoday tag ).html(getLoader()'');
     // 0.5 --> show animation in popup.
     // 1-> show popup.
     // 2--> send ajax call to render userinfo html.
     // 3--> show that html in the popup.
     // 4 --> jQuery(popupBoday tag ).html(succss data );

// Start user Info

$(document).on('click', '.btnUserInfo', function() {
  var UserInfoId = parseInt($(this).attr('user-id'));
  console.log("UserInfoId"+UserInfoId);
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.ajax({
        type: 'GET',
        url: '{!! route('users.profilePopup') !!}',
        data: {'id': UserInfoId},
        beforeSend: function(){
           $('#ModaluserInfo').modal('show');
        },
        success: function(data) {
          console.log(' data ', data);
          $('.ModaluserInfo .modalContentUser').html(data);

        }
    });

});



//========================================================================//
//========================================================================//
$(document).on('click', '.btnUserVideoInfo', function() {
  var UserInfoId = parseInt($(this).attr('user-id'));
  $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
  $.ajax({
      type: 'GET',
      url: '{!! route('users.profileVideoPopup') !!}',
      data: {'id': UserInfoId},
      beforeSend: function(){
         $('#ModaluserInfo').modal('show');
      },
      success: function(data) {
        console.log(' data ', data);
        $('.ModaluserInfo  .modalContentUser').html(data);
      }
  });
});


//========================================================================//
// ModaluserInfo script to show full image when click on thumb
//========================================================================//
 $('.ModaluserInfo').on('click','.profleMediaGalleryImage img', function(){
  console.log(' profleMediaGalleryImage click ');
    var imageFullPath = $(this).attr('data-fullpath');
    var imgTag = '<img src="'+imageFullPath+'" />';
    $('.ModaluserInfo .profileImg').html(imgTag);
 });
$('.ModaluserInfo').on('click','.profleVideos img', function(){
    console.log(' profleVideos click ');
    var videoFullPath = $(this).attr('data-src');
    var videoTag = '<video class="videoPlayer" controls="true"><source src="'+videoFullPath+'"></video>';
    $('.ModaluserInfo .profileVideoShow').html(videoTag);  // attr('src', videoFullPath);//
    $(".profileVideoShow video")[0].load();
    $(".profileVideoShow video")[0].play();
 });
$('.ModaluserInfo').on('hidden.bs.modal', function () {
  $('.ModaluserInfo  .modalContentUser').html(getLoader('smallSpinner'));
})

//========================================================================//
// Click on btnUserResumeInfo function downalod JobSeeker CV.
//========================================================================//
$(document).on('click','.btnUserResumeInfo', function(){
  console.log(' btnUserResumeInfo click ');
  var UserInfoId = parseInt($(this).attr('user-id'));
  $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
  $.ajax({
      type: 'GET',
      url: '{!! route('users.resumeData') !!}',
      data: {'id': UserInfoId},
      beforeSend: function(){
         // $('#ModaluserInfo').modal('show');
      },
      success: function(data) {
        console.log('data ', data);
        if(data != ''){
          window.open(data, '_blank')
        }
        // $('.ModaluserInfo  .modalContentUser').html(data);
      }
  });
});


//========================================================================//
// Click on btnBulkApproved Button show confirmation popup.
//========================================================================//
$(document).on('click','.btnBulkApproved', function(){
  console.log(' btnBulkApproved click ');
  var UserInfoId = parseInt($(this).attr('user-id'));
  jQuery('input[name="cbx[]"]:checked').each(function(i,el){ console.log('i', i, 'el', $(el).val()); });
  var cbx = $('input[name="cbx[]"]:checked').map(function(){return $(this).val(); });

  if(cbx.length <= 0){
      alert('Please Select Checkboxes');
      return false;
    }
  $('#ModalBulkApprovedInfo .modalContentUser').html($('#divtemp').html());
  $('.ModalBulkApprovedInfo .bulkCount').html(cbx.length);
  jQuery('#dataTablejobs').DataTable({
    processing: true,
    serverSide: true,
    ajax: '{!! route('jobs.dataTablejob') !!}',
    columns: [
        { data: 'id', name: 'id' },
        { data: 'title', name: 'title' },
        { data: 'action', name: 'action'},
    ]
});




$('#ModalBulkApprovedInfo').modal('show');

});


$('#ModalBulkApprovedInfo').on('hidden.bs.modal', function (e) {

    // $('#question').hide();
    $('#jobslist-tab').addClass("active");
    $('#question-tab').removeClass('active');
    $('#dataTablejobs').DataTable().destroy();
    $('#jobslist').removeClass("fade");
    $('#jobslist').addClass('active');
    $('#question').removeClass("active");
    $('#question').addClass('fade');

});

$(document).on('click','.modelConfirmAction', function(){
  var cbx = $('input[name="cbx[]"]:checked').map(function(){return $(this).val(); }).toArray();
  var applyFormData = $('#job_apply_form').serializeArray();
  applyFormData[applyFormData.length] = { name: "cbx", value: cbx };
  //   applyFormData.push(cbx);
   console.log(' modelConfirmAction cbx ', applyFormData);
  $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
  $.ajax({
      type: 'POST',
      url: base_url+'/admin/ajax/massJobApplySubmit',
      data: applyFormData,
      beforeSend: function(){
         $('#ModalBulkApprovedInfo .modalContentUser').html(getLoader('smallSpinner'));
         $('#ModalBulkApprovedInfo .modelConfirmAction').prop('disabled', true);
      },
      success: function(data) {
        console.log('data ', data);
        console.log('data ', data.status);
        if(data.status==1){

           $('#ModalBulkApprovedInfo .modalContentUser').html(data.message);
        }else{
           $('#ModalBulkApprovedInfo .modalContentUser').html(data.error);
        }
      }
  });
});



//========================================================================//
// Click on btnVerifyUser Button show confirmation popup.
//========================================================================//
$(document).on('click','.btnVerifyUser', function(){
  console.log(' btnVerifyUser click ');
  var user_id = parseInt($(this).attr('user-id'));
  var elem = $(this);
  elem.html(getLoader('smallSpinner btnSpinner',false,true));
  $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
  $.ajax({
      type: 'POST',
      url: '{!! route('users.confirmAccount') !!}',
      data: {'cbx': [user_id]},
      success: function(data) {
        console.log('data ', data);
        if(data.status){
          setTimeout(function(){ elem.text('verified');}, 1000);
          setTimeout(function(){ elem.remove();}, 1500);
        }else{
            elem.text('Error');
        }
      }
  });
});





//========================================================================//
// Click on btnBulkApproved Button show confirmation popup.
//========================================================================//
$(document).on('click','.btnBulkCSVExport', function(){
  console.log(' btnBulkCSVExport click ');
  var cbx = $('input[name="cbx[]"]:checked').map(function(){return $(this).val(); }).toArray();
    if(cbx.length <= 0){
      alert('Please Select Checkboxes');
      return false;
    }
    var cbx_hidden =  '';
    cbx.forEach(function(id){ cbx_hidden += '<input type="hidden" name="cbx[]" value="'+id+'" />'  });
    $('.bulkCSVExportForm .cbx_list').html(cbx_hidden);
    $('.bulkCSVExportForm').submit();
});


$(document).on('click','.btnBulkCompileCV', function(){
  console.log(' btnBulkCompileCV click ');
  var cbx = $('input[name="cbx[]"]:checked').map(function(){return $(this).val(); }).toArray();
    if(cbx.length <= 0){
      alert('Please Select Checkboxes');
      return false;
    }
    var cbx_hidden =  '';
    cbx.forEach(function(id){ cbx_hidden += '<input type="hidden" name="cbx[]" value="'+id+'" />'  });
    $('.BulkCompileCVForm .cbx_list').html(cbx_hidden);
    $('.BulkCompileCVForm').submit();
});


//========================================================================//
// Click on btnBulkApproved Button show confirmation popup.
//========================================================================//
$(document).on('click','.btnBulkPDFGenerate', function(){
  console.log(' btnBulkPDFGenerate click ');
  var cbx = $('input[name="cbx[]"]:checked').map(function(){return $(this).val(); }).toArray();
    if(cbx.length <= 0){
      alert('Please Select Checkboxes');
      return false;
    }
    var cbx_hidden =  '';
    cbx.forEach(function(id){ cbx_hidden += '<input type="hidden" name="cbx[]" value="'+id+'" />'  });
    $('.bulkPDFExportForm .cbx_list').html(cbx_hidden);
    $('.bulkPDFExportForm').submit();
});



$(document).on('click','.btnBulkEmail', function(){
  console.log(' btnBulkPDFGenerate click ');
  var cbx = $('input[name="cbx[]"]:checked').map(function(){return $(this).val(); }).toArray();
    if(cbx.length <= 0){
      alert('Please Select Checkboxes');
      return false;
    }
    var cbx_hidden =  '';
    cbx.forEach(function(id){ cbx_hidden += '<input type="hidden" name="cbx[]" value="'+id+'" />'  });
    $('.bulkEmailForm .cbx_list').html(cbx_hidden);
    $('.bulkEmailForm').submit();
});



this.bulkSmsFunction = function(){
    var cbx = $('input[ name = "cbx[]" ]:checked').map(function(){ return $(this).val(); }).toArray();
    console.log(cbx);

}




  $(document).on('click', '.bulkPool', function(){
    var cbx = $('input[name = "cbx[]" ]:checked').map(function(){return $(this).val();}).toArray();
    var cbx_hidden =  '';
    cbx.forEach(function(id){ cbx_hidden += '<input type="hidden" name="cbx[]" value="'+id+'" />'  });
    $('.bulkPoolContent .cbx_list').html(cbx_hidden);
    console.log(cbx);

    if(cbx.length <= 0){
      alert('Please Select Checkboxes');
      return false;
    }
    else{

      $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
      $.ajax({
            type: 'GET',
            url: base_url+'/admin/ajax/bulk/bulkPool',
            // data: cbx,
              success: function(data){
                  console.log(' data ', data);
                  $('.poolsInModal').html(data);
                  $('.ModalBulkPool').modal('show');

              }
            });

    }
  });

// ================================================== Bulk Pool Confirm ==================================================



$(document).on('click', '.addInPoolConfirm', function(){

  var formdata = $('.addBulkJobSeekerInPool').serializeArray();
  console.log(formdata);

  $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
      $.ajax({
            type: 'POST',
            url: base_url+'/admin/ajax/bulk/AddBulkJobseekerInPool',
            data: formdata,
              success: function(data){
                  console.log(' data ', data);
                  $('.poolsInModal').html(data);
                  $('.ModalBulkPool').modal('show');
                  $('.usersAddedMessage').removeClass('d-none');
                  $('#dataTable').DataTable().ajax.reload();
                  setTimeout(function() { 
                      $('.usersAddedMessage').addClass('d-none');
                      $('.ModalBulkPool').modal('hide');
                      
                  }, 3000);

              }
      });



});























});




</script>
@stop
