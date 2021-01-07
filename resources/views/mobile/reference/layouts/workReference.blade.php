
<div class="container p-0">
	<div class="workreference">
		   <h6 class="font-weight-bold text-center my-4"> Verification Details </h6>
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
			    <label for="inputOrganization">What is the name of organization you and candidate worked for ?</label>
			    <span type="text" class="form-control" id="inputOrganization" name="refereeOrganization">{{$reference->refereeOrganization}}</span>
			  </div>

			  <div class="form-group">
			    <label for="inputTitle">What was the candidates job title at the organisation you worked together? </label>
			    <span type="text" class="form-control" id="inputTitle" name="candidateTitle">{{$reference->candidateTitle}}</span>
			  </div>

			  <div class="form-group">
			    <label for="inputDates">What dates did you work together ?</label>
			    <span type="text" class="form-control" id="inputDates" name="refereeDates">{{$reference->refereeDates}}</span>
			  </div>

			  <div class="form-group">
			    <label for="inputOrgTitle">What was your title at the organisation ?</label>
			    <span type="text" class="form-control" id="inputOrgTitle" name="refereeOrganizationTitle">{{$reference->refereeOrganizationTitle}}</span>
			  </div>
			  <div class="form-group">
			    <label for="inputReport">Did the candidate report to you ?</label>
			    <span type="text" class="form-control" id="inputReport" name="refereeReport">{{$reference->refereeReport}}</span>
			  </div>

			  <div class="form-group">
			    <label for="inputLeaving">Is the candidate still working at this organisation? If not, what was their reason for leaving? </label>
			    <span type="text" class="form-control" id="inputLeaving" name="refereeLeaving">{{$reference->refereeLeaving}}</span>
			  </div>

			<h6 class="font-weight-bold text-center my-4"> Work Related Questions </h6>
			
			<div class="form-group">
			    <label for="inputPerExpectation">Did the candidate meet their performance expectations in the role?</label>
			    <span class="form-control" id="inputPerExpectation" name="refereePerformance">{{$reference->refereePerformance}}</span>
			    <textarea type="text" class="form-control" id="dd1" name="ddText1" placeholder="Please provide futhur detail here">{{$reference->ddText1}}</textarea>
			 </div>
			 <div class="form-group">
			    <label for="inputRequirement">Was the candidate on time & punctual? Did they provide adequate notice & acceptable reasons for any leave requirements?</label>

			    <span class="form-control" id="inputRequirement" name="refereeRequirements">{{$reference->refereeRequirements}}</span>
			    <textarea type="text" class="form-control" id="dd2" name="ddText2" placeholder="Please provide futhur detail here">{{$reference->ddText2}}</textarea>
			 </div>
			 <div class="form-group">
			    <label for="inputBehaviour">Did the candidate display good values and behaviours at work?</label>

			    <span class="form-control" id="inputBehaviour" name="refereeBehaviours">{{$reference->refereeBehaviours}}</span>
			    <textarea type="text" class="form-control" id="dd3" name="ddText3" placeholder="Please provide futhur detail here">{{$reference->ddText3}}</textarea>
			 </div>
			 <div class="form-group">
			    <label for="inputTeamPlayer">In terms of working in a group, was the candidate a team player and able to work well with others?</label>

			    <span class="form-control" id="inputTeamPlayer" name="refereeTeamplayer">{{$reference->refereeTeamplayer}}</span>
			    <textarea type="text" class="form-control" id="dd4" name="ddText4" placeholder="Please provide futhur detail here">{{$reference->ddText4}}</textarea>
			 </div>
			<h5 class="font-weight-bold text-center my-4">Final Questions</h5>

			<div class="form-group">
			    <label for="inputManagement">What’s the best management advice you could provide to the candidate’s next Leader? Does the candidate best respond to any particular management style?</label>
			    <span type="text" class="form-control" id="inputManagement" name="refereeManagementr">{{$reference->refereeManagementr}}</span>
			</div>

			<div class="form-group">
			    <label for="inputProspectives">Would you recommend the candidate to prospective employers for a role? </label>
			    <span type="text" class="form-control" id="inputProspectives" name="refereeProspective">{{$reference->refereeProspective}}</span>
			</div>

			<div class="form-group">
			    <label for="inputPotentially">Would you potentially rehire the candidate?  </label>
			    <span type="text" class="form-control" id="inputPotentially" name="refereePotentially">{{$reference->refereePotentially}}</span>
			</div>


			<div class="form-group">
			    <label for="inputComments">Please feel free to add any additional final comments for the reference check ? </label>
			    <span type="text" class="form-control" id="inputComments" name="refereeComments">{{$reference->refereeComments}}</span>
			</div>

   </div>

</div>

