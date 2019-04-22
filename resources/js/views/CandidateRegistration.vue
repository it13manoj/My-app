<template>
<div>
  <!-- ======================= Start Navigation ===================== -->
  <nav class="navbar navbar-default  navbar-fixed light bootsnav padd-bot-10">
    <div class="container">
      <div>
        <router-link to="/" class="navbar-brand signin-header col-sm-5 col-md-3 col-xs-6">
          <img src="home_assets/img/logo.png" class="logo logo-display " alt="">
          <img src="home_assets/img/logo.png" class="logo logo-scrolled" alt="">
        </router-link>
        <ul class="nav pull-right col-sm-4 col-md-2 col-xs-6">
          <li class="sign-up"><router-link to="/userlogin" class="btn-signup btn-radius red-btn">Sign in</router-link></li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- ======================= End Navigation ===================== -->
  <!-- ====================== Start Signup Form ============= -->
  <section id="signup" class="signin-banner" style="background-image:url(home_assets/img/slider-1.jpg);    padding-top: 50px;"  >
    
    <div class="container">
      <div class="log-box">
        <div class="log-box-head">
          <h2>Create Account</h2>
        </div>
        
        <div class="log-box-body">
          <!-- Nav tabs -->
          <ul class="nav nav-tabs nav-advance theme-bg" role="tablist">
           <li class="nav-item ">
             <!--  <a class="nav-link tab1" data-toggle="tab" href="#employer" role="tab">
              <i class="ti-user"></i> Employer</a> -->
              <router-link to="/registration" class="nav-link tab1"><i class="ti-user"></i> Employer</router-link>
            </li>
            <li class="nav-item active">
             <!--  <a class="nav-link tab-last" data-toggle="tab" href="#candidate" role="tab">
              <i class="ti-user"></i> Candidate</a> -->
              <router-link to="/candidate_registration" class="nav-link tab-last"><i class="ti-user"></i> Candidate</router-link>
            </li>
          </ul>
          <!-- Tab panels -->
          <div class="tab-content">
            
            <div class="tab-pane fade in show active" id="candidate" role="tabpanel">
              <flash-message class="myCustomClass" variant="success"></flash-message>
              <form @submit="submitemp" method="post">
                <div class="row">
                  <div class="col-sm-12">
                  <div class="form-group col-md-6 col-sm-12 col-xs-12 col-lg-6 padd-l-0 padd-r-0 ">
                  <label>First Name <span>*</span></label>
                 <input type="hidden" name="_token" :value="csrf">
                      <input type="text" v-model="empfirstname" v-validate="'required|alpha'" name="user_first_name" class="form-control" >
                      <p class="error_msg error_msgfirstname">{{ errors.first('user_first_name') }}</p>
                     </div>
                <div class="form-group col-md-6 col-sm-12 col-xs-12 col-lg-6 padd-l-xs-0 padd-r-0">
                  <label>Last Name <span>*</span></label>
                  <input type="text" v-model="emplastname" v-validate="'required|alpha'" name="user_last_name" class="form-control">
                      <p class="error_msg error_msglastname" >{{ errors.first('user_last_name') }}</p>
                    </div>
                  </div>
                  <div class="col-sm-12">
                <div class="form-group col-md-6 col-sm-12 col-xs-12 col-lg-6 padd-l-0  padd-r-0">
                  <label>Email <span>*</span></label>
                  <input type="text" @blur="checkemail" v-validate="'required|email'" name="user_email" v-model="empemail" class="form-control">
                      <p class="error_msg error_msgemail" v-if="!error_msgemail">{{ errors.first('user_email') }}</p>
                      <p class="error_msg error_msgemail">{{error_msgemail}}</p>
                    </div>
                <div class="form-group col-md-6 col-sm-12 col-xs-12 col-lg-6 padd-l-xs-0 padd-r-0">
                  <label>Contact Number <span>*</span></label>
                  <input type="text" @blur="checkcontact" v-validate="'required|digits:10'" name="contact" v-model="empcontact" class="form-control" >
                      <p class="error_msg error_msgcontact" v-if="!error_msgcontact">{{ errors.first('contact') }}</p>
                      <p class="error_msg error_msgcontact">{{error_msgcontact}}</p>
                    </div>
                  </div>
                  <div class="col-sm-12">
                <div class="form-group col-md-6 col-sm-12 col-xs-12 col-lg-6 padd-l-0  padd-r-0">
                  <label>Password <span>*</span></label>
                  <input type="password" v-validate="'required'" v-model="emppass" name="password" class="form-control" id="password-field">
                      <span  @click="togglepassword" style="cursor:pointer" id="password-field-eye" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                      <p class="error_msg error_msgpass" >{{ errors.first('password') }}</p>
                    </div>
                <div class="form-group col-md-6 col-sm-12 col-xs-12 col-lg-6 padd-l-xs-0 padd-r-0">
                  <label>I am a </label>
                  <div class="margin-bottom-0">
                    <select class="wide form-control br-1" name="user_role" v-validate data-vv-rules="required" v-model="emprole">
                      <option value="Fresher">Fresher</option>
                      <option value="Experience">Experience</option>
                    </select>
                  </div>
                   <span class="error_msg error_msgrole">{{ errors.first('user_role') }}</span>
                </div>
              </div>
                <div class="form-group text-center">
                  <button type="submit" class="loding btn theme-btn full-width btn-m" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing">Sign Up </button>
                </div>
                <label for="agree">
                  <p class="font-400 line-height-20 font-12"><!-- I agree with  -->By clicking Sign up, you agree to the Naukriyan <a href="#" class="thene-color">Terms of Services</a> and <a href="#" class="thene-color">Privacy Policy</a></p>
                </label>
              </div>
              </form>
              <div class="log-option"><span>OR</span><p>Sign in with</p></div>
              <div class="row">
                <div class="col-md-4">
                  <a href="#" title="" class="fb-log-btn log-btn"><i class="fa fa-facebook"></i> Facebook</a>
                </div>
                <div class="col-md-4">
                  <a href="#" title="" class="linkedin-log-btn log-btn"><i class="fa fa-linkedin"></i>Linked In</a>
                </div>
                <div class="col-md-4">
                  <a href="#" title="" class="google-log-btn log-btn"><i class="fa fa-google"></i>Gmail</a>
                </div>
              </div>
            </div>
            <!--/.Panel 2-->
            
          </div>
        </div>
        
        
      </div>
    </div>
  </section>
