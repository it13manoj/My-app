<template>

   <div class="container">
                <div class="row">
                    <form>
                        <div class="col-md-3 col-sm-12">
                            <p class="result_showing">Showing {{startfrom}}-{{endto}} of {{total}} Results</p>
                        </div>
                        <div class="col-sm-9">
                            <div class="col-md-12 padd-l-0">
                                <div class="col-md-4 col-sm-12">
                                    <div class="field_w_search">
                                        <input type="text" @keyup="getResults2" v-model="searchjob" class="form-control" placeholder="Search Job">
                                    </div>
                                </div>
                                <!-- <div class="col-md-3 col-sm-6">
                                    <div class="search-wide full col-md-6 col-sm-6">
                                       <select class="wide form-control">
                                          <option value="1" data-display="Sort By">All</option>
                                          <option value="2">Most Viewed</option>
                                          <option value="4">Most Search</option>
                                       </select>
                                    </div>
                                </div> -->
                                <div class="col-md-4 col-sm-6">
                                     <div class="search-wide full col-md-6 col-sm-6">
                                       <select v-model="limit" @change="getResults2" class="wide form-control">
                                          <option value="all" data-display="Status">All</option>
                                          <option value="1">Active</option>
                                          <option value="2">Deactivate</option>
                                          <option value="3">Reject</option>
                                       </select>
                                    </div>
                                </div>
                                <!-- <div class="col-md-2 col-sm-12">
                                    <button class="btn apply-job-btn  btn-radius">Submit </button>
                                </div> -->
                                
                            </div>
                             
                        </div>
                    </form>
                    
                    
                </div>
                <div class="table-responsive box"> 
                    <table class="table table-lg table-hover">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Expiry</th>
                                <th>Status</th>
                                <th>Application</th>
                                <th>View</th>
                                <th>Shortlist</th>
                                <th>Interview</th>
                                <th>Offer</th>
                                <th>Save for future</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        
                        <tbody v-if="loaded">
                        
                            <tr v-for="(job,index) in laravelData.data">
                                <td>
                                    <a target="_blank" :href="baseUrl+'/jobdetails/'+job.encid">
                                        {{job.job_title}}
                                    </a>
                                </td>            
                                <td>{{job.dateofexpiry}}</td>
                                <td v-if="job.job_status==1" class="cl-success" > Active </td>
                                    <td v-else-if="job.job_status==2" class="cl-danger" > Rejected </td>
                                    <td v-else-if="job.job_status==3" class="cl-default" > Inactive </td>
                                    <td v-else-if="job.job_status==4" class="cl-default" > Inactive </td>
                                    <td v-else="job.job_status==0" class="cl-warning" > Pending </td>
                                <td><a @click="getapplications(job)" href="javascript:;" class="application">{{job.application}} Application</a></td>
                                <td>0</td>
                                <td>{{job.shortlist}}</td>
                                <td>{{job.inteview}}</td>
                                <td>{{job.offer}}</td>
                                <td>{{job.savedfor}}</td>
                                <td>
                                <a href="javascript:;" @click="editjob(job)" class="cl-success mrg-5" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit" title="Edit"></i></a>
                                <a v-if="job.job_status==1" href="javascript:;" @click="change_status(job.job_id,3,index)" class="cl-danger mrg-5" data-toggle="tooltip" data-original-title="Deactivate" title="Deactivate"><i class="fa fa-trash-o"></i></a>
                                <a  v-if="job.job_status==3" href="javascript:;" @click="change_status(job.job_id,1,index)" class="cl-info mrg-5" data-toggle="tooltip" data-original-title="Activate" title="Activate"><i class="fa fa-refresh"></i></a>
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

</template>

 

<script>

    export default {

        data() {

            return {

                laravelData: {},
                startfrom:0,
                endto:0,
                total:0,
                baseUrl:'',
                limit:'all',
                page:1,
                searchjob:''

            }

        },

        created() {

            this.getResults();

        },

        methods: {
            getResults2()
            {
                this.page=1;
                this.getResults();              
            },
            getResults(page) {
                this.page=page;
                this.baseUrl=Laravel.baseUrl;
               /* if (typeof this.page === 'undefined') {

                    this.page = 1;

                }*/
                var serff=this;
                axios
              .get(Laravel.baseUrl+'/employer/fetchjobsofuser?page=' + serff.page+'&limit='+this.limit+'&searchjob='+serff.searchjob)
              .then(response => {serff.laravelData = response.data;this.startfrom=response.data.from;this.endto=response.data.to;this.total=response.data.total});
              this.loaded=true;   
              this.page++;
              

            }, editjob(job){
                window.location.href = Laravel.baseUrl+'/employer/editjob/' + btoa(job.job_id);
            },
             getapplications(job){
                window.location.href = Laravel.baseUrl+'/employer/manage_application/' + btoa(job.job_id);
            },
            change_status(job_id,status,index)
            {
                var selff=this;
              axios
              .get(Laravel.baseUrl+'/employer/change_status?jid='+btoa(job_id)+'&status='+status)
              .then(function (response) {
                  /*  $.each( selff.jobs, function( key, value ) {
                            if ( value.job_id== job_id ) {
                              value.job_status=status;
                              
                            } 
                            });*/
                    selff.laravelData.data[index].job_status=status;
                });
            },

        }

    }

</script>