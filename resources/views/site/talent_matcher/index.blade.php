@extends('web.employer.employermaster') {{-- web/employer/employermaster --}}
@section('custom_css')
@stop
@section('content')
<section class="row m-0">
   <div class="col-md-12 px-0">
      <div class="profile profile-section px-0">
         <h2>Talent Matcher</h2>
         @include('web.talent_matcher.user.list') {{-- web/talent_matcher/user/list --}}
      </div>
   </div>
</section>
{{-- html for talent matcher ends here --}}
@stop
@section('custom_js')

<script src="{{ asset('js/web/profile.js') }}"></script>



@stop
@section('custom_footer_css')
@stop