</div>
</template>
<script type="text/javascript">
    
      export default {
          data: () =>({
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            compname:null,
            error_msgcomp:null,
            comarray:[],
            empcontact:null,
            empemail:null,
            empfirstname:null,
            error_msgfirstname:null,
            emplastname:null,
            error_msglastname:null,
            emprole:null,
            error_msgrole:null,
            empdesig:null,
            error_msgdesig:null,
            error_msgpass:null,
            emppass:null,
            error_msgcontact:null,
            error_msgemail:null,
            resp:1,
          }),
          created: function(){
              const dict = {
                custom: {
                  user_email: {
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
                  user_role: {
                    required:'Please select your role.'
                  },
                  contact:{
                    required:'Please enter your contact number',
                  },
                  password:{
                    required:'Please enter your password',
                  },
                }
              };

              //Validator.localize('en', dict);
              // or use the instance method
              this.$validator.localize('en', dict);
          },
          beforeMount()
               {
                   document.title = Laravel.appName+' | Jobseeker Registrations'
               },
          methods:{
             togglepassword:function(e)
            {
              if($("#password-field").attr('type')=='password')
              {
               $("#password-field").attr('type','text'); 
               $("#password-field-eye").addClass('fa-eye-slash');
               $("#password-field-eye").removeClass('fa-eye');
              }else
              {
                $("#password-field").attr('type','password');
                $("#password-field-eye").addClass('fa-eye');
               $("#password-field-eye").removeClass('fa-eye-slash');
              }
            },
            async checkemail(){
              this.error_msgemail=''
              var response =  await this.checvalidation('email',this.empemail);
              if(this.resp==0){
              this.error_msgemail="This email is already exist";
              this.empemail="";
              this.resp=1;
              }else{
                this.resp=1;
              this.error_msgemail='';
              }
            },
            async checkcontact(){
            var respo= await this.checvalidation('phone',this.empcontact);
            if(this.resp==0){
            this.error_msgcontact="This contact number is already exist";
            this.empcontact="";
            this.resp=1;
            }else{
            this.error_msgcontact='';
              this.resp=1;
            }
            },
            validEmail: function (email) {
              var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
              return re.test(email);
            },
            async checvalidation(type,value){
              var selff = this;
              await axios.get('/checkAuthentication?type='+type+'&val='+value)
              .then(function(response){
              selff.resp= response.data;
              });

            },
            submitemp:function(e){
               e.preventDefault();
              this.$validator.validateAll().then((result)=>{
               
                if(!result){
                  //alert('error');
                  return false;
                }
                $(".loader").show();
                var selff=this;
                let currentObj = new URLSearchParams();
                currentObj.append('user_email', this.empemail);
                currentObj.append('password', this.emppass);
                currentObj.append('user_first_name', this.empfirstname);
                currentObj.append('user_last_name', this.emplastname);
                currentObj.append('user_role', this.emprole);
                currentObj.append('user_contact', this.empcontact);
                axios.post('/candidate/register_candidate',currentObj)
                .then(function (response) {

                    currentObj.output = response.data;
                    console.log(currentObj.output);
                    $(".loader").hide();
                    selff.flash("Thank you for registration.We have sent you a confirmation email.Please confirm your email",'success');
                    e.target.reset();
                    //this.emailerrors='';
                   // window.location="/home";
                    //router.go('/home');
                    //this.$router.push("/home");
                    //axios.get('/home');
                }).catch(function (error) {
                    //console.log(error);
                    $(".loader").hide();
                    //this.emailerrors='Invalid email or password.';
                    currentObj.output = error;

                })
              })
              e.preventDefault();
            },
            validate:function(){
            this.$validator.validateAll();
            return this.errors.any();
          }
          },
          

      }
      $(function () {
        $(window).scroll(function () {
        var $nav = $(".navbar-fixed");
        $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
        });
      });
</script>
<style type="text/css" scoped>
nav {
box-shadow: 0 0px 0px rgba(0, 0, 0, 0.05);
-webkit-box-shadow: 0 0px 0px rgba(0, 0, 0, 0.05);
}
nav.navbar.bootsnav{
background-color: transparent;
box-shadow: 0 0px 0px rgba(0,0,0,0.05);
-webkit-box-shadow: 0 0px 0px rgba(0,0,0,0.05);
}
@media only screen and (min-width: 1024px){
.nav-tabs.nav-advance>li {
width: 50%;
}
}
</style>
<!-- ====================== End Signup Form ============= -->