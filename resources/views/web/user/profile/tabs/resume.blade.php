         

<div class="row Resume">
   <h2>Resume & Contact Details</h2>
   <div class="col-md-6 Resume-email"><label>Email:<span>{{  $user->email }}</span></label></div>
   <div class="col-md-6 Resume-contact"><label>Contact#:<span>{{ $user->phone }}</span></label></div>
</div>

<div class="Gallery clearfix">
   <ul>
      <li>
         <section class="multiple-file-pdf" id="mupload5" > 
            <div class="file-chooser clearfix">

               <form id="frm_upload" onsubmit="userResumeUpload()" class="submit-document" action="route('userUploadResume')" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                    <br>
                    <input type="file" name="resume" id="resume" accept=".pdf,.doc,.docx">
                    <button class="btn violet save-resume-btn valign-top " name="submit" style="padding: 5px;"><i class="fa fa-save" ></i>Save</button>
                </form>

            </div>
         </section>
      </li>
    </ul>
    
    <ul class="private_attachments">
      
      @foreach ($attachments as $attachment)
      {{-- {{asset('images/user/'.$attachment->file)}} --}}
      <li class="attachment_{{$attachment->id}} uploaded-file-resume">
         {{--  <div class="attachment"><img src="{{asset('images/site/icons/cv.png')}}" /></div> --}}
         <span class="attach_title">{{ $attachment->name }}</span>
         <div class="attach_btns">
            <a class="attach_btn downloadAttachBtn" href="{{asset('images/user/'.$attachment->file)}}"><i class="fas fa-download"></i></a>
            <a class="attach_btn removeAttachBtn" data-attachmentid="{{$attachment->id}}" data-toggle="modal" data-target="#deleteresumeModal" onclick="removeAttachmentModal({{$attachment->id}});">X</a>
         </div>
      </li>
      @endforeach

   </ul>

</div>
                          
                   
                            
<div class="modal fade" id="deleteresumeModal" role="dialog">
  <div class="modal-dialog delete-applications">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <i data-dismiss="modal" class="close-box fa fa-times"></i>                      
        <h1 class="modal-title"><i class="fa fa-trash trash-icon"></i>Delete Attachment?</h1>
      </div>
      <div class="modal-body">
        <strong>This action can not be undone. Are you sure you wish to continue?</strong>
      </div>
      <div class="dual-footer-btn">
        <input type="hidden" name="" id="deleteAttachmentId"/>

        <button type="button" class="btn btn-default black_btn" data-dismiss="modal"><i class="fa fa-times"></i>Cancel</button>
        <button type="button" class="orange_btn" onclick="removeAttachmentConfirm()" data-dismiss="modal"><i class="fa fa-check"></i>OK</button>
      </div>
    </div>
    
  </div>
</div>