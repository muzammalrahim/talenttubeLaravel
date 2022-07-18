{{-- <div  class="full-height"> --}}

@extends('web.employer.employermaster')
@section('content')
<section class="row">
   <div class="col-md-12">
      <div class="profile profile-section">
         <div class="row filter-section py-2 mb-5" >
            <h2>Welcome to Interview Concierge</h2>
            <div class="job_row_heading jobs_filter row pb-2" style="color: ">
               <a  class="blue_btn my-3 text-center py-1 col-12 col-md-5 col-lg-5 mx-md-3 mx-lg-3" href="{{route('interviewconcierge.new')}}">Click here to create a new Booking Schedule</a> 
               <a  class="orange_btn my-3 text-center py-1 col-12 col-md-5 col-lg-5 mx-md-3 mx-lg-3" href="{{route('interviewconcierge.edit')}}">Click here to edit an existing Booking Schedule</a>
            </div>
         </div>
         {{-- <div class="row">
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
         </div> --}}

            <div class="table-responsive">
              <table class="table table-striped tableResponsive">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">ID</th>
                    <th scope="col">Company</th>
                    <th scope="col">Position</th>
                    <th scope="col">Bookings</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($interview as $int)
                    <tr>
                        {{-- <th scope="row">1</th> --}}
                        <td> {{ $loop->index+1 }} </td>
                        <td>{{$int->uniquedigits}}</td>
                        <td>{{$int->companyname}}</td>
                        <td>{{$int->positionname}}</td>
                        <td class="text-center">{{($int->interviewBookings)?($int->interviewBookings->aggregate):0}}</td>
                        <td><a href="{{route('interviewconciergeEdit',['id' => $int->id])}}"> <i class="fas fa-edit pl-3"></i></a></td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
      </div>
   </div>
</section>
@stop

{{-- </div> --}}
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


   html, body {
  height: 100%;
  margin: 0;
}
.full-height {
  height: 100%;
 background: #f3f5f9;
}

@media only screen and (max-width: 600px) {
.tableResponsive{
    width: 50rem !important;
    margin: 0 auto !important;

}
}

@media only screen and (max-width: 479px){
    a.blue_btn.my-3.text-center.py-1.col-12.col-md-5.col-lg-5.mx-md-3.mx-lg-3, a.orange_btn.my-3.text-center.py-1.col-12.col-md-5.col-lg-5.mx-md-3.mx-lg-3{
        height: unset !important;
        font-size: 14px !important;
        padding: 7px 10px !important;
    }
}

@media only screen and (max-width: 815px){
    a.blue_btn.my-3.text-center.py-1.col-12.col-md-5.col-lg-5.mx-md-3.mx-lg-3, a.orange_btn.my-3.text-center.py-1.col-12.col-md-5.col-lg-5.mx-md-3.mx-lg-3{
        height: unset !important;
        font-size: 14px !important;
        padding: 7px 10px !important;
    }
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
{{-- <script type="text/javascript">
   jQuery(function(){
      function rescaletable(){
         var width = jQuery('.table-responsive').width();
         var scale;
         if (width < 500)
         {
            scale = width / 500;
         } else{
            scale = 1.0;
         }
         jQuery('.tableResponsive').css('transform', 'scale(' + scale + ')');
         jQuery('.tableResponsive').css('-webkit-transform', 'scale(' + scale + ')');
         jQuery('.tableResponsive').css('transform-origin', '0 0');

         jQuery('.tableResponsive').css('-webkit-transform-origin', '0 0');
      }
      rescaletable();
      jQuery( window ).resize(function() { rescaletable(); });
   });
</script> --}}
@stop