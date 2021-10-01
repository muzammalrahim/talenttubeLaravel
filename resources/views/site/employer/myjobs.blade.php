
@extends('site.employer.employermaster')

@section('custom_css')
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
@stop

@section('content')
{{-- <div class="newJobCont">
    <div class="head icon_head_browse_matches">My Jobs</div>
    <div class="add_new_job">
        <div class="job_row_heading jobs_filter"></div> --}}
{{-- 
        @if ($jobs->count() > 0)
        @foreach ($jobs as $job)
        <div class="job_row job_{{$job->id}}">
            @dump($job->id)
            @php
            $experience = json_decode($job->experience);
            $jobType = '';
            if($job->type == 'Contract')
            {
                $jobType = 'Contract';
            }
            elseif ($job->type == 'temporary') {
                $jobType = 'Temporary';
            }
            elseif ($job->type == 'casual') {
                $jobType = 'casual';
            }
            elseif ($job->type == 'full_time') {
                $jobType = 'Full time';
            }
            elseif ($job->type == 'part_time') {
                $jobType = 'Part time';
            }
            @endphp --}}
           {{--  <div class="job_heading p10">
                <h3 class="job_title">{{$job->title}}</h3>
                <div class="job_location">
                    <span>Location : </span>
                    {{$job->city}},  {{($job->state)}}, {{($job->country)}}
                </div>
            </div>
            <div class="job_info row p10 dblock">
                <div class="w_25p">
                    <div class="j_label bold">Job Type</div>
                    <div class="j_value">{{$jobType}}</div>
                </div> --}}
{{-- 
                <div class="w_25p">
                    <div class="j_label bold">Job Experience</div>
                    <div class="j_value">  @if(!empty($experience))
                        @foreach($experience as $industry )
                            <div class="IndustrySelect">
                                <p><i class="fas fa-angle-right qualifiCationBullet"></i>{{getIndustryName($industry)}}
                                      <i class="fa fa-trash removeIndustry hide_it"></i>
                                </p>
                            </div>
                        @endforeach
                    @endif</div>
                </div> --}}
{{-- 
                <div class="w_25p">
                    <div class="j_label bold">Job Salary</div>
                    <div class="j_value">{{$job->salary}}</div>
                </div>

            </div>

            <div class="job_detail p10">
                <div class="j_label bold">Job Detail</div>
                <div>{{$job->description}}</div>
            </div>

            <div class="job_footer p10">
                <div class="w_25p">
                    <div class="j_label bold">Expire on</div>
                    <div class="j_value">{{ ($job->expiration)?($job->expiration->format('yy-m-d')):''}}</div>
                </div>

                <div class="w_25p">

                   <a href="{{route('empJobApplications',['id' => $job->id])}}">

                    <button type="button" class="ApplicationCountButton">
                    <div class="j_label bold">Applications</div>
                    <div class="j_value" style="font-weight:700;"><u>{{($job->applicationCount)?($job->applicationCount->aggregate):0}}<u/></div></button></a>

                </div>

                <div class="w50 fl_right">

                    <div class="j_button dinline_block fl_right m5">
                        <a class="jobDetailBtn graybtn jbtn " href="{{route('jobDetail',['id' => $job->id])}}">Detail</a>
                    </div>
                    <div class="j_button dinline_block fl_right m5">
                        <a class="graybtn jbtn" href="{{route('employerJobEdit',['id' => $job->id])}}">Edit</a>
                    </div>
                    <div class="j_button dinline_block fl_right m5">
                        <a class="myJobDeleteBtn graybtn jbtn"  data-jobid="{{$job->id}}">Delete</a>
                    </div>

                    
                    <div class="j_button dinline_block fl_right m5">
                        <a class="jobDetailBtn graybtn jbtn " href="{{route('advertise',['id' => $job->id])}}">Advertising</a>
                    </div>

                </div>
            </div>


        </div>
        @endforeach
            @else
                <h3>You have not posted any job yet</h3>
        @endif

    </div>

<div class="cl"></div>
</div>

<div style="display:none;">
    <div id="confirmJobDeleteModal" class="modal p0 confirmJobDeleteModal wauto">
        <div class="pp_info_start pp_alert pp_confirm pp_cont" style="left: 0px; top: 0px; margin: 0;">
            <div class="cont">
                <div class="title">Delete Job?</div>

                <div class="img_chat">

                </div>

                <div class="successMessage">

                </div>

                <div class="contentBody">
                    <div class="icon" style="margin: 10px 0px 20px 0px;">
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
    </div>
 --}}

