<aside class="navbar sticky-top navbar-vertical navbar-expand-lg" data-bs-theme="dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu" aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark">
            <a href="{{ route('home') }}" class="mt-2">
                Yontoko Inventory
            </a>
        </h1>
        <div class="navbar-nav flex-row d-lg-none">
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                    <span class="avatar avatar-sm" style="background-image: url(./static/avatars/000m.jpg)"></span>
                    <div class="d-none d-xl-block ps-2">
                        <div>Paweł Kuna</div>
                        <div class="mt-1 small text-secondary">UI Designer</div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="#" class="dropdown-item">Status</a>
                    <a href="./profile.html" class="dropdown-item">Profile</a>
                    <a href="#" class="dropdown-item">Feedback</a>
                    <div class="dropdown-divider"></div>
                    <a href="./settings.html" class="dropdown-item">Settings</a>
                    <a href="./sign-in.html" class="dropdown-item">Logout</a>
                </div>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav pt-lg-3">

                <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('home') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Home
                        </span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('pos*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('pos.index') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-package">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" />
                                <path d="M12 12l8 -4.5" />
                                <path d="M12 12l0 9" />
                                <path d="M12 12l-8 -4.5" />
                                <path d="M16 5.25l-8 4.5" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            POS
                        </span>
                    </a>
                </li>

                <li class="nav-item dropdown {{ request()->is(['category*', 'product*']) ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Master
                        </span>
                    </a>
                    <div class="dropdown-menu {{ request()->is('category*', 'product*') ? 'show' : '' }}">
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ request()->is('category*') ? 'active' : '' }}" href="{{ route('category.index') }}">
                                    Category
                                </a>
                            </div>
                        </div>
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ request()->is('product*') ? 'active' : '' }}" href="{{ route('product.index') }}">
                                    Product
                                </a>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="nav-item {{ request()->is('users*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('users.index') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            User
                        </span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</aside>
