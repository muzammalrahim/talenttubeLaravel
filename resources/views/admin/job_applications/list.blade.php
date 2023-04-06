@extends('adminlte::page')

@section('title',$title)

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


@section('content_header')


<div class="block row">
    <div class="col-md-3"><h1 class="m-0 text-dark">{{$content_header}}</h1></div>

</div>


<hr>


@stop


{{-- @include('admin.errors',[ 'error' => $errors, 'record' => $record ]) --}}

@section('content')

@include('admin.errors')
@include('admin.success')


{{-- @dump( $jobs->toArray() ) --}}


<div class="form-group row">
  


  {{-- <div class="col-md-8 mt-2"> --}}
    {{-- <div class="dtHeader"> --}}
        {{-- <div class="dtFilter dtHead"> --}}
            <label class="dtFilterLabel col-sm-2 col-form-label">Select Job</label>
            <div class="col-6"> 
                <select name="filter_job[]" multiple="multiple" id="filter_job" placeholder = "Filter by Job" class="multi-select form-control custom-select">
                    {{-- <option value="">Filter By Job</option> --}}
                    @if(!empty($jobs))
                        @foreach ($jobs as $job)
                            <option value="{{$job->id}}"  {{($request->job_id && $request->job_id == $job->id)?'selected="selected"':''}}> {{$job->title}}  ({{ ($job->applicationCount)?($job->applicationCount->aggregate):0 }})</option>
                        @endforeach
                    @endif
                </select>
            </div>
        {{-- </div> --}}
      {{-- </div> --}}
  {{-- </div> --}}


</div>



{{-- <div class="row mb-3"> --}}

  {{-- <div class="col-md-3 mt-2">
    <div class="dtHeader">
        <div class="dtFilter dtHead">
            <label class="dtFilterLabel">Select Job</label>
            <select name="filter_job" id="filter_job">
                <option value="">Filter By Job</option>
                @if(!empty($jobs))
                    @foreach ($jobs as $job)
                        <option value="{{$job->id}}"  {{($request->job_id && $request->job_id == $job->id)?'selected="selected"':''}}> {{$job->title}}  ({{ ($job->applicationCount)?($job->applicationCount->aggregate):0 }})</option>
                    @endforeach
                @endif
            </select>

        </div>
      </div>
  </div> --}}

{{-- </div>

<div class="row" style="margin-bottom: 15px;">
 --}}

  <div class="block row text-white mb-3 margin_auto justify-content-center">

    <div class="mb-2 bulkButton mr-1"><a class="btn btn-block btn-sm btn-primary btnBulkApproved" style="margin-right:5px;">Bulk Assign</a></div>
    <div class="mb-2 bulkButton mr-1"><a class="btn btn-block btn-sm btn-primary btnBulkPDFGenerate">Bulk Snapshot</a></div>
    <div class="mb-2 bulkButton mr-1"><a class="btn btn-block btn-sm btn-primary btnBulkPDFGeneratePremium">Bulk Premium Snapshot</a></div>
    <div class="mb-2 bulkButton mr-1"><a class="btn btn-block btn-sm btn-primary btnExportCSV">Bulk Export CSV</a></div>
    <div class="mb-2 bulkButton mr-1"><a class="btn btn-block btn-sm btn-primary btnBulkEmail">Bulk Email</a></div>
    <div class="mb-2 bulkButton mr-1"><a class="btn btn-block btn-sm btn-primary btnBulkCompileCV">Bulk Compile CV</a></div>
    <div class="mb-2 bulkButton mr-1"><a class="btn btn-block btn-sm btn-primary btnBulkStatus ml-1">Multi Bulk Status</a></div>
    <div class="mb-2 bulkButton ml-2"><a class="btn btn-block btn-sm btn-primary bulkInterview">Bulk Interview</a></div>
    <div class="mb-2 bulkButton ml-2"><a class="btn btn-block btn-sm btn-primary bulkPool">Bulk Pool</a></div>
    <div class="mb-2 bulkButton ml-2"><a class="btn btn-block btn-sm btn-primary" onclick="bulkTestingButtonJobApp()" >Bulk Testing</a></div>

    {{-- <div class="col-md-2"><a class="btn btn-block btn-primary ">Bulk Apply To Job</a></div> --}}
  </div>
{{-- </div> --}}

