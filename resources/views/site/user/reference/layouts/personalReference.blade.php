
{{-- ================================================== For Showing Personal Refrence in completed references ==================================================  --}}


<div class="container p-0 m-0">
	<div class="workreference"> 
		   <h5 class="font-weight-bold text-center mb-4"> Verification Details </h5>
			   <div class="form-group row mr-2">
			      <label for="inputEmail4" class="col-md-1">Name:</label>
			      <span type="text" class="form-control col-md-3" id="inputEmail4">{{$reference->refereeName}}</span>
			      <label for="inputPhone" class="col-md-1">Phone:</label>
			   	  <span class="form-control col-md-3" id="inputPhone" name="refereePhone">{{$reference->refereePhone}}</span>
			      <label for="inputPassword4" class="col-md-1">Email: </label>
			      <span type="text" class="form-control col-md-3" id="inputPassword4">{{$reference->refereeEmail}}</span>
		  		</div>
			  
			  <div class="form-group row mr-2">
			    <label for="inputKnowing" class = "col-md-6">How do you know the candidate ?Was there a particular institution, event or association you where involved with the candidate? Examples include charity, sporting club, religious or community organisation etc</label>
			    <input type="text" class="form-control col-md-6" id="inputKnowing" name="refereeKnowing">
			  </div>
			  <div class="form-group row mr-2">
			    <label for="inputMeet" class = "col-md-6">When did you first meet them?</label>
			    <input type="text" class="form-control col-md-6" id="inputMeet" name="refereeMeet">
			  </div>

			  {{-- <div class="form-group row">
			    <label for="inputParticularIns" class = "col-md-6"></label>
			    <input type="text" class="form-control col-md-6" id="inputParticularIns" name="refereeParticularIns">
			  </div> --}}
			  
			
			<h5 class="font-weight-bold text-center mb-4">Values & Skill Related Questions</h5>

			<div class="form-group row mr-2">
			    <label for="inputInteraction" class = "col-md-6">In your interactions with the candidate, do you believe they showed good honesty and integrity?</label>
			    <span class="form-control col-md-2 spanSyle" id="inputInteraction" name="refereeInteractions">{{$reference->refereeInteractions}}</span>
			    <textarea class="form-control col-md-4 bg-white" disabled="true" id="dd1" name="ddText1" placeholder="Please provide furthur detail here">{{$reference->ddText1}}</textarea>
			 </div>


			 <div class="form-group row mr-2">
			    <label for="inputPuntual" class = "col-md-6">During your relationship with the candidate, have you found them to be generally on time and punctual? </label>
			    <span class="form-control col-md-2 spanSyle" id="inputPuntual" name="refereePunctual">{{$reference->refereePunctual}}</span>
			    <textarea class="form-control col-md-4 bg-white" disabled="true" id="dd2" name="ddText2" placeholder="Please provide furthur detail here">{{$reference->ddText2}}</textarea>
			 </div>

			 <div class="form-group row mr-2">
			    <label for="inputCoomunication" class = "col-md-6">How do you rate the candidate’s communication skills, based on the interactions you’ve had with them? </label>
			    <span class="form-control col-md-2 spanSyle" id="inputCoomunication" name="refereeCommunication">{{$reference->refereeCommunication}}</span>
			    <textarea class="form-control col-md-4 bg-white" disabled="true" id="dd3" name="ddText3" placeholder="Please provide furthur detail here">{{$reference->ddText3}}</textarea>
			 </div>

			 <div class="form-group row mr-2">
			    <label for="inputMotivation" class = "col-md-6">Does the candidate display good personal drive and motivation? </label>
			    <span class="form-control col-md-2 spanSyle" id="inputMotivation" name="refereeMotivation">{{$reference->refereeMotivation}}</span>
			    <textarea type="text" class="form-control col-md-4 bg-white" disabled="true" id="dd4" name="ddText4" placeholder="Please provide furthur detail here">{{$reference->ddText4}}</textarea>
			 </div>

			 <div class="form-group row mr-2">
			    <label for="inputRelatively" class = "col-md-6">Have you found the candidate to be relatively bright and able to follow instructions? </label>

			    <span class="form-control col-md-2 spanSyle" id="inputRelatively" name="refereeRelatively">{{$reference->refereeRelatively}}</span>
			    <textarea class="form-control col-md-4 bg-white" disabled="true" id="dd5" name="ddText5" placeholder="Please provide furthur detail here">{{$reference->ddText5}}</textarea>
			 </div>

			<h5 class="font-weight-bold text-center mb-4">Final Questions</h5>

			<div class="form-group row mr-2">
			    <label for="inputBasedExp" class = "col-md-6">Based on your experience, what would be the best way to get the most of this candidate? Is there a particular management style you think they would best respond to</label>
			    <textarea type="text" class="form-control col-md-6 bg-white" disabled="true" id="inputBasedExp" name="refereeBasedExp">{{$reference->refereeBasedExp}}</textarea>
			</div>

			<div class="form-group row mr-2">
			    <label for="inputProspective" class = "col-md-6">Would you recommend the candidate to prospective employers for a role? </label>
			    <textarea type="text" class="form-control col-md-6 bg-white" disabled="true" id="inputProspective" name="refereeProspective">{{$reference->refereeProspective}}</textarea>
			</div>


			<div class="form-group row mr-2">
			    <label for="inputComments" class = "col-md-6">Please feel free to add any additional final comments for the reference check ? </label>
			    <textarea type="text" class="form-control col-md-6 bg-white" disabled="true" id="inputComments" name="refereeComments">{{$reference->refereeComments}}</textarea>
			</div>			
   </div>

</div>
