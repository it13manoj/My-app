<!DOCTYPE html>

         <html class="no-js" lang="zxx">
            <head>
               <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
               <meta http-equiv="X-UA-Compatible" content="IE=edge">
               <meta name="viewport" content="width=device-width, initial-scale=1.0">
               <meta name="description" content="">
               <meta name="keywords" content="">
               <meta name="robots" content="index,follow">
               <meta name="csrf-token" content="{{ csrf_token() }}">
               <title>{{\Config::get('app.name')}}</title>

               <!-- Bootstrap Core CSS -->
               <link rel="stylesheet" href="{{asset('home_assets/plugins/bootstrap/css/bootstrap.min.css')}}">

               <!-- Bootstrap Select Option css -->
               <link rel="stylesheet" href="{{asset('home_assets/plugins/bootstrap/css/bootstrap-select.min.css')}}">
               <link rel="stylesheet" href="{{asset('css/bootstrap-multiselect.css')}}">
               <!-- Icons -->
               <link href="{{asset('home_assets/plugins/icons/css/icons.css')}}" rel="stylesheet">
               <!-- Nice Select Option css -->
               <link rel="stylesheet" href="{{asset('home_assets/plugins/nice-select/css/nice-select.css')}}">
               <!-- Animate -->
               <link href="{{asset('home_assets/plugins/animate/animate.css')}}" rel="stylesheet">
               <!-- Bootsnav -->
               <link href="{{asset('home_assets/plugins/bootstrap/css/bootsnav.css')}}" rel="stylesheet">
               <!-- Aos Css -->
               <link href="{{asset('home_assets/plugins/aos-master/aos.css')}}" rel="stylesheet">
               <!-- Slick Slider -->
               <link href="{{asset('home_assets/plugins/slick-slider/slick.css')}}" rel="stylesheet">
               <!-- Custom style -->
               <link href="{{asset('home_assets/css/style.css')}}" rel="stylesheet">
               <link href="{{asset('home_assets/css/responsiveness.css')}}" rel="stylesheet">
               <link href="{{asset('home_assets/css/changes.css')}}" rel="stylesheet">
               <!-- Custom Color -->
               <link href="{{asset('home_assets/css/skin/default.css')}}" rel="stylesheet">
               <link href="{{asset('home_assets/plugins/date-dropper/datedropper.css')}}" rel="stylesheet">
               <!-- Banner CSS -->
               <link rel="stylesheet" href="{{asset('home_assets/css/swiper.min.css')}}">
               <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css">
               <script src="{{asset('home_assets/js/swiper.min.js')}}"></script>
               <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>

               <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
               <!--[if lt IE 9]>
               <script src="js/html5shiv.min.js"></script>
               <script src="js/respond.min.js"></script>
               <![endif]--> 
               <style type="text/css">
                  .loader {
                    width: 100%;
                    height: 100%;
                    top: 0px;
                    left: 0px;
                    position: fixed;
                    display: block;
                    opacity: 0.7;
                    background-color: #fff;
                    z-index: 1000000;
                    text-align: center;
                    }
                    
                    .loading-text {
                    position: relative;
                    top: 36%;
                    color: #000;
                    z-index: 100;
                    text-align: center;
                    }
                    

               </style>
            </head>

            
            <!--  <body v-if="['login', 'register'].includes($route.name)" id="signin" >
             <body v-else> -->
              <body>
              <div  style="display:none;" class="loader">
      <div style="
         position: relative;
         top: 38%;
         z-index: 100;
         text-align: center;
         ">
         <img class="loading-image" src="{{asset('admin_assets/loading.gif')}}" alt="Loading..." />
      </div>
      <h2 class="loading-text">Loading Please Wait...</h2>
   </div>
           
                <div id="app">
                  
                    <webheader v-if="!['cahngepassword','forgotpass','userlogin', 'registration','candidate_registration','user_profile/personalinfo','user_profile/professionaldetails','user_profile/educationaldetails','user_profile/certificationdetails','user_profile/skillsdetails','user_profile/resume'].includes($route.name)"></webheader>
                     <webheaderprofile v-if="['user_profile/personalinfo','user_profile/educationaldetails','user_profile/professionaldetails','user_profile/certificationdetails','user_profile/skillsdetails','user_profile/resume'].includes($route.name)"></webheaderprofile>
                    
                    <router-view></router-view>
                    <webfooter v-if="!['cahngepassword','forgotpass','userlogin', 'registration','candidate_registration'].includes($route.name)"></webfooter>
                </div> 
              
            
             
               <!-- =================== START JAVASCRIPT ================== -->
               <!-- Jquery js-->
               <script src="{{asset('home_assets/js/jquery.min.js')}}"></script>
              <script type="text/javascript">
                window.Laravel = <?php echo json_encode([
                          'csrfToken' => csrf_token(),
                          'baseUrl' => url('/'),
                          'appName'=> \Config::get('app.name')
                      ]); ?>   
              </script>
               <script src="{{ mix('js/app.js') }}"></script>
               <!-- Bootstrap js-->
               <script src="{{asset('home_assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
               <script src="{{asset('js/bootstrap-multiselect.js')}}"></script>
               <!-- Bootsnav js-->
               <script src="{{asset('home_assets/plugins/bootstrap/js/bootsnav.js')}}"></script>
               <script src="{{asset('home_assets/js/viewportchecker.js')}}"></script>
               <!-- Slick Slider js-->
               <script src="{{asset('home_assets/plugins/slick-slider/slick.js')}}"></script>
               <!-- wysihtml5 editor js -->
               <script src="{{asset('home_assets/plugins/bootstrap/js/wysihtml5-0.3.0.js')}}"></script>
               <script src="{{asset('home_assets/plugins/bootstrap/js/bootstrap-wysihtml5.js')}}"></script>
               <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
               <!-- Aos Js -->
               <script src="{{asset('home_assets/plugins/aos-master/aos.js')}}"></script>
               <!-- Nice Select -->
              <!--  <script src="{{asset('home_assets/plugins/nice-select/js/jquery.nice-select.min.js')}}"></script> -->
               <!-- Custom Js -->
               <script src="{{asset('home_assets/js/custom.js')}}"></script>
               <script src="{{asset('home_assets/js/additional.js')}}"></script>
               <!-- counter Js -->
               <script src="{{asset('home_assets/js/counter.js')}}" type="text/javascript"></script>
               <script src="{{asset('home_assets/plugins/date-dropper/datedropper.js')}}"></script>

               <!-- <script src="{{ asset('assets/js/multiselect_industry.js') }}"></script> -->
               <script>
                  AOS.init();
               </script>
               <script>
                  var swiper = new Swiper('.swiper-container', {
                      pagination: '.swiper-pagination',
                      paginationClickable: true,
                      nextButton: '.swiper-button-next',
                      prevButton: '.swiper-button-prev',
                      spaceBetween: 30,
                      autoplay: false,
                      autoplayDisableOnInteraction: false
                  });
                  function playVideo(){
                       var background_video = document.getElementById("background_video");
                       background_video.play().catch(); 
                  }


                       
               </script>
                 <script>
                   $(document).ready(function () {
                  $('.date-from').datepicker({
                     endDate: new Date(),
                  });
                });
                   $(document).on('focus','.date-from', function(){
                          //$(this).datepicker();
                          $(this).datepicker();
                       });
                </script>
                <script type="text/javascript">
                  /*$(function () {
                          $('select[multiple].active.3col').multiselect({
                              columns: 1,
                              placeholder: 'Select',
                              search: true,
                              searchOptions: {
                                  'default': 'Search'
                              },
                              selectAll: true
                          });

                      });*/
                  </script>
            </body>
         </html>