<div style="display:none;">


<div id="deleteSlotModal" class="popup intConc_sign_inPP">
    <div class="head"> Delete Slot

        <span class="close_hover"> </span>

    </div>
    <div class="cont">
        <div class="bl">

            {{-- <form id="intCon_login" class="intCon_login" method="post" autocomplete="on" action=""> --}}
                
                {{-- @csrf --}}
                <p> All the interview bookings with this slot will be deleted.<br> Are you sure you wish to continue? </p> 

                <input type="text" name="" class="slotIDPopUp">

              <div class="center deleteSlotDiv">  <button id="deleteSlot_confirm" type="submit" class="btn pink">Yes</button>
              </div>
            {{-- </form> --}}
            
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
    margin-bottom: 20px;
    font-weight: 600;
}
.popup {
    min-height: 160px;
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

#deleteSlotModal{
  background: white;
  padding: 20px;
}

.interviewConcierge {
    background: #254c8e;
}
.deleteSlotDiv{
    margin-top: 20px;
}
</style>

 <script type="text/javascript">
  



</script>