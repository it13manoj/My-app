<template>
   <div>
     
          <!-- ======================= End Navigation ===================== -->
               <!-- ====================== Start Signup Form ============= -->
               <section class="">
                  <div class="container">
                     <div class="row">
                        
                        <div class="col-md-12">
                           <!-- General Information -->
                           <div class="box">
                              <div class="box-header">
                                 <div class="width-100">
                                    <h4 class="pull-left">Personal Information </h4><!-- <span class="pull-right set_upper_button"><a href="#" class="angle_left hide"> <i class="fa fa-angle-left" ></i></a><a href="education_info.html" class="angle_right"><i class="fa fa-angle-right" ></i></a> </span> -->
                                    <flash-message class="myCustomClass" variant="success"></flash-message>
                                 </div> 
                              </div>
                              <div class="box-body">
                                 <form enctype="multipart/form-data" class="c-form" @submit="submitemp">
                                       <div class="row">
                                          <div class="form-group col-sm-4 mrg-bot-10">
                                             <label>First Name <span>*</span></label>
                                             <input v-validate="'required|alpha'" type="text" name="user_first_name" v-model="firstName" class="form-control" > 
                                             <p class="error_msg" >{{ errors.first('user_first_name') }}</p>
                                          </div>
                                          <div class="form-group col-sm-4 mrg-bot-10">
                                             <label>Last Name <span>*</span></label>
                                             <input v-validate="'required|alpha'" type="text" v-model="lastName" name="user_last_name" class="form-control" > 
                                             <p class="error_msg" >{{ errors.first('user_last_name') }}</p>
                                          </div>
                                          <div class="form-group col-sm-4 mrg-bot-10">
                                             <label>Email <span>*</span></label>
                                             <input type="email" v-validate="'required|email'" v-model="email" name="email" class="form-control" > 
                                             <p class="error_msg" >{{ errors.first('email') }}</p>
                                          </div>
                                       </div>
                                       <div class="row">
                                          <div class="form-group col-sm-4 mrg-bot-10">
                                             <label>Contact Number <span>*</span></label>
                                             <input type="text" v-validate="'required|digits:10'" v-model="contact" name="user_contact" class="form-control" > 
                                             <p class="error_msg" >{{ errors.first('user_contact') }}</p>
                                          </div>
                                          <div class="form-group col-sm-4 mrg-bot-10">
                                             <label>Date of birth<span>*</span></label>
                                             <!-- <input v-model="dob" name="dob" type="text" class="date-from form-control" v-validate="'required'"> -->
                                              <datepicker v-model="dob" name="dob" type="text" v-validate="'required'"  :format="formatDate"></datepicker>

                                             <p class="error_msg" >{{ errors.first('dob') }}</p>
                                          </div>
                                          <div class="form-group col-sm-4 mrg-bot-10">
                                             <label class="width-100">Gender <span>*</span></label>
                                             <select v-validate="'required'" class="wide form-control" v-model="gender" name="gender">
                                                <option value="">Select</option>
                                                <option value="Female">Female</option>
                                                <option value="Male">Male</option>
                                                <option value="Other">Other</option>
                                             </select>
                                             <span class="error_msg" >{{ errors.first('gender') }}</span>

                                          </div>
                                       </div>
                                       <div class="row">
                                          <div class="form-group col-sm-4 mrg-bot-10">
                                             <label class="width-100">Nationality</label>
                                             <select v-validate="'required'" v-model="nationality" name="nationality" class="wide form-control">
                                                      <option value="" >Select</option>
                                                      <option v-for="country in countrylist" :value="country.country_id">{{country.country_name}}</option>
                                             </select>
                                             <span class="error_msg" >{{ errors.first('nationality') }}</span>
                                          </div>
                                          <div class="form-group col-sm-4 mrg-bot-10">
                                             <label class="width-100">Work Authorization Status</label>
                                              <select class="wide form-control" v-model="workauth" name="workauth">
                                                      <option value="">Select</option>
                                                      <option value="1">Have H1 Visa</option>
                                                      <option value="2">Need H1 Visa</option>
                                                      <option value="3">TN Permit Holder)</option>
                                                      <option value="4">Green Card Holder</option>
                                                      <option value="5">National Open School</option>
                                                      <option value="6">US Citizen</option>
                                                      <option value="7">Authorized to work in US</option>
                                                      
                                             </select>
                                             <span class="error_msg" >{{ errors.first('workauth') }}</span>
                                          </div>
                                          <div class="form-group col-sm-4 mrg-bot-10">
                                             <label>Aadhar Card</label>
                                             <input v-validate="'required'" v-model="adhaar" name="adhaar" type="text" class="form-control" >
                                             <p class="error_msg">{{ errors.first('adhaar') }}</p>
                                          </div>
                                       </div>
                                          <!-- <div class="col-sm-4 mrg-bot-10">
                                             <label>PAN Card</label>
                                             <input type="text" class="form-control" >
                                          </div>
                                          <div class="col-sm-4 mrg-bot-10">
                                             <label>Passport Number</label>
                                             <input type="text" class="form-control" >
                                          </div> -->
                                       
                                          <!-- <div class="form-group profile_detail"> -->
                                             <div class="row">
                                                <div class="form-group col-sm-4 mrg-bot-10">
                                                   <label>Current Designation <span>*</span></label>
                                                   <input v-validate="'required'" v-model="designation" name="designation" type="text" class="form-control" > 
                                                   <p class="error_msg">{{ errors.first('designation') }}</p>
                                                </div>
                                                <div class="form-group col-sm-4 mrg-bot-10">
                                                   <label class="width-100">Industry <span>*</span></label>
                                                   <select v-validate="'required'" @change="getfunctionalarea" class="wide form-control" name="industry" v-model="industry">
                                                      <option value="">Select</option>
                                                      <option v-for="indust in industrylist" :value="indust.category_id">{{indust.category_name}}</option>
                                                   </select>
                                                   <span class="error_msg">{{ errors.first('industry') }}</span>
                                                </div>
                                                <div class="form-group col-sm-4 mrg-bot-10">
                                                   <label class="width-100">Functional Area <span>*</span></label>
                                                   <select v-validate="'required'" name="functionalarea" v-model="functionalarea" class="wide form-control">
                                                      <option value="">Select</option>
                                                      <option v-for="functional in functionalarealist" :value="functional.subcategory_id">{{functional.subcategory_name}}</option>
                                                   </select>
                                                   <span class="error_msg">{{ errors.first('functionalarea') }}</span>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="form-group col-sm-4 mrg-bot-10 m-clear">
                                                   <label class="width-100">Experience <span>*</span></label>
                                                   <div class="col-sm-6 padd-l-0 padd-r-0">
                                                      <select v-validate="'required'" name="expyear" v-model="expyear" class="wide form-control">
                                                         <option data-display="Year">Select</option>
                                                         <option value="1">1 Year</option>
                                                         <option value="2">2 Year</option>
                                                      </select>
                                                   </div>
                                                   <div class="col-sm-6  padd-r-0">
                                                      <select v-validate="'required'" class="wide form-control" name="expmonth" v-model="expmonth">
                                                         <option data-display="Months">Select</option>
                                                         <option value="1">1 Month</option>
                                                         <option value="2">2 Months</option>
                                                      </select>
                                                   </div>
                                                   <span class="error_msg">{{ errors.first('expyear') }} {{ errors.first('expmonth') }}</span>
                                                </div>
                                                <div class="form-group col-sm-4 mrg-bot-10 m-clear">
                                                   <label >Job Type</label>
                                                   <select v-validate="'required'" class="wide form-control" v-model="jobtype" name="jobtype">
                                                      <option data-display="Job Type">Full Time</option>
                                                      <option value="1">Part Time</option>
                                                      <option value="2">Freelancer</option>
                                                   </select>
                                                   <span class="error_msg">{{ errors.first('jobtype') }}</span>
                                                </div>
                                             
                                          <!-- </div> -->
                                          <!-- <div class="salary_info"> -->
                                                <div class="form-group col-sm-4 mrg-bot-10 m-clear">
                                                   <label class="width-100">Current Salary <span>*</span></label>
                                                   <div>
                                                      <div class="col-sm-12 padd-l-0 padd-r-0">
                                                         <input v-validate="'required'" type="number" name="currentsalary" v-model="currentsalary" class="form-control">
                                                         <p class="error_msg">{{ errors.first('currentsalary') }}</p>
                                                      </div>
                                                      
                                                   </div>
                                                   <div class="mrg-bot-0">
                                                      <span class="custom-checkbox">
                                                         <input type="checkbox" id="notDisclosed" v-model="notDisclosed" value="1">
                                                         <label for="notDisclosed"></label>Not Disclosed
                                                      </span>
                                                   </div>
                                                   <span class="error_msg"></span>
                                                </div>
                                             </div>
                                             <div class="row">
                                             <div class="form-group col-sm-4 mrg-bot-10 m-clear">
                                                <label class="width-100">Expected Salary <span>*</span></label>
                                                <div>
                                                   <div class=" col-sm-12 padd-l-0 padd-r-0">
                                                      <input v-validate="'required'" type="number" name="expectedsalary" v-model="expectedsalary" class="form-control">
                                                      <p class="error_msg">{{ errors.first('expectedsalary') }}</p>
                                                   </div>
                                                   

                                                </div>
                                                <div class=" mrg-bot-0">
                                                   <span class="custom-checkbox">
                                                      <input type="checkbox" v-model="negotiable" value="1" id="Negotiable">
                                                      <label for="Negotiable"></label>Negotiable
                                                   </span>
                                                </div>
                                                <span class="error_msg"> </span>
                                             </div>
                                         <!--  </div> -->
                                          <!-- <div class="location_info"> -->
                                             <div class="form-group col-sm-4 mrg-bot-10">
                                                <label>Current Location <span>*</span></label>
                                                <input v-validate="'required'" type="text" class="form-control" v-model="currentlocation" name="currentlocation">
                                                <p class="error_msg">{{ errors.first('currentlocation') }}</p>
                                             </div>
                                             <div class="form-group col-sm-4 mrg-bot-10">
                                                <label>Prefered Location</label>
                                                <input v-validate="'required'" type="text" class="form-control" v-model="perferedlocation" name="perferedlocation">
                                                <p class="error_msg">{{ errors.first('perferedlocation') }}</p>
                                             </div>
                                          </div>
                                         <!--  </div> -->
                                       
                                       <div class="row mrg-bot-10">
                                       <div class="form-group col-sm-6 mrg-bot-10">
                                             <label>Notice Period</label>
                                             <div class="custom-file-upload form-control">
                                                <select class="wide form-control" name="noticeperiod" v-model="noticeperiod">
                                                <option value="">Select</option>
                                                <option value="Immidiate">Immediate</option>
                                                <option value="15 Days">15 Days</option>
                                                <option value="1 Month">1 Month</option>
                                                <option value="2 Months">2 Months</option>
                                                <option value="3 Months">3 Months</option>
                                                <option value="4 Months">4 Months</option>
                                                <option value="5 Months">5 Months</option>
                                                <option value="6 Months">6 Months</option>
                                             </select>
                                             </div>
                                       </div>
                                       <div class="form-group col-sm-6 mrg-bot-10">
                                             <label>Profile Image</label>
                                             <div class="custom-file-upload form-control">
                                                <input @change="changefile" type="file" id="file" name="profilepicture" placeholder="Browse" class="" accept="image/*" />
                                                <input type="hidden" name="profilepic" v-model="profilepic">
                                             </div>
                                       </div>
                                    </div>
                                       
                                       
                                       <div class="row">
                                          <label class="width-100 font-20next">Social Accounts</label>
                                          <div class="form-group col-sm-4 mrg-bot-10 padd-r-0 padd-l-0">
                                             <label>Facebook</label>
                                             <input type="text" class="form-control" name="fbid" v-model="fbid">
                                          </div>
                                          <div class="form-group padd-r-0 col-sm-4 mrg-bot-10">
                                             <label>Twitter</label>
                                             <input name="twitterid" v-model="twitterid" type="text" class="form-control" >
                                          </div>
                                          <div class="form-group padd-r-0 col-sm-4 mrg-bot-10 padd-r-0 ">
                                             <label>Linkedin</label>
                                             <input type="text" class="form-control" name="linkedinid" v-model="linkedinid">
                                          </div>
                                       </div>
                                       <div class="text-right ">
                                    
                                    <button type="submit" class="btn btn-m theme-btn"> Next </button>
                                 </div>
                                    </form>
                                    </div>
                                    
                                 
                              </div> 
                           </div>
                        </div>
                     </div>
               </section>
            </div>
         </template>
         <script>
         
          import Datepicker from 'vuejs-datepicker';
             import VueMoment from 'vue-moment'; 
           export default {
             components: {
                 Datepicker
               },
              data: () => ({
                  csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                  usertoken:'',
                  islogin:'',
                  firstName:'',
                  lastName:'',
                  email:'',
                  contact:'',
                  currentyear:'',
                  dob:'',
                  gender:'',
                  nationality:'',
                  workauth:'',
                  adhaar:'',
                  designation:'',
                  industry:'',
                  functionalarea:'',
                  expyear:'',
                  expmonth:'',
                  jobtype:'',
                  currentsalary:'',
                  expectedsalary:'',
                  currentlocation:'',
                  perferedlocation:'',
                  notDisclosed:'',
                  negotiable:'',
                  profilepic:'',
                  userid:'',
                  fbid:'',
                  twitterid:'',
                  linkedinid:'',
                  userimage:'',
                  countrylist:'',
                  industrylist:'',
                  functionalarealist:'',
                  noticeperiod:'',

                }),
                beforeCreate: function () {
                  document.title = Laravel.appName+' | Personal Details'
                if (!this.$session.exists()) {
                  this.$router.push('/')
                }
              },
              created: function () {
                
                this.usertoken=this.$session.get('user_token');
                this.getcountries();
               this.getindustries();
               this.getuserdetails(this.$session.get('user_token'));
                 var d = new Date();
                  this.currentyear = d.getFullYear();
                   const dict = {
                   custom: {
                     email: {
                       required: 'Please enter your email',
                       email:'Please enter a valid email'
                     },
                     user_first_name: {
                       required:'Please enter your first name.',
                       alpha:'First name may only contain alphabetic characters.'
                     },
                     user_last_name: {
                       required:'Please enter your last name.',
                       alpha:'Last name may only contain alphabetic characters.'
                     },
                     user_designation:{
                       required:'Please add your designation'
                     },
                     contact:{
                       required:'Please enter your contact number',
                     },
                   }
              };

              //Validator.localize('en', dict);
              // or use the instance method
              //this.$validator.localize('en', dict);
              },
              methods:
              {
               formatDate (date) {
              return this.$moment(date).format('MM/DD/YYYY')
            },
               getuserdetails(page) {
                  var serff=this;
                  axios
                 .get('/../getjobseekerdetails?access_token='+btoa(page))
                 .then(response => {
                     serff.firstName=response.data.user_first_name;
                     serff.lastName=response.data.user_last_name;
                     serff.email=response.data.email;
                     serff.contact=response.data.user_contact;
                     serff.dob=response.data.user_dob;
                     serff.gender=response.data.user_gender;
                     serff.nationality=response.data.user_nationality;
                     serff.workauth=response.data.workauth;
                     serff.adhaar=response.data.user_id_proof;
                     serff.designation=response.data.user_designation;
                     serff.industry=response.data.user_industry;
                     serff.functionalarea=response.data.user_functional_area;
                     serff.expyear=response.data.user_experience_year;
                     serff.expmonth=response.data.user_experience_months;
                     serff.jobtype=response.data.job_type;
                     serff.currentsalary=response.data.user_current_salary;
                     serff.expectedsalary=response.data.user_expected_salary;
                     serff.currentlocation=response.data.user_current_location;
                     serff.perferedlocation=response.data.user_prefered_location;
                     serff.notDisclosed=response.data.user_salary_confidential;
                     serff.negotiable=response.data.user_salary_negotiable;
                     serff.profilepic=response.data.user_profile_picture;
                     serff.userid=response.data.id;
                     serff.fbid=response.data.user_fb_link;
                     serff.twitterid=response.data.user_twitter_link;
                     serff.linkedinid=response.data.user_linkedin_link;
                     serff.noticeperiod=response.data.notice_period;
                    // alert(response.data.notice_period);
                     this.getfunctionalarea();
                  })
               },
               getcountries:function()
               {
                  var serff=this;
                  axios
                 .get('/../getcountrieslist')
                 .then(response => {
                     serff.countrylist=response.data;
                  })
               },
               getindustries:function()
               {
                  var serff=this;
                  axios
                 .get('/../getindustrylist')
                 .then(response => {
                     serff.industrylist=response.data;
                  })
               },
               getfunctionalarea:function()
               {
                  var serff=this;
                  axios
                 .get('/../getfunctionalarealist?industry='+this.industry)
                 .then(response => {
                     serff.functionalarealist=response.data;
                  })
               },
               changefile:function(e)
               {
                this.userimage=e.target.files[0];
               },
               submitemp:function(e){
               e.preventDefault();
              this.$validator.validateAll().then((result)=>{
                if(!result){
                  return false;
                }
                var selff=this;
                let currentObj = new FormData();
                  if(this.userimage!='' && this.userimage!=null){
                     currentObj.append('userimage', this.userimage, this.userimage.name);
                  }
                currentObj.append('user_first_name', this.firstName);
                currentObj.append('user_last_name', this.lastName);
                currentObj.append('email', this.email);
                currentObj.append('user_contact', this.contact);
                currentObj.append('user_role', 'Jobseeker');
                currentObj.append('user_dob', this.dob);
                currentObj.append('user_gender', this.gender);
                currentObj.append('workauth', this.workauth);
                currentObj.append('user_id_proof', this.adhaar);
                currentObj.append('user_designation', this.designation);
                currentObj.append('user_industry', this.industry);
                currentObj.append('user_functional_area', this.functionalarea);
                currentObj.append('user_experience_year', this.expyear);
                currentObj.append('user_experience_months', this.expmonth);
                currentObj.append('job_type', this.jobtype);
                currentObj.append('user_current_salary', this.currentsalary);
                currentObj.append('user_expected_salary', this.expectedsalary);
                currentObj.append('user_current_location', this.currentlocation);
                currentObj.append('user_prefered_location', this.perferedlocation);
                currentObj.append('user_salary_confidential', this.notDisclosed);
                currentObj.append('user_salary_negotiable', this.negotiable);
                currentObj.append('user_profile_picture', this.profilepic);
                currentObj.append('user_fb_link', this.fbid);
                currentObj.append('user_twitter_link', this.twitterid);
                currentObj.append('user_linkedin_link', this.linkedinid);
                currentObj.append('id', this.userid);
                currentObj.append('nationality',this.nationality);
                currentObj.append('notice_period',this.noticeperiod);
                axios.post('/../updatePersonalinfo',currentObj)
                .then(function (response) {

                    //currentObj.output = response.data;
                    selff.flash("Personal details updated successfuly",'success', {timeout: 3000});
                    //selff.$router.push("/../user_profile/educationaldetails");
                     window.location="/../user_profile/educationaldetails";
                    //this.emailerrors='';
                   // window.location="/home";
                    //router.go('/home');
                    //this.$router.push("/home");
                    //axios.get('/home');
                }).catch(function (error) {
                    //console.log(error);
                    //this.emailerrors='Invalid email or password.';
                    currentObj.output = error;

                })
              })
              e.preventDefault();
            },
              }
          }

         </script>
         <style type="text/css">
                  input[type=file] {
                     display: initial;
                     height: 35px;
                     }
                     .custom-file-upload{
                        height: 40px;
                        padding: 0;
                     }
                  .vdp-datepicker input
                  {
                    height: 40px;
                  border: 1px solid #dde6ef;
                  margin-bottom: 10px;
                  box-shadow: none;
                  border-radius: 5px;
                  background: #fbfdff;
                  font-size: 15px;
                  color: #6b7c8a;
                  font-weight: 400;
                  display: block;
                  width: 100%;
                  padding: 6px 12px;
                  line-height: 1.42857143;
                  }     

               </style>

               <!-- ====================== End Signup Form ============= -->

              