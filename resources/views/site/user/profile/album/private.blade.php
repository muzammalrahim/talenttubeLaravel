<span class="prvate-section">
    <div class="title_private_photos" style="margin-bottom: 5px;">
        Resume &amp; Contact Details
    </div>
    
    <ul class="list_interest_c" style="margin: 0;padding: 0 0 0 23px;">
        <li><span class="basic_info">•</span><span id="info_looking_for_orientation">Email: {{$user->email}}</span></li>
        <li><span class="basic_info">•</span><span id="info_looking_for_ages">Mobile : {{$user->phone}}</span></li>
        {{-- <li> <a class="btn violet view-resume" target="_blank" style="" href="/talenttube/_files/resumeUpload/3687_Pimmys logo.pdf">View Resume</a></li> --}}
    </ul>
    
    
    <form id="frm_upload" class=" submit-document" action="route('userUploadResume')" method="post" enctype="multipart/form-data">
				 {{ csrf_field() }}
        <br>
        <input type="file" name="resume" id="resume" accept=".pdf,.doc,.docx">
        <button class="btn violet save-resume-btn valign-top" name="submit" style="padding: 5px;">Save</button>
    </form>
    </span>
    <br>

		<div class="private_attachments">
				@foreach ($attachments as $attachment)

					{{-- {{asset('images/user/'.$attachment->file)}} --}}

					<div class="attachment_{{$attachment->id}} attachment_file">
							<div class="attachment"><img src="{{asset('images/site/icons/cv.png')}}" /></div>
							<span class="attach_title">{{ $attachment->name }}</span>
							<div class="attach_btns">
								<a class="attach_btn downloadAttachBtn" href="{{asset('images/user/'.$attachment->file)}}">Download</a>
								<a class="attach_btn removeAttachBtn" data-attachmentid="{{$attachment->id}}" onclick="UProfile.confirmAttachmentDelete({{$attachment->id}});">Remvoe</a>
							</div>
							
					</div>
				@endforeach		
		</div>

		
<div style="display:none;">
<div id="confirmDeleteAttachmentModal" class="modal p0 confirmDeleteModal">
<div class="pp_info_start pp_alert pp_confirm pp_cont" style="left: 0px; top: 0px; margin: 0;">
		<div class="cont">
				<div class="title">Delete Attachment?</div>
				<div class="img_chat">
						<div class="icon">
								<img src="{{asset('/images/site/icons/icon_pp_sure.png')}}" height="48" alt="">
						</div>
						<div class="msg">This action can not be undone. Are you sure you wish to continue?</div>
				</div>
				<div class="double_btn">
						<button class="confirm_close btn small dgrey" onclick="UProfile.cancelGalleryConfirm(); return false;">Cancel</button>
						<button class="confirm_ok btn small marsh" onclick="UProfile.deleteAttachment(); return false;">OK</button>
						<input type="hidden" name="deleteAttachmentId" id="deleteAttachmentId" value=""/>
						<div class="cl"></div>
				</div>
		</div>
</div>
</div>
</div>

<style type="text/css">

#confirmDeleteAttachmentModal>a.close-modal,#confirmDeleteVideoModal>a.close-modal,#confirmDeleteModal>a.close-modal{
    margin: 14px 14px 0px 0px;
}

div.pp_info_start.pp_alert.pp_confirm.pp_cont>div.cont>.title {
    font-size: 20px;
}
</style>