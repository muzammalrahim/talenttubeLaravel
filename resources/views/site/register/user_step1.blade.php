<div id="step-1" class="hide1">
    <div class="slogan">Almost there! Just a little more to go.</div>
    <div class="bl_form_registration bl_form_registration_step_1">

            <div class="part br" >
                <p>Sign up faster.</p>
                {{-- <ul class="bl_social_buttons bl_social_buttons_register">
                    <li class="login_facebook"><a href="">&nbsp;</a></li>
                    <li class="login_google_plus"><a href="social_login.php?module=google_plus">&nbsp;</a></li>
                    <li class="login_linkedin"><a href="social_login.php?module=linkedin">&nbsp;</a></li>
                    <li class="login_twitter"><a href="social_login.php?module=twitter">&nbsp;</a></li>
                    <li class="login_vk"><a href="social_login.php?module=vk">&nbsp;</a></li>
                </ul> --}}
                <div class="line_or">
                    <div class="line_top"></div>
                    <div class="or">or</div>
                    <div class="line_bottom"></div>
                </div>
            </div>


            <div id="bl_frm_register" class="part">
                <div class="bl">
                    <label>First Name</label>
                    <form name="frm_date" action="" autocomplete="off">
                       <div class="col-sm-12 " style="display: flex;">
                            <input type="text" name="firstname" class="inp" placeholder="First Name"/>

                            <input type="text" name="surname"  class="inp" placeholder="Sur Name" style="margin-left: 15px;" / >
                        <!--<div id="day_check" class="icon_check to_hide"></div>-->
                        </div>

                    </form>
                    <div id="birth_error" class="error to_hide">&nbsp;</div>
                    <div class="cl"></div>
                </div>



                <div class="bl">
                    <label>I am from
                    </label>
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
                    <select name="country" data-search-unique-id="true" data-location="geo_states" id="country" class="location country geo" data-search="true" data-search-placeholder="Enter manually..." data-search-not-found="No matches...">
                        <option  id="option_country_230"  value="230" selected="selected">United States</option>
                        <option  id="option_country_229"  value="229" >United Kingdom</option>
                        <option  id="option_country_40"  value="40" >Canada</option>
                        <option  id="option_country_1"  value="1" >Afghanistan</option>
                        <option  id="option_country_2"  value="2" >Aland Islands</option>
                        <option  id="option_country_3"  value="3" >Albania</option>


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
                        <option  value="96201" >Adams Center</option>
                        <option  value="55422" >Addison</option>
                        <option  value="55423" >Adirondack</option>
                        <option  value="55424" >Afton</option>
                        <option  value="55425" >Airmont</option>
                        <option  value="55426" >Akron</option>
                        <option  value="55427" >Alabama</option>
                        <option  value="55428" >Albany</option>
                        <option  value="55429" >Albertson</option>
                        <option  value="55430" >Albion</option>
                        <option  value="135166" >Alcove</option>
                        <option  value="55431" >Alden</option>
                        <option  value="55432" >Alder Creek</option>
                        <option  value="96202" >Alexander</option>
                        <option  value="55433" >Alexandria Bay</option>
                        <option  value="55434" >Alfred</option>
                        <option  value="55435" >Alfred Station</option>
                        <option  value="55436" >Allegany</option>
                        <option  value="135167" >Allentown</option>
                        <option  value="55437" >Alma</option>

                        <option  value="55949" >Hoosick</option>
                        <option  value="55950" >Hoosick Falls</option>
                        <option  value="55951" >Hopewell Junction</option>


                    </select>
                    </div>
                    <!--<div class="bl_city">
                        <input id="city" name="city_title" class="inp city not_frm" type="text" value="" />
                        <div id="city_check" class="icon_check to_hide"></div>
                    </div>-->

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
                    <label></label>
                    <div class="bl_inp_pos">
                        <input id="phone" name="phone" class="inp email placeholder" type="text" placeholder="Enter Phone Number" value=""/>
                        <div id="phone_check" class="icon_check to_hide"></div>
                        <div id="phone_error" class="error to_hide">&nbsp;</div>
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
        <div class="cl"></div>
    </div>
    </div>
