<!-- header -->
<div class="header">
	<div class="header_w">
		<ul class="nav">
            @if (isEmployer($user))
                <li class="credits_balans_li"><a class="credits_balans" id="credits_balans_header" href="{{route('credit')}}">0 credits</a></li>
            @endif
                <li class="selected"><span>Profile</span></li>
                <li><a href="" onclick="Profile.showSettingsEditor(); return false;">Settings</a></li>
                <li><a href="./upgrade">Upgrade</a></li>
                <li><a href="{{route('logout')}}">Sign out</a></li>
		</ul>
	</div>
</div>
<!-- /header -->
