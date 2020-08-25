
@extends('mobile.employer.usermaster')
@section('content')


 
<h6 class="h6 jobAppH6">Job Seekeers</h6>

 

@if ($jobSeekers->get() && $jobSeekers->count() > 0)


@foreach ($jobSeekers->get()  as $js)    
	
	{{-- @dump($js) --}}
<div class="card border-info mb-3 shadow mb-3 bg-white rounded job_row jobApp_{{-- {{$application->id}} --}}">


    <div class="card">

            <div class="card-header jobInfoFont jobAppHeader p-2">Name:
                <span class="jobInfoFont font-weight-normal">{{$js->name}} {{$js->surname}}</span>

                    <div class="jobInfoFont">Location:
                    <span class="font-weight-normal">{{($js->GeoCity)?($js->GeoCity->city_title):''}},  {{($js->GeoState)?($js->GeoState->state_title):''}}, {{($js->GeoCountry)?($js->GeoCountry->country_title):''}}</span>
                    </div>

            </div>



{{-- ============================================ Card Body ============================================ --}}

		<div class="card-body jobAppBody pt-2">

		    <div class="row jobInfo">
		       
		        <div class="col-4 p-0">
		            <img class="img-fluid z-depth-1" src="https://media-exp1.licdn.com/dms/image/C5103AQHK0mH7N_EvGg/profile-displayphoto-shrink_200_200/0?e=1601510400&v=beta&t=mxpoqv7XzDVLr_ACQKTkPsIKa5wSLg7JMke622gyR1U" height="100px" width="150px">

		          {{--   <div class="mt-2">
		                <span class="jobInfoFont">Location:</span>
		                {{($js->GeoCity)?($js->GeoCity->city_title):''}},  {{($js->GeoState)?($js->GeoState->state_title):''}}, {{($js->GeoCountry)?($js->GeoCountry->country_title):''}}
		            </div> --}}
		       

		        </div>


		        <div class="col p-0 pl-3">

		            <div class="jobInfoFont">Recent Job</div>
		            <div>
		            {{$js->recentJob}}
		            </div>

		            {{-- <div class="jobInfoFont mt-2">Interested In</div>
		            <div>
		            {{$js->interested_in}}
		            </div> --}}

		            <div class="jobInfoFont mt-2">Salary Range</div>
		            <div>
		            {{getSalariesRangeLavel($js->salaryRange)}}
		            </div>


		            
		        </div>

		    </div> 

		    <div class="row p-0">
		        <div class="card-title col p-0 mt-2 mb-0 jobInfoFont">Interested In</div>
		    </div>
		    <p class="card-text jobDetail row mb-1">{{$js->interested_in}}</p>
		    

		    <div class="row p-0">
		        <div class="card-title col p-0 mt-2 mb-0 jobInfoFont">About Me</div>
		    </div>
		    <p class="card-text jobDetail row mb-1">{{$js->about_me}}</p>

		    <div class="row p-0">
		        <div class="card-title col p-0 mt-2 mb-0 jobInfoFont">Qualification</div>
		    </div>

		    @php
	         $qualification_names =  getQualificationNames($js->qualification)
	        @endphp
	        
	         @if(!empty($qualification_names))
	            @foreach ($qualification_names as $qnKey => $qnValue) 

	               {{-- <span class="qualification dblock">{{$qnValue}}</span> --}}

		    <p class="card-text jobDetail row mb-1 qualification dblock">{{$qnValue}}</p>


	            @endforeach
	         @endif

		    {{-- <p class="card-text jobDetail row mb-1 qualification dblock">{{$qnValue}}</p> --}}


		</div>

{{-- ============================================ Card Body end ============================================ --}}


{{-- ============================================ Card Footer ============================================ --}}

        <div class="card-footer text-muted jobAppFooter p-1">

                <div class="float-right">
                    <a class="jobDetailBtn graybtn jbtn m5 btn btn-sm btn-primary ml-0 btn-xs"href="{{route('MemployerInfo', ['id' => $js->id])}}">Detail</a>
                    <a class="jobApplyBtn graybtn jbtn btn btn-sm btn-primary mr-0 btn-xs">Block</a>

                    <a class="jobApplyBtn graybtn jbtn btn btn-sm btn-primary mr-0 btn-xs">Like</a>

                </div>
                
        </div>

{{-- ============================================ Card Footer end ============================================ --}}


    </div>

</div>

@endforeach
@endif



@stop


@section('custom_footer_css')
<style type="text/css">


</style>
@stop

@section('custom_js')


@stop

