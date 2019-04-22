 @extends('Employer.layouts.app')
@section('title', 'Post Job')
@section('content')
 <style type="text/css">
		#field {
			/*margin-bottom:20px;*/
		}
		.company{
			width: 100%;
			border-radius: 0 50px 50px 0;
			padding: 9px 15px;
		}
		.badge-info {
    color: #fff;
    background-color: #17a2b8;
}
</style>
  <link rel="stylesheet" href="http://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
<!-- ======================= Start Page Title ===================== -->
		<div class="page-title">
			<div class="container">
				<div class="page-caption">
					<h2 class="subheader-heading">Create Job</h2>
				</div>
			</div>
		</div>
		<!-- ======================= End Page Title ===================== -->
		
		<!-- ======================= Create Job ===================== -->
		<section class="create-job" id="app">
			<div class="container">
				@if(Auth::user()->user_role=='Admin')
				<form role="form" data-toggle="validator" class="c-form" method="post" action="{{route('save_user_job.submit')}}">
				@else
				<form role="form" data-toggle="validator" class="c-form" method="post" action="{{route('save_job.submit')}}">
				@endif	
				{{csrf_field()}}
					<!-- General Information -->
					<div class="box box_shadown_none">
						<div class="box-header">
							<h4>General Information</h4>
						</div>
						<div class="box-body">
							<div class="row">
								<div class="col-sm-12 padd-l-0 padd-r-0">
									@if(Auth::user()->user_role=='Admin')
									<div class="col-sm-4">
										<label class="width-100">Company <span>*</span></label>
										<select class="wide form-control" name="job_company_id" onchange="fetchusers(this.value)">
		                                    <option value="">Select</option>
		                                    @if($companies)
		                                    	@foreach($companies as $comp)
		                                    		<option value="{{$comp->company_id}}">{{$comp->company_name}}</option>
		                                    	@endforeach
		                                    @endif
		                                 </select>
		                                  <span class="error_msg" ></span>
									</div>
									<div class="col-sm-4">
										<label class="width-100">Recruiter <span>*</span></label>
										<select class="wide form-control job_user_id" name="job_user_id" id="job_user_id" onchange="fetchquestionnaire(this.value)">
		                                    <option value="">Select</option>
		                                   
		                                 </select>
		                                  <span class="error_msg" ></span>
									</div>
									@endif

									<div class="col-sm-4">
										<label>Job Title <span>*</span></label>
										<input type="text" name="job_title" class="form-control" data-error="Please enter job title" required>
										 <p class="help-block with-errors error_msg" ></p>
									</div>
								
									<div class="col-sm-4">
										<label class="width-100">Industry <span>*</span></label>
										<select class="wide form-control" name="job_category" onchange="fetchsubcategory(this.value)">
		                                    <option value="">Select</option>
		                                    @if($categories)
		                                    	@foreach($categories as $cat)
		                                    		<option value="{{$cat->category_id}}">{{$cat->category_name}}</option>
		                                    	@endforeach
		                                    @endif
		                                 </select>
		                                  <span class="error_msg" ></span>
									</div>
									<div class="col-sm-4">
										<label class="width-100">Functional Area <span>*</span></label>
										<select class="wide form-control job-sub-category" name="job_sub_category">
		                                    <option value="">Select</option>
		                                    </select>
		                                 <span class="error_msg" ></span>
									</div>
								</div>
								<div class="col-sm-12 padd-l-0 padd-r-0">
									<div class="col-sm-4 m-clear">
										<label class="width-100">Career Level <span>*</span></label>
										<select class="wide form-control" name="job_career_level">
		                                    <option value="">Select</option>
		                                    <option value="Entry Level">Entry Level</option>
		                                    <option value="Mid level">Mid level</option>
		                                    <option value="Top Level">Top Level</option>
		                                 </select>
		                                 <span class="error_msg" ></span>
									</div>
									<div class="col-sm-4 m-clear">
										<label>Role <span>*</span></label>
										<input type="text" name="job_role" class="form-control" >
										<p class="error_msg" ></p>
									</div>
									<div class="col-sm-4 m-clear">
										<label>No. Of Vacancy <span>*</span></label>
										<input type="number" min="1" name="job_vacancy" class="form-control" >
										<p class="error_msg" ></p>
									</div>
								</div>
								<div class="col-sm-12 padd-l-0 padd-r-0">
									<div class="col-sm-4 m-clear">
										<label class="width-100">Experience <span>*</span></label>
										<div class="col-md-6 padd-l-0 padd-r-0">
											<select name="job_experience" id="job_experience_min" class="job_experience wide form-control">
												<option value="">Min Experience</option>
												@for($ei=0;$ei<=30;$ei++)
												<option value="{{$ei}}">{{$ei}} Year</option>
												@endfor
											</select>
										</div>
										<div class="col-md-6 padd-r-0">
											<select class="job_experience wide form-control" name="job_experience_max" id="job_experience_max">
												<option value="">Max Experience</option>
												@for($ei=0;$ei<=30;$ei++)
												<option value="{{$ei}}">{{$ei}} Year</option>
												@endfor
											</select>
										</div>
										<span class="error_msg" ></span>
									</div>
									<div class="col-sm-4">
										<label>Apply Before <span>*</span></label>
										<input type="text" id="job_last_applying_date"  class="form-control job_last_applying_date" readonly="" name="job_last_applying_date">
										<p class="error_msg" ></p>
									</div>
									<div class="col-sm-4 m-clear">
										<label> Qualification <span>*</span></label>

										<!-- <input type="text" name="job_qualification" class="form-control" > -->
										<select  name="job_qualification[]" multiple class="education wide form-control">
                                                         <option value="High School">High School</option>
                                                         <option value="Intermediate">Intermediate</option>
                                                         <option value="Graduation Diploma">Graduation/Diploma</option>
                                                         <option value="Masters Post-Graduation">Masters/Post-Graduation</option>
                                                         <option value="Doctorate PhD">Doctorate/PhD</option>
                                                      </select>
										<p class="error_msg" ></p>
									</div>
								</div>
								<div class="col-sm-12 padd-l-0 padd-r-0">
									<div class="col-sm-4">
										<label class="width-100">Graduating Year</label>
										<div class="col-md-6 col-sm-12 padd-l-0 padd-r-0">
											<select class="job_graduation_year wide form-control" name="job_graduation_start_year" id="job_graduation_start_year">
												<option value="">Select</option>
												@for($gy=1970;$gy<=(date('Y'));$gy++)
												<option value="{{$gy}}">{{$gy}}</option>
												@endfor
											</select>
										</div>
										<div class="col-md-6 col-sm-12 padd-r-0">
											<select class="job_graduation_year wide form-control" name="job_graduation_end_year" id="job_graduation_end_year">
												<option value="">Select</option>
												@for($gy=1970;$gy<=(date('Y'));$gy++)
												<option value="{{$gy}}">{{$gy}}</option>
												@endfor
											</select>
										</div>
										<span class="error_msg" ></span>
									</div>
									<div class="col-sm-4 m-clear">
										<label class="width-100">Job Type <span>*</span></label>
										<select name="job_type" id="job_type" class="wide form-control">
											<option value="">Select</option>
											<option value="Full Time">Full Time</option>
											<option value="Part Time">Part Time</option>
											<option value="Freelancer">Freelancer</option>
											<option value="Internship">Internship</option>
										</select>
										<span class="error_msg" ></span>
									</div>
									<div class="col-sm-4 m-clear">
										<label class="width-100">Job Shift</label>
										<select name="job_shift" id="job_shift" class="wide form-control">
											<option value="">Select</option>
											<option value="Morning">Morning</option>
											<option value="Day">Day</option>
											<option value="Night">Night</option>
										</select>
										<span class="error_msg" ></span>
									</div>
								</div>
								<div class="col-sm-12 padd-l-0 padd-r-0">
									<div class="col-sm-4">
										<label class="width-100">Salary ( in Lakhs / year ) <span>*</span></label>
										<div class="row">
											<div class="col-md-6 col-sm-12   padd-r-0">
												<select id="job_offered_salary_min" class="job_offered_salary wide form-control" name="job_offered_salary_min">
													<option value="">Select</option>
													@for($os=1;$os<=200;$os++)
													<option value="{{$os}}">{{$os}} Lakh</option>
													@endfor
												</select>
											</div>
											<div class="col-md-6 col-sm-12  ">
												<select id="job_offered_salary_max" class="wide form-control job_offered_salary" name="job_offered_salary_max">
													<option value="">Select</option>
													@for($os=1;$os<=200;$os++)
													<option value="{{$os}}">{{$os}} Lakh</option>
													@endfor
												</select>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<span class="custom-checkbox">
														<input name="job_is_salary_disclosed" type="checkbox" id="job_is_salary_disclosed" value="1">
														<label for="job_is_salary_disclosed"></label>Not Disclosed
													</span>
												</div>
											</div>
										</div>	
										<span class="error_msg" > </span>
									</div>
									<div class="col-sm-8 m-clear">
										<label>Job Location <span>*</span> <span v-if="job_location2.length>0" v-for="loc in job_location2" @click="removeloc(loc)" style="cursor: pointer;"class="badge badge-info">@{{loc}} X</span></label>
										<div class="pf-field">
										<ul class="tags">
											<li class="tagAdd">  
												<input type="hidden" v-model="job_location" name="job_location">
								              	<input  @change="setlocations" type="text" class="search-field form-control" name="job_location2" id="address2" @keyup="fetchcities" list="citiesl" v-model="cityn" placeholder="Enter Location">
								              	 <datalist id="citiesl">
							                      <option v-for="city in cities">@{{city.city_name}}</option>
							                      </datalist>
											</li>
										</ul>
									</div>
										<!-- <div class="box-body">
							<div class="row">
								
								<div class="col-sm-12">
									<label>KeyWords</label>
									<div class="pf-field">
										<ul class="tags">
											<li class="tagAdd">  
								              	<input type="text" class="search-field" data-role="tagsinput">
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div> -->

										<p class="error_msg" style="clear:both" > </p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Overview -->
					
					<div class="box">
						<div class="box-header">
							<h4>Overview </h4>
						</div>
						<div class="box-body">
							<div class="row">
								
								<div class="col-sm-12">
									<label>Overview <span>*</span></label>
									<textarea name="job_description" id="job_description" class="form-control height-120 " ></textarea>
									<p class="error_msg" ></p>
								</div>
								
							</div>
						</div>
					</div>
					<!-- Responsibility -->
					<div class="box">
						<div class="box-header">
							<h4>Responsibility</h4>
						</div>
						<div class="box-body">
							<div class="row">
								
								<div class="col-sm-12">
									<label>Responsibility <span>*</span></label>
									<textarea name="job_responsibility" id="job_responsibility" class="form-control height-120 " ></textarea>
									<p class="error_msg" ></p>
								</div>
								
							</div>
						</div>
					</div>
					<!-- RRequirment -->
					<div class="box">
						<div class="box-header">
							<h4>Skills & Requirements</h4>
						</div>
						<div class="box-body">
							<div class="row">
								
								<div class="col-sm-12">
									<label>Skills & Requirements <span>*</span></label>
									<textarea name="job_skills" id="job_skills" class="form-control height-120" ></textarea>
									<p class="error_msg"></p>
								</div>
								
							</div>
						</div>
					</div>
					<!-- Rewards and Benefits -->
					<div class="box">
						<div class="box-header">
							<h4>Rewards and Benefits</h4>
						</div>
						<div class="box-body">
							<div class="row">
								
								<div class="col-sm-4">
									<div class="form-group">
										<span class="custom-checkbox">
											<input type="checkbox" name="job_benefits[]" id="Accommodation" value="Accommodation">
											<label for="Accommodation"></label>Accommodation
										</span>
									</div>
								</div>
								
								<div class="col-sm-4">
									<div class="form-group">
										<span class="custom-checkbox">
											<input type="checkbox" id="Gratuity" name="job_benefits[]" value="Gratuity">
											<label for="Gratuity"></label>Gratuity
										</span>
									</div>
								</div>
								
								<div class="col-sm-4">
									<div class="form-group">
										<span class="custom-checkbox">
											<input name="job_benefits[]" value="Health Insurance" type="checkbox" id="Health_Insurance">
											<label for="Health_Insurance"></label>Health Insurance
										</span>
									</div>
								</div>
								
								<div class="col-sm-4">
									<div class="form-group">
										<span class="custom-checkbox">
											<input name="job_benefits[]" value="Incentive Bonus" type="checkbox" id="Incentive_Bonus">
											<label for="Incentive_Bonus"></label>Incentive Bonus
										</span>
									</div>
								</div>
								
								<div class="col-sm-4">
									<div class="form-group">
										<span class="custom-checkbox">
											<input name="job_benefits[]" value="Leaves" type="checkbox" id="Leaves">
											<label for="Leaves"></label>Leaves
										</span>
									</div>
								</div>

								<div class="multi-box  col-sm-4">
									<div class="dublicat-box form-group">
										<span class="custom-checkbox">
											<input name="job_benefits[]" value="Travelling" type="checkbox" id="Travelling">
											<label for="Travelling"></label>Travelling
										</span>
									</div>
								</div>

								<div id="newrevarddiv">
									
								</div>
								<div class="col-md-12">
									<div class="text-center"><a href="javascript:void(0)" class="btn add-field theme-btn" data-toggle="modal" data-target="#addmore_rewards">Add More</a></div>
								</div>
							</div>
						</div>
					</div>

					<!-- Keywords -->
					<div class="box">
						<div class="box-header">
							<h4>KeyWords</h4>
						</div>
						<div class="box-body">
							<div class="row">
								
								<div class="col-sm-12">
									<label>KeyWords</label>
									<div class="pf-field">
										<ul class="tags">
											<li class="tagAdd">  
								              	<input name="job_keywords" type="text" class="search-field" data-role="tagsinput">
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Associate Test/Questionnaire -->
					<div class="box">
						<div class="box-header">
							<h4>Associate Test/Questionnaire</h4>
						</div>
						<div class="box-body">
							<div class="row">
								<div class="col-sm-6">
									<label>Associate Test/Questionnaire</label>
									<div class="pf-field">
										<span class="custom-checkbox">
											<input type="checkbox" onclick="performquestionnaireaction()" id="select_questionnaire" name="select_questionnaire">
											<label for="select_questionnaire"></label>Associate Test/Questionnaire
										</span>
									</div>
									
								</div>
								<DIV class="col-sm-6">
									<select disabled="disabled" id="job_questionnaire" name="job_questionnaire" class="wide form-control job_questionnaire">
										<option value="">Select Questionnaire</option>
										@if($questionnaires)
											@foreach($questionnaires as $questionnaire)
												<option value="{{$questionnaire->questionnaire_id}}">{{$questionnaire->questionnaire_title}}</option>
											@endforeach
										@endif
									</select>
									<a target="_blank" href="{{route('add_questionnaire')}}">Add New Questionnaire</a>
								</DIV>
							</div>
						</div>
					</div>

					<!-- Preference -->
					<div class="box">
						<div class="box-header">
							<h4>Preferences</h4>
						</div>
						<div class="box-body">
							<div class="row">
								<div class="col-sm-4">
									<div class="pf-field">
										<span class="custom-checkbox">
											<input type="checkbox" id="women" name="job_preference[]" value="women">
											<label for="women"></label>Women
										</span>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="pf-field">
										<span class="custom-checkbox">
											<input type="checkbox" id="differentlyAbled" name="job_preference[]" value="Differently Abled">
											<label for="differentlyAbled"></label>Differently Abled
										</span>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="pf-field">
										<span class="custom-checkbox">
											<input type="checkbox" id="retired" name="job_preference[]" value="Retired">
											<label for="retired"></label>Retired
										</span>
									</div>
								</div>
								<div id="morepreference">
									
								</div>
								<div class="col-md-12 mrg-top-20">
									<div class="text-center"><a href="javascript:void(0)" class="btn add-field theme-btn" data-toggle="modal" data-target="#addmore_preferences">Add More</a></div>
								</div>
								
								
							</div>
						</div>
					</div>

					<!-- Preference -->
					<div class="box">
						<div class="box-header">
							<h4>Job Posted as</h4>
						</div>
						<div class="box-body">
							<div class="row">
								<div class="col-sm-4">
									<label>Job Posted as</label>
									<select name="job_event" id="job_event" onchange="jobeventchange()" class="wide form-control">
										<option value="Normal">Normal</option>
										<option value="Walk-ins">Walk-ins</option>
										<option value="Job-fair">Job-fair</option>
										<!-- <option value="4">Night</option> -->
									</select>
								</div>
								
								<div class="col-sm-12 mixjob" style="display: none;">
									<!-- <label class="width-100">Date of walk-ins</label> -->
									<!-- <label class="width-100">Date of Job Fair</label> -->
									<div class="col-sm-6 padd-l-0">
										<label>To</label>
										<input type="text" id="walk-ins-to" data-lang="en" data-large-mode="true" data-min-year="{{date('Y')}}" data-id="datedropper-0" data-max-year="{{date('Y')+2}}" data-theme="my-style" class="form-control" readonly="" name="job_event_start_date" data-init-set="false">
									</div>
									<div class="col-sm-6 padd-r-0 ">
										<label>From</label>
										<input type="text" id="walk-ins-from" data-lang="en" data-large-mode="true" data-min-year="{{date('Y')}}"  data-id="datedropper-0" data-theme="my-style" class="form-control" readonly="" name="job_event_end_date" data-max-year="{{date('Y')+2}}" data-init-set="false">
									</div>
								</div>
								<!-- <div class="col-sm-12">
									<label class="width-100">Date of Job Fair</label>
									<div class="col-sm-6 padd-l-0">
										<label>To</label>
										<input type="text" id="job-fair-to" data-lang="en" data-large-mode="true" data-min-year="2017" data-max-year="2020" data-disabled-days="08/17/2017,08/18/2017" data-id="datedropper-0" data-theme="my-style" class="form-control" readonly="">
									</div>
									<div class="col-sm-6 padd-r-0">
										<label>From</label>
										<input type="text" id="job-fair-from" data-lang="en" data-large-mode="true" data-min-year="2017" data-max-year="2020" data-disabled-days="08/17/2017,08/18/2017" data-id="datedropper-0" data-theme="my-style" class="form-control" readonly="">
									</div>
								</div> -->
								<div class="col-sm-12 jobfair" style="display: none;">
									<label class="width-100">Companies Details</label>
									<div class="col-sm-4 padd-l-0">
										<label>No of Company</label>
										<input type="text" name="job_event_number_of_companies" class="form-control" >
									</div>
									<div class="col-sm-8 padd-r-0 jobfair">
										<label>Add Company Name</label>
										<input type="hidden" name="count" value="1" />
									        <div class="control-group" id="fields">
									            <div class="controls" id="profs"> 
									                <div class="input-append">
									                    <div id="field">
									                    	<div class="row" id="field1">
									                    		<div class="col-sm-10 padd-r-0">
										                    		<input class="form-control " autocomplete="off" class="input"  name="job_event_companies[]"  type="text" placeholder="Type something" />
										                    	</div>
										                    	<div class="col-sm-2 padd-l-0">
										                    		<button class="btn theme-btn add-more-company company" type="button">+</button>
										                    	</div>
									                    	</div>
									                    </div>
									                </div>
									            </div>
									        </div>
									</div>
								</div>
								<div class="col-sm-4 m-clear">
									<label>Job Category</label>
									<select name="job_p_category" class="wide form-control">
										<option value="">Select</option>
										<option value="1">Basic</option>
										<option value="2">Hot</option>
										<option value="3">Featured</option>
										<!-- <option value="4">Night</option> -->
									</select>
								</div>
								
							</div>
						</div>
					</div>
					
					<div class="text-center">
						<button type="submit" class="btn btn-m theme-btn">Submit & Exit</button>
					</div>
					
				</form>
			</div>
		</section>
		
		<!-- ====================== End Create Job ================ -->
		<!-- Add More Rewards Window Code -->
		<div class="modal fade" id="addmore_rewards" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content" id="myModalLabel1">
					<div class="modal-body">	
						<!-- Tab panels -->
						<div class="tab-content">
							<!-- Employer Panel 1-->
							<h3>Rewards and Benefits</h3>
							<hr>
							<div class="tab-pane fade in show active" id="employer" role="tabpanel">
								<form id="rewardform">
									<div class="form-group">
										<label>Add Rewards</label>
										<input type="text" id="newrevard" class="form-control" placeholder="Rewards">
									</div>
									<div class="form-group text-center">
										<button type="submit" class="btn theme-btn full-width btn-m">Add </button>
									</div>
								</form>
							</div>
							<!--/.Panel 1-->
						</div>
						<!-- Tab panels -->
					</div>
				</div>
			</div>
		</div>   
		<!-- End Add More Rewards Window Code-->
		<!-- Add More Preferences Window Code -->
		<div class="modal fade" id="addmore_preferences" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content" id="myModalLabel1">
					<div class="modal-body">	
						<!-- Tab panels -->
						<div class="tab-content">
							<!-- Employer Panel 1-->
							<h3>Preferences</h3>
							<hr>
							<div class="tab-pane fade in show active" id="employer" role="tabpanel">
								<form id="preferencesform">
									<div class="form-group">
										<label>Add Preferences</label>
										<input type="text" class="form-control" id="newpreference" placeholder="Preferences">
									</div>
									<div class="form-group text-center">
										<button type="submit" class="btn theme-btn full-width btn-m">Add </button>
									</div>
								</form>
							</div>
							<!--/.Panel 1-->
						</div>
						<!-- Tab panels -->
					</div>
				</div>
			</div>
		</div>   
		<!-- End preferences  Window Code-->
