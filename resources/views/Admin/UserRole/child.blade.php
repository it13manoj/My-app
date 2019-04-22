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
  <div class="row">
  <div class="col-3">
  <select class="form-control" name="moderator" id="moderator" style="background: #ffb463;color:white" onchange="GetAlertDetails(this.value)">
    <option value="">Select Moderator</option>
    @foreach($Moderator as $rol)
      <option value="{{$rol->id}}">{{$rol->name}}</option>
    @endforeach
  </select>
</div>
<div class="col-9">
<button type="button" class="btn btn-warning btn-fw pull-right" data-toggle="modal" data-target="#myModal"  hidden="">Add Menu</button>
</div>
</div>
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
                    <form class="forms-sample dataformtosubmit2" method="POST" action="{{route('edit_child.submit')}}">
                     @csrf
                     <div class="row">
                     <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputName1">Parent Menu Name <span>*</span></label>
                        <select class="form-control" required name="Parent_Menu_Name" id="Parent_Menu_Name" placeholder="Parent Menu Name" type="text">
                          <option value="">Select Parent</option>
                           @foreach($ParentMenu as $ft)
                           <option value="{{ $ft->parent_id }}">{{ $ft->parent_name}}</option>
                           @endforeach
                        </select>
                       <input type="hidden" name="edit" id="editmenuid">
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputName1">Child Menu Name <span>*</span></label>
                        <input class="form-control" required name="child_Menu_name" id="child_Menu_name" placeholder="Child Menu Name" type="text">
                        
                      </div>
                    </div>

                     <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputName1">Child Menu Link <span>*</span></label>
                        <input class="form-control" required name="child_Menu_Link" id="child_Menu_Link" placeholder="Child Menu Link" type="text">
                        
                      </div>
                    </div>
                   
                    <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputName1">&nbsp;</label>
                        <button type="submit" class="btn btn-success mr-2" style="width: 100%">Submit</button>
                        
                      </div>
                    </div>

                  </div>
               
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
                            <th>Child Menu Name</th>
                            <th>Action</th>
                            <th>Status</th>
                        </tr>
                  <tbody id="replace">
                     @foreach($Child as $row)
                     <tr id="replace_{{$row->child_id}}">
                       <td> <input type="checkbox" name="checkbox[]" value="{{$row->child_id}}" class="chechbox" idd="{{$row->child_id}}"></td>
                       <td> {{ $row->parent_name }}</td>
                       <td> {{ $row->child_menu_name }}</td>
                       <td>

                        <span style="cursor:pointer" onclick="childEditMenu({{$row->child_id}});" class="btn btn-outline-primary editbtn"><i class="fa fa-edit" >Edit</i></span></td>
                       <td>
                        @if($row->child_status==1)
                        <span class="btn btn-success" onclick="ProformeStatus('active',0,{{$row->child_id}})" idd="{{$row->child_id}}">Actie</span>
                        @else
                         <span class="btn btn-danger"  onclick="ProformeStatus('inactive',1,{{$row->child_id}})" idd="{{$row->child_id}}">Inactie</span>
                        @endif
                      </td>
                     </tr>
                     @endforeach
                   </tbody>
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
  function childEditMenu(id){
    $.ajax({
      type:"post",
      url:"{{route('getChildMenu')}}",
      data:{id:id, _token: '{{csrf_token()}}'},
      success:function(msg){
        $('#myModal').modal('show');
        var obj=JSON.parse(msg);
        $('#Parent_Menu_Name').val(obj[0].child_parent_menu_id);
        $('#child_Menu_name').val(obj[0].child_menu_name);
        $('#child_Menu_Link').val(obj[0].child_menu_link);
        $('#editmenuid').val(obj[0].child_id);
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
        <script type="text/javascript">
          function ProformeStatus(value,s,id){
            var idd=$(this).attr('idd');
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
                   url : "{{route('manager.child_status')}}",
                   method : "POST",
                   data : {id:id,value:value,s:s,'_token':'{{ csrf_token() }}'},
                  dataType:'text',
                   success : function (data)
                   {
                        $('#replace_'+id).html(data);
                       $(".loader").hide();
                      
                   }
               });
            });
          }
        </script>
        <script type="text/javascript">
          $(document).on('click','.chechbox',function(){
              var id=$(this).attr('idd');
              var moderator=$('#moderator').val();
              if(moderator==""){
                alert('Please Select Moderator');
                return false;
              }
              if($(this). prop("checked") == true){
                  var category="yes";
                }
              else if($(this). prop("checked") == false){
                 var category="no";
              }
              $.ajax({
                type:"post",
                url:"{{route('manager.alertchildrole')}}",
                data:{id:id,moderator:moderator,category:category,'_token':'{{ csrf_token() }}'},
                success:function(msg){

                }
              })
          });
          function GetAlertDetails(id){
            $.ajax({
              type:"post",
              url:"{{route('manager.gEtEmpLoYeRolE')}}",
              data:{id:id,'_token':'{{ csrf_token() }}'},
              success:function(msg){
                $('#replace').html(msg);
              }
            })
          }
        </script>
@endsection