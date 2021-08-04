

{{-- <script src="{{ asset('js/dropzone/dist/min/dropzone.min.js') }}"></script> --}}

<script type="text/javascript">
	

// ============================================================================================================ 
// Dropzone js
// ============================================================================================================ 

// =============================================== For Loop index "0" ===============================================
// $(document).on('ready', function(){

Dropzone.autoDiscover = false;
  new Dropzone("#dropzone_0", {
  url : base_url + '/ajax/interview-response/uploadVideo',
  paramName: "file", // The name that will be used to transfer the file
  maxFilesize: 40, // MB
  maxFiles: 1,
  timeout: 3600000,
  addRemoveLinks: true,
  dictRemoveFile: " Remove",
  acceptedFiles: 'video/*',
  // acceptedFiles: '.video/x-flv, .video/mp4, .application/x-mpegURL, .video/MP2T, .video/3gpp, .video/quicktime, .video/x-msvideo, .video/x-ms-wmv,',
  init: function () {
    var $this = this;
    $("#clear-media").on("click", function () {
      $this.removeAllFiles();
    });
    this.on("success", function (file, response) {
      console.log(response.path);
      $('.vide_response_url_0').val(response.path);return;
    });

    this.on("removedfile", function (file) {
      var question_id = $('.vide_response_url_0').attr('data-question_id');
      var userInterviewId = $('.userInterviewId').val();
      // console.log(question_id);
      $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
      $.ajax({
          type: 'POST',
          url: base_url+'/ajax/interview-response/delete_video/' +1,
          data:{question_id:question_id,userInterviewId:userInterviewId},
          success: function(response){
              console.log(' response ', response);
              $('.vide_response_url_0').val('');
          }
      });
      console.log(' Remove video from here ');
    });

  }
});


// =============================================== For Loop index "1" ===============================================

Dropzone.autoDiscover = false;
  new Dropzone("#dropzone_1", {
  url : base_url + '/ajax/interview-response/uploadVideo',
  paramName: "file", // The name that will be used to transfer the file
  maxFilesize: 40, // MB
  maxFiles: 1,
  timeout: 3600000,
  addRemoveLinks: true,
  dictRemoveFile: " Remove",
  acceptedFiles: 'video/*',
  // acceptedFiles: '.video/x-flv, .video/mp4, .application/x-mpegURL, .video/MP2T, .video/3gpp, .video/quicktime, .video/x-msvideo, .video/x-ms-wmv,',
  init: function () {
    var $this = this;
    $("#clear-media").on("click", function () {
      $this.removeAllFiles();
    });
    this.on("success", function (file, response) {
      console.log(response.path);
      $('.vide_response_url_1').val(response.path);return;
    });

    this.on("removedfile", function (file) {
      var question_id = $('.vide_response_url_1').attr('data-question_id');
      var userInterviewId = $('.userInterviewId').val();
      // console.log(question_id);
      $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
      $.ajax({
          type: 'POST',
          url: base_url+'/ajax/interview-response/delete_video/' +1,
          data:{question_id:question_id,userInterviewId:userInterviewId},
          success: function(response){
              console.log(' response ', response);
              $('.vide_response_url_1').val('');
          }
      });
      console.log(' Remove video from here ');
    });

  }
});

// =============================================== For Loop index "2" ===============================================

Dropzone.autoDiscover = false;

  new Dropzone("#dropzone_2", {
  url : base_url + '/ajax/interview-response/uploadVideo',
  paramName: "file", // The name that will be used to transfer the file
  maxFilesize: 40, // MB
  maxFiles: 1,
  timeout: 3600000,
  addRemoveLinks: true,
  dictRemoveFile: " Remove",
  acceptedFiles: 'video/*',
  // acceptedFiles: '.video/x-flv, .video/mp4, .application/x-mpegURL, .video/MP2T, .video/3gpp, .video/quicktime, .video/x-msvideo, .video/x-ms-wmv,',
  init: function () {
    var $this = this;
    $("#clear-media").on("click", function () {
      $this.removeAllFiles();
    });
    this.on("success", function (file, response) {
      console.log(response.path);
      $('.vide_response_url_2').val(response.path);

    });
    
    this.on("removedfile", function (file) {
      var question_id = $('.vide_response_url_2').attr('data-question_id');
      var userInterviewId = $('.userInterviewId').val();
      console.log(question_id);
      $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
      $.ajax({
          type: 'POST',
          url: base_url+'/ajax/interview-response/delete_video/' +1,
          data:{question_id:question_id,userInterviewId:userInterviewId},
          success: function(response){
              console.log(' response ', response);
              $('.vide_response_url_2').val('');

          }
      });
      console.log(' Remove video from here ');
    });

  }
});


// });


</script>