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
                <div class="card-header font-weight-bold"> Total Employer</div>
                Employers : {{ $employers }} <br>
                {{-- Total Females : {{ $females->count() }} <br> --}}
        
            </div>

            <div class="col-4">
                <div class="card-header font-weight-bold"> Employer's Initial Question</div>

                <div class="row">
                    <div class="col-9"> Does your company hire Graduates or Interns? </div>
                    <div class="col-3"> {{ $user_q1_count }}</div>
                </div>
                <div class="row">
                    <div class="col-9"> Are you open to Part Time or Casual workers? </div>
                    <div class="col-3"> {{ $user_q2_count }}</div>
                </div>
                <div class="row">
                    <div class="col-9"> Does you organisation offer temporary or contract type work? </div>
                    <div class="col-3"> {{ $user_q3_count }}</div>
                </div>
                <div class="row">
                    <div class="col-9"> Are you looking for Full Time candidates? </div>
                    <div class="col-3"> {{ $user_q4_count }}</div>
                </div>
                <div class="row">
                    <div class="col-9"> Are you willing to repay relocation expenses for a strong candidate? </div>
                    <div class="col-3"> {{ $user_q5_count }}</div>
                </div>

                <div class="row">
                    <div class="col-9"> Does your organisation ever hire candidates who are not Permanent Residents or Citizens? </div>
                    <div class="col-3"> {{ $user_q6_count }}</div>
                </div>

            </div>

            {{-- Most Popular Location --}}

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
            


            


        </div>

        {{-- Industry Experience --}}

        <div class="row">
            <div class="col-12 card-header font-weight-bold text-center"> Industry Experience </div>
        </div>

        <div class="row">

            @php
                $ind1 = array_slice($indus, 0, 14, true);
                $ind2 = array_slice($indus, 14, 14, true);
                $ind3 = array_slice($indus, 28, 14, true);
                // dump($ind1 , $ind2, $ind3);
            @endphp

            <div class="col-4">
                <div class="row">
                    <div class="col-9"> Industry  </div>
                    <div class="col-3"> Count</div>
                </div>               
         
                @foreach ($ind1 as $key => $ind)

                    <div class="row Industries">
                        <div class="col-9">   {{ $industriesnew[$key] }} </div>
                        <div class="col-3"> {{ $ind }} </div>
                    </div>
                @endforeach
            </div>


            <div class="col-4">
                <div class="row">
                    <div class="col-9"> Industry  </div>
                    <div class="col-3"> Count</div>
                </div>               
         
                @foreach ($ind2 as $key => $ind)

                    <div class="row Industries">
                        <div class="col-9">   {{ $industriesnew[$key] }} </div>
                        <div class="col-3"> {{ $ind }} </div>
                    </div>
                @endforeach
            </div>


            <div class="col-4">
                <div class="row">
                    <div class="col-9"> Industry  </div>
                    <div class="col-3"> Count</div>
                </div>               
         
                @foreach ($ind3 as $key => $ind)

                    <div class="row Industries">
                        <div class="col-9">   {{ $industriesnew[$key] }} </div>
                        <div class="col-3"> {{ $ind }} </div>
                    </div>
                @endforeach
            </div>
            
            {{-- Filter end here --}}
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
