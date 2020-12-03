<div  class="full-height">
@extends('mobile.user.usermaster')

@section('content')
<div class="card newJobCont ">
   <div class="card-header responsive_header  jobAppHeader icon_head_browse_matches head_concierge_botmline font-weight-bold pb-3">Welcome to Mobile Interview Concierge</div>
   <div class="card-body c_bg">
      <div class="add_new_job">
         <div class="job_row_heading jobs_filter"></div>
         <div class = "IncConNew mb-2"> 
            <a class="w50 font-14" href="{{route('Minterviewconcierge.new')}}">Click here to create a new Booking Schedule</a> 
         </div>
         <div class = "intConEdit mb-3">  
            <a class="intConEditRoute font-14" href="{{route('Minterviewconcierge.edit')}}">Click here to edit an existing Booking Schedule</a>
         </div>
      </div>
      <h6 class="bookedInterview mb-o"> My Booked Interviews</h6>


{{-- 
      <table class="table">
         <thead class="">
            <tr >
               <th scope="col" class="font-weight-bold">Company</th>
               <th scope="col" class="font-weight-bold">Booking ID</th>
               <th scope="col" class="font-weight-bold">Action</th>
            </tr>
         </thead>
         <tbody>
            @foreach ($interview as $int) 
            <tr >
               <td class="pl-3">{{$int->companyname}}</td>
               <td class="pl-3">{{$int->uniquedigits}}</td>
               <td> <a href="{{route('MinterviewconciergeEdit',['id' => $int->id])}}"> <i class="fas fa-edit pl-3"></i> </td>
            </tr>
            @endforeach
         </tbody>
      </table> --}}

{{--       <div class="row font-weight-bold font-14">
         <div class="col-3"> Company</div>
         <div class="col-3"> Position</div>
         <div class="col-3"> Bookings</div>
         <div class="col-3"> Action</div>
      </div>
      @foreach ($interview as $int)
      <div class="row py-2 font-14">
        <div class="col-3">{{$int->companyname}}</div>
        <div class="col-3">{{$int->positionname}}</div>
        <div class="col-3"> {{($int->interviewBookings)?($int->interviewBookings->aggregate):0}} </div>
        <div class="col-3"><a href="{{route('MinterviewconciergeEdit',['id' => $int->id])}}"> <i class="fas fa-edit text-primary"></i></a></div>
      </div>
      @endforeach --}}




      {{-- Table --}}
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
        <td><a href="{{route('MinterviewconciergeEdit',['id' => $int->id])}}"> <i class="fas fa-edit pl-3"></i></a></td>

    </tr>

      @endforeach
  </tbody>
</table>
</div>

{{-- Table end here --}}

   </div>
</div>

@stop

@section('custom_footer_css')
</div>
<style>
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
    width: 495px !important;
    margin: 0 auto !important;

}
}

</style>


@stop

@section('custom_js')


<script type="text/javascript">
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
</script>
@stop

