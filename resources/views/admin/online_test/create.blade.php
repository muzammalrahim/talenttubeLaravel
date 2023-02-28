@extends('adminlte::page')

@section('title',$title)

@section('content_header')

@stop

@section('content')

<div class="container">
    @include('admin.errors',[ 'error' => $errors, 'record' => $record ])

    {!! Form::open(array('url' => route('onlineTest.store'), 'method' => 'POST', 'files' => true, 'name'=>'formJob', 'novalidate'=>'')) !!}

    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-5"><h4 class="card-title mb-0">{{ __('Add New Test ') }}</h4></div>
        </div>

        <hr>
        <div class="form-group row">
          {{ Form::label('test_name', null, ['class' => 'col-md-2 form-control-label']) }}
          <div class="col-md-10">
            {{ Form::text('name', $value = null, $attributes = array('class'=>'form-control', 'placeholder' => 'Enter test name','required'=> 'false')) }}
          </div>
        </div>

        <hr>

        <div class="form-group row">
          {{ Form::label('time', null, ['class' => 'col-md-2 form-control-label']) }}
          <div class="col-md-10">
            {{ Form::number('time', $value = null, $attributes = array('class'=>'form-control', 'placeholder' => 'Enter maximum time allowed for test in minutes','required'=> 'false')) }}
          </div>
        </div>

        <hr>

        <div class="question">
          <div class="form-group row">
            {{ Form::label('Question 1', null, ['class' => 'col-md-2 form-control-label']) }}
            <div class="col-md-9" id="summernote">
              {{ Form::text('question[1][question]', $value = null , $attributes = array('class'=>'form-control', 
              //'id'=>'summernote' ,
              'placeholder' => 'Enter question','required'=> 'false')) }}
            </div>
            <div class="col-md-1">
              <span class="removeQuestion btn btn-danger"><i class="fa fa-trash"> </i></span>
            </div>
          </div>

          <div class="form-group row">
            <div class="col-md-2"> Options </div>
            <div class="col-md-10">
              <div class="form-check p-0">
                <label class="form-check-label" for="flexCheckDefault">(1) </label>
                <input class="form-input" name="question[1][option1]" type="text" id="flexCheckDefault">

                <label class="form-check-label" for="flexCheckDefault">(2) </label>
                <input class="form-input" name="question[1][option2]" type="text" id="flexCheckDefault">

                <label class="form-check-label" for="flexCheckDefault">(3) </label>
                <input class="form-input" name="question[1][option3]" type="text" id="flexCheckDefault">

                <label class="form-check-label" for="flexCheckDefault">(4) </label>
                <input class="form-input" name="question[1][option4]" type="text" id="flexCheckDefault">
              </div>
            </div>
          </div>

          <div class="form-group row">
            <div class="col-md-2"> Answer </div>
            <div class="col-md-2">
              <select class="form-control" name="question[1][answer]">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
              </select>
            </div>

            <div class="col-md-2"> <span class="btn btn-primary addImg"> Add Image </span> </div>
          </div>

        <hr>


          <div class="row form-group imgDiv d-none" >
            <div class="col-md-2"> Add Image </div>
            <div class="col-md-10"> <input type="file" name="question[1][questionImage]"> </div>
          </div>

      </div>

        <div class="questionslist mb-2"></div>
        <span class="addTemplateQuestion btn btn-primary"style = "cursor:pointer;">+ Add Question</span>

      </div>

      <div class="card-footer">
        <div class="row">
          <div class="col"><a class="btn btn-danger btn-sm" href=" {!! route('onlinetest') !!}">Cancel</a></div>
          <div class="col text-right"><button class="btn btn-success btn-sm pull-right" type="submit">Create</button></div>
        </div>
      </div>
    </div>

  {!! Form::close() !!}

</div>

@stop


