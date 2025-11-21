<!-- Left Sidebar Start -->
<div class="app-sidebar-menu">
    <div class="h-100" data-simplebar>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <div class="logo-box">
                <a href="{{ route('dashboard') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('backend/assets/images/logo-light.png') }}" alt="" height="24">
                    </span>
                </a>
                <a href="{{ route('dashboard') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('backend/assets/images/logo-dark.png') }}" alt="" height="24">
                    </span>
                </a>
            </div>

            {{-- menu --}}
            <ul id="side-menu">

                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{ route('dashboard') }}" class="tp-link">
                        <i data-feather="home"></i>
                        <span> Dashboard </span>
                    </a>
                </li>

                <li class="menu-title">Pages</li>

                <li>
                    <a href="#sidebarAuth" data-bs-toggle="collapse">
                        <i data-feather="users"></i>
                        <span> Review Setup </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarAuth">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.review') }}" class="tp-link">All Review</a>
                            </li>
                            <li>
                                <a href="{{ route('add.review') }}" class="tp-link">Add Review</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sliderAuth" data-bs-toggle="collapse">
                        <i data-feather="users"></i>
                        <span> Slider Setup </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sliderAuth">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('get.slider') }}" class="tp-link">Get Slider</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarError" data-bs-toggle="collapse">
                        <i data-feather="alert-octagon"></i>
                        <span> Feature Setup </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarError">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.feature') }}" class="tp-link">All Feature</a>
                            </li>
                            <li>
                                <a href="{{ route('add.feature') }}" class="tp-link">Add Feature</a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#clarifiesAuth" data-bs-toggle="collapse">
                        <i data-feather="users"></i>
                        <span> Clarifies Setup </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="clarifiesAuth">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('get.clarifies') }}" class="tp-link">Get Clarifies</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#financialAuth" data-bs-toggle="collapse">
                        <i data-feather="users"></i>
                        <span> Financial Setup </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="financialAuth">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('get.financial') }}" class="tp-link">Get Financial</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#usabilityAuth" data-bs-toggle="collapse">
                        <i data-feather="users"></i>
                        <span> Usability Setup </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="usabilityAuth">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('get.usability') }}" class="tp-link">Get Usability</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#connectAuth" data-bs-toggle="collapse">
                        <i data-feather="users"></i>
                        <span> Connect Setup </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="connectAuth">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.connect') }}" class="tp-link">All Connect</a>
                            </li>
                            <li>
                                <a href="{{ route('add.connect') }}" class="tp-link">Add Connect</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#faqAuth" data-bs-toggle="collapse">
                        <i data-feather="users"></i>
                        <span> Faq's Setup </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="faqAuth">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.faqs') }}" class="tp-link">All Faq's</a>
                            </li>
                            <li>
                                <a href="{{ route('add.faqs') }}" class="tp-link">Add Faq's</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#teamAuth" data-bs-toggle="collapse">
                        <i data-feather="users"></i>
                        <span> Team's Setup </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="teamAuth">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.team') }}" class="tp-link">All Team's</a>
                            </li>
                            <li>
                                <a href="{{ route('add.team') }}" class="tp-link">Add Team</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#aboutAuth" data-bs-toggle="collapse">
                        <i data-feather="users"></i>
                        <span> About Setup </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="aboutAuth">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('get.about') }}" class="tp-link">Get About</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#categoryAuth" data-bs-toggle="collapse">
                        <i data-feather="users"></i>
                        <span> Blog Category Setup </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="categoryAuth">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.blog.category') }}" class="tp-link">All Blog Category</a>
                            </li>
                            <li>
                                <a href="{{ route('add.blog.category') }}" class="tp-link">Add Blog Category</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="menu-title mt-2">General</li>

                <li>
                    <a href="widgets.html" class="tp-link">
                        <i data-feather="aperture"></i>
                        <span> Widgets </span>
                    </a>
                </li>

            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
</div>
<!-- Left Sidebar End -->
