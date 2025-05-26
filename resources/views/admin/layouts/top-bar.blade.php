 <!-- Topbar Start -->
            <header class="app-topbar" id="header">
                <div class="page-container topbar-menu">
                    <div class="d-flex align-items-center gap-2">

                        <!-- Brand Logo -->
                        <a href="index.html" class="logo">
                            <span class="logo-light">
                                <span class="logo-lg"><img src="{{asset('assets/images/logo.png')}}" alt="logo"></span>
                                <span class="logo-sm"><img src="{{asset('assets/images/logo-sm.png')}}" alt="small logo"></span>
                            </span>

                            <span class="logo-dark">
                                <span class="logo-lg"><img src="{{asset('assets/images/logo-dark.png')}}" alt="dark logo"></span>
                                <span class="logo-sm"><img src="{{asset('assets/images/logo-sm.png')}}" alt="small logo"></span>
                            </span>
                        </a>

                        <!-- Sidebar Menu Toggle Button -->
                        <button class="sidenav-toggle-button">
                            <i class="ri-menu-5-line fs-24"></i>
                        </button>

                        <!-- Horizontal Menu Toggle Button -->
                        <button class="topnav-toggle-button px-2" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                            <i class="ri-menu-5-line fs-24"></i>
                        </button>

                        <!-- Topbar Page Title -->
                        <div class="topbar-item d-none d-md-flex px-2">
                            <div>
                                <h4 class="page-title fs-20 fw-semibold mb-0">@stack('title')</h4>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <!-- Button Trigger Customizer Offcanvas -->
                        <div class="topbar-item d-none d-sm-flex">
                            <button class="topbar-link" data-bs-toggle="offcanvas" data-bs-target="#theme-settings-offcanvas"
                                type="button">
                                <i class="ri-settings-4-line fs-22"></i>
                            </button>
                        </div>

                        <!-- Light/Dark Mode Button -->
                        <div class="topbar-item d-none d-sm-flex">
                            <button class="topbar-link" id="light-dark-mode" type="button">
                                <i class="ri-moon-line light-mode-icon fs-22"></i>
                                <i class="ri-sun-line dark-mode-icon fs-22"></i>
                            </button>
                        </div>

                        <!-- User Dropdown -->
                        <div class="topbar-item nav-user">
                            <div class="dropdown">
                                <a class="topbar-link dropdown-toggle drop-arrow-none px-2" data-bs-toggle="dropdown"
                                    data-bs-offset="0,19" type="button" aria-haspopup="false" aria-expanded="false">
                                    <img src="{{asset('assets/images/users/avatar-1.jpg')}}" width="32" class="rounded-circle me-lg-2 d-flex"
                                        alt="user-image">
                                    <span class="d-lg-flex flex-column gap-1 d-none">
                                        <h5 class="my-0">{{auth()->user()->name}}</h5>
                                    </span>
                                    <i class="ri-arrow-down-s-line d-none d-lg-block align-middle ms-1"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <!-- item-->
                                    <div class="dropdown-header noti-title">
                                        <h6 class="text-overflow m-0">Welcome !</h6>
                                    </div>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <i class="ri-account-circle-line me-1 fs-16 align-middle"></i>
                                        <span class="align-middle">My Account</span>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <!-- item-->
                                    <a href="{{route('admin.logout')}}" class="dropdown-item active fw-semibold text-danger">
                                        <i class="ri-logout-box-line me-1 fs-16 align-middle"></i>
                                        <span class="align-middle">Sign Out</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- Topbar End -->
            <!-- Search Modal -->
            <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form>
                            <div class="px-3 py-2 d-flex flex-row align-items-center" id="top-search">
                                <i class="ri-search-line fs-22"></i>
                                <input type="search" class="form-control bg-transparent fs-16 border-0" id="search-modal-input"
                                    placeholder="Search for actions, people,">
                                <button type="submit" class="btn p-0" data-bs-dismiss="modal" aria-label="Close">[esc]</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
