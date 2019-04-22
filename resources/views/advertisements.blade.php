 @extends('Admin.Layouts.master')
@section('title', 'Advertisements')
@section('content')
<style type="text/css">
  .cke_contents > iframe{
  width: 100% !important;
} 
</style>
<div class="content-wrapper">
          <div class="card">
 <!-------------Country Listing Start From Here--------------->
            <div class="card-body" id="listingdiv">
            	<button type="button" id="addbutton" class="btn btn-warning btn-fw" style="float:right;"> <span>+ Add Advertisement</span></button>
              <h4 class="card-title">Advertisement Manager</h4>
              @if(Session::has('message'))
              <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> {{ Session::get('message') }}
              </div>
              @endif
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="pagetable" class="table">
                      <thead>
                        <tr>
                            <th> #</th>
                            <th>Title</th>
                            <th>Start Date</th>
                            <th>End Date</th>
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
            <!-------------Country Add Edit From Here--------------->
            <div class="card-body" style="display: none;padding: 1.88rem" id="addeditdiv">
                <button type="button" id="backbutton" class="backbutton btn btn-warning btn-fw" style="float:right;"> <span>Back</span></button>
              <h4 class="card-title">Add Page</h4>

              <div class="row">
                <div class="col-8">
                  <div class="table-responsive">
                    <form class="forms-sample dataformtosubmit" method="POST" action="{{route('manager.advertisments.submit')}}">
                     @csrf
                    <div class="form-group">
                      <label for="exampleInputName1">Title</label>
                      <input class="form-control" required name="adv_title" id="adv_title" placeholder="Page Name" type="text">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">Link</label>
                      <input class="form-control" required name="adv_link" id="adv_link" placeholder="Page Name" type="text">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword4">Start Date</label>
                      <input class="form-control" name="advStartDate" id="advStartDate" placeholder="Position" type="text">
                      <input type="hidden" name="aid" id="aid" value="0">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword4">End Date</label>
                      <input class="form-control" name="advEndDate" id="advEndDate" placeholder="Position" type="text">
                    </div>
                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                    <button type="button" class="btn btn-light backbutton">Cancel</button>
                  </form>                 
                  </div>
                </div>
              </div>
            </div>
            <!-------------Country Add Edit Here--------------->



          </div>
        </div>
@endsection
@section('page-footer')
        <script type="text/javascript">
             $("#addbutton").click(function(){
                    $("#listingdiv").hide();
                     $('.dataformtosubmit')[0].reset();
                     $("#cid").val(0);
                    $("#addeditdiv").slideDown( "slow", function() {
                            // Animation complete.
                          });
                });
                $(".backbutton").click(function(){
                    $("#addeditdiv").hide();
                    $("#listingdiv").slideDown( "slow", function() {
                          });
                });
        /********submit form*******/
        /*$(".dataformtosubmit").submit(function(){
            var action=$(this).attr('action');
            var desc = CKEDITOR.instances['description'].getData();
            //alert(desc);
            var formdata=new FormData();
            formdata.append('desc',desc);
            $(".loader").show();
            $.ajax({
                   url : action,
                   method : "POST",
                   data : formdata,
                   dataType : "text",
                   success : function (data)
                   {
                      if(data ==1) 
                      {
                       $(".loader").hide();
                       //window.location.reload();
                      }
                      else
                      {
                        
                      }
                   }
               });return false;
        });*/
        $(document).on('click','.editbtn',function(){
            var id=$(this).attr('id');
             $(".loader").show();
            $.ajax({
                   url : "{{route('manager.get_page_details')}}",
                   method : "GET",
                   data : {id:id},
                  dataType:'json',
                   success : function (data)
                   {
                      $("#pagename").val(data.page_name);
                       $("#description").val(data.description);
                        CKEDITOR.instances['description'].setData(data.description);
                       $("#position").val(data.position);
                       $("#pid").val(data.id);
                       $("#listingdiv").hide();
                       $("#addeditdiv").slideDown( "slow", function() {
                                // Animation complete.
                              });
                       $(".loader").hide();
                       //window.location.reload();
                      
                   }
               });
            
        });
        $(document).on('click','.change_status',function(){
            var id=$(this).attr('idd');
             
             swal({
                  title: 'Are you sure?',
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
                   url : "{{route('manager.change_status')}}",
                   method : "POST",
                   data : {id:id,status_of:'page','_token':'{{ csrf_token() }}'},
                  dataType:'text',
                   success : function (data)
                   {
                      if(data==1){
                        $('#status_'+id).html('<label style="cursor:pointer" class="badge badge-danger">Inactive</label>');
                      }else{
                        $('#status_'+id).html('<label style="cursor:pointer" class="badge badge-success">Active</label>');
                      }
                       $(".loader").hide();
                       //window.location.reload();
                      
                   }
               });
            });          
        });

        </script>

<script type="text/javascript">
  var oTable2=$('#pagetable').DataTable({
                                 "paging":   true,
                                  "processing": true,
                                  "serverSide": true,
                                  "ajax": "{{route('manager.get_pages')}}",
                                  "columns": [
                                    { "data": "serial" },
                                    { "data": "page_name" },
                                    { "data": "position" },
                                    { "data": "pstatus" },
                                    { "data": "action" },
                                    
                                ],columnDefs: [
                                   { orderable: false, targets: -1 }
                                ]
                                });
</script>
<script>
    CKEDITOR.replace( 'description' );
</script>
@endsection