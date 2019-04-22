<template>
<section>
				<div class="container">
					<div class="error-page padd-top-60 padd-bot-30">
						<img :src="baseUrl+'/home_assets/img/job-post-successful.png'">
						
						<h2 class="mrg-top-10 mrg-bot-5 cl-primary funky-font font-60">Thank you for Applying</h2>
						<p>Your application has been submitted successfuly. If you need help please contact us via email contact@naukriyan.com </p>
						<router-link to="/user_dashboard" class="btn theme-btn mrg-top-20">
						Go To Dashboard</router-link>
					</div>
				</div>
			</section>
	</template>
	<script>
  import VueMoment from 'vue-moment'; 
     export default {
        data: () => ({
            baseUrl:''
          }),
          
        async beforeMount()
         {
            this.baseUrl=Laravel.baseUrl;
            document.title = Laravel.appName+' | Success'
           
         },

         methods:{
               
         }
    }

 
</script>