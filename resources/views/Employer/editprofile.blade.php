@extends('Employer.layouts.app')
@section('title', 'Edit Profile')
@section('content')

 <!-- ====================== Start Signup Form ============= -->
               <section class="padding-top-7">
                  <div class="container">
                     <div class="row">
                        <div class="col-md-offset-3 col-md-5 col-sm-12 steps padd-r-0 padd-l-0">
                           <div class="col-md-6 ">
                              <div class="steps_box active_tab">
                                 <a id="signup-form-t-0" href="personal_info_employer.html" aria-controls="signup-form-p-0">
                                    <span class="title">
                                       <span class="icon"><i class="ti-user"></i></span>
                                       <span class="title_text">Personal</span>
                                    </span>
                                 </a>
                              </div>
                           </div>
                           <div class="col-md-6 ">
                              <div class="steps_box disable">
                                 <a id="signup-form-t-0" href="{{route('edit_organization')}}" aria-controls="signup-form-p-0">
                                    <span class="title">
                                       <span class="icon"><i class="ti-book"></i></span>
                                       <span class="title_text">Company</span>
                                    </span>
                                 </a>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-12">
                              <!-- General Information -->
                                 <div class="box">
                                    <div class="box-header">
                                       <div class="width-100">
                                          <h4 class="pull-left">Personal Information </h4><span class="pull-right set_upper_button"><a href="company_info_employer.html" class="angle_right"><i class="fa fa-angle-right" ></i></a> </span>
                                       </div> 
                                    </div>
                                    <div class="box-body">
                                       <form class="c-form" method="post" enctype="multipart/form-data">
                                       	  
                                       	  <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <div class="row">
                                             	<div class="col-sm-12 ">
	                                                <div class="form-group col-sm-4 mrg-bot-10 padd-l-0">
	                                                   <label>First Name <span>*</span></label>
	                                                   <input type="text" value="{{$result->user_first_name}}" name="user_first_name" id="user_first_name" class="form-control" > 
	                                                   <p class="error_msg" ></p>
	                                                </div>
	                                                <div class="form-group col-sm-4 mrg-bot-10">
	                                                   <label>Last Name <span>*</span></label>
	                                                   <input type="text" value="{{$result->user_last_name}}" name="user_last_name" id="user_last_name" class="form-control" > 
	                                                   <p class="error_msg" > </p>
	                                                </div>
	                                                <div class="form-group col-sm-4 mrg-bot-10 padd-r-0">
	                                                   <label>Email <span>*</span></label>
	                                                   <input type="email" value="{{$result->email}}" disabled="disabled" name="email" id="email" class="form-control" > 
	                                                   <p class="error_msg" ></p>
	                                                </div>
                                                </div>
                                                <div class="col-sm-12">
	                                                <div class="form-group col-sm-4 mrg-bot-10 padd-l-0">
	                                                   <label>Contact Number <span>*</span></label>
	                                                   <input type="text" class="form-control"  value="{{$result->user_contact}}" name="user_contact" id="user_contact">
	                                                   <input type="hidden" name="oldcontact" value="{{$result->user_contact}}"> 
	                                                   <p class="error_msg" ></p>
	                                                </div>
                                                
	                                                <div class="form-group col-sm-4 mrg-bot-10">
	                                                   <label>Date of birth<span>*</span></label>
	                                                   <input type="text" id="dob" class="form-control" readonly="" value="{{$result->user_dob}}" name="user_dob" >
	                                                   <p class="error_msg" ></p>
	                                                </div>
	                                                <div class="form-group col-sm-4 mrg-bot-10 padd-r-0">
	                                                   <label class="width-100">Gender <span>*</span></label>
	                                                   <select class="wide form-control" name="user_gender" id="user_gender">
	                                                      <option data-display="Gender"> Select</option>
	                                                      <option @if($result->user_gender=='Female') selected @endif value="Female">Female</option>
	                                                      <option @if($result->user_gender=="Male") selected @endif value="Male">Male</option>
	                                                      <option @if($result->user_gender=='Other') selected @endif value="Other">Other</option>
	                                                   </select>
	                                                   <span class="error_msg" ></span>
	                                                </div>
	                                            </div>
	                                            <div class="col-sm-12">
	                                                <div class="form-group col-sm-4 mrg-bot-10 padd-l-0">
	                                                   <label>Aadhar Card</label>
	                                                   <input type="text" class="form-control"  value="{{$result->user_id_proof}}" name="user_id_proof" id="user_id_proof">
	                                                </div>
	                                                <div class="form-group col-sm-4 mrg-bot-10">
	                                                   <label>Current Designation <span>*</span></label>
	                                                   <input type="text" class="form-control"  value="{{$result->user_designation}}" name="user_designation" id="user_designation"> 
	                                                   <p class="error_msg" ></p>
	                                                </div>
	                                                <div class="form-group col-sm-4 mrg-bot-10 padd-r-0">
	                                                   <label class="width-100">Industry <span>*</span></label>
	                                                   <select class="wide form-control" name="user_category" id="user_category" onchange="fetchsubcategory(this.value)">
	                                                      <option value=""> Select</option>
	                                                      @if($categories)
	                                                      	@foreach($categories as $category)
	                                                      	<option @if($category->category_id==$result->user_industry) selected @endif value="{{$category->category_id}}">{{$category->category_name}}</option>
	                                                      	@endforeach
	                                                      @endif
	                                                   </select>
	                                                   <span class="error_msg" ></span>
	                                                </div>
                                                </div>
                                                <div class="col-sm-12">
                                                	<div class="form-group col-sm-4 mrg-bot-10 padd-l-0">
	                                                   <label class="width-100">Functional Area <span>*</span></label>
	                                                   <select name="user_functional_area" class="job-sub-category wide form-control">
	                                                      <option >Select</option>
	                                                     
	                                                   </select>
	                                                   <span class="error_msg" ></span>
	                                                </div>
	                                                <div class="form-group col-sm-8 mrg-bot-10 padd-r-0">
	                                                   <label>Profile Pic</label>
	                                                   <div class="custom-file-upload form-control">
	                                                      <input type="file" id="file" name="profilepic" placeholder="Browse" class=""  />
	                                                      <input type="hidden" value="{{$result->user_profile_picture}}" name="oldpic">
	                                                      <input type="hidden" value="{{$result->user_profile_pic_thumb}}" name="oldthumb">
	                                                   </div>
	                                                   <p class="error_msg" ></p>
	                                                </div>
                                                </div>
	                                            <div class="col-sm-12 ">
	                                                <label class="width-100 font-20next">Social Accounts</label>
	                                                <div class="form-group col-sm-4 mrg-bot-10 padd-l-0">
	                                                   <label>FaceBook</label>
	                                                   <input type="text" name="user_facebook" class="form-control" value="{{$result->user_fb_link}}">
	                                                   <p class="error_msg" ></p>
	                                                </div>
	                                                <div class="form-group col-sm-4 mrg-bot-10">
	                                                   <label>Twitter</label>
	                                                   <input type="text" class="form-control" value="{{$result->user_twitter_link}}" name="user_twitter">
	                                                   <p class="error_msg" ></p>
	                                                </div>
	                                                <div class="form-group col-sm-4 mrg-bot-10 padd-r-0 ">
	                                                   <label>Linkedin</label>
	                                                   <input type="text" name="user_linkedin" class="form-control" value="{{$result->user_linkedin_link}}" >
	                                                   <p class="error_msg" ></p>
	                                                </div>
	                                            </div>
                                            </div>
                                            <div class="text-right ">
                                          	  	<button type="submit"  class="btn btn-m theme-btn"> Update </button>
                                       		</div>
                                       </form>
                                    </div>
                                    <!-- <div class="text-right padding-right-30 padd-bot-40">
                                          <a href="personal_info.html" class="btn light-gray-btn"> Back </a>
                                          <a href="professional_info.html" class="btn theme-btn"> Next </a>
                                       </div> -->
                                 </div>
                           
                           
                        </div>
                     </div>
                     
                  </div>
               </section>
               <!-- ====================== End Signup Form ============= -->

@endsection
@section('page-footer')
<script>
 $('#date-from').dateDropper();
fetchsubcategory($('#user_category').val());
 function fetchsubcategory(categoryId){
 	$.ajax({
    url: "{{ route('fetchsubcats') }}?category_id="+categoryId,
    success: function(response){
       
        /*var obj = $.parseJSON(response);*/
        $(".job-sub-category").html('').trigger('change');
        console.log(categoryId);
        $(".job-sub-category").append(response).trigger('change');
        if(categoryId=='{{$result->user_industry}}'){
            $(".job-sub-category").val('{{$result->user_functional_area}}');
         }
        
    }
   })
 }

 /*$(".c-form").on('submit',function(e){
 	alert("here");
 })*/
</script>
 <script type="text/javascript">

    $('#dob').datepicker({  

       format: 'mm-dd-yyyy',
       endDate: new Date()

     });  

</script> 

@endsection