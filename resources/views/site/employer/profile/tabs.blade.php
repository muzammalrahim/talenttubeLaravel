



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
                     
                     {{-- ==================================== Recent job ==================================== --}}

                     <div class="about-infomation">
                        <h2>Recent Job</h2>
                            <button type="button"  onclick="showFieldEditor('recentJob');" class="edited-text"><i class="fas fa-edit"></i></button>
                        
                        <div class="recentjob">
                           <span class="recentjobSpan"> {{$user->recentJob}} </span>
                              <b class="mx-2">at</b>
                           <span class="organizationSpan"> {{$user->organHeldTitle}} </span>
                        </div>

                        <div class="row sec_recentJob d-none">
                           <div class="col-5">
                              <input type="text" name="recentJobField" class="form-control recentJobField" value="{{$user->recentJob}}">
                           </div>
                           <div class="col-1">  <span> at </span>  </div>
                           <div class="col-6">
                              <input type="text" name="organHeldTitleField" class="form-control organHeldTitleField" value="{{$user->organHeldTitle}}" onclick="showFieldEditor()">
                           </div>
                        </div>           

                        <div class="row">
                           <div class="col-md-12">
                              <div class="float-right button_recentJob d-none">
                                 <button class="cancel-button" onclick="hideFieldEditor('recentJob');">Cancel</button>
                                 <button class="orange_btn mt-2" onclick="updateRecentJob()">Save</button> 
                              </div>
                           </div>
                        </div>

                        <div class="alert alert-success alert_recentJob hide_me" role="alert">
                          <strong>Success!</strong> Recent Job has been updated successfully!
                        </div>
                     </div>

                     {{-- ==================================== About me ==================================== --}}

                     <div class="about-infomation">
                        <h2>About me</h2>
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


                    
                    <div class="about-infomation bl qualificationBox">
                        <h2>Qualification</h2>
                        <button type="button" class="edited-text" onclick="showQualificationEditor();"><i class="fas fa-edit editQualification"></i></button>
                        <p class="loader SaveQualification"style="float: left;"></p>
                              <div class="cl"></div>
                        <ul class="qualification-li">
                            <li><i class="qualification-circle"></i><span> Type: {{ ucfirst($user->qualificationType) }}</span></li>
                            <div class="">
                            @include('site.layout.parts.jobSeekerQualificationList') {{-- site/layout/parts/jobSeekerQualificationList --}}  </div>
                            <div class="button_qualification d-none "> 
                                <button class="btn-info btn-block rounded py-2 btn-sm m-0 addQualification" onclick="addQualification()" >Add New</button> 
                                 <button class="savequalification btn-block orange_btn rounded py-2 " onclick="updateQualification()">Save</button>
                              </div>
                              <div class="alert alert-success QualifAlert hide_me" role="alert">
                                <strong>Success!</strong> Qualification have been updated successfully!
                              </div>
                        </ul>
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
                                 <input type="file" id="files" name="files[]" multiple />
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
                 
                      {{-- <div class="tab_photos tab_cont"> --}}
     {{--  --}}

   {{--  </div> --}}

                  </div> 
                  <!-- ========================================== tag tab ========================================== -->

                  @include('site.user.profile.tabs.tags')

                  <!--=================job tab ============================ -->
                  
                  @include('site.user.profile.tabs.jobs')
                  
                  <!--=================referance tab=====================-->
                  
                  @include('site.user.profile.tabs.reference')
                  
                  <!--========================end all tabs-->
               
               </div>
            </div>