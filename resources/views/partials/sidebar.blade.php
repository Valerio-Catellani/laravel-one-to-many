<nav id='sidebar' class=" navbar-dark position-relative sidebar-risize">
    <button id="hype-sidebar-collapse" class="default-button text-white position-absolute"><i
            class="fa-solid fa-caret-left fs-1 hype-text-collapse"></i><i
            class="fa-solid fa-caret-right fs-1 d-none hype-text-collapse"></i></button>
    <a href="/" class="nav-link text-white d-flex p-3">
        <div class="logo-img-container d-flex align-items-center">
            <img class="img-fluid hype-color-invert py-3" src={{ asset('images/portfolio-logo.png') }} alt="logo">
        </div>
        <h2 class="p-3 hype-text-collapse">Portfolio </h2>
    </a>
    <ul class="nav flex-column">
        <li class="nav-item {{ Route::currentRouteName() === 'admin.dashboard' ? 'active' : '' }}">
            <a class="nav-link text-white " aria-current="page" href="{{ route('admin.dashboard') }}"><i
                    class="fa-solid fa-home fs-4 pe-3"></i><span class="hype-text-collapse">Home</span></a>
        </li>
        <li
            class="nav-item {{ (Route::currentRouteName() === 'admin.projects.index' || Route::currentRouteName() === 'admin.projects.create' ? 'active' : Route::currentRouteName() === 'admin.projects.update') ? 'active' : '' }}">
            <a class="nav-link text-white " aria-current="page" href="{{ route('admin.projects.index') }}"><i
                    class="fa-solid fa-book-open fs-4 pe-3"></i><span class="hype-text-collapse">Projects</span></a>
        </li>
        <li
            class="nav-item {{ (Route::currentRouteName() === 'admin.categories.index' || Route::currentRouteName() === 'admin.projects.create' ? 'active' : Route::currentRouteName() === 'admin.projects.update') ? 'active' : '' }}">
            <a class="nav-link text-white " aria-current="page" href="{{ route('admin.categories.index') }}"><i
                    class="fa-solid fa-book-open fs-4 pe-3"></i><span class="hype-text-collapse">Categories</span></a>
        </li>
    </ul>
</nav>
