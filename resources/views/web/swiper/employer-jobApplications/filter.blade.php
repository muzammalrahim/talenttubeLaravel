<link href="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
<script src="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js"></script>




<style>
    select { width: 100%; }
    .ms-drop>ul>li>label>input[type="checkbox"] {
    height: 12px;
    margin-top: 5px !important;
}
.ms-drop{
    position: relative !important;
}

.ms-drop>ul {
    overflow-x: hidden;
}
</style>
<script>
    $(function() {
        $('.multiple-select').multipleSelect()
    })
</script>
<div class="jobAppfilter mb-2" style="position: absolute;width: 82%;z-index: 999;">
    {{ Form::open(array('url' => url()->current(), 'method' => 'get', 'id' => 'jobapp_filter_form' )) }}
    <input type="hidden" name="page" id="paginate" value="">
    <!-- Grid row -->
    <div class="row m-0 d-flex justify-content-center">
        <!-- Grid column -->
        <div class="col-12 p-0">
            <!--Accordion wrapper-->
            <div class="accordion md-accordion accordion-2" id="accordionEx7" role="tablist" aria-multiselectable="true">
                <!-- Accordion card -->
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header rgba-stylish-strong z-depth-1" role="tab" id="heading1" onclick="showOverlay()">
                        <a data-toggle="collapse" data-parent="#accordionEx7" href="#collapse1" aria-expanded="true" aria-controls="collapse1">
                            <h5 class="mb-0 white-text font-thin" id="filter">Filters <i class="fas fa-angle-down rotate-icon"></i>
                            </h5>
                        </a>
                    </div>
                    <!-- Card body -->
                    <div id="collapse1" class="collapse" role="tabpanel" aria-labelledby="heading1" data-parent="#accordionEx7">
                        <div class="p-2 card-body mb-1 rgba-grey-light white-text FilterCont">
                            <div class="test" style="max-height: 260px;overflow-y:auto;">
                                {{-- ============================================= Qualification ============================================= --}}

                                <div class="job_applications_filter mb20">
                                    <input type="hidden" name="page" id="paginate" value="">
                                    <input type="hidden" name="job_id" value="{{$job->id}}">
                                    {{-- ======================================= Filter By Keyword ======================================= --}}
                                    <div class="FilterBox">
                                        <div class="input-employee clearfix mb-0">
                                                {{-- <label class="col-md-4">Keyword:</label> --}}
                                            <label class=" browse-heading font-weight-normal">Keyword:</label>
                                            <input type="text" class="form-control col-12 col-sm-8 ml-3 ml-sm-0" name="ja_filter_keyword">
                                        </div>
                                    </div>
                                        {{-- ======================================= Filter By Salary ======================================= --}}
                                    <div class="FilterBox">
                                        <div class="input-employee clearfix mb-0">
                                            <label class="browse-heading font-weight-normal">Salary Range:</label>
                                            <select class="white-text mdb-select md-form colorful-select dropdown-primary form-control icon_show text-dark mb-1" id="filter_salary" name="filter_salary" data-placeholder="Select Salary Range">
                                                <option value="">Select Salary Range</option> @foreach(getSalariesRange() as $sk => $salary) <option value="{{$sk}}">{{$salary}}</option> @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    {{-- ======================================= Filter By Sort By ======================================= --}}
                                    <div class="FilterBox">
                                        {{-- <div class="searchField_sortBy d-flex col-md-4"> --}}
                                        <div class="input-employee clearfix">
                                            <label class="browse-heading font-weight-normal">Sort By:</label>
                                            {{-- <div class="sortByFieldLabel col-5 pt-2">Sort By: </div> --}}
                                            <select name="ja_filter_sortBy" class="form-control bg-white icon_show">
                                                <option value="goldstars">Gold Stars</option>
                                                <option value="applied">Applied</option>
                                                <option value="inreview">In Review</option>
                                                <option value="interview">Interview</option>
                                                <option value="unsuccessful">Unsuccessful</option>
                                                <option value="pending">pending</option>
                                                <option value="all_candidates">All candidates</option>
                                            </select>
                                        </div>
                                    </div>


                                    {{-- ======================================= Filter By Qualification ======================================= --}}
                                    <div class="FilterBox">
                                        <label class="form-check-label mt-1" for="filter_industry_status">Filter by Qualification</label>
                                        <select class="white-text mdb-select md-form colorful-select dropdown-primary filter_qualification_type form-control icon_show mb-1" 
                                        id="ja_filter_qualification_type" 
                                        name="ja_filter_qualification_type" data-placeholder="Select Qalification & Trades">
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
                                        <div class="qualification_degree d-none">
                                            <select multiple="multiple" class="multiple-select mb-1" multiple name="ja_filter_qualification[]" id="degreeSelect" data-placeholder="Select a Degree">
                                                @foreach ($qualifications as $qualif)
                                                    {{-- @if($qualif['type']  == 'degree') --}}
                                                      <option value="{{$qualif['id']}}">{{$qualif['title']}}</option>
                                                    {{-- @endif --}}
                                                @endforeach
                                            </select>
                                        </div>
                                        @endif
                                    </div>
                                    {{-- ============================================= Industry Experience ============================================= --}}
                                    <div class="FilterBox FilterIndustry">
                                        <div class="custom-checkbox">
                                            <input type="checkbox" class="filter_showDetail" id="filter_industry_status" name="filter_industry_status" data-dc="FilterIndustryList">
                                            <label class="form-check-label" for="filter_industry_status">Filter by Industry</label>
                                        </div>
                                        <div class="FilterIndustryList d-none"> 
                                            @php $industries = getIndustries(); @endphp 
                                            @if(!empty($industries)) 
                                            <div class="filter_industries_list "> 
                                                @foreach ($industries as $indK => $indV) 
                                                <div class="custom-checkbox">
                                                    <input type="checkbox" class="" id="industry_{{$indK}}" name="filter_industry[]" value="{{$indK}}">
                                                    <label class="form-check-label" for="industry_{{$indK}}">{{$indV}}</label>
                                                </div> @endforeach 
                                            </div> 
                                            @endif 
                                        </div>
                                    </div>
                                    {{-- ============================================= Industry Experience ============================================= --}}
                                    {{-- ======================================= Filter By Question ======================================= --}}
                                 
                                    <div class="FilterBox FilterIndustry">
                                        <div class="custom-checkbox">
                                            <input type="checkbox" class="filter_showDetail" id="filter_question_status" name="filter_by_questions" data-dc="FilterIndustryList">
                                            <label class="form-check-label" for="filter_question_status">Filter by Questions</label>
                                        </div>
                                    </div>
                                    <div class="FilterBox FilterQuestionBox d-none">
                                        @if(varExist('questions', $job)) 
                                        @foreach ($job->questions as $qkey => $jq) 
                                        <div class="jobFilterQuestion mb-1">
                                            <label class="fjq_title">{{$jq->title}}</label>
                                            <div class="fjq_options"> 
                                                @if($jq->options) 
                                                <select class="filter_question bg-white select_aw form-control icon_show" name="filter_question[{{$jq->id}}]">
                                                    <option value="">Select</option> 
                                                    @foreach ($jq->options as $qk => $jqopt) 
                                                    <option value="{{$jqopt}}">{{$jqopt}}</option> @endforeach
                                                </select> 
                                                @endif 
                                            </div>
                                        </div> 
                                        @endforeach 
                                        @endif 
                                    </div>
                                    {{-- ============================================ Filter by Location ============================================ --}}
                                    
                                    <div class="FilterBox FilterLocation">
                                        <div class="custom-checkbox">
                                            <input type="checkbox" class="filter_showDetail" id="filter_location_status" name="filter_location_status" data-dc="FilterLocationBox">
                                            <label class="form-check-label" for="filter_location_status">Filter by Location</label>
                                        </div>
                                        <div class="FilterLocationBox d-none col location_search_cont mt-1">
                                            <div class="row">
                                                <div class="col-9 pl-0 md-form form-sm">
                                                    <input type="text" name="location_search" id="location_search" class="form-control form-control-sm white-text" placeholder="Type a location">
                                                </div>
                                                <div class="col-3 p-0">
                                                    <select class="white-text mdb-select md-form filter_location_radius form-control icon_show text-dark mb-1" 
                                                    name="filter_location_radius">
                                                        <option value="5">5km</option>
                                                        <option value="10">10km</option>
                                                        <option value="25" selected="selected">25km</option>
                                                        <option value="50">50km</option>
                                                        <option value="51">50km +</option>
                                                    </select>
                                                </div>
                                                <div class="location_latlong d-none w100">
                                                    <input type="hidden" class="location_lat w50 fl_left" name="location_lat" id="location_lat" value="" placeholder="Lat" readonly="true" aria-invalid="false">
                                                    <input type="hidden" class="location_long w50 fl_left" name="location_long" id="location_long" value="" placeholder="Long" readonly="true" aria-invalid="false">
                                                </div>
                                                <div class="location_map_box dtable w100">
                                                    <div class="location_map" id="location_map"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="FilterBox mt-3">
                                <div class="text-center">
                                    <button name="ResetForm" data-toggle="collapse" onclick="locationReload()" data-target="#collapse1" class="orange_btn" id="ResetForm" type="button">Reset</button>
                                    <button name="CreateConfig" data-toggle="collapse" data-target="#collapse1" class="btn blue_btn " id="CreateConfig" type="submit">Submit</button>
                                </div>
                            </div>
                            {{-- ============================================= Question ============================================= --}}
                        </div>
                    </div>
                </div>
                <!-- Accordion card -->
            </div>
            <!--/.Accordion wrapper-->
        </div>
        <!-- Grid column -->
    </div>
    <!-- Grid row -->
    {{ Form::close() }}
</div>