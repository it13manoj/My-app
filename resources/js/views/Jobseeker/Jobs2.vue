 <template>
   <div>
<!-- ======================= Search Filter ===================== -->
					<section id="job_page_search" class="padding-top-7">
						<div class="container">
							<div class="col-md-12">
								<form id="job_search_form">
									<fieldset class="search-form border-radius-50">
										<div class="col-md-4 col-sm-4 padd-0">
											<div class="icon-addon addon-lg">
												<input type="text" class="form-control skill_search br-1" placeholder="Skills, Designation, Companies" />
												<label class="fa ti-pencil"></label>
											</div>
										</div>
										<div class="col-md-3 col-sm-3 padd-0">
											<div class="icon-addon addon-lg">
												<select class="wide form-control border-radius-0 line-height-40">
													<option data-display="Location">All Country</option>
													<option value="1">Allahabad</option>
													<option value="2">India</option>
													<option value="3" disabled>Australia</option>
													<option value="4">United State</option>
												</select>
												<label class=" fa ti-location-pin "></label>
											</div>
										</div>
											
										<div class="col-md-3 col-sm-3 padd-0">
											<div class="icon-addon addon-lg">
												<select class="wide form-control border-radius-0 line-height-40">
													<option data-display="Indusry">Show All</option>
													<option value="1">Web Design</option>
													<option value="2">Accountant</option>
													<option value="3">Marketting</option>
													<option value="4">Farmer</option>
												</select>
												<label class="fa ti-bar-chart"></label>
											</div>
										</div>
											
										<div class="col-md-2 col-sm-2 padd-0 m-clear">
											<button type="submit" class="btn theme-btn search-button full-width height-50 radius-0">FIND JOB</button>
										</div>
											
									</fieldset>
								</form>
								<div>
									<a href="" data-toggle="modal" data-target="#advance_search" class="pull-right margin-top-30 padding-right-40"> Advanced Search </a>
								</div>
							</div>
						</div>
					</section>
				<!-- ======================= Search Filter ===================== -->
               <!-- ====================== Start Job Detail 2 ================ -->
               <section>
                  <div class="container">
                     <!-- row -->
                     <div class="row">
                        <!-- Start Sidebar -->
                        <div class="col-md-3 col-sm-4">
                           <div class="widget-boxed ">
                              <div class="widget-boxed-header">
                                 <h4>Keyword</h4>
                              </div>
                              <div class="widget-boxed-body">
                                 <div class="search_widget_job">
                                    <div class="field_w_search">
                                       <input @keyup="getjobs" v-model="jobsearchkeyword" type="text" class="form-control" placeholder="Search Keywords">
                                    </div>
                                    <!--  <div class="field_w_search">
                                       <input type="Submit" class="btn btn-m btn-block" >
                                    </div> -->
                                 </div>
                              </div>
                           </div>
                           <div class="widget-boxed padd-bot-0">
                              <div class="widget-boxed-header">
                                 <h4>Offered Salary</h4>
                              </div>
                               <div class="widget-boxed-body">
                                 <div class="side-list no-border">
                                    <ul>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input @change="getjobs" v-model="OfferedSalary" value="0-3" type="checkbox" id="1">
                                          <label for="1"></label>
                                          </span>
                                          0-3 Lakhs
                                          <!-- <span class="pull-right">102</span> -->
                                       </li>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input @change="getjobs" v-model="OfferedSalary" value="3-6" type="checkbox" id="2">
                                          <label for="2"></label>
                                          </span>
                                           3-6 Lakhs
                                          <!-- <span class="pull-right">78</span> -->
                                       </li>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input @change="getjobs" v-model="OfferedSalary" value="6-10" type="checkbox" id="3">
                                          <label for="3"></label>
                                          </span>
                                          6-10 Lakhs
                                          <!-- <span class="pull-right">12</span> -->
                                       </li>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input @change="getjobs" v-model="OfferedSalary" value="10-15" type="checkbox" id="4">
                                          <label for="4"></label>
                                          </span>
                                          10-15 Lakhs
                                          <!-- <span class="pull-right">85</span> -->
                                       </li>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input @change="getjobs" v-model="OfferedSalary" value="15-20" type="checkbox" id="5">
                                          <label for="5"></label>
                                          </span>
                                          15-20 Lakhs
                                          <!-- <span class="pull-right">307</span> -->
                                       </li>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input @change="getjobs"  v-model="OfferedSalary" value="20-30" type="checkbox" id="6">
                                          <label for="6"></label>
                                          </span>
                                          20-30 Lakhs
                                          <!-- <span class="pull-right">307</span> -->
                                       </li>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input @change="getjobs" v-model="OfferedSalary" value="30-50" type="checkbox" id="7">
                                          <label for="7"></label>
                                          </span>
                                          30-50 Lakhs 
                                          <!-- <span class="pull-right">307</span> -->
                                       </li>
                                    </ul>
                                   <!--  <div class="text-center">
                                       <a href="#" >more</a>
                                    </div> -->
                                    
                                 </div>
                              </div>
                           </div>
                           <div class="widget-boxed padd-bot-0">
                              <div class="widget-boxed-header br-0">
                                 <h4>Industry <a href="#industry" data-toggle="collapse"><i class="pull-right ti-plus" aria-hidden="true"></i></a></h4>
                              </div>
                              <div class="widget-boxed-body collapse"  id="industry">
                                 <div class="side-list no-border">
                                    <ul>
                                       <li v-for="industry in industries">
                                          <span class="custom-checkbox">
                                          <input @change="getjobs" v-model="industryfilter" :value="industry.category_id" type="checkbox" :id="'cat'+industry.category_id">
                                          <label :for="'cat'+industry.category_id"></label>
                                          </span>
                                          {{industry.category_name}}
                                          <!-- <span class="pull-right">102</span> -->
                                       </li>
                                       
                                    </ul>
                                     <div class="text-center">
                                       <a href="#" >more</a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="widget-boxed padd-bot-0">
                              <div class="widget-boxed-header br-0">
                                 <h4>Job Type <a href="#jobtype" data-toggle="collapse"><i class="pull-right ti-plus" aria-hidden="true"></i></a></h4>
                              </div>
                              <div class="widget-boxed-body collapse" id="jobtype">
                                 <div class="side-list no-border">
                                    <ul>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input @change="getjobs" v-model="jobTypen" value="Part Time" type="checkbox" id="a1">
                                          <label for="a1"></label>
                                          </span>
                                          Part Time
                                          <!-- <span class="pull-right">102</span> -->
                                       </li>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input @change="getjobs" v-model="jobTypen" value="Full Time" type="checkbox" id="b1">
                                          <label for="b1"></label>
                                          </span>
                                          Full Time
                                          <!-- <span class="pull-right">78</span> -->
                                       </li>
                                       
                                       <li>
                                          <span class="custom-checkbox">
                                          <input @change="getjobs" v-model="jobTypen" value="Freelancer" type="checkbox" id="e1">
                                          <label for="e1"></label>
                                          </span>
                                          Freelancer
                                          <!-- <span class="pull-right">307</span> -->
                                       </li>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input @change="getjobs" v-model="jobTypen" value="Internship" type="checkbox" id="f1">
                                          <label for="f1"></label>
                                          </span>
                                          Internship
                                          <!-- <span class="pull-right">256</span> -->
                                       </li>
                                    </ul>
                                     <div class="text-center">
                                       <a href="#" >more</a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- <div class="widget-boxed padd-bot-0">
                              <div class="widget-boxed-header br-0">
                                 <h4>Designation <a href="#designation" data-toggle="collapse"><i class="pull-right ti-plus" aria-hidden="true"></i></a></h4>
                              </div>
                              <div class="widget-boxed-body collapse" id="designation">
                                 <div class="side-list no-border">
                                    <ul>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input type="checkbox" id="a">
                                          <label for="a"></label>
                                          </span>
                                          Web Designer
                                          <span class="pull-right">102</span>
                                       </li>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input type="checkbox" id="b">
                                          <label for="b"></label>
                                          </span>
                                          Php Developer
                                          <span class="pull-right">78</span>
                                       </li>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input type="checkbox" id="c">
                                          <label for="c"></label>
                                          </span>
                                          Project Manager
                                          <span class="pull-right">12</span>
                                       </li>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input type="checkbox" id="d">
                                          <label for="d"></label>
                                          </span>
                                          Human Resource
                                          <span class="pull-right">85</span>
                                       </li>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input type="checkbox" id="e">
                                          <label for="e"></label>
                                          </span>
                                          CMS Developer
                                          <span class="pull-right">307</span>
                                       </li>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input type="checkbox" id="f">
                                          <label for="f"></label>
                                          </span>
                                          App Developer
                                          <span class="pull-right">256</span>
                                       </li>
                                    </ul>
                                     <div class="text-center">
                                       <a href="#" >more</a>
                                    </div>
                                 </div>
                              </div>
                           </div> -->
                           <div class="widget-boxed padd-bot-0">
                              <div class="widget-boxed-header br-0">
                                 <h4>Location <a href="#location" data-toggle="collapse"><i class="pull-right ti-plus" aria-hidden="true"></i></a></h4>
                              </div>
                              <div class="widget-boxed-body collapse" id="location">
                                 <div class="side-list no-border">
                                    <ul>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input type="checkbox" id="a">
                                          <label for="a"></label>
                                          </span>
                                          Noida
                                          <span class="pull-right">102</span>
                                       </li>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input type="checkbox" id="b">
                                          <label for="b"></label>
                                          </span>
                                          Pune
                                          <span class="pull-right">78</span>
                                       </li>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input type="checkbox" id="c">
                                          <label for="c"></label>
                                          </span>
                                          Delhi/NCR
                                          <span class="pull-right">12</span>
                                       </li>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input type="checkbox" id="d">
                                          <label for="d"></label>
                                          </span>
                                          Bangaluru
                                          <span class="pull-right">85</span>
                                       </li>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input type="checkbox" id="e">
                                          <label for="e"></label>
                                          </span>
                                          Mumbai
                                          <span class="pull-right">307</span>
                                       </li>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input type="checkbox" id="f">
                                          <label for="f"></label>
                                          </span>
                                          Lucknow
                                          <span class="pull-right">256</span>
                                       </li>
                                    </ul>
                                    <div class="text-center">
                                       <a href="#" >more</a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="widget-boxed padd-bot-0">
                              <div class="widget-boxed-header br-0">
                                 <h4>Experince <a href="#experince" data-toggle="collapse"><i class="pull-right ti-plus" aria-hidden="true"></i></a></h4>
                              </div>
                              <div class="widget-boxed-body collapse" id="experince">
                                 <div class="side-list no-border">
                                    <ul>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input type="checkbox" id="11">
                                          <label for="11"></label>
                                          </span>
                                          1Year To 2Year
                                       </li>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input type="checkbox" id="21">
                                          <label for="21"></label>
                                          </span>
                                          2Year To 3Year
                                       </li>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input type="checkbox" id="31">
                                          <label for="31"></label>
                                          </span>
                                          3Year To 4Year
                                       </li>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input type="checkbox" id="41">
                                          <label for="41"></label>
                                          </span>
                                          4Year To 5Year
                                       </li>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input type="checkbox" id="51">
                                          <label for="51"></label>
                                          </span>
                                          5Year To 7Year
                                       </li>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input type="checkbox" id="61">
                                          <label for="61"></label>
                                          </span>
                                          7Year To 10Year
                                       </li>
                                    </ul>
                                     <div class="text-center">
                                       <a href="#" >more</a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="widget-boxed padd-bot-0">
                              <div class="widget-boxed-header br-0">
                                 <h4>Qualification <a href="#qualification" data-toggle="collapse"><i class="pull-right ti-plus" aria-hidden="true"></i></a></h4>
                              </div>
                              <div class="widget-boxed-body collapse" id="qualification">
                                 <div class="side-list no-border">
                                    <ul>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input type="checkbox" id="12">
                                          <label for="12"></label>
                                          </span>
                                          High School
                                       </li>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input type="checkbox" id="22">
                                          <label for="22"></label>
                                          </span>
                                          Intermediate
                                       </li>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input type="checkbox" id="32">
                                          <label for="32"></label>
                                          </span>
                                          Graduation
                                       </li>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input type="checkbox" id="42">
                                          <label for="42"></label>
                                          </span>
                                          Master Degree
                                       </li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- Start Job List -->
                        <div class="col-md-9 col-sm-8">
                           <div class="row mrg-bot-20">
                              <div class="col-sm-5">
                                 <h4 v-if="jobs.data">{{jobs.data.length}} Jobs &amp; Vacancies</h4>
                              </div>
                              <div class="col-sm-7">
                                 <div class="fl-right">
                                    <!-- <div class="search-wide">
                                       <h5>Sort By</h5>
                                    </div>
                                    <div class="search-wide ">
                                       <select class="wide form-control">
                                          <option value="1">Most Recent</option>
                                          <option value="2">Most Viewed</option>
                                          <option value="4">Most Search</option>
                                       </select>
                                    </div> -->
                                    <div class="search-wide ">
                                       <select v-model="limit" @change="getjobs" class="wide form-control">
                                          <option value="10">10 Per Page</option>
                                          <option value="20">20 Per Page</option>
                                          <option value="30">30 Per Page</option>
                                          <option value="50">50 Per Page</option>
                                       </select>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="table-responsive">
                                 <table class="table table-lg table-hover">
                                    <thead>
                                       <tr>
                                          <th>Title</th>
                                          <th>Company</th>
                                          <th>Location</th>
                                          <th>Job Type</th>
                                          <th>Experience</th>
                                          <th>Apply</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <tr v-for="(job,jobindex) in jobs.data">
                                          <td><router-link :to="{ name: 'jobdetails', params: { id:job.encId} }" ><img v-if="job.job_p_category==1" src="home_assets/img/hot.png" class="category-xs" alt="Hot" data-toggle="tooltip" title="hot">
                                          <img v-if="job.job_p_category==2" src="home_assets/img/featured.png" class="category-xs" alt="Featured" data-toggle="tooltip" title="Featured">
                                          <img v-if="job.job_p_category==3" src="home_assets/img/free.png" class="category-xs" alt="Basic" data-toggle="tooltip" title="Basic">

                                          {{job.job_title.substring(0,20)}}</router-link></td>
                                          <td><a href="company-detail.html" class="company-name-color">{{job.company_name.substring(0,15)}}</a></td>
                                          <td><i class="ti-location-pin"></i>{{job.job_address.substring(0,20)}}</td>
                                          <td> {{job.job_type}}</td>
                                          <td><i class="ti-briefcase"></i> {{job.job_experience}} year</td>
                                          <td>
                                             <span class="job-like">
                                             <label class="toggler toggler-danger">
                                             <a v-if="job.isSaved==0" @click="savejobs('listing',job.job_id,jobindex)" href="javascript:;">
                                                <i  class="fa fa-heart save unsave"></i></a>
                                             <a v-else href="javascript:;" @click="savejobs('listing',job.job_id,jobindex)">
                                                <i  class="fa fa-heart save"></i>
                                                 </a>
                                             </label>
                                             </span>
                                            <!--  <a href="#" data-toggle="modal" data-target="#apply-job" class="apply-job-btn btn btn-radius ">Apply</a> -->
                                              <!-- <a v-if="job.isApplied==0" @click="applyjobs('listing',job.job_id,jobindex)" href="javascript:;" class="btn apply-job-btn btn-radius t">Apply</a> -->
                                              <router-link v-if="job.isApplied==0" :to="{ name: 'apply', params: { id:job.encId} }" class="btn apply-job-btn btn-radius t" >Apply</router-link>
                                                <a v-else @click="applyjobs('listing',job.job_id,jobindex)" href="javascript:;" class="btn apply-job-btn btn-radius t">Applied</a>
                                          </td>
                                       </tr>
                                       
                                    </tbody>
                                 </table>
                                 <!-- flexbox -->
                                 <div class="text-center">
                                    <pagination :data="jobs" @pagination-change-page="getjobs"></pagination>
                                 </div>
                                 <!-- /.flexbox -->
                              </div>
                        </div>
                     </div>
                     <!-- End Row -->
                  </div>
               </section>
               <!-- ====================== End Job Detail 2 ================ -->		

