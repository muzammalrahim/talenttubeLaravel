<div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">

    <div class="form-group row">
      {{ Form::label('Job ID', null, ['class' => 'col-md-2 form-control-label']) }}
      <div class="col-md-10">
        {{ Form::text('id', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Id','required'=> 'false','disabled'=> true)) }}
      </div>
    </div>

    <div class="form-group row">
      {{ Form::label('job', null, ['class' => 'col-md-2 form-control-label']) }}
      <div class="col-md-10">
        {{ Form::text('job', $value = $record->job->title , $attributes = array('class'=>'form-control', 'placeholder' => 'Job Title','required'=> 'false', 'disabled'=> true)) }}
      </div>
    </div>

    <div class="form-group row">
      {{ Form::label('status', null, ['class' => 'col-md-2 form-control-label']) }}
      <div class="col-md-10">
        {{ Form::select('status', jobStatusArray(), null, ['placeholder' => 'Select Status']) }}
      </div>
    </div>

    <div class="form-group row">
      {{ Form::label('job_seeker', null, ['class' => 'col-md-2 form-control-label']) }}
      <div class="col-md-10">
        {{ Form::text('user_id', $value = $record->jobseeker->name.' '.$record->jobseeker->surname.' ('.$record->user_id.')', $attributes = array('class'=>'form-control', 'placeholder' => 'status','required'=> 'false', 'disabled'=> true)) }}
      </div>
    </div>

    <div class="form-group row">
      {{ Form::label('gold star', null, ['class' => 'col-md-2 form-control-label']) }}
      <div class="col-md-10">
        {{ Form::text('goldstar', $value = $record->goldstar , $attributes = array('class'=>'form-control', 'placeholder' => 'Gold Star','required'=> 'false', 'disabled'=> true)) }}
      </div>
    </div>

    <div class="form-group row">
      {{ Form::label('Preffer', null, ['class' => 'col-md-2 form-control-label']) }}
      <div class="col-md-10">
        {{ Form::text('preffer', $value = $record->preffer , $attributes = array('class'=>'form-control', 'placeholder' => 'Preffer','required'=> 'false', 'disabled'=> true)) }}
      </div>
    </div>

    <div class="form-group row">
      {{ Form::label('Created At', null, ['class' => 'col-md-2 form-control-label']) }}
      <div class="col-md-10">
        {{ Form::text('created_at', $value = $record->created_at , $attributes = array('class'=>'form-control', 'placeholder' => 'Created At','required'=> 'false')) }}
      </div>
    </div>

    <div class="form-group row">
      {{ Form::label('updated_at', null, ['class' => 'col-md-2 form-control-label']) }}
      <div class="col-md-10">
        {{ Form::text('updated_at', $value = $record->updated_at , $attributes = array('class'=>'form-control', 'placeholder' => 'Created At','required'=> 'false')) }}
      </div>
    </div>

     <a class="btn btn-primary btnNext text-white" style="float: right;"onclick="scrollToTop()">Next</a>
</div>