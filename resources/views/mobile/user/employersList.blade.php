@if(isset($employers))
@if ($employers->count() > 0)
@foreach ($employers as $js)

    {{-- @dump($job->jobEmployer->name) --}}

    <div class="card border-info mb-3 shadow mb-3 bg-white rounded job_row jobApp_{{-- {{$application->id}} --}}">


        <div class="card">

            <div class="card-header jobInfoFont jobAppHeader p-2">Company : 
                <span class="jobInfoFont">{{$js->name}}</span>
                {{-- @dump($js->id) --}}
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
                        {{$js->interested_in}}
                        </div>

                        <div class="mt-3">
                            <span class="jobInfoFont">Location</span>
                        </div>

                        <div>
                        {{($js->GeoCity)?($js->GeoCity->city_title):''}},  {{($js->GeoState)?($js->GeoState->state_title):''}}, {{($js->GeoCountry)?($js->GeoCountry->country_title):''}}
                        </div>
                        
                    </div>

                </div> 

                <div class="row p-0">

                    <div class="card-title col p-0 mt-2 mb-0 jobInfoFont">About Us</div>

                </div>


                <p class="card-text jobDetail row mb-1">{{$js->about_me}}</p>
            
            {{--     <div class="row p-0">

                    <div class="card-title col p-0 mb-0 jobInfoFont">Job Detail</div>

                </div>

                <p class="card-text jobDetail row">{{$job->description}}</p> --}}

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
<div class="employeer_pagination cpagination">{!! $employers->render() !!}</div>
@endif
@endif