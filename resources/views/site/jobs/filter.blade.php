
 

<div class="job_row_heading jobs_filter mb20">
<div class="job_applications_filter ">

    {{ Form::open(array('url' => url()->current(), 'method' => 'get', 'id' => 'filter_form' )) }}
    <input type="hidden" name="page" id="paginate" value="">
    
    <div class="searchField_keyword dblock mb10">
        <div class="searchFieldLabel dinline_block">Keyword: </div>
        <input type="text" name="filter_keyword">
    </div>

    <div class="searchField_salaryRange dblock mb10">
        <div class="searchFieldLabel dinline_block">Salary Range: </div>
        <select name="filter_salary" class="dinline_block select_aw" data-placeholder="Select Salary Range">
             <option value="">Select Salary Range</option>
            @foreach(getSalariesRange() as $sk => $salary)
                <option value="{{$sk}}">{{$salary}}</option>
            @endforeach
        </select>
    </div>

    <div class="searchField_JobType dblock mb10">
        <div class="searchFieldLabel dinline_block">Job Type: </div>
        <select name="filter_jobType" class="dinline_block select_aw" data-placeholder="Select Job Type">
            <option value="">Select Job Type</option>
            <option value="contract">Contract</option>
            <option value="temporary">Temporary</option>
            <option value="casual">Casual</option>
            <option value="part_time">Part Time</option>
            <option value="full_time">Full Time</option>
        </select>
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
            <div class="location_map_box dtable w100"><div class="location_map" id="location_map"></div></div>
        </div>
    </div>


    <div class="searchField_action">
        <div class="searchFieldLabel dinline_block"></div>
        <button class="btn small OrangeBtn">Submit</button>
    </div>

    {{ Form::close() }}
</div>
</div>

