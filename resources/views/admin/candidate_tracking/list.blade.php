@extends('adminlte::page')

@section('title',$title)

@section('content_header')

<div class="block row">
    <div class="col-md-2"><h1 class="m-0 text-dark">{{$content_header}}</h1></div>

    <div class="block row col-md-10 text-white">
      <div class="col-md-1.5 bulkButton"><a class="btn btn-sm btn-block btn-primary btnBulkApproved" style="margin-right: 5px;">Bulk Assign</a></div>
      <div class="col-md-1.5 bulkButton"><a class="btn btn-sm btn-block btn-primary btnBulkPDFGenerate">Bulk Snapshot</a></div>
      <div class="col-md-1.5 bulkButton"><a class="btn btn-sm btn-block btn-primary btnBulkCSVExport">Bulk Export CSV</a></div>
      <div class="col-md-1.5 bulkButton"><a  class="btn btn-sm btn-block btn-primary btnBulkEmail">Bulk Email</a></div>
      <div class="col-md-1.5 bulkButton"><a class="btn btn-sm btn-block btn-primary btnBulkCompileCV">Bulk Compile CV</a></div>
      <div class="col-md-1.5 bulkButton"><a class="btn btn-sm btn-block btn-primary addCondidate" href="{{ route('addCandidate') }}" >Add Candidate</a></div>
      <div class="col-md-1.5 bulkButton"><a class="btn btn-sm btn-block btn-primary" onclick="bulkremoveButton()" >Bulk Remove</a></div>
      <div class="col-md-1.5 bulkButton"><a class="btn btn-sm btn-block btn-primary" onclick="bulkTestingButton()" >Bulk Testing</a></div>
    </div>
    {{-- testing --}}

</div>


@stop


{{-- @include('admin.errors',[ 'error' => $errors, 'record' => $record ]) --}}

@section('content')

@include('admin.errors')
@include('admin.success')



{{-- @dump($records); --}}
<table class="table table-bordered cbxDataTable" id="dataTable">
    <thead>
        <tr style = "text-align: center">
            {{-- <th>select</th> --}}
            <th>
              <input name="select_all" value="1" id="cbx_all" type="checkbox" />
            {{-- Id --}}
            </th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Profile</th>
            <th>Select Job</th>
            <th>Job Status</th>
            <th>Ref Check</th>
            <th>Tests</th>
            <th>Interviews</th>
            <th>Admin's Notes</th>
            {{-- <th>action</th> --}}

        </tr>
    </thead>
  </table>


{{-- =======================================================  User Deleting Pop Up  ======================================================= --}}

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


{{-- ======================================================= User Info Pop Up ======================================================= --}}

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

{{-- ======================================================= Bulk Approved Pop Up ======================================================= --}}


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

{{-- ======================================================= Bulk Assigning Job ======================================================= --}}

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

{{-- ======================================================= BulkCVS download ======================================================= --}}

<div class="d-none">
  <form method="POST" class="bulkCSVExportForm" action="{{route('bulk.GenerateCVS')}}">
    @csrf
    <div class="cbx_list">
    </div>
  </form>
</div>


{{-- ======================================================= Bulk PDF download ======================================================= --}}

<div class="d-none">
    <form method="POST" class="BulkCompileCVForm" action="{{route('bulk.BulkGenerateCVPDF')}}">
      @csrf
      <div class="cbx_list">
      </div>
    </form>
  </div>

{{-- ======================================================= Bulk CSV download ======================================================= --}}

<div class="d-none">
  <form method="POST" class="bulkPDFExportForm" action="{{route('bulk.GeneratePDF')}}">
    @csrf
    <div class="cbx_list">
    </div>
  </form>
</div>

{{-- ======================================================= Bulk Email download ======================================================= --}}

<div class="d-none">
    <form method="GET" class="bulkEmailForm" action="{{route('bulkEmail.new')}}">
      @csrf
      <div class="cbx_list">
      </div>
    </form>
</div>

{{-- ======================================================= Modal For getting jobs ======================================================= --}}

