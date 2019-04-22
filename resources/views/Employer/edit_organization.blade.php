 @extends('Employer.layouts.app')
@section('title', 'Edit Organization')
@section('content')
<link rel="stylesheet" href="http://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
 <!-- ====================== Start Signup Form ============= -->
               <section class="padding-top-7">
                  <div class="container">
                     <div class="row">
                        <div class="col-md-offset-3 col-md-5 col-sm-12 steps padd-r-0 padd-l-0">
                           <div class="col-md-6 ">
                              <div class="steps_box  disable">
                                 <a id="signup-form-t-0" href="{{url('employer/edit_employer')}}" aria-controls="signup-form-p-0">
                                    <span class="title">
                                       <span class="icon"><i class="ti-user"></i></span>
                                       <span class="title_text">Personal</span>
                                    </span>
                                 </a>
                              </div>
                           </div>
                           <div class="col-md-6 ">
                              <div class="steps_box active_tab">
                                 <a id="signup-form-t-0" href="company_info_employer.html" aria-controls="signup-form-p-0">
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
                                 <form enctype="multipart/form-data" class="c-form" action="{{route('update_organization')}}" method="post">
                                    {{csrf_field()}}
                                          <!-- General Information -->
                                          <div class="box">
                                             <div class="box-header">
                                                <div class="width-100">
                                                   <h4 class="pull-left">Company Information </h4><span class="pull-right set_upper_button"><a href="#" class="angle_left "> <i class="fa fa-angle-left" ></i></a><a href="javascript:;" class="angle_right hide"><i class="fa fa-angle-right" ></i></a> </span>
                                                </div>
                                             </div>
                                             <div class="box-body">
                                                <div class="row">
                                                   <div class="col-sm-12">
                                                      <div class="col-sm-4">
                                                         <label>Company Name <span>*</span></label>
                                                         <input type="text" class="form-control" name="company_name" value="{{$result->company_name}}">
                                                         <p class="error_msg" ></p>
                                                      </div>
                                                   
                                                      <div class="col-sm-4">
                                                         <label>Company Tagline</label>
                                                         <input type="text" class="form-control" name="company_tag_line" value="{{$result->company_tag_line}}">
                                                         <p class="error_msg" > </p>
                                                      </div>
                                                   
                                                      <div class="col-sm-4">
                                                         <label class="width-100">Category <span>*</span></label>
                                                         <select class="wide form-control" name="company_category">
                                                            <option value=""> Select</option>
                                                         @if($categories)
                                                            @foreach($categories as $category)
                                                            <option @if($category->category_id==$result->company_category) selected @endif value="{{$category->category_id}}">{{$category->category_name}}</option>
                                                            @endforeach
                                                         @endif
                                                         </select>
                                                         <span class="error_msg" ></span>
                                                      </div>
                                                   </div>
                                                   <div class="col-sm-12">
                                                   <div class="col-sm-4 m-clear">
                                                      <label>Owner Name <span>*</span></label>
                                                      <input type="text" name="company_owner" class="form-control" value="{{$result->company_owner}}">
                                                      <p class="error_msg" ></p>
                                                   </div>
                                                   
                                                   <div class="col-sm-4 m-clear">
                                                      <label>Email Id <span>*</span></label>
                                                      <input type="text" name="company_email" class="form-control" value="{{$result->company_email}}">
                                                      <p class="error_msg" ></p>
                                                   </div>

                                                   <div class="col-sm-4 m-clear">
                                                      <label>Conatct No <span>*</span></label>
                                                      <input type="text" name="company_contact" class="form-control" value="{{$result->company_contact}}">
                                                      <p class="error_msg" ></p>
                                                   </div>
                                                   </div>
                                                   <div class="col-sm-12">
                                                      <div class="col-sm-4 m-clear">
                                                         <label>Website <span>*</span></label>
                                                         <input type="text" class="form-control" name="company_website" value="{{$result->company_website}}">
                                                         <p class="error_msg" ></p>
                                                      </div>

                                                      <div class="col-sm-4">
                                                         <label class="width-100">Employees </label>
                                                         <select name="number_of_employees" class="wide form-control">
                                                            <option value="">Select</option>
                                                            <option @if($result->number_of_employees=='1-10') selected @endif value="1-10">1-10</option>
                                                            <option @if($result->number_of_employees=='10-50') selected @endif value="10-50">10-50</option>
                                                            <option @if($result->number_of_employees=='50-100') selected @endif value="50-100">50-100</option>
                                                            <option @if($result->number_of_employees=='100-500') selected @endif value="100-500">100-500</option>
                                                            <option @if($result->number_of_employees=='500-1000') selected @endif value="500-1000">500-1000</option>
                                                            <option @if($result->number_of_employees=='>1000') selected @endif value=">1000">>1000</option>
                                                         </select>
                                                         <span class="error_msg" ></span>
                                                      </div>

                                                      <div class="col-sm-4">
                                                         <label>Established<small>(Please enter year)</small> <span>*</span></label>
                                                         <input type="text" class="form-control" value="{{$result->company_establish_date}}" name="company_establish_date">
                                                         <p class="error_msg" ></p>
                                                      </div>
                                                   </div>
                                                   <div class="col-sm-12">
                                                      <div class="col-sm-6">
                                                         <label>Company Logo <span>*</span></label>
                                                         <div class="custom-file-upload">
                                                            <input type="file" id="file" name="company_logo" />
                                                            <input type="hidden" name="oldlogo" value="{{$result->company_logo}}">
                                                         </div>
                                                         <p class="error_msg" ></p>
                                                      </div>
                                                   
                                                      <div class="col-sm-6">
                                                         <label>Banner Image <span>*</span></label>
                                                         <div class="custom-file-upload">
                                                            <input type="file" id="file" name="company_cover_image"  />
                                                            <input type="hidden" name="oldcover" value="{{$result->company_cover_image}}">
                                                         </div>
                                                         <p class="error_msg" ></p>
                                                      </div>

                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <!-- Company Address -->
                                          <div class="box">
                                             <div class="box-header">
                                                <h4>Company Address</h4>
                                             </div>
                                             <div class="box-body">
                                                <div class="row">
                                                   <div class="col-sm-12">
                                                      <div class="col-sm-4">
                                                      <label>Address <span>*</span></label>
                                                <input type="text" class="form-control" name="company_address" id="address" value="{{$result->company_address}}">
                                                <input type="hidden" id="latt" name="latt" value="{{$result->company_lat}}">
                                                <input type="hidden" id="longg" name="longg" value="{{$result->company_long}}">
                                                         <p class="error_msg" ></p>
                                                      </div>
                                                      <div class="col-sm-4 m-clear">
                                                         <label class="width-100">Country <span>*</span></label>
                                                         <select onchange="fetchstate(this.value);" id="country" name="company_country" class="wide form-control">
                                                            <option value="">Select</option>
                                                            @if($countries)
                                                               @foreach($countries as $country)
                                                            <option @if($country->country_id==$result->company_country) selected @endif value="{{$country->country_id}}">{{$country->country_name}}</option>
                                                               @endforeach
                                                            @endif
                                                         </select>
                                                         <span class="error_msg" ></span>
                                                      </div>
                                                   
                                                      <div class="col-sm-4 m-clear">
                                                         <label class="width-100">State <span>*</span></label>
                                                         <select name="company_state" class="state wide form-control" onchange="fetchcities(this.value);">
                                                            <option value="">Select</option>
                                                         </select>
                                                         <span class="error_msg" ></span>
                                                      </div>
                                                   </div>
                                                   <div class="col-sm-12">
                                                      
                                                      
                                                      <div class="col-sm-4">
                                                         <label class="width-100">City <span>*</span></label>
                                                         <select name="company_city" class="city wide form-control">
                                                            <option value="">Select</option>
                                                         </select>
                                                         <span class="error_msg" ></span>
                                                      </div>

                                                      <div class="col-sm-4 m-clear">
                                                         <label>Revenue <span>*</span></label>
                                                         <input type="text" name="company_capital" value="{{$result->company_capital}}" class="form-control" value="">
                                                         <p class="error_msg" ></p>
                                                      </div>
                                                      <div class="col-sm-4 m-clear">
                                                         <label>Corporate Number <span>*</span></label>
                                                         <input type="text" name="company_corporate_number" value="{{$result->company_corporate_number}}" class="form-control" value="">
                                                         <p class="error_msg" ></p>
                                                      </div>
                                                                       
                                                      <!-- <div class="col-sm-4 m-clear">
                                                         <label class="width-100">Working Time</label>
                                                         <select class="wide form-control" name="working_time">
                                                            <option @if($result->company_workingtime=='08:00AM To 5:00PM') selected @endif value="08:00AM To 5:00PM">08:00AM To 5:00PM</option>
                                                            <option @if($result->company_workingtime=='10:00AM To 4:00PM') selected @endif value="10:00AM To 4:00PM">10:00AM To 4:00PM</option>
                                                            <option @if($result->company_workingtime=='10:00AM To 6:00PM') selected @endif value="10:00AM To 6:00PM">10:00AM To 6:00PM</option>
                                                            <option @if($result->company_workingtime=='11:00AM To 7:00PM') selected @endif value="11:00AM To 7:00PM">11:00AM To 7:00PM</option>
                                                         </select>
                                                         <span class="error_msg" ></span>
                                                      </div> -->
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          
                                          <!-- Social Accounts -->
                                          <div class="box">
                                             <div class="box-header">
                                                <h4>Social Accounts</h4>
                                             </div>
                                             <div class="box-body">
                                                <div class="row">
                                                   
                                                   <div class="col-sm-4">
                                                      <label><!-- <i class="fa fa-facebook mrg-r-5"> </i>-->Facebook</label>
                                                      <input type="text" name="company_fb" value="{{$result->company_fb}}" class="form-control">
                                                   </div>
                                                  
                                                   <div class="col-sm-4">
                                                      <label><!-- <i class="fa fa-twitter mrg-r-5"></i> -->Twitter</label>
                                                      <input type="text" name="company_twitter" value="{{$result->company_twitter}}" class="form-control">
                                                   </div>
                                                   
                                                   <div class="col-sm-4">
                                                      <label><!-- <i class="fa fa-linkedin mrg-r-5"></i> -->LinkedIn</label>
                                                      <input type="text" name="company_linked_in" value="{{$result->company_linked_in}}" class="form-control" >
                                                   </div>
                                                   
                                                   
                                                   
                                                </div>
                                             </div>
                                          </div>
                                          
                                          <!-- Company Summery -->
                                          <div class="box">
                                             <div class="box-header">
                                                <h4>Company Summary</h4>
                                             </div>
                                             <div class="box-body">
                                                <div class="row">
                                                   
                                                   <div class="col-sm-12">
                                                      <label>About Company <span>*</span></label>
                                                      <textarea class="form-control height-120 " name="company_about" id="about_company" placeholder="About Company">{{$result->company_about}}</textarea>
                                                      <span class="error_msg" ></span>
                                                   </div>
                                                   
                                                </div>
                                             </div>
                                          </div>

                                          <!-- Company Images -->
                                          <div class="box">
                                             <div class="box-header">
                                                <h4>Life in a company</h4>
                                             </div>
                                             <div class="box-body">
                                                <div class="row">
                                                   @if($result->company_pics!='')

                                                   @php $imgs=explode(',',$result->company_pics) @endphp
                                                   @endif
                                                   <div class="col-sm-12">
                                                      <fieldset class="upload_image">
                                                           <a href="javascript:void(0)" onclick="$('#pro-image').click()">Upload Image</a>
                                                           <input type="file" id="pro-image" name="company_pics[]" style="display: none;" class="form-control" multiple>
                                                           <input type="hidden" name="oldpics" value="{{$result->company_pics}}">
                                                      </fieldset>
                                                      <div class="preview-images-zone">
                                                         @if($result->company_pics!='')
                                                         @foreach($imgs as $img)
                                                         @if($img!='')
                                                         <div class="preview-image preview-show-1">
                                                            <div class="image-cancel" data-no="1">x</div>
                                                            <div class="image-zone"><img id="pro-img-1" src="{{asset('admin_assets/uploaded_images/company_pic/thumb/gallery')}}/{{$img}}"></div>
                                                         </div>
                                                         @endif
                                                         @endforeach
                                                         @endif
                                                       </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>

                                          <!-- Company Videos -->
                                          <div class="box">
                                             <div class="box-header">
                                                <h4>Youtube Videos</h4>
                                             </div>
                                             <div class="box-body">
                                                <div class="row">
                                                   <div class="col-sm-12">
                                                      <fieldset class="upload_image">
                                                          <!--  <a href="javascript:void(0)" onclick="$('#pro-image').click()">Upload Video</a> -->
                                                           <input type="text" data-role="tagsinput" id="company_videos" name="company_videos"  class="form-control" value="{{$result->company_videos}}">
                                                       </fieldset>
                                                      <!-- <div class="preview-images-zone">
                                                         <div class="preview-image preview-show-1">
                                                            <div class="image-cancel" data-no="1">x</div>
                                                            <div class="image-zone"><iframe id="pro-img-1" src="https://www.youtube.com/watch?v=9EefXVcEMuI"></iframe></div>
                                                         </div>
                                                         
                                                         
                                                       </div> -->
                                                   </div>
                                                   <div class="col-sm-12">
                                                         <label>Additional Information</label>
                                                         <textarea id="additionalinfo" style="resize: none;" name="additionalinfo" class="form-control">{{$result->additionalinfo}}</textarea>
                                                      </div>
                                                </div>
                                             </div>
                                          </div>
                                          
                                          <div class="text-right">
                                             <a href="{{url('employer/edit_employer')}}" class="btn btn-m light-gray-btn"> Back </a>
                                             <button type="submit" class="btn btn-m theme-btn">Submit</button>
                                          </div>
                                          
                                       </form>
                        </div>
                     </div>
                     
                  </div>
               </section>
               <!-- ====================== End Signup Form ============= -->


