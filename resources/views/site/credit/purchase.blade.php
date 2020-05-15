{{-- @extends('site.user.usertemplate') --}}
@extends('site.employer.employermaster')

@section('custom_css')
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
@stop

@section('content')
<div class="newJobCont">
    <div class="head icon_head_browse_matches">Purchase Credits</div>

    <div class="cont cont_boost_plan" style="display: block;">

        <div class="row credit_wallet">
            <img src="http://182.180.54.194/talenttube/_frameworks/main/impact/images/features_refill_b.png" alt="">
            <div class="cl"></div>
            <span class="txt">Refill your credits now to uses a lot of wonderful features!</span>
        </div>

        {{-- <div class="credit_select_bx">

            <input type="radio" value="1" name="creditAmount" class="radioClick"> 100 credits for $1.00<br>
            <input type="radio" value="5" name="creditAmount" class="radioClick"> 550 credits for $5.00<br>
            <input type="radio" value="10" name="creditAmount" class="radioClick"> 1250 credits for $10.00<br>
            <input type="radio" value="20" name="creditAmount" class="radioClick"> 2750 credits for $20.00<br>

        </div> --}}


        {{-- <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" name="frmTransaction" id="frmTransaction">
            <input type="hidden" name="business" value="sb-wx2ex1797607@business.example.com">
            <input type="hidden" name="cmd" value="_xclick">
             <input type="hidden" name="item_name" value="Purchase Credit">
            <input type="hidden" name="item_number" value="{{$user->id}}">

            <input type="hidden" name="currency_code" value="USD">
            <input type="hidden" name="cancel_return" value="{{route('paymentCancel')}}">
            <input type="hidden" name="return" value="{{route('paymentStatus')}}">

            <input type="radio" value="1" name="amount" class="radioClick"> 100 credits for $1.00<br>
            <input type="radio" value="5" name="amount" class="radioClick"> 550 credits for $5.00<br>
            <input type="radio" value="10" name="amount" class="radioClick"> 1250 credits for $10.00<br>
            <input type="radio" value="20" name="amount" class="radioClick"> 2750 credits for $20.00<br>


            <input type="submit" name="Purchase" />
        </form> --}}



        <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" >
                <input type="hidden" name="business" value="sb-wx2ex1797607@business.example.com">
                <input type="hidden" name="cmd" value="_xclick">
                <input type="hidden" name="item_name" value="Purchase Credit">
                <input type="hidden" name="item_number" value="{{$user->id}}">

                <input type="radio" value="1" name="amount" class="radioClick"> 100 credits for $1.00<br>
                <input type="radio" value="5" name="amount" class="radioClick"> 550 credits for $5.00<br>
                <input type="radio" value="10" name="amount" class="radioClick"> 1250 credits for $10.00<br>
                <input type="radio" value="20" name="amount" class="radioClick"> 2750 credits for $20.00<br>

                {{-- <input type="hidden" name="no_shipping" value="1"> --}}
                <input type="hidden" name="currency_code" value="USD">
                <input type="hidden" name="notify_url" value="{{route('notifyPayment')}}">
                <input type="hidden" name="cancel_return" value="{{route('paymentCancel')}}">
                <input type="hidden" name="return" value="{{route('paymentReturn')}}">


                <input type="submit" name="Purchase" />
        </form>



        <div class="cl"></div>
    </div>



    <div class="cl"></div>
</div>

@stop

@section('custom_footer_css')
<link rel="stylesheet" href="{{ asset('css/site/profile.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}">

@stop

@section('custom_js')
<script src="{{ asset('js/site/jquery.modal.min.js') }}"></script>
<script src="{{ asset('js/site/jquery-ui.js') }}"></script>
<script src="{{ asset('js/site/common.js') }}"></script>

<script type="text/javascript">
$(document).ready(function() {
    $('.radioClick').on('click', function(){
        console.log(' radioClick ', this );
    });

});

onclick = function(elem){

}


</script>
@stop
