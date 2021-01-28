


<div class="job_row_heading jobs_filter">
<div class="job_applications_filter mb20">

    {{ Form::open(array('url' => url()->current(), 'method' => 'get', 'id' => 'jobSeeker_filter_form' )) }}
    <input type="hidden" name="page" id="paginate" value="">

    {{--
    <div class="searchField_qualification mb10">
        <div class="searchFieldLabel dinline_block">Qualification: </div>
        <select class="dinline_block select_aw" name="filter_qualification_type" data-placeholder="Select Qalification & Trades">
             <option value="">Select Qalification & Trades</option>
             <option value="certificate">Certificate or Advanced Diploma</option>
             <option value="trade">Trade Certificate</option>
             <option value="degree">University Degree</option>
             <option value="post_degree">University Post Graduate (Masters or PHD)</option>
        </select>
    </div> --}}

     <div class="searchField_qualification mb10">
        <div class="searchFieldLabel dinline_block">Qualification: </div>
        <select class="dinline_block filter_qualification_type js-select" name="filter_qualification_type" data-placeholder="Select Qalification & Trades">
             <option value="">Select Qalification & Trades</option>
             <option value="certificate">Certificate or Advanced Diploma</option>
             <option value="trade">Trade Certificate</option>
             <option value="degree">University Degree</option>
             <option value="post_degree">University Post Graduate (Masters or PHD)</option>
        </select>

        @php
         $qualifications = getQualificationsList();
        @endphp
        @if(!empty($qualifications))
        <div class="filter_qualificaton_degree">
            <ul class="qualification_ul item_ul dot_list">
                @foreach ($qualifications as $qualif)
                    <li class="{{$qualif['type']}}" data-id="{{$qualif['id']}}" data-type="ja_filter_qualification[]">
                        <span>{{$qualif['title']}}</span>
                    </li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>



    <div class="searchField_salaryRange dblock mb10">
        <div class="searchFieldLabel dinline_block">Salary Range: </div>
        <select name="filter_salary" class="dinline_block select_aw" id="filter_salary" data-placeholder="Select Salary Range">
             <option value="">Select Salary Range</option>
            @foreach(getSalariesRange() as $sk => $salary)
                <option value="{{$sk}}">{{$salary}}</option>
            @endforeach
        </select>
    </div>

     <div class="searchField_industry mb10">
        <div class="searchFieldLabel dinline_block">Filter by Industry: </div>
        <div class="toggleSwitchButton dinline_block"><label class="switch"><input type="checkbox" name="filter_industry_status"></label></div>
        {{-- industry selection --}}
        <div class="filter_industryList hide_it">
            @php
                $industries = getIndustries()
            @endphp
            @if(!empty($industries))
            <div class="filter_industries_list ">
                <ul class="industries_ul item_ul dot_list">
                    @foreach ($industries as $indK => $indV)
                        <li class="" data-id="{{$indK}}" data-type="filter_industry[]"><span>{{$indV}}</span></li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
        {{-- industry selection --}}
    </div>




    <div class="searchField_location mb10">
        <div class="searchFieldLabel dinline_block">Filter by Location: </div>
        <div class="search_location_status_cont toggleSwitchButton">
            {{-- <label for="yes_no_radio">Do you agree to the terms?</label>
            <p><input type="radio" name="search_location_status" checked>Search Google map</input></p>
            <p><input type="radio" name="search_location_status">Any Location</input></p> --}}
            {{-- <label class="switch">
                <input type="checkbox" name="filter_location_status" id="filter_location_status">
            </label> --}}
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="filter_location_status" id="filter_location_status">
                </label>
            </div>
        </div>
        {{-- bl_location --}}
        <div class="location_search_cont hide_it">
            <div class="location_input dtable w100">
                <input type="text" name="location_search" class="inp w80 fl_left" id="location_search" value="" placeholder="Type a location" aria-invalid="false">
                <select class="dinline_block filter_location_radius select_aw" name="filter_location_radius" data-placeholder="Select Location Radius">
                     <option value="5">5km</option>
                     <option value="10">10km</option>
                     <option value="25">25km</option>
                     <option value="50">50km</option>
                     <option value="51">50km +</option>
                </select>
            </div>
            <div class="location_latlong dtable w100">
                <input type="hidden" class="location_lat w50 fl_left" name="location_lat" id="location_lat" value="" placeholder="Lat" readonly="true" aria-invalid="false">
                <input type="hidden" class="location_long w50 fl_left" name="location_long" id="location_long" value="" placeholder="Long" readonly="true" aria-invalid="false">
                {{--
                <input type="hidden" name="location_name" id="location_name"  value="">
                <input type="hidden" name="location_city" id="location_city"  value="">
                <input type="hidden" name="location_state" id="location_state"  value="">
                <input type="hidden" name="location_country" id="location_country"  value="">
                --}}
            </div>
            <div class="location_map_box dtable w100"><div class="location_map" id="location_map"></div></div>
        </div>
        {{-- bl_location --}}
    </div>


    <div class="searchField_questions mb10">
      <div class="searchFieldLabel dinline_block">Filter by Question: </div>
      <div class="toggleSwitchButton">
            <label class="switch"><input type="checkbox" name="filter_by_questions"></label>
      </div>

      <div class="filter_question_cont hide_it">

         @php
            // $userQuestion = getUserRegisterQuestions();
            // dump($userQuestion)
         @endphp


         <div class="questionFilter">
         @if(!empty(getUserRegisterQuestions()))
         <select class="filter_question select_aw" name="filter_question">
            @foreach (getUserRegisterQuestions() as $qk => $question)
                <option value="{{$qk}}">{{$question}}</option>
            @endforeach
         </select>

         <select class="filter_question_value select_aw" name="filter_question_value">
             <option value="yes">Yes</option>
             <option value="no">No</option>
         </select>

         @endif
         </div>

      </div>

    </div>

    {{-- ============================================ Filter by Resume ============================================ --}}

    <div class="searchField_resume dwebkitbox mb10">
        <div class="searchFieldLabel dinline_block">Filter by Resume: </div>
        <div class="toggleSwitchButton">
            <label class="switch"><input type="checkbox" name="filter_by_resume"></label>
        </div>

        <div class="filter_resume_cont hide_it">
            <input type="text" name="filter_by_resume_value" class="filter_by_resume_value">
        </div>

    </div>



    {{-- ============================================ Filter by Keywords ============================================ --}}


     <div class="searchField_keyword dblock mb10">
        <div class="searchFieldLabel dinline_block">Filter by Keyword: </div>
        <input type="text" name="filter_keyword">
    </div>

     {{-- ============================================ Filter by Tags ============================================ --}}


    <div class="searchField_tags mb10">
        <div class="searchFieldLabel dinline_block">Filter by Tags: </div>
        <div class="toggleSwitchButton dinline_block"><label class="switch"><input type="checkbox" name="filter_tags_status" class="filter_tags_status"></label></div>
        {{-- industry selection --}}
        <div class="filter_tagList hide_it">
            
            {{-- @if(!empty($industries)) --}}
            <div class="filter_tags_list">
                <ul class="tags_ul item_ul dot_list">
                    @foreach ($tags as $tag => $tagVal)
                        <li class="" data-id="{{$tagVal->id}}" data-type="filter_tags[]"><span>{{$tagVal->title}}</span></li>
                    @endforeach
                </ul>
            </div>
            {{-- @endif --}}
        </div>
        {{-- industry selection --}}
    </div>






    <div class="searchField_action">
        <div class="searchFieldLabel dinline_block"></div>
                                <button class="btn small OrangeBtn">Submit</button>
                                {{-- <input class="btn small OrangeBtn reset-btn" value="Reset" type="reset"> --}}
								<button class="btn small OrangeBtn reset-btn" >Reset</button>
    </div>

    {{ Form::close() }}
</div>
</div>


