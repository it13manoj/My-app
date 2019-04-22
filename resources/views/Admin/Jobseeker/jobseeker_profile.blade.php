@extends('Admin.Layouts.master')
@section('title', 'Employer Profile')
@section('content')
<div class="content-wrapper">
          <div class="row user-profile">
            <div class="col-lg-4 side-left d-flex align-items-stretch">
              <div class="row">
                <div class="col-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body avatar">
                      <h4 class="card-title">Info</h4>
                      @if($userdetails->user_profile_picture!='')
                      <img src="{{asset('/admin_assets/uploaded_images/profile_pic/')}}/{{$userdetails->user_profile_picture}}" alt="">
                      @else
                      <img src="{{asset('admin_assets/images/profile-default.png')}}" alt="">
                      @endif
                      <p class="name">{{$userdetails->user_first_name}} {{$userdetails->user_last_name}}</p>
                      <p class="designation">-  {{$userdetails->user_designation}}  -</p>
                      <a class="d-block text-center text-dark" href="#">{{$userdetails->email}}</a>
                      <a class="d-block text-center text-dark" href="#">{{$userdetails->user_contact}}</a>
                    </div>
                  </div>
                </div>
                <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body overview">
                      <ul class="achivements">
                        <li><p>0</p><p>Job Posted</p></li>
                        <li><p>0</p><p>Hired</p></li>
                        <!-- <li><p>29</p><p>Completed</p></li> -->
                      </ul>
                      <div class="wrapper about-user">
                        <h4 class="card-title mt-4 mb-3">About</h4>
                        <p>{{$userdetails->user_about}}</p>
                      </div>
                      <div class="info-links">
                       <!--  <a class="website" href="http://urbanui.com/">
                          <i class="mdi mdi-earth text-gray"></i>
                          <span>http://urbanui.com/</span>
                        </a>
                        <a class="social-link" href="#">
                          <i class="mdi mdi-facebook text-gray"></i>
                          <span>https://www.facebook.com/johndoe</span>
                        </a>
                        <a class="social-link" href="#">
                          <i class="mdi mdi-linkedin text-gray"></i>
                          <span>https://www.linkedin.com/johndoe</span>
                        </a> -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-8 side-right stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="wrapper d-block d-sm-flex align-items-center justify-content-between">
                    <h4 class="card-title mb-0">Details</h4>
                    <ul class="nav nav-tabs tab-solid tab-solid-primary mb-0" id="myTab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-expanded="true">Info</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="avatar-tab" data-toggle="tab" href="#avatar" role="tab" aria-controls="avatar">Profile Picture</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="security-tab" data-toggle="tab" href="#security" role="tab" aria-controls="security">Security</a>
                      </li>
                    </ul>
                  </div>
                  <div class="wrapper">
                    <hr>
                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info">
                        <form method="POST" action="{{route('manager.add_edit_employers.submit')}}" enctype="multipart/form-data">
                          @csrf
                          <div class="form-group">
                            <label for="name">First Name</label>
                           <input class="form-control" required name="user_first_name" id="user_first_name" placeholder="First Name" value="{{$userdetails->user_first_name}}" type="text">
                          <input type="hidden" name="user_id" value="{{$userdetails->id}}" id="uid2">
                          </div>
                          <div class="form-group">
                            <label for="name">Last Name</label>
                           <input class="form-control" required name="user_last_name" id="user_last_name" placeholder="Last Name" value="{{$userdetails->user_last_name}}" type="text">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputName1">Email</label>
                            <input class="form-control" onchange="checkemail()" value="{{$userdetails->email}}" required name="email" id="email" placeholder="Email" type="email">
                            <span id="emailerror"></span>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputName1">Company</label>
                            <select required="required" class="form-control" name="user_company" id="user_company">
                                <option value="">Select Company</option>
                                @if($companies)
                                  @foreach($companies as $company)
                                      <option @if($userdetails->user_company==$company->company_id) selected @endif value="{{$company->company_id}}">{{$company->company_name}}</option>
                                  @endforeach
                                @endif
                            </select>
                           
                          </div>
                           <div class="form-group">
                            <label for="exampleInputName1">Contact Number</label>
                            <input class="form-control" required name="user_contact" id="user_contact" placeholder="Contact Number" value="{{$userdetails->user_contact}}" type="text">
                            
                          </div>
                          <div class="form-group">
                          <label for="exampleInputName1">Designation</label>
                          <input class="form-control" required name="user_designation" id="user_designation" placeholder="Designation" value="{{$userdetails->user_designation}}" type="text">
                          
                        </div>
                          <div class="form-group">
                            <label for="exampleInputName1">About</label>
                            <textarea class="form-control"  name="user_about" id="user_about" placeholder="About" type="text">{{$userdetails->user_about}}</textarea> 
                            <input type="hidden" name="oldimage" value="{{$userdetails->user_profile_picture}}">
                          </div>
                          
                          <div class="form-group mt-5">
                            <button type="submit" class="btn btn-success mr-2">Update</button>
                            <!-- <button class="btn btn-outline-danger">Cancel</button> -->
                          </div>
                        </form>
                      </div><!-- tab content ends -->
                      <div class="tab-pane fade" id="avatar" role="tabpanel" aria-labelledby="avatar-tab">
                        <div class="wrapper mb-5 mt-4">
                          <span class="badge badge-warning text-white">Note : </span>
                          <p class="d-inline ml-3 text-muted">Image size is limited to not greater than 1MB .</p>
                        </div>

                        <form method="POST" action="{{route('manager.add_edit_employers.submit')}}" enctype="multipart/form-data">
                          @csrf
                          <input type="hidden" name="user_id" value="{{$userdetails->id}}" id="id">
                         
                          @if($userdetails->user_profile_picture!='')
                      
                       <input type="file" name="user_image" class="dropify" data-max-file-size="1mb" data-default-file="{{asset('/admin_assets/uploaded_images/profile_pic/')}}/{{$userdetails->user_profile_picture}}"/>
                      @else
                      <input type="file" name="user_image" class="dropify" data-max-file-size="1mb" data-default-file="{{asset('admin_assets/images/profile-default.png')}}"/>
                      @endif
                          <input type="hidden" name="oldimage" value="{{$userdetails->user_profile_picture}}">
                          <div class="form-group mt-5">
                            <button type="submit" class="btn btn-success mr-2">Update</button>
                            <button class="btn btn-outline-danger">Cancel</button>
                          </div>
                        </form>
                      </div>
                      <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
                        <form method="POST" action="{{route('manager.add_edit_employers.submit')}}" enctype="multipart/form-data">
                          @csrf
                          <div class="form-group">
                            <label for="change-password">Change password</label>
                            <div class="row">
                              <div class="col-10">
                            <input type="password" value="" class="form-control" id="change-password" placeholder="Enter you current password" name="password">
                            <input type="hidden" name="user_id" value="{{$userdetails->id}}" id="id">
                            </div><div class="col-2" style="padding:5px;"><a class="togglepass" type="button" style="cursor:pointer;padding: 8px 10px 8px 10px;border: 1px solid #ccc;"><i class="mdi mdi-eye"></i></a></div>
                          </div>
                        </div>
                          <div class="form-group">
                           <!--  <input type="password" class="form-control" id="new-password" placeholder="Enter you new password"> -->
                            <input type="hidden" name="oldimage" value="{{$userdetails->user_profile_picture}}">
                          </div>
                          <div class="form-group mt-5">
                            <button type="submit" class="btn btn-success mr-2">Update</button>
                            <button class="btn btn-outline-danger">Cancel</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <script type="text/javascript">
            $(".togglepass").click(function(){
                var pastype=$("#change-password").attr('type');
                if(pastype=="password")
                {
                  $("#change-password").attr('type','text');
                   
                  $(".togglepass").html('<i class="fa fa-eye-slash"></i>');
                }else{
                  $("#change-password").attr('type','password');
                  $(".togglepass").html('<i class="fa fa-eye"></i>');
                }
            });
            function checkemail()
        {
          var email = $("#email").val();
          var uid=$("#uid2").val();
           $(".loader").show();
            $.ajax({
                   url : '{{route("manager.checkemail")}}',
                   method : "GET",
                   data : {email:email,uid:uid},
                   dataType : "text",
                   success : function (data)
                   {
                      if(data ==1) 
                      {
                       $("#emailerror").text("This email Id is already registered.");
                       $("#email").val('');
                       $("#email").focus();
                      }
                      else
                      {
                         $("#emailerror").text("");
                      }
                      $(".loader").hide();
                   }
               });return false;
        }
        </script>
        @endsection