 <template>
   <div>
 <!-- ====================== Start Signup Form ============= -->
               <section class="">
                  <div class="container">
                     <div class="row">
                        <div class="col-md-12">
                           <!-- Add Qualification -->
                              <div class="box">
                                 <div class="box-header">
                                    <div class="width-100">
                                          <h4 class="pull-left">Skills Information </h4><!-- <span class="pull-right set_upper_button"><a href="certification_info.html" class="angle_left "> <i class="fa fa-angle-left" ></i></a><a href="resume_info.html" class="angle_right"><i class="fa fa-angle-right" ></i></a> </span> -->
                                    </div> 
                                 </div>
                                 <flash-message class="myCustomClass" variant="success"></flash-message>
                                 <div class="box-body">
                                    <div class="c-form">
                                       <div class="extra-field-box">
                                          <div class="multi-box"> 
                                             <div v-for="(skillss,index) in skills" class="dublicat-box mrg-bot-40">
                                                <form @submit="updateskills($event,index)">
                                                <div class="row mrg-bot-20">
                                                   <div class="col-sm-6">
                                                      <div>
                                                         <label>Skill <span>*</span></label>
                                                         <input v-model="skillss.skill" name="skill" :id="'skill_'+index" type="text" class="form-control">
                                                         <input :id="'resumeId_'+index" type="hidden" name="resumeId" v-model="skillss.resumeId">
                                                         <p :class="'error_msg error_msg_skill_'+index" ></p>
                                                      </div>
                                                   </div>
                                                   
                                                  <div class="col-sm-6">
                                                      <label>Expertise Level  <span>*</span></label>
                                                      <select :id="'expertise_'+index" v-model="skillss.expertise" name="expertise" class="wide form-control">
                                                         <option value="">Select</option>
                                                         <option value="Expert">Expert</option>
                                                         <option value="Intermediate">Intermediate</option>
                                                         <option value="Beginners">Beginners</option>
                                                      </select>
                                                       <p :class="'error_msg error_msg_expertise_'+index" ></p>
                                                   </div>
                                                  
                                                </div>
                                                <button type="submit" class="btn theme-btn save-field">Update</button>
                                               
                                                <button @click="removeElement2(skillss.resumeId)" type="button" class="btn remove-field light-gray-btn">Remove</button>
                                             </form>
                                             </div>




                                             <div v-if="currentView" class="dublicat-box mrg-bot-40">
                                                <form @submit="submitaddform">
                                                <div class="row mrg-bot-20">
                                                   <div class="col-sm-6">
                                                      <div>
                                                         <label>Skill <span>*</span></label>
                                                         <input v-model="skill" v-validate="'required'" name="skill" type="text" class="form-control">
                                                         <p class="error_msg" >{{ errors.first('skill') }}</p>
                                                      </div>
                                                   </div>
                                                   
                                                  <div class="col-sm-6">
                                                      <label>Expertise Level  <span>*</span></label>
                                                      <select v-validate="'required'" v-model="expertise" name="expertise" class="wide form-control">
                                                         <option value="">Select</option>
                                                         <option value="Expert">Expert</option>
                                                         <option value="Intermediate">Intermediate</option>
                                                         <option value="Beginners">Beginners</option>
                                                      </select>
                                                   </div>
                                                   <p class="error_msg" >{{ errors.first('expertise') }}</p>
                                                </div>
                                                <button type="submit" class="btn theme-btn save-field">Save</button>
                                                <!--<button type="button" class="btn theme-btn update-field">Update</button> -->
                                              
                                                <button @click="removeElement" type="button" class="btn remove-field light-gray-btn">Remove</button>
                                             </form>
                                             </div>
                                             <button @click="addnewform2" v-if="!currentView" type="button" class="btn add-field theme-btn">Add More</button>
                                          </div>
                                          <div class="text-right">
                                          <router-link to="/user_profile/certificationdetails" class="btn btn-m light-gray-btn">Back</router-link>
                                         <router-link to="/user_profile/resume" class="btn btn-m theme-btn">Next</router-link>
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
 
     export default {
        data: () => ({
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            skills:[],
            currentView:false,
            skill:'',
            expertise:'',
          }),
          
        beforeMount:function()
         {
            this.getskilldetails(this.$session.get('id'));
            document.title = Laravel.appName+' | Skill Details'
         },
         created: function () {

         },
         methods:{
            getskilldetails(page) {
                  var serff=this;
                  axios
                 .get(Laravel.baseUrl+'/getskilldetails?access_token='+btoa(page))
                 .then(response => {
                  serff.skills=response.data;
                  })
               },
            removeElement:function (inde){
                        this.currentView=false;
                        },
            resetvalue:function()
            {
               this.skill='';
               this.expertise='';
            },
            submitaddform:function(e)
            {
               e.preventDefault();
               var selff=this;
               let currentObj = new FormData();
               currentObj.append('skill', this.skill);
               currentObj.append('expertise', this.expertise);
               currentObj.append('resumeId', 0);
               currentObj.append('userid', this.$session.get('id'));
               this.$validator.validateAll().then((result)=>{
                if(!result){
                  return false;
                }
               axios.post(Laravel.baseUrl+'/add_skill_details',currentObj)
                .then(function (response) {
                    selff.skills.push(response.data);
                    e.target.reset();
                    selff.currentView=false;
                    selff.resetvalue();
                     selff.flash("Skill added successfuly",'success', {timeout: 3000});
                 }).catch(function (error) {
                    currentObj.output = error;
                })
               })
            },
            updateskills(event,index)
            {
               event.preventDefault();
               var selff=this;
               if($("#skill_"+index).val()=='')
               {
                  $(".error_msg_skill_"+index).html('The Skill Field Is Required.');
                  return false;
               }else
               {
                $(".error_msg_skill_"+index).html('');
               }
               if($("#expertise_"+index).val()=='')
               {
                  $(".error_msg_expertise_"+index).html('The Expertise Field Is Required.');
                  return false;
               }else
               {
                $(".error_msg_expertise_"+index).html('');
               }
               let currentObj = new FormData();

               currentObj.append('skill', $("#skill_"+index).val());
               currentObj.append('expertise', $("#expertise_"+index).val());
               currentObj.append('resumeId', $("#resumeId_"+index).val());
               currentObj.append('userid', this.$session.get('id'));
                axios.post(Laravel.baseUrl+'/add_skill_details',currentObj)
                .then(function (response) {
                    //selff.educations.push(response.data);
                    selff.flash("Skill updated successfuly",'success', {timeout: 3000});
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
                axios.post(Laravel.baseUrl+'/removeskillInfo',currentObj)
                .then(function (response) {
                    selff.skills=response.data;
                    selff.flash("Skill deleted successfuly",'success', {timeout: 3000});
                    selff.currentView=false;
                 }).catch(function (error) {
                    currentObj.output = error;
                })
                },
         }
    }

</script>