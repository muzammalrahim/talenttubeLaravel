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


        {{-- <form action="http://139.59.44.29/notifyPayment" method="POST"> --}}
        <form action="http://localhost:8000/notifyPayment" method="POST">

          <input name="mc_gross"                type="hidden" value="10.00" />
          <input name="protection_eligibility"  type="hidden" value="Eligible" />
          <input name="address_status"          type="hidden" value="confirmed" />
          <input name="payer_id"                type="hidden" value="UGF4YVBG8N4PQ" />
          <input name="address_street"          type="hidden" value="1 Main St" />
          <input name="payment_date"            type="hidden" value="10:36:31 May 15  /> 2020 PDT" />
          <input name="payment_status"          type="hidden" value="Completed" />
          <input name="charset"                 type="hidden" value="windows-1252" />
          <input name="address_zip"             type="hidden" value="95131" />
          <input name="first_name"              type="hidden" value="John" />
          <input name="mc_fee"                  type="hidden" value="0.59" />
          <input name="address_country_code"    type="hidden" value="US" />
          <input name="address_name"            type="hidden" value="John Doe" />
          <input name="notify_version"          type="hidden" value="3.9" />
          <input name="custom"                  type="hidden" = null />
          <input name="payer_status"            type="hidden" value="verified" />
          <input name="business"                type="hidden" value="sb-wx2ex1797607@business.example.com" />
          <input name="address_country"         type="hidden" value="United States" />
          <input name="address_city"            type="hidden" value="San Jose" />
          <input name="quantity"                type="hidden" value="1" />
          <input name="verify_sign"             type="hidden" value="AjZ3jRPRqW-3b9561IRYSsRHKNbHAH3jwy.y7RiVhBLJOra7Fp2KxbVm" />
          <input name="payer_email"             type="hidden" value="sb-5bupj1793152@personal.example.com" />
          <input name="txn_id"                  type="hidden" value="1SW27326HK972743E" />
          <input name="payment_type"            type="hidden" value="instant" />
          <input name="last_name"               type="hidden" value="Doe" />
          <input name="address_state"           type="hidden" value="CA" />
          <input name="receiver_email"          type="hidden" value="sb-wx2ex1797607@business.example.com" />
          <input name="payment_fee"             type="hidden" value="0.59" />
          <input name="shipping_discount"       type="hidden" value="0.00" />
          <input name="insurance_amount"        type="hidden" value="0.00" />
          <input name="receiver_id"             type="hidden" value="Q9LEKG36D5GTE" />
          <input name="txn_type"                type="hidden" value="web_accept" />
          <input name="item_name"               type="hidden" value="Purchase Credit" />
          <input name="discount"                type="hidden" value="0.00" />
          <input name="mc_currency"             type="hidden" value="USD" />
          <input name="item_number"             type="hidden" value="19" />
          <input name="residence_country"       type="hidden" value="US" />
          <input name="test_ipn"                type="hidden" value="1" />
          <input name="shipping_method"         type="hidden" value="Default" />
          <input name="transaction_subject"     type="hidden" = null />
          <input name="payment_gross"           type="hidden" value="10.00" />
          <input name="ipn_track_id"            type="hidden" value="9bd3e5495a176" />

          {{-- <input name="test" type="submit" value="test" /> --}}
          <input type="submit" name="Test purchase" />
        </form>




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
