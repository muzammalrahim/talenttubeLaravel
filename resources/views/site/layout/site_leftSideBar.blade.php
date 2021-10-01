<div class=" col-lg-2 sidebar d-none d-lg-block d-xl-block ">
   <ul>


      <li class="logo-design"><a href="{{ route('homepage') }}"><img src="{{ asset('assests/images/frame1.png') }}"  alt=""></a></li>
      
      @if (isEmployer($user))


         {{-- <li><a href="{{ route('employerProfile') }}" class="{{(request()->is('employer/'.$user->username))?'active':''}} sidebar-text-view"><i class="fas fa-user"></i><span> My Profile</span></a></li> --}}


         <li><a href="{{ route('employerProfile') }}" class="{{(request()->is('employer/'.$user->username))?'active':''}} sidebar-text-view">
            <i class="fas fa-user"></i><span> My Profile</span></a>
         </li>


         <li><a href="{{ route('interviewconcierge') }}" class="{{(request()->is('interviewconcierge*'))?'active':''}} sidebar-text-view"><i class="far fa-address-book"></i><span> Interview Concierge</span></a>

         </li>

         <li><a href="{{ route('intetviewInvitationEmp') }}" class="{{(request()->is('intetview-invitation/emp'))?'active':''}} sidebar-text-view"><i class="fas fa-envelope-open-text"></i><span>Interview Invitations</span></a>
         </li>


         <li><a href="{{ route('employerJobs') }}" class="{{(request()->is('employer/jobs*'))?'active':''}} sidebar-text-view"><i class="fas fa-briefcase"></i><span>My Jobs</span></a>
         </li>

         <li><a href="{{ route('newJob') }}" class="{{(request()->is('employer/job/new'))?'active':''}} sidebar-text-view"><i class="fas fa-business-time"></i><span>Add New Job</span></a>
         </li>

         <li><a href="{{ route('jobSeekers') }}" class="{{(request()->is('jobSeekers'))?'active':''}} sidebar-text-view"><i class="fas fa-user-tie"></i><span>Job Seekers</span></a>

         </li>


      @else


         <li><a href="{{ route('profile') }}" class="{{(request()->is('user/'.$user->username))?'active':''}} sidebar-text-view"><i class="fas fa-user"></i><span> My Profile</span></a></li>

         <li><a href="{{ route('jobApplications') }}" class="{{(request()->is('jobApplications'))?'active':''}} sidebar-text-view"><i class="fas fa-briefcase"></i><span> My jobs Application</span></a></li>
         
         <li><a href="{{ route('interviewconcierg.user') }}" class="{{(request()->is('interviewconcierge/user'))?'active':''}} sidebar-text-view"><i class="far fa-address-book"></i><span>Interview Concierge</span></a></li>

         <li><a href="{{ route('intetviewInvitation') }}" class="{{(request()->is('intetview-invitations'))?'active':''}} sidebar-text-view"><i class="fas fa-envelope-open-text"></i><span>Interview Invitations</span></a></li>
         <li><a href="{{route('crossreference.user')}}" class="{{(request()->is('crossreference.user'))?'active':''}} sidebar-text-view"><i class="fas fa-link"></i><span>Cross Refrance</span></a></li>
         <li><a href="{{ route('jobs') }}" class="{{(request()->is('jobs'))?'active':''}} sidebar-text-view"><i class="fas fa-search"></i><span>Browse Jobs</span></a></li>

         <li><a href="{{ route('employers') }}" class="{{(request()->is('employers'))?'active':''}} sidebar-text-view"><i class="fas fa-users"></i><span>Employers</span></a></li>

         <li><a href="{{ route('testing') }}" class="{{(request()->is('testing'))?'active':''}} sidebar-text-view"><i class="fas fa-clipboard-list"></i><span>Testing</span></a></li>

      @endif

         <li><a href="{{ route('blockList') }}" class="{{(request()->is('block'))?'active':''}} sidebar-text-view"><i class="fas fa-user-lock"></i><span>Block Users</span></a></li>

         <li><a href="{{ route('likeList') }}" class="{{(request()->is('like'))?'active':''}} sidebar-text-view"><i class="fas fa-thumbs-up"></i><span>Like Users</span></a></li>


         <li><a href="{{ route('talent_matcher') }}" class="{{(request()->is('talent-matcher'))?'active':''}} sidebar-text-view"><i class="fas fa-hand-holding-usd"></i><span>Talent Matcher</span></a></li>
   </ul>
</div>