{{-- <div class="col-md-2">
    <div class="dtActions">
        <button class="btn btn-success btn-sm pull-right btnExportCSV">Export CVS</button>
    </div>
</div> --}}



<table class="table table-bordered text-center cbxDataTable" id="dataTable">

    <thead>
        <tr style = "text-align: center">
            <th><label>Bulk Select</label><input name="select_all" value="1" id="cbx_all" type="checkbox" /></th>
            <th><label class="adminStatus">Status</label><input name="selecta_all" class="specialinputblue" title="Review" value="1" id="cxx_all" type="checkbox" /><input name="selecta_all" class="specialinputgreen" title="Interview" value="1" id="cyx_all" type="checkbox" /><input name="selecta_all" class="specialinputred" title="Unsuccessful" value="1" id="czx_all" type="checkbox" /></th>

            {{-- <th><label>Bulk Pool</label><input name="select_all" value="1" id="cbxp_all" type="checkbox" /></th> --}}

            <th>Status</th>
            <th>JobSeeker</th>
            <th>Job</th>
            <th>Detail</th>
            <th>Goldstar</th>
            {{-- <th>undesirable</th> --}}
            <th>Correspondance</th>
            <th> Suburb </th>
            <th>Mandatory Testing</th>
            <th>Interview</th>
            <th>Action</th>
        </tr>
    </thead>
</table>

{{--  ================================ View video , resume by clicking on icons ================================ --}}

@include('admin.job_applications.parts.view_video')

{{--  ================================ View video , resume by clicking on icons ================================ --}}

  
  {{-- Bulk Approved Pop Up End --}}

  <div id="ModalBulkApprovedInfo" class="modal fade ModalBulkApprovedInfo" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body p-3">
              <div class="modalContentUser">
              </div>
           </div>
           <div class="modal-footer text-center margin_auto">
                <button type="button" class="btn btn-default btn-md modelCancelAction" data-dismiss="modal">Cancel</button>
           </div>
        </div>
    </div>
  </div>
  
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
  <form method="POST" class="bulkCSVExportForm" action="{{route('jobApplication.exportCSV')}}">
    @csrf
    <div class="cbx_list">
    </div>
  </form>
</div>


<div class="d-none">
    <form method="POST" class="bulkPDFExportForm" action="{{route('bulk.generatePDFApplicant')}}">
      @csrf
      <div class="cbx_list">
      </div>
    </form>
</div>


<div class="d-none">
    <form method="GET" class="bulkEmailForm" action="{{route('bulkEmailApplicant.new')}}">
      @csrf
      <div class="cbx_list">
      </div>
    </form>
</div>


<div class="d-none">
    <form method="POST" class="BulkCompileCVForm" action="{{route('bulk.BulkGenerateCVPDFApplicant')}}">
      @csrf
      <div class="cbx_list">
      </div>
    </form>
</div>

<div class="d-none">
    <form method="POST" class="BulkInterviewForm" action="{{route('bulk.bulkInterview')}}">
      @csrf
      <div class="cbx_list">
      </div>
    </form>
</div>

<div class="d-none">
  <form method="GET" class="bulkTestingJobApp" action="{{ route('bulk.bulkTestingJobApp') }}">
      @csrf
    <div class="cbx_list">
      </div>
  </form>
</div>

<div class="d-none">
  <form method="POST" class="bulkPDFPremiumExportForm" action="{{route('bulk.generatePremiumPDFApplicant')}}">
    @csrf
    <div class="cbx_list">
    </div>
  </form>
</div>

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


{{-- ======================================================= Modal For getting tests ======================================================= --}}

<div class="modal fade right" id="getTestsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true" data-backdrop="false">
  <div class="modal-dialog modal-full-height modal-right modal-notify modal-info" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #343a40">
        <p class="heading lead text-white onlineTests_header">Online Tests</p>
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
            }
        });
}
jQuery(function() {
  $(document).on('click','.btnBulkApproved', function(){
  console.log(' btnBulkApproved click ');
  var UserInfoId = parseInt($(this).attr('user-id'));
  console.log(UserInfoId);
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
      url: base_url+'/admin/ajax/massJobApplySubmitApplicant',
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
           location.reload();

        }else{
           $('#ModalBulkApprovedInfo .modalContentUser').html(data.error);
        }
      }
  });
});


