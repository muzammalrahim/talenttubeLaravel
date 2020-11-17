<div style="display:none;">


<div id="intConc_sign_in" class="popup intConc_sign_inPP">
    <div class="head"> Interview Concierge
        <a id="#intConc_sign_in_close" class="icon_close" href="">
            <span class="close_hover"></span>
        </a>

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

                <button id="intConform_login" type="submit" class="btn pink">Sign in</button>
                
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


</style>


 <script type="text/javascript">

 	

 </script>