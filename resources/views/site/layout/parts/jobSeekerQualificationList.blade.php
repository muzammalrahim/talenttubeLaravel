
    {{-- @dump($user->qualificationType);  --}}
 @php
    $qualificationsData =  ($user->qualification)?(getQualificationsData($user->qualification)):(array());
  @endphp
    @if(!empty($qualificationsData))
       @foreach($qualificationsData as $qualification)
          <div class="QualificationSelect">
              <input type="hidden" name="qualification[]" class="userQualification" value="{{$qualification['id']}}">
              <p><i class="fas fa-angle-double-right qualifiCationBullet"></i>{{$qualification['title']}} <i class="fa fa-trash removeQualification hide_it"></i></p>
          </div>
       @endforeach
     @endif


{{--   @foreach ($userQualification as $qualification)
    <div class="QualificationSelect">
        <p><i class="fas fa-angle-double-right qualifiCationBullet"></i>{{$qualification->qualificationNames->title}} <i class="fa fa-trash removeQualification hide_it"></i></p>
    </div>
  @endforeach --}}


