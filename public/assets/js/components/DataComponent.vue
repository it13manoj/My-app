<template>

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
                                        <input type="text" class="form-control" placeholder="Search Job">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="search-wide full col-md-6 col-sm-6">
                                       <select class="wide form-control">
                                          <option value="1" data-display="Sort By">All</option>
                                          <option value="2">Most Viewed</option>
                                          <option value="4">Most Search</option>
                                       </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                     <div class="search-wide full col-md-6 col-sm-6">
                                       <select class="wide form-control">
                                          <option value="1" data-display="Status">All</option>
                                          <option value="2">Active</option>
                                          <option value="3">Deactivate</option>
                                          <option value="4">Reject</option>
                                       </select>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-12">
                                    <button class="btn apply-job-btn  btn-radius">Submit </button>
                                </div>
                                
                            </div>
                             
                        </div>
                    </form>
                    
                    
                </div>
                <div class="table-responsive"> 
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
                        
                            <tr v-for="job in laravelData">
                                <td>
                                    <a href="job-detail.html">
                                        @{{job.job_title}}
                                    </a>
                                </td>            
                                <td>@{{ moment(new Date(job.job_expiry_date), "YYYY-MM-DD").format("ll") }}</td>
                                <td v-if="job.job_status==1" class="cl-success" > Active </td>
                                    <td v-else-if="job.job_status==2" class="cl-danger" > Rejected </td>
                                    <td v-else-if="job.job_status==3" class="cl-default" > Inactive </td>
                                    <td v-else-if="job.job_status==4" class="cl-default" > Inactive </td>
                                    <td v-else="job.job_status==0" class="cl-warning" > Pending </td>
                                <td><a href="javascript:;" class="application">0</a></td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>
                                <a href="javascript:;" @click="editjob(job)" class="cl-success mrg-5" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                <a v-if="job.job_status==1" href="javascript:;" @click="change_status(job.job_id,3)" class="cl-danger mrg-5" data-toggle="tooltip" data-original-title="Deactivate"><i class="fa fa-trash-o"></i></a>
                                <a  v-if="job.job_status==3" href="javascript:;" @click="change_status(job.job_id,1)" class="cl-info mrg-5" data-toggle="tooltip" data-original-title="Activate"><i class="fa fa-refresh"></i></a>
                                </td>  
                            </tr>
                            
                        </tbody>
                    </table>
                    
                    <!-- flexbox -->
                    <div class="flexbox padd-10">
                        <ul class="pagination">
                            <li class="page-item">
                              <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">«</span>
                                <span class="sr-only">Previous</span>
                              </a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                              <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">»</span>
                                <span class="sr-only">Next</span>
                              </a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.flexbox -->
            
                </div>
                
            </div>

</template>

 

<script>

    export default {

        mounted() {

            console.log('Component mounted.')

        },

        data() {

            return {

                laravelData: {},

            }

        },

        created() {

            this.getResults();

        },

        methods: {

            getResults(page) {

                if (typeof page === 'undefined') {

                    page = 1;

                }

      

                this.$http.get('/fetchjobsofuser?page=' + page)

                    .then(response => {

                        return response.json();

                    }).then(data => {

                        this.laravelData = data;

                    });

            }

        }

    }

</script>