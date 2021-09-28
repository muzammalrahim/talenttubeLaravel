

@extends('web.user.usermaster')

@section('custom_css')
{{-- <link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/profile.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}"> --}}


@stop

@section('content')
{{-- <div class="">
    <div class="head icon_head_browse_matches">Employers List</div>
        @include("site.user.employerfilter")
        @include("site.spinner")
        <div class="employers_list">
 --}}          {{--   @include("site.user.employerslist") --}}  {{-- site/user/employerslist --}}
{{--         </div>
</div>

<div style="display:none;">
<div id="confirmJobSeekerBlockModal" class="modal p0 confirmJobSeekerBlockModal wauto">
    <div class="pp_info_start pp_alert pp_confirm pp_cont" style="left: 0px; top: 0px; margin: 0;">
        <div class="cont">
            <div class="title">Block Employer?</div>

            <p class="showError mt20"></p>
            <div class="img_chat">
                <div class="icon">
                    <img src="{{asset('/images/site/icons/icon_pp_sure.png')}}" height="48" alt="">
                </div>
                <div class="msg">Are you sure you wish to continue?</div>
            </div>
            <div class="double_btn">
                <button class="confirm_close btn small dgrey" onclick="UProfile.cancelGalleryConfirm(); return false;">Cancel</button>
                <button class="confirm_JobSeekerBlock_ok btn small marsh">OK</button>
                <input type="hidden" name="jobSeekerBlockId" id="jobSeekerBlockId" value=""/>
                <div class="cl"></div>
            </div>
        </div>
        <div class="apiMessage"></div>
    </div>
</div>
</div>
 --}}


{{-- =====================================================html for emloyeer list============================================ --}}
 <section class="row">
                <div class="col-md-12">
                  <div class="profile profile-section">
                    <div class="employer-main">
                      <h2>Employers List</h2>
                      
                      <!-- Top Filter Row -->
                      <div class="employee-wraper">
                        <div class="emp-t-row">
                          <div class="row b-filter-row top-filter-row">
                            <div class="col-md-4 col-sm-12">
                              <div class="input-employee clearfix">
                                  <label>Keyword:</label>
                                  <input type="text" class="form-control" placeholder="" aria-label="Recipient's username">
                              </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                              <div class="input-employee clearfix">
                                  <label>Filter by Industry:</label>
                                  <input data-toggle="modal" data-target="#myModal" type="text" class="form-control" placeholder="Sydney, New South Wales, Australia" aria-label="Recipient's username"> 
                                  <i class="search-employee-icon fas fa-search"></i>
                              </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                              <div class="input-employee clearfix">
                                  <label>Filter by Location:</label>
                                  <input data-toggle="modal" data-target="#myModal2" type="text" class="form-control" placeholder="" aria-label="Recipient's username">
                                  <div class="loc-icon">
                                    <img src="assests/images/location.png" alt="">
                                </div>
                              </div>
                            </div>
                          </div>
      
                          <!-- row 2 -->
                          <div class="row b-filter-row">
                            <div class="col-md-8">
                              <div class="input-employee clearfix">
                                <label>Questions:</label>
                                <input type="text" class="form-control" placeholder="Are you open to temporary and contract work?" aria-label="Recipient's username"> 
                            </div>
                            </div>
                             <div class="col-md-4">
                           <ul class="question-radiobtn">
                             <li>
                                 <div class="form-check emp-redio">
                                  <input type="radio" id="test1" name="radio-group" checked>
                                  <label for="test1">Yes</label>
                                </div>
                              
                             </li>
                             <li>
                              <div class="form-check emp-redio">
                                <input type="radio" id="test2" name="radio-group">
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
                      </div>
                    
                    <!-- Top Filter Row -->
                      <div class="row">
                        <div class="col-sm-12 col-md-6">
                          <div class="job-box-info block-box clearfix">
                            <div class="box-head">
                              <h4>No Match potential</h4>                          
                            </div>
                            <div class="row Block-user-wrapper">
                              <div class="col-md-4 user-images">
                                <div class="block-user-img ">
                                  <img src="assests/images/blocked-user-img.png" alt="">
                                </div>
                                <div class="block-user-progress ">
                                  <h6>Rapid Print</h6>
                                 <div class="progress-img"> <img src="assests/images/user-progressbar.svg" alt=""></div>
                                 <div class="block-progrees-ratio d-block d-md-none">
                                    <ul>
                                  <li><span class="Progress-ratio-icon1">.</span> <span>60%</span> Match </li>
                                  <li><span class="Progress-ratio-icon2">.</span> <span>40%</span> UnMatch</li>
                                </ul>
                              </div>
                                </div>
                              </div>
                              <div class="col-md-8 user-details">
                                <div class="row blocked-user-about">
                                  <h6>About me:</h6>
                                  <p>Offering quality and personalised Merchandise/Garment printing, as well as affordable photobooth and jukebox hire across Sydney.</p>
                                </div>
                                <div class="row blocked-user-about">
                                  <h6>Intrested In:</h6>
                                  <p>Screen Printers, entertainment hire attendants and sales people - WE WANT YOU, AND YOUR FRIENDS</p>
                                </div>
                                <div class="row blocked-user-about">
                                  <h6>Location:</h6>
                                  <p>Offering quality and personalised Merchandise/Garment printing, as well as affordable photobooth and jukebox hire across Sydney.</p>
                                </div>
                                <div class="row blocked-user-experience">
                                  <h6>Industory Experience:</h6>
                                  <p>Trades and Services</p>
                                  <p>Retail and Consumer products</p>
                                  <p>Entertainment and event management</p>
                                </div>
              
                              </div>
                            </div>
                            <div class="box-footer1 box-footer  clearfix">
                              <div class="block-progrees-ratio1 d-none d-md-block">
                                <ul>
                                  <li><span class="Progress-ratio-icon1">.</span> <span>60%</span> Match </li>
                                  <li><span class="Progress-ratio-icon2">.</span> <span>40%</span> UnMatch</li>
                                </ul>
                              </div>
                              <div class=" employe-btn-group">
                              <button class="block-btn"><i class="fas fa-ban"></i> Block</button>
                              <button class="detail-btn"><i class="fas fa-file-alt"></i> Detail</button>
                              <button class="like-btn"><i class="fas fa-thumbs-up"></i> Like</button>
                             </div>                                
                            </div>
                         </div>
                       </div>
                      <div class="col-sm-12 col-md-6">
                       <div class="job-box-info block-box clearfix">
                         <div class="box-head">
                           <h4>No Match potential</h4>                          
                         </div>
                         <div class="row Block-user-wrapper">
                           <div class="col-md-4 user-images">
                             <div class="block-user-img ">
                               <img src="assests/images/blocked-user-img.png" alt="">
                             </div>
                             <div class="block-user-progress ">
                               <h6>Rapid Print</h6>
                              <div class="progress-img"> <img src="assests/images/user-progressbar.svg" alt=""></div>
                              <div class="block-progrees-ratio d-block d-md-none">
                                 <ul>
                               <li><span class="Progress-ratio-icon1">.</span> <span>60%</span> Match </li>
                               <li><span class="Progress-ratio-icon2">.</span> <span>40%</span> UnMatch</li>
                             </ul>
                           </div>
                             </div>
                           </div>
                           <div class="col-md-8 user-details">
                             <div class="row blocked-user-about">
                               <h6>About me:</h6>
                               <p>Offering quality and personalised Merchandise/Garment printing, as well as affordable photobooth and jukebox hire across Sydney.</p>
                             </div>
                             <div class="row blocked-user-about">
                               <h6>Intrested In:</h6>
                               <p>Screen Printers, entertainment hire attendants and sales people - WE WANT YOU, AND YOUR FRIENDS</p>
                             </div>
                             <div class="row blocked-user-about">
                               <h6>Location:</h6>
                               <p>Offering quality and personalised Merchandise/Garment printing, as well as affordable photobooth and jukebox hire across Sydney.</p>
                             </div>
                             <div class="row blocked-user-experience">
                               <h6>Industory Experience:</h6>
                               <p>Trades and Services</p>
                               <p>Retail and Consumer products</p>
                               <p>Entertainment and event management</p>
                             </div>
           
                           </div>
                         </div>
                         <div class="box-footer1 box-footer  clearfix">
                           <div class="block-progrees-ratio1 d-none d-md-block">
                             <ul>
                               <li><span class="Progress-ratio-icon1">.</span> <span>60%</span> Match </li>
                               <li><span class="Progress-ratio-icon2">.</span> <span>40%</span> UnMatch</li>
                             </ul>
                           </div>
                           <div class=" employe-btn-group">
                           <button class="block-btn"><i class="fas fa-ban"></i> Block</button>
                           <button class="detail-btn"><i class="fas fa-file-alt"></i> Detail</button>
                           <button class="like-btn"><i class="fas fa-thumbs-up"></i> Like</button>
                          </div>                                
                         </div>
                      </div>
                    </div>   

                   </div>
                    </div>
                   
                </div>
              </section>



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



@section('custom_js')
<script src="{{ asset('js/site/jquery.modal.min.js') }}"></script>
<script src="{{ asset('js/site/jquery-ui.js') }}"></script>
<script src="{{ asset('js/site/common.js') }}"></script>



<script type="text/javascript" src="https://maps.google.com/maps/api/js?libraries=places&key={{env('GOOGLE_API')}}"></script>
{{-- <script src="{{ asset('js/site/profile_photo.js') }}"></script>  --}}
{{-- <script src="{{ asset('js/site/gallery_popup/jquery.magnific-popup.js') }}"></script>  --}}
{{-- <script src="{{ asset('js/site/gallery_popup/lc_lightbox.lite.js') }}"></script> --}}

<script type="text/javascript">
$(document).ready(function() {

	$('#employer_filter_form').on('submit',function(event){
    console.log(' jobSeeker_filter_form submit ');
    event.preventDefault();
    $('#paginate').val('');
    getData();
});

var getData = function(){
    var url = '{{route('employers')}}';
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.post(url, $('#employer_filter_form').serialize(), function(data){
        // console.log(' success data  ', data);
        $('.employers_list').html(data);
    });
}

getData();

$(document).on('click','.jobseeker_pagination .page-item .page-link',function(e){
    console.log(' page-link click ', $(this) );
    e.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
    $('#paginate').val(page);
    getData();
});


});


$('input[name="filter_by_questions"]').change(function() {
    console.log(' filter_by_questions ');
    (this.checked)?(jQuery('.filter_question_cont').removeClass('hide_it')):(jQuery('.filter_question_cont').addClass('hide_it'));
     // $('input, select').styler({ selectSearch: true, });
});

$(".reset-btn").click(function(){
//	$("#employer_filter_form").trigger("reset");
    jQuery('input[name="filter_keyword"]').val("");
    $('input[name="filter_industry_status"]').each(function() {

    if(this.checked){
        $(this).toggleClass('checked').trigger('refresh');
        this.checked = !this.checked;
        $(this).toggleClass('checked').trigger('refresh');
        (this.checked)?(jQuery('.filter_industryList').removeClass('hide_it')):(jQuery('.filter_industryList').addClass('hide_it'));

        }
    });
    jQuery('input[name="filter_location_status"]').styler();
    jQuery('#employer_filter_form').find('input, select').trigger('refresh');
    event.preventDefault();
    $('#paginate').val('');

    jQuery('input[name="filter_location_status"]').each(function() {

            if(this.checked){
            $(this).toggleClass('checked').trigger('refresh');
            this.checked = !this.checked;
            $(this).toggleClass('checked').trigger('refresh');
            (this.checked)?(jQuery('.location_search_cont').removeClass('hide_it')):(jQuery('.location_search_cont').addClass('hide_it'));

            }
        });

    $('input[name="filter_by_questions"]').each(function() {

    if(this.checked){
        $(this).toggleClass('checked').trigger('refresh');
        this.checked = !this.checked;
        $(this).toggleClass('checked').trigger('refresh');
        (this.checked)?(jQuery('.filter_question_cont').removeClass('hide_it')):(jQuery('.filter_question_cont').addClass('hide_it'));

        }

// $('input, select').styler({ selectSearch: true, });
    });
    getDataCustom();
});


var getDataCustom = function(){
	var url = '{{route('employers')}}';
	$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
	$.post(url, $('#employer_filter_form').serialize(), function(data){
					$('.employers_list').html(data);
	});
}


$('input[name="filter_location_status"]').change(function() {
    console.log(' filter_location_status ');
    (this.checked)?(jQuery('.location_search_cont').removeClass('hide_it')):(jQuery('.location_search_cont').addClass('hide_it'));
});




    //====================================================================================================================================//
    // Google map location script
    //====================================================================================================================================//
    var map;

    var input = document.getElementById('location_search');
    var autocomplete = new google.maps.places.Autocomplete(input);
    var geocoder = new google.maps.Geocoder();
    var hasLocation = false;
    var latlng = new google.maps.LatLng(-31.2532183, 146.921099);
    var marker = "";
    var circle = "";

    var options = {
        zoom: 14,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    if(jQuery("#location_map").length > 0) {
        map = new google.maps.Map(document.getElementById("location_map"), options);
        autocomplete.bindTo('bounds', map);
        autocomplete.setFields(['address_components', 'geometry', 'icon', 'name']);
        if(!hasLocation) { map.setZoom(14); }

        // add listner on map, when click on map change the latlong and put a marker over there.
        google.maps.event.addListener(map, "click", function(event) {
            console.log(' addListener click  ');
            reverseGeocode(event.latLng);
        })

        // get the location (city,state,country) on base of text enter in search.
        // jQuery("#location_search_load").click(function() {
        //     if(jQuery("#location_search").val() != "") {
        //         geocode(jQuery("#location_search").val());
        //         return false;
        //     } else {
        //         // marker.setMap(null);
        //         return false;
        //     }
        //     return false;
        // })
        // jQuery("#location_search").keyup(function(e) {
        //     if(e.keyCode == 13)
        //         jQuery("#location_search_load").click();
        // })

        // when click on the Autocomplete suggested locations list
        autocomplete.addListener('place_changed', function() {
             console.log(' autocomplete place_changed ');

              var place = autocomplete.getPlace();
              console.log(' place ', place);

              if (!place.geometry) {
                // User entered the name of a Place that was not suggested and
                // pressed the Enter key, or the Place Details request failed.
                window.alert("No details available for input: '" + place.name + "'");
                return;
              }

              // If the place has a geometry, then present it on a map.
              if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
              } else {
                map.setCenter(place.geometry.location);
                map.setZoom(14);  // Why 14? Because it looks good.
              }


              // var address = '';
              // if (place.address_components) {
              //   address = [
              //     (place.address_components[0] && place.address_components[0].short_name || ''),
              //     (place.address_components[1] && place.address_components[1].short_name || ''),
              //     (place.address_components[2] && place.address_components[2].short_name || '')
              //   ].join(' ');
              // }


              // console.log(' auto place --- ', place);
              // console.log(' auto address --- ', address);

                var address, city, country, state;
                var address_components = place.address_components;
                for ( var j in address_components ) {
                    var types = address_components[j]["types"];
                    var long_name = address_components[j]["long_name"];
                    var short_name = address_components[j]["short_name"];
                    // console.log(' address_components ', address_components);
                    if ( jQuery.inArray("locality", types) >= 0 && jQuery.inArray("political", types) >= 0 ) {
                        city = long_name;
                    }
                    else if ( jQuery.inArray("administrative_area_level_1", types) >= 0 && jQuery.inArray("political", types) >= 0 ) {
                        state = long_name;
                    }
                    else if ( jQuery.inArray("country", types) >= 0 && jQuery.inArray("political", types) >= 0 ) {
                        country = long_name;
                    }
                }

                if((city) && (state) && (country))
                    address = city + ", " + state + ", " + country;
                else if((city) && (state))
                    address = city + ", " + state;
                else if((state) && (country))
                    address = state + ", " + country;
                else if(country)
                    address = country;

                 if((place) && (place.name))
                    address = place.name + ',' + address;

                    // console.log(' reverseGeocode place ', place);
                    // console.log(' reverseGeocode city/state/country = ', city,'/',state,'/',country );
                    updateLocationInputs(place.name,city,state,country);
                    jQuery("#location_search").val(address);
                    placeMarker(place.geometry.location);

            });

        }
        // location_map length.

    function placeMarker(location) {
        console.log(' placeMarker location ',location);

        if (marker == "") {
            marker = new google.maps.Marker({
                position: latlng,
                map: map,
                draggable:true,
                title: "Drag me"
            })
            google.maps.event.addListener(marker, "dragend", function() {
            var point = marker.getPosition();
            map.panTo(point);
                jQuery("#location_lat").val(point.lat());
                jQuery("#location_long").val(point.lng());
            });
        }
        marker.setPosition(location);
        marker.setVisible(true);
        map.setCenter(location);
        map.setZoom(14);
        if((location.lat() != "") && (location.lng() != "")) {
            jQuery("#location_lat").val(location.lat());
            jQuery("#location_long").val(location.lng());
        }
        drawCircle(location);
    }

    function drawCircle(location){
        // var center = new google.maps.LatLng(19.0822507, 72.8812041);
         // place circle.
        var filter_location_radius =  parseInt(jQuery('select[name="filter_location_radius"]').val())*1000;
        if (circle == "") {
            //  var circle = new google.maps.Circle({
            //     center: location,
            //     map: map,
            //     radius: filter_location_radius,          // IN METERS.
            //
            // });

             circle = new google.maps.Circle({
                     map: map,
                     radius: filter_location_radius,    // 10 miles in metres
                     fillColor: '#FF6600',
                     fillOpacity: 0.3,
                     strokeColor: "#FFF",
                     strokeWeight: 0         // DON'T SHOW CIRCLE BORDER.
                    });
        }
        console.log(' circle marker ', circle);
        circle.bindTo('center', marker, 'position');
        circle.setRadius(filter_location_radius);
        map.fitBounds(circle.getBounds());

    }

    function geocode(address) {
        // console.log('---2-- geocode ', address);
        if (geocoder) {
            geocoder.geocode({"address": address}, function(results, status) {
                if (status != google.maps.GeocoderStatus.OK) {
                    alert("Cannot find address");
                    return;
                }
                placeMarker(results[0].geometry.location);
                reverseGeocode(results[0].geometry.location);
                if(!hasLocation) {
                    map.setZoom(14);
                    hasLocation = true;
                }
            })
        }
    }

    function reverseGeocode(location) {
        console.log(' reverseGeocode ', location);
        if (geocoder) {
            geocoder.geocode({"latLng": location}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    var address, city, country, state;
                    for ( var i in results ) {
                        var address_components = results[i]["address_components"];
                        for ( var j in address_components ) {
                            var types = address_components[j]["types"];
                            var long_name = address_components[j]["long_name"];
                            var short_name = address_components[j]["short_name"];

                            // console.log(' address_components ', address_components);

                            if ( jQuery.inArray("locality", types) >= 0 && jQuery.inArray("political", types) >= 0 ) {
                                city = long_name;
                            }
                            else if ( jQuery.inArray("administrative_area_level_1", types) >= 0 && jQuery.inArray("political", types) >= 0 ) {
                                state = long_name;
                            }
                            else if ( jQuery.inArray("country", types) >= 0 && jQuery.inArray("political", types) >= 0 ) {
                                country = long_name;
                            }
                        }
                    }
                    if((city) && (state) && (country))
                        address = city + ", " + state + ", " + country;
                    else if((city) && (state))
                        address = city + ", " + state;
                    else if((state) && (country))
                        address = state + ", " + country;
                    else if(country)
                        address = country;

                    // console.log(' reverseGeocode results ', results);
                    // console.log(' reverseGeocode city/state/country = ', city,'/',state,'/',country );
                    updateLocationInputs('',city,state,country);
                    jQuery("#location_search").val(address);
                    placeMarker(location);
                    return true;
                }
            })
        }
        return false;
    }
    
    function updateLocationInputs(place,city,state,country){
        jQuery('#location_name').val(place);
        jQuery('#location_city').val(city);
        jQuery('#location_state').val(state);
        jQuery('#location_country').val(country);
    }
    // by default show this location;
    geocode('Sydney New South Wales, Australia');
    jQuery('.filter_location_radius').on('change', function(){
        console.log(' filter_location_radius changed.  ');
        drawCircle(new google.maps.LatLng(jQuery("#location_lat").val(), jQuery("#location_long").val()));
    });


</script>
@stop

{{-- @section('custom_css')
<style type="text/css">

.showError{
    margin-top: 20px !important;
}
</style>

@stop --}}
