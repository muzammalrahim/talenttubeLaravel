<div class="modal fade" id="errorReschedulingSlot" tabindex="-1" role="dialog" aria-labelledby="sendemail" aria-hidden="true" data-backdrop = "static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="sendemail">Slot Updated</h5>
        <button type="button" class="close text-white bookingDeletedClodeModal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-0">
        <div class="text-center my-4 warning_text">
            Error – You are already booked in for this interview time slot, please select another time slot to properly reschedule your interview
        </div>
        {{-- <div class="ajaxDataOfSlots"></div> --}}
      </div>
      <div class="modal-footer text-center d-block">
        <button type="button" class="btn btn-sm btn-success text-white" onclick="removeOverlay()"  data-dismiss="modal" aria-label="Close"> ok </button>

      </div>
    </div>
  </div>
</div>