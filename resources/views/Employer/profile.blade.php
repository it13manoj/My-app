@extends('Employer.layouts.app')
@section('title', 'Employer Dashboard')
@section('content')
<!-- ======================= Page Title ===================== -->
		<div class="page-title">
			<div class="container">
				<div class="page-caption">
					<h2 class="subheader-heading">Employer Detail</h2>
				</div>
			</div>
		</div>
		<!-- ======================= End Page Title ===================== -->
		
		<!-- ================ Employer Profile ======================= -->
		<section>
			<div class="container bg-white-profile-header">
				
				<div class="col-md-2 col-sm-3">
					<div class="emp-pic">
						@if($result->user_profile_picture!='')
							<img class="img-responsive img-circle width-120" src="{{asset('admin_assets/uploaded_images/profile_pic/thumb/'.$result->user_profile_pic_thumb)}}" alt="">
						@else
							<img class="img-responsive img-circle width-120" src="{{asset('home_assets/img/avatar4.jpg')}}" alt="">
						@endif
						
					</div>
				</div>
				
				<div class="col-md-5 col-sm-4">
					<div class="emp-des">
						<h3>{{ucfirst($result->user_first_name)}} {{ucfirst($result->user_last_name)}}</h3>
						<span >{{ucfirst($result->user_designation)}} @ <span class="theme-cl">{{ucfirst($result->company_name)}}</span></span>
						<p><span><i class="fa fa-envelope-o"></i> {{$result->email}}</span>
						<span><i class="ti-mobile"></i> {{$result->user_contact}}</span></p>
						
						<!-- <p>MT-587, Near Bue Market Qch52,<br>New York (0054785) </p> -->
					</div>
					<!-- <div class="emp-bt">
						<a href="#" class="btn theme-btn theme-btn-outlined"><i class="ti-plus"></i> Following</a> 
						<a href="#" class="btn theme-btn"><i class="ti-plus"></i> Follow</a>
					</div> -->
				</div>
				
				<div class="col-md-5 col-sm-5">
					<div class="emp-detail box margin_bottom_0">
						<div class="box-body">
							<ul>
								<li><span class="cl-danger">{{$totaljobs}}</span>Jobs</li>
								<li><span class="cl-success">{{$totalactivejobs}}</span>Active Jobs</li>
								<li><span class="cl-primary">0</span>Followers</li>
							</ul>
						</div>
					</div>
				</div>
				
			</div>
		</section>
		<!-- ================ End Employer Profile ======================= -->
		
		<!-- ================ Employers Jobs ======================= -->
		<section class="padd-top-20" id="app">
			<profile-joblisting></profile-joblisting>
		</section>

		<!-- ================ End Employers Jobs ======================= -->
@endsection
@section('page-footer')
<script type="text/javascript">
	window.Laravel = <?php echo json_encode([
                          'csrfToken' => csrf_token(),
                      ]); ?>   
</script>

<script src="{{ mix('js/app.js') }}"></script>
@endsection