<div class="container noteContainer">
	@if ($notes->count() > 0)

		@foreach ($notes as $note)
		<div class="notes note_{{$note->id}} mb10">
			<div class="pb20"> <b> Note  </b> <span class="test">{{$loop->index+1}}: <b> Time: </b> {{$note->created_at->format('h-i-s')}} <b> Date: </b> {{$note->created_at->format('d-m-Y')}} </span> 
                <i class="fas fa-trash fl_right noteDeleteClick pointer noteRemoval" data-target="#deleteNote" data-toggle="modal" data-noteid = "{{$note->id}}"></i>
            </div>

			<div class="notestext">
				<textaread>{{$note->text}} </textaread>
			</div>
			<div class="attachment">
				{{-- @dump($note) --}}
			@if ($note->file != "0" )
				<a class="attach_btn" href="{{asset('media/public'.$note->file_path)}}"><i class="fas fa-download"></i> {{ $note->file }}</a>
			@endif
			</div>
				
		</div>
		@endforeach
	@endif

</div>






