@extends('mobile.user.usermaster') {{-- mobile/user/usermaster --}}
@section('content')

    <h6 class="h6 jobAppH6">Talent Matcher</h6>

    <!-- =============================================================================================================================== -->

 {{--    <div class="jobSeekers_list">

        @include('mobile.talent_matcher.index') <!-- mobile/talent_matcher/index -->

    </div>  --}}


    @include('mobile.talent_matcher.list') <!-- mobile/talent_matcher/list -->


@stop




{{-- <script type="text/javascript" src="https://maps.google.com/maps/api/js?libraries=places&key={{env('GOOGLE_API')}}"></script> --}}
@section('custom_js')


<script type="text/javascript">





</script>
@stop








