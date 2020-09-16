

 <div class="mJSFilter mb-2">
  {{ Form::open(array('url' => url()->current(), 'method' => 'get', 'id' => 'filter_form' )) }}
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
        <div class="card-header rgba-stylish-strong z-depth-1 mb-1" role="tab" id="heading1">
          <a data-toggle="collapse" data-parent="#accordionEx7" href="#collapse1" aria-expanded="true"
            aria-controls="collapse1">
            <h5 class="mb-0 white-text font-thin" id="filter">Filters <i class="fas fa-angle-down rotate-icon"></i></h5>
          </a>
        </div>

        <!-- Card body -->
        <div id="collapse1" class="collapse" role="tabpanel" aria-labelledby="heading1"
          data-parent="#accordionEx7">
          <div class="p-2 card-body mb-1 rgba-grey-light white-text FilterCont">

            <div class="FilterBox">
																<div class="form-group md-form"> <!-- left unspecified, .bmd-form-group will be automatically added (inspect the code) -->
																	<input type="text" name="filter_keyword" class="form-control" style="color:white;" placeholder="Keyword">
															 </div>

																<div class="form-group">
																	<select name="filter_jobType" class="white-text mdb-select md-form" data-placeholder="Select Job Type">
																					<option value="" >Select Job Type</option>
																					<option value="contract">Contract</option>
																					<option value="temporary">Temporary</option>
																					<option value="casual">Casual</option>
																					<option value="part_time">Part Time</option>
																					<option value="full_time">Full Time</option>
																	</select>
																</div>






            {{-- Salary Range --}}

            <div class="FilterBox">
                <select class="white-text mdb-select md-form colorful-select dropdown-primary filter_qualification_type" name="filter_salary" data-placeholder="Select Salary Range">
                <option value="">Select Salary Range</option>
                @foreach(getSalariesRange() as $sk => $salary)
                    <option value="{{$sk}}">{{$salary}}</option>
                @endforeach
                </select>
            </div>
            {{-- Salary Range --}}
            {{-- Location  --}}
            <div class="FilterBox FilterLocation">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input filter_showDetail" id="filter_location_status" name="filter_location_status" data-dc="FilterLocationBox">
                    <label class="form-check-label" for="filter_location_status">Filter by Location</label>
                </div>
                <div class="FilterLocationBox d-none col">
                  {{-- bl_location --}}
                    <div class="location_search_cont row">
                        <div class="col-10 pl-0 md-form form-sm">
                          {{-- <input type="text" name="location_search" class="inp" id="location_search" value="" aria-invalid="false"> --}}
                          <input type="text" name="location_search" id="location_search" class="form-control form-control-sm white-text"  placeholder="Type a location">

                        </div>
                        <div class="col-2 p-0">
                            <select class="white-text mdb-select md-form filter_location_radius" name="filter_location_radius" data-placeholder="Select Location Radius">
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
                    <div class="location_map_box dtable w100"><div class="location_map" id="location_map"></div></div>
                    </div>
                {{-- bl_location --}}
                </div>
            </div>
            {{-- Location  --}}



													<div class="FilterBox my-2">
														<div class="text-center">
															<button name="ResetForm" data-toggle="collapse" data-target="#collapse1" class="btn waves-effect waves-light reset-btn" id="ResetForm" type="button">Reset</button>
															<button name="CreateConfig" data-toggle="collapse" data-target="#collapse1" class="btn waves-effect waves-light " id="CreateConfig" type="submit">Submit</button>
														</div>
												</div>


            </div>
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





