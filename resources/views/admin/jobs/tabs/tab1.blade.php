<div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">

                  <div class="form-group row">
                          {{ Form::label('ID', null, ['class' => 'col-md-2 form-control-label']) }}
                          <div class="col-md-10">
                            {{ Form::text('id', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Id','required'=> 'false','disabled'=> true)) }}
                          </div>
                    </div>

                     <div class="form-group row">
                        {{ Form::label('title', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                          {{ Form::text('title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'title','required'=> 'true')) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('city', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                          {{ Form::text('city', $value = null, $attributes = array('class'=>'form-control', 'placeholder' => 'city','required'=> 'false')) }}
                        </div>
                     </div>

                    <div class="form-group row">
                        {{ Form::label('state', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                          {{ Form::text('state', $value = null, $attributes = array('class'=>'form-control', 'placeholder' => 'state','required'=> 'false')) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('country', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                          {{ Form::text('country', $value = null, $attributes = array('class'=>'form-control', 'placeholder' => 'country','required'=> 'false')) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('Experience', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                          {{ Form::text('experience', $value, $attributes = array('class'=>'form-control', 'placeholder' => 'Experience','required'=> 'false')) }}
                        </div>
                    </div>

                    <div class="form-group row ">
                        {{ Form::label('Type', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                        {{ Form::select('type', $type, $record->type, ['placeholder' => 'Job Type']) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('Expiration', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                          {{ Form::text('expiration', $value = $record->expiration , $attributes = array('class'=>'form-control', 'placeholder' => 'Expiration','required'=> 'false')) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('Created At', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                          {{ Form::text('created_at', $value = $record->created_at , $attributes = array('class'=>'form-control', 'placeholder' => 'Created At','required'=> 'false')) }}
                        </div>
                    </div>

                    <div class="form-group row ">
                        {{ Form::label('Created By', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                        {{ Form::select('user_id', $user_id, null, ['placeholder' => 'Select Employer']) }}
                        </div>
                    </div>



                     <a class="btn btn-primary btnNext text-white" style="float: right;" onclick="scrollToTop()">Next</a>
  </div>
