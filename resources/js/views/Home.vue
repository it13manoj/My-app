<template>
   <div onload="playVideo()">
 <!-- ======================= Start Banner ===================== -->
               <section id="lab_video_slider">
                  <div class="container-fluid">
                     <div class="row">
                        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
                        <!-- Link Swiper's CSS -->
                        <!-- Swiper -->
                        <div class="swiper-container">
                           <div class="swiper-wrapper">
                              <div id="slide_one" class="swiper-slide">
                                 <div id="lab_video_text_overlay" >
                                    <div class="container">
                                       <h2 class="" style="color: #ffffff;">Aim Higher. Reach Farther. Dream Bigger. </h2>
                                       <p style="color: #ffffff;" > Find Your Career. You Deserve it.</p>
                                    </div>
                                 </div>
                                 <!-- VIDEO -->
                                 <video class="slider-video" width="100%" preload="auto" loop autoplay style="visibility: visible; width: 100%;" id="background_video" poster="home_assets/img/home-video-image.jpg">
                                    <source src="home_assets/background.mp4" type="video/mp4">
                                    <source src="home_assets/background.mp4" type="video/webm">
                                 </video>
                              </div>
                           </div>
                         
                        </div>
                        <!-- Initialize Swiper -->
                     </div>
                     <!-- end .row -->
                  </div>
               </section>
               <!-- ======================= End Banner ===================== -->
               <!-- ====================== Advance Features : Search Job ================= -->
               <section class="theme-background">
                  <div class="container">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="heading margin-bottom-0">
                              <h2 class="text-white ">Advance Features</h2>
                              <p class="text-white">Search A Job To Tell Us About Your Project. We'll Quickly Match You With The Right Freelancers.</p>
                           </div>
                           <form id="job_search_form" method="get" action="/jobs">
                              <fieldset class="home-form-1 icon-field border-radius-50">
                                 <div class="col-md-6 col-sm-6 padd-0">
                                    <div class="form-group mrg-bot-5">
                                       <div class="icon-addon addon-lg">
                                          <input type="text" class="form-control br-1 skill_search" placeholder="Skills, Designation, Companies" v-model="headsearch" name="keywords" />
                                          <label class="fa ti-pencil"></label>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-4 col-sm-4 padd-0">
                                    <div class="form-group mrg-bot-5 ">
                                       <div class="icon-addon addon-lg">
                                          <!-- <select class="wide form-control br-1 border-radius-0 border-radius-xs-50 line-height-40">
                                             <option data-display="Location">All Country</option>
                                             <option value="1">Allahabad</option>
                                             <option value="2">India</option>
                                             <option value="3" disabled>Australia</option>
                                             <option value="4">United State</option>
                                          </select> -->
                                          <input v-model="locationsearch" name="locationsearch" type="text" class="form-control location-in-top" placeholder="Location">
                                    
                                          <label class="fa ti-location-pin"></label>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- <div class="col-md-3 col-sm-3 padd-0">
                                    <div class="form-group mrg-bot-5">
                                       <div class="icon-addon addon-lg">
                                          <select class="wide form-control border-radius-0 border-radius-xs-50 line-height-40">
                                             <option data-display="Industry">Show All</option>
                                             <option value="1">Web Design</option>
                                             <option value="2">Accountant</option>
                                             <option value="3" disabled>Marketting</option>
                                             <option value="4">Farmer</option>
                                          </select>
                                         
                                          <label class="fa ti-bar-chart"></label>
                                       </div>
                                    </div>
                                 </div> -->
                                 <div class="col-md-2 col-sm-2 padd-0">
                                    <button type="submit" class="btn theme-btn search-button border-radius-xs-50 cl-white seub-btn">FIND JOB</button>
                                 </div>
                              </fieldset>
                           </form>
                           <div class="text-center">
                              <!-- <div class="choose-opt">
                                 <div class="choose-opt-box"><span>OR</span></div>
                              </div> -->
                              <a href="#" class="btn btn-hiring border-radius-50 btn-m mrg-5"><span class="ti-upload padd-r-5"></span>Upload Your CV</a>
                              <a href="#" class="btn btn-hiring border-radius-50  btn-m mrg-5"><span class="ti-briefcase padd-r-5"></span>Post a Job for Free</a>
                              <router-link to="/jobs" class="btn btn-hiring border-radius-50  btn-m mrg-5" ><span class="ti-search padd-r-5"></span>Advanced Search</router-link>
                           </div>
                        </div>
                     </div>
                  </div>
               </section>
               <!-- ====================== How It Work ================= -->
               <section class="how-it-works">
                  <div class="container">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="heading">
                              <h2>How It Works?</h2>
                              <p>Each month, more than 7 million Jobhunt turn to website in their search for work, making over<br>160,000 applications every day.</p>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-4 col-sm-4">
                           <div class="work-process">
                              <span class="process-icon bg-danger-light">
                              <i class="ti-user"></i>
                              <span class="process-count bg-danger cl-white">1</span>
                              </span>
                              <h4>Create An Account</h4>
                              <p>naukriyan is the leading and longest-running online recruitment in India. We understand that job-seekers come to us not only for a job, but for an portunity to realize their professional.</p>
                           </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                           <div class="work-process step-2">
                              <span class="process-icon bg-success-light">
                              <i class="ti-pencil-alt"></i>
                              <span class="process-count bg-success cl-white">2</span>
                              </span>
                              <h4>Specify & Search Your Job</h4>
                              <p>You’ll receive applications via email. You can also manage jobs and candidates from your dashboard. Review applications, Schedule interviews and view recommended candidates all from one place</p>
                           </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                           <div class="work-process step-3">
                              <span class="process-icon bg-purple-light">
                              <i class="ti-thumb-up"></i>
                              <span class="process-count bg-purple cl-white">3</span>
                              </span>
                              <h4>Apply For Job</h4>
                              <p>Search a job to tell us about your requirement. We'll quickly match you with the right employers.</p>
                           </div>
                        </div>
                     </div>
                  </div>
               </section>
               <!-- ======================= All Jobs ==================================== -->
               <section v-if="industries">
                  <div class="container">
                    <h2 class="heading">Latest Jobs</h2>
                    <ul class="nav nav-tabs nav-advance theme-bg" role="tablist">
                        <li  v-for="(categor,index) in industries" v-if="categor.featured==1" @click="getjobs(categor.category_id)" class="nav-item" v-bind:class="[type==categor.category_id ? 'active' : '',type=='' && index=='0' ? 'active' : '']" >
                           <a v-if="index<lastitem-1" class="nav-link"  role="tab" v-bind:class="[index==0 ? 'tab1' : 'middle_tab']">
                           {{categor.category_name}}</a>
                            <a v-else class="nav-link"  role="tab" v-bind:class="[index==lastitem-1 ? 'tab-last' : 'middle_tab']">
                           {{categor.category_name}}</a>
                        </li>
                        <!-- <li @click="getjobs('Hot')" class="nav-item " v-bind:class="[type=='Hot' ? 'active' : '']">
                           <a class="nav-link middle_tab" data-toggle="tab" href="#egovernance" role="tab">
                           Hot Jobs</a>
                        </li>
                        <li @click="getjobs('JobFair')" class="nav-item " v-bind:class="[type=='JobFair' ? 'active' : '']">
                           <a class="nav-link middle_tab" data-toggle="tab" href="#walkins" role="tab">
                           Walkins/Job fairs </a>
                        </li> -->
                    </ul>
                    <div class="tab-content">
                        <!-- Government Jobs -->
                        <div class="tab-pane fade in show active" id="goverment" role="tabpanel">
                           <div class="row">
                              <div class="table-responsive">
                                <table class="table table-lg table-hover">
                                    <thead>
                                       <tr>
                                          <th>Title</th>
                                          <th>Company Name</th>
                                          <th>Location</th>
                                          <!-- <th>Job Type</th> -->
                                          <th>Experience</th>
                                          <th v-if="user_role=='Jobseeker' || user_role==''"></th>
                                       </tr>
                                    </thead>
                                    <tbody v-if="jobs.length>0">

                                       <tr v-for="job in jobs">
                                          <td><router-link :to="{ name: 'jobdetails', params: { id:job.encId} }" >{{job.job_title.substring(0,30)}}</router-link></td>
                                          <td><router-link :to="{ name: 'companies', params: { id:job.company_slug} }" class="company-name-color">{{job.company_name}}</router-link></td>
                                          <td><i class="ti-location-pin"></i> {{job.job_address.substring(0,30)}}</td>
                                          <!-- <td>
                                             <div class="full-type">Full Time</div>
                                          </td> -->
                                          <td><i class="ti-briefcase"></i> {{job.job_experience}} year</td>
                                          <td v-if="user_role=='Jobseeker' || user_role==''">
                                             <span class="job-like">
                                             <label class="toggler toggler-danger">
                                             <a v-if="job.isSaved==0" @click="savejobs('listing',job.job_id,jobindex)" href="javascript:;">
                                                <i  class="fa fa-heart save unsave"></i></a>
                                             <a v-else href="javascript:;" @click="savejobs('listing',job.job_id,jobindex)">
                                                <i  class="fa fa-heart save"></i>
                                                 </a>
                                             </label>
                                             </span>
                                             <router-link v-if="job.isApplied==0" :to="{ name: 'apply', params: { id:job.encId} }" class="btn apply-job-btn btn-radius t" >Apply</router-link>
                                                <a v-else @click="applyjobs('listing',job.job_id,jobindex)" href="javascript:;" class="btn apply-job-btn btn-radius t">Applied</a>
                                          </td>
                                       </tr>
                                    </tbody>
                                    <tbody v-else>
                                        <tr>No data Found</tr>
                                    </tbody>
                                </table>
                                
                                <div v-if="jobs.length>0" class="flexbox padd-10 text-center">
                                 <router-link  :to="{ name: 'jobs'}" class="btn theme-btn btn-radius btn-m" >View All</router-link>
                                </div>
                              </div>
                           </div>
                        </div>
                        <!-- E-Governance Jobs -->
                        
                        <!-- Walkins/Events/Job fairs -->
                        
                        <!-- Featured Jobs -->
                     
                    </div>
                  </div>
               </section>
               <!-- ====================== End All jobs ============================ -->
               <!-- ====================== Tag Section ============================ -->
               <section class="tag-sec" style="background:url(assets/img/slider-01.jpg);">
                  <div class="container">
                     <div class="col-md-10 col-md-offset-1">
                        <div class="tag-content">
                           <h2>Naukriyan Site Stats</h2>
                           <p>Here we list our site stats and how many people we’ve helped find a job and companies have found 
                              recruits. It's a pretty awesome stats area!
                           </p>
                           <div class="stats-sec">
                              <div class="row">
                                 <div id="testimonial-slide" class="testimonial-carousel">
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                       <div class="cmp-icon1">
                                          <i class="cmp-i icon-profile-male"></i>
                                       </div>
                                       <div class="stat2">
                                          <span>74,058</span>
                                          <h5>Job Seekers</h5>
                                       </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                       <div class="cmp-icon1">
                                          <i class="cmp-i icon-profile-male"></i>
                                       </div>
                                       <div class="stat2">
                                          <span>4,799</span>
                                          <h5>Employers</h5>
                                       </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                       <div class="cmp-icon1">
                                          <i class="cmp-i icon-aperture"></i>
                                       </div>
                                       <div class="stat2">
                                          <span>1,587</span>
                                          <h5>Companies</h5>
                                       </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                       <div class="cmp-icon1">
                                          <i class="cmp-i icon-global"></i>
                                       </div>
                                       <div class="stat2">
                                          <span>2,799</span>
                                          <h5>Members</h5>
                                       </div>
                                    </div>
                                 </div>                                 
                              </div>
                           </div>
                         
                           <a href="#" class="btn theme-btn-reverse btn-radius" title="">EXPLORE US<i class="ti-shift-right"></i></a>
                        </div>
                     </div>
                  </div>
               </section>
              
               <!-- =================== End Tag Section ==================== -->
               <!-- ================ Opening job Section ============================== -->
               <section>
                  <div class="container">
                     <div class="row" data-aos="fade-up">
                        <div class="col-md-12 text-center">
                           <div class="heading">
                              <h2>Are You Hiring?</h2>
                              <p>Find everything you need to post a job and receive the best candidates by visiting our Empl oyer website. We offer small business and enterprise options.</p>
                           </div>
                           <a href="#" class="btn theme-btn btn-radius" title="">EXPLORE US<i class="ti-shift-right"></i></a>
                        </div>
                     </div>
                  </div>
               </section>
               <!-- ================ End Opening job Section ============================== -->
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
                                 <form class="advance_search_form" method="get" action="/jobs">
                                    <div class="form-group col-md-6 col-xs-12 padding-left-0">
                                       <label>Skills, Designation, Companies</label>
                                       <input type="text" class="form-control"  v-model="headsearch"  name="keywords" placeholder="Skills, Designation, Companies">
                                    </div>
                                    <div class="form-group col-md-6 col-xs-12 padding-left-0 padding-right-0">
                                       <label>Location</label>
                                       <input v-model="locationsearch" name="locationsearch"  type="text" class="form-control" placeholder="Location">
                                      
                                    </div>
                                    
                                    <div class="form-group col-md-6 col-xs-12 padding-left-0 ">
                                       <label>Work Experience ( in Year )</label>
                                       <div class="dropdown">
                                         <button class="dropdown-toggle multiselect-drop" type="button" data-toggle="dropdown"><span v-if="industryfilter.length<=0">Select</span><span v-else>{{industryfilter.length}} selected</span>
                                         <span class="caret pull-right mgr-top-5p"></span></button>
                                         <ul class="dropdown-menu">
                                           <li class="padd-l-20">
                                          <span class="custom-checkbox">
                                          <input  v-model="jobexp" type="checkbox" value="0-0" id="fresher">
                                          <label for="fresher"></label>
                                          </span>
                                          Fresher
                                       </li>
                                       <li class="padd-l-20">
                                          <span class="custom-checkbox">
                                          <input  v-model="jobexp" type="checkbox" id="exp1" value="1-2">
                                          <label for="exp1"></label>
                                          </span>
                                          1Year To 2Year
                                       </li>
                                       <li class="padd-l-20">
                                          <span class="custom-checkbox">
                                          <input  v-model="jobexp" type="checkbox" id="exp2" value="2-3">
                                          <label for="exp2"></label>
                                          </span>
                                          2Year To 3Year
                                       </li>
                                       <li class="padd-l-20">
                                          <span class="custom-checkbox">
                                          <input  v-model="jobexp" type="checkbox" id="exp3" value="3-4">
                                          <label for="exp3"></label>
                                          </span>
                                          3Year To 4Year
                                       </li>
                                       <li class="padd-l-20">
                                          <span class="custom-checkbox">
                                          <input  v-model="jobexp" type="checkbox" id="exp4" value="4-5">
                                          <label for="exp4"></label>
                                          </span>
                                          4Year To 5Year
                                       </li>
                                       <li class="padd-l-20">
                                          <span class="custom-checkbox">
                                          <input  v-model="jobexp" type="checkbox" id="exp5" value="5-7">
                                          <label for="exp5"></label>
                                          </span>
                                          5Year To 7Year
                                       </li>
                                       <li class="padd-l-20">
                                          <span class="custom-checkbox">
                                          <input  v-model="jobexp" type="checkbox" id="exp6" value="7-10">
                                          <label for="exp6"></label>
                                          </span>
                                          7Year To 10Year
                                       </li>
                                       <li class="padd-l-20">
                                          <span class="custom-checkbox">
                                          <input  v-model="jobexp" type="checkbox" id="exp7" value="10-11">
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
                                         <button class="dropdown-toggle multiselect-drop" type="button" data-toggle="dropdown"><span v-if="industryfilter.length<=0">Select</span><span v-else>{{industryfilter.length}} selected</span>
                                         <span class="caret pull-right mgr-top-5p"></span></button>
                                         <ul class="dropdown-menu">
                                          <li class="padd-l-20">
                                          <span class="custom-checkbox">
                                          <input  v-model="OfferedSalary" value="0-3" type="checkbox" id="1">
                                          <label for="1"></label>
                                          </span>
                                          0-3 Lakhs
                                          <!-- <span class="pull-right">102</span> -->
                                       </li>
                                       <li class="padd-l-20">
                                          <span class="custom-checkbox">
                                          <input  v-model="OfferedSalary" value="3-6" type="checkbox" id="2">
                                          <label for="2"></label>
                                          </span>
                                           3-6 Lakhs
                                          <!-- <span class="pull-right">78</span> -->
                                       </li>
                                       <li class="padd-l-20">
                                          <span class="custom-checkbox">
                                          <input  v-model="OfferedSalary" value="6-10" type="checkbox" id="3">
                                          <label for="3"></label>
                                          </span>
                                          6-10 Lakhs
                                          <!-- <span class="pull-right">12</span> -->
                                       </li>
                                       <li class="padd-l-20">
                                          <span class="custom-checkbox">
                                          <input  v-model="OfferedSalary" value="10-15" type="checkbox" id="4">
                                          <label for="4"></label>
                                          </span>
                                          10-15 Lakhs
                                          <!-- <span class="pull-right">85</span> -->
                                       </li>
                                       <li class="padd-l-20">
                                          <span class="custom-checkbox">
                                          <input  v-model="OfferedSalary" value="15-20" type="checkbox" id="5">
                                          <label for="5"></label>
                                          </span>
                                          15-20 Lakhs
                                          <!-- <span class="pull-right">307</span> -->
                                       </li>
                                       <li class="padd-l-20">
                                          <span class="custom-checkbox">
                                          <input   v-model="OfferedSalary" value="20-30" type="checkbox" id="6">
                                          <label for="6"></label>
                                          </span>
                                          20-30 Lakhs
                                          <!-- <span class="pull-right">307</span> -->
                                       </li>
                                       <li class="padd-l-20">
                                          <span class="custom-checkbox">
                                          <input  v-model="OfferedSalary" value="30-50" type="checkbox" id="7">
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
                                         
                                          <v-select :value.sync="industryfilter"  multiple v-model="industryfilter" :options="options"></v-select>
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
                                                   <input  v-model="industryfilter" :value="industry.category_id" type="checkbox" :id="'cat'+industry.category_id">
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
                                                <input  v-model="jobTypen" value="Part Time" type="checkbox" id="a1">
                                                <label for="a1"></label>
                                                </span>
                                                Part Time
                                                <!-- <span class="pull-right">102</span> -->
                                             </li>
                                             <li class="padd-l-20">
                                                <span class="custom-checkbox">
                                                <input  v-model="jobTypen" value="Full Time" type="checkbox" id="b1">
                                                <label for="b1"></label>
                                                </span>
                                                Full Time
                                                <!-- <span class="pull-right">78</span> -->
                                             </li>
                                             
                                             <li class="padd-l-20">
                                                <span class="custom-checkbox">
                                                <input  v-model="jobTypen" value="Freelancer" type="checkbox" id="e1">
                                                <label for="e1"></label>
                                                </span>
                                                Freelancer
                                                <!-- <span class="pull-right">307</span> -->
                                             </li>
                                             <li class="padd-l-20">
                                                <span class="custom-checkbox">
                                                <input  v-model="jobTypen" value="Internship" type="checkbox" id="f1">
                                                <label for="f1"></label>
                                                </span>
                                                Internship
                                                <!-- <span class="pull-right">256</span> -->
                                             </li>
                                         </ul>
                                       </div> 
                                    </div>
                                    
                                   
                                    <div class="form-group text-center">
                                       <button @click="submitsearch" type="button" class="btn theme-btn full-width btn-m">Search </button>
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
               import Multiselect from 'vue-multiselect';
                 //Vue.component('multiselect', Multiselect);
               export default {
                  components: { Multiselect },
              data: () => ({
                  csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                  jobs:{},
                  type:'',
                  islogin:true,
                  user_role:'',
                  user_id:'',
                  jobsearchkeyword:'',
                  OfferedSalary:[],
                  industries:[],
                  industryfilter:[],
                  industryfilter2:[],
                  jobTypen:[],
                  jobQual:[],
                  jobexp:[],
                  baseUrl:'',
                  lastitem:0,
                  headsearch:'',
                   locationsearch:'',
                  
                }),
               async beforeMount()
               {
                  this.baseUrl=Laravel.baseUrl;
                  await this.getindustries();
                  if (!this.$session.exists()) {
                      this.islogin=false;
                      this.user_role='';
                      this.user_id='';
                  }else
                  {
                     this.islogin=true;
                     this.user_id=this.$session.get('id');
                     this.user_role=this.$session.get('user_role');
                  }
                   document.title = Laravel.appName+' | Home'
                   //this.gethomepagejobs(this.type);
               },
               methods:
               {
                  submitsearch:function()
                  {
                     $("#advance_search2").modal('toggle');
                     this.$router.push('/jobs?jobsearchkeyword='+this.jobsearchkeyword+'&OfferedSalary='+this.OfferedSalary+'&industryfilter='+this.industryfilter+'&jobType='+this.jobTypen+'&keywords='+this.headsearch+'&locationsearch='+this.locationsearch+'&jobQual='+this.jobQual+'&jobexp='+this.jobexp);
                  },
                  getindustries:function()
                  {
                     var serff=this;
                     axios
                    .get(Laravel.baseUrl+'/getindustrylist')
                    .then(response => {
                        serff.industries=response.data;
                     for (let i = 0; i < serff.industries.length; i++) {
                        if(serff.industries[i].featured==1)
                        {
                           serff.type=serff.industries[i].category_id;
                           break;
                        }
                        }
                        for (let i = 0; i < serff.industries.length; i++) {
                        if(serff.industries[i].featured==1)
                        {
                         this.lastitem++;
                        }
                        }
                     this.gethomepagejobs(this.type);

                     })
                  },
                  getjobs(type)
                  {
                     this.type=type;
                     this.gethomepagejobs(this.type);
                  },
                  gethomepagejobs(type)
                  {
                     var serff=this;
                     axios
                    .get(Laravel.baseUrl+'/gethomepagejobs?access_token='+type+'&reqId='+btoa(serff.user_id))
                    .then(response => {
                        serff.jobs=response.data;
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
