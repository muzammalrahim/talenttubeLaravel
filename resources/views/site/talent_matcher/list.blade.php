    
    @php
        $check = false;
    @endphp
    
    @if ($query && $query->count() > 0)

    @foreach ($query as $js)


    <div class="dflex"> 
    @php
        $dist = calculate_distance($js, $user);
        $ind_exp = cal_ind_exp($js,$user);
        $compatibility = compatibility($js, $user); 
        $user_compat = $compatibility*20;

        // ========================= excluded 6th question ========================= 
        
        $emp_questions = json_decode($js->questions , true);
        $user_questions = json_decode($user->questions , true);

        $emp_resident = '';
        $user_resident = '';
        
        if ($emp_questions != null && $user_questions != null) {
            $emp_match = array_slice($emp_questions, 5, 6, true);
            foreach ($emp_match as $key => $value) {
                $emp_resident .= $value;
            }
            $user_match = array_slice($user_questions, 5, 6, true);
            foreach ($user_match as $key => $value) {
                $user_resident .= $value;
            }
        }

    @endphp

        {{-- @dump($emp_resident) --}}

    {{-- @if ($emp_resident == 'no' && $user_resident == 'no') --}}
        {{-- <div class="text-danger bold w50"> No Match Potential </div> --}}
    {{-- @else --}}

        @if ($dist < 50 && !empty($ind_exp))

            @php
                $check = true;
            @endphp
            
        @endif


    {{-- @endif --}}
        
</div>
    


    {{-- @include('site.talent_matcher.algo')  --}}

    {{-- <input type="checkbox" name="cbx[]" value="{{ $js->id }}"> --}}

    {{-- @dump($check) --}}
    @if ($check)
        {{-- expr --}}
    <div class="jobSeeker_row dblock js_{{$js->id}} mb20 p20">
        <div class="jobSeeker_box relative dinline_block w100">
            @include('site.layout.parts.jobSeekerProfilePhotoBox')   {{-- site/layout/parts/jobSeekerProfilePhotoBox --}}
            @include('site.layout.parts.jobSeekerInfoBox')   {{-- site/layout/parts/jobSeekerInfoBox --}}
            <div class="jobApplicAction">
             @if (in_array($js->id,$likeUsers))
                <a class="active graybtn jbtn" data-jsid="{{$js->id}}">Liked</a>
             @else
                <a class="jsLikeUserBtn graybtn jbtn" data-jsid="{{$js->id}}">Like</a>
             @endif
                <a class="graybtn jbtn" href="{{route('jobSeekerInfo',['id'=>$js->id])}}" target="_blank">View Profile</a>
            </div>
        </div>
    </div>


{{--
    <div class="jobSeeker_row dblock js_{{$js->id}} mb20 p20">

        <div class="jobSeeker_box relative dinline_block w100">

        <div class="js_info w_70p w_box dblock fl_left">

            @include('site.layout.parts.jobSeekerProfilePhotoBox')

            <div class="js_education js_field">
                <span class="js_label">Education: </span>{{ ucfirst($js->qualificationType) }}
            </div>
            <div class="js_about js_field">
                <span class="js_label">About me:</span>
                <p class="js_about_me"> {{$js->about_me}}</p>
            </div>
            <div class="js_interested js_field">
                <span class="js_label">Interested in:</span>
                <p>{{$js->interested_in}}</p>
            </div>

            <div class="js_languages js_field">
                <span class="js_label">Languages:</span>
                <div class="js_tags dinline_block">
                    @if ($js->language)
                    @foreach ($js->language as $lang)
                        <span class="js_tag">{{getLanguage($lang)}}</span>
                    @endforeach
                    @endif
                </div>
            </div>

            <div class="js_languages js_field">
                <span class="js_label">Hobbies:</span>
                <div class="js_tags dinline_block">
                    @if ($js->hobbies)
                    @foreach ($js->hobbies as $hobby)
                        <span class="js_tag">{{getHobby($hobby)}}</span>
                    @endforeach
                    @endif
                </div>
            </div>

        </div>

        <div class="js_actionBtn">
            <a class="graybtn jbtn" href="{{route('jobSeekerInfo', ['id' => $js->id])}}">Detail</a>
            <a class="jsBlockUserBtn graybtn jbtn" data-jsid="{{$js->id}}">Block</a>
            @if (in_array($js->id,$likeUsers))
            <a class="active graybtn jbtn" data-jsid="{{$js->id}}">Liked</a>
            @else
            <a class="jsLikeUserBtn graybtn jbtn" data-jsid="{{$js->id}}">Like</a>
            @endif
        </div>

        </div>

    </div>
 --}}
    @endif

       @php
        $check = false;
    @endphp
    

    @endforeach


    {{-- <div class="jobseeker_pagination cpagination mb20">{!! $query->onEachSide(0)->links() !!}</div> --}}

    @endif


{{-- <div class="d-none">
  <form method="POST" class="bulkPDFExportForm" action="{{route('empBulk.GeneratePDF')}}">
    @csrf
    <div class="cbx_list">
    </div>
  </form>
</div> --}}








