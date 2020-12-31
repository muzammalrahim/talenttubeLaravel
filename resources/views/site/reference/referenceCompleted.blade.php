
    
@extends('site.employer.referencemaster')

@section('content')

<div class="container">
	<div class="header text-center">
		<h4 class="font-weight-bold">You have submitted your reference</h4>
	</div> 

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
    margin-top: 10% !important;
}
body{
		background-image: url(https://images.pexels.com/photos/34092/pexels-photo.jpg?auto=compress&cs=tinysrgb&h=750&w=1260) !important;
	}
</style>

@stop