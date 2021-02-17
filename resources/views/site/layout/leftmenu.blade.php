<div id="colfix_l_bl" class="col left to_show move">
    <div class="bl_logo">
        {{-- <a href="{{route('homepage')}}" class="logo"><img src="{{asset('/images/site/logo_inner.png')}}" style="max-width:183px; max-height: 60px;" alt="" /></a> --}}

        
        <a href="{{route('homepage')}}" class="logo"><img src="https://talenttube.tv/wp-content/themes/talenttube/images/talenttube.png" style="max-width:183px; max-height: 60px;" alt="" /></a>

    </div>
    <div id="colfix_l" class="cont col_fix">
        <ul class="nav leftmenu">

            {{-- @dump($user) --}}



            @if (isEmployer($user))
                <li><a href="{{route('employerProfile')}}" class="column_narrow_search_results {{(request()->is('employer/'.$user->username))?'active':''}}">
                <span class="icon"></span>My Profile</a></li>
                
                <li><a href="{{route('interviewconcierge')}}" class="column_narrow_search_results {{(request()->is('interviewconcierge*'))?'active':''}}"><span class="icon"></span>Interview Concierge</a></li>

                <li><a href="{{route('intetviewInvitationEmp')}}" class="column_narrow_search_results {{(request()->is('intetviewInvitationEmp'))?'active':''}}"><span class="icon"></span>Interview Invitations</a></li>
                
                <li><a href="{{route('employerJobs')}}" class="column_narrow_search_results {{(request()->is('employer/jobs*'))?'active':''}}"><span class="icon"></span>My jobs</a></li>
				<li><a href="{{route('newJob')}}" class="column_narrow_search_results {{(request()->is('employer/job/new'))?'active':''}}"><span class="icon"></span>Add New job</a></li>
                <li><a href="{{route('jobSeekers')}}" class="column_narrow_search_results {{(request()->is('jobSeekers'))?'active':''}}"><span class="icon"></span>Job Seekers</a></li>

                

            @else
                <li><a href="{{route('profile')}}" class="column_narrow_search_results {{(request()->is('user/'.$user->username))?'active':''}}">
                <span class="icon"></span>My Profile</a></li>

                <li><a href="{{route('jobApplications')}}" class="column_narrow_search_results {{(request()->is('jobApplications'))?'active':''}}"><span class="icon"></span>My jobs Application</a></li>

                <li><a href="{{route('interviewconcierg.user')}}" class="column_narrow_search_results {{(request()->is('interviewconcierg.user'))?'active':''}}"><span class="icon"></span>Interview Concierge</a></li>

                <li><a href="{{route('intetviewInvitation')}}" class="column_narrow_search_results {{(request()->is('intetviewInvitation'))?'active':''}}"><span class="icon"></span>Interview Invitations</a></li>



                <li><a href="{{route('crossreference.user')}}" class="column_narrow_search_results {{(request()->is('crossreference.user'))?'active':''}}"><span class="icon"></span>Cross Reference</a></li>


               {{--  <li><a href="{{route('intetviewInvitation')}}" class="column_narrow_search_results {{(request()->is('intetviewInvitation'))?'active':''}}"><span class="icon"></span>Interview Invitations</a></li> --}}

                <li><a href="{{route('jobs')}}" class="column_narrow_search_results {{(request()->is('jobs'))?'active':''}}"><span class="icon"></span>Browse jobs</a></li>
                <li><a href="{{route('employers')}}" class="column_narrow_search_results {{(request()->is('employers'))?'active':''}}"><span class="icon"></span>Employers</a></li>

            @endif

                <li><a href="{{route('blockList')}}" class="column_narrow_search_results {{(request()->is('block'))?'active':''}}"><span class="icon"></span>Block Users</a></li>

                {{-- Like User List --}}

                <li><a href="{{route('likeList')}}" class="column_narrow_search_results {{(request()->is('like'))?'active':''}}"><span class="icon"></span>Like Users</a></li>


                <li>
                    <a id="narrow_menu_link_31" href="{{route('mutualLikes')}}" class="column_narrow_mutual_likes {{(request()->is('mutual-likes'))?'active':''}}">
                        <span class="icon"></span>Mutual likes
                        <span id="narrow_mutual_likes_count" class="count "></span>
                    </a>
                </li>

                {{-- Liker User List End --}}

            {{-- <li>
                <a id="narrow_menu_link_27" href="messages.html" class="column_narrow_messages  ">
                    <span class="icon"></span>Messages
                    <span id="narrow_messages" class="count "></span>
                </a>
            </li> --}}

            {{-- <li>
                <a id="narrow_menu_link_28" href="./hot_or_not" class="column_narrow_hot_or_not  ">
                    <span class="icon"></span>Talent Matcher
                </a>
            </li> --}}

           {{--  <li>
                <a id="narrow_menu_link_35" href="chatroom.html" class="column_narrow_general_chat  ">
                    <span class="icon"></span>Chat rooms
                    <span id="narrow_general_chat_count" class="count "></span>
                </a>
            </li> --}}

           {{--  <li>
                <a id="narrow_menu_link_20" href="profile-vister.html" class="column_narrow_profile_visitors  ">
                    <span class="icon"></span>Profile visitors
                    <span id="narrow_visitors_count" class="count ">4</span>

                </a>
            </li> --}}



            {{-- <li>
                <a id="" href="interest-parties.html" class="column_narrow_who_likes_you  ">
                    <span class="icon"></span>Interested Parties
                    <span id="narrow_who_likes_you_count" class="count "></span>
                </a>
            </li> --}}

           {{--  <li>
                <a id="narrow_menu_link_52" href="./page?id=52" class="Jobs  inactive">
                    <span class="icon"></span>JOBS
                </a>
            </li> --}}
{{--
            <li>
                <a id="narrow_menu_link_30" href="myinterest.html" class="column_narrow_whom_you_like  ">
                    <span class="icon"></span>My Interest
                    <span id="narrow_whom_you_like_count" class="count "></span>
                </a>
            </li> --}}

           {{--  <li>
                <a id="narrow_menu_link_32" href="private-resume.html" class="column_narrow_can_see_your_private_photos  ">
                    <span class="icon"></span>Private Resume access
                    <span id="narrow_private_photo_count" class="count "></span>
                </a>
            </li> --}}

           {{--  <li>
                <a id="narrow_menu_link_23" href="./" class="column_narrow_invite  ">
                    <span class="icon"></span>Invite friends
                </a>
            </li> --}}

          {{--   <li>
                <a id="user_block_list" href="block.html" class="column_narrow_blocked menu_selected inactive">
                    <span class="icon"></span>Blocked
                    <span id="narrow_blocked_count" class="count "></span>

                </a>
            </li> --}}

        </ul>

        <div id="bl_banner_l_empty" class="bl_banner_empty"></div>
    </div>
</div>

<style>
    #colfix_l, .colfix_r_bg, .colfix_r_bg_head {
        background-color: #142d69;
    }
</style>
