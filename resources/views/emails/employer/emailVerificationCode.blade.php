


<h2>Hello <i>{{ $user->name }}</i></h2>
    <p><a href="{{route('accountVerification',['id' => $user->id, 'code' => $user->email_verification])}}">Please click here to find verify your email address</a></p>
Thank You,
<br/>
<i>TalentTube Admin</i>
