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
					<table class="tb_frmX frm_edit_main">
						<tbody>
						<tr>
							<th><div class="name">Company Name</div></th>
							<td>
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
                        {{(isTypeEmployer($user))?'Employer':'Job Seeker'}}
                    </div>
                </div>
            </td>
						</tr>
							{{-- Location --}}
							<tr>
								<th><div class="name">Location</div></th>
								<td>
									<div class="locationContainer">
										<div class="bl bl_location">
                     
                        <div class="location_filed">
                            <div class="location_input dtable w100">
                                <input type="text" name="location_search" class="inp w80 fl_left" id="location_search" 
                                value="{{userLocation($user)}}" placeholder="Type a location" aria-invalid="false">
                               {{--  <button type="button" id="location_search_load" class="btn btn-success location_search_btn w20 fl_left">Search</button> --}}
                            </div>
                            <div class="location_latlong dtable w100">
                                <input type="text" class="location_lat w50 fl_left" name="location_lat" id="location_lat" value="{{$user->location_lat}}" placeholder="Lat" readonly="true" aria-invalid="false">
                                <input type="text" class="location_long w50 fl_left" name="location_long" id="location_long" value="{{$user->location_long}}" placeholder="Long" readonly="true" aria-invalid="false">

                                <input type="hidden" name="location_name" id="location_name"  value="">
                                <input type="hidden" name="location_city" id="location_city"  value="">
                                <input type="hidden" name="location_state" id="location_state"  value="">
                                <input type="hidden" name="location_country" id="location_country"  value="">
                            </div>

                            <div class="location_map_box dtable w100">
                                <div class="location_map" id="location_map"></div>
                            </div>
                        </div>

                        <span id="location_city_error" class="error to_hide hide_it">Location City Field is Required</span>
                        <span id="location_state_error" class="error to_hide hide_it">Location State Field is Required</span>
                        <span id="location_country_error" class="error to_hide hide_it">Location Country Field is Required</span>

                        <div class="cl"></div>
                    </div>
									</div>
								</td>
							</tr>
							{{-- Location end --}}




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