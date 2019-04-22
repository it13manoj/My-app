<template>
   <div>
<section   :style="{ backgroundImage: 'url(' + background + ')' }" class="detail-section">

   

                  <div class="overlay"></div>
                  <div class="profile-cover-content">
                     <div class="container">
                     	<h2 class="company_name">{{jobdetails.job_title}}</h2>
                        <div class="cover-buttons">
                           <ul>
                        		<li>
                              <div v-if="jobdetails.job_role!='' && jobdetails.job_role!=null" class="buttons medium button-plain job-detail-banner ">{{jobdetails.job_role}}</div>
                           	</li>
                           	<li>
                              <div v-if="jobdetails.job_expiry_date!='' && jobdetails.job_expiry_date!=null" class="buttons medium button-plain "><i class="fa ti-calendar"></i><span class="ver-ali">Apply Before : {{$moment(jobdetails.job_expiry_date).format('MMMM, DD YYYY')}}</span> </div>
                           	</li>
                           	<li>
                              <div v-if="jobdetails.job_address!='' && jobdetails.job_address!=null" class="buttons medium button-plain "><i class="fa ti-location-pin"></i><span class="ver-ali">Location : {{jobdetails.job_address}}</span></div>
                           	</li>
                              <!-- <li>
                              <div class="buttons medium button-plain "><i class="fa ti-eye"></i><span class="ver-ali">View : 0</span></div>
                              </li>
                              <li>
                              <div class="buttons medium button-plain "><i class="fa icon-document"></i><span class="ver-ali">Application : 0</span></div>
                              </li>  -->
                           </ul>
                        </div>
                        <!-- <span class="job-like">
                           <label class="toggler toggler-danger">
                              <input type="checkbox" checked>
                              <i class="fa fa-heart"></i>
                           </label>
                        </span> -->
                     </div>
                  </div>
               </section>
               <!-- ================ End Job Detail Basic Information ======================= -->
               <!-- ================ Start Job Overview ======================= -->
               <section>
                  <div class="container">
                     <!-- row -->
                     <div class="row">
                        <div class="col-md-8 col-sm-8">
                           
                           <div v-if="jobdetails.job_description!='' && jobdetails.job_description!=null" class="detail-wrapper">
                              <div class="detail-wrapper-header">
                                 <h4>Overview</h4>
                              </div>
                              <div class="detail-wrapper-body">
                                 <p v-html="jobdetails.job_description"></p>
                              </div>
                           </div>
                           <div v-if="jobdetails.job_responsibility!='' && jobdetails.job_responsibility!=null" class="detail-wrapper">
                              <div class="detail-wrapper-header">
                                 <h4>Responsibilities</h4>
                              </div>
                              <div class="detail-wrapper-body">
                                 <ul class="detail-list" v-html="jobdetails.job_responsibility">
                                   
                                 </ul>
                              </div>
                           </div>
                           <div class="detail-wrapper" v-if="jobdetails.job_skills!='' && jobdetails.job_skills!=null">
                              <div class="detail-wrapper-header">
                                 <h4>Skills & Requirements</h4>
                              </div>
                              <div class="detail-wrapper-body">
                                 <ul class="detail-list" v-html="jobdetails.job_skills">
                                    
                                 </ul>
                              </div>
                           </div>
                           <div class="detail-wrapper" v-if="jobdetails.job_benefits!='' && jobdetails.job_benefits!=null">
                              <div class="detail-wrapper-header">
                                 <h4>Rewards and Benefits</h4>
                              </div>
                              <div v-if="jobdetails.job_benefits" class="detail-wrapper-body">
                                 <ul class="detail-list">
                                    <li v-for="benifit in jobdetails.job_benefits.split(',')">{{benifit}}</li>
                                    
                                 </ul>
                              </div>
                           </div>

                           <!-- Ad's  -->
                           <!-- <div class="col-md-12">
                              <img src="home_assets/img/728x90.png">
                           </div> -->
                        </div>
                        <div class="col-md-4 col-sm-4">
                           <div class="sidebar">
                              <!-- Start: Apply -->
                              <div class="widget-boxed border-none padd-bot-0">
                                 <div class="widget-boxed-body">
                                    <div class="row">
                                       <div class="col-md-6 col-sm-12 padding-left-0">
                                           <!-- <a v-if="jobdetails.isApplied==0" href="javascript:;" @click="applyjobs('mainjob',jobdetails.job_id,0)" class="btn btn-m btn-block apply-job-btn-detail left-0"><i class="fa fa-paper-plane padd-r-5"></i>Apply</a>

                                           <a v-else href="javascript:;" @click="applyjobs('mainjob',jobdetails.job_id,0)" class="btn btn-m btn-block apply-job-btn-detail left-0"><i class="fa fa-paper-plane padd-r-5"></i>Applied</a> -->
                                           <router-link v-if="jobdetails.isApplied==0" :to="{ name: 'apply', params: { id:jobdetails.encId} }" class="btn btn-m btn-block apply-job-btn-detail left-0" ><i class="fa fa-paper-plane padd-r-5"></i>Apply</router-link>
                                                <a v-else @click="applyjobs('listing',jobdetails.job_id,jobindex)" href="javascript:;" class="btn btn-m btn-block apply-job-btn-detail left-0"><i class="fa fa-paper-plane padd-r-5"></i>Applied</a>
                                       </div>
                                       <div class="col-md-6 col-sm-12 padding-right-0">
                                          <a v-if="jobdetails.isSaved==0" href="javascript:;" @click="savejobs('mainjob',jobdetails.job_id,0)" class="btn btn-m btn-block light-gray-btn "><i class="fa fa-heart save unsave padd-r-5"></i>Save</a>
                                           <a v-else href="javascript:;" @click="savejobs('mainjob',jobdetails.job_id,0)" class="btn btn-m btn-block light-gray-btn "><i class="fa fa-heart save  padd-r-5"></i>Saved</a>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <!-- End: Apply -->
                              <!-- Start: Company info -->
                              <div class="widget-boxed">
                                 <div class="widget-boxed-header">
                                    <h4><i class="ti-world padd-r-10"></i>Company Info</h4>
                                 </div>
                                 <div class="widget-boxed-body">
                                    <div class="job-owner-avater" >
                                       <img v-bind:src="'/../admin_assets/uploaded_images/company_pic/thumb/'+jobdetails.company_logo" class="img-responsive img-circle" alt="" />
                                    </div>
                                    <div class="job-title-bar">
                                    <h4 class="mrg-top-0"><router-link  :to="{ name: 'companies', params: { id:jobdetails.company_slug} }" >{{jobdetails.company_name}}</router-link></h4>
                                    <div class="">
                                       <p v-if="jobdetails.company_address!='' && jobdetails.company_address!=null" class="mrg-bot-0">
                                          <!-- <i class="ti-location-pin mrg-r-5"></i> -->
                                          {{jobdetails.company_address}} <a href="#viewonmap" ><small class="map-text">view on map</small></a>
                                       </p>
                                    </div>
                                 </div>
                                 </div>
                              </div>
                              <!-- End: Employer info -->
                              <!-- Start: Employer info -->
                              <div class="widget-boxed">
                                 <div class="widget-boxed-header">
                                    <h4 class="mrg-top-0"><i class="ti-user padd-r-10"></i>Employer Info</h4>
                                 </div>
                                 <div class="widget-boxed-body">
                                    <div class="job-owner-avater" style="max-width: 80px;border-radius: 50%;margin-right: 20px;">
                                       <img src="home_assets/img/avatar4.jpg" class="img-responsive img-circle" alt="">
                                    </div>
                                    <div class="job-title-bar">
                                    <h4 class="mrg-top-0"><a href="employer_profile.html">{{jobdetails.user_first_name}} {{jobdetails.user_last_name}}</a></h4>
                                    <div class="">
                                       <p class="mrg-bot-0 line-height-20">
                                          {{jobdetails.user_designation}} @ <a href="conpany_detail.html">{{jobdetails.company_name}}</a>
                                    <!--  <span class="display-block">Posted {{jobdetails.postedago}} days ago</span> --> </p>
                                    </div>
                                    <hr>
                                    <div class="row">
                                       <div class="col-md-6">
                                          <span><i class="ti-mobile padd-r-5"></i> {{jobdetails.user_contact}}</span>
                                       </div>
                                       <div class="col-md-6">
                                          <span class="word-b"><i class="ti-email padd-r-5"></i>{{jobdetails.email}}</span>
                                       </div>
                                    </div>
                                    
                                 </div>
                                 </div>
                              </div>
                              <!-- End: Employer info -->
                              <!-- Start: Job Overview -->
                              <div class="widget-boxed">
                                 <div class="widget-boxed-header">
                                    <h4><i class="ti-time padd-r-10"></i>Job Overview </h4>
                                 </div>
                                 <div class="widget-boxed-body">
                                    <div class="side-list no-border">
                                       <ul>
                                          <li><i class="ti-credit-card padd-r-10"></i>Salary ( in Lakhs / year ) : {{jobdetails.job_offered_salary_min}} - {{jobdetails.job_offered_salary_max}}</li>
                                          <li><i class="ti-bar-chart padd-r-10"></i>Industry : {{jobdetails.category_name}}</li>
                                          <li><i class="ti-world padd-r-10"></i>Functional Area : {{jobdetails.subcategory_name}}</li>
                                          <li><i class="fa fa-line-chart padd-r-10"></i>Career Level : {{jobdetails.job_career_level}}</li>
                                          <li><i class="ti-world padd-r-10"></i>Job Type : {{jobdetails.job_type}}</li>
                                          <li><i class="ti-world padd-r-10"></i>Job Shift : {{jobdetails.job_shift}}</li>
                                          <li><i class="ti-shield padd-r-10"></i>Openings : {{jobdetails.job_vacancy}}</li>
                                         <!--  <li><i class="ti-mobile padd-r-10"></i>Call : 91 234 567 8765</li>
                                          <li><i class="ti-email padd-r-10"></i> suppoer@listinghub.com</li> -->
                                          <li><i class="ti-pencil-alt padd-r-10"></i>Min. Qualification : {{jobdetails.job_qualification}}</li>
                                          <li><i class="ti-briefcase padd-r-10"></i>Experience Required : {{jobdetails.job_experience}} Year.</li>
                                          <li><i class="fa fa-transgender padd-r-10"></i>Preference : {{jobdetails.job_preference}}</li>
                                          
                                          
                                       </ul>
                                       <h5>Share Job</h5>
                                       <ul class="side-list-inline no-border social-side">
                                    <li><a target="_blank" :href="'https://www.facebook.com/sharer/sharer.php?u='+baseUrl+'/jobdetails/'+jobdetails.encId"><i class="fa fa-facebook theme-cl"></i></a></li>
                                    <!-- <li><a href="#"><i class="fa fa-google-plus theme-cl"></i></a></li> -->
                                          <li><a target="_blank" :href="'https://twitter.com/home?status='+baseUrl+'/jobdetails/'+jobdetails.encId"><i class="fa fa-twitter theme-cl"></i></a></li>
                                          <li><a target="_blank" :href="'https://www.linkedin.com/shareArticle?mini=true&url='+baseUrl+'/jobdetails/'+jobdetails.encId"><i class="fa fa-linkedin theme-cl"></i></a></li>
                                         <!--  <li><a href="#"><i class="fa fa-pinterest theme-cl"></i></a></li> -->
                                       </ul>
                                    </div>
                                 </div>
                              </div>
                              <!-- End: Job Overview -->
                              <!-- Start: Keywords  -->
                              <div v-if="jobdetails.job_keywords" class="widget-boxed" id="viewonmap">
                                 <div class="widget-boxed-header">
                                    <h4><i class="ti-tag padd-r-10"></i>KeyWords</h4>
                                 </div>
                                 <div class="widget-boxed-body">
                                    <div class="side-list">
                                       <a  v-for="keywords in jobdetails.job_keywords.split(',')" href=""><span class="key-tag">{{keywords}}</span></a>
                                    </div>
                                 </div>
                              </div>
                              <!-- End: Keywords -->
                              
                              <!-- Start: Google Map -->
                              <div v-if="jobdetails.company_address!='' && jobdetails.company_address!=null" class="widget-boxed" id="viewonmap">
                                 <div class="widget-boxed-header">
                                    <h4><i class="ti-location-pin padd-r-10"></i>Location</h4>
                                 </div>
                                 <div class="widget-boxed-body">
                                    <div class="side-list">
                                       <!-- <iframe v-bind:src="'https://www.google.com/maps/embed?pb='+jobdetails.job_address" width="100%" height="360" frameborder="0" style="border:0" allowfullscreen></iframe> -->
                                        <gmap-map ref="mymap"   :center="startLocation" :zoom="14" style="width: 100%; height: 300px">
                                          <gmap-marker  :position="getPosition()" :clickable="true"  />
                                           </gmap-map>
                                    </div>
                                 </div>
                              </div>
                              <!-- End: Google Map -->
                           </div>
                        </div>
                     </div>
                     <!-- End Row -->
                     <!-- row -->
                     <div class="row" v-if="similarjobs.length>0">
                        <div class="col-md-12">
                           <h4 class="mrg-bot-20">Similar Jobs</h4>
                        </div>
                     </div>
                     <!-- End Row -->
                     <!-- row -->
                     <div class="row">
                        <!-- Single Job -->
                        <div v-for="(similarjob,jobindex) in similarjobs" class="col-md-3 col-sm-6">
                           <div class="grid-job-widget">
                              <div>
                                 <span class="job-type full-type ">{{similarjob.job_type}}</span>
                                 <div class="job-like box-layout-job">
                                    <label class="toggler toggler-danger">
                                    <a v-if="similarjob.isSaved==0" @click="savejobs('listing',similarjob.job_id,jobindex)" href="javascript:;">
                                    <i  class="fa fa-heart save unsave"></i></a>
                                    <a v-else href="javascript:;" @click="savejobs('listing',similarjob.job_id,jobindex)">
                                    <i  class="fa fa-heart save"></i>
                                     </a>
                                    </label>
                                 </div>
                                 <div v-if="similarjob.job_p_category=='3'" class="job-featured"></div>
                                 <div v-if="similarjob.job_p_category=='2'" class="job-hot"></div>
                              </div>
                              
                              <div class="u-content">
                                 <div class="avatar box-80 2222">
                                    <a  target="_blank" :href="baseUrl+'/jobdetails/'+similarjob.encId" >
                                    <img class="img-responsive" v-bind:src="'/../admin_assets/uploaded_images/company_pic/thumb/'+similarjob.company_logo"  alt="">
                                    </a>

                                 </div>
                                 <h5><a  target="_blank" :href="baseUrl+'/jobdetails/'+similarjob.encId" >{{similarjob.job_title.substring(0,20)}}</a></h5>
                                 <p class="text-muted">{{similarjob.job_address.substring(0,20)}}</p>
                              </div>
                              <div class="job-type-grid">
                                 <router-link v-if="similarjob.isApplied==0" :to="{ name: 'apply', params: { id:similarjob.encId} }" class="btn apply-job-btn btn-radius t" >Apply</router-link>
                                 <!-- <a v-if="similarjob.isApplied==0" @click="applyjobs('listing',similarjob.job_id,jobindex)" href="javascript:;" class="btn apply-job-btn btn-radius t">Apply</a> -->
                                  <a v-else @click="applyjobs('listing',similarjob.job_id,jobindex)" href="javascript:;" class="btn apply-job-btn btn-radius t">Applied</a>
                              </div>
                           </div>
                        </div>
                        
                     </div>
                     <!-- End Row -->
                  </div>
               </section>

