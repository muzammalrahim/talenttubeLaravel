@extends('adminlte::page')

@section('title',$title)

@section('content_header')




<div class="container">

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5"><h4 class="card-title mb-0">{{ __('Reference Info') }}</h4></div>
            </div>
            <hr>
            <div class="row mt-4 mb-4">
                <div class="col">

                    {{-- Adding Tab Start --}}

                    <div class="col-12 col-sm-6 col-lg-12">
                        <div class="card card-primary card-tabs">

                            <div class="card-header p-0 pt-1 tabColor"style="background: #6c757d;">
                                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">

                                  <li class="nav-item col-lg-3">
                                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true"><b>General</b></a>
                                  </li>

                                 {{--  <li class="nav-item col-lg-3">
                                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false"><b>User Information</b></a>
                                  </li>

                                  <li class="nav-item col-lg-3">
                                    <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false"><b>Questions</b></a>
                                  </li>

                                  <li class="nav-item col-lg-3">
                                    <a class="nav-link" id="custom-tabs-one-private-tab" data-toggle="pill" href="#custom-tabs-one-private" role="tab" aria-controls="custom-tabs-one-private" aria-selected="false"><b>Private Gallery</b></a>
                                  </li> --}}

                                </ul>
                            </div>

                            <div class="card-body">

                                <div class="tab-content" id="custom-tabs-one-tabContent">

                                    @if ($reference->refType == 'Work Reference'){
                                        @include('admin.crossReference.tabs.workreference_tab') {{-- admin/crossReference/tabs/workreference_tab --}} 

                                    @elseif($reference->refType == 'Personal Reference')
                                    
                                        @include('admin.crossReference.tabs.personalreference_tab') {{-- admin/crossReference/tabs/personalreference_tab --}} 
                                    @else
                                        @include('admin.crossReference.tabs.educationalreference_tab')

                                    }

                                    @endif


                                </div> <!-- tab-content end -->
                            </div>

                          <!-- /.card -->
                        </div>
                    </div>
                            {{-- Adding Tab End --}}
                </div><!--col-->


            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                {{-- <div class="col"><a class="btn btn-danger btn-sm" href=" {!! route('users') !!}">Cancel</a></div> --}}
                {{-- <div class="col text-right"><button class="btn btn-success btn-sm pull-right" type="submit">Update</button></div> --}}
            </div>
        </div><!--card-footer-->

    </div><!--card-->


</div>


@stop


{{-- @include('admin.errors',[ 'error' => $errors, 'record' => $record ]) --}}



@section('content')

@include('admin.errors')
@include('admin.success')


@stop

@section('css')

 <link rel="stylesheet"  href="{{ asset('css/admin_custom.css') }}">
  

@stop


@section('plugins.Datatables') @stop

@section('js')


<script src="{{ asset('js/admin_custom.js') }}"></script>

<script type="text/javascript">
    function scrollToTop() {
      window.scrollTo(0, 0);
}
</script>
@stop



