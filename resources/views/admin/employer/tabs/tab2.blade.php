<div class="tab-pane fade " id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                  
                    <div class="mb-2 bg-secondary text-white text-center"><b>Profile</b></div>

                                             {{-- For putting img --}}
            <div class="col-md-12 row">

                <div class="col-md-9">

                    <div class="form-group row">
                        {{ Form::label('about_me', null, ['class' => 'col-md-3 form-control-label']) }}
                        <div class="col-md-9">
                          {{ Form::text('about_me', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'About me','required'=> 'false')) }}
                        </div> 
                    </div>

                   <div class="form-group row">
                        {{ Form::label('interested_in', null, ['class' => 'col-md-3 form-control-label']) }}
                        <div class="col-md-9">
                          {{ Form::text('interested_in', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Interested in ','required'=> 'false')) }}
                        </div> 
                    </div>

                    <div class="form-group row">
                        {{ Form::label('Company', null, ['class' => 'col-md-3 form-control-label']) }}
                        <div class="col-md-9">
                          {{ Form::text('company', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Company ','required'=> 'false')) }}
                        </div> 
                    </div>

                </div>

                    <div class="col-md-3">
                     {{--    @dump($record->profileImage->image)

                        @php
                            $profile_image   = asset('images/site/icons/nophoto.jpg');
                            if ($record->profileImage){
                                $profile_image = asset('images/user/'.$record->id.'/gallery/'.$record->profileImage->image);
                            }
                        @endphp
                        <img class="js_photo w100" id="pic_main_img" src="{{$profile_image}}"> --}}

                        <img class="userimg" src="https://image.shutterstock.com/image-photo/stunning-view-pakistan-monument-heart-600w-1516516472.jpg" >
                     </div> 
            </div>     

                         {{-- Img Putting End here --}}
                  
                    <div class="mb-2 bg-secondary text-white text-center"><b>Qualification</b></div>


                   <div class="form-group row">
                        {{ Form::label('education', null, ['class' => 'col-md-2 form-control-label']) }}
                         <div class="col-md-10">
                        {{ Form::select('education', $educationDropdown, null, ['placeholder' => 'Select Education']) }}
                        </div> 
                    </div>
                <div class="mb-2 bg-secondary text-white text-center"><b>Tags</b></div>


                     <div class="form-group row">
                  
                        {{ Form::label('language', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                        <div class="langList">
                          @if(!empty($record->language))
                            @if( is_array($record->language))
                                @foreach( $record->language as $lang )
                                    <div class="langSelect">
                                        <select name="language[]">
                                        @if(!empty($languages))
                                        @foreach($languages as $lk=>$lv)
                                            <option value="{{$lk}}" {{($lk == $lang)?('selected="selected"'):''  }} >{{$lv}}</option>
                                        @endforeach
                                        @endif
                                        </select>
                                        <span class="removeLang btn btn-danger">Remove</span>
                                    </div>
                                @endforeach
                            
                            @else 
                                 <div class="langSelect">
                                        <select name="language[]">
                                        @if(!empty($languages))
                                        @foreach($languages as $lk=>$lv)
                                            <option value="{{$lk}}" {{($lk == $record->language)?('selected="selected"'):''  }} >{{$lv}}</option>
                                        @endforeach
                                        @endif
                                        </select>
                                <span class="removeLang btn btn-danger">Remove</span>
                                    </div>
                            @endif  
                        @endif
                        </div> 
                        <span class="addLang btn btn-primary"style = "cursor:pointer;">+ Add</span> 
                        </div> 
                    </div>

                  <div class="form-group row">
                        {{ Form::label('hobbies', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                        <div class="hobbyList">
                          @if(!empty($record->hobbies))
                            @foreach( $record->hobbies as $hobby )
                                <div class="hobbySelect">
                                    <select name="hobbies[]">
                                    @if(!empty($hobbies))
                                    @foreach($hobbies as $lk=>$lv)
                                        <option value="{{$lk}}" {{($lk == $hobby)?('selected="selected"'):''  }} >{{$lv}}</option>
                                    @endforeach
                                    @endif
                                    </select>
                                   <span class="removeHobby btn btn-danger">Remove</span>
                                </div>
                            @endforeach
                        @endif
                        </div> 
                        <span class="addHobby btn btn-primary"style = "cursor:pointer;">+ Add</span> 
                        </div> 
                    </div>

                     
                    
            

                    <div class="form-group row">
                        {{ Form::label('created_at', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                          {{ Form::text('created_at', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Created At','required'=> 'false','disabled'=> true)) }}
                        </div> 
                    </div>

                    <div class="form-group row">
                        {{ Form::label('updated_at', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                          {{ Form::text('updated_at', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Updated At','required'=> 'false','disabled'=> true)) }}
                        </div> 
                    </div>

                    <div class="form-group row">
                        {{ Form::label('credit', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                          {{ Form::number('credit', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Credit','required'=> 'false')) }}
                        </div> 
                    </div>

                    

                   
                    
                      <a class="btn btn-primary btnPrevious text-white"onclick="scrollToTop()" >Previous</a>
                     <a class="btn btn-primary btnNext text-white" style="float:right;"onclick="scrollToTop()">Next</a>


                  </div>

