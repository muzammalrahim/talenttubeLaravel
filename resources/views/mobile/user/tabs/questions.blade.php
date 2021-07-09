<div class="tab-pane fade" id="profile-just" role="tabpanel" aria-labelledby="profile-tab-just">
    <div class="mb-3 bg-white rounded text-dark">
        <h6 class="card-header h6">Questions <div class="spinner-border spinner-border-sm text-light userQuesLoader ml-2" role="status" style="display:none;"></div>
        <i class="fas fa-edit float-right editQuestions"></i></h6>
        <div class="card-body p-2 cardBody">
                <p class="loader SaveQuestionsLoader"style="float: left;"></p>
                  <div class="cl"></div>
                    <div class="questionsOfUser">
                      @include('mobile.layout.parts.jobSeekerQuestions')  {{--  mobile/layout/parts/jobSeekerQuestions    --}}
                    </div>
                    <div class="col-md-12 text-center mt-3">
                        <a class="btn btn-sm btn-success saveQuestionsButton d-none">Save</a>
                    </div>
                <div class="alert alert-success questionsAlert" role="alert" style="display:none;">
                  <strong>Success!</strong> Questions have been updated successfully!
                </div>
        </div>
    </div>
</div>


<script type="text/javascript">


//===================================================== User Questions Edit =====================================================

 $(".editQuestions").click(function(){
     $('.hideme').show();
     $('.saveQuestionsButton').removeClass('d-none');
     $('.QuestionsKeyPTag').addClass('d-none');
     $('.jobSeekerRegQuestion').removeClass('d-none');


});

//  ======================================= User Questions Ajax saveQuestionsButton =======================================

    $(".saveQuestionsButton").click(function(){
        var items = {};
        $('select.jobSeekerRegQuestion').each(function(index,el){
        // console.log(index, $(el).attr('name')  , $(el).val()   );
            // items.push({name:  $(el).attr('name') , value: $(el).val()});
            var elem_name = $(el).attr('name');
            var elem_val = $(el).val();
            items[elem_name] = elem_val;
            // items.push({elem_name : elem_val });
        $('.userQuesLoader').show();           //indusExpLoader

        });
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // $('.SaveQuestionsLoader').after(getLoader('smallSpinner SaveQuestionsSpinner'));
        $.ajax({
            type: 'POST',
            url: base_url+'/m/ajax/MupdateQuestions',
            data: {'questions': items},

            success: function(data){
                    $('.questionsAlert').show().delay(3000).fadeOut('slow');
                    $('.saveQuestionsButton').addClass('d-none');
                    $('.userQuesLoader').hide();
                    // location.reload();

                    $('.QuestionsKeyPTag').removeClass('d-none');
                    $('.jobSeekerRegQuestion').addClass('d-none');


                    if(data.status==1){
                         $(".questionsOfUser").html(data.data);
                        // $(".SaveQuestionsSpinner").remove();

                }
            }
        });
    });

//  ======================================= User Questions Ajax End  =======================================

</script>