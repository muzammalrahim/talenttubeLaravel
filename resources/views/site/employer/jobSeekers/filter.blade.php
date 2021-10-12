


<div class="job_row_heading jobs_filter employee-wraper">
<div class="job_applications_filter mb20 emp-t-row">

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
<div class="row b-filter-row top-filter-row">
    {{-- ============================================ Filter by Qualification ============================================ --}}

     <div class="searchField_qualification mb20 col-md-4 d-flex">
        <div class="searchFieldLabel dinline_block pt-2 col-5">Qualification: </div>
        <select class="dinline_block filter_qualification_type js-select form-control bg-white" name="filter_qualification_type" data-placeholder="Select Qalification & Trades">
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

    {{-- ============================================ Filter by Salary ============================================ --}}

    <div class="searchField_salaryRange d-flex mb20 col-md-4">
        <div class="  col-5 pt-2">Salary Range: </div>
        <select name="filter_salary" class="dinline_block select_aw form-control bg-white" id="filter_salary" data-placeholder="Select Salary Range">
             <option value="">Select Salary Range</option>
            @foreach(getSalariesRange() as $sk => $salary)
                <option value="{{$sk}}">{{$salary}}</option>
            @endforeach
        </select>
    </div>

     {{-- ============================================ Filter by Keywords ============================================ --}}

    <div class="searchField_keyword d-flex mb20 col-md-4">
        <div class="  col-6 pt-2">Filter by Keyword: </div>
        <input type="text" name="filter_keyword" class="form-control">
    </div>


    {{-- ============================================ Filter by Question ============================================ --}}

    <div class="searchField_questions mb20 col-md-8 d-flex">
      <div class="  col-3 pt-2">Filter by Question: </div>
      <div class="filter_question_cont ">
         <div class="questionFilter d-flex">
         @if(!empty(getUserRegisterQuestions()))
         <select class="filter_question select_aw form-control bg-white" name="filter_question">
            @foreach (getUserRegisterQuestions() as $qk => $question)
                <option value="{{$qk}}">{{$question}}</option>
            @endforeach
         </select>
           <ul class="question-radiobtn d-flex ">
             <li>
                 <div class="form-check emp-redio py-2">
                  <input type="radio" id="test1"  name="filter_question_value" value="yes" checked>
                  <label for="test1">Yes</label>
                </div>
              
             </li>
             <li>
              <div class="form-check emp-redio py-2">
                <input type="radio" id="test2"  name="filter_question_value" value="no">
                 <label for="test2">No</label>
              </div>
             </li>
           </ul>

         @endif
         </div>

      </div>

    </div>


    {{-- ============================================ Filter by Resume ============================================ --}}

    <div class="searchField_resume {{-- dwebkitbox --}} mb20 col-md-4 d-flex">
        <div class="searchFieldLabel col-6 pt-2 ">Filter by Resume: </div>
            <input type="text" name="filter_by_resume_value" class="filter_by_resume_value form-control">
    </div>
        {{-- ============================================ Filter by Age Group ============================================ --}}

    <div class="searchField_resume {{-- dwebkitbox --}} mb20 col-md-4 d-flex">
        <div class="searchFieldLabel col-6 pt-2">Filter by Age Group: </div>
            <select name="filter_by_age_val" id="filterAgeGroup" class="form-control bg-white">
                <option value="">Select Age Group</option>
                <option value="18-25">18-25</option>
                <option value="25-30">25-30</option>
                <option value="30-40">30-40</option>
                <option value="40-54">40-54</option>
                <option value="55+">55+</option>
            </select>
    </div>
    {{-- ==============================================================filter by industries============================================== --}}

     <div class="searchField_industry mb20 col-md-8 d-flex">
        <div class="searchFieldLabel dinline_block col-3">Filter by Industry: </div>
        <input type="text" name="filter_industry_status" class="form-control" data-toggle="modal" data-target="#myModal" style="width: 100% !important;">
      
    </div>
    {{-- ============================================ Filter by Location ============================================ --}}
    <div class="searchField_location mb10 col-md-4 d-flex">
        <div class="searchFieldLabel col-5 p-2">Filter by Location: </div>
                    <input type="text" name="filter_location_status" id="filter_location_status" placeholder="Filter by location" class="form-control"  data-toggle="modal" data-target="#myModal2">
        </div>

    {{-- ============================================ Filter by Gender ============================================ --}}

    <div class="searchField_Age mb10 col-md-4 d-flex">
        <div class="searchFieldLabel  col-6 pt-2">Filter by Gender: </div>
        <div class="filter_gender_cont col-6">
            <select name="filter_by_gender_val" id="filterAgeGroup" class="form-control bg-white">
                <option value="">Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
        </div>
    </div>




    {{-- ============================================ Filter by Tags ============================================ --}}

    <div class="searchField_tags mb10 col-md-4 d-flex">
        <div class="searchFieldLabel col-5 pt-2">Filter by Tags: </div>
       <input type="text" name="filter_tags_status" class="filter_tags_status form-control" data-toggle="modal" data-target="#myModal">
    </div>
         <div class="bj-tr-btn">
          <button class="orange_btn" type="reset"><i class="fas fa-redo"></i> Reset</button>
          <button class="interview-tag used-tag"><i class="fas fa-paper-plane"></i>Submit</button>
        </div>
    {{ Form::close() }}
