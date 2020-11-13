<div  class="full-height">
@extends('mobile.user.usermaster')

@section('content')
<div class="card newJobCont "> 

    <div class="card-header responsive_header  jobAppHeader icon_head_browse_matches head_concierge_botmline">Welcome to Mobile Interview Concierge</div> 
   
			<div class="card-body c_bg">
			
			 <div class="add_new_job">
        <div class="job_row_heading jobs_filter"></div>
       <div> <a class="w50 job_anchorsTags" href="{{route('Minterviewconcierge.new')}}">Click here to create a new Booking Schedule</a> </div>
      <div class="mt-2">  <a class="w50 job_anchorsTags" href="{{route('Minterviewconcierge.edit')}}">Click here to edit an existing Booking Schedule</a></div>
    </div>

				<h4 class="h6 jobAppH6 mt-5"> My Booked Interviews</h4>

   <table class="table">
  <thead class="">
          <tr >
            <th scope="col" class="font-weight-bold">Company</th>
            <th scope="col" class="font-weight-bold">Position</th>
            <th scope="col" class="font-weight-bold">Action</th>
          </tr>
        </thead>
								
								<tbody>

           @foreach ($interview as $int) 
          <tr >
           <td class="pl-3">{{$int->companyname}}</td>
            <td class="pl-3">{{$int->positionname}}</td>
            <td> <i class="fas fa-edit pl-3"></i> </td>
          </tr>

          @endforeach

        </tbody>
      </table>

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
.job_anchorsTags {
    
    font: 16px Tahoma, Arial, Verdana, sans-serif;
}
</style>


@stop

@section('custom_js')


<script type="text/javascript">

</script>
@stop

