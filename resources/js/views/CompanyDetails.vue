 <template>
 	<div>
 <div class="clearfix"></div>
         <!-- ================ Job Detail Basic Information ======================= -->
         <section id="company_detail_banner" class="detail-section" v-bind:style="{ 'background-image': 'url('+baseUrl+'/admin_assets/uploaded_images/company_pic/'+companies.company_cover_image+')' }">
            <div class="overlay"></div>
            <div class="profile-cover-content">
               <div class="container">
                  <div class="cover-buttons">
                     <ul class="margin-bottom-0">
                        <li>
                           <div class="buttons medium button-plain "><i class="fa fa-phone"></i><span class="ver-ali">{{companies.company_contact}}</span></div>
                        </li>
                        <li>
                           <div class="buttons medium button-plain "><i class="fa fa-map-marker"></i><span class="ver-ali">{{companies.company_address}}</span></div>
                        </li>
                        <li>
                           <div class="buttons medium button-plain "><i class=" ti-world"></i><span class="ver-ali">{{companies.company_website}}</span></div>
                        </li>
                        <li>
                           <div class="buttons medium button-plain "><i class="ti-email"></i><span class="ver-ali">{{companies.company_email}}</span></div>
                        </li>
                     </ul>
                  </div>
                  <div class="job-owner hidden-xs hidden-sm">
                     <div class="job-owner-avater">
                        <img :src="baseUrl+'/admin_assets/uploaded_images/company_pic/thumb/'+companies.company_logo" class="img-responsive img-circle" alt="" />
                     </div>
                     <div class="job-owner-detail">
                        <h4>{{companies.company_name}}</h4>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- ================ End Job Detail Basic Information ======================= -->
         <!-- company full detail End -->
         <section class="padding-top-7">
            <div class="container">
               <!-- row -->
                <div class="row">
	                <div class="col-md-12 col-sm-12">
	                    
	                    <div class="text-center company1">
	                        <div class="">
	                           <h4>We at {{companies.company_name}}</h4>
	                        </div>
	                        <div class="text-justify" v-html="companies.company_about">
	                           
	                        </div>
	                    </div>
	                    <div class="clearfix"></div>
	                    <div class="clearfix"></div> 
	                    <div class="text-center company1">
	                    	<div class="">
	                           <h4>Company Location</h4>
	                        </div>
	                    	<div class="">
	                    		<div class="col-md-12 col-sm-12">
							
    
    <gmap-map ref="mymap" class="padd-bot-40"  :center="startLocation" :zoom="14" style="width: 100%; height: 300px">

      <!-- <gmap-info-window :options="infoOptions" :position="infoPosition" :opened="infoOpened" @closeclick="infoOpened=false">
        {{infoContent}}
      </gmap-info-window> -->

      <gmap-marker  :position="getPosition()" :clickable="true"  />

    </gmap-map>
								</div>
	                    	</div>
	                    </div>
	                    <div class="text-center company1 " v-if="companies&&companies.otherimages">
	                        <div class="">
	                           <h4>Life at {{companies.company_name}}</h4>
	                        </div>
	                        <div class="">
	                           <div class="col-md-12">
					               <div class="row">
					                  <div class="gal">
					                     <img v-for="imgss in companies.otherimages" v-if="imgss!='' && imgss!=null" :src="baseUrl+'/admin_assets/uploaded_images/company_pic/gallery/'+imgss" :alt="companies.company_name">
					                  </div>
					               </div>
		            			</div>
	                        </div>
	                    </div>   
	                </div>
	                
               </div>
            </div>
            <!-- End Row -->
         </section>
      </div>
  </template>
  <script>
 import * as VueGoogleMaps from "vue2-google-maps";
// import GoogleMap from './GoogleMap' 
     export default {
      name: "GoogleMap",
        data: () => ({
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            companies:{},
            baseUrl:Laravel.baseUrl,
            
            test:'test',
             startLocation: {
                lat: 10.3157,
                lng: 123.8854
              },
          }),
        mounted() {
            //this.geolocate();
          },  
        async beforeMount()
         {
            await this.getcompanydetails();
            document.title = Laravel.appName+' | Company Details'
         },
         created: function () {

         },
         methods:{
          getPosition: function() {
            //  alert(this.companies.company_lat);
              //alert(parseFloat(this.companies.company_lat));
              return {
                lat: parseFloat(this.companies.company_lat),
                lng: parseFloat(this.companies.company_long)
              } 
            },
            getcompanydetails:function(e)
            {
            	var serff=this;
            	var pathArray=window.location.pathname.split('/');
               var company_slug = pathArray[2];
                  axios
                 .get(Laravel.baseUrl+'/getcompanydetails?access_token='+btoa(company_slug))
                 .then(response => {
                  serff.companies=response.data;
                  document.title = Laravel.appName+' | '+serff.companies.company_name;
                  //serff.showmap(serff.companies.company_address);
                  serff.locations=serff.companies.company_address;
                  
                    var l=0;
                      $.each(serff.companies, function(i, elem) {
                          l++;
                      });
                  serff.test=l;
                  serff.startLocation.lat=parseFloat(serff.companies.company_lat);
            serff.startLocation.lng=parseFloat(serff.companies.company_long);
                      //alert(l);
                  //$("#gmapin").val(serff.companies.company_address);
                  })
            },
         }
    }

</script>