
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

                   {{--      <a class="show_photo_gallery" href="{{$profile_image}}" data-lcl-thumb="{{$profile_image}}" >
                        <img  class="img-fluid z-depth-1" id="pic_main_img" src="{{$profile_image}}" title="" height="100px" width="100px">
                        </a> --}}

                           @php
                    $profile_image   = asset('images/site/icons/nophoto.jpg');
                    if ($js->profileImage){
                        $profile_image = asset('images/user/'.$js->id.'/gallery/'.$js->profileImage->image);
                    }
                    @endphp
                        <img lass="img-fluid z-depth-1" src="{{$profile_image}}">

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
                        {{$js->city}},  {{$js->state}}, {{$js->country}}
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
                        <a class="btn btn-sm btn-primary mr-0 btn-xs unlikeEmpButton" data-jsid="{{$js->id}}" data-toggle="modal" data-target="#unlikeEmpModal">UnLike</a>
                    </div>
            </div>



{{-- ============================================ Card Footer end ============================================ --}}


        </div>

    </div>






@endforeach
@else
    <div class="jobAppH6">You have not Liked anyone</div>
@endif




@stop


@section('custom_footer_css')
<style type="text/css">


</style>
@stop


{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}

{{-- <script type="text/javascript" src="{{ asset('js/mobile/likeUnlikeBlockUnblockEmp.js') }}"></script>  --}}

@section('custom_js')

<script type="text/javascript">
    $('.unlikeEmpButton').click(function(){
        // console.log('Hi Unlike Employer Button');
        var btn = $(this);
        var jobseeker_id = $(this).data('jsid');
        // console.log(' likeEmployerButton jobseeker_id ', jobseeker_id);
        $('#idEmpInModalHidden').val(jobseeker_id);

    });

    $('.confirmUnlikeEmployer').click(function(){
        // console.log('Hi Unlike Employer Button');
        var btn = $(this);
        var jobseeker_id = $(this).data('jsid');
        // console.log(' likeEmployerButton jobseeker_id ', jobseeker_id);
        var emp_id = $('#idEmpInModalHidden').val();
        console.log(emp_id);

        // $('.idEmpInModalHidden').val(jobseeker_id);
        // $('.idOfEmployerInModal').html(jobseeker_id);

            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                type: 'POST',
                url: base_url+'/m/ajax/MunLikeUser/'+emp_id,
                data: {'id': emp_id},
                success: function(data){
                   // btn.prop('disabled',false);
                    // $('.confirmJobSeekerBlockModal').removeClass('showLoader').addClass('showMessage');

                    if( data.status == 1 ){
                        $('.empLikeAlert').show().delay(3000).fadeOut('slow');
                        location.reload();

                        // $('.confirmJobSeekerBlockModal .apiMessage').html(data.message);
                        // $('.jobSeeker_row.js_'+jobseeker_id).remove();

                    }

                    // else{
                    //     $('.confirmJobSeekerBlockModal .apiMessage').html(data.error);
                    // }
                }
            });
    });

</script>
@stop

