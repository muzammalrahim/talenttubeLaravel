@extends('admin.pdf.pdfmaster')

@section('header_css')
<style type="text/css">
  @page {
    margin: 20px !important;
    padding: 20px 10px !important;
  }
  .container{
    height:1000px;
    /*margin: 0px auto;*/
    width: 100%;
    font-size: 14px;
  }
  .header{
    height: 80px;
    width: 100%;
    text-align: center;
    /*border:1px solid black;*/
  }
  .page-break {
    page-break-after: always;
  }
  .wrapper{

    margin-top: 10px;
 }

 a.contactBtn {
    background: #384171;
    color: white;
    padding: 6px 10px;
    border-radius: 4px;
    border: 0px;
    font-size: 12px;
    text-decoration: none;
    display: inline-block;
    display: block;
    margin: 0 auto;
    width: 80px;
}
 .navbar{
  height: 300px;
  /*width: 98.7%;*/
  width: 98%;
  margin-bottom: 20px;
  /*float: left;*/
  border:1px solid black;
  padding: 0.5%;
 }
 .image{
  height: 250px;
  width: 30%;
  float: left;
  margin-right: 10px;

 }
 .rounded{
  border-radius: 20px;
/*  height: 250px;*/
 }

 .description{
/*  height: 250px;*/
  width: 67%;
  margin-top: 10px;
/*  position: relative;*/
text-align: justify;
  left: 25px;
  line-height: 25px;
  /*background: aliceblue;*/
  float:right;
 }

 .table{
    text-align: left;
    /* float: right; */
    width: 725px;
    margin: 0 auto;
    line-height: 33px;
    border:1px solid black;
    margin-top: 10px;



 }
 th{
  background: aliceblue;
 }
 th,td{
  border-bottom:1px solid black;
  padding: 10px;

 }
 /*tr{
  border-bottom: 1px solid black;
 }*/

.navbar-div{
/*  display:flex;*/
  
}
.image-div{
  height: auto;
  width: 20%;
  float: left;
}
.description-div{
  width: 80%;
  padding:0px 20px 20px 20px;
  text-align: justify
}
.image-div img{
  max-width: 90%;
    height: auto;
    margin: 0 auto;
    display: block;
}
.m-0{
  margin:0px;
}
</style>


@stop

@section('content')
  {{-- @dump($applications) --}}


  @php
  // dd($user->qualification);
  $industry_experienceData =  json_decode($job->experience);
  // ?(getIndustriesData($user->industry_experience)):(array());
 // dd( $industry_experienceData);

  $jobType = '';
  if($job->type == 'Contract')
  {
  $jobType = 'Contract';
  }
  elseif ($job->type == 'temporary') {
  $jobType = 'Temporary';
  }
  elseif ($job->type == 'casual') {
  $jobType = 'Casual';
  }
  elseif ($job->type == 'full_time') {
  $jobType = 'Full time';
  }
  elseif ($job->type == 'part_time') {
  $jobType = 'Part time';
  }

  @endphp

<div class="container">
<div class="header">
  <h1><u>Talent Tube Job</u></h1>
</div>
  <div class="navbar">
    <div class="image">
      <img src="{{$profile_image}}" class="rounded" alt="profile image" width="100%" height="">
    </div>
    <div class="description">
        <b style="margin-right: 42px;">Title:</b> {{$value = $job->title }}
        <br>
          @php 
              $remSpecialCharDesc = str_replace("\&#39;","'", $job->description);
          @endphp
         <b>Description: </b> {{$value = $remSpecialCharDesc }}
         <br>
         <b style="margin-right: 15px;">Company: </b>{{$value = $job->jobEmployer->company }}
         <br>
         <b style="margin-right: 20px;">Location: </b>{{$job->jobEmployer->country }}, {{$job->jobEmployer->state }}, {{$job->jobEmployer->city }}
         {{-- {{$value+ = $job->jobEmployer->city }} --}}
  	 </div>
