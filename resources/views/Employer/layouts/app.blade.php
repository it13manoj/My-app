<?php 
$headerWeb = json_decode(file_get_contents(public_path('website/web-setting.info')),true);
$headerFavicon = url('/website/favicon.ico');
if(file_exists('/website/'.$headerWeb['webFavicon'])){
    $headerFavicon = url('/website/'.$headerWeb['webFavicon']);
}

$navPage =  Request::segment(2);
$navp=Request::segment(1);
$app = Session::get('jcmUser');
$next = Request::route()->uri;
?>
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
               <title>@yield('title') &raquo; {{ $headerWeb['webTitle'] }}</title>

               <!-- Bootstrap Core CSS -->
               <link rel="stylesheet" href="{{asset('home_assets/plugins/bootstrap/css/bootstrap.min.css')}}">

               <!-- Bootstrap Select Option css -->
               <link rel="stylesheet" href="{{asset('home_assets/plugins/bootstrap/css/bootstrap-select.min.css')}}">
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
               <!-- Banner CSS -->
               <link rel="stylesheet" href="{{asset('home_assets/css/swiper.min.css')}}">
               <script src="{{asset('home_assets/js/swiper.min.js')}}"></script>
               <link href="{{asset('home_assets/plugins/date-dropper/datedropper.css')}}" rel="stylesheet">
                 <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">

  
               <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
               <!--[if lt IE 9]>
               <script src="js/html5shiv.min.js"></script>
               <script src="js/respond.min.js"></script>
               <![endif]--> 
               
            </head>

            
            <!--  <body v-if="['login', 'register'].includes($route.name)" id="signin" >
             <body v-else> -->
              <body>
            
                @if($navPage=='edit_employer' || $navPage=='edit_organization')
                @include('Employer.Includes.second_header')
                @elseif($navp=='verifyUser')
               
                @else
                @include('Employer.Includes.header')
                @endif
                @yield('content')
                @include('Employer.Includes.footer')
              
            
             
               <!-- =================== START JAVASCRIPT ================== -->
               <!-- Jquery js-->
               <script src="{{asset('home_assets/js/jquery.min.js')}}"></script>
                <script type="text/javascript">
                 window.Laravel = <?php echo json_encode([
                          'csrfToken' => csrf_token(),
                          'base_url'=>'{{url("/")}}'
                      ]); ?>   
               </script>
              <!--  <script src="{{ mix('js/app.js') }}"></script> -->
               <!-- Bootstrap js-->
               <script src="{{asset('home_assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
               <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
               <!-- Bootsnav js-->
               <script src="{{asset('home_assets/plugins/bootstrap/js/bootsnav.js')}}"></script>
               <script src="{{asset('home_assets/js/viewportchecker.js')}}"></script>
               <!-- Slick Slider js-->
               <script src="{{asset('home_assets/plugins/slick-slider/slick.js')}}"></script>
               <!-- wysihtml5 editor js -->
               <script src="{{asset('home_assets/plugins/bootstrap/js/wysihtml5-0.3.0.js')}}"></script>
               <script src="{{asset('home_assets/plugins/bootstrap/js/bootstrap-wysihtml5.js')}}"></script>
               <!-- Aos Js -->
               <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
               <script src="{{asset('home_assets/plugins/aos-master/aos.js')}}"></script>
               <!-- Nice Select -->
              <!--  <script src="{{asset('home_assets/plugins/nice-select/js/jquery.nice-select.min.js')}}"></script> -->
               <!-- Custom Js -->
               <script src="{{asset('home_assets/js/custom.js')}}"></script>
              
               <script src="{{asset('home_assets/js/additional.js')}}"></script>

               <script src="{{asset('home_assets/js/multiselect.js')}}"></script>
               <!-- Date dropper js-->
               <script src="{{asset('home_assets/plugins/date-dropper/datedropper.js')}}"></script>
               <!-- counter Js -->
               <script src="{{asset('home_assets/js/counter.js')}}" type="text/javascript"></script>
               <script>
      $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
      });
    </script>
               @yield('page-footer')
            </body>
         </html>