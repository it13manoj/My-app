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
                                    <h4 class="pull-left">Resume & Cover Letter </h4>
                                 </div>
                              </div>
                              <flash-message class="myCustomClass" variant="success"></flash-message>
                              <div class="box-body">
                                 <form class="c-form" enctype="multipart/form-data" @submit="submitaddform">
                                    <div class="">
                                       <div class="">
                                          <div class="mrg-bot-40">
                                             <div class="row">
                                                <div class="col-sm-12">
                                                   <div>
                                                      <label>Resume <span>*</span></label>
                                                      <div class="custom-file-upload form-control">
                                                         <input  @change="changefile" type="file" id="file" name="resume" placeholder="Browse" class="" accept="application/msword,application/pdf"  />
                                                         <input type="hidden" name="resumeId" v-model="resumeId" value="0">
                                                      </div>
                                                   </div>
                                                   <p class="error_msg error_msg_resume" ></p>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-sm-12">
                                                   <div>
                                                      <label>Video Resume</label>
                                                      <div class="custom-file-upload form-control">
                                                         <input @change="changefile2" type="file" id="file" name="myfiles" placeholder="Browse" class="" multiple />
                                                      </div>
                                                      <div class="log-option mrg-bot-0 mrg-top-40"><span>OR</span></div>
                                                      <div >
                                                         <label>Video Resume Link</label>
                                                         <input type="text" v-model="resume_link" class="form-control">
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- cover letter  -->
                                             <div class="row">
                                                <div class="col-sm-12">
                                                   <label>Cover Letter <span>*</span></label>
                                                   <!-- <textarea v-model="cover_letter" name="coverletter" class="form-control height-120 textarea" placeholder="Resume"></textarea> -->
                                                   
                                                   
                                                   <textarea id="cover_letter" class="form-control height-120 cover_letter" placeholder="Cover letter" name="coverletter" v-model="cover_letter"></textarea>
                                                   <p class="error_msg error_msg_cover_letter" ></p>
                                                </div>

                                             </div>
                                                <button v-if="resumeId==0" type="submit" class="btn theme-btn update-field">Save</button>
                                                <button v-else type="submit" class="btn theme-btn update-field">Update</button> 
                                            
                                          </div>
                                       </div>
                                       <div class="text-right">
                                         
                                          <router-link to="/user_profile/skillsdetails" class="btn btn-m light-gray-btn">Back</router-link>
                                         <router-link to="/user_dashboard" class="btn btn-m theme-btn">Finish</router-link>
                                       </div>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </section>
</div>
</template>
<script>
 
  /*$(document).ready(function(){
  CKEDITOR.replace( 'cover_letter' );
});*/
     export default {
        data: () => ({
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            resume:'',
            video_resume:'',
            old_resume:'',
            old_video_resume:'',
            resume_link:'',
            resumeId:'0',
            cover_letter:'',
            
          }),
          
        beforeMount:function()
         {
            this.getresumedetails(this.$session.get('id'));
            document.title = Laravel.appName+' | Resume';

         },
         created: function () {
           
         },
         mounted:function()
         {
          CKEDITOR.replace( 'cover_letter' );
         },
         methods:{
            getresumedetails(page) {
                  var serff=this;
                  axios
                 .get(Laravel.baseUrl+'/getresumedetails?access_token='+btoa(page))
                 .then(response => {
                  //console.log(response.data[0].cover_letter);
              //    serff.resume=response.data;
                  serff.cover_letter=response.data[0].cover_letter;
                  serff.resume_link=response.data[0].resume_link;
                  serff.resumeId=response.data[0].resumeId;
                  serff.old_resume=response.data[0].resume;
                  serff.old_video_resume=response.data[0].video_resume;
                  })
               },
            submitaddform:function(e)
            {
               e.preventDefault();
               var cletter=CKEDITOR.instances['cover_letter'].getData();
               
               if(this.old_resume=='' || this.old_resume==null)
               {
                if($('#file').get(0).files.length === 0)
               {
                $(".error_msg_resume").text("Please update your resume");
                return false;
               }else
               {
                $(".error_msg_resume").text("");
               }
               }
               if(cletter=='')
               {
                $(".error_msg_cover_letter").text("Please update your cover letter");
                return false;
               }else
               {
                $(".error_msg_cover_letter").text("");
               }
               var selff=this;
               let currentObj = new FormData();
               if(this.resume!='' && this.resume!=null){
                     currentObj.append('resume', this.resume, this.resume.name);
               }
               if(this.video_resume!='' && this.video_resume!=null){
                     currentObj.append('video_resume', this.video_resume, this.video_resume.name);
               }
               currentObj.append('resume_link', this.resume_link);
               currentObj.append('cover_letter', CKEDITOR.instances['cover_letter'].getData());
               currentObj.append('resumeId', this.resumeId);
               currentObj.append('userid', this.$session.get('id'));
              /* alert(this.cover_letter);
               return false;*/
               this.$validator.validateAll().then((result)=>{
                if(!result){
                  return false;
                }
               axios.post(Laravel.baseUrl+'/add_resume',currentObj)
                .then(function (response) {
                    e.target.reset();
                    selff.resume_link=response.data.resume_link;
                    selff.resumeId=response.data.resumeId;
                    selff.old_resume=response.data.resume;
                    selff.old_video_resume=response.data.video_resume;
                    selff.flash("Resume updated successfuly",'success', {timeout: 3000});
                 }).catch(function (error) {
                    currentObj.output = error;
                })
               })
            },
            changefile:function(e)
               {
                this.resume=e.target.files[0];
            },
            changefile2:function(e)
               {
                this.video_resume=e.target.files[0];
            },
         }
    }

</script>