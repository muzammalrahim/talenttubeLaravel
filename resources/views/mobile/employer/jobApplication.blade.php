
@extends('mobile.user.usermaster')
@section('content')
    {{-- <div class="head icon_head_browse_matches">Job Seekers List</div> --}}


<h6 class="h6 jobAppH6">Job's Applications</h6>

<!-- =============================================================================================================================== -->
@include('mobile.employer.jobAppfilter')
@include('mobile.spinner')
<div class="jobapp_list">



</div>
@stop
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
<script type="text/javascript" src="{{ asset('js/mobile/likeUnlikeBlockUnblockJS.js') }}"></script>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?libraries=places&key={{env('GOOGLE_API')}}"></script>
@section('custom_js')
<script type="text/javascript">



var getData = function(){

    var url = '{{route('mjobAppFilter')}}';
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.post(url, $('#jobapp_filter_form').serialize(), function(data){
        $('.jobapp_list').html(data);

    });
}

getData();



$(".reset-btn").click(function(){
				$("#jobapp_filter_form").trigger("reset");
    $("#filter").html("Filters" +"<i class='fas fa-angle-down rotate-icon'></i>");
    $('.FilterQuestionBox').addClass("d-none");
    $('.FilterLocationBox').addClass("d-none");
    $('.FilterIndustryList').addClass("d-none");
    $('#paginate').val('');
				getData();
});


$('#jobapp_filter_form').on('submit',function(event){
    console.log(' Form submitted ');
    event.preventDefault();
    $('#paginate').val('');
    getData();
});

    // change job application status, send ajax.
    $(document).on('change','select.jobApplicStatus',function(e){
        console.log(' jobApplicStatus change ', $(this));
        var statusElem = $(this);
        var status = $(this).val();
        var application_id = $(this).attr('data-application_id');
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'POST',
            url: base_url+'/m/ajax/MchangeJobApplicationStatus',
            data: {status: status, application_id: application_id},
            success: function(data){

                // var jobAppStatusHtml = '<span class="jobApplicationStatusResponse">Updated Succesfully</span>';
                // statusElem.closest('.jobApplicationStatusCont').append(jobAppStatusHtml);
                // setTimeout(function(){
                //   statusElem.closest('.jobApplicationStatusCont').find('.jobApplicationStatusResponse').remove();
                // },6000);

                $('.jobAppChangeStatus').css("display","block");

                setTimeout(function(){
                  $('.jobAppChangeStatus').hide();
                },3000);
            }
        });
    });


$('.questionsAnswers').click(function(){
    $('.application_qa').toggleClass('d-none');

})
</script>

@stop

@section('custom_css')

<style type="text/css">

.jobApplicationStatusCont{
    width: 100px;
}
input.select-dropdown.form-control {
    font-size: 12px;
}
.jobApplicationStatusResponse {
    display: block;
    position: absolute;
    font-size: 11px;
    margin: 6px;
    color: #fba82f;
}
</style>
@stop







