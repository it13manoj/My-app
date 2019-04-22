<template>
   <div>
             <!-- ======================= Start Navigation ===================== -->
      <nav class="navbar navbar-default navbar-mobile navbar-fixed light bootsnav padd-bot-10">
         <div class="container">
            <!-- Start Logo Header Navigation -->
            <div class="navbar-header">
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
               <i class="fa fa-bars"></i>
               </button>
               <router-link to="/" class="navbar-brand">
               <img src="/../home_assets/img/logo.png" class="logo logo-display" alt="">
               <img src="/../home_assets/img/logo.png" class="logo logo-scrolled" alt="">
               </router-link>
            </div>
            <!-- End Logo Header Navigation -->
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-menu">
               <ul class="nav navbar-nav navbar-right">
                  <li class="sign-up">
                     <router-link to="/user_dashboard" class="btn-signup btn-radius red-btn">Dashboard</router-link>
                  </li>
               </ul>
            </div>
            <!-- /.navbar-collapse -->
         </div>
      </nav>
      <div class="padding-top-7">
         <div class="container">
            <div class="row">
                  <div class="col-md-12 col-sm-12 steps padd-r-0 padd-l-0">
                     <div class="col-md-2 ">
                        <div class="steps_box " v-bind:class="{'active_tab':($route.name=='user_profile/personalinfo')}">
                           <router-link to="/user_profile/personalinfo" aria-controls="signup-form-p-0">
                              <span class="title">
                                 <span class="icon"><i class="ti-user"></i></span>
                                 <span class="title_text">Personal</span>
                              </span>
                           </router-link>
                        </div>
                     </div>
                     <div class="col-md-2 ">
                        <div class="steps_box" v-bind:class="{'active_tab':($route.name=='user_profile/educationaldetails')}">
                              <router-link to="/user_profile/educationaldetails" aria-controls="signup-form-p-0">
                              <span class="title">
                                 <span class="icon"><i class="ti-book"></i></span>
                                 <span class="title_text">Education</span>
                              </span>
                           </router-link>
                        </div>
                     </div>
                     <div class="col-md-2 ">
                        <div class="steps_box" v-bind:class="{'active_tab':($route.name=='user_profile/professionaldetails')}">
                           
                           <router-link to="/user_profile/professionaldetails" aria-controls="signup-form-p-0">
                              <span class="title">
                                 <span class="icon"><i class="icon-documents"></i></span>
                                 <span class="title_text">Professional</span>
                              </span>
                           </router-link>
                        </div>
                     </div>
                     <div class="col-md-2 ">
                        <div class="steps_box" v-bind:class="{'active_tab':($route.name=='user_profile/certificationdetails')}">
                          <router-link to="/user_profile/certificationdetails" aria-controls="signup-form-p-0">
                               
                              <span class="title">
                                 <span class="icon"><i class="ti-medall"></i></span>
                                 <span class="title_text">Certificates</span>
                              </span>
                           </router-link>
                        </div>
                     </div>
                     <div class="col-md-2 ">
                           <div class="steps_box" v-bind:class="{'active_tab':($route.name=='user_profile/skillsdetails')}">
                                 <router-link to="/user_profile/skillsdetails" aria-controls="signup-form-p-0">
                                 <span class="title">
                                    <span class="icon"><i class="ti-medall-alt"></i></span>
                                    <span class="title_text">Skills</span>
                                 </span>
                              </router-link>
                           </div>
                     </div>
                     <div class="col-md-2 ">
                           <div class="steps_box" v-bind:class="{'active_tab':($route.name=='user_profile/resume')}">
                              <router-link to="/user_profile/resume" aria-controls="signup-form-p-0">
                                  
                                 <span class="title">
                                    <span class="icon"><i class="ti-user"></i></span>
                                    <span class="title_text">Resume</span>
                                 </span>
                              </router-link>
                           </div>
                     </div>
                  </div>
            </div>
         </div>
      </div>
      </div>
</template>