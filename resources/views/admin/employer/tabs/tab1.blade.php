<div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">

                    <div class="form-group row">
                          {{ Form::label('ID', null, ['class' => 'col-md-2 form-control-label']) }}
                          <div class="col-md-10">
                            {{ Form::text('id', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Id','required'=> 'false','disabled'=> true)) }}
                          </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('name', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                          {{ Form::text('name', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'name','required'=> 'false')) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('email', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                          {{ Form::text('email', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'email','required'=> 'false')) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('password', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                          {{ Form::text('password', '' , $attributes = array('class'=>'form-control', 'placeholder' => 'password','required'=> 'false')) }}
                        </div>
                    </div>

                     <div class="form-group row">
                        {{ Form::label('phone', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                          {{ Form::text('phone', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Phone','required'=> 'false')) }}
                        </div>
                    </div>

                    <div class="form-group row country_dd">
                        {{ Form::label('country', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                        {{ Form::select('country', $countries, null, ['placeholder' => 'Select Country']) }}
                        </div>
                    </div>

                    <div class="form-group row state_dd">
                        {{ Form::label('state', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                            {{ Form::select('state', $states, null, ['placeholder' => 'Select state']) }}
                        </div>
                    </div>

                    <div class="form-group row city_dd">
                        {{ Form::label('city', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                        {{ Form::select('city', $cities, null, ['placeholder' => 'Select state']) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('age', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                          {{ Form::text('age', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Age','required'=> 'false')) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('bday', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-2">
                          {{ Form::select('bday', $Days, null, ['placeholder' => 'Select Day']) }}
                        </div>
                        {{ Form::label('bmonth', null, ['class' => 'col-md-1 form-control-label']) }}
                        <div class="col-md-2">
                          {{ Form::select('bmonth', $Months, null, ['placeholder' => 'Select Month']) }}
                        </div>
                        {{ Form::label('byear', null, ['class' => 'col-md-1 form-control-label']) }}
                        <div class="col-md-2">
                          {{ Form::select('byear', $years, null, ['placeholder' => 'Select Year']) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('statusText', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                          {{ Form::text('statusText', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Status Text','required'=> 'false')) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('gender', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                           {{ Form::select('gender', ['male' => 'Male', 'female' => 'Female'], null, ['placeholder' => 'Select Gender']) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('eye', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                          {{ Form::select('eye', $eyeColor, null, ['placeholder' => 'Eye Color']) }}
                        </div> 
                    </div>

                     <div class="form-group row">
                        {{ Form::label('family', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                          {{ Form::select('family', $familyType, null, ['placeholder' => 'Family Type']) }}
                        </div> 
                    </div>

                 

                     <a class="btn btn-primary btnNext text-white" style="float: right;" onclick="scrollToTop()">Next</a>
  </div>