
@extends('mobile.user.usermaster')
@section('content')

 
{{-- <h6 class="h6 jobAppH6">Add New Job</h6> --}}




    {{-- @dump($job) --}}

    <div class="card border-info mb-3 shadow mb-3 bg-white rounded job_row jobApp_{{-- {{$application->id}} --}}">


        <div class="card">

            <div class="card-header jobAppHeader p-2 jobInfoFont text-center">
               <h5 class="font-weight-bold">Add New Job</h5>    
            <div>
             {{--        <div class="row p-0 m-0">
                        <span class="jobInfoFont">Location : </span>
                            <div class="jobDetail font-weight-normal"  style="margin: 0.2rem 0 0 0.2rem;">
                             {{($job->GeoCity)?($job->GeoCity->city_title):''}},  {{($job->GeoState)?($job->GeoState->state_title):''}}, {{($job->GeoCountry)?($job->GeoCountry->country_title):''}}</div>
                    </div> --}}
                </div>
            </div>

 
{{-- ============================================ Card Body ============================================ --}}

        <div class="card-body jobAppBody pt-2">

                 <form method="POST" name="new_job_form" class="new_job_form newJob job_validation">

                    @csrf
                
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label font-weight-bold">Title</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="title">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label font-weight-bold">Description</label>
                    <div class="col-sm-10">
                  <textarea class="form-control z-depth-1" id="description" rows="3" placeholder="Write something here..."></textarea>
                     
                    </div>
                </div>


                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label font-weight-bold">Experience</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="experience">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label font-weight-bold">Type</label>
                    <div class="col-sm-10">


                    <select name="type" class="browser-default custom-select" >
                        <option value="contract">Contract</option>
                        <option value="temporary">Temporary</option>
                        <option value="casual">Casual</option>
                        <option value="part_time">Part Time</option>
                        <option value="full_time">Full Time</option>
                    </select>

                    </div>
                </div>

                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label font-weight-bold">Location</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="location">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label font-weight-bold">Vacancies </label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="Vacancies ">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label font-weight-bold">Salary  </label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="Salary">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label font-weight-bold">Expiration Date</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="expiration-date">
                    </div>
                </div>

                <div class="questionstCard">


                <div class="form-group text-center font-weight-bold">
                    Job Questions
                </div>

                <div class="form-group row">

                    <label for="staticEmail" class="col-sm-2 col-form-label font-weight-bold">Title</label>

                    <div class="col-sm-10">

                      <input type="text" class="form-control" id="question-id">

                    </div>

                </div>


                <div class="form-group row">

                    <label for="staticEmail" class="col-sm-2 col-form-label font-weight-bold">Options</label>

                    <div class="col-sm-10">

                        <input type="text" class="col-sm-3 form-control float-left mr-5" id="question-id">

                        <div class="col-sm-3 custom-control custom-checkbox custom-control-inline mt-2">
                          <input type="checkbox" class="custom-control-input" id="defaultInline1">
                          <label class="custom-control-label font-weight-bold" for="defaultInline1">Gold Star</label>
                        </div>

                        <div class="col-sm-3 custom-control custom-checkbox custom-control-inline mt-2">
                          <input type="checkbox" class="custom-control-input" id="defaultInline2">
                          <label class="custom-control-label font-weight-bold" for="defaultInline2">Prefer</label>
                        </div>

                    </div>

                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <a class="jobApplyBtn graybtn jbtn btn btn-sm btn-primary mr-0 btn-xs">Add option</a>
                    </div>
                </div>

                </div>

            </div>

        </form>

{{-- ============================================ Card Body end ============================================ --}}


{{-- ============================================ Card Footer ============================================ --}}

            <div class="card-footer text-muted jobAppFooter p-1">

                    <div class="text-center">
    
                        <a class="jobApplyBtn graybtn jbtn btn btn-sm btn-success mr-0">Save</a>

                    </div>
                    
            </div>

{{-- ============================================ Card Footer end ============================================ --}}


        </div>

    </div> 
   



@stop


@section('custom_footer_css')
<style type="text/css">


</style>
@stop

@section('custom_js')


@stop

