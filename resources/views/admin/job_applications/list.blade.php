@extends('adminlte::page')

@section('title',$title)

@section('content_header')

<div class="block row">
    <div class="col-md-6"><h1 class="m-0 text-dark">{{$content_header}}</h1></div>
  {{--   <div class="col-md-6">
        <div class="float-right">
            <a href="{!! route('jobs.create') !!}" class="btn btn-block btn-success">Add New</a>
        </div>
    </div> --}}
</div>

@stop


{{-- @include('admin.errors',[ 'error' => $errors, 'record' => $record ]) --}}

@section('content')

@include('admin.errors')
@include('admin.success')

{{-- @dump( $jobs->toArray() ) --}}

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

    <div class="dtActions">
        <button class="btn btn-success btn-sm pull-right btnExportCSV">Export CVS</button>
    </div>

</div>




<table class="table table-bordered text-center cbxDataTable" id="dataTable"t>
    <thead>
        <tr style = "text-align: center">
            <th><input name="select_all" value="1" id="cbx_all" type="checkbox" /></th>
            <th>status</th>
            <th>JobSeeker</th>
            <th>Job</th>
            <th>goldstar</th>
            <th>preffer</th>
            {{-- <th>experience</th> --}}
            {{-- <th>created_at</th> --}}
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



{{-- BulkCSV download --}}
<div class="d-none">
  <form method="POST" class="bulkCSVExportForm" action="{{route('jobApplication.exportCSV')}}">
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
<script>
jQuery(function() {
    var tableObj = jQuery('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: '{!! route('job.jobAppDatatable') !!}',
          data: function (d) {
                d.filter_job = $('#filter_job').val()
            }
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'status', name: 'status' },
            { data: 'user_id', name: 'user_id' },
            { data: 'job_id', name: 'job_id' },
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
             return '<input type="checkbox" name="cbx[]" value="'+ $('<div/>').text(data).html() + '">';
         }
      }],
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

 


});
</script>
@stop



@section('css')
<link rel="stylesheet"  href="{{ asset('css/admin_custom.css') }}">
<style type="text/css">
.JobAppDatatable_filter{ display: none;  }
</style>
@stop
