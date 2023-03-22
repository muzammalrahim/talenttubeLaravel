
@php
  $qualificationsData =  ($user->qualification)?(getQualificationsData($user->qualification)):(array());
@endphp


@if(!empty($qualificationsData))
  <div class="jobSeekerQualificationList">
    @foreach($qualificationsData as $qualification)
      <div class="QualificationSelect">
        <input type="hidden" name="qualification[]" class="userQualification" value="{{$qualification['id']}}">
          <li class="d-flex">
            <div class="circle-div">
              <i class="qualification-sign"> ></i>
            </div>
            <div class="qual-div">
              <p class="text_interested_in m-0"> {{ ucfirst($qualification['title']) }} <i class="fa fa-trash removeQualification d-none float-right"></i> </p>
            </div>
              
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
