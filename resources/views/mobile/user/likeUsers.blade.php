
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



{{-- ======================================================= Unlike Employer Modal ======================================================= --}}
 

 <!-- Central Modal Medium Info -->
 <div class="modal fade" id="unlikeEmpModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-hidden="true" data-backdrop="static">
   <div class="modal-dialog modal-notify modal-danger" role="document">
     <!--Content-->
     <div class="modal-content">
       <!--Header-->
       <div class="modal-header">

         @if (isEmployer($user))
         <p class="heading lead">UnLike Jobseeker?</p>
         @else
         <p class="heading lead">UnLike Employer?</p>

     
         @endif

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>

       <!--Body-->
       <div class="modal-body">
         <div class="text-center">
           <i class="fas fa-check fa-4x mb-3 animated rotateIn"></i>

           <p>
               Are you sure you wish to continue?

           </p>
            <p class="idOfEmployerInModal"></p>
         </div>
       </div>


       <!--Footer-->
       <div class="modal-footer justify-content-center">
         <a type="button" class="btn btn-outline-danger waves-effect" data-dismiss="modal">Cancel</a>
         <a type="button" class="btn btn-danger confirmUnlikeEmployer" data-dismiss="modal" >Confirm</a>
         <input type="hidden" name="idEmpInModalHidden" id="idEmpInModalHidden" value =""/>


       </div>
     </div>
     <!--/.Content-->
   </div>
 </div>
 <!-- Central Modal Medium Info-->

{{-- ======================================================= Unlike Employer Modal ======================================================= --}}



@stop


@section('custom_footer_css')
<style type="text/css">


</style>
@stop

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

