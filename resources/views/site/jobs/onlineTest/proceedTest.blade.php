



<div class="newJobCont">

    <div class="head icon_head_browse_matches"> {{$UserOnlineTest->onlineTest->name}} <div class="countdown fl_right"> </div> </div>

    	<div class="questionData">

    		@if ($UserOnlineTest->status == 'pending' || $UserOnlineTest->status == 'continue' )
    			@include('site.jobs.onlineTest.oneQuestion')  {{-- site/onlineTest/parts/oneQuestion --}}
    		@else
    			<div class="fomr_btn act_field center">
			        <button class="btn small turquoise submitApplication">Submit</button>
			    </div>
    		@endif


    	</div>
    <div class="cl"></div>
</div>

<script type="text/javascript" src="{{ asset('js/site/jobApply/onlineTest/script.js') }}"></script>
