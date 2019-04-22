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
                                          <h4 class="pull-left">Educational Information </h4><!-- <span class="pull-right set_upper_button"><a href="personal_info.html" class="angle_left "> <i class="fa fa-angle-left" ></i></a><a href="professional_info.html" class="angle_right"><i class="fa fa-angle-right" ></i></a> </span> -->
                                          
                                    </div> 
                                 </div>
                                 <flash-message class="myCustomClass" variant="success"></flash-message>
                                 <div class="box-body">
                                    <div class="c-form">
                                       <div class="extra-field-box">
                                          <div class="multi-box"> 
                                             <div  v-for="(education,index) in educations" class="dublicat-box mrg-bot-40">
                                                <form :idd="education.resumeId" @submit="updateEducation($event,index)">
                                                <div class="row">
                                                   <div class="col-sm-6">
                                                      <label class="width-100">Education <span>*</span></label>
                                                      <select :value="education.education" :id="'education_'+index" class="education wide form-control">
                                                         <option value="10th">10th</option>
                                                         <option value="12th">12th</option>
                                                         <option value="Graduation/Diploma">Graduation/Diploma</option>
                                                         <option value="Masters/Post-Graduation">Masters/Post-Graduation</option>
                                                         <option value="Doctorate/PhD">Doctorate/PhD</option>
                                                      </select>
                                                      <span :class="'error_msg error_msg_education_'+index" ></span>
                                                   </div>
                                                   <div v-if="education.education=='10th' || education.education=='12th'" class="col-sm-6">
                                                      <div>
                                                         <label class="width-100">Board <span>*</span></label>
                                                         <select :value="education.board" class="board wide form-control" :id="'board_'+index">
                                                            <option value="All India">All India</option>
                                                            <option value="CBSE">CBSE</option>
                                                            <option value="CISCE(ICSE/ISC)">CISCE(ICSE/ISC)</option><option value="National Open School">National Open School</option>
                                                            <option value="State Board" >State Board</option>
                                                         </select>
                                                         <span :class="'error_msg error_msg_board_'+index" > </span>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="row">
                                                   <div v-if="education.education!='10th' && education.education!='12th'" class="col-sm-6">
                                                      <div>
                                                         <label>Degree Name <span>*</span></label>
                                                         <input type="text" :id="'degree_'+index" :value="education.degree" class="form-control degree">
                                                         <p :class="'error_msg error_msg_degree_'+index" > </p>
                                                      </div>
                                                   </div>
                                                   <div class="col-sm-6">
                                                      <label>GDPA/Percentage <span>*</span></label>
                                                      <input :value="education.percentage" :id="'percentage_'+index" type="text" class="form-control percentage">
                                                      <p :class="'error_msg error_msg_percentage_'+index" ></p>
                                                   </div>
                                                </div>
                                                <div class="row mrg-bot-20">
                                                   <div class="col-sm-6">
                                                      <label>Institute Name <span>*</span></label>
                                                      <input type="text" :value="education.institute" :id="'institute_'+index" class="form-control institute">
                                                      <p :class="'error_msg error_msg_institute_'+index" ></p>
                                                   </div>
                                                   
                                                   <div class="col-sm-6">
                                                      <label >Passing Out Year <span>*</span></label>
                                                    <!--   <input type="text" :value="education.passing_out_year" class="date-from form-control" readonly=""> -->
                                                       <datepicker :id="'passing_out_year_'+index" :format="formatDate"  :value="education.passing_out_year"></datepicker>
                                                      <input type="hidden" name="resumeId" :id="'resumeId_'+index" :value="education.resumeId">
                                                      <p :class="'error_msg error_msg_passing_out_year_'+index" ></p>
                                                   </div>
                                                </div>
                                               
                                                <button type="submit" class="btn theme-btn update-field">Update</button>
                                                <button @click="removeElement2(education.resumeId)" type="button" class="btn remove-field light-gray-btn">Remove</button>
                                                </form>
                                             </div>
                                            
                                            <!-- <template v-for="t in newbox">
                                                <div v-html="t">
                                                   
                                                </div>
                                               
                                            </template> -->
                                            <div v-if="currentView" id="addform">
                                              <div class="dublicat-box mrg-bot-40 cruel">
                                                <form  idd="addform" @submit="submitaddform">
                                                <input type="hidden" name="_token" :value="csrf">
                                                <input type="hidden" v-model="neweduid" name="educationid">
                                                <div class="row">
                                                   <div class="col-sm-6">
                                                      <label class="width-100">Education <span>*</span></label>
                                                      <select v-validate="'required'" class="wide form-control" v-model="newedu" name="education">
                                                        <option value="">Select</option>
                                                         <option value="10th">10th</option>
                                                         <option value="12th">12th</option>
                                                         <option value="Graduation/Diploma">Graduation/Diploma</option>
                                                         <option value="Masters/Post-Graduation">Masters/Post-Graduation</option>
                                                         <option value="Doctorate/PhD">Doctorate/PhD</option>
                                                      </select>
                                                      <span class="error_msg" >{{ errors.first('education') }}</span>
                                                   </div>
                                                   <div v-if="newedu=='10th' || newedu=='12th'" class="col-sm-6">
                                                      <div>
                                                         <label class="width-100">Board <span>*</span></label>
                                                         <select v-validate="'required'" v-model="newboard" name="board" class="wide form-control">
                                                            <option value="">Select</option>
                                                            <option value="All India">All India</option>
                                                            <option value="CBSE">CBSE</option>
                                                            <option value="CISCE(ICSE/ISC)">CISCE(ICSE/ISC)</option>
                                                            <option value="Diploma">Diploma</option>
                                                            <option value="National Open School">National Open School</option>
                                                            <option value="State Board">State Board</option>
                                                         </select>
                                                         <span class="error_msg" >{{ errors.first('board') }}</span>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="row">
                                                   <div v-if="newedu!='10th' && newedu!='12th'" class="col-sm-6">
                                                      <div>
                                                         <label>Degree Name <span>*</span></label>
                                                         <input v-validate="'required'" type="text" name="degree" v-model="newdegree" class="form-control">
                                                         <p class="error_msg" >{{ errors.first('degree') }}</p>
                                                      </div>
                                                   </div>
                                                   <div class="col-sm-6">
                                                      <label>GDPA/Percentage <span>*</span></label>
                                                      <input v-validate="'required'" type="text" name="gdpa/Percentage" v-model="newper" class="form-control">
                                                      <p class="error_msg" >{{ errors.first('gdpa/Percentage') }}</p>
                                                   </div>
                                                </div>
                                                <div class="row mrg-bot-20">
                                                   <div class="col-sm-6">
                                                      <label>Institute Name <span>*</span></label>
                                                      <input v-validate="'required'" type="text" name="institute" class="form-control" v-model="newinst">
                                                      <p class="error_msg" >{{ errors.first('institute') }}</p>
                                                   </div>
                                                   
                                                   <div class="col-sm-6">
                                                      <label >Passing Out Year <span>*</span></label>
                                                     <!--  <input  type="text" name="Date" :value="newpoy" class="date-from form-control date-from2" > -->
                                                      <datepicker v-validate="'required'" :format="formatDate" name="Date" v-model="newpoy"></datepicker>
                                                      <p class="error_msg error_msgdate" >{{ errors.first('Date') }}</p>
                                                   </div>
                                                </div>
                                                <button type="submit" class="btn theme-btn save-field">Save</button>
                                                <button @click="removeElement" type="button" class="btn remove-field light-gray-btn">Remove</button>
                                                </form>
                                             </div>
                                            </div>
                                           
                                          

                                           <!-- <component :is="currentView"></component> -->
                                           <button v-if="!currentView" @click="addnewform2" type="button" class="btn add-field theme-btn">Add More</button>
                                            </div>
                                          <div class="text-right">
                                         <router-link to="/user_profile/personalinfo" class="btn btn-m light-gray-btn">Back</router-link>
                                         <router-link to="/user_profile/professionaldetails" class="btn btn-m theme-btn">Next</router-link>
                                          
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
            educations:[],
            index:0,
            currentView:false,
            newedu:'',
            newboard:'',
            newdegree:'',
            newper:'',
            newinst:'',
            newpoy:'',
            neweduid:0
          }),
          
        beforeMount:function()
         {
            this.geteducationdetails(this.$session.get('id'));
            document.title = Laravel.appName+' | Educational Details'
          
         },
         methods:{
          /*  updatedate()
            {
              alert($('.date-from2').val());this.newpoy = $('.date-from2').val()
            },*/
            formatDate (date) {
              return this.$moment(date).format('MM/DD/YYYY')
            },
            geteducationdetails(page) {
                  var serff=this;
                  axios
                 .get('/../geteducationdetails?access_token='+btoa(page))
                 .then(response => {
                  serff.educations=response.data;
                  })
                 console.log(serff.educations);
               },
            removeElement:function (inde){
                         // $("#".inde).remove();
                          this.currentView=false;
                        },
            submitaddform:function(e)
            {
               e.preventDefault();
               var selff=this;
               var inde=$(this).attr('id');
               let currentObj = new FormData();
               currentObj.append('newedu', this.newedu);
               currentObj.append('newboard', this.newboard);
               currentObj.append('newdegree', this.newdegree);
               currentObj.append('newper', this.newper);
               currentObj.append('newinst', this.newinst);
               currentObj.append('newpoy', this.newpoy);
               currentObj.append('userid', this.$session.get('id'));
               this.$validator.validateAll().then((result)=>{
                if(!result){
                  return false;
                }
                /*if(this.newpoy=='')
                {
                  $(".error_msgdate").text("Please select passing out date");
                  return false;
                }else
                {
                  $(".error_msgdate").text("");
                }*/
               axios.post('/../addneweducation',currentObj)
                .then(function (response) {
                    selff.educations.push(response.data);
                    selff.flash("Educational details added successfuly",'success', {timeout: 3000});
                    e.target.reset();
                    selff.currentView=false;
                 }).catch(function (error) {
                    currentObj.output = error;
                })
               })
            },
            updateEducation(e,index)
            {
               e.preventDefault();
               if($("#education_"+index).val()=='')
               {
                  $(".error_msg_education_"+index).html('Please enter your education.');
                  return false;
               }else
               {
                $(".error_msg_education_"+index).html('');
               }

               if($("#education_"+index).val()=='10th' || $("#education_"+index).val()=='12th')
               {
                 if($("#board_"+index).val()=='')
                 {
                    $(".error_msg_board_"+index).html('Please select education board.');
                    return false;
                 }else
                 {
                  $(".error_msg_board_"+index).html('');
                 }
              }else
              {
                  if($("#degree_"+index).val()=='')
                 {
                    $(".error_msg_degree_"+index).html('Please enter degree.');
                    return false;
                 }else
                 {
                  $(".error_msg_degree_"+index).html('');
                 }
              }

               if($("#percentage_"+index).val()=='')
               {
                  $(".error_msg_percentage_"+index).html('Please enter your percentage/gdpa.');
                  return false;
               }else
               {
                $(".error_msg_percentage_"+index).html('');
               }

               if($("#institute_"+index).val()=='')
               {
                  $(".error_msg_institute_"+index).html('Please enter your institute name.');
                  return false;
               }else
               {
                $(".error_msg_institute_"+index).html('');
               }
               if($("#passing_out_year_"+index).val()=='')
               {
                  $(".error_msg_passing_out_year_"+index).html('Please enter passing out year.');
                  return false;
               }else
               {
                $(".error_msg_passing_out_year_"+index).html('');
               }

               var education=$("#education_"+index).val();
               if(education=='10th' || education=='12th')
               {
                var board=$("#board_"+index).val(); 
               var degree='';
               }else
               {
                var board='';
               var degree=$("#degree_"+index).val();
               }
               
               
               var percentage=$("#percentage_"+index).val();
               var institute=$("#institute_"+index).val();
               var passingoutyear=$("#passing_out_year_"+index).val();
               var resumeid=$("#resumeId_"+index).val();
               var selff=this;
               let currentObj = new FormData();
               currentObj.append('newedu',education);
               currentObj.append('newboard',board);
               currentObj.append('newdegree',degree);
               currentObj.append('newper',percentage);
               currentObj.append('newinst',institute);
               currentObj.append('newpoy',passingoutyear);
               currentObj.append('resumeId',resumeid);
                axios.post('/../updateEducationalInfo',currentObj)
                .then(function (response) {
                    //selff.educations.push(response.data);
                    selff.flash("Educational details updated successfuly",'success', {timeout: 3000});
                    //e.target.reset();
                    selff.currentView=false;
                 }).catch(function (error) {
                    currentObj.output = error;
                })
            },
            addnewform2:function()
             {
                this.currentView = true;
                //console.log(this.educations);
             },
           removeElement2: function(resumeId) {
                let currentObj = new FormData();
                var selff=this;
                currentObj.append('resumeId',resumeId);
                currentObj.append('userId',this.$session.get('id'));
                axios.post('/../removeEducationalInfo',currentObj)
                .then(function (response) {
                    selff.educations=response.data;
                    selff.flash("Educational detail deleted successfuly",'success', {timeout: 3000});
                    //e.target.reset();
                    selff.currentView=false;
                 }).catch(function (error) {
                    currentObj.output = error;
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