<div class="bl_frm">
   <form id="frm_profile_edit_personal" name="frm_profile_edit_field_personal" class="form_redError" method="POST">
      {{ csrf_field() }}
      <input class="ajax" type="hidden" name="ajax" value="1">
      <table class="tb_frm frm_edit_personal">
         <tbody>
            <tr>
               <th>
                  <div class="name">Sexuality</div>
               </th>
               <td>
                  <div class="field">
                     <div id="pp_4_sexuality-styler" class="  select_main">
                        <select data-placeholder="" id="gender" name="gender" class="select_main">
                           <option selected="" value="0">Please Choose</option>
                           <option value="male" {{($user->gender == 'male')?'selected="selected"':''}}>Male</option>
                           <option value="female" {{($user->gender == 'female')?'selected="selected"':''}}>Female</option>
                        </select>
                        <div id="gender_error" class="error to_hide">&nbsp;</div>
                     </div>
                  </div>
               </td>
            </tr>
            <tr>
               <th>
                  <div class="name">Eye color</div>
               </th>
               <td>
                  <div class="field">
                     <div id="pp_4_eye-styler" class="select_main">
                        <select data-placeholder="" id="pp_4_eye" name="eye" class="select_main">
                           <option value="0">Please Choose</option>
                           <option value="black" {{($user->eye == 'black')?'selected="selected"':''}} >Black</option>
                           <option value="blue" {{($user->eye == 'blue')?'selected="selected"':''}} >Blue</option>
                           <option value="brown" {{($user->eye == 'brown')?'selected="selected"':''}} >Brown</option>
                           <option value="green" {{($user->eye == 'green')?'selected="selected"':''}} >Green</option>
                           <option value="gray" {{($user->eye == 'gray')?'selected="selected"':''}} >Gray</option>
                           <option value="hazel" {{($user->eye == 'hazel')?'selected="selected"':''}} >Hazel</option>
                           <option value="contacts" {{($user->eye == 'contacts')?'selected="selected"':''}} >Colored Contacts</option>
                        </select>
                        <div id="eye_error" class="error to_hide">&nbsp;</div>
                     </div>
                  </div>
               </td>
            </tr>
            <tr>
               <th>
                  <div class="name">Kids</div>
               </th>
               <td>
                  <div class="field">
                     <div id="pp_4_family-styler" class="  select_main" >
                        <select data-placeholder="" id="pp_4_family" name="family" class="select_main" >
                        @foreach ($familyType as $fkey => $family)
                        <option value="{{$fkey}}" {{($user->family == $fkey)?'selected="selected"':''}} >{{$family}}</option>
                        @endforeach
                        </select>
                        <div id="family_error" class="error to_hide">&nbsp;</div>
                     </div>
                  </div>
               </td>
            </tr>
            <tr>
               <th>
                  <div class="name">Education</div>
               </th>
               <td>
                  <div class="field">
                     <div id="pp_4_education-styler" class="select_main" >
                        <select data-placeholder="" id="pp_4_education" name="education" class="select_main" >
                        @foreach ($educationDropdown as $key => $education )
                        <option value="{{$key}}" {{($user->education == $fkey)?'selected="selected"':''}} >{{$education}}</option>
                        @endforeach
                        </select>
                        <div id="education_error" class="error to_hide">&nbsp;</div>
                     </div>
                  </div>
               </td>
            </tr>
            <tr>
               <th class="field_checkbox">
                  <div class="name">Language</div>
               </th>
               <td>
                  <div class="field field_checkbox">
                     <div id="pp_4_language_0-styler" data-checkbox="language" class="user_languages select_main" >
                        <select data-placeholder="" id="pp_4_language_0" data-checkbox="language" name="language[]" class="select_main" >
                        @if (count($languages) > 0 )
                        @foreach ($languages as $lkey => $lang )
                        <option value="{{$lkey}}" {{  (isset($user->language) &&(in_array($fkey,$user->language))  )?'selected="selected"':''}} >{{$lang}}</option>
                        @endforeach
                        @endif
                        </select>
                     </div>
                     <div id="link_add_language" data-type-add="language" class="field link_add" style="display:block;">
                        <div class="add_field"><span>+ Add</span></div>
                     </div>
                  </div>
               </td>
            </tr>
            <tr>
               <th class="field_checkbox">
                  <div class="name">Hobbies</div>
               </th>
               <td>
                  <div class="field field_checkbox">
                     <div id="pp_4_hobbies_0-styler" data-checkbox="hobbies" class="user_hobbies select_main" >
                        <select data-placeholder="" id="pp_4_hobbies_0" data-checkbox="hobbies" name="hobbies[]" class="select_main" >
                        @foreach ($hobbies as $hkey => $hobby )
                        <option value="{{$hkey}}" {{ (isset($user->hobbies) &&  (in_array($hkey,$user->hobbies)) )?'selected="selected"':''}}>{{$hobby}}</option>
                        @endforeach
                        </select>
                     </div>
                     <div id="link_add_hobbies" data-type-add="hobbies" class="field link_add" style="display:block;">
                        <div class="add_field"><span>+ Add</span></div>
                     </div>
                  </div>
               </td>
            </tr>
         </tbody>
      </table>
      <div class="fl_right bl_btn to_show" style="transition-delay: 0.1s;">
         <button class="btn small white_frame frm_editor_cancel">Cancel</button>
         <button class="btn small turquoise frm_editor_save">Save</button>
      </div>
      <div class="btn small ppform_save_loader hide_it">
         <div class="spinner center">
            <div class="spinner-blade"></div>
            <div class="spinner-blade"></div>
            <div class="spinner-blade"></div>
            <div class="spinner-blade"></div>
            <div class="spinner-blade"></div>
            <div class="spinner-blade"></div>
            <div class="spinner-blade"></div>
            <div class="spinner-blade"></div>
            <div class="spinner-blade"></div>
            <div class="spinner-blade"></div>
            <div class="spinner-blade"></div>
            <div class="spinner-blade"></div>
         </div>
      </div>
   </form>
   <script>
      $('.select_main', '#frm_profile_edit_personal').styler({
          singleSelectzIndex: '11',
          selectAutoWidth: false,
          selectAppearsNativeToIOS: false,
          selectAnimation: true,
          onSelectOpened: function() {
              lastValueCheckboxPersonal = $(this).find('select').val();
          }
      });
      
      $('#link_add_language').click(function(){
          console.log(' link_add_language click ');
          var elem = $('#frm_profile_edit_personal select[name="language[]"]').first().clone(false);
          console.log(' elem ', elem );
          console.log(' elem class ', elem.attr('class') );
      
          var count_lang  =  parseInt($('#frm_profile_edit_personal select[name="language[]"]').length) + 1;
          elem.prop("selected", false);
          elem.attr('id','pp_4_language_'+count_lang);
      
          $('#frm_profile_edit_personal .user_languages').append(elem);
      
          setTimeout(function() {
              elem.styler({
                  singleSelectzIndex: '11',
                  selectAutoWidth: false,
                  selectAppearsNativeToIOS: false,
                  selectAnimation: true,
                  onSelectOpened: function() {
                      lastValueCheckboxPersonal = $(this).find('select').val();
                  }
              })
          }, 1);
      });
      
      
      $('#link_add_hobbies').click(function(){
          console.log(' link_add_language click ');
          var elem = $('#frm_profile_edit_personal select[name="hobbies[]"]').first().clone(false);
          console.log(' elem ', elem );
          console.log(' elem class ', elem.attr('class') );
      
          var count_lang  =  parseInt($('#frm_profile_edit_personal select[name="hobbies[]"]').length) + 1;
          elem.prop("selected", false);
          elem.attr('id','pp_4_language_'+count_lang);
      
          $('#frm_profile_edit_personal .user_hobbies').append(elem);
      
          setTimeout(function() {
              elem.styler({
                  singleSelectzIndex: '11',
                  selectAutoWidth: false,
                  selectAppearsNativeToIOS: false,
                  selectAnimation: true,
                  onSelectOpened: function() {
                      lastValueCheckboxPersonal = $(this).find('select').val();
                  }
              })
          }, 1);
      });
   </script>
</div>