    
@extends('mobile.intConUsers.intConMaster')

@section('content')



<div class="card shadow mb-3 bg-white rounded">
    <h6 class="card-header h6"> Interview Concierge</h6>

    <div class="card-body p-2 cardBody mt-2">
    
    	{{-- @dd($data['interview_Data']); --}}

    	<span> You have not booked any slot for interview.</span>
    	<div class="goHomeLink text-center pb-3 mt-3"> 
    		<a href="{{route('homepage')}}"> Click here to go home page</a>
    	</div>

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