
<div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">

	<div class="tempDisplayforemployer hide_it job_row">
		<form method="POST" name="interviewTemplate" class="interviewTemplate newJob job_validation">
		@csrf
			<div class="row">
				<p class="col-md-3 font-weight-bold">Interview Template:</p>
				<select class="templateSelect form-control col-md-9" name="templateSelect" >
					<option value="0"> Select Template</option>
					@foreach ($interviewTemplate as $template)
						<option value="{{ $template->id }}"> 
							{{$template->template_name}} 
						</option>
					@endforeach
				</select>
				<span class="btn small leftMargin turquoise interviewLoader"></span>
			</div>

			<input type="hidden" name="jobApp_id" value="{{$jobApp_id}}" class="jobApp_id">
		</form>



	    {{-- ========================== Get Template and questions through aja and embed them in below div ========================== --}}
	    
	    <form method="POST" name="interviewTemplateSave" class="interviewTemplateSave newJob job_validation">
	        <div class="templateData p10"></div>
	        <input type="hidden" name="user_id" value="{{$user_id}}" class="jsId">
	    </form>

	</div>

	<a class="btn btn-primary btnPrevious text-white"onclick="scrollToTop()" >Previous</a>
 
</div>
