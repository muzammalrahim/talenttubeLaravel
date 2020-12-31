
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
			    <label for="inputEducational">What was the name of the educational institution or organisation yourself and the candidate attended?</label>
			    <span type="text" class="form-control" id="inputEducational" name="refereeEducational">{{$reference->refereeEducational}}</span>
			  </div>
			  <div class="form-group">
			    <label for="inputDates">Roughly, how long ago did you did you first meet the candidate (approximate dates are sufficient)?</label>
			    <span type="text" class="form-control" id="inputDates" name="refereeDates">{{$reference->refereeDates}}</span>
			  </div>

			  <div class="form-group">
			    <label for="inputParticular">Was there a particular class, course or subject you taught the candidate (eg; HSC Biology Teacher, Bachelor of Business, Tafe Mechanic Apprentice teacher etc)? If not, what was your education relationship to the candidate (eg: career advisor, principle, tutor, etc) ?</label>
			    <span type="text" class="form-control" id="inputParticular" name="refereeParticularClass">{{$reference->refereeParticularClass}}</span>
			  </div>
			  
			<h6 class="font-weight-bold text-center my-4">Educational Related Question </h6>

			<div class="form-group">
			    <label for="inputPunctual">During your relationship with the candidate, did you find them to be generally on time and punctual to class or any appointments?</label>
			    <span class="form-control" id="inputPunctual" name="refereePunctual">{{$reference->refereePunctual}}</span>
			    <span type="text" class="form-control" id="dd1" name="ddText1" placeholder="Please provide furthur detail here">{{$reference->ddText1}}</span>
			 </div>

			 <div class="form-group">
			    <label for="inputCommunication">How do you rate the candidate’s communication skills, based on any verbal and written correspondence/assignments you’ve had with them?</label>
			    <span class="form-control" id="inputCommunication" name="refereeCommunication">{{$reference->refereeCommunication}}</span>
			    <span type="text" class="form-control" id="dd2" name="ddText2" placeholder="Please provide furthur detail here">{{$reference->ddText2}}</span>
			 </div>

			 <div class="form-group">
			    <label for="inputInitiative">Did the candidate show good educational initiative, such as doing good research & completing any assigned homework or tasks?</label>
			    <span class="form-control" id="inputInitiative" name="refereeInitiative">{{$reference->refereeInitiative}}</span>
			    <span type="text" class="form-control" id="dd3" name="ddText3" placeholder="Please provide furthur detail here">{{$reference->ddText3}}</span>
			 </div>

			 <div class="form-group">
			    <label for="inputDemonstrate">Was the candidate able to demonstrate good focus and stay on task, while avoiding any unnecessary disruptions to the lesson or class? </label>
			    <span class="form-control" id="inputDemonstrate" name="refereeDemonstrate">{{$reference->refereeDemonstrate}}</span>
			    <span type="text" class="form-control" id="dd4" name="ddText4" placeholder="Please provide furthur detail here">{{$reference->ddText4}}</span>
			 </div>

			 <div class="form-group">
			    <label for="inputLearning">Did the candidate demonstrate good learning outcomes & adequate academic performance during their studies?  </label>
			    <span class="form-control" id="inputLearning" name="refereeLearning">{{$reference->refereeLearning}}</span>
			    <span type="text" class="form-control" id="dd5" name="ddText5" placeholder="Please provide furthur detail here">{{$reference->ddText5}}</span>
			 </div>

			 <div class="form-group">
			    <label for="inputInteraction">In your interactions with the candidate, do you believe they showed good honesty and integrity during their studies?  </label>
			    <span class="form-control" id="inputInteraction" name="refereeInteractions">{{$reference->refereeInteractions}}</span>
			    <span type="text" class="form-control" id="dd6" name="ddText6" placeholder="Please provide furthur detail here">{{$reference->ddText6}}</span>
			 </div>

			<h6 class="font-weight-bold text-center my-4">Final Questions</h6>

			<div class="form-group">
			    <label for="inputManagement">Based on your experience, what would be the best way to get the most of this candidate? Is there a particular management style you think they would best respond to? </label>
			    <span type="text" class="form-control" id="inputManagement" name="refereeManagementr">{{$reference->refereeManagementr}}</span>
			</div>

			<div class="form-group">
			    <label for="inputCurricular">Was the candidate involved in extra curricular activities during their time at this academic institution? 
 				</label>
			    <span type="text" class="form-control" id="inputCurricular" name="refereeCurricular">{{$reference->refereeCurricular}}</span>
			</div>

			<div class="form-group">
			    <label for="inputRelatedProject">If there was any group related projects, did the candidate demonstrate good team building skills?  </label>
			    <span type="text" class="form-control" id="inputRelatedProject" name="refereeRelatedProject">{{$reference->refereeRelatedProject}}</span>
			</div>


			<div class="form-group">
			    <label for="inputProspective">Would you recommend the candidate to prospective employers for a role  ? </label>
			    <span type="text" class="form-control" id="inputProspective" name="refereeProspective">{{$reference->refereeProspective}}</span>
			</div>

			<div class="form-group">
			    <label for="inputCandidateBest">What industry or role do you think the candidate would be best suited for? </label>
			    <span type="text" class="form-control" id="inputCandidateBest" name="refereeCandidateBest">{{$reference->refereeCandidateBest}}</span>
			</div>

			<div class="form-group">
			    <label for="inputComments">Please feel free to add any additional final comments for the reference check ? </label>
			    <span type="text" class="form-control" id="inputComments" name="refereeComments">{{$reference->refereeComments}}</span>
			</div>

   </div>

</div>
