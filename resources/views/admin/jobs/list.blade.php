@extends('adminlte::page')

@section('title',$title)

@section('content_header')

<div class="block row">
    <div class="col-md-6"><h1 class="m-0 text-dark">{{$content_header}}</h1></div>
    <div class="col-md-6">
        <div class="float-right">
            <a href="{!! route('jobs.create') !!}" class="btn btn-block btn-success">Add New</a>
        </div>
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
            <th>id.</th>
            <th>title</th>
            <th>country</th>
            <th>state</th>
            <th>city</th>
            <th>experience</th>
            <th>created_at</th>
            {{-- <th>created_by</th> --}}
            <th>action</th>
        </tr>
    </thead>
  </table>

<div id="deleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
                 <!-- Modal content-->
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
</div>


@stop


@section('css')
    <link rel="stylesheet"  href="{{ asset('css/admin_custom.css') }}">
    <style type="text/css">
        
        .modal.showProcessing  .modalContent{ display: none;  }
        .modal.showProcessing  .modelProcessing{ display: block !important;  }

        #delConfirmId{
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
            ajax: '{!! route('jobs.dataTable') !!}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'title', name: 'title' },
                // { data: 'description', name: 'description' },
                // { data: 'type', name: 'type' },
                { data: 'country', name: 'country' },
                { data: 'state', name: 'state' },
                { data: 'city', name: 'city' },
                { data: 'experience', name: 'experience' },
                { data: 'created_at', name: 'created_at' },
                // { data: 'created_by', name: 'created_by' },
                { data: 'action', name: 'action'},
            ]
        });
    });
</script>
@stop
