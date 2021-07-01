<div id="step-1" class="hide1">
	<div class="registerForm container h-100">

		<div class="formTitle text-white text-center">Create New Account</div>

		<div class="formBox mb-4">
			<form name="frm_date" method="post" autocomplete="off" class="text-center needs-validation" novalidate>
				@csrf
				<!-- First Name -->
				<div class="md-form bgShad">
					<input type="text" name="firstname" id="field_firstname" class="form-control" required>
					<label for="field_firstname">First Name</label>
					<div class="invalid-feedback">Please choose first name.</div>
				</div>

				<!-- Last Name -->
				<div class="md-form bgShad">
					<input type="text" name="surname" id="field_surname" class="form-control">
					<label for="field_surname">Surname</label>
					<div class="invalid-feedback">Please choose a surname.</div>
				</div>


				<div class="md-form bgShad">
					{{-- <input type="text" name="surname" id="field_surname" class="form-control"> --}}
					{{-- <label for="field_surname">Title</label> --}}
					{{-- <div class="invalid-feedback">Please choose a surname.</div> --}}\

					<select class="form-control" name="title"> 
						<option value="Mr" class=" text-dark">Mr</option>
						<option value="Ms" class=" text-dark">Ms</option>
						<option value="Miss" class=" text-dark">Miss</option>
						<option value="Mrs" class=" text-dark">Mrs</option>
					</select>
				</div>



				<!-- Last Name -->
				{{-- bl_location --}}
				{{-- <div class="md-form bgShad">

				<input type="text" class="form-control" name="location_search" id="location_search" placeholder="Type a location">
				<div class="input-group-append">
					<button id="location_search_load" class="btn btn-outline-secondary location_search_btn waves-effect waves-light btn-sm " type="button">Search</button>
				</div>
				<label for="location_search">Location</label>

				<div class="location_latlong d-none w100">
					<input type="text" class="location_lat w50 fl_left" name="location_lat" id="location_lat" value="" placeholder="Lat" readonly="true" aria-invalid="false">
					<input type="text" class="location_long w50 fl_left" name="location_long" id="location_long" value="" placeholder="Long" readonly="true" aria-invalid="false">

					<input type="hidden" name="location_name" id="location_name"  value="">
					<input type="hidden" name="location_city" id="location_city"  value="">
					<input type="hidden" name="location_state" id="location_state"  value="">
					<input type="hidden" name="location_country" id="location_country"  value="">
				</div>
				</div> --}}
				{{-- bl_location --}}


				<!-- Email -->
				<div class="md-form bgShad">
					<input type="email" name="email" id="field_email" class="form-control" required/>
					<label for="field_email" data-error="wrong" data-success="right">E-mail</label>
					<div class="invalid-feedback">Please choose an email.</div>
					<div id="email_error" class="invalid-feedback d-none"></div>
				</div>

				<!-- Mobile -->
				<div class="md-form bgShad">
					<input type="text" name="phone" id="field_phone" class="form-control" required>
					<label for="field_phone">Mobile Number</label>
					<div class="invalid-feedback">Please choose a phone number.</div>
					<div id="phone_error" class="invalid-feedback d-none"></div>
				</div>

				<!-- UserName -->
				<div class="md-form bgShad">
					<input type="text" name="username" id="field_username" class="form-control" required>
					<label for="field_username">Username</label>
					<div class="invalid-feedback">Please choose a username.</div>
					<div id="username_error" class="invalid-feedback d-none"></div>
				</div>

				<!-- Password -->
				<div class="md-form bgShad">
					<input type="password" name="password" id="field_password" class="form-control" required>
					<label for="field_password">Password</label>
					<div class="invalid-feedback">Please choose a password.</div>
					<div id="password_error" class="invalid-feedback d-none">&nbsp;</div>
				</div>

				<!-- Password_confirmation -->
				<div class="md-form bgShad">
					<input type="password" name="password_confirmation" id="field_password_confirmation" class="form-control" required>
					<label for="field_password_confirmation">Confirm password</label>
					<div class="invalid-feedback">Please choose a password.</div>
					<div id="password_confirmation_error" class="invalid-feedback d-none">&nbsp;</div>
				</div>

				<!-- Terms and Privacy -->
				<div class="md-form">
					<div class="form-check">
						<input type="checkbox" name="privacy_policy" class="form-check-input" id="field_privacy_policy" required>
						<label class="form-check-label" for="field_privacy_policy">I agree to the Terms and Privacy Policy and confirm I am at least 18 years of age </label>
						<div class="invalid-feedback">You must agree before submitting.</div>
					</div>
				</div>

				<!-- Submit button -->
				<div class="md-form">
					<div class="clearfix"></div>
					<button id="frm_register_submit" type="submit" class="btn btn-primary btn-primary2 w-50" disabled>Next</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div id="success-step-1" class="hide"></div>
