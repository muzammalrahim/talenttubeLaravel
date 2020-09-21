
@extends('mobile.user.usermaster')
@section('content')
    {{-- <div class="head icon_head_browse_matches">Job Seekers List</div> --}}


<h6 class="h6 jobAppH6">Job's Applications</h6>

<!-- =============================================================================================================================== -->

<div class="jobSeekers_list">

{{-- @dump($applications) --}}
@if ($applications->count() > 0)
@foreach ($applications as $application)
	@php
           $js = $application->jobseeker;
           // dd($js);
    @endphp

    {{-- @dump($js) --}}
<div class="card border-info mb-3 shadow mb-3 bg-white rounded job_row jobApp_{{$application->id}}">
    <div class="card">
        <div class="card-header jobInfoFont jobAppHeader p-2">Name:
            <span class="jobInfoFont font-weight-normal">{{$js->name}} {{$js->surname}}</span>
                <div class="jobInfoFont">Location:
                <span class="font-weight-normal">{{($js->GeoCity)?($js->GeoCity->city_title):''}},  {{($js->GeoState)?($js->GeoState->state_title):''}}, {{($js->GeoCountry)?($js->GeoCountry->country_title):''}}</span>
                </div>
        </div>
				@php
				$profile_image  = asset('images/site/icons/nophoto.jpg');
				$profile_image_gallery    = $js->profileImage()->first();

				// dump($profile_image_gallery);

					if ($profile_image_gallery) {
								// $profile_image   = assetGallery($profile_image_gallery->access,$js->id,'',$profile_image_gallery->image);

								$profile_image   = assetGallery2($profile_image_gallery,'small');
									// dump($profile_image);

					}
				@endphp
        {{-- ============================================ Card Body ============================================ --}}
        <div class="card-body jobAppBody pt-2">

            <div class="row jobInfo">

                <div class="col-4 p-0">
                    <img class="img-fluid z-depth-1" src="{{$profile_image}}" height="100px" width="100px">
                  {{--   <div class="mt-2">
                        <span class="jobInfoFont">Location:</span>
                        {{($js->GeoCity)?($js->GeoCity->city_title):''}},  {{($js->GeoState)?($js->GeoState->state_title):''}}, {{($js->GeoCountry)?($js->GeoCountry->country_title):''}}
                    </div> --}}
                </div>
                <div class="col p-0 pl-3">
                    <div class="jobInfoFont">Recent Job</div><div>{{$js->recentJob}}</div>
                    <div class="jobInfoFont mt-2">Salary Range</div><div>{{getSalariesRangeLavel($js->salaryRange)}}</div>
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
            <p class="card-text jobDetail row mb-1 qualification dblock">{{$qnValue}}</p>


                @endforeach
             @endif
        </div>

{{-- ============================================ Card Body end ============================================ --}}


