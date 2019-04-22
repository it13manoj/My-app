	<template>
	<div>
<div class="container">
				
				<section class="padd-top-0">
					<!-- filter bar -->
					<div class="row">
						<div class="col-md-4 col-sm-12">
							<span class="resulttext">Showing {{startfrom}}-{{endto}} of {{total}} Results</span>
						</div>
						<div class="col-sm-8">
							<!-- <div class="col-md-12 padd-l-0">
								<div class="col-md-5 col-sm-12">
									<div class="field_w_search">
	                                    <input type="text" class="form-control" placeholder="Search Job">
	                                </div>
								</div>
								<div class="col-md-4 col-sm-6">
			                        <div class="search-wide full ">
			                           <select class="wide form-control">
			                              <option value="1" data-display="Sort By">All</option>
			                              <option value="2">Most Viewed</option>
			                              <option value="4">Most Search</option>
			                           </select>
			                        </div>
			                    </div>
			                    <div class="col-md-3 col-sm-6">
			                    	<div class="filter">
			                        	<a href="javascript:void(0)" class="btn theme-btn btn-width-200 theme-btn-outlined" data-toggle="modal" data-target="#filter">Filter</a>
			                        </div>
			                    </div>
							</div> --> 
		                </div>
					</div>
					<flash-message class="myCustomClass" variant="success"></flash-message>
					<div class="row padd-top-30">
						<div class="col-md-12 col-sm-12">
							<div class="tab style-2" role="tabpanel">
								<!-- Nav tabs -->
								<ul class="nav nav-tabs" role="tablist">
									<li  v-bind:class="[atype=='All' ? 'active' : '']"><a href="javascript:;" @click="getResultss('All')">All</a></li>
									<li v-bind:class="[atype=='Applied' ? 'active' : '']" ><a href="javascript:;" @click="getResultss('Applied')">New Applied</a></li>
									<li v-bind:class="[atype=='Shortlisted' ? 'active' : '']"><a href="javascript:;" @click="getResultss('Shortlisted')">Shortlisted</a></li>
									<li v-bind:class="[atype=='Rejected' ? 'active' : '']"><a href="javascript:;" @click="getResultss('Rejected')">Rejected</a></li>
									<li v-bind:class="[atype=='Interview' ? 'active' : '']"><a href="javascript:;" @click="getResultss('Interview')">InterView Scheduled</a></li>
									<li v-bind:class="[atype=='Offered' ? 'active' : '']"><a href="javascript:;" @click="getResultss('Offered')">Offer</a></li>
									<li v-bind:class="[atype=='Hired' ? 'active' : '']"><a href="javascript:;" @click="getResultss('Hired')">Hire</a></li>
									<!-- <li role="presentation"><a href="#review" aria-controls="review" role="tab" data-toggle="tab">Review</a></li> -->
									<li v-bind:class="[atype=='FutureSave' ? 'active' : '']"><a href="javascript:;" @click="getResultss('FutureSave')">Save for further</a></li>
								</ul>
								<!-- Tab panes -->
								<div class="tab-content tabs">
									<div role="tabpanel" class="tab-pane fade in active" id="all">
										<div class="table-responsive"> 
											<table class="table table-lg table-hover">
												<thead>
													<tr>
														<th><div class="form-group mrg-bot-0">
							                                  <span class="custom-checkbox">
							                                     <input class="checkall" @change="checkall" type="checkbox" id="0">
							                                     <label for="0"></label>
							                                  </span>
							                               </div>
							                            </th>
														<th>Name</th>
														<th>Applied on</th>
														<th>Experience </th>
														<th>Current Designation</th>
														<th>Expected Salary</th>
														<th>Notice Period </th>
														<th>Actions</th>
													</tr>
												</thead>
												
												<tbody>
													<tr v-if="laravelData.data.length<1">No data found</tr>
													<tr v-else v-for="(apps,index) in laravelData.data">
														<td>
															<div class="form-group mrg-bot-0">
							                                  <span class="custom-checkbox">
							                                     <input v-model="candidates" type="checkbox" :id="apps.id" :value="apps.id+'_'+index" class="candidatecheck" :checked="candidates.indexOf(apps.id) >= 0">
							                                     <label :for="apps.id"></label>
							                                  </span>
							                               </div>
							                           </td>
														<td>
															<a target="_blank" :href="baseUrl+'/employer/candidate_profile/'+apps.user_slug+'/'+apps.id">
															<img v-if="apps.user_profile_picture!=''" :src="baseUrl+'/admin_assets/uploaded_images/profile_pic/thumb/'+apps.user_profile_picture" class="avatar avatar-lg" alt="Avatar"><span>{{apps.user_first_name}} {{apps.user_last_name}}</span>
															<span class="mng-jb">{{apps.email}}</span>
															</a>
														</td>
														<td>{{apps.appliedDate}}</td>
														<td><span v-if="apps.user_experience_year">{{apps.user_experience_year}} year</span></td>
														<td><span v-if="apps.user_designation">{{apps.user_designation}}</span></td>                
														<td><span v-if="apps.user_expected_salary">{{apps.user_expected_salary}} Rs/year</span></td>
														<td><span v-if="apps.notice_period">{{apps.notice_period}}</span></td>
														<td>