$(document).on('click','.btnBulkStatus', function(){
    var cxx = $('input[name="cxx"]:checked').map(function(){return $(this).val(); }).toArray();
    var cyx = $('input[name="cyx"]:checked').map(function(){return $(this).val(); }).toArray();
    var czx = $('input[name="czx"]:checked').map(function(){return $(this).val(); }).toArray();
  if(cxx.length <= 0 && cyx.length <= 0 && czx.length <= 0 ){
      alert('Please Select Checkboxes');
      return false;
    }
  var applyFormData = $('#job_apply_form').serializeArray();
  applyFormData[applyFormData.length] = { name: "cxx", value: cxx };
  applyFormData[applyFormData.length] = { name: "cyx", value: cyx };
  applyFormData[applyFormData.length] = { name: "czx", value: czx };

//   applyFormData.push(cbx);
   console.log(' form data  ', applyFormData);
  $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
  $.ajax({
      type: 'POST',
      url: base_url+'/admin/ajax/massStatusChange',
      data: applyFormData,
      beforeSend: function(){
        $('#dataTable_processing').css("display", "block");
      },
      success: function(data) {
        if(data.status==1){
            $('#cxx_all').prop('checked', false);
            $('#cyx_all').prop('checked', false);
            $('#czx_all').prop('checked', false);
            tableObj.ajax.reload();
        }else{
           alert("Couldn't changed status of applications. Contact Developer");
           $('#dataTable_processing').css("display", "none");
        }
      }
  });

});
    var tableObj = jQuery('#dataTable').DataTable({
        processing: true,
        order: [/*[ 1, 'asc' ], [ 3, 'asc' ],*/ [ 0, 'asc' ]],

        'language': {
            'loadingRecords': '&nbsp;',
            'processing': '<div class="spinner"></div>'
        },
        serverSide: true,
        ajax: {
          url: '{!! route('job.jobAppDatatable') !!}',
          data: function (d) {
                d.filter_job = $('#filter_job').val()
            }
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'id', name: 'id2' },
            // { data: 'js_id', name: 'js_id' },

            { data: 'status', name: 'status' },
            { data: 'user_id', name: 'user_id' },
            { data: 'job_id', name: 'job_id' },
            { data: 'profile', name: 'profile' },
            { data: 'goldstar', name: 'goldstar' },
            // { data: 'preffer', name: 'preffer' },
            { data: 'correspondance', name: 'correspondance' },
            { data: 'suburb', name: 'suburb' },
            { data: 'test_result', name: 'test_result' },
            { data: 'interview', name: 'interview'},
            { data: 'action', name: 'action'},
        ],
        columnDefs: [{
         'targets': 0,
         'searchable':false,
         'orderable':false,
         'className': 'dt-body-center',
         'render': function (data, type, full, meta){
             return '<input type="checkbox" name="cbx[]" value="'+ $('<div/>').text(data).html() + '">';
         }
      },{
         'targets': 1,
         'searchable':false,
         'orderable':false,
         'className': 'dt-body-center',
         'render': function (data, type, full, meta){
             return '<div><input type="checkbox" class="specialinputblue" title="Review" name="cxx" value="'+ $('<div/>').text(data).html() + '">'+'<input type="checkbox" class="specialinputgreen" title = "Interview" name="cyx" value="'+ $('<div/>').text(data).html() + '">'+'<input type="checkbox" class="specialinputred" name="czx" title = "Unsuccessful" value="'+ $('<div/>').text(data).html() + '"></div>';
         }
      },

        { "orderable": true, "targets": [2,3,4,8,9] },
        { "orderable": false, "targets": [5,6,7,10,11] },

/*      {
         'targets': 2,
         'searchable':false,
         'orderable':false,
         'className': 'dt-body-center',
         'render': function (data, type, full, meta){
             return '<input type="checkbox" name="cbxp[]" value="'+ $('<div/>').text(data).html() + '">';
            
         }
      },*/


      ],
    });

    $('#filter_job').change(function() { tableObj.ajax.reload();});


    //========================================================================//
    // Click on btnExportCSV.
    //========================================================================//
    $(document).on('click','.btnExportCSV', function(){
      console.log(' btnExportCSV click ');
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



});


  $(document).on('click','.bulkInterview', function(){
  console.log(' bulkInterview click ');
  var cbx = $('input[name="cbx[]"]:checked').map(function(){return $(this).val(); }).toArray();
    console.log(cbx);
    if(cbx.length <= 0){
      alert('Please Select Checkboxes');
      return false;
    }

      // return;

    var cbx_hidden =  '';
    cbx.forEach(function(id){ cbx_hidden += '<input type="hidden" name="cbx[]" value="'+id+'" />'  });
    $('.BulkInterviewForm .cbx_list').html(cbx_hidden);
    $('.BulkInterviewForm').submit();
  });

  // ================================================== Bulk Pool Ajax ==================================================




  $('#cbxp_all').on('click', function(event){
    var checked_status = this.checked;
    console.log(' checked_status ', checked_status, this );
    $.each($("input[name='cbx[]'"), function(){
      $(this).prop('checked', checked_status);
    });
  });


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
            url: base_url+'/admin/ajax/bulk/jobApplication/AddBulkJobseekerInPool',
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

