<template>
   <div>
      <div class="page-title" >
         <div class="container">
            <div class="col-sm-7">
               <div class="page-caption">
                  <h2 class="subheader-heading">Candidate Profile</h2>
               </div>
            </div>
            <div class="col-sm-5 text-right mrg-top-40">
               <a :href="baseUrl+'/admin_assets/resume/'+coverl.resume" target="_blank" v-for="coverl in resumes.resumeResume" v-if="coverl.resume!='' && coverl.resume!=null" type="submit" class="btn btn-m btn-success">Download Resume</a>
               <div  class="job_action dropdown">
                  <a class="dropdown-toggle " data-toggle="dropdown" href="#"><i class="fa fa-ellipsis-v"></i></a>
                  <ul class="dropdown-menu">
                     <li>
                        <a v-if="appdetails.applicationStatus!='Shortlisted'" @click="updateApplicationStatus(appid,appid,'Shortlisted')" href="javascript:;">Shortlist</a>
                        <a v-else style="color:#ccc" href="javascript:;">Shortlist</a>
                     
                     </li>

                     <li>
                        <a v-if="appdetails.applicationStatus!='Rejected'" @click="updateApplicationStatus(appid,appid,'Rejected')" href="javascript:;">Reject</a>
                        <a v-else style="color:#ccc" href="javascript:;">Reject</a>
                     </li>
                     
                     <li><a @click="updatecandidate(appid)" data-toggle="modal" data-target="#interview_scheduled_modal" href="javascript:;">Scheduled Interview</a></li>
                     
                     <li>
                        <a v-if="appdetails.applicationStatus!='Offered'" @click="updateApplicationStatus(appid,appid,'Offered')" href="javascript:;">Job Offer</a>
                        <a v-else style="color:#ccc" href="javascript:;">Job Offer</a>
                     </li>
                     
                     <li>
                        <a v-if="appdetails.applicationStatus!='Hired'" @click="updateApplicationStatus(appid,appid,'Hired')" href="javascript:;">Hire</a>
                        <a v-else style="color:#ccc" href="javascript:;">Hire</a>
                     </li>
                     
                     <li><a @click="sendmessage1(appid)" data-toggle="modal" data-target="#message" href="javascript:;">Message</a></li>
                     
                     <li>
                        <a v-if="appdetails.applicationStatus!='FutureSave'" @click="updateApplicationStatus(appid,appid,'FutureSave')" href="javascript:;">Save
                        </a>
                         <a v-else style="color:#ccc" href="javascript:;">Hire</a>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </div> 
    <section>
                  <div class="container">
                     <flash-message class="myCustomClass" variant="success"></flash-message>
                     <div>
                        <div class="tab style-2" role="tabpanel">
                           <!-- Nav tabs -->
                           <ul class="nav nav-tabs" role="tablist">
                              <li role="presentation" class="active"><a href="#profile" aria-controls="home2" role="tab" data-toggle="tab">Profile</a></li>
                              <li v-for="coverl in resumes.resumeResume" v-if="coverl.resume!='' && coverl.resume!=null" role="presentation"><a href="#resume" aria-controls="profile2" role="tab" data-toggle="tab">Resume</a></li>
                             
                           </ul>
                           <!-- Tab panes -->
                           <div v-if="resumes.userDetails" class="tab-content tabs">
                              <div  role="tabpanel" class="tab-pane fade in active" id="profile">
                                   <div class="row" style="padding: 15px 0">
                                       <div id="mainbody" class="col-md-9 col-sm-8">
                                          <div id="text">
                                             <div class="">
                                                <div class="detail-wrapper" id="personalinformationl">
                                                   <div class="detail-wrapper-body">
                                                      <div class="text-center mrg-bot-30">
                                                         <img v-if="resumes.userDetails.user_profile_picture!=''" :src="baseUrl+'/admin_assets/uploaded_images/profile_pic/thumb/'+resumes.userDetails.user_profile_picture" class="img-circle width-100px" alt=""/>

                                                         <img v-else :src="baseUrl+'/home_assets/img/client-1.jpg'" class="img-circle width-100px" alt=""/>
                                                         <h4 class="meg-0">{{resumes.userDetails.user_first_name}}   {{resumes.userDetails.user_last_name}}</h4>
                                                         <span>{{resumes.userDetails.user_designation}}</span>
                                                      </div>
                                                      <div class="row">
                                                         <div v-if="resumes.userDetails.user_current_location!='' && resumes.userDetails.user_current_location!=null" class="col-sm-4 mrg-bot-10" >
                                                            <i class="ti-location-pin padd-r-10"></i><span data-toggle="tooltip" data-placement="top" title="Current Location">{{resumes.userDetails.user_current_location}}</span> 
                                                         </div>
                                                         <div class="col-sm-4 mrg-bot-10 padd-r-0" >
                                                            <i class="ti-email padd-r-10"></i><span data-toggle="tooltip" data-placement="top" title="Email">{{resumes.userDetails.email}} <a v-if="resumes.userDetails.is_email_verified==0" href="#"></a> <span v-else class="ti-check-box green"></span> </span>
                                                         </div>
                                                         <div class="col-sm-4 mrg-bot-10" >
                                                            <i class="ti-mobile padd-r-10"></i><span data-toggle="tooltip" data-placement="top" title="Contact Number">{{resumes.userDetails.user_contact}} <a v-if="resumes.userDetails.is_contact_verified==0" href="#"></a> <span v-else class="ti-check-box green"></span> </span>
                                                         </div>
                                                         <div v-if="resumes.userDetails.user_current_salary!='' && resumes.userDetails.user_current_salary!=null" class="col-sm-4 mrg-bot-10" >
                                                            <i class="ti-credit-card padd-r-10"></i><span data-toggle="tooltip" data-placement="top" title="Current Salary" >{{resumes.userDetails.user_current_salary}} Rs/Year</span> 
                                                         </div>
                                                         <div v-if="resumes.userDetails.user_experience_year!='' && resumes.userDetails.user_experience_year!=null" class="col-sm-4 mrg-bot-10" >
                                                            <i class="ti-briefcase padd-r-10"></i><span data-toggle="tooltip" data-placement="top" title="Experience">{{resumes.userDetails.user_experience_year}} Year {{resumes.userDetails.user_experience_months}} Month</span>
                                                         </div>
                                                         <div v-if="resumes.userDetails.user_gender!='' && resumes.userDetails.user_gender!=null" class="col-sm-4 mrg-bot-10" >
                                                            <i class="fa fa-transgender padd-r-10"></i><span data-toggle="tooltip" data-placement="top" title="Gender">{{resumes.userDetails.user_gender}}</span>
                                                         </div>
                                                         <div v-if="resumes.userDetails.category_name!='' && resumes.userDetails.category_name!=null" class="col-sm-4 mrg-bot-10" >
                                                            <i class="ti-bar-chart padd-r-10"></i><span data-toggle="tooltip" data-placement="top" title="Industry">{{resumes.userDetails.category_name}}</span>
                                                         </div>
                                                      <div v-if="resumes.userDetails.subcategory_name!='' && resumes.userDetails.subcategory_name!=null" class="col-sm-4 mrg-bot-10" >
                                                            <i class="ti-world padd-r-10"></i><span data-toggle="tooltip" data-placement="top" title="Functional Area">{{resumes.userDetails.subcategory_name}}</span>
                                                         </div>
                                                         <div v-if="dob!='' && dob!=null" class="col-sm-4 mrg-bot-10" >
                                                            <i class="ti-calendar padd-r-10"></i><span data-toggle="tooltip" data-placement="top" title="Date Of Birth">{{dob}}</span>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div v-if="resumes.resumeResume.length>0" class="detail-wrapper" id="coverletter">
                                                   <div class="detail-wrapper-header">
                                                      <h4>Cover Letter</h4>
                                                   </div>
                                                   <div class="detail-wrapper-body ">
                                                      <p class="just-p" v-for="coverl in resumes.resumeResume" v-html="coverl.cover_letter"></p>
                                                      
                                                   </div>
                                                </div>
                                                <div v-if="resumes.resumeEducation.length>0" class="detail-wrapper" id="education">
                                                   <div class="detail-wrapper-header">
                                                      <h4>Education</h4>
                                                   </div>
                                                   <div class="detail-wrapper-body">
                                                      <div v-for="education in resumes.resumeEducation" class="edu-history info">
                                                         <i></i>
                                                         <div class="detail-info">
                                                         <h3 v-if="education.education!='10th' && education.education!='12th'">{{education.degree}}</h3>
                                                         <h3 v-else>{{education.education}}</h3>

                                                            <i>{{$moment(education.passing_out_year).format('MMMM DD,YYYY')}}</i>
                                                            <span>{{education.institute}}</span>
                                                          
                                                         </div>
                                                      </div>
                                                      
                                                   </div>
                                                </div>
                                                <div v-if="resumes.resumeProfession.length>0" class="detail-wrapper" id="worknexperience" >
                                                   <div class="detail-wrapper-header">
                                                      <h4>Work & Experience</h4>
                                                   </div>
                                                   <div class="detail-wrapper-body">
                                                      <div v-for="profession in resumes.resumeProfession" class="edu-history info">
                                                         <i></i>
                                                         <div class="detail-info">
                                                            <h3>{{profession.designation}}</h3>
                                                            <i>{{$moment(profession.startDate).format('YYYY')}} - <span v-if="profession.currentlyWork">Present</span><span v-else>{{$moment(profession.endDate).format('YYYY')}}</span></i>
                                                            <span class="company-name-color">{{profession.organization}}</span>
                                                            <p>{{profession.roleandresp}}</p>
                                                         </div>
                                                      </div>
                                                      
                                                   </div>
                                                </div>
                                                <div v-if="resumes.resumeCertification.length>0" class="detail-wrapper" id="certification">
                                                   <div class="detail-wrapper-header">
                                                      <h4>Certification</h4>
                                                   </div>
                                                   <div class="detail-wrapper-body">
                                                      <div v-for="certifications in resumes.resumeCertification" class="edu-history info">
                                                         <i></i>
                                                         <div class="detail-info">
                                                            <h3>{{certifications.course}}</h3>
                                                            <i>{{$moment(certifications.startDate).format('YYYY')}} - {{$moment(certifications.endDate).format('YYYY')}}</i>
                                                            <span>{{certifications.institute}}</span>
                                                            <p>{{certifications.description}}</p>
                                                         </div>
                                                      </div>
                                                      
                                                   </div>
                                                </div>
                                                <div  v-if="resumes.resumeSkills.length>0" class="detail-wrapper" id="skills">
                                                   <div class="detail-wrapper-header">
                                                      <h4>Skills</h4>
                                                   </div>
                                                   <div class="detail-wrapper-body">
                                                      <div v-for="skills in resumes.resumeSkills" class="edu-history info">
                                                         <i></i>
                                                         <div class="detail-info">
                                                            <h3>{{skills.skill}}</h3>
                                                            <p>{{skills.expertise}}</p>
                                                         </div>
                                                      </div>
                                                     
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-md-3">
                                          <div >
                                             <div class="sidebar">
                                                <!-- Start: Job Overview -->
                                                <div class="widget-boxed">
                                                   <div class="widget-boxed-header">
                                                      <h4><i class="ti-user padd-r-10"></i>Job Preference</h4>
                                                   </div>
                                                   <div class="widget-boxed-body" id="job_preference">
                                                      <div class="side-list no-border" >
                                                         <ul>
                                                            <li v-if="resumes.userDetails.user_expected_salary!='' && resumes.userDetails.user_expected_salary!=null">
                                                               <div class="pull-left"><i class="ti-credit-card padd-r-10"></i></div>
                                                               <div><span data-toggle="tooltip" data-placement="top" title="Expected Salary">{{resumes.userDetails.user_expected_salary}} Rs/Year</span> </div>
                                                            </li>
                                                            <li v-if="resumes.userDetails.user_prefered_location!='' && resumes.userDetails.user_prefered_location!=null">
                                                               <div class="pull-left"><span class="ti-location-pin padd-r-10"></span></div>
                                                               <div><span  data-toggle="tooltip" data-placement="top" title="Prefered Location">{{resumes.userDetails.user_prefered_location}}</span></div>
                                                            </li>
                                                            <li v-if="resumes.usermeta">
                                                               <div class="pull-left"><span class="ti-calendar padd-r-10"></span></div>
                                                               <div><span v-if="resumes.usermeta.notice_period" data-toggle="tooltip" data-placement="top" title="Notice Period">{{resumes.usermeta.notice_period}}</span></div>
                                                            </li>
                                                         </ul>
                                                         <h5>Social Share</h5>
                                                         <ul class="side-list-inline no-border social-side">
                                                            <li><a v-if="resumes.userDetails.user_fb_link!=''" :href="resumes.userDetails.user_fb_link" target="_blank"><i class="fa fa-facebook theme-cl"></i></a></li>
                                                            <li><a v-if="resumes.userDetails.user_twitter_link!=''" :href="resumes.userDetails.user_twitter_link" target="_blank"><i class="fa fa-twitter theme-cl"></i></a></li>
                                                            <li><a v-if="resumes.userDetails.user_linkedin_link!=''" :href="resumes.userDetails.user_linkedin_link" target="_blank"><i class="fa fa-linkedin theme-cl"></i></a></li>
                                                            <!-- <li><a href="#"><i class="fa fa-pinterest theme-cl"></i></a></li> -->
                                                         </ul>
                                                      </div>
                                                   </div>
                                                </div>
                                                <!-- End: Job Overview -->
                                                <!-- Start: quick links style="position: fixed;margin-top: -315px;margin-right: 66px;" -->
                                                <div class="widget-boxed" id="bar-fixed" >
                                                   <div class="widget-boxed-header">
                                                      <h4><i class="ti-headphone padd-r-10"></i>Quick Links</h4>
                                                   </div>
                                                   <div class="widget-boxed-body">
                                                      <div class="side-list no-border" >
                                                         <ul>
                                                            <li>
                                                               <div><a @click="scrollto('personalinformationl');" href="javascript:;">Personal Information</a> <span><i class="ti-check-box green" ></i></span></div>
                                                            </li>
                                                            <li>
                                                               <div><a @click="scrollto('coverletter');" href="javascript:;">Cover Letter</a><span ><i v-if="resumes.resumeResume.length>0" class="ti-check-box green" ></i> <i v-else>Pending</i></span></div>
                                                            </li>
                                                            <li>
                                                               <div><a @click="scrollto('education');" href="javascript:;" >Education</a><span><i v-if="resumes.resumeEducation.length>0" class="ti-check-box green" ></i> <i v-else>Pending</i></span></div>
                                                            </li>
                                                            <li>
                                                               <div><a @click="scrollto('worknexperience');" href="javascript:;" >Work & Experience</a><span><i v-if="resumes.resumeProfession.length>0" class="ti-check-box green" ></i> <i v-else>Pending</i></span></div>
                                                            </li>
                                                            <li>
                                                               <div><a @click="scrollto('certification');" href="javascript:;">Certification</a><span><i v-if="resumes.resumeCertification.length>0" class="ti-check-box green" ></i> <i v-else>Pending</i></span></div>
                                                            </li>
                                                            <li>
                                                               <div><a @click="scrollto('skills');" href="javascript:;">Skills</a><span><i v-if="resumes.resumeSkills.length>0" class="ti-check-box green" ></i> <i v-else>Pending</i></span></div>
                                                            </li>
                                                         </ul>
                                                      </div>
                                                   </div>
                                                </div>
                                                <!-- End: quick links -->
                                             </div>
                                          </div>
                                       </div>   
                                    </div>
                              </div>
                              <div role="tabpanel" class="tab-pane fade" id="resume">
                                 <div class="row" style="padding: 15px 0">
                                    <div class="col-md-12">
                                       <iframe v-for="coverl in resumes.resumeResume" v-if="coverl.resume!=''" id="pdfFrame" :src="baseUrl+'/admin_assets/resume/'+coverl.resume"  width="100%" height="700px">
                                       </iframe>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </section>

               <div class="modal fade" id="message" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content" id="myModalLabel1">
               <span class="close-popup" data-dismiss="modal"><i class="fa fa-times"></i></span>
               <div class="modal-body">
                  <!-- Tab panels -->
                  <div class="tab-content">
                     <!-- Employer Panel 1-->
                     <h5 class="modal-heading" >Message</h5>
                     <div class="tab-pane fade in show active" id="employer" role="tabpanel">
                        <form @submit="sendmessage"class="advance_search_form1" id="advance_search_form">
                           <div class="form-group col-md-12 col-xs-12 padding-left-0">
                              <label>Type your message</label>
                               <textarea  name="Message" v-model="message" class="form-control height-120" placeholder="Type your message"></textarea>
                              <p class="error_msg" >{{ message_error }}</p>
                           </div>
                           
                           
                           <div class="form-group text-center">
                              <button  type="submit" class="btn theme-btn btn-m">Send </button>
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
      <!-- End message Window -->

            <!-- message Window start -->
      <div :class="{ in: modalShown }" class="modal fade" id="interview_scheduled_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
         <div class="modal-dialog">
             <div class="modal-content" id="myModalLabel1">
                        <span class="close-popup" data-dismiss="modal"><i class="fa fa-times"></i></span>
                        <div class="modal-body">
                           <!-- Tab panels -->
                           <div class="tab-content">
                              <!-- Employer Panel 1-->
                              <h5 class="modal-heading" >Scheduled Interview </h5>
                              <div class="tab-pane fade in show active" id="employer" role="tabpanel">
                                 <form class="advance_search_form" @submit="submitInterview" id="advance_search_form2">
                                    <div class="form-group col-md-6 col-xs-12 padding-left-0">
                                       <label>Date</label>
                                       <datepicker v-validate="'required'" :format="formatDate" v-model="interviewDate" name="Date" class="form-control" ></datepicker>
                                       <p class="error_msg" >{{ errors.first('Date') }}</p>
                                    </div>
                                    <div class="form-group col-md-6 col-xs-12 padding-left-0 ">
                                       <label class="width-100">Time</label>
                                       <div class="form-group col-md-12 col-xs-12 padding-left-0 padding-right-0 margin-bottom-0">
                                          <select v-validate="'required'" name="Time" class="wide form-control" v-model="interviewTime">
                                             <option value="9:00 AM - 9:30 PM">9:00 PM - 9:30 PM</option>
                                                <option value="9:30 AM - 10:00 PM">9:30 PM - 10:00 PM</option>
                                                <option value="10:00 AM - 10:30 AM">10:00 AM - 10:30 AM</option>
                                                <option value="10:30 AM - 11:00 AM">10:30 AM - 11:00 AM</option>
                                                <option value="11:00 AM - 11:30 AM">11:00 AM - 11:30 AM</option>
                                                <option value="11:30 AM - 12:00 PM">11:30 AM - 12:00 PM</option>
                                                <option value="12:00 PM - 12:30 PM">12:00 PM - 12:30 PM</option>
                                                <option value="12:30 PM - 1:00 PM">12:30 PM - 1:00 PM</option>
                                                <option value="1:00 PM - 1:30 PM">1:00 PM - 1:30 PM</option>
                                                <option value="1:30 PM - 2:00 PM">1:30 PM - 2:00 PM</option>
                                                <option value="2:00 PM - 2:30 PM">2:00 PM - 2:30 PM</option>
                                                <option value="2:30 PM - 3:00 PM">2:30 PM - 3:00 PM</option>
                                                <option value="3:00 PM - 3:30 PM">3:00 PM - 3:30 PM</option>
                                                <option value="3:30 PM - 4:00 PM">3:30 PM - 4:00 PM</option>
                                                <option value="4:00 PM - 4:30 PM">4:00 PM - 4:30 PM</option>
                                                <option value="4:30 PM - 5:00 PM">4:30 PM - 5:00 PM</option>
                                                <option value="5:00 PM - 5:30 PM">5:00 PM - 5:30 PM</option>
                                                <option value="5:30 PM - 6:00 PM">5:30 PM - 6:00 PM</option>
                                                <option value="6:00 PM - 6:30 PM">6:00 PM - 6:30 PM</option>
                                                <option value="6:30 PM - 7:00 PM">6:30 PM - 7:00 PM</option>
                                          </select>
                                          <p class="error_msg" >{{ errors.first('Time') }}</p>
                                       </div>
                                        <!-- <div class="form-group col-md-6 col-xs-12 padding-right-0 margin-bottom-0">
                                          <select class="wide form-control">
                                             <option data-display="End">End Time</option>
                                             <option value="1">10:00</option>
                                             <option value="2">10:30</option>
                                             <option value="3">11:00</option>
                                             <option value="4">11:30</option>
                                          </select>
                                       </div> -->
                                    </div>
                                    <div class="form-group col-md-6 col-xs-12 padding-left-0 ">
                                       <label>Venue</label>
                                       <div class="form-group margin-bottom-0">
                                          <select v-validate="'required'" name="Venue" class="wide form-control" v-model="venueName">
                                             <option value="">Select Venue</option>
                                             <option v-if="venues" v-for="venue in venues" :value="venue.venue_id">{{venue.venue_name}}</option>
                                          </select>
                                          <p class="error_msg" >{{ errors.first('Venue') }}</p>
                                       </div> 
                                      
                                    </div>
                                    <div class="form-group col-md-6 col-xs-12 padding-left-0 ">
                                       <label>Contact Person</label>
                                       <input v-validate="'required'" type="text" v-model="contactPerson" name="ContactPerson" class="wide form-control" />
                                       <p class="error_msg" >{{ errors.first('ContactPerson') }}</p>      
                                    </div>
                                    <div class="form-group col-md-6 col-xs-12 padding-left-0 ">
                                       <label>Email Id</label>
                                       <input name="Email" v-validate="'required|email'" type="text" class="wide form-control" v-model="contactEmail" />
                                       <p class="error_msg" >{{ errors.first('Email') }}</p>  
                                    </div>
                                    <div class="form-group col-md-6 col-xs-12 padding-left-0 ">
                                       <label>Contact Number</label>
                                       <input name="ContactNo" v-validate="'required'" type="text" v-model="contactNo" class="wide form-control" />
                                       <p class="error_msg" >{{ errors.first('ContactNo') }}</p>  
                                    </div>
                                    <div class="form-group col-md-12 col-xs-12 padding-left-0">
                                       <label>Instruction</label>
                                        <textarea class="form-control height-120" v-model="instruction" placeholder="Instruction"></textarea>
                                    </div>
                                    <div class="form-group text-center">
                                       <button type="submit"  class="btn theme-btn btn-m">Submit</button>
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
     </div>
 </template>

 <script>
 import Datepicker from 'vuejs-datepicker';
  import VueMoment from 'vue-moment'; 
     export default {
       components: {
        Datepicker,
      },
        data: () => ({
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            resumes:[],
            dob:'',
            baseUrl:'',
            candidates:[],
             allSelected:false,
             venues:{},
             interviewDate:'',
             interviewTime:'',
             venueName:'',
             contactPerson:'',
             contactEmail:'',
             contactNo:"",
             instruction:"",
             modalShown: true,
             message:'',
             message_error:'',
             appid:'',
             appdetails:{}
          }),
          
        async beforeMount()
         {
            this.baseUrl=Laravel.baseUrl;
            await this.getresumedetails(Laravel.user_id);
             this.getapplicationStatus();
         },
         created: function () {
            this.getvenues();
         },
         methods:{
            updatecandidate(userid)
            {
               this.candidates=[userid];
            },
            getapplicationStatus()
            {

            },
            scrollto(id){
               $('html, body').animate({
                 scrollTop: $("#"+id).offset().top-85
             }, 500);
            },
            changedob(date)
            {
               this.dob=this.$moment(date).format('MMMM DD,YYYY');
            },
            formatDate (date) {
              return this.$moment(date).format('MM/DD/YYYY')
            },
            getresumedetails(page) {
                  var serff=this;
                  var pathArray=window.location.pathname.split('/');
                  this.appid = pathArray[4];
                  axios
                 .get(Laravel.baseUrl+'/getUsersResumeDetails?access_token='+btoa(page)+'&appid='+this.appid)
                 .then(response => {
                  serff.resumes=response.data;
                  serff.appdetails=response.data.appdetails;
                  console.log(serff.appdetails);
                 if(serff.resumes.userDetails.user_dob!='' && serff.resumes.userDetails.user_dob!=null)
                  {
                     serff.changedob(serff.resumes.userDetails.user_dob);
                  }
                  })
               },
               submitInterview:function(e)
               {
                  e.preventDefault();
                  var selff=this;
                     let currentObj = new FormData();
                     /*var pathArray=window.location.pathname.split('/');
                     var secondLevelLocation = pathArray[3];*/
                     currentObj.append('interviewDate', this.interviewDate);
                     currentObj.append('interviewTime', this.interviewTime);
                     currentObj.append('venueName', this.venueName);
                     currentObj.append('contactPerson', this.contactPerson);
                     currentObj.append('contactEmail', this.contactEmail);
                     currentObj.append('contactNo', this.contactNo);
                     currentObj.append('instruction', this.instruction);
                     currentObj.append('candidates', this.candidates);
                     currentObj.append('jobid', btoa(this.appdetails.job_id));
                     this.$validator.validateAll().then((result)=>{
                      if(!result){
                        return false;
                      }
                     axios.post(Laravel.baseUrl+'/employer/scheduleInterview',currentObj)
                      .then(function (response) {
                          $("#interview_scheduled_modal").modal('toggle');
                          selff.appdetails.applicationStatus='Interview';
                           selff.flash("Interview Scheduled successfuly",'success', {timeout: 3000});
                       }).catch(function (error) {
                          currentObj.output = error;
                          selff.flash(error,'danger', {timeout: 3000});
                      })
                     })
               },
               sendmessage1(userid)
               {
                  this.candidates=[userid];
               },
               sendmessage:function(e)
               {
                  
                  e.preventDefault();
                  var selff=this;
                     let currentObj = new FormData();
                     var pathArray=window.location.pathname.split('/');
                     var secondLevelLocation = pathArray[3];
                     currentObj.append('message', this.message);
                     currentObj.append('candidates', this.candidates);
                     currentObj.append('jobid', secondLevelLocation);
                      if(this.message==''){
                        this.message_error="Please enter your message";
                        return false;
                      }
                     axios.post(Laravel.baseUrl+'/employer/sendMessage',currentObj)
                      .then(function (response) {
                          $("#message").modal('toggle');
                         

                          selff.candidates=[];
                          selff.message=''
                         selff.flash("Message sent successfuly",'success', {timeout: 3000});
                       }).catch(function (error) {
                          currentObj.output = error;
                          selff.flash(error,'danger', {timeout: 3000});
                      })
                     
               },
               getvenues()
               {
                  var serff=this;
                  axios
                    .get(Laravel.baseUrl+'/employer/fetchvenuelist')
                    .then(response => {console.log(response);serff.venues = response.data;});
               },
               updateApplicationStatus(appid,index,status)
            {
                  this.candidates=[appid+'_'+index];
                  this.updateApplicationStatus2(status);
            },
            async updateApplicationStatus2(status)
            {
               let currentObj = new FormData();
               var serff=this;
                 var pathArray=window.location.pathname.split('/');
               var secondLevelLocation = pathArray[3];
               currentObj.append('appid', this.candidates);
               currentObj.append('job_id',secondLevelLocation)
               currentObj.append('status', status);
               await axios.post(Laravel.baseUrl+'/employer/updateApplicationStatus',currentObj)
                .then(function (response) {
                  
                  $.each(serff.candidates, function(index,values) {
                     
                      var pathArray=values.split('_');
                      var index=pathArray[1];
                serff.appdetails.applicationStatus=status;
               });
                  serff.flash("Application status updated successfully",'success', {timeout: 3000});
                 }).catch(function (error) {
                    currentObj.output = error;
                    serff.flash(currentObj.output,'error', {timeout: 3000});
                })
            }
         }
    }

 
</script>
		
		<!-- ====================== End Resume Detail ================ -->