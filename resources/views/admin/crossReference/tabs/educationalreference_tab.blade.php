<div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">

     
     

{{-- ================================================== For Showing Work Refrence in completed references ==================================================  --}}



{{-- ================================================== For Showing Educational Refrence in completed references ==================================================  --}}

    
<div class="container p-0 m-0">
	<div class="workreference"> 
		   <h5 class="font-weight-bold text-center mb-4"> Verification Details </h5>
			    <div class="form-group row mr-2">
			      <label for="inputEmail4" class = "col-md-6">What is your full name</label>
			      <span type="text" class="form-control col-md-6" id="inputEmail4">{{$reference->refereeName}}</span>
			    </div>

			    <div class="form-group row mr-2">
			    <label for="inputPhone" class = "col-md-6">What is your best contact number</label>
			    <span type="text" class="form-control col-md-6" id="inputPhone">{{$reference->refereePhone}}</span>
			  </div>

			    <div class="form-group row mr-2">
			      <label for="inputPassword4" class = "col-md-6">What is your best email address (personal email address is fine): </label>
			      <span type="text" class="form-control col-md-6" id="inputPassword4">{{$reference->refereeEmail}}</span>
			    </div>
			  
			  <div class="form-group row mr-2">
			    <label for="inputEducational" class = "col-md-6">What was the name of the educational institution or organisation yourself and the candidate attended?</label>
			    <span type="text" class="form-control col-md-6" id="inputEducational">{{$reference->refereeEducational}}</span>
			  </div>
			  <div class="form-group row mr-2">
			    <label for="inputDates" class = "col-md-6">Roughly, how long ago did you first meet the candidate (approximate dates are sufficient)?</label>
			    <span type="text" class="form-control col-md-6" id="inputDates">{{$reference->refereeDates}}</span>
			  </div>

			  <div class="form-group row mr-2">
			    <label for="inputParticular" class = "col-md-6">What was your education relationship to the candidate (eg: career advisor, principle, maths tutor, physics professor, Tafe teacher etc)? Was there a particular class, course or subject you taught the candidate (eg; HSC Biology, Bachelor of Business, Tafe Mechanic Apprenticeship etc)?</label>
			    <span type="text" class="form-control col-md-6" id="inputParticular">{{$reference->refereeParticularClass}}</span>
			  </div>

			<h5 class="font-weight-bold text-center mb-4">Educational Related Question </h5>

			<div class="form-group row mr-2">
			    <label for="inputPunctual" class = "col-md-6">During your relationship with the candidate, did you find them to be generally on time and punctual to class or any appointments?</label>
			    <span class="form-control col-md-2 spanSyle" id="inputPunctual">{{$reference->refereePunctual}}</span>
			    <textarea type="text" class="form-control col-md-4 bg-white" disabled="true" id="dd1">{{$reference->ddText1}}</textarea>
			 </div>
			 <div class="form-group row mr-2">
			    <label for="inputCommunication" class = "col-md-6">How do you rate the candidate’s communication skills, based on any verbal and written correspondence/assignments you’ve had with them?</label>
			    <span class="form-control col-md-2 spanSyle" id="inputCommunication">{{$reference->refereeCommunication}}</span>
			    <textarea type="text" class="form-control col-md-4 bg-white" disabled="true" id="dd2">{{$reference->ddText2}}</textarea>
			 </div>
			 <div class="form-group row mr-2">
			    <label for="inputInitiative" class = "col-md-6">Did the candidate show good educational initiative, such as doing good research & completing any assigned homework or tasks?</label>
			    <span class="form-control col-md-2 spanSyle" id="inputInitiative">{{$reference->refereeInitiative}}</span>
			    <textarea type="text" class="form-control col-md-4 bg-white" disabled="true" id="dd3">{{$reference->ddText3}}</textarea>
			 </div>
			 <div class="form-group row mr-2">
			    <label for="inputDemonstrate" class = "col-md-6">Was the candidate able to demonstrate good focus and stay on task, while avoiding any unnecessary disruptions to the lesson or class? </label>
			    <span class="form-control col-md-2 spanSyle" id="inputDemonstrate">{{$reference->refereeDemonstrate}}</span>
			    <textarea type="text" class="form-control col-md-4 bg-white" disabled="true" id="dd4">{{$reference->ddText4}}</textarea>
			 </div>
			 <div class="form-group row mr-2">
			    <label for="inputLearning" class = "col-md-6">Did the candidate demonstrate good learning outcomes & adequate academic performance during their studies?  </label>
			    <span class="form-control col-md-2 spanSyle" id="inputLearning">{{$reference->refereeLearning}}</span>
			    <textarea type="text" class="form-control col-md-4 bg-white" disabled="true" id="dd5">{{$reference->ddText5}}</textarea>
			 </div>
			 <div class="form-group row mr-2">
			    <label for="inputInteraction" class = "col-md-6">In your interactions with the candidate, do you believe they showed good honesty and integrity during their studies?  </label>
			    <span class="form-control col-md-2 spanSyle" id="inputInteraction">{{$reference->refereeInteractions}}</span>
			    <textarea type="text" class="form-control col-md-4 bg-white" disabled="true" id="dd6">{{$reference->ddText6}}</textarea>
			 </div>

			<h5 class="font-weight-bold text-center mb-4">Final Questions</h5>

			<div class="form-group row mr-2">
			    <label for="inputManagement" class = "col-md-6">Based on your experience, what would be the best way to get the most of this candidate? Is there a particular management style you think they would best respond to? </label>
			    <textarea type="text" class="form-control col-md-6 bg-white" disabled="true" id="inputManagement">{{$reference->refereeManagementr}}</textarea>
			</div>

			<div class="form-group row mr-2">
			    <label for="inputCurricular" class = "col-md-6">Was the candidate involved in extra curricular activities during their time at this academic institution? 
 				</label>
			    <textarea type="text" class="form-control col-md-6 bg-white" disabled="true" id="inputCurricular">{{$reference->refereeCurricular}}</textarea>
			</div>

			<div class="form-group row mr-2">
			    <label for="inputRelatedProject" class = "col-md-6">If there was any group related projects, did the candidate demonstrate good team building skills?  </label>
			    <textarea type="text" class="form-control col-md-6 bg-white" disabled="true" id="inputRelatedProject">{{$reference->refereeRelatedProject}}</textarea>
			</div>


			<div class="form-group row mr-2">
			    <label for="inputProspective" class = "col-md-6">Would you recommend the candidate to prospective employers for a role  ? </label>
			    <textarea type="text" class="form-control col-md-6 bg-white" disabled="true" id="inputProspective">{{$reference->refereeProspective}}</textarea>
			</div>

			<div class="form-group row mr-2">
			    <label for="inputCandidateBest" class = "col-md-6">What industry or role do you think the candidate would be best suited for? </label>
			    <textarea type="text" class="form-control col-md-6 bg-white" disabled="true" id="inputCandidateBest">{{$reference->refereeCandidateBest}}</textarea>
			</div>

			<div class="form-group row mr-2">
			    <label for="inputComments" class = "col-md-6">Please feel free to add any additional final comments for the reference check ? </label>
			    <textarea type="text" class="form-control col-md-6 bg-white" disabled="true" id="inputComments">{{$reference->refereeComments}}</textarea>
			</div>


   </div>

</div>







    {{-- <a class="btn btn-primary btnNext text-white" style="float: right;" onclick="scrollToTop()">Next</a> --}}
  </div>
