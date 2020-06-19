@extends('adminlte::page')

@section('title',$title)

@section('content_header')
@stop




@section('content')

<div class="container">

    @if ($record)
        {!! Form::model($record, array('url' => route('employers.update',['id' => $record->id]), 'method'=>'PATCH', 'files' => true, 'name'=>'formUser', 'novalidate'=>'')) !!}
    @else
        {!! Form::open(array('url' => route('employers.create'), 'method' => 'POST', 'files' => true, 'name'=>'formUser', 'novalidate'=>'')) !!}
    @endif
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5"><h4 class="card-title mb-0">{{ __('admin.admin.user_management') }} <small class="text-muted">Edit User</small></h4></div>
            </div>
            <hr>
            <div class="row mt-4 mb-4">
                <div class="col">

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

                    <div class="form-group row">
                        {{ Form::label('education', null, ['class' => 'col-md-2 form-control-label']) }}
                         <div class="col-md-10">
                        {{ Form::select('education', $educationDropdown, null, ['placeholder' => 'Select Education']) }}
                        </div> 
                    </div>




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
                        {{ Form::label('about_me', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                          {{ Form::text('about_me', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'About me','required'=> 'false')) }}
                        </div> 
                    </div>

                    <div class="form-group row">
                        {{ Form::label('interested_in', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                          {{ Form::text('interested_in', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Interested in ','required'=> 'false')) }}
                        </div> 
                    </div>

                    
                    @php 
                       $questions = ($record)?(json_decode($record->questions, true)):array(); 
                    @endphp

                    <div class="form-group row">
                        {{ Form::label('questions', null, ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                        @if(!empty($questions))
                            @foreach($questions as $qk => $question)
                             {{$qk}} 
                             <p>
                             <input type="radio" class = "btn btn-primary"name="questions[{{$qk}}]" value="yes" {{($question =='yes')?'checked':''}}>
                            Yes   &nbsp; &nbsp;
                           <input type="radio" name="questions[{{$qk}}]" value="no" {{($question =='no')?'checked':''}}>     No 
                             </p>
                            @endforeach
                        @endif
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


                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col"><a class="btn btn-danger btn-sm" href=" {!! route('users') !!}">Cancel</a></div>
                <div class="col text-right"><button class="btn btn-success btn-sm pull-right" type="submit">Update</button></div>
            </div>
        </div><!--card-footer-->

    </div><!--card-->

    {!! Form::close() !!}

</div>

@stop


@section('css')
    <link rel="stylesheet"  href="{{ asset('css/admin_custom.css') }}">
@stop

@section('js')
<script src="{{ asset('js/admin_custom.js') }}"></script>


<script type="text/javascript">
// add and remove languages code
$(document).ready(function(){
   $(document).on('click','.removeLang', function(){
    $(this).closest('.langSelect').remove();
   });

   $(document).on('click','.addLang', function(){
    console.log(' addLang ');
    var newLangHtml = '<div class="langSelect"><select name="language[]">'; 

    @if(!empty($languages))
        @foreach($languages as $lk=>$lang)
            newLangHtml += '<option value="{{$lk}}">{{$lang}}</option>'; 
        @endforeach
    @endif

    newLangHtml += '</select>';  
    newLangHtml += '<span class="removeLang btn btn-danger">Remove</span>';
    newLangHtml += '</div>';

    $('.langList').append(newLangHtml);
   });
}); 
</script>



<!-- added by Hassan -->
<script type="text/javascript"> var base_url = '{!! url('/') !!}';</script>
<script type="text/javascript">
// add and remove languages code
$(document).ready(function(){
   $(document).on('click','.removeHobby', function(){
    $(this).closest('.hobbySelect').remove();
   });


   $(document).on('click','.addHobby', function(){
    console.log(' addHobby ');
    var newHobbyHtml = '<div class="hobbySelect"><select name="hobbies[]">'; 
    @if(!empty($hobbies))
        @foreach($hobbies as $lk=>$hobby)
            newHobbyHtml += '<option value="{{$lk}}">{{$hobby}}</option>'; 
        @endforeach
    @endif
    newHobbyHtml += '</select>';  
    newHobbyHtml += '<span class="removeHobby btn btn-danger">Remove</span>';
    newHobbyHtml += '</div>';
    $('.hobbyList').append(newHobbyHtml);
   });
   // addHobby end



   $(document).on('change','.country_dd', function(){
     console.log(' country_dd ',this);
     var country_id = $('#country').val();
     var type = 'geo_states';
     get_Location('geo_states',country_id,0);
   });
   // country_dd end


    $(document).on('change','.state_dd', function(){
     console.log(' state_dd ',this);
     var country_id = $('#country').val();
     var city_id = $('.state_dd select').val();
     var type = 'geo_cities';
     get_Location('geo_cities',country_id,city_id);
   });
   // country_dd end



  get_Location = function(type, country_id, state_id){
    $.ajax({
        type: 'POST',
        url: base_url+'/ajax/'+type,
        data: { cmd:type,
                select_id: (type == 'geo_states')?country_id:state_id,
                filter:'1',
                list: 0
        },
        beforeSend: function(){
            // $jq('.geo, #city', pp_profile_edit_main_frm).prop('disabled', true).trigger('refresh');
            // preloader
        },
        success: function(data){
            console.log(data);
            if (data.status) {
                var option ='<option value="0">Select City</option>';
                switch (type) {
                    case 'geo_states':
                        $('.state_dd select').html(data.list);
                        $('.city_dd select').html(option);
                        break
                    case 'geo_cities':
                        $('.city_dd select').html(data.list);
                        break
                }
            }
        }
    });
  }
}); 
</script>
<!-- added by Hassan -->

@stop





@section('plugins.Datatables')

@stop

<!-- added by Hassan -->

<style>
    span.removeHobby,span.removeLang{
        cursor: pointer;
        /*float: right;*/
    } 

    select{
        display: block;
        width: 100%;
        height: calc(2.25rem + 2px);
        padding: .375rem .75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        box-shadow: inset 0 0 0 transparent;
        transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }

div.langSelect>select, div.hobbySelect>select {
    width: 88%;
    float: left;
    margin-bottom: 16px;
    margin-right: 27px;
}

@media only screen and (max-width: 1409px) {
  div.langSelect>select, div.hobbySelect>select {
    width: 100%;
    margin-bottom: 16px;
  }
}

.btn-danger{
    margin-bottom: 16px;
    
}

</style>