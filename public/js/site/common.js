var CommonScript = function() {


    this.GetLocation = function(type, elem){
        console.log(' GetStateList ');
        var location = $(elem).closest('.geo_location_cont');
        var geo_country_elem = location.find('select.geo_country');
        var geo_state_elem = location.find('select.geo_states'); //.val();
        var geo_city_elem = location.find('select.geo_cities'); //.val();
        $.ajax({
            type: 'POST',
                url: base_url+'/ajax/'+type,
                data: { cmd:type,
                        select_id: (type === 'geo_states')? geo_country_elem.val() : geo_state_elem.val(),
                        filter:'1',
                        list: 0},
                        beforeSend: function(){
                            geo_country_elem.prop('disabled', true).trigger('refresh');
                            geo_city_elem.prop('disabled', true).trigger('refresh');
                            // preloader
                        },
                        success: function(data){
                            console.log(' data ', data);
                            geo_country_elem.prop('disabled', false).trigger('refresh');
                            geo_city_elem.prop('disabled', false).trigger('refresh');

                            // $jq('.geo, #city', pp_profile_edit_main_frm).prop('disabled', false).trigger('refresh');
                            // $this.disabledProfileEditMain(false);
                            if (data.status) {

                                console.log(' geo_state_elem ', geo_state_elem );
                                console.log(' data.list ', data.list);

                                switch (type) {
                                    case 'geo_states':
                                        geo_state_elem.html(data.list).trigger('refresh');
                                        geo_city_elem.html('<option value="0">Select City</option>').trigger('refresh');
                                        break
                                    case 'geo_cities':
                                        geo_city_elem.html(data.list).trigger('refresh');
                                        break
                                }
                            }
                        }
        });
    }
    // GetLocation end here.

    // saveNewJob = function(){
    //     console.log(' saveNewJob ');
    //     event.preventDefault();
    // }


    profileVideoShow =  function(video_url){
        console.log(' showVideoModal ', video_url);
        var videoElem  = '<video id="player" controls>';
        videoElem     += '<source src="'+video_url+'" type="video/mp4">';
        videoElem     += '</video>';
        $('#videoShowModal .videoBox').html(videoElem);
        $('#videoShowModal').modal({
            fadeDuration: 200,
            fadeDelay: 2.5,
            escapeClose: false,
            clickClose: false,
        }); 
       //  const player = new Plyr('#player');
    }

}


$(function () {
    CommonScript = new CommonScript();






});



$(document).ready(function(){

    // Save New job button click //
    /////////////////////////////////////////////////////////////////
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
    })






});
