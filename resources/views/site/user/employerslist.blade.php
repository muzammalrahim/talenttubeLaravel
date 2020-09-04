@if(isset($employers))
@if ($employers->count() > 0)
@foreach ($employers as $js)
<div class="jobSeeker_row dblock js_{{$js->id}} mb20 p20">

				<div class="jobSeeker_box relative dinline_block w100">

				<div class="js_profile w_30p w_box dblock fl_left">
								<div class="js_profile_cont center p10">
												@php
												$profile_image   = asset('images/site/icons/nophoto.jpg');
												if ($js->profileImage){
																$profile_image = asset('images/user/'.$js->id.'/gallery/'.$js->profileImage->image);
												}
												@endphp
												<img class="js_photo w100" id="pic_main_img" src="{{$profile_image}}">
								</div>
								<div class="js_info center">
												<div class="js_name"><h4 class="bold">{{$js->name}} {{$js->surname}}</h4></div>
												{{-- <div class="js_status_label">{{$js->statusText}}</div> --}}
												
								</div>
				</div>

				<div class="js_info w_70p w_box dblock fl_left">

						{{--   <div class="js_education js_field">
												<span class="js_label">Qualification:</span>{{implode(', ',getQualificationNames($js->qualification))}}
								</div> --}}
								<div class="js_about js_field">
												<span class="js_label">About me:</span>
												<p class="js_about_me"> {{$js->about_me}}</p>
								</div>
								<div class="js_interested js_field">
												<span class="js_label">Interested in:</span>
												<p>{{$js->interested_in}}</p>
								</div>
								<div class="js_location js_field"><span class="js_label">Location:</span>
								<p class="js_location"> {{($js->GeoCity)?($js->GeoCity->city_title):''}},  {{($js->GeoState)?($js->GeoState->state_title):''}}, {{($js->GeoCountry)?($js->GeoCountry->country_title):''}} </p>
								</div>

							

				</div>
				{{-- @dump($likeUsers) --}}
				<div class="js_actionBtn">
								<a class="graybtn jbtn" href="{{route('employerInfo', ['id' => $js->id])}}">Detail</a>
								<a class="jsBlockUserBtn graybtn jbtn" data-jsid="{{$js->id}}">Block</a>
								@if (in_array($js->id,$likeUsers))
								<a class="active graybtn jbtn" data-jsid="{{$js->id}}">Liked</a>
								@else
								<a class="jsLikeUserBtn graybtn jbtn" data-jsid="{{$js->id}}">Like</a>
								@endif
				</div>

			</div>
		</div>
@endforeach
<div class="jobseeker_pagination cpagination">{!! $employers->render() !!}</div>
@endif
@endif
