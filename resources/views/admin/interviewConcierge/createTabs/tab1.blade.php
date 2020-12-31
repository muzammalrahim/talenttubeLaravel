
<div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
    {{-- @dump($record) --}}

    <div class="form-group row">
        {{ Form::label('title', null, ['class' => 'col-md-2 form-control-label']) }}
        <div class="col-md-10">
            {{ Form::text('title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'title','required'=> 'true')) }}
        </div>
    </div>

    <div class="form-group row">
        {{ Form::label('Company Name', null, ['class' => 'col-md-2 form-control-label']) }}
            <div class="col-md-10">
                  {{ Form::text('companyname', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Compnay Name','required'=> 'true')) }}
            </div>
    </div>

    <div class="form-group row">
        {{ Form::label('Position Name', null, ['class' => 'col-md-2 form-control-label']) }}
            <div class="col-md-10">
                  {{ Form::text('positionname', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Position Name','required'=> 'true')) }}
            </div>
    </div>

    <div class="form-group row">
        {{ Form::label('instructions', null, ['class' => 'col-md-2 form-control-label']) }}
            <div class="col-md-10">
                  {{ Form::text('instruction', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Instructions','required'=> 'true')) }}
            </div>
    </div>

    <div class="form-group row">
        {{ Form::label('Additional Manager', null, ['class' => 'col-md-2 form-control-label']) }}
            <div class="col-md-10">
                  {{ Form::text('additionalmanagers', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Additional Manager','required'=> 'true')) }}
            </div>
    </div>


    {{-- <div class="mb-2 bg-secondary text-white text-center"><b>Industry</b></div> --}}

    <div class="form-group row"></div>

    {{-- <div class="form-group row ">
        {{ Form::label('Created By', null, ['class' => 'col-md-2 form-control-label']) }}
            <div class="col-md-10">
                {{ Form::text('employername', $value =  $record->employerData->name, $attributes= array ('class'=>'form-control', 'placeholder' => 'title','required'=> 'true')) }}
            </div>
    </div> --}}


    <a class="btn btn-primary btnNext text-white" style="float: right;" onclick="scrollToTop()">Next</a>
</div>



