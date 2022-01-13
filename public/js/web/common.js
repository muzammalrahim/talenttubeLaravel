$(document).ready(function(){
	// console.log(' New Common.js appearing ');


	// ===================================================== Save Industry experience ==================================================== 

   this.updateNewJobIndustryExperience = function(){
       $.ajaxSetup({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
           });
           var industry_experience = jQuery('.industry_experience').map(function(){ return $(this).val()}).get();
            $('.SaveindustryExperience').after(getLoader('smallSpinner SaveIndustrySpinner'));
           $.ajax({
               type: 'POST',
               url: base_url+'/ajax/updateNewJobIndustryExperience',
               data: {'industry_experience': industry_experience},
               success: function(resp){
                   if(resp.status){
                       $('.IndusListBox').removeClass('edit');
                       $('.IndusAlert').show().delay(3000).fadeOut('slow');
                       $('.SaveIndustrySpinner').remove();
                       $('.IndusList').html(resp.data);
                       $('.removeIndustry').addClass('hide_it');
                       $('.addIndus').addClass('hide_it');
                       $('.buttonSaveIndustry').addClass('hide_it');

                       }
               }
       });
    }

	// ===================================================== Save New Job ==================================================== 

   	$('.saveNewJob').on('click',function() {

        event.preventDefault();
        var formData = $('.new_job_form').serializeArray();
        $('.saveNewJob').html(getLoader('pp_profile_edit_main_loader')).prop('disabled',true);
        console.log(' formData ', formData);
        $('.general_error').html('');
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/job/new',
            data: formData,
            success: function(data){
                console.log(' data ', data);
                $('.saveNewJob').html('Save').prop('disabled',false);
                if( data.status == 1 ){
                    // that.hideMainEditor();
                    $('.add_new_job').html(data.message);
                }else{
                    $('.general_error').html('<p>Error Creating new job</p>').removeClass('to_hide').addClass('to_show');
                    if(data.validator != undefined){
                        const keys = Object.keys(data.validator);
                        for (const key of keys) {
                            if($('#'+key+'_error').length > 0){
                                $('#'+key+'_error').removeClass('to_hide').addClass('to_show').text(data.validator[key][0]);
                            }
                        }
                    }
                   if(data.error != undefined){
                     $('.general_error').append(data.error);
                   }
                   setTimeout(() => { $('.general_error').removeClass('to_show').addClass('to_hide').text(''); },3000);
                }

            }
        });
   	});

	// ===================================================== Delete New Job (Employer) ====================================================

	this.deleteJobAsEmployer = function(job_id){

        console.log(' confirmJobAppRemoval click  job_id ', job_id );
        $('#deleteConfirmJobId').val(job_id);
	}

	// ===================================================== Confirm Delete New Job (Employer) ==================================================== 

	// $(document).on('click','.confirm_jobDelete_ok',function(){

	this.confirmDeleteJobAsEmployer = function(){

       // $('.confirmJobDeleteModal .img_chat').html(getLoader('jobDeleteloader'));
       // $(this).prop('disabled',true);
       var job_id =  $('#deleteConfirmJobId').val();
       $('.contentBody').hide();
       $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
       $.ajax({
           type: 'POST',
           url: base_url+'/ajax/deleteJob/'+job_id,
           success: function(data){
               if( data.status == 1 ){
                   var jobDeletingMessage = data.message;
                   console.log(jobDeletingMessage);
                   $('.successMessage').text(jobDeletingMessage).show();
                   $('.jobDeleteloader').hide();
                   // $('.confirmJobDeleteModal .img_chat').html(data.message).show();
                   $('.job_'+job_id).remove();
                   $('.double_btn').hide();
               }else{
                   $('.confirmJobDeleteModal .img_chat').html(data.error);
               }
           }
       });
   // });
	}


	// ======================================= Edit job Industry experience as employer =======================================


	// $(".editIndustry").click(function(){

	this.editJobIndustryExpAsEmp = function(){

       $(this).closest('.IndusListBox').addClass('edit');
       $('.removeIndustry').removeClass('hide_it');
       $('.addIndus').removeClass('hide_it');
       $('.saveIndus').removeClass('hide_it');
       $('.buttonSaveIndustry').removeClass('hide_it');
       // console.log('welcome');
     // });

	}



	// ======================================= Update industry experience new job added by employer =======================================

	this.updateNewJobIndustryExpAsEmployer = function(){
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var industry_experience = jQuery('.industry_experience').map(function(){ return $(this).val()}).get();
            $.ajax({
                type: 'POST',
                url: base_url+'/ajax/updateNewJobIndustryExperience',
                data: {'industry_experience': industry_experience},
                success: function(resp){
                    if(resp.status){
                        $('.IndusListBox').removeClass('edit');
                        $('.IndusAlert').show().delay(3000).fadeOut('slow');
                        $('.SaveIndustrySpinner').remove();
                        $('.IndusList').html(resp.data);
                        $('.removeIndustry').addClass('hide_it2');
                        $('.addIndus').addClass('hide_it');
                        $('.saveIndus').addClass('hide_it');
                    }
                }
        });
    }

    // ======================================= Fully Update New job added ny employer =======================================

   	// $('.updateJobBtn').on('click',function() { 

   	this.updateJobAsEmployer = function(job_id){
       event.preventDefault();
       var formData = $('.edit_job_form').serializeArray();
       // $('.updateJobBtn').html(getLoader('pp_profile_edit_main_loader')).prop('disabled',true);
       console.log(' formData ', formData);
       $('.general_error').html('');
       $.ajax({
           type: 'POST',
           url: base_url+'/ajax/job/'+job_id,
           data: formData,
           success: function(data){
               console.log(' data ', data);
               $('.updateJobBtn').html('Save').prop('disabled',false);
               if( data.status == 1 ){
                   // that.hideMainEditor();
                   // $('.add_new_job').html(data.message);
                   window.location =data.redirect;
               }else{
                   $('.general_error').html('<p>Error Creating new job</p>').removeClass('to_hide').addClass('to_show');
                   if(data.validator != undefined){
                       const keys = Object.keys(data.validator);
                       for (const key of keys) {
                           if($('#'+key+'_error').length > 0){
                               $('#'+key+'_error').removeClass('to_hide').addClass('to_show').text(data.validator[key][0]);
                           }
                       }
                   }
                  if(data.error != undefined){
                    $('.general_error').append(data.error);
                  }
                  setTimeout(() => { $('.general_error').removeClass('to_show').addClass('to_hide').text(''); },3000);
               }

           }
       });
       console.log('after ajsx');
    }
   	// })

    // ======================================= Fully Update New job added ny employer =======================================





});