 @extends('Admin.Layouts.master')
@section('title', 'Company')
@section('content')
@if($company)
  @php $company_name=$company->company_name;
        $ccategory=$company->company_category;
        $company_email=$company->company_email;
        $company_contact=$company->company_contact;
        $company_website=$company->company_website;
        $number_of_employees=$company->number_of_employees;
        $company_capital=$company->company_capital;
        $company_sales=$company->company_sales;
        $company_corporate_number=$company->company_corporate_number;
        $company_establish_date=$company->company_establish_date;
        $company_fb=$company->company_fb;
        $company_twitter=$company->company_twitter;
        $company_google_plus=$company->company_google_plus;
        $company_linked_in=$company->company_linked_in;
        $company_owner=$company->company_owner;
        $company_country=$company->company_country;
        $company_state=$company->company_state;
        $company_city=$company->company_city;
        $company_address=$company->company_address;
        $company_about=$company->company_about;
        $company_id=$company->company_id;
        $oldlogo=$company->company_logo;
        $latt=$company->company_lat;
        $longg=$company->company_long;
   @endphp
@else
@php 
        $latt='';
        $longg='';
        $oldlogo='';
        $company_name='';
        $ccategory='';
        $company_email='';
        $company_contact='';
        $company_website='';
        $number_of_employees='';
        $company_capital='';
        $company_sales='';
        $company_corporate_number='';
        $company_establish_date='';
        $company_fb='';
        $company_twitter='';
        $company_google_plus='';
        $company_linked_in='';
        $company_owner='';
        $company_country='';
        $company_state='';
        $company_city='';
        $company_address='';
        $company_about='';
        $company_id=0;
