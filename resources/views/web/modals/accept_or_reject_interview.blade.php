<div class="modal fade" id="acceptOrRejectInterview" role="dialog">
    <div class="modal-dialog delete-applications">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <i data-dismiss="modal" class="close-box fa fa-times"></i><i ></i>                      
          {{-- <h1 class="modal-title"><i class="fas fa-thumbs-down trash-icon"></i>UnLike User</h1> --}}
        </div>
        <div class="modal-body">
          <strong>Would you like to accept or reject this interview ?</strong>
        </div>
        <input type="hidden" id="interviewUrl" name="">
        <input type="hidden" id="interviewId" name="">
        <div class="dual-footer-btn">
          <button type="button" class="btn btn-default black_btn" onclick="rejectInterviewInvitation()" data-dismiss="modal"><i class="fa fa-times"></i>Reject</button>
          <button type="button" class="orange_btn" onclick="acceptInterviewButton()" data-dismiss="modal"><i class="fa fa-check" ></i>Accept</button>
        </div>
      </div>
      
    </div>
</div>