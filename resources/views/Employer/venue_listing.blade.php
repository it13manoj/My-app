 @extends('Employer.layouts.app')
@section('title', 'Venues')
@section('content')
<!-- ======================= Page Title ===================== -->
		<div class="page-title">
			<div class="container">
				<div class="col-sm-7">
					<div class="page-caption">
						<h2 class="subheader-heading">Manage Interview Location</h2>
					</div>
				</div>
				<div class="col-sm-5 text-right mrg-top-40">
					<a href="{{route('add_venues')}}" class="btn btn-m theme-btn">Add New</a>
				</div>
			</div>
		</div>
		<!-- ======================= End Page Title ===================== -->
		
		<!-- ======================== Manage Job ========================= -->
		<section>
			<div class="container">
				<div class="row">

					<form>
						<div class="col-md-5 col-sm-12">
							Showing {{ $venues->firstItem() }}-{{ $venues->lastItem() }} of {{$venues->total()}} results
						</div>
						<div class="col-sm-7">
							<div class="col-md-12 padd-l-0">
								<div class="col-md-6 col-sm-12">
									<div class="field_w_search">
	                                    <input type="text" name="search" value="{{$search}}" class="form-control" placeholder="Search Venue">
	                                </div>
								</div>
								
			                    
			                    <div class="col-md-2 col-sm-12">
			                    	<button class="btn apply-job-btn  btn-radius">Submit </button>
			                    </div>
			                    @if($search!='')
			                    <div class="col-md-2 col-sm-12">
			                    	<a style="font-size: 15px;height: 36px;padding:7px 15px;" href="{{route('venues')}}" class="btn btn-primary btn-radius">Reset</a>
			                    </div>
			                    @endif
			                    
							</div>
							 
		                </div>
					</form>
					
					
				</div>
				<div class="table-responsive"> 
					<table class="table table-lg table-hover">
						<thead>
							<tr>
								<th>Venue</th>
								<th>Address</th>
								<th>Contact Person</th>
								<th>Email</th>
								<th>Contact number</th>
								<th>Action</th>
							</tr>
						</thead>
						
						<tbody>
						@if($venues)
						@php $i=1; @endphp
						@foreach($venues as $venue)
							<tr>
								<td>{{$venue->venue_name}}</td>            
								<td> {{$venue->venue_address}}</td>
								<td>{{$venue->contact_person}}</td>
								<td>{{$venue->contact_email}}</td>
								<td>{{$venue->contact_no}}</td>
								
								<td>
								<a href="{{route('edit_venue',[base64_encode($venue->venue_id)])}}" class="cl-success mrg-5" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit"></i></a>
								@if($venue->venue_status==0)
								<a href="{{route('change_status_of_venue',[base64_encode($venue->venue_id),$venue->venue_status])}}" class="cl-danger mrg-5" data-toggle="tooltip" data-original-title="Inactive">Inactive</a>
								@else
								<a href="{{route('change_status_of_venue',[base64_encode($venue->venue_id),$venue->venue_status])}}" class="cl-success mrg-5" data-toggle="tooltip" data-original-title="Active">Active</a>
								@endif
								</td>  
							</tr>
							@endforeach
						@endif
						</tbody>
					</table>
					
					<!-- flexbox -->
					<div class="flexbox padd-10">
						{!! $venues->render() !!}
					</div>
					<!-- /.flexbox -->
			
				</div>
				
			</div>
		</section>
@endsection
@section('page-footer')
@endsection
		