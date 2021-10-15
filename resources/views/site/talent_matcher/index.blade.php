@extends('web.employer.employermaster') {{-- site/employer/employermaster --}}
@section('custom_css')
@stop
@section('content')
<section class="row">
   <div class="col-md-12 profile profile-section">
      <h2>Talent Matcher</h2>
      @include('web.talent_matcher.user.list') {{-- web/talent_matcher/user/list --}}
   </div>
</section>
{{-- html for talent matcher ends here --}}
@stop
@section('custom_js')
@stop
@section('custom_footer_css')
@stop