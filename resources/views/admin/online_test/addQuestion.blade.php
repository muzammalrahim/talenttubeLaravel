<div class="form-group row">
          {{ Form::label('Question'.$qId.'', null, ['class' => 'col-md-2 form-control-label']) }}
          <div class="col-md-10">
            {{ Form::text('question[][question]', $value = null , $attributes = array('class'=>'form-control', 
            'id'=>'summernote' ,
            'placeholder' => 'Question for interview','required'=> 'false')) }}
          </div>
        </div>


        <div class="form-group row">

          <div class="col-md-2"> Options </div>

          <div class="col-md-10">
            <div class="form-check p-0">
              <label class="form-check-label" for="flexCheckDefault">(1) </label>
              <input class="form-input" name="question[{{$qId}}][option1]" type="text" id="flexCheckDefault">

              <label class="form-check-label" for="flexCheckDefault">(2) </label>
              <input class="form-input" name="question[{{$qId}}][option2]" type="text" id="flexCheckDefault">

              <label class="form-check-label" for="flexCheckDefault">(3) </label>
              <input class="form-input" name="question[{{$qId}}][option3]" type="text" id="flexCheckDefault">

              <label class="form-check-label" for="flexCheckDefault">(4) </label>
              <input class="form-input" name="question[{{$qId}}][option4]" type="text" id="flexCheckDefault">
            </div>
          </div>

        </div>



        <div class="form-group row">
          <div class="col-md-2"> Answer </div>
          <div class="col-md-2">
            <select class="form-control" name="question[{{$qId}}][answer]">
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
            </select>
          </div>

        </div>




        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

  <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

</head>
<body>
  {{-- <div id="summernote"><p>Hello Summernote</p></div> --}}
  <script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });
  </script>