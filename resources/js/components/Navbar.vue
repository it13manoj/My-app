<template>
<nav class="navbar navbar-default navbar-mobile navbar-fixed light bootsnav newnavbar">
   <div class="container">
      <!-- Start Logo Header Navigation -->
      <div class="navbar-header">
         <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
         <i class="fa fa-bars"></i>
         </button>
         <router-link to="/" class="navbar-brand">
         <img :src="baseUrl+'/home_assets/img/logo.png'" class="logo logo-display" alt="">
         <img :src="baseUrl+'/home_assets/img/logo.png'" class="logo logo-scrolled" alt="">
         </router-link>
      </div>
      <!-- End Logo Header Navigation -->
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="navbar-menu">
         <ul class="nav navbar-nav navbar-left" data-in="fadeInDown" data-out="fadeOutUp">
            <li class="dropdown">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown">Home</a>
               <ul class="dropdown-menu animated fadeOutUp">
                  <li><router-link to="/">Home</router-link></li>
                  <li><a href="aboutus.html">About Us</a></li>
                  <li><a href="faqs.html">FAQs</a></li>
                  <li><a href="contactus.html">Contact Us</a></li>
                  <li><a href="tnc.html">Terms and Conditions</a></li>
               </ul>
            </li>
            <li v-if="user_role=='Employer'" class="dropdown">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown">Employer</a>
               <ul class="dropdown-menu animated fadeOutUp">
                  <li><a :href="baseUrl+'/employer/post_new_job'">Post Job</a></li>
                   <li><a :href="baseUrl+'/employer/manage_jobs'">Manage Jobs</a></li>
                   <li><a :href="baseUrl+'/employer/questionnaire'">Questionnaires</a></li>
                   <li><a :href="baseUrl+'/employer/venues'">Venues</a></li>
               </ul>
            </li>
            <li class="dropdown" v-if="user_role=='Jobseeker'">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown">Candidate</a>
               <ul class="dropdown-menu animated fadeOutUp">
                  <li><router-link to="/jobs">Browse All Jobs</router-link></li>
                  <li><a href="job-listing.html">Job Search</a></li>
                  
                  <li><a href="#">Self Assessment/Skill development</a></li>
                  <li class="dropdown">
                     <a href="#">Career Services <i class="fa fa-angle-right pull-right"></i></a>
                     <ul class="dropdown-menu animated fadeOutUp">
                        <li><a href="#">Audio Resumes/Video Resumes</a></li>
                        <li><a href="#">Resume development(Premium)</a></li>
                        <li><a href="#">Career Advice</a></li>
                        <li><a href="#">Interview preparation</a></li>
                        <li><a href="#">Salary Advice</a></li>
                        <li><a href="#">Job search techniques</a></li>
                        <li><a href="#">Job questionnaires</a></li>
                        <li><a href="#">Tips for Freshers/MBA/Engineers/Non-IT</a></li>
                     </ul>
                  </li>
               </ul>
            </li>
            
         </ul>
         <ul class="nav navbar-nav navbar-right">

            <li v-if="!islogin" class="sign-up"><router-link to="/userlogin" class="btn-signup btn-radius red-btn">Sign in</router-link></li>
             <li v-if="!islogin" class="sign-up"><router-link to="/registration" class="btn-signup btn-radius red-btn">Sign up</router-link></li>
            <li v-else class="dropdown sign-up">
                        <a class="dropdown-toggle " data-toggle="dropdown" href="javascript:;" >
                           
                            <img v-if="user_profile_pic_thumb!='' && user_profile_pic_thumb!=null" class="img-responsive img-circle" :src="baseUrl+'/admin_assets/uploaded_images/profile_pic/thumb/'+user_profile_pic_thumb" alt="">
                           
                              <img v-else class="img-responsive img-circle" :src="baseUrl+'/admin_assets/images/profile-default.png'" alt="">
                           
                        </a>
                        <ul v-if="user_role=='Jobseeker'" class="dropdown-menu animated fadeOutUp">
                           <li class="menu-per-info">
                              <p class="margin-bottom-0">
                                 <span>{{user_first_name}} {{user_last_name}}</span>
                                 <span>{{email}}</span>
                                 <span>Last Login: {{$moment(user_last_login).format('MMM DD,YYYY')}}</span>
                              </p>
                           </li>
                           <li><router-link to="/user_dashboard">View Dashboard</router-link></li>
                           <li><router-link to="/profile">View Profile</router-link></li>
                           <li><router-link to="/savedjobs">Saved Jobs</router-link></li>
                           <li><router-link to="/user_profile/personalinfo">Edit Profile</router-link></li>
                           
                           <li><router-link to="/user_profile/educationaldetails">Create Resume</router-link></li>
                           <li><!-- <a @click="logout" href="javascript:;">Sign Out</a> -->
                              <a @click="logout" :href="baseUrl+'/logout'"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Sign Out</a>
                                                      <form id="logout-form" :action="baseUrl+'/logout'" method="POST" style="display: none;">
                                        <input type="hidden" name="_token" v-model="token">
                                    </form>

                           </li>
                        </ul>
                        <ul v-else class="dropdown-menu animated fadeOutUp">
                           <li class="menu-per-info">
                              <p class="margin-bottom-0">
                                 <span>{{user_first_name}} {{user_last_name}}</span>
                                 <span>{{email}}</span>
                                 <span>Last Login: {{$moment(user_last_login).format('MMM DD,YYYY')}}</span>
                              </p>
                           </li>
                           <li><a :href="baseUrl+'/employer/home'">View Dashboard</a></li>
                           <li><a :href="baseUrl+'/employer/myInterview'">My Interview</a></li>
                           <li><a :href="baseUrl+'/employer/user/'+user_slug">View Profile</a></li>
                           <li><a :href="baseUrl+'/employer/edit_employer'">Edit Profile</a></li>

                           <li><a :href="baseUrl+'/employer/edit_organization'">Edit Organization</a></li>
                           <li><a @click="logout" :href="baseUrl+'/logout'"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Sign Out</a>
                                                      <form id="logout-form" :action="baseUrl+'/logout'" method="POST" style="display: none;">
                                        <input type="hidden" name="_token" v-model="token">
                                    </form>
                                  </li>
                        </ul>

                     </li>  
         </ul>
      </div>
      <!-- /.navbar-collapse -->
   </div>
