<div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">

     {{--  <div class="form-group row">
            {{ Form::label('ID', null, ['class' => 'col-md-2 form-control-label']) }}
            <div class="col-md-10">
              {{ Form::text('id', $value = null, $attributes = array('class'=>'form-control','id'=>'formUserId','placeholder' => 'Id','required'=> 'false', 'disabled'=> true)) }}
            </div>
      </div> --}}

      <div class="form-group row">
          {{ Form::label('template_name', null, ['class' => 'col-md-2 form-control-label']) }}
          <div class="col-md-10">
            {{ Form::text('template_name', $value = null, $attributes = array('class'=>'form-control', 'placeholder' => 'name','required'=> 'false')) }}
          </div>
      </div>

      <div class="form-group row">
          {{ Form::label('type', null, ['class' => 'col-md-2 form-control-label']) }}
          <div class="col-md-10">
            {{ Form::select('type', $value = $template_name , $attributes = array('class'=>'form-control', 'required'=> 'false')) }}
          </div>
      </div>


      <div class="form-group row">
          {{ Form::label('Question', null, ['class' => 'col-md-2 form-control-label']) }}
          <div class="col-md-10">
            {{ Form::text('question', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Question for interview','required'=> 'false')) }}
          </div>
      </div>

      <div class="questionslist">
        
      </div>

      <span class="addTemplateQuestion btn btn-primary"style = "cursor:pointer;">+ Add Question</span> 


      <a class="btn btn-primary btnNext text-white" style="float: right;" onclick="scrollToTop()">Next</a>
  </div>


