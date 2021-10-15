



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
               </ul>
               <div class="tab-content" id="myTabContent">
                  <!--==================== profile tab-->
                  <div class="profile-text-wrap tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="Profile-tab">
                     

                     {{-- ==================================== About us ==================================== --}}

                     <div class="about-infomation">
                        <h2>About Us</h2>
                        <button type="button"id="showeditbox" onclick="showFieldEditor('about_me');" class="edited-text"><i class="fas fa-edit"></i></button>
                        <textarea class="form-control bg-white border-0 sec_about_me" rows="3" cols="3" readonly > {{$user->about_me}}</textarea>

                        <div class="row">
                           <div class="col-md-12">
                              <div class="float-right button_about_me d-none">
                                 <button class="cancel-button" onclick="hideFieldEditor('about_me');">Cancel</button>
                                 <button class="orange_btn mt-2" onclick="updateProfile('about_me');" >Save</button> 
                              </div>
                           </div>
                        </div>
                        <div class="alert alert-success alert_about_me hide_me" role="alert">
                          <strong>Success!</strong> About me has been updated successfully!
                        </div>
                     </div>

                     <div class="about-infomation">
                        <h2>Interested In</h2>
                        <button type="button"  onclick="showFieldEditor('interested_in');" class="edited-text"><i class="fas fa-edit"></i></button>
                     
                        <textarea class="form-control bg-white border-0 sec_interested_in" rows="3" cols="3" readonly > {{$user->interested_in}}</textarea>

                        <div class="row">
                           <div class="col-md-12">
                              <div class="float-right button_interested_in d-none">
                                 <button class="cancel-button" onclick="hideFieldEditor('interested_in');">Cancel</button>
                                 <button class="orange_btn mt-2" onclick="updateProfile('interested_in');">Save</button> 
                              </div>
                           </div>
                        </div>
                        <div class="alert alert-success alert_interested_in hide_me" role="alert">
                          <strong>Success!</strong> Interested In have been updated successfully!
                        </div>
                     </div>


                    

                    <div class="about-infomation IndusListBox">
                        <h2>Industry Experience</h2>
                        <button type="button" class="edited-text" onclick="showIndustryExpEditor();"><i class="fas fa-edit"></i></button>
                        <ul class="qualification-li">
                            <div class="IndusList">  
                              @include('site.layout.parts.jobSeekerIndustryList')
                            </div>
                            <div class="button_industryExperience d-none">
                                <button class="addIndus btn-info btn-block rounded py-2 btn-sm m-0" onclick="addIndustryExp()" >Add New</button> 
                                <button class=" btn-block orange_btn rounded py-2  saveIndus " onclick="updateIndusExperience()">Save</button>
                            </div>
                            <div class="alert alert-success IndusAlert hide_me" role="alert">
                               <strong>Success!</strong> Industry Experience have been updated successfully!
                            </div>
                        </ul>
                    </div>
                </div>
               
                  <!-- ========================================== album-tab ========================================== -->
                  

                  <div class="album-section tab-pane fade Photos " id="profile" role="tabpanel" aria-labelledby="profile-tab">

                     @include('site.user.profile.tabs.album')  {{-- site/user/profile/tabs/album --}}
                    

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

                              </div>
                              <!-- =========== end ============== -->
                           </li>
                        </ul>
                     </div>
                  </div>


                  <!-- ========================================== question tab ========================================== -->
                  
                  <div class="tab-pane fade questions-tab" id="contact"  role="tabpanel" aria-labelledby="contact-tab">
                     <h2>Questions <button type="button" onclick="showFieldEditor('recentJob');" class="edited-text orange_btn float-right"><i class="fas fa-edit"></i></button> </h2>
                            @include('site.employer.profile.tabs.questions')
                  </div> 

                  
                  <!--========================end all tabs-->
               
               </div>
            </div>