
$(document).ready(function() {

    // alert('Hi How are you 24 December');
    $('.letsGoButton').click(function(){
        $('.initialQuestions').addClass('d-none');
        $('.workreference').removeClass('d-none');
        $('.container-fluid').css({"height":"525px"});
        console.log('Cross reference');

    });

    // ========================================== Declining Reference Start ==========================================

    $('.declineButton').click(function(){

        $('.declinedSpinner').removeClass('d-none');
        var refID = $('.declineButton').val();
        console.log(refID);
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

        $.ajax({
            type: 'POST',
            id: refID,

            url: base_url+'/ajax/crossreference/declineReference/' + refID ,
            success: function(data){
                console.log(' data ', data);
                $('.declineButton').html('Declined').prop('disabled',true);
                
                $('.declinedSpinner').addClass('d-none');
                setTimeout(function() {
                    location.href = base_url + '/reference/declined'; 
                    }, 4000);
              

            }
        });
    });

    // ========================================== Declining Reference End ==========================================

});
