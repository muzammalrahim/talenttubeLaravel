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
 @php
    // dd($user->qualification);
    $industry_experienceData =  ($user->industry_experience);
    // ?(getIndustriesData($user->industry_experience)):(array());
   // dd( $industry_experienceData);
  @endphp

 {{-- @dd($user->toArray()) --}}

@if(!empty($industry_experienceData))
    @foreach($industry_experienceData as  $industry )
    <div class="IndustrySelect">
              <input type="hidden" name="industry_experience[]" class="industry_experience" value="{{$industry}}"/> 
              <li class="d-flex">
                <div class="circle-div">
                  <i class="qualification-circle"></i>
                </div>
                <div class="qual-div">
                  <p class="text_interested_in m-0"> {{getIndustryName($industry)}} </p> <i class="fa fa-trash removeIndustry d-none float-right"></i>
                </div>
              </li>
            </div>
    @endforeach
@endif
