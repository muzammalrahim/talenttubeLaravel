

<div class="mb40">

    @include('site.user.jobseekerInfoTabs.notesText')


    <form method="POST" name="crossReference" class="crossReference newJob job_validation">
        @csrf
        <textarea id="notes" name="notes" rows="4" cols="50"> </textarea >
        <p class="errorsInFields text-danger"></p>
        <div class="fomr_btn act_field">
               <button class="btn small leftMargin turquoise saveNote">Save Note</button>
        </div>

        <input type="hidden" name="js_id" value="{{ $jobSeeker->id }}">

        {{-- @dump($jobSeeker->id) --}}
    </form>
</div>



<div style="display:none;">
<div id="confirmNoteRemoval" class="modal cmodal p0 confirmNoteRemoval wauto">
    <div class="pp_info_start pp_alert pp_confirm pp_cont" style="left: 0px; top: 0px; margin: 0;">
        <div class="cont">
            <div class="title">Delete Note</div>
            <div class="spinner_loader">
                <div class="spinner center">
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
            <div class="apiMessage mt20"></div>
            <div class="img_chat">
                <div class="icon">
                    <img src="{{asset('/images/site/icons/icon_pp_sure.png')}}" height="48" alt="">
                </div>
                <div class="msg">Are you sure you wish to continue?</div>
            </div>
            <div class="double_btn">
                <button class="confirm_close btn small dgrey" onclick="UProfile.cancelGalleryConfirm(); return false;">Cancel</button>
                <button class="confirm_jobAppDelete_ok confirm_btn btn small marsh">OK</button>
                <input type="hidden" name="deleteConfirmJobAppId" id="deleteConfirmJobAppId" value=""/>
                <div class="cl"></div>
            </div>
        </div>
    </div>
</div>
</div>


<script type="text/javascript">






$(document).ready(function() {

    // Save new notes 
    $('.saveNote').on('click',function() {
    event.preventDefault();
    var formData = $('.crossReference').serializeArray();
    console.log(formData);
    // return;

    $('.saveNote').html(getLoader('pp_profile_edit_main_loader')).prop('disabled',true);
    console.log(' formData ', formData);
    // return;

    $('.general_error1').html('');
    $.ajax({
        type: 'POST',
        url: base_url+'/ajax/saveNote',
        data: formData,
        success: function(response){
            // console.log(' data ', data);
            $('.saveNote').html('Save Note').prop('disabled',false);
            if( response.status == 1 ){
                $('.errorsInFields').text('Notes added sucessfully');
                setTimeout(() => { $('.errorsInFields').removeClass('to_show').addClass('to_hide').text(''); },3000);
                $('.errorsInFields').css("color" , "green" );
                $('#notes').val("");
                // $(".container").load(" .container");
                $(".tab_notes .container").html(response.noteHtml);
                // $('.container').load(document.URL + ' .container');
            }else{
                var errorss =  response.validator;
                var nameError = errorss['notes'];
                if(nameError) {
                    var nameError2 = nameError.toString();
                    $('.errorsInFields').text(nameError2);
                }
                // $('.errorsInFields').text('Error occured');
               setTimeout(() => { $('.errorsInFields').removeClass('to_show').addClass('to_hide').text(''); },4000);
            }

        }
    });
    });

    // remove existing note. 
    console.log(' note doc ready  ');
    $('.tab_notes').on('click','.noteRemoval',function(){
        var note_id = $(this).attr('data-noteid');
        console.log(' noteRemoval click  note_id ', note_id, $(this) );
        $('.modal.cmodal').removeClass('showLoader').removeClass('showMessage');
        $('.confirm_close').show();
        $('#confirmNoteRemoval').modal({
            fadeDuration: 200,
            fadeDelay: 2.5,
            escapeClose: false,
            clickClose: false,
        });
        $('#deleteConfirmJobAppId').val(note_id);
    });

    $(document).on('click','.confirm_jobAppDelete_ok',function(){
        $('.confirmNoteRemoval').addClass('showLoader');
        var note_id_del = $('#deleteConfirmJobAppId').val();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/deleteNote/'+note_id_del,
            success: function(data){
                $('.confirmNoteRemoval').removeClass('showLoader').addClass('showMessage');
                if( data.status == 1 ){
                    $('.confirmNoteRemoval .apiMessage').html(data.message);
                    $('.note_'+note_id_del).remove();
                    $('.confirm_close').hide();
                }else{
                    $('.confirmNoteRemoval .apiMessage').html(data.error);
                }
            }
        });

    });

});




</script>

<style type="text/css">
.errorsInFields{color:red; margin-left: 15%;}
.notes { display: block; padding: 10px; border: 1px solid #ced1da; border-radius: 3px; clear: both; margin: 0px; }
/*.textCenter2 { padding-bottom: 10px !important; font-weight: 600; }*/
</style>