</div> {{-- row --}}

   <table class="table">
    <thead>
      <tr>
        <th>Experience</th>
        <td>
            @if(!empty($industry_experienceData))
            @foreach($industry_experienceData as  $industry )
                          {{getIndustryName($industry)}}<br>
            @endforeach
        @endif
        </div></td>
        <th>Salary</th>
        <td>{{$value = $job->salary}}</td>
      </tr>

      <tr>
        <th>Job Type</th>
        <td>{{$jobType}}</td>
        <th>Posted on</th>
        <td>{{$value = $job->created_at}}</td>
      </tr>

      <tr>
        <th>Location</th>
        <td>{{$job->jobEmployer->country }}, {{$job->jobEmployer->state }}, {{$job->jobEmployer->city }}</td>
        <th>Expiration</th>
        <td>{{$value = $job->expiration}}</td>
      </tr>

    </thead>

  </table>



    @foreach($applications as $application)




    @php
      $applicationStatus = '';
  if ($application->status == 'applied') {
    $applicationStatus = 'Applied';
  }
  elseif($application->status == 'inreview'){
    $applicationStatus = 'In Review';
  }

  elseif($application->status == 'interview'){
    $applicationStatus = 'Interview';
  }else{
    $applicationStatus = 'Unsuccessful';
  }

    @endphp
    <div class="page-break"></div>
      <div class="header" >
  <h1><u>Talent Tube Job Applicants</u></h1>
  </div>
      {{-- @dump($application->id) --}}

  <div class="navbar">
        <div class="image">
            @php
              $profile_image2 = getProfileImage($application->jobseeker->id)
            @endphp
                <img src="{{$profile_image2}}" class="rounded" alt="Cinque Terre" width="100%" height="236">
                <div class="wrapper">
                    <a class="contactBtn" href="{{route('publicuservideo',['id' => $application->jobseeker->id])}}">Watch Video</a>
                </div>

      </div>

      {{-- <a class="contactBtn" href="{{route('jobSeekerInfo',['id' => $application->id])}}">Contact Details</a> --}}
        <div class="description">
         <b style="margin-right: 40px;">Name:</b> {{$application->jobseeker->name }} {{$application->jobseeker->surname }}
         <br>
         <b style="margin-right: 9px;">About Me: </b> {{$application->jobseeker->about_me }}
         <br>
         <b style="margin-right: 3px;">Recent Job: </b>{{$application->jobseeker->recentJob }}
           <br>
         <b style="margin-right: 3px;">Expected Salary: </b>{{$application->jobseeker->salaryRange }}
         <br>
         <b style="margin-right: 10px;">Job Status: </b> {{$applicationStatus }}
         <br>
         <b style="margin-right: 1px;">Interested In: </b>{{$application->jobseeker->interested_in }}
         <br>
         <b style="margin-right: 1px;">Qualification: </b>{{implode(', ',getQualificationNames($application->jobseeker->qualification))}}
         <br>
         <b style="margin-right: 1px;">Location: </b>{{$application->jobseeker->country}},{{$application->jobseeker->state}},{{$application->jobseeker->city}}

        </div>


</div>

  <table class="table">

      <tr>
        <th>Questions</th>

        <td>

{{-- @dump($application->answers) --}}

                @foreach($job->questions as $key =>$question)
                    <h4 class="m-0">{{$question->title}}</h4>
                    <p class="m-0">{{$application->answers[$key]->answer}}</p>
                @endforeach

                <div class="jobAppDescriptionBox">
                    <h4 style="margin:0px">{{jobApplicationMandatoryQuestion()}}</h4>
                    <div class="jobAppDescription">
                        <p class="m-0">{{ $application->description}}</p></div>
                </div>
        </td>




      </tr>



        {{-- @dump($job->questions) --}}

{{-- @dump($job->questions) --}}

  </table>
{{-- @dump($application->jobseeker) --}}


  @endforeach

</div> {{-- Container --}}




{{--  --}}


{{-- @dump($application->answers) --}}








@stop
