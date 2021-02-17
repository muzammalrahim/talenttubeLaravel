
$(document).ready(function(){

	// console.log('Java Script ready');

	$(document).on('click' , '.addjsInPool' , function(){
	var user_id = $(this).attr('user_id');
	var pool_id = $('.pool_id').attr('pool_id');
	// console.log(pool_id);

		$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
	      $.ajax({
	        type: 'POST',
	        url: base_url + '/admin/jobseeker/addInPool' ,
	        data: {'user_id': user_id,'pool_id': pool_id},
	        success: function(data) {
	           $('#dataTable').DataTable().ajax.reload();
	        }
	     });

	});


	$(document).on('click' , '.removeFromPool' , function(){
		var user_id = $(this).attr('user_id');
		var pool_id = $('.pool_id').attr('pool_id');
		$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
	      $.ajax({
	        type: 'POST',
	        url: base_url + '/admin/jobseeker/removeFromPool' ,
	        data: {'user_id': user_id,'pool_id': pool_id},
	        success: function(data) {
	           $('#dataTable').DataTable().ajax.reload();
	        }
	     });
	});




});

