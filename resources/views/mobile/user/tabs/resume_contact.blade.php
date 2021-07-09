
<div class="prvate-section text-dark mt-2">
    <div class="tabs_resume mb-2 font-weight-bold"> <i class="fa fa-lock" aria-hidden="true"></i> Resume &amp; Contact Details</div>
    <ul class="list_interest_c" style="margin: 0;padding: 0 0 0 23px;">
        <li><span id="info_looking_for_orientation">Email: {{$user->email}}</span></li>
        <li><span id="info_looking_for_ages">Mobile : {{$user->phone}}</span></li>
        {{-- <li> <a class="btn violet view-resume" target="_blank" style="" href="/talenttube/_files/resumeUpload/3687_Pimmys logo.pdf">View Resume</a></li> --}}
    </ul>
    <form id="frm_upload" class="submit-document1" action="" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
        <br>
        {{-- <div class="row">  --}}
          <input type="file" name="resume" id="resume" class="form-control" accept=".pdf,.doc,.docx">
          <button class="btn btn-sm btn-primary save-resume-btn" name="" style="padding: 5px;">Upload Resume</button>
        {{-- </div> --}}
    </form>
</div>

<div class="private_attachments">
    @foreach ($attachments as $attachment)
    <div class="attachment_{{$attachment->id}} attachment_file">
      <div class="attachment"><img src="{{asset('images/site/icons/cv.png')}}" height="70px" /></div>
      <span class="attach_title">{{ $attachment->name }}</span>
      <div class="attach_btns">
        <a class="attach_btn btn btn-sm btn-primary d-inline-block" href="{{asset('images/user/'.$attachment->file)}}">Download</a>
        <a class="attach_btn btn btn-sm btn-danger removeAttachBtn d-inline-block" data-attachmentid="{{$attachment->id}}" data-toggle="modal" data-target="#deleteResumeModal">Remove</a>
      </div>
    </div>
    @endforeach
</div>


<!-- Central Modal Medium Danger -->

<div class="modal fade" id="deleteResumeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
 aria-hidden="true">
 <div class="modal-dialog modal-notify modal-danger" role="document">
   <!--Content-->
   <div class="modal-content">
     <!--Header-->
     <div class="modal-header">
       <p class="heading lead">Delete Resume</p>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true" class="white-text">&times;</span>
       </button>
     </div>
     <!--Body-->
     <div class="modal-body">
       <div class="text-center">
         <i class="fas fa-check fa-4x mb-3 animated rotateIn"></i>
          <p> This action can not be undone. Are you sure you wish to continue? </p>
       </div>
     </div>
     <!--Footer-->
     <div class="modal-footer justify-content-center">
       <a type="button" class="btn btn-outline-danger waves-effect" data-dismiss="modal">No</a>
       <input type="hidden" name="" class="deleteAttachmentIdInModal">
       <a type="button" class="btn btn-danger confirmDeleteAttachment" data-dismiss="modal" >Yes </a>
     </div>
   </div>
   <!--/.Content-->
 </div>
</div>


<script type="text/javascript">


$('.submit-document1').on('submit',(function(e) {
  e.preventDefault();
  var formData = new FormData(this);
  formData.append('submit', true);
  $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
  $.ajax({
    type:'POST',
    url: base_url+'/m/ajax/userUploadResume',
    data:formData,
    cache:false,
    contentType: false,
    processData: false,
    beforeSend:function(){
      $('.save-resume-btn').html('Saving... <i class="fa fa-spinner fa-spin"></i>');
    },
    success:function(data){
      $('.save-resume-btn').html('Upload Resume');
      if(data && data.attachments) {
      // data = JSON.parse(data);
      // $('.view-resume').attr('href', '/talenttube/_files/resumeUpload/'+data['attachment']).show();
      var attachments = data.attachments;
      console.log(attachments);
      var attach_html = '';
      attach_html += '<div class="attachment_'+attachments.id+' attachment_file">';
      attach_html +=   '<div class="attachment"><img src="'+base_url+'/images/site/icons/cv.png" height ="70px"/></div>';
      attach_html +=   '<span class="attach_title">'+attachments.name+'</span>';
      attach_html +=   '<div class="attach_btns">';
      attach_html +=      '<a class="attach_btn btn btn-sm btn-primary downloadAttachBtn" href="'+data.file+'">Download</a>';
      attach_html +=      '<a class="attach_btn btn btn-sm btn-danger removeAttachBtn" data-attachmentid="'+attachments.id+'" onclick="UProfile.confirmAttachmentDelete('+attachments.id+');">Remvoe</a>';
      attach_html +=    '</div>';
      attach_html +=  '</div>';
      $('.private_attachments').append(attach_html);
    }
    console.log(data);
  },
  error: function(data){
    console.log("error");
    console.log(data);
  }
});

}));


$('.removeAttachBtn').click(function(){
  var deleteAttachmentId = $(this).attr('data-attachmentid');
   $('.deleteAttachmentIdInModal').val(deleteAttachmentId);
});

$('.confirmDeleteAttachment').click(function(){
  var attachment_id = $('.deleteAttachmentIdInModal').val();
    console.log(attachment_id);
  $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
  $.ajax({
    type:'GET',
    url: base_url+'/m/ajax/MremoveAttachment/',
    data: {attachment_id: attachment_id},
    success: function(data){
      console.log(' data ', data);
      if(data.status == 1){
        $('.attachment_file.attachment_'+attachment_id).remove();
      }
    }
  });

});


</script>