@extends('web.employer.employermaster') {{-- web/employer/employermaster --}}
@section('custom_css')
@stop
@section('content')
<section class="row m-0">
   <div class="col-md-12 px-0">
      <div class="profile profile-section px-0">
         <h2 class="ps-2">Talent Matcher</h2>
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
<style type="text/css">
   @media only screen and (max-width: 479px){
      .sidebaricontoggle {
         top: 4rem !important;
      }
      .block-box .box-footer .block-btn {
         width: 40% !important;
      }
   }
   @media only screen and (min-width: 480px) and (max-width: 991px){
      .sidebaricontoggle {
         top: 5rem !important;
      }
   }
</style>
@stop