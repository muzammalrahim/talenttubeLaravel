// {{-- ======================================================== Like Employer ======================================================== --}}

$(document).on('click','.likeEmployerButton',function(){
    var btn = $(this);
    var jobseeker_id = $(this).data('jsid');
    console.log(' likeEmployerButton jobseeker_id ', jobseeker_id);
    // $(this).html(getLoader('blockJobSeekerLoader'));
    // $(this).html('..');
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.ajax({
        type: 'POST',
        url: base_url+'/m/ajax/MlikeEmployer/'+jobseeker_id,
        success: function(data){
            btn.prop('disabled',false);
            if( data.status == 1 ){

                // $('.empLikeAlert').show().delay(3000).fadeOut('slow');
                btn.html('Liked').addClass('active');
                // location.reload();

                // $(this)('.likeEmployerButton').attr("d-none");

                // $('.jobSeeker_row.js_'+jobseeker_id).remove();
                // $('.likeEmployerButton').html("Liked");
            }else{
                btn.html('error');
            }
        }
    });
});

// {{-- ======================================================== Like Employer End Here ======================================================== --}}

// {{-- ======================================================== Block Employer ======================================================== --}}

$(document).on('click','.blockEmployerButton',function(){
    var btn = $(this);
    var employer_id = $(this).data('jsid');
    console.log(' Employer  ', employer_id);
    // $(this).html(getLoader('blockJobSeekerLoader'));
    // $(this).html('..');

    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.ajax({
        type: 'POST',
        url: base_url+'/m/ajax/MblockEmployer/'+employer_id,
        success: function(data){
            btn.prop('disabled',false);
            if( data.status == 1 ){

                // $('.empBlockAlert').show().delay(3000).fadeOut('slow');
                btn.html('Blocked').addClass('active');
                // location.reload();
                

                // $('You Have Block Employer Successfully').alert();
                // $(this)('.likeEmployerButton').attr("d-none");
                // $('.jobSeeker_row.js_'+jobseeker_id).remove();
                // $('.likeEmployerButton').html("Liked");
            }else{
                btn.html('error');
            }
        }
    });
});

// {{-- ======================================================== Block Employer End Here ======================================================== --}}



// ======================================================= Unlike Employer in Employer Detal Page =======================================================

    $('.unlikeEmpButton').click(function(){
        // console.log('Hi Unlike Employer Button');
        var btn = $(this);
        var jobseeker_id = $(this).data('jsid');
        // console.log(' likeEmployerButton jobseeker_id ', jobseeker_id);
        $('#idEmpInModalHidden').val(jobseeker_id);

    });

    $('.confirmUnlikeEmployer').click(function(){
        // console.log('Hi Unlike Employer Button');
        var btn = $(this);
        var jobseeker_id = $(this).data('jsid');
        // console.log(' likeEmployerButton jobseeker_id ', jobseeker_id);
        var emp_id = $('#idEmpInModalHidden').val();
        console.log(emp_id);
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                type: 'POST',
                url: base_url+'/m/ajax/MunLikeUser/'+emp_id,
                data: {'id': emp_id},
                success: function(data){
                    if( data.status == 1 ){
                        $('.empLikeAlert').show().delay(3000).fadeOut('slow');
                        location.reload();
                    }
                }
            });
    });

// ======================================================= Unlike Employer in Employer Detal Page end here =======================================================



