<!-- Tagging system -->
<div class="tagging_cont p10">
	<div class="selectedTags p10">
		<div class="selectTagHead"><h3>Skills, Qualifications, Studies & Experience</h3></div>
		<div class="selectTagList">
			<ul></ul>
		</div>
	</div>

	<div class="newTag" id="newTag">
			<p class="m0">Add more interests here!</p>
			<div class="newTagInput relative">
				<input type="text" name="newTag" value="" />
				<button id="addNewTag" class="btn pink">Add New</button>
				<div class="tagSuggestionCont" style="display: none;">
					<ul class="tagSuggestion">
					</ul>
				</div>
			</div>
	</div>

	<div class="tagsList">

		<div class="tagCategories">
				<ul class="tagCategoriesList">
					 @if(!empty($tagCategories))
					 @foreach($tagCategories as $tagCat)
					 		<li class="tagCategory tagItem {{($tagCat->id == 1)?'selected':''}}" data-id="{{$tagCat->id}}"><i class="tagIcon {{$tagCat->icon}}"></i>{{$tagCat->title}}</li>
					 @endforeach
					 @endif
				</ul>
		</div>

		<div class="tagListCont">
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



	<div class="newTagPopup" style="display:none;">
		<div id="addNewTagModal" class="modal p0 addNewTagModal wauto">
		    <div class="addNewTagModalBox relative">
		        <div class="cont">
		            <div class="title p10">Add New Tag?</div>
		            {{-- <div class="img_chat">
		                <div class="icon">
		                    <img src="{{asset('/images/site/icons/icon_pp_sure.png')}}" height="48" alt="">
		                </div>
		                <div class="msg">This action can not be undone. Are you sure you wish to continue?</div>
		            </div> --}}
		            <div class="newTagFormLoading" style="display: none;">
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

			  			 <div class="apiMessage center" style="display: none;"></div>

		            <div class="newTagForm">	
		            	<div class="new_tag_title form_field">
		            			<span class="form_label">Title :</span>
		            			<div class="form_input">
		            				<input type="text" value="" name="newTagtitle" class="w100">
		            				<div id="newTagtitle_error" class="error field_error to_hide">&nbsp;</div>
		            			</div>
		            	</div>

		            	<div class="new_tag_category form_field">
		            			<span class="form_label">Category :</span>
		            			<div class="form_input">
		            				 <select name="newTagCategory" class="">
		            				 	@if(!empty($tagCategories))
														 @foreach($tagCategories as $tagCat)
														 		<option value="{{$tagCat->id}}"><i class="tagIcon {{$tagCat->icon}}"></i>{{$tagCat->title}}</option>
														 @endforeach
													@endif
		            				 </select>
		            				<div id="newTagCategory_error" class="error field_error to_hide">&nbsp;</div>
		            			</div>
		            	</div>


		            {{-- 	<div class="new_tag_icon form_field">
		            			<span class="form_label">Icon :</span>
		            			<div class="form_input">
		            				 <select name="newTagIcon" class="">
		            				 	@php 
		            				 		$fa_list = getFontAwesomeIconList();
		            				 	@endphp
		            				 	@if(!empty($fa_list))
														 @foreach($fa_list as $fv)
														 		<option value="{{$fv['icon']}}">{{$fv['name']}}</option>
														 @endforeach
													@endif
		            				 </select>
		            				<div id="newTagIcon_error" class="error field_error to_hide">&nbsp;</div>
		            			</div>
		            	</div> --}}
		            	
		            </div>

		            <div class="double_btn center">
		                <button class="newTagClose btn small dgrey"><a class="color_white" href="#close-modal" rel="modal:close">Cancel</a></button>
		                <button class="newTagAdd btn small marsh">OK</button>
		                <div class="cl"></div>
		            </div>
		        </div>
		    </div>
		</div>
	</div>


</div>



 