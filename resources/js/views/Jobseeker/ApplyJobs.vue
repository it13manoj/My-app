 <template>
   <div>
 <div class="page-title">
                  <div class="container">
                     <div class="">
                        <div class="page-caption">
                           <h2 class="subheader-heading">{{jobs.job_title}}</h2>
                             <p><span class="job_location">{{jobs.job_address}}</span> | <span>{{jobs.job_experience}} Year</span></p>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- ======================= End Job Name ===================== -->
               <!-- ====================== Start Question ============= -->
               <section class="padd-top-30">
                  <div class="container">
                     <div class="row">
                        <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12 body-middle">
                           <form>
                              <ul class="" style="list-style-type: none ">
                                 <li v-if="jobs.job_qualification!=''" class="">
                                    <div class="col-md-9 col-lg-10 col-xs-12 col-sm-12">
                                       <p class="question ">Q:&nbsp;&nbsp; Do you have any of the following or equivalent qualification?</p>
                                       <ul class="padding-left-40">
                                          <li>
                                             <p>
                                                {{jobs.job_qualification}}
                                             </p>
                                          </li>
                                       </ul>
                                       
                                    </div>
                                    
                                    <div class="material-switch col-md-offset-1 col-lg-offset-1 col-md-2 col-lg-1 col-xs-12 col-sm-12 ">
                                       <input v-model="allcheck" id="someSwitchOptionWarning1"  type="checkbox" value="1"/>
                                       <label for="someSwitchOptionWarning1" class="label-warning"></label>
                                   </div>
                                 </li>
                                 <li class="">
                                    <div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
                                       <p class="question">Q:&nbsp;&nbsp;  Do you have work experience of {{jobs.job_experience}}- year?</p>
                                    </div>
                                    <div class="material-switch col-md-offset-1 col-lg-offset-1 col-md-2 col-lg-1 col-xs-12 col-sm-12 ">
                                       <input v-model="allcheck" value="2" id="someSwitchOptionWarning2"  type="checkbox"/>
                                          <label for="someSwitchOptionWarning2" class="label-warning"></label>
                                    </div>
                                 </li>
                                 <li>
                                    <div class="col-md-9 col-lg-10 col-xs-12 col-sm-12">
                                       <p class="question">Q:&nbsp;&nbsp; Do you have the following skills?
                                       </p>
                                       <ul class="padding-left-40">
                                          <li class="text-justify" v-html="jobs.job_skills"></li>
                                       </ul>
                                    </div>
                                    <div class="material-switch col-md-offset-1 col-lg-offset-1 col-md-2 col-lg-1 col-xs-12 col-sm-12 ">
                                       <input v-model="allcheck" value="3" id="someSwitchOptionWarning3" type="checkbox"/>
                                          <label for="someSwitchOptionWarning3" class="label-warning"></label>
                                    </div>
                                 </li>
                              </ul>
                              <div class="text-center padd-top-40 clear-both">
                                 <a @click="$router.go(-1)" class="btn btn-m light-gray-btn mrg-r-20"  value="cancel"> Cancel</a>
                                 <button v-if="allcheck.length==3" @click="applyjobs(jobs.job_id,jobs.job_questionnaire)" type="button" class="btn btn-m theme-btn" value="Apply">Apply</button>
                               </div>
                           </form>
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
            jobs:{},
            allcheck:[]
          }),
          
        async beforeMount()
         {
            if (!this.$session.exists()) {
                     this.$router.push('/userlogin')
              }
            await this.getjobs();
            document.title = Laravel.appName+' | Apply For Job'
           
         },
         methods:{
            getjobs(page) {
                   var uid=this.$session.get('id');
                  var pathArray=window.location.pathname.split('/');
               var secondLevelLocation = pathArray[2];
                  var serff=this;
                  axios
                 .get(Laravel.baseUrl+'/getapplyjobsdetails?jid='+secondLevelLocation)
                 .then(response => {
                  serff.jobs=response.data;
                  })
               },
               submit()
               {
                  console.log(this.allcheck);
               },
               applyjobs(jobid,questionnaire)
               {
                  if (!this.$session.exists()) {
                     this.$router.push('/userlogin')
                   }
                 let selff=this;
                  let currentObj = new FormData();
               currentObj.append('access_token', btoa(this.$session.get('id')));
               currentObj.append('jobid', btoa(jobid));
               axios.post(Laravel.baseUrl+'/applyjob',currentObj)
                .then(function (response) {
                   
                   /*  if(response.data==1)
                     {*/
                        if(questionnaire=='' || questionnaire==null)
                        {  
                          selff.$router.push('/jobapplysuccess');
                        }else
                        {
                          // alert('here2');
                           //this.$router.push('/submitquestionnaire/'+bota(jobid));
                           var jid=btoa(jobid);
                           selff.$router.push({ name: 'submitquestionnaire', params: { jid } })
                        }
                    // }
                    /*else
                     {
                        selff.jobdetails.isApplied=0;

                     }*/
                 
                 }).catch(function (error) {
                    currentObj.output = error;
                })
               
               },
         }
    }

 
</script>