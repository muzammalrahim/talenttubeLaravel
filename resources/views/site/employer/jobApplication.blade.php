{{-- @extends('site.user.usertemplate') --}}
@extends('site.employer.employermaster')

@section('custom_css')
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
@stop

@section('content')
<div class="jobApplicationCont">
    <div class="head icon_head_browse_matches">JobSeeker Application Submitted</div>

    <div class="job_applications_filter mb20">
   
    {{ Form::open(array('url' => url()->current(), 'method' => 'get', 'id' => 'job_applications_filter_form' )) }}
        <input type="hidden" name="page" id="paginate" value="">
        <input type="hidden" name="job_id" value="{{$job->id}}">

        <div class="searchFieldLocation mb10 dblock">
            <div class="searchFieldLabel dinline_block">Location: </div>
            <div class="searchField filterCountry country_dd">
                <select name="ja_filter_country" class=""  data-placeholder="Select Country">
                    <option value="">Select Country</option>
                     @foreach(get_Geo_Country() as $country)
                       <option value="{{$country->country_id}}" >{{$country->country_title}}</option>
                    @endforeach
                </select>
            </div>

             <div class="searchField filterState state_dd">
                <select name="ja_filter_state" class="">
                    {{--  @foreach(get_Geo_State($job->state) as $state)
                       <option value="{{$state->state_id}}" >{{$state->state_title}}</option>
                    @endforeach --}}
                </select>
            </div>

            <div class="searchField filterState city_dd">
                <select name="ja_filter_city" class="">
                    {{--  @foreach(get_Geo_City($job->country, $job->state) as $city)
                       <option value="{{$city->city_id}}">{{$city->city_title}}</option>
                    @endforeach --}}
                </select>
            </div>

            

        </div>

        <div class="searchField_qualification mb10">
            <div class="searchFieldLabel dinline_block">Qualification: </div>
            <select class="dinline_block" name="ja_filter_qualification_type" data-placeholder="Select Qalification & Trades">
                 <option value="">Select Qalification & Trades</option>
                 <option value="certificate">Certificate or Advanced Diploma</option>
                 <option value="trade">Trade Certificate</option>
                 <option value="degree">University Degree</option>
                 <option value="post_degree">University Post Graduate (Masters or PHD)</option>
            </select>
        </div>

        <div class="searchField_salaryRange dblock mb10">
            <div class="searchFieldLabel dinline_block">Salary Range: </div>
            <select name="ja_filter_salary" class="dinline_block" data-placeholder="Select Salary Range">
                 <option value="">Select Salary Range</option>
                @foreach(getSalariesRange() as $sk => $salary)
                    <option value="{{$sk}}">{{$salary}}</option>
                @endforeach
            </select>
        </div>

        <div class="searchField_keyword dblock mb10">
            <div class="searchFieldLabel dinline_block">Keyword: </div>
            <input type="text" name="ja_filter_keyword">
        </div>
        
        <div class="searchField_action">
            <div class="searchFieldLabel dinline_block"></div>
            <button class="btn small OrangeBtn">Submit</button>
        </div>

    {{ Form::close() }}
    </div>



    <div class="job_applications">
         
        

       

    </div>

 


   


</div>

{{-- <div style="display:none;">
    <div id="confirmJobDeleteModal" class="modal p0 confirmJobDeleteModal wauto">
        <div class="pp_info_start pp_alert pp_confirm pp_cont" style="left: 0px; top: 0px; margin: 0;">
            <div class="cont">
                <div class="title">Delete Job?</div>
                <div class="img_chat">
                    <div class="icon">
                        <img src="{{asset('/images/site/icons/icon_pp_sure.png')}}" height="48" alt="">
                    </div>
                    <div class="msg">This action can not be undone. Are you sure you wish to continue?</div>
                </div>
                <div class="double_btn">
                    <button class="confirm_close btn small dgrey" onclick="UProfile.cancelGalleryConfirm(); return false;">Cancel</button>
                    <button class="confirm_jobDelete_ok btn small marsh">OK</button>
                    <input type="hidden" name="deleteConfirmJobId" id="deleteConfirmJobId" value=""/>
                    <div class="cl"></div>
                </div>
            </div>
        </div>
    </div>
    </div> --}}


@stop



@section('custom_js')
<script src="{{ asset('js/site/jquery.modal.min.js') }}"></script>
<script src="{{ asset('js/site/jquery-ui.js') }}"></script>
<script src="{{ asset('js/site/common.js') }}"></script>
{{-- <script src="{{ asset('js/site/profile_photo.js') }}"></script>  --}}
{{-- <script src="{{ asset('js/site/gallery_popup/jquery.magnific-popup.js') }}"></script>  --}}
{{-- <script src="{{ asset('js/site/gallery_popup/lc_lightbox.lite.js') }}"></script> --}}

