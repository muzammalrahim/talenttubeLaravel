<div class="job_applications_filter mb20 employee-wraper">
        {{ Form::open(array('url' => url()->current(), 'method' => 'get', 'id' => 'job_applications_filter_form' )) }}
        <input type="hidden" name="page" id="paginate" value="">
        <input type="hidden" name="job_id" value="{{$job->id}}">
        <div class="row b-filter-row top-filter-row mb-0">
            {{-- ======================================= Filter By Keyword ======================================= --}}
            <div class="row">
                <div class="col-md-6 col-sm-6 col-12">
                    <div class="input-employee clearfix mb-0">
                        <div class="row">
                            {{-- <label class="col-md-4">Keyword:</label> --}}
                            <label class="col-12 col-sm-4 browse-heading font-weight-normal">Keyword:</label>
                            <input type="text" class="form-control col-12 col-sm-8 ml-3 ml-sm-0" name="ja_filter_keyword">
                        </div>
                    </div>
                </div>
                {{-- ======================================= Filter By Salary ======================================= --}}
                <div class="col-md-6 col-sm-6 col-12">
                    <div class="input-employee clearfix">
                        <div class="row">
                            <label class="col-12 col-sm-4 browse-heading font-weight-normal">Salary:</label>
                            {{-- <input type="text" class="form-control col-md-8" name="filter_salary" aria-label="Recipient's username"> --}}
                            <select name="ja_filter_salary" class="form-control col-12 col-sm-8 ml-3 ml-sm-0 bg-white icon_show" id="filter_salary" data-placeholder="Select Salary Range">
                                <option value="">Select Salary Range</option> @foreach(getSalariesRange() as $sk => $salary) <option value="{{$sk}}">{{$salary}}</option> @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            {{-- ======================================= Filter By Sort By ======================================= --}}
            <div class="row">
                {{-- <div class="searchField_sortBy d-flex col-md-4"> --}}
                <div class="col-md-6 col-sm-6 col-12">
                    <div class="input-employee clearfix">
                        <div class="row">
                            <label class="col-12 col-sm-4 browse-heading font-weight-normal">Sort By:</label>
                            {{-- <div class="sortByFieldLabel col-5 pt-2">Sort By: </div> --}}
                            <select name="ja_filter_sortBy" class="form-control col-12 col-sm-8 ml-3 ml-sm-0 bg-white icon_show">
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
                </div>
                {{-- ======================================= Filter By Qualification ======================================= --}}
                <div class="col-md-6 col-sm-6 col-12 px-0">
                    <div class="searchField_qualification b-filter-row">
                        <div class="row input-employee">
                            {{-- <div class="searchFieldLabel col-5 pt-2">Qualification: </div> --}}
                            <label class="col-12 col-sm-4 browse-heading font-weight-normal">Qualifications:</label>
                            <select class="col-12 col-sm-8 ml-3 ml-sm-0 filter_qualification_type form-control bg-white icon_show" name="ja_filter_qualification_type" onchange="showQualificationSelect2()" data-placeholder="Select Qalification & Trades">
                                <option value="">Select Qalification & Trades</option>
                                <option value="certificate">Certificate or Advanced Diploma</option>
                                <option value="trade">Trade Certificate</option>
                                <option value="degree">University Degree</option>
                                <option value="post_degree">University Post Graduate (Masters or PHD)</option>
                            </select> @php ($qualifications = getQualificationsList()) @endphp @if(!empty($qualifications)) <div class="filter_qualificaton_degree pe-0 pt-3 position-relative" style="opacity:0">
                                {{-- <ul class="qualification_ul item_ul dot_list">
                           @foreach ($qualifications as $qualif)
                           
                                                                    <li class="{{$qualif['type']}}" data-id="{{$qualif['id']}}" data-type="ja_filter_qualification[]"> <span>{{$qualif['title']}}</span>
                                </li> @endforeach </ul> --}} <select class="multi-select form-control custom-select icon_show" name="ja_filter_qualification[]" multiple="multiple" id="filter_by_qualification"> @foreach ($qualifications as $qualif) <option value="{{ $qualif['type'] }} data-id={{$qualif['id']}}">
                                        <span style="width: 100%">{{$qualif['title']}}</span>
                                    </option> @endforeach </select>
                                <i class="fa fa-angle-down qualifications-icon position-absolute"></i>
                            </div> @endif
                        </div>
                    </div>
                </div>
            </div>
            {{-- ======================================= Filter By Industry ======================================= --}}
            <div class="row b-filter-row mt-3">
                <div class="col-12 col-md-10 browse-mp">
                    <div class="row">
                        <div class="col-3 col-sm-2 mt-1">
                            <h5 class="browse-heading font-weight-normal">Industry:</h5>
                        </div>
                        <div class="col-2 col-sm-1 custom-checkbox pl-sm-0">
                            <input type="checkbox" name="filter_industry_status" checked class="">
                        </div>
                        <div class="col-sm-9 filter_industryList">
                            <select name="filter_industry[]" multiple="multiple" id="filter_industry" placeholder="Filter by Job" class="multi-select form-control custom-select" style="width:100%"> @php $industries = getIndustries() @endphp @if(!empty($industries)) <div class="filter_industries_list"> @foreach ($industries as $indK => $indV) <option class="" value="{{$indK}}" data-id="{{$indK}}">
                                        <span>{{$indV}}</span>
                                    </option> @endforeach </div> @endif </select>
                            <i class="fa fa-angle-down dropdownSelect3 position-absolute"></i>
                            {{-- </div>
                        --}}
                        </div>
                    </div>
                </div>
            </div>
            {{-- ======================================= Filter By Question ======================================= --}}
            <div class="row b-filter-row mt-3">
                <div class="col-12 col-md-10">
                    <div class="row">
                        <div class="col-3 col-sm-2 mt-1">
                            <h5 class="browse-heading font-weight-normal">Question:</h5>
                        </div>
                        <div class="col-2 col-sm-1 custom-checkbox pl-sm-0">
                            <input type="checkbox" class="" name="filter_by_questions">
                        </div>
                        <div class="col-sm-9 pt-3 pt-sm-0 questionFilter filter_question_cont"> @if(varExist('questions', $job)) @foreach ($job->questions as $qkey => $jq) <div class="jobFilterQuestion row mb-1">
                                <span class="fjq_counter col-2">Question {{($qkey+1)}}: </span>
                                <span class="fjq_title col-5">{{$jq->title}}</span>
                                <div class="fjq_options col-5"> @if($jq->options) <select class="filter_question bg-white  select_aw form-control icon_show" name="filter_question[{{$jq->id}}]">
                                        <option value="">Select</option> @foreach ($jq->options as $qk => $jqopt) <option value="{{$jqopt}}">{{$jqopt}}</option> @endforeach
                                    </select> @endif </div>
                            </div> @endforeach @endif </div>
                    </div>
                </div>
            </div>
            {{-- ============================================ Filter by Location ============================================ --}}
            <div class="row b-filter-row mt-3">
                <div class="col-12 col-md-10">
                    <div class="row">
                        <div class="col-3 col-sm-2 mt-1 b-mob-pad">
                            <h5 class="browse-heading font-weight-normal">Location:</h5>
                        </div>
                        <div class="col-2 col-sm-1 custom-checkbox pl-sm-0">
                            <input type="checkbox" class="" name="filter_location_status">
                        </div>
                        <div class="FilterLocationBox col-sm-9 pt-3 pt-sm-0">
                            <div class="location_search_cont row hide_it">
                                <div class="col-9 pe-0 md-form form-sm">
                                    <input type="text" name="location_search" id="location_search" class="form-control form-control-sm white-text" placeholder="Type a location">
                                </div>
                                <div class="col-3 ps-0">
                                    <select class="white-text mdb-select md-form filter_location_radius custom-select icon_show" name="filter_location_radius" data-placeholder="Select Location Radius">
                                        <option value="5" selected="selected">5km</option>
                                        <option value="10">10km</option>
                                        <option value="25">25km</option>
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
            {{-- data-target ="#qualification_modal" data-toggle = "modal" --}}
            <div class="bj-tr-btn">
                <button class="orange_btn" type="reset">
                    <i class="fas fa-redo"></i> Reset </button>
                <button class="interview-tag used-tag">
                    <i class="fas fa-paper-plane"></i>Submit </button>
            </div>
        </div>
        {{ Form::close() }}
    </div>