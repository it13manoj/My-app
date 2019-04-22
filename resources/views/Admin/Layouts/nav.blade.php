<?php

  $role= Auth::user()->user_role;
  $mainid= Auth::user()->id;
//$Moderator= DB::table('user_role')->where('role_usre',$role)->get();
if($role=="Admin"){
$Moderator=DB::table('user_role')
                ->select('user_role.*','parent_menu.parent_id','parent_menu.parent_name','parent_menu.parent_link')
                ->leftjoin('parent_menu','parent_menu.parent_id','=','user_role.role_parent_menu_id')->where('role_usre',$role)->get();
          }else{
            $Moderator=DB::table('modetorrole')
                ->select('modetorrole.*','parent_menu.parent_id','parent_menu.parent_name','parent_menu.parent_link')
                ->leftjoin('parent_menu','parent_menu.parent_id','=','modetorrole.m_parent_id')->where('modetorrole.modetor_id',$mainid)->get();
          }
 ?>
  <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <div class="nav-link">
                <div class="profile-image">
                  <img src="{{asset('admin_assets/images/faces/face10.jpg')}}" alt="image"/>
                  <span class="online-status online"></span> <!--change class online to offline or busy as needed-->
                </div>
                <div class="profile-name">
                  <p class="name">
                   Admin
                  </p>
                  <p class="designation">
                    Super Admin
                  </p>
                </div>
              </div>
            </li>
            @foreach($Moderator as $parent)
            @if($parent->parent_link!='javascript.void(0)')
             <li class="nav-item">
              <a class="nav-link" href="{{route($parent->parent_link)}}">
                <i class="icon-rocket menu-icon"></i>
                <span class="menu-title">{{$parent->parent_name}}</span>
               
              </a>
              </li> 
                @elseif($parent->parent_link=='javascript.void(0)')


                <li class="nav-item">
                @if($parent->parent_name=="User Manager")
              <a class="nav-link collapsed" data-toggle="collapse" href="#page-layouts" aria-expanded="false" aria-controls="page-layouts">
                <i class="icon-people menu-icon"></i>
                <span class="menu-title">{{$parent->parent_name}}</span>
                </a>
                <div class="collapse" id="page-layouts">
                @elseif($parent->parent_name=="Settings")
              <a class="nav-link collapsed" data-toggle="collapse" href="#setting-layouts" aria-expanded="false" aria-controls="setting-layouts">
                <i class="icon-settings menu-icon"></i>
                <span class="menu-title">{{$parent->parent_name}}</span>
              </a>
              <div class="collapse" id="setting-layouts">
                @endif
                  <ul class="nav flex-column sub-menu">
                    <?php 
                    $childid=$parent->parent_id;

                    if($role=="Admin"){
                    $ChildMenu= DB::table('child_menu')->where('child_parent_menu_id',$childid)->where('child_status',1)->get();
                      }else{
                  $ChildMenu=DB::table('employeewiserole')
                ->select('employeewiserole.*','child_menu.child_id','child_menu.child_menu_link','child_menu.child_menu_name')
                ->leftjoin('child_menu','child_menu.child_id','=','employeewiserole.child_id')->where('child_menu.child_status',1)->where('emp_id',$mainid)->where('child_parent_menu_id',$childid)->get();
                  }
                     ?>
                    @foreach($ChildMenu as $ft)
                  <li class="nav-item d-none d-lg-block"> <a class="nav-link" href="@if($ft->child_menu_link!='#'){{route($ft->child_menu_link)}} @elseif($ft->child_menu_link=='#') {{'#'}} @endif">{{$ft->child_menu_name}}</a></li>
                    @endforeach
                 </ul>
              </div>
            </li>
                @endif
            @endforeach

            <!-- <li class="nav-item">
              <a class="nav-link" href="{{route('admin.dashboard')}}">
                <i class="icon-rocket menu-icon"></i>
                <span class="menu-title">Dashboard</span>
               
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('manager.companies')}}">
                <i class="icon-rocket menu-icon"></i>
                <span class="menu-title">Company Manager</span>
               
              </a>
            </li>
           
            <li class="nav-item">
              <a class="nav-link collapsed" data-toggle="collapse" href="#page-layouts" aria-expanded="false" aria-controls="page-layouts">
                <i class="icon-people menu-icon"></i>
                <span class="menu-title">User Manager</span>
              </a>
              <div class="collapse" id="page-layouts">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item d-none d-lg-block"> <a class="nav-link" href="{{route('manager.employers')}}">Employer</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{route('jobseekers')}}">Jobseekers</a></li>
                  <li class="nav-item d-none d-lg-block"> <a class="nav-link" href="#">Consultants</a></li>
                  <li class="nav-item d-none d-lg-block"> <a class="nav-link" href="{{route('moderators')}}">Moderators</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('job_listing')}}">
                <i class="icon-rocket menu-icon"></i>
                <span class="menu-title">Job manager</span>
               
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('admin.dashboard')}}">
                <i class="icon-rocket menu-icon"></i>
                <span class="menu-title">Application manager</span>
               
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('manager.advertisments')}}">
                <i class="icon-rocket menu-icon"></i>
                <span class="menu-title">Advertisment manager</span>
               
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('packages')}}">
                <i class="icon-credit-card menu-icon"></i>
                <span class="menu-title">Package manager</span>
               
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('admin.dashboard')}}">
                <i class="icon-rocket menu-icon"></i>
                <span class="menu-title">Enquiries</span>
               
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('admin.dashboard')}}">
                <i class="icon-rocket menu-icon"></i>
                <span class="menu-title">News Feeds</span>
               
              </a>
            </li>
             <li class="nav-item">
              <a class="nav-link collapsed" data-toggle="collapse" href="#setting-layouts" aria-expanded="false" aria-controls="setting-layouts">
                <i class="icon-settings menu-icon"></i>
                <span class="menu-title">Settings</span>
                
              </a>
              <div class="collapse" id="setting-layouts">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item d-none d-lg-block"> <a class="nav-link" href="{{route('manager.countries')}}">Countries</a></li>
                  <li class="nav-item d-none d-lg-block"> <a class="nav-link" href="{{route('manager.states')}}">State</a></li>
                  <li class="nav-item d-none d-lg-block"> <a class="nav-link" href="{{route('manager.cities')}}">City</a></li>
                  <li class="nav-item d-none d-lg-block"> <a class="nav-link" href="{{route('manager.jobcategories')}}">Job Industry</a></li>
                  <li class="nav-item d-none d-lg-block"> <a class="nav-link" href="{{route('manager.jobsubcategories')}}">Job Functional Area</a></li>
                  <li class="nav-item d-none d-lg-block"> <a class="nav-link" href="{{route('manager.pages')}}">CMS Pages</a></li>
                  
                   <li class="nav-item d-none d-lg-block"> <a class="nav-link" href="{{route('manager.parent')}}">Parent Menu</a></li>

                   <li class="nav-item d-none d-lg-block"> <a class="nav-link" href="{{route('manager.child')}}">Child Menu</a></li>

                   <li class="nav-item d-none d-lg-block"> <a class="nav-link" href="{{route('manager.userrole')}}">User Role</a></li>

                  

                 
                </ul>
              </div>
            </li> -->
            <li class="nav-item">
              <a class="nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                <i class="icon-power menu-icon"></i>
                <span class="menu-title">Logout</span>
               
              </a>
               <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
            </li>
            
          </ul>
        </nav>