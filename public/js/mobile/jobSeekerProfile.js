

// {{-- ==================================================== Edit Qualification ==================================================== --}}




  $(document).ready(function(){

  $(".editQualification").click(function(){
        $(this).closest('.qualificationBox').addClass('editQualif');
        $('.removeQualification').removeClass('hide_it2');
        $('.addQualification').removeClass('hide_it2');
        $('.qualificationSaveButton').removeClass('hide_it2');

        // console.log('Testing Qualification');
  });

   $('.qualificationBox').on('click','.removeQualification', function(){
      console.log('removeQualification');
     $(this).closest('.QualificationSelect').remove();
   });

 })
   $(document).on('click','.addQualification', function(){
    console.log(' addQualification ');
    var newQualificationHtml = '<div class="QualificationSelect"><select name="qualification[]" class="userQualification">';
    @if(!empty($qualificationList))
        @foreach($qualificationList as $lk=>$qualification)
            newQualificationHtml += '<option value="{{$qualification['id']}}">{{$qualification['title']}}</option>';
        @endforeach
    @endif
    newQualificationHtml += '</select>';
    newQualificationHtml += '<i class="fa fa-trash removeQualification"></i>';
    newQualificationHtml += '</div>';
    $('.qualificationList').append(newQualificationHtml);
   });

// ==================================================== Edit Qualification ====================================================

//===================================================== add remove industry ===================================================

 $(".editIndustry").click(function(){
    $(this).closest('.IndusListBox').addClass('edit');

    $('.removeIndustry').removeClass('hide_it2');
    $('.addIndus').removeClass('hide_it2');
    $('.buttonSaveIndustry').removeClass('hide_it2');

    // console.log('welcome');
  });

// add and remove Industry code
$(document).ready(function(){
   $(document).on('click','.removeIndustry', function(){
    $(this).closest('.IndustrySelect').remove();
   });

   $(document).on('click','.addIndus', function(){
    console.log(' addIndus ');
    var newIndusHtml = '<div class="IndustrySelect"><select name="industry_experience[]" class="industry_experience userIndustryExperience">';
    @if(!empty($industriesList))
        @foreach($industriesList as $lk=>$lv)
            newIndusHtml += '<option value="{{$lk}}">{{$lv}}</option>';
        @endforeach
    @endif
    newIndusHtml += '</select>';
    newIndusHtml += '<i class="fa fa-trash removeIndustry"></i>';
    newIndusHtml += '</div>';

    $('.IndusList').append(newIndusHtml);
   });
});

//===================================================== add remove industry =====================================================

//===================================================== User Questions Edit =====================================================

 $(".editQuestions").click(function(){
 $('.hide2').css("display","inline-block");
 $('.jobSeekerRegQuestion').removeClass('hide_it');
 $('.QuestionsKeyPTag').addClass('hide_it');
});

//================================================ User Questions Editing end here ================================================


// </script>