{{-- ============================================ Card Footer ============================================ --}}

        <div class="card-footer text-muted jobAppFooter p-1">
                <div class="float-right">
                    <a class="jobDetailBtn graybtn jbtn m5 btn btn-sm btn-primary ml-0 btn-xs my-3" href="{{route('MjobSeekersInfo', ['id' => $js->id])}}">View Profile</a>
                    {{-- <a class="jsBlockButton btn btn-sm btn-danger mr-0 btn-xs" data-jsid ="{{$js->id}}">Block</a> --}}
                    {{-- @if (in_array($js->id,$likeUsers)) --}}
                        {{-- <a class="btn btn-sm btn-danger mr-0 btn-xs unlikeEmpButton" data-jsid="{{$js->id}}" data-toggle="modal" data-target="#unlikeEmpModal">UnLike</a> --}}
                    {{-- @else --}}
                    <a class="jsLikeButton btn btn-sm btn-primary mr-0 btn-xs my-3" data-jsid ="{{$js->id}}">Like</a>

                    {{-- <a class="status btn btn-sm btn-primary mr-0 btn-xs" data-jsid ="{{$js->id}}">Status</a> --}}
                    {{-- @endif --}}

                    <div class="mx-2 float-right jobApplicationStatusCont">
                        <select name="jobApplicStatus" class="mdb-select sm-form colorful-select dropdown-primary select_aw jobApplicStatus" data-application_id="{{$application->id}}">
                          @foreach (jobStatusArray() as $statusK => $statusV)
                                  <option value="{{$statusK}}" {{($application->status == $statusK )?'selected="selected"':''}} >{{$statusV}}</option>
                             @endforeach
                        </select>
                    </div>

                   

      {{--               <div class="jobApplicationStatusCont dinline_block">
                        <select name="jobApplicStatus" class="select_aw jobApplicStatus" data-application_id="{{$application->id}}">
                             @foreach (jobStatusArray() as $statusK => $statusV)
                                  <option value="{{$statusK}}" {{($application->status == $statusK )?'selected="selected"':''}} >{{$statusV}}</option>
                             @endforeach
                        </select>
                    </div> --}}
                </div>
        </div>

        <div class="jobAppFooter jobAppChangeStatus" style="display: none">
            <p class="float-right mr-3 text-primary mt-3"> Updated Successfully</p>
        </div>

        <div class="jobAppFooter">
            <div class="text-center"><a class="mt-0 btn btn-primary btn-sm questionsAnswers">Questions/Answers</a></div>
                <div class="application_qa jobDetail p-2 d-none">
                    @php
                        $answers = $application->answers;     
                    @endphp
                     @if (!empty($answers))
                            <div class="jobAnswers">
                                @foreach ($answers as $answer)
                                <div class="job_answers">
                                    <div class="jqa_q font-weight-bold">{{$answer->question->title}}</div>
                                    <div class="jqa_a">{{$answer->answer}}</div>
                                </div>
                                @endforeach
                            </div>         
                     @endif
                    <div class="jobAppDescriptionBox">
                        <span class="font-weight-bold">{{jobApplicationMandatoryQuestion()}}</span>
                        <div class="jobAppDescription">{{$application->description}}</div>
                    </div>
                </div>
        </div>

{{-- ============================================ Card Footer end ============================================ --}}
    </div>
</div>
@endforeach
{{-- <div class="jobseeker_pagination cpagination">{!! $job->links() !!}</div> --}}
<div class="cl"></div>
<div class="job_pagination cpagination">{!! $applications->render() !!}</div>

@else
 <h6 class="h6 jobAppH6">No Application for this job</h6>
@endif

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
<script type="text/javascript" src="{{ asset('js/mobile/likeUnlikeBlockUnblockJS.js') }}"></script>


</div>
@stop

<script type="text/javascript" src="https://maps.google.com/maps/api/js?libraries=places&key={{env('GOOGLE_API')}}"></script>
@section('custom_js')
<script type="text/javascript">

    // change job application status, send ajax.
    $(document).on('change','select.jobApplicStatus',function(e){
        console.log(' jobApplicStatus change ', $(this));
        var statusElem = $(this);
        var status = $(this).val();
        var application_id = $(this).attr('data-application_id');
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'POST',
            url: base_url+'/m/ajax/MchangeJobApplicationStatus',
            data: {status: status, application_id: application_id},
            success: function(data){

                // var jobAppStatusHtml = '<span class="jobApplicationStatusResponse">Updated Succesfully</span>';
                // statusElem.closest('.jobApplicationStatusCont').append(jobAppStatusHtml);
                // setTimeout(function(){
                //   statusElem.closest('.jobApplicationStatusCont').find('.jobApplicationStatusResponse').remove();
                // },6000);

                $('.jobAppChangeStatus').css("display","block");

                setTimeout(function(){
                  $('.jobAppChangeStatus').hide();
                },3000);
            }
        });
    });


$('.questionsAnswers').click(function(){
    $('.application_qa').toggleClass('d-none');

})
</script>

@stop

@section('custom_css')

<style type="text/css">

.jobApplicationStatusCont{
    width: 100px;
}
input.select-dropdown.form-control {
    font-size: 12px;
}
.jobApplicationStatusResponse {
    display: block;
    position: absolute;
    font-size: 11px;
    margin: 6px;
    color: #fba82f;
}
</style>
@stop







