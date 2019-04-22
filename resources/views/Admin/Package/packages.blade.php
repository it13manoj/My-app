 @extends('Admin.Layouts.master')
@section('title', 'Packages')
@section('content')
 <div class="content-wrapper">
  <div id="listingdiv">
  <a href="javascript:;" id="addbutton" class="addbutton btn btn-warning btn-fw" style="float:right;"> <span>+ Add New</span></a>
              <h4 class="card-title">Packages</h4>
              <div  id="deletealert" >
          @if(Session::has('message'))
              <div class="alert alert-success alert-dismissible" >
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> {{ Session::get('message') }}
              </div>
              @endif
            </div>
         <div class="row">
          @if($results)
          @foreach($results as $rec)
            <div class="col-md-6 grid-margin" id="Remove_{{$rec->id}}">
              <div class="card">
                <div class="card-body">
                  <h6 class="card-title mb-0">{{$rec->package_name}} <a href="javascript:;" class="editbtn" id="{{$rec->id}}"><i class="fa fa-edit"></i></a>&nbsp;<i class="cl-danger fa fa-trash-o" onclick="PackageDelete({{$rec->id}});"></i></h6>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="d-inline-block pt-3">
                      <div class="d-lg-flex">
                        <h2 class="mb-0"><i class="fa fa-inr"></i> {{$rec->package_price}} </h2>
                        <div class="d-flex align-items-center ml-lg-2">
                          <i class="mdi mdi-clock text-muted"></i>
                          <small class="ml-1 mb-0">Duration: {{$rec->package_duration}} days</small>
                        </div>
                      </div>
                      <small class="text-gray">{{substr($rec->package_description,0,20)}}</small>
                    </div>
                    <div class="d-inline-block">
                      <div class="bg-warning px-3 px-md-4 py-2 rounded">
                        <i class="mdi mdi-wallet text-white icon-lg"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
            @endif
            
          </div>
        </div>
        <!-------------package Add Edit From Here--------------->
         <div class="card" style="display: none;padding: 1.88rem" id="addeditdiv">
            <div class="card-body" >
                <button type="button" id="backbutton" class="backbutton btn btn-warning btn-fw" style="float:right;"> <span>Back</span></button>
              <h4 class="card-title">Add Package</h4>

              <div class="row">
                <div class="col-8">
                  <div class="table-responsive">
                    <form class="forms-sample dataformtosubmit" method="POST" action="{{route('add_edit_packages.submit')}}">
                    @csrf
                    <div class="form-group">
                      <label for="exampleInputName1">Package Name</label>
                      <input class="form-control" required name="package_name" id="package_name" placeholder="Package Name" type="text">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Package Description</label>
                      <textarea class="form-control" required name="package_description" id="package_description" placeholder="Package Description"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Package Price <i class="fa fa-inr"></i></label>
                      <input class="form-control" required name="package_price" id="package_price" placeholder="Package Price" type="number" min="0">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Package Duration(<small>in days</small>)</label>
                      <input class="form-control" required name="package_duration" id="package_duration" placeholder="Package Duration" type="number" min="0">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Total Jobs</label>
                      <input class="form-control" required name="package_total_jobs" id="package_total_jobs" placeholder="Total Jobs" type="number" min="0">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Total Resume Download</label>
                      <input class="form-control" required name="package_total_resume_download" id="package_total_resume_download" placeholder="Total Resume Download" type="number" min="0">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Total Excel Export</label>
                      <input class="form-control" required name="package_total_excel_export" id="package_total_excel_export" placeholder="Total Excel Export" type="number" min="0">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Total Resume Views</label>
                      <input class="form-control" required name="package_total_resume_views" id="package_total_resume_views" placeholder="Total Resume Views" type="number" min="0">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Total Resume Forward</label>
                      <input class="form-control" required name="package_total_resume_forward" id="package_total_resume_forward" placeholder="Total Resume Forward" type="number" min="0">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Total Resume Search</label>
                      <input class="form-control" required name="package_total_resume_search" id="package_total_resume_search" placeholder="Total Resume Search" type="number" min="0">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Total Email</label>
                      <input class="form-control" required name="package_total_email" id="package_total_email" placeholder="Total Email" type="number" min="0">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Total SMS</label>
                      <input class="form-control" required name="package_total_sms" id="package_total_sms" placeholder="Total SMS" type="number" min="0">
                      <input type="hidden" name="package_id" id="package_id" value="0">
                    </div>
                     <div class="form-group">
                      <label for="exampleInputName1">Naukriyan Recruitment Service</label>
                      <input type="radio" name="package_recruitment_service" id="package_recruitment_service1" value="1">Yes <input type="radio" name="package_recruitment_service" id="package_recruitment_service2" value="0">No
                    </div>
                    
                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                    <button type="button" class="btn btn-light backbutton">Cancel</button>
                  </form>                 
                  </div>
                </div>
              </div>
            </div>
          </div>
            <!-------------Package Add Edit Here--------------->
        </div>
        <script type="text/javascript">
             $("#addbutton").click(function(){
                    $("#listingdiv").hide();
                     $('.dataformtosubmit')[0].reset();
                    // $("#scid").val(0);
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
        $(".dataformtosubmit").submit(function(){
            var action=$(this).attr('action');
            var formdata=$( this ).serialize();
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
                       window.location.reload();
                      }
                      else
                      {
                        
                      }
                   }
               });return false;
        });

        $(document).on('click','.editbtn',function(){
            var id=$(this).attr('id');
             $(".loader").show();
            $.ajax({
                   url : "{{route('get_package_details')}}",
                   method : "GET",
                   data : {id:btoa(id)},
                  dataType:'json',
                   success : function (data)
                   {
                       $("#package_name").val(data.package_name);
                       $("#package_description").val(data.package_description);
                       $("#package_price").val(data.package_price);
                       $("#package_duration").val(data.package_duration);
                       $("#package_total_jobs").val(data.package_total_jobs);
                       $("#package_total_resume_download").val(data.package_total_resume_download);
                       $("#package_total_excel_export").val(data.package_total_excel_export);
                       $("#package_total_resume_views").val(data.package_total_resume_views);
                       $("#package_total_resume_forward").val(data.package_total_resume_forward);
                       $("#package_total_resume_search").val(data.package_total_resume_search);
                       $("#package_total_email").val(data.package_total_email);
                       $("#package_total_sms").val(data.package_total_sms);
                       $("#package_id").val(data.id);
                       if(data.package_recruitment_service==1){
                          $("#package_recruitment_service1").attr('checked','checked');
                       }else
                       {
                          $("#package_recruitment_service2").attr('checked','checked');
                       }


                       $("#listingdiv").hide();
                       $("#addeditdiv").slideDown( "slow", function() {
                                // Animation complete.
                              });
                       $(".loader").hide();
                       //window.location.reload();
                      
                   }
               });
            
        });
          </script>
          <style type="text/css">
              i.cl-danger {
              color: red;
              cursor: pointer;
              }
          </style>
          <script type="text/javascript">
            function PackageDelete(id){
              $.ajax({
                type:"post",
                url:"{{route('DeletePackadge')}}",
               data:{id:id, _token: '{{csrf_token()}}'},
                success:function(msg){
                 $('#Remove_'+id).hide();
                 $('#deletealert').html('<div class="alert alert-danger alert-dismissible"><strong>Your Package deleted ! </strong></div>');
                }
              });

            }
          </script>
        @endsection