
@extends('mobile.user.usermaster')
@section('content')



<h6 class="h6 jobAppH6">Employer Detail Page</h6>

{{-- @if ($employers->count() > 0) --}}
{{-- @foreach ($employers as $jobs) --}}

    {{-- @dump($empquestion) --}}

    <div class="card border-info mb-3 shadow mb-3 bg-white rounded job_row jobApp_{{-- {{$application->id}} --}}">


        <div class="card">

            <div class="card-header jobInfoFont jobAppHeader p-2">Company : 
                <span class="jobInfoFont">{{$employer->name}}</span>
            </div>

{{-- ============================================ Card Body ============================================ --}}

            <div class="card-body jobAppBody pt-2">

                <div class="row jobInfo">
                   
                    <div class="col-4 p-0">
                        <img class="img-fluid z-depth-1" src="https://media-exp1.licdn.com/dms/image/C5103AQHK0mH7N_EvGg/profile-displayphoto-shrink_200_200/0?e=1601510400&v=beta&t=mxpoqv7XzDVLr_ACQKTkPsIKa5wSLg7JMke622gyR1U" height="100px" width="100px">
                    </div>

                    <div class="col p-0 pl-3">

                        <div class="jobInfoFont">Interested In</div>
                        <div>
                        {{$employer->interested_in}}
                        </div>

                        <div class="mt-3">
                            <span class="jobInfoFont">Location</span>
                        </div>
                        <div>
                        {{($employer->GeoCity->city_title)}}, {{($employer->GeoState->state_title)}},{{($employer->GeoCountry->country_title)}}
                        </div>
                        
                    </div>

                </div> 

                <div class="row p-0">
                    <div class="card-title col p-0 mt-2 mb-0 jobInfoFont">About Us</div>
                </div>
                <p class="card-text jobDetail row mb-1">{{$employer->about_me}}</p>

                <div class="row p-0">
                    <div class="card-title col p-0 mt-2 mb-0 jobInfoFont">Questions</div>
                </div>
                @php  
                        $userQuestions = !empty($user->questions)?(json_decode($user->questions, true)):(array()); 
                @endphp

                @if(!empty($empquestion))
                        @foreach($empquestion as $qk => $question)
                            <div>
                              <p class="card-text jobDetail row mb-1">{{$question}} </p>
                               <p class="card-text jobDetail row mb-1 font-weight-bold">{{$userQuestions[$qk]}}</p>
                            </div>
                        @endforeach
                @endif

            </div>

{{-- ============================================ Card Body end ============================================ --}}


{{-- ============================================ Card Footer ============================================ --}}

            <div class="card-footer text-muted jobAppFooter p-1">

                    <div class="float-right">
                        <a class="jobApplyBtn graybtn jbtn btn btn-sm btn-primary mr-0 btn-xs">Block</a>
                        <a class="jobApplyBtn graybtn jbtn btn btn-sm btn-primary mr-0 btn-xs">Like</a>
                    </div>
            </div>

{{-- ============================================ Card Footer end ============================================ --}}

        </div>

    </div> 

@stop
