    
<div class="container p-0 m-0">
	<div class="workreference"> 
		   <h5 class="font-weight-bold text-center"> Verification Detail </h5>
			    <div class="form-group row">
			      <label for="inputEmail4" class = "col-md-6">What is your full name</label>
			      <span type="text" class="form-control col-md-6" id="inputEmail4" name="refereeName">{{$reference->refereeName}}</span>
			    </div>

			    <div class="form-group row">
			    <label for="inputPhone" class = "col-md-6">What is your best contact number</label>
			    <span type="text" class="form-control col-md-6" id="inputPhone" name="refereePhone">{{$reference->refereePhone}}</span>
			  </div>

			    <div class="form-group row">
			      <label for="inputPassword4" class = "col-md-6">What is your best email address (personal email address is fine): </label>
			      <span type="text" class="form-control col-md-6" id="inputPassword4" name="refereeEmail">{{$reference->refereeEmail}}</span>
			    </div>
			  
			  <div class="form-group row">
			    <label for="inputEducational" class = "col-md-6">What was the name of the educational institution or organisation yourself and the candidate attended?</label>
			    <span type="text" class="form-control col-md-6" id="inputEducational" name="refereeEducational">{{$reference->refereeEducational}}</span>
			  </div>
			  <div class="form-group row">
			    <label for="inputDates" class = "col-md-6">Roughly, how long ago did you first meet the candidate (approximate dates are sufficient)?</label>
			    <span type="text" class="form-control col-md-6" id="inputDates" name="refereeDates">{{$reference->refereeDates}}</span>
			  </div>

			  <div class="form-group row">
			    <label for="inputParticular" class = "col-md-6">Was there a particular class, course or subject you taught the candidate (eg; HSC Biology Teacher, Bachelor of Business, Tafe Mechanic Apprentice teacher etc)? If not, what was your education relationship to the candidate (eg: career advisor, principle, tutor, etc) ?</label>
			    <span type="text" class="form-control col-md-6" id="inputParticular" name="refereeParticularClass">{{$reference->refereeParticularClass}}</span>
			  </div>
			<h5 class="font-weight-bold text-center mb-4">Educational Related Question </h5>
			<div class="form-group row">
			    <label for="inputPunctual" class = "col-md-6">During your relationship with the candidate, did you find them to be generally on time and punctual to class or any appointments?</label>
			    <span class="form-control col-md-3" id="inputPunctual" name="refereePunctual">{{$reference->refereePunctual}}</span>
			    <span type="text" class="form-control col-md-3" id="dd1" name="ddText1" placeholder="Please provide furthur detail here">{{$reference->ddText1}}</span>
			 </div>
			 <div class="form-group row">
			    <label for="inputCommunication" class = "col-md-6">How do you rate the candidate’s communication skills, based on any verbal and written correspondence/assignments you’ve had with them?</label>
			    <span class="form-control col-md-3" id="inputCommunication" name="refereeCommunication">{{$reference->refereeCommunication}}</span>
			    <span type="text" class="form-control col-md-3" id="dd2" name="ddText2" placeholder="Please provide furthur detail here">{{$reference->ddText2}}</span>
			 </div>
			 <div class="form-group row">
			    <label for="inputInitiative" class = "col-md-6">Did the candidate show good educational initiative, such as doing good research & completing any assigned homework or tasks?</label>
			    <span class="form-control col-md-3" id="inputInitiative" name="refereeInitiative">{{$reference->refereeInitiative}}</span>
			    <span type="text" class="form-control col-md-3" id="dd3" name="ddText3" placeholder="Please provide furthur detail here">{{$reference->ddText3}}</span>
			 </div>
			 <div class="form-group row">
			    <label for="inputDemonstrate" class = "col-md-6">Was the candidate able to demonstrate good focus and stay on task, while avoiding any unnecessary disruptions to the lesson or class? </label>
			    <span class="form-control col-md-3" id="inputDemonstrate" name="refereeDemonstrate">{{$reference->refereeDemonstrate}}</span>
			    <span type="text" class="form-control col-md-3" id="dd4" name="ddText4" placeholder="Please provide furthur detail here">{{$reference->ddText4}}</span>
			 </div>
			 <div class="form-group row">
			    <label for="inputLearning" class = "col-md-6">Did the candidate demonstrate good learning outcomes & adequate academic performance during their studies?  </label>
			    <span class="form-control col-md-3" id="inputLearning" name="refereeLearning">{{$reference->refereeLearning}}</span>
			    <span type="text" class="form-control col-md-3" id="dd5" name="ddText5" placeholder="Please provide furthur detail here">{{$reference->ddText5}}</span>
			 </div>
			 <div class="form-group row">
			    <label for="inputInteraction" class = "col-md-6">In your interactions with the candidate, do you believe they showed good honesty and integrity during their studies?  </label>
			    <span class="form-control col-md-3" id="inputInteraction" name="refereeInteractions">{{$reference->refereeInteractions}}</span>
			    <span type="text" class="form-control col-md-3" id="dd6" name="ddText6" placeholder="Please provide furthur detail here">{{$reference->ddText6}}</span>
			 </div>
			<h5 class="font-weight-bold text-center mb-4">Final Questions</h5>

			<div class="form-group row">
			    <label for="inputManagement" class = "col-md-6">Based on your experience, what would be the best way to get the most of this candidate? Is there a particular management style you think they would best respond to? </label>
			    <span type="text" class="form-control col-md-6" id="inputManagement" name="refereeManagementr">{{$reference->refereeManagementr}}</span>
			</div>

			<div class="form-group row">
			    <label for="inputCurricular" class = "col-md-6">Was the candidate involved in extra curricular activities during their time at this academic institution? 
 				</label>
			    <span type="text" class="form-control col-md-6" id="inputCurricular" name="refereeCurricular">{{$reference->refereeCurricular}}</span>
			</div>

			<div class="form-group row">
			    <label for="inputRelatedProject" class = "col-md-6">If there was any group related projects, did the candidate demonstrate good team building skills?  </label>
			    <span type="text" class="form-control col-md-6" id="inputRelatedProject" name="refereeRelatedProject">{{$reference->refereeRelatedProject}}</span>
			</div>


			<div class="form-group row">
			    <label for="inputProspective" class = "col-md-6">Would you recommend the candidate to prospective employers for a role  ? </label>
			    <span type="text" class="form-control col-md-6" id="inputProspective" name="refereeProspective">{{$reference->refereeProspective}}</span>
			</div>

			<div class="form-group row">
			    <label for="inputCandidateBest" class = "col-md-6">What industry or role do you think the candidate would be best suited for? </label>
			    <span type="text" class="form-control col-md-6" id="inputCandidateBest" name="refereeCandidateBest">{{$reference->refereeCandidateBest}}</span>
			</div>

			<div class="form-group row">
			    <label for="inputComments" class = "col-md-6">Please feel free to add any additional final comments for the reference check ? </label>
			    <span type="text" class="form-control col-md-6" id="inputComments" name="refereeComments">{{$reference->refereeComments}}</span>
			</div>


   </div>

</div>
