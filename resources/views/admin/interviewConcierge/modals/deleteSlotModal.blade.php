
<!-- Modal -->
<div class="modal fade" id="deleteSlotPopUp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title" id="exampleModalLabel">Delete Slot</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p> All the interview bookings with this slot will be deleted.<br> Are you sure you wish to continue? </p> 

            <input type="hidden" name="" class="slotIDPopUp">
            <input type="hidden" name="" class="comnameInPopUp">
            <input type="hidden" name="" class="useremailInPopup">
            <input type="hidden" name="" class="posNamePopup">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-danger" id="deleteSlot_confirm">yes</button>
      </div>
    </div>
  </div>
</div>



{{-- Delete Interview Modal --}}

<div class="modal fade" id="deleteInterviewPopUp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content w-75 m-auto">
      <div class="modal-header bg-danger">
        <h5 class="modal-title" id="exampleModalLabel">Delete Interview</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p> This action cannot be undone.<br> Are you sure you wish to continue? </p> 

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-danger" id="removejob">yes</button>
      </div>
    </div>
  </div>
</div>


{{-- Delete Interview Modal --}}