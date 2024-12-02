<nav class="topnav navbar navbar-light">
    <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
        <i class="fe fe-menu navbar-toggler-icon"></i>
    </button>
    <ul class="nav ml-auto">
        <li class="nav-item">
            <a class="nav-link text-muted my-2" href="#" id="modeSwitcher" data-mode="light">
                <i class="fe fe-sun fe-16"></i>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink"
                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="avatar avatar-sm mt-2">
                    @if (auth()->user()->profile && auth()->user()->profile->image)
                        <img src="{{ asset('images/foto_profile/' . auth()->user()->profile->image) }}" alt="Profile"
                            class="avatar-img rounded-circle">
                    @else
                        <img src="{{ asset('template/assets/avatars/face-1.jpg') }}" alt="Default"
                            class="avatar-img rounded-circle">
                    @endif
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <div class="dropdown-item text-muted">
                    <strong>{{ auth()->user()->profile->full_name ?? auth()->user()->email }}</strong>
                </div>
                <div class="dropdown-divider"></div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item text-danger">
                        <i class="fe fe-log-out fe-12 mr-2"></i> Sign out
                    </button>
                </form>
            </div>
        </li>
    </ul>
</nav>
