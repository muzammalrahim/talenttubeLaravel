


<div class="attachment_{{$attachment->id}} attachment_file">
	<div class="attachment"><img src="{{asset('images/site/icons/cv.png')}}" / height="85px"></div>
		<span class="attach_title">{{ $attachment->name }}</span>
	<div class="attach_btns">
		<a class="attach_btn downloadAttachBtn" href="{{asset('images/user/'.$attachment->file)}}">Download</a>
	</div>
</div>