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
																<select class="dinline_block filter_location_radius select_aw p-0" name="filter_location_radius" data-placeholder="Select Location Radius">
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
            <div class="col-md-12 col-sm-12">
               <div class="input-employee clearfix">
               	<div class="row pt-2">
	                  {{-- <label class="col-md-4">Keyword:</label> --}}
                  	<h5 class="col-md-4 col-4 pt-2 browse-heading">Keyword:</h5>

	                  <input type="text" class="form-control col-md-7 col-7" name="filter_keyword" aria-label="Recipient's username">
               	</div>
               </div>
            </div>
            <div class="row b-filter-row">
               <div class="col-md-12 browse-mp">
                  <div class="row">
                     <div class="col-md-3 col-6">
                        <h5 class="browse-heading">Filter by Industry:</h5>
                     </div>
                     <div class="col-md-1 col-sm-2 col-2 custom-checkbox">
                        <input type="checkbox" name="filter_industry_status" class="">
                     </div>
                     <div class="col-md-8 col-12">
                        {{-- 
                        <div class="indusDiv d-none">
                           --}}
                           <select name="filter_industry[]" multiple="multiple" id="filter_industry" placeholder = "Filter by Job" class="multi-select form-control custom-select w-100" >
                              @php
                              $industries = getIndustries()
                              @endphp
                              @if(!empty($industries))
                              <div class="filter_industries_list">
                                 @foreach ($industries as $indK => $indV)
                                 <option class="" value="{{$indK}}" data-id="{{$indK}}"><span style="width:100%;">{{$indV}}</span></option>
                                 @endforeach
                              </div>
                              @endif
                           </select>
                           {{-- 
                        </div>
                        --}}
                     </div>
                  </div>
               </div>
            </div>


            <div class="row b-filter-row mt-md-3">
               <div class="col-md-12">
                  <div class="row">
                     <div class="col-md-3 col-sm-12 mt-1 b-mob-pad">
                        <h5 class="browse-heading">Filter by Location:</h5>
                     </div>
                     <div class="col-1 custom-checkbox mt-1">  
                        <input type="checkbox" checked class="" name="filter_location_status">
                     </div>
                     <div class="FilterLocationBox col">
                        <div class="location_search_cont row">
                           <div class="col-8 col-sm-9">
                              <input type="text" name="location_search" id="location_search" class="form-control form-control-sm white-text"  placeholder="Type a location">
                           </div>

                           <div class="col-2 p-0">
                              <select class="white-text mdb-select md-form filter_location_radius custom-select" name="filter_location_radius" data-placeholder="Select Location Radius">

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

            <div class="row b-filter-row mt-3">
              {{-- <div class="col-12"> --}}
                <div class="col-md-3 col-sm-12 mt-1 b-mob-pad">
                  <h5 class="browse-heading">Filter by Questions:</h5>
               </div>

               <div class="col-1 custom-checkbox mt-1">  
                  <input type="checkbox" class="" name="filter_by_questions">
               </div>
                <div class="col-md-6">
                   <div class="input-employee clearfix">
                      @if(!empty(getUserRegisterQuestions()))
                      <select type="text" class="w-100 bg-white" name="filter_question" aria-label="Recipient's username">
                         @foreach (getUserRegisterQuestions() as $qk => $question)
                         <option value="{{$qk}}">{{$question}}</option>
                         @endforeach
                      </select>
                      @endif
                   </div>
                </div>
                <div class="col-md-2">
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
            {{-- </div>   --}}
           </div>
         </div>
         <!-- row 2 -->
         
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


<script type="text/javascript"> 

  $(document).ready(function() {
    $('#filter_industry').select2();
    // allowClear: true,
    placeholder: "Leave blank to ..."
});
 
</script>