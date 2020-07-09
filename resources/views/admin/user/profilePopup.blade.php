

<div class="profilePopup">
	ID : {{$user->id}}
	Name : {{$user->name}}
	
	<div style="text-align: left;">
		 
		

		@php
			$gs = $gallery->first();
		@endphp
		@dump($gs->toArray()) 

		<img src="{{assetGallery($gs->access,$gs->user_id,'small',$gs->image) }}" />


	</div>
</div>