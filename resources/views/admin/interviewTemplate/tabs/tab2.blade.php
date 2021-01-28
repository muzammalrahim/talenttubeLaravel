<div class="tab-pane fade " id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                    


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
              {{ Form::number('credit', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Credit','required'=> 'false',)) }}
            </div> 
        </div>

             <a class="btn btn-primary btnPrevious text-white"onclick="scrollToTop()" >Previous</a>
             {{-- <a class="btn btn-primary btnNext text-white" style="float:right;"onclick="scrollToTop()">Next</a> --}}
 
</div>

<style type="text/css">

</style>