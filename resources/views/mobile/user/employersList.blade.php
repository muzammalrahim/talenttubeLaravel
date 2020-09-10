 
@if(isset($employers))

@if ($employers->count() > 0)
@foreach ($employers as $js)

    {{-- @dump($profile_image) --}}

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


                   {{--      <a class="show_photo_gallery" href="{{$profile_image}}" data-lcl-thumb="{{$profile_image}}" >
                            <img  class="photo" id="pic_main_img" src="{{$profile_image}}" title="">
                        </a> --}}


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

                {{-- @dump($likeUsers); --}}


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
                        <a class="jobDetailBtn graybtn jbtn m5 btn btn-sm btn-primary ml-0 btn-xs" href="{{route('MemployerInfo', ['id' => $js->id])}}">Detail</a>
                        <a class="btn btn-sm btn-danger mr-0 btn-xs blockEmployerButton" data-jsid ="{{$js->id}}">Block</a>

                        @if (in_array($js->id,$likeUsers))

                        <a class="btn btn-sm btn-danger mr-0 btn-xs unlikeEmpButton" data-jsid="{{$js->id}}" data-toggle="modal" data-target="#unlikeEmpModal">UnLike</a>
                        @else
                        <a class="btn btn-sm btn-primary mr-0 btn-xs likeEmployerButton" data-jsid ="{{$js->id}}">Like</a>

                        @endif
                    </div>
                    
            </div>

{{-- ============================================ Card Footer end ============================================ --}}


        </div>

    </div> 

 

@endforeach
<div class="employeer_pagination cpagination">{!! $employers->render() !!}</div>
@endif
@endif
 

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


