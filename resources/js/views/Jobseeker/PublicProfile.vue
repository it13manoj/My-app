<template>
   <div>
    <section class="padding-top-7">
                  <div class="container">
                     <div>
                        <div class="tab style-2" role="tabpanel">
                           <!-- Nav tabs -->
                           <!-- <ul class="nav nav-tabs" role="tablist">
                              <li role="presentation" class="active"><a href="#profile" aria-controls="home2" role="tab" data-toggle="tab">Profile</a></li>
                              <li v-for="coverl in resumes.resumeResume" v-if="coverl.resume!=''" role="presentation"><a href="#resume" aria-controls="profile2" role="tab" data-toggle="tab">Resume</a></li>
                             
                           </ul> -->
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
                                                            <i class="ti-email padd-r-10"></i><span data-toggle="tooltip" data-placement="top" title="Email">{{resumes.userDetails.email}}<!--  <a v-if="resumes.userDetails.is_email_verified==0" href="#"><span class="verify"> Verify </span></a> <span v-else class="ti-check-box green"></span>  --></span>
                                                         </div>
                                                         <div class="col-sm-4 mrg-bot-10" >
                                                            <i class="ti-mobile padd-r-10"></i><span data-toggle="tooltip" data-placement="top" title="Contact Number">{{resumes.userDetails.user_contact}} <!-- <a v-if="resumes.userDetails.is_contact_verified==0" href="#"><span class="verify"> Verify </span></a> <span v-else class="ti-check-box green"></span> --> </span>
                                                         </div>
                                                         <div v-if="resumes.userDetails.user_current_salary!='' && resumes.userDetails.user_current_salary!=null" class="col-sm-4 mrg-bot-10" >
                                                            <i class="ti-credit-card padd-r-10"></i><span data-toggle="tooltip" data-placement="top" title="Current Salary" >{{resumes.userDetails.user_current_salary}} Rs/Year</span> 
                                                         </div>
                                                         <div  v-if="resumes.userDetails.user_experience_year!='' && resumes.userDetails.user_experience_year!=null" class="col-sm-4 mrg-bot-10" >
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
                                                               <div  class="pull-left"><span class="ti-location-pin padd-r-10"></span></div>
                                                               <div><span  data-toggle="tooltip" data-placement="top" title="Prefered Location">{{resumes.userDetails.user_prefered_location}}</span></div>
                                                            </li>
                                                            <li v-if="resumes.usermeta">
                                                               <div class="pull-left"><span class="ti-calendar padd-r-10"></span></div>
                                                               <div><span v-if="resumes.usermeta.notice_period"  data-toggle="tooltip" data-placement="top" title="Notice Period">{{resumes.usermeta.notice_period}}</span></div>
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
                              <div v-for="coverl in resumes.resumeResume" v-if="coverl.resume!=''" role="tabpanel" class="tab-pane fade" id="resume">
                                 <div class="row" style="padding: 15px 0">
                                    <div class="col-md-12">
                                       <iframe id="pdfFrame" :src="baseUrl+'/admin_assets/resume/'+coverl.resume"  width="100%" height="700px">
                                       </iframe>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </section>
     </div>
 </template>

 <script>
  import VueMoment from 'vue-moment'; 
     export default {
        data: () => ({
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            resumes:[],
            dob:'',
            baseUrl:''
          }),
          
        async beforeMount()
         {
            this.baseUrl=Laravel.baseUrl;
            var pathArray=window.location.pathname.split('/');
               var secondLevelLocation = pathArray[2];
            await this.getresumedetails(secondLevelLocation);
         },
         created: function () {

         },
         methods:{
            scrollto(id){
               $('html, body').animate({
                 scrollTop: $("#"+id).offset().top-85
             }, 500);
            },
            changedob(date)
            {
               this.dob=this.$moment(date).format('MMMM DD,YYYY');
            },
            getresumedetails(page) {
                  var serff=this;
                  axios
                 .get(Laravel.baseUrl+'/getUsersResumeDetails?profile_slug='+btoa(page))
                 .then(response => {
                  serff.resumes=response.data;
                 if(serff.resumes.userDetails.user_dob!='' && serff.resumes.userDetails.user_dob!=null)
                  {
                     serff.changedob(serff.resumes.userDetails.user_dob);
                  }
                  document.title = Laravel.appName+' | '+serff.resumes.userDetails.user_first_name+' '+serff.resumes.userDetails.user_last_name;
                  })
               },
         }
    }

 
</script>
		
		<!-- ====================== End Resume Detail ================ -->