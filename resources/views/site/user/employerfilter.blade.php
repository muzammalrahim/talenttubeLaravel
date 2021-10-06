 {{-- @dump($employers) --}}
	{{-- <div class="add_new_job">

		<div class="job_row_heading jobs_filter">
			<div class="job_applications_filter mb20">

				{{ Form::open(array('url' => url()->current(), 'method' => 'get', 'id' => 'employer_filter_form' )) }}
				<input type="hidden" name="page" id="paginate" value=""> --}}

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
{{--
					<div class="searchField_qualification mb10">
						<div class="searchField_keyword dblock mb10">
							<div class="searchFieldLabel dinline_block">Keyword: </div>
							<input type="text" name="filter_keyword" style="margin-left: 53px;">
						</div>

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
				</div> --}}




{{--
					<div class="searchField_industry mb10">
								<div class="searchFieldLabel dinline_block">Filter by Industry: </div>
								<div class="toggleSwitchButton dinline_block"><label class="switch"><input type="checkbox" name="filter_industry_status"></label></div> --}}
								{{-- industry selection --}}
					{{-- 			<div class="filter_industryList hide_it">
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
								</div> --}}
								{{-- industry selection --}}
				{{-- </div> --}}




				{{-- <div class="searchField_location mb10">
								<div class="searchFieldLabel dinline_block">Filter by Location: </div>
								<div class="search_location_status_cont toggleSwitchButton">
												<label class="switch">
																<input type="checkbox" name="filter_location_status">
												</label>
								</div> --}}
								{{-- bl_location --}}
					{{-- 			<div class="location_search_cont hide_it">
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
												</div>
												<div class="location_map_box dtable w100"><div class="location_map" id="location_map"></div></div>
								</div> --}}
								{{-- bl_location --}}
				{{-- </div> --}}


				{{-- <div class="searchField_questions mb10">
						<div class="searchFieldLabel dinline_block">Filter by Question: </div>
						<div class="toggleSwitchButton">
												<label class="switch"><input type="checkbox" name="filter_by_questions"></label>
						</div>

						<div class="filter_question_cont hide_it">




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

				</div> --}}



			{{-- 	<div class="searchField_action">
								<div class="searchFieldLabel dinline_block"></div>
								<button class="btn small OrangeBtn">Submit</button>
								<button class="btn small OrangeBtn reset-btn">Rest</button>
				</div>

				{{ Form::close() }}
</div>
</div>

		</div> --}}

		<div class="employer-main">
          <h2>Employers List</h2>
          {{ Form::open(array('url' => url()->current(), 'method' => 'get', 'id' => 'employer_filter_form' )) }}
        <input type="hidden" name="page" id="paginate" value="">
          <!-- Top Filter Row -->
          <div class="employee-wraper">
            <div class="emp-t-row">
              <div class="row b-filter-row top-filter-row">
                <div class="col-md-4 col-sm-12">
                  <div class="input-employee clearfix">
                      <label>Keyword:</label>
                      <input type="text" class="form-control" name="filter_keyword" aria-label="Recipient's username">
{{--                      @php--}}
{{--                        $qualifications = getQualificationsList();--}}
{{--                      @endphp--}}
{{--                      @if(count($qualifications))--}}
{{--                      <div class="filter_qualificaton_degree">--}}
{{--                              <ul class="qualification_ul item_ul dot_list">--}}
{{--                                      @foreach ($qualifications as $qualif)--}}
{{--                                              <li class="{{$qualif['type']}}" data-id="{{$qualif['id']}}" data-type="ja_filter_qualification[]">--}}
{{--                                                      <span>{{$qualif['title']}}</span>--}}
{{--                                              </li>--}}
{{--                                      @endforeach--}}
{{--                              </ul>--}}
{{--                      </div>--}}
{{--                      @endif--}}
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="input-employee clearfix">
                      <label>Filter by Industry:</label>
                      <input data-toggle="modal" data-target="#myModal" type="text" class="form-control" name="filter_industry_status" placeholder="" aria-label="Recipient's username">
                      <i class="search-employee-icon fas fa-search"></i>
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="input-employee clearfix">
                      <label>Filter by Location:</label>
                      <input data-toggle="modal" data-target="#myModal2" type="text" class="form-control" name="filter_location_status" aria-label="Recipient's username">
                      <div class="loc-icon">
                        <img src="assests/images/location.png" alt="">
                    </div>
                  </div>
                </div>
              </div>

              <!-- row 2 -->
              <div class="row b-filter-row">
                  <div class="col-md-2 input-employee">
                      <label class="d-flex justify-content-center flex-row">Questions:</label>
                  </div>
                <div class="col-md-6">
                  <div class="input-employee clearfix">
                    @if(!empty(getUserRegisterQuestions()))
                    <select type="text" class="form-control bg-white" name="filter_question" aria-label="Recipient's username">
                      @foreach (getUserRegisterQuestions() as $qk => $question)
                                <option value="{{$qk}}">{{$question}}</option>
                        @endforeach
                    </select>
                    @endif
                </div>
                </div>
                 <div class="col-md-4">
               <ul class="question-radiobtn">
                 <li>
                     <div class="form-check emp-redio">
                      <input type="radio" id="test1" name="filter_question_value" value="yes" checked>
                      <label for="test1">Yes</label>
                    </div>

                 </li>
                 <li>
                  <div class="form-check emp-redio">
                    <input type="radio" id="test2" value="no" name="filter_question_value">
                     <label for="test2">No</label>
                  </div>
                 </li>
               </ul>
               </div>
              </div>
          </div>
            <!-- row 2 -->
         </div>
             <!-- buttons -->

            <div class="bj-tr-btn">
              <button class="orange_btn" type="reset"><i class="fas fa-redo"></i> Reset</button>
              <button class="interview-tag used-tag"><i class="fas fa-paper-plane"></i>Submit</button>
            </div>
         <!-- buttons -->
         {{ Form::close() }}
          </div>
 <div class="d-"></div>



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
                <div class="filter_industryList ">
                        @php
                                $industries = getIndustries();
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

            <!-- Modal -->

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
                        <div class="location_search_cont ">
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
