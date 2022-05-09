@extends('adminlte::page')

@section('title',$title)

@section('content_header')

@stop

@section('content')

<div class="container">
    @include('admin.errors',[ 'error' => $errors, 'record' => $record ])

    {!! Form::open(array('url' => route('template.update' ,['id' => $record->id]), 'method' => 'POST', 'files' => true, 'name'=>'formJob', 'novalidate'=>'')) !!}





    {{-- @dump($record->tempQuestions); --}}

    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-5"><h4 class="card-title mb-0">{{ __('Edit Interview Template ') }}</h4></div>
        </div>

        <hr>
        <div class="form-group row">
          {{ Form::label('template_name', null, ['class' => 'col-md-2 form-control-label']) }}
          <div class="col-md-10">
            {{ Form::text('template_name', $value = $record->template_name, $attributes = array('class'=>'form-control', 'placeholder' => 'name','required'=> 'false')) }}
          </div>
        </div>

        <div class="form-group row">
          {{ Form::label('type', null, ['class' => 'col-md-2 form-control-label']) }}
          <div class="col-md-10">
            {{ Form::select('type', $type , $attributes = array('class'=>'form-control', 'required'=> 'false')) }}
          </div>
        </div>

        <div class="form-group row">
          {{ Form::label('employers instruction', null, ['class' => 'col-md-2 form-control-label']) }}
          <div class="col-md-10">
            {{ Form::text('employers_instruction', $value = $record->employers_instruction , $attributes = array('class'=>'form-control', 'placeholder' => 'Employers instruction' , 'required'=> 'false')) }}
          </div>
        </div>

        <div class="form-group row">  
          {{ Form::label('Employer Video Intro', null, ['class' => 'col-md-2 form-control-label']) }}

          @if (isset($record->employer_video_intro))
            
            <div class="video_div pointer"  onclick="showVideoModal12('{{template_video($record->employer_video_intro)}}')"> 
              <div id="v_123456"> <img src="https://img.icons8.com/color/48/000000/video.png"/></div>
            </div>

            {{-- <a href="{{ asset('/public/media/interview_bookings/employer/'. $record->employer_video_intro) }}"></a> --}}
            
            @else

          <div class="col-md-10"> <input type="file" name="employer_video_intro"> </div>


          @endif
          

        </div>




        

        @php
          $questions = $record->tempQuestions;
        @endphp
        @foreach ($questions as $key => $question)
          
          {{-- @dump($questions); --}}

          <div class="form-group row oldQuestion">
            
            {{-- <input type="hidden" name="oldQuestion[{{$key+1}}][id]" value="{{$question->id}}" /> --}}

            <label for="tempQuestions" class="col-sm-2 col-form-label">Question <span class="test">{{$key+1}}</span>  </label>
            <div class="col-sm-8">

              <input type="hidden" name="questions[{{$key+1}}][id]" value="{{$question->id}}" />
              <input type="text" class="form-control" name="questions[{{$key+1}}][question] " id="tempQuestions" placeholder="Password" value=" {{$question->question}} " >

            </div>

            <div class="col-md-2">
              <input name="questions[{{ $key+1 }}][video_response]" {{ ($question['video_response'] == 1)? 'checked':'' }} type="checkbox">
              <span class="col-md-2">Video Reponse</span>
              <i class="fa fa-trash removeOldQuestion text-danger pointer" value = "{{$question->id}}"></i>
              <input type="hidden" name="" class="tempLateId" value=" {{$record->id}} " >
            </div>

          </div>

        @endforeach

        <div class="questionslist"></div>

        <span class="addTemplateQuestion btn btn-primary"style = "cursor:pointer;">+ Add Question</span>

      </div>

      <div class="card-footer">
        <div class="row">
          <div class="col"><a class="btn btn-danger btn-sm" href=" {!! route('interviewTemplates') !!}">Cancel</a></div>
          <div class="col text-right"><button class="btn btn-success btn-sm pull-right" type="submit">Update</button></div>
        </div>
      </div>
    </div>


  {!! Form::close() !!}

</div>



