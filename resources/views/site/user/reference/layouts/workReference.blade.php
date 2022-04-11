

{{-- ================================================== For Showing Work Refrence in completed references ==================================================  --}}

<div class="container p-0 m-0">
	<div class="workreference">
		   <h5 class="font-weight-bold text-center mb-4 py-2"> Referee's Detail </h5>
		   		<div class="form-group row mr-2">
		            <div class="col-md-4">
		              <div class="row">
		                <label for="inputEmail4" class="col-md-4">Name:</label>
			      		<span type="text" class="form-control col-md-8" id="inputEmail4">{{$reference->refereeName}}</span>
		              </div>
		            </div>
		            <div class="col-md-4">
		              <div class="row">
		                <label for="inputPhone" class="col-md-4">Phone:</label>
			   	  		<span class="form-control col-md-8" id="inputPhone" name="refereePhone">{{$reference->refereePhone}}</span>
		              </div>
		            </div>
		            <div class="col-md-4">
		              <div class="row">
		                <label for="inputPassword4" class="col-md-4">Email: </label>
			      		<span type="text" class="form-control col-md-8" id="inputPassword4">{{$reference->refereeEmail}}</span>
		              </div>
		            </div>
		        </div>

		   <h5 class="font-weight-bold text-center mb-4"> Verification Details </h5>
		  		
			    <div class="form-group row mr-2">
			      <label for="inputOrganization" class="col-md-6">What is the name of organization you and candidate worked for ?</label>
			      <span type="text" class="form-control col-md-6" id="inputOrganization">{{$reference->refereeOrganization}}</span>
			  	</div>
				<div class="form-group row mr-2">
				    <label for="inputTitle" class="col-md-6">What was the candidates job title at the organisation you worked together? </label>
				    <span type="text" class="form-control col-md-6" id="inputTitle">{{$reference->candidateTitle}}</span>
				</div>
			  <div class="form-group row mr-2">
			    <label for="inputDates" class="col-md-6">What dates did you work together ?</label>
			    <span type="text" class="form-control col-md-6" id="inputDates" name="">{{$reference->refereeDates}}</span>
			  </div>
			  <div class="form-group row mr-2">
			    <label for="inputOrgTitle" class="col-md-6">What was your title at the organisation ?</label>
			    <span type="text" class="form-control col-md-6" id="inputOrgTitle" name=""> {{$reference->refereeOrganizationTitle}}</span>
			  </div>
			  <div class="form-group row mr-2">
			    <label for="inputReport" class="col-md-6">Did the candidate report to you ?</label>
			    <span type="text" class="form-control col-md-6" id="inputReport" name="">{{$reference->refereeReport}}</span>
			  </div>
			  <div class="form-group row mr-2">
			    <label for="inputLeaving" class="col-md-6">Is the candidate still working at this organisation? If not, what was their reason for leaving? </label>
			    <span type="text" class="form-control col-md-6" id="inputLeaving" name=""> {{$reference->refereeLeaving}}</span>
			  </div>

			<h5 class="font-weight-bold text-center mb-4"> Work Related Questions </h5>

			<div class="form-group row mr-2">
			    <label for="inputPerExpectation" class="col-md-6">Did the candidate meet their performance expectations in the role?</label>
			    <span class="form-control col-md-2 spanSyle" id="inputPerExpectation" name="refereePerformance">{{$reference->refereePerformance}}</span>
			    <textarea type="text" class="form-control col-md-4 bg-white pt-3" disabled="true" id="dd1" name="ddText1">{{$reference->ddText1}}</textarea>
			 </div>
			 <div class="form-group row mr-2">
			    <label for="inputRequirement" class="col-md-6">Was the candidate on time & punctual? Did they provide adequate notice & acceptable reasons for any leave requirements?</label>
			    <span class="form-control col-md-2 spanSyle" id="inputRequirement" name="refereeRequirements">{{$reference->refereeRequirements}}</span>
			    <textarea type="text" class="form-control col-md-4 bg-white pt-3" disabled="true" id="dd2" name="ddText2">{{$reference->ddText2}}</textarea>
			 </div>
			 <div class="form-group row mr-2">
			    <label for="inputBehaviour" class="col-md-6">Did the candidate display good values and behaviours at work?</label>
			    <span class="form-control col-md-2 spanSyle" id="inputBehaviour" name="refereeBehaviours">{{$reference->refereeBehaviours}}</span>
			    <textarea type="text" class="form-control col-md-4 bg-white pt-3" disabled="true" id="dd3" name="ddText3" placeholder="Please provide furthur detail here">{{$reference->ddText3}}</textarea>
			 </div>
			 <div class="form-group row mr-2">
			    <label for="inputTeamPlayer" class="col-md-6">In terms of working in a group, was the candidate a team player and able to work well with others?</label>
			    <span class="form-control col-md-2 spanSyle" id="inputTeamPlayer" name="refereeTeamplayer">{{$reference->refereeTeamplayer}}</span>
			    <textarea type="text" class="form-control col-md-4 bg-white pt-3" disabled="true" id="dd4" name="ddText4">{{$reference->ddText4}}</textarea>
			 </div>

			<h5 class="font-weight-bold text-center mb-4">Final Questions</h5>

			<div class="form-group row mr-2">
			    <label for="inputManagement" class="col-md-6">What’s the best management advice you could provide to the candidate’s next Leader? Does the candidate best respond to any particular management style?</label>
			    <textarea type="text" class="form-control col-md-6 bg-white" disabled ="true" id="inputManagement"> {{$reference->refereeManagementr}} </textarea>
			</div>
			<div class="form-group row mr-2">
			    <label for="inputProspectives" class="col-md-6">Would you recommend the candidate to prospective employers for a role? </label>
			    <textarea type="text" class="form-control col-md-6 bg-white" disabled ="true" id="inputProspectives"> {{$reference->refereeProspective}} </textarea>
			</div>
			<div class="form-group row mr-2">
			    <label for="inputPotentially" class="col-md-6">Would you potentially rehire the candidate?  </label>
			    <textarea type="text" class="form-control col-md-6 bg-white" disabled ="true" id="inputPotentially"> {{$reference->refereePotentially}} </textarea>
			</div>
			<div class="form-group row mr-2">
			    <label for="inputComments" class="col-md-6">Please feel free to add any additional final comments for the reference check ? </label>
			    <textarea type="text" class="form-control col-md-6 bg-white"  disabled ="true"id="inputComments"> {{$reference->refereeComments}} </textarea>
			</div>
   </div>

</div>


