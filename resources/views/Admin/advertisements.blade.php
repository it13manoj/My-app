 @extends('Admin.Layouts.master')
@section('title', 'Advertisements')
@section('content')
<style type="text/css">
  .cke_contents > iframe{
  width: 100% !important;
} 
</style>
<link href="https://www.jquery-az.com/boots/css/bootstrap-multiselect/bootstrap-multiselect.css" rel="stylesheet">
<style type="text/css">
   .multiselect-native-select .multiselect
  {
    background-color: #fff !important;
    text-align: left !important;
  }
  .multiselect-native-select .btn-group
  {
    width: 100%;
  }
  .multiselect-native-select .dropdown-menu.show
  {
    width: 100%;
    
  }
  .multiselect-container>li>a>label.radio, .multiselect-container>li>a>label.checkbox
  {
    color:#000;
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
                    <form class="forms-sample dataformtosubmit" method="POST" action="{{route('manager.advertisments.submit')}}" enctype="multipart/form-data">
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
                      <label for="exampleInputEmail3">Advertisement For</label>
                      <select name="adv_for" id="adv_for" class="form-control">
                          <option value="all">All</option>
                          <option value="Employer">Employer</option>
                          <option value="Jobseeker">Jobseeker</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">Industry</label>
                      <select name="adv_category[]" multiple="multiple" id="adv_category" class="3col active">
                          @foreach($industry as $indus)
                            <option value="Adv_{{$indus->category_id}}_cat">{{$indus->category_name}}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword4">Start Date</label>
                      <input class="form-control" required name="advStartDate" id="advStartDate" placeholder="Start Date" type="text">
                      <input type="hidden" name="aid" id="aid" value="0">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword4">End Date</label>
                      <input class="form-control" required name="advEndDate" id="advEndDate" placeholder="End Date" type="text">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword4">Advertisement Image</label>
                      <input required class="form-control" name="advimg" id="advimg" placeholder="Position" type="file" accept="image/*">
                      <input type="hidden" name="oldimg" id="oldimg" value="">
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
<script type="text/javascript" src="{{asset('assets/js/multiselect_industry.js')}}"></script>
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
           var formdata=$( this ).serialize();
            $(".loader").show();
            $.ajax({
                   url : action,
                   method : "POST",
                   data : formdata,
                   dataType : "text",
                   cache: false,
                  contentType: false,
                  processData: false,
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
        });*/
        $(document).on('click','.editbtn',function(){
            var id=$(this).attr('id');
             $(".loader").show();
            $.ajax({
                   url : "{{route('manager.get_advertisments_details')}}",
                   method : "GET",
                   data : {id:id},
                  dataType:'json',
                   success : function (data)
                   {
                      $("#adv_title").val(data.adv_title);
                      $("#adv_link").val(data.adv_link);
                      $("#advStartDate").val(data.advStartDate);
                      $("#advEndDate").val(data.advEndDate);
                       $("#oldimg").val(data.adv_image);
                       $("#adv_for").val(data.adv_for);
                       //$("#adv_category").val(data.categories);
                      /* $.each(data.categories, function(value) {
                                    console.log(value);
                                    $('#adv_category').multiselect('setOptions', value).multiselect('refresh');
                        });*/

                       $.each(data.categories, function(value,key) {
                        //console.log(key);
                $('option[value="'+key+'"]').prop('selected', true);
                $('option[value="'+key+'"]').attr('selected', 'selected');
            });
            $('#adv_category').multiselect('refresh');



                       $("#aid").val(data.id);
                       $("#listingdiv").hide();
                       $("#addeditdiv").slideDown( "slow", function() {
                                // Animation complete.
                              });
                       $("#advimg").removeAttr('required');
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
                   data : {id:id,status_of:'advert','_token':'{{ csrf_token() }}'},
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
                                  "ajax": "{{route('manager.get_advertisments')}}",
                                  "columns": [
                                    { "data": "serial" },
                                    { "data": "adv_title" },
                                    { "data": "advStartDate" },
                                    { "data": "advEndDate" },
                                    { "data": "status" },
                                    { "data": "action" },
                                    
                                ],columnDefs: [
                                   { orderable: false, targets: -1 }
                                ]
                                });
</script>
  <script type="text/javascript">
                  $(function () {
                          $('select[multiple].active.3col').multiselect({
                              columns: 1,
                              placeholder: 'Select',
                              enableFiltering:true,
                              allSelectedText: 'All',
                                includeSelectAllOption: true,
                              enableCaseInsensitiveFiltering: true,
                              search: true,
                              searchOptions: {
                                  'default': 'Search'
                              },
                              selectAll: true
                          });

                      });
            
                  </script>
<script>
   $('#advStartDate').datepicker();
   $('#advEndDate').datepicker();
</script>
@endsection