</div>
</template>
 <script>
  import VueMoment from 'vue-moment'; 
     export default {
        data: () => ({
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            jobs:{},
            limit:10,
            jobsearchkeyword:'',
            OfferedSalary:[],
            industries:[],
            industryfilter:[],
            jobTypen:[],
          }),
          
        async beforeMount()
         {
            await this.getjobs();
            document.title = Laravel.appName+' | Jobs'
         },
         created: function () {
            this.getindustries();
         },
         methods:{
            getindustries:function()
               {
                  var serff=this;
                  axios
                 .get(Laravel.baseUrl+'/getindustrylist')
                 .then(response => {
                     serff.industries=response.data;
                  })
               },
            getjobs(page) {
                   var uid=this.$session.get('id');
                  if (typeof page === 'undefined') {
                       page = 1;
                   }
                  var serff=this;
                  let currentObj = new FormData();
                  currentObj.append('jobsearchkeyword', this.jobsearchkeyword);
                  currentObj.append('OfferedSalary', this.OfferedSalary);
                  currentObj.append('industryfilter', this.industryfilter);
                  currentObj.append('limit', this.limit);
                  axios
                 .get(Laravel.baseUrl+'/getjobs?page='+page+'&access_token='+btoa(uid)+'&limit='+this.limit+'&jobsearchkeyword='+this.jobsearchkeyword+'&OfferedSalary='+this.OfferedSalary+'&industryfilter='+this.industryfilter+'&jobType='+this.jobTypen)
                 .then(response => {
                  serff.jobs=response.data;
                  console.log(response.data);
                  })
               },
               savejobs(jobtype,jobid,jobindex)
               {
                  if (!this.$session.exists()) {
                     this.$router.push('/userlogin')
                   }
                 let selff=this;
                  let currentObj = new FormData();
               currentObj.append('access_token', btoa(this.$session.get('id')));
               currentObj.append('jobid', btoa(jobid));
               axios.post(Laravel.baseUrl+'/savejob',currentObj)
                .then(function (response) {
                    if(jobtype=='mainjob')
                    {
                     if(response.data==1)
                     {
                        selff.jobs.data.isSaved=1;
                     }else
                     {
                        selff.jobs.data.isSaved=0;

                     }
                    }
                    else
                    {
                     if(response.data==1)
                     {
                        selff.jobs.data[jobindex].isSaved=1;
                     }else
                     {
                        selff.jobs.data[jobindex].isSaved=0;

                     }
                  }
                 }).catch(function (error) {
                    currentObj.output = error;
                })
               
               },
               applyjobs(jobtype,jobid,jobindex)
               {
                  if (!this.$session.exists()) {
                     this.$router.push('/userlogin')
                   }
                 let selff=this;
                  let currentObj = new FormData();
               currentObj.append('access_token', btoa(this.$session.get('id')));
               currentObj.append('jobid', btoa(jobid));
               axios.post(Laravel.baseUrl+'/applyjob',currentObj)
                .then(function (response) {
                    if(jobtype=='mainjob')
                    {
                     if(response.data==1)
                     {
                        selff.jobs.data.isApplied=1;
                     }/*else
                     {
                        selff.jobdetails.isApplied=0;

                     }*/
                    }
                    else
                    {
                     if(response.data==1)
                     {
                        selff.jobs.data[jobindex].isApplied=1;
                     }else
                     {
                        //selff.jobs.data[jobindex].isApplied=0;

                     }
                  }
                 }).catch(function (error) {
                    currentObj.output = error;
                })
               
               },
         }
    }

 
</script>