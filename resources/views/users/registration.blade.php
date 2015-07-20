@extends($layout)
@section('stylesheets')
<link href='http://fonts.googleapis.com/css?family=Bree+Serif' rel='stylesheet' type='text/css'>
{!! Html::style('assets/css/users/registration.css') !!}
@stop
@section('scripts')
<script src="assets/js/users/registration.js"></script>
@stop

@section('content')
<div id="main-frame" class="col-md-7">
	{!! Form::open(array('action' => 'UsersController@postRegistration','id'=>'reg-form', 'class'=>'','role'=>"form")) !!}
	<div class="form-frame col-md-12">
		<div class="input-section  step1">
			<h3 class="form-title">Basic Information</h3>
			<div class="form-single">
				<input type="text" class="form-style col-md-4 first_name" name="first_name" placeholder="First name *" id="first_name" aria-describedby="sizing-addon2">
				<div class="error-first_name hide error"></div>
			</div>
			<div class="form-single">
				<input type="text" class="form-style col-md-5 last_name" name="last_name" id="last_name" placeholder="Last name *" aria-describedby="sizing-addon2">
				<div class="error-last_name hide error"></div>
			</div>
			<div class="form-single">
				<select class="form-style col-md-2 age" name="age" id="age">
					<option >Age</option>
					<option value="1">Below 18</option>
					<option value="2">18 or older</option>
				</select>
				<div class="error-age hide error"></div>
			</div>
			<input type="text" class="form-style col-md-12 top-margin rows email" name="email" id="email" placeholder="Email *" aria-describedby="sizing-addon2">
			<div class="error-wrapper">
				<div class="error-email hide error"></div>
			</div>

			
			<input type="text" class="form-style col-md-12 top-margin rows company" name="company" id="company" placeholder="Company Name" aria-describedby="sizing-addon2">
		</div>

		<div class="input-section step3">
			<h3 class="form-title">Your New Account Credentials</h3>
			<input type="text" class="form-style col-md-12 username" name="username" id="username" placeholder="Username *" aria-describedby="sizing-addon2">
			<div class="error-username hide error"></div>
			<input type="password" class="form-style col-md-12 top-margin rows password" name="password" id="password" placeholder="Password" aria-describedby="sizing-addon2">
			<div class="error-password hide error"></div>
			<input type="password" class="form-style col-md-12 top-margin rows password_again"  name="password_again" id="password_again" placeholder="Re-Enter Password" aria-describedby="sizing-addon2">
			<div class="error-password-again hide error"></div>
			<a class="btn btn-primary pull-right" id="submit-btn" >Join Us</a>
		</div>
		
	</div>
	{!! Form::close() !!}
</div>

<style>

</style>


@stop