 @extends('Admin.Layouts.master')
@section('title', 'Edit Jobseeker')
@section('content')
<style type="text/css">
  label > span{
    color:red;
  }
</style>
<div class="content-wrapper">
          <div class="card">

            <!-------------Country Add Edit From Here--------------->
            <div class="card-body" id="addeditdiv">
                <a href="{{route('jobseekers')}}" id="backbutton" class="backbutton btn btn-warning btn-fw" style="float:right;"> <span>Back</span></a>
              <h4 class="card-title">Edit Jobseeker</h4>
                @if(Session::has('message'))
              <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> {{ Session::get('message') }}
              </div>
              @endif
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive" style="overflow: hidden;">
                    <form class="forms-sample dataformtosubmit2" method="POST" action="{{route('add_edit_jobseeker.submit')}}" enctype="multipart/form-data">
                     @csrf
                     <div class="row">
                     <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputName1">First Name <span>*</span></label>
                        <input class="form-control" required name="user_first_name" id="user_first_name" placeholder="First Name" value="{{$userdetails->user_first_name}}" type="text">
                        <input type="hidden" name="user_id" value="{{$userdetails->id}}" id="id">
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputName1">Last Name <span>*</span></label>
                        <input class="form-control" required name="user_last_name" id="user_last_name" placeholder="Last Name" value="{{$userdetails->user_last_name}}" type="text">
                        
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputName1">Email <span>*</span></label>
                        <input class="form-control" value="{{$userdetails->email}}" required name="email" id="email" onchange="checkemail()" placeholder="Email" type="email">
                        <span id="emailerror"></span>
                        
                      </div>
                    </div>
                   
                    <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputName1">Password <span>*</span></label>
                        <input class="form-control"  name="password" id="password" placeholder="Password" value="" type="password">
                        
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputName1">Contact Number <span>*</span></label>
                        <input class="form-control"  onkeypress='validate(event)' maxlength="14" required name="user_contact" id="user_contact" placeholder="Contact Number" value="{{$userdetails->user_contact}}" type="text">
                        
                      </div>
                    </div>
                     
                    <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputName1">About</label>
                        <textarea class="form-control"  name="user_about" id="user_about" placeholder="About" type="text">{{$userdetails->user_about}}</textarea> 
                        
                      </div>
                    </div>
                     <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputName1">Profile Image</label>
                        <input type="file" class="dropify" name="user_image"/>
                        <input type="hidden" name="oldimage" value="{{$userdetails->user_profile_picture}}">
                      </div>
                    </div>
                  </div>
                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                    <!-- <button type="button" class="btn btn-light backbutton">Cancel</button> -->
                  </form>                 
                  </div>
                </div>
              </div>
            </div>
            <!-------------Country Add Edit Here--------------->



          </div>
        </div>

        <script type="text/javascript">
             
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
        
     function checkemail()
        {
          var email = $("#email").val();
          var uid=$("#id").val();
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

        /**************phone number validation****************/
/*function alphaOnly(event) {
  var key = event.keyCode;
  return ((key >= 48 && key <= 57) || key == 8);
};*/
function validate(evt) {
  var theEvent = evt || window.event;
  var key = theEvent.keyCode || theEvent.which;
  key = String.fromCharCode( key );
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}
/**************phone number validation****************/
        </script>
@endsection