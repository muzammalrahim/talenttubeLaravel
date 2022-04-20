<div class=" col-lg-2 sidebar d-none d-lg-block d-xl-block ">
   <ul>


      <li class="logo-design"><a href="{{ route('homepage') }}"><img src="{{ asset('assests/images/frame1.png') }}"  alt=""></a></li>
      
      @if (isEmployer($user))

         <li>
            <a href="{{ route('employerProfile') }}" class="{{(request()->is('employer/'.$user->username))?'active':''}} sidebar-text-view">
               <div class="row px-2"><i class="fas fa-user col-2"></i><span class="col-10"> My Profile</span></div>
            </a>
         </li>

         <li>
            <a href="{{ route('interviewconcierge') }}" class="{{(request()->is('interviewconcierge*'))?'active':''}} sidebar-text-view">
               <div class="row px-2"><i class="far fa-address-book col-2"></i><span class="col-10"> Interview Concierge</span></div>
            </a>
         </li>

         <li>
            <a href="{{ route('intetviewInvitationEmp') }}" class="{{(request()->is('intetview-invitation/emp'))?'active':''}} sidebar-text-view">
               <div class="row px-2"><i class="fas fa-envelope-open-text col-2"></i><span class="col-10">Interview Invitations</span></div>
            </a>
         </li>

         <li>
            <a href="{{ route('employerJobs') }}" class="{{(request()->is('employer/jobs*'))?'active':''}} sidebar-text-view">
               <div class="row px-2"><i class="fas fa-briefcase col-2"></i><span class="col-10">My Jobs</span></div>
            </a>
         </li>

         <li>
            <a href="{{ route('newJob') }}" class="{{(request()->is('employer/job/new'))?'active':''}} sidebar-text-view">
               <div class="row px-2"><i class="fas fa-business-time col-2"></i><span class="col-10">Add New Job</span></div>
            </a>
         </li>

         <li>
            <a href="{{ route('jobSeekers') }}" class="{{(request()->is('jobSeekers'))?'active':''}} sidebar-text-view">
               <div class="row px-2"><i class="fas fa-user-tie col-2"></i><span class="col-10">Job Seekers</span></div>
            </a>
         </li>

      @else

         <li>
            <a href="{{ route('profile') }}" class="{{(request()->is('user/'.$user->username))?'active':''}} sidebar-text-view">
               <div class="row px-2"><i class="fas fa-user col-2"></i><span class="col-10"> My Profile</span></div>
            </a>
         </li>

         <li>
            <a href="{{ route('jobApplications') }}" class="{{(request()->is('jobApplications'))?'active':''}} sidebar-text-view">
               <div class="row px-2"><i class="fas fa-briefcase col-2"></i><span class="col-10"> My jobs Applications</span></div>
            </a>
         </li>
         
         <li>
            <a href="{{ route('interviewconcierg.user') }}" class="{{(request()->is('interviewconcierge/user'))?'active':''}} sidebar-text-view">
               <div class="row px-2"><i class="far fa-address-book col-2"></i><span class="col-10">Interview Concierge</span> </div> 
            </a>
         </li>

         <li>
            <a href="{{ route('intetviewInvitation') }}" class="{{(request()->is('intetview-invitations'))?'active':''}} sidebar-text-view">
               <div class="row px-2"><i class="fas fa-envelope-open-text col-2"></i><span class="col-10">Interview Invitations</span></div>
            </a>
         </li>
         <li>
            <a href="{{route('crossreference.user')}}" class="{{(request()->is('crossreference.user'))?'active':''}} sidebar-text-view">
               <div class="row px-2"><i class="fas fa-link col-2"></i><span class="col-10">Cross Reference</span></div>
            </a>
         </li>
         <li>
            <a href="{{ route('jobs') }}" class="{{(request()->is('jobs'))?'active':''}} sidebar-text-view">
               <div class="row px-2"><i class="fas fa-search col-2"></i><span class="col-10">Browse Jobs</span></div>
            </a>
         </li>

         <li>
            <a href="{{ route('employers') }}" class="{{(request()->is('employers'))?'active':''}} sidebar-text-view">
               <div class="row px-2"><i class="fas fa-users col-2"></i><span class="col-10">Employers</span></div>
            </a>
         </li>

         <li>
            <a href="{{ route('testing') }}" class="{{(request()->is('testing'))?'active':''}} sidebar-text-view">
               <div class="row px-2"><i class="fas fa-clipboard-list col-2"></i><span class="col-10">Testing</span></div>
            </a>
         </li>

      @endif

         <li>
            <a href="{{ route('blockList') }}" class="{{(request()->is('block'))?'active':''}} sidebar-text-view">
               <div class="row px-2"><i class="fas fa-user-lock col-2"></i><span class="col-10">Block Users</span></div> 
            </a>
         </li>

         <li>
            <a href="{{ route('likeList') }}" class="{{(request()->is('like'))?'active':''}} sidebar-text-view">
               <div class="row px-2"><i class="fas fa-thumbs-up col-2"></i><span class="col-10">Liked Users</span></div>
            </a>
         </li>

         <li>
            <a href="{{ route('talent_matcher') }}" class="{{(request()->is('talent-matcher'))?'active':''}} sidebar-text-view">
               <div class="row px-2"><i class="fas fa-hand-holding-usd col-2"></i><span class="col-10">Talent Matcher</span></div>
            </a>
         </li>
   </ul>
</div>