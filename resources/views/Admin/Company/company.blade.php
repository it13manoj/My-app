 @extends('Admin.Layouts.master')
@section('title', 'Company')
@section('content')
<div class="content-wrapper">
          <div class="card">
 <!-------------Country Listing Start From Here--------------->
            <div class="card-body" id="listingdiv">
              <form method="get">
              <div class="row">
                <div class="col-md-4">
              
                <div class="form-group">
                    <input type="text" name="search" value="{{$search}}" placeholder="Search" class="form-control">
                </div>
              
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  @if($search)
                  <a href="{{url('manager/companies')}}" type="submit" class="btn btn-danger">Reset</a>
                  @endif
                  </div>
                </div>
              </div>
            </form>
            	<a href="{{route('manager.add_edit_company')}}" id="addbutton" class="btn btn-warning btn-fw" style="float:right;"> <span>+ Add Company</span></a>
              <h4 class="card-title">Company Manager</h4>
              @if(Session::has('message'))
              <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> {{ Session::get('message') }}
              </div>
              @endif
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="catTable2" class="table">
                      <thead>
                        <tr>
                            <th> #</th>
                            <th>Company Name</th>
                            <th>Company contact</th>
                            <th>Company email</th>
                            <th>No. Of employees</th>
                            <th>Mark as Top</th>
                            <th>Mark as Featured</th>
                            <th>Status</th>
                            <th>Action</th>

                        </tr>
                      </thead>
                      <tbody>
                        @if($companies)
                        @php $i=1;@endphp
                        @foreach($companies as $company)
                          <tr>
                            <td>{{$i}}</td>
                            <td>{{$company->company_name}}</td>
                            <td>{{$company->company_contact}}</td>
                            <td>{{$company->company_email}}</td>
                            <td>{{$company->number_of_employees}}</td>
                            <td><input class="markas" idd="top" idd2="{{$company->company_id}}" type="checkbox" @if($company->is_marked_top==1) checked @endif name="is_marked_top" value="1"></td>
                            <td><input class="markas" idd="featured" idd2="{{$company->company_id}}"  type="checkbox" @if($company->is_marked_featured==1) checked @endif name="is_marked_featured" value="1"></td>
                            <td>@if($company->company_status==1) 
                                <a style="cursor:pointer" type="button" id="status_{{$company->company_id}}" class="change_status" idd="{{$company->company_id}}"> <label style="cursor:pointer" class="badge badge-success">Active</label></a>
                            @else
                                <a style="cursor:pointer" type="button" id="status_{{$company->company_id}}" class="change_status" idd="{{$company->company_id}}"> <label style="cursor:pointer" class="badge badge-danger">Inactive</label></a>
                            @endif</td>
                            <td>
                               <a href="{{url('/manager/edit_company')}}/{{base64_encode($company->company_id)}}" style="cursor:pointer"  class="btn btn-primary editbtn"><i class="fa fa-edit">Edit</i></a>
                        <a target="_blank" href="{{url('userprofile/')}}/{{$company->company_id}}" style="cursor:pointer"  class="btn btn-primary editbtn"><i class="fa fa-eye">View</i></a>
                            </td>
                            
                          </tr>
                          @php $i++;@endphp
                          @endforeach
                          
                        @endif
                      </tbody>
                    </table>    
                    {!! $companies->appends(request()->input())->links() !!}                 
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
                   data : {id:id,status_of:'company','_token':'{{ csrf_token() }}'},
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

        $(".markas").on('change',function(){
            $(".loader").show();
            var id=$(this).attr('idd2');
            var type=$(this).attr('idd');
            if($(this).prop("checked") == true){
                var status=1;
            }else{
                var status=0;
            }
                $.ajax({
                   url : "{{route('manager.markas')}}",
                   method : "POST",
                   data : {id:id,type:type,status:status,'_token':'{{ csrf_token() }}'},
                  dataType:'text',
                   success : function (data)
                   {
                       $(".loader").hide();
                    }
               });
        });
        </script>
@endsection