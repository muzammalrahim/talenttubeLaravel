 

 <div class="mJSFilter mb-2">
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
        <div class="card-header rgba-stylish-strong z-depth-1 mb-1" role="tab" id="heading1">
          <a data-toggle="collapse" data-parent="#accordionEx7" href="#collapse1" aria-expanded="true"
            aria-controls="collapse1">
            <h5 class="mb-0 white-text font-thin">Filters <i class="fas fa-angle-down rotate-icon"></i></h5>
          </a>
        </div>

        <!-- Card body -->
        <div id="collapse1" class="collapse" role="tabpanel" aria-labelledby="heading1"
          data-parent="#accordionEx7">
          <div class="p-2 card-body mb-1 rgba-grey-light white-text FilterCont">
            
            <div class="FilterBox">
                <select class="white-text mdb-select md-form colorful-select dropdown-primary filter_qualification_type" name="filter_qualification_type" data-placeholder="Select Qalification & Trades">
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
                    <select class="white-text mdb-select md-form qualification_degree" multiple name="qualification_degree[]" data-placeholder="Select Degree">
                        @foreach ($qualifications as $qualif)
                            @if($qualif['type']  == 'degree')
                              <option value="{{$qualif['id']}}">{{$qualif['title']}}</option>
                            @endif
                        @endforeach
                    </select>
                 {{-- <label class="mdb-main-label">Example label</label> --}}
                </div>
 
                <div class="qualification_trade d-none">
                    <select class="white-text mdb-select md-form qualification_trade" multiple name="qualification_trade[]" data-placeholder="Select Trade">
                        @foreach ($qualifications as $qualif)
                            @if($qualif['type']  !== 'degree')
                              <option value="{{$qualif['id']}}">{{$qualif['title']}}</option>
                            @endif
                        @endforeach
                    </select>
                 {{-- <label class="mdb-main-label">Example label</label> --}}
                </div>
                @endif

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



             {{-- Industry Experience --}}
            <div class="FilterBox FilterIndustry">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input filter_showDetail" id="filter_industry_status" name="filter_industry_status" data-dc="FilterIndustryList">
                    <label class="form-check-label" for="filter_industry_status">Filter by Industry</label>
                </div>
                <div class="FilterIndustryList d-none">
                @php 
                    $industries = getIndustries()
                @endphp
                @if(!empty($industries))
                    <div class="filter_industries_list ">
                            @foreach ($industries as $indK => $indV)
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="industry_{{$indK}}">
                                    <label class="form-check-label" for="industry_{{$indK}}">{{$indV}}</label>
                                </div>
                            @endforeach
                    </div>
                @endif
                </div>
            </div>
            {{-- Industry Experience --}}




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
                    {{-- <div class="location_map_box dtable w100"><div class="location_map" id="location_map"></div></div> --}}
                    </div>
                {{-- bl_location --}}      
                </div>
            </div>
            {{-- Location  --}}



            {{-- Question  --}}
             <div class="FilterBox FilterLocation">
                 <div class="form-check">
                    <input type="checkbox" class="form-check-input filter_showDetail" id="filter_by_questions" name="filter_by_questions" data-dc="FilterQuestionBox">
                    <label class="form-check-label" for="filter_by_questions">Filter by Question</label>
                </div>
                <div class="FilterQuestionBox d-none col">
                   
                    <div class="row">
                @if(!empty(getUserRegisterQuestions()))

                    <div class="col-12 p-0">
                        <select class="white-text mdb-select md-form filter_question" name="filter_question">
                            @foreach (getUserRegisterQuestions() as $qk => $question)
                                <option value="{{$qk}}">{{$question}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-4 p-0">
                        <select class="white-text mdb-select md-form filter_question_value"  name="filter_question_value">
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div> 


                @endif
</div>
                </div>
             </div>


            {{-- Question  --}}


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

  

 

 