<a v-if="apps.applicationStatus=='Shortlisted'" href="javascript:;"  title="Shortlist" class="cl-gray mrg-5"><i class="fa fa-check-square-o"></i></a>
<a v-else href="javascript:;" @click="updateApplicationStatus(apps.id,index,'Shortlisted')" title="Shortlist" class="cl-info mrg-5"><i class="fa fa-check-square-o"></i></a>


<a v-if="apps.applicationStatus=='Rejected'" href="javascript:;" class="cl-gray  mrg-5"  title="Reject"><i class="fa  fa-remove"></i></a>
<a v-else href="javascript:;" @click="updateApplicationStatus(apps.id,index,'Rejected')" class=" cl-danger mrg-5"  title="Reject"><i class="fa  fa-remove"></i></a>


<a v-if="apps.applicationStatus=='Interview'" href="javascript:;"  class="cl-gray mrg-5"   title="Schedule Interview"><i class="fa fa-calendar-plus-o"></i></a>
<a v-else href="javascript:;" @click="updatecandidate(apps.id)" data-toggle="modal" data-target="#interview_scheduled_modal" class="cl-primary mrg-5"   title="Schedule Interview"><i class="fa fa-calendar-plus-o"></i></a>
														

<a v-if="apps.applicationStatus=='Offered'" href="javascript:;"  class="cl-gray mrg-5" title="Offer"><i class="fa fa-file-text-o"></i></a>
<a v-else href="javascript:;" @click="updateApplicationStatus(apps.id,index,'Offered')" class="cl-success mrg-5" title="Offer"><i class="fa fa-file-text-o"></i></a>


<a v-if="apps.applicationStatus=='Hired'" href="javascript:;" class="cl-gray mrg-5" hover title="Hire"><i class="fa fa-thumbs-o-up"></i></a>
<a v-else href="javascript:;" @click="updateApplicationStatus(apps.id,index,'Hired')" class="cl-purple mrg-5" hover title="Hire"><i class="fa fa-thumbs-o-up"></i></a>


<a href="javascript:;" @click="sendmessage1(apps.id)" data-toggle="modal" data-target="#message" class="cl-default mrg-5" hover title="Message"><i class="fa fa-commenting-o"></i></a>

