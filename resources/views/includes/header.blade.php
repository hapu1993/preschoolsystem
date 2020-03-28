<header>
    <!-- Sidebar navigation -->
    <div id="slide-out" class="side-nav sn-bg-4 fixed">
        <ul class="custom-scrollbar">






            <!-- Side navigation links -->
            <li>
                <ul class="collapsible collapsible-accordion">
                    <li><a class="collapsible-header waves-effect arrow-r"></i><i class="fas fa-list-ul"></i>My Class<i
                                class="fas fa-angle-down rotate-icon"></i></a>
                        <div class="collapsible-body">
                            <ul class="list-unstyled">
                                <li><a href="#" class="waves-effect">Homework</a>
                                </li>
                                <li><a href="#" class="waves-effect">Activity</a>
                                </li>
                                <li><a href="{{route('attendence')}}" class="waves-effect">Attendence</a>
                                </li>
                                <li><a href="{{route('home')}}" class="waves-effect">Attendence view</a>
                                </li>
                                <li><a href="#" class="waves-effect">Performance</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li><a class="collapsible-header waves-effect arrow-r"><i class="far fa-comments"></i></i> Chat box</a>
                    </li>

                    <li><a class="collapsible-header waves-effect arrow-r"><i class="fas fa-envelope"></i></i>Notification</a>
                    </li>

                    <li><a class="collapsible-header waves-effect arrow-r"><i class="fas fa-child"></i></i> My Student<i class="fas fa-angle-down rotate-icon"></i></a>
                        <div class="collapsible-body">
                            <ul class="list-unstyled">
                                <li><a href="#" class="waves-effect">List of Student</a>
                                </li>
                                <li><a href="#" class="waves-effect">View profile</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                </ul>
            </li>
            <!--/. Side navigation links -->
        </ul>
        <div class="sidenav-bg mask-strong"></div>
    </div>
    <!--/. Sidebar navigation -->
    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-toggleable-md navbar-expand-lg scrolling-navbar double-nav blue-gradient" style="background-color: #d500f9">
        <!-- SideNav slide-out button -->
        <div class="float-left">
            <a href="#" data-activates="slide-out" class="button-collapse white-text"><i class="fas fa-bars"></i></a>
        </div>
        <!-- Breadcrumb-->
        <div class="breadcrumb-dn mr-auto">
            <p class="h4 white-text">Pre-school Management System - {{isset($page_title) ? $page_title : ''}}</p>
        </div>
        <ul class="nav navbar-nav nav-flex-icons ml-auto">
            <li class="nav-item">
                <a class="nav-link"><i class="fas fa-envelope white-text"></i> <span class="clearfix d-none d-sm-inline-block white-text">Notification</span></a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle white-text" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Log out</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a class="dropdown-item" href="#">Edit profile</a>
                </div>
            </li>
        </ul>
    </nav>
    <!-- /.Navbar -->
</header>
