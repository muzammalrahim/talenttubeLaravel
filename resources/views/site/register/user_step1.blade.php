



<div id="step-1" class="hide1">
<div class="slogan">Almost there! Just a little more to go.</div>
    <div class="bl_form_registration bl_form_registration_step_1">

            <div class="part br" >
                <p>Sign up faster.</p>
                {{--
                <ul class="bl_social_buttons bl_social_buttons_register">
                    <li class="login_facebook"><a href="">&nbsp;</a></li>
                    <li class="login_google_plus"><a href="social_login.php?module=google_plus">&nbsp;</a></li>
                    <li class="login_linkedin"><a href="social_login.php?module=linkedin">&nbsp;</a></li>
                    <li class="login_twitter"><a href="social_login.php?module=twitter">&nbsp;</a></li>
                    <li class="login_vk"><a href="social_login.php?module=vk">&nbsp;</a></li>
                </ul>
                --}}
                <div class="line_or">
                    <div class="line_top"></div>
                    <div class="or">or</div>
                    <div class="line_bottom"></div>
                </div>
            </div>

            <form name="frm_date" method="post" action="{{route('register')}}" autocomplete="off">
            {{ csrf_field() }}
            <div id="bl_frm_register" class="part">
                <div class="bl">
                    <label>First Name</label>
                       <div class="col-sm-12 " style="display: flex;">
                            <input type="text" name="firstname" class="inp" placeholder="First Name"/>
                            <input type="text" name="surname"  class="inp" placeholder="Sur Name" style="margin-left: 15px;" / >
                        </div>
                    <div id="birth_error" class="error to_hide">&nbsp;</div>
                    <div class="cl"></div>
                </div>

                <div class="bl">
                    <label>I am from</label>
                    <div id="css_loader_location" class="css_loader css_loader_location hidden">
                        <div class="spinner spinnerw center">
                            <div class="spinner-blade"></div>
                            <div class="spinner-blade"></div>
                            <div class="spinner-blade"></div>
                            <div class="spinner-blade"></div>
                            <div class="spinner-blade"></div>
                            <div class="spinner-blade"></div>
                            <div class="spinner-blade"></div>
                            <div class="spinner-blade"></div>
                            <div class="spinner-blade"></div>
                            <div class="spinner-blade"></div>
                            <div class="spinner-blade"></div>
                            <div class="spinner-blade"></div>
                        </div>
                    </div>
                    <div class="bl_location">
                    <select name="country" id="country" class="location country geo"
                        data-search-unique-id="true"
                        data-location="geo_states"
                        data-search="true"
                        data-search-placeholder="Enter manually..."
                        data-search-not-found="No matches..." >
                        @foreach ($geo_country as $country)
                            <option  id="option_country_{{$country->country_id}}"  value="{{$country->country_id}}">{{$country->country_title}}</option>
                        @endforeach
                    </select>

                    <select name="state" id="state" data-location="geo_cities" class="location state geo" data-search="true" data-search-placeholder="Enter manually..." data-search-not-found="No matches...">
                        <option  value="2527" >Alabama</option>
                        <option  value="2575" >West Virginia</option>
                        <option  value="2576" >Wisconsin</option>
                        <option  value="2577" >Wyoming</option>
                    </select>

                    <div class="separator"></div>
                    <select name="city" id="city" class="location city" data-search="true" data-search-placeholder="Enter manually..." data-search-not-found="No matches...">
                        <option  value="55420" >Accord</option>
                        <option  value="96200" >Acra</option>
                        <option  value="55421" >Adams</option>
                        <option  value="135165" >Adams Basin</option>
                    </select>
                    </div>


                    <div id="city_error" class="error to_hide">&nbsp;</div>
                <div class="cl"></div>
                </div>

                <div class="bl">
                    <label>E-mail</label>
                    <div class="bl_inp_pos">
                        <input id="email" name="email" class="inp email placeholder" type="text" placeholder="e.g. example@site.com" value=""/>
                        <div id="email_check" class="icon_check to_hide"></div>
                        <div id="email_error" class="error to_hide">&nbsp;</div>
                    </div>
                </div>

                <div class="bl">
                    <label>Mobile Number</label>
                    <div class="bl_inp_pos">
                        <input id="phone" name="phone" class="inp email placeholder" type="text" placeholder="Enter Phone Number" value=""/>
                        <div id="phone_check" class="icon_check to_hide"></div>
                        <div id="phone_error" class="error to_hide">&nbsp;</div>
                    </div>
                </div>

                <div class="bl">
                    <label>Username</label>
                    <div class="bl_inp_pos to_show">
                        <input id="name" class="inp username placeholder" name="username" maxlength="20" type="text" placeholder="This will be public" value="">
                        <div id="username_check" class="icon_check to_hide"></div>
                        <div id="username_error" class="error to_hide">&nbsp;</div>
                    </div>
                </div>

                <div class="bl">
                    <label>Password</label>
                    <div class="bl_inp_pos to_show">
                        <input id="password" class="inp psw placeholder" name="password" type="password" placeholder="Password" value="">
                        <div id="password_check" class="icon_check to_hide"></div>
                        <div id="password_error" class="error to_hide">&nbsp;</div>
                    </div>
                </div>

                <span class="sign">
                    <input id="agree" name="privacy_policy" value="1" type="checkbox"/>
                    <label for="agree">I agree to the</label>
                    <a href="" onclick="infoOpen('terms'); return false;">Terms</a>
                    <label for="agree">and</label>
                    <a href="" onclick="infoOpen('priv'); return false;">Privacy Policy</a>
                    <span class="cl"></span>
                </span>

                <button id="frm_register_submit" id="" class="btn pink disabled" disabled>Next</button>
                <span id="agree_error" class="error to_hide">You need to agree to the terms</span>

            </div>
            </form>

        <div class="cl"></div>
</div>
</div>



<div id="success-step-1" class="hide">
    
</div>