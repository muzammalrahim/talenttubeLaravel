
@extends('mobile.user.usermaster')

@section('custom_css')
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
@stop

@section('content')

  <div class="card shadow mb-3 bg-white rounded">
    <h6 class="card-header h6 m-0">My Cross References </h6>
    <div class="add_new_job card-body cardBody p-0">

      @if ($crossreference->count() > 0)
        {{-- expr --}}
      
      @foreach ($crossreference as $reference)
        <div class="referees p-2 mb-2">
          <p class="font-weight-bold"> <span class="bold">Reference </span> <span> ({{ $loop->index+1 }})</span></p>
          <p class="p-0 m-0"> <span class="font-weight-bold">Referee: </span> <span> {{ $reference->refName }} </span></p>
          <p class="p-0 m-0"> <span class="font-weight-bold">Type: </span> <span> {{ $reference->refType }} </span></p>
          @if ($reference->refStatus == "Reference Fraud")
            <p class="p-0 m-0"> <span class="font-weight-bold">Status: </span> <span> Awaiting Response</span></p>
          @else
          <p class="p-0 m-0"> <span class="font-weight-bold">Status: </span> <span> {{ $reference->refStatus }} </span></p>
          @endif
          <p class="p-0 m-0"> <span class="font-weight-bold">Phone: </span> <span> {{ $reference->refPhone }} </span></p>
          <p class="p-0 m-0"> <span class="font-weight-bold">Email: </span> <span> {{ $reference->refEmail }} </span></p>
        </div>
      @endforeach
      @else
      <h3 class="h6 jobAppH6 mt-3">you hava not added any reference yet</h3>
      @endif
    </div>
</div>

@stop

@section('custom_footer_css')
<link rel="stylesheet" href="{{ asset('css/site/profile.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}">
<style>

.referees:nth-child(even) {background: #eee}

</style>

@stop

@section('custom_js')
<script src="{{ asset('js/site/jquery.modal.min.js') }}"></script>
<script src="{{ asset('js/site/jquery-ui.js') }}"></script>

<script type="text/javascript">

</script>
@stop

