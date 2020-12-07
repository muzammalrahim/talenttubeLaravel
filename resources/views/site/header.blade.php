<!-- header_top  -->


<div class="head_top absolute">
   <div class="bl">
      <div class="fl_right">
         @if (Auth::check())
            @if (isEmployer())
              <a  class="btn_sign" href="{{route('employerProfile')}}">Dashboard</a>
            @elseif(isAdmin())
              <a  class="btn_sign" href="{{route('adminDashboard')}}">Dashboard</a>
            @else
              <a  class="btn_sign" href="{{route('profile')}}">Dashboard</a>
            @endif

        @else
            <span class="link">Have an account?</span>
            <a id="pp_sign_in_open" class="btn_sign">Sign in</a>
        @endif

      </div>
      <div class="cl"></div>
   </div>

   
   <div class="cl"></div>
</div>

<a   class = "interviewConciergeRoute" >
    <div class="interviewConcierge">Interview Concierge</div>
</a>


<!-- /header_top  -->


<div class="header ">
   <div id="bg_cover" class="cover show" style="background-image: url({{asset('/images/homepage_bg.jpg')}});"></div>
</div>


