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
     @endif  --}}  


 {{-- @dd($user->toArray()) --}}

@if(!empty($user->industry_experience))
    @foreach($user->industry_experience as  $industry )
    	<div class="IndustrySelect">
              <input type="hidden" name="industry_experience[]" class="industry_experience" value="{{$industry}}">
              <p>
                <i class="fas fa-angle-right qualifiCationBullet"></i>
              	{{getIndustryName($industry)}}
              	<i class="fa fa-trash removeIndustry hide_it"></i></p>
        </div>
    @endforeach
@endif