</nav>
<!-- ======================= End Navigation ===================== -->
</template>
<script>
import VueMoment from 'vue-moment'; 
     export default {
        data: () => ({
            islogin:'',
            user_role:'',
            user_first_name:'',
            user_last_name:'',
            email:'',
            user_last_login:'',
            baseUrl: Laravel.baseUrl,
            token:Laravel.csrfToken,
            user_slug:'',
            user_profile_pic_thumb:''
          }),
          
        created:function()
         {

            if (!this.$session.exists()) {
                this.islogin=false;
                this.user_role='';
            }else
            {
               this.islogin=true;
               this.user_role=this.$session.get('user_role');
               this.user_first_name=this.$session.get('user_first_name');
               this.user_last_name=this.$session.get('user_last_name');
               this.user_last_login=this.$session.get('user_last_login');
               this.email=this.$session.get('email');
               this.user_slug=this.$session.get('user_slug');
               this.user_profile_pic_thumb=this.$session.get('user_profile_pic_thumb')
            }
         },
         methods:{
            logout:function()
            {
               this.$session.destroy()
                //this.$router.push('/')
                this.islogin=false
                this.user_role=''
                this.user_first_name=''
                this.user_last_name=''
                this.email=''
                this.user_slug=''
                this.user_last_login=''
                this.$router.push('/')
            }
         }
    }


</script>
<style>
.sign-up
{
  margin-left:5px;
}
</style>