<div class="modal fade right" id="getJobsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true" data-backdrop="false">
  <div class="modal-dialog modal-full-height modal-right modal-notify modal-info" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #343a40">
        <p class="heading lead text-white">Select Job</p>
        <button type="button" class="close modalCloseTopButton text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text">×</span>
        </button>
      </div>
      <div class="modal-body p-0">
        <div class="text-center applyJobModalHeader">           
        </div>
      </div>
    </div>
  </div>
</div>

{{-- ======================================================= Modal For getting job's Status =======================================================  --}}

<div class="modal fade right" id="getJobStatusDropdown" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true" data-backdrop="false">
  <div class="modal-dialog modal-full-height modal-right modal-notify modal-info" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #343a40">
        <p class="heading lead text-white">Job Status</p>
        <button type="button" class="close modalCloseTopButton text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text">×</span>
        </button>
      </div>
      <div class="modal-body p-0">
        <select></select>
        {{-- <div class="text-center applyJobModalHeader">            --}}
        </div>
      </div>
    </div>
  </div>
</div>


{{-- ======================================================= Bulk remove from tracker ======================================================= --}}

<div class="d-none">
  <form method="GET" class="bulkRemoveUser" action="{{ route('users.removeTracker') }}">
      @csrf
    <div class="cbx_list">
      </div>
  </form>
</div>

{{-- ======================================================= Bulk testing  ======================================================= --}}

<div class="d-none">
  <form method="GET" class="bulkTesting" action="{{ route('bulk.bulkTesting') }}">
      @csrf
    <div class="cbx_list">
      </div>
  </form>
</div>

@stop


@section('css')
<link rel="stylesheet"  href="{{ asset('css/admin_custom.css') }}">
<style type="text/css">
  .modal.showProcessing  .modalContentUser{ display: none;  }
  .modal.showProcessing  .modelProcessingUser{ display: block !important; }
  #delConfirmIdUser{ color:red; }
  td{ text-align: center; }
  .bulkButton {margin-left: 7px; margin-top: 7px;}
  .disableClick{pointer-events: none;}
  .adminNote{bottom: 12px;right: 3px;cursor: pointer;display: flex;position: relative;float: right;color: #dc3545;}

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



// =================================================== iteration-8 datatable ===================================================

jQuery(function() {
  var table = jQuery('#dataTable').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: '{!! route('tracker.dataTable') !!}',
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
          // { data: 'city', name: 'city' },
          { data: 'email', name: 'email' },
          { data: 'phone', name: 'phone' },
          // { data: 'created_at', name: 'created_at' },
          { data: 'profile', name: 'profile' },
          { data: 'select_job', name: 'select_job' },
          { data: 'job_status', name: 'job_status' },
          { data: 'ref_check', name: 'ref_check' },
          { data: 'tests', name: 'tests' },
          { data: 'interviews', name: 'interviews' },
          { data: 'notes', name: 'notes' },
          // { data: 'action', name: 'action' }
      ],
   columnDefs: [
      {
       'targets': 0,
       'searchable':false,
       'orderable':false,
       'className': 'dt-body-center',
       'render': function (data, type, full, meta){
           return '<input type="checkbox" name="cbx[]" value="'+ $('<div/>').text(data).html() + '">';             
       }

      },
      {className: "ob_balance",targets: [8]}
    ],
  });


$('.filter_status').on('change', function(){
  var filter_status = $(this).val();
  // console.log('filter_status ', filter_status);
  var newpath = '{!! route('users') !!}/'+filter_status;
  window.location.href = newpath;
});



/*    $(document).on('click', 'tbody tr td.ob_balance', function(e){
    e.stopPropagation();
    currentEle = $(this);
    var data = $(this).text();
    $(this).html( '<input type="text" value="'+data+'" class="ob-balance"/>');
    $('.ob-balance').focus();
    });
    $(document).on('blur','.ob-balance',function(e) {
    var ob_balance = $('.ob-balance').val();
    console.log(ob_balance);
     $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
      jQuery.ajax({
      type: 'POST',
      url: base_url+"/update-status/",
      data: {"ob_balance": ob_balance},
      success: function(){
      }
      });
    currentEle.html($(".ob-balance").val());
    });*/





// =============================================== iteration-8 Get job of JobSeeker Modal ===============================================

$(document).on('click', '.userJobsModal', function(){
  var id = $(this).attr('user_id');
  $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
  $.ajax({
    type: 'GET',
    url: '{!! route('users.getJobs') !!}',
    data: {'id': id},
    success: function(data) {
      // console.log(' data ', data);
      $('.applyJobModalHeader').html(data);
    }
  });
});

    // =============================================== iteration-8 Select job of JobSeeker Modal ===============================================

    $(document).on('click', '.selectJobButton' , function(){
      var id = $(this).val();
      var user_id = $('.user_id').val();
      // var job_title = $('.job_title').val();
      // console.log(job_title);

      var status = $(this).siblings('.row').find('.status').attr('data-status');
      var title = $(this).parents('.bgColor').find('.job_title').val();
      console.log(title);
      var abc = $('.jobStatus_'+user_id ).text(status);
      $('.jobStatus_'+user_id ).attr('jobapp_id' , id);
      $('.jobTitle_'+user_id ).text(title);
      $('.jobStatus_'+user_id ).addClass('changeJobStatusButton');
      // console.log(bcd);

      $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
      $.ajax({
        type: 'POST',
        url: '{!! route('jobs.defaultJobApplication') !!}',
        data: {'jobApp_id': id , 'user_id': user_id},
        success: function(data) {
          console.log(' data ', data);
        }
      });


    });


    // =============================================== iteration-8 on Click get job Status ===============================================

    $(document).on('click' , '.changeJobStatusButton' , function(){

      var user_id = $(this).attr('user_id');

      // var user_id = $('.user_id').val();

      $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
      $.ajax({
        type: 'POST',
        url: '{!! route('jobs.changesStatus') !!}',
        data: {'id': user_id},
        success: function(data) {
          console.log(' data ', data);
          // $('.applyJobModalHeader').html(data);/
           // $('#dataTable').DataTable().ajax.reload();
          $('.jobStatus_'+user_id ).html(data);
          $('.jobStatus_'+user_id ).removeClass('changeJobStatusButton');
          // $('.jobStatus_'+user_id ).addClass('changeJobStatus');
        }
      });

    });


  // =============================================== iteration-8 on Click change job Status ===============================================

    $(document).on('change' , '.changeJobStatus ' , function(){

      var status = $(this).val();

      // console.log(status);
      var user_id = $(this).closest('.jobStatus').attr('user_id');

      // console.log(user_id);

      var jobapp_id = $(this).closest('.jobStatus').attr('jobapp_id');
      // console.log(jobapp_id);

      $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
      $.ajax({
        type: 'POST',
        url: '{!! route('jobs.changesJobStatusConfirm') !!}',
        data: {'status':status, 'user_id':user_id, 'jobapp_id':jobapp_id},
        success: function(data) {
          // console.log(' data ', data);

          $('#dataTable').DataTable().ajax.reload();

        }
      });

    });



    // =============================================== iteration-8 notes ===============================================

    $(document).on('click' , '.addNotesField' , function(){
      // e.preventDefault();
      // console.log('hi add note field');
      $(this).siblings('.inputType').removeClass('d-none');
      $(this).addClass('d-none');
    });

    $(document).on('change' , '.inputType' , function (){
        var text = $(this).val();
        console.log(text); 
        var user_id = $(this).attr('user_id');
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
          type: 'POST',
          url: '{!! route('users.addUsersNote') !!}',
          data: {'text': text , 'user_id':user_id },
          success: function(data) {
             $('#dataTable').DataTable().ajax.reload(); 
          }
        });

      });


    // =============================================== iteration-8 update notes ===============================================


    $(document).on('click' , '.adminNote', function(){
      $(this).parents('td').find('.newNote').removeClass('d-none');
      $(this).parents('.noteDiv').addClass('d-none');
    });

    $(document).on('change' , '.newNoteInput', function(){
      var user_id = $(this).attr('user_id');
      var text = $(this).val();
      // console.log(text);
      $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
          type: 'POST',
          url: '{!! route('users.updateNote') !!}',
          data: {'text': text , 'js_id':user_id },
          success: function(data) {
             $('#dataTable').DataTable().ajax.reload(); 
          }
        });


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
           $('#dataTable').DataTable().ajax.reload();
           
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



});
</script>
@stop
