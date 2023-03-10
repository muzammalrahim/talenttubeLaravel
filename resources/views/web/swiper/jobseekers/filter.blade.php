<link href="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
<script src="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js"></script>




<style>
    select {
        width: 100%;
    }
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
    /*$(document).on('change' '.filter_qualification_type', function(){
    });*/
</script>
<div class="mJSFilter mb-2" style="position: absolute;width: 82%;z-index: 999;">
    {{ Form::open(array('url' => url()->current(), 'method' => 'get', 'id' => 'jobSeeker_filter_form' )) }}
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
                        {{-- <div class="overlay"></div> --}}
                        <div class="p-2 card-body mb-1 rgba-grey-light white-text FilterCont">
                            <div class="test" style="max-height: 260px;overflow-y:auto;">
                                {{-- ============================================= Qualification ============================================= --}}

                                <div class="FilterBox">
                                    <select class="white-text mdb-select md-form colorful-select dropdown-primary filter_qualification_type form-control icon_show mb-1" 
                                    id="swiper_qualification_type" 
                                    name="swiper_qualification_type" data-placeholder="Select Qalification & Trades">
                                         <option vaResetFormlue="">Select Qalification & Trades</option>
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

                                    {{-- <div class="qualification_trade d-none">
                                        <select multiple="multiple" class="multiple-select" multiple name="ja_filter_qualification[]"  id="tradeSelect" data-placeholder="Select Trade">
                                            @foreach ($qualifications as $qualif)
                                                @if($qualif['type']  !== 'trade')
                                                  <option value="{{$qualif['id']}}">{{$qualif['title']}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div> --}}
                                    @endif
                                </div>
                                {{-- ============================================= Salary Range ============================================= --}}
                                <div class="FilterBox">
                                    <select class="white-text mdb-select md-form colorful-select dropdown-primary form-control icon_show text-dark mb-1" id="filter_salary" name="filter_salary" data-placeholder="Select Salary Range">
                                        <option value="">Select Salary Range</option> @foreach(getSalariesRange() as $sk => $salary) <option value="{{$sk}}">{{$salary}}</option> @endforeach
                                    </select>
                                </div>
                                {{-- ============================================= Salary Range ============================================= --}}
                                {{-- ============================================ Filter by Age Group ============================================ --}}
                                <div class="FilterBox">
                                    <select class="white-text mdb-select md-form colorful-select dropdown-primary form-control icon_show text-dark mb-1" id="filter_by_age" name="filter_by_age" data-placeholder="Select Age Group">
                                        <option value="">Select Age Group</option>
                                        <option value="18-25">18-25</option>
                                        <option value="25-30">25-30</option>
                                        <option value="30-40">30-40</option>
                                        <option value="40-54">40-54</option>
                                        <option value="55+">55+</option>
                                    </select>
                                </div>
                                {{-- ============================================ Filter by Gender ============================================ --}}
                                <div class="FilterBox">
                                    <select class="white-text mdb-select md-form colorful-select dropdown-primary form-control icon_show text-dark mb-1" id="filter_by_gender" name="filter_by_gender" data-placeholder="Select Gender">
                                        <option value="">Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                                {{-- ============================================ Filter by Age Group ============================================ --}}
                                {{-- ============================================= Industry Experience ============================================= --}}
                                <div class="FilterBox FilterIndustry">
                                    <div class="custom-checkbox">
                                        <input type="checkbox" class="filter_showDetail" id="filter_industry_status" name="filter_industry_status" data-dc="FilterIndustryList">
                                        <label class="form-check-label" for="filter_industry_status">Filter by Industry</label>
                                    </div>
                                    <div class="FilterIndustryList d-none"> @php $industries = getIndustries() @endphp @if(!empty($industries)) <div class="filter_industries_list "> @foreach ($industries as $indK => $indV) <div class="custom-checkbox">
                                                <input type="checkbox" class="" id="industry_{{$indK}}" name="filter_industry[]" value="{{$indK}}">
                                                <label class="form-check-label" for="industry_{{$indK}}">{{$indV}}</label>
                                            </div> @endforeach </div> @endif </div>
                                </div>
                                {{-- ============================================= Industry Experience ============================================= --}}
                                <hr class="my-2" style="height: 0.1em;  background: rgb(41, 41, 41); ">
                                {{-- ============================================= Location  ============================================= --}}
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
                                                <select class="white-text mdb-select md-form filter_location_radius form-control icon_show text-dark mb-1" name="filter_location_radius">
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
                                {{-- ============================================= Location ============================================= --}}
                                <hr class="my-2" style="height: 0.07em;  background: rgb(41, 41, 41); ">
                                {{-- ============================================= Question ============================================= --}}
                                <div class="FilterBox FilterLocation">
                                    <div class="custom-checkbox">
                                        <input type="checkbox" class="filter_showDetail" id="filter_by_questions" name="filter_by_questions" data-dc="FilterQuestionBox">
                                        <label class="form-check-label" for="filter_by_questions">Filter by Question</label>
                                    </div>
                                    <div class="FilterQuestionBox d-none col filter_question_cont mt-1">
                                        <div class="row"> @if(!empty(getUserRegisterQuestions())) <div class="col-12 p-0">
                                                <select class="white-text mdb-select md-form filter_question form-control icon_show text-dark mb-1" name="filter_question"> @foreach (getUserRegisterQuestions() as $qk => $question) <option value="{{$qk}}">{{$question}}</option> @endforeach </select>
                                            </div>
                                            <div class="col-4 p-0">
                                                <select class="white-text mdb-select md-form filter_question_value form-control icon_show text-dark mb-1" name="filter_question_value">
                                                    <option value="yes">Yes</option>
                                                    <option value="no">No</option>
                                                </select>
                                            </div> @endif
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