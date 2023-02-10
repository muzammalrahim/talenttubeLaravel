<!-- Tagging system -->
<div class="tagging_cont p10">
   <div class="selectedTags p10">
      <div class="selectTagHead">
         <h3>Skills, Qualifications, Studies & Experience</h3>
      </div>
      <div class="selectTagList">
         <ul>
            @if (isset($userTags))
            @foreach($userTags as $uTags)
            <li class="tag tagItem" data-id="{{$uTags->id}}"><i class="tagIcon fab fa-accusoft"></i>{{$uTags->title}}</li>
            @endforeach
            @endif
         </ul>
      </div>
   </div>
   <div class="newTag" id="newTag">
      <p class="">Add more interests here!</p>
      <div class="newTagInput relative">
         
        <div class="row m-0 p-0">
        	<div class="col-sm-9 col-8 p-0">
         		<input type="text" class="form-control" name="newTag" value="" />
        	</div>

        	<div class="col-sm-3 col-4 mt-0 mt-md-0">	
         		<button id="addNewTag" class="orange_btn" data-toggle = "modal" data-target = "#addNewTagModal" style="height:none !important">Add New</button>
        	</div> 		
        </div>



         <div class="tagSuggestionCont" style="display: none;">
            <ul class="tagSuggestion">
            </ul>
         </div>
      </div>
   </div>
   <div class="tagsList row">
      <div class="tagCategories col-12 col-md-5">
         <ul class="tagCategoriesList">
            @if(!empty($tagCategories))
            @foreach($tagCategories as $tagCat)
            <li class="tagCategory tagItem {{($tagCat->id == 1)?'selected':''}}" data-id="{{$tagCat->id}}"><i class="tagIcon {{$tagCat->icon}}"></i>{{$tagCat->title}}</li>
            @endforeach
            @endif
         </ul>
      </div>
      <div class="tagListCont col-12 col-md-7">
         <div class="tagListBox">
            <ul class="tagList">
               @if(!empty($tags))
               @foreach($tags as $tag)
               <li class="tag tagItem" data-id="{{$tag->id}}"><i class="tagIcon {{$tag->icon}}"></i>{{$tag->title}}</li>
               @endforeach
               @endif
            </ul>
         </div>
         <div class="loadingAnimation">
            <div class="spinner center spinnerw">
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
         {{-- <a class="loadMoreTags">More interests  <i class="tagIcon fa fa-redo"></i></a> --}}
      </div>
   </div>

</div>


<div class="bj-modal">
   <div class="modal fade addNewTagModal" id="addNewTagModal" tabindex="-1" role="dialog"
      aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog filter-industry-modal" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <div class="m-header">
                  <h4 class="modal-title" id="myModalLabel">
                     <img src="{{ asset('assests/images/filter.png') }}" alt="img" class="">
                     Add New Tag
                  </h4>
                  <i data-dismiss="modal" aria-label="Close" class="close-box fa fa-times"></i>
               </div>
            </div>
            <div class="modal-body">

              	<div class="newTagForm">
                  <div class="new_tag_title form_field">
                     <span class="form_label">Title :</span>
                     <div class="form_input">
                        <input type="text" value="" name="newTagtitle" class="w100 form-control">
                        <div id="newTagtitle_error" class="error field_error to_hide">&nbsp;</div>
                     </div>
                  </div>
                  <div class="new_tag_category form_field">
                     <span class="form_label">Category :</span>
                     <div class="form_input">
                        <select name="newTagCategory" class="something custom-select">
                           @if(!empty($tagCategories))
                           @foreach($tagCategories as $tagCat)
                           <option value="{{$tagCat->id}}"><i class="tagIcon {{$tagCat->icon}}"></i>{{$tagCat->title}}</option>
                           @endforeach
                           @endif
                        </select>
                        <div id="newTagCategory_error" class="error field_error to_hide">&nbsp;</div>
                     </div>
                  </div>
               </div>
               <div class="modal-footer">
                  <button class="newTagClose orange_btn" data-dismiss="modal"> Cancel </button>
                  <button class="newTagAdd btn-primary bs-btn" data-dismiss="modal"><span class="fb-text"> Add </span></button>

                  <div class="cl"></div>
               </div>


            </div>
            
         </div>
      </div>
   </div>
</div>