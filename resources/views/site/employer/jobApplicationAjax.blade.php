

    <div class="job_row_heading jobs_filter"></div>
    @if ($applications->count() > 0)
    @foreach ($applications as $application)
        @php
           $js = $application->jobseeker;
           // dd($application);
        @endphp

        <div class="jobSeeker_row dblock js_{{$js->id}} mb20 p20">

            <div class="jobSeeker_box relative dinline_block w100">
                @include('site.layout.parts.jobSeekerProfileStar')
                @include('site.layout.parts.jobSeekerProfilePhotoBox')

                @include('site.layout.parts.jobSeekerInfoBox')
                <div class="jobApplicAction">
                 @if (in_array($js->id,$likeUsers))
                    <a class="active graybtn jbtn" data-jsid="{{$js->id}}">Liked</a>
                 @else
                    <a class="jsLikeUserBtn graybtn jbtn" data-jsid="{{$js->id}}">Like</a>
                 @endif
                    <a class="graybtn jbtn" href="{{route('jobSeekerInfo',['id'=>$js->id])}}" >View Profile</a>
                    <div class="jobApplicationStatusCont dinline_block">
                        <select name="jobApplicStatus" class="select_aw jobApplicStatus" data-application_id="{{$application->id}}">
                             @foreach (jobStatusArray() as $statusK => $statusV)
                                  <option value="{{$statusK}}" {{($application->status == $statusK )?'selected="selected"':''}} >{{$statusV}}</option>
                             @endforeach
                        </select>
                    </div>
                </div>
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
