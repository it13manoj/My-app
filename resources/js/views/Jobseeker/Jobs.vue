<template>
   <div>
<div class="page-title">
                  <div class="container">
                     <div class="page-caption">
                        <h2 class="subheader-heading"> Search Jobs</h2>
                     </div>
                  </div>
               </div>
               <!-- ======================= End Page Title ===================== -->
               <!-- ======================= Search Filter ===================== -->
					<section id="job_page_search" class="padd-0 ">
						<div class="container">
							<div class="col-md-12">
								<form id="job_search_form" @submit="getjobs2">
									<fieldset class="search-form border-radius-50">
										<div class="col-md-6 col-sm-6 padd-0">
											<div class="icon-addon addon-lg">
												<input  v-model="headsearch" type="text" class="form-control skill_search br-1" placeholder="Skills, Designation, Companies" />
												<label class="fa ti-pencil"></label>
											</div>
										</div>
										<div class="col-md-4 col-sm-4 padd-0">
											<div class="icon-addon addon-lg">
												<!-- <select class="wide form-control border-radius-0 line-height-40">
													<option data-display="Location">All Country</option>
													<option value="1">Allahabad</option>
													<option value="2">India</option>
													<option value="3" disabled>Australia</option>
													<option value="4">United State</option>
												</select>
												<label class=" fa ti-location-pin "></label> -->
                                     <input v-model="locationsearch" type="text" class="form-control location-in-top" placeholder="Location">
                                    <label class=" fa ti-location-pin "></label>
											</div>
										</div>
											
										<!-- <div class="col-md-3 col-sm-3 padd-0">
											<div class="icon-addon addon-lg">
												<select class="wide form-control border-radius-0 line-height-40">
													<option data-display="Industry">Show All</option>
													<option value="1">Web Design</option>
													<option value="2">Accountant</option>
													<option value="3">Marketting</option>
													<option value="4">Farmer</option>
												</select>
												<label class="fa ti-bar-chart"></label>
											</div>
										</div> -->
											
										<div class="col-md-2 col-sm-2 padd-0 m-clear">
											<button type="submit" class="btn theme-btn search-button full-width height-50 radius-0">FIND JOB</button>
										</div>
											
									</fieldset>
								</form>
								<div>
									<a href="" data-toggle="modal" data-target="#advance_search2" class="pull-right margin-top-30 padding-right-40"> Advanced Search </a>
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
                                       <input @keyup="getjobs(0)" v-model="jobsearchkeyword" type="text" class="form-control" placeholder="Search Keywords">
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
                                          <input @change="getjobs(0)" v-model="OfferedSalary" value="0-3" type="checkbox" id="1">
                                          <label for="1"></label>
                                          </span>
                                          0-3 Lakhs
                                          <!-- <span class="pull-right">102</span> -->
                                       </li>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input @change="getjobs(0)" v-model="OfferedSalary" value="3-6" type="checkbox" id="2">
                                          <label for="2"></label>
                                          </span>
                                           3-6 Lakhs
                                          <!-- <span class="pull-right">78</span> -->
                                       </li>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input @change="getjobs(0)" v-model="OfferedSalary" value="6-10" type="checkbox" id="3">
                                          <label for="3"></label>
                                          </span>
                                          6-10 Lakhs
                                          <!-- <span class="pull-right">12</span> -->
                                       </li>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input @change="getjobs(0)" v-model="OfferedSalary" value="10-15" type="checkbox" id="4">
                                          <label for="4"></label>
                                          </span>
                                          10-15 Lakhs
                                          <!-- <span class="pull-right">85</span> -->
                                       </li>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input @change="getjobs(0)" v-model="OfferedSalary" value="15-20" type="checkbox" id="5">
                                          <label for="5"></label>
                                          </span>
                                          15-20 Lakhs
                                          <!-- <span class="pull-right">307</span> -->
                                       </li>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input @change="getjobs(0)"  v-model="OfferedSalary" value="20-30" type="checkbox" id="6">
                                          <label for="6"></label>
                                          </span>
                                          20-30 Lakhs
                                          <!-- <span class="pull-right">307</span> -->
                                       </li>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input @change="getjobs(0)" v-model="OfferedSalary" value="30-50" type="checkbox" id="7">
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
                                          <input @change="getjobs(0)" v-model="industryfilter" :value="industry.category_id" type="checkbox" :id="'cat'+industry.category_id">
                                          <label :for="'cat'+industry.category_id"></label>
                                          </span>
                                          {{industry.category_name}}
                                          <!-- <span class="pull-right">102</span> -->
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
                                 <h4>Job Type <a href="#jobtype" data-toggle="collapse"><i class="pull-right ti-plus" aria-hidden="true"></i></a></h4>
                              </div>
                              <div class="widget-boxed-body collapse" id="jobtype">
                                 <div class="side-list no-border">
                                    <ul>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input @change="getjobs(0)" v-model="jobTypen" value="Part Time" type="checkbox" id="a1">
                                          <label for="a1"></label>
                                          </span>
                                          Part Time
                                          <!-- <span class="pull-right">102</span> -->
                                       </li>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input @change="getjobs(0)" v-model="jobTypen" value="Full Time" type="checkbox" id="b1">
                                          <label for="b1"></label>
                                          </span>
                                          Full Time
                                          <!-- <span class="pull-right">78</span> -->
                                       </li>
                                       
                                       <li>
                                          <span class="custom-checkbox">
                                          <input @change="getjobs(0)" v-model="jobTypen" value="Freelancer" type="checkbox" id="e1">
                                          <label for="e1"></label>
                                          </span>
                                          Freelancer
                                          <!-- <span class="pull-right">307</span> -->
                                       </li>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input @change="getjobs(0)" v-model="jobTypen" value="Internship" type="checkbox" id="f1">
                                          <label for="f1"></label>
                                          </span>
                                          Internship
                                          <!-- <span class="pull-right">256</span> -->
                                       </li>
                                    </ul>
                                     <!-- <div class="text-center">
                                       <a href="#" >more</a>
                                    </div> -->
                                 </div>
                              </div>
                           </div>
                          
                           <!-- <div class="widget-boxed padd-bot-0">
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
                           </div> -->
                           <div class="widget-boxed padd-bot-0">
                              <div class="widget-boxed-header br-0">
                                 <h4>Experince <a href="#experince" data-toggle="collapse"><i class="pull-right ti-plus" aria-hidden="true"></i></a></h4>
                              </div>
                              <div class="widget-boxed-body collapse" id="experince">
                                 <div class="side-list no-border">
                                    <ul>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input @change="getjobs(0)" v-model="jobexp" type="checkbox" value="0-0" id="fresher">
                                          <label for="fresher"></label>
                                          </span>
                                          Fresher
                                       </li>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input @change="getjobs(0)" v-model="jobexp" type="checkbox" id="exp1" value="1-2">
                                          <label for="exp1"></label>
                                          </span>
                                          1Year To 2Year
                                       </li>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input @change="getjobs(0)" v-model="jobexp" type="checkbox" id="exp2" value="2-3">
                                          <label for="exp2"></label>
                                          </span>
                                          2Year To 3Year
                                       </li>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input @change="getjobs(0)" v-model="jobexp" type="checkbox" id="exp3" value="3-4">
                                          <label for="exp3"></label>
                                          </span>
                                          3Year To 4Year
                                       </li>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input @change="getjobs(0)" v-model="jobexp" type="checkbox" id="exp4" value="4-5">
                                          <label for="exp4"></label>
                                          </span>
                                          4Year To 5Year
                                       </li>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input @change="getjobs(0)" v-model="jobexp" type="checkbox" id="exp5" value="5-7">
                                          <label for="exp5"></label>
                                          </span>
                                          5Year To 7Year
                                       </li>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input @change="getjobs(0)" v-model="jobexp" type="checkbox" id="exp6" value="7-10">
                                          <label for="exp6"></label>
                                          </span>
                                          7Year To 10Year
                                       </li>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input @change="getjobs(0)" v-model="jobexp" type="checkbox" id="exp7" value="10-11">
                                          <label for="exp7"></label>
                                          </span>
                                          More than 10 Year
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
                                 <h4>Qualification <a href="#qualification" data-toggle="collapse"><i class="pull-right ti-plus" aria-hidden="true"></i></a></h4>
                              </div>
                              <div class="widget-boxed-body collapse" id="qualification">
                                 <div class="side-list no-border">
                                    <ul>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input value="High School" @change="getjobs(0)" v-model="jobQual" type="checkbox" id="q12">
                                          <label for="q12"></label>
                                          </span>
                                          High School
                                       </li>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input value="Intermediate" @change="getjobs(0)" v-model="jobQual" type="checkbox" id="q22">
                                          <label for="q22"></label>
                                          </span>
                                          Intermediate
                                       </li>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input value="Graduation Diploma" @change="getjobs(0)" v-model="jobQual" type="checkbox" id="q32">
                                          <label for="q32"></label>
                                          </span>
                                          Graduation/Diploma
                                       </li>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input value="Masters Post-Graduation" @change="getjobs(0)" v-model="jobQual" type="checkbox" id="q42">
                                          <label for="q42"></label>
                                          </span>
                                          Masters/Post-Graduation
                                       </li>
                                       <li>
                                          <span class="custom-checkbox">
                                          <input value="Doctorate PhD" @change="getjobs(0)" v-model="jobQual" type="checkbox" id="q43">
                                          <label for="q43"></label>
                                          </span>
                                          Doctorate/PhD
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
                                 <h4>{{total}} Jobs &amp; Vacancies</h4>
                              </div>
                              <div class="col-sm-7 col-md-7">
                                 <div class="fl-right">
                                    <!-- <div class="search-wide">
                                       <h5>Sort By</h5>
                                    </div> -->
                                    <!-- <div class="search-wide">
                                       <select class="wide form-control">
                                          <option value="1">Most Recent</option>
                                          <option value="2">Most Viewed</option>
                                          <option value="4">Most Search</option>
                                       </select>
                                    </div> -->
                                    <div class="search-wide ">
                                       <select v-model="limit" @change="getjobs(0)" class="wide form-control">
                                          <option value="10">10 Per Page</option>
                                          <option value="20">20 Per Page</option>
                                          <option value="30">30 Per Page</option>
                                          <option value="50">50 Per Page</option>
                                       </select>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- Single Verticle job -->
                           <div v-if="jobs.data.length>0"  v-for="(job,jobindex) in jobs.data" class="job-verticle-list">
                              <div class="vertical-job-card">
                                 <div class="vertical-job-header">
                                    <div class="vrt-job-cmp-logo">
                                       <router-link :to="{ name: 'jobdetails', params: { id:job.encId} }" ><img v-bind:src="baseUrl+'/admin_assets/uploaded_images/company_pic/thumb/'+job.company_logo" class="img-responsive" alt="" /></router-link>
                                    </div>
                                    <h4><router-link  :to="{ name: 'jobdetails', params: { id:job.encId} }" >{{job.job_title.substring(0,20)}}</router-link></h4>
                                    <span class="com-tagline company-name-color">{{job.company_name.substring(0,15)}}</span>
                                    <span class="pull-right vacancy-no">
                                    	<span class="job-like">
                                             <label class="toggler toggler-danger">
                                             <a v-if="job.isSaved==0" @click="savejobs('listing',job.job_id,jobindex)" href="javascript:;">
                                                <i  class="fa fa-heart save unsave"></i></a>
                                             <a v-else href="javascript:;" @click="savejobs('listing',job.job_id,jobindex)">
                                                <i  class="fa fa-heart save"></i>
                                                 </a>
                                             </label>
                                        </span>
                                    </span>
                                    <div v-if="job.job_p_category==2" class="job-featured"></div>
                                     <div v-if="job.job_p_category==1" class="job-hot"></div>
                                 </div>
                                 <div class="vertical-job-body">
                                    <div class="row">
                                       <div class="col-md-9 col-sm-8">
                                          <ul class="can-skils">
                                             <!-- <li><strong>Job Id: </strong>G58726</li> -->
                                             <li><strong>Industry: </strong>{{job.category_name}}</li>
                                             <li v-if="job.keyws.length>0 && job.keyws[0]!='' "><strong>Skills: </strong>
                                                <span style="cursor:pointer" @click="searchkey(keyw)" v-for="keyw in job.keyws" class="skill-tag">{{keyw}}</span>
                                             </li>
                                             <li><strong>Experience: </strong>{{job.job_experience}} Year</li>
                                             <li><strong>Location: </strong>{{job.job_address.substring(0,20)}}</li>
                                          </ul>
                                       </div>
                                       <div class="col-md-3 col-sm-4">
                                          <div class="vrt-job-act">
                                             <router-link v-if="job.isApplied==0" :to="{ name: 'apply', params: { id:job.encId} }" class="btn-job apply-job-btn job-apply" >Apply</router-link>
                                                <a v-else @click="applyjobs('listing',job.job_id,jobindex)" href="javascript:;" class="btn-job apply-job-btn job-apply">Applied</a>
                                             <router-link class="btn-job light-gray-btn" :to="{ name: 'jobdetails', params: { id:job.encId} }" >View Job</router-link>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- Single Verticle job -->
                           
                           <!-- Single Verticle job -->
                           
                           <!-- Single Verticle job -->
                           
                           <!-- Single Verticle job -->
                           
                           <div v-if="showloadmore" class="text-center padding-top-20">
                              <a href="javascript:;" @click="getjobs" class="btn loding theme-btn btn-radius btn-m" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Loding...">Load More</a>
                           </div>
                        </div>
                     </div>
                     <!-- End Row -->
                  </div>
               </section>

               <div class="modal fade" id="advance_search2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                  <div class="modal-dialog">
                     <div class="modal-content" id="myModalLabel1">
                        <span class="close-popup" data-dismiss="modal"><i class="fa fa-times"></i></span>
                        <div class="modal-body">
                           <!-- Tab panels -->
                           <div class="tab-content">
                              <!-- Employer Panel 1-->
                              <h5 class="modal-heading" >Advance Search</h5>
                              <div class="tab-pane fade in show active" id="employer" role="tabpanel">
                                 <form class="advance_search_form">
                                    <div class="form-group col-md-6 col-xs-12 padding-left-0">
                                       <label>Skills, Designation, Companies</label>
                                       <input type="text" class="form-control" @keyup="getjobs(0)" v-model="headsearch" placeholder="Skills, Designation, Companies">
                                    </div>
                                    <div class="form-group col-md-6 col-xs-12 padding-left-0 padding-right-0">
                                       <label>Location</label>
                                       <input v-model="locationsearch" @keyup="getjobs(0)" type="text" class="form-control" placeholder="Location">
                                      
                                    </div>
                                    
                                    <div class="form-group col-md-6 col-xs-12 padding-left-0 ">
                                       <label>Work Experience ( in Year )</label>
                                       <div class="dropdown">
                                         <button class="dropdown-toggle multiselect-drop" type="button" data-toggle="dropdown"><span v-if="jobexp.length<=0">Select</span><span v-else>{{jobexp.length}} selected</span>
                                         <span class="caret pull-right mgr-top-5p"></span></button>
                                         <ul class="dropdown-menu">
                                           <li class="padd-l-20">
                                          <span class="custom-checkbox">
                                          <input @change="getjobs(0)" v-model="jobexp" type="checkbox" value="0-0" id="fresher">
                                          <label for="fresher"></label>
                                          </span>
                                          Fresher
                                       </li>
                                       <li class="padd-l-20">
                                          <span class="custom-checkbox">
                                          <input @change="getjobs(0)" v-model="jobexp" type="checkbox" id="exp1" value="1-2">
                                          <label for="exp1"></label>
                                          </span>
                                          1Year To 2Year
                                       </li>
                                       <li class="padd-l-20">
                                          <span class="custom-checkbox">
                                          <input @change="getjobs(0)" v-model="jobexp" type="checkbox" id="exp2" value="2-3">
                                          <label for="exp2"></label>
                                          </span>
                                          2Year To 3Year
                                       </li>
                                       <li class="padd-l-20">
                                          <span class="custom-checkbox">
                                          <input @change="getjobs(0)" v-model="jobexp" type="checkbox" id="exp3" value="3-4">
                                          <label for="exp3"></label>
                                          </span>
                                          3Year To 4Year
                                       </li>
                                       <li class="padd-l-20">
                                          <span class="custom-checkbox">
                                          <input @change="getjobs(0)" v-model="jobexp" type="checkbox" id="exp4" value="4-5">
                                          <label for="exp4"></label>
                                          </span>
                                          4Year To 5Year
                                       </li>
                                       <li class="padd-l-20">
                                          <span class="custom-checkbox">
                                          <input @change="getjobs(0)" v-model="jobexp" type="checkbox" id="exp5" value="5-7">
                                          <label for="exp5"></label>
                                          </span>
                                          5Year To 7Year
                                       </li>
                                       <li class="padd-l-20">
                                          <span class="custom-checkbox">
                                          <input @change="getjobs(0)" v-model="jobexp" type="checkbox" id="exp6" value="7-10">
                                          <label for="exp6"></label>
                                          </span>
                                          7Year To 10Year
                                       </li>
                                       <li class="padd-l-20">
                                          <span class="custom-checkbox">
                                          <input @change="getjobs(0)" v-model="jobexp" type="checkbox" id="exp7" value="10-11">
                                          <label for="exp7"></label>
                                          </span>
                                          More than 10 Year
                                       </li>
                                         </ul>
                                       </div> 
                                    </div>

                                    
                                    <div class="form-group col-md-6 col-xs-12 padding-left-0 ">
                                       <label>Expected Salary (in Lakhs)</label>
                                       <div class="dropdown">
                                         <button class="dropdown-toggle multiselect-drop" type="button" data-toggle="dropdown"><span v-if="OfferedSalary.length<=0">Select</span><span v-else>{{OfferedSalary.length}} selected</span>
                                         <span class="caret pull-right mgr-top-5p"></span></button>
                                         <ul class="dropdown-menu">
                                          <li class="padd-l-20">
                                          <span class="custom-checkbox">
                                          <input @change="getjobs(0)" v-model="OfferedSalary" value="0-3" type="checkbox" id="1">
                                          <label for="1"></label>
                                          </span>
                                          0-3 Lakhs
                                          <!-- <span class="pull-right">102</span> -->
                                       </li>
                                       <li class="padd-l-20">
                                          <span class="custom-checkbox">
                                          <input @change="getjobs(0)" v-model="OfferedSalary" value="3-6" type="checkbox" id="2">
                                          <label for="2"></label>
                                          </span>
                                           3-6 Lakhs
                                          <!-- <span class="pull-right">78</span> -->
                                       </li>
                                       <li class="padd-l-20">
                                          <span class="custom-checkbox">
                                          <input @change="getjobs(0)" v-model="OfferedSalary" value="6-10" type="checkbox" id="3">
                                          <label for="3"></label>
                                          </span>
                                          6-10 Lakhs
                                          <!-- <span class="pull-right">12</span> -->
                                       </li>
                                       <li class="padd-l-20">
                                          <span class="custom-checkbox">
                                          <input @change="getjobs(0)" v-model="OfferedSalary" value="10-15" type="checkbox" id="4">
                                          <label for="4"></label>
                                          </span>
                                          10-15 Lakhs
                                          <!-- <span class="pull-right">85</span> -->
                                       </li>
                                       <li class="padd-l-20">
                                          <span class="custom-checkbox">
                                          <input @change="getjobs(0)" v-model="OfferedSalary" value="15-20" type="checkbox" id="5">
                                          <label for="5"></label>
                                          </span>
                                          15-20 Lakhs
                                          <!-- <span class="pull-right">307</span> -->
                                       </li>
                                       <li class="padd-l-20">
                                          <span class="custom-checkbox">
                                          <input @change="getjobs(0)"  v-model="OfferedSalary" value="20-30" type="checkbox" id="6">
                                          <label for="6"></label>
                                          </span>
                                          20-30 Lakhs
                                          <!-- <span class="pull-right">307</span> -->
                                       </li>
                                       <li class="padd-l-20">
                                          <span class="custom-checkbox">
                                          <input @change="getjobs(0)" v-model="OfferedSalary" value="30-50" type="checkbox" id="7">
                                          <label for="7"></label>
                                          </span>
                                          30-50 Lakhs 
                                          <!-- <span class="pull-right">307</span> -->
                                       </li>
                                         </ul>
                                       </div> 
                                    </div>

                                    <!-- <div class="form-group col-md-6 col-xs-12 padding-left-0 ">
                                      <label>Industry</label>
                                      <div class="form-group margin-bottom-0">
                                         
                                          <v-select :value.sync="industryfilter" @change="getjobs(0)" multiple v-model="industryfilter" :options="options"></v-select>
                                      </div>
                                    </div> -->
                                     <div class="form-group col-md-6 col-xs-12 padding-left-0 ">
                                       <label>Industry</label>
                                       <div class="dropdown">
                                         <button class="dropdown-toggle multiselect-drop" type="button" data-toggle="dropdown"><span v-if="industryfilter.length<=0">Select</span><span v-else>{{industryfilter.length}} selected</span>
                                         <span class="caret pull-right mgr-top-5p"></span></button>
                                         <ul class="dropdown-menu">
                                          <li v-for="industry in industries" class="padd-l-20">
                                                   <span class="custom-checkbox">
                                                   <input @change="getjobs(0)" v-model="industryfilter" :value="industry.category_id" type="checkbox" :id="'cat'+industry.category_id">
                                                   <label :for="'cat'+industry.category_id"></label>
                                                   </span>
                                                   {{industry.category_name}}
                                                   <!-- <span class="pull-right">102</span> -->
                                                </li>
                                         </ul>
                                       </div> 
                                    </div>
                                    <div class="form-group col-md-6 col-xs-12 padding-left-0 ">
                                       <label>Job Type</label>
                                       <div class="dropdown">
                                         <button class="dropdown-toggle multiselect-drop" type="button" data-toggle="dropdown"><span v-if="jobTypen.length<=0">Select</span><span v-else>{{jobTypen.length}} selected</span>
                                         <span class="caret pull-right mgr-top-5p"></span></button>
                                         <ul class="dropdown-menu">
                                             <li class="padd-l-20">
                                                <span class="custom-checkbox">
                                                <input @change="getjobs(0)" v-model="jobTypen" value="Part Time" type="checkbox" id="a1">
                                                <label for="a1"></label>
                                                </span>
                                                Part Time
                                                <!-- <span class="pull-right">102</span> -->
                                             </li>
                                             <li class="padd-l-20">
                                                <span class="custom-checkbox">
                                                <input @change="getjobs(0)" v-model="jobTypen" value="Full Time" type="checkbox" id="b1">
                                                <label for="b1"></label>
                                                </span>
                                                Full Time
                                                <!-- <span class="pull-right">78</span> -->
                                             </li>
                                             
                                             <li class="padd-l-20">
                                                <span class="custom-checkbox">
                                                <input @change="getjobs(0)" v-model="jobTypen" value="Freelancer" type="checkbox" id="e1">
                                                <label for="e1"></label>
                                                </span>
                                                Freelancer
                                                <!-- <span class="pull-right">307</span> -->
                                             </li>
                                             <li class="padd-l-20">
                                                <span class="custom-checkbox">
                                                <input @change="getjobs(0)" v-model="jobTypen" value="Internship" type="checkbox" id="f1">
                                                <label for="f1"></label>
                                                </span>
                                                Internship
                                                <!-- <span class="pull-right">256</span> -->
                                             </li>
                                         </ul>
                                       </div> 
                                    </div>
                                    
                                   
                                    <div class="form-group text-center">
                                       <button data-dismiss="modal" type="button" class="btn theme-btn full-width btn-m">Search </button>
                                    </div>
                                 </form>
                              </div>
                           </div>
                           <!-- Tab panels -->
                        </div>
                     </div>
                  </div>
               </div>



            </div>
      </template>
     
      <script>
      import vSelect from 'vue-select'
  import VueMoment from 'vue-moment'; 
     export default {
      components: {
                 vSelect
               },
        data: () => ({
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            jobs:{},
            limit:10,
            jobsearchkeyword:'',
            OfferedSalary:[],
            industries:[],
            industryfilter:[],
            industryfilter2:[],
            jobTypen:[],
            jobQual:[],
            jobexp:[],
            baseUrl:'',
            headsearch:'',
            options:[],
            locationsearch:'',
            showloadmore:true,
             startfrom:0,
                endto:0,
                total:0,
                page:1,
          }),
          
        async beforeMount()
         {
            if(this.$route.query.keywords)
            {
               this.headsearch=this.$route.query.keywords;
            }
            if(this.$route.query.locationsearch)
            {
               this.locationsearch=this.$route.query.locationsearch;
            }
            if(this.$route.query.jobsearchkeyword)
            {
             this.jobsearchkeyword=this.$route.query.jobsearchkeyword;  
            }
            if(this.$route.query.OfferedSalary)
            {
             this.OfferedSalary=this.$route.query.OfferedSalary; 
             console.log(this.OfferedSalary); 
            }
            if(this.$route.query.industryfilter)
            {
             this.industryfilter=this.$route.query.industryfilter;  
            }
            if(this.$route.query.jobType)
            {
             this.jobTypen=this.$route.query.jobType;
             console.log(this.$route.query.jobType);  
            }
            if(this.$route.query.jobQual)
            {
             this.jobQual=this.$route.query.jobQual;  
            }
            if(this.$route.query.jobexp)
            {
             this.jobexp=this.$route.query.jobexp;

            }

            
            this.baseUrl=Laravel.baseUrl;
            await this.getindustries();
            await this.getjobs();
            document.title = Laravel.appName+' | Jobs'
         },
         mounted()
         {
              /*let recaptchaScript = document.createElement('script')
             recaptchaScript.setAttribute('src', Laravel.baseUrl+'/assets/js/multiselect_industry.js')
             document.head.appendChild(recaptchaScript)*/
            //this.setmultiselect();
         },
         watch: {
           industryfilter: function (newVal) {
             console.log(newVal);
           }
         },
         created: function () {
            
            
         },
         methods:{
            searchkey(key)
            {
               this.jobsearchkeyword=key;
               this.getjobs(0);
            },
            /*setmultiselect:function(e)
            {
               $('select[multiple].active.3col').multiselect({
                              columns: 1,
                              placeholder: 'Select',
                              search: true,
                              searchOptions: {
                                  'default': 'Search'
                              },
                              selectAll: true
                          });
            },*/
            getjobs2:function(e)
            {
               e.preventDefault();
               this.getjobs(0);
            },
            getindustries:function()
               {
                  var serff=this;
                  axios
                 .get(Laravel.baseUrl+'/getindustrylist')
                 .then(response => {
                     serff.industries=response.data;
                    // console.log(serff.industries);
                     for (let i = 0; i < serff.industries.length; i++) {
                     serff.options.push({label: serff.industries[i].category_name, value: serff.industries[i].category_id})
                     }
                  })
               },
            getjobs(page) {
                  if(page==0)
                  {
                     this.page=1;
                  }

                   var uid=this.$session.get('id');
                  /*if (typeof page === 'undefined') {
                       page = 1;
                   }*/
                  var serff=this;
                  $(".loader").show();
                  let currentObj = new FormData();
                  currentObj.append('jobsearchkeyword', this.jobsearchkeyword);
                  currentObj.append('OfferedSalary', this.OfferedSalary);
                  currentObj.append('industryfilter', this.industryfilter);
                  currentObj.append('limit', this.limit);
                  axios
                 .get(Laravel.baseUrl+'/getjobs?page='+this.page+'&access_token='+btoa(uid)+'&limit='+this.limit+'&jobsearchkeyword='+this.jobsearchkeyword+'&OfferedSalary='+this.OfferedSalary+'&industryfilter='+this.industryfilter+'&jobType='+this.jobTypen+'&headsearch='+this.headsearch+'&locationsearch='+this.locationsearch+'&jobQual='+this.jobQual+'&jobexp='+this.jobexp)
                 .then(response => {
                  $(".loader").hide();
                  if(serff.page<=1)
                  {
                  serff.jobs=response.data;
                 // serff.page=serff.page+1;    
                  }else
                  {
                     console.log(response.data);
                    serff.jobs.data=serff.jobs.data.concat(response.data.data) 
                  }
                 
                 
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