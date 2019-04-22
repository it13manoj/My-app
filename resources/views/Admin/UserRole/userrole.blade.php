 @extends('Admin.Layouts.master')
@section('title', 'Add Jobseeker')
@section('content')
<style type="text/css">
	label > span{
		color:red;
	}
</style>
<div class="content-wrapper">
  <div class="card">
<div id="setbutton" >
    <form class="forms-sample dataformtosubmit2" method="POST" action="{{route('edit_rolealert.submit')}}">
                     @csrf
  <div class="col-3">
    <div class="form-group">
   <label for="exampleInputName1">Select User Role<span>*</span></label>
 <select class="form-control" required name="Parent_Menu_Name" id="Parent_Menu_Name" placeholder="Parent Menu Name" type="text" onchange="GetDetails(this.value)">
<option value="">Select Parent</option>
@foreach($Moderator as $m)
<option value="{{$m->id}}">{{$m->name}}</option>
@endforeach
</select>
</div>
</div>

 
         <!-------------Country Add Edit From Here--------------->
            <div class="card-body" id="addeditdiv">
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive" style="overflow: hidden;">
                   
                     @csrf
                     <div class="row" id="replace">
                      @foreach($ParentMenu as $row)
                       
                        <div class="col-6">
                          <div class="">
                         <input type="checkbox" name="RoleAlert[]" id="rolealert" value="{{ $row->parent_id }}">&nbsp;&nbsp;{{ $row->parent_name }}
                          </div>
                        </div>
                        @endforeach
                      </div>
                     <button  class="btn btn-success mr-2" style="width: 100%">Submit</button>
                  </form>                 
                  </div>
                </div>
              </div>
            </div>
            <!-------------Country Add Edit Here--------------->
        </div>
        </div>
      </div>
<script type="text/javascript">
  function GetDetails(id){
    $.ajax({
      type:"post",
      url:"{{route('GetDetails')}}",
      data:{id:id, _token: '{{csrf_token()}}'},
      success:function(msg){
       $('#replace').html(msg);
      }

    })
  }

</script>
        <script type="text/javascript">
             
        /********submit form*******/
     /*   $(".dataformtosubmit").submit(function(){
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
        });*/
/*
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
        }*/
        
     
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
        <style type="text/css">
          .col-6, .lightGallery .image-tile {
    flex: 0 0 50%;
    max-width: 50%;
    line-height: 3;
    border: 1px solid gainsboro;
    /* background: ghostwhite; */
    padding: 9px;
}
        </style>
@endsection