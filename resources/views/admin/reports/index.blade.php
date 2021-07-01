@extends('adminlte::page')

@section('title',$title)

@section('content_header')

<div class="block row">
    <div class="col-md-2"><h1 class="m-0 text-dark">{{$content_header}}</h1></div>
    <div class="block row col-md-8 text-white">
    </div>
    <div class="col-md-2">
        <div class="float-right">
            {{-- <a href="{!! route('onlineTest.create') !!}" class="btn btn-block btn-success">Add New</a> --}}
        </div>
    </div>

</div>


@stop


@section('content')

@include('admin.errors')
@include('admin.success')


<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-4">
                <div class="card-header font-weight-bold"> Jobseekers</div>
                Total Males : {{ $males->count() }} <br>
                Total Females : {{ $females->count() }} <br>
        
            </div>

            <div class="col-4">
                <div class="card-header font-weight-bold"> Age Brackets</div>

                <div class="row">
                    <div class="col-6"> From Age 18 to 25 </div>
                    <div class="col-6"> {{ $first_loop }}</div>
                </div>

                <div class="row">
                    <div class="col-6"> From Age 26 to 30 </div>
                    <div class="col-6"> {{ $second_loop }}</div>
                </div>
                <div class="row">
                    <div class="col-6"> From Age 31 to 40 </div>
                    <div class="col-6"> {{ $third_loop }}</div>
                </div>
                <div class="row">
                    <div class="col-6"> From Age 41 to 54 </div>
                    <div class="col-6"> {{ $forth_loop }}</div>
                </div>
                <div class="row">
                    <div class="col-6"> From Age 54 + </div>
                    <div class="col-6"> {{ $fifth_loop }}</div>
                </div>
            </div>

            <div class="col-4">
                <div class="card-header font-weight-bold"> Job Seeker's Initial Question</div>

                <div class="row">
                    <div class="col-9"> Are you seeking a Graduate Program or Internship? </div>
                    <div class="col-3"> {{ $user_q1_count }}</div>
                </div>
                <div class="row">
                    <div class="col-9"> Are you open to Part Time or Casual work? </div>
                    <div class="col-3"> {{ $user_q2_count }}</div>
                </div>
                <div class="row">
                    <div class="col-9">Are you open to temporary and contract work?</div>
                    <div class="col-3"> {{ $user_q3_count }}</div>
                </div>
                <div class="row">
                    <div class="col-9">Are you looking for Full Time Employment?</div>
                    <div class="col-3"> {{ $user_q4_count }}</div>
                </div>
                <div class="row">
                    <div class="col-9">Are you looking or willing to relocate for your next job opportunity?</div>
                    <div class="col-3"> {{ $user_q5_count }}</div>
                </div>

                <div class="row">
                    <div class="col-9">Are you a Permanent Resident or Citizen of Australia or New Zealand?</div>
                    <div class="col-3"> {{ $user_q6_count }}</div>
                </div>

            </div>

            <div class="col-4">
                <div class="card-header font-weight-bold"> Qualification Level</div>
                Trade Qualification {{ $trade }} <br>
                Certificate Qualification {{$certificate}}<br>
                Degree Qualification {{ $degree }}<br>
                Post Degree Qualification {{ $post_degree }}<br>
            </div>

            <div class="col-4">
                <div class="card-header font-weight-bold"> Qualification Types</div>

                <div class="row">
                    <div class="col-9"> Name </div>
                    <div class="col-3"> Count</div>
                </div>
                @foreach ($userQual as $qualif)
                    <div class="row">
                        <div class="col-9">  <b>{{ $loop->index+1 }}) </b> {{ $qualif->qualificationNames->title }} </div>
                        <div class="col-3"> {{ $qualif->qualif_count }}</div>
                    </div>
                @endforeach
            </div>

            <div class="col-4">
                <div class="card-header font-weight-bold"> Most Popular Location</div>

                <div class="row">
                    <div class="col-9"> City </div>
                    <div class="col-3"> Count</div>
                </div>
                @foreach ($userLocation as $location)

                    <div class="row">
                        <div class="col-9">  <b>{{ $loop->index+1 }}) </b> {{ $location->city }} </div>
                        <div class="col-3"> {{ $location->city_count }} </div>
                    </div>
                @endforeach
            </div>

            {{-- Industry Experience --}}

            <div class="col-4">
                <div class="card-header font-weight-bold"> Industry Experience </div>

                <div class="row">
                    <div class="col-9"> Industry  </div>
                    <div class="col-3"> Count</div>
                </div>
                @foreach ($indus as $ind)
                    <div class="row">
                        <div class="col-9">  <b>{{ $loop->index+1 }}) </b> {{ $industriesnew[$loop->index] }} </div>
                        <div class="col-3"> {{ $ind }} </div>
                    </div>
                @endforeach
            </div>
            
            {{-- Industry Experience --}}

        </div>
        

    </div>
</div>

@stop


@section('css')
<link rel="stylesheet"  href="{{ asset('css/admin_custom.css') }}">
<style type="text/css">

</style>
@stop

@section('plugins.Datatables') @stop

@section('js')
<script src="{{ asset('js/admin_custom.js') }}"></script>

<script type="text/javascript">
    var base_url = '{!! url('/') !!}';


    
</script>
<script>


</script>
@stop
