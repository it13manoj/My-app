<template>
<div>
<section class="">
                  <div class="container">
                     <div class="row">
                        <div class="col-md-12">
                           <!-- Add Qualification -->
                              <div class="box">
                                 <div class="box-header">
                                    <div class="width-100">
                                          <h4 class="pull-left">Certification Information </h4><!-- <span class="pull-right set_upper_button"><a href="professional_info.html" class="angle_left "> <i class="fa fa-angle-left" ></i></a><a href="skill_info.html" class="angle_right"><i class="fa fa-angle-right" ></i></a> </span> -->
                                    </div> 
                                 </div>
                                 <flash-message class="myCustomClass" variant="success"></flash-message>
                                 <div class="box-body">
                                    <div class="c-form">
                                       <div class="extra-field-box">
                                          <div class="multi-box">
                                             <!-- added records -->
                                          <div v-for="(certification,index) in certifications" class="dublicat-box mrg-bot-40">
                                                <form @submit="updateCertification($event,index)">
                                                <div class="row">
                                                   <div class="row">
                                                      <div class="col-sm-6">
                                                         <div>
                                                            <label>Course <span>*</span></label>
                                                            <input type="text" v-model="certification.course" name="course" :id="'course_'+index" class="form-control">
                                                            <input type="hidden" :id="'resumeId_'+index" name="resumeId" v-model="certification.resumeId">
                                                            <p :class="'error_msg error_msg_course_'+index" ></p>
                                                         </div>
                                                      </div>
                                                      <div class="col-sm-6">
                                                         <div>
                                                            <label>Institute <span>*</span></label>
                                                            <input type="text" v-model="certification.institute" name="institute" :id="'institute_'+index" class="form-control">
                                                             <p :class="'error_msg error_msg_institute_'+index" ></p>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div class="row">
                                                      <div class="col-sm-6">
                                                         <div class="col-md-6 padd-l-0">
                                                            <label>From <span>*</span></label>
                                                            <datepicker :id="'startDate_'+index" :format="formatDate" name="startDate" v-model="certification.startDate"></datepicker>
                                                               <p :class="'error_msg error_msg_startDate_'+index" ></p>
                                                         </div>
                                                         <div class="col-sm-6 padd-r-0">
                                                            <label>To <span>*</span></label>
                                                             <datepicker  :format="formatDate" :id="'endDate_'+index" name="endDate" v-model="certification.endDate"></datepicker>
                                                             <p :class="'error_msg error_msg_endDate_'+index" ></p>
                                                         </div>
                                                   
                                                        <div class="col-sm-6 padd-r-0">
                                                               <label>Valid Till <span>*</span></label>
                                                               <div class="form-group mrg-bot-0">
                                                                  <span class="custom-checkbox">
                                                                     <input :id="'willExpire_'+index" type="checkbox" name="willExpire" v-model="certification.willExpire" id="willExpire" value="yes">
                                                                     <label for="willExpire"></label>Never Expire
                                                                  </span>
                                                               </div>
                                                               <datepicker v-if="!certification.willExpire"  :format="formatDate" name="validTill" v-model="validTill" :id="'validTill_'+index"></datepicker>
                                                               
                                                               <p :class="'error_msg error_msg_validTill_'+index" ></p>
                                                         </div>
                                                      </div>
                                                   
                                                      <div class="col-sm-6">
                                                         <div>
                                                            <label>Score </label>
                                                            <input :id="'score_'+index" type="text" name="score" v-model="certification.score" class="form-control">
                                                         </div>
                                                          <span :class="'error_msg error_msg_score_'+index"></span>
                                                      </div>
                                                   </div>
                                                   <div class="row">
                                                      <div class="col-sm-6">
                                                         <div>
                                                            <label>Certificate Type </label>
                                                             <select class="wide form-control" v-model="certification.certificationType" name="certificationType" :id="'certificationType_'+index">
                                                               <option value="">Select</option>
                                                               <option value="Full Time">Full Time</option>
                                                               <option value="Part Time">Part Time</option>
                                                            </select>
                                                         </div>
                                                         <span :class="'error_msg error_msg_certificationType_'+index"></span>
                                                      </div>
                                                      <div class="col-sm-12">
                                                         <label>Description</label>
                                                         <textarea :id="'description_'+index" v-model="certification.description" name="description" class="form-control height-120" ></textarea>
                                                      </div>
                                                   </div>
                                                </div>
                                                <!-- <button type="button" class="btn theme-btn save-field">Save</button>
                                                <button type="button" class="btn theme-btn update-field">Update</button> -->
                                                <button  type="submit" class="btn add-field theme-btn">Update</button>
                                                <button @click="removeElement2(certification.resumeId)" type="button" class="btn remove-field light-gray-btn">Remove</button>
                                             </form>
                                             </div> 
                                             <!-- added records-->
                                             <div v-if="currentView" class="dublicat-box mrg-bot-40">
                                                <form @submit="submitaddform">
                                                <div class="row">
                                                   <div class="row">
                                                      <div class="col-sm-6">
                                                         <div>
                                                            <label>Course <span>*</span></label>
                                                            <input type="text" v-model="course" name="course" v-validate="'required'" class="form-control">
                                                            <p class="error_msg" >{{ errors.first('course') }}</p>
                                                         </div>
                                                      </div>
                                                      <div class="col-sm-6">
                                                         <div>
                                                            <label>Institute <span>*</span></label>
                                                            <input type="text" v-model="institute" name="institute" v-validate="'required'" class="form-control">
                                                             <p class="error_msg" >{{ errors.first('institute') }}</p>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div class="row">
                                                      <div class="col-sm-6">
                                                         <div class="col-md-6 padd-l-0">
                                                            <label>From <span>*</span></label>
                                                            <datepicker v-validate="'required'" :format="formatDate" name="startDate" v-model="startDate"></datepicker>
                                                               <p class="error_msg" >{{ errors.first('startDate') }}</p>
                                                         </div>
                                                         <div class="col-sm-6 padd-r-0">
                                                            <label>To <span>*</span></label>
                                                             <datepicker  :format="formatDate" v-validate="'required'" name="endDate" v-model="endDate"></datepicker>
                                                             <p class="error_msg" >{{ errors.first('endDate') }}</p>
                                                         </div>
                                                      </div>
                                                     <div class="col-sm-6 padd-r-0">
                                                            <label>Valid Till <span>*</span></label>
                                                            <datepicker v-if="!willExpire"  :format="formatDate" name="validTill" v-model="validTill"></datepicker>
                                                            <div class="form-group mrg-bot-0">
                                                               <span class="custom-checkbox">
                                                                  <input type="checkbox" name="willExpire" v-model="willExpire" id="willExpire" value="yes">
                                                                  <label for="willExpire"></label>Never Expire
                                                               </span>
                                                            </div>
                                                            <p class="error_msg" ></p>
                                                      </div>
                                                   </div>
                                                   <div class="row">
                                                      <div class="col-sm-6">
                                                      <div>
                                                         <label>Score </label>
                                                         <input type="text" name="score" v-model="score" class="form-control">
                                                      </div>
                                                   </div>
                                                   <div class="col-sm-6">
                                                      <div>
                                                         <label>Certificate Type </label>
                                                          <select class="wide form-control" v-model="certificationType" name="certificationType">
                                                            <option value="">Select</option>
                                                            <option value="Full Time">Full Time</option>
                                                            <option value="Part Time">Part Time</option>
                                                         </select>
                                                      </div>
                                                      <span class="error_msg">{{ errors.first('certificationType') }}</span>
                                                   </div>
                                                   </div>
                                                   
                                                   <div class="col-sm-12">
                                                      <label>Description</label>
                                                      <textarea v-model="description" name="description" class="form-control height-120" ></textarea>
                                                   </div>
                                                </div>
                                                <!-- <button type="button" class="btn theme-btn save-field">Save</button>
                                                <button type="button" class="btn theme-btn update-field">Update</button> -->
                                                <button  type="submit" class="btn add-field theme-btn">Save</button>
                                                <button @click="removeElement" type="button" class="btn remove-field light-gray-btn">Remove</button>
                                             </form>
                                             </div>
                                             <button v-if="!currentView" @click="addnewform2" type="button" class="btn add-field theme-btn">Add More</button>
                                          </div>
                                          <div class="text-right">
                                           <router-link to="/user_profile/professionaldetails" class="btn btn-m light-gray-btn">Back</router-link>
                                         <router-link to="/user_profile/skillsdetails" class="btn btn-m theme-btn">Next</router-link>
                                       </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>                                                                                                                                             
                        </div>
                     </div>
                     
                  </div>
               </section>
