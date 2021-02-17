



{{-- <div class="form-group row"> --}}
      {{-- {{ Form::label('status', null, ['class' => 'col-md-2 form-control-label']) }} --}}
      {{-- <div class="col-md-10"> --}}
        {{ Form::select('status', jobStatusArray(), null, ['placeholder' => 'Select Status', 'class' => 'form-control pointer changeJobStatus']) }}
      {{-- </div> --}}
    {{-- </div> --}}