@extends('web.employer.employermaster') {{-- web/employer/employermaster --}}
@section('custom_css')
@stop
@section('content')
<section class="row">
   <div class="col-md-12">
      <div class="profile profile-section">
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