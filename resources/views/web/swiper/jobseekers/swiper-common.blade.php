<div class="modal fade"id="videoShowModal"tabindex="-1"aria-labelledby="exampleModalLabel"aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="closeButton">
            <span class="float-right border border-black m-2 py-1 px-2" onclick="closeVideo()">X</span>
        </div>
      <div class="modal-body videoBox w-100"></div>
    </div>
  </div>
</div>


@include('web.modals.jobApplication-questions')




<script type="text/javascript">

    this.change_status = function(app_id, status,this_e){
        $(this_e).parents('.jobApp_'+app_id).find('.status-div').removeClass('activestatus');
        $(this_e).closest('.status-div').addClass('activestatus');
        $.ajax({
          type: 'POST',
          url: base_url+'/ajax/application/status/update/'+app_id,
          data: {status:status},
            success: function(data){
                if (data.status == 1) {
                    if (data.jobStatus == 'inreview') {
                        $('.statusUpdated_'+app_id).html('(In Review)');
                    }
                    else{
                        var jobsstatus = '(' +data.jobStatus+ ')';
                        $('.statusUpdated_'+app_id).html( jobsstatus );    
                    }
                }
            }   
        });
    }

    // ============================================== Change Status to in review ============================================== 

    profileVideoShow =  function(video_url){
        console.log(' showVideoModal ', video_url);
        var videoElem  = '<video id="player" controls class = "video-fluid w-100">';
        videoElem     += '<source src="'+video_url+'" type="video/mp4">';
        videoElem     += '</video>';
        $('#videoShowModal .videoBox').html(videoElem);
        $('#videoShowModal').modal('show'); 
    }

    closeVideo = function(){
        $('#videoShowModal').modal('hide'); 

    }

    this.viewJobseekerCv = function(jsId){
        // var jsId = $(this).attr('data-jsid');
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
            nextEl: '.swiper-button-next1',
            prevEl: '.swiper-button-prev1',
        },
        pagination: {
          el: ".swiper-pagination",
          dynamicBullets: true,
        },

        longSwipes: false,
        loopPreventsSlide: false,
        touchEventsTarget: 'container'
      });


    var swiper = new Swiper(".mySwiper", {

        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
          el: ".swiper-pagination",
          dynamicBullets: true,
        },

        longSwipes: false,
        loopPreventsSlide: false,
        touchEventsTarget: 'container'
      });



</script>


<style type="text/css">
    
    img#imginModal {
    /*height: calc(var(--vh, 1vh) * 57);*/
    height: calc(var(--vh, 1vh) * 57);
    max-width: calc(100vw - 52px);

}
.main-body{
    overflow: auto;
    overflow-x: hidden;
    max-height: 100vh;
    overflow: hidden;
}
.swiper-wrapper {box-sizing: inherit !important;}

.jobSeekers_list{
    height: calc(var(--vh, 1vh) * 79);
}

.applications_list{
    height: calc(var(--vh, 1vh) * 79);
}

 img.img-fluid.imageSizeModal.z-depth-1 {
/*            height: 300px;*/
height: calc(var(--vh, 1vh) * 44);
}
</style>

