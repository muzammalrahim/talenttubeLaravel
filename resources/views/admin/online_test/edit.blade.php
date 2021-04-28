@extends('adminlte::page')

@section('title',$title)

@section('content_header')

@stop

@section('content')

<div class="container">
    @include('admin.errors',[ 'error' => $errors, 'record' => $record ])

    {!! Form::open(array('url' => route('onlineTest.update' ,['id' => $record->id]), 'method' => 'POST', 'files' => true, 'name'=>'formJob', 'novalidate'=>'')) !!}





    {{-- @dump($record->tempQuestions); --}}

    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-5"><h4 class="card-title mb-0">{{ __('Edit Online Test ') }}</h4></div>
        </div>

        <hr>
        <div class="form-group row">
          {{ Form::label('name', null, ['class' => 'col-md-2 form-control-label']) }}
          <div class="col-md-10">
            {{ Form::text('name', $value = $record->name, $attributes = array('class'=>'form-control', 'placeholder' => 'Enter test name','required'=> 'false')) }}
          </div>
        </div>

        <div class="form-group row">
          {{ Form::label('time', null, ['class' => 'col-md-2 form-control-label']) }}
          <div class="col-md-10">
            {{ Form::number('time', $value = $record->time , $attributes = array('class'=>'form-control', 'required'=> 'false')) }}
          </div>
        </div>

          <hr>


        

        @php
          $questions = $record->testQuestions;
        @endphp
        @foreach ($questions as $key => $question)
          
          <div class="oldQuestion">
            
            <div class="row form-group">
              <label for="tempQuestions" class="col-sm-2 col-form-label">Question <span class="test">{{$key+1}}</span>  </label>
              <div class="col-sm-9">

                <input type="hidden" name="question[{{$key+1}}][id]" value="{{$question->id}}" />
                <input type="text" class="form-control" name="question[{{$key+1}}][question] " id="tempQuestions" placeholder="Enter question" value=" {{$question->question}} " >

              </div>

              <div class="col-md-1">
                <span class="pointer removeOldQuestion btn btn-danger" data-testId = "{{$record->id}}" data-qId = "{{$question->id}}"> <i class="fa fa-trash"></i></span>
                <input type="hidden" name="" class="tempLateId" value=" {{$record->id}} " >
              </div>
            </div>


            {{-- <div class="options"> --}}
            <div class="row form-group">

              <div class="col-md-2 my-3"> Options </div>

              <div class="col-md-10 my-3">
                <div class="form-check p-0">
                  <label class="form-check-label" for="flexCheckDefault">(1) </label>
                  <input class="form-input" name="question[{{$key+1}}][option1]" value="{{$question->option1}}" type="text" id="flexCheckDefault">

                  <label class="form-check-label" for="flexCheckDefault">(2) </label>
                  <input class="form-input" name="question[{{$key+1}}][option2]" value="{{$question->option2}}" type="text" id="flexCheckDefault">

                  <label class="form-check-label" for="flexCheckDefault">(3) </label>
                  <input class="form-input" name="question[{{$key+1}}][option3]" value="{{$question->option3}}" type="text" id="flexCheckDefault">

                  <label class="form-check-label" for="flexCheckDefault">(4) </label>
                  <input class="form-input" name="question[{{$key+1}}][option4]" value="{{$question->option4}}" type="text" id="flexCheckDefault">
                </div>
              </div>
            </div>


            <div class="row form-group">

              <div class="col-md-2"> Answer </div>
              <div class="col-md-2">
                <select class="form-control" name="question[{{$key+1}}][answer]" value = "{{$question->answer}}" >
                  <option {{ $question->answer == 1 ? 'selected' : ''}} >1</option> 
                  <option {{ $question->answer == 2 ? 'selected' : ''}} >2</option> 
                  <option {{ $question->answer == 3 ? 'selected' : ''}} >3</option> 
                  <option {{ $question->answer == 4 ? 'selected' : ''}} >4</option> 
                </select>
              </div>

              @if (empty($question->image_name) )
                <div class="col-md-2"> <span class="btn btn-primary addImg"> Add Image </span> </div>
              @endif



            </div>
              @if (!empty($question->image_name) )
              <div class="row form-group questionImage" >
                <div class="col-md-2"> Question Image </div>
                <img data-photo-id=""  id="photo" style="height:50px"   class="photo" data-src="" src="{{ asset('public/media/public/onlineTest/' . $question->image_name ) }}" >
                  {{-- src="http://localhost/talenttube/public/media/public/onlineTest/1616073022.jpg" > --}}
                {{-- <div class="col-md-10"> <input type="file" name="question[1][questionImage]"> </div> --}}
              </div>

              @else

              <div class="row form-group imgDiv d-none" >
                <div class="col-md-2"> Add Image </div>
                <div class="col-md-10"> <input type="file" name="question[{{$key+1}}][questionImage]"> </div>
              </div>

              @endif

          </div>

          <hr>

        @endforeach

        <div class="questionslist mb-2"></div>

        <span class="addTemplateQuestion btn btn-primary"style = "cursor:pointer;">+ Add Question</span>

      </div>

      <div class="card-footer">
        <div class="row">
          <div class="col"><a class="btn btn-danger btn-sm" href=" {!! route('onlinetest') !!}">Cancel</a></div>
          <div class="col text-right"><button class="btn btn-success btn-sm pull-right" type="submit">Update</button></div>
        </div>
      </div>
    </div>


  {!! Form::close() !!}

</div>

@stop


@section('css')
    <link rel="stylesheet"  href="{{ asset('css/admin_custom.css') }}">

@stop

@section('js')

