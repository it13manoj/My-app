<template>
<div class="container">
			
				<div class="row">
					<div class="col-md-12 col-sm-12 ">
						<div class="col-md-5">
							<h2 class="mrg-top-0">Job Posted</h2>
						</div>
						<div class="col-md-7">
							<div class="short pull-right">
								<div class="custom dropdown">
								  <!-- <button class="btn light-btn dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
								   All Jobs 
									<span class="caret caret-search"></span>
								  </button> --><!-- 
								  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
								  	<li><a href="all">All Jobs</a></li>
									<li><a href="1">Basic Jobs</a></li>
									<li><a href="2">Hot Jobs</a></li>
									<li><a href="3">Featured Jobs</a></li>
									<li><a href="Deactive">Deactive Jobs</a></li>

								  </ul> -->
								   <select v-model="limit" @change="getResults2" class="wide form-control">
                                          <option value="all">All Jobs</option>
                                          <option value="1">Basic Jobs</option>
                                          <option value="2">Hot Jobs</option>
                                          <option value="3">Featured Jobs</option>
                                          <option value="Deactive">Deactive Jobs</option>
                                       </select>
								</div>
							</div>
						</div>
						
					</div>					
				</div>
				<div class="row">
					
					<div v-for="job in laravelData.data" class="col-md-3 col-sm-6">
						<div class="grid-job-widget">
						
							<span class="job-type full-type">{{job.job_type}}</span>
							<!-- <div class="job-like box-layout-job">
								<label class="toggler toggler-danger">
									<input type="checkbox" checked>
									<i class="fa fa-heart"></i>
								</label>
							</div> -->
							
							<div class="u-content">
								<div class="avatar box-80">
									<router-link target="_blank" :to="{ name: 'jobdetails', params: { id:job.encid} }" >
										<img class="img-responsive" v-bind:src="job.companylogo" alt="">
									</router-link>
								</div>
								<h5><router-link target="_blank" :to="{ name: 'jobdetails', params: { id:job.encid} }" >{{job.job_title}}</router-link></h5>
								<p class="text-muted">{{job.job_address}}</p>
							</div>
							
							<div class="job-type-grid">
								
								<a href="javascript:;" class="btn apply-job-btn btn-radius btn-success">{{job.status}}</a>
							</div>
							
						</div>
					</div>
				
				<div class="row">
					<div class="col-md-12">
					<div class="text-center">
						<a v-if="showloadmore" href="javascript:;" @click="loadmore" class="btn loding theme-btn btn-radius btn-m" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Loding...">Load More</a>
					</div>
				</div>
				</div> 
				
			</div>
		</div>
		</template>
		<script>

    export default {

        mounted() {

            console.log('Component mounted.')

        },

        data() {

            return {

                laravelData: {},
                startfrom:0,
                endto:0,
                total:0,
                page:1,
                showloadmore:true,
                limit:'all'

            }

        },

        created() {

            this.getResults();

        },

        methods: {
        	getResults2()
        	{
        		this.page=1;
				this.getResults();        		
        	},

            getResults() {

              /*  if (typeof this.page === 'undefined') {

                    this.page = 1;

                }*/
                var serff=this;
                axios
              .get('http://localhost:8000/employer/fetchjobsofuser?page=' + serff.page+'&limit='+serff.limit)
              .then(response => {
              					console.log(response.data);
              					serff.laravelData = response.data;
              					serff.startfrom=response.data.from;
              					serff.endto=response.data.to;
              					serff.total=response.data.total;
              					if(response.data.last_page==serff.page)
              					{
              						serff.showloadmore=false;
              					}else
              					{
              						serff.showloadmore=true;
              					}
              					serff.page=serff.page+1;
              				});
             					
             

            },
            loadmore()
            {
            	let serff=this;
                axios
              .get('http://localhost:8000/employer/fetchjobsofuser?page=' + serff.page+'&limit='+serff.limit)
              .then(response => {
              					serff.laravelData.data=serff.laravelData.data.concat(response.data.data)
              					serff.startfrom=response.data.from;
              					serff.endto=response.data.to;
              					serff.total=response.data.total;
              					if(response.data.last_page>=serff.page)
              					{
              						serff.showloadmore=false;
              					}else
              					{
              						serff.showloadmore=true;
              					}
              					serff.page=serff.page+1;
              				});
            }

            /*, editjob(job){
                window.location.href = '/employer/editjob/' + btoa(job.job_id);
            },*/

        }

    }

</script>