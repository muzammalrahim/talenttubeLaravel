

<div class="galleryCont">
	<div class="head2"> <i class="fas fa-clock"></i> Account Information</div>
</div>
<p> {{$jobSeeker->name}} joined talenttube at <span class="bold"> {{$historyCreated->created_at}} </span> </p>

	
@if ($history->count() > 0)

	{{-- <div class="galleryCont">
			<div class="head2"> <i class="fas fa-clock"></i> {{$hist->created_at}}</div>
	</div> --}}

	@php
		$date_pervious = null; 
	@endphp

		<div class="history mb40">

	@foreach ($history as $hist)
		 
		{{-- @dump( $hist->created_at->format('Y-m-d') ) --}}

			@if ($date_pervious &&  ($date_pervious->format('Y-m-d') != $hist->created_at->format('Y-m-d') ))
				<div class="galleryCont">
					<div class="head2"> <i class="fas fa-clock"></i> Date {{$hist->created_at->format('Y-m-d')}}</div>
				</div>
			@endif
				

			@if ($hist->type == "Salary")
				<p> <span>{{$hist->created_at->format('h:i:s')}} : </span>  <b> {{$jobSeeker->name}} </b> Updated {{$hist->type}} to <span class="bold"> {{$hist->new_salary}} </span>  </p>

			@elseif ($hist->type == "refernce_sent")
				<p> <span>{{$hist->created_at->format('h:i:s')}} : </span> <b> {{$jobSeeker->name}} </b> has sent  <b> {{$hist->reference->refType}} </b>   at <b> {{$hist->created_at}} </b> </p>

			@elseif ($hist->type == "Refernce Completed")
				<p> <span>{{$hist->created_at->format('h:i:s')}} : </span> <b> {{$jobSeeker->name}} </b> has  <b> {{$hist->reference->refType}} </b>  from  {{$hist->reference->refName}} at <b> {{$hist->created_at}} </b></p>
			
			
			@elseif ($hist->type == "Recent job")
				<p>  <span>{{$hist->created_at->format('h:i:s')}} : </span> <b> {{$jobSeeker->name}} </b> Updated  {{$hist->type}} to <span class="bold"> {{$hist->recentJob}} </span> </p>
			
			@elseif ($hist->type == "Job Applied")

				@if ($hist->jobs)
					<p> <span>{{$hist->created_at->format('h:i:s')}} : </span> <b> {{$jobSeeker->name}} </b> applied for <b> {{$hist->jobs->title}} </b> 
						<a class="jobDetailBtn graybtn jbtn viewJobDetail" target="_blank" href="{{route('jobDetail', ['id' => $hist->job_id]) }}" > View Job Detail
					</a>
					</p>
				@endif
				
			@elseif($hist->type == "User_Gallery")
				<p>  <span>{{$hist->created_at->format('h:i:s')}} : </span> <b> {{$jobSeeker->name}} </b> uploaded   new image </p>
			
			@elseif( $hist->type == "Video_upload")
				<p>  <span>{{$hist->created_at->format('h:i:s')}} : </span> <b> {{$jobSeeker->name}} </b> uploaded  new video </p>
			@elseif($hist->type == "Qualification Updated")
				<p>  <span>{{$hist->created_at->format('h:i:s')}} : </span> <b> {{$jobSeeker->name}} </b> Updated Qualification </p>
			@elseif($hist->type == "job_Status")
						{{-- @dump($hist->type) --}}
				<p>  <span>{{$hist->created_at->format('h:i:s')}} : </span> Job Status for <b> {{$jobSeeker->name}} </b> changed from "{{$hist->old_job_status}}"" to 
					"{{$hist->job_status}}" for <b> {{$hist->jobs->title}} </b> </p>

			@elseif($hist->type == "Deleted Job Application")
				<p>  <span>{{$hist->created_at->format('h:i:s')}} : </span>  <b> {{$jobSeeker->name}} </b> removed job application  from the role of <b> {{ $hist->jobs->title }} </b>
					<a class="jobDetailBtn graybtn jbtn" target="_blank" href="{{route('jobDetail',['id' => $hist->job_id])}}">See Job Detail</a>
				</p>

			@elseif($hist->type == "interview_sent")
				@if ($hist->userInterviews)
					<p>  <span>{{$hist->created_at->format('h:i:s')}} : </span>  <b> {{$jobSeeker->name}} </b> has received <b> {{ $hist->userInterviews->template->type }}
				</b>  interview of <b> {{$hist->userInterviews->template->template_name}} </b> at <b> {{$hist->created_at}}</b>
					{{-- <a class="jobDetailBtn graybtn jbtn" target="_blank" href="{{route('jobDetail',['id' => $hist->job_id])}}">See Job Detail</a> --}}
				</p>
			@endif
			

			@elseif($hist->type == "Interview Confirmed")
				@if ($hist->userInterviews)

				<p>  <span>{{$hist->created_at->format('h:i:s')}} : </span>  <b> {{$jobSeeker->name}} </b> has confirmed <b> {{ $hist->userInterviews->template->type }}
				</b>  interview of <b> {{$hist->userInterviews->template->template_name}} </b> at <b> {{$hist->created_at}}</b>
					{{-- <a class="jobDetailBtn graybtn jbtn" target="_blank" href="{{route('jobDetail',['id' => $hist->job_id])}}">See Job Detail</a> --}}
				</p>
				@endif

			@elseif($hist->type == "onlineTest_sent")
				
				<p>  <span>{{$hist->created_at->format('h:i:s')}} : </span>  <b> {{$jobSeeker->name}} </b> has received <b> {{ $hist->userOnlineTestInHistory->onlineTest->name}}
				</b>  Online Test at <b> {{$hist->created_at}}</b>
					{{-- <a class="jobDetailBtn graybtn jbtn" target="_blank" href="{{route('jobDetail',['id' => $hist->job_id])}}">See Job Detail</a> --}}
				</p>

			@elseif($hist->type == "onlineTest_comp")
				
				<p>  <span>{{$hist->created_at->format('h:i:s')}} : </span>  <b> {{$jobSeeker->name}} </b> has completed <b> {{ $hist->userOnlineTestInHistory->onlineTest->name}}
				</b>  Online Test at <b> {{$hist->created_at}}</b>
					{{-- <a class="jobDetailBtn graybtn jbtn" target="_blank" href="{{route('jobDetail',['id' => $hist->job_id])}}">See Job Detail</a> --}}
				</p>
				
			@else
				<span>{{$hist->created_at->format('h:i:s')}} : </span> The user has not any activity	
			@endif

			@php
				$date_pervious = $hist->created_at;  
			@endphp
	@endforeach

		</div>
	
