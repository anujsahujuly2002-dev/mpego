 <!-- Menu -->
            <!-- Sidenav Menu Start -->
            <div class="sidenav-menu">
                <!-- Brand Logo -->
                <a href="{{route('admin.dashboard')}}" class="logo">
                    <span class="logo-light">
                        <span class="logo-lg"><img src="{{asset('assets/images/logo.png')}}" alt="logo"></span>
                        <span class="logo-sm"><img src="{{asset('assets/images/logo-sm.png')}}" alt="small logo"></span>
                    </span>

                    <span class="logo-dark">
                        <span class="logo-lg"><img src="{{asset('assets/images/logo-dark.png')}}" alt="dark logo"></span>
                        <span class="logo-sm"><img src="{{asset('assets/images/logo-sm.png')}}" alt="small logo"></span>
                    </span>
                </a>

                <!-- Sidebar Hover Menu Toggle Button -->
                <button class="button-sm-hover">
                    <i class="ri-circle-line align-middle"></i>
                </button>

                <!-- Full Sidebar Menu Close Button -->
                <button class="button-close-fullsidebar">
                    <i class="ti ti-x align-middle"></i>
                </button>

                <div data-simplebar>

                    <!--- Sidenav Menu -->
                    <ul class="side-nav">
                        <li class="side-nav-title">
                            Menu
                        </li>

                        <li class="side-nav-item">
                            <a href="{{route('admin.dashboard')}}" class="side-nav-link">
                                <span class="menu-icon"><i class="ti ti-dashboard"></i></span>
                                <span class="menu-text"> Dashboard </span>
                                {{-- <span class="badge bg-danger rounded-pill">9+</span> --}}
                            </a>
                        </li>
                        {{-- @canany(['permission-delete', 'permission-edit', 'permission-create','permisson-list','role-delete', 'role-edit', 'role-create','role-list']) --}}
                            <li class="side-nav-item @if (in_array(request()->route()->getName(),['admin.permissions.index','admin.permissions.create','admin.roles.index','admin.roles.create','admin.roles.edit'])) active @endif">
                                <a data-bs-toggle="collapse" href="#sidebarInvoice" aria-expanded="false" aria-controls="sidebarInvoice" class="side-nav-link">
                                    <span class="menu-icon"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user-cog"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h2.5" /><path d="M19.001 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M19.001 15.5v1.5" /><path d="M19.001 21v1.5" /><path d="M22.032 17.25l-1.299 .75" /><path d="M17.27 20l-1.3 .75" /><path d="M15.97 17.25l1.3 .75" /><path d="M20.733 20l1.3 .75" /></svg></span>
                                    <span class="menu-text">Role & Permission</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse  @if (in_array(request()->route()->getName(),['admin.permissions.index','admin.permissions.create','admin.roles.create','admin.roles.edit'])) show @endif" id="sidebarInvoice">
                                    <ul class="sub-menu">
                                        @canany(['role-delete', 'role-edit', 'role-create','role-list'])
                                            <li class="side-nav-item">
                                                <a href="{{route('admin.roles.index')}}" class="side-nav-link @if(in_array(request()->route()->getName(),['admin.roles.index','admin.roles.create','admin.roles.edit'])) active @endif">
                                                    <span class="menu-text">Role</span>
                                                </a>
                                            </li>
                                        @endcanany
                                        @canany(['permission-delete', 'permission-edit', 'permission-create','permission-list'])
                                            <li class="side-nav-item">
                                                <a href="{{route('admin.permissions.index')}}" class="side-nav-link @if(in_array(request()->route()->getName(),['admin.permissions.index','admin.permissions.create'])) active @endif"">
                                                    <span class="menu-text">Permission</span>
                                                </a>
                                            </li>
                                        @endcanany
                                    </ul>
                                </div>
                            </li>
                        {{-- @endcanany --}}
                        <li class="side-nav-item" >
                            <a href="{{route('admin.users.index')}}" class="side-nav-link">
                                <span class="menu-icon"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-users-group"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" /><path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M17 10h2a2 2 0 0 1 2 2v1" /><path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M3 13v-1a2 2 0 0 1 2 -2h2" /></svg></span>
                                <span class="menu-text">Users </span>
                            </a>
                        </li>

                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- Sidenav Menu End -->
