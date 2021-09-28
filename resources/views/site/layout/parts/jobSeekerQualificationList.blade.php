
@php
  $qualificationsData =  ($user->qualification)?(getQualificationsData($user->qualification)):(array());
@endphp


@if(!empty($qualificationsData))
  <div class="jobSeekerQualificationList">
    @foreach($qualificationsData as $qualification)
      <div class="QualificationSelect">
        <input type="hidden" name="qualification[]" class="userQualification" value="{{$qualification['id']}}">
          <li>
            <i class="qualification-circle"></i>
            <span> {{ ucfirst($qualification['title']) }} <i class="fa fa-trash removeQualification d-none float-right"></i> </span>
          </li>
      </div>
    @endforeach
  </div>
@endif


{{--  @php
    $qualificationsData =  ($user->qualification)?(getQualificationsData($user->qualification)):(array());
  @endphp
    @if(!empty($qualificationsData))
       @foreach($qualificationsData as $qualification)
          <div class="QualificationSelect">
              <input type="hidden" name="qualification[]" class="userQualification" value="{{$qualification['id']}}">
              <p><i class="fas fa-angle-double-right qualifiCationBullet"></i>{{$qualification['title']}} <i class="fa fa-trash removeQualification hide_it"></i></p>
          </div>
       @endforeach
     @endif --}}
