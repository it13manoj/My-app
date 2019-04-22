 @extends('Admin.Layouts.master')
@section('title', 'Jobs')
@section('content')
<div class="content-wrapper">
          <div class="card">
 <!-------------Country Listing Start From Here--------------->
            <div class="card-body" id="listingdiv">
            	<a target="_blank" href="{{route('add_user_job')}}" id="addbutton" class="btn btn-warning btn-fw" style="float:right;"> <span>+ Add Job</span></a>
              <h4 class="card-title">Job Manager</h4>
              @if(Session::has('message'))
              <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> {{ Session::get('message') }}
              </div>
              @endif
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="jobTable" class="table">
                      <thead>
                        <tr>
                            <th> #</th>
                            <th>Title</th>
                            <th>Company</th>
                            <th>Recruiter</th>
                            <th>Category</th>
                            <th>Job Category</th>
                            <!-- <th>Experience</th>
                            <th>Salary</th> -->
                            <th>Application</th>
                            <th>Created on</th>
                            <th>Published on</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        
                      </tbody>
                    </table>                    
                  </div>
                </div>
              </div>
            </div>
            <!-------------Country Listing Ends Here--------------->
           



          </div>
        </div>

 <div class="modal fade" id="exampleModal-2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel-2">Reason</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                         <div class="form-group">
                           <label>Please mention the reason</label>
                           <textarea rows="8" class="form-control" id="reason"></textarea>
                           <input type="hidden" name="jobidrej" id="jobidrej">
                         </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" id="reasonsubmitbtn" class="btn btn-success">Submit</button>
                          <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                        </div>
                      </div>
                    </div>
                  </div>
        <script type="text/javascript">
             
        $(document).on('click','.change_status',function(){
            var id=$(this).attr('idd');
            var status=$(this).attr('idd1');
             
             swal({
                  title: 'Are you sure you want to continue?',
                  text: " ",
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes '
                }, 
                function(){
                    $(".loader").show();
                $.ajax({
                   url : "{{route('change_job_status')}}",
                   method : "POST",
                   data : {id:id,status:status,reason:'',status_of:'job','_token':'{{ csrf_token() }}'},
                  dataType:'text',
                   success : function (data)
                   {
                     $("#chngspn"+id).html(data);
                       $(".loader").hide();
                       //window.location.reload();
                      
                   }
               });
            });          
        });
$(document).on('click','.change_status2',function(){
  $("#jobidrej").val($(this).attr('idd'));
  $("#exampleModal-2").modal('toggle');
});
        </script>
@endsection
@section('page-footer')
<script type="text/javascript">
var oTable2=$('#jobTable').DataTable({
                                 "paging":   true,
                                  "processing": true,
                                  "serverSide": true,
                                  "ajax": "{{route('getadminjobs')}}",
                                  "columns": [
                                    { "data": "serial" },
                                    { "data": "job_title" },
                                    { "data": "company_name" },
                                    { "data": "userName" },
                                    { "data": "category_name" },
                                    { "data": "jobcat" },
                                    { "data": "applicationss" },
                                    { "data": "created_on" },
                                    { "data": "published_on" },
                                    { "data": "status" },
                                    { "data": "action" },
                                    
                                ]
                                ,columnDefs: [
                                   { orderable: false, targets: -1 }
                                ]
                                });
$("#reasonsubmitbtn").click(function(){
  var reason=$("#reason").val();
  var id=$("#jobidrej").val();
    $(".loader").show();
                $.ajax({
                   url : "{{route('change_job_status')}}",
                   method : "POST",
                   data : {id:id,status:2,reason:reason,status_of:'job','_token':'{{ csrf_token() }}'},
                  dataType:'text',
                   success : function (data)
                   {
                     $("#chngspn"+id).html(data);
                       $(".loader").hide();
                       $("#reason").val('');
                       $("#jobidrej").val('');
                       $("#exampleModal-2").modal('toggle');
                       //window.location.reload();
                      
                   }
               });
});
</script>
@endsection