{{-- html for emloyers job section --}}
   <div class="row">
                 @if ($jobs->count() > 0)
                 @foreach ($jobs as $job)
       {{--  <div class="job_row job_{{$job->id}}"> --}}
            {{-- @dump($job->id) --}}
            @php
            $experience = json_decode($job->experience);
            $jobType = '';
            if($job->type == 'Contract')
            {
                $jobType = 'Contract';
            }
            elseif ($job->type == 'temporary') {
                $jobType = 'Temporary';
            }
            elseif ($job->type == 'casual') {
                $jobType = 'casual';
            }
            elseif ($job->type == 'full_time') {
                $jobType = 'Full time';
            }
            elseif ($job->type == 'part_time') {
                $jobType = 'Part time';
            }
            @endphp
                      <div class="col-sm-12 col-md-6">
                       <div class="job-box-info block-box clearfix">
                         <div class="box-head">
                           <h4 class="text-white">{{$job->title}}</h4>  
                           <h6>Location: {{$job->city}},  {{($job->state)}}, {{($job->country)}}</h6>                        
                         </div>
                         <div class="row Block-user-wrapper">
                                     <ul class="job-box-text concigerge clearfix">
                                <li class="text-info-detail clearfix">
                                  <label>Job Type:</label>
                                  <span>{{$jobType}}</span>
                                </li>
                                <li class="text-info-detail clearfix">
                                 <label>Job Detail:</label>
                                 <p>{{$job->description}}</p>
                                </li>
                               <li class="text-info-detail clearfix">
                                 <label>Job Experience:</label>
                            <span> 
                                @if(!empty($experience))
                                    @foreach($experience as $industry )
                                        <ul class="IndustrySelect">
                                            <li>{{getIndustryName($industry)}} </li>
                                        </ul>
                                    @endforeach
                                 @endif
                             </span>
                               </li>
                               <li class="text-info-detail clearfix">
                                 <label>Job Salary:</label>
                                 <span>{{$job->salary}}</span>
                               </li>
                               <li class="text-info-detail clearfix">
                                <label>Expired On:</label>
                                <span>{{ ($job->expiration)?($job->expiration->format('yy-m-d')):''}}</span>
                              </li>
                                 <a href="{{route('empJobApplications',['id' => $job->id])}}">
                                <button type="button">
                                <div class="j_label bold">Applications</div>
                                <div class="j_value" style="font-weight:700;"><u>{{($job->applicationCount)?($job->applicationCount->aggregate):0}}<u/></div></button>
                                </a>
                            </ul>
                         
                         </div>
                         <div class="box-footer1 box-footer  clearfix">
                           <div class=" employe-btn-group " style="float: right !important;">
                           <button class="block-btn" data-toggle="modal" data-target="#myModal"><i class="fas fa-trash" ></i> Delete</button>
                          <a href="{{route('jobDetail',['id' => $job->id])}}"> <button class="detail-btn" ><i class="fas fa-file-alt"></i> Detail</button></a>
                           <a href="{{route('employerJobEdit',['id' => $job->id])}}"><button class="like-btn"><i class="fas fa-thumbs-up"></i> Edit</button></a>
                          <a href="{{route('advertise',['id' => $job->id])}}"> <button class="like-btn">Advertisement</button></a>

                          </div>                                
                         </div>
                      </div>
                    </div>   
                      @endforeach
                        @else
                            <h3>You have not posted any job yet</h3>
                    @endif
                   </div>




{{-- modal for unblock user of block page --}}

   <!-- ====================================================================================Modal -->
              <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog delete-applications">
                
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <i data-dismiss="modal" class="close-box fa fa-times"></i>                      
                      <h1 class="modal-title"><i class="fas fa-trash trash-icon"></i>Delete Job</h1> 
                    </div>
                    <div class="modal-body">
                      <strong>Are you sure you wish to continue?</strong>
                    </div>
                    <div class="dual-footer-btn">
                      <button type="button" class="btn btn-default black_btn" data-dismiss="modal"><i class="fa fa-times"></i>Cancel</button>
                      <button type="button" class="orange_btn"><i class="fa fa-check"></i>OK</button>
                    </div>
                  </div>
                  
                </div>
              </div>
{{-- html for emloyers job section ends here --}}

@stop

@section('custom_footer_css')
<link rel="stylesheet" href="{{ asset('css/site/profile.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}"> --}}
{{-- <link rel="stylesheet" href="{{ asset('css/site/gallery_popup/magnific-popup.css') }}"> --}}
{{-- <link rel="stylesheet" href="{{ asset('css/site/gallery_popup/lc_lightbox.css') }}"> --}}


@stop

@section('custom_js')
{{-- <script src="{{ asset('js/site/jquery.modal.min.js') }}"></script> --}}
<script src="{{ asset('js/site/jquery-ui.js') }}"></script>
<script src="{{ asset('js/site/common.js') }}"></script>
{{-- <script src="{{ asset('js/site/profile_photo.js') }}"></script>  --}}
{{-- <script src="{{ asset('js/site/gallery_popup/jquery.magnific-popup.js') }}"></script>  --}}
{{-- <script src="{{ asset('js/site/gallery_popup/lc_lightbox.lite.js') }}"></script> --}}

{{-- <script type="text/javascript">
$(document).ready(function() {

    console.log(' new job doc ready ');
    $(".datepicker").datepicker({ dateFormat: "yy-mm-dd" });

    $('.myJobDeleteBtn').on('click',function(){
        var job_id = $(this).attr('data-jobid');
        console.log(' confirmJobAppRemoval click  job_id ', job_id, $(this) );
        $('.contentBody').show();
        $('.double_btn').show();
        // $('.img_chat').hide();
        $('.successMessage').hide();
        $('#confirmJobDeleteModal').modal({
            fadeDuration: 200,
            fadeDelay: 2.5,
            escapeClose: false,
            clickClose: false,
        });
        $('#deleteConfirmJobId').val(job_id);
    });
    $(document).on('click','.confirm_jobDelete_ok',function(){
        $('.confirmJobDeleteModal .img_chat').html(getLoader('jobDeleteloader'));
        // $(this).prop('disabled',true);
        var job_id =  $('#deleteConfirmJobId').val();
        $('.contentBody').hide();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/deleteJob/'+job_id,
            success: function(data){
                if( data.status == 1 ){
                    var jobDeletingMessage = data.message;
                    console.log(jobDeletingMessage);
                    $('.successMessage').text(jobDeletingMessage).show();
                    $('.jobDeleteloader').hide();
                    // $('.confirmJobDeleteModal .img_chat').html(data.message).show();
                    $('.job_row.job_'+job_id).remove();
                    $('.double_btn').hide();
                }else{
                    $('.confirmJobDeleteModal .img_chat').html(data.error);
                }
            }
        });
    });


});
</script> --}}
@stop

