// {{-- ======================================================== Like JS ======================================================== --}}

$(document).on('click','.jsLikeButton',function(){
    var btn = $(this);
    var jobseeker_id = $(this).data('jsid');
    console.log(' jsLikeButton jobseeker_id ', jobseeker_id);
    // $(this).html(getLoader('blockJobSeekerLoader'));
    // $(this).html('..');
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.ajax({
        type: 'POST',
        url: base_url+'/m/ajax/MlikeJS/'+jobseeker_id,
        success: function(data){
            btn.prop('disabled',false);
            if( data.status == 1 ){

                $('.empLikeAlert').show().delay(3000).fadeOut('slow');
                btn.html('Liked').addClass('active');

                // location.reload();
                // $(this)('.jsLikeButton').attr("d-none");
                // $('.jobSeeker_row.js_'+jobseeker_id).remove();
                // $('.jsLikeButton').html("Liked");
            }else{
                btn.html('error');
            }
        }
    });
});

// {{-- ======================================================== Like JS End Here ======================================================== --}}

// {{-- ======================================================== Block Employer ======================================================== --}}

$(document).on('click','.jsBlockButton',function(){
    var btn = $(this);
    var js_id = $(this).data('jsid');
    console.log(' Job Seeker  ', js_id);
    // $(this).html(getLoader('blockJobSeekerLoader'));
    // $(this).html('..');

    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.ajax({
        type: 'POST',
        url: base_url+'/m/ajax/MblockJS/'+js_id,
        success: function(data){
            btn.prop('disabled',false);
            if( data.status == 1 ){

                $('.empBlockAlert').show().delay(3000).fadeOut('slow');
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

// {{-- ======================================================== Like Employer Detail Page ======================================================== --}}

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

                $('.empLikeAlert').show().delay(3000).fadeOut('slow');
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
// {{-- ======================================================== Block Employer in detail page ======================================================== --}}

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

                $('.empBlockAlert').show().delay(3000).fadeOut('slow');
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

// {{-- ======================================================== Block Employer in detail End Here ======================================================== --}}


