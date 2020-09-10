{{-- @extends('site.user.usertemplate') --}}
@extends('mobile.user.usermaster')
@section('content')

 

<div class="card shadow mb-3 bg-white rounded">

  <h6 class="card-header h6">Company Information {{-- <i class="fas fa-edit float-right"> --}}</i></h6>

    <div class="card-body p-2 cardBody">
    <div id="over" style="/*position:absolute; */width:auto; height:150px">

      {{-- <img src="https://p16-tiktokcdn-com.akamaized.net/aweme/720x720/tiktok-obj/1646491669975042.jpeg"> --}}
        <a class="show_photo_gallery" href="{{$profile_image}}" data-lcl-thumb="{{$profile_image}}" >
            <img  class="photo" id="pic_main_img" src="{{$profile_image}}" title="">
        </a>
        
    </div>

    <div class="personalInfo">{{$user->name}} {{$user->surname}}</div>
    <div class="personalInfo"><b>Email:</b> {{$user->email}}</div>
    <div class="personalInfo"><b>Phone:</b> {{$user->phone}}</div>
    <div class="personalInfo"><b>Location: </b>{{$user->location}}</div>

        {{-- Interested In --}}
    <div class="aboutMeSection"><b>Interested In: </b>
            <div class="spinner-border spinner-border-sm text-primary IntsdInLoader ml-2" role="status" style="display:none;"></div>
            <i class="fas fa-edit float-right intInSecButton"></i> <p class="interestedInSec">{{$user->interested_in}}</p>
        </div>

    <div class="col-md-12 text-center my-2">
                              <a class="btn btn-sm btn-success saveInterestedInButton d-none">Save</a>
        </div>

        <div class="alert alert-success interestedInAlert" role="alert" style="display:none;">
          <strong>Success!</strong> Interested In have been updated successfully!
        </div>

        {{-- Interested In --}}

    <div class="aboutMeSection"><b>About Me: </b>
            <div class="spinner-border spinner-border-sm text-primary AboutMeLoader ml-2" role="status" style="display:none;"></div>
            <i class="fas fa-edit float-right aboutMeSecButton"></i> <p class="aboutMeSec">{{$user->about_me}}</p>
        </div>

        <div class="col-md-12 text-center my-2">
            <a class="btn btn-sm btn-success saveAboutMeButton d-none">Save</a>
        </div>

        <div class="alert alert-success AboutMeAlert" role="alert" style="display:none;">
          <strong>Success!</strong> About Me have been updated successfully!
        </div>

        <div class="cardContent"></div>
        <div class="cardEdit" style="display: none;"></div>
    {{-- @dump($user); --}}

    </div>

</div> 


<div class="card shadow mb-3 bg-white rounded">

    <h6 class="card-header h6">Questions<i class="fas fa-edit float-right editQuestions"></i></h6>

{{--     <div class="card-body p-2 cardBody">

            <p class="loader SaveQuestionsLoader"style="float: left;"></p>
              <div class="cl"></div>
                <div class="questionsOfUser">
            
                    @php  
                        $userQuestions = !empty($user->questions)?(json_decode($user->questions, true)):(array()); 
                    @endphp
                      @if(!empty($empquestion))
                          @foreach($empquestion as $qk => $question)
                            <div>
                              <p>{{$question}} </p>
                               <p class="QuestionsKeyPTag"><b>{{$userQuestions[$qk]}}</b></p>
                                <select name="{{$qk}}" class="jobSeekerRegQuestion custom-select custom-select hideme mb-2">
                                    <option value="yes"
                                    {{( isset($userQuestions[$qk]) && ($userQuestions[$qk] == 'yes'))?'selected':''}}
                                    >Yes</option>
                                    <option value="no"
                                    {{( isset($userQuestions[$qk]) && ($userQuestions[$qk] == 'no'))?'selected':''}}
                                    >No</option>
                                </select>
                            </div>
                          @endforeach
                      @endif
                          <div class="col-md-12 text-center mt-3">
                              <a class="btn btn-sm btn-success saveQuestionsButton d-none">Save</a>
                          </div>  
                </div>


            <div class="alert alert-success questionsAlert d-none mt-2" role="alert">
              <strong>Success!</strong> Questions have been updated successfully!
            </div>
    </div> --}}

      <div class="card-body p-2 cardBody">

            <p class="loader SaveQuestionsLoader"style="float: left;"></p>
              <div class="cl"></div>
                <div class="questionsOfUser">
                    @php  
                        $userQuestions = !empty($user->questions)?(json_decode($user->questions, true)):(array()); 
                    @endphp
                      @if(!empty($empquestion))
                          @foreach($empquestion as $qk => $question)
                            <div>
                              <p class="mb-1">{{$question}} </p>
                               <p class="QuestionsKeyPTag mb-1"><b>{{$userQuestions[$qk]}}</b></p>
                                <select name="{{$qk}}" class="jobSeekerRegQuestion custom-select custom-select hideme mb-2 d-none">
                                    <option value="yes"
                                    {{( isset($userQuestions[$qk]) && ($userQuestions[$qk] == 'yes'))?'selected':''}}
                                    >Yes</option>
                                    <option value="no"
                                    {{( isset($userQuestions[$qk]) && ($userQuestions[$qk] == 'no'))?'selected':''}}
                                    >No</option>
                                </select>
                            </div>
                          @endforeach
                      @endif
                          <div class="col-md-12 text-center mt-3">
                              <a class="btn btn-sm btn-success saveQuestionsButton d-none">Save</a>
                          </div>  
                </div>
            <div class="alert alert-success questionsAlert" role="alert" style="display:none;">
              <strong>Success!</strong> Questions have been updated successfully!
            </div>
  </div>

