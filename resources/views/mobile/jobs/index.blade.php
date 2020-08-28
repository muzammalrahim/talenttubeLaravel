@extends('mobile.user.usermaster')
@section('content')

 
<h6 class="h6 jobAppH6">Browse Jobs</h6>

<!-- ================================================================ Jobs Apply Modal ================================================================ -->
  @include('mobile.jobs.jobsModal')
<!-- ================================================================ Jobs Filter ================================================================ -->
  @include('mobile.jobs.jobsFilter')
<!-- ================================================================ Jobs List ================================================================ -->
  @include('mobile.jobs.jobsList')


@stop


@section('custom_footer_css')

@stop

@section('custom_js')

<script type="text/javascript">

$(document).ready(function(){
  console.log(' doc ready ');

  $(document).on('click','.jobApplyBtn', function() {
    console.log(' jobApplyBtn click  ');
    var jobPopId = parseInt($(this).attr('job-id'));
    var jobPopTitle = $(this).attr('job-title');
    $('.jobTitle').text(jobPopTitle);
    $('#openModalJobId').val(jobPopId);
    $('#modalJobApply').modal('show');



  }); // jobApplyBtn click end 

$('#modalJobApply').on('show.bs.modal', function (event) {
    console.log(' jobApplyModal show ');
        var jobPopId = $('#openModalJobId').val();
        console.log(' jobPopId ', jobPopId);
        console.log(' after open ', event); 
        $('.applyJobModalProcessing').removeClass('d-none');

        $.ajax({
        type: 'GET',
            url: base_url+'/m/ajax/MjobApplyInfo/'+ jobPopId,
            success: function(data){
                console.log("apply for job call");
                $('.applyJobModalProcessing').addClass('d-none');
                $('.jobApplyModalContent').removeClass('d-none');
                $('.jobApplyModalContent').html(data);
            }
        });
  });

// Jobs Modal Close Button

  $(document).on('click','.modalCloseTopButton', function() {
    console.log(' Job Close Button click  ');
    $('input[type="text"],textarea').val('')

  }); 

// Jobs Modal Close Button



});
// ready end 

// $(document).on('click','.jobApplyBtnX', function() {

//   var jobPopId = parseInt($(this).attr('job-id'));
//   var jobPopTitle = $(this).attr('job-title');
//   $('.jobTitle').text(jobPopTitle);
//   // $.get(base_url + '/ajax/MjobApplyInfo/'+jobPopId, function(data,status){
//   //   console.log("data", data);

//   // });

// });







</script>
@stop

