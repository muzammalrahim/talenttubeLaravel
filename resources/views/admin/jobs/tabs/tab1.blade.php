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
            
                     <div class="form-group row country_dd">
                        {{ Form::label('country', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                        {{ Form::select('country', $countries, ($record)?($record->country):null, ['placeholder' => 'Select Country']) }}
                        </div>
                    </div>

                     <div class="form-group row state_dd">
                        {{ Form::label('state', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                            {{ Form::select('state', $states ?? '', ($record)?($record->state):null, ['placeholder' => 'Select state']) }}
                        </div>
                    </div>

                     <div class="form-group row city_dd">
                        {{ Form::label('city', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                        {{ Form::select('city', $cities, ($record)?($record->city):null, ['placeholder' => 'Select state']) }}
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