@endsection
@section('page-footer')
	<script type="text/javascript" src="{{asset('js/validator.js')}}"></script>
		<script>
		$('#myTab a').click(function (e) {
			e.preventDefault()
			$(this).tab('show')
		})
		</script>
		
		<!-- Date Dropper Script-->
		
		
		<script>
			AOS.init();
		</script>
		<script type="text/javascript">
			$(document).ready(function(){
		   $(".add-more-company").click(function(e){
		        var next = Math.floor((Math.random() * 9999) + 1);
		        var newIn = '<div class="row" id="remove' + next + '" ><div class="col-sm-10 padd-r-0"><input name="job_event_companies[]" required autocomplete="off" class="input form-control" type="text"></div><div class="col-sm-2 padd-l-0"> <button idd="remove' + next + '" class="btn btn-danger company remove-me" type="button" >-</button></div>';
		        $(".input-append").append(newIn);
		            
		    });    
		});
			$(document).on('click','.remove-me',function(e){
			             e.preventDefault();
		                var fieldNum = $(this).attr('idd');
		                $("#"+fieldNum).remove();
		            });

			/*************Fetch functional areas*************/
			//fetchsubcategory($('#user_category').val());
			 function fetchsubcategory(categoryId){
			 	$.ajax({
			    url: "{{ route('fetchsubcats') }}?category_id="+categoryId,
			    success: function(response){
			       
			        /*var obj = $.parseJSON(response);*/
			        $(".job-sub-category").html('').trigger('change');
			        console.log(categoryId);
			        $(".job-sub-category").append(response).trigger('change');
			       
			        
			    }
			   })
			 }
			 @if(Auth::user()->user_role=='Admin')
			 function fetchusers(companyId){
			 	$.ajax({
			    url: "{{ route('fetchusersofcompany') }}?company_id="+companyId,
			    success: function(response){
			        $(".job_user_id").html('').trigger('change');
			        $(".job_user_id").append(response).trigger('change');
			       
			        
			    }
			   })
			 }
			 function fetchquestionnaire(userId){
			 	$.ajax({
			    url: "{{ route('fetchquestionnaire') }}?user_id="+userId,
			    success: function(response){
			        $(".job_questionnaire").html('').trigger('change');
			        $(".job_questionnaire").append(response).trigger('change');
			       
			        
			    }
			   })
			 }
			 
			 @endif
			/*************Fetch functional aread***************/
		</script>
		<script src="http://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
		<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBnQrXrRyWtQu7EKB9Hk1S10Gc6eQuamUo&libraries=places&callback=initAutocomplete"
        async defer></script> -->
        <script src="https://cdn.jsdelivr.net/npm/vue"></script>
		<script src="https://unpkg.com/axios/dist/axios.min.js"></script> 
	      <script type="text/javascript">
	      	var app=new Vue({
	      		el:"#app",
	      		data:{
	      			cities:'',
	      			cityn:'',
	      			job_location:'',
	      			job_location2:[]
	      		},
	      		methods:
	      		{	
	      			fetchcities()
	      			{
	      				 axios
					      .get('{{route("fetchcitiesforjob")}}?city='+this.cityn)
					      .then(response => (this.cities = response.data));
	      			},
	      			setlocations()
	      			{
	      				if(this.job_location=='')
	      				{
	      					if(this.cityn!=''){
	      					this.job_location=this.cityn;
	      					this.job_location2.push(this.cityn);
	      					this.cityn='';
	      					}
	      				}
	      				else
		      			{
		      				if(this.cityn!=''){
		      				this.job_location=this.job_location+','+this.cityn;
	      					this.job_location2.push(this.cityn);
		      				this.cityn='';
		      				}
		      			}
	      			},
					removeloc(loc)
					{
						for (var i=this.job_location2.length-1; i>=0; i--) {
					    if (this.job_location2[i] === loc) {
					        this.job_location2.splice(i, 1);
					    }
						}
					    this.job_location=this.job_location.replace(','+loc, '');
					    this.job_location=this.job_location.replace(loc+',', '');
					    this.job_location=this.job_location.replace(loc, '');
					}
				}
	      	})
	      </script>
	      <script>
     
      var placeSearch, autocomplete;
      var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
      };

      function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('address')),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();
        var latitude = place.geometry.location.lat();
        var longitude = place.geometry.location.lng();
      }
	  function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }

      /***********Add new rward or benifit******/
      $("#rewardform").on('submit',function(e){
      	var newrevard=$("#newrevard").val();
      	if(newrevard!='')
      	{
      		var x = Math.floor((Math.random() * 9999) + 1);
      		$("#newrevarddiv").append('<div id="remove'+x+'" class="multi-box  col-sm-4"><div class="dublicat-box form-group"><span class="custom-checkbox"><input name="job_benefits[]" type="checkbox" value="'+newrevard+'" id="reward'+x+'"><label for="reward'+x+'"></label>'+newrevard+' <a href="javascript:;" class="removediv" idd="remove'+x+'">X</a></span></div></div>');
      		$("#newrevard").val('');
      	$("#addmore_rewards").modal('toggle');
      	}

      	e.preventDefault();
      });
      $("#preferencesform").on('submit',function(e){
      	var newpreference=$("#newpreference").val();
      	if(newpreference!='')
      	{
      		var x = Math.floor((Math.random() * 9999) + 1);
      		
		$("#morepreference").append('<div id="remove'+x+'" class="col-sm-4"><div class="pf-field"><span class="custom-checkbox"><input name="job_preference[]" type="checkbox" value="'+newpreference+'" id="reward'+x+'"><label for="reward'+x+'"></label>'+newpreference+' <a href="javascript:;" class="removediv" idd="remove'+x+'">X</a></span></div></div>');
      		$("#newpreference").val('');
      	$("#addmore_preferences").modal('toggle');
      	}

      	e.preventDefault();
      });
      
      $(document).on('click','.removediv',function(){
      		var toremove=$(this).attr('idd');
      		$("#"+toremove).remove();
      });

      function performquestionnaireaction()
      {
      	if ($("#select_questionnaire").prop('checked')) {
            $("#job_questionnaire").removeAttr('disabled');
        }
        else {
           $("#job_questionnaire").attr('disabled','disabled');
        }
      }

      function jobeventchange()
      {
      	var vale=$("#job_event").val();
      	if(vale=='' || vale=='Normal')
      	{
      		$(".mixjob").hide();
      		$(".jobfair").hide();
      	}
      	if(vale=='Walk-ins')
      	{
      		$(".mixjob").show();
      		$(".jobfair").hide();	
      	}
      	if(vale=='Job-fair')
      	{
      		$(".mixjob").show();
      		$(".jobfair").show();	
      	}
      }
    </script>
    <script type="text/javascript">
    	CKEDITOR.replace( 'job_description', {removePlugins: 'image',} );
    	CKEDITOR.replace( 'job_skills', {removePlugins: 'image',} );
    	CKEDITOR.replace( 'job_responsibility', {removePlugins: 'image',} );
    	
    	
    </script>
    <script type="text/javascript">
    	$(".job_offered_salary").on('change',function(){
    		var minsal=$("#job_offered_salary_min").val();
    		var maxsal=$("#job_offered_salary_max").val();
    		if(parseInt(maxsal)<parseInt(minsal))
		      {
		        //alert("here2");
		         $("#job_offered_salary_min").val(maxsal);
		         $("#job_offered_salary_max").val(minsal);
		      }
    	})
    	
		$(".job_graduation_year").on('change',function(){
    		var minsal=$("#job_graduation_start_year").val();
    		var maxsal=$("#job_graduation_end_year").val();
    		if(parseInt(maxsal)<parseInt(minsal))
		      {
		        //alert("here2");
		         $("#job_graduation_start_year").val(maxsal);
		         $("#job_graduation_end_year").val(minsal);
		      }
    	})
    	$(".job_experience").on('change',function(){
    		var minsal=$("#job_experience_min").val();
    		var maxsal=$("#job_experience_max").val();
    		if(parseInt(maxsal)<parseInt(minsal))
		      {
		        //alert("here2");
		         $("#job_experience_min").val(maxsal);
		         $("#job_experience_max").val(minsal);
		      }
    	})
    	
    	
    </script>
    <script type="text/javascript">

    $('.job_last_applying_date').datepicker({  

       format: 'mm-dd-yyyy',
       startDate: new Date()

     });  
     $('#job-fair-from').datepicker({  

       format: 'mm-dd-yyyy',
       startDate: new Date()

     });  
      $('#job-fair-to').datepicker({  

       format: 'mm-dd-yyyy',
       startDate: new Date()

     });  
       $('#walk-ins-from').datepicker({  

       format: 'mm-dd-yyyy',
       startDate: new Date()

     });  
        $('#walk-ins-to').datepicker({  

       format: 'mm-dd-yyyy',
       startDate: new Date()

     });  

</script> 
		
@endsection
		<!-- ====================== End Create Job ================ -->