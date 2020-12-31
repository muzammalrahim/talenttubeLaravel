
<div class="container p-0">
	<div class="workreference">
		   <h6 class="font-weight-bold text-center my-4"> Verification Detail </h6>

			    <div class="form-group">
			      <label for="inputEmail4">What is your full name</label>
			      <span type="text" class="form-control" id="inputEmail4" name="refereeName">{{$reference->refereeName}}</span>
			    </div>

			    <div class="form-group">
			    <label for="inputPhone">What is your best contact number</label>
			    <span type="text" class="form-control" id="inputPhone" name="refereePhone">{{$reference->refereePhone}}</span>
			  </div>

			    <div class="form-group">
			      <label for="inputPassword4">What is your best email address (personal email address is fine): </label>
			      <span type="text" class="form-control" id="inputPassword4" name="refereeEmail">{{$reference->refereeEmail}}</span>
			    </div>
			  
			  <div class="form-group">
			    <label for="inputKnowing">How do you know the candidate ?</label>
			    <span type="text" class="form-control" id="inputKnowing" name="refereeKnowing">{{$reference->refereeKnowing}}</span>
			  </div>
			  <div class="form-group">
			    <label for="inputMeet">When did you first meet them?</label>
			    <span type="text" class="form-control" id="inputMeet" name="refereeMeet">{{$reference->refereeMeet}}</span>
			  </div>

			  <div class="form-group">
			    <label for="inputParticularIns">Was there a particular institution, event or association you where involved with the candidate? Examples include charity, sporting club, religious or community organisation etc</label>
			    <span type="text" class="form-control" id="inputParticularIns" name="refereeParticularIns">{{$reference->refereeParticularIns}}</span>
			  </div>
			<h6 class="font-weight-bold text-center my-4">Values & Skill Related Questions</h6>
			<div class="form-group">
			    <label for="inputInteraction">In your interactions with the candidate, do you believe they showed good honesty and integrity?</label>
			    <span class="form-control" id="inputInteraction" name="refereeInteractions">{{$reference->refereeInteractions}}</span>
			    <span type="text" class="form-control" id="dd1" name="ddText1" placeholder="Please provide furthur detail here">{{$reference->ddText1}}</span>
			 </div>
			 <div class="form-group">
			    <label for="inputPuntual">During your relationship with the candidate, have you found them to be generally on time and punctual? </label>
			    <span class="form-control" id="inputPuntual" name="refereePunctual">{{$reference->refereePunctual}}</span>
			    <span type="text" class="form-control" id="dd2" name="ddText2" placeholder="Please provide furthur detail here">{{$reference->ddText2}}</span>
			 </div>
			 <div class="form-group">
			    <label for="inputCoomunication">How do you rate the candidate’s communication skills, based on the interactions you’ve had with them? </label>
			    <span class="form-control" id="inputCoomunication" name="refereeCommunication">{{$reference->refereeCommunication}}</span>
			    <span type="text" class="form-control" id="dd3" name="ddText3" placeholder="Please provide furthur detail here">{{$reference->ddText3}}</span>
			 </div>
			 <div class="form-group">
			    <label for="inputMotivation">Does the candidate exhibit a good personal drive and motivation? </label>
			    <span class="form-control" id="inputMotivation" name="refereeMotivation">{{$reference->refereeMotivation}}</span>
			    <span type="text" class="form-control" id="dd4" name="ddText4" placeholder="Please provide furthur detail here">{{$reference->ddText4}}</span>
			 </div>
			 <div class="form-group">
			    <label for="inputRelatively">Have you found the candidate to be relatively bright and able to follow instructions? </label>
			    <span class="form-control" id="inputRelatively" name="refereeRelatively">{{$reference->refereeRelatively}}</span>
			    <span type="text" class="form-control" id="dd5" name="ddText5" placeholder="Please provide furthur detail here">{{$reference->ddText5}}</span>
			 </div>

			<h6 class="font-weight-bold text-center my-4">Final Questions</h6>

			<div class="form-group">
			    <label for="inputBasedExp">Based on your experience, what would be the best way to get the most of this candidate? Is there a particular management style you think they would best respond to</label>
			    <span type="text" class="form-control" id="inputBasedExp" name="refereeBasedExp">{{$reference->refereeBasedExp}}</span>
			</div>

			<div class="form-group">
			    <label for="inputProspective">Would you recommend the candidate to prospective employers for a role? </label>
			    <span type="text" class="form-control" id="inputProspective" name="refereeProspective">{{$reference->refereeProspective}}</span>
			</div>


			<div class="form-group">
			    <label for="inputComments">Please feel free to add any additional final comments for the reference check ? </label>
			    <span type="text" class="form-control" id="inputComments" name="refereeComments">{{$reference->refereeComments}}</span>
			</div>
   </div>

</div>
