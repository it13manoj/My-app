 @extends('Admin.Layouts.master')
@section('title', 'Jobseeker')
@section('content')
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
               <!-------search is here----------->

               <!-------search is here----------->
              <div class="row">
              <div class="col-md-4">
                <h4 class="card-title">Jobseeker Manager</h4>
              </div>
              <div class="col-md-4">
            	<a href="{{route('add_jobseeker')}}" id="addbutton2" class="btn btn-warning btn-fw" style="float:right;"> <span>+ Add Jobseeker</span></a> 
              </div>
              <div class="col-md-4">
              <a href="javascript:;" id="addbutton" class="btn btn-warning btn-fw" > <span>Import</span></a>
              </div>
              </div>
              <form method="post">
                {{csrf_field()}}
              <div class="row">
                <div class="col-md-4">
              
                <div class="form-group">
                  <label>Keyword</label>
                    <input type="text" name="search" value="{{$search}}" placeholder="Search" class="form-control">
                </div>
              
                </div>
                <div class="col-md-4 advncsearch" style="display: none;">
              
                <div class="form-group">
                  <label>Industry</label>
                  <div class="form-group margin-bottom-0">
                      <select name="industries[]" multiple="multiple" class="3col active">
                          @if($category)
                            @foreach($category as $cat)
                              <option @if($industry)@if(in_array($cat->category_id,$industry)) selected @endif @endif value="{{$cat->category_id}}">{{$cat->category_name}}</option>
                            @endforeach
                          @endif
                      </select>
                  </div>
                </div>
              
                </div>
                <div class="col-md-4 advncsearch" style="display: none;">
                
                <div class="form-group">
                  <label>Experience</label>
                    <select name="experience[]" multiple="multiple" class="3col active">
                          <option @if($experience)@if(in_array('0-0',$experience)) selected @endif @endif  value="0-0">Fresher</option>
                          <option @if($experience)@if(in_array('1-2',$experience)) selected @endif @endif value="1-2">1 Year to 2 Year</option>
                          <option @if($experience)@if(in_array('2-3',$experience)) selected @endif @endif value="2-3">2 Year to 3 Year</option>
                          <option @if($experience)@if(in_array('3-4',$experience)) selected @endif @endif value="3-4">3 Year to 4 Year</option>
                          <option @if($experience)@if(in_array('4-5',$experience)) selected @endif @endif value="4-5">4 Year to 5 Year</option>
                          <option @if($experience)@if(in_array('5-7',$experience)) selected @endif @endif value="5-7">5 Year to 7 Year</option>
                          <option @if($experience)@if(in_array('7-10',$experience)) selected @endif @endif value="7-10">7 Year to 10 Year</option>
                          <option @if($experience)@if(in_array('10-11',$experience)) selected @endif @endif value="10-11">More than 10 Year</option>
                          
                      </select>
                </div>
              
                </div>
                <div class="col-md-3 advncsearch" style="display: none;">
                  
                <div class="form-group">
                  <label>Expected Salary</label>
                    <select name="expectedsalary[]" multiple="multiple" class="3col active">
                          <option @if($expsalary)@if(in_array('0-300000',$expsalary)) selected @endif @endif value="0-300000">0-3 Lakhs</option>
                          <option @if($expsalary)@if(in_array('300000-600000',$expsalary)) selected @endif @endif value="300000-600000">3-6 Lakhs</option>
                          <option @if($expsalary)@if(in_array('600000-1000000',$expsalary)) selected @endif @endif value="600000-1000000">6-10 Lakhs</option>
                          <option @if($expsalary)@if(in_array('1000000-1500000',$expsalary)) selected @endif @endif value="1000000-1500000">10-15 Lakhs</option>
                          <option @if($expsalary)@if(in_array('1500000-2000000',$expsalary)) selected @endif @endif value="1500000-2000000">15-20 Lakhs</option>
                          <option @if($expsalary)@if(in_array('2000000-3000000',$expsalary)) selected @endif @endif value="2000000-3000000">20-30 Lakhs</option>
                          <option @if($expsalary)@if(in_array('3000000-5000000',$expsalary)) selected @endif @endif value="3000000-5000000">30-50 Lakhs</option>
                          
                      </select>
                </div>
              
                </div>
                
            <div class="col-md-6">
              <label style="color:#fff">Action</label>
              <div class="form-group">
              <button type="submit" class="btn btn-primary">Submit</button>
              <button type="button" class="btn btn-warning searchadvance">Advance Search</button>
              @if($industry || $expsalary || $experience || $search)
              <a href="{{url('manager/jobseekers')}}" class="btn btn-danger searchadvance">Reset</a>
              @endif
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
                    <table id="jobseekerTable" class="table">
                      <thead>
                        <tr>
                            <th> #</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone number</th>
                            <th>Created on</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if($jobseekers)
                        @php $i=1;@endphp
                          @foreach($jobseekers as $jobseeker)
                          <tr>
                            <td>{{$i}}</td>
                            <td>
                              @if($jobseeker->user_profile_picture!='')
                              <img src="{{url('/admin_assets/uploaded_images/profile_pic/thumb')}}/{{$jobseeker->user_profile_picture}}" style="height:50px !important;width:50px !important;">
                              @else
                               <img src="{{url('/admin_assets/images/profile-default.png')}}" style="height:50px !important;width:50px !important;">
                              @endif
                            </br>{{$jobseeker->user_first_name}} {{$jobseeker->user_last_name}}</td>
                            <td>{{$jobseeker->email}}</td>
                            <td>{{$jobseeker->user_contact}}</td>
                            <td>{{date('M d,Y',strtotime($jobseeker->created_at))}}</td>
                            <td>
                              @if($jobseeker->user_status==1) 
                                <a style="cursor:pointer" type="button" id="status_{{$jobseeker->id}}" class="change_status" idd="{{$jobseeker->id}}"> <label style="cursor:pointer" class="badge badge-success">Active</label></a>
                            @else
                                <a style="cursor:pointer" type="button" id="status_{{$jobseeker->id}}" class="change_status" idd="{{$jobseeker->id}}"> <label style="cursor:pointer" class="badge badge-danger">Inactive</label></a>
                            @endif

                            </td>
                            <td>
                      <a href="{{url('/manager/editjobseeker')}}/{{base64_encode($jobseeker->id)}}" style="cursor:pointer"  class="btn btn-primary editbtn"><i class="fa fa-edit">Edit</i></a>
                        <a target="_blank" href="{{url('userprofile/')}}/{{$jobseeker->user_slug}}" style="cursor:pointer"  class="btn btn-primary editbtn"><i class="fa fa-eye">View</i></a>

                            </td>
                          </tr>
                          @php $i++;@endphp
                          @endforeach
                        @endif
                      </tbody>
                    </table>  
                    {!! $jobseekers->appends(request()->input())->links() !!}                  
                  </div>
                </div>
              </div>
            </div>
            <!-------------Country Listing Ends Here--------------->
            <div class="card-body" style="display: none;padding: 1.88rem" id="addeditdiv">
                <button type="button" id="backbutton" class="backbutton btn btn-warning btn-fw" style="float:right;"> <span>Back</span></button>
              <h4 class="card-title">Import using excel file</h4>

              <div class="row">
                <div class="col-8">
                  <div class="table-responsive">
                    <form enctype="multipart/form-data" class="forms-sample dataformtosubmit" method="POST" action="{{route('manager.importusingexcel')}}">
                     @csrf
                     <a href="{{asset('website/userImport.xlsx')}}">Donwload sample file</a>
                    <div class="form-group">
                      <label for="exampleInputName1">Select Excel File</label>
                      <input class="form-control" required name="excelfile" id="excelfile" type="file">
                    </div>
                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                    <button type="button" class="btn btn-light backbutton">Cancel</button>
                  </form>                 
                  </div>
                </div>
              </div>
            </div>
           



          </div>
        </div>
        <script type="text/javascript" src="{{asset('assets/js/multiselect_industry.js')}}"></script>
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

        $("#addbutton").click(function(){
                    $("#listingdiv").hide();
                     $("#addeditdiv").slideDown( "slow", function() {
                            // Animation complete.
                          });
                });
                $(".backbutton").click(function(){
                    $("#addeditdiv").hide();
                    $("#listingdiv").slideDown( "slow", function() {
                          });
                });

                $(".expand").click(function(){
                  $(".portlet-body").show();
                })
        </script>
        <script type="text/javascript">
                  $(function () {
                          $('select[multiple].active.3col').multiselect({
                              columns: 1,
                              placeholder: 'Select',
                              enableFiltering:true,
                              enableCaseInsensitiveFiltering: true,
                              search: true,
                              searchOptions: {
                                  'default': 'Search'
                              },
                              selectAll: true
                          });

                      });
            $(".searchadvance").click(function(){
              $(".advncsearch").slideToggle('slow');
            })
                  </script>
@endsection