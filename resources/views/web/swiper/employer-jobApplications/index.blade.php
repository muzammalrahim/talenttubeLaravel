@extends('web.user.usermaster') {{-- mobile/user/usermaster --}}
@section('content')
    
    @section('custom_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/swiper/swipers.css') }}">
    @endsection

    <!-- =============================================================================================================================== -->
    <div class="filter-div" style="height: 60px;position: relative;">

        @include('web.swiper.employer-jobApplications.filter') {{-- web/swiper/jobseekers/filter --}} 

    </div>
        

    @include('mobile.spinner')
    @include('web.modals.sendTest')

    {{-- @include('web.modals.jobApplication-questions') --}}

    <div class="applications_list">
        @include('web.swiper.employer-jobApplications.list')  <!--  web/swiper/employer-jobApplications/list -->
    </div> 

    
@stop


<script type="text/javascript" src="https://maps.google.com/maps/api/js?libraries=places&key={{env('GOOGLE_API')}}"></script>

<link rel="stylesheet"href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>


<style type="text/css">
    @media only screen and (max-width: 768px){
        .sidebaricontoggle{
            top: 3.69rem !important;
        }

      }
</style>
@section('custom_js')

<script type="text/javascript">
$(document).ready(function() {


    @include('web.map.map')

        
    //====================================================================================================================================//
    // Block User Confirmed.
    //====================================================================================================================================//


    $(document).on('click','.confirm_JobSeekerBlock_ok',function(){
        console.log(' confirm_JobSeekerBlock_ok ');
        var jobseeker_id = $('#jobSeekerBlockId').val();

        $('.confirmJobSeekerBlockModal  .img_chat').html(getLoader('blockJobSeekerLoader'));
        var btn = $(this); //
        btn.prop('disabled',true);

        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/blockJobSeeker/'+jobseeker_id,
            success: function(data){
                btn.prop('disabled',false);
                if( data.status == 1 ){
                    $('.confirmJobSeekerBlockModal .img_chat').html(data.message);
                    $('.jobSeeker_row.js_'+jobseeker_id).remove();
                }else{
                    $('.confirmJobSeekerBlockModal .img_chat').html(data.error);
                }
            }
        });
    });

//====================================================================================================================================//
// Top Filter form submit load data throug ajax.
//====================================================================================================================================//
$('#jobapp_filter_form').on('submit',function(event){
    console.log(' jobSeeker_filter_form submit ');
    event.preventDefault();
    $('#paginate').val('');
    getData();
});

// function to send ajax call for getting data throug filter/Pagination selection.
var getData = function(){
    var url = '{{route('swiper.jobAppFilter')}}';
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    var jqxhr = $.post(url, $('#jobapp_filter_form').serialize(), function(data){
        // console.log(' success data  ', data);
        $('.applications_list').html(data);
    });
}

getData();

// Bottom pagination load data throug ajax.
$(document).on('click','.jobseeker_pagination .page-item .page-link',function(e){
    console.log(' page-link click ', $(this) );
    e.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
    $('#paginate').val(page);
    getData();
});



//====================================================================================================================================//
// Enable/Disabled Filtering by google map location.
//====================================================================================================================================//
$('input[name="filter_location_status"]').change(function() {
    var filterByLocation = $('input[name="filter_location_status"]').is(':checked');
    console.log(' filter_location_status ', filterByLocation);
    (filterByLocation)?(jQuery('.location_search_cont').removeClass('d-none')):(jQuery('.location_search_cont').addClass('d-none'));
});

//====================================================================================================================================//
// Enable/Disabled Filtering by Questions.
//====================================================================================================================================//
$('input[name="filter_industry_status"]').change(function() {
    var filterByIndustry = $('input[name="filter_industry_status"]').is(':checked');
    (filterByIndustry)?(jQuery('.FilterIndustryList').removeClass('d-none')):(jQuery('.FilterIndustryList').addClass('d-none'));
     // $('input, select').styler({ selectSearch: true, });
});

$('input[name="filter_by_questions"]').change(function() {
    var filterByQuestions = $('input[name="filter_by_questions"]').is(':checked');
    console.log(' filter_by_questions ', filterByQuestions);
    (filterByQuestions)?(jQuery('.FilterQuestionBox').removeClass('d-none')):(jQuery('.FilterQuestionBox').addClass('d-none'));
});


