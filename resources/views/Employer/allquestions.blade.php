@extends('Employer.layouts.app')
@section('title', 'All Questions')
@section('content')
<!-- ======================= Page Title ===================== -->
		<div class="page-title">
			<div class="container">
				<div class="col-sm-7">
					<div class="page-caption">
						<h2 class="subheader-heading">Questions</h2>
					</div>
				</div>
				<div class="col-sm-5 text-right mrg-top-40">
					<a href="{{route('addquestions',[base64_encode($questionnaire_id),0])}}" class="btn btn-m theme-btn">Add New</a>
				</div>
			</div>
		</div>
		<!-- ======================= End Page Title ===================== -->
		
		<!-- ======================== Manage Job ========================= -->
		<section>
			<div class="container">
				<div class="row">
					
					
					
				</div>
				<div class="table-responsive box"> 
					<table class="table table-lg table-hover">
						<thead>
							<tr>
								<th>Question</th>
								<th>Options</th>
								<th>Marks</th>
								<th>Required</th>
								<th>Suffle</th>
								<th>Action</th>
							</tr>
						</thead>
						
						<tbody>
						@if($results)
							@foreach($results as $rec)
							<tr>
								<td>
									{{$rec->question}}
								</td>            
								<td>{{$rec->options}}</td>
								<td>{{$rec->marks}}</td>
								<td>@if($rec->is_required==1) Yes @else No @endif</td>
								<td>@if($rec->is_suffle==1) Yes @else No @endif</td>
								<td>
								<a href="{{route('addquestions',[base64_encode($questionnaire_id),$rec->id])}}" class="cl-success mrg-5" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit"></i></a>
								<a href="{{route('deletequestions',[base64_encode($questionnaire_id),$rec->id])}}" class="cl-danger mrg-5" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
								</td>  
							</tr>
							@endforeach
					  	@endif
							
							
							
						</tbody>
					</table>
					
					<!-- flexbox -->
					<div class="flexbox padd-10">
						{!! $results->render() !!}
						<!-- <ul class="pagination">
							<li class="page-item">
							  <a class="page-link" href="#" aria-label="Previous">
								<span aria-hidden="true">«</span>
								<span class="sr-only">Previous</span>
							  </a>
							</li>
							<li class="page-item active"><a class="page-link" href="#">1</a></li>
							<li class="page-item"><a class="page-link" href="#">2</a></li>
							<li class="page-item"><a class="page-link" href="#">3</a></li>
							<li class="page-item">
							  <a class="page-link" href="#" aria-label="Next">
								<span aria-hidden="true">»</span>
								<span class="sr-only">Next</span>
							  </a>
							</li>
						</ul> -->
					</div>
					<!-- /.flexbox -->
			
				</div>
				
			</div>
		</section>
		
		<!-- ====================== End Manage Company ================ -->

@endsection
@section('page-footer')
@endsection