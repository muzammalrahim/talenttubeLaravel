

<div class="js_info w_70p w_box dblock fl_left">

    {{-- ============================================= Pie Chart =============================================  --}}
            
        @include('site.user.match_algo.match_algo') {{-- site/user/match_algo/match_algo --}}
            
    {{-- ============================================= Pie Chart =============================================  --}}
            
    <div class="js_about js_field">
        <span class="js_label">Recent Job:</span>
        <span class="js_about_me"> {{$js->recentJob}}</span>
    </div>

    <div class="js_education js_field">
        <span class="js_label">Qualification:</span>
        @php
         $qualification_names =  getQualificationNames($js->qualification)
        @endphp
        @if(!empty($qualification_names))
        <div class="font13"><i class="fas fa-angle-right qualifiCationBullet"></i>
            Type:<span class="qualifTypeSpan">{{$js->qualificationType}}</span>
        </div>
        @foreach ($qualification_names as $qnKey => $qnValue)
               <p class="qualification"> <i class="fas fa-angle-double-right qualifiCationBullet"></i>{{$qnValue}}</p>
        @endforeach
        @endif
    </div>

    <div class="js_about js_field">
        <span class="js_label">About me:</span>
        <p class="js_about_me"> {{$js->about_me}}</p>
    </div>
    <div class="js_interested js_field">
        <span class="js_label">Interested in:</span>
        <p>{{$js->interested_in}}</p>
    </div>


    <div class="js_interested js_field">
        <span class="js_label">Salary Range:</span> {{getSalariesRangeLavel($js->salaryRange)}}
    </div>


    <div class="js_interested js_field">
    <span class="js_label">Industry Experience:</span>
        @if(isset($js->industry_experience))
        @foreach ($js->industry_experience as $ind)
            <div class="indsutrySelect">
                <p style="margin-bottom: 0px;"><i class="fas fa-angle-right qualifiCationBullet"></i>{{getIndustryName($ind)}} </p>
            </div>
        @endforeach
        @endif
    </div>
</div>
