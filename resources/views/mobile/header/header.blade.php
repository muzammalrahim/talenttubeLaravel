  <!--Double navigation-->


  @php
    use Carbon\Carbon;
    use App\Attachment;
  @endphp

  
  <header>
    <!-- Sidebar navigation -->
    <div id="slide-out" class="side-nav sn-bg-4">
      <ul class="custom-scrollbar">
        <!-- Logo -->
        <li>
          <div class="logo-wrapper waves-light">
              <div id="logoOverImg" class="pt-3 text-center" style="/*position:absolute; */width:auto; height:80px;">

                {{-- <a href="#"><img src="https://p16-tiktokcdn-com.akamaized.net/aweme/720x720/tiktok-obj/1646491669975042.jpeg"></a> --}}

            {{-- <a class="show_photo_gallery" href="{{$profile_image}}" data-lcl-thumb="{{$profile_image}}" >
            <img  class="photo" id="pic_main_img" src="{{$profile_image}}" title="">
            </a>
             --}}
             <h1><i class="fas fa-user-circle"></i></h1>
             {{-- <h1> <img src="{{$profile_image}}" alt="avatar mx-auto white" class="rounded-circle img-fluid" style="height: 65px"> </h1> --}}


              </div>
          </div>
        </li>
        <!--/. Logo -->

        <!--Social-->

{{--         <li>
          <ul class="social">
            <li><a href="#" class="icons-sm fb-ic"><i class="fab fa-facebook-f"> </i></a></li>
            <li><a href="#" class="icons-sm pin-ic"><i class="fab fa-pinterest"> </i></a></li>
            <li><a href="#" class="icons-sm gplus-ic"><i class="fab fa-google-plus-g"> </i></a></li>
            <li><a href="#" class="icons-sm tw-ic"><i class="fab fa-twitter"> </i></a></li>
          </ul>
        </li> --}}

        <!--/Social-->

        <!--Search Form-->
     {{--    <li>
          <form class="search-form" role="search">
            <div class="form-group md-form mt-0 pt-1 waves-light">
              <input type="text" class="form-control" placeholder="Search">
            </div>
          </form>
        </li> --}}
        <!--/.Search Form-->

        <!-- Side navigation links -->
        <li>

          <ul class="collapsible collapsible-accordion">

