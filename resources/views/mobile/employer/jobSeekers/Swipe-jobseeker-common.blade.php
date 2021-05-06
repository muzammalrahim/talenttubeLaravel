<div class="modal fade"id="videoShowModal"tabindex="-1"aria-labelledby="exampleModalLabel"aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="closeButton">
            <span class="float-right border border-black m-2 py-1 px-2" onclick="closeVideo()">X</span>
        </div>
      <div class="modal-body videoBox"></div>
     <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="closeVideo()">Close</button>
      </div>  -->
    </div>
  </div>
</div>

<script type="text/javascript">
    
    // ============================================== Change Status to in review ============================================== 

    this.inreview = function(){
        var app_id = $('.inreview').attr('data-appId');
        var status = $('.inreview').attr('data-status');
        $.ajax({
          type: 'POST',
          url: base_url+'/m/ajax/application/status/inreview',
          data: {id:app_id,status:status},
            success: function(data){
                if (data.status == 1) {
                    $('.statusUpdated').html(data.jobStatus);
                }
            }   
        });
    }

    // ============================================== Change Status to interview ============================================== 

    this.interview = function(){
        var app_id = $('.interview').attr('data-appId');
        var status = $('.interview').attr('data-status');
        $.ajax({
          type: 'POST',
          url: base_url+'/m/ajax/application/status/interview',
          data: {id:app_id,status:status},
            success: function(data){
                if (data.status == 1) {
                    $('.statusUpdated').html(data.jobStatus);
                }
            }
        });
    }

    // ============================================== Change Status to unsuccessful ============================================== 

    this.unsuccessful = function(){
        var app_id = $('.unsuccessful').attr('data-appId');
        var status = $('.unsuccessful').attr('data-status');
        // console.log("Application Id" +app_id + "Application Status"+ status); 
        $.ajax({
          type: 'POST',
          url: base_url+'/m/ajax/application/status/unsuccessful',
          data: {id:app_id,status:status},
            success: function(data){
                if (data.status == 1) {
                    $('.statusUpdated').html(data.jobStatus);
                }
            }   
        });
    }

    $('.questionsAnswers').click(function(){
        $('.application_qa').toggleClass('d-none');
    });


    profileVideoShow =  function(video_url){
        console.log(' showVideoModal ', video_url);
        var videoElem  = '<video id="player" controls class = "video-fluid">';
        videoElem     += '<source src="'+video_url+'" type="video/mp4">';
        videoElem     += '</video>';
        $('#videoShowModal .videoBox').html(videoElem);
        $('#videoShowModal').modal('show'); 
    }

    closeVideo = function(){
        $('#videoShowModal').modal('hide'); 

    }

    viewCv = function(){
        var jsId = $('.viewCvButton').attr('data-jsid');
        // console.log(jsId);

        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                type: 'POST',
                url: base_url+'/m/ajax/jobseeker/viewCv/'+jsId,
                data: {'id': jsId},
                success: function(data){
                console.log(data)
                location.href = data;
                }
            });
    }

    profileImage = function(profile_image){
        console.log(' showVideoModal ', profile_image);
        var videoElem  = '<img id="imginModal" src="'+profile_image+'""/>';
        $('#videoShowModal .videoBox').html(videoElem);
        $('#videoShowModal').modal('show'); 
    }



    var swiper = new Swiper(".mySwiper", {

        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
          el: ".swiper-pagination",
          dynamicBullets: true,
        },
      });



</script>


<style type="text/css">
    
    img#imginModal {
    /*height: calc(var(--vh, 1vh) * 57);*/
    height: calc(var(--vh, 1vh) * 57);
    max-width: calc(100vw - 52px);

}
.swiper-wrapper {box-sizing: inherit !important;}

.jobSeekers_list{
    height: calc(var(--vh, 1vh) * 79);
}
</style>


