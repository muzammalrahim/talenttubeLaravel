@extends('web.employer.employermaster')
@section('content')
<section class="row">
   <div class="col-md-12">
      <div class="profile profile-section">
         <div class="row filter-section py-2 mb-5" >
            <h2>Welcome to Interview Concierge</h2>
            <div class="job_row_heading jobs_filter d-flex pb-2" style="color: ">
               <a  class=" blue_btn mx-3 text-center py-1" href="{{route('interviewconcierge.new')}}">Click here to create a new Booking Schedule</a> <br>
               <a  class=" orange_btn mx-3 text-center py-1" href="{{route('interviewconcierge.edit')}}">Click here to edit an existing Booking Schedule</a>
            </div>
         </div>
         <div class="row">
            <h4 class=" py-2 font-weight-bold"> My Booked Interviews</h4>
            <table class="table table-striped table-hover table-bordered">
               <thead class=" text-white " style="background:#2672AB;">
                  <tr>
                     <th>Company</th>
                     <th>Booking Id</th>
                     <th>Position</th>
                     <th>Managers</th>
                     <th>Booking</th>
                     <th>Actions</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($interview as $int)
                  <tr>
                     <td>{{$int->companyname}}</td>
                     <td>{{$int->uniquedigits}}</td>
                     <td>{{$int->positionname}}</td>
                     <td>{{$int->additionalmanagers}}</td>
                     <td>{{($int->interviewBookings)?($int->interviewBookings->aggregate):0}}</td>
                     <td><a href="{{route('interviewconciergeEdit',['id' => $int->id])}}"><i class="fas fa-edit text-white p-2" style="background: #F48128; border-radius: 5px;"></i></a></td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
   </div>
</section>
@stop
@section('custom_footer_css')
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
   }
</style>
@stop
@section('custom_js')
{{-- <script src="{{ asset('js/site/jquery.modal.min.js') }}"></script> --}}
{{-- <script src="{{ asset('js/site/jquery-ui.js') }}"></script> --}}
{{-- <script src="{{ asset('js/site/common.js') }}"></script> --}}
{{-- <script src="{{ asset('js/site/profile_photo.js') }}"></script>  --}}
{{-- <script src="{{ asset('js/site/gallery_popup/jquery.magnific-popup.js') }}"></script>  --}}
{{-- <script src="{{ asset('js/site/gallery_popup/lc_lightbox.lite.js') }}"></script> --}}
<script type="text/javascript"></script>
@stop