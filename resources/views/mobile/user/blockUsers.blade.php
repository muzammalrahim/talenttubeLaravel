
@extends('mobile.user.usermaster')
@section('content')

<h6 class="h6 jobAppH6">Block User's List</h6>

@if ($blockUsers->count() > 0)
@foreach ($blockUsers as $blockUser)

    {{-- @dump($likeUser->user->name) --}}

    @php
        $js = $blockUser->user;
    @endphp

{{-- @dump($js) --}}

    <div class="card border-info mb-3 shadow mb-3 bg-white rounded job_row jobApp_{{-- {{$application->id}} --}}">


        <div class="card">

            @if (isEmployer($user))
                <div class="card-header jobInfoFont jobAppHeader p-2">Job Seeker :
                    <span class="jobInfoFont">{{$js->name}} {{$js->surname}}</span>
                </div>
            @else
                <div class="card-header jobInfoFont jobAppHeader p-2">Company :
                    <span class="jobInfoFont">{{$js->name}} {{$js->surname}}</span>
                </div>

            @endif

{{-- ============================================ Card Body ============================================ --}}

            <div class="card-body jobAppBody pt-2">

                <div class="row jobInfo">

                    <div class="col-4 p-0">



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
                        <img lass="img-fluid z-depth-1" src="{{$profile_image}}">

                        {{-- <img class="img-fluid z-depth-1" src="https://media-exp1.licdn.com/dms/image/C5103AQHK0mH7N_EvGg/profile-displayphoto-shrink_200_200/0?e=1601510400&v=beta&t=mxpoqv7XzDVLr_ACQKTkPsIKa5wSLg7JMke622gyR1U" height="100px" width="100px"> --}}
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
                        <a class="btn btn-sm btn-primary mr-0 btn-xs unBlockEmpButton"  data-jsid="{{$js->id}}">UnBlock</a>
                    </div>

            </div>

{{-- ============================================ Card Footer end ============================================ --}}


        </div>

    </div>

@endforeach

@else
	<div class="jobAppH6">You have not blocked anyone</div>

@endif




{{-- ====================================== Modal Succcess on unBlocking ====================================== --}}

<div class="modal fade" id="getCodeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-notify modal-success" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <p class="heading lead">Success</p>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="text-center">
          <i class="fas fa-check fa-4x mb-3 animated rotateIn"></i>

        @if (isEmployer($user))

            <p><strong>Success!</strong> You have UnBlocked Job Seeker successfully!</p>
        @else
          <p><strong>Success!</strong> You have UnBlocked Employer successfully!</p>
        @endif
        </div>
      </div>
    </div>
  </div>
</div>

{{-- ====================================== Modal Succcess on unBlocking ====================================== --}}


@stop

@section('custom_footer_css')
@stop

@section('custom_js')

<script type="text/javascript">

{{-- ======================================================== Block Employer ======================================================== --}}

$(document).on('click','.unBlockEmpButton',function(){
    // console.log("hi unblock button")
    var btn = $(this);
    var employer_id = $(this).data('jsid');
    console.log(' Employer  ', employer_id);
    // // $(this).html(getLoader('blockJobSeekerLoader'));
    // // $(this).html('..');

    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.ajax({
        type: 'POST',
        url: base_url+'/m/ajax/MunBlockUser/'+employer_id,
        success: function(data){
            btn.prop('disabled',false);
            if( data.status == 1 ){
                // $('.empUnBlockAlert').show().delay(3000).fadeOut('slow');
                $("#getCodeModal").modal('show');

                setTimeout(() => {
                    $("#getCodeModal").modal('hide');
                },3000);

                window.setTimeout(function(){location.reload()},3000)

            }else{
                btn.html('error');
            }
        }
    });
});

{{-- ======================================================== Block Employer End Here ======================================================== --}}

</script>

@stop

