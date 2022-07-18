<div class="employer-main">
   <h2>Job Seekers List</h2>
   {{ Form::open(array('url' => url()->current(), 'method' => 'get', 'id' => 'jobSeeker_filter_form' )) }}
   <input type="hidden" name="page" id="paginate" value="">
   <!-- Top Filter Row -->
   <div class="employee-wraper">
      <div class="emp-t-row">
         <div class="row b-filter-row top-filter-row">
            <div class="row ">   
               <div class="col-md-6 col-sm-6">
                  <div class="input-employee clearfix">

                     <div class="row">
                        <label class="col-12 col-sm-4 browse-heading">Keyword:</label>
                        <input type="text" class="form-control col-12 col-sm-8 ml-3 ml-sm-0" name="filter_keyword">

                     </div>
                  </div>
               </div>
               <div class="col-md-6 col-sm-6">
                  <div class="input-employee clearfix">

                     <div class="row">
                        <label class="col-12 col-sm-4 browse-heading">Salary:</label>

                        {{-- <input type="text" class="form-control col-md-8" name="filter_salary" aria-label="Recipient's username"> --}}
                        <select name="filter_salary" class="form-control col-sm-8 col-12 ml-3 ml-sm-0 bg-white icon_show" id="filter_salary" data-placeholder="Select Salary Range">
                           <option value="">Select Salary Range</option>
                           @foreach(getSalariesRange() as $sk => $salary)
                               <option value="{{$sk}}">{{$salary}}</option>
                           @endforeach
                       </select>
                     </div>
                  </div>
               </div>
            </div>


            {{-- ============================================ Filter by Resume ============================================ --}}
            <div class="row b-filter-row -lg-3">
            
               <div class="col-md-12">
                  <div class="row">
                     <div class="searchField_resume col-md-6 col-sm-6 clearfix">
                        {{-- <div class="searchFieldLabel">Filter by Resume: </div> --}}
                        <div class="row">
                           <label class="col-12 col-sm-4 browse-heading">Resume:</label>
                           {{-- <div class="col-md-1 col-sm-2 col-2 custom-checkbox mt-1">
                              <input type="checkbox" name="filter_by_resume" class="">
                           </div> --}}

                           {{-- <div class="filter_resume_cont"> --}}
                           <input type="text" name="filter_by_resume_value" class="filter_by_resume_value form-control col-12 col-sm-8 ml-3 ml-sm-0">
                           {{-- </div> --}}
                        </div>
                     </div>


                     {{-- ============================================ Filter by Age Group ============================================ --}}

                     <div class="searchField_resume col-md-6 col-sm-6 clearfix">
                        <div class="row">
                           <label class="col-12 col-sm-4 browse-heading">Age Group:</label>

                              <select name="filter_by_age_val" class="form-control col-12 col-sm-8 ml-3 ml-sm-0 bg-white icon_show" id="filterAgeGroup">
                                 <option value="">Select Age Group</option>
                                 <option value="18-25">18-25</option>
                                 <option value="25-30">25-30</option>
                                 <option value="30-40">30-40</option>
                                 <option value="40-54">40-54</option>
                                 <option value="55+">55+</option>
                              </select>
                        </div>

                     </div>
                  
                  </div>
               </div>
            </div>

           
            {{-- ================================== Filter by Qualification ================================== --}}
            
            <div class="row b-filter-row mt-3">
               <div class="col-md-12 browse-mp">
                  <div class="row">
                     <div class="col-md-6 col-12 clearfix">
                        <div class="row">
                            <div class=" col-12 col-sm-4 mt-1">
                              <h5 class="browse-heading">Qualification:</h5>
                           </div>

                           <div class=" col-12 col-sm-8 ml-3 ml-sm-0 p-0">
                              <select class="dinline_block filter_qualification_type js-select form-control icon_show bg-white" onchange="showQualificationSelect2()" name="filter_qualification_type" data-placeholder="Select Qalification & Trades">
                                 <option value="">Select Qalification & Trades</option>
                                 <option value="certificate">Certificate or Advanced Diploma</option>
                                 <option value="trade">Trade Certificate</option>
                                 <option value="degree">University Degree</option>
                                 <option value="post_degree">University Post Graduate (Masters or PHD)</option>
                              </select>

                              <i class="fa fa-angle-down dropdownSelect2" style="opacity:0"></i>

                              @php
                                 $qualifications = getQualificationsList();
                              @endphp
                              @if(!empty($qualifications))
                                 <div class="filter_qualificaton_degree mt-3 mb-sm-3" style="opacity:0">
                                    <select name="filter_qualification[]" multiple="multiple" id="filter_by_qualification"
                                     placeholder = "Filter by Job" class="multi-select form-control icon_show custom-select" style="width:100%">
                                       @foreach ($qualifications as $qualif)
                                          <option class="d-none" value="{{$qualif['id']}}" data-id="{{$qualif['id']}}" ><span>{{$qualif['title']}}</span></option>
                                       @endforeach
                                    </select>

                                    
                                 </div>
                              @endif
                           </div>
                        </div>
                     </div>

                     
                     {{-- ================================== Filter by Industry ================================== --}}
                     <div class="col-md-6 col-12">
                        <div class="row">
                           <div class=" col-12 col-sm-3 col-lg-3  mt-1">
                              <h5 class="browse-heading">Industry:</h5>
                           </div>
                           <div class=" col-2 col-sm-1 col-lg-1 custom-checkbox mt-1">
                              <input type="checkbox" name="filter_industry_status" checked class="">
                           </div>
                           <div class=" col-10 col-sm-7 col-lg-8 filter_industryDiv">

                              <select name="filter_industry[]" multiple="multiple" id="filter_industry" placeholder = "Filter by Job" class="multi-select form-control custom-select" style="width:96%">
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

                              <i class="fa fa-angle-down dropdownSelect3 position-absolute"></i>

                                 {{-- 
                                    </div>
                                 --}}
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>      


            {{-- ============================================ Filter by User Tags ============================================ --}}
            <div class="row b-filter-row mt-4 mt-lg-3">
               <div class="col-md-12">
                  <div class="row">
                     <div class="col-md-6 pb-4 pb-lg-none col-12">
                        <div class="row">
                           <label  class="col-12 col-sm-3 col-lg-3 browse-heading">
                              User Tags:
                           </label>
                           {{-- <input type="checkbox" name="filter_tags_status" class=""> --}}
                           <div class="col-2 col-sm-1 col-lg-1 custom-checkbox mt-1">
                              <input type="checkbox" name="filter_tags_status" checked class="filter_tags_status">
                           </div>
                           @if(!empty($tags))
                           <div class="filter_tagList col-10 col-sm-7 col-lg-8">

                              <select name="filter_tags[]" multiple="multiple" id="filter_by_usertaga" placeholder = "Filter by Job" class="multi-select form-control custom-select" style="width: 96%">
                                 @foreach ($tags as $tag => $tagVal)
                                 <option class="" value="{{$tagVal->id}}"><span>{{$tagVal->title}}</span></option>
                                 @endforeach


                              </select>
                               <i class="fa fa-angle-down dropdownSelect3 position-absolute"></i>
                              </div>
                           @endif
                        </div>
                     </div>


                     {{-- ============================================ Filter by Gender ============================================ --}}
                      <div class="col-md-6 col-12">
                        <div class="row">
                           <label class="col-12 col-sm-3 col-lg-3 browse-heading">Gender:</label>
                              {{-- <input type="checkbox" name="filter_tags_status" class=""> --}}
                           <div class="col-2 col-sm-1 col-lg-1 custom-checkbox mt-1">
                              <input type="checkbox" name="filter_by_gender" checked class="filter_by_gender">
                           </div>
                           {{-- @if(!empty($tags)) --}}
                           <div class="filter_gender_cont col-10 col-sm-7 col-lg-8">
                              <select name="filter_by_gender_val" id="filterAgeGroup" placeholder = "Filter by Job" class="form-control icon_show bg-white" style="width: 96%;">
                                 <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                 </select>
                           </div>
                           {{-- @endif --}}
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            {{-- ============================================ Filter by Questions ============================================ --}}
            <div class="row b-filter-row  mt-3">
               <div class="col-md-12 browse-mp">
                  <div class="row">
                     <div class="col-md-6 pb-4 pb-sm-none pb-lg-none col-12">
                        <div class="row">
                           <label  class="col-12 col-sm-3 col-lg-3 browse-heading">
                              Questions:
                           </label>
                           <div class="col-2 col-sm-1 col-lg-1 custom-checkbox mt-1">  
                              <input type="checkbox" class="" name="filter_by_questions">
                           </div>
                           <div class=" col-10 col-sm-7 col-lg-8">
                              <div class="input-employee clearfix filter_question_cont hide_it">
                                 @if(!empty(getUserRegisterQuestions()))
                                 <select type="text" class="form-control bg-white icon_show " name="filter_question" aria-label="Recipient's username" style="width: 96%;">
                                    @foreach (getUserRegisterQuestions() as $qk => $question)
                                    <option value="{{$qk}}">{{$question}}</option>
                                    @endforeach
                                 </select>
                                 @endif
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-12 col-md-6">
                        <div class="row">
                           <div class="col-12 col-sm-6 filter_question_cont hide_it">
                              <ul class="question-radiobtn">
                                 <li>
                                    <div class="form-check emp-redio p-0">
                                       <input type="radio" id="test1" name="filter_question_value" value="yes" checked>
                                       <label for="test1">Yes</label>
                                    </div>
                                 </li>
                                 <li>
                                    <div class="form-check emp-redio p-0 p-md-2">
                                       <input type="radio" id="test2" value="no" name="filter_question_value">
                                       <label for="test2">No</label>
                                    </div>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>            

            {{-- ============================================ Filter by Location ============================================ --}}
            <div class="row b-filter-row  mt-3">
               <div class="col-md-12 browse-mp">
                  <div class="row">
                     <div class="col-12 col-md-10">
                       <div class="row">
                           <div class=" col-3 col-sm-2 mt-1 b-mob-pad">
                              <h5 class="browse-heading">Location:</h5>
                           </div>
                           <div class="col-2 col-sm-1 custom-checkbox pl-sm-0">  
                              <input type="checkbox" class="" name="filter_location_status">
                           </div>
                           <div class="FilterLocationBox col-sm-9 pe-0 pt-3 pt-sm-0">
                              <div class="location_search_cont row hide_it">
                                 <div class="col-9 md-form form-sm">
                                    <input type="text" name="location_search" id="location_search" class="form-control form-control-sm white-text"  placeholder="Type a location">
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
                                 <div class="location_latlong dtable w100">
                                    <input type="hidden" class="location_lat w50 fl_left" name="location_lat" id="location_lat" value="" placeholder="Lat" readonly="true" aria-invalid="false">
                                    <input type="hidden" class="location_long w50 fl_left" name="location_long" id="location_long" value="" placeholder="Long" readonly="true" aria-invalid="false">
                                    <input type="hidden" name="location_name" id="location_name"  value="">
                                    <input type="hidden" name="location_city" id="location_city"  value="">
                                    <input type="hidden" name="location_state" id="location_state"  value="">
                                    <input type="hidden" name="location_country" id="location_country"  value="">
                                 </div>
                                 <div class="location_map_box dtable w100">
                                    <div class="location_map" id="location_map"></div>
                                 </div>
                              </div>
                           </div>
                       </div>
                     </div>
                  </div>  
               </div>
            </div>
         </div>  
      </div>
   </div>
   <!-- buttons -->
   <div class="bj-tr-btn">
      <button class="orange_btn reset-btn" type="reset" id="btnReset"><i class="fas fa-redo"></i> Reset</button>
      <button class="interview-tag used-tag"><i class="fas fa-paper-plane"></i>Submit</button>
   </div>
   <!-- buttons -->
   {{ Form::close() }}
</div>
<div class="d-"></div>


<script type="text/javascript"> 

$(document).ready(function() {
   $('#filter_industry').select2({
      
      allowClear: true

   });

   $('#filter_by_qualification').select2({
      allowClear: true

   });
   $('#filter_by_usertaga').select2({
      allowClear: true

   });


    $(function () {
        $("#btnReset").bind("click", function () {
            $("#filterAgeGroup")[0].selectedIndex = 0;
        });
    });


   // allowClear: true,
   placeholder: "Leave blank to ..."


   this.showQualificationSelect2 = function(){
      // console.log('on change qualification');
      var selected = $('.filter_qualification_type option:selected').val();
      // console.log(selected);
      if (selected != '') {
         $('.filter_qualificaton_degree').css('opacity', '1');
         $('.dropdownSelect2').css('opacity', '1');
      }
      else{
         $('.filter_qualificaton_degree').css('opacity', '0');
         $('.dropdownSelect2').css('opacity', '0');
         $("#filter_by_qualification").val('').trigger('change');

      }
   }

});
 
</script>
