

@section('custom_css')

<style type="text/css">
    .head.icon_head_browse_matches {
    text-align: center;
}
.jobsIApplied{
    background: #254c8e;
    color: white !important;
    padding: 10px 0px 10px 0px !important;

}
.jobtypeInTabs {
    margin-left: 15px;
}
.modal a.close-modal {
    top: 1.5px;
    right: 2.5px;
    }
</style>
@stop


<div class="newJobCont">
    <div class="head icon_head_browse_matches jobsIApplied">Jobs I Have Applied</div>

     <div class="add_new_job">
        {{-- @dump($jobsApplication) --}}
        <div class="job_row_heading jobs_filter">

        </div>

        @if ($jobsApplication->count() > 0)
        @foreach ($jobsApplication as $application)
            <div class="job_row jobApp_{{$application->id}}">

                @php
                    $job = $application->job;
                @endphp

                <div class="job_heading p10">
                    <div class="w_80p">
                        <h3 class=" job_title"><a>{{$job->title}}</a></h3>
                        <div class="job_location">
                            <div class="js_location">Location: {{$job->city}},  {{$job->state}}, {{$job->country}} </div>
                        </div>
                    </div>

                    <div class="fl_right">
                        <div class="j_label bold">Status</div>
                        <div class="j_value text_capital">{{$application->status}}</div>
                    </div>

                </div>
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
                <div class="job_info row p10 dblock">
                    <div class="w_25p jobtypeInTabs">
                        <div class="j_label bold">Job Type</div>
                        <div class="j_value">{{$jobType}}</div>
                    </div>

                    <div class="w_25p">
                        <div class="j_label bold">Job Experience</div>
                        <div class="j_value">@if(!empty($experience))
                            @foreach($experience as $industry )
                                <div class="IndustrySelect">

                                      <p>
                                        <i class="fas fa-angle-right qualifiCationBullet"></i>
                                          {{getIndustryName($industry)}}
                                          <i class="fa fa-trash removeIndustry hide_it"></i></p>
                                </div>
                            @endforeach
                        @endif</div>
                    </div>

                    <div class="w_25p">
                        <div class="j_label bold">Job Salary</div>
                        <div class="j_value">{{$job->salary}}</div>
                    </div>

                    {{-- <div class="w_25p">
                        <div class="j_label bold">Job Category</div>
                        <div class="j_value">Web & E-commerce Job</div>
                    </div> --}}
                </div>

                <div class="job_detail p10">
                    <div class="j_label bold">Job Detail</div>
                    <div>{{$job->description}}</div>
                </div>

                <div class="job_footer p10 relative">
                    <div class="w_25p">
                        <div class="j_label bold">Submitted</div>
                        {{-- @dump($jobsApplication->created_at->format('yy-mm-dd')) --}}
                        <div class="j_value">{{$application->created_at->format('yy-m-d')}}</div>
                    </div>

                    <div class="js_actionBtn bottom_10">
                        <button class="confirmJobAppRemoval redbtn jbtn" data-jobid="{{$application->id}}">Remove</button>
                    </div>
                </div>


            </div>
        @endforeach
        @endif
    </div>
            <div class="cl"></div>
</div>

<div style="display:none;">
<div id="confirmJobAppDeleteModal" class="modal cmodal p0 confirmJobAppDeleteModal wauto">
    <div class="pp_info_start pp_alert pp_confirm pp_cont" style="left: 0px; top: 0px; margin: 0;">
        <div class="cont">
            <div class="title">Delete Job Application?</div>
            <div class="spinner_loader">
                <div class="spinner center">
                    <div class="spinner-blade"></div>
                    <div class="spinner-blade"></div>
                    <div class="spinner-blade"></div>
                    <div class="spinner-blade"></div>
                    <div class="spinner-blade"></div>
                    <div class="spinner-blade"></div>
                    <div class="spinner-blade"></div>
                    <div class="spinner-blade"></div>
                    <div class="spinner-blade"></div>
                    <div class="spinner-blade"></div>
                    <div class="spinner-blade"></div>
                    <div class="spinner-blade"></div>
                </div>
            </div>
            <div class="apiMessage mt20"></div>
            <div class="img_chat">
                <div class="icon">
                    <img src="{{asset('/images/site/icons/icon_pp_sure.png')}}" height="48" alt="">
                </div>
                <div class="msg">Are you sure you wish to continue?</div>
            </div>
            <div class="double_btn">
                <button class="confirm_close btn small dgrey" onclick="UProfile.cancelGalleryConfirm(); return false;">Cancel</button>
                <button class="confirm_jobAppDelete_ok confirm_btn btn small marsh">OK</button>
                <input type="hidden" name="deleteConfirmJobAppId" id="deleteConfirmJobAppId" value=""/>
                <div class="cl"></div>
            </div>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    console.log(' new job doc ready  ');

    // $(".datepicker").datepicker({ dateFormat: "yy-mm-dd" });

    $('.confirmJobAppRemoval').on('click',function(){
        var job_id = $(this).attr('data-jobid');
        console.log(' confirmJobAppRemoval click  job_id ', job_id, $(this) );
        $('.modal.cmodal').removeClass('showLoader').removeClass('showMessage');
        $('#confirmJobAppDeleteModal').modal({
            fadeDuration: 200,
            fadeDelay: 2.5,
            escapeClose: false,
            clickClose: false,
        });
        $('#deleteConfirmJobAppId').val(job_id);
    });

    $(document).on('click','.confirm_jobAppDelete_ok',function(){
        // $('.confirmJobAppDeleteModal  .img_chat').html(getLoader('jobDeleteloader'));
        // $(this).prop('disabled',true);
        // $.modal.close();
        $('.confirmJobAppDeleteModal').addClass('showLoader');
        var job_app_id = $('#deleteConfirmJobAppId').val();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/deleteJobApplication/'+job_app_id,
            success: function(data){
                $('.confirmJobAppDeleteModal').removeClass('showLoader').addClass('showMessage');
                if( data.status == 1 ){
                    $('.confirmJobAppDeleteModal .apiMessage').html(data.message);
                    $('.jobApp_'+job_app_id).remove();
                }else{
                    $('.confirmJobAppDeleteModal .apiMessage').html(data.error);
                }
            }
        });

    });

});
</script>
