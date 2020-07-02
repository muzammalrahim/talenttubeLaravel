// Employer Deleting Code

$(document).on('click','#empdel', function() {
  var Empdelid=parseInt($(this).attr('emp-id'));
  var Emptitle = $(this).attr('emp-title');
  $('#deleteConfirmEmp').val(Empdelid);
  $('#deleteModalemp').modal('show');
  $('#delConfirmIdEmp').html(Emptitle);
});
  // Ajax for deleting Employer

  $('#removeEmp').on('click', function() {
    var delidemp = $('#deleteConfirmEmp').val();
    console.log("Employer Delete"+delidemp);

    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.ajax({
        type: 'POST',
        url: 'employers/delete/' + delidemp,
        data: {delidemp},
        beforeSend: function(){
           $(".modelProcessingEmp").show();
           $(".modalContentEmp p").hide();
           $("#removeEmp").prop("disabled", true);            
        },
        success: function(data) {
          console.log(' data ', data);
            if(data.status == 1 )
             $('#deleteModalemp').modal('hide');
             $(".modelProcessingEmp").hide();
             $(".modalContentEmp p").show();
             $("#removeEmp").prop("disabled", false);
            jQuery('#dataTable').DataTable().ajax.reload();
        }
    });
    
  });