 
@if(isset($employers))
 

<div class="alert alert-success empLikeAlert" role="alert" style="display:none;">
          <strong>Success!</strong> You have successfully liked this Employer!
</div>

<div class="alert alert-success empBlockAlert" role="alert" style="display:none;">
          <strong>Success!</strong> You have Blocked Employer successfully!
</div>
 
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
                        <a class="jobDetailBtn graybtn jbtn m5 btn btn-sm btn-primary ml-0 btn-xs"href="{{route('MemployerInfo', ['id' => $js->id])}}">Detail</a>
                        <a class="btn btn-sm btn-primary mr-0 btn-xs blockEmployerButton" data-jsid ="{{$js->id}}">Block</a>

                        <a class="btn btn-sm btn-primary mr-0 btn-xs likeEmployerButton" data-jsid ="{{$js->id}}">Like</a>

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

{{-- ======================================================== Like Employer ======================================================== --}}

$(document).on('click','.likeEmployerButton',function(){
    var btn = $(this);
    var jobseeker_id = $(this).data('jsid');
    console.log(' likeEmployerButton jobseeker_id ', jobseeker_id);
    // $(this).html(getLoader('blockJobSeekerLoader'));
    // $(this).html('..');
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.ajax({
        type: 'POST',
        url: base_url+'/m/ajax/MlikeEmployer/'+jobseeker_id,
        success: function(data){
            btn.prop('disabled',false);
            if( data.status == 1 ){

                $('.empLikeAlert').show().delay(3000).fadeOut('slow');
                btn.html('Liked').addClass('active');
                // location.reload();

                // $(this)('.likeEmployerButton').attr("d-none");

                // $('.jobSeeker_row.js_'+jobseeker_id).remove();
                // $('.likeEmployerButton').html("Liked");
            }else{
                btn.html('error');
            }
        }
    });
});

{{-- ======================================================== Like Employer End Here ======================================================== --}}

{{-- ======================================================== Block Employer ======================================================== --}}

$(document).on('click','.blockEmployerButton',function(){
    var btn = $(this);
    var employer_id = $(this).data('jsid');
    console.log(' Employer  ', employer_id);
    // $(this).html(getLoader('blockJobSeekerLoader'));
    // $(this).html('..');

    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.ajax({
        type: 'POST',
        url: base_url+'/m/ajax/MblockEmployer/'+employer_id,
        success: function(data){
            btn.prop('disabled',false);
            if( data.status == 1 ){

                $('.empBlockAlert').show().delay(3000).fadeOut('slow');
                btn.html('Blocked').addClass('active');
                // location.reload();
                

                // $('You Have Block Employer Successfully').alert();
                // $(this)('.likeEmployerButton').attr("d-none");
                // $('.jobSeeker_row.js_'+jobseeker_id).remove();
                // $('.likeEmployerButton').html("Liked");
            }else{
                btn.html('error');
            }
        }
    });
});

{{-- ======================================================== Block Employer End Here ======================================================== --}}


</script>
