{{-- @extends('site.user.usertemplate') --}}
@extends('mobile.user.usermaster')

@section('content')
<div class="card">
    <div class="card-header jobAppHeader p-2 jobInfoFont"> Interview Created</div>

    <div class="card-body jobAppBody p-1 font-14">
      
  
    <p class="font_s">Good news, your booking is now created, booking ID {{$interview->uniquedigits}}. You can now Select Job Seekers from your liked list to invite to interview, manually enter own Job Seeker details below to receive notification about the interviews, or send the below link directly to anyone you'd like interview</p>
    <hr class="new">
      
          <div> 
              <a  class="w50 Afont_s" href="{{route('Minterviewconcierge.getlikedlistjobseekers')}}">Click here to invite job Seekers from your liked list</a>
          </div>
          <div> 
            <a   class="w50 Afont_s"  href="{{route('Minterviewconcierge.manualjobseekers')}}">Click here to manually enter Job Seeker contact details</a>
          </div>
          <div>
            <a  class="w50 Afont_s"  href="{{route('Minterviewconcierge.url')}}">Click here to access the unique URL to send to Job Seekers</a>
          </div>
          @php
           session()->put('bookingid',$interview->id);
          @endphp
          <a  class="w50 Afont_s"  href="{{route('MunidigitEdit')}}">Click here to edit Booking ID Number</a>

    </div>
</div>

@stop

@section('custom_footer_css')


<style>
a.w50.Afont_s {
    text-decoration: underline;
}
</style>
@stop

@section('custom_js')

<script type="text/javascript">
</script>
@stop

