<template>
<div>
<!-- ======================= Page Title ===================== -->
<div class="page-title">
   <div class="container">
      <div class="">
         <div class="page-caption">
            <h2 class="subheader-heading">{{questionnaire.questionnaire_title}}</h2>
         </div>
      </div>
   </div>
</div>
<!-- ======================= End Page Title ===================== -->
<!-- ======================== Manage Job ========================= -->
<section class="padd-top-30">
   <div class="container">
      <div class="">
         <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12 body-middle">
            <div>
               <form class="padd-l-20">
                  <ol>
                     <li v-for="(question,qindex) in questions">
                        <div>
                           <p class="question">{{question.question}} ?</p>
                           <div v-for="option in question.optionsa" class="form-check col-md-6 col-lg-3 col-xs-12 col-sm-6">
                               <input class="form-check-input" v-model="answers[qindex]" type="radio"  :id="option+'_'+qindex" :value="option">
                               <label class="form-check-label" :for="option+'_'+qindex">
                                 {{option}}
                               </label>
                           </div>
                           
                        </div>
                     </li>
                  </ol>
                  <div class="text-center padd-top-40 clear-both">
                     <button v-if="answers.length == questions.length" @click="applyjobs" type="button" class="btn btn-m theme-btn" value="Submit">Submit</button>
                   </div>
                </form>
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
            questionnaire:{},
            questions:{},
            answers:[]
          }),
          
        async beforeMount()
         {
            await this.getquestionnaire();
            document.title = Laravel.appName+' | Submit Questionnaire'
         },

         methods:{
            getquestionnaire() {
              //alert('here');
                   var uid=this.$session.get('id');
                  var pathArray=window.location.pathname.split('/');
                  var secondLevelLocation = pathArray[2];
                  var serff=this;
                  axios
                 .get(Laravel.baseUrl+'/getjobquestionnaire?jid='+secondLevelLocation)
                 .then(response => {
                    serff.questionnaire=response.data.questionnaire;
                    serff.questions=response.data.questions;
                  })
               },
               applyjobs()
               {
                  if (!this.$session.exists()) {
                     this.$router.push('/userlogin')
                   }
                 let selff=this;
                 var pathArray=window.location.pathname.split('/');
                  var jobid = pathArray[2];
                  let currentObj = new FormData();
               currentObj.append('access_token', btoa(this.$session.get('id')));
               currentObj.append('jobid', jobid);
               currentObj.append('answers', this.answers);
               axios.post(Laravel.baseUrl+'/submitanswers',currentObj)
                .then(function (response) {
                   
                           selff.$router.push('/jobapplysuccess');
                 }).catch(function (error) {
                    currentObj.output = error;
                })
               
               },
         }
    }

 
</script>