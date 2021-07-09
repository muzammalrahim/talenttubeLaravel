
<div class="salarySection"><b>Expecting Salary: </b>

  <div class="spinner-border spinner-border-sm text-primary salaryLoader ml-2" role="status" style="display:none;"></div>
  <i class="fas fa-edit float-right salarySecButton"></i> 
  <p class="oldSalary my-1"> <b>{{'AUD: '}}</b><span  class="salaryRangeValue">{{number_format($user->salaryRange),3}}</span>  </p>
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
            $('.salaryRangeValue').text(salaryRangeField);

          }
        }

      });

});


</script>