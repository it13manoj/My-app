<template><div>
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
<section class="signin-banner" style="background-image:url(home_assets/img/slider-1.jpg);"  >
                  <div class="container">
                     <div class="log-box">
                     	<div class="log-box-head">
                     		<h2>Forgot Password</h2>
                     	</div>
                     	<div class="log-box-body">
                           <flash-message class="myCustomClass" variant="success"></flash-message>
                     		<form @submit="submitemp" method="post">
	                           <div class="form-group">
	                              <label>Email <span>*</span></label>
	                              <input type="text" @blur="checkemail" v-validate="'required|email'" name="user_email" v-model="empemail" class="form-control focus" placeholder="Email">
                                  <p class="error_msg error_msgemail" v-if="!error_msgemail">{{ errors.first('user_email') }}</p>
                                 <p class="error_msg error_msgemail">{{error_msgemail}}</p>
	                           </div>
	                           <div class="form-group text-center">
	                              <button type="submit" class="loding btn theme-btn full-width btn-m" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing">Send Link </button>
	                           </div>
	                        </form>
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
            empemail:null,
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
                }
              };
           this.$validator.localize('en', dict);
          },
          beforeMount()
               {
                   document.title = Laravel.appName+' | Forgot Password'
               },
          methods:{
            
            async checkemail(){
              /*if(this.validEmail(this.empemail))
              {*/
              this.error_msgemail=''
              // console.log(this.checvalidation('email',this.empemail));
              var response =  await this.checvalidation('email',this.empemail);
              //console.log(this.resp);
              if(this.resp==1){
              this.error_msgemail="This email is not registered with us.";
              this.empemail="";
              this.resp=0;
              return false;
              }else{
                this.resp=1;
              this.error_msgemail='';
              }
              /*}else{
              this.error_msgemail="Please enter a valid email";
              }*/
            },
            async checvalidation(type,value){
              //var asbd=1;
              var selff = this;
              await axios.get(Laravel.baseUrl+'/checkAuthentication?type='+type+'&val='+value)
              .then(function(response){
              selff.resp= response.data;
              });

            },
            submitemp:function(e){
              //this.validate();
              this.checvalidation('email',this.empemail);
               e.preventDefault();
              this.$validator.validateAll().then((result)=>{
               
                if(!result){
                  //alert('error');
                  return false;
                }
                $(".loader").show();
                console.log(this);
                var selff=this;
                let currentObj = new URLSearchParams();
                currentObj.append('user_email', this.empemail);
                axios.post(Laravel.baseUrl+'/sendresetpasswordmail',currentObj)
                .then(function (response) {
                    $(".loader").hide();
                    currentObj.output = response.data;
                    console.log(currentObj.output);
                    selff.flash("Please check your registered email.We have sent you a password reset email",'success');
                    e.target.reset();
                    //this.emailerrors='';
                   // window.location="/home";
                    //router.go('/home');
                    //this.$router.push("/home");
                    //axios.get('/home');
                }).catch(function (error) {
                    //console.log(error);
                    //this.emailerrors='Invalid email or password.';
                    $(".loader").hide();
                    currentObj.output = error;

                })
              })
              e.preventDefault();
            },
            validate:function(){
              

              //this.$validator.updateDictionary(messages);
            //VeeValidate.Validator.updateDictionary(dictionary);
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
<style type="text/css">
                  nav.navbar.bootsnav{
                       background-color: transparent;
                       box-shadow: 0 0px 0px rgba(0,0,0,0.05);
                       -webkit-box-shadow: 0 0px 0px rgba(0,0,0,0.05);
                    }
</style>