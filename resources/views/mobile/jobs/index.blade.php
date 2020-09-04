@extends('mobile.user.usermaster')
@section('content')

 
<h6 class="h6 jobAppH6">Browse Jobs</h6>

<!-- ================================================================ Jobs Apply Modal ================================================================ -->
<!-- ================================================================ Jobs Filter ================================================================ -->
  @include('mobile.jobs.jobsFilter')
<!-- ================================================================ Jobs List ================================================================ -->
		<div class="jobSeekers_list">	
		@include('mobile.jobs.jobsList')
		</div>

@stop


@section('custom_footer_css')

@stop

@section('custom_js')

<script type="text/javascript">

$(document).ready(function(){

	$('#filter_form').on('submit',function(event){
    console.log(' filter_form submit '); 
    event.preventDefault();
    $('#paginate').val('');
    getData();
});

// function to send ajax call for getting data throug filter/Pagination selection. 
var getData = function(){
    var url = '{{route('MjobsFilter')}}';
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.post(url, $('#filter_form').serialize(), function(data){
						 
        $('.jobSeekers_list').html(data);
    });
}

getData(); 

$(document).on('click','.jobs_pagination .page-item .page-link',function(e){
    console.log(' page-link click ', $(this) ); 
    e.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
    $('#paginate').val(page);
    getData();
});
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
$(".reset-btn").click(function(){
	$("#filter_form").trigger("reset");
	$("#filter").html("Filters" +"<i class='fas fa-angle-down rotate-icon'></i>");
	getDataCustom();
});

var getDataCustom = function(){
    var url = '{{route('MjobsFilter')}}';
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.post(url, $('#filter_form').serialize(), function(data){
        $('.jobs_list').html(data);
    });
}





</script>
@stop

