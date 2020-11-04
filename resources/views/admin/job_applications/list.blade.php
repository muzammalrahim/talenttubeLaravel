@extends('adminlte::page')

@section('title',$title)

@section('content_header')

<div class="block row">
    <div class="col-md-3"><h1 class="m-0 text-dark">{{$content_header}}</h1></div>

</div>

@stop


{{-- @include('admin.errors',[ 'error' => $errors, 'record' => $record ]) --}}

@section('content')

@include('admin.errors')
@include('admin.success')


{{-- @dump( $jobs->toArray() ) --}}
<div class="row" style="margin-bottom: 15px;">

  <div class="col-md-3 mt-2">
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
  </div>

  <div class="block row mt-4 col-md-9 text-white">


    <div class="col-md-1.5 bulkButton mr-1"><a class="btn btn-block btn-primary btnBulkApproved mt-1" style="margin-right:5px;">Bulk Assign Job</a></div>
    <div class="col-md-1.5 bulkButton mr-1"><a class="btn btn-block btn-primary btnBulkPDFGenerate mt-1">Bulk Snapshot</a></div>
    <div class="col-md-1.5 bulkButton mr-1"><a class="btn btn-block btn-primary btnExportCSV mt-1">Bulk Export CSV</a></div>
    <div class="col-md-1.5 bulkButton mr-1"><a class="btn btn-block btn-primary btnBulkEmail mt-1">Bulk Email</a></div>
    <div class="col-md-1.5 bulkButton"><a class="btn btn-block btn-primary btnBulkCompileCV mt-1">Bulk Compile CV</a></div>
    <div class="col-md-1.5 bulkButton"><a class="btn btn-block btn-primary btnBulkStatus ml-1 mt-1">Multi Bulk Status</a></div>
    {{-- <div class="col-md-2"><a class="btn btn-block btn-primary ">Bulk Apply To Job</a></div> --}}
  </div>
</div>

{{-- <div class="col-md-2">
    <div class="dtActions">
        <button class="btn btn-success btn-sm pull-right btnExportCSV">Export CVS</button>
    </div>
</div> --}}



<table class="table table-bordered text-center cbxDataTable" id="dataTable">

    <thead>
        <tr style = "text-align: center">
            <th><label>Bulk Select</label><input name="select_all" value="1" id="cbx_all" type="checkbox" /></th>
            <th><label class="adminStatus">Status</label><input name="selecta_all" class="specialinputblue" value="1" id="cxx_all" type="checkbox" /><input name="selecta_all" class="specialinputgreen" value="1" id="cyx_all" type="checkbox" /><input name="selecta_all" class="specialinputred" value="1" id="czx_all" type="checkbox" /></th>
            <th>status</th>
            <th>JobSeeker</th>
            <th>Job</th>
            <th>Profile</th>
            <th>goldstar</th>
            <th>undesirable</th>
            <th>action</th>
        </tr>
    </thead>
  </table>

{{-- <div id="deleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
             </div>
             <div class="modal-body">

                <div class="modalContent">
                    <p>Do you want to Delete <b><span id="delConfirmId"></span></b> Job ?</p>

                </div>

                <div class="modelProcessing" style="display: none;">
                        <h4>Deleting job...</h4>
                 </div>

             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-danger" id="removejob" style="margin: 0 auto">Yes</button>
              <input type="hidden" name="deleteConfirm" id="deleteConfirm" value="">
             </div>

        </div>
    </div>
</div> --}}

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
{{-- BulkCSV download end --}}

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
jQuery(function() {


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
            { data: 'status', name: 'status' },
            { data: 'user_id', name: 'user_id' },
            { data: 'job_id', name: 'job_id' },
            { data: 'profile', name: 'profile' },
            { data: 'goldstar', name: 'goldstar' },
            { data: 'preffer', name: 'preffer' },
            { data: 'action', name: 'action'},
        ],
        columnDefs: [{
         'targets': 0,
         'searchable':false,
         'orderable':false,
         'className': 'dt-body-center',
         'render': function (data, type, full, meta){
             return '<input type="checkbox" name="cbx" value="'+ $('<div/>').text(data).html() + '">';
         }
      },{
         'targets': 1,
         'searchable':false,
         'orderable':false,
         'className': 'dt-body-center',
         'render': function (data, type, full, meta){
             return '<div><input type="checkbox" class="specialinputblue" name="cxx" value="'+ $('<div/>').text(data).html() + '">'+'<input type="checkbox" class="specialinputgreen" name="cyx" value="'+ $('<div/>').text(data).html() + '">'+'<input type="checkbox" class="specialinputred" name="czx" value="'+ $('<div/>').text(data).html() + '"></div>';
         }
      },

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
</script>
@stop



@section('css')
<link rel="stylesheet"  href="{{ asset('css/admin_custom.css') }}">
<style type="text/css">
.JobAppDatatable_filter{ display: none;  }


</style>
@stop
