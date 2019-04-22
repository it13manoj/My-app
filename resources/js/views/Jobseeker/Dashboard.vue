	<template>
	<div>	
		<!-- ======================= Start Page Title ===================== -->
		 <div class="page-title">
			<div class="container">
				<div class="col-sm-12">
					<div class="page-caption">
						<h2 class="subheader-heading">Dashboard</h2>
						<!-- <p><a href="#" title="Home">Home</a> <i class="ti-arrow-right"></i> Resume Detail</p> -->
					</div>
				</div>
			</div>
		</div> 
		<!-- ======================= End Page Title ===================== -->
		
		
		<!-- ====================== Resume Detail ================ -->
		<section >
			<div class="container">
				<!-- row -->
				<div class="row">
					
					<div class="col-md-9 col-sm-8">
						<div class="">
							<div class="col-md-4 col-sm-6">
								<div class="card horizontal cardIcon waves-effect waves-dark">
									<div class="card-image bg-red">
										<i class="icon-document ti"></i>
									</div>
									<div class="card-stacked bg-red">
										<div class="card-content">
											<h3 class="text-white">{{appliedJobs}}</h3> 
										</div>
										<div class="card-action">
											<span class="text-white">Applied Jobs</span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-4 col-sm-6">
								<div class="card horizontal cardIcon waves-effect waves-dark">
									<div class="card-image bg-orange">
										<i class="ti-eye ti"></i>
									</div>
									<div class="card-stacked bg-orange">
										<div class="card-content">
											<h3 class="text-white">{{resumeView}}</h3> 
										</div>
										<div class="card-action">
											<span class="text-white">Resume View</span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-4 col-sm-6">
								<div class="card horizontal cardIcon waves-effect waves-dark">
									<div class="card-image bg-blue">
										<i class="ti-check ti"></i>
									</div>
									<div class="card-stacked bg-blue">
										<div class="card-content">
											<h3 class="text-white">{{appropriate}}</h3> 
										</div>
										<div class="card-action">
											<span class="text-white">Appropriate For Me</span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-4 col-sm-6">
								<div class="card horizontal cardIcon waves-effect waves-dark">
									<div class="card-image bg-green">
										<i class="ti-bag ti"></i>
									</div>
									<div class="card-stacked bg-green">
										<div class="card-content">
											<h3 class="text-white">{{shortlisted}}</h3> 
										</div>
										<div class="card-action">
											<span class="text-white">Shortlisted</span>
										</div>
									</div>
								</div>								
							</div>
							<div class="col-md-4 col-sm-6">
								<div class="card horizontal cardIcon waves-effect waves-dark">
									<div class="card-image bg-purple">
										<i class="icon-calendar ti"></i>
									</div>
									<div class="card-stacked bg-purple">
										<div class="card-content">
											<h3 class="text-white">{{upcomingInterview}}</h3> 
										</div>
										<div class="card-action">
											<span class="text-white">Upcoming Interviews</span>
										</div>
									</div>
								</div>	
							</div>
							<div class="col-md-4 col-sm-6">
								<div class="card horizontal cardIcon waves-effect waves-dark">
									<div class="card-image bg-sea-green">
										<i class="icon-flag ti"></i>
									</div>
									<div class="card-stacked bg-sea-green">
										<div class="card-content">
											<h3 class="text-white">{{followcomp}}</h3> 
										</div>
										<div class="card-action">
											<span class="text-white">Follow Companies</span>
										</div>
									</div>
								</div>	
							</div>
							<div class="col-md-4 col-sm-6">
								<div class="card horizontal cardIcon waves-effect waves-dark">
									<div class="card-image bg-coral" style="">
										<i class="icon-heart ti"></i>
									</div>
									<div class="card-stacked  bg-coral " >
										<div class="card-content">
											<h3 class="text-white">{{savedjob}}</h3> 
										</div>
										<div class="card-action">
											<span class="text-white">Job Saved</span>
										</div>
									</div>
								</div>	
							</div>
							<div class="col-md-4 col-sm-6">
								<div class="card horizontal cardIcon waves-effect waves-dark">
									<div class="card-image bg-peru" >
										<i class="icon-envelope ti"></i>
									</div>
									<div class="card-stacked bg-peru">
										<div class="card-content">
											<h3 class="text-white">{{recruitermsg}}</h3> 
										</div>
										<div class="card-action">
											<span class="text-white">Recruiter Message</span>
										</div>
									</div>
								</div>	
							</div>
							<div class="col-md-4 col-sm-6">
								<div class="card horizontal cardIcon waves-effect waves-dark">
									<div class="card-image bg-pink">
										<i class="icon-flag ti"></i>
									</div>
									<div class="card-stacked bg-pink" >
										<div class="card-content">
											<h3 class="text-white">Basic</h3> 
										</div>
										<div class="card-action">
											<span class="text-white">Subscriptions</span>
										</div>
									</div>
								</div>	
							</div>
						</div>
						
					</div>
					<!-- Sidebar -->
					<div class="col-md-3 col-sm-4">
						<div style="margin-top: 5px;" v-if="advertisements" v-for="advrt in advertisements" class="sidebar">
							<div class="">
								<a :href="advrt.adv_link" target="_blank">
								<img class="ads" :src="baseUrl+'/admin_assets/uploaded_images/adv_pic/'+advrt.adv_image">
							</a>
							</div>
						</div>
					</div>
					<!-- End Sidebar -->
					
					
				</div>
				<!-- End Row -->
				
			</div>
		</section>
		
		<!-- ====================== End Resume Detail ================ -->
	</div>
	</template>
	<script>
     export default {
        data: () => ({
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            usertoken:null,
            appliedJobs:0,
            resumeView:0,
            appropriate:0,
            shortlisted:0,
            upcomingInterview:0,
            followcomp:0,
            savedjob:0,
            recruitermsg:0,
            advertisements:{},
            islogin:'',
            baseUrl:''
          }),
          beforeCreate: function () {
		    if (!this.$session.exists()) {
		      this.$router.push('/')
		    }
		  },
		  beforeMount()
           {
               document.title = Laravel.appName+' | Jobseeker Dashboard'
           },
		  created: function () {
		    // `this` points to the vm instance
		    this.baseUrl=Laravel.baseUrl;
		    this.usertoken=this.$session.get('user_token');
		    this.getdashboarddetails();
		  },
		  methods:
		  {
		  	 getdashboarddetails() {
               var uid=this.$session.get('id');
                  var serff=this;
                  axios
                 .get(Laravel.baseUrl+'/getjobseekerdashboard?access_token='+btoa(uid))
                 .then(response => {
                 	serff.appliedJobs=response.data.applied_jobs;
                 	serff.shortlisted=response.data.shortlisted;
                 	serff.savedjob=response.data.savedjobs;
                 	serff.advertisements=response.data.advertisements;
                  })
               },
		  }
    }

</script>
		
		
		
		