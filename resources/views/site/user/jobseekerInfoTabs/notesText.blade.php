<div class="container noteContainer">
	@if ($notes->count() > 0)

		@foreach ($notes as $note)
		<div class="notes note_{{$note->id}} mb10">
			<div class="pb20"> <b> Note  </b> <span class="test">{{$loop->index+1}}: <b> Time: </b> {{$note->created_at->format('h-i-s')}} <b> Date: </b> {{$note->created_at->format('d-m-Y')}} </span> 
                <i class="fas fa-trash fl_right noteDeleteClick pointer noteRemoval" data-noteid = "{{$note->id}}"></i>
            </div>

			<div class="notestext">
				<textaread>{{$note->text}} </textaread>
			</div>	
		</div>
		@endforeach
	@endif



</div>






