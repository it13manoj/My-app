@extends('Employer.layouts.app')
@section('title', 'My Interview')
@section('content')
<div class="page-title">
			<div class="container">
				<div class="page-caption">
					<h2 class="subheader-heading">My Interview</h2>
				</div>
			</div>
		</div>
		<!-- ======================= End Page Title ===================== -->
		
		<!-- ======================== Manage Job ========================= -->
		<section>

			<div class="container">
				<div class="row">
						<div class="flash-message">
						 @if ($message = Session::get('success'))
							<div class="alert alert-success alert-block">
								<button type="button" class="close" data-dismiss="alert">×</button>	
							        <strong>{{ $message }}</strong>
							</div>
							@endif
						</div>
					<form method="get" action="">
						<div class="col-md-6 col-sm-12">
							Showing {{ $results->firstItem() }}-{{ $results->lastItem() }} of {{$results->total()}} results
						</div>
						<div class="col-sm-6">
							<div class="col-md-12 padd-l-0">
								<div class="col-md-8 col-sm-12">
									<div class="field_w_search">
	                                    <input type="text" class="form-control" name="search" value="{{$search}}" placeholder="Search Venue">
	                                </div>
								</div>
								
			                    
			                    <div class="col-md-2 col-sm-12">
			                    	<button type="submit" class="btn apply-job-btn  btn-radius">Submit </button>
			                    </div>
			                    @if($search!='')
			                    <div class="col-md-2 col-sm-12">
			                    	<a href="{{route('myInterview')}}" class="btn btn-danger apply-job-btn  btn-radius">Reset </a>
			                    </div>
			                    @endif
							</div>
							 
		                </div>
					</form>
					
					
				</div>
				<div class="table-responsive box"> 
					@if(sizeof($results)>0)
					<table class="table table-lg table-hover">
						<thead>
							<tr>
								<th>Name</th>
								<th>Email</th>
								<th>Job Title</th>
								<th>Interview Date</th>
								<th>Action</th>
							</tr>
						</thead>
						
						<tbody>
						
							
							@foreach($results as $rec)
							<tr>
								<td>{{$rec->user_first_name}} {{$rec->user_last_name}}</td>
								<td>{{$rec->email}}</td>
								<td>{{$rec->job_title}}</td>
								<td>{{date('M d,Y',strtotime($rec->interview_date))}} {{$rec->interview_time}}</td>
								<td>
								<!-- <a href="#" class="cl-success mrg-5" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit"></i></a> -->
								<a href="{{route('cancelInterview',[base64_encode($rec->id)])}}" class="cl-danger mrg-5" data-toggle="tooltip" data-original-title="Cancel Interview"><i class="fa fa-trash-o"></i></a>
								</td>  
							</tr>
							@endforeach
							
							
							
						</tbody>
						
					</table>
					@else
							<h4>No Intervie Found</h4>
							@endif
					
					<!-- flexbox -->
					<div class="flexbox padd-10">
						{!! $results->render() !!}
					</div>
					<!-- /.flexbox -->
			
				</div>
				
			</div>
		</section>

@endsection
@section('page-footer')
@endsection