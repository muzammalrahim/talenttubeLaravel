  
<div class="tab-pane fade" id="custom-tabs-one-seeker" role="tabpanel" aria-labelledby="custom-tabs-one-seeker-tab">
        
   <div class="form-group row">
      {{ Form::label('job seeker id', null, ['class' => 'col-md-2 form-control-label']) }}
      <div class="col-md-10 row">
        {{ Form::text('id', $value = $record->jobseeker->id, $attributes = array('class'=>'form-control', 'placeholder' => 'id','required'=> 'false','disabled'=> true)) }}
      </div>
    </div>

    <div class="form-group row">
      {{ Form::label('username', null, ['class' => 'col-md-2 form-control-label']) }}
      <div class="col-md-10 row">
        {{ Form::text('username', $value = $record->jobseeker->username, $attributes = array('class'=>'form-control', 'placeholder' => 'name','required'=> 'false')) }}
      </div>
    </div>

    
        
       {{-- @dump($record->jobseeker->id) --}}

  <a class="btn btn-primary btnPrevious text-white text-white" onclick="scrollToTop()" >Previous</a>

</div>