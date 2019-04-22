<template>
   <div>
 <nav class="navbar navbar-default  navbar-fixed light bootsnav padd-bot-10">
                  <div class="container">
                     <div>
                        <router-link to="/" class="navbar-brand signin-header col-sm-5 col-md-3 col-xs-6">
                           <img src="home_assets/img/logo.png" class="logo logo-display " alt="">
                           <img src="home_assets/img/logo.png" class="logo logo-scrolled" alt=""></router-link>
                        
                        <ul class="nav pull-right col-sm-4 col-md-2 col-xs-6">
                           <li class="sign-up">
                            <router-link to="/registration" class="btn-signup btn-radius red-btn">Sign up</router-link>
                           </li>
                        </ul>
                     </div>
                      <div class="collapse navbar-collapse" id="navbar-menu">
                        
                     </div>
                  </div>

               </nav>
               <!-- ======================= End Navigation ===================== -->

               <!-- add "focus" class after the "form control" class when error message displayed  -->
               <!-- ====================== Start Signup Form ============= -->
               <section class="signin-banner" style="background-image:url(home_assets/img/slider-1.jpg);"  >	
                  <div class="container">
                     <div class="log-box">
                     	<div class="log-box-head">
                     		<h2>Sign in</h2>
                     	</div>
                     	<div class="log-box-body">
                        <flash-message class="myCustomClass" variant="success"></flash-message>
                     		<form  method="post" @submit="validate">
	                           <div class="form-group">
	                              <label>Email <span>*</span></label>
                                <input type="hidden" name="_token" :value="csrf">
	                              <input v-model="email" type="text" name="email" class="form-control" >
	                              <p class="error_msg errormsg_email" >{{emailerrors}}</p>
	                           </div>
	                           <div class="form-group">
                                 <!-- <div class="icon-addon addon-lg"> -->
	                                <label>Password <span>*</span></label>
	                                <input v-model="password" type="password" name="password" class="form-control" id="password-field" >
                                   	<span @click="togglepassword" style="cursor:pointer" id="password-field-eye" class="fa fa-fw fa-eye field-icon"></span>
                                  	<p class="error_msg errormsg_pass" >{{passerrors}}</p>
                                 <!-- </div> -->
	                           </div>
	                           <div class="form-group">
	                              <span class="custom-checkbox">
	                              <input type="checkbox" id="44">
	                              <label for="44"></label>Remember me
	                              </span>
                                <router-link to="/forgotpass" class="fl-right" title="Forgot Password?">
	                              Forgot Password?</router-link>
                                
	                           </div>
	                           <div class="form-group text-center">
	                              <button type="submit" class="loding btn theme-btn full-width btn-m" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing">Sign In </button>
	                           </div>
	                        </form>
                           <!-- <div class="log-option"><span>OR</span><p>Sign in with</p></div>
                           <div class="row">
                              <div class="col-md-4 col-sm-4 col-xs-12">
                                 <a href="#" title="" class="fb-log-btn log-btn"><i class="fa fa-facebook"></i> Facebook</a>
                              </div>
                              <div class="col-md-4 col-sm-4 col-xs-12">
                                 <a href="#" title="" class="linkedin-log-btn log-btn"><i class="fa fa-linkedin"></i>Linked In</a>
                              </div>
                              <div class="col-md-4 col-sm-4 col-xs-12">
                                 <a href="#" title="" class="google-log-btn log-btn"><i class="fa fa-google"></i>Gmail</a>
                              </div>
                           </div>    -->
                     	</div>
                        
                        
                     </div>
                  </div>
               </section>
            </div>
</template>
<script>
     export default {
        data: () => ({
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            emailerrors:null,
            passerrors:null,
            email: null,
            password: null,
          }),
          beforeMount()
               {
                   document.title = Laravel.appName+' | Login'
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
            validate:function(e){
              if (!this.email) {
                this.emailerrors='Please enter email.';
              } else if (!this.validEmail(this.email)) {
                this.emailerrors='Please enter a valid email.';
              }else if (!this.password) {
                this.passerrors=("Please enter password.");
              }else{
                this.emailerrors='';
                this.passerrors;
                e.preventDefault();
                $(".loader").show();
                let currentObj = this;

                axios.post('/login', {
                   // _token:this.csrf,
                    email: this.email,

                    password: this.password

                })

                .then(function (response) {

                    currentObj.output = response.data;
                    currentObj.flash("Login Successful",'success', {timeout: 3000});
                    var datan=currentObj.output;
                    if(datan===Array)
                    {
                      alert('array');
                    }
                    
                      
                    
                    /*Vue.auth.setToken(datan.user_token,datan.user_first_name,datan.user_last_name,datan.email,datan.user_contact,datan.id);
                    console.log(currentObj.output.user_role);*/
                    if(typeof datan === 'object' && datan !== null)
                    {
                    currentObj.$session.start()
                    currentObj.$session.set('user_token', datan.user_token)
                    currentObj.$session.set('user_first_name', datan.user_first_name)
                    currentObj.$session.set('user_last_name', datan.user_last_name)
                    currentObj.$session.set('email', datan.email)
                    currentObj.$session.set('user_contact', datan.user_contact)
                    currentObj.$session.set('user_role', datan.user_role)
                    currentObj.$session.set('user_last_login', datan.last_login)
                    currentObj.$session.set('user_slug', datan.user_slug)
                    currentObj.$session.set('user_profile_pic_thumb', datan.user_profile_picture)
                    currentObj.$session.set('id', datan.id)
                    //Vue.http.headers.common['Authorization'] = 'Bearer ' + datan.user_token
                    //currentObj.$router.push('/panel/search')
                    }
                     $(".loader").hide();
                    if(currentObj.$session.get('user_role')=='Employer')
                    {

                      window.location="employer/home";
                    }if(currentObj.$session.get('user_role')=='Jobseeker')
                    {
                      window.location="user_dashboard";
                       //currentObj.$router.push('user_dashboard')
                      // router.go('/user_dashboard');
                    }

                    //window.location="employer/home";
                    //router.go('/home');
                    //this.$router.push("/home");
                    //axios.get('/home');
                }).catch(function (error) {
                  $(".loader").hide();
                    //console.log(error);
                    //this.emailerrors='Invalid email or password.';
                    currentObj.flash("Email/Password does not matched or may be your account is not active",'error', {timeout: 3000});
                    //currentObj.output = error;

                });
              }
                //this.formSubmit();
              
              e.preventDefault();
            }, 
             validEmail: function (email) {
              var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
              return re.test(email);
            }, 
          }      
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
</style>
