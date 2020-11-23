{{-- @extends('site.user.usertemplate') --}}
@extends('mobile.user.usermaster')

@section('content')
<div class="">
    <p class="font_s">Good news, your booking is now created, booking ID {{$interview->uniquedigits}}. You can now Select Job Seekers from your liked list to invite to interview, manually enter own Job Seeker details below to receive notification about the interviews, or send the below link directly to anyone you'd like interview</p>
    <hr class="new">
    <div>
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
        <a  class="w50 Afont_s"  href="{{route('Minterviewconcierge.formedit')}}">Click here to edit Booking ID</a>
    </div>
</div>

@stop

@section('custom_footer_css')


<style>
a:hover {
  text-decoration: underline;
		background-color: yellow;
}
.notbrak{
    display: inline-block;
}

.leftMargin{
    margin-left: 10px;
}

.topMargin{
    margin-top: 10px;
}

.textCenter{
   margin-left: 40%;
   padding-bottom: 10px !important;
}

.dynamicTextStyle{
    margin-left: 5px;
    margin-right: 5px;
}

.heading{

    font-size: 1.4em !important;
    margin-bottom: 10px;
    line-height: 26pt;
}

hr.new{
    border-top: 1px dotted #8c8b8b;
	border-bottom: 1px dotted #fff;

}

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
.font_s{
	font-size:14px;
}

.Afont_s{
	font-size:14px;
	text-decoration:underline;
}

</style>
@stop

@section('custom_js')

<script type="text/javascript">
</script>
@stop

