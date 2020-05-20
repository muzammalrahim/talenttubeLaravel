<table id="personal_items">
    <tbody>
    <tr><th>Sexuality</th><td>{{$user->gender}}</td></tr>
    <tr><th>Eye color</th><td>{{$user->eye}}</td></tr>
    <tr><th>Kids</th><td>{{$user->family}}</td></tr>
    <tr><th>Education</th><td>{{getEducationName($user->education)}}</td></tr>
    @if (!empty( $user->language))
        @foreach ($user->language as $lang )
            <tr><th>Language</th><td>{{getLanguage($lang)}}</td></tr>
        @endforeach
    @endif

    @if (!empty( $user->hobbies))
        @foreach ($user->hobbies as $hobby )
            <tr><th>Hobbies</th><td>{{getHobby($hobby)}}</td></tr>
        @endforeach
    @endif
    </tbody>
</table>
