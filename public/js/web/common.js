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

                    // $("#addNewJobModalError").modal('show');
                    $('.general_error').html('<p>Your job can not be posted until you complete all fields</p>').removeClass('to_hide').addClass('to_show');
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


    // ====================================================== add more question. ======================================================
   
    // $('.addQuestion').on('click',function(){

    this.addnewQuestion = function(){
       console.log(' addQuestion clck  ');
       var qC = parseInt($('#questionCounter').val())+1;
       if(qC<=5){
           var jobQuestion  = '<div class="col-12 col-sm-6 col-md-6 col-lg-6 p-4">';
               jobQuestion += '<div class="jobQuestion  q'+qC+' row bg-light rounded">';
               jobQuestion +=  '<div class="col-md-12 pt-2">';
               jobQuestion +=    '<label>Title</label>';
               jobQuestion +=    '<input type="text" name="jq['+qC+'][title]" class="form-control bg-white"/>';
               jobQuestion +=  '</div>';
               jobQuestion +=  '<div class="col-md-12 pt-2 ">';
               jobQuestion +=    '<label class="jq_field_label">Options</label>';
               jobQuestion +=    '<div class="jq_field_questions">';
               jobQuestion +=          '<div class="option row mb-1">';
               jobQuestion +=          '<div class=" col-lg-5">';
               jobQuestion +=             '<input type="text" name="jq['+qC+'][option][0][text]" class="bg-white form-control" />';
               jobQuestion +=          '</div>';
               jobQuestion +=           '<div class="col-lg-7 p-lg-0">';
               jobQuestion +=           '<div class="row">';
               jobQuestion +=                 '<div class="col-lg-6 custom-checkbox d-flex">';
               jobQuestion +=                      '<input type="checkbox" id="jq_'+qC+'_option_0_preffer" name="jq['+qC+'][option][0][preffer]" value="preffer">';
               jobQuestion +=                       '<label for="jq_'+qC+'_option_0_preffer" class=" pt-1">Undiserable</label> ';
               jobQuestion +=                  '</div>';
               jobQuestion +=                  '<div class="col-lg-6 custom-checkbox">';
               jobQuestion +=                     '<input type="checkbox" id="jq_'+qC+'_option_0_goldstar" name="jq['+qC+'][option][0][goldstar]" value="goldstar">';
               jobQuestion +=                     '<label for="jq_'+qC+'_option_0_goldstar" class="pt-1">Gold Star</label> ';
               jobQuestion +=                  '</div>';
               jobQuestion +=           '</div>';
               jobQuestion +=           '</div>';
               jobQuestion +=          '</div>';
               jobQuestion +=      '</div>';
               jobQuestion +=     '<div class="j_button dinline_block addOptionsBtn mt-3"><a class="addQuestionOption blue-btn" data-qc="'+qC+'">Add Option+</a></div>';
               jobQuestion +=    '</div>';
               jobQuestion +=  '<div class="jq_remove"><span class=" removeJobQuestion text-danger float-right"><i class="fas fa-times-circle"></i></span></div>';
               jobQuestion +=  '</div>';
               jobQuestion +=  '</div>';

            $('.jobQuestions').append(jobQuestion);
            $('#questionCounter').val(qC);
            // jQFormStyler(); // rerun the form styler.
            $('input:checkbox').change(function() {
            if ($(this).is(':checked')) {
                   $(this).closest('label').addClass('checked');
                   if($(this).attr('name').includes('preffer')){
                       var res = $(this).attr('name').replace("preffer", "goldstar");
                       var arrChkBox = $('[name="'+res+'"]');
                       arrChkBox.prop('checked', false).trigger('refresh');
                   }

                   if($(this).attr('name').includes('goldstar')){
                       var res = $(this).attr('name').replace("goldstar", "preffer");
                       var arrChkBox = $('[name="'+res+'"]');
                       arrChkBox.prop('checked', false).trigger('refresh');
                   }

            } else {
              $(this).closest('label').removeClass('checked');
            }
           });

        }
    }
    // });


    // ====================================================== add more option to question. ======================================================
   
       $('.jobQuestions').on('click','.addQuestionOption', function(){
           var oC = $(this).closest('.jobQuestion').find('.jq_field_questions .option').length;
           // var qC = $(this).attr('data-qc');
           var qC = parseInt($('#questionCounter').val());
           var option_html = '';
               option_html +=          '<div class="jq_option option row mb-1">';
               option_html +=          '<div class="col-lg-5">';
               option_html +=             '<input type="text" name="jq['+qC+'][option]['+oC+'][text]" class="bg-white form-control"/>';
               option_html +=             '</div>';
               option_html +=              '<div class="col-lg-7 p-lg-0">'
               option_html +=              '<div class="row">';
               option_html +=              '<div class="jq_option_cbx col-lg-6 custom-checkbox d-flex">';
               option_html +=              '<input type="checkbox" id="jq_'+qC+'_option_'+oC+'_preffer" name="jq['+qC+'][option]['+oC+'][preffer]" value="preffer">';
               option_html +=                '<label for="jq_'+qC+'_option_'+oC+'_preffer" class=" pt-1">Undiserable</label> ';
               option_html +=                  '</div>';
               option_html +=                  '<div class="jq_option_cbx col-lg-6 custom-checkbox">';
               option_html +=                     '<input type="checkbox" id="jq_'+qC+'_option_'+oC+'_goldstar" name="jq['+qC+'][option]['+oC+'][goldstar]" value="goldstar">';
               option_html +=                     '<label for="jq_'+qC+'_option_'+oC+'_goldstar" class="pt-1">Gold Star</label> ';
               option_html +=                  '</div>';
               option_html +=                 '</div>';
               option_html +=               '</div>';
               option_html +=          '</div>';
   
           $(this).closest('.jobQuestion').find('.jq_field_questions').append(option_html);
           // jQFormStyler(); // rerun the form styler.
   
           $('input:checkbox').change(function() {
            if ($(this).is(':checked')) {
                   $(this).closest('label').addClass('checked');
                   if($(this).attr('name').includes('preffer')){
                       var res = $(this).attr('name').replace("preffer", "goldstar");
                       var arrChkBox = $('[name="'+res+'"]');
                       arrChkBox.prop('checked', false).trigger('refresh');
                   }
                   if($(this).attr('name').includes('goldstar')){
                       var res = $(this).attr('name').replace("goldstar", "preffer");
                       var arrChkBox = $('[name="'+res+'"]');
                       arrChkBox.prop('checked', false).trigger('refresh');
                   }
            } else {
              $(this).closest('label').removeClass('checked');
            }
           });
   
       });

    // ================================= Scroll to top on click pagination =================================
    
   /* $(document).click('.pagination', function(){
        $(window).scrollTop(0);
    })*/




});