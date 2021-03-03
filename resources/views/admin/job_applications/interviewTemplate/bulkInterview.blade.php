@extends('adminlte::page')

@section('title',$title)

@section('content_header')
@stop

@section('content')

<div class="container">

    @include('admin.errors',[ 'error' => $errors, 'record' => $record ])

    {{-- @dump($jobApp) --}}

        {{-- {!! Form::open(array('url' => route('bulkIntrerview.send'), 'method' => 'POST', 'files' => true, 'name'=>'formJob', 'novalidate'=>'')) !!} --}}

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5"><h4 class="card-title mb-0"><small class="text-muted">Create Bulk Interview</small></h4></div>
            </div>
            <hr>
            <div class="row mt-4 mb-4">
                <div class="col">


                	<div class="tempDisplayforemployer hide_it job_row">
						<form method="POST" name="interviewTemplate" class="interviewTemplate newJob job_validation">
						@csrf
							<div class="row">
								<p class="col-md-3 font-weight-bold">Interview Template:</p>
								<select class="templateSelect form-control col-md-9" name="templateSelect" >
									<option value="0"> Select Template</option>
									@foreach ($interviewTemplate as $template)
										<option value="{{ $template->id }}"> 
											{{$template->template_name}} 
										</option>
									@endforeach
								</select>
								<span class="btn small leftMargin turquoise interviewLoader"></span>
							</div>
						</form>

					    {{-- ========================== Get Template and questions through aja and embed them in below div ========================== --}}
					    
					    <form method="POST" name="interviewTemplateSave" class="interviewTemplateSave newJob job_validation">
					        <div class="templateData p10"></div>

					        @foreach ($jobApplications as $jobApp)
					        	<input type="hidden" name="jobApp_id[{{$jobApp->jobseeker->id}}]" value="{{$jobApp->id}}" class="jobApp_id">
					        @endforeach
					    </form>

					</div>


                    {{-- @dd($jobSeekers) --}}

                    <div class="form-group row">
                        {{ Form::label('Users', null, ['class' => 'col-md-3 form-control-label']) }}
                        <div class="col-md-9">
                        <select name="user_ids2" multiple class="form-control" disabled>
                            @foreach ($jobApplications as $js)
                                <option>{{$js->jobseeker->name.' '.$js->jobseeker->surname}}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>


                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col"><a class="btn btn-danger btn-sm" href=" {{ url()->previous() }}">Cancel</a></div>
                {{-- <div class="col text-right"><button class="btn btn-success btn-sm pull-right" type="submit">Save</button></div> --}}
            </div>
        </div><!--card-footer-->

    </div><!--card-->

    {{-- {!! Form::close() !!} --}}

</div>

@stop

@section('css')
<link rel="stylesheet"  href="{{ asset('css/admin_custom.css') }}">
<link rel="stylesheet"  href="{{ asset('css/multi-select.css') }}">

@stop

@section('js')
    {{-- <script src="{{ asset('js/admin_custom.js') }}"></script> --}}
    <script src="{{ asset('js/jquery.multi-select.js') }}"></script>

{{-- country city state --}}
<script type="text/javascript">
	

	// =============================================== iteration-8 Interview Booking in job_applications page ===============================================

	$('.interviewTemplate').on('change',function() {
	  event.preventDefault();
	  var formData = $('.interviewTemplate').serializeArray();

	  // $('.interviewLoader').html(getLoader('pp_profile_edit_main_loader interviewTemplateLoader')).prop('disabled',true);
	  console.log(' formData ', formData);
	  // return;
	    $('.general_error1').html('');
	    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
	      $.ajax({
	          type: 'POST',
	          url: base_url+'/admin/ajax/interview/bulkInterviewTemplate',
	          data: formData,
	            success: function(data){
	              $('.interviewLoader').prop('disabled',false);
	                $('.templateData').html(data);
	            }
	      });
	});


	// ============================================ Live Interview button ============================================

	$(document).on('click' , '.liveInterviewButton', function (){
	    $('.answersInput').removeClass('d-none');
	    $('.liveInterview').removeClass('d-none'); 
	    $('.liveInterviewButton').addClass('d-none'); 
	    $('.conductInterview123').addClass('d-none');
	});



    $(document).on("click" , ".conductInterview123" , function(){
        // var inttTempId = $('.conductInterview123').val();
        // var inttTempId = $(this).attr('data-tempId');
        // var user_id = $('.jsId').val();
        // console.log(user_id);

        var formData = $('.interviewTemplateSave').serializeArray();
        console.log(formData);
        // $('.conductInterview123').html(getLoader('pp_profile_edit_main_loader conductInterviewLoader')).prop('disabled',true);
        $('.general_error1').html('');
        $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'POST',
            url: base_url+'/admin/ajax/bulk/bulkInterview/send',
            data:formData,
            success: function(response){
                if(response.status == 1){
                    
                    var message = response.message;
                    $('.recordalreadExist').removeClass('d-none').text(message);
                    $('.conductInterviewLoader').addClass('d-none');
                    $('.interviewTemplateLoader').addClass('d-none');
                    // $('.conductInterview123').html('Interview Conducted').prop('disabled',false);
                    setTimeout(function(){
                    $('.recordalreadExist').addClass('d-none'); },
                    3000);  
                    location.reload();

                    // window.location.href = "{{ route('intetviewInvitationEmp')}}" ;

                }
                else{

                    var message = response.message;
                    // var abc = response.messge
                    $('.recordalreadExist').removeClass('d-none').text(message);
                    $('.interviewTemplateLoader').addClass('d-none');
                    // $('.conductInterview123').html('Error Occured').prop('disabled',false);
                    setTimeout(function(){
                    $('.recordalreadExist').addClass('d-none'); },
                    3000);

                }
                

            }
        });

    });






</script>

<script type="text/javascript"> var base_url = '{!! url('/') !!}';</script>

@stop

@section('plugins.Datatables')

@stop


