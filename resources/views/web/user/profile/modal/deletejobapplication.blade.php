<div class="modal fade px-3 px-md-0" id="jobAppDeleteModal" role="dialog">
    <div class="modal-dialog delete-applications">
        <!-- Modal content-->
        <div class="modal-content border-0">
            <div class="modal-header">
                <i data-dismiss="modal" class="close-box fa fa-times"></i>                      
                <h1 class="modal-title"><i class="fa fa-trash trash-icon"></i>Delete Job Application</h1>
            </div>
            {{-- <div class="modalBody"> --}}
                <div class="modal-body">
                    <strong>Are you sure you wish to continue?</strong>
                </div>
                <input type="hidden" id="deleteConfirmJobAppId" name="">

                <div class="dual-footer-btn">
                    <button type="button" class="btn btn-default black_btn" data-dismiss="modal"><i class="fa fa-times"></i>Cancel</button>
                    <button type="button" class="orange_btn float-none" onclick="confirmDeleteJobApp()" data-dismiss="modal" ><i class="fa fa-check"></i>OK</button>
                </div>
            {{-- </div> --}}

            {{-- <div class="modalFooter my-4 text-center">
                <div class="apiMessage"></div>
                <div class="spinner-grow text-primary deleteJobAppLoader d-none" role="status">
                  <span class="sr-only">Loading...</span>
                </div>
            </div> --}}
        </div>
    </div>
</div>