<nav class="navbar bg-body-tertiary sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand text-light" href={{ route('home') }}><img
                src={{ asset('assets/images/frontend/images/deltinLogo.png') }} height='40px'
                alt="deltin-royal-logo"></a>
        <div class="d-flex align-items-center">
            <a href={{ route('user.logout', auth()->user()) }} class="nav-link"><button
                    class="btn blue-gradient mx-2 small-hide">Logout</button></a>
            <button class="navbar-toggler text-light mx-2" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <i class="bi bi-list fs-2"></i>
            </button>
        </div>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h3 class="offcanvas-title d-flex align-items-center" id="offcanvasNavbarLabel">
                    <a href={{ route('profile') }} class="nav-link "><span
                            class="material-symbols-outlined fs-1">person_pin</span></a>
                </h3>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <a class="nav-link active text-light d-flex align-items-center dropdown-toggle"
                    href="{{ route('head.and.tail') }}" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <span class="material-symbols-outlined mx-2">gamepad</span> <b>Head and Tail</b>
                </a>
            </div>
        </div>
    </div>
</nav>
