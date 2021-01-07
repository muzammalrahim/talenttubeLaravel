
<div class="container p-0">
	<div class="workreference">
		   <h6 class="font-weight-bold text-center my-4"> Verification Details </h6>

			    <div class="form-group">
			      <label for="inputEmail4">What is your full name</label>
			      <span type="text" class="form-control" id="inputEmail4">{{$reference->refereeName}}</span>
			    </div>

			    <div class="form-group">
			    <label for="inputPhone">What is your best contact number</label>
			    <span type="text" class="form-control" id="inputPhone">{{$reference->refereePhone}}</span>
			  </div>

			    <div class="form-group">
			      <label for="inputPassword4">What is your best email address (personal email address is fine): </label>
			      <span type="text" class="form-control" id="inputPassword4">{{$reference->refereeEmail}}</span>
			    </div>
			  
			  <div class="form-group">
			    <label for="inputKnowing">How do you know the candidate ? Was there a particular institution, event or association you where involved with the candidate? Examples include charity, sporting club, religious or community organisation etc</label>
			    <span type="text" class="form-control" id="inputKnowing">{{$reference->refereeKnowing}}</span>
			  </div>
			  <div class="form-group">
			    <label for="inputMeet">When did you first meet them?</label>
			    <span type="text" class="form-control" id="inputMeet">{{$reference->refereeMeet}}</span>
			  </div>

			  {{-- <div class="form-group">
			    <label for="inputParticularIns"></label>
			    <span type="text" class="form-control" id="inputParticularIns" name="refereeParticularIns">{{$reference->refereeParticularIns}}</span>
			  </div> --}}
			<h6 class="font-weight-bold text-center my-4">Values & Skill Related Questions</h6>

			<div class="form-group">
			    <label for="inputInteraction">In your interactions with the candidate, do you believe they showed good honesty and integrity?</label>
			    <span class="form-control" id="inputInteraction">{{$reference->refereeInteractions}}</span>
			    <textarea type="text" class="form-control" id="dd1">{{$reference->ddText1}}</textarea>
			 </div>
			 <div class="form-group">
			    <label for="inputPuntual">During your relationship with the candidate, have you found them to be generally on time and punctual? </label>
			    <span class="form-control" id="inputPuntual">{{$reference->refereePunctual}}</span>
			    <textarea type="text" class="form-control" id="dd2">{{$reference->ddText2}}</textarea>
			 </div>
			 <div class="form-group">
			    <label for="inputCoomunication">How do you rate the candidate’s communication skills, based on the interactions you’ve had with them? </label>
			    <span class="form-control" id="inputCoomunication">{{$reference->refereeCommunication}}</span>
			    <textarea type="text" class="form-control" id="dd3">{{$reference->ddText3}}</textarea>
			 </div>
			 <div class="form-group">
			    <label for="inputMotivation">Does the candidate display good personal drive and motivation? </label>
			    <span class="form-control" id="inputMotivation">{{$reference->refereeMotivation}}</span>
			    <textarea type="text" class="form-control" id="dd4">{{$reference->ddText4}}</textarea>
			 </div>
			 <div class="form-group">
			    <label for="inputRelatively">Have you found the candidate to be relatively bright and able to follow instructions? </label>
			    <span class="form-control" id="inputRelatively">{{$reference->refereeRelatively}}</span>
			    <textarea type="text" class="form-control" id="dd5">{{$reference->ddText5}}</textarea>
			 </div>

			<h6 class="font-weight-bold text-center my-4">Final Questions</h6>

			<div class="form-group">
			    <label for="inputBasedExp">Based on your experience, what would be the best way to get the most of this candidate? Is there a particular management style you think they would best respond to</label>
			    <textarea type="text" class="form-control bg-white" disabled="true" id="inputBasedExp">{{$reference->refereeBasedExp}}</textarea>
			</div>

			<div class="form-group">
			    <label for="inputProspective">Would you recommend the candidate to prospective employers for a role? </label>
			    <textarea type="text" class="form-control bg-white" disabled="true" id="inputProspective">{{$reference->refereeProspective}}</textarea>
			</div>


			<div class="form-group">
			    <label for="inputComments">Please feel free to add any additional final comments for the reference check ? </label>
			    <textarea type="text" class="form-control bg-white" disabled="true" id="inputComments">{{$reference->refereeComments}}</textarea>
			</div>
   </div>

</div>