</div> 



@stop


@section('custom_footer_css')
<style type="text/css">

p,span{
    font-size: 12px;
}

</style>
@stop

@section('custom_js')

<script type="text/javascript">


// {{-- ==================================================== Edit Interested IN ==================================================== --}}

$('.intInSecButton').click(function(){

        $('.interestedInSec').attr("contentEditable", "true");
        $('.interestedInSec').addClass('interestedInEditColor');
        $('.interestedInSec').addClass('editable');
    $('.saveInterestedInButton').removeClass('d-none');

    
});

$(".saveInterestedInButton").click(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var interestedIn = $('.interestedInSec').text(); 
    console.log(interestedIn);
        $('.IntsdInLoader').show();
    $.ajax({
        type: 'POST',
        url: base_url+'/m/ajax/MupdateInterested_inEmp',
        data: {'interestedIn': interestedIn},
        success: function(resp){
            if(resp.status){
                $('.IntsdInLoader').hide(); 
                $('.saveInterestedInButton').addClass('d-none'); 
                $('.interestedInSec').attr("contentEditable", "false");
                $('.interestedInSec').removeClass('interestedInEditColor');
                $('.interestedInAlert').show().delay(3000).fadeOut('slow');


            }
        }
    });
});

// {{-- ==================================================== Edit Interested IN End ==================================================== 

--}}

// {{-- ==================================================== Edit About Me  ==================================================== --}}

$('.aboutMeSecButton').click(function(){

        $('.aboutMeSec').attr("contentEditable", "true");
        $('.aboutMeSec').addClass('interestedInEditColor');
        $('.aboutMeSec').addClass('editable');
        $('.saveAboutMeButton').removeClass('d-none');
});

$(".saveAboutMeButton").click(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var aboutMe = $('.aboutMeSec').text(); 
    console.log(aboutMe);
    $('.AboutMeLoader').show();
    $.ajax({
        type: 'POST',
        url: base_url+'/m/ajax/Mabout_meEmp',
        data: {'aboutMe': aboutMe},
        success: function(resp){
            if(resp.status){
                $('.AboutMeLoader').hide(); 
                $('.saveAboutMeButton').addClass('d-none'); 
                $('.aboutMeSec').attr("contentEditable", "false");
                $('.aboutMeSec').removeClass('interestedInEditColor');
                $('.AboutMeAlert').show().delay(3000).fadeOut('slow');

            }
        }
    });
});

// {{-- ==================================================== Edit About Me End ==================================================== --}}


//===================================================== Employer Questions Edit =====================================================

 $(".editQuestions").click(function(){      
     $('.hideme').show();
     $('.saveQuestionsButton').removeClass('d-none');
     $('.QuestionsKeyPTag').addClass('d-none');
     $('.jobSeekerRegQuestion').removeClass('d-none');


});
//================================================ Employer Questions Editing end here ================================================

//  ======================================= Employer Questions Ajax saveQuestionsButton =======================================

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
            url: base_url+'/m/ajax/MupdateQuestionsEmp',
            data: {'questions': items},
            
            success: function(data){
                    $('.questionsAlert').show().delay(3000).fadeOut('slow');
                    $('.saveQuestionsButton').addClass('d-none'); 
                    $('.userQuesLoader').hide();
                    // $('.QuestionsKeyPTag').removeClass('hide_it');
                    if(data){
                        // $(".questionsOfUser").load(" .questionsOfUser");
                        // $(".SaveQuestionsSpinner").remove();
                       
                }
            }
        });
    });

//  ======================================= Employer Questions Ajax End  =======================================




</script>
@stop

