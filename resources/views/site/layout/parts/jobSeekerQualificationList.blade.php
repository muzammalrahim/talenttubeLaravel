 





    {{-- @dump($user->qualificationType);  --}}


 @php
    // dd($user->qualification); 
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

