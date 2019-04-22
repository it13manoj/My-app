<nav class="navbar navbar-default navbar-mobile navbar-fixed light bootsnav">
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
                        <ul class="nav navbar-nav navbar-left" data-in="fadeInDown" data-out="fadeOutUp">
                           <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Home</a>
                              <ul class="dropdown-menu animated fadeOutUp">
                                 <li><a href="{{url('/')}}">Home </a></li>
                                 <li><a href="aboutus.html">About Us</a></li>
                                 <li><a href="faqs.html">FAQs</a></li>
                                 <li><a href="contactus.html">Contact Us</a></li>
                                 <li><a href="tnc.html">Terms and Conditions</a></li>
                              </ul>
                           </li>
                           @if(Auth::user())
                           <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Employer</a>
                              <ul class="dropdown-menu animated fadeOutUp">
                                 <li><a href="{{route('post_new_job')}}">Post Job</a></li>
                                 <li><a href="{{route('manage_jobs')}}">Manage Jobs</a></li>
                                 <li><a href="{{route('questionnaire')}}">Questionnaires</a></li>
                                 <li><a href="{{route('venues')}}">Venues</a></li>
                                <!--  <li><a href="#">Search for right candidate</a></li>
                                 <li><a href="#">Get Screened candidates</a></li>
                                 <li><a href="#">Assistance for Campus placements/recruitment drive/Walk-ins</a></li>
                                 <li><a href="#">Branding: Company portfolio display</a></li>
                                 <li><a href="#">Cater your manpower free of cost</a></li>
                                 <li><a href="#">Online assessment of candidates</a></li>
                                 
                                 <li><a href="#">Video profile display</a></li> -->
                              </ul>
                           </li>
                           <li><a href="{{route('packagepricing')}}">Packages</a></li>
                           @endif
                           <!-- <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Candidate</a>
                              <ul class="dropdown-menu animated fadeOutUp">
                                 <li><a href="job-listing.html">Job Search</a></li>
                                 <li><a href="job-listing-2.html">Browse All Jobs</a></li>
                                 <li><a href="#">Self Assessment/Skill development</a></li>
                                 <li class="dropdown">
                                    <a href="#">Career Services <i class="fa fa-angle-right pull-right"></i></a>
                                    <ul class="dropdown-menu animated fadeOutUp">
                                       <li><a href="#">Audio Resumes/Video Resumes</a></li>
                                       <li><a href="#">Resume development(Premium)</a></li>
                                       <li><a href="#">Career Advice</a></li>
                                       <li><a href="#">Interview preparation</a></li>
                                       <li><a href="#">Salary Advice</a></li>
                                       <li><a href="#">Job search techniques</a></li>
                                       <li><a href="#">Job questionnaires</a></li>
                                       <li><a href="#">Tips for Freshers/MBA /Engineers/Non-IT</a></li>
                                    </ul>
                                 </li>
                              </ul>
                           </li> -->
                           
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                          @if(Auth::user())
                            <li class="sign-up"><a href="javascript:void(0)"><sup><div class="circle-ripple set-circle"></div></sup><i class="ti-bell padd-r-15"></i></a></li>
                            <li class="dropdown sign-up">
                        <a class="dropdown-toggle " data-toggle="dropdown" href="javascript:;" >
                           @if(Auth::user()->user_profile_pic_thumb!='')
                            <img class="img-responsive img-circle" src="{{asset('admin_assets/uploaded_images/profile_pic/thumb/'.Auth::user()->user_profile_pic_thumb)}}" alt="">
                           @else
                              <img class="img-responsive img-circle" src="{{asset('admin_assets/images/profile-default.png')}}" alt="">
                           @endif

                        </a>
                        
                        <ul  class="dropdown-menu animated fadeOutUp">
                           <li class="menu-per-info">
                              <p class="margin-bottom-0">
                                 <span>{{ucfirst(Auth::user()->user_first_name)}} {{ucfirst(Auth::user()->user_last_name)}}</span>
                                 <span>{{substr(Auth::user()->email,0,20)}}@if(strlen(Auth::user()->email)>20)...@endif</span>
                                 <span>Last Login: {{date('M d,Y',strtotime(Auth::user()->last_login))}}</span>
                              </p>
                           </li>
                           <li><a href="{{url('employer/home')}}">View Dashboard</a></li>
                           <li><a href="{{route('myInterview')}}">My Interview</a></li>
                           <li><a href="{{url('employer/user/'.Auth::user()->user_slug)}}">View Profile</a></li>
                           <li><a href="{{url('employer/edit_employer')}}">Edit Profile</a></li>

                           <li><a href="{{route('edit_organization')}}">Edit Organization</a></li>
                           <li id="app1"><a @click="logout" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Sign Out</a></li>
                                                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                        </ul>
                     </li>  
                     @else
                          <!--  <li class="sign-up"><a class="btn-signup btn-radius red-btn" href="signup.html">Sign in/Sign up</a></li> -->
                          <li class="sign-up"><a href="{{url('/')}}/userlogin" class="btn-signup btn-radius red-btn">Sign in</a></li>
             <li v-if="!islogin" class="sign-up"><a  href="{{url('/')}}/registration" class="btn-signup btn-radius red-btn">Sign up</a></li>
              @endif
                        </ul>
                      
                     
                     </div>
                     <!-- /.navbar-collapse -->
                  </div>
                 <!--  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue-session@1.0.0/index.js"></script>
                  <script type="text/javascript">
                     //import VueSession from 'vue-session';
                     const app2 = new Vue({
                     el: '#app1',
                     created:function()
                     {
                        console.log(this.$session);
                     },
                      methods:{
                        logout:function()
                        {
                           this.$session.destroy()
                            //this.$router.push('/')
                            this.islogin=false
                            this.user_role=''
                            this.user_first_name=''
                            this.user_last_name=''
                            this.email=''
                            this.user_slug=''
                            this.user_last_login=''
                            
                        }
                     }
                     });
                  </script> -->
         </nav>