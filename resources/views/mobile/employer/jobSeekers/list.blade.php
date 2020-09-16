
 {{-- @dd($jobSeekers) --}}
@if(isset($jobSeekers))
@if ($jobSeekers && $jobSeekers->count() > 0)


@foreach ($jobSeekers as $js)

    {{-- @dump($js) --}}
<div class="card border-info mb-3 shadow mb-3 bg-white rounded job_row jobApp_{{-- {{$application->id}} --}}">
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
                    <img class="img-fluid z-depth-1" src="{{$profile_image}}" height="100px" width="150px">

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
                    <a class="jobDetailBtn graybtn jbtn m5 btn btn-sm btn-primary ml-0 btn-xs" href="{{route('MjobSeekersInfo', ['id' => $js->id])}}">View Profile</a>

                    <a class="jsBlockButton btn btn-sm btn-danger mr-0 btn-xs" data-jsid ="{{$js->id}}">Block</a>

                    @if (in_array($js->id,$likeUsers))
                        <a class="btn btn-sm btn-danger mr-0 btn-xs unlikeEmpButton" data-jsid="{{$js->id}}" data-toggle="modal" data-target="#unlikeEmpModal">UnLike</a>
                    @else
                    <a class="jsLikeButton btn btn-sm btn-primary mr-0 btn-xs" data-jsid ="{{$js->id}}">Like</a>

                    @endif

                </div>
        </div>

{{-- ============================================ Card Footer end ============================================ --}}


    </div>

</div>

@endforeach
<div class="jobseeker_pagination cpagination">{!! $jobSeekers->links() !!}</div>
@endif




{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
<script type="text/javascript" src="{{ asset('js/mobile/likeUnlikeBlockUnblockJS.js') }}"></script>

<script type="text/javascript">

$('.unlikeEmpButton').click(function(){
        var btn = $(this);
        var jobseeker_id = $(this).data('jsid');
        $('#idEmpInModalHidden').val(jobseeker_id);

    });


    $('.confirmUnlikeEmployer').click(function(){
        var btn = $(this);
        var jobseeker_id = $(this).data('jsid');
        var emp_id = $('#idEmpInModalHidden').val();
        console.log(emp_id);
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                type: 'POST',
                url: base_url+'/m/ajax/MunLikeUser/'+emp_id,
                data: {'id': emp_id},
                success: function(data){
                    if( data.status == 1 ){
                        $('.empLikeAlert').show().delay(3000).fadeOut('slow');
                        location.reload();
                    }
                }
            });
    });
</script>
@endif