@endphp
@endif
<div class="content-wrapper">
          <div class="card">

            <!-------------Country Add Edit From Here--------------->
            <div class="card-body" id="addeditdiv">
                <a href="{{url('manager/companies')}}" type="button" id="backbutton" class="backbutton btn btn-warning btn-fw" style="float:right;"> <span>Back</span></a>
              <h4 class="card-title">Add Company</h4>

              <div class="row">
                <div class="col-12">
                  <div class="table-responsive" style="overflow: hidden;">
                    <form class="forms-sample dataformtosubmit2" method="POST" action="{{route('manager.add_edit_company.submit')}}" enctype="multipart/form-data">
                     @csrf
                     <div class="row">
                     <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputName1">Company Name</label>
                        <input class="form-control" required name="companyname" id="companyname" placeholder="Company Name" type="text" value="{{$company_name}}">
                        
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputName1">Category</label>
                        <select required="required" class="form-control" name="category" id="category">
                            <option value="">Select Category</option>
                            @if($category)
                              @foreach($category as $cat)
                                  <option @if($ccategory==$cat->category_id) selected @endif value="{{$cat->category_id}}">{{$cat->category_name}}</option>
                              @endforeach
                            @endif
                        </select>
                       
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputName1">Contact Email</label>
                        <input class="form-control" required name="company_email" id="company_email" placeholder="Contact Email" type="email" value="{{$company_email}}">
                        
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputName1">Contact Number</label>
                        <input class="form-control" required name="company_contact" id="company_contact" value="{{$company_contact}}" placeholder="Contact Number" type="text">
                        
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputName1">Company Website</label>
                        <input class="form-control"  name="company_website" id="company_website" value="{{$company_website}}" placeholder="Company Website" type="url">
                        
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputName1">Number Of Employees</label>
                        <input class="form-control"  name="number_of_employees" id="number_of_employees" placeholder="Number Of Employees" type="number" value="{{$number_of_employees}}">
                        
                      </div>
                    </div>
                     <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputName1">Capital</label>
                        <input class="form-control"  name="company_capital" id="company_capital" placeholder="Capital" type="text" value="{{$company_capital}}">
                        
                      </div>
                    </div>
                     <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputName1">Sales</label>
                        <input class="form-control"  name="company_sales" id="company_sales" value="{{$company_sales}}" placeholder="Sales" type="text">
                        
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputName1">Corporate Number</label>
                        <input value="{{$company_corporate_number}}" class="form-control"  name="company_corporate_number" id="company_corporate_number" placeholder="Corporate Number" type="text">
                        
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputName1">Establish Year</label>
                        <input class="form-control" value="{{$company_establish_date}}"  name="company_establish_date" id="company_establish_date" placeholder="Establish Date" type="text">
                        
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputName1">Facebook Url</label>
                        <input class="form-control"  name="company_fb" value="{{$company_fb}}" id="company_fb" placeholder="Facebook Url" type="url">
                        
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputName1">Twitter Url</label>
                        <input class="form-control" value="{{$company_twitter}}"  name="company_twitter" id="company_twitter" placeholder="Twitter Url" type="url">
                        
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputName1">Google Plus Url</label>
                        <input class="form-control"  name="company_google_plus" value="{{$company_google_plus}}" id="company_google_plus" placeholder="Google Plus Url" type="text">
                        
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputName1">LinkedIn Url</label>
                        <input class="form-control"  name="company_linked_in" id="company_linked_in" value="{{$company_linked_in}}" placeholder="LinkedIn Url" type="text">
                        
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputName1">Owner</label>
                            <input class="form-control"  name="owner" id="owner" value="{{$company_owner}}" placeholder="Owner" type="text">
                       
                       
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputName1">Country</label>
                        <select  class="form-control" name="country" onchange="fetchstate(this.value);" id="country">
                            <option value="">Select Country</option>
                            @if($country)
                              @foreach($country as $count)
                                  <option @if($count->country_id==$company_country) selected @endif value="{{$count->country_id}}">{{$count->country_name}}</option>
                              @endforeach
                            @endif
                        </select>
                       
                      </div>
                    </div>
                     <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputName1">State</label>
                          <select name="state" class="state wide form-control" onchange="fetchcities(this.value);">
                            <option value="">Select</option>
                         </select>
                       
                      </div>
                    </div>
                     <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputName1">City</label>
                        <select name="city" class="city wide form-control">
                          <option value="">Select</option>
                       </select>
                       
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputName1">Address</label>
                        <input type="text" class="form-control"  name="company_address" id="company_address" placeholder="Address" value="{{$company_address}}">
                        <input type="hidden" id="latt" name="latt" value="{{$latt}}">
                        <input type="hidden" id="longg" name="longg" value="{{$longg}}"> 
                        
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputName1">Description</label>
                        <textarea class="form-control"  name="company_about"  id="company_about" placeholder="Description" type="text">{{$company_about}}</textarea> 
                        
                      </div>
                    </div>
                     <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputName1">Logo</label>
                        <input type="file" class="dropify" name="companyLogo"/>
                        <input type="hidden" name="cid" value="{{$company_id}}" id="cid">
                        <input type="hidden" name="oldlogo" value="{{$oldlogo}}">
                      </div>
                      
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                      @if($oldlogo!='')
                      <img height="200" width="200" src="{{asset('admin_assets/uploaded_images/company_pic/thumb/')}}/{{$oldlogo}}">
                      @endif
                    </div>
                    </div>
                  </div>
                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                    <button type="button" class="btn btn-light backbutton">Cancel</button>
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
        
     

        </script>
        <script>
 fetchstate($('#country').val());
 function fetchstate(country){
   $.ajax({
    url: "{{ route('fetchstates') }}?country_id="+country,
    success: function(response){
       
        /*var obj = $.parseJSON(response);*/
        $(".state").html('').trigger('change');
        //console.log(categoryId);
        $(".state").append(response).trigger('change');
        if(country=='{{$company_country}}'){
            $(".state").val('{{$company_state}}');
         }
        
    }
   })
 }
  function fetchcities(state){
    @if($company_state!='')
      var state='{{$company_state}}'
    @endif
   $.ajax({
    url: "{{ route('fetchcities') }}?state_id="+state,
    success: function(response){
       
        /*var obj = $.parseJSON(response);*/
        $(".city").html('').trigger('change');
        //console.log(categoryId);
        $(".city").append(response).trigger('change');
        if(state=='{{$company_state}}'){
            $(".city").val('{{$company_city}}');
         }
        
    }
   })
 }

 
 //CKEDITOR.replace( 'additionalinfo', {removePlugins: 'image',});

</script>

@endsection
@section('page-footer')
  <script type="text/javascript">
  CKEDITOR.replace( 'company_about', {removePlugins: 'image',});
  </script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBnQrXrRyWtQu7EKB9Hk1S10Gc6eQuamUo&libraries=places&callback=initAutocomplete"
   async defer></script>
 <script>
     
      var placeSearch, autocomplete;
      var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
      };

      function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('company_address')),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();
        var latitude = place.geometry.location.lat();
        var longitude = place.geometry.location.lng();
        $("#latt").val(latitude);
        $("#longg").val(longitude);
      }
     function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }
      </script>
@endsection