@endsection
@section('page-footer')
 <script>
      $('#myTab a').click(function (e) {
         e.preventDefault()
         $(this).tab('show')
      })
      </script>
      
      <!-- Date Dropper Script-->
      <script>
         $('#reservation-date').dateDropper();
      </script>
      <script type="text/javascript">
         $(document).ready(function() {
    document.getElementById('pro-image').addEventListener('change', readImage, false);
    
    //$( ".preview-images-zone" ).sortable();
    
    $(document).on('click', '.image-cancel', function() {
        let no = $(this).data('no');
        $(".preview-image.preview-show-"+no).remove();
    });
});



var num = 4;
function readImage() {
    if (window.File && window.FileList && window.FileReader) {
        var files = event.target.files; //FileList object
        var output = $(".preview-images-zone");

        for (let i = 0; i < files.length; i++) {
            var file = files[i];
            if (!file.type.match('image')) continue;
            
            var picReader = new FileReader();
            
            picReader.addEventListener('load', function (event) {
                var picFile = event.target;
                var html =  '<div class="preview-image preview-show-' + num + '">' +
                            '<div class="image-cancel" data-no="' + num + '">x</div>' +
                            '<div class="image-zone"><img id="pro-img-' + num + '" src="' + picFile.result + '"></div>' +
                            '</div>';

                output.append(html);
                num = num + 1;
            });

            picReader.readAsDataURL(file);
        }
        $("#pro-image").val('');
    } else {
        console.log('Browser not support');
    }
}


      </script>
      <script>
         AOS.init();
      </script>
      <!------------fetch data-------------->
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
        if(country=='{{$result->company_country}}'){
            $(".state").val('{{$result->company_state}}');
         }
        
    }
   })
 }
  function fetchcities(state){
   $.ajax({
    url: "{{ route('fetchcities') }}?state_id="+state,
    success: function(response){
       
        /*var obj = $.parseJSON(response);*/
        $(".city").html('').trigger('change');
        //console.log(categoryId);
        $(".city").append(response).trigger('change');
        if(state=='{{$result->company_state}}'){
            $(".city").val('{{$result->company_city}}');
         }
        
    }
   })
 }

 CKEDITOR.replace( 'about_company', {removePlugins: 'image',});
 CKEDITOR.replace( 'additionalinfo', {removePlugins: 'image',});

</script>
<script src="https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
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
            /** @type {!HTMLInputElement} */(document.getElementById('address')),
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