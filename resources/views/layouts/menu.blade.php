<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
        <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    <nav class="vertnav navbar navbar-light">
        <!-- nav bar -->
        <div class="w-100 mb-4 d-flex">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="{{ route('home') }}">
                <img src="{{ asset('logo_lab.png') }}" alt="Logo" class="img-fluid"
                    style="border-radius: 15px; width: 80px; height: 80px;">
            </a>
        </div>
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item ">
                <a href="{{ route('home') }}" class="nav-link">
                    <i class="fe fe-home fe-16"></i>
                    <span class="ml-3 item-text">Dashboard</span><span class="sr-only">(current)</span>
                </a>

            </li>
        </ul>
        <p class="text-muted nav-heading mt-4 mb-1">
            <span>Features</span>
        </p>
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
                <a class="nav-link" href="{{ route('members.index') }}">
                    <i class="fe fe-users fe-16"></i> <!-- Ikon untuk "Members" -->
                    <span class="ml-3 item-text">Members</span>
                </a>
            </li>

            <li class="nav-item w-100">
                <a class="nav-link" href="{{ route('banners.index') }}">
                    <i class="fe fe-image fe-16"></i> <!-- Ikon untuk "Banner" -->
                    <span class="ml-3 item-text">Banner</span>
                </a>
            </li>

            <li class="nav-item w-100">
                <a class="nav-link" href="{{ route('project') }}">
                    <i class="fe fe-briefcase fe-16"></i> <!-- Ikon untuk "Project" -->
                    <span class="ml-3 item-text">Project</span>
                </a>
            </li>

            <li class="nav-item w-100">
                <a class="nav-link" href="{{ route('mitras.index') }}">
                    <i class="fe fe-thumbs-up fe-16"></i> <!-- Ikon untuk "Mitra" -->
                    <span class="ml-3 item-text">Mitra</span>
                </a>
            </li>

        </ul>
    </nav>
</aside>
