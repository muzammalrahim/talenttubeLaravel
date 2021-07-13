

@php
  $salary = '';
  if ($user->salaryRange == '50000') {
    $salary = '50,000 to 60,000';
  }

    elseif($user->salaryRange == '60000')
    {
      $salary = '60,000 to 70,000';
    }

    elseif($user->salaryRange == '70000')
    {
       $salary = '70,000 to 80,000';
    }

     elseif($user->salaryRange == '80000')
     {
       $salary = '80,000 to 90,000';
     }

     elseif($user->salaryRange == '90000')
     {
       $salary = '90,000 to 100,000';
     }

     elseif($user->salaryRange == '100000')
     {
       $salary = '100,000 to 120,000';
     }

     elseif($user->salaryRange == '120000')
     {
       $salary = '120,000 to 150,000';
     }

     else{
      $salary = '150,000 +' ;
     }




        // '70000' => '70,000 to 80000',
        // '' => '80,000 to 90000',
        // '90000' => '90,000 to 100000',
        // '100000' => '100,000 to 120000',
        // '120000' => '120,000 to 150000',
        // '150000' => '150,000 + ',



@endphp

<div class="salarySection"><b>Expecting Salary: </b>

  <div class="spinner-border spinner-border-sm text-primary salaryLoader ml-2" role="status" style="display:none;"></div>
  <i class="fas fa-edit float-right salarySecButton"></i> 
  <p class="oldSalary my-1"> <b>{{'AUD: '}}</b><span  class="salaryRangeValue">{{$salary}}</span>  </p>
</div>

<div class="newSalary my-2 d-none">
  {{ Form::select('salaryRange', $salaryRange, $user->salaryRange, 
  ['placeholder' => 'Select Salary Range', 'id' => 'salaryRangeFieldnew',  'class' => 'form-control custom-select']) }}
</div>

<div class="alert alert-success salaryAlert" role="alert" style="display:none;">
  <strong>Success!</strong> Salary updated successfully!
</div>


<script type="text/javascript">


// ========================================================= Edit Salary Range =========================================================

$('.salarySecButton').click(function(){
  $('.oldSalary').addClass('d-none');
  $('.newSalary').removeClass('d-none');
});

$(document).on('change' , '#salaryRangeFieldnew' , function(){

  var salaryRangeField = $('#salaryRangeFieldnew option:selected').val();
  console.log(salaryRangeField);
  $('.salaryLoader').show(); 

    $.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
      $.ajax({

        type: 'POST',
        url: base_url+'/m/ajax/MupdateSalaryRange',
        data: {'salaryRange': salaryRangeField},
        success: function(data){
          if(data.status == 1){
            $('.salaryLoader').hide(); 
            // $('.salaryRangeField').addClass('hide_it');
            $('.salaryAlert').show().delay(3000).fadeOut('slow');
            $('.oldSalary').removeClass('d-none');
            $('.newSalary').addClass('d-none');
            // console.log(salaryRangeField);
            if (salaryRangeField == '50000') {
              $('.salaryRangeValue').text('50,000 to 60,000');
            }
            else if(salaryRangeField == '60000'){
              $('.salaryRangeValue').text('60,000 to 70,000');

            }

            else if(salaryRangeField == '70000'){
              $('.salaryRangeValue').text('70,000 to 80,000');

            }
            else if(salaryRangeField == '80000'){
              $('.salaryRangeValue').text('80,000 to 90,000');

            }

            else if(salaryRangeField == '90000'){
              $('.salaryRangeValue').text('90,000 to 100,000');

            }

            else if(salaryRangeField == '100000'){
              $('.salaryRangeValue').text('100,000 to 120,000');

            }
            else if(salaryRangeField == '120000'){
              $('.salaryRangeValue').text('120,000 to 150,000');

            }
            else{
              $('.salaryRangeValue').text(salaryRangeField + ' ' + '+');

            }


          }
        }

      });

});


</script>