<script type="text/javascript">
$(document).ready(function() {

    console.log(' new job doc ready ');
    // trigger date picker. 
    $(".datepicker").datepicker({ dateFormat: "yy-mm-dd" });

    // job Delete confirmation modal popup open. 
    $('.myJobDeleteBtn').on('click',function(){
        var job_id = $(this).attr('data-jobid');
        console.log(' confirmJobAppRemoval click  job_id ', job_id, $(this) );
        $('#confirmJobDeleteModal').modal({
            fadeDuration: 200,
            fadeDelay: 2.5,
            escapeClose: false,
            clickClose: false,
        });
        $('#deleteConfirmJobId').val(job_id);
    });

    // confirmation job delete ok trigger. 
    $(document).on('click','.confirm_jobDelete_ok',function(){
        $('.confirmJobDeleteModal  .img_chat').html(getLoader('jobDeleteloader'));
        $(this).prop('disabled',true);
        var job_id =  $('#deleteConfirmJobId').val();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/deleteJob/'+job_id,
            success: function(data){
                if( data.status == 1 ){
                    $('.confirmJobDeleteModal .img_chat').html(data.message);
                    $('.job_row.job_'+job_id).remove();
                }else{
                    $('.confirmJobDeleteModal .img_chat').html(data.error);
                }
            }
        });
    });

    // Show Job Application Question Answers. 
    $(document).on('click','.ja_load_qa',function(){
        var job_app_id = $(this).attr('data-appid');
        $(this).html(getLoader('jobDeleteloader'));
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'GET',
            url: base_url+'/ajax/getJobAppQA/'+job_app_id,
            success: function(data){
                $('.job_app_'+job_app_id+' .job_app_qa_box').html(data).show();
                $('.job_app_'+job_app_id+' .ja_load_qa').remove();
            }
        });
    });

    // Top Filter form submit load data throug ajax. 
    $('#job_applications_filter_form').on('submit',function(event){
        console.log(' job_applications_filter_form submit '); 
        event.preventDefault();
        getData();
    });
    
    // Bottom pagination load data throug ajax. 
    $(document).on('click','.job_pagination .page-item .page-link',function(e){
        console.log(' page-link click ', $(this) ); 
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        $('#paginate').val(page);
        getData();
    });

    // function to send ajax call for getting data throug filter/Pagination selection. 
    var getData = function(){
        var url = '{{route('jobAppFilter')}}';
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.post(url, $('#job_applications_filter_form').serialize(), function(data){
            $('.job_applications').html(data);
        });
    }

    // initially when page load trigger the ajax call to get data. 
    getData();





  // on country dorop down change update the state drop down. 
   $(document).on('change','.country_dd', function(){
     console.log(' country_dd ',this);
     var country_id = $('.country_dd select').val();
     var type = 'geo_states';
     console.log(' country_id ', country_id)
     get_Location('geo_states',country_id,0);
   });
   // country_dd end

   // on state drop down change update the city dropdown 
    $(document).on('change','.state_dd', function(){
     console.log(' state_dd ',this);
     var country_id = $('.country_dd select').val();
     var city_id = $('.state_dd select').val();
     var type = 'geo_cities';
     get_Location('geo_cities',country_id,city_id);
   });
   // country_dd end


  // get country/state dropdown data ajax.  
  get_Location = function(type, country_id, state_id){
    $.ajax({
        type: 'POST',
        url: base_url+'/ajax/'+type,
        data: { cmd:type,
                select_id: (type == 'geo_states')?country_id:state_id,
                filter:'1',
                list: 0
        },
        beforeSend: function(){
            // $jq('.geo, #city', pp_profile_edit_main_frm).prop('disabled', true).trigger('refresh');
            // preloader
        },
        success: function(data){
            console.log(data);
            if (data.status) {
                var option ='<option value="0">Select City</option>';
                switch (type) {
                    case 'geo_states':
                        $('.state_dd select').html(data.list).trigger('refresh');
                        $('.city_dd select').html(option).trigger('refresh');
                        break
                    case 'geo_cities':
                        $('.city_dd select').html(data.list).trigger('refresh');
                        break
                }
                formStyler();
            }
        }
    });
  }

  formStyler =  function(){
    $('#job_applications_filter_form input, #job_applications_filter_form select').styler({ selectSearch: true,});
  } 

});
</script>
@stop



@section('custom_footer_css')
<link rel="stylesheet" href="{{ asset('css/site/profile.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}">
{{-- <link rel="stylesheet" href="{{ asset('css/site/gallery_popup/magnific-popup.css') }}"> --}}
{{-- <link rel="stylesheet" href="{{ asset('css/site/gallery_popup/lc_lightbox.css') }}"> --}}
<style type="text/css">
button.ja_load_qa { background: #40c7db; }
.job_app_qa_box {
    padding: 10px;
    border: 1px solid rgba(0,0,0,0.1);
    border-radius: 4px;
    margin: 10px 0px;
}
.job_answers { margin-bottom: 6px; }
.jqa_q {
    margin: 2px 0px;
    display: inline-block;
}
.jqa_a {
    margin: 2px 0px;
    display: inline-block;
    font-weight: bold;
    color: #eea11e;
}
.searchFieldLabel { min-width: 100px; }
.searchField { display: inline-block; }
.job_pagination li.page-item {
    display: inline-block;
    border: 1px solid #ff5f4e;
    border-radius: 4px;
    vertical-align: text-bottom;
}
.job_pagination li.page-item span {
    text-align: center;
    padding: 9px;
    display: table-cell;
}
.job_pagination li.page-item.active {
    color: white;
    background: #ff5f4e;
}
</style>

@stop