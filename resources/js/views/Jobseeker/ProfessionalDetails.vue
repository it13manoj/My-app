<template>
<div>
<section >
                  <div class="container">
                     <div class="row">
                        <div class="col-md-12">
                           <!-- Add Qualification -->
                              <div class="box">
                                 <div class="box-header">
                                    <div class="width-100">
                                          <h4 class="pull-left">Professional Information </h4><!-- <span class="pull-right set_upper_button"><a href="education_info.html" class="angle_left "> <i class="fa fa-angle-left" ></i></a><a href="certification_info.html" class="angle_right"><i class="fa fa-angle-right" ></i></a> </span> -->
                                          
                                    </div> 
                                 </div>
                                 <flash-message class="myCustomClass" variant="success"></flash-message>
                                 <div class="box-body">
                                    <div class="c-form">
                                       <div class="extra-field-box">
                                          <div class="multi-box"> 
                                             <div v-for="(professional,index) in professionals" class="dublicat-box mrg-bot-40">
                                              <form class="c-form" @submit="updateProfessional($event,index)">
                                                <div class="row">
                                                   <div class="col-sm-6">
                                                      <div>
                                                         <label>Designation <span>*</span></label>
                                                         <input name="designation" :id="'designation_'+index" type="text" v-model="professional.designation" class="form-control">
                                                         <input type="hidden" :id="'resumeId_'+index" name="resumeId" v-model="professional.resumeId">
                                                          <p :class="'error_msg error_msg_designation_'+index" ></p>
                                                      </div>
                                                   </div>
                                                   <div class="col-sm-6">
                                                      <div>
                                                         <label>Organization <span>*</span></label>
                                                         <input  name="organization" :id="'organization_'+index" v-model="professional.organization" type="text" class="form-control">
                                                         <p :class="'error_msg error_msg_organization_'+index" ></p>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="row">
                                                   <div class="col-sm-6">
                                                      <label class="width-100">Job Type <span>*</span></label>
                                                      <div class="form-group mrg-bot-0">
                                                         <select :id="'jobtype_'+index" v-model="professional.jobtype"  class="wide form-control" name="jobtype" >
                                                         <option value="">Select</option>
                                                         <option value="Full Time">Full Time</option>
                                                         <option value="Part Time">Part Time</option>
                                                         <option value="Internship">Internship</option>
                                                         </select>
                                                      </div>
                                                      <span :class="'error_msg error_msg_jobtype_'+index" ></span>
                                                   </div>
                                                   <div class="col-sm-6">
                                                      <label class="width-100">Job Shift </label>
                                                      <div class="form-group mrg-bot-0">
                                                         <select :id="'jobshift_'+index" v-model="professional.jobshift" name="jobshift" class="wide form-control">
                                                            <option value="">Select</option>
                                                            <option data-display="Day">Day</option>
                                                            <option value="Night">Night</option>
                                                            <option value="Morning">Morning</option>
                                                         </select>
                                                      </div>
                                                      <span :class="'error_msg error_msg_jobshift_'+index" ></span>
                                                   </div>
                                                </div>
                                                <div class="row">
                                                   <div class="col-sm-6">
                                                      <label class="width-100">Industry <span>*</span></label>
                                                      <select :id="'industry_'+index" v-model="professional.industry"  class="wide form-control" @change="getfunctionalarea" name="industry">
                                                         <option value=""> Select</option>
                                                         <option v-for="indust in industrylist" :value="indust.category_id">{{indust.category_name}}</option>
                                                      </select>
                                                      <span :class="'error_msg error_msg_industry_'+index" ></span>
                                                   </div>
                                                   <div class="col-sm-6">
                                                      <label class="width-100">Functional Area <span>*</span></label>
                                                      <select v-model="professional.fArea" class="wide form-control"  name="functional_Area" :id="'functional_Area_'+index">
                                                         <option value="">Select</option>
                                                      <option v-for="functional in professional.subcatlist" :value="functional.subcategory_id">{{functional.subcategory_name}}</option>
                                                      </select>
                                                      <span :class="'error_msg error_msg_functional_Area_'+index" ></span>
                                                   </div>
                                                </div>
                                                <div class="row">
                                                   <div class="col-sm-6">
                                                      <label>From <span>*</span></label>
                                                     <datepicker :id="'startDate_'+index" :format="formatDate" v-model="professional.startDate" name="startDate" ></datepicker>
                                                      <p :class="'error_msg error_msg_startDate_'+index" ></p>
                                                   </div>
                                                   <div class="col-sm-6">
                                                      <label>To <span>*</span></label>
                                                       <datepicker v-if="!professional.currentlyWork"  :format="formatDate" name="endDate" v-model="professional.endDate" :id="'endDate_'+index"></datepicker>
                                                      <div class="form-group mrg-bot-0">
                                                         <span class="custom-checkbox">
                                                            <input :id="'currentlyWork_'+index" type="checkbox" v-model="professional.currentlyWork" value="yes" id="currentlyWork">
                                                            <label for="currentlyWork"></label>Currently work here
                                                         </span>
                                                      </div>
                                                      <p :class="'error_msg error_msg_endDate_'+index" > </p>
                                                   </div>
                                                </div>
                                                <div class="row mrg-bot-20">
                                                   <div class="col-sm-12">
                                                      <label>Roles and Responsibility</label>
                                                      <textarea v-model="professional.roleandresp"  class="form-control height-120" name="Responsibility" :id="'responsibility_'+index" placeholder="Roles and Responsibility"></textarea>
                                                   </div>
                                                   <p :class="'error_msg error_msg_responsibility_'+index" ></p>
                                                </div>
                                                <!-- <button type="button" class="btn theme-btn save-field">Save</button>
                                                <button type="button" class="btn theme-btn update-field">Update</button> -->
                                                <button type="submit" class="btn add-field theme-btn">Update</button>
                                                <button  @click="removeElement2(professional.resumeId)" type="button" class="btn remove-field light-gray-btn">Remove</button>
                                              </form>
                                             </div>
                                             <!-- add new div -->
                                             <div v-if="currentView" class="dublicat-box mrg-bot-40">
                                              <form class="c-form" @submit="submitaddform" id="addform">
                                                <div class="row">
                                                   <div class="col-sm-6">
                                                      <div>
                                                         <label>Designation <span>*</span></label>
                                                         <input v-model="designation" name="designation" v-validate="'required'" type="text" class="form-control">
                                                          <p class="error_msg" >{{ errors.first('designation') }}</p>
                                                      </div>
                                                   </div>
                                                   <div class="col-sm-6">
                                                      <div>
                                                         <label>Organization <span>*</span></label>
                                                         <input v-model="organization" name="organization" v-validate="'required'" type="text" class="form-control">
                                                         <p class="error_msg" >{{ errors.first('organization') }}</p>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="row">
                                                   <div class="col-sm-6">
                                                      <label class="width-100">Job Type <span>*</span></label>
                                                      <div class="form-group mrg-bot-0">
                                                         <select v-validate="'required'" class="wide form-control" name="jobtype" v-model="jobtype">
                                                         <option value="">Select</option>
                                                         <option value="Full Time">Full Time</option>
                                                         <option value="Part Time">Part Time</option>
                                                         <option value="Internship">Internship</option>
                                                         </select>
                                                      </div>
                                                      <span class="error_msg" >{{ errors.first('jobtype') }}</span>
                                                   </div>
                                                   <div class="col-sm-6">
                                                      <label class="width-100">Job Shift </label>
                                                      <div class="form-group mrg-bot-0">
                                                         <select v-validate="'required'" v-model="jobshift" name="jobshift" class="wide form-control">
                                                            <option value="">Select</option>
                                                            <option data-display="Day">Day</option>
                                                            <option value="Night">Night</option>
                                                            <option value="Morning">Morning</option>
                                                         </select>
                                                      </div>
                                                      <span class="error_msg" >{{ errors.first('jobshift') }}</span>
                                                   </div>
                                                </div>
                                                <div class="row">
                                                   <div class="col-sm-6">
                                                      <label class="width-100">Industry <span>*</span></label>
                                                      <select v-validate="'required'" class="wide form-control" @change="getfunctionalarea" v-model="industry" name="industry">
                                                         <option value=""> Select</option>
                                                         <option v-for="indust in industrylist" :value="indust.category_id">{{indust.category_name}}</option>
                                                      </select>
                                                      <span class="error_msg" >{{ errors.first('industry') }}</span>
                                                   </div>
                                                   <div class="col-sm-6">
                                                      <label class="width-100">Functional Area <span>*</span></label>
                                                      <select v-validate="'required'" class="wide form-control" v-model="fArea" name="functional_Area">
                                                         <option value="">Select</option>
                                                      <option v-for="functional in functionalarealist" :value="functional.subcategory_id">{{functional.subcategory_name}}</option>
                                                      </select>
                                                      <span class="error_msg" >{{ errors.first('functional_Area') }}</span>
                                                   </div>
                                                </div>
                                                <div class="row">
                                                   <div class="col-sm-6">
                                                      <label>From <span>*</span></label>
                                                     <datepicker v-validate="'required'" :format="formatDate" name="startDate" v-model="startDate"></datepicker>
                                                      <p class="error_msg" >{{ errors.first('startDate') }}</p>
                                                   </div>
                                                   <div class="col-sm-6">
                                                      <label>To <span>*</span></label>
                                                       <datepicker v-if="!currentlyWork"  :format="formatDate" name="endDate" v-model="endDate"></datepicker>
                                                      <div class="form-group mrg-bot-0">
                                                         <span class="custom-checkbox">
                                                            <input  type="checkbox" v-model="currentlyWork" value="yes" id="currentlyWork">
                                                            <label for="currentlyWork"></label>Currently work here
                                                         </span>
                                                      </div>
                                                      <p class="error_msg" > </p>
                                                   </div>
                                                </div>
                                                <div class="row mrg-bot-20">
                                                   <div class="col-sm-12">
                                                      <label>Roles and Responsibility</label>
                                                      <textarea v-validate="'required'" v-model="roleandresp" class="form-control height-120" name="Responsibility" placeholder="Roles and Responsibility"></textarea>
                                                   </div>
                                                   <p class="error_msg" >{{ errors.first('Responsibility') }}</p>
                                                </div>
                                                <!-- <button type="button" class="btn theme-btn save-field">Save</button>
                                                <button type="button" class="btn theme-btn update-field">Update</button> -->
                                                <button type="submit" class="btn add-field theme-btn">Save</button>
                                                <button @click="removeElement" type="button" class="btn remove-field light-gray-btn">Remove</button>
                                              </form>
                                             </div>
                                             <!-- add new div -->
                                              <button v-if="!currentView" @click="addnewform2" type="button" class="btn add-field theme-btn">Add More</button>
                                          </div>
                                          <div class="text-right">
                                          <router-link to="/user_profile/educationaldetails" class="btn btn-m light-gray-btn">Back</router-link>
                                         <router-link to="/user_profile/certificationdetails" class="btn btn-m theme-btn">Next</router-link>
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
            professionals:[],
            index:0,
            currentView:false,
            designation:'',
            organization:'',
            jobtype:'',
            jobshift:'',
            industry:'',
            fArea:'',
            currentlyWork:'',
            roleandresp:'',
            endDate:'',
            startDate:'',
            neweduid:0,
            industrylist:'',
            functionalarealist:'',
          }),
          
        beforeMount:function()
         {
            this.getprofessionaldetails(this.$session.get('id'));
            document.title = Laravel.appName+' | Professional Details'
         },
         created: function () {
             this.getindustries();
         },
         methods:{
            formatDate (date) {
              return this.$moment(date).format('MM/DD/YYYY')
            },
            getprofessionaldetails(page) {
                  var serff=this;
                  axios
                 .get('/../getprofessionaldetails?access_token='+btoa(page))
                 .then(response => {
                  serff.professionals=response.data;
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
               var inde=$(this).attr('id');
               let currentObj = new FormData();
               currentObj.append('designation', this.designation);
               currentObj.append('organization', this.organization);
               currentObj.append('jobtype', this.jobtype);
               currentObj.append('jobshift', this.jobshift);
               currentObj.append('industry', this.industry);
               currentObj.append('fArea', this.fArea);
               currentObj.append('currentlyWork', this.currentlyWork);
               currentObj.append('roleandresp', this.roleandresp);
               currentObj.append('endDate', this.endDate);
               currentObj.append('startDate', this.startDate);
               currentObj.append('userid', this.$session.get('id'));
               this.$validator.validateAll().then((result)=>{
                if(!result){
                  return false;
                }
               axios.post('/../add_professional_details',currentObj)
                .then(function (response) {
                    selff.professionals.push(response.data);
                    e.target.reset();
                    selff.currentView=false;
                    selff.resetvalue();
                     selff.flash("Professional details added successfuly",'success', {timeout: 3000});
                 }).catch(function (error) {
                    currentObj.output = error;
                })
               })
            },
            updateProfessional(event,index)
            {
               event.preventDefault();
               var selff=this;
               let currentObj = new FormData();
               if($("#designation_"+index).val()=='')
               {
                  $(".error_msg_designation_"+index).text('Please enter your designation');
                  return false;
               }else
               {
                  $(".error_msg_designation_"+index).text('');
               }

               if($("#organization_"+index).val()=='')
               {
                  $(".error_msg_organization_"+index).text('Please enter organization');
                  return false;
               }else
               {
                  $(".error_msg_organization_"+index).text('');
               }

               if($("#jobtype_"+index).val()=='')
               {
                  $(".error_msg_jobtype_"+index).text('Please select job type');
                  return false;
               }else
               {
                  $(".error_msg_jobtype_"+index).text('');
               }

               if($("#jobshift_"+index).val()=='')
               {
                  $(".error_msg_jobshift_"+index).text('Please select job shift');
                  return false;
               }else
               {
                  $(".error_msg_jobshift_"+index).text('');
               }

               if($("#industry_"+index).val()=='')
               {
                  $(".error_msg_industry_"+index).text('Please select industry');
                  return false;
               }else
               {
                  $(".error_msg_industry_"+index).text('');
               }

               if($("#functional_Area_"+index).val()=='')
               {
                  $(".error_msg_functional_Area_"+index).text('Please select functional area');
                  return false;
               }else
               {
                  $(".error_msg_functional_Area_"+index).text('');
               }

               if($("#startDate_"+index).val()=='')
               {
                  $(".error_msg_startDate_"+index).text('Please enter your designation');
                  return false;
               }else
               {
                  $(".error_msg_startDate_"+index).text('');
               }

               if($("#responsibility_"+index).val()=='')
               {
                  $(".error_msg_responsibility_"+index).text('Please enter your roles & responsibility');
                  return false;
               }else
               {
                  $(".error_msg_responsibility_"+index).text('');
               }
               if($("#currentlyWork_"+index).val()!='yes')
               {
                  if($("#endDate_"+index).val()=='')
                  {
                     $(".error_msg_endDate_"+index).text('Please select end date');
                     return false;
                  }else
                  {
                     $(".error_msg_endDate_"+index).text('');
                  }
               }

                currentObj.append('designation', $("#designation_"+index).val());
               currentObj.append('organization', $("#organization_"+index).val());
               currentObj.append('jobtype', $("#jobtype_"+index).val());
               currentObj.append('jobshift', $("#jobshift_"+index).val());
               currentObj.append('industry', $("#industry_"+index).val());
               currentObj.append('fArea', $("#functional_Area_"+index).val());
               currentObj.append('startDate',  $("#startDate_"+index).val());
               currentObj.append('currentlyWork', $("#currentlyWork_"+index).val());
              
               currentObj.append('resumeId', $("#resumeId_"+index).val());
               if($("#currentlyWork_"+index).val()=='yes')
               {
                 currentObj.append('roleandresp',  $("#responsibility_"+index).val());
               }else
               {
                currentObj.append('endDate',  $("#endDate_"+index).val());
                currentObj.append('roleandresp',  $("#responsibility_"+index).val());
               }
                axios.post(Laravel.baseUrl+'/update_professional_details',currentObj)
                .then(function (response) {
                    //selff.educations.push(response.data);
                    selff.flash("Professional details updated successfuly",'success', {timeout: 3000});
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
                axios.post('/../removeProfessionalInfo',currentObj)
                .then(function (response) {
                    selff.professionals=response.data;
                    selff.flash("Professional detail deleted successfuly",'success', {timeout: 3000});
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