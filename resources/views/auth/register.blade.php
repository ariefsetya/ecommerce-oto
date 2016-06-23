@extends('app')

@section('body')
<form method="POST" action="">
	<div id="page-wrapper" class="sign-in-wrapper">
		<div class="graphs">
			<div class="sign-up">
				<h1>Create an account</h1>
				<p class="creating"></p>
				<h2>Personal Information</h2>
				<div class="sign-u">
					<div class="sign-up1">
						<h4>Name</h4>
					</div>
					<div class="sign-up2">
							<input type="text" placeholder=" " required name="name">
							<input type="hidden" name="_token" value="{{csrf_token()}}" placeholder=" " required>
					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="sign-u">
					<div class="sign-up1">
						<h4>Email Address</h4>
					</div>
					<div class="sign-up2">
							<input type="text" name="email" placeholder=" " required>
					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="sign-u">
					<div class="sign-up1">
						<h4>Password</h4>
					</div>
					<div class="sign-up2">
							<input type="password" name="password" placeholder=" " required>
					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="sub_home">
					<div class="sub_home_left">
							<input type="submit" value="Create">
					</div>
					<div class="sub_home_right">
						<p>Go Back to <a href="{{url()}}">Home</a></p>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>
		</div>
	</div>
</form>
@endsection