<a v-if="apps.applicationStatus=='FutureSave'" href="javascript:;" class="cl-gray mrg-5"hover title="Save"><i class="fa fa-star-o"></i></a>
<a v-else href="javascript:;" @click="updateApplicationStatus(apps.id,index,'FutureSave')" class="cl-warning mrg-5"hover title="Save"><i class="fa fa-star-o"></i></a>
														</td>  
													</tr>
													
													
												</tbody>
											</table>
											
											<!-- flexbox -->
											<div class="flexbox padd-10">
												 <pagination :data="laravelData" @pagination-change-page="getResults"></pagination>
											</div>
											<!-- /.flexbox -->
										</div>
									</div>
									
									
									
									
									
									
									
								</div>
							</div>
						</div>
					</div>
		                
				</section>
				<!--footer---->

			</div>
			<div class="container" v-if="candidates.length > 1">
         <div class="  navbar-fixed-bottom effect6" style="width:80%; margin:0 auto;">
            <div class="row no-ml no-mr" id="bottomNav">
               <div class="col-md-3 col-xs-12 col-sm-3 text-center">{{candidates.length}} Candidate Selected</div>
               <div class="col-xs-12 col-md-9 col-sm-9 text-center padding-right-0 padding-top-5">
                  <a href="javascript:;" @click="updateApplicationStatus2('Shortlisted')" class="cl-info bd-info mrg-5 bottom-option" data-toggle="tooltip" data-original-title="Shortlisted"><i class="fa fa-check-square-o"></i>
                     Shortlisted
                  </a>
                  <a href="javascript:;" @click="updateApplicationStatus2('Rejected')" class=" cl-danger bd-red mrg-5 bottom-option" data-toggle="tooltip" data-original-title="Reject"><i class="fa  fa-remove"></i> Reject </a>

                  <a href="#" class="cl-primary bd-primary mrg-5 bottom-option" data-original-title="Scheduled Interview" data-toggle="modal" data-target="#interview_scheduled_modal"><i class="fa fa-calendar-plus-o"></i>
                     Scheduled Interview
                   </a>
                  <a href="javascript:;" @click="updateApplicationStatus2('Offered')" class="cl-success  bd-success mrg-5 bottom-option" data-toggle="tooltip" data-original-title="Offer"><i class="fa fa-file-text-o"></i>
                  Offer</a>
                  <a href="javascript:;" @click="updateApplicationStatus2('Hired')" class="cl-purple bd-purple icon_disbale mrg-5 bottom-option" data-toggle="tooltip" data-original-title="Hire"><i class="fa fa-thumbs-o-up"></i>
                  Hire</a>
                  <a href="#" class="cl-default bd-default mrg-5 bottom-option" data-original-title="Message" data-toggle="modal" data-target="#message"><i class="fa fa-commenting-o"></i>
                  Message</a>
                  <a href="javascript:;" @click="updateApplicationStatus2('FutureSave')" class="cl-warning bd-warning mrg-5 bottom-option" data-toggle="tooltip" data-original-title="Save"><i class="fa fa-star-o"></i>
                  Save</a>
               </div>
            </div>
         </div>
      </div>

       <div class="modal fade" id="message" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content" id="myModalLabel1">
               <span class="close-popup" data-dismiss="modal"><i class="fa fa-times"></i></span>
               <div class="modal-body">
                  <!-- Tab panels -->
                  <div class="tab-content">
                     <!-- Employer Panel 1-->
                     <h5 class="modal-heading" >Message</h5>
                     <div class="tab-pane fade in show active" id="employer" role="tabpanel">
                        <form @submit="sendmessage"class="advance_search_form1" id="advance_search_form">
                           <div class="form-group col-md-12 col-xs-12 padding-left-0">
                              <label>Type your message</label>
                               <textarea  name="Message" v-model="message" class="form-control height-120" placeholder="Type your message"></textarea>
                          		<p class="error_msg" >{{ message_error }}</p>
                           </div>
                           
                           
                           <div class="form-group text-center">
                              <button  type="submit" class="btn theme-btn btn-m">Send </button>
                           </div>
                        </form>
                     </div>
                     <!--/.Panel 1-->
                  </div>
                  <!-- Tab panels -->
               </div>
            </div>
         </div>
      </div>   
      <!-- End message Window -->

            <!-- message Window start -->
      <div :class="{ in: modalShown }" class="modal fade" id="interview_scheduled_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
         <div class="modal-dialog">
             <div class="modal-content" id="myModalLabel1">
                        <span class="close-popup" data-dismiss="modal"><i class="fa fa-times"></i></span>
                        <div class="modal-body">
                           <!-- Tab panels -->
                           <div class="tab-content">
                              <!-- Employer Panel 1-->
                              <h5 class="modal-heading" >Scheduled Interview </h5>
                              <div class="tab-pane fade in show active" id="employer" role="tabpanel">
                                 <form class="advance_search_form" @submit="submitInterview" id="advance_search_form2">
                                    <div class="form-group col-md-6 col-xs-12 padding-left-0">
                                       <label>Date</label>
                                       <datepicker v-validate="'required'" :format="formatDate" v-model="interviewDate" name="Date" class="form-control" ></datepicker>
                                       <p class="error_msg" >{{ errors.first('Date') }}</p>
                                    </div>
                                    <div class="form-group col-md-6 col-xs-12 padding-left-0 ">
                                       <label class="width-100">Time</label>
                                       <div class="form-group col-md-12 col-xs-12 padding-left-0 padding-right-0 margin-bottom-0">
                                          <select v-validate="'required'" name="Time" class="wide form-control" v-model="interviewTime">
                                             <option value="9:00 AM - 9:30 PM">9:00 PM - 9:30 PM</option>
                                                <option value="9:30 AM - 10:00 PM">9:30 PM - 10:00 PM</option>
                                                <option value="10:00 AM - 10:30 AM">10:00 AM - 10:30 AM</option>
                                                <option value="10:30 AM - 11:00 AM">10:30 AM - 11:00 AM</option>
                                                <option value="11:00 AM - 11:30 AM">11:00 AM - 11:30 AM</option>
                                                <option value="11:30 AM - 12:00 PM">11:30 AM - 12:00 PM</option>
                                                <option value="12:00 PM - 12:30 PM">12:00 PM - 12:30 PM</option>
                                                <option value="12:30 PM - 1:00 PM">12:30 PM - 1:00 PM</option>
                                                <option value="1:00 PM - 1:30 PM">1:00 PM - 1:30 PM</option>
                                                <option value="1:30 PM - 2:00 PM">1:30 PM - 2:00 PM</option>
                                                <option value="2:00 PM - 2:30 PM">2:00 PM - 2:30 PM</option>
                                                <option value="2:30 PM - 3:00 PM">2:30 PM - 3:00 PM</option>
                                                <option value="3:00 PM - 3:30 PM">3:00 PM - 3:30 PM</option>
                                                <option value="3:30 PM - 4:00 PM">3:30 PM - 4:00 PM</option>
                                                <option value="4:00 PM - 4:30 PM">4:00 PM - 4:30 PM</option>
                                                <option value="4:30 PM - 5:00 PM">4:30 PM - 5:00 PM</option>
                                                <option value="5:00 PM - 5:30 PM">5:00 PM - 5:30 PM</option>
                                                <option value="5:30 PM - 6:00 PM">5:30 PM - 6:00 PM</option>
                                                <option value="6:00 PM - 6:30 PM">6:00 PM - 6:30 PM</option>
                                                <option value="6:30 PM - 7:00 PM">6:30 PM - 7:00 PM</option>
                                          </select>
                                          <p class="error_msg" >{{ errors.first('Time') }}</p>
                                       </div>
                                        <!-- <div class="form-group col-md-6 col-xs-12 padding-right-0 margin-bottom-0">
                                          <select class="wide form-control">
                                             <option data-display="End">End Time</option>
                                             <option value="1">10:00</option>
                                             <option value="2">10:30</option>
                                             <option value="3">11:00</option>
                                             <option value="4">11:30</option>
                                          </select>
                                       </div> -->
                                    </div>
                                    <div class="form-group col-md-6 col-xs-12 padding-left-0 ">
                                       <label>Venue</label>
                                       <div class="form-group margin-bottom-0">
                                          <select v-validate="'required'" name="Venue" class="wide form-control" v-model="venueName">
                                             <option value="">Select Venue</option>
                                             <option v-if="venues" v-for="venue in venues" :value="venue.venue_id">{{venue.venue_name}}</option>
                                          </select>
                                          <p class="error_msg" >{{ errors.first('Venue') }}</p>
                                       </div> 
                                      
                                    </div>
                                    <div class="form-group col-md-6 col-xs-12 padding-left-0 ">
                                       <label>Contact Person</label>
                                       <input v-validate="'required'" type="text" v-model="contactPerson" name="ContactPerson" class="wide form-control" />
                                       <p class="error_msg" >{{ errors.first('ContactPerson') }}</p>      
                                    </div>
                                    <div class="form-group col-md-6 col-xs-12 padding-left-0 ">
                                       <label>Email Id</label>
                                       <input name="Email" v-validate="'required|email'" type="text" class="wide form-control" v-model="contactEmail" />
                                       <p class="error_msg" >{{ errors.first('Email') }}</p>  
                                    </div>
                                    <div class="form-group col-md-6 col-xs-12 padding-left-0 ">
                                       <label>Contact Number</label>
                                       <input name="ContactNo" v-validate="'required'" type="text" v-model="contactNo" class="wide form-control" />
                                       <p class="error_msg" >{{ errors.first('ContactNo') }}</p>  
                                    </div>
                                    <div class="form-group col-md-12 col-xs-12 padding-left-0">
                                       <label>Instruction</label>
                                        <textarea class="form-control height-120" v-model="instruction" placeholder="Instruction"></textarea>
                                    </div>
                                    <div class="form-group text-center">
                                       <button type="submit"  class="btn theme-btn btn-m">Submit</button>
                                    </div>
                                 </form>
                              </div>
                              <!--/.Panel 1-->
                           </div>
                           <!-- Tab panels -->
                        </div>
                     </div>
         </div>
      </div>   
		</div>

