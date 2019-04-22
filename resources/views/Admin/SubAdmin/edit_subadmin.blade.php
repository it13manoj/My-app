 @extends('Admin.Layouts.master')
@section('title', 'Modertors')
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
                <a href="{{route('moderators')}}" id="backbutton" class="backbutton btn btn-warning btn-fw" style="float:right;"> <span>Back</span></a>
              <h4 class="card-title">Add Sub Admin</h4>

              <div class="row">
                <div class="col-12">
                  <div class="table-responsive1">
                    <form class="forms-sample dataformtosubmit2" method="POST" action="{{route('manager.add_edit_subadmin.submit')}}" enctype="multipart/form-data">
                     @csrf
                     <div class="row">
                     <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputName1">First Name <span>*</span></label>
                        <input class="form-control" required name="user_first_name" id="user_first_name" placeholder="First Name" type="text">
                        <input type="hidden" name="user_id" value="0" id="id">
                      </div>
                    </div>

                    <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputName1">Last Name <span>*</span></label>
                        <input class="form-control" required name="user_last_name" id="user_last_name" placeholder="Last Name" type="text">
                        
                      </div>
                    </div>
                     <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputName1">Contact Number <span>*</span></label>
                        <input class="form-control"  onkeypress='validate(event)' maxlength="14" required name="user_contact" id="user_contact" placeholder="Contact Number" type="text">
                        
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputName1">Email <span>*</span></label>
                        <input class="form-control" onchange="checkemail()" required name="email" id="email" placeholder="Email" type="email">
                        <span id="emailerror"></span>
                      </div>
                    </div>
                  
                  
                    <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputName1">Password <span>*</span></label>
                        <input class="form-control" required name="password" id="password" placeholder="Password" type="password">
                        
                      </div>
                    </div>
                   

                    <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputName1">Privilege <span>*</span></label>
                        <select class="form-control chosen" required name="privilege[]" id="privilege" placeholder="privilege" multiple="">
                          <option value="">Select Privilege</option>
                          @foreach($ParentMenu as $Prnt)
                            <option value="{{$Prnt->parent_id}}">{{$Prnt->parent_name}}</option>
                          @endforeach
                        </select>
                        
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
                   url : '{{route("manager.checkemailadmin")}}',
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
$(function() {
$('.chosen').chosen();
});
        </script>
        <style type="text/css">
    
    .chosen-container-multi .chosen-choices li.search-field input[type=text]{
      height: 31px !important;
    }
        </style>
<link href="http://cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.min.css" rel="stylesheet"/>
<script src="http://cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.jquery.min.js"></script>
@endsection