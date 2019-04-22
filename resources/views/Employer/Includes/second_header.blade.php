<!-- ======================= Start Navigation ===================== -->
               <nav class="navbar navbar-default navbar-mobile navbar-fixed light bootsnav padd-bot-10">
                  <div class="container">
                     <!-- Start Logo Header Navigation -->
                     <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                        <i class="fa fa-bars"></i>
                        </button>
                        <a class="navbar-brand" href="{{url('employer/home')}}">
                        <img src="{{asset('home_assets/img/logo.png')}}" class="logo logo-display" alt="">
                        <img src="{{asset('home_assets/img/logo.png')}}" class="logo logo-scrolled" alt="">
                        </a>
                     </div>
                     <!-- End Logo Header Navigation -->
                     <!-- Collect the nav links, forms, and other content for toggling -->
                     <div class="collapse navbar-collapse" id="navbar-menu">
                        <ul class="nav navbar-nav navbar-right">
                           <li class="sign-up"><a class="btn-signup btn-radius red-btn" href="{{url('employer/home')}}">Dashboard</a></li>
                        </ul>
                     </div>
                     <!-- /.navbar-collapse -->
                  </div>
               </nav>
               <!-- ======================= End Navigation ===================== -->