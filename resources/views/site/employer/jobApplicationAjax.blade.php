 
    
        <div class="job_row_heading jobs_filter"></div>

        @if ($applications->count() > 0)
        @foreach ($applications as $application)
            @php
               $js = $application->jobseeker;
            @endphp

            <div class="jobSeeker_row dblock js_{{$js->id}} mb20 p20">
                <div class="jobSeeker_box relative dinline_block w100">
                    @include('site.layout.parts.jobSeekerProfileStar')
                    @include('site.layout.parts.jobSeekerProfilePhotoBox')
                    @include('site.layout.parts.jobSeekerInfoBox')
                </div>
                
                <div class="job_app_qa job_app_{{$application->id}}">
                    <div><button class="ja_load_qa btn small" data-appid="{{$application->id}}">Question/Answers</button></div>
                    <div class="job_app_qa_box" style="display: none;"></div>
                </div>
            </div>


        @endforeach
        @endif
 

 
    
    <div class="cl"></div>


    <div class="job_pagination cpagination">{!! $applications->render() !!}</div>