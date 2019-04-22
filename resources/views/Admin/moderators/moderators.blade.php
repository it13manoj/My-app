 @extends('Admin.Layouts.master')
@section('title', 'Modertors')
@section('content')
<div class="content-wrapper">
          <div class="card">
 <!-------------Country Listing Start From Here--------------->
            <div class="card-body" id="listingdiv">
              
            	<a href="{{route('sub_admin')}}" id="addbutton" class="btn btn-warning btn-fw" style="float:right;"> <span>+ Add Moderator</span></a>
              <h4 class="card-title">Moderator Manager</h4>
            
            <form method="post">
              <div class="row">
                
               
               
                
                
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
                    <table id="employerTable1" class="table">
                      <thead>
                        <tr>
                            <th> #</th>
                           
                            <th>Name</th>
                            <th>Email</th>
                            
                            <th>Username</th>
                            <th>Phone number</th>
                            
                  
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      @foreach($Moderator as $row)
                        <tr>
                          <td>
                            {{$row->id}}
                          </td>
                          <td>
                            {{$row->name}}
                          </td>
                          <td>
                            {{$row->email}}
                          </td>
                          <td>
                            {{$row->userId}}
                          </td>
                          <td>
                            {{$row->contact}}
                          </td>
                          <td>
                            <span class="btn btn-info">Edit</span>
                          </td>
                          <td>
                            <span class="btn btn-success">Active</span>
                          </td>
                        </tr>

                      @endforeach
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

    
@endsection