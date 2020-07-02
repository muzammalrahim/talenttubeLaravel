@extends('adminlte::page')

@section('title',$title)

@section('content_header')
<div class="block row">
    <div class="col-md-6"><h1 class="m-0 text-dark">{{$content_header}}</h1></div>
    <div class="col-md-6">
        <div class="float-right">
            <a href="{!! route('employers.create') !!}" class="btn btn-block btn-success">Add New</a>
        </div>
    </div>
</div>
@stop

@section('content')

<table class="table table-bordered" id="dataTable">
    <thead>
        <tr style = "text-align: center">
            <th>id.</th>
            <th>name</th>
            <th>email</th>
            <th>created_at</th>
            <th>action</th>
            {{-- <th>delete</th> --}}
        </tr>
    </thead>
  </table>

  <div id="deleteModalemp" class="modal fade" role="dialog">
    <div class="modal-dialog">
                 <!-- Modal content-->
        <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
             </div>
             <div class="modal-body">

                <div class="modalContentEmp">
                    <p>Do you want to Delete <b><span id="delConfirmIdEmp"></span></b> Employer ?</p>
                    
                </div>

                <div class="modelProcessingEmp" style="display: none;">
                        <h4>Deleting Employer...</h4>    
                 </div>

             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-danger" id="removeEmp" style="margin: 0 auto">Yes</button>
              <input type="hidden" name="deleteConfirmEmp" id="deleteConfirmEmp" value="">
             </div>

        </div>
    </div>
</div>

@stop

@section('css')
    <link rel="stylesheet"  href="{{ asset('css/admin_custom.css') }}">

    <style type="text/css">
        
        .modal.showProcessing  .modalContentEmp{
         display: none;  

        }
        
        .modal.showProcessing  .modelProcessingEmp{ 
            display: block !important;  
        }

        #delConfirmIdEmp{
            color:red;
        }

        td{
          text-align: center;
        }
    </style>

@stop

@section('plugins.Datatables')

@stop

@section('js')

<script src="{{asset('js/admin_employerdelete.js')}}"></script>

<script>
    jQuery(function() {
        jQuery('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('employers.dataTable') !!}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'created_at', name: 'created_at' },
                { data: 'action', name: 'action', },
                // { data: 'action', name: 'action', },
            ]
        });
    });
</script>
@stop
