<div class="IndustrySelect">
	  <p class="p0 qualifType"> Template Name: <b>  {{$UserInterview->template->template_name}} </b> </p>
	  @if ($UserInterview->template->type == 'phone_screeen' )
	    <p class="p0 qualifType"> Template Type: <b> Phone Screen</b> </p>
	  @else
	    <p class="p0 qualifType text_capital"> Template Type: <b> {{$UserInterview->template->type}} </b> </p>
	    <p class="p0 qualifType"> Employer's Instructions: <b> {{$UserInterview->template->employers_instruction}} </b> </p>
	  @endif
	  <p class="p0 qualifType text_capital"> Interviewer Name: <b> {{$UserInterview->employer->company}} </b> </p>

	  @if ($UserInterview->template->employer_video_intro)
	    
	    <div class="dflex">
	        <div class="w20">
	          <p class="p0 qualifType text_capital"> Employer's Intro: </p>
	        </div>
	        <div class="w80">
	          <div class="video_div pointer"  onclick="showVideoModal12( '{{template_video($UserInterview->template->employer_video_intro)}}')"> 
	            <div id="v_123456"> <img src="https://img.icons8.com/color/48/000000/video.png"/></div>
	          </div>      
	        </div>

	    </div>

	  @endif

</div>



<div style="display:none;">
    <div id="videoShowModal" class="modal p0 videoShowModal">
        <div class="pp_info_start pp_alert pp_confirm pp_cont" style="left: 0px; top: 0px; margin: 0;">
            <div class="cont">
                <div class="videoBox"></div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

this.showVideoModal12= function(video_url){

  console.log(' =============== hassan here ================ ', video_url);
  var videoElem  = '<video id="player" controls>';
  videoElem     += '<source src="'+video_url+'" type="video/mp4">';
  videoElem     += '</video>';
  $('#videoShowModal .videoBox').html(videoElem);
  $('#videoShowModal').modal({
      fadeDuration: 200,
      fadeDelay: 2.5,
      escapeClose: false,
      clickClose: false,
          });
  $('#videoShowModal').on($.modal.CLOSE, function(event, modal) {
    $(this).find(".videoBox video").remove();
  });

}

</script>