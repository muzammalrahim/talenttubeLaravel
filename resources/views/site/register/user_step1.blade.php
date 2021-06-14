



<div id="step-1" class="hide1">
<div class="slogan">Almost there! Just a little more to go.</div>
    <div class="bl_form_registration bl_form_registration_step_1">



            <form name="frm_date" method="post" action="{{route('register')}}" autocomplete="off">
            {{ csrf_field() }}
            <div id="bl_frm_register" class="part float_none margin_auto">
                <div class="bl">
                    <label>First Name</label>
                       <div class="col-sm-12 " style="display: flex;">
                            <input type="text" name="firstname" class="inp w49" placeholder="First Name"/>
                            <input type="text" name="surname"  class="inp w49" placeholder="Surname" style="margin-left: 15px;" / >
                        </div>
                    <div id="birth_error" class="error to_hide">&nbsp;</div>
                    <div class="cl"></div>
                </div>

                {{-- bl_location --}}
                <div class="bl bl_location">
                <label>I am from</label>
                    <div class="location_filed">
                        <div class="location_input dtable w100">
                            <input type="text" name="location_search" class="inp w80 fl_left" id="location_search" value="" placeholder="Type a location" aria-invalid="false">
                            <button type="button" id="location_search_load" class="btn btn-success location_search_btn w20 fl_left">Search</button>
                        </div>
                        <div class="location_latlong dtable w100 hide_it">
                            <input type="hidden" class="location_lat w50 fl_left" name="location_lat" id="location_lat" value="" placeholder="Lat" readonly="true" aria-invalid="false">
                            <input type="hidden" class="location_long w50 fl_left" name="location_long" id="location_long" value="" placeholder="Long" readonly="true" aria-invalid="false">

                            <input type="hidden" name="location_name" id="location_name"  value="">
                            <input type="hidden" name="location_city" id="location_city"  value="">
                            <input type="hidden" name="location_state" id="location_state"  value="">
                            <input type="hidden" name="location_country" id="location_country"  value="">
                        </div>

                        <div class="location_map_box dtable w100" style="display: none">
                            <div class="location_map" id="location_map"></div>
                        </div>
                    </div>

                    <span id="location_city_error" class="error to_hide">Location City Field is Required</span>
                    <span id="location_state_error" class="error to_hide">Location State Field is Required</span>
                    <span id="location_country_error" class="error to_hide">Location Country Field is Required</span>

                    <div class="cl"></div>
                </div>
                {{-- bl_location --}}

                <div class="bl">
                    <label>E-mail</label>
                    <div class="bl_inp_pos">
                        <input id="email" name="email" class="inp email placeholder w100" type="text" placeholder="e.g. example@site.com" value=""/>
                        <div id="email_check" class="icon_check to_hide"></div>
                        <div id="email_error" class="error to_hide">&nbsp;</div>
                    </div>
                </div>

                <div class="bl">
                    <label>Mobile Number</label>
                    <div class="bl_inp_pos">
                        <input
                            id="phone"
                            name="phone"
                            class="inp email placeholder w100"
                            type="text"
                            placeholder="Enter Phone Number"
                            value=""
                            maxlength="10"
                            minlength="10"
                            />
                        <div id="phone_check" class="icon_check to_hide"></div>
                        <div id="phone_error" class="error to_hide">&nbsp;</div>
                    </div>
                </div>

                <div class="bl">
                    <label>Username</label>
                    <div class="bl_inp_pos to_show">
                        <input id="name" class="inp username placeholder w100" name="username" maxlength="20" type="text" placeholder="This will be public" value="">
                        <div id="username_check" class="icon_check to_hide"></div>
                        <div id="username_error" class="error to_hide">&nbsp;</div>
                    </div>
                </div>

                <div class="bl">
                    <label>Password</label>
                    <div class="bl_inp_pos to_show">
                        <input id="password" class="inp psw placeholder w100" name="password" type="password" placeholder="Password" value="">
                        <div id="password_check" class="icon_check to_hide"></div>
                        <div id="password_error" class="error to_hide">&nbsp;</div>
                    </div>
                </div>

                <div class="bl pb20">
                    <label>Confirm password</label>
                    <div class="bl_inp_pos to_show">
                        <input id="password_confirmation" class="inp psw pswc w100" name="password_confirmation" type="password" placeholder="Confirm Password" value="" required>
                        <div id="password_confirmation_check" class="icon_check to_hide"></div>
                        <div id="password_confirmation_error" class="error to_hide">&nbsp;</div>
                    </div>
                </div>

                <span class="sign center">
                    <input id="agree" name="privacy_policy" value="1" type="checkbox"/>
                    <label for="agree">I agree to the</label>
                    {{-- <a href="" onclick="infoOpen('terms'); return false;">Terms</a>  --}}

                    <a href="{{ route('privacy') }}" target="_blank">Terms Privacy Policy</a> 

                    {{-- <label for="agree">and</label>
                    <a href="" onclick="infoOpen('priv'); return false;">Privacy Policy</a>
                    <span class="cl"></span> --}}
                </span>

                <button id="frm_register_submit" class="btn pink disabled" disabled>Next</button>
                <span id="agree_error" class="error to_hide">You need to agree to the terms</span>

            </div>
            </form>

        <div class="cl"></div>
</div>
</div>





</div>

<div id="success-step-1" class="hide">
