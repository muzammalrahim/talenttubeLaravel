{{--  @php
    // dd($user->qualification); 
      $qualificationsData =  ($user->qualification)?(getQualificationsData($user->qualification)):(array());
  @endphp
    @if(!empty($qualificationsData))
       @foreach($qualificationsData as $qualification)
          <div class="QualificationSelect">
              <input type="hidden" name="qualification[]" class="userQualification" value="{{$qualification['id']}}">
              <p>{{$qualification['title']}} <i class="fa fa-trash removeQualification hide_it"></i></p>
          </div>
       @endforeach
     @endif --}}   


@php
  $qualificationsData =  ($user->qualification)?(getQualificationsData($user->qualification)):(array());
@endphp
@if(!empty($qualificationsData))
   @foreach($qualificationsData as $qualification)
      <div class="QualificationSelect">
          <input type="hidden" name="qualification[]" class="userQualification" value="{{$qualification['id']}}">
          <p class="mb-1"><i class="fas fa-angle-double-right mr-2"></i> {{$qualification['title']}} <i class="fa fa-trash removeQualification hide_it2 float-right"></i></p>
      </div>
   @endforeach
 @endif 