<script src="{{ asset('js/admin_custom.js') }}"></script>
<script src="{{ asset('js/site/userProfileadmin.js') }}"></script>
<script>
 $("#form_id").submit(function(){
  return false;
});
 </script>




<script type="text/javascript">

// ============================================== Add and remove Question ==============================================

$(document).ready(function(){

  $(document).on('click' , '.addImg', function(){
    console.log('add new image edit');
    $(this).parents('.oldQuestion').find('.imgDiv').toggleClass('d-none');
  });


  $(document).on('click' , '.addImg', function(){
    console.log('add new image edit');
    $(this).parents('.question').find('.imgDiv').toggleClass('d-none');
  });

  $(document).on('click','.removeQuestion', function(){
    $(this).closest('.question').remove();


   });

  $(document).on('click','.removeOldQuestion', function(){
    var qId = $(this).attr('data-qId');
    var test_id = $(this).attr('data-testId');
    // console.log(qId);
    $(this).closest('.oldQuestion').remove();
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
      $.ajax({
      type: 'POST',
      url: base_url+'/admin/ajax/onlineTest/question/delete',
      data:{id: qId,test_id:test_id},
      success: function(data){
          console.log(' data ', data);
          if( data.status == 1 ){
          $(this).closest('.oldQuestion').remove();
          }else{
            return false;
          }
        }
    });
  });

  

  var vals = $('.test').last().text();
  var i = Number(vals)+1;

  // var i = 2;
   $(document).on('click','.addTemplateQuestion', function(){
    console.log(' Add Question ');
    if(i <= 30){
      

      var newQuestionsList = '<div class="question q'+i+' border-bottom mb-2">';
      newQuestionsList += '<div class="row t'+i+' ">';
      newQuestionsList += '<div class="text col-md-2 font-weight-bold">Question '+i+'</div>';
      newQuestionsList +='<input name="newQuestion['+i+'][question]" class="questionInput form-control col-md-9" id = "summernote">';
      newQuestionsList += '</input>';
      newQuestionsList += '<div class = "col-md-1">';
      newQuestionsList += '<span class="removeQuestion btn btn-danger"><i class = "fa fa-trash"> </i></span>';
      newQuestionsList += '</div>';
      newQuestionsList += '</div>';



      newQuestionsList += '<div class="form-group row my-3">';
      newQuestionsList += '<div class="col-md-2"> Options';
      newQuestionsList +=  '</div>';
      newQuestionsList += '<div class="col-md-10">';
      newQuestionsList += '<div class="form-check p-0">';
      newQuestionsList += '<label class="form-check-label" for="flexCheckDefault">';
      newQuestionsList += '  (1) ';
      newQuestionsList += '</label>';
      newQuestionsList += '<input class="form-input" type="text" name="newQuestion['+i+'][option1]" id="flexCheckDefault">';


      newQuestionsList += '<label class="form-check-label" for="flexCheckDefault">';
      newQuestionsList += '  (2) ';
      newQuestionsList += '</label>';
      newQuestionsList += ' <input class="form-input" type="text" name="newQuestion['+i+'][option2]" id="flexCheckDefault">';


      newQuestionsList += ' <label class="form-check-label" for="flexCheckDefault">';
      newQuestionsList += '  (3) ';
      newQuestionsList += ' </label>';
      newQuestionsList += ' <input class="form-input" type="text" name="newQuestion['+i+'][option3]" id="flexCheckDefault">';


      newQuestionsList += ' <label class="form-check-label" for="flexCheckDefault">';
      newQuestionsList += '  (4) ';
      newQuestionsList += ' </label>';
      newQuestionsList += ' <input class="form-input" type="text" name="newQuestion['+i+'][option4]" id="flexCheckDefault">';



      newQuestionsList += ' </div>';


      newQuestionsList += ' </div>';



      newQuestionsList += '</div>';


      newQuestionsList += '<div class="form-group row">';
      newQuestionsList +=    '<div class="col-md-2"> Answer </div>';
      newQuestionsList +=    '<div class="col-md-2">';
      newQuestionsList +=      '<select class="form-control" name = newQuestion['+i+'][answer]>';
      newQuestionsList +=        '<option>1</option>';
      newQuestionsList +=        '<option>2</option>';
      newQuestionsList +=        '<option>3</option>';
      newQuestionsList +=        '<option>4</option>';
      newQuestionsList +=      '</select>';
      newQuestionsList += '</div>';




      newQuestionsList +=  '<div class="col-md-2">'; 
      newQuestionsList += '<span class="btn btn-primary addImg"> Add Image </span>';
      newQuestionsList += '</div>';



      newQuestionsList += '</div>';
      

      newQuestionsList +=   '<div class="row form-group imgDiv d-none" >';
      newQuestionsList +=    '<div class="col-md-2"> Add Image </div>';
      newQuestionsList +=   '<div class="col-md-10"> <input type="file" name="newQuestion['+i+'][questionImage]">';
      newQuestionsList += '</div>';



      i++;  
    }
    else{
      return false;
    }
    
    $('.questionslist').append(newQuestionsList);
   });





});

// ============================================== Add and remove Question ==============================================



</script>



<!-- added by Hassan -->
<script type="text/javascript"> var base_url = '{!! url('/') !!}';</script>
{{-- <script src="http://malsup.github.com/jquery.form.js"></script> --}}
{{-- <script type="text/javascript" src="https://maps.google.com/maps/api/js?libraries=places&key={{env('GOOGLE_API')}}"></script> --}}
{{-- <link rel="stylesheet" href="{{ asset('css/viewer.css') }}"> --}}
{{-- <script type="text/javascript" src="{{ asset('js/viewer.js') }}"></script> --}}
<script type="text/javascript">  


</script>
<!-- added by Hassan -->

@stop

@section('plugins.Datatables')

@stop


