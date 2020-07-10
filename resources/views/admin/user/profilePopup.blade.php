

<div class="profilePopup">

	<div class="profileImg">
		@if($user->profileImage)
			<img src="{{assetGallery2($user->profileImage,'')}}" />
		@endif
	</div>

	<div class="profleMediaGalleryBox" style="text-align: left;">
		 @if($user->Gallery)
			<div class="profleMediaGallery">
					@foreach ($user->Gallery as $gallery)
					 <div class="profleMediaGalleryImage">
					 	<img src="{{assetGallery2($gallery,'small')}}" data-fullpath="{{assetGallery2($gallery,'')}}" />
					 </div>
					@endforeach
			</div>
			
		@endif
	</div>
</div>