{{--             <li><a class="collapsible-header waves-effect arrow-r"><i class="fas fa-chevron-right"></i> Submit
                blog<i class="fas fa-angle-down rotate-icon"></i></a>
              <div class="collapsible-body">
                <ul>
                  <li><a href="#" class="waves-effect">Submit listing</a>
                  </li>
                  <li><a href="#" class="waves-effect">Registration form</a>
                  </li>
                </ul>
              </div>
            </li>

            <li><a class="collapsible-header waves-effect arrow-r"><i class="fas fa-hand-point-up"></i>
                Instruction<i class="fas fa-angle-down rotate-icon"></i></a>
              <div class="collapsible-body">
                <ul>
                  <li><a href="#" class="waves-effect">For bloggers</a>
                  </li>
                  <li><a href="#" class="waves-effect">For authors</a>
                  </li>
                </ul>
              </div>
            </li>

            <li><a class="collapsible-header waves-effect arrow-r"><i class="fas fa-eye"></i> About<i class="fas fa-angle-down rotate-icon"></i></a>
              <div class="collapsible-body">
                <ul>
                  <li><a href="#" class="waves-effect">Introduction</a>
                  </li>
                  <li><a href="#" class="waves-effect">Monthly meetings</a>
                  </li>
                </ul>
              </div>
            </li> --}}

            @if (isEmployer($user))
                <li><a href="{{route('employerProfile')}}" class="column_narrow_search_results {{(request()->is('m/employer/'.$user->username))?'active':''}}">
                <span class="icon"></span>My Profile</a></li>

                {{-- Interview Concirge  --}}

                <li><a href="{{route('MemployerJobs')}}" class="column_narrow_search_results {{(request()->is('m/Memployer/jobs*'))?'active':''}}"><span class="icon"></span>My jobs</a></li>

                <li><a href="{{route('MnewJob')}}" class="column_narrow_search_results {{(request()->is('m/employer/Mjob/new'))?'active':''}}"><span class="icon"></span>Add New job</a></li>

                <li><a href="{{route('MjobSeekers')}}" class="column_narrow_search_results {{(request()->is('m/MjobSeekers'))?'active':''}}"><span class="icon"></span>Job Seekers</a></li>


                @php
                  
                  


                //   =========================================== Paid employer viewing jobseeker ===========================================
                  $isallowed = False;
                  if ($user->employerStatus == 'paid') {
                      $empExpDate = $user->emp_status_exp;
                      $currentDate = Carbon::now();
                      $datetime1 = new DateTime($empExpDate);
                      $datetime2 = new DateTime($currentDate);
                      // $interval = $datetime1->diff($datetime2);
                      // dd($interval);
                      if ($datetime1 >= $datetime2) {
                          // $attachments = Attachment::where('user_id', $jobSeeker->id)->get();
                          $isallowed = True;
                          // $data['attachments'] = $attachments;
                      }
                      else{
                          $isallowed = False;
                          $user->employerStatus = 'unpaid';
                          $user->save();
                      }

                  }

                // =========================================== Paid employer viewing jobseeker ===========================================
                
                @endphp
                @if ($isallowed)
                  <li><a href="{{route('Swipe-jobseekers')}}" class="column_narrow_search_results {{(request()->is('m/Swipe-jobseekers'))?'active':''}}"><span class="icon"></span>Swipe Job Seekers</a></li>
                @endif
                

                <li><a href="{{route('Minterviewconcierge')}}" class="column_narrow_search_results {{(request()->is('m/Minterviewconcierge'))?'active':''}}"><span class="icon"></span>Interview Concierge</a></li>

                <li><a href="{{route('MintetviewInvitationEmp')}}" class="column_narrow_search_results {{(request()->is('m/Intetview/Invitation/emp'))?'active':''}}"><span class="icon"></span>Interview Invitations</a></li>

            @else
                <li><a href="{{route('profile')}}" class="column_narrow_search_results {{(request()->is('m/user/'.$user->username))?'active':''}}">
                <span class="icon"></span>My Profile</a></li>

                <li><a href="{{route('mJobApplications')}}" class="column_narrow_search_results {{(request()->is('m/mJobApplications'))?'active':''}}"><span class="icon"></span>My jobs Application</a></li>

                <li><a href="{{route('MintetviewInvitation')}}" class="column_narrow_search_results {{(request()->is('m/Intetview/Invitation'))?'active':''}}"><span class="icon"></span>Interview Invitations</a></li>

                
                <li><a href="{{route('Mcrossreference.user')}}" class="column_narrow_search_results {{(request()->is('m/Mcrossreference.user'))?'active':''}}"><span class="icon"></span>Cross Reference</a></li>

                <li><a href="{{route('Mjobs')}}" class="column_narrow_search_results {{(request()->is('m/Mjobs'))?'active':''}}"><span class="icon"></span>Browse jobs</a></li>

                <li><a href="{{route('Memployers')}}" class="column_narrow_search_results {{(request()->is('m/Memployers'))?'active':''}}"><span class="icon"></span>Employers</a></li>

                <li><a href="{{route('mTesting')}}" class="column_narrow_search_results {{(request()->is('m/mTesting'))?'active':''}}"><span class="icon"></span>Testing</a></li>


                
            @endif

                <li><a href="{{route('MblockList')}}" class="column_narrow_search_results {{(request()->is('m/Mblock'))?'active':''}}"><span class="icon"></span>Block Users</a></li>

                {{-- Like User List --}}

                <li><a href="{{route('MlikeList')}}" class="column_narrow_search_results {{(request()->is('m/Mlike'))?'active':''}}"><span class="icon"></span>Like Users</a></li>
                

              {{--   <li>
                    <a id="narrow_menu_link_31" href="{{route('MmutualLikes')}}" class="column_narrow_mutual_likes {{(request()->is('m/Mmutual-likes'))?'active':''}}">
                        <span class="icon"></span>Mutual likes
                        <span id="narrow_mutual_likes_count" class="count "></span>
                    </a>
                </li> --}}
{{-- 
            <li><a class="collapsible-header waves-effect arrow-r"><i class="fas fa-envelope"></i> Contact me<i
                  class="fas fa-angle-down rotate-icon"></i></a>
              <div class="collapsible-body">
                <ul>
                  <li><a href="#" class="waves-effect">FAQ</a>
                  </li>
                  <li><a href="#" class="waves-effect">Write a message</a>
                  </li>
                  <li><a href="#" class="waves-effect">FAQ</a>
                  </li>
                  <li><a href="#" class="waves-effect">Write a message</a>
                  </li>
                  <li><a href="#" class="waves-effect">FAQ</a>
                  </li>
                  <li><a href="#" class="waves-effect">Write a message</a>
                  </li>
                  <li><a href="#" class="waves-effect">FAQ</a>
                  </li>
                  <li><a href="#" class="waves-effect">Write a message</a>
                  </li>
                </ul>
              </div>
            </li> --}}

          </ul>

        </li>
        <!--/. Side navigation links -->
      </ul>
      <div class="sidenav-bg mask-strong"></div>
    </div>
    <!--/. Sidebar navigation -->
    <!-- Navbar -->
    <nav class="navbar navbar-toggleable-md navbar-expand-lg scrolling-navbar double-nav">
      <!-- SideNav slide-out button -->
      <div class="float-left scrolling">
        <a href="#" data-activates="slide-out" class="button-collapse"><i class="fas fa-bars"></i></a>
      </div>
      <!-- Breadcrumb-->
      {{-- <div class="breadcrumb-dn mr-auto">
        <p>Material Design for Bootstrap</p>
      </div> --}}

      <ul class="nav navbar-nav nav-flex-icons ml-auto mt-2">
        <li class="nav-item">
          {{-- <a class="nav-link"><i class="fas fa-envelope"></i> <span class="clearfix d-none d-sm-inline-block">Contact</span></a> --}}
        </li>

        <li class="nav-item">

          {{-- <a class="nav-link"><i class="far fa-comments"></i> <span class="clearfix d-none d-sm-inline-block">Support</span></a> --}}
          @if (isEmployer($user))
              <li class="credits_balans_li mr-2"><a class="credits_balans {{(request()->is('m/premium-account'))?'active':''}}" id="credits_balans_header" href="{{route('mPremiumAccount')}}"> Premium Account</a></li>
              <li><a href="{{route('employerProfile')}} {{(request()->is('m/employerProfile'))?'active':''}}"><span>Profile</span></a></li>
          @else
              <li><a href="{{route('profile')}}"><span class="jobSeekerProfileHeader">Profile</span></a></li>
          @endif

        </li>

        <li class="nav-item mr-2">

          {{-- <a class="nav-link"><i class="fas fa-user"></i> <span class="clearfix d-none d-sm-inline-block">Account</span></a> --}}
          
          <li><a href="{{route('MupdateUserPersonalSetting')}}"><span class="jobSeekerProfileUpdate {{(request()->is('m/MupdateUserPersonalSetting'))?'active':''}}">Update</span></a></li>


        </li>

        <li class="nav-item dropdown mr-2">

                <li><a href="{{route('logout')}}"><span class = "signOutButtonHeader">Sign out</span></a></li>

  {{--         <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Dropdown
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="#">Something else here</a>
          </div> --}}

        </li>
      </ul>

    </nav>
    <!-- /.Navbar -->
  </header>
  
  <!--/.Double navigation-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
     /* The function will add a class to disable the scroll for the page */
    $('body').on('click', '.navbar-toggleable-md .scrolling', function(){
      // console.log('The class will be added.');
      $('.container-fluid').addClass('position-fixed');
    });
    $('body').on('click', 'div#sidenav-overlay', function() {
      // console.log('The class will be removed.');
      $('.container-fluid').removeClass('position-fixed');
    });
  });
</script>