@endif

{{--  
@if ($historyJobsApplied->count() > 0)
	<div class="galleryCont">
		<div class="head2"> <i class="fas fa-briefcase"></i> Jobs Applied</div>
	</div>
	@foreach ($historyJobsApplied as $hist)
		<p> <span class="bold">{{$jobSeeker->name}} </span>  applied for below jobs  </p>
		<p><span class="bold"> Job Title: </span>{{$hist->jobs->title}}</p>
		<p><span class="bold"> Job Decription: </span> {{$hist->jobs->description}}</p>
		<p><span class="bold"> Job Type: </span>{{$hist->jobs->type}}</p>
	@endforeach
@endif


@if ($historyReference->count() > 0)

	<div class="galleryCont">
		<div class="head2"> <i class="fas fa-list"></i> Completed References</div>
	</div>
	@foreach ($historyReference as $hist)
		@if($hist->type == 'Refernce Completed')
			<p> <span class="bold">{{$jobSeeker->name}} </span>  has below completed references {{$hist->reference_id}} </p>
			<p> <span class="bold"> Reference Type: </span> {{$hist->reference->refType}}  </p>
		@endif
	@endforeach
@endif


@if ($historyRecentJobs->count() > 0)		
	<div class="galleryCont">
		<div class="head2">Recent Job</div>
	</div>
	@foreach ($historyRecentJobs as $hist)
		<p> <span class="bold">{{$jobSeeker->name}} </span>  Updated Recent Job </p>
	@endforeach
@endif

@if ($historySalary->count() > 0)
	<div class="galleryCont">
		<div class="head2">Updated Salary</div>
	</div>
	@foreach ($historySalary as $hist)
		<p> <span class="bold">{{$jobSeeker->name}} </span>  Updated Salary </p>
	@endforeach
@endif --}}


<style type="text/css">
	/*.head3{font-size: 16px; color: black; background:red; font-weight: 700; }*/

	.head3 {
    font-size: 20px;
    color: black;
    font-weight: 700;
}


</style>
