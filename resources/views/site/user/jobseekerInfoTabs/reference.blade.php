@if ($crossreference->count()>0)
{{-- expr --}}
@foreach ($crossreference as $ref)
<div class="referees">
   <p><span class="bold">Reference Type:</span><span style="margin-left: 10px;">{{$ref->refType}}</span></p>
   <p><span class="bold">Referee Status:</span><span style="margin-left: 10px;">{{$ref->refStatus}}</span></p>
   <p><span class="bold">Organization Worked Together:</span><span style="margin-left: 10px;">{{$ref->refereeOrganization}}</span></p>
   <p><span class="bold">Title at Organization:</span><span style="margin-left: 10px;">{{$ref->refereeOrganizationTitle}}</span></p>
</div>
@endforeach
@else
<p class="mt20 ml20">
   <span class="bold"> {{$jobSeeker->name}}  </span> has not added any reference yet.
</p>
@endif
<div class="mt20">
   <a href="{{ route('referencesForAll', ['id' => $js->id, 'name'=>$js->name]) }}" target="_blank" class="seeCompletedReference orange_btn py-2"> View completed reference check feedback here</a> 
   <button class="blue_btn cop_text"><i class="fas fa-clipboard"></i> Click here to copy the link</button>
</div>