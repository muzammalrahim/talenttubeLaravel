@extends('mobile.user.usermaster') {{-- mobile/user/usermaster --}}
@section('content')

    {{-- <h6 class="h6 jobAppH6">Job Seekeers</h6> --}}
    <!-- =============================================================================================================================== -->

    @include('mobile.employer.jobSeekers.filter') {{-- mobile/employer/jobSeekers/filter --}} 

    <!-- mobile/employer/jobSeekers/filter -->
         @include('mobile.spinner')
    <!-- =============================================================================================================================== -->




    {{-- <div class="has-slider">
            <div style="color: #fff;" class="prev">prev</div>
            <div style="color: #fff;" class="next">next</div>
            
              <div class="slider mslider">

            @foreach ($employer as $emp)

                <div class="slider-panel">
                    <a href="">

                        {{ $emp->company }}

                        <img src="https://images.pexels.com/photos/39811/pexels-photo-39811.jpeg?w=940&amp;h=650&amp;auto=compress&amp;cs=tinysrgb" alt="" />
                    </a>
                </div>

            @endforeach
              </div>
            

            <div class="slider-pagination"></div>
    </div> --}}

    <div class="jobSeekers_list">
        @include('mobile.employer.jobSeekers.swipe_jobseekerList')  <!-- mobile/employer/jobSeekers/swipe_jobseekerList -->
    </div> 

@stop




<script type="text/javascript" src="https://maps.google.com/maps/api/js?libraries=places&key={{env('GOOGLE_API')}}"></script>

<link rel="stylesheet"href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>


<style type="text/css">
    
</style>
@section('custom_js')

<script type="text/javascript">
$(document).ready(function() {


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
$('#jobSeeker_filter_form').on('submit',function(event){
    console.log(' jobSeeker_filter_form submit ');
    event.preventDefault();
    $('#paginate').val('');
    getData();
});

// function to send ajax call for getting data throug filter/Pagination selection.
var getData = function(){
    var url = '{{route('swipeJobSeekersFilter')}}';
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    var jqxhr = $.post(url, $('#jobSeeker_filter_form').serialize(), function(data){
        // console.log(' success data  ', data);
        $('.jobSeekers_list').html(data);
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
    console.log(' filter_location_status ');
    (this.checked)?(jQuery('.location_search_cont').removeClass('hide_it')):(jQuery('.location_search_cont').addClass('hide_it'));
});

//====================================================================================================================================//
// Enable/Disabled Filtering by Questions.
//====================================================================================================================================//
$('input[name="filter_by_questions"]').change(function() {
    console.log(' filter_by_questions ');
    (this.checked)?(jQuery('.filter_question_cont').removeClass('hide_it')):(jQuery('.filter_question_cont').addClass('hide_it'));
     // $('input, select').styler({ selectSearch: true, });
});


$(".reset-btn").click(function(){
    $("#jobSeeker_filter_form").trigger("reset");
    $("#filter").html("Filters" +"<i class='fas fa-angle-down rotate-icon'></i>");
    $('.FilterQuestionBox').addClass("d-none");
    $('.FilterLocationBox').addClass("d-none");
    $('.FilterIndustryList').addClass("d-none");
    $('#paginate').val('');
    getDataCustom();
});
//made custom function for global call to refresh the job seekers data on rest
var getDataCustom = function(){
    var url = '{{route('swipeJobSeekersFilter')}}';
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.post(url, $('#jobSeeker_filter_form').serialize(), function(data){
        // console.log(' success data  ', data);
        $('.jobSeekers_list').html(data);
    });
}
});
</script>
@stop








