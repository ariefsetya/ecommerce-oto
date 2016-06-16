@extends('app')

@section('body')
<section>
			<div id="page-wrapper" class="sign-in-wrapper">
				<div class="graphs">
					<div class="sign-in-form">
						<div class="">
							<h1>Log in</h1>
						</div>
						<hr>
						<form>
							<div class="log-input">
								<div class="">
								   <input type="text" class="user" value="Your Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Your Email';}">
								</div>
							</div>
							<div class="log-input">
								<div class="">
								   <input type="password" class="lock" value="password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email address:';}">
								</div>
							</div>
							<div class="signin-rit text-right">
								Forgot Password? <a href="#">Click Here</a>
							</div>
							<hr>
							<input type="submit" value="Log in">
						</form>	 
						<div class="new_people">
							<h2>For New People</h2>
							<p>Having hands on experience in creating innovative designs,I do offer design 
								solutions which harness.</p>
							<a href="register.html">Register Now!</a>
						</div>
					</div>
				</div>
			</div>
		<!--footer section start-->
			<footer class="diff">
			   <p class="text-center">© 2016 Resale. All Rights Reserved | Design by <a href="https://w3layouts.com/" target="_blank">w3layouts.</a></p>
			</footer>
        <!--footer section end-->
	</section>
@endsection
