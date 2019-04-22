@extends('Employer.layouts.app')
@section('title', 'Jobseeker Profile')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
	<!-- ======================= Page Title ===================== -->
		
		<!-- ======================= End Page Title ===================== -->
		
		<!-- ======================== Manage Job ========================= -->
		<section id="app">
			<jobseekerprofile-component></jobseekerprofile-component>
			
		</section>
		 
		<!-- ====================== End Manage Company ================ -->
@endsection
@section('page-footer')
<script type="text/javascript">
	window.Laravel = <?php echo json_encode([
                          'csrfToken' => csrf_token(),
                          'baseUrl'=>url('/'),
                          'user_id'=>$userdetails->id
                      ]); ?>   
</script>

<script src="{{ mix('js/app.js') }}"></script>

@endsection