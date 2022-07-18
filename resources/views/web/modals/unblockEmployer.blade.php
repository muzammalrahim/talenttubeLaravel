<div class="modal fade px-3 px-md-0" id="unblockUserModal" role="dialog">
    <div class="modal-dialog delete-applications">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <i data-dismiss="modal" class="close-box fa fa-times"></i>                      
          <h1 class="modal-title"><i class="fas fa-ban trash-icon"></i>UnBlock User</h1> 
        </div>
        <div class="modal-body">
          <strong>Are you sure you wish to continue?</strong>
        </div>
        <input type="hidden" id="jobSeekerBlockId" name="">
        <div class="dual-footer-btn mx-3 mx-md-0">
          <button type="button" class="btn btn-default black_btn" data-dismiss="modal"><i class="fa fa-times"></i>Cancel</button>
          <button type="button" class="orange_btn" onclick="confirmUnBlockEmployer()" data-dismiss="modal"><i class="fa fa-check"></i>OK</button>
        </div>
      </div>
    </div>
</div>