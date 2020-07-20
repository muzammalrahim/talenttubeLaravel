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
 .navbar{
  height: 270px;
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
  /*border-radius: 20px;*/
  height: 250px;
 }
 
 .description{
  height: 250px;
  width: 67%;
  margin-top: 10px;
  position: relative;
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

</style>

  
@stop

@section('content')
  {{-- @dump($applications) --}}




{{-- @dump($users) --}}
{{-- @dump($job->jobEmployer) --}}

 {{-- <h1>Test</h1> --}}

{{-- <img src="..." class="rounded float-left" alt="..."> --}}


  
<div class="container">

<div class="header">
  <h1>Talent Tube Job</h1>
</div>

  <div class="navbar">
    <div class="image">
      <img src="https://images.pexels.com/photos/927451/pexels-photo-927451.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260" class="rounded" alt="Cinque Terre" width="100%" height="236">
    </div>

    <div class="description">
 		
        <b style="margin-right: 50px;">Title:</b> {{$value = $job->title }}
        <br>
         {{-- @dump($job) --}}
         <b>Description: </b> {{$value = $job->description }}
         <br>
         <b style="margin-right: 15px;">Company: </b>{{$value = $job->jobEmployer->name }}

         <br>
         <b style="margin-right: 17px;">Location: </b>{{$job->jobEmployer->country }}, {{$job->jobEmployer->state }}, {{$job->jobEmployer->city }}
         {{-- {{$value+ = $job->jobEmployer->city }} --}}
  
  	 </div>

</div> {{-- row --}}

   <table class="table">
    <thead>
      <tr>
        <th>Experience</th>
        <td>{{$value = $job->experience}}</td>
        <th>Salary</th>
        <td>{{$value = $job->salary}}</td>
      </tr>

      <tr>
        <th>Job Type</th>
        <td>{{$value = $job->type}}</td>
        <th>Gender</th>
        <td>{{$value = $job->gender}}</td>
      </tr>

      <tr>
        <th>Age</th>
        <td>{{$value = $job->age}}</td>
        <th>Vacancies</th>
        <td>{{$value = $job->vacancies}}</td>
      </tr>

      <tr>
        <th>Posted on</th>
        <td>{{$value = $job->created_at}}</td>
        <th>Expiration</th>
        <td>{{$value = $job->expiration}}</td>
      </tr>

      <tr>
        <th>Location</th>
        <td>{{$value = $job->city}}</td>
        <th>Expiration</th>
        <td>{{$value = $job->expiration}}</td>
      </tr>

    </thead>
   
  </table>



    @foreach($applications as $application)

      <div class="header" >
  <h1>Talent Tube Job Applicants</h1>
  </div>
      {{-- @dump($application->id) --}}

  <div class="navbar">

        <div class="image">


 {{--        @if($application->jobseeker)

            @if($application->jobseeker->profileImage)
                 <img src="{{assetGallery2($application->profileImage,'small')}}">
                 @else
                 <img src="{{asset('images/site/icons/nophoto.jpg')}}">
            @endif
        @else
          
        @endif --}}

                <img src="https://images.pexels.com/photos/927451/pexels-photo-927451.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260" class="rounded" alt="Cinque Terre" width="100%" height="236">



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
         <b style="margin-right: 10px;">Job Status: </b>{{$application->status }}
         <br>
         <b style="margin-right: 1px;">Interested In: </b>{{$application->jobseeker->interested_in }}
         <br>
         <b style="margin-right: 1px;">Qualification: </b>{{implode(', ',getQualificationNames($application->jobseeker->qualification))}}
         <br>
         <b style="margin-right: 1px;">Location: </b>{{$application->jobseeker->country}},{{$application->jobseeker->state}},{{$application->jobseeker->city}}

        </div>


</div>

  <table class="table"style="    margin-bottom: 20px;">
    <thead>
      <tr>
        <th>Questions</th>

        <td>

{{-- @dump($application->answers) --}}

                @foreach($job->questions as $question)
                      {{$question->title}}
                    @foreach($application->answers as $ans) 
                    
                      {{$ans->answer}}
                      
                    @endforeach  

                @endforeach
        </td>



       
      </tr>


    </thead>
        {{-- @dump($job->questions) --}}

{{-- @dump($job->questions) --}}
   
  </table>
{{-- @dump($application->jobseeker) --}}


  @endforeach

</div> {{-- Container --}}




{{--  --}}


{{-- @dump($application->answers) --}}






 

@stop