// =============================================== iteration-8 Get job of JobSeeker Modal ===============================================

$(document).on('click', '.userTestsModal', function(){
  var id = $(this).attr('jobApp_id');
  // console.log(id);return;
  $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
  $.ajax({
    type: 'GET',
    url: '{!! route('getOnlineTestJobApplications') !!}',
    data: {'id': id},
    success: function(data) {
      // console.log(' data ', data);
      $('.onlineTests_header').text('Online Tests');
      $('.applyJobModalHeader').html(data);
    }
  });
});

// ==========================================================================================================
// Iteration-12
// ============================================== View Video ============================================== 

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
        // console.log(' data ', data);
        $('.ModaluserInfo  .modalContentUser').html(data);
      }
  });
});

// ============================================== View Resume ============================================== 


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


// $('#filter_job').multiSelect();

// =============================================== Get Gold Star questions and answers  ===============================================

// $(document).on('click', '.userTestsModal', function(){
    this.getGoldStarAnswers = function(jobApp_id){
        console.log(jobApp_id);
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
          $.ajax({
            type: 'GET',
            url: '{!! route('application_answers') !!}',
            data: {'id': jobApp_id},
            success: function(data) {
              // console.log(' data ', data);
              $('.onlineTests_header').text('Application Answers');
              $('.applyJobModalHeader').html(data);
            }
          });
    }
  // var id = $(this).attr('jobApp_id');
  // console.log(id);return;
/*  $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
  $.ajax({
    type: 'GET',
    url: '{!! route('getOnlineTestJobApplications') !!}',
    data: {'id': id},
    success: function(data) {
      // console.log(' data ', data);
      $('.onlineTests_header').text('Online Tests');
      $('.applyJobModalHeader').html(data);
    }
  });*/
// });

    $(document).on('click','.btnBulkPDFGeneratePremium',function(){
        var cbx = $('input[name="cbx[]"]:checked').map(function(){
            return $(this).val();
        }).toArray();
        if (cbx.length <1) {
            alert('Please select checkboxes');
        }else{
            var cbx_hidden = '';
            $.each(cbx,function(key,value){
                cbx_hidden += '<input type="hidden" name="cbx[]" value="'+value+'"/>'
            });

            // console.log(cbx_hidden);return;
            $('.bulkPDFPremiumExportForm .cbx_list').html(cbx_hidden);
            $('.bulkPDFPremiumExportForm').submit();
        }
    })

</script>
@stop



@section('css')
<link rel="stylesheet"  href="{{ asset('css/admin_custom.css') }}">
<style type="text/css">
.JobAppDatatable_filter{ display: none;  }


</style>
@stop


<script type="text/javascript">

$(document).ready(function() {
    $('#filter_job').select2();
    // allowClear: true,
    placeholder: "Leave blank to ..."
});

</script>