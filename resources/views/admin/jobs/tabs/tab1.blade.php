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
                        <div class="col-md-12">
                            <div id="accordion">
                                <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                    <button class="btn btn-link" data-toggle="collapse" onclick="return false;" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                       Location:
                                    </button>
                                    </h5>
                                </div>

                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                        <input class="form-control mb-2" type="text" placeholder="" value="{{userLocation($record)}}" id="location_search">
                                        <div class="form-control" style="height: 200px; background-color: rgba(255,0,0,0.1);" id="location_map">
                                        </div>
                                        <button type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"  class="mt-2 btn btn-outline-warning saveNewLocation">Save</button>
                                    </div>


                                    <div class="location_latlong">
                                    {{ Form::hidden('location_lat', $value = null, $attributes = array('class'=>'form-control', 'placeholder' => 'location_lat','required'=> 'false', 'id' => 'location_lat')) }}
                                    {{ Form::hidden('location_long', $value = null, $attributes = array('class'=>'form-control', 'placeholder' => 'location_long','required'=> 'false', 'id' => 'location_long')) }}
                                    {{ Form::hidden('location', $value = null, $attributes = array('class'=>'form-control', 'placeholder' => 'location','required'=> 'false', 'id' => 'location_name')) }}
                                    {{ Form::hidden('city', $value = null, $attributes = array('class'=>'form-control', 'placeholder' => 'city','required'=> 'false', 'id' => 'location_city')) }}
                                    {{ Form::hidden('state', $value = null, $attributes = array('class'=>'form-control', 'placeholder' => 'state','required'=> 'false', 'id' => 'location_state')) }}
                                    {{ Form::hidden('country', $value = null, $attributes = array('class'=>'form-control', 'placeholder' => 'country','required'=> 'false', 'id' => 'location_country')) }}
                                    <input type="hidden" name="user_id" id="user_id"  value="{{$record->id}}">
                                    </div>

                                </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="mb-2 bg-secondary text-white text-center"><b>Industry</b></div>

                    <div class="form-group row">

                        {{ Form::label('industry', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                            @php
                             $industry_experience = json_decode($record->experience);
                            @endphp

                        <div class="IndusList">
                          @if(!empty($industry_experience))
                            @foreach($industry_experience as $industry )

                                <div class="IndusSelect">
                                    <select name="industry_experience[]">
                                    @if(!empty($industriesList))
                                    @foreach($industriesList as $lk=>$lv)
                                        <option value="{{$lk}}" {{($lk == $industry)?('selected="selected"'):''  }} >{{$lv}}</option>
                                    @endforeach
                                    @endif
                                    </select>
                                    <span class="removeIndus btn btn-danger">Remove</span>
                                </div>
                            @endforeach
                        @endif
                        </div>
                        <span class="addIndus btn btn-primary"style = "cursor:pointer;">+ Add</span>
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
