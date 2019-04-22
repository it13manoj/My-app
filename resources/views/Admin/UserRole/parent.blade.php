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
<button type="button" class="btn btn-warning btn-fw pull-right" data-toggle="modal" data-target="#myModal" hidden="">Add Menu</button>
</div>
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
         <!-------------Country Add Edit From Here--------------->
            <div class="card-body" id="addeditdiv">
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive" style="overflow: hidden;">
                    <form class="forms-sample dataformtosubmit2" method="POST" action="{{route('edit_parent.submit')}}">
                     @csrf
                     <div class="row">
                     <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputName1">Parent Menu Name <span>*</span></label>
                        <input class="form-control" required name="Parent_Menu_Name" id="Parent_Menu_Name" placeholder="Parent Menu Name" type="text">
                       <input type="hidden" name="edit" id="editmenuid">
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputName1">Parent Menu Link <span>*</span></label>
                        <input class="form-control" required name="Parent_Menu_Link" id="Parent_Menu_Link" placeholder="Parent Menu Link" type="text">
                        
                      </div>
                    </div>
                   
                  </div>
                    <button type="submit" class="btn btn-success mr-2" style="width: 100%">Submit</button>
                    <!-- <button type="button" class="btn btn-light backbutton">Cancel</button> -->
                  </form>                 
                  </div>
                </div>
              </div>
            </div>
            <!-------------Country Add Edit Here--------------->
          </div>
      </div>
    </div>
  </div>
          <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="jobTable" class="table">
                      <thead>
                        <tr>
                            <th> #</th>
                            <th>Parent Menu Name</th>
                            <th>Action</th>
                            <th>Status</th>
                        </tr>
                     @foreach($ParentMenu as $ft)
                     <tr>
                       <td>{{$ft->parent_id}}</td>
                       <td> {{ $ft->parent_name }}</td>
                       <td><span style="cursor:pointer" onclick="parentEditMenu({{$ft->parent_id}});" class="btn btn-outline-primary editbtn"><i class="fa fa-edit" >Edit</i></span></td>
                       <td><span class="btn btn-success">Actie</span></td>
                     </tr>
                    
                     @endforeach
                      </thead>
                      <tbody>
                        
                      </tbody>
                    </table>                    
                  </div>
                </div>
              </div>
        </div>
      </div>
<script type="text/javascript">
  function parentEditMenu(id){
    $.ajax({
      type:"post",
      url:"{{route('getParentMenu')}}",
      data:{id:id, _token: '{{csrf_token()}}'},
      success:function(msg){
        $('#myModal').modal('show');
        var obj=JSON.parse(msg);
        console.log(obj[0].parent_name);
        $('#Parent_Menu_Name').val(obj[0].parent_name);
        $('#Parent_Menu_Link').val(obj[0].parent_link);
        $('#editmenuid').val(obj[0].parent_id);
      }

    })
  }

</script>
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