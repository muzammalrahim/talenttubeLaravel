<div style="visibility:hidden">
<div id="pp_profile_main_editor" class="pp_edit_info pp_cont p0">
	<div class="frame">
		<a class="icon_close" href="#close" onclick="UProfile.hideMainEditor()" > <span class="close_hover"></span></a>
		<div class="head">Edit basic details</div>
		<div class="cont">
			<div class="bl_frm bl_frm_editor" style="height: auto; opacity: 1; transition: height 0.3s linear 0s, opacity 0.3s linear 0s;">
				<form id="frm_profile_edit_main" name="frm_profile_edit_main" method="post">
                    {{ csrf_field() }}
					<input type="hidden" name="cmd" value="profile_edit_main_save" class="ajax">
					<input type="hidden" name="ajax" class="ajax" value="0">
					<table class="tb_frm frm_edit_main">
						<tbody>
						<tr>
                            <th><div class="name">Name or nickname</div></th>
                            <td>
                               {{-- @dump($user)  --}}
                            <div class="field">
                                <input id="profile_edit_main_nickname" class="inp nickname" name="nickname" type="text" value="{{$user->name}}" 
                                title="The username needs to be between 3 and 20 symbols in length.">
                                <div id="nickname_error" class="error to_hide">&nbsp;</div>
                            </div>
                            </td>
						</tr>
						<tr>
                        <th><div class="name">I am a</div></th>
                        <td>
                            <div class="fieldX">
                                <div id="profile_edit_main_orientation-styler">
                                    <select id="profile_edit_main_orientation" name="orientation" class="select_main">
                                        <option value="1" selected="selected">Job Seeker</option>
                                        <option value="2">Employer</option>
                                    </select>
                                </div>
                            </div>
                        </td>
						</tr>
							<tr>
								<th>
									<div class="name">Birthday</div>
								</th>
								<td>
									<div id="profile_edit_main_birthday" class="field birthday">
										<div id="profile_edit_main_day-styler" >
											<select id="profile_edit_main_day" name="day" class="select_main day">
                                                @for ($i=1; $i < 31; $i++)
                                                    <option value="{{$i}}" {{($user->bday == $i)?'selected="selected"':''}}>{{$i}}</option>
                                                @endfor
											</select>
                                            <div id="day_error" class="error to_hide">&nbsp;</div>
										</div>
										<div id="profile_edit_main_month-styler">
                                            <select id="profile_edit_main_month" name="month" class="select_main month" 
                                                onchange="updateDay('month','frm_profile_edit_main','year','month','day', UProfile.refreshSelectBirthdayEditMain)"
                                                data-search="false">
												<option value="1"  {{($user->bmonth == 1)?'selected="selected"':''}} >January</option>
												<option value="2" {{($user->bmonth == 2)?'selected="selected"':''}}>February</option>
												<option value="3" {($user->bmonth == 3)?'selected="selected"':''}} >March</option>
												<option value="4" {($user->bmonth == 4)?'selected="selected"':''}} >April</option>
												<option value="5" {($user->bmonth == 5)?'selected="selected"':''}} >May</option>
												<option value="6" {($user->bmonth == 6)?'selected="selected"':''}} >June</option>
												<option value="7" {($user->bmonth == 7)?'selected="selected"':''}} >July</option>
												<option value="8" {($user->bmonth == 8)?'selected="selected"':''}} >August</option>
												<option value="9" {($user->bmonth == 9)?'selected="selected"':''}} >September</option>
												<option value="10" {{($user->bmonth == 10)?'selected="selected"':''}} >October</option>
												<option value="11" {{($user->bmonth == 11)?'selected="selected"':''}} >November</option>
												<option value="12" {{($user->bmonth == 12)?'selected="selected"':''}}>December</option>
                                            </select>
                                            <div id="month_error" class="error to_hide">&nbsp;</div>
										</div>
										<div id="profile_edit_main_year-styler">
                                            <select id="profile_edit_main_year" name="year" class="select_main year" 
                                            onchange="updateDay('year','frm_profile_edit_main','year','month','day', UProfile.refreshSelectBirthdayEditMain)">
                                            @for ($y=now()->year; $y > 1945; $y--)
                                                <option value="{{$y}}" {{($user->byear == $y)?'selected="selected"':''}}>{{$y}}</option>
                                            @endfor
                                            </select>
                                            <div id="year_error" class="error to_hide">&nbsp;</div>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<th>
									<div class="name">Location</div>
								</th>
								<td>
									{{-- <div class="field">
                                        <div id="country-styler" data-location="geo_states">
                                            <select name="country" id="country" data-location="geo_states" class="geo select_main" onchange="UProfile.GetLocation('geo_states');" >
                                                <option value="0">Select Country</option>
                                                @foreach ($geo_country as $country)
                                                    <option value="{{$country->country_id}}" {{($user->country == $country->country_id)?'selected="selected"':''}}>{{$country->country_title}}</option>
                                                @endforeach
                                            </select>
                                            <div id="country_error" class="error to_hide">&nbsp;</div>
										</div>
									</div> --}}
								</td>
							</tr>
							<tr>
								<th>
									<div class="name">&nbsp;</div>
								</th>
								<td>
									<div class="field">
                                        <div id="state-styler" data-location="geo_cities">
                                            <select name="state" id="state" data-location="geo_cities" class="geo select_main" onchange="UProfile.GetLocation('geo_cities');">
												<option value="0">Choose State</option>
											</select>
                                            <div id="state_error" class="error to_hide">&nbsp;</div>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<th>
									<div class="name">&nbsp;</div>
								</th>
								<td>
									<div id="profile_edit_main_location" class="field">
										<div id="city-styler">
											<select name="city" id="city" class="select_main">
                                                <option value="0">Choose City</option>
                                            </select>
                                            <div id="city_error" class="error to_hide">&nbsp;</div>
										</div>
									</div>
									<div class="error_frm"></div>
								</td>
							</tr>
						</tbody>
					</table>
				</form>
				
			</div>
			<div class="css_loader loader_edit_popup hidden">
				<div class="spinner center">
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
		</div>
		<div class="foot">
			<div class="fl_right bl_btn to_show" style="transition-delay: 0s;">
                
                <div id="general_error" class="error to_hide">&nbsp;</div>

				<button class="btn small white_frame frm_editor_cancel" onclick="UProfile.hideMainEditor()">Cancel</button>
				<button class="btn small turquoise frm_editor_save" onclick="UProfile.saveProfile()" >Save</button>
			</div>
			<div class="cl"></div>
		</div>
	</div>
</div>
</div>