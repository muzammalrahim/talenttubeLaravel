<div class="tab-pane fade " id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">

	<div class="slot form_field">
	   <label class="form_label">Interview Slots:</label>
	   <div class="form_input w100">
	      	<div class="slots">
	      		<div class="slot s1 notbrak leftMargin pSlot topMargin slotBorder ">

                            <div class="mb10">Interview Slot 1 <span class="fl_right"> <i class="fas fa-trash deleteSlot fl_right tk"></i></span></div>
                                <div class="time">
                                <div class="notbrak">Time</div>
                                <div class="notbrak"><input type="text" class="timepicker timepicker-without-dropdown text-center checkstatus" autocomplete="off" name="slot[1][start]" size="8" required /></div>
                                <div class="notbrak">To</div>
                                <div class="notbrak"><input type="text" class="timepicker timepicker-without-dropdown text-center checkstatus1" autocomplete="off" name="slot[1][end]" size="8" required /></div>
                                </div>
                            <div class="date topMargin">
                                <span class="notbrak">Date</span>
                                <input type="text" name="date[1]" class="datepicker notbrak checkstatusDate"  autocomplete="off" size="8" required />
							</div>																			
                              <div class="m_no_i">
                                <label class="w50 notbrak my10" style="margin-right: 5px;">Maximum number of interviewees:</label>
                                <div class="form_input form_input_C2">
                                    <select name="maximumnumber[1]" class="form_select" >
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                        <option value="16">16</option>
                                        <option value="17">17</option>
                                        <option value="18">18</option>
                                        <option value="19">19</option>
                                        <option value="20">20</option>
                                    </select>
                                </div>

                            </div>
                    </div>
            </div>
	      </div>
    </div>


	<div class="form_field">
        <span class="form_label"></span>
        <div class="form_input">
            <div class="general_error error to_hide">&nbsp;</div>
        </div>
    </div>
    
    <div class="addSlot text-center">
        <span class="btn btn-success small violet"> Add Interview slot</span>
    </div>

 {{--    <div class="fomr_btn act_field center">
        <button class="btn btn-primary small turquoise updateNewBooking ">Update</button>
    </div> --}}

    <a class="btn btn-primary btnPrevious text-white mt-3"onclick="scrollToTop()" >Previous</a>
    {{-- <a class="btn btn-primary btnNext text-white" style="float:right;"onclick="scrollToTop()">Next</a> --}}

</div>

