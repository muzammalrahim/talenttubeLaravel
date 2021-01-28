
     

    // tagging system Script
    jQuery('.tagCategory.tagItem').on('click',function(){
        console.log(' tagCategory tagItem click '); 
        jQuery('.tagCategory.tagItem').removeClass('selected');
        jQuery(this).addClass('selected'); 

        jQuery('.tagListCont .tagListBox').html('');
        jQuery('.tagListCont').addClass('loadingList');


        var tagCatId = jQuery(this).attr('data-id');
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            url: base_url+'/ajax/getTags/'+tagCatId,
            type : 'GET',
            success : function(resp) {
               console.log('getTags ', resp);
               jQuery('.tagListCont').removeClass('loadingList');
               if(resp.status){   
                    jQuery('.tagListCont .tagListBox').html(resp.data);
               }
            }
        });

    });


     jQuery('.tagListBox').on('click','li a.loadMoreTags', function(){
        console.log(' loadMoreTags click '); 
        jQuery('.tagListCont .tagListBox').html('');
        jQuery('.tagListCont').addClass('loadingList');
        var offset = jQuery(this).attr('data-offset');
        var tagCatId = jQuery('.tagCategory.tagItem.selected').attr('data-id');
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            url: base_url+'/ajax/getTags/'+tagCatId+'/'+offset,
            type : 'GET',
            success : function(resp) {
               console.log('getTags ', resp);
               jQuery('.tagListCont').removeClass('loadingList');
               if(resp.status){   
                    jQuery('.tagListCont .tagListBox').html(resp.data);
               }
            }
        });
    });



    
    jQuery('html').click(function(e) {
      //if clicked element is not your element and parents aren't your div
      if (e.target.id != 'newTag' && $(e.target).parents('#newTag').length == 0) {
         jQuery('.tagSuggestionCont').hide(); 
      }else{
         console.log(' 2 focusin out '); 
         jQuery('.tagSuggestionCont').show();
      }
    });

    // jQuery('.newTag').focusin(function(){
    //     console.log(' focusin out '); 
    //     jQuery('.tagSuggestionCont').show();
    // });

    jQuery('.newTag input').on('keyup',function() {
				
        var query =  jQuery.trim(jQuery(this).val()); 
        console.log(' newTag keyup ', query);
        if ( query == '' ){
           jQuery('.tagSuggestionCont').hide();
           jQuery('ul.tagSuggestion').html('');
        }
        var userSelectedTagsList = jQuery('.selectTagList ul li').map(function(){  return $(this).attr('data-id') }).get(); 
        jQuery.ajax({
            url: base_url+"/ajax/searchTags",
            type:"GET", 
            data:{'search':query, 'exclude': userSelectedTagsList},
            success:function (resp) {
                console.log(' resp ', resp);   
                //$('#country_list').html(data);
                if(resp.status){
                    console.log(' resp data ', resp.data);
                    if(resp.data.length > 0){
                        jQuery('.tagSuggestionCont').show();
                        var suggestionArray = resp.data;
                        var suggestion = ''; 
                        jQuery.each( suggestionArray, function( index, value ){
                            suggestion += '<li class="suggestTagItem tagItem" data-id="'+value.id+'"><i class="tagIcon fa fa-box-open"></i><span>'+value.title+'</span></li>';
                        });
                        jQuery('ul.tagSuggestion').html(suggestion);
                    }
                }
            }
        })
        // end of ajax call
    });

    jQuery('.tagSuggestionCont').on('click','.suggestTagItem', function(){
        addNewTag(this);
    });


    jQuery('.tagListBox').on('click','.tag.tagItem', function(){
        addNewTag(this);
        // jQuery(this).remove();
    });

    var addNewTag = function(elem){
        var tagId = jQuery(elem).attr('data-id');
        console.log('suggestTagItem click ', tagId); 
        // if (userSelectedTagsList.indexOf(tagId) == -1){
        //      userSelectedTagsList.push(tagId);
        //      var tag_clone = elem;
        //      console.log(' tag_clone ', tag_clone);
        //     jQuery('.selectTagList ul').append(tag_clone);
        // }
        // console.log(' userSelectedTagsList ', userSelectedTagsList);
        // if (userSelectedTagsList.length > 0 ){
        //     jQuery('#user_step7_done').prop('disabled',false);
        // }else{
        //    jQuery('#user_step7_done').prop('disabled',true);
        // }

        // check if tag already selected. 
        // jQuery('')
        var userSelectedTagsList = jQuery('.selectTagList ul li').map(function(){  return $(this).attr('data-id') }).get(); 
        if (userSelectedTagsList.indexOf(tagId) == -1){
             var tag_clone = elem;
             console.log(' tag_clone ', tag_clone);
            jQuery('.selectTagList ul').append(tag_clone);
            saveUserTags();
        }
    } 


    jQuery('.selectTagList').on('click','li.tagItem', function(){
        console.log(' selectTagList click '); 
        var userSelectedTagsList = jQuery('.selectTagList ul li').map(function(){  return $(this).attr('data-id') }).get();
        var tagId = jQuery(this).attr('data-id');
         if ( userSelectedTagsList.indexOf(tagId) != -1 ){
              jQuery(this).remove();
              saveUserTags();
         }
    });

   

    jQuery('button#addNewTag').on('click',function(){
        console.log(' button#addNewTag '); 
        var newTagTitle = jQuery.trim(jQuery('.newTagInput input').val());
        jQuery('.addNewTagModal .form_input input').val(newTagTitle);
        jQuery('.addNewTagModalBox').removeClass('loading');
        jQuery('.addNewTagModal .apiMessage').hide();
        jQuery('.addNewTagModal .error').html('&nbsp;');

       jQuery('#addNewTagModal').modal({
            fadeDuration: 200,
            fadeDelay: 2.5,
            escapeClose: false,
            clickClose: false,
        });
    });


    jQuery('.addNewTagModal .newTagAdd').on('click',function(){
        console.log(' newTagAdd click '); 
        jQuery('.addNewTagModalBox').addClass('loading');
        
        var newTagTitle = jQuery('.addNewTagModal .form_input input').val();
        var newTagCat   = jQuery('.addNewTagModal .form_input select[name="newTagCategory"]').val();
        var newTagIcon  = jQuery('.addNewTagModal .form_input select[name="newTagIcon"]').val();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        jQuery.ajax({
            url: base_url+"/ajax/addNewTag",
            type:"POST", 
            data:{'newTagtitle':newTagTitle, 'newTagCategory': newTagCat, 'newTagIcon': newTagIcon},
            success:function (resp) {
                console.log(' resp ', resp);   
																//$('#country_list').html(data);
															
                if(resp.status){
                    console.log(' resp data ', resp.data);
                    var newTagElem = resp.data;
                    var newTagHtml = '<li class="tagItem" data-id="'+newTagElem.id+'"><i class="tagIcon fa '+newTagElem.icon+'"></i><span>'+newTagElem.title+'</span></li>';                    
                    var dom_nodes = jQuery(jQuery.parseHTML(newTagHtml));
                    addNewTag(dom_nodes);

                    // jQuery('.selectTagList ul').append(newTagHtml); 
                    jQuery('.addNewTagModal .apiMessage').html('Tag Succesfully Added').show();
                    setTimeout(function() {
                        jQuery.modal.close();
                        jQuery('.newTagInput input').val(''); 
                    }, 1000);
                }else{
                    jQuery('.addNewTagModalBox').removeClass('loading');
                     if(resp.validator != undefined){
                        const keys = Object.keys(resp.validator);
                        for (const key of keys) {
                            if($('#'+key+'_error').length > 0){
                                $('#'+key+'_error').removeClass('to_hide').addClass('to_show').text(resp.validator[key][0]);
                            }
                        }
                    }

                   if(resp.error != undefined){
                     $('.addNewTagModalBox .apiMessage').show().text(resp.error);
                      setTimeout(function() {
                        jQuery('.addNewTagModal .apiMessage').html('').hide();
                    }, 3000);

                   }

                }
            }
        })

    });



    //====================================================================================================================================//
    // Ajax Post // update user tags. .
    //====================================================================================================================================//
	var saveUserTags = function(){
        console.log(' saveUserTags '); 
         var userSelectedTagsList = jQuery('.selectTagList ul li').map(function(){  return $(this).attr('data-id') }).get();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        jQuery.ajax({
            url: base_url+"/ajax/updateUserTags",
            type:"POST", 
            data:{'tags': userSelectedTagsList},
            success:function (resp) {
                console.log(' resp ', resp);   
                //$('#country_list').html(data);
                if(resp.status){
                    console.log(' resp data ', resp.data);
                    
                    // jQuery('.selectTagList ul').append(newTagHtml); 
                    jQuery('.addNewTagModal .apiMessage').html('Tag Succesfully Added').show();
                    setTimeout(function() {
                        jQuery.modal.close();
                        jQuery('.newTagInput input').val(''); 
                    }, 1000);
                }else{

                }
            }
        })

    
	 
	 
    } 

    