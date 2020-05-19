<div style="display:none;">


<div id="pp_sign_in" class="popup pp_sign">
    <div class="head">
        Sign in
        <a id="pp_sign_in_close" class="icon_close" href="">
            <span class="close_hover"></span>
        </a>
    </div>
    <div class="cont">
        <div class="bl">
            <form id="form_login" class="form_login" method="post" autocomplete="on" action="{{route('login')}}">
                {{ csrf_field() }}
                {{-- <input type="hidden" name="ajax" class="ajax" value="1" /> --}}
                <input id="form_login_user" type="text" name="email" class="inp placeholder" placeholder="Your email or username" />
                <input type="hidden" name="login_type" value="site_ajax" />
                <div class="error"></div>
                <input id="form_login_pass"  type="password" name="password" class="inp placeholder" placeholder="Password" />
                <div class="bl_remember">
                    <input id="form_login_remember" name="remember" value="1" type="checkbox" checked="checked"/>
                    <label for="form_login_remember">Remember me</label>
                </div>
                <button id="form_login_submit" type="submit" class="btn pink">Sign in</button>
                <div class="login_form_errors to_hide"></div>
            </form>
            <a id="pp_forgot_pass_open" class="link" href="">Forgot password?</a>
            <div class="line"></div>
            <div class="or"><span>or</span></div>

            <ul class="bl_social_buttons">
                <li class="login_facebook"><a href="https://www.facebook.com/v2.2/dialog/oauth?client_id=1&state=d011f99a4fc6308a3ff3ca630888c216&response_type=code&sdk=php-sdk-5.6.2&redirect_uri=http%3A%2F%2Flocalhost%2Ftalenttube%2Fjoin_facebook.php%3Fcmd%3Dfb_login&scope=email">&nbsp;</a></li>
                <li class="login_google_plus"><a href="social_login.php?module=google_plus">&nbsp;</a></li>
                <li class="login_linkedin"><a href="social_login.php?module=linkedin">&nbsp;</a></li>
                <li class="login_twitter"><a href="social_login.php?module=twitter">&nbsp;</a></li>
                <li class="login_vk"><a href="social_login.php?module=vk">&nbsp;</a></li>
            </ul>

        </div>
    </div>
</div>





</div>
