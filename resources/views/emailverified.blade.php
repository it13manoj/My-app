@extends('Employer.layouts.app')
@section('title', 'Email Verified')
@section('content')
<!-- ======================= Start Page content ===================== -->
			<section>
				<div class="container">
					<div class="error-page padd-bot-30 centered">
						<img class="" src="{{asset('home_assets/img/job-post-successful.png')}}">
						
						<h2 class="mrg-top-10 mrg-bot-5 cl-primary funky-font font-60">Thank you for signing up</h2>
						<p>Thank you for signing up with us, your email has been verified successfully. If you need help please contact us via email contact@naukriyan.com </p>
						<a href="/userlogin" class="btn theme-btn mrg-top-20">Go To Sign in</a>
					</div>
				</div>
			</section>
		<!-- ======================= End Page content ===================== -->
@endsection
<!-- @section('page-footer') -->
<!-- @endsection -->