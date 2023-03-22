<div class="modal fade" id="myModal" role="dialog">
   <div class="modal-dialog delete-applications">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header py-4 px-2">
            <i data-dismiss="modal" class="close-box fa fa-times"></i>                      
            <h5 class="modal-title text-start text-white">Send Online Test</h5>
         </div>
         <div class="modal-body">
            <div class="testContent p10">
                 
               <form name="sendTestForm" class="sendTestForm">
                  @csrf
                  <input type="hidden" name="jobApp_id" class="jobAppIdModal">
                  <div class="job_age form_field" style="height:120px;">
                     <span class="w20 dinline_block">Select Test</span>
                     <div class="w70 dinline_block">
                        <select name="test_id" class="form-control icon_show">
                           @foreach ($onlineTest as $test)
                           <option value="{{$test->id}}"> {{$test->name}} </option>
                           @endforeach
                        </select>
                     </div>
                  </div>
               </form>
              
               <p class="errorsInFields text-danger"></p>
               <div class="fomr_btn act_field center">
                  <button class="btn small turquoise orange_btn" onclick="sendOnlineTestNotification()">Send Test</button>
               </div>
            </div>
         </div>
         <div class="dual-footer-btn">
            {{-- <button type="button" class="btn btn-default black_btn" data-dismiss="modal"><i class="fa fa-times"></i>Cancel</button> --}}
            {{-- <button type="button" class="orange_btn"><i class="fa fa-check"></i>OK</button> --}}
         </div>
      </div>
   </div>
</div>