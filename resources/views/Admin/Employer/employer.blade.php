 @extends('Admin.Layouts.master')
@section('title', 'Employer')
@section('content')
<div class="content-wrapper">
          <div class="card">
 <!-------------Country Listing Start From Here--------------->
            <div class="card-body" id="listingdiv">
              
            	<a href="{{route('manager.add_edit_employers')}}" id="addbutton" class="btn btn-warning btn-fw" style="float:right;"> <span>+ Add Employer</span></a>
              <h4 class="card-title">Employer Manager</h4>
            
            <form method="post">
              <div class="row">
                
                <div class="col-md-4 advncsearch" >
              
                <div class="form-group">
                  <label>Industry</label>
                  <div class="form-group margin-bottom-0">
                      <select id="industry" name="industries" class="form-control">
                        <option value="">Select Industry</option>
                          @if($industry)
                            @foreach($industry as $cat)
                              <option  value="{{$cat->category_id}}">{{$cat->category_name}}</option>
                            @endforeach
                          @endif
                      </select>
                  </div>
                </div>
              
                </div>
                <div class="col-md-4 advncsearch" >
              
                <div class="form-group">
                  <label>Functional Area</label>
                  <div class="form-group margin-bottom-0">
                      <select id="subcategory" name="subcate" class="form-control">
                        <option value="">Select Functional Area</option>
                          @if($functional)
                            @foreach($functional as $subcat)
                              <option  value="{{$subcat->subcategory_name}}">{{$subcat->subcategory_name}}</option>
                            @endforeach
                          @endif
                      </select>
                  </div>
                </div>
              
                </div>
                
                
            </div>
            </form>
              @if(Session::has('message'))
              <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> {{ Session::get('message') }}
              </div>
              @endif
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="employerTable" class="table">
                      <thead>
                        <tr>
                            <th> #</th>
                            <th> Industryid</th>
                            <th> subcat</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Company</th>
                            <th>Username</th>
                            <th>Phone number</th>
                            <th>Industry</th>
                            <th>Functional Area</th>
                            <th>Can Edit Company</th>
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

        <script type="text/javascript">
             
        $(document).on('click','.change_status',function(){
            var id=$(this).attr('idd');
             
             swal({
                  title: 'Are you sure you want to change the status?',
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
                   data : {id:id,status_of:'user','_token':'{{ csrf_token() }}'},
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
        $(document).on('click','.markfeature',function(){
            var id=$(this).attr('idd');
             $(".loader").show();
            $.ajax({
                   url : "{{route('manager.markfeature')}}",
                   method : "GET",
                   data : {id:id,'type':'employer'},
                  dataType:'json',
                   success : function (data)
                   {
                       $(".loader").hide();
                   }
               });
            
        });

        $("#industry").change(function(){
          var categoryId=$("#industry").val();
          $.ajax({
          url: "{{ route('fetchsubcats') }}?category_id="+categoryId,
          success: function(response){
             
              /*var obj = $.parseJSON(response);*/
              $("#subcategory").html('').trigger('change');
              console.log(categoryId);
              $("#subcategory").append(response).trigger('change');
             
              
          }
         })

        })
        </script>
@endsection