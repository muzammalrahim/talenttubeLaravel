    
@extends('mobile.intConUsers.intConMaster')

@section('content')

<div class="card shadow mb-3 bg-white rounded">
	<div class="header text-center">
		<h4 class="font-weight-bold mt-3">Your Interview Slot has been created</h4>
	</div> 

	<div class="card-body goHome text-center pb-3"> 
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
.homeBg{height:100% !important }

</style>

@stop