@section('css')
    <link rel="stylesheet"  href="{{ asset('css/admin_custom.css') }}">


    {{-- Summernote --}}
  {{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet"> --}}
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    

    {{-- Summernote --}}

@stop

@section('js')

<script src="{{ asset('js/admin_custom.js') }}"></script>
<script src="{{ asset('js/site/userProfileadmin.js') }}"></script>

    {{-- Summernote --}}

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    {{-- Summernote --}}

<script>


 $("#form_id").submit(function(){
  return false;
});


// $(document).ready(function() {
//         $('#summernote').summernote();
// });

 </script>




<script type="text/javascript">

// ============================================== Add and remove Question ==============================================

$(document).ready(function(){


  $(document).on('click' , '.addImg', function(){
    $(this).parents('.question').find('.imgDiv').toggleClass('d-none');
  });

  $(document).on('click','.removeQuestion', function(){
    $(this).closest('.question').remove();
   });

  var i = 2;
   $(document).on('click','.addTemplateQuestion', function(){
    console.log(' Add Question ');

    if(i <= 30)
    {

      var newQuestionsList = '<div class="question q'+i+' border-bottom mb-2">';
      newQuestionsList += '<div class="row t'+i+' ">';
      newQuestionsList += '<div class="text col-md-2 font-weight-bold">Question '+i+'</div>';
      newQuestionsList +='<input name="question['+i+'][question]" class="questionInput form-control col-md-9" id = "summernote_'+i+'">';
      newQuestionsList += '</input>';
      newQuestionsList += '<div class = "col-md-1">';

      newQuestionsList += '<span class="removeQuestion btn btn-danger"><i class = "fa fa-trash"> </i></span>';
      newQuestionsList += '</div>';
      newQuestionsList += '</div>';

      newQuestionsList += '<div class="form-group row mt-3">';
      newQuestionsList += '<div class="col-md-2"> Options';
      newQuestionsList +=  '</div>';
      newQuestionsList += '<div class="col-md-10">';
      newQuestionsList += '<div class="form-check p-0">';
      newQuestionsList += '<label class="form-check-label" for="flexCheckDefault">';
      newQuestionsList += '  (1) ';
      newQuestionsList += '</label>';
      newQuestionsList += '<input class="form-input" type="text" name="question['+i+'][option1]" id="flexCheckDefault">';


      newQuestionsList += '<label class="form-check-label" for="flexCheckDefault">';
      newQuestionsList += '  (2) ';
      newQuestionsList += '</label>';
      newQuestionsList += ' <input class="form-input" type="text" name="question['+i+'][option2]" id="flexCheckDefault">';


      newQuestionsList += ' <label class="form-check-label" for="flexCheckDefault">';
      newQuestionsList += '  (3) ';
      newQuestionsList += ' </label>';
      newQuestionsList += ' <input class="form-input" type="text" name="question['+i+'][option3]" id="flexCheckDefault">';


      newQuestionsList += ' <label class="form-check-label" for="flexCheckDefault">';
      newQuestionsList += '  (4) ';
      newQuestionsList += ' </label>';
      newQuestionsList += ' <input class="form-input" type="text" name="question['+i+'][option4]" id="flexCheckDefault">';


      newQuestionsList += ' </div>';
      newQuestionsList += ' </div>';


      newQuestionsList += '</div>';


      newQuestionsList += '<div class="form-group row">';
      newQuestionsList +=    '<div class="col-md-2"> Answer </div>';
      newQuestionsList +=    '<div class="col-md-2">';
      newQuestionsList +=      '<select class="form-control" name = question['+i+'][answer]>';
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
      newQuestionsList +=   '<div class="col-md-10"> <input type="file" name="question['+i+'][questionImage]">';
      newQuestionsList += '</div>';





    // ==================================== Ajax call to add new question with text editor ====================================

/*    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
      $.ajax({
      type: 'POST',
      url: base_url+'/admin/ajax/onlineTest/addQuestion',
      data:{id: i},
      success: function(data){
          // console.log(' data ', data);
          $('.questionslist').append(data);

        }
    });*/


    // ==================================== Ajax call to add new question with text editor ====================================


    i++;  

      

    }
    else{
      return false;
    }
    
    $('.questionslist').append(newQuestionsList);
    
      // $('#summernote_'+i+'').summernote();
   });



  // ================================================ Summernote ================================================

  // $('#summernote').summernote();


  // ================================================ Summernote end here ================================================


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

@stop

@section('plugins.Datatables')

@stop

