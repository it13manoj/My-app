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
<section class="signin-banner" style="background-image:url(/../home_assets/img/slider-1.jpg);"  >
                  <div class="container">
                     <div class="log-box">
                     	<div class="log-box-head">
                     		<h2>Forgot Password</h2>
                     	</div>
                     	<div class="log-box-body">
                           <flash-message class="myCustomClass" variant="success"></flash-message>
                     		<form @submit="submitemp" method="post">
	                           <div class="form-group">
	                              <label>Password <span>*</span></label>
	                              <input type="password" class="form-control focus" id="password-field" v-validate="'required'" name="password" v-model="password" placeholder="Password">
                                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>


                                  <p class="error_msg error_msgemail">{{ errors.first('password') }}</p>
                                 
	                           </div>
	                           <div class="form-group text-center">
	                              <button type="submit" class="loding btn theme-btn full-width btn-m" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing">Change Password </button>
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
            password:null,
            resp:1,
          }),
          created: function(){
              const dict = {
                custom: {
                  password: {
                    required: 'Please enter your password',
                  },
                }
              };
           this.$validator.localize('en', dict);
          },
          beforeMount()
               {
                   document.title = Laravel.appName+' | Change Password'
               },
          methods:{
            
           
            submitemp:function(e){
               e.preventDefault();
              this.$validator.validateAll().then((result)=>{
               
                if(!result){
                  return false;
                }
                $(".loader").show();
                var selff=this;
                var pathArray=window.location.pathname.split('/');
               var secondLevelLocation = pathArray[2];

                let currentObj = new URLSearchParams();
                currentObj.append('password', this.password);
                currentObj.append('access_token', secondLevelLocation);
                
                axios.post(Laravel.baseUrl+'/updatepassword',currentObj)
                .then(function (response) {
                    $(".loader").hide();
                    selff.output = response.data;
                    if(response.data==1)
                    {
                     
                    setTimeout(function(){  selff.flash("Your Password has been change successfuly",'success', {timeout: 3000});
                     }, 3000);
                    selff.$router.push("/userlogin");
                    }else
                    {
                        selff.flash("You are not allowed to change the password",'error', {timeout: 3000});
                    e.target.reset();
                    }
                    
                }).catch(function (error) {
                    $(".loader").hide();
                    selff.output = error;

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
<style type="text/css">
                  nav.navbar.bootsnav{
                       background-color: transparent;
                       box-shadow: 0 0px 0px rgba(0,0,0,0.05);
                       -webkit-box-shadow: 0 0px 0px rgba(0,0,0,0.05);
                    }
</style>