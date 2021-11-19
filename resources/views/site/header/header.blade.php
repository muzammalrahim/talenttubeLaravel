<header class="container-fluid header-section">
   <!-- for mobile view navigation as a  sidebaar -->
   <!-- =========================================================================== -->
   <div class="sidebar-header-section d-block d-lg-none">
      <div class="container-fluid">
         <div class="header  ">
            <img src="assests/images/frame1.png" alt="">
         </div>
         <input type="checkbox" name="" id="opensidebarmenu">
         <label for="opensidebarmenu" class="sidebaricontoggle">
            <div class="spinner top "></div>
            <div class="spinner middle "></div>
            <div class="spinner bottom "></div>
         </label>
         <div id="sidebarMenu" class="mobile-sidebar">
            <ul class="menu">
               <li><a href="#"><i class="fas fa-user "></i> Profile</a></li>
               <li><a href="" class="modal-dialog"><i class="fas fa-sign-in-alt"></i> Sign In</a></li>
               <!-- <li><a href="#">Have an Account?</a></li> -->
            </ul>
            <ul class="menu2">
               <!-- <li><a href="#">Home</a></li> -->
               <li><a href="#">About</a></li>
               <li><a href="#">Services</a></li>
               <li><a href="#">Blog</a></li>
            </ul>
         </div>
      </div>
   </div>
   <!-- Mobile view navigation end here -->
   <!-- =========================================================================== -->
   <!-- for windows navigation-bar -->
   <div class="window-header clearfix">
      <nav class="row navbar navbar-expand-lg d-none d-lg-flex navigation-bar navbar-light bg-transparent">
         <div class="col-md-3 col-sm-9">
            <a class="navbar-brand text-white" href="{{ route('homepage') }}"><img class="logo" src="assests/images/frame1.png" alt=""></a>
         </div>
         <div class="col-md-6">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
               aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>    
            <div class="collapse navbar-collapse header-section-nav" id="navbarSupportedContent">
               <ul class="navbar-nav mr-auto">
                  <!-- <li class="nav-item active">
                     <a class="nav-link text-white" href="#">Home </a>
                     </li> -->
                  <li class="nav-item">
                     <a class="nav-link text-white" href="#">About </a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link text-white" href="#">Contact </a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link text-white" href="#">Blog </a>
                  </li>
               </ul>
               <div class="dual-button">
                  <a href="#" data-toggle="modal" data-target="#interviewConciergeModal" class="orange_btn interview-button"><img src="assests/images/Interview-icon.svg" alt="" class="interview-icon"> <img src="assests/images/interview_hover.svg" class="interview_hover_icon" alt="" style="display: none;"> Interview concierge</a>
               </div>
            </div>
         </div>
         <div class="col-md-3 header-signin-btn" clearfix>
            <div class="form-inline account-have">
               @if (Auth::check())
               @if (isEmployer())
               <a href="{{route('employerProfile')}}" class="orange_btn"><i class="fas fa-th-large"></i> Dashboard</a>
               @elseif(isAdmin())
               <a href="{{route('adminDashboard')}}" class="orange_btn"><i class="fas fa-th-large"></i> Dashboard</a>
               @else
               <a href="{{route('profile')}}" class="orange_btn"><i class="fas fa-th-large"></i> Dashboard</a>
               @endif
               @else
               <span class="Account">HAVE AN ACCOUNT?</span>
               <a href="{{ route('signIn') }}" class="orange_btn signin" id="">SIGN IN</a>
               @endif
            </div>
         </div>
      </nav>
   </div>
</header>
<div class="modal fade" id="signin-modal" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Modal Header</h4>
         </div>
         <div class="modal-body">
            <p>Some text in the modal.</p>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>