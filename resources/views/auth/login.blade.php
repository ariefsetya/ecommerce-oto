@extends('app')

@section('body')
<form method="POST">
<section>
	<div id="page-wrapper" class="sign-in-wrapper">
		<div class="graphs">
			<div class="sign-in-form">
				<div class="">
					<h1>Log in</h1>
				</div>
				<hr>
					<div class="log-input">
						<div class="">
						   <input type="text" name="email" class="user" placeholder="Your Email">
						   <input type="hidden" name="_token" value="{{csrf_token()}}" class="user" placeholder="Your Email">
						</div>
					</div>
					<div class="log-input">
						<div class="">
						   <input type="password" name="password" class="lock" placeholder="password">
						</div>
					</div>
					<div class="signin-rit text-right">
						Forgot Password? <a href="#">Click Here</a>
					</div>
					<hr>
					<input type="submit" value="Log in">
				<div class="new_people">
					<h2>For New People</h2>
					<p></p>
					<a href="{{url('auth/register')}}">Register Now!</a>
				</div>
			</div>
		</div>
	</div>
</section>
</form>	 
@endsection
