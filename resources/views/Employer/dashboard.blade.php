@extends('Employer.layouts.app')
@section('title', 'Employer Dashboard')
@section('content')

	<!-- ======================= Start Page Title ===================== -->
		 <div class="page-title">
			<div class="container">
				<div class="col-sm-12">
					<div class="page-caption">
						<h2 class="subheader-heading">Dashboard</h2>
						<!-- <p><a href="#" title="Home">Home</a> <i class="ti-arrow-right"></i> Resume Detail</p> -->
					</div>
				</div>
			</div>
		</div> 
		<!-- ======================= End Page Title ===================== -->
		
		

		<!-- ====================== Resume Detail ================ -->
		<section >
			<div class="container">
				<!-- row -->
				<div class="row">
					
					<div class="col-md-9 col-sm-8">
						<div class="">
							<div class="col-md-4 col-sm-6">
								<div class="card horizontal cardIcon waves-effect waves-dark">
									<div class="card-image bg-red">
										<i class="icon-document ti"></i>
									</div>
									<div class="card-stacked bg-red">
										<div class="card-content">
											<h3 class="text-white">{{$activejobs}}</h3> 
										</div>
										<div class="card-action">
											<span class="text-white">Active Jobs</span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-4 col-sm-6">
								<div class="card horizontal cardIcon waves-effect waves-dark">
									<div class="card-image bg-blue">
										<i class="ti-check ti"></i>
									</div>
									<div class="card-stacked bg-blue">
										<div class="card-content">
											<h3 class="text-white">{{$jobs}}</h3> 
										</div>
										<div class="card-action">
											<span class="text-white">Post Job</span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-4 col-sm-6">
								<div class="card horizontal cardIcon waves-effect waves-dark">
									<div class="card-image bg-orange">
										<i class="ti-eye ti"></i>
									</div>
									<div class="card-stacked bg-orange">
										<div class="card-content">
											<h3 class="text-white">{{$applicationsv}}</h3> 
										</div>
										<div class="card-action">
											<span class="text-white">Resume Viewed</span>
										</div>
									</div>
								</div>
							</div>
							
							<!-- <div class="col-md-4 col-sm-6">
								<div class="card horizontal cardIcon waves-effect waves-dark">
									<div class="card-image bg-green">
										<i class="ti-download ti"></i>
									</div>
									<div class="card-stacked bg-green">
										<div class="card-content">
											<h3 class="text-white">18</h3> 
										</div>
										<div class="card-action">
											<span class="text-white">Resume Download</span>
										</div>
									</div>
								</div>								
							</div> -->
							<div class="col-md-4 col-sm-6">
								<div class="card horizontal cardIcon waves-effect waves-dark">
									<div class="card-image bg-purple">
										<i class="icon-calendar ti"></i>
									</div>
									<div class="card-stacked bg-purple">
										<div class="card-content">
											<h3 class="text-white">{{$applicationsI}}</h3> 
										</div>
										<div class="card-action">
											<span class="text-white">Scheduled Interviews</span>
										</div>
									</div>
								</div>	
							</div>
							<!-- <div class="col-md-4 col-sm-6">
								<div class="card horizontal cardIcon waves-effect waves-dark">
									<div class="card-image bg-sea-green">
										<i class="icon-flag ti"></i>
									</div>
									<div class="card-stacked bg-sea-green">
										<div class="card-content">
											<h3 class="text-white">18</h3> 
										</div>
										<div class="card-action">
											<span class="text-white">Follow Companies</span>
										</div>
									</div>
								</div>	
							</div> -->
							<!-- <div class="col-md-4 col-sm-6">
								<div class="card horizontal cardIcon waves-effect waves-dark">
									<div class="card-image bg-coral" style="">
										<i class="icon-heart ti"></i>
									</div>
									<div class="card-stacked  bg-coral " >
										<div class="card-content">
											<h3 class="text-white">25</h3> 
										</div>
										<div class="card-action">
											<span class="text-white">Job Saved</span>
										</div>
									</div>
								</div>	
							</div> -->
							<!-- <div class="col-md-4 col-sm-6">
								<div class="card horizontal cardIcon waves-effect waves-dark">
									<div class="card-image bg-peru" >
										<i class="icon-envelope ti"></i>
									</div>
									<div class="card-stacked bg-peru">
										<div class="card-content">
											<h3 class="text-white">8</h3> 
										</div>
										<div class="card-action">
											<span class="text-white">Recruiter Message</span>
										</div>
									</div>
								</div>	
							</div> -->
							<div class="col-md-4 col-sm-6">
								<div class="card horizontal cardIcon waves-effect waves-dark">
									<div class="card-image bg-pink">
										<i class="icon-flag ti"></i>
									</div>
									<div class="card-stacked bg-pink" >
										<div class="card-content">
											<h3 class="text-white">Basic</h3> 
										</div>
										<div class="card-action">
											<span class="text-white">Subscriptions</span>
										</div>
									</div>
								</div>	
							</div>
						</div>
						
					</div>
					<!-- Sidebar -->
					<div class="col-md-3 col-sm-4">
						@if($adverts)
						@php $i=0@endphp
						@foreach($adverts as $adv)
						<div @if($i>0) style="margin-top: 5px;" @endif class="sidebar">
							<a href="{{$adv->adv_link}}" target="_blank">
							<div class="">
								<img class="ads" src="{{asset('admin_assets/uploaded_images/adv_pic')}}/{{$adv->adv_image}}">
							</div>
						</a>
						</div>
						@php $i++@endphp
						@endforeach
						@endif
					</div>
					<!-- End Sidebar -->
					
					
				</div>
				<!-- End Row -->
				
			</div>
		</section>
		
		<!-- ====================== End Resume Detail ================ -->
@endsection
@section('page-footer')
@endsection