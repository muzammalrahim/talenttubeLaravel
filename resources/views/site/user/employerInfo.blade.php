{{-- @extends('site.user.usertemplate') --}}
@extends('web.user.usermaster')

@section('custom_css')
{{-- <link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}"> --}}
{{-- <link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}"> --}}
@stop

@section('content')

  <section class="row">
     <div class="col-md-12">
     @php
     $js = $employer;
     @endphp
     <div class="profile profile-section">
        <h2>Employers Detail</h2>
        <!-- Top Filter Row -->
        <div class="row">
           <div class="col-sm-12 col-md-12">
              <div class="job-box-info employee-details-info block-box clearfix">
                 <div class="box-head">
                    @php
                    $dist = calculate_distance($js, $user);
                    $ind_exp = cal_ind_exp($js,$user);
                    $compatibility = compatibility($js, $user); 
                    $user_compat = $compatibility*20;
                    $emp_questions = json_decode($js->questions , true);
                    $user_questions = json_decode($user->questions , true);
                    $emp_resident = '';
                    $user_resident = '';
                    if ($emp_questions != null && $user_questions != null) {
                    $emp_match = array_slice($emp_questions, 5, 6, true);
                    foreach ($emp_match as $key => $value) {
                    $emp_resident .= $value;
                    }
                    $user_match = array_slice($user_questions, 5, 6, true);
                    foreach ($user_match as $key => $value) {
                    $user_resident .= $value;
                    }
                    }
                    @endphp
                    @if ($emp_resident == 'no' && $user_resident == 'no')
                    <h4 class="text-danger bold w50"> No Match Potential </h4>
                    @else
                    @if ($dist < 50 && !empty($ind_exp))
                    <h4 class="text-green bold w50"> Strong Match Potential </h4>
                    @elseif($dist < 50 )
                    <h4 class="text-orange bold w50"> Moderate Match Potential  </h4>
                    @elseif(!empty($ind_exp))
                    <h4 class="text-orange w50"> Moderate Match Potential </h4>
                    @else
                    <h4 class="text-danger bold w50"> No Match Potential </h4>
                    @endif
                    @endif                        
                 </div>
                 <div class="row Block-user-wrapper">
                    <div class="col-md-3 user-images">
                       <div class="block-user-img ">
                          @php
                          $profile_image  = asset('images/site/icons/nophoto.jpg');
                          $profile_image_gallery    = $js->profileImage()->first();
                          if ($profile_image_gallery) {
                          $profile_image   = assetGallery2($profile_image_gallery,'small');
                          }
                          @endphp
                          <img src="{{$profile_image}}" alt="">
                       </div>
                       <div class="block-user-progress ">
                          <h6>{{$js->name}} {{$js->surname}}</h6>
                          <div class="progress-img"> <img src="assests/images/user-progressbar.svg" alt=""></div>
                          <div class="block-progrees-ratio d-block d-md-none">
                          </div>
                       </div>
                    </div>
                    <div class="col-md-9 user-details">
                       {{-- ============================================= Pie Chart =============================================  --}}
                       <div class="w50">
                          <div id="piechart_{{$js->id}}"></div>
                       </div>
                       <script type="text/javascript">
                          google.charts.load('current', {'packages':['corechart']});
                          google.charts.setOnLoadCallback(drawChart);
                            function drawChart() {
                              var data = google.visualization.arrayToDataTable([
                              ['Task', 'Potenial'],
                              ['Match', {{ $user_compat }}],
                              ['Unmatch',100-{{ $user_compat }}],
                            ]);
                            var options = { 'width':300, 'height':160, tooltip: { isHtml: true }, };
                            var chart = new google.visualization.PieChart(document.getElementById('piechart_'+{{$js->id}}));
                            chart.draw(data, options);
                          }
                       </script>
                       {{-- ============================================= Pie Chart =============================================  --}}
                       <div class="mt-2 row blocked-user-about">
                          <h6 class="p-0">About me:</h6>
                          <p class="">{{$js->about_me}}</p>
                       </div>
                       <div class="mt-2 row blocked-user-about">
                          <h6 class="p-0">Intrested In:</h6>
                          <p class="">{{$js->interested_in}}</p>
                       </div>
                       <div class="mt-2 row blocked-user-about">
                          <h6 class="p-0">Location:</h6>
                          <p class="">{{$js->city}},  {{$js->state}}, {{$js->country}}</p>
                       </div>
                       <div class="mt-2 row blocked-user-experience">
                          <h6 class="p-0">Industory Experience:</h6>
                          @if(isset($js->industry_experience))
                          <ul class="p-0">
                             @foreach ($js->industry_experience as $ind) 
                             <li class="indsutrySelect">
                                <p>{{getIndustryName($ind)}} </p>
                             </li>
                             @endforeach 
                          </ul>
                          @endif 
                       </div>
                    </div>
                 </div>
                 <div class="box-footer clearfix">
                    <div class="block-progrees-ratio d-none d-md-block">
                    </div>
                    <button class="unblock-btn" onclick="blockFunction('{{ $js->id }}')"><i class="fas fa-ban"></i> Block</button> 
                    @if (in_array($js->id,$likeUsers))
                    <button class="like-btn"><i class="fas fa-thumbs-up"></i> Liked</button>
                    @else
                    <button class="like-btn" data-toggle="modal" data-target="#myModal999"><i class="fas fa-thumbs-up"></i> Like</button>
                    @endif                         
                 </div>
              </div>
           </div>
        </div>
        <div class="profile">
           <ul class="nav nav-tabs employee-tab-info" id="Profile-tab" role="tablist">
              <span class="line-tab"></span>
              <li class="nav-item" role="presentation">
                 <button class="nav-link active" id="job-tab" data-bs-toggle="tab" data-bs-target="#job"
                    type="button" role="tab" aria-controls="job" aria-selected="false">
                 <i class="fa fa-circle tab-circle-cross"></i>Job</button>
              </li>
              <li class="nav-item" role="presentation">
                 <button class="nav-link" id="profile-tab1" data-bs-toggle="tab" data-bs-target="#profile"
                    type="button" role="tab" aria-controls="profile" aria-selected="false">
                 <i class="fa fa-circle tab-circle-cross"></i>Album</button>
              </li>
              <li class="nav-item" role="presentation">
                 <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                    type="button" role="tab" aria-controls="contact" aria-selected="false">
                 <i class="fa fa-circle tab-circle-cross"></i>Questions</button>
              </li>
           </ul>
           <div class="tab-content employee-details-infomation" id="myTabContent">
              <!--=================job tab ============================ -->
              <div class="tab-pane fade show active job-applied" id="job"  role="tabpanel" aria-labelledby="job-tab">
                 {{-- <h2>Jobs I Have Applied</h2> --}}
                 <div class="row">
                  @include('site.user.employerInfoTabs.jobs')
                 </div>
              </div>
              <!--================== album-tab-->
              <div class="album-section tab-pane fade Photos " id="profile" role="tabpanel"
                 aria-labelledby="profile-tab">
                 @include('site.user.employerInfoTabs.album')
              </div>
              <!--====================== question tab===========================-->
              <div class="tab-pane fade questions-tab" id="contact"  role="tabpanel" aria-labelledby="contact-tab">
                 <h2>Questions</h2>
                 @include('site.user.employerInfoTabs.emp_questions')  {{-- site/user/employerInfoTabs/emp_questions --}}
              </div>
              <!--========================end all tabs-->
           </div>
        </div>
     </div>
  </section>


  <!-- ====================================================================================Modal -->
  <div class="modal fade" id="myModal333" role="dialog">
    <div class="modal-dialog delete-applications">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <i data-dismiss="modal" class="close-box fa fa-times"></i><i ></i>                      
          <h1 class="modal-title"><i class="fas fa-ban trash-icon"></i>Block User</h1>
        </div>
        <div class="modal-body">
          <strong>Are you sure you wish to continue?</strong>
        </div>
        <div class="dual-footer-btn">
          <button type="button" class="btn btn-default black_btn" data-dismiss="modal"><i class="fa fa-times"></i>Cancel</button>
          <button type="button" class="orange_btn"><i class="fa fa-check"></i>OK</button>
        </div>
      </div>
    </div>
  </div>


  <!-- ====================================================================================Modal -->

  <div class="modal fade" id="myModal999" role="dialog">
    <div class="modal-dialog delete-applications">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <i data-dismiss="modal" class="close-box fa fa-times"></i><i ></i>                      
          <h1 class="modal-title"><i class="fas fa-thumbs-up trash-icon"></i>Like User</h1>
        </div>
        <div class="modal-body">
          <strong>Are you sure you wish to continue?</strong>
        </div>
        <div class="dual-footer-btn">
          <button type="button" class="btn btn-default black_btn" data-dismiss="modal"><i class="fa fa-times"></i>Cancel</button>
          <button type="button" class="orange_btn"><i class="fa fa-check"></i>OK</button>
        </div>
      </div>
    </div>
  </div>

@stop

@section('custom_footer_css')
   <style type="text/css">
      
   </style>
@stop

@section('custom_js')

{{-- <script src="{{ asset('js/site/common.js') }}"></script> --}}
<script src="{{ asset('js/site/common.js') }}"></script>
<script src="{{ asset('js/site/jquery-ui.js') }}"></script>

<script src="{{ asset('js/web/profile.js') }}"></script>
<script type="text/javascript">

</script>
@stop
