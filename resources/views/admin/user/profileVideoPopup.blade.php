

<div class="profileVideoPopup">

	{{-- @dd( $user->vidoes->first() ); --}}
	<div class="profileVideoShow">
		@if($user->vidoes)
			<video class="videoPlayer" controls=""><source src="{{assetVideo($user->vidoes->first())}}"></video>
		@endif
	</div>

	
	<div class="profleVideosBox" style="text-align: left;">
		 @if($user->vidoes->count() > 1)
			<div class="profleVideos">
					@foreach ($user->vidoes as $vidoe)
					 {!! generateVideoThumbs($vidoe) !!}
					@endforeach
			</div>
		@endif
	</div>


</div>