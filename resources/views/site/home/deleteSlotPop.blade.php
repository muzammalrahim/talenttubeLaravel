{{-- <div style="display:none;">


    <div id="deleteSlotModal" class="popup intConc_sign_inPP">
        <div class="head"> Delete Slot

            <span class="close_hover"> </span>

        </div>
        <div class="cont">
            <div class="bl">
                    <p> All the interview bookings with this slot will be deleted.<br> Are you sure you wish to continue? </p> 

                    <input type="hidden" name="" class="slotIDPopUp">
                    <input type="hidden" name="" class="comnameInPopUp">
                    <input type="hidden" name="" class="useremailInPopup">
                    <input type="hidden" name="" class="posNamePopup">

                  <div class="center deleteSlotDiv">  <button id="deleteSlot_confirm" type="submit" class="btn pink">Yes</button></div>
                
            </div>
        </div>
    </div>


</div> --}}



<div class="modal fade" id="deleteSlotModal" role="dialog">
    <div class="modal-dialog delete-applications">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <i data-dismiss="modal" class="close-box fa fa-times"></i><i ></i>                      
                <h1 class="modal-title"><i class="fas fa-thumbs-down trash-icon"></i>Delete Booking</h1>
            </div>
            <div class="modal-body">
                <strong>All the interview bookings with this slot will be deleted.<br> Are you sure you wish to continue?</strong>
            </div>

            {{-- <input type="hidden" id="jobSeekerBlockId" /> --}}

            <input type="hidden" name="" class="slotIDPopUp">
            <input type="hidden" name="" class="comnameInPopUp">
            <input type="hidden" name="" class="useremailInPopup">
            <input type="hidden" name="" class="posNamePopup">

            <div class="dual-footer-btn deleteSlotDiv">
                <button type="button" class="btn btn-default black_btn" data-dismiss="modal"><i class="fa fa-times"></i>Cancel</button>
                <button type="button" class="orange_btn" id="deleteSlot_confirm" {{-- onclick="confirmUnlikeFun()" --}} data-dismiss="modal"><i class="fa fa-check"></i>OK</button>
            </div>
        </div>
    </div>
</div>

