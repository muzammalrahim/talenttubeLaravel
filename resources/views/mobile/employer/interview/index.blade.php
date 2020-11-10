
@extends('mobile.user.usermaster')

@section('content')
<div class="newJobCont"> 

    {{-- <div class="head icon_head_browse_matches">Welcome to Mobile Interview Concierge</div> --}}
    <div class="add_new_job">
        <div class="job_row_heading jobs_filter"></div>
        <a class="w50" href="{{route('Minterviewconcierge.new')}}">Click here to create a new Booking Schedule</a> <br>
        <a class="w50" href="{{route('Minterviewconcierge.edit')}}">Click here to edit an existing Booking Schedule</a>
    </div>

    <h4 class="h6 jobAppH6 mt-3"> My Booked Interviews</h4>

      <table class="table">
        <thead>
          <tr >
            <th scope="col" class="font-weight-bold">Company</th>
            <th scope="col" class="font-weight-bold">Position</th>
            <th scope="col" class="font-weight-bold">Action</th>
          </tr>
        </thead>
        <tbody>

           @foreach ($interview as $int) 
          <tr>
           <td>{{$int->companyname}}</td>
            <td>{{$int->positionname}}</td>
            <td> <i class="fas fa-edit"></i> </td>
          </tr>

          @endforeach

        </tbody>
      </table>
      
    
</div>

@stop

@section('custom_footer_css')

@stop

@section('custom_js')


<script type="text/javascript">

</script>
@stop

