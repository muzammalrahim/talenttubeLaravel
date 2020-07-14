
<div class="tab-pane fade" id="custom-tabs-one-private" role="tabpanel" aria-labelledby="custom-tabs-one-private-tab">
        
    <div class="form-group row">
      {{ Form::label('employer_id', null, ['class' => 'col-md-2 form-control-label']) }}
      <div class="col-md-10 row">
        {{ Form::text('id', $value = $record->job->user_id , $attributes = array('class'=>'form-control', 'placeholder' => 'id','required'=> 'false','disabled'=> true)) }}
      </div>
    </div>

    

   <a class="btn btn-primary btnNext text-white" style="float:right;"onclick="scrollToTop()">Next</a>
   <a class="btn btn-primary btnPrevious text-white text-white" onclick="scrollToTop()" >Previous</a>

</div>