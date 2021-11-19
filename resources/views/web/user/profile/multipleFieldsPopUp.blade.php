


<div class="about-infomation">
   <h2>Recent Job</h2>
   <div class="row">
      <div class="col-5">
         <input type="text" id="recentJobInput" name="recentJobField" class="form-control" value="{{$user->recentJob}}"/>
      </div>
      <div class="col-1">  <span> at </span>  </div>
      <div class="col-6">
         <input type="text" name="organHeldTitleField" class="form-control organHeldTitleField" value="{{$user->organHeldTitle}}"/>
      </div>
   </div>

   <div class="row">
      <div class="col-md-12">
         <div class="button_recentJob text-center">
            <button class="orange_btn mt-2 px-4" onclick="updateRecentJob()">Save</button> 
            </div>
         </div>
   </div>

   <div class="alert alert-success alert_recentJob hide_me" role="alert">
      <strong>Success!</strong> Recent Job has been updated successfully!
   </div>

</div>





<div class="about-infomation">
   <h2>Salary Range</h2>
   <div class="row sec_recentJob">
      <div class="col-12">
         {{ Form::select('salaryRange', $salaryRange, $user->salaryRange, ['placeholder' => 'Select Salary Range', 'id' => 'salaryRangeFieldnew', 'class' => 'form-control']) }}
      </div>
   </div>

   <div class="row">
      <div class="col-md-12">
         <div class="button_recentJob text-center">
            <button class="orange_btn button_salaryRange my-2 px-4" onclick="updateSalaryRangeValue()" >Save</button>
            </div>
         </div>
   </div>

   <div class="alert alert-success alert_salayRange hide_me" role="alert">
      <strong>Success!</strong> Recent Job has been updated successfully!
   </div>




</div>





