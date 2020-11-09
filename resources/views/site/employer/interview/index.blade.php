{{-- @extends('site.user.usertemplate') --}}
@extends('site.employer.employermaster')

@section('custom_css')
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

@stop

@section('content')
<div class="newJobCont">

    <div class="head icon_head_browse_matches">Welcome to Interview Concierge</div>
    <div class="add_new_job">
        <div class="job_row_heading jobs_filter"></div>
        <a class="w50" href="{{route('interviewconcierge.new')}}">Click here to create a new Booking Schedule</a> <br>
        <a class="w50" href="{{route('interviewconcierge.edit')}}">Click here to edit an existing Booking Schedule</a>
    </div>

    <h4 class="text-center py-2 font-weight-normal"> My Booked Interviews</h4>

    {{-- @dump($interview) --}}

    
      {{-- <h5 class="text-center"> {{ $int->title}}</h5> --}}

{{--       <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th class="th-sm">Title </th>
              <th class="th-sm">Position</th>
              <th class="th-sm">Company</th>
              <th class="th-sm">Mangers</th>
              <th class="th-sm">Edit</th>
           
            </tr>
          </thead>

          @foreach ($interview as $int)
          <tbody>
            
            <tr>
              <td>{{$int->title}}</td>
              <td>{{$int->companyname}}</td>
              <td>{{$int->positionname}}</td>
              <td>{{$int->additionalmanagers}}</td>
              <td><a href="{{route('interviewconcierge.edit')}}"> <i class="fas fa-edit text-primary"></i></a></td>
        
            </tr>
          </tbody>
           @endforeach
        </table> --}}


      <div class="row font-weight-bold p-2">
        {{-- <div class="col-md-2">Sr#</div> --}}
        <div class="col-md-3">Company</div>
        <div class="col-md-3">Position</div>
        <div class="col-md-3">Mangers</div>
        <div class="col-md-3">Action</div>
      </div> 
      
   @foreach ($interview as $int)

      <div class="row p-2">
     {{--    @for($x = 1; $x <=$interview->count(); $x++)
         
        @endfor --}}
        
        {{-- <div class="col-md-2">{{$x}}</div> --}}
        <div class="col-md-3">{{$int->companyname}}</div>
        <div class="col-md-3">{{$int->positionname}}</div>
        <div class="col-md-3">{{$int->additionalmanagers}}</div>
        <div class="col-md-3"><a href="{{route('interviewconcierge.edit')}}"> <i class="fas fa-edit text-primary"></i></a></div>
      </div> 
      
     

    @endforeach
    

<div class="cl"></div>
</div>

@stop

@section('custom_footer_css')
<link rel="stylesheet" href="{{ asset('css/site/profile.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}">
{{-- <link rel="stylesheet" href="{{ asset('css/site/gallery_popup/magnific-popup.css') }}"> --}}
{{-- <link rel="stylesheet" href="{{ asset('css/site/gallery_popup/lc_lightbox.css') }}"> --}}
<style>

.button {
  background-color: rgb(31, 120, 236);
  border-radius: 5px;
  color: white;
  padding: .5em;
  text-decoration: none;
  margin-top: 20px !important;
  margin-bottom: 20px !important;
  display:block
}

.button:focus,
.button:hover {
  background-color: rgb(52, 49, 238);
  color: White;
}
.col{padding-left: 0px; padding-right: 0px;}
.col_fix>ul li {
    width: 100%;
}


table.dataTable thead .sorting:after,
table.dataTable thead .sorting:before,
table.dataTable thead .sorting_asc:after,
table.dataTable thead .sorting_asc:before,
table.dataTable thead .sorting_asc_disabled:after,
table.dataTable thead .sorting_asc_disabled:before,
table.dataTable thead .sorting_desc:after,
table.dataTable thead .sorting_desc:before,
table.dataTable thead .sorting_desc_disabled:after,
table.dataTable thead .sorting_desc_disabled:before {
  bottom: .5em;
}

tbody {
 border:1px solid black;
  /*border-radius: 5px;*/
}
</style>

@stop

@section('custom_js')
<script src="{{ asset('js/site/jquery.modal.min.js') }}"></script>
<script src="{{ asset('js/site/jquery-ui.js') }}"></script>
<script src="{{ asset('js/site/common.js') }}"></script>
{{-- <script src="{{ asset('js/site/profile_photo.js') }}"></script>  --}}
{{-- <script src="{{ asset('js/site/gallery_popup/jquery.magnific-popup.js') }}"></script>  --}}
{{-- <script src="{{ asset('js/site/gallery_popup/lc_lightbox.lite.js') }}"></script> --}}

<script type="text/javascript">

</script>
@stop

