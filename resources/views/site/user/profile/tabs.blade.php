<!-- tabs_profile -->
<div class="tabs_profile tabContainer">
  <div id="tabs_profile">
      <ul class="tab customTab">
          <li id="tabs-1_switch" class="switch_tab selected">
              <a href="#tabs-1" title=""><span>Profile</span></a>
          </li>

          <li id="tabs-2_switch" class="switch_tab ">
              <a href="#tabs-2" title=""><span>Albums</span></a>
          </li>

          <li id="tabs-3_switch" class="switch_tab ">
              <a href="#tabs-3" title=""><span>Questions</span></a>
          </li>

          <li id="tabs-4_switch" class="switch_tab ">
              <a href="#tabs-4" title=""><span>Tags</span></a>
          </li>
          <li id="tabs-5_switch" class="switch_tab ">
              <a href="#tabs-5" title=""><span>jobs</span></a>
          </li>
          <li id="tabs-6_switch" class="switch_tab ">
              <a href="#tabs-6" title=""><span>Reference</span></a>
          </li>
          
        {{--   <li id="tabs-7_switch" class="switch_tab ">
              <a href="#tabs-7" title=""><span>Interview Invitation</span></a>
          </li> --}}

      </ul>
  </div>

  <div id="tabs_content" class="tabs_content">

    <!-- tab_about -->

    <a id="tabs-1" class="tab_link tab_a target"></a>
    <div class="tab_about tab_cont">
      <div class="col_left">

        {{-- ======================================== About Me ============================================ --}}
        <div class="bl">
            <div class="title">
                <div id="basic_anchor_about_me" class="title_icon_edit">About me
                    {{-- <span id="basic_pen_about_me" onclick="UProfile.showBasicFieldEditor('about_me');"></span> --}}
                    <i id="basic_pen_about_me" onclick="UProfile.showBasicFieldEditor('about_me');" class="fas fa-edit "></i>
                </div>
                <div class="cl"></div>
            </div>
            <textarea id="basic_editor_text_about_me" class="basic_textarea" maxlength="1000" disabled=""
                style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 100px; opacity: 1;">{{$user->about_me}}</textarea>
            <div id="basic_editor_about_me" class="frm_edit">
                <button id="basic_editor_save_about_me" class="btn small pink" onclick="UProfile.saveBasicFieldEditor('about_me'); return false;">Save</button>
                <button id="basic_editor_cancel_about_me" class="btn small white_frame" onclick="UProfile.closeBasicFieldEditor('about_me'); return false;">Cancel</button>
                <div class="cl"></div>
            </div>
            {{-- <script>Profile.handlerBasicFieldEditor('about_me');</script> --}}
        </div>

        {{-- ======================================== About Me End here ======================================= --}}

        <hr class="rounded">
        {{-- <div class="lineDivivder"><span>Interested In</span></div> --}}

        {{-- ======================================== Interested in ===========================================--}}

        <div class="bl">
            <div class="title">
                <div id="basic_anchor_interested_in" class="title_icon_edit">Interested in
                    {{-- <span id="basic_pen_interested_in" onclick="UProfile.showBasicFieldEditor('interested_in');"></span> --}}


                    <i id="basic_pen_interested_in" onclick="UProfile.showBasicFieldEditor('interested_in');" class="fas fa-edit "></i>

                </div>
                <div class="cl"></div>
            </div>
            <textarea id="basic_editor_text_interested_in" data-desc="" data-type="textarea" class="basic_textarea" maxlength="1000"
            style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 100px; opacity: 1;">{{$user->interested_in}}</textarea>
            <div id="basic_editor_interested_in" class="frm_edit">
                <button id="basic_editor_save_interested_in" class="btn small pink" onclick="UProfile.saveBasicFieldEditor('interested_in'); return false;">Save</button>
                <button id="basic_editor_cancel_interested_in" class="btn small white_frame" onclick="UProfile.closeBasicFieldEditor('interested_in'); return false;">Cancel</button>
                <div class="cl"></div>
            </div>
        </div>

        {{-- ======================================== Interested in ======================================= --}}


              <hr class="rounded">


        {{-- ======================================== Qualification ======================================= --}}


            {{-- @dump($user->qualificationType) --}}
        <div class="bl qualificationBox">

            <div class="title qualificationList">
              <div id="basic" class="title_icon_edit">Qualification <i class="editQualification fas fa-edit "></i>
                </div><p class="loader SaveQualification"style="float: left;"></p>
                <div class="cl"></div>
                <div class="qualifType"><i class="fas fa-angle-right qualifiCationBullet"></i>Type:
                    <span class="qualifTypeSpan">{{$user->qualificationType}}</span>
                </div>
                <div class="jobSeekerQualificationList">
                   @include('site.layout.parts.jobSeekerQualificationList')   {{--   site/layout/parts/jobSeekerQualificationList  --}}
                </div>
            </div>
                 <a class="addQualification btn btn-sm btn-primary text-white hide_it"style = "cursor:pointer;">Add New</a>
                 <a class="btn btn-sm btn-success hide_it saveQualification" onclick="UProfile.updateQualifications()">Save</a>
        </div>
        <div class="alert alert-success QualifAlert hide_it2" role="alert">
          <strong>Success!</strong> Qualification have been updated successfully!
        </div>

        {{-- ======================================== Qualification End here ======================================= --}}

          <hr class="rounded">
        {{-- ======================================== Industry Experience ======================================= --}}
        <div class="title IndusListBox">

            {{-- <div id="basic_anchor_industry_experience">Industry Experience <i class="editIndustry fas fa-edit "></i>
          <p class="loader SaveIndustryLoader"style="float: left;"></p></div>
          <div class="cl"></div> --}}
            <div id="basic" class="title_icon_edit">Industry Experience <i class="editIndustry fas fa-edit "></i></div>
              <p class="loader SaveindustryExperience"style="float: left;"></p>
                <div class="cl"></div>
                  <div class="IndusList">
                       @include('site.layout.parts.jobSeekerIndustryList')
                  </div>
                    <span class="addIndus btn btn-primary hide_it"style = "cursor:pointer;">+ Add</span>
                    <a class="btn btn-sm btn-success hide_it saveIndus"style = "cursor:pointer;" onclick="UProfile.updateIndustryExperience()">Save</a>
        </div>

        <div class="alert alert-success IndusAlert hide_it2" role="alert">
        {{--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> --}}
          <strong>Success!</strong> Industry Experience have been updated successfully!
        </div>

        {{-- ======================================== Industry Experience end here  ======================================= --}}

		    {{-- <div class="bl">
					<div class="title">
							<div id="basic_anchor_interested_in">Academics
								<span class="fa fa-plus icon_green" onclick="UProfile.showNewActivity('academic');"></span>
							</div>
							<div class="cl"></div>
					</div>

					<div class="activity_list">
						 @foreach ($activities as $activity)
								<div class="activity activity_{{$activity->id}}">
										<div class="activity_title"> {{$activity->title}} ({{ $activity->date->format('F Y')}}) </div>
                                          <div class="activity_desc">{{$activity->description}}</div>
                                          <div class="act_action"><span  onclick="UProfile.removeActivity('academic',{{$activity->id}});" class="close_icon activityRemove" data-id="{{$activity->id}}"></span></div>
								</div>
						 @endforeach
					</div>

					<div class="add_new_activity academic" style="visibility:hidden;opacity:0;">
					<form method="POST" name="new_activity_form" class="new_activity_form act_validation">
							<div class="activity_title">Add new Activity</div>

							<div class="act_title act_field">
								<span class="act_label">Title :</span>
								<div class="act_field_input">
										<input type="text" value="" name="title" class="w100" />
										<div id="title_error" class="error to_hide">&nbsp;</div>
								</div>
							</div>

							<div class="act_date act_field">
								<span class="act_label">Date :</span>
								<div class="act_field_input">
								<select id="act_month" name="month" class="select_main month" data-search="true"  data-placeholder="Select Month">

									@foreach (getMonths() as $mkey => $month)
											<option value="{{$mkey}}">{{$month}}</option>
									@endforeach
								</select>
									<select id="act_year" name="year" class="select_main year" data-search="true"  data-placeholder="Select Year">
									@for ($y=now()->year; $y > 1945; $y--)
									 <option value="{{$y}}">{{$y}}</option>
                                      @endfor
								</select>
								<div id="month_error" class="error to_hide">&nbsp;</div>
								<div id="year_error" class="error to_hide">&nbsp;</div>
								</div>
							</div>

							<div class="act_desc act_field">
								<span class="act_label">Description :</span>
								<div class="act_field_input">
									<textarea name="act_description" class="act_editor w100" maxlength="1000" style="min-height: 120px;"></textarea>
									<div id="act_description_error" class="error to_hide">&nbsp;</div>
								</div>
							</div>

							<div class="act_btn act_field">
								<span class="act_label"></span>
								<iput type="type" value="academic" />
								<button class="btn small white_frame" onclick="UProfile.cancelNewActivity()">Cancel</button>
								<button class="btn small turquoise" onclick="UProfile.saveNewActivity('academic')">Save</button>
							</div>

						</form>
					</div>
		    </div> --}}
      </div>



          {{--
          <div class="col_right">
              <div class="bl">
                  <div class="title">
                      <div class="title_icon_edit">
                          <a id="personalInfoModalBtn">Personal info</a>
                          <div class="icon_edit"><span></span></div>
                      </div>
                      <div class="cl"></div>
                  </div>
                  @include('site.user.profile.personalInfoTable')
              </div>
          </div>
           --}}
    </div>
    <!-- /tab_about -->

    <!-- tab_photos -->
    <a id="tabs-2" class="tab_link tab_a "></a>
    <div class="tab_photos tab_cont">

        @include('site.user.profile.album.album')   {{-- site/user/profile/album/album --}}
    </div>

    <!-- ============================================================= tab_photos ============================================================= -->

    <!-- ============================================================= Tab question ============================================================= -->

    <a id="tabs-3" class="tab_link tab_a"></a>

    <div class="tab_photos tab_cont">
      <div>
        <div id="basic" class="title_icon_edit"style="float:left;">Questions <i class="editQuestions fas fa-edit mb10"></i></div>
        <p class="loader SaveQuestionsLoader"style="float: left;"></p>
        <div class="cl"></div>
        @php
              $userQuestions = !empty($user->questions)?(json_decode($user->questions, true)):(array());
        @endphp
        <div class="questionsOfUser">
          @include('site.user.profile.questionsuserpart')
        </div>
        <div class="col-md-12 text-center"style="margin-top: 15px;">
          <a class="btn btn-sm btn-success saveQuestionsButton hide_it2" onclick="UProfile.updateQuestions()">Save</a>
        </div>
      </div>

      <div class="alert alert-success questionsAlert" role="alert">
        {{--  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> --}}
        <strong>Success!</strong> Questions have been updated successfully!
      </div>

    </div>

    <!--=========================================================== Tab question end here ============================================================= -->


    <!-- ============================================================= Tab Tags ============================================================= -->

    <a id="tabs-4" class="tab_link tab_a"></a>

    <div class="tab_photos tab_cont">
      <div class="col_left">
        <div>
          <div id="basic" class="title_icon_edit"style="float:left;">Tags {{-- <i class="editTags fas fa-edit "></i> --}}</div>
          <p class="loader SaveTagsLoader"style="float: left;"></p>
          <div class="cl"></div>
          {{--       <div class="tagsOfUser">
          @foreach($userTags as $uTags)
          <div class="userTag">
          <span class="userTagLabel">{{$uTags->title}}</span>
          <input type="hidden" name="userTags[]" value="{{$uTags->id}}" class="UserTagsHidden">
          </div>
          @endforeach
         </div> --}}
         {{-- <a class="btn btn-sm btn-success saveTagsButton hide2" style="margin-top: 5px;">Save</a> --}}
       </div>
       {{-- <div class="alert alert-success TagsAlert hide2" role="alert">
        <strong>Success!</strong> Tags have been updated successfully!
        </div> --}}
      </div>
      <div class="userTagsEditingLayout">
          @include('site.layout.tagging')  {{-- site/layout/tagging --}}
      </div>
      <div class="savebuttonUsertags hide_it2">
        {{-- <button type="button" class="btn btn-success">Done</button> --}}
      </div>
    </div>

    <!-- ============================================================= Tab Tags end here  ============================================================= -->

    <!-- ============================================================= Tab Jobs ============================================================= -->

    <a id="tabs-5" class="tab_link tab_a"></a>

    <div class="tab_photos tab_cont" style="padding:0px;">
      <div>
          {{-- <div id="basic" class="title_icon_edit"style="float:left;">Jobs <i class="editQuestions fas fa-edit "></i></div> --}}
          {{-- <p class="loader SaveQuestionsLoader"style="float: left;"></p> --}}
        <div class="cl"></div>
      </div>
      <div class="includedLayoutOfJobApplication">
          @include('site.user.profile.jobApplicationInTabs')
      </div>
      <div class="alert alert-success JobsAlert hide_it2" role="alert">
        <strong>Success!</strong> Jobs have been updated successfully!
      </div>
    </div>

    <!-- ============================================================= Tab Jobs end here ============================================================= -->
    <!-- ============================================================= Tab Reference ============================================================= -->

    <a id="tabs-6" class="tab_link tab_a"></a>
      <div class="tab_reference tab_cont" style="padding:0px;">
        @include('site.user.profile.crossReference')   {{-- site/user/profile/crossReference --}}
      </div>

    <!-- =========================================== Tab Reference end here ========================================== -->

    {{--   <a id="tabs-7" class="tab_link tab_a"></a>
      <div class="tab_interviewInvitation tab_cont pt20" style="padding:0px;">
        @include('site.user.profile.interviewInvitation')   
      </div>
   --}}

    <!-- =========================================== Tab Reference end here ========================================== -->
  </div>
</div>
<!-- /tabs_profile -->
