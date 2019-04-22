 @extends('Admin.Layouts.master')
@section('title', 'Cities')
@section('content')
<div class="content-wrapper">
          <div class="card">
 <!-------------Country Listing Start From Here--------------->
            <div class="card-body" id="listingdiv">
            	<button type="button" id="addbutton" class="btn btn-warning btn-fw" style="float:right;"> <span>+ Add City</span></button>
              <h4 class="card-title">Cities Manager</h4>
              @if(Session::has('message'))
              <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> {{ Session::get('message') }}
              </div>
              @endif
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="cityTable" class="table">
                      <thead>
                        <tr>
                            <th> #</th>
                            <th>City Name</th>
                            <th>Country Name</th>
                            <th>State Name</th>
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
              <h4 class="card-title">Add City</h4>

              <div class="row">
                <div class="col-8">
                  <div class="table-responsive">
                    <form class="forms-sample dataformtosubmit" method="POST" action="{{route('manager.cities.submit')}}">
                     @csrf
                    <div class="form-group">
                      <label for="exampleInputName1">City Name</label>
                      <input class="form-control" required name="city_name" id="city_name" placeholder="City Name" type="text">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">Country</label>
                      <select onchange="get_states('');" required name="country" class="form-control" id="country">
                        <option value="">Select Country</option>
                        @if($countries)
                          @foreach($countries as $country)
                              <option value="{{$country->country_id}}">{{$country->country_name}}</option>
                          @endforeach
                        @endif

                      </select>
                      <input type="hidden" name="cid" id="cid" value="0">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">State</label>
                      <select  name="state" class="form-control" id="state">
                        <option value="">Select State</option>
                      </select>
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
                   url : "{{route('manager.get_city_details')}}",
                   method : "GET",
                   data : {id:id},
                  dataType:'json',
                   success : function (data)
                   {
                      $("#city_name").val(data.city_name);
                      $("#country").val(data.country_id);
                      
                      $("#cid").val(data.city_id);
                      $("#listingdiv").hide();
                      $("#addeditdiv").slideDown( "slow", function() {
                                // Animation complete.
                              });
                      get_states(data.state_id);
                     
                      
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
                   data : {id:id,status_of:'city','_token':'{{ csrf_token() }}'},
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

        function get_states(id)
        {
          var id=$("#country").val();
           $(".loader").show();
                $.ajax({
                   url : "{{route('manager.fetch_states')}}",
                   method : "GET",
                   data : {id:id},
                  dataType:'text',
                   success : function (data)
                   {
                      $("#state").html(data);
                        $("#state").val(id);
                       $(".loader").hide();
                       //window.location.reload();
                      
                   }
               });
        }

        </script>
@endsection