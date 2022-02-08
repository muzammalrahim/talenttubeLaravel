@php
$dist = calculate_distance($js, $user);
$ind_exp = cal_ind_exp($js,$user);
$compatibility = compatibility($js, $user); 
$user_compat = $compatibility*20;
$emp_questions = json_decode($js->questions , true);
$user_questions = json_decode($user->questions , true);
$emp_resident = '';
$user_resident = '';
if ($emp_questions != null && $user_questions != null) {
$emp_match = array_slice($emp_questions, 5, 6, true);
foreach ($emp_match as $key => $value) {
$emp_resident .= $value;
}
$user_match = array_slice($user_questions, 5, 6, true);
foreach ($user_match as $key => $value) {
$user_resident .= $value;
}
}
@endphp
@if ($emp_resident == 'no' && $user_resident == 'no')
<h4 class="text-danger bold"> No Match Potential </h4>
@else
@if ($dist < 50 && !empty($ind_exp))
<h4 class="text-green bold "> Strong Match Potential </h4>
@elseif($dist < 50 )
<h4 class="text-orange bold "> Moderate Match Potential  </h4>
@elseif(!empty($ind_exp))
<h4 class="text-orange "> Moderate Match Potential </h4>
@else
<h4 class="text-danger bold"> No Match Potential </h4>
@endif
@endif