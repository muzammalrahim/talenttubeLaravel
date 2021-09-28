
@extends('site.employer.employermaster')

@section('custom_css')
{{-- <link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}"> --}}
{{-- <link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}"> --}}
@stop

@section('content')
{{-- <div class="newJobCont">
    <div class="head icon_head_browse_matches">Browse Jobs</div>

    <div class="add_new_job"> --}}

        <!-- =============================================================================================================================== -->
       {{--  @include('site.jobs.filter') --}}
        <!-- =============================================================================================================================== -->
      {{--   @include("site.spinner") --}}
        <!-- =============================================================================================================================== -->
        {{--  <div class="jobs_list"> --}}
            {{-- @include('site.jobs.list') --}} {{-- site/jobs/list --}}
         {{-- </div> --}}
        <!-- =============================================================================================================================== -->

{{--     </div>

<div class="cl"></div>
</div>


<div style="display: none;">
<div id="jobApplyModal" class="modal p0 jobApplyModal wauto">
    <div id="job_apply_modal" class="w100 pp_edit_info pp_cont m0">
        <div class="frame">
            <a class="icon_close" href="#close"><span class="close_hover"></span></a>
            <div class="head m0">Submit Proposal</div>
            <input type="hidden" value="" name="openModalJobId" id="openModalJobId" />
            <div class="cont">
                <div class="css_loader loader_edit_popup">
                    <div class="spinner center">
                        <div class="spinner-blade"></div>
                        <div class="spinner-blade"></div>
                        <div class="spinner-blade"></div>
                        <div class="spinner-blade"></div>
                        <div class="spinner-blade"></div>
                        <div class="spinner-blade"></div>
                        <div class="spinner-blade"></div>
                        <div class="spinner-blade"></div>
                        <div class="spinner-blade"></div>
                        <div class="spinner-blade"></div>
                        <div class="spinner-blade"></div>
                        <div class="spinner-blade"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div> --}}

{{-- ============================================================html for browse jobs================================================ --}}
  <section class="row">
                <div class="col-md-12 browse-job-main">
                  <div class="profile profile-section">
                    <h2>Browse Jobs</h2>

                    <div class="bj-main">
                      <!-- Top Filter Row -->

                      <div class="filter-section">
                        <div class="row b-filter-row" style="align-items: center;">

                          <div class="col-md-4">
                            <div class="row browse-mp" style="align-items: center;">
                              <div class="col-lg-4 col-md-12 col-sm-12">
                                <h5 class="browse-heading">Keyword:</h5>
                              </div>
                              <div class="col-lg-8 col-md-12 col-sm-12">
                                <div class="input-group">
                                  <input type="text" class="form-control" placeholder=""
                                    aria-label="Recipient's username">
                                </div>
                              </div>
                            </div>
                          </div>
  
  
                          <div class="col-md-4">
                            <div class="row browse-mp" style="align-items: center;">
                              <div class="col-lg-4 col-md-12 col-sm-12">
                                <h5 class="browse-heading">Salary Range:</h5>
                              </div>
                              <div class="col-lg-8 col-md-12 col-sm-12">
                                <form action="">
                                  <div class="form-group">
                                    <select class="form-select b-select" aria-label="Default select example">
                                      <option selected>please select salary range</option>
                                      <option value="1">One</option>
                                      <option value="2">Two</option>
                                      <option value="3">Three</option>
                                    </select>
  
                                  </div>
                                </form>
                              </div>
  
                            </div>
                          </div>
  
                          <div class="col-md-4">
                            <div class="row browse-mp" style="align-items: center;">
                              <div class="col-lg-4 col-md-12 col-sm-12">
                                <h5 class="browse-heading">Job Type:</h5>
                              </div>
                              <div class="col-lg-8 col-md-12 col-sm-12">
                                <form action="">
                                  <div class="form-group">
                                    <select class="form-select b-select" aria-label="Default select example">
                                      <option selected> Please select job type</option>
                                      <option value="1">One</option>
                                      <option value="2">Two</option>
                                      <option value="3">Three</option>
                                    </select>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- Top Filter Row -->
  
  
                        <!-- Adress + Location -->
                        <div class="row b-filter-row mt-3" style="align-items: center;">
                          <div class="col-md-6 browse-mp">
                            <div class="row" style="align-items: center;">
                              <div class="col-md-3 col-sm-12">
                                <h5 class="browse-heading">Filter by Industry:</h5>
                              </div>
                              <div class="col-md-9 col-sm-12">
                                <!-- Button trigger modal -->
                                <a data-toggle="modal" data-target="#myModal">
                                  <div class="input-group">
                                    <input type="text" class="form-control" placeholder="">
                                    <div class="input-group-append">
                                      <img class="bs-img" src="assests/images/l-search.png" alt="img">
                                    </div>
                                  </div>
                                </a>
                                <!-- Button trigger modal -->
  
                               
                              </div>
                            </div>
  
                          </div>
                          <div class="col-md-6">
                            <div class="row" style="align-items: center;">
                              <div class="col-md-3 col-sm-12 b-mob-pad">
                                <h5 class="browse-heading">Filter by Location:</h5>
                              </div>
                              <div class="col-md-9 col-sm-12">
                                <!-- Button trigger modal -->
                                <a data-toggle="modal" data-target="#myModal2">
                                  <div class="input-group location-filter" style="position: relative;">
                                    <input type="text" class="form-control main-input"
                                      placeholder="Sydney, New South Wales, Australia">
                                    <div class="loc-icon">
                                      <img src="assests/images/location.png" alt="">
  
                                    </div>
                                  </div>
                                </a>
                                <!-- Button trigger modal -->
  
                                
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Adress + Location -->

                      <!-- buttons -->
                      <div class="bj-tr-btn">
                        <button class="orange_btn" type="reset"><i class="fas fa-redo"></i> Reset</button>
                        <button class="interview-tag used-tag"><i class="fas fa-paper-plane"></i>Submit</button>
                      </div>
                      <!-- buttons -->
                    </div>

                    <!-- Job Detail Area -->

                    <div class="row">
                      <div class="col-sm-12 col-md-6">

                        <div class="job-box-info">
                          <div class="box-head">
                            <h4>
                              Social Media Officer (remote role)
                            </h4>
                            <!-- <label>Location:<span> Alexandria, New South Wales, Australia</span></label> -->
                            <i class="close-box fa fa-times"></i>
                          </div>
                          <div class="job-box-text clearfix">

                            <div class="text-info-detail clearfix">
                              <label>Job Type:</label>
                              <span>Senior Designer</span>
                            </div>
                            <div class="text-info-detail clearfix">
                              <label>Job Experience:</label>
                              <span>3 year</span>
                            </div>
                            <div class="text-info-detail clearfix">
                              <label>Job Salary:</label>
                              <span>$500/-</span>
                            </div>
                            <div class="text-info-detail clearfix">
                              <label>Submitted:</label>
                              <span>20-12-2012</span>
                            </div>
                            <div class="text-info-detail clearfix">
                              <label>Job Detailed:</label>
                              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                Lorem Ipsum is simply dummy text of the printing Lorem Ipsum is simply dummy text of the
                                printing and typesetting industry. and typesetting industry. </p>
                            </div>
                          </div>
                          <div class="bc-footer">
                            <div class="row">
                              <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                                <div class="b-heading">
                                  <h4> Code: 941813</h4>
                                </div>
                              </div>

                              <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                                <div class="b-card-btn">
                                  <button type="button" class="orange_btn"> <i class="fas fa-file-alt"></i> Detail</button>
                                  <button data-toggle="modal" data-target="#myModal9" class="interview-tag used-tag"><i class="far fa-check-circle"></i> Apply </button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                      </div>
                      <div class="col-sm-12 col-md-6">
                        <div class="job-box-info">
                          <div class="box-head">
                            <h4>
                              Social Media Officer (remote role)
                            </h4>

                            <!-- <label>Location:<span> Alexandria, New South Wales, Australia</span></label> -->
                            <i class="close-box fa fa-times"></i>
                          </div>
                          <div class="job-box-text clearfix">

                            <div class="text-info-detail clearfix">
                              <label>Job Type:</label>
                              <span>Senior Designer</span>
                            </div>
                            <div class="text-info-detail clearfix">
                              <label>Job Experience:</label>
                              <span>3 year</span>
                            </div>
                            <div class="text-info-detail clearfix">
                              <label>Job Salary:</label>
                              <span>$500/-</span>
                            </div>
                            <div class="text-info-detail clearfix">
                              <label>Submitted:</label>
                              <span>20-12-2012</span>
                            </div>

                            <div class="text-info-detail clearfix">
                              <label>Job Detailed:</label>
                              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                Lorem Ipsum is simply dummy text of the printing Lorem Ipsum is simply dummy text of the
                                printing and typesetting industry. and typesetting industry. </p>
                            </div>
                          </div>
                          <div class="bc-footer">
                            <div class="row">
                              <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                                <div class="b-heading">
                                  <h4> Code: 941813</h4>
                                </div>
                              </div>
                              <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                                <div class="b-card-btn">
                                  <button type="button" class="orange_btn"> <i class="fas fa-file-alt"></i> Detail</button>
                                  <button data-toggle="modal" data-target="#myModal9" class="interview-tag used-tag"><i class="far fa-check-circle"></i> Apply </button>
                                </div>

                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Job Detail Area -->
                  </div>
                </div>

              </section>




               <!-- =====================Apply button modal================================ -->
          <div class="modal fade" id="myModal9" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog Apply-modal " role="document">
              <div class="modal-content ">
                <div class="modal-header Apply-modal-header">
                  <div class="m-header  ">
                    <h4 class="modal-title Apply-modal-title " id="myModalLabel">
                      Submit Proposal
                    </h4>
                    <i data-dismiss="modal" aria-label="Close" class="close-box fa fa-times"></i>
                  </div>
                 

                </div>
                <div class="modal-body ">
                  <div class="m-inner-main">
                    <div class="loc-m-row">
                      <div class="row Apply-modal-body">
                        <h4 class="first-heading">1 day contract - Market Stall Assistant</h4>
                        <p>Almost done , few questions before your resume is accepted for this job</p>
                        <form action="">
                          <div class="col-md-12 Apply-job-modal-form">
                            <label for="">Are you available all day August 15th, and can you make it to the Brisbane CBD
                              for 8 hours?</label>
                            <ul class="question-radiobtn">
                              <li>
                                <div class="form-check emp-redio">
                                  <input type="radio" id="test1" name="radio-group1" checked>
                                  <label for="test1"> Yes to both</label>
                                </div>

                              </li>

                              <li>
                                <div class="form-check emp-redio">
                                  <input type="radio" id="test2" name="radio-group1">
                                  <label for="test2">No to both</label>
                                </div>
                              </li>
                              <li>
                                <div class="form-check emp-redio">
                                  <input type="radio" id="test3" name="radio-group1">
                                  <label for="test3">Yes on the 15th, but need a lift to the CBD</label>
                                </div>
                              </li>
                            </ul>
                          </div>
                          <div class="col-md-12 Apply-job-modal-form">
                            <label for="">Are you physically fit and able to move heavy equipment and stock?</label>
                            <ul class="question-radiobtn">
                              <li>
                                <div class="form-check emp-redio">
                                  <input type="radio" id="test4" name="radio-group2" checked>
                                  <label for="test4">Yes</label>
                                </div>

                              </li>

                              <li>
                                <div class="form-check emp-redio">
                                  <input type="radio" id="test5" name="radio-group2">
                                  <label for="test5">No</label>
                                </div>
                              </li>
                              <li>
                                <div class="form-check emp-redio">
                                  <input type="radio" id="test6" name="radio-group2">
                                  <label for="test6">Up to 20 kilos max</label>
                                </div>
                              </li>
                            </ul>
                          </div>
                          <div class="col-md-12 Apply-job-modal-form">
                            <label for="">Do you consent to just 1 day contract?</label>
                            <ul class="question-radiobtn">
                              <li>
                                <div class="form-check emp-redio3">
                                  <input type="radio" id="test7" name="radio-group3" checked>
                                  <label for="test7">Yes</label>
                                </div>

                              </li>

                              <li>
                                <div class="form-check emp-redio3">
                                  <input type="radio" id="test8" name="radio-group3">
                                  <label for="test8">No</label>
                                </div>
                              </li>
                            </ul>
                          </div>
                          <div class="col-md-12 Apply-job-modal-form">
                            <label for="">What motivated you to apply for this job and why do think you will be
                              suitable?</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                              placeholder="Maximum 300 Characters"></textarea>
                          </div>
                          <div class="col-md-12 Apply-job-modal-form">
                            <label for="">This job requires you to complete a mandatory online test, in order to be
                              considered for the job. Do you agree to continue ?</label>
                            <ul class="question-radiobtn">
                              <li>
                                <div class="form-check emp-redio3">
                                  <input type="radio" id="test9" name="radio-group4" checked>
                                  <label for="test9">Yes</label>
                                </div>

                              </li>

                              <li>
                                <div class="form-check emp-redio3">
                                  <input type="radio" id="test10" name="radio-group4">
                                  <label for="test10">No</label>
                                </div>
                              </li>
                            </ul>

                          </div>
                          <div class="col-md-12 Apply-job-modal-form">
                            <label for="">We can see you’ve completed this same online test previously. Would you like
                              to use your previous results, or would you like to complete the test again?</label>
                            <ul class="question-radiobtn">
                              <li>
                                <div class="form-check emp-redio3">
                                  <input type="radio" id="test11" name="radio-group5" checked>
                                  <label for="test11">Redo Test</label>
                                </div>

                              </li>

                              <li>
                                <div class="form-check emp-redio3">
                                  <input type="radio" id="test12" name="radio-group5">
                                  <label for="test12">Use Previous Result</label>
                                </div>
                              </li>
                            </ul>

                          </div>
                          <div class="col-md-12 bj-tr-btn">
                            <button class="interview-tag used-tag" type="submit"><i class="fas fa-paper-plane"></i>Submit</button>
                          </div>
                        </form>
                      </div>
                    </div>


                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- =====================Apply button modal ends============================= -->


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
                    <div class="i-modal-checks">
                     <ul class="filter-modal-list">

                      <li>
                        <div class="m-inner-main ">
                        <div class="form-check custom-checkbox">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked1" checked>
                          <label class="form-check-label" for="flexCheckChecked1"></label>
                           Aviation
                          </label>
                        </div>
                      </div>
                    </li>
                     
                      <li>
                        <div class="">
                        <div class="form-check custom-checkbox">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked2" >
                          <label class="form-check-label" for="flexCheckChecked2">
                            Government and Public Services
                          </label>
                        </div>
                      </div>
                    </li>
                      <li>
                        <div class="">
                        <div class="form-check custom-checkbox">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked3" >
                          <label class="form-check-label" for="flexCheckChecked3">
                           Accounting and Finance
                          </label>
                        </div>
                      </div>
                    </li>
                      <li>
                        <div class="">
                        <div class="form-check custom-checkbox">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked4" >
                          <label class="form-check-label" for="flexCheckChecked4">
                            Healthcare and Medical
                          </label>
                        </div>
                      </div>
                    </li>
                      <li>
                        <div class="">
                        <div class="form-check custom-checkbox">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked5" >
                          <label class="form-check-label" for="flexCheckChecked5">
                            Administration and Office support
                          </label>
                        </div>
                      </div>
                    </li>
                      <li>
                        <div class="">
                        <div class="form-check custom-checkbox">
                          <input class="form-check-input" type="checkbox" value=""5 id="flexCheckChecked6" checked>
                          <label class="form-check-label" for="flexCheckChecked6">
                            Hospitality and Hotels
                          </label>
                        </div>
                      </div>
                    </li>
                      <li>
                        <div class="">
                        <div class="form-check custom-checkbox">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked7" >
                          <label class="form-check-label" for="flexCheckChecked7">
                            Advertising Arts and Media
                          </label>
                        </div>
                      </div>
                    </li>
                      <li>
                        <div class="">
                        <div class="form-check custom-checkbox">
                          <input class="form-check-input" type="checkbox" value=""7 id="flexCheckChecked8" >
                          <label class="form-check-label" for="flexCheckChecked8">
                            Health and Safety
                          </label>
                        </div>
                      </div>
                    </li>
                      <li>
                        <div class="">
                        <div class="form-check custom-checkbox">
                          <input class="form-check-input" type="checkbox" value=""8 id="flexCheckChecked9" >
                          <label class="form-check-label" for="flexCheckChecked9">
                            Automotive
                          </label>
                        </div>
                      </div>
                    </li>
                      <li>
                        <div class="">
                        <div class="form-check custom-checkbox">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked10" >
                          <label class="form-check-label" for="flexCheckChecked10">
                            Tourism
                          </label>
                        </div>
                      </div>
                    </li>
                      <li>
                        <div class="">
                        <div class="form-check custom-checkbox">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked11" >
                          <label class="form-check-label" for="flexCheckChecked11">
                            Banking and Financial Services
                          </label>
                        </div>
                      </div>
                    </li>
                      <li>
                        <div class="">
                        <div class="form-check custom-checkbox">
                          <input class="form-check-input" type="checkbox" value=""  id="flexCheckChecked12" >
                          <label class="form-check-label" for="flexCheckChecked12">
                            Human Resources and Recruitment
                          </label>
                        </div>
                      </div>
                    </li>
                      <li>
                        <div class="">
                        <div class="form-check custom-checkbox">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked13" >
                          <label class="form-check-label" for="flexCheckChecked13">
                            Call center and Customer Services
                          </label>
                        </div>
                      </div>
                    </li>
                      <li>
                        <div class="">
                        <div class="form-check custom-checkbox">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked14" checked>
                          <label class="form-check-label" for="flexCheckChecked14">
                            Government and Public Services
                          </label>
                        </div>
                      </div>
                    </li>
                      <li>
                        <div class="">
                        <div class="form-check custom-checkbox">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked15" >
                          <label class="form-check-label" for="flexCheckChecked15">
                            Information Technalogy
                          </label>
                        </div>
                      </div>
                    </li>
                      <li>
                        <div class="">
                        <div class="form-check custom-checkbox">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked16" >
                          <label class="form-check-label" for="flexCheckChecked16">
                            CEO and General Management
                          </label>
                        </div>
                      </div>
                    </li>
                      <li>
                        <div class="">
                        <div class="form-check custom-checkbox">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked17" checked>
                          <label class="form-check-label" for="flexCheckChecked17">
                            Insurance
                          </label>
                        </div>
                      </div>
                    </li>
                      <li>
                        <div class="">
                        <div class="form-check custom-checkbox">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked18" >
                          <label class="form-check-label" for="flexCheckChecked18">
                            Comunity Services and Development
                          </label>
                        </div>
                      </div>
                    </li>
                      <li>
                        <div class="">
                        <div class="form-check custom-checkbox">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked19" >
                          <label class="form-check-label" for="flexCheckChecked19">
                            Legal
                          </label>
                        </div>
                      </div>
                    </li>
                      <li>
                        <div class="">
                        <div class="form-check custom-checkbox">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked20" >
                          <label class="form-check-label" for="flexCheckChecked20">
                            Company Directors
                          </label>
                        </div>
                      </div>
                    </li>
                      <li>
                        <div class="">
                        <div class="form-check custom-checkbox">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked21" >
                          <label class="form-check-label" for="flexCheckChecked21">
                            Law enforement and private Security
                          </label>
                        </div>
                      </div>
                    </li>
                      <li>
                        <div class="">
                        <div class="form-check custom-checkbox">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked22" checked>
                          <label class="form-check-label" for="flexCheckChecked22">
                            Construction
                          </label>
                        </div>
                      </div>
                    </li>
                      <li>
                        <div class="">
                        <div class="form-check custom-checkbox">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked23" >
                          <label class="form-check-label" for="flexCheckChecked23">
                            Manufacturing
                          </label>
                        </div>
                      </div>
                    </li>
                      <li>
                        <div class="">
                        <div class="form-check custom-checkbox">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked24" >
                          <label class="form-check-label" for="flexCheckChecked24">
                           Consulting and Strategy
                          </label>
                        </div>
                      </div>
                    </li>
                      <li>
                        <div class="">
                        <div class="form-check custom-checkbox">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked25" checked>
                          <label class="form-check-label" for="flexCheckChecked25">
                            Marketing and comunication
                          </label>
                        </div>
                      </div>
                    </li>
                      <li>
                        <div class="">
                        <div class="form-check custom-checkbox">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked26" >
                          <label class="form-check-label" for="flexCheckChecked26">
                            Design and Architecture
                          </label>
                        </div>
                      </div>
                    </li>
                      <li>
                        <div class="">
                        <div class="form-check custom-checkbox">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked27" >
                          <label class="form-check-label" for="flexCheckChecked27">
                            Mining , Resources and Energy
                          </label>
                        </div>
                      </div>
                    </li>
                      <li>
                        <div class="">
                        <div class="form-check custom-checkbox">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked28" >
                          <label class="form-check-label" for="flexCheckChecked28">
                            Disputes and Complaint Resolution
                          </label>
                        </div>
                      </div>
                    </li>
                      <li>
                        <div class="">
                        <div class="form-check custom-checkbox">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked29" >
                          <label class="form-check-label" for="flexCheckChecked29">
                            Real Estate and Property
                          </label>
                        </div>
                      </div>
                    </li>
                      <li>
                        <div class="">
                        <div class="form-check custom-checkbox">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked30" >
                          <label class="form-check-label" for="flexCheckChecked30">
                            Defence and Armed forces
                          </label>
                        </div>
                      </div>
                    </li>
                      <li>
                        <div class="">
                        <div class="form-check custom-checkbox">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked40" >
                          <label class="form-check-label" for="flexCheckChecked40">
                            Retail and Consumer Products
                          </label>
                        </div>
                      </div>
                    </li>
                      <li>
                        <div class="">
                        <div class="form-check custom-checkbox">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked41" >
                          <label class="form-check-label" for="flexCheckChecked41">
                            Entertainment and Event Management
                          </label>
                        </div>
                      </div>
                    </li>
                      <li>
                        <div class="">
                        <div class="form-check custom-checkbox">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked42" >
                          <label class="form-check-label" for="flexCheckChecked42">
                            Sales and Bussiness Development
                          </label>
                        </div>
                      </div>
                    </li>
                      <li>
                        <div class="">
                        <div class="form-check custom-checkbox">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked43" >
                          <label class="form-check-label" for="flexCheckChecked43">
                            Education and training
                          </label>
                        </div>
                      </div>
                    </li>
                      <li>
                        <div class="">
                        <div class="form-check custom-checkbox">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked44" checked>
                          <label class="form-check-label" for="flexCheckChecked44">
                            Science and Technalogy
                          </label>
                        </div>
                      </div>
                    </li>
                      <li><div class="">
                        <div class="form-check custom-checkbox">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked45" >
                          <label class="form-check-label" for="flexCheckChecked45">
                            Engineering
                          </label>
                        </div>
                      </div>
                    </li>
                      <li>
                        <div class="">
                        <div class="form-check custom-checkbox">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked46" >
                          <label class="form-check-label" for="flexCheckChecked46">
                            Support and Recreation
                          </label>
                        </div>
                      </div>
                    </li>
                      <li>
                        <div class="">
                        <div class="form-check custom-checkbox">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked47" >
                          <label class="form-check-label" for="flexCheckChecked47">
                            Farming Animals and Conservation
                          </label>
                        </div>
                      </div>
                    </li>
                      <li>
                        <div class="">
                        <div class="form-check custom-checkbox">
                          <input class="form-check-input" type="checkbox" value=""  id="flexCheckChecked48" >
                          <label class="form-check-label" for="flexCheckChecked48">
                            Team Leader and People Management
                          </label>
                        </div>
                      </div>
                    </li>
                      <li>
                        <div class="">
                        <div class="form-check custom-checkbox">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked49" >
                          <label class="form-check-label" for="flexCheckChecked49">
                            Fast food
                          </label>
                        </div>
                      </div>
                    </li>
                      <li>
                        <div class="">
                        <div class="form-check custom-checkbox">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked50" >
                          <label class="form-check-label" for="flexCheckChecked50">
                            Telecomunication
                          </label>
                        </div>
                      </div>
                    </li>
                      <li>
                        <div class="">
                        <div class="form-check custom-checkbox">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked51" >
                          <label class="form-check-label" for="flexCheckChecked51">
                            Fire and Emergency Services
                          </label>
                        </div>
                      </div>
                    </li>
                      <li>
                        <div class="">
                        <div class="form-check custom-checkbox">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked52" >
                          <label class="form-check-label" for="flexCheckChecked52">
                            Trades and Services
                          </label>
                        </div>
                      </div>
                    </li>
                    </ul>
                    </div>

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
                    <div class="m-inner-main">
                      <div class="loc-m-row">
                        <div class="row">
                          <div class="col-sm-9 browse-mp">
                            <div class="input-group location-filter-m" style="position: relative;">

                              <input type="text" class="form-control"
                                placeholder="Sydney, New South Wales, Australia">
                              <div class="loc-icon">
                                <img src="assests/images/l-search.png" alt="">

                              </div>
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="location-filter ls-m" style="position: relative;">
                              <form action="">
                                <div class="form-group">

                                  <select class="selectpicker form-control">
                                    <option>1</option>
                                    <option>2</option>
                                  </select>
                                </div>
                              </form>

                            </div>
                          </div>
                        </div>
                      </div>


                      <div style="width: 100%">
                        <iframe width="100%" height="600" frameborder="0" scrolling="no"
                          marginheight="0" marginwidth="0"

                          src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=1%20Grafton%20Street,%20Dublin,%20Ireland+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">
                        </iframe>
                        <a href="https://www.maps.ie/draw-radius-circle-map/"></a>
                      </div>
                    </div>
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


@stop

@section('custom_footer_css')
{{-- <link rel="stylesheet" href="{{ asset('css/site/profile.css') }}"> --}}
{{-- <link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}"> --}}

{{-- <script type="text/javascript" src="https://maps.google.com/maps/api/js?libraries=places&key={{env('GOOGLE_API')}}"></script> --}}

@stop

@section('custom_js')
{{-- <script src="{{ asset('js/site/jquery.modal.min.js') }}"></script> --}}
{{-- <script src="{{ asset('js/site/jquery-ui.js') }}"></script> --}}
{{-- <script src="{{ asset('js/site/common.js') }}"></script> --}}
{{-- <script src="{{ asset('js/site/location_gmap.js') }}"></script> --}}
{{-- <script src="{{ asset('js/site/profile_photo.js') }}"></script> 
<script src="{{ asset('js/site/gallery_popup/jquery.magnific-popup.js') }}"></script> 
<script src="{{ asset('js/site/gallery_popup/lc_lightbox.lite.js') }}"></script> --}}

{{-- <script type="text/javascript">
$(document).ready(function() {

//====================================================================================================================================//
// Top Filter form submit load data throug ajax.
//====================================================================================================================================//
$('#filter_form').on('submit',function(event){
    console.log(' filter_form submit ');
    event.preventDefault();
    $('#paginate').val('');
    getData();
});

// function to send ajax call for getting data throug filter/Pagination selection.
var getData = function(){
    var url = '{{route('jobsFilter')}}';
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.post(url, $('#filter_form').serialize(), function(data){
        $('.jobs_list').html(data);
    });
}

getData();

// Bottom pagination load data throug ajax.
$(document).on('click','.jobs_pagination .page-item .page-link',function(e){
    console.log(' page-link click ', $(this) );
    e.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
    $('#paginate').val(page);
    getData();
});


});

$("body").click(function(){
    clickOutside: false;
});

$(".reset-btn").click(function(){
    //$("#filter_form").trigger("reset");

    jQuery('input[name="filter_location_status"]').styler();

    event.preventDefault();
    $('#paginate').val('');

        $('input[name="filter_industry_status"]').each(function() {

        if(this.checked){
        $(this).toggleClass('checked').trigger('refresh');
        this.checked = !this.checked;
        $(this).toggleClass('checked').trigger('refresh');
        (this.checked)?(jQuery('.filter_industryList').removeClass('hide_it')):(jQuery('.filter_industryList').addClass('hide_it'));

        }

        });


    jQuery('input[name="filter_location_status"]').each(function() {

        if(this.checked){
        $(this).toggleClass('checked').trigger('refresh');
        this.checked = !this.checked;
        $(this).toggleClass('checked').trigger('refresh');
        (this.checked)?(jQuery('.location_search_cont').removeClass('hide_it')):(jQuery('.location_search_cont').addClass('hide_it'));

        }
    });
    jQuery('input[name="filter_keyword"]').val("");
    jQuery('#filter_salary').get(0).selectedIndex = 0;
    jQuery('#filter_jobType').get(0).selectedIndex = 0;
    jQuery('#filter_form').find('input, select').trigger('refresh');
    getDataCustom();
});


var getDataCustom = function(){
    var url = '{{route('jobsFilter')}}';
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.post(url, $('#filter_form').serialize(), function(data){
        $('.jobs_list').html(data);
    });
}



</script> --}}
@stop

