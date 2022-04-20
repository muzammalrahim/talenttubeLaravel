   {{-- <h2>Refrance</h2> --}}

      <form method="POST" name="crossReference" class="crossReference">
          @csrf
         <div class="row mb-4">
            <div class="col-md-4 col-sm-12">
               <label>Referee’s Name:</label>
            </div>
            <div class="col-md-8 col-sm-12">
               <input type="text" class="form-control" name="name" placeholder="Enter name" required>
            </div>
         </div>

         <div class="row mb-4">
            <div class="col-md-4 col-sm-12">
               <label>Referee’s Mobile:</label>
            </div>
            <div class="col-md-8 col-sm-12">
               <input type="number" class="form-control" name="mobile" placeholder="Enter your mobile number" required>
            </div>
         </div>

         <div class="row mb-4">
            <div class="col-md-4 col-sm-12">
               <label>Referee’s Email:</label>
            </div>
            <div class="col-md-8 col-sm-12">
               <input type="email" class="form-control" name="email" placeholder="Enter Email" required>
            </div>
         </div>

         

         <div class="row mb-4">
            <div class="col-md-4 col-sm-12">
               <label>Reference Type:</label>
            </div>
            <div class="col-md-8 col-sm-12 select-refeance">
               <i class="fa fa-caret-down select-caret"></i>

               <select class="form-control selectReference" name="refType">
                   <option>Work Reference</option>
                   <option>Personal  Reference</option>
                   <option>Educational  Reference</option>
               </select>

            </div>
         </div>
         <div class="row">
            <div class="col-md-4 col-sm-12">
               <label>Employer Notification:</label>
            </div>
            <div class="col-md-8 col-sm-12 select-refeance">
               <i class="fa fa-caret-down select-caret"></i>

               <select name="employerNotification" class="form-control">
                  <option value="0"> Select Employer</option>
                  @foreach ($employer as $employ)
                     <option value=" {{$employ->id}}">{{$employ->company}}</option>
                  @endforeach
               </select>

            </div>
         </div>

         <p class="errorsInFields text-danger">  </p>


         <input type="hidden" name="username" value="{{$user->name}}">
         <input type="hidden" name="userId" value="{{$user->id}}">

         <div class="row">

            <div class="col-md-12" clearfix>
               <button type="submit" class="orange_btn float-right mt-4" onclick="sendReferrenceNotification()"><i class="fas fa-mail-bulk"></i> Send Email</button>
            </div>
         </div>
      </form>

