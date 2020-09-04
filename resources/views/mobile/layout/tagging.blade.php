<!-- Tagging System For Mobile -->
<div class="row">
	<div class="col-sm-12">
		<div class="selectedTags p-4">
			<div class="selectTagHead"><h3>Skills, Qualifications, Studies & Experience</h3></div>
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
	</div>
	
<div class="col-sm-12 mb-3">
	<div class="newTag" id="newTag">
		<p class="m-0">Add more interests here!</p>
		<div class="newTagInput relative">
			<div class="col-auto">
				<!-- Material input -->
				<div class="md-form">
						<input type="text" name="newTag" value="" class="form-control mb-2" id="inlineFormInputMD" placeholder="Add New Tag">
						<label class="sr-only" for="inlineFormInputMD">Name</label>
				</div>
				</div>
				<div class="col-auto text-center">
					<button id="addNewTag" class="btn btn-success mb-0" data-toggle="modal" data-target="#addNewTagModal">Add New</button>
			</div>
			<div class="col-auto">
				<div class="tagSuggestionCont" style="display: none;">
					<ul class="tagSuggestion">
					</ul>
				</div>
			</div>
			{{-- <input type="text" name="newTag" value="" />
			<button id="addNewTag" class="btn pink" data-toggle="modal" data-target="#addNewTagModal">Add New</button> --}}
		</div>
</div>
</div>
	<div class="col-sm-12">
		<div class="tagsList">
			<div class="d-block d-md-flex">
				<div class="tagCategories">
					<ul class="tagCategoriesList">
							@if(!empty($tagCategories))
							<label class="mdb-main-label">Select Tag Category</label>
							<select name="tagCategories" id="tagCategory" class="browser-default custom-select">
								@foreach($tagCategories as $tagCat)
								<option value="{{$tagCat->id}}">{{$tagCat->title}}</option>
							{{-- <div class="p-3 flex-1">
									<li class="tagCategory tagItem {{($tagCat->id == 1)?'selected':''}}" data-id="{{$tagCat->id}}"><i class="tagIcon {{$tagCat->icon}}"></i>{{$tagCat->title}}</li>
								</div> --}}
							@endforeach
							</select>
							@endif
					</ul>
			</div>
			</div>
			<div class="tagListCont text-center">
				<div class="tagListBox">
					<ul class="tagList">
						@if(!empty($tags))
							@foreach($tags as $tag)
									<li class="tag tagItem" data-id="{{$tag->id}}"><i class="tagIcon {{$tag->icon}}"></i>{{$tag->title}}</li>
							@endforeach
							@endif
					</ul>
				</div>
				<div class="loadingAnimation d-none">
					<div class="spinner-grow text-success" role="status">
						<span class="sr-only">Loading...</span>
				</div>
				</div>
				{{-- <a class="loadMoreTags">More interests  <i class="tagIcon fa fa-redo"></i></a> --}}
			</div>
		
		</div>
	</div>


<!-- Add New Tag Popup -->
<div class="modal fade addNewTagModal" id="addNewTagModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
		aria-hidden="true">
		<div class="modal-dialog modal-notify modal-info" role="document">
				<!--Content-->
				<div class="modal-content">
						<!--Header-->
						<div class="modal-header text-center">
							<h4 class="modal-title w-100 font-weight-bold text-white">Add New Tag?</h4>

								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true" class="white-text">&times;</span>
								</button>
						</div>

						<!--Body-->
						<div class="modal-body mx-3">
							<div class="newTagFormLoading" style="display: none;">
								<div class="spinner-grow text-success" role="status">
									<span class="sr-only">Loading...</span>
							</div>
						</div>
							<div class="apiMessage" style="display: none;"></div>
							<div class="newTagForm">
								<div class="new_tag_title form_field md-form">
										<span class="form_label h5">Title :</span>
										<div class="form_input">
											<input type="text" value="" name="newTagtitle" class="form-control">
											<div id="newTagtitle_error" class="error field_error to_hide">&nbsp;</div>
										</div>
								</div>

								<div class="new_tag_category form_field">
										<span class="form_label h5 d-block pb-2">Category :</span>
										<div class="form_input">
												<select name="newTagCategory" class="browser-default custom-select form-control">
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
						</div>

						<!--Footer-->
						<div class="modal-footer justify-content-center">
							<button class="newTagClose btn-primary btn small dgrey"><a class="text-white" data-dismiss="modal" href="#close-modal" rel="modal:close">Cancel</a></button>
		     <button class="newTagAdd btn marsh btn-outline-primary waves-effect">OK</button>
								{{-- <a type="button" class="btn btn-primary">Get it now <i class="far fa-gem ml-1 text-white"></i></a>
								<a type="button" class="btn btn-outline-primary waves-effect" data-dismiss="modal">No, thanks</a> --}}
						</div>
				</div>
				<!--/.Content-->
		</div>
</div>
<!-- Central Modal Medium Info-->
</div>
