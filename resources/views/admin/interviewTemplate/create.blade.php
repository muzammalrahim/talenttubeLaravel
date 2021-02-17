@extends('adminlte::page')

@section('title',$title)

@section('content_header')

@stop

@section('content')

<div class="container">
    @include('admin.errors',[ 'error' => $errors, 'record' => $record ])

    {!! Form::open(array('url' => route('template.store'), 'method' => 'POST', 'files' => true, 'name'=>'formJob', 'novalidate'=>'')) !!}

    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-5"><h4 class="card-title mb-0">{{ __('Add New Interview Template ') }}</h4></div>
        </div>

        <hr>
        <div class="form-group row">
          {{ Form::label('template_name', null, ['class' => 'col-md-2 form-control-label']) }}
          <div class="col-md-10">
            {{ Form::text('template_name', $value = null, $attributes = array('class'=>'form-control', 'placeholder' => 'name','required'=> 'false')) }}
          </div>
        </div>

        <div class="form-group row">
          {{ Form::label('type', null, ['class' => 'col-md-2 form-control-label']) }}
          <div class="col-md-10">
            {{ Form::select('type', $value = $type , $attributes = array('class'=>'form-control', 'required'=> 'false')) }}
          </div>
        </div>

        <div class="form-group row">
          {{ Form::label('Question 1', null, ['class' => 'col-md-2 form-control-label']) }}
          <div class="col-md-10">
            {{ Form::text('question[]', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Question for interview','required'=> 'false')) }}
          </div>
        </div>
        <div class="questionslist"></div>

        <span class="addTemplateQuestion btn btn-primary"style = "cursor:pointer;">+ Add Question</span>

       {{--  <div class="row mt-4 mb-4">
          <div class="col">
            <div class="col-12 col-sm-6 col-lg-12">
              <div class="card card-primary card-tabs">
                <div class="card-header p-0 pt-1 tabColor"style="background: #6c757d;">
                  <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item col-lg-6">
                      <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true"><b>General</b></a>
                    </li>

                    <li class="nav-item col-lg-6">
                      <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false"><b>Interview Question</b></a>
                    </li>

                  </ul>

                </div>

                <div class="card-body">
                  <div class="tab-content" id="custom-tabs-one-tabContent">
                    @include('admin.interviewTemplate.tabs.tab1')
                    @include('admin.interviewTemplate.tabs.tab2')
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div> --}}

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

  var i = 2;
   $(document).on('click','.addTemplateQuestion', function(){
    console.log(' Add Question ');
    if(i <= 10){
      var newQuestionsList = '<div class="row questions t'+i+' ">';
      newQuestionsList += '<div class="text col-md-2 font-weight-bold">Question '+i+'</div>';
      newQuestionsList +='<input name="question[]" class="questionInput form-control col-md-7 mx-2">';
      newQuestionsList += '</input>';
      newQuestionsList += '<span class="removeQuestion btn btn-danger col-md-2">Remove</span>';
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
.userimg{
  height: 160px;
  width: 160px;
}

.photo{
    width: 100px;
    height: 110px;
    margin-right: 10px;
    margin-bottom: 10px;
}

.imagesAdmin{

    margin-top:30px;
}

.imageSizeModal{

    width: 200px;
    height: 210px;
}

.showinline{
    display:inline-block;
}
</style>

<!-- added by Hassan -->
