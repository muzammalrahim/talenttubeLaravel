
@extends('mobile.user.usermaster')
@section('content')

 
<h6 class="h6 jobAppH6">Like User's List</h6>

@if ($likeUsers->count() > 0)
@foreach ($likeUsers as $likeUser)

    {{-- @dump($likeUser->user->name) --}}

    @php
        $js = $likeUser->user;
    @endphp

    <div class="card border-info mb-3 shadow mb-3 bg-white rounded job_row jobApp_{{-- {{$application->id}} --}}">


        <div class="card">

            <div class="card-header jobInfoFont jobAppHeader p-2">Company : 
                <span class="jobInfoFont">{{$js->name}}</span>
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
            
       

            </div>

{{-- ============================================ Card Body end ============================================ --}}


{{-- ============================================ Card Footer ============================================ --}}

            <div class="card-footer text-muted jobAppFooter p-1">

                    <div class="float-right">
                        <a class="jobApplyBtn graybtn jbtn btn btn-sm btn-primary mr-0 btn-xs">UnLike</a>
                    </div>
                    
            </div>

{{-- ============================================ Card Footer end ============================================ --}}


        </div>

    </div> 

@endforeach
@else
    <div class="jobAppH6">You have not Blocked anyone</div>
@endif     



@stop


@section('custom_footer_css')
<style type="text/css">


</style>
@stop

@section('custom_js')


@stop

