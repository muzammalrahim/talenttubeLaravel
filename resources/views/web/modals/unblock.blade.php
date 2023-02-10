<div class="modal fade px-3 px-md-0" id="unBlockModal" role="dialog">
   <div class="modal-dialog delete-applications">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <i data-dismiss="modal" class="close-box fa fa-times"></i><i ></i>                      
            <h1 class="modal-title w-100"><i class="fas fa-ban trash-icon"></i>UnBlock User</h1>
         </div>
         <div class="modal-body">
            <strong>Are you sure you wish to continue?</strong>
         </div>

         <input type="hidden" id="jobSeekerBlockId" />

         <div class="dual-footer-btn mx-3 mx-md-0">
            <button type="button" class="btn btn-default black_btn" data-dismiss="modal"><i class="fa fa-times"></i>Cancel</button>
            <button type="button" onclick="confirmUnBlockUser()" data-dismiss="modal" class="orange_btn float-none"><i class="fa fa-check"></i>OK</button>
         </div>
      </div>
   </div>
</div>