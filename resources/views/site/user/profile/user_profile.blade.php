@extends('web.user.usermaster') {{-- site/user/usermaster --}}

@section('content')
   <div class="main-content col-lg-10 col-md-12 col-sm-12">
      <!--================== Mobile view sidebar ========================================================= -->
      <div class="container-fluid d-lg-none d-xl-none">
         <input type="checkbox" class="sidebar-toggle" name="" id="opensidebarmenu" style="background-color: #00326f;">
         <label for="opensidebarmenu" class="sidebaricontoggle">
            <div class="spinner top "></div>
            <div class="spinner middle "></div>
            <div class="spinner bottom "></div>
         </label>
         <div id="sidebarMenu">
            <div class="row">
               <ul class="sidebar-menu">
                  <li><a href="index.html"><img src="assests/images/frame1.png"  alt=""></a></li>
                  <li><a href="dashboard.html" class="active sidebar-text"><i class="fas fa-user"></i><span> Profile</span></a></li>
                  <li><a href="job.html" class="sidebar-text"><i class="fas fa-briefcase"></i><span> Job Applications</span></a></li>
                  <li><a href="concerge.html" class="sidebar-text"><i class="far fa-address-book"></i><span> Concerge</span></a></li>
                  <li><a href="interview.html" class="sidebar-text"><i class="fas fa-envelope-open-text"></i><span>Interview Invitations</span></a></li>
                  <li><a href="cross.html" class="sidebar-text"><i class="fas fa-link"></i><span>Cross Refrance</span></a></li>
                  <li><a href="browser.html" class="sidebar-text"><i class="fas fa-search"></i><span>Browse Jobs</span></a></li>
                  <li><a href="employers.html" class="sidebar-text"><i class="fas fa-users"></i><span>Employers</span></a></li>
                  <li><a href="testing.html" class="sidebar-text"><i class="fas fa-clipboard-list"></i><span>Testing</span></a></li>
                  <li><a href="block.html" class="sidebar-text"><i class="fas fa-user-lock"></i><span>Block Users</span></a></li>
                  <li><a href="user.html" class="sidebar-text"><i class="fas fa-thumbs-up"></i><span>Like Users</span></a></li>
                  <li><a href="talent.html" class="sidebar-text"><i class="fas fa-hand-holding-usd"></i><span>Talent Matcher</span></a></li>
               </ul>
            </div>
         </div>
      </div>
      <!-- Mobile view navigation end here -->
      <nav class="row top-nav-header">
         <div class="col-md-10 nav nav-tabs body-tab-btn clearfix" id="nav-tab" role="tablist">
            <button class="nav-link blue_btn" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" 
               role="tab" aria-controls="nav-home" aria-selected="true"><i class="fas fa-user"></i>Premium Account</button>
            <button class="nav-link active orange_btn" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" 
               type="button" role="tab" aria-controls="nav-profile" aria-selected="false"><i class="fas fa-user"></i> Profile</button>
            <button class="nav-link orange_btn" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" 
               type="button" role="tab" aria-controls="nav-contact" aria-selected="false"><i class="fas fa-clipboard-list"></i> Update</button>
         </div>
         <div class="col-md-2 sign-btn">
          <a href="{{ route('logout') }}">
            <button class="orange_btn signout"  type="button"><i class="fas fa-sign-out-alt"></i>Sign Out</button>
          </a>
         </div>
      </nav>
      <div class="tab-content" id="nav-tabContent">
         <div class="tab-pane" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <div class="premiun-accounts profile-section">
               <h2>Premium Account</h2>
               <p>Are you interested in contacting some job seekers that interest you or your organisation? If so, 
                  please contact us at <a href="#" class="account-links">info@talenttube.org</a> to for our latest prices and packages. 
                  By accessing our premium account features, you must also agree to the following:
               </p>
               <ul>
                  <li>
                     <p><span>1)</span> You agree to only contact job seekers about relevant employment opportunities</p>
                  </li>
                  <li>
                     <p><span>2)</span> You are welcome to share the more open details of our job seekers with people 
                        in your network (their video intro, snapshot, profile, etc) who may have relevant job opportunities. 
                        However, please contact the job seeker directly for their permission if you wish to share the details 
                        you can access as a Premium Account holder (resume, contact details, full name)
                     </p>
                  </li>
                  <li>
                     <p><span>3)</span> You are under no circumstances allowed to share our job seeker data with marketing companies</p>
                  </li>
                  <li>
                     <p><span>4)</span> You understand this is not a dating site or platform to do anything other than to discuss relevant employment opportunities with job seekers. 
                        Any non-employment related approaches will be reported.
                     </p>
                  </li>
               </ul>
               <p>Failure to comply with the above will result in the immediate cancelation of your account, and in some circumstances, 
                  our job seekers may pursue this further with the local authorities or civil courts.
               </p>
            </div>
         </div>
         <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <section class="row">
               <div class="col-md-4 order-md-2 order-sm-1 profile-data-info">
                  <div class="profile-information">
                     <div class="profile-img-wrapper">
                        <img src="{{ asset('assests/images/user.png') }}" width="150" alt="profile">
                     </div>
                     <div class="profile-detail clearfix">
                        <h1 >Hassan Khan</h1>
                        <p >Islamabad capital territory Pakistan</p>
                        <h2>Job Seekers</h2>
                        <div class="recent-job clearfix">
                           <label>Recent Job:</label>
                           <span>Laravel at hbsdcsvcysc</span>
                        </div>
                        <div class="recent-job clearfix">
                           <label>Expecting Salary:</label>
                           <span>AUD:1,50,000</span>
                        </div>
                        <button type="button" class="edit-btn orange_btn"><i class="fas fa-edit"></i>Edit</button>
                     </div>
                  </div>
               </div>
               <div class="col-md-8 order-md-1 order-sm-2 first-tap-detail">
                  <div class="profile profile-section">
                     <ul class="nav nav-tabs" id="Profile-tab" role="tablist">
                        <span class="line-tab"></span>
                        <li class="nav-item" role="presentation">
                           <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                              type="button" role="tab" aria-controls="home" aria-selected="true">
                           <i class="fa fa-circle tab-circle-cross"></i>Profile</button>
                        </li>
                        <li class="nav-item" role="presentation">
                           <button class="nav-link" id="profile-tab1" data-bs-toggle="tab" data-bs-target="#profile"
                              type="button" role="tab" aria-controls="profile" aria-selected="false">
                           <i class="fa fa-circle tab-circle-cross"></i>Album</button>
                        </li>
                        <li class="nav-item" role="presentation">
                           <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                              type="button" role="tab" aria-controls="contact" aria-selected="false">
                           <i class="fa fa-circle tab-circle-cross"></i>Questions</button>
                        </li>
                        <li class="nav-item" role="presentation">
                           <button class="nav-link" id="tag-tab" data-bs-toggle="tab" data-bs-target="#tag"
                              type="button" role="tab" aria-controls="tag" aria-selected="false">
                           <i class="fa fa-circle tab-circle-cross"></i>Tags</button>
                        </li>
                        <li class="nav-item" role="presentation">
                           <button class="nav-link" id="job-tab" data-bs-toggle="tab" data-bs-target="#job"
                              type="button" role="tab" aria-controls="job" aria-selected="false">
                           <i class="fa fa-circle tab-circle-cross"></i>Job</button>
                        </li>
                        <li class="nav-item" role="presentation">
                           <button class="nav-link" id="refrance-tab" data-bs-toggle="tab" data-bs-target="#refrance"
                              type="button" role="tab" aria-controls="refrance" aria-selected="false">
                           <i class="fa fa-circle tab-circle-cross"></i>Refrences</button>
                        </li>
                     </ul>
                     <div class="tab-content" id="myTabContent">
                        <!--==================== profile tab-->
                        <div class="profile-text-wrap tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="Profile-tab">
                           <div class="about-infomation">
                              <h2>About me</h2>
                              <button type="button" class="edited-text"><i class="fas fa-edit"></i></button>
                              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis eum quaerat iusto
                                 voluptatum optio voluptatem maxime laudantium error fugiat asperiores!
                              </p>
                           </div>
                           <div class="about-infomation">
                              <h2>Interested In</h2>
                              <button type="button" class="edited-text"><i class="fas fa-edit"></i></button>
                              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis eum quaerat iusto
                                 voluptatum optio voluptatem maxime laudantium error fugiat asperiores!
                              </p>
                           </div>
                           <div class="about-infomation">
                              <h2>Qualification</h2>
                              <button type="button" class="edited-text"><i class="fas fa-edit"></i></button>
                              <ul class="qualification-li">
                                 <li><i class="qualification-circle"></i><span> Lorem ipsum dolor sit amet consectetur adipisicing elit.</span></li>
                                 <li><i class="qualification-circle"></i><span>Lorem ipsum dolor sit amet consectetur adipisicing elit.</span></li>
                                 <li><i class="qualification-circle"></i><span>Lorem ipsum dolor sit amet consectetur adipisicing elit.</span></li>
                                 <li><i class="qualification-circle"></i><span>Lorem ipsum dolor sit amet consectetur adipisicing elit.</span></li>
                              </ul>
                           </div>
                           <div class="about-infomation">
                              <h2>Industry Experience</h2>
                              <button type="button" class="edited-text"><i class="fas fa-edit"></i></button>
                              <ul class="qualification-li">
                                 <li><i class="qualification-circle"></i><span> Lorem ipsum dolor sit amet consectetur adipisicing elit.</span></li>
                                 <li><i class="qualification-circle"></i><span>Lorem ipsum dolor sit amet consectetur adipisicing elit.</span></li>
                                 <li><i class="qualification-circle"></i><span>Lorem ipsum dolor sit amet consectetur adipisicing elit.</span></li>
                                 <li><i class="qualification-circle"></i><span>Lorem ipsum dolor sit amet consectetur adipisicing elit.</span></li>
                              </ul>
                           </div>
                        </div>
                        <!--================== album-tab-->
                        <div class="album-section tab-pane fade Photos " id="profile" role="tabpanel"
                           aria-labelledby="profile-tab">
                           <div class=" Gallery">
                              <h2>Photos</h2>
                              <ul>
                                 <li class="">
                                    <!-- ============ upload images ============= -->
                                    <div class="album-upload-img field" align="left">
                                       <div class="upload-file">
                                          <i class="fas fa-images"></i>
                                          <span>Upload-photo</span>
                                       </div>
                                       <input type="file" id="files" name="files[]" multiple />
                                    </div>
                                    <!-- =========== end ============== -->
                                 </li>
                              </ul>
                           </div>
                           <div class="row Resume">
                              <h2>Resume & Contact Details</h2>
                              <div class="col-md-6 Resume-email"><label>Email:<span>hkhan5028@gmail.com</span></label></div>
                              <div class="col-md-6 Resume-contact"><label>Contact#:<span>+92 337 1234567</span></label></div>
                           </div>
                           <div class="Gallery clearfix">
                              <ul>
                                 <li>
                                    <section class="multiple-file-pdf" id="mupload5">
                                       <div class="file-chooser clearfix">
                                          <input type="file" class="file-chooser__input" id="file5" name="file5[]">
                                          <button type="button" class="send-btn orange_btn"><i class="fa fa-save"></i>Save</button>
                                       </div>
                                       <div class="file-uploader__message-area">
                                          <!-- <p>Select a file</p> -->
                                       </div>
                                    </section>
                                 </li>
                              </ul>
                           </div>
                           <div class=" Gallery">
                              <h2>Video's</h2>
                              <ul>
                                 <li class="">
                                    <!-- ============ upload images ============= -->
                                    <div class="album-upload-img field" align="left">
                                       <div class="upload-file">
                                          <i class="fas fa-images"></i>
                                          <span>Upload-Video</span>
                                       </div>
                                       <input type="file" id="files" name="files[]" multiple />
                                    </div>
                                    <!-- =========== end ============== -->
                                 </li>
                              </ul>
                           </div>
                        </div>
                        <!--====================== question tab===========================-->
                        <div class="tab-pane fade questions-tab" id="contact"  role="tabpanel" aria-labelledby="contact-tab">
                           <h2>Questions</h2>
                           <div class="question-ans">
                              <h4 class="accordionone">Are you seeking a graduate programe or internship</h4>
                              <div class="panel">
                                 <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                              </div>
                           </div>
                           <div class="question-ans">
                              <h4 class="accordionone">Are you seeking a graduate programe or internship</h4>
                              <div class="panel">
                                 <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                              </div>
                           </div>
                           <div class="question-ans">
                              <h4 class="accordionone">Are you seeking a graduate programe or internship</h4>
                              <div class="panel">
                                 <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                              </div>
                           </div>
                           <div class="question-ans">
                              <h4 class="accordionone">Are you seeking a graduate programe or internship</h4>
                              <div class="panel">
                                 <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                              </div>
                           </div>
                           <div class="question-ans">
                              <h4 class="accordionone">Are you seeking a graduate programe or internship</h4>
                              <div class="panel">
                                 <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                              </div>
                           </div>
                        </div>
                        <!--=====================tag tab==============-->
                        <div class="tab-pane fade tag-tab-info " id="tag"  role="tabpanel" aria-labelledby="tag-tab">
                           <form action="">
                              <h2 >Tags</h2>
                              <h3 >Skills , Qualifications, Studies and Experience</h3>
                              <div class="add-skils clearfix">
                                 <input type="text" class="form-control" placeholder="Add more intrest">
                                 <a href="" type="submit" class="orange_btn"><i class="fas fa-plus"></i>Add</a>
                              </div>
                              <div class="skill-boxs">
                                 <ul>
                                    <li><span>Melbourne uni <i class="fa fa-times"></i></span></li>
                                    <li><span>Melbourne uni <i class="fa fa-times"></i></span></li>
                                    <li><span>Melbourne uni <i class="fa fa-times"></i></span></li>
                                 </ul>
                              </div>
                              <div class=" container-fluid d-none d-lg-block tag-tabactive">
                                 <div class="row additional-sidebar-wrapper  ">
                                    <div class="additional-sidebar col-md-5 ">
                                       <div class="">
                                          <div class="nav flex-column nav-pills " id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                             <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home"
                                                type="button" role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="fas fa-star"></i>
                                             <span>Most Popular</span></button>
                                             <button class="nav-link" id="v-pills-organization-tab" data-bs-toggle="pill"
                                                data-bs-target="#v-pills-organization" type="button" role="tab" aria-controls="v-pills-organization"
                                                aria-selected="false"><i class="fas fa-globe"></i> <span>Org I've worked for</span></button>
                                             <button class="nav-link" id="v-pills-language-tab" data-bs-toggle="pill" data-bs-target="#v-pills-language"
                                                type="button" role="tab" aria-controls="v-pills-language" aria-selected="false"><i class="fas fa-bug"></i>
                                             <span>Language I Speak</span></button>
                                             <button class="nav-link" id="v-pills-job-tab" data-bs-toggle="pill" data-bs-target="#v-pills-job"
                                                type="button" role="tab" aria-controls="v-pills-job" aria-selected="false"><i
                                                class="fas fa-briefcase"></i> <span>Most Job Titles</span></button>
                                             <button class="nav-link " id="v-pills-hobies-tab" data-bs-toggle="pill" data-bs-target="#v-pills-hobies"
                                                type="button" role="tab" aria-controls="v-pills-hobies" aria-selected="true"><i
                                                class="fas fa-gamepad"></i> <span>Hobies & Intrests</span></button>
                                             <button class="nav-link" id="v-pills-qualification-tab" data-bs-toggle="pill"
                                                data-bs-target="#v-pills-qualification" type="button" role="tab" aria-controls="v-pills-qualification"
                                                aria-selected="false"><i class="fas fa-graduation-cap"></i> <span>Qualification</span></button>
                                             <button class="nav-link" id="v-pills-institution-tab" data-bs-toggle="pill"
                                                data-bs-target="#v-pills-institution" type="button" role="tab" aria-controls="v-pills-institution"
                                                aria-selected="false"><i class="fas fa-book"></i> <span>Tertiary Instutions & Studies</span></button>
                                             <button class="nav-link" id="v-pills-network-tab" data-bs-toggle="pill" data-bs-target="#v-pills-network"
                                                type="button" role="tab" aria-controls="v-pills-network" aria-selected="false"><i
                                                class="fas fa-filter"></i> <span>My Personal Networks</span></button>
                                             <button class="nav-link" id="v-pills-other-tab" data-bs-toggle="pill" data-bs-target="#v-pills-other"
                                                type="button" role="tab" aria-controls="v-pills-other" aria-selected="false"><i
                                                class="fas fa-spinner"></i> <span>Others</span></button>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="additional-content-area col-md-7">
                                       <div class="tab-content" id="v-pills-tabContent">
                                          <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                             <h2>Most popular</h2>
                                             <div class="row content">
                                                <div class="col-sm-6">
                                                   <ul>
                                                      <li><a href=""><span><i class="fas fa-plus"></i></span> Malbourne Uni</a></li>
                                                   </ul>
                                                </div>
                                                <div class="col-sm-6">
                                                   <ul>
                                                      <li><a href=""><span><i class="fas fa-plus"></i></span> Cantonese</a></li>
                                                   </ul>
                                                </div>
                                                <div class="col-sm-6">
                                                   <ul>
                                                      <li><a href=""><span><i class="fas fa-plus"></i></span> Wallpaper Installer</a></li>
                                                   </ul>
                                                </div>
                                                <div class="col-sm-6">
                                                   <ul>
                                                      <li><a href=""><span><i class="fas fa-plus"></i></span> Procurement</a></li>
                                                   </ul>
                                                </div>
                                                <div class="col-sm-6">
                                                   <ul>
                                                      <li><a href=""><span><i class="fas fa-plus"></i></span>Service NSW</a></li>
                                                   </ul>
                                                </div>
                                                <div class="col-sm-6">
                                                   <ul>
                                                      <li><a href=""><span><i class="fas fa-plus"></i></span> Bar Attendent</a></li>
                                                   </ul>
                                                </div>
                                                <div class="col-sm-6">
                                                   <ul>
                                                      <li><a href=""><span><i class="fas fa-plus"></i></span> Beauty</a></li>
                                                   </ul>
                                                </div>
                                                <div class="col-sm-6">
                                                   <ul>
                                                      <li><a href=""><span><i class="fas fa-plus"></i></span> Malbourne Uni</a></li>
                                                   </ul>
                                                </div>
                                                <div class="col-sm-6">
                                                   <ul>
                                                      <li><a href=""><span><i class="fas fa-plus"></i></span> Cantonese</a></li>
                                                   </ul>
                                                </div>
                                                <div class="col-sm-6">
                                                   <ul>
                                                      <li><a href=""><span><i class="fas fa-plus"></i></span> Wallpaper Installer</a></li>
                                                   </ul>
                                                </div>
                                                <div class="col-sm-6">
                                                   <ul>
                                                      <li><a href=""><span><i class="fas fa-plus"></i></span> Procurement</a></li>
                                                   </ul>
                                                </div>
                                                <div class="col-sm-6">
                                                   <ul>
                                                      <li><a href=""><span><i class="fas fa-plus"></i></span>Service NSW</a></li>
                                                   </ul>
                                                </div>
                                                <div class="col-sm-6">
                                                   <ul>
                                                      <li><a href=""><span><i class="fas fa-plus"></i></span> Bar Attendent</a></li>
                                                   </ul>
                                                </div>
                                                <div class="col-sm-6">
                                                   <ul>
                                                      <li><a href=""><span><i class="fas fa-plus"></i></span> Beauty</a></li>
                                                   </ul>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="tab-pane fade" id="v-pills-organization" role="tabpanel"
                                             aria-labelledby="v-pills-organization-tab">
                                             <center>
                                                <h1>404! Page Not Found</h1>
                                             </center>
                                             <center><big>WE are Working On it-page-2</big></center>
                                          </div>
                                          <div class="tab-pane fade" id="v-pills-language" role="tabpanel" aria-labelledby="v-pills-language-tab">
                                             <center>
                                                <h1>404! Page Not Found</h1>
                                             </center>
                                             <center><big>WE are Working On it-page-3</big></center>
                                          </div>
                                          <div class="tab-pane fade" id="v-pills-job" role="tabpanel" aria-labelledby="v-pills-job-tab">
                                             <center>
                                                <h1>404! Page Not Found</h1>
                                             </center>
                                             <center><big>WE are Working On it-page-4</big></center>
                                          </div>
                                          <div class="tab-pane fade" id="v-pills-hobies" role="tabpanel" aria-labelledby="v-pills-hobies-tab">
                                             <center>
                                                <h1>404! Page Not Found</h1>
                                             </center>
                                             <center><big>WE are Working On it-page-5</big></center>
                                          </div>
                                          <div class="tab-pane fade" id="v-pills-qualification" role="tabpanel"
                                             aria-labelledby="v-pills-qualification-tab">
                                             <center>
                                                <h1>404! Page Not Found</h1>
                                             </center>
                                             <center><big>WE are Working On it-page-6</big></center>
                                          </div>
                                          <div class="tab-pane fade" id="v-pills-institution" role="tabpanel" aria-labelledby="v-pills-institution-tab">
                                             <center>
                                                <h1>404! Page Not Found</h1>
                                             </center>
                                             <center><big>WE are Working On it-page-7</big></center>
                                          </div>
                                          <div class="tab-pane fade" id="v-pills-network" role="tabpanel" aria-labelledby="v-pills-network-tab">
                                             <center>
                                                <h1>404! Page Not Found</h1>
                                             </center>
                                             <center><big>WE are Working On it-page-8</big></center>
                                          </div>
                                          <div class="tab-pane fade" id="v-pills-other" role="tabpanel" aria-labelledby="v-pills-other-tab">
                                             <center>
                                                <h1>404! Page Not Found</h1>
                                             </center>
                                             <center><big>WE are Working On it-page-9</big></center>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <!-- ==========================Mobile view Portion===================== -->
                              <div class="d-block d-lg-none mobil-tab-view">
                                 <div class="accordion" id="accordionExample">
                                    <div class="accordion-item">
                                       <h2 class="accordion-header" id="headingOne">
                                          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                          <i class="fas fa-star"></i>
                                          <span>Most Popular</span>
                                          </button>
                                       </h2>
                                       <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                          <div class="accordion-body">
                                             <div class="container ">
                                                <h2>Most popular</h2>
                                                <div class="row tagcontent-list">
                                                   <div class="col-md-6 col-sm-12">
                                                      <ul>
                                                         <li><a href=""><span><i class="fas fa-plus"></i></span> Malbourne Uni</a></li>
                                                         <li><a href=""><span><i class="fas fa-plus"></i></span> Cantonese</a></li>
                                                         <li><a href=""><span><i class="fas fa-plus"></i></span> Wallpaper Installer</a></li>
                                                         <li><a href=""><span><i class="fas fa-plus"></i></span> Procurement</a></li>
                                                         <li><a href=""><span><i class="fas fa-plus"></i></span> Service NSW</a></li>
                                                         <li><a href=""><span><i class="fas fa-plus"></i></span> Bar Attendent</a></li>
                                                         <li><a href=""><span><i class="fas fa-plus"></i></span> Beauty</a></li>
                                                      </ul>
                                                   </div>
                                                   <div class="col-md-6 col-sm-12">
                                                      <ul>
                                                         <li><a href=""><span><i class="fas fa-plus"></i></span> Malbourne Uni</a></li>
                                                         <li><a href=""><span><i class="fas fa-plus"></i></span> Cantonese</a></li>
                                                         <li><a href=""><span><i class="fas fa-plus"></i></span> Wallpaper Installer</a></li>
                                                         <li><a href=""><span><i class="fas fa-plus"></i></span> Procurement</a></li>
                                                         <li><a href=""><span><i class="fas fa-plus"></i></span>Service NSW</a></li>
                                                         <li><a href=""><span><i class="fas fa-plus"></i></span> Bar Attendent</a></li>
                                                         <li><a href=""><span><i class="fas fa-plus"></i></span> Beauty</a></li>
                                                      </ul>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="accordion-item">
                                       <h2 class="accordion-header" id="headingTwo">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                          <i class="fas fa-globe"></i> <span>Org I've worked for</span>
                                          </button>
                                       </h2>
                                       <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                          <div class="accordion-body">
                                             <center>
                                                <h1>404! Page Not Found</h1>
                                             </center>
                                             <center><big>WE are Working On it-page-2</big></center>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="accordion-item">
                                       <h2 class="accordion-header" id="headingThree">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                          <i class="fas fa-bug"></i><span>Language I Speak</span>
                                          </button>
                                       </h2>
                                       <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                          <div class="accordion-body">
                                             <center>
                                                <h1>404! Page Not Found</h1>
                                             </center>
                                             <center><big>WE are Working On it-page-2</big></center>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="accordion-item">
                                       <h2 class="accordion-header" id="headingFour">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                          <i class="fas fa-briefcase"></i> <span>Most Job Titles</span>
                                          </button>
                                       </h2>
                                       <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="heading" data-bs-parent="#accordionExample">
                                          <div class="accordion-body">
                                             <center>
                                                <h1>404! Page Not Found</h1>
                                             </center>
                                             <center><big>WE are Working On it-page-2</big></center>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="accordion-item">
                                       <h2 class="accordion-header" id="headingFive">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                          <i class="fas fa-gamepad"></i> <span>Hobies & Intrests</span>
                                          </button>
                                       </h2>
                                       <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="heading" data-bs-parent="#accordionExample">
                                          <div class="accordion-body">
                                             <center>
                                                <h1>404! Page Not Found</h1>
                                             </center>
                                             <center><big>WE are Working On it-page-2</big></center>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="accordion-item">
                                       <h2 class="accordion-header" id="headingSix">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                          <i class="fas fa-graduation-cap"></i> <span>Qualification</span>
                                          </button>
                                       </h2>
                                       <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="heading" data-bs-parent="#accordionExample">
                                          <div class="accordion-body">
                                             <center>
                                                <h1>404! Page Not Found</h1>
                                             </center>
                                             <center><big>WE are Working On it-page-2</big></center>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="accordion-item">
                                       <h2 class="accordion-header" id="headingSeven">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                          <i class="fas fa-book"></i> <span>Tertiary Instutions & Studies</span>
                                          </button>
                                       </h2>
                                       <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="heading" data-bs-parent="#accordionExample">
                                          <div class="accordion-body">
                                             <center>
                                                <h1>404! Page Not Found</h1>
                                             </center>
                                             <center><big>WE are Working On it-page-2</big></center>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="accordion-item">
                                       <h2 class="accordion-header" id="headingEight">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                          <i class="fas fa-filter"></i> <span>My Personal Networks</span>
                                          </button>
                                       </h2>
                                       <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="heading" data-bs-parent="#accordionExample">
                                          <div class="accordion-body">
                                             <center>
                                                <h1>404! Page Not Found</h1>
                                             </center>
                                             <center><big>WE are Working On it-page-2</big></center>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="accordion-item">
                                       <h2 class="accordion-header" id="headingNine">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                                          <i class="fas fa-spinner"></i> <span>Others</span>
                                          </button>
                                       </h2>
                                       <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="heading" data-bs-parent="#accordionExample">
                                          <div class="accordion-body">
                                             <center>
                                                <h1>404! Page Not Found</h1>
                                             </center>
                                             <center><big>WE are Working On it-page-2</big></center>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <!-- ==============================ends================================= -->
                           </form>
                        </div>
                        <!--=================job tab ============================ -->
                        <div class="tab-pane fade job-applied" id="job"  role="tabpanel" aria-labelledby="job-tab">
                           <h2>Jobs I Have Applied</h2>
                           <div class="row">
                              <div class="col-md-6 col-sm-12">
                                 <div class="job-box-info">
                                    <div class="box-head">
                                       <h4>This is test</h4>
                                       <label>Location:<span> Alexandria, New South Wales, Australia</span></label>
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
                                          <label class="job-detail-label">Job Detailed:</label>
                                          <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                                       </div>
                                       <span class="interview-tag used-tag">Interview</span>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6 col-sm-12">
                                 <div class="job-box-info">
                                    <div class="box-head">
                                       <h4>This is test</h4>
                                       <label>Location:<span> Alexandria, New South Wales, Australia</span></label>
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
                                          <label class="job-detail-label">Job Detailed:</label>
                                          <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                                       </div>
                                       <span class="interview-tag used-tag">Interview</span>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6 col-sm-12">
                                 <div class="job-box-info">
                                    <div class="box-head">
                                       <h4>This is test</h4>
                                       <label>Location:<span> Alexandria, New South Wales, Australia</span></label>
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
                                          <label class="job-detail-label">Job Detailed:</label>
                                          <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                                             Lorem Ipsum is simply dummy text of the printing Lorem Ipsum is simply dummy text of the printing and typesetting industry. and typesetting industry. 
                                          </p>
                                       </div>
                                       <span class="pendinginterview-tag used-tag">Pending Interview</span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!--=================referance tab=====================-->
                        <div class="tab-pane fade referance-tab" id="refrance"  role="tabpanel" aria-labelledby="refrance-tab">
                           <h2>Refrance</h2>
                           <form action="">
                              <div class="row mb-3">
                                 <div class="col-md-4 col-sm-12">
                                    <Label>Name:</label>
                                 </div>
                                 <div class="col-md-8 col-sm-12">
                                    <input type="text" class="form-control"  placeholder="Enter name" required>
                                 </div>
                              </div>
                              <div class="row mb-4">
                                 <div class="col-md-3 col-sm-12">
                                    <Label>Number:</label>
                                 </div>
                                 <div class="col-md-8 col-sm-12">
                                    <input type="number" class="form-control"  placeholder="+92" required>
                                 </div>
                              </div>
                              <div class="row mb-3">
                                 <div class="col-md-4 col-sm-12">
                                    <Label>Email:</label>
                                 </div>
                                 <div class="col-md-8 col-sm-12">
                                    <input type="email" class="form-control"  placeholder="Enter Email" required>
                                 </div>
                              </div>
                              <div class="row mb-3">
                                 <div class="col-md-4 col-sm-12">
                                    <Label>Reference:</label>
                                 </div>
                                 <div class="col-md-8 col-sm-12 select-refeance">
                                    <i class="fa fa-caret-down select-caret"></i>
                                    <select class="form-control ">
                                       <option>Referance</option>
                                       <option>Referance</option>
                                       <option>Referance</option>
                                       <option>Referance</option>
                                       <option>Referance</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="row mb-3">
                                 <div class="col-md-4 col-sm-12">
                                    <Label>Employer Notification:</label>
                                 </div>
                                 <div class="col-md-8 col-sm-12 select-refeance">
                                    <i class="fa fa-caret-down select-caret"></i>
                                    <select class="form-control" >
                                       <option>Notification1</option>
                                       <option>Notification1</option>
                                       <option>Notification1</option>
                                       <option>Notification1</option>
                                       <option>Notification1</option>
                                    </select>
                                 </div>
                              </div>
                           </form>
                        </div>
                        <!--========================end all tabs-->
                     </div>
                  </div>
               </div>
            </section>
         </div>
         <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
            <div class="profile-section update-information">
               <div class="row update-information-area">
                  <div class="col-sm-12">
                     <h2>Update Email Address</h2>
                     <div class="row">
                        <div class="col-sm-3">
                           <label>Email</label>
                        </div>
                        <div class="col-sm-6">
                           <input class="form-control" type="email" placeholder="Example@domain.com"/>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row update-information-area">
                  <div class="col-sm-12">
                     <h2>Update Phone Number</h2>
                     <div class="row">
                        <div class="col-sm-3">
                           <label>Phone</label>
                        </div>
                        <div class="col-sm-6">
                           <input class="form-control" type="number" placeholder="Example@domain.com"/>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row update-information-area">
                  <div class="col-sm-12">
                     <h2>Update Password</h2>
                     <div class="row mb-3">
                        <div class="col-sm-3">
                           <label>Current Password</label>
                        </div>
                        <div class="col-sm-6">
                           <input class="form-control" type="number" placeholder="Example@domain.com"/>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-sm-3">
                           <label>New Password</label>
                        </div>
                        <div class="col-sm-6">
                           <input class="form-control" type="number" placeholder="Example@domain.com"/>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="update-account-info">
                  <button class="update-btn orange_btn" type="button"><i class="fas fa-retweet"></i>Update All</button>
                  <button class="delete-btn" type="button"><i class="fa fa-trash"></i>Delete Account</button>
               </div>
            </div>
         </div>
      </div>
      <!-- ============== top buttons end =========================== -->
   </div>
@endsection