</div>
</template>
 <script>
  import VueMoment from 'vue-moment'; 
     export default {
        data: () => ({
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            jobdetails:{},
            background:'/../home_assets/img/slider-2.jpg',
            similarjobs:{},
            baseUrl:'',
            startLocation: {
                lat: 10.3157,
                lng: 123.8854
              },
          }),
          
        async beforeMount()
         {
            await this.getjobdetails();
               
         },
         created: function () {

         },
         methods:{
             getPosition: function() {
            //  alert(this.companies.company_lat);
              //alert(parseFloat(this.companies.company_lat));
              return {
                lat: parseFloat(this.jobdetails.company_lat),
                lng: parseFloat(this.jobdetails.company_long)
              } 
            },
            getjobdetails() {
               this.baseUrl=Laravel.baseUrl;
               var pathArray=window.location.pathname.split('/');
               var secondLevelLocation = pathArray[2];
               var uid=this.$session.get('id');
               //alert(secondLevelLocation);
                  var serff=this;
                  axios
                 .get('/../getjobdetail?job='+secondLevelLocation+'&access_token='+btoa(uid))
                 .then(response => {
                //  console.log(response.data.jobDetails[0]);
                  serff.jobdetails=response.data.jobDetails[0];
                  serff.similarjobs=response.data.similarjobs;
                  document.title = Laravel.appName+' | '+serff.jobdetails.job_title
                  this.getBackground(serff.jobdetails.company_cover_image)
                   serff.startLocation.lat=parseFloat(serff.jobdetails.company_lat);
            serff.startLocation.lng=parseFloat(serff.jobdetails.company_long);
                  })
               },
               getBackground(bimg)
               {
                  if(bimg!='')
                  {
                     this.background= '/../admin_assets/uploaded_images/company_pic/'+bimg;
                  }else
                  {
                     this.background= '/../home_assets/img/slider-2.jpg';
                  }
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
               axios.post('/../savejob',currentObj)
                .then(function (response) {
                    if(jobtype=='mainjob')
                    {
                     if(response.data==1)
                     {
                        selff.jobdetails.isSaved=1;
                     }else
                     {
                        selff.jobdetails.isSaved=0;

                     }
                    }
                    else
                    {
                     if(response.data==1)
                     {
                        selff.similarjobs[jobindex].isSaved=1;
                     }else
                     {
                        selff.similarjobs[jobindex].isSaved=0;

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
               axios.post('/../applyjob',currentObj)
                .then(function (response) {
                    if(jobtype=='mainjob')
                    {
                     if(response.data==1)
                     {
                        selff.jobdetails.isApplied=1;
                     }/*else
                     {
                        selff.jobdetails.isApplied=0;

                     }*/
                    }
                    else
                    {
                     if(response.data==1)
                     {
                        selff.similarjobs[jobindex].isApplied=1;
                     }else
                     {
                        //selff.similarjobs[jobindex].isApplied=0;

                     }
                  }
                 }).catch(function (error) {
                    currentObj.output = error;
                })
               
               },
         }
    }

 
</script>
<style>
.coveimgs
{
   background-image:url("/../admin_assets/uploaded_images/company_pic/{{jobdetails.company_cover_image}}");
}
.novcoverimg
{
   background-image:url("/../home_assets/img/slider-2.jpg");
}
</style>