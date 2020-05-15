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


        {{-- <form action="http://139.59.44.29/notifyPayment" method="POST">
            <input name="mc_gross" type="hidden" value="500.00" />
            <input name="custom" type="hidden" value="some custom data" />
            <input name="address_status" type="hidden" value="confirmed" />
            <input name="item_number1" type="hidden" value="6" />
            <input name="item_number2" type="hidden" value="4" />
            <input name="payer_id" type="hidden" value="FW5W7ZUC3T4KL" />
            <input name="tax" type="hidden" value="0.00" />
            <input name="address_street" type="hidden" value="1234 Rock Road" />
            <input name="payment_date" type="hidden" value="14:55 15 Jan 07 2005 PST" />
            <input name="payment_status" type="hidden" value="Completed" />
            <input name="address_zip" type="hidden" value="12345" />
            <input name="mc_shipping" type="hidden" value="0.00" />
            <input name="mc_handling" type="hidden" value="0.00" />
            <input name="first_name" type="hidden" value="Jason" />
            <input name="last_name" type="hidden" value="Anderson" />
            <input name="mc_fee" type="hidden" value="0.02" />
            <input name="address_name" type="hidden" value="Jason Anderson" />
            <input name="notify_version" type="hidden" value="1.6" />
            <input name="payer_status" type="hidden" value="verified" />
            <input name="business" type="hidden" value="paypal@emailaddress.com" />
            <input name="address_country" type="hidden" value="United States" />
            <input name="num_cart_items" type="hidden" value="2" />
            <input name="mc_handling1" type="hidden" value="0.00" />
            <input name="mc_handling2" type="hidden" value="0.00" />
            <input name="address_city" type="hidden" value="Los Angeles" />
            <input name="verify_sign" type="hidden" value="AlUbUcinRR5pIo2KwP4xjo9OxxHMAi6.s6AES.4Z6C65yv1Ob2eNqrHm" />
            <input name="mc_shipping1" type="hidden" value="0.00" />
            <input name="mc_shipping2" type="hidden" value="0.00" />
            <input name="tax1" type="hidden" value="0.00" />
            <input name="tax2" type="hidden" value="0.00" />
            <input name="txn_id" type="hidden" value="TESTER" />
            <input name="payment_type" type="hidden" value="instant" />
            <input name="last_name=Borduin" type="hidden" />
            <input name="payer_email" type="hidden" value="test@domain.com" />
            <input name="item_name1" type="hidden" value="Rubber+clog" />
            <input name="address_state" type="hidden" value="CA" />
            <input name="payment_fee" type="hidden" value="0.02" />
            <input name="item_name2" type="hidden" value="Roman sandal" />
            <input name="invoice" type="hidden" value="123456" />
            <input name="quantity" type="hidden" value="1" />
            <input name="quantity1" type="hidden" value="1" />
            <input name="receiver_id" type="hidden" value="5HRS8SCK9NSJ2" />
            <input name="quantity2" type="hidden" value="1" />
            <input name="txn_type" type="hidden" value="web_accept" />
            <input name="mc_gross_1" type="hidden" value="0.01" />
            <input name="mc_currency" type="hidden" value="USD" />
            <input name="mc_gross_2" type="hidden" value="0.01" />
            <input name="payment_gross" type="hidden" value="0.02" />
            <input name="subscr_id" type="hidden" value="PP-1234" />
            <input name="test" type="submit" value="test" />
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
                {{-- <input type="hidden" name="notify_url" value="http://139.59.44.29/notifyPayment"> --}}
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
