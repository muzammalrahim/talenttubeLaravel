@extends('mobile.user.usermaster')
@section('content')



<h6 class="h6 jobAppH6">Employers</h6>
    <!-- ===================================================== Employer Filter ===================================================== -->

@include('mobile.user.employersFilter')
@include('mobile.spinner')
<!-- ===================================================== Employer List ===================================================== -->


<div class="employersList">
	@include('mobile.user.employersList')		{{-- mobile/user/employersList --}}
</div>


@stop


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('js/mobile/likeUnlikeBlockUnblockEmp.js') }}"></script>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?libraries=places&key={{env('GOOGLE_API')}}"></script>

@section('custom_js')

<script type="text/javascript">

	$(document).ready(function(){

		$('#employer_filter_form').on('submit',function(event){
			console.log(' filter_form submit ');
			event.preventDefault();
			$('#paginate').val('');
			getData();
	});

	// function to send ajax call for getting data throug filter/Pagination selection.
	var getData = function(){
		var url = '{{route('Memployers')}}';
		$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
		$.post(url, $('#employer_filter_form').serialize(), function(data){
						$('.employersList').html(data);
		});
	}

	getData();
// Bottom pagination load data throug ajax.
	$(document).on('click','.employeer_pagination .page-item .page-link',function(e){
	    console.log(' page-link click ', $(this) );
	    e.preventDefault();
	    var page = $(this).attr('href').split('page=')[1];
	    $('#paginate').val(page);
	    getData();
	});

});

	$(".reset-btn").click(function(){
	$("#employer_filter_form").trigger("reset");
	$("#filter").html("Filters" +"<i class='fas fa-angle-down rotate-icon'></i>");
	getDataCustom();
});

	var getDataCustom = function(){
		var url = '{{route('Memployers')}}';
		$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
		$.post(url, $('#employer_filter_form').serialize(), function(data){
						$('.employersList').html(data);
		});
	}

</script>
@stop

