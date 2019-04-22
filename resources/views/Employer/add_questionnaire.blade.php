 @extends('Employer.layouts.app')
@section('title', 'Post Job')
@section('content')
@if($results)
	@php 
	$questionnaire_title=$results->questionnaire_title;
	$questionnaire_id=$results->questionnaire_id;
	$submission_days=$results->submission_days;
	$accept_late_submission=$results->accept_late_submission;
	$suffle_questions=$results->suffle_questions;
	@endphp
@else
	@php 
	$questionnaire_title='';
	$questionnaire_id=0;
	$submission_days='';
	$accept_late_submission='';
	$suffle_questions='';
	@endphp
@endif
<!-- ======================= Page Title ===================== -->
		<div class="page-title">
			<div class="container">
				<div class="">
					<div class="page-caption">
						<h2 class="subheader-heading">Add New Questionnaires</h2>
					</div>
				</div>
				
			</div>
		</div>
		<!-- ======================= End Page Title ===================== -->
		
		<!-- ======================== Manage Job ========================= -->
		<section>
			<div class="container">
				
				<form method="post" action="{{route('add_questionnaire.submit')}}">
					{{csrf_field()}}
					<div class="row box">
						<div class="box-body">
						<div class="col-sm-12">
							<label>Questionnaire Title <span>*</span></label>
							<input type="text" name="questionnaire_title" value="{{$questionnaire_title}}" class="form-control">
							<input type="hidden" name="questionnaire_id" value="{{$questionnaire_id}}">
						</div>
						<!-- <div class="col-sm-6">
							<label>Type <span>*</span></label>
							<select class="wide form-control">
	                            <option data-display="Type">Select</option>
	                            <option value="2">Test</option>
	                            <option value="2">Quiz</option>
	                         </select>
						</div> -->
						<div class="col-sm-6">
							<label>Submission Days <span>*</span></label>
							<input type="number" name="submission_days" value="{{$submission_days}}" class="form-control">
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<span class="custom-checkbox">
									<input type="checkbox" @if($accept_late_submission==1) checked="checked" @endif id="late_submission" name="accept_late_submission" value="1">
									<label for="late_submission"></label>Accept Late Submission
								</span>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<span class="custom-checkbox">
									<input type="checkbox" @if($suffle_questions==1) checked="checked" @endif name="suffle_questions" value="1" id="shuffle_questions">
									<label for="shuffle_questions"></label>Shuffle Questions
								</span>
							</div>
						</div>
					</div>
				</div>
				
				
				<div class="text-right">
                  <a href="{{route('questionnaire')}}" class="btn btn-m light-gray-btn"> Back </a>
                  <input type="submit" class="btn btn-m theme-btn" value="Save">
                </div>
                </form>
			</div>
		</section>
		
		<!-- ====================== End Manage Company ================ -->
@endsection
@section('page-footer')
@endsection