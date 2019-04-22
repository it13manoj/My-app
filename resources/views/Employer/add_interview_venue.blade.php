@extends('Employer.layouts.app')
@section('title', 'Add Venue')
@section('content')
@if($venue)
      @php $venue_name=$venue->venue_name;
      $venue_id=$venue->venue_id;
      $venue_address=$venue->venue_address;
      $contact_person=$venue->contact_person;
      $contact_email=$venue->contact_email;
      $contact_no=$venue->contact_no;
      $instructions=$venue->instructions;
      @endphp
   @else
   @php  $venue_name='';
      $venue_id=0;
      $venue_address='';
      $contact_person='';
      $contact_email='';
      $contact_no='';
      $instructions='';
      @endphp
   @endif
<section class="padding-top-7">
                  <div class="container">
                     <div class="row">
                        <div class="col-md-12">
                              <!-- General Information -->
                                 <div class="box">
                                    <div class="box-header">
                                       <div class="width-100">
                                          <h4 class="pull-left">Interview Venue </h4>
                                       </div> 
                                    </div>
                                    <div class="box-body">
                                       <form class="c-form" action="{{route('add_venues.submit')}}" method="post">
                                          {{csrf_field()}}
                                          <input type="hidden" name="venue_id" value="{{$venue_id}}">
                                             <div class="row">
                                                <div class="form-group col-sm-4 mrg-bot-10">
                                                   <label>Venue <span>*</span></label>
                                                   <input required name="venue_name" value="{{$venue_name}}" id="venue_name" type="text" class="form-control" > 
                                                   <p class="venue_name_error" > </p>
                                                </div>
                                                <div class="form-group col-sm-8 mrg-bot-10">
                                                   <label>Address <span>*</span></label>
                                                   <input required id="address" name="venue_address" value="{{$venue_address}}" type="text" class="form-control" > 
                                                   <p class="venue_address_error" ></p>
                                                </div>
                                                
                                             </div>
                                             <div class="row">
                                                <div class="form-group col-sm-4 mrg-bot-10">
                                                   <label>Contact Person Name <span>*</span></label>
                                                   <input required type="text" name="contact_person" id="contact_person" value="{{$contact_person}}" class="form-control" > 
                                                   <p class="contact_person_error" ></p>
                                                </div>
                                                <div class="form-group col-sm-4 mrg-bot-10">
                                                   <label>Email <span>*</span></label>
                                                   <input required type="email" name="contact_email" value="{{$contact_email}}" id="contact_email" class="form-control" > 
                                                   <p class="contact_email_error" ></p>
                                                </div>
                                                <div class="form-group col-sm-4 mrg-bot-10">
                                                   <label>Contact Number <span>*</span></label>
                                                   <input oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required type="text" name="contact_no" value="{{$contact_no}}" id="contact_no" class="form-control" > 
                                                   <p class="contact_no_error" ></p>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-sm-12">
                                                      <label>Instruction</label>
                                                      <textarea name="instruction" id="instruction" class="form-control height-120" >{{$instructions}}</textarea>
                                                </div>
                                             </div>
                                          <div class="text-center">
                                             <button type="submit" class="btn btn-m theme-btn right">Submit </button>
                                          </div>
                                          
                                       </div>
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
@endsection
@section('page-footer')
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