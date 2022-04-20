{{-- <div class="job_row_heading jobs_filter mb20">
   <div class="job_applications_filter ">
      {{ Form::open(array('url' => url()->current(), 'method' => 'get', 'id' => 'filter_form' )) }}
      <input type="hidden" name="page" id="paginate" value="">
      <div class="searchField_keyword dblock mb10">
         <div class="searchFieldLabel dinline_block">Keyword: </div>
         <input type="text" name="filter_keyword" style="margin-left: 53px;">
      </div>
      <div class="searchField_salaryRange dblock mb10">
         <div class="searchFieldLabel dinline_block" style="margin-right:25px">Salary Range: </div>
         <select name="filter_salary" id="filter_salary" class="dinline_block select_aw" data-placeholder="Select Salary Range">
            <option value="">Select Salary Range</option>
            @foreach(getSalariesRange() as $sk => $salary)
            <option value="{{$sk}}">{{$salary}}</option>
            @endforeach
         </select>
      </div>
      <div class="searchField_JobType dblock mb10">
         <div class="searchFieldLabel dinline_block" style="margin-right:50px">Job Type: </div>
         <select name="filter_jobType" id="filter_jobType" class="dinline_block select_aw" data-placeholder="Select Job Type">
            <option value="">Select Job Type</option>
            <option value="contract">Contract</option>
            <option value="temporary">Temporary</option>
            <option value="casual">Casual</option>
            <option value="part_time">Part Time</option>
            <option value="full_time">Full Time</option>
         </select>
      </div>
      <div class="searchField_industry mb10">
         <div class="searchFieldLabel dinline_block">Filter by Industry: </div>
         <div class="toggleSwitchButton dinline_block"><label class="switch"><input type="checkbox" name="filter_industry_status"></label></div>
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

      </div>
      <div class="searchField_location mb10">
         <div class="searchFieldLabel dinline_block">Filter by Location: </div>
         <div class="search_location_status_cont toggleSwitchButton">
            <label class="switch"><input type="checkbox" name="filter_location_status"></label>
         </div>
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
            </div>
            <div class="location_map_box dtable w100">
               <div class="location_map" id="location_map"></div>
            </div>
         </div>
      </div>
      <div class="searchField_action">
         <div class="searchFieldLabel dinline_block"></div>
         <button class="btn small OrangeBtn">Submit</button>
         <button class="btn small OrangeBtn reset-btn">Rest</button>
      </div>
      {{ Form::close() }}
   </div>
</div>  --}}
{{-- html for browse job form --}}
<div class="bj-main">
   <div class="filter-section">
      {{ Form::open(array('url' => url()->current(), 'method' => 'get', 'id' => 'filter_form' )) }}
      <input type="hidden" name="page" id="paginate" value="">
      <div class="row b-filter-row" style="align-items: center;">
         <div class="col-md-4">
            <div class="row browse-mp" style="align-items: center;">
               <div class="col-lg-3 col-md-12 col-sm-12">
                  <h5 class="browse-heading">Keyword:</h5>
               </div>
               <div class="col-lg-9 col-md-12 col-sm-12">
                  <div class="input-group">
                     <input type="text" class="form-control" name="filter_keyword" placeholder=""
                        aria-label="Recipient's username">
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-4">
            <div class="row browse-mp" style="align-items: center;">
               <div class="col-lg-5 col-md-12 col-sm-12">
                  <h5 class="browse-heading">Salary Range:</h5>
               </div>
               <div class="col-lg-7 col-md-12 col-sm-12">
                     <div class="form-group">
                        <select name="filter_salary" class="b-select form-control icon_show" id="filter_salary" aria-label="Default select example" data-placeholder="Select Salary Range">
                           <option value="">Select Salary Range</option>
                           @foreach(getSalariesRange() as $sk => $salary)
                           <option value="{{$sk}}">{{$salary}}</option>
                           @endforeach
                        </select>
                     </div>
               </div>
            </div>
         </div>

         <div class="col-md-4">
            <div class="row browse-mp" style="align-items: center;">
               <div class="col-lg-5 col-md-12 col-sm-12">
                  <h5 class="browse-heading">Job Type:</h5>
               </div>
               <div class="col-lg-7 col-md-12 col-sm-12">
                     <div class="form-group">
                        <select name="filter_jobType" class="b-select form-control icon_show" id="filter_jobType" aria-label="Default select example"  data-placeholder="Select Job Type">
                           <option value="">Select Job Type</option>
                           <option value="contract">Contract</option>
                           <option value="temporary">Temporary</option>
                           <option value="casual">Casual</option>
                           <option value="part_time">Part Time</option>
                           <option value="full_time">Full Time</option>
                        </select>
                     </div>
               </div>
            </div>
         </div>
      </div>

      <div class="row b-filter-row mt-3">
         <div class="col-md-12 browse-mp">
            <div class="row">
               <div class="col-md-3 col-sm-12">
                  <h5 class="browse-heading">Filter by Industry:</h5>
               </div>

               <div class="col-md-1 col-sm-2 col-2 custom-checkbox">
                  <input type="checkbox" name="filter_industry_status" class="">
               </div>

               <div class="col-md-8 col-sm-12">
                  {{-- <div class="indusDiv d-none"> --}}
                     <select name="filter_industry[]" multiple="multiple" id="filter_industry" placeholder = "Filter by Job" class="multi-select form-control custom-select">         
                        @php
                           $industries = getIndustries()
                        @endphp
                        @if(!empty($industries))

                        <div class="filter_industries_list">
                              @foreach ($industries as $indK => $indV)
                              <option class="" value="{{$indK}}" data-id="{{$indK}}"><span>{{$indV}}</span></option>
                              @endforeach
                        </div>
                        @endif
                      </select>
                  {{-- </div> --}}
               </div>
            </div>
         </div>
      </div>
      
      <div class="row b-filter-row mt-3">
         <div class="col-md-12">
            <div class="row">
               <div class="col-md-3 col-sm-12 b-mob-pad">
                  <h5 class="browse-heading">Filter by Location:</h5>
               </div>
               
               <div class="col-1 custom-checkbox">  
                  <input type="checkbox" class="" name="filter_location_status">
               </div>
               <div class="FilterLocationBox col">
                    <div class="location_search_cont row hide_it">
                        <div class="col-8 col-sm-9">
                          <input type="text" name="location_search" id="location_search" class="form-control form-control-sm white-text"  placeholder="Type a location">

                        </div>
                        <div class="col-4 col-sm-3">
                            <select class="white-text bg-white icon_show filter_location_radius form-control mb-1" name="filter_location_radius" data-placeholder="Select Location Radius">
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
                </div>

            </div>
         </div>
      </div>

      <div class="bj-tr-btn">
         <button class="orange_btn" type="reset"><i class="fas fa-redo"></i> Reset</button>
         <button class="interview-tag used-tag" type="submit"><i class="fas fa-paper-plane"></i>Submit</button>
      </div>

      {{ Form::close() }}

   </div>
</div>

<script type="text/javascript">
   
$(document).ready(function() {
    $('#filter_industry').select2();
    // allowClear: true,
    placeholder: "Leave blank to ..."
});


</script>