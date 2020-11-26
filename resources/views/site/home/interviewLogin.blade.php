<div style="display:none;">


<div id="intConc_sign_in" class="popup intConc_sign_inPP">
    <div class="head"> Interview Concierge

        <span class="close_hover"> </span>

    </div>
    <div class="cont">
        <div class="bl">

            <form id="intCon_login" class="intCon_login" method="post" autocomplete="on" action="">
                
                @csrf

                <input id="intConform_mobile"  type="text" name="mobile" class="inp placeholder" placeholder="Mobile" />

                    <p class="errorInMobile p-0 m-0 text-danger hide errorPtag"> </p> 

                <input id="intConform_email"  type="email" name="email" class="inp placeholder" placeholder="Email" />

                    <p class="errorInEmail p-0 m-0 text-danger hide errorPtag"> </p>  
                
                
                <div class="bl_remember">

                    <p class="errorInBooking p-0 m-0 text-danger hide errorPtag"> </p>  
                    
                </div>

                <button id="intConform_login" type="submit" class="btn pink intConSigninButton">Sign in</button>
                
            </form>
            
        </div>
    </div>
</div>


</div>


<style type="text/css">

.errorPtag {
    color: red;
    margin: 7px;
    font-size: 13px;
}
.popup .head{
    font-size: 20px;
}
.popup {
    min-height: 290px;
}

.close_hover{
    position: absolute;
    background-image: url(/images/site/icon_close.png);
    width: 24px;
    height: 24px;
    background-repeat: no-repeat;
    display: block;
    top: 15px;
    right: 3px;
    cursor: pointer;
}
</style>


 <script type="text/javascript">


 </script>