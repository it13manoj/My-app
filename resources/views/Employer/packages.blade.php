@extends('Employer.layouts.app')
@section('title', 'Packages')
@section('content')
<div class="page-title">
          <div class="container">
             <div class="page-caption">
                <div class="row">
                   <div class="col-md-7 col-sm-12">
                      <h2 class="subheader-heading">Pricing</h2>
                   </div>
                </div>
             </div>
          </div>
        </div>
		
		
		<!-- ================ Questions ======================= -->
		<section class="padd-top-20 faqs">
			<div class="container">
				<div class="row">
					@if($packages)
						@foreach($packages as $package)
					<div class="col-md-4 col-sm-4">
					<div class="package-box">
						<div class="package-header">
							<i class="fa fa-cog" aria-hidden="true"></i>
							<h3>{{$package->package_name}}</h3>
						</div>
						<div class="package-price">
							<h2><sup>Rs </sup>{{$package->package_price}}</h2>
						</div>
						<div class="package-info">
							<ul>
								<li>{{$package->package_total_jobs}} Total job </li>
								<li>{{$package->package_total_resume_download}} Resume download </li>
								<li>{{$package->package_total_resume_views}} Resume view </li>
								<li>{{$package->package_total_resume_forward}} Resume Forword</li>
								<li>{{$package->package_total_resume_search}} Resume Search</li>
								<li>{{$package->package_total_excel_export}} Excel Export</li>
								<li>{{$package->package_total_email}} Emails</li>
								<li>{{$package->package_total_sms}} SMS</li>
							</ul>
						</div>
						<a href="{{route('payments')}}"><button type="submit" class="btn btn-package" >Buy</button></a>
						<!--<a href="{{url('employer/payments/'.Auth::user()->id.'/'.$package->id)}}"><button type="submit" class="btn btn-package" >Buy</button></a>-->
					</div>
				</div>
				@endforeach
				@endif
				</div>
			</div>
		</section>

		

@endsection
@section('page-footer')
@endsection