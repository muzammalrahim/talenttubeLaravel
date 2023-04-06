<div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">

      <div class="form-group row">
            {{ Form::label('ID', null, ['class' => 'col-md-2 form-control-label']) }}
            <div class="col-md-10">
              {{ Form::text('id', $value = null, $attributes = array('class'=>'form-control','id'=>'formUserId','placeholder' => 'Id','required'=> 'false', 'disabled'=> true)) }}
            </div>
      </div>

      <div class="form-group row">
          {{ Form::label('name', null, ['class' => 'col-md-2 form-control-label']) }}
          <div class="col-md-10">
            {{ Form::text('name', $value = null, $attributes = array('class'=>'form-control', 'placeholder' => 'name','required'=> 'false')) }}
          </div>
      </div>

      <div class="form-group row">
          {{ Form::label('surname', null, ['class' => 'col-md-2 form-control-label']) }}
          <div class="col-md-10">
            {{ Form::text('surname', $value = null, $attributes = array('class'=>'form-control', 'placeholder' => 'name','required'=> 'false')) }}
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

      <div class="form-group row">
        {{ Form::label('Location', null, ['class' => 'col-md-2 form-control-label']) }}
        <div class="col-md-10">
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



      {{-- <div class="form-group row">
          {{ Form::label('statusText', null, ['class' => 'col-md-2 form-control-label']) }}
          <div class="col-md-10">
            {{ Form::text('statusText', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Status Text','required'=> 'false')) }}
          </div>
      </div>
 --}}
      <div class="form-group row">
          {{ Form::label('Passing Year', null, ['class' => 'col-md-2 form-control-label']) }}
          <div class="col-md-10">
          

            <select id="year" name="passing_year" class="form-control">
                {{ $last= date('Y')-50 }}
                {{ $now = date('Y') }}

                @for ($i = $now; $i >= $last; $i--)
                    <option value="{{ $i }}" {{ ($i == $record->passing_year ) ? 'selected': '' }}  >{{ $i }}</option>
                @endfor

            </select>

            {{-- {{ Form::number('passing_year', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Age','required'=> 'false')) }} --}}
          
          </div>
      </div>


     


       <a class="btn btn-primary btnNext text-white" style="float: right;" onclick="scrollToTop()">Next</a>
  </div>