$('select[name="ja_filter_qualification_type"]').change(function() {
    var qualification = $('select[name="ja_filter_qualification_type"]').val();
    console.log(' filter_by_questions ', qualification);
    (qualification)?(jQuery('.qualification_degree').removeClass('d-none')):(jQuery('.qualification_degree').addClass('d-none'));
});


});

this.showOverlay = function(){
    if ($('#collapse1').hasClass('show')) {
        $('.overlay').css('display','none');
    }else{
        $('.overlay').css('display','block');
    }
    console.log('herhehrehrhehrher');
}


this.showQualificationSelect2Swiper = function(){
  // console.log('on change qualification');
  var selected = $('.filter_qualification_type option:selected').val();
  // console.log(selected);
  if (selected != '') {
     $('.filter_qualificaton_degree').css('opacity', '1');
     $('.dropdownSelect2').css('opacity', '1');
  }
  else{
     $('.filter_qualificaton_degree').css('opacity', '0');
     $('.dropdownSelect2').css('opacity', '0');
     $("#filter_by_qualification").val('').trigger('change');

  }
}

this.locationReload = function(){
    location.reload();
}

$(document).on('click', '.getJobAppAnswers',function(){
    var job_app_id = $(this).data('app-id');
    console.log(job_app_id)
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.ajax({
        type: 'GET',
        url: base_url+'/ajax/getJobAppQA/'+job_app_id,
        success: function(data){
            $('#jobApplication-questions .response').html(data);
            // $('#jobApplication-questions').show();
       }
    });

});


$(document).on('click' , '.requestTest', function(){
    // console.log('request test button');
    var job_id = $(this).attr('data-jobAppId');
    console.log(job_id);
    $('.jobAppIdModal').val(job_id);

});
/*
this.sendTestFunction = function(){
    var formData = $('.sendTestForm').serializeArray();
    console.log(formData); return;
}*/

this.sendOnlineTestNotification = function(){
    var formData = $('.sendTestForm').serializeArray();
    // $('.sendTestButton').html(getLoader('pp_profile_edit_main_loader')).prop('disabled',true);
    console.log(formData); 
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.ajax({
          type: 'POST',
          url: base_url+'/ajax/sendOnlineTest',
          data:formData,
          success: function(response){
              $('.sendTestButton').html('Send Test').prop('disabled',false);
              if( response.status == 1 ){
                  $('.errorsInFields').text('Test has been sent sucessfully');
                  $('.errorsInFields').removeClass('to_hide').addClass('to_show');
                  setTimeout(() => { $('.errorsInFields').removeClass('to_show').addClass('to_hide').text(''); },4000);
              }else if(response.status == 0){
                $('.sendTestButton').html('Send Test').prop('disabled',false);
                $('.errorsInFields').text('you have already sent test to this applicant');
                $('.errorsInFields').removeClass('to_hide').addClass('to_show');

                setTimeout(() => { $('.errorsInFields').removeClass('to_show').addClass('to_hide').text(''); },4000);
              }
              else{
                  $('.sendTestButton').html('Send Test').prop('disabled',false);
                  $('.errorsInFields').text('Error occured');
                  setTimeout(() => { $('.errorsInFields').removeClass('to_show').addClass('to_hide').text(''); },4000);
              }
          }
    });
}

$(document).on('change','select.jobApplicStatus',function(e){
    console.log(' jobApplicStatus change ', $(this));
    var statusElem = $(this);
    var status = $(this).val();
    var application_id = $(this).attr('data-application_id');
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.ajax({
        type: 'POST',
        url: base_url+'/ajax/changeJobApplicationStatus',
        data: {status: status, application_id: application_id},
        success: function(data){
            alert('Updated Succesfully');
            /*var jobAppStatusHtml = '<span class="jobApplicationStatusResponse">Updated Succesfully</span>';
            statusElem.closest('.jobApplicationStatusCont').append(jobAppStatusHtml);
            setTimeout(function(){
                statusElem.closest('.jobApplicationStatusCont').find('.jobApplicationStatusResponse').remove();
            },1500);*/
        }
    });
});

</script>
@stop








