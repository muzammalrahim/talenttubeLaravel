<div class="modal fade" id="emailSendingModal" tabindex="-1" role="dialog" aria-labelledby="sendemail" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="sendemail">Send Your Preferred Slot</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-0">
        {{-- <input type="text" name="" class="intConInModal"> --}}
        <div class="text-center preferredSlotLoader d-none">
            <div class="spinner-border text-primary" role="status">
              <span class="sr-only">Loading...</span>
            </div>
        </div>

        <div class="ajaxDataOfSlots"></div>
        <input type="hidden" name="" class="bookingIdINModal">

      </div>
      <div class="modal-footer text-center d-block">
        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
        {{-- <button type="button" class="confirmSendEmail btn btn-primary" data-dismiss="modal">Confirm</button> --}}

        <div class="pb-3"> 
            <a href="{{route('homepage')}}"> Click here to go home page</a>
        </div>

      </div>
    </div>
  </div>
</div>