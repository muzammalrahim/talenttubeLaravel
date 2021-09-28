               

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
            @if (isEmployer($user))

               <li><a href="{{ route('homepage') }}"><img src="assests/images/frame1.png"  alt=""></a></li>

               <li><a href="{{ route('employerProfile') }}" class="{{(request()->is('employer/'.$user->username))?'active':''}} sidebar-text"><i class="fas fa-user"></i><span> My Profile</span></a></li>

               <li><a href="{{ route('interviewconcierge') }}" class="{{(request()->is('interviewconcierge*'))?'active':''}} sidebar-text"><i class="fas fa-briefcase"></i><span> Interview Concierge</span></a></li>

               <li><a href="{{ route('intetviewInvitationEmp') }}" class="{{(request()->is('intetview-invitation/emp'))?'active':''}} sidebar-text"><i class="fas fa-envelope-open-text"></i><span>Interview Invitations</span></a></li>

               <li><a href="{{ route('employerJobs') }}" class="{{(request()->is('employer/jobs*'))?'active':''}} sidebar-text"><i class="fas fa-link"></i><span>My Jobs</span></a></li>

               <li><a href="{{ route('newJob') }}" class="{{(request()->is('employer/job/new'))?'active':''}} sidebar-text"><i class="fas fa-link"></i><span>Add New JOb</span></a></li>

               <li><a href="{{ route('jobSeekers') }}" class="{{(request()->is('jobSeekers'))?'active':''}} sidebar-text"><i class="fas fa-link"></i><span>Job Seekers</span></a></li>

            @else


               <li><a href="{{ route('profile') }}" class="{{(request()->is('user/'.$user->username))?'active':''}} sidebar-text"><i class="fas fa-briefcase"></i><span> My Profile</span></a></li>

               <li><a href="{{ route('jobApplications') }}" class="{{(request()->is('jobApplications'))?'active':''}} sidebar-text"><i class="far fa-address-book"></i><span> My jobs Application</span></a></li>
               
               <li><a href="{{ route('interviewconcierg.user') }}" class="{{(request()->is('interviewconcierge/user'))?'active':''}} sidebar-text"><i class="fas fa-link"></i><span>Interview Concierge</span></a></li>

               <li><a href="{{ route('intetviewInvitation') }}" class="{{(request()->is('intetview-invitations'))?'active':''}} sidebar-text"><i class="fas fa-search"></i><span>Interview Invitations</span></a></li>

               <li><a href="{{ route('jobs') }}" class="{{(request()->is('jobs'))?'active':''}} sidebar-text"><i class="fas fa-users"></i><span>Browse Jobs</span></a></li>

               <li><a href="{{ route('employers') }}" class="{{(request()->is('employers'))?'active':''}} sidebar-text"><i class="fas fa-clipboard-list"></i><span>Employers</span></a></li>

               <li><a href="{{ route('testing') }}" class="{{(request()->is('testing'))?'active':''}} sidebar-text"><i class="fas fa-user-lock"></i><span>Testing</span></a></li>
            @endif
               <li><a href="{{ route('blockList') }}" class="{{(request()->is('block'))?'active':''}} sidebar-text"><i class="fas fa-thumbs-up"></i><span>Block Users</span></a></li>

               <li><a href="{{ route('likeList') }}" class="{{(request()->is('like'))?'active':''}} sidebar-text"><i class="fas fa-hand-holding-usd"></i><span>Like Users</span></a></li>

               <li><a href="{{ route('talent_matcher') }}" class="{{(request()->is('talent_matcher'))?'active':''}} sidebar-text"><i class="fas fa-hand-holding-usd"></i><span>Talent Matcher</span></a></li>

         </ul>
      </div>
   </div>
</div>
<!-- Mobile view navigation end here -->
<nav class="row top-nav-header">
   <div class="col-md-10 nav nav-tabs body-tab-btn clearfix" id="nav-tab" role="tablist">

      @if (isEmployer($user))

      <a href="{{ route('premiumAccount') }}">
         <button class="nav-link blue_btn p-0" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" 
         role="tab" aria-controls="nav-home" aria-selected="true"><i class="fas fa-user"></i>Premium Account</button>
      </a>
      
      @else

      <a href="{{ route('profile') }}">
         <button class="nav-link active orange_btn p-0" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" 
         type="button" role="tab" aria-controls="nav-profile" aria-selected="false"><i class="fas fa-user"></i> Profile</button>
      </a>

      @endif

      <a href="{{ route('updateUserPersonalSetting') }}">
         <button class="nav-link orange_btn p-0" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" 
         type="button" role="tab" aria-controls="nav-contact" aria-selected="false"><i class="fas fa-clipboard-list"></i> Update</button>
      </a>
   
   </div>
   <div class="col-md-2 sign-btn">
    <a href="{{ route('logout') }}">
      <button class="orange_btn signout"  type="button"><i class="fas fa-sign-out-alt"></i>Sign Out</button>
    </a>
   </div>
</nav>


<!-- ============== top buttons end =========================== -->

