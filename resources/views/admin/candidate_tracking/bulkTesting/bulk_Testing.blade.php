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
                <div class="col-sm-5"><h4 class="card-title mb-0"><small class="text-muted">Create Bulk online Test</small></h4></div>
            </div>
            <hr>
            <div class="row mt-4 mb-4">
                <div class="col">
                	<div class="tempDisplayforemployer hide_it job_row">
						<form method="POST" name="onlineTestTemplate" class="onlineTestTemplate newJob job_validation" onchange="onlineTestTemplateFunction()">
						@csrf
							<div class="row">
								<p class="col-md-3 font-weight-bold">Online Test:</p>
								<select class="templateSelect form-control col-md-9" name="templateSelect" >
									<option value="0"> Select Test</option>
									@foreach ($onlineTestTemplate as $template)
										<option value="{{ $template->id }}"> 
											{{$template->name}} 
										</option>
									@endforeach
								</select>
								<span class="btn small leftMargin turquoise interviewLoader"></span>
							</div>
						</form>

					    {{-- ========================== Get Template and questions through ajax and embed them in below div ========================== --}}
					    
					    <form method="POST" name ="sendOnlineTestConfirm" class="sendOnlineTestConfirm newJob job_validation">
					        <div class="templateData p10"></div>

					        @foreach ($jobSeekers as $us)
					        	<input type="hidden" name="user[]" value="{{$us->id}}" class="jobApp_id">
					        @endforeach
					    </form>

					</div>


                    {{-- @dd($jobSeekers) --}}

                    <div class="form-group row">
                        {{ Form::label('Users', null, ['class' => 'col-md-3 form-control-label']) }}
                        <div class="col-md-9">
                        <select name="user_ids2" multiple class="form-control" disabled>
                            @foreach ($jobSeekers as $js)
                                <option>{{$js->name.' '.$js->surname}}</option>
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

<script src="{{ asset('js/admin_custom.js') }}"></script>
<script src="{{ asset('js/jquery.multi-select.js') }}"></script>

<script type="text/javascript">
	


</script>

<script type="text/javascript"> var base_url = '{!! url('/') !!}';</script>

@stop

@section('plugins.Datatables')

@stop


