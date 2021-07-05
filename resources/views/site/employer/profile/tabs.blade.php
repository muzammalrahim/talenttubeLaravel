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

        </ul>
    </div>

    <div id="tabs_content" class="tabs_content"> <!-- tabs_content -->

        <a id="tabs-1" class="tab_link tab_a target"></a>
        <div class="tab_about tab_cont"> <!-- tab_about -->
            <div class="col_left">

                {{-- =========================================== About Us =========================================== --}}

                <div class="bl">
                    <div class="title">
                        <div id="basic_anchor_about_me" class="title_icon_edit">About Us
                            <i id="basic_pen_about_me" onclick="UProfile.showBasicFieldEditor('about_me');" class=" fas fa-edit"></i>
                        </div>
                        <div class="cl"></div>
                    </div>

                    @php
                        $remSpecialChar = str_replace("\&#39;","'",$user->about_me);
                    @endphp

                    <textarea id="basic_editor_text_about_me" class="basic_textarea" maxlength="1000" disabled=""
                        style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 100px; opacity: 1;">{{$remSpecialChar}}</textarea>

                    <div id="basic_editor_about_me" class="frm_edit">
                        <button id="basic_editor_save_about_me" class="btn small pink" onclick="UProfile.saveBasicFieldEditor('about_me'); return false;">Save</button>
                        <button id="basic_editor_cancel_about_me" class="btn small white_frame" onclick="UProfile.closeBasicFieldEditor('about_me'); return false;">Cancel</button>
                        <div class="cl"></div>
                    </div>
                </div>

                {{-- =========================================== Interested in =========================================== --}}

                <div class="bl">
                    <div class="title">
                        <div id="basic_anchor_interested_in" class="title_icon_edit">Interested in
                            <i id="basic_pen_interested_in" onclick="UProfile.showBasicFieldEditor('interested_in');" class=" fas fa-edit"></i>
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

                {{-- =========================================== Industry Experience =========================================== --}}

                <div class="title IndusListBox">

                    <div id="basic" class="title_icon_edit">Industry Experience <i class="editIndustry fas fa-edit"></i></div>
                      <p class="loader SaveindustryExperience"style="float: left;"></p>
                        <div class="cl"></div>
                        <div class="IndusList">
                            @include('site.layout.parts.jobSeekerIndustryList')
                        </div>
                        <span class="addIndus btn btn-primary hide_it"style = "cursor:pointer;">+ Add</span>
                        <a class="btn btn-sm btn-success hide_it saveIndus"style = "cursor:pointer;" 
                            onclick="UProfile.updateIndustryExperience()">Save
                        </a>
                </div>

                <div class="alert alert-success IndusAlert hide_it2" role="alert">
                    <strong>Success!</strong> Industry Experience have been updated successfully!
                </div>

            </div>
            
        </div> <!-- tab_about -->

        <!-- ===================================================== tab_photos ===================================================== -->

        <a id="tabs-2" class="tab_link tab_a "></a>
        <div class="tab_photos tab_cont">
            @include('site.employer.profile.album.album')  {{--     site/employer/profile/album/album   --}} 
        </div>

        {{-- =============================================== Tab Question =============================================== --}}

        <a id="tabs-3" class="tab_link tab_a"></a>
        
        @include('site.employer.profile.tabs.questions')  {{--     site/employer/profile/tabs/questions   --}} 


    </div><!-- tabs_content -->

</div>
<!-- /tabs_profile -->