</template>
<script>
/*import TimeRange from 'vue-time-range';*/
import VTooltip from 'v-tooltip';
import Datepicker from 'vuejs-datepicker';
    export default {
    	 components: {
        Datepicker,
      },
        data() {

            return {

                laravelData: {},
                startfrom:0,
                endto:0,
                total:0,
                baseUrl:'',
                atype:'All',
                candidates:[],
                allSelected:false,
                venues:{},
                interviewDate:'',
                interviewTime:'',
                venueName:'',
                contactPerson:'',
                contactEmail:'',
                contactNo:"",
                instruction:"",
                modalShown: true,
                message:'',
                message_error:''

            }

        },

        created() {
        	this.baseUrl=Laravel.baseUrl;
            this.getResults();
            this.getvenues();

        },

        methods: {
        	submitInterview:function(e)
        	{
        		e.preventDefault();
        		var selff=this;
               let currentObj = new FormData();
               var pathArray=window.location.pathname.split('/');
               var secondLevelLocation = pathArray[3];
               currentObj.append('interviewDate', this.interviewDate);
               currentObj.append('interviewTime', this.interviewTime);
               currentObj.append('venueName', this.venueName);
               currentObj.append('contactPerson', this.contactPerson);
               currentObj.append('contactEmail', this.contactEmail);
               currentObj.append('contactNo', this.contactNo);
               currentObj.append('instruction', this.instruction);
               currentObj.append('candidates', this.candidates);
               currentObj.append('jobid', secondLevelLocation);
               this.$validator.validateAll().then((result)=>{
                if(!result){
                  return false;
                }
               axios.post(Laravel.baseUrl+'/employer/scheduleInterview',currentObj)
                .then(function (response) {
                    $("#interview_scheduled_modal").modal('toggle');
                    $.each(selff.candidates, function(index,values) {
                		 var pathArray=values.split('_');
                		 var index=pathArray[1];
				    serff.laravelData.data[index].applicationStatus='Interview';
				   });

                    selff.candidates=[];
                   // alert("herer");
                    e.target.reset();
                    
                     selff.flash("Interview Scheduled successfuly",'success', {timeout: 3000});
                 }).catch(function (error) {
                    currentObj.output = error;
                })
               })
        	},
        	sendmessage1(userid)
        	{
        		this.candidates=[userid];
        	},
        	sendmessage:function(e)
        	{
        		
        		e.preventDefault();
        		var selff=this;
               let currentObj = new FormData();
               var pathArray=window.location.pathname.split('/');
               var secondLevelLocation = pathArray[3];
               currentObj.append('message', this.message);
               currentObj.append('candidates', this.candidates);
               currentObj.append('jobid', secondLevelLocation);
                if(this.message==''){
                	this.message_error="Please enter your message";
                  return false;
                }
               axios.post(Laravel.baseUrl+'/employer/sendMessage',currentObj)
                .then(function (response) {
                    $("#message").modal('toggle');
                   

                    selff.candidates=[];
                    selff.message=''
                    e.target.reset();
                    
                     selff.flash("Message sent successfuly",'success', {timeout: 3000});
                 }).catch(function (error) {
                    currentObj.output = error;
                })
               
        	},
        	getvenues()
        	{
        		var serff=this;
        		axios
              .get(Laravel.baseUrl+'/employer/fetchvenuelist')
              .then(response => {serff.venues = response.data;});
        	},
        	getResultss(type)
        	{
        		this.atype=type;
        		this.getResults();
        	},
        	updatecandidate(userid)
        	{
        		this.candidates=[userid];
        	},
        	 formatDate (date) {
              return this.$moment(date).format('MM/DD/YYYY')
            },
        	checkall()
        	{
        		this.candidates = [];
        		    if(!this.allSelected){
		              this.laravelData.data.forEach((select,index) => {
		              	//alert(select);
		                this.candidates.push(select.id+'_'+index);
		                this.allSelected=true;
		            });
		              //console.log(this.candidates);
		          }else
		          {
		          	this.candidates=[];
		          	this.allSelected=false;
		          }
		          //console.log(this.candidates);
        		/*alert('candidatecheck');
        		$('.candidatecheck').not(this).prop('checked', this.checked);*/
        		/*if ( $('.checkall').is('checked')) {
        			alert('here');
				      $('.candidatecheck').attr('checked','checked');
				  } else {
				  	alert('here2');
				      $('.candidatecheck').removeAttr('checked');
				  } */
        	},
            getResults(page) {
            	//alert(page);
            	
            	var pathArray=window.location.pathname.split('/');
               var secondLevelLocation = pathArray[3];
              if (typeof page === 'undefined') {

                    page = 1;

                }
                var serff=this;
                axios
              .get(Laravel.baseUrl+'/employer/fetchapplicationsofjob?page=' + page+'&type='+this.atype+'&access_token='+secondLevelLocation)
              .then(response => {serff.laravelData = response.data;this.startfrom=response.data.from;this.endto=response.data.to;this.total=response.data.total});
              this.loaded=true;   
              Vue.nextTick(function () {
		            $('[data-toggle="tooltip"]').tooltip()
		        })
              

            },
            updateApplicationStatus(appid,index,status)
            {
            		this.candidates=[appid+'_'+index];
            		this.updateApplicationStatus2(status);
            },
            async updateApplicationStatus2(status)
            {
            	let currentObj = new FormData();
            	var serff=this;
            	  var pathArray=window.location.pathname.split('/');
               var secondLevelLocation = pathArray[3];
            	currentObj.append('appid', this.candidates);
            	currentObj.append('job_id',secondLevelLocation)
            	currentObj.append('status', status);
            	await axios.post(Laravel.baseUrl+'/employer/updateApplicationStatus',currentObj)
                .then(function (response) {
                	
                	$.each(serff.candidates, function(index,values) {
                		
                		 var pathArray=values.split('_');
                		 var index=pathArray[1];
				    serff.laravelData.data[index].applicationStatus=status;
				   });
                	serff.candidates=[];
                	serff.flash("Application status updated successfully",'success', {timeout: 3000});
                 }).catch(function (error) {
                    currentObj.output = error;
                    serff.flash(currentObj.output,'error', {timeout: 3000});
                })
            }
            /*, editjob(job){
                window.location.href = Laravel.baseUrl+'/employer/editjob/' + btoa(job.job_id);
            },*/
             

        }

    }

</script>
<style>

.tooltip {
  // ...

  &.info {
    $color: rgba(#004499, .9);

    .tooltip-inner {
      background: $color;
      color: white;
      padding: 24px;
      border-radius: 5px;
      box-shadow: 0 5px 30px rgba(black, .1);
      max-width: 250px;
    }

    .tooltip-arrow {
      border-color: $color;
    }
  }
}

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
margin-top: -7px;
}
.cl-gray
{
	color:#ccc;
}


</style>