



<div id="step-1" class="hide1 emp-step-1">
    <div class="slogan">Almost there! Just a little more to go.</div>
        <div class="bl_form_registration bl_form_registration_step_1">

                <form name="frm_date" id="employer_reg_form" method="post" action="{{route('registerEmployer')}}" autocomplete="off">
                {{ csrf_field() }}
                <div id="bl_frm_register" class="part float_none margin_auto">
                    <div class="bl">
                        <label>First Name</label>
                        <div class="col-sm-12 " style="display: flex;">
                            <input type="text" name="firstname" class="inp w49" placeholder="First Name" required />
                            <input type="text" name="surname"  class="inp w49" placeholder="Surname" style="margin-left: 15px;" required / >
                        </div>
                        <div class="col-md-6"><div id="firstname_error" class="error to_hide">&nbsp;</div></div>
                        <div class="col-md-6"><div id="surname_error" class="error to_hide">&nbsp;</div></div>

                        <div class="cl"></div>
                    </div>


                    {{-- 
                    <div class="geo_location_cont">
                    <div class="bl ">
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
                       
                        <div class="col-md-6 w49 dinline_block box_border">
                        <select name="geo_country" id="country" class="geo select_main geo_country width-200 " onchange="CommonScript.GetLocation('geo_states',this);">
                            <option value="">Select Country</option>
                            @foreach ($geo_country as $country)
                                <option value="{{$country->country_id}}" {{(default_Country_id() == $country->country_id)?('selected="selected"'):('')}}>{{$country->country_title}}</option>
                            @endforeach
                        </select>
                        </div>

                        <div class="col-md-6 w49 dinline_block box_border">
                        <select name="geo_states" class="form_select geo_states " onchange="CommonScript.GetLocation('geo_cities',this);">
                            <option value="">Select State</option>
                            @foreach ($geo_state as $state)
                                <option value="{{$state->state_id}}">{{$state->state_title}}</option>
                            @endforeach
                        </select>
                        </div>

                        </div>

                        <div id="city_error" class="error to_hide">&nbsp;</div>
                    <div class="cl"></div>
                    </div>

                    <div class="bl">
                        <div class="bl_inp_pos w100">
                            <select name="geo_cities" class="form_select geo_cities w100" >
                                <option value="">Select City</option>
                            </select>
                            <div id="geo_cities_error" class="error to_hide">&nbsp;</div>
                        </div>
                    </div>
                    </div> 
                    --}}


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
                    
                    <div class="w49 dinline_block">
                    <select name="country" id="country" class="location country geo w100"
                        data-search-unique-id="true"
                        data-location="geo_states"
                        data-search="true"
                        data-search-placeholder="Enter manually..."
                        data-search-not-found="No matches..." >
                        @foreach ($geo_country as $country)
                            <option  id="option_country_{{$country->country_id}}"  value="{{$country->country_id}}" {{(default_Country_id() == $country->country_id)?('selected="selected"'):('')}}>{{$country->country_title}}</option>
                        @endforeach
                    </select>
                    </div>
                    
                    <div class="w49 dinline_block">
                    <select name="state" id="state" 
                        data-location="geo_cities" 
                        class="location state geo w100" 
                        data-search="true" 
                        data-search-placeholder="Enter manually..." 
                        data-search-not-found="No matches...">
                            <option  value="2527" >Alabama</option>
                            <option  value="2575" >West Virginia</option>
                            <option  value="2576" >Wisconsin</option>
                            <option  value="2577" >Wyoming</option>
                            @foreach ($geo_state as $state)
                                <option  id="option_state_{{$state->state_id}}"  value="{{$state->state_id}}">{{$state->state_title}}</option>
                            @endforeach
                    </select>
                    </div>

                    <div class="separator"></div>
                    <select name="city" id="city" 
                        class="location city w100" 
                        data-search="true" 
                        data-search-placeholder="Enter manually..." 
                        data-search-not-found="No matches..."
                        data-placeholder="Select City">
                        @foreach ($geo_cities as $city)
                                <option  id="option_city_{{$city->city_id}}"  value="{{$city->city_id}}">{{$city->city_title}}</option>
                        @endforeach
                    </select>
                    </div>


                    <div id="city_error" class="error to_hide">&nbsp;</div>
                <div class="cl"></div>
                </div>


                    <div class="bl">
                        <label>E-mail</label>
                        <div class="bl_inp_pos">
                            <input id="email" name="email" class="inp email w100" type="text" placeholder="e.g. example@site.com" value="" required/>
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
                        <label>Company name</label>
                        <div class="bl_inp_pos to_show">
                            <input id="name" class="inp username placeholder w100" name="companyname" maxlength="20" type="text" placeholder="This will be public" value="" required>
                            <div id="companyname_check" class="icon_check to_hide"></div>
                            <div id="companyname_error" class="error to_hide">&nbsp;</div>
                        </div>
                    </div>

                    <div class="bl">
                        <label>Password</label>
                        <div class="bl_inp_pos to_show">
                            <input id="password" class="inp psw placeholder w100" name="password" type="password" placeholder="Password" value="" required>
                            <div id="password_check" class="icon_check to_hide"></div>
                            <div id="password_error" class="error to_hide">&nbsp;</div>
                        </div>
                    </div>


                     <div class="bl pb20">
                        <label>Confirm password</label>
                        <div class="bl_inp_pos to_show">
                            <input id="password_confirmation" class="inp psw pswc placeholder w100" name="password_confirmation" type="password" placeholder="Confirm Password" value="" required>
                            <div id="password_confirmation_check" class="icon_check to_hide"></div>
                            <div id="password_confirmation_error" class="error to_hide">&nbsp;</div>
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

                    <button id="frm_emp_register_submit" id="" class="btn pink" >Next</button>
                    <span id="agree_error" class="error to_hide">You need to agree to the terms</span>

                </div>

                <input type="hidden" name="user_type" value="employer" />
                </form>

            <div class="cl"></div>
    </div>
    </div>



    <div id="success-step-1" class="hide">

    </div>
