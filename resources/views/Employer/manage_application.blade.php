@extends('Employer.layouts.app')
@section('title', 'Manage Applications')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
	<!-- ======================= Page Title ===================== -->
		<div class="page-title">
			<div class="container">
				<div class="page-caption">
					<div class="row">
						<div class="col-md-7 col-sm-12">
							<h2 class="subheader-heading">{{$jobdetails->job_title}}</h2>
							<p><span class="job_location" >{{$jobdetails->job_address}}</span> | <span>{{$jobdetails->job_experience}} Year</span></p>
						</div>
						<div class="col-sm-5 text-right mrg-top-40">
			               <!-- <button type="submit" class="btn btn-m theme-btn-outlined">Upgrade Job</button> -->
			               <div  class="job_action dropdown">
			                        <a class="dropdown-toggle " data-toggle="dropdown" href="#"><i class="fa fa-ellipsis-v"></i></a>
			                        <ul class="dropdown-menu">
			                           <li><a href="{{url('employer/editjob')}}/{{base64_encode($jobdetails->job_id)}}">Edit Job</a></li>
			                           <!-- <li><a href="resume-detail.html">Deactive Job</a></li>
			                           <li><a href="edit-resume.html">Refresh Job</a></li> -->
			                        </ul>
			                     </div>
			            </div>
						
					</div>
				</div>
			</div>
		</div>
		<!-- ======================= End Page Title ===================== -->
		
		<!-- ======================== Manage Job ========================= -->
		<section id="app">
			<application-component></application-component>
			
		</section>
		 
		<!-- ====================== End Manage Company ================ -->
@endsection
@section('page-footer')
<script type="text/javascript">
	window.Laravel = <?php echo json_encode([
                          'csrfToken' => csrf_token(),
                          'baseUrl'=>url('/')
                      ]); ?>   
</script>

<script src="{{ mix('js/app.js') }}"></script>

@endsection