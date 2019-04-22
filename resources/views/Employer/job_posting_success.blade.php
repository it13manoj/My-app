@extends('Employer.layouts.app')
@section('title', 'Employer Dashboard')
@section('content')
<!-- ======================= Start Page content ===================== -->
			<section>
				<div class="container">
					<div class="error-page padd-top-60 padd-bot-30">
						<img src="{{asset('home_assets/img/job-post-successful.png')}}">
						
						<h2 class="mrg-top-10 mrg-bot-5 cl-primary funky-font font-60">Thank you for submitting</h2>
						<p>Thank you for submitting, your job has been published. If you need help please contact us via email contact@naukriyan.com </p>
						<a href="{{url('employer/home')}}" class="btn theme-btn mrg-top-20">Go To Dashboard</a>
					</div>
				</div>
			</section>
		<!-- ======================= End Page content ===================== -->
@endsection
@section('page-footer')
@endsection