<!-- header -->
<div class="header">
	<div class="header_w">
		<ul class="nav">
            @if (isEmployer($user))
                <li class="credits_balans_li">
                    <a class="credits_balans" id="credits_balans_header" href="{{route('premiumAccount')}}"> Premium Account</a>
                </li>
                <li><a href="{{route('employerProfile')}}"><span>Profile</span></a></li>
            @else
                <li><a href="{{route('profile')}}"><span class="jobSeekerProfileHeader">Profile</span></a></li>
            @endif
                {{-- <li><a href="" onclick="Profile.showSettingsEditor(); return false;">Update</a></li> --}}

            <li><a href="{{route('updateUserPersonalSetting')}}"><span class="jobSeekerProfileUpdate">Update</span></a></li>

            {{-- <li><a href="./upgrade">Upgrade</a></li> --}}
            
            <li><a href="{{route('logout')}}"><span class = "signOutButtonHeader">Sign out</span></a></li>
		</ul>
	</div>
</div>
<!-- /header -->