</div>
</div>
</div>
<!-- Modal by filter industry -->
<div class="bj-modal">
<div class="modal fade" id="myModal" tabindex="-1" role="dialog"
aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog filter-industry-modal" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <div class="m-header">
        <h4 class="modal-title" id="myModalLabel">
          <img src="assests/images/filter.png" alt="img" class="">
          Filter by Industry
        </h4>
        <i data-dismiss="modal" aria-label="Close" class="close-box fa fa-times"></i>
      </div>
    </div>
    <div class="modal-body">
     {{-- industry selection --}}
        <div class="filter_industryList {{-- hide_it --}}">
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
    <div class="modal-footer">
      <button type="button" class="btn btn-primary bs-btn">
        <img src="assests/images/search-modal.png" alt="img" class="">
        <span class="fb-text">
          Search
        </span>
      </button>

    </div>
  </div>
</div>
</div>

<!-- Modal -->
</div>

<!-- Modal filter by location -->
<div class="bj-modal loc-modal">
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog"
aria-labelledby="myModalLabel" aria-hidden="true">

<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <div class="m-header">
        <h4 class="modal-title">
          <i class="fas fa-map-marker-alt"></i> Location
          <i data-dismiss="modal" aria-label="Close" class="close-box fa fa-times"></i>
        </h4>
      </div>
      


    </div>
    <div class="modal-body">
{{-- bl_location --}}
<div class="location_search_cont {{-- hide_it --}}">
<div class="location_input dtable w100 d-flex">
<input type="text" name="location_search" class="inpfl_left form-control" id="location_search" value="" placeholder="Type a location" aria-invalid="false">
<select class="dinline_block filter_location_radius select_aw" name="filter_location_radius" data-placeholder="Select Location Radius" style="height: 34px; border-radius: 1px solid gray;">
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
</div>
<div class="location_map_box dtable w100"><div class="location_map" id="location_map"></div></div>
</div>
{{-- bl_location --}}
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-primary gl-btn">
        <i class="fas fa-paper-plane"></i>
        <span class="gl-text">Done </span>
      </button>
    </div>
  </div>
</div>
</div>
</div>
<!-- Modal -->

        <!-- Modal filter by tags -->
<div class="bj-modal">
<div class="modal fade" id="myModal45" tabindex="-1" role="dialog"
aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog filter-industry-modal" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <div class="m-header">
        <h4 class="modal-title" id="myModalLabel">
          <img src="assests/images/filter.png" alt="img" class="">
          Filter by Industry
        </h4>
        <i data-dismiss="modal" aria-label="Close" class="close-box fa fa-times"></i>
      </div>
    </div>
    <div class="modal-body">
    {{-- industry selection --}}
        <div class="filter_tagList {{-- hide_it --}}">
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
    <div class="modal-footer">
      <button type="button" class="btn btn-primary bs-btn">
        <img src="assests/images/search-modal.png" alt="img" class="">
        <span class="fb-text">
          Search
        </span>
      </button>

    </div>
  </div>
</div>
</div>
<!-- Modal -->