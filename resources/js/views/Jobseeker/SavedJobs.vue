<template>
   <div>
<div class="page-title">
   <div class="container">
      <div class="">
         <div class="page-caption">
            <h2 class="subheader-heading">Saved Jobs</h2>
         </div>
      </div>
   </div>
</div>
<!-- ======================= End Page Title ===================== -->
<!-- ======================== Manage Job ========================= -->
<section>
   <div class="container">
      <div class="row">
         <form>
            <div class="col-md-3 col-sm-12">
               Showing 0-10 of 10 Results
            </div>
            <div class="col-sm-9">
               <div class="col-md-12 padd-l-0">
                  <div class="col-md-4 col-sm-12">
                     <div class="field_w_search">
                        <div class="form-group">
                           <input v-model="jobsearchkeyword" @keyup="getjobs" type="text" class="form-control" placeholder="Search Job" id="search">
                           <!-- <input type="password" class="form-control focus" id="password-field" > -->
                           <span toggle="#search" class="fa fa-fw fa-search field-icon toggle-search"></span>
                        </div>
                     </div>
                  </div>
                 <!--  <div class="col-md-3 col-sm-6">
                     <div class="search-wide full col-md-6 col-sm-6">
                        <select class="wide form-control">
                           <option value="1" data-display="Sort By">All</option>
                           <option value="2">Most Viewed</option>
                           <option value="4">Most Search</option>
                        </select>
                     </div>
                  </div> -->
                  <div class="col-md-3 col-sm-6 fl-right">
                     <div class="search-wide full col-md-6 col-sm-6">
                       <select v-model="limit" @change="getjobs" class="wide form-control">
                           <option value="10">10 Per Page</option>
                           <option value="20">20 Per Page</option>
                           <option value="30">30 Per Page</option>
                           <option value="50">50 Per Page</option>
                        </select>
                     </div>
                  </div>
                 <!--  <div class="col-md-2 col-sm-12">
                     <button class="btn submit-filter-btn  btn-radius">Submit </button>
                  </div> -->
               </div>
            </div>
         </form>
      </div>
      <div class="table-responsive">
         <table class="table table-lg table-hover">
            <thead>
               <tr>
                  <th>Title</th>
                  <th>Company</th>
                  <th>Location</th>
                  <th>Job Type</th>
                  <th>Experience</th>
                  <th>Apply</th>
               </tr>
            </thead>
            <tbody>
               <tr v-for="(job,jobindex) in jobs.data">
                  <td><router-link :to="{ name: 'jobdetails', params: { id:job.encId} }" >
                     <img v-if="job.job_p_category==1" src="home_assets/img/hot.png" class="category-xs" alt="Hot" data-toggle="tooltip" title="hot">
                                          <img v-if="job.job_p_category==2" src="home_assets/img/featured.png" class="category-xs" alt="Featured" data-toggle="tooltip" title="Featured">
                                          <img v-if="job.job_p_category==3" src="home_assets/img/free.png" class="category-xs" alt="Basic" data-toggle="tooltip" title="Basic">
                  {{job.job_title.substring(0,20)}}</router-link></td>
                  <td><router-link  :to="{ name: 'companies', params: { id:job.company_slug} }" class="company-name-color">{{job.company_name.substring(0,15)}}</router-link></td>
                  <td><i class="ti-location-pin"></i> {{job.job_address.substring(0,20)}}</td>
                  <td> {{job.job_type}}</td>
                  <td><i class="ti-briefcase"></i> {{job.job_experience}} year</td>
                  <td>
                                             <span class="job-like">
                                             <label class="toggler toggler-danger">
                                             <a v-if="job.isSaved==0" @click="savejobs('listing',job.job_id,jobindex)" href="javascript:;">
                                                <i  class="fa fa-heart save unsave"></i></a>
                                             <a v-else href="javascript:;" @click="savejobs('listing',job.job_id,jobindex)">
                                                <i  class="fa fa-heart save"></i>
                                                 </a>
                                             </label>
                                             </span>
                                            <!--  <a href="#" data-toggle="modal" data-target="#apply-job" class="apply-job-btn btn btn-radius ">Apply</a> -->
                                              <a v-if="job.isApplied==0" @click="applyjobs('listing',job.job_id,jobindex)" href="javascript:;" class="btn apply-job-btn btn-radius t">Apply</a>
                                                <a v-else @click="applyjobs('listing',job.job_id,jobindex)" href="javascript:;" class="btn apply-job-btn btn-radius t">Applied</a>
                                          </td>
               </tr>

               
            </tbody>
         </table>
         <!-- flexbox -->
         <div class="text-center">
            <pagination :data="jobs" @pagination-change-page="getjobs"></pagination>
         </div>
         <!-- /.flexbox -->
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
            limit:10,
            jobsearchkeyword:'',
            
          }),
          
        async beforeMount()
         {
            await this.getjobs();
            document.title = Laravel.appName+' | Saved Jobs'
         },
         methods:{
            getjobs(page) {
                   var uid=this.$session.get('id');
                  if (typeof page === 'undefined') {
                       page = 1;
                   }
                  var serff=this;
                  axios
                 .get(Laravel.baseUrl+'/getsavedjobs?page='+page+'&access_token='+btoa(uid)+'&limit='+this.limit+'&jobsearchkeyword='+this.jobsearchkeyword)
                 .then(response => {
                  serff.jobs=response.data;
                  
                  })
               },
               savejobs(jobtype,jobid,jobindex)
               {
                  if (!this.$session.exists()) {
                     this.$router.push('/userlogin')
                   }
                 let selff=this;
                  let currentObj = new FormData();
               currentObj.append('access_token', btoa(this.$session.get('id')));
               currentObj.append('jobid', btoa(jobid));
               axios.post(Laravel.baseUrl+'/savejob',currentObj)
                .then(function (response) {
                    if(jobtype=='mainjob')
                    {
                     if(response.data==1)
                     {
                        selff.jobs.data.isSaved=1;
                     }else
                     {
                        selff.jobs.data.isSaved=0;

                     }
                    }
                    else
                    {
                     if(response.data==1)
                     {
                        selff.jobs.data[jobindex].isSaved=1;
                     }else
                     {
                        selff.jobs.data[jobindex].isSaved=0;

                     }
                  }
                 }).catch(function (error) {
                    currentObj.output = error;
                })
               
               },
               applyjobs(jobtype,jobid,jobindex)
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
                    if(jobtype=='mainjob')
                    {
                     if(response.data==1)
                     {
                        selff.jobs.data.isApplied=1;
                     }/*else
                     {
                        selff.jobdetails.isApplied=0;

                     }*/
                    }
                    else
                    {
                     if(response.data==1)
                     {
                        selff.jobs.data[jobindex].isApplied=1;
                     }else
                     {
                        //selff.jobs.data[jobindex].isApplied=0;

                     }
                  }
                 }).catch(function (error) {
                    currentObj.output = error;
                })
               
               },
         }
    }

 
</script>

