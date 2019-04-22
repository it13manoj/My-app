@extends('Employer.layouts.app')
@section('title', 'Manage Jobs')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
	<!-- ======================= Page Title ===================== -->
		<div class="page-title">
			<div class="container">
				<div class="page-caption">
					<h2 class="subheader-heading">Manage Jobs</h2>
				</div>
			</div>
		</div>
		<!-- ======================= End Page Title ===================== -->
		
		<!-- ======================== Manage Job ========================= -->
		<section id="app">
			<data-component></data-component>
			<!-- <div class="container">
				<div class="row">
					<form>
						<div class="col-md-3 col-sm-12">
							Showing 0-10 of 10 Results
						</div>
						<div class="col-sm-9">
							<div class="col-md-12 padd-l-0">
								<div class="col-md-4 col-sm-12">
									<div class="field_w_search">
	                                    <input type="text" class="form-control" placeholder="Search Job">
	                                </div>
								</div>
								<div class="col-md-3 col-sm-6">
			                        <div class="search-wide full col-md-6 col-sm-6">
			                           <select class="wide form-control">
			                              <option value="1" data-display="Sort By">All</option>
			                              <option value="2">Most Viewed</option>
			                              <option value="4">Most Search</option>
			                           </select>
			                        </div>
			                    </div>
			                    <div class="col-md-3 col-sm-6">
			                    	 <div class="search-wide full col-md-6 col-sm-6">
			                           <select class="wide form-control">
			                              <option value="1" data-display="Status">All</option>
			                              <option value="2">Active</option>
			                              <option value="3">Deactivate</option>
			                              <option value="4">Reject</option>
			                           </select>
			                        </div>
			                    </div>
			                    <div class="col-md-2 col-sm-12">
			                    	<button class="btn apply-job-btn  btn-radius">Submit </button>
			                    </div>
			                    
							</div>
							 
		                </div>
					</form>
					
					
				</div>
				<div class="table-responsive"> 
					<table class="table table-lg table-hover">
						<thead>
							<tr>
								<th>Title</th>
								<th>Expiry</th>
								<th>Status</th>
								<th>Application</th>
								<th>View</th>
								<th>Shortlist</th>
								<th>Interview</th>
								<th>Offer</th>
								<th>Save for future</th>
								<th>Action</th>
							</tr>
						</thead>
						
						<tbody v-if="loaded">
						
							<tr v-for="job in jobs">
								<td>
									<a href="job-detail.html">
										@{{job.job_title}}
									</a>
								</td>            
								<td>@{{ moment(new Date(job.job_expiry_date), "YYYY-MM-DD").format("ll") }}</td>
								<td v-if="job.job_status==1" class="cl-success" > Active </td>
									<td v-else-if="job.job_status==2" class="cl-danger" > Rejected </td>
									<td v-else-if="job.job_status==3" class="cl-default" > Inactive </td>
									<td v-else-if="job.job_status==4" class="cl-default" > Inactive </td>
									<td v-else="job.job_status==0" class="cl-warning" > Pending </td>
								<td><a href="javascript:;" class="application">0</a></td>
								<td>0</td>
								<td>0</td>
								<td>0</td>
								<td>0</td>
								<td>0</td>
								<td>
								<a href="javascript:;" @click="editjob(job)" class="cl-success mrg-5" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit"></i></a>
								<a v-if="job.job_status==1" href="javascript:;" @click="change_status(job.job_id,3)" class="cl-danger mrg-5" data-toggle="tooltip" data-original-title="Deactivate"><i class="fa fa-trash-o"></i></a>
								<a  v-if="job.job_status==3" href="javascript:;" @click="change_status(job.job_id,1)" class="cl-info mrg-5" data-toggle="tooltip" data-original-title="Activate"><i class="fa fa-refresh"></i></a>
								</td>  
							</tr>
							
						</tbody>
					</table>
					
					
					<div class="flexbox padd-10">
						<ul class="pagination">
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
						</ul>
					</div>
					
				</div>
				
			</div> -->
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
<!-- <script src="https://cdn.jsdelivr.net/npm/vue"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script> -->


<script type="text/javascript">
	//const axios = require('axios');
	/*var app=new Vue({
		el:"#app",
		data:
		{
			jobs:'',
			loaded:false,
		},
		mounted () {
		    axios
		      .get('{{route("fetchjobsofuser")}}')
		      .then(response => (this.jobs = response.data.data));
		      this.loaded=true;
		  },methods: {
		    editjob(job){
		        window.location.href = '/employer/editjob/' + btoa(job.job_id);
		    },
		    change_status(job_id,status)
		    {
		    	var selff=this;
		      axios
		      .get('{{route("change_status")}}?jid='+btoa(job_id)+'&status='+status)
		      .then(function (response) {
		       		$.each( selff.jobs, function( key, value ) {
						    if ( value.job_id== job_id ) {
						      value.job_status=status;
						      
						    } 
						    });
                });
		    }
		}

	});*/

</script>
@endsection