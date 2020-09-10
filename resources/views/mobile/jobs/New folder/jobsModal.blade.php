

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

