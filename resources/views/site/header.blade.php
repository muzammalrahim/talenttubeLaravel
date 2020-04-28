<!-- header_top  -->
<div class="head_top absolute">
   <div class="bl">
      <div class="fl_right">
         <span class="link">Have an account?</span>

         @if (Auth::check())
            <a  class="btn_sign" href="{{route('profile')}}">Sign in</a>
        @else
            <a id="pp_sign_in_open" class="btn_sign" href="">Sign in</a>
        @endif



      </div>
      <div class="cl"></div>
   </div>
   <div class="cl"></div>
</div>
<!-- /header_top  -->


<div class="header ">
   <div id="bg_cover" class="cover show" style="background-image: url({{asset('/images/homepage_bg.jpg')}});"></div>
</div>
