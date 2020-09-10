

<div class="modal fade right" id="modalJobApply" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true" data-backdrop="false">
  <div class="modal-dialog modal-full-height modal-right modal-notify modal-info" role="document">
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header">
        <p class="heading lead">Submit Proposal</p>
        <button type="button" class="close modalCloseTopButton" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text">×</span>
        </button>
      </div>

      <!--Body-->
      <div class="modal-body p-2 mt-2">
        <div class="text-center applyJobModalHeader">           
          <p><strong class="jobTitle font-weight-bold ">Job Title</strong></p> 
          <p class="jobInfoFont row m-0">
            <strong>
              Almost done, few questions before your resume is accepted for this job.
            </strong>
          </p>
        </div>
        <hr>
        <div class="applyJobModalProcessing">
          <div class="text-center mt-3"><i class="far fa-file-alt fa-4x mb-3 animated rotateIn"></i></div>
        </div>
        <div class="jobApplyModalContent d-none"></div>
        <input type="hidden" name="openModalJobId" value="" id="openModalJobId" >
      </div>

      <!--Footer-->
      
      {{-- <div class="modal-footer justify-content-center">
        <a type="button" class="submitApplication btn btn-primary waves-effect waves-light">Submit
          <i class="fa fa-paper-plane ml-1"></i>
        </a>
        <a type="button" class="btn btn-outline-primary waves-effect" data-dismiss="modal">Cancel</a>
      </div>
     --}}
    </div>
  </div>
</div>

<!-- ================================================= Job Deleting Modal ================================================= -->

<div class="modal fade right" id="deleteJobPopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="t`rue">
  <div class="modal-dialog modal-notify modal-danger modal-side modal-top-right" role="document">
    <!--Content-->
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header">
        <p class="heading">Delete Job</p>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text">&times;</span>
        </button>
      </div>
      <!--Body-->
      <div class="modal-body">
        <div class="row">
          <div class="col">
            <p class="text-center"><i class="fas fa-trash fa-2x"></i></p>
          </div>
        </div>
        <div class="row text-center mt-3 px-4">
            <p>This action can not be undone. Are you sure you wish to continue?</p>
        </div>
      </div>
      <!--Footer-->
      <div class="modal-footer justify-content-center">
        <a type="button" class="btn btn-sm btn-outline-danger waves-effect" data-dismiss="modal">Cancel</a>
        <a type="button" id="deleteConfirmJobId" class="confirm_jobDelete_ok btn btn-sm btn-danger"data-dismiss="modal">Delete<i class="fas fa-trash ml-1 white-text"></i></a>
      </div>
      <input type="hidden" name="deleteConfirmJobId" id="deleteConfirmJobId" value=""/>
    </div>
    <!--/.Content-->
  </div>
</div>

{{-- ======================= ajax loader ============================ --}}

<div class="modal" id="centralModalSuccess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-notify modal-success" role="document">

      <div class="modal-body">
        <div class="text-center">

        <div class="spinner-grow text-primary" role="status">
          <span class="sr-only">Loading...</span>
        </div>

        </div>
      </div>
  </div>
</div>

{{-- ======================= Succes Message ============================ --}}

<div class="modal jobDeleted" id="successMessageJobdeleting" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-notify modal-success" role="document">

      <div class="modal-body">
        <div class="text-center text-white">
            <p>Job Has been Deleted Successfully</p>
        <div class="spinner-grow text-primary" role="status">
          <span class="sr-only">Loading...</span>
        </div>

        </div>
      </div>
  </div>
</div>

<!-- ================================================= Job Application Deleting Modal ================================================= -->

<div class="modal fade right" id="deleteJobAppPopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="t`rue">
  <div class="modal-dialog modal-notify modal-danger modal-side modal-top-right" role="document">
    <!--Content-->
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header">
        <p class="heading">Delete Job Application</p>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text">&times;</span>
        </button>
      </div>
      <!--Body-->
      <div class="modal-body">
        <div class="row">
          <div class="col">
            <p class="text-center"><i class="fas fa-trash fa-2x"></i></p>
          </div>
        </div>
        <div class="row text-center mt-3 px-4">
            <p>This action can not be undone. Are you sure you wish to continue?</p>
        </div>
      </div>
      <!--Footer-->
      <div class="modal-footer justify-content-center">
        <a type="button" class="btn btn-sm btn-outline-danger waves-effect" data-dismiss="modal">Cancel</a>
        
        <a type="button" id="deleteConfirmJobId" class="confirm_jobAppDelete_ok btn btn-sm btn-danger"data-dismiss="modal">Delete<i class="fas fa-trash ml-1 white-text"></i></a>

      </div>
      <input type="hidden" name="deleteConfirmJobAppId" id="deleteConfirmJobAppId" value=""/>
    </div>
    <!--/.Content-->
  </div>
</div>

{{-- ======================================================= Unlike Employer js Modal ======================================================= --}}
 <!-- Central Modal Medium Info -->
 <div class="modal fade" id="unlikeEmpModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-hidden="true" data-backdrop="static">
   <div class="modal-dialog modal-notify modal-danger" role="document">
     <!--Content-->
     <div class="modal-content">
       <!--Header-->
       <div class="modal-header">
         @if (isEmployer($user))
         <p class="heading lead">UnLike Jobseeker?</p>
         @else
         <p class="heading lead">UnLike Employer?</p>
         @endif
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
       <!--Body-->
       <div class="modal-body">
         <div class="text-center">
           <i class="fas fa-check fa-4x mb-3 animated rotateIn"></i>

           <p>
               Are you sure you wish to continue?

           </p>
            <p class="idOfEmployerInModal"></p>
         </div>
       </div>

       <!--Footer-->
       <div class="modal-footer justify-content-center">
         <a type="button" class="btn btn-outline-danger waves-effect" data-dismiss="modal">Cancel</a>
         <a type="button" class="btn btn-danger confirmUnlikeEmployer" data-dismiss="modal" >Confirm</a>
         <input type="hidden" name="idEmpInModalHidden" id="idEmpInModalHidden" value =""/>

       </div>
     </div>
     <!--/.Content-->
   </div>
 </div>
 <!-- Central Modal Medium Info-->

{{-- ======================================================= Unlike Employer Modal ======================================================= --}}