<div class="modal fade" id="deleteNoteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-notify modal-success" role="document">
     <!--Content-->
     <div class="modal-content">
       <!--Header-->
       <div class="modal-header bg-success">
         <p class="heading lead">Video  </p>
         <button type="button" class="close text-white" class="" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
       <!--Body-->
       <div class="modal-body video_inModal"> </div>
       <!--Footer-->
       <div class="modal-footer justify-content-center">
        <a type="button" class="btn btn-outline-success waves-effect" class="" data-dismiss="modal">Close</a>
       </div>
     </div>
     <!--/.Content-->
   </div>
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

  $(document).on('click','.removeQuestion', function(){
    $(this).closest('.questions').remove();


   });

  $(document).on('click','.removeOldQuestion', function(){
    var id = $(this).attr('value');
    var temp_id = $('.tempLateId').attr('value');
    console.log(temp_id);
    $(this).closest('.oldQuestion').remove();


    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
            type: 'POST',
            url: base_url+'/admin/ajax/template/question/delete',
            data:{id: id,temp_id:temp_id},
            success: function(data){
                console.log(' data ', data);
                if( data.status == 1 ){

                $(this).closest('.oldQuestion').remove();

                }else{
                   
                }

              }
          });

    // console.log(q_id);
    // $(this).closest('.oldQuestion').remove();
   
   });

  

  var vals = $('.test').last().text();
  var i = Number(vals)+1;

  // var i = 2;
   $(document).on('click','.addTemplateQuestion', function(){
    console.log(' Add Question ');
    if(i <= 10){

      var newQuestionsList = '<div class="form-group row questions t'+i+' ">';
      newQuestionsList    += '<label for="Question 1" class="col-md-2 form-control-label">Question '+i+' </label>';
      newQuestionsList    += '<div class="col-md-8">';
      newQuestionsList    += '<input class="form-control questionInput" placeholder="Question for interview" required="false" name="newquestions['+i+'][question]" type="text"></div>';
      newQuestionsList    += '<div class="col-md-2">';
      newQuestionsList    += '<input name="newquestions['+i+'][video_response]" type="checkbox">';
      newQuestionsList    += '<span class="col-md-2">Video Reponse</span>'
      newQuestionsList    += '<i class="fa fa-trash removeQuestion text-danger pointer"></i>';
      newQuestionsList    += '</div>';
      newQuestionsList    += '</div>';

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
<script src="http://malsup.github.com/jquery.form.js"></script>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?libraries=places&key={{env('GOOGLE_API')}}"></script>
<link rel="stylesheet" href="{{ asset('css/viewer.css') }}">
<script type="text/javascript" src="{{ asset('js/viewer.js') }}"></script>
<script type="text/javascript">  


// Tab next click
$('#custom-tabs-one-home .btnNext').on('click', function (e) {
  e.preventDefault()
  $('#custom-tabs-one-profile-tab').tab('show')
});

$('#custom-tabs-one-profile .btnNext').on('click', function (e) {
  e.preventDefault()
  $('#custom-tabs-one-messages-tab').tab('show')
});

$('#custom-tabs-one-messages .btnNext').on('click', function (e) {
  e.preventDefault()
  $('#custom-tabs-one-private-tab').tab('show')
});

// new

$('#custom-tabs-one-profile .btnPrevious').on('click', function (e) {
  e.preventDefault()
  $('#custom-tabs-one-home-tab').tab('show')
});

$('#custom-tabs-one-messages .btnPrevious').on('click', function (e) {
  e.preventDefault()
  $('#custom-tabs-one-profile-tab').tab('show')
});

$('#custom-tabs-one-private .btnPrevious').on('click', function (e) {
  e.preventDefault()
  $('#custom-tabs-one-messages-tab').tab('show')
});



// For Scrolling to top start

function scrollToTop() {
      window.scrollTo(0, 0);
}

// For Scrolling to top end

this.showVideoModal12= function(video_url){
  $("#deleteNoteModal").modal('show');
  var videoElem  = '<video id="player" class="w-100" controls>';
  videoElem     += '<source class = "video_src" src="'+video_url+'" type="video/mp4">';
  videoElem     += '</video>';
  $('.video_inModal').html(videoElem);

}


// $(document).click('.close_modal'  , function(){
//   console.log('Modal clicked here');
//   $('.video_src').attr('src' , '');
// })

</script>
<!-- added by Hassan -->

@stop

@section('plugins.Datatables')

@stop


<!-- added by Hassan -->

<style>

select , .bg-secondary{
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


</style>

<!-- added by Hassan -->