</div>
</template>

<script>
 import VueMoment from 'vue-moment'
 import Datepicker from 'vuejs-datepicker';
     export default {
      components: {
        Datepicker
      },
        data: () => ({
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            certifications:[],
            currentView:false,
            course:'',
            institute:'',
            startDate:'',
            endDate:'',
            validTill:'',
            willExpire:'',
            score:'',
            certificationType:'',
            description:'',
          }),
          
        beforeMount:function()
         {
            this.getcertificationdetails(this.$session.get('id'));
            document.title = Laravel.appName+' | Certification Details'
           
         },
         created: function () {

         },
         methods:{
            formatDate (date) {
              return this.$moment(date).format('MM/DD/YYYY')
            },
            getcertificationdetails(page) {
                  var serff=this;
                  axios
                 .get(Laravel.baseUrl+'/getcertificationdetails?access_token='+btoa(page))
                 .then(response => {
                  serff.certifications=response.data;
                  })
               },
            removeElement:function (inde){
                        this.currentView=false;
                        },
            resetvalue:function()
            {
            this.designation='';
            this.organization='';
            this.jobtype='';
            this.jobshift='';
            this.industry='';
            this.fArea='';
            this.currentlyWork='';
            this.roleandresp='';
            this.endDate='';
            this.startDate='';
            },
            submitaddform:function(e)
            {
               e.preventDefault();
               var selff=this;
               let currentObj = new FormData();
               currentObj.append('course', this.course);
               currentObj.append('institute', this.institute);
               currentObj.append('startDate', this.startDate);
               currentObj.append('endDate', this.endDate);
               currentObj.append('validTill', this.validTill);
               currentObj.append('willExpire', this.willExpire);
               currentObj.append('score', this.score);
               currentObj.append('certificationType', this.certificationType);
               currentObj.append('description', this.description);
               currentObj.append('userid', this.$session.get('id'));
               this.$validator.validateAll().then((result)=>{
                if(!result){
                  return false;
                }
               axios.post('/../add_certification_details',currentObj)
                .then(function (response) {
                    selff.certifications.push(response.data);
                    e.target.reset();
                    selff.currentView=false;
                    selff.resetvalue();
                     selff.flash("Certification details added successfuly",'success', {timeout: 3000});
                 }).catch(function (error) {
                    currentObj.output = error;
                })
               })
            },
            updateCertification(e,index)
            {
               e.preventDefault();
               var selff=this;
               if($("#course_"+index).val()=='')
               {
                  $(".error_msg_course_"+index).html('Please enter course name.');
                  return false;
               }else
               {
                $(".error_msg_course_"+index).html('');
               }
               if($("#institute_"+index).val()=='')
               {
                  $(".error_msg_institute_"+index).html('Please enter institute name.');
                  return false;
               }else
               {
                $(".error_msg_institute_"+index).html('');
               }
               if($("#startDate_"+index).val()=='')
               {
                  $(".error_msg_startDate_"+index).html('Please enter start date.');
                  return false;
               }else
               {
                $(".error_msg_startDate_"+index).html('');
               }
               if($("#endDate_"+index).val()=='')
               {
                  $(".error_msg_endDate_"+index).html('Please enter end date.');
                  return false;
               }else
               {
                $(".error_msg_endDate_"+index).html('');
               }
               if($("#willExpire_"+index).val()=='yes')
               {
                  if($("#validTill_"+index).val()=='')
                     {
                        $(".error_msg_validTill_"+index).html('Please enter expiry date.');
                        return false;
                     }else
                     {
                      $(".error_msg_validTill_"+index).html('');
                     }
               }
                if($("#score_"+index).val()=='')
               {
                  $(".error_msg_score_"+index).html('Please enter score.');
                  return false;
               }else
               {
                $(".error_msg_score_"+index).html('');
               }
               if($("#certificationType_"+index).val()=='')
               {
                  $(".error_msg_certificationType_"+index).html('Please select certification type.');
                  return false;
               }else
               {
                $(".error_msg_certificationType_"+index).html('');
               }

               let currentObj = new FormData();
               currentObj.append('course', $("#course_"+index).val());
               currentObj.append('institute', $("#institute_"+index).val());
               currentObj.append('startDate', $("#startDate_"+index).val());
               currentObj.append('endDate', $("#endDate_"+index).val());
               currentObj.append('willExpire', $("#willExpire_"+index).val());
               
               currentObj.append('resumeId', $("#resumeId_"+index).val());
               if(e.target[5].value!='yes')
               {
                 currentObj.append('validTill',  $("#validTill_"+index).val());
                 currentObj.append('score', $("#score_"+index).val());
               currentObj.append('certificationType', $("#certificationType_"+index).val());
               currentObj.append('description', $("#description_"+index).val());
               }else
               {
                   currentObj.append('validTill',  '');
                currentObj.append('score', $("#score_"+index).val());
               currentObj.append('certificationType', $("#certificationType_"+index).val());
               currentObj.append('description', $("#description_"+index).val());
               }
               currentObj.append('userid', this.$session.get('id'));
                axios.post('/../update_certification_details',currentObj)
                .then(function (response) {
                    //selff.educations.push(response.data);
                    selff.flash("Certification details updated successfuly",'success', {timeout: 3000});
                    //e.target.reset();
                    selff.currentView=false;
                 }).catch(function (error) {
                    currentObj.output = error;
                })
            },
            addnewform2:function()
             {
                this.currentView = true;
              
             },
           removeElement2: function(resumeId) {
                let currentObj = new FormData();
                var selff=this;
                currentObj.append('resumeId',resumeId);
                currentObj.append('userId',this.$session.get('id'));
                axios.post('/../removeCertificationInfo',currentObj)
                .then(function (response) {
                    selff.certifications=response.data;
                    selff.flash("Certification detail deleted successfuly",'success', {timeout: 3000});
                    selff.currentView=false;
                 }).catch(function (error) {
                    currentObj.output = error;
                })
                },
               getindustries:function()
               {
                  var serff=this;
                  axios
                 .get('/../getindustrylist')
                 .then(response => {
                     serff.industrylist=response.data;
                  })
               },
               getfunctionalarea:function()
               {
                  var serff=this;
                  axios
                 .get('/../getfunctionalarealist?industry='+this.industry)
                 .then(response => {
                     console.log(response.data);
                     serff.functionalarealist=response.data;
                  })
               },
         }
    }

</script>
<style>
.vdp-datepicker input
{
  height: 40px;
border: 1px solid #dde6ef;
margin-bottom: 10px;
box-shadow: none;
border-radius: 5px;
background: #fbfdff;
font-size: 15px;
color: #6b7c8a;
font-weight: 400;
display: block;
width: 100%;
padding: 6px 12px;
line-height: 1.42857143;
}
</style>