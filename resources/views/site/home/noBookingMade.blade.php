    
@extends('site.employer.uniqueUrlUnregisteredUser')

@section('content')

<div class="container">
	<div class="header text-center">
		<h4 class="font-weight-bold">Interview Concierge Bookings</h4>
	</div> 

	<h5> You are not selected for any interview slot.</h5>


	<div class="goHome text-center pb-3"> 
		<a href="{{route('homepage')}}"> Click here to go home page</a>
	</div>
    
</div>


@stop

@section('custom_js')

@stop

@section('custom_css')

<style type="text/css">
	
.col_center {
    width: 50% !important;
    padding-top: 14px;
    /*margin-top: 10% !important;*/
}

</style>

@stop