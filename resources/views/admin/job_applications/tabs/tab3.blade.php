 
<div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
       

    <div class="form-group row">
      {{ Form::label('id', null, ['class' => 'col-md-2 form-control-label']) }}
      <div class="col-md-10 row">
        {{ Form::text('id', $value = $record->job->id , $attributes = array('class'=>'form-control', 'placeholder' => 'id','required'=> 'false','disabled'=> true)) }}
      </div>
    </div>
        
    <div class="form-group row">
      {{ Form::label('title', null, ['class' => 'col-md-2 form-control-label']) }}
      <div class="col-md-10 row">
        {{ Form::text('title', $value = $record->job->title , $attributes = array('class'=>'form-control', 'placeholder' => 'Description','required'=> 'false')) }}
      </div>
    </div>

    <div class="form-group row">
      {{ Form::label('description', null, ['class' => 'col-md-2 form-control-label']) }}
      <div class="col-md-10 row">
        {{ Form::text('title', $value = $record->job->description , $attributes = array('class'=>'form-control', 'placeholder' => 'Description','required'=> 'false')) }}
      </div>
    </div>

    <div class="form-group row">
      {{ Form::label('type', null, ['class' => 'col-md-2 form-control-label']) }}
      <div class="col-md-10 row">
        {{ Form::text('type', $value = $record->job->type , $attributes = array('class'=>'form-control', 'placeholder' => 'type','required'=> 'false')) }}
      </div>
    </div>

    <div class="form-group row">
      {{ Form::label('experience', null, ['class' => 'col-md-2 form-control-label']) }}
      <div class="col-md-10 row">
        {{ Form::text('experience', $value = $record->job->experience , $attributes = array('class'=>'form-control', 'placeholder' => 'experience','required'=> 'false')) }}
      </div>
    </div>

    <div class="form-group row">
      {{ Form::label('salary', null, ['class' => 'col-md-2 form-control-label']) }}
      <div class="col-md-10 row">
        {{ Form::text('salary', $value = $record->job->salary , $attributes = array('class'=>'form-control', 'placeholder' => 'salary','required'=> 'false')) }}
      </div>
    </div>

    <div class="form-group row">
      {{ Form::label('vacancies', null, ['class' => 'col-md-2 form-control-label']) }}
      <div class="col-md-10 row">
        {{ Form::text('vacancies', $value = $record->job->vacancies , $attributes = array('class'=>'form-control', 'placeholder' => 'vacancies','required'=> 'false')) }}
      </div>
    </div>

    <div class="form-group row">
      {{ Form::label('gender', null, ['class' => 'col-md-2 form-control-label']) }}
      <div class="col-md-10 row">
        {{ Form::text('gender', $value = $record->job->gender , $attributes = array('class'=>'form-control', 'placeholder' => 'gender','required'=> 'false')) }}
      </div>
    </div>

    {{-- @dump($record->job) --}}

    <div class="form-group row">
      {{ Form::label('age', null, ['class' => 'col-md-2 form-control-label']) }}
      <div class="col-md-10 row">
        {{ Form::text('age', $value = $record->job->age , $attributes = array('class'=>'form-control', 'placeholder' => 'age','required'=> 'false')) }}
      </div>
    </div>

    <div class="form-group row">
      {{ Form::label('expiration', null, ['class' => 'col-md-2 form-control-label']) }}
      <div class="col-md-10 row">
        {{ Form::text('expiration', $value = $record->job->expiration , $attributes = array('class'=>'form-control', 'placeholder' => 'expiration','required'=> 'false')) }}
      </div>
    </div>



     <a class="btn btn-primary btnPrevious text-white text-white" onclick="scrollToTop()" >Previous</a>
     <a class="btn btn-primary btnNext text-white" style="float:right;"onclick="scrollToTop()">Next</a>
     
</div>