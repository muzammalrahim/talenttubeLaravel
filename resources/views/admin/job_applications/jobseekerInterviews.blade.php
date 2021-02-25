@extends('adminlte::page')

@section('title',$title)

@section('content_header')

  <div class="block row">
    <div class="col-md-4"><h1 class="m-0 text-dark">{{$content_header}}</h1></div>
</div>

@stop

@section('content')

<div class="container">

  <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5"><h4 class="card-title mb-0">{{ __('Interviews of Jobseeker') }} <small class="text-muted">Edit Interview</small></h4></div>
            </div>
            <hr>
            <div class="row mt-4 mb-4">
                <div class="col">

                    {{-- ================================================== Adding Tab Start ================================================== --}}

                      <div class="col-12 col-sm-6 col-lg-12">
                        <div class="card card-primary card-tabs">
                          
                          <div class="card-header p-0 pt-1 tabColor"style="background: #6c757d;">
                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">

                              <li class="nav-item col-lg-6">
                                <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true"><b>Interview</b></a>
                              </li>

                              <li class="nav-item col-lg-6">
                                <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false"><b>Add New Interview</b></a>
                              </li>
                            </ul>
                          </div>

                          <div class="card-body">
                            <div class="tab-content" id="custom-tabs-one-tabContent">
                              @include('admin.job_applications.intTabs.tab1')
                              @include('admin.job_applications.intTabs.tab2')
                            </div> <!-- tab-content end -->
                          </div>
                          
                          <!-- /.card -->
                        </div>
                      </div>
                    {{-- ================================================== Adding Tab End ================================================== --}}

                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col"><a class="btn btn-danger btn-sm" href=" {!! route('users') !!}">Cancel</a></div>
                <div class="col text-right"><button class="btn btn-success btn-sm pull-right" type="submit">Update</button></div>
            </div>
        </div><!--card-footer-->

    </div><!--card-->

    

</div>

@stop

@section('css')
    <link rel="stylesheet"  href="{{ asset('css/admin_custom.css') }}">
@stop

@section('js')

  <script type="text/javascript" src="{{ asset('js/admin_custom.js') }}"></script>

    <!-- added by Hassan -->

    <script type="text/javascript"> var base_url = '{!! url('/') !!}';</script>

    <script type="text/javascript">
      

      $('#custom-tabs-one-home .btnNext').on('click', function (e) {
        e.preventDefault()
        $('#custom-tabs-one-profile-tab').tab('show')
      });

      $('#custom-tabs-one-profile .btnPrevious').on('click', function (e) {
        e.preventDefault()
        $('#custom-tabs-one-home-tab').tab('show')
      });


      function scrollToTop() { 
        window.scrollTo({top: 0, behavior: 'smooth' }); 
      }



      
  // ============================================ See Employers's Response hide & show jobseeker's info page ============================================

  $(document).on("click" , ".seeEmployerResponse" , function(){
    console.log('hi employer response button');
      $(this).parents('.employerResponseDiv').find('.employerResponse').slideToggle();
  });

    </script>
@stop

@section('plugins.Datatables')

@stop

