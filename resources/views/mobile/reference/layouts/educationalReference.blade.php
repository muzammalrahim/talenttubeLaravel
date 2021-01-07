
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
			    <label for="inputEducational">What was the name of the educational institution or organisation yourself and the candidate attended?</label>
			    <span type="text" class="form-control" id="inputEducational">{{$reference->refereeEducational}}</span>
			  </div>
			  <div class="form-group">
			    <label for="inputDates">Roughly, how long ago did you did you first meet the candidate (approximate dates are sufficient)?</label>
			    <span type="text" class="form-control" id="inputDates">{{$reference->refereeDates}}</span>
			  </div>

			  <div class="form-group">
			    <label for="inputParticular">What was your education relationship to the candidate (eg: career advisor, principle, maths tutor, physics professor, Tafe teacher etc)? Was there a particular class, course or subject you taught the candidate (eg; HSC Biology, Bachelor of Business, Tafe Mechanic Apprenticeship etc)?</label>
			    <span type="text" class="form-control" id="inputParticular">{{$reference->refereeParticularClass}}</span>
			  </div>
			  
			<h6 class="font-weight-bold text-center my-4">Educational Related Question </h6>

			<div class="form-group">
			    <label for="inputPunctual">During your relationship with the candidate, did you find them to be generally on time and punctual to class or any appointments?</label>
			    <span class="form-control" id="inputPunctual">{{$reference->refereePunctual}}</span>
			    <textarea type="text" class="form-control" id="dd1">{{$reference->ddText1}}</textarea>
			 </div>

			 <div class="form-group">
			    <label for="inputCommunication">How do you rate the candidate’s communication skills, based on any verbal and written correspondence/assignments you’ve had with them?</label>
			    <span class="form-control" id="inputCommunication">{{$reference->refereeCommunication}}</span>
			    <textarea type="text" class="form-control" id="dd2">{{$reference->ddText2}}</textarea>
			 </div>

			 <div class="form-group">
			    <label for="inputInitiative">Did the candidate show good educational initiative, such as doing good research & completing any assigned homework or tasks?</label>
			    <span class="form-control" id="inputInitiative">{{$reference->refereeInitiative}}</span>
			    <textarea type="text" class="form-control" id="dd3">{{$reference->ddText3}}</textarea>
			 </div>

			 <div class="form-group">
			    <label for="inputDemonstrate">Was the candidate able to demonstrate good focus and stay on task, while avoiding any unnecessary disruptions to the lesson or class? </label>
			    <span class="form-control" id="inputDemonstrate">{{$reference->refereeDemonstrate}}</span>
			    <textarea type="text" class="form-control" id="dd4">{{$reference->ddText4}}</textarea>
			 </div>

			 <div class="form-group">
			    <label for="inputLearning">Did the candidate demonstrate good learning outcomes & adequate academic performance during their studies?  </label>
			    <span class="form-control" id="inputLearning">{{$reference->refereeLearning}}</span>
			    <textarea type="text" class="form-control" id="dd5">{{$reference->ddText5}}</textarea>
			 </div>

			 <div class="form-group">
			    <label for="inputInteraction">In your interactions with the candidate, do you believe they showed good honesty and integrity during their studies?  </label>
			    <span class="form-control" id="inputInteraction">{{$reference->refereeInteractions}}</span>
			    <textarea type="text" class="form-control" id="dd6">{{$reference->ddText6}}</textarea>
			 </div>

			<h6 class="font-weight-bold text-center my-4">Final Questions</h6>

			<div class="form-group">
			    <label for="inputManagement">Based on your experience, what would be the best way to get the most of this candidate? Is there a particular management style you think they would best respond to? </label>
			    <textarea type="text" class="form-control bg-white" disabled="true" id="inputManagement">{{$reference->refereeManagementr}}</textarea>
			</div>

			<div class="form-group">
			    <label for="inputCurricular">Was the candidate involved in extra curricular activities during their time at this academic institution? 
 				</label>
			    <textarea type="text" class="form-control bg-white" disabled="true" id="inputCurricular">{{$reference->refereeCurricular}}</textarea>
			</div>

			<div class="form-group">
			    <label for="inputRelatedProject">If there was any group related projects, did the candidate demonstrate good team building skills?  </label>
			    <textarea type="text" class="form-control bg-white" disabled="true" id="inputRelatedProject">{{$reference->refereeRelatedProject}}</textarea>
			</div>


			<div class="form-group">
			    <label for="inputProspective">Would you recommend the candidate to prospective employers for a role  ? </label>
			    <textarea type="text" class="form-control bg-white" disabled="true" id="inputProspective">{{$reference->refereeProspective}}</textarea>
			</div>

			<div class="form-group">
			    <label for="inputCandidateBest">What industry or role do you think the candidate would be best suited for? </label>
			    <textarea type="text" class="form-control bg-white" disabled="true" id="inputCandidateBest">{{$reference->refereeCandidateBest}}</textarea>
			</div>

			<div class="form-group">
			    <label for="inputComments">Please feel free to add any additional final comments for the reference check ? </label>
			    <textarea type="text" class="form-control bg-white" disabled="true" id="inputComments">{{$reference->refereeComments}}</textarea>